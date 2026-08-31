<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseCheckoutRequest;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CourseCheckoutController extends Controller
{
    /** @var array<string, string> Course slug => human label, for error messages. */
    private const COURSES = [
        'cissp' => 'CISSP Live Online Training',
        'prince2' => 'PRINCE2 Live Online Training',
    ];

    private const COUPON_CODES = ['ISACA50', 'MEPAK50'];

    private const COUPON_PRICE = 499.99;

    public function __construct(private readonly PayPalService $paypal) {}

    public function create(CourseCheckoutRequest $request, string $course): RedirectResponse
    {
        $this->label($course);
        $settings = SiteSettings::current();

        $couponCode = $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null;
        $couponApplied = in_array($couponCode, self::COUPON_CODES, true);

        $amount = $couponApplied ? self::COUPON_PRICE : (float) $settings->{"{$course}_price"};

        $order = $this->paypal->createOrder(
            route("{$course}.paypal.return"),
            route("{$course}.paypal.cancel"),
            number_format($amount, 2, '.', ''),
            $settings->{"{$course}_currency"}
        );

        $approvalUrl = collect($order['links'] ?? [])
            ->firstWhere('rel', 'approve')['href'] ?? null;

        if (! $approvalUrl) {
            return back()->withErrors([$course => 'Could not initiate PayPal checkout. Please try again.']);
        }

        session([
            "{$course}_pending_name" => $request->name,
            "{$course}_pending_email" => $request->email,
            "{$course}_pending_amount" => $amount,
            "{$course}_pending_coupon_code" => $couponApplied ? $couponCode : null,
        ]);

        return redirect()->away($approvalUrl);
    }

    public function capture(string $course): RedirectResponse
    {
        $this->label($course);

        $orderId = request()->query('token');
        $name = session("{$course}_pending_name");
        $email = session("{$course}_pending_email");
        $amount = session("{$course}_pending_amount");
        $couponCode = session("{$course}_pending_coupon_code");

        if (! $orderId || ! $name || ! $email || ! $amount) {
            return redirect()->route("{$course}.pricing")->withErrors([$course => 'Invalid payment session.']);
        }

        $result = $this->paypal->captureOrder($orderId);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return redirect()->route("{$course}.pricing")->withErrors([$course => 'Payment capture failed. Please try again.']);
        }

        $settings = SiteSettings::current();

        CourseEnrollment::create([
            'course' => $course,
            'name' => $name,
            'email' => $email,
            'amount' => $amount,
            'currency' => $settings->{"{$course}_currency"},
            'coupon_code' => $couponCode,
            'paypal_order_id' => $orderId,
            'status' => 'completed',
        ]);

        session()->forget([
            "{$course}_pending_name",
            "{$course}_pending_email",
            "{$course}_pending_amount",
            "{$course}_pending_coupon_code",
        ]);

        return redirect()->route("{$course}.enrolled")->with([
            'enrollment_name' => $name,
            'enrollment_email' => $email,
        ]);
    }

    public function cancel(string $course): RedirectResponse
    {
        $this->label($course);

        return redirect()->route("{$course}.pricing")->with('info', 'Enrollment cancelled. You can try again anytime.');
    }

    private function label(string $course): string
    {
        return self::COURSES[$course] ?? throw new NotFoundHttpException;
    }
}
