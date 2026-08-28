<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseCheckoutRequest;
use App\Mail\CourseEnrollmentConfirmationMail;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CourseCheckoutController extends Controller
{
    /** @var array<string, string> Course slug => human label, for error messages. */
    private const COURSES = [
        'cissp' => 'CISSP Live Online Training',
        'prince2' => 'PRINCE2 Live Online Training',
    ];

    public function __construct(private readonly PayPalService $paypal) {}

    public function create(CourseCheckoutRequest $request, string $course): RedirectResponse
    {
        $label = $this->label($course);
        $settings = SiteSettings::current();

        if ($settings->{"{$course}_seats_remaining"} <= 0) {
            return back()->withErrors([$course => "The {$label} is fully booked. Please contact us to join the waitlist."]);
        }

        $order = $this->paypal->createOrder(
            route("{$course}.paypal.return"),
            route("{$course}.paypal.cancel"),
            number_format((float) $settings->{"{$course}_price"}, 2, '.', ''),
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
        ]);

        return redirect()->away($approvalUrl);
    }

    public function capture(string $course): RedirectResponse
    {
        $this->label($course);

        $orderId = request()->query('token');
        $name = session("{$course}_pending_name");
        $email = session("{$course}_pending_email");

        if (! $orderId || ! $name || ! $email) {
            return redirect()->route("{$course}.pricing")->withErrors([$course => 'Invalid payment session.']);
        }

        $result = $this->paypal->captureOrder($orderId);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return redirect()->route("{$course}.pricing")->withErrors([$course => 'Payment capture failed. Please try again.']);
        }

        $settings = SiteSettings::current();

        $enrollment = CourseEnrollment::create([
            'course' => $course,
            'name' => $name,
            'email' => $email,
            'amount' => $settings->{"{$course}_price"},
            'currency' => $settings->{"{$course}_currency"},
            'paypal_order_id' => $orderId,
            'status' => 'completed',
        ]);

        try {
            Mail::to($email)->send(new CourseEnrollmentConfirmationMail($enrollment));
        } catch (\Throwable $e) {
            Log::error('CourseEnrollmentConfirmationMail failed', ['error' => $e->getMessage()]);
        }

        session()->forget(["{$course}_pending_name", "{$course}_pending_email"]);

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
