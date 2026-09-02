<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriscCheckoutRequest;
use App\Models\Coupon;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;

class CriscCheckoutController extends Controller
{
    private const COURSE = 'crisc';

    public function __construct(private readonly PayPalService $paypal) {}

    public function create(CriscCheckoutRequest $request): RedirectResponse
    {
        $settings = SiteSettings::current();

        $couponCode = $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null;
        $coupon = $couponCode ? Coupon::query()->active()->where('name', $couponCode)->first() : null;

        $basePrice = (float) $settings->crisc_price;
        $amount = $coupon ? $coupon->discountedAmount($basePrice) : $basePrice;

        $couponApplied = $coupon !== null;

        $order = $this->paypal->createOrder(
            route('crisc-course.paypal.return'),
            route('crisc-course.paypal.cancel'),
            number_format($amount, 2, '.', ''),
            $settings->crisc_currency
        );

        $approvalUrl = collect($order['links'] ?? [])
            ->firstWhere('rel', 'approve')['href'] ?? null;

        if (! $approvalUrl) {
            return back()->withErrors(['crisc' => 'Could not initiate PayPal checkout. Please try again.']);
        }

        session([
            'crisc_pending_name' => $request->name,
            'crisc_pending_email' => $request->email,
            'crisc_pending_amount' => $amount,
            'crisc_pending_coupon_code' => $couponApplied ? $couponCode : null,
        ]);

        return redirect()->away($approvalUrl);
    }

    public function capture(): RedirectResponse
    {
        $orderId = request()->query('token');
        $name = session('crisc_pending_name');
        $email = session('crisc_pending_email');
        $amount = session('crisc_pending_amount');
        $couponCode = session('crisc_pending_coupon_code');

        if (! $orderId || ! $name || ! $email || ! $amount) {
            return redirect()->route('crisc-course.pricing')->withErrors(['crisc' => 'Invalid payment session.']);
        }

        $result = $this->paypal->captureOrder($orderId);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return redirect()->route('crisc-course.pricing')->withErrors(['crisc' => 'Payment capture failed. Please try again.']);
        }

        $settings = SiteSettings::current();

        CourseEnrollment::create([
            'course' => self::COURSE,
            'name' => $name,
            'email' => $email,
            'amount' => $amount,
            'currency' => $settings->crisc_currency,
            'coupon_code' => $couponCode,
            'paypal_order_id' => $orderId,
            'status' => 'completed',
        ]);

        session()->forget(['crisc_pending_name', 'crisc_pending_email', 'crisc_pending_amount', 'crisc_pending_coupon_code']);

        return redirect()->route('crisc-course.enrolled')->with([
            'enrollment_name' => $name,
            'enrollment_email' => $email,
        ]);
    }

    public function cancel(): RedirectResponse
    {
        return redirect()->route('crisc-course.pricing')->with('info', 'Enrollment cancelled. You can try again anytime.');
    }
}
