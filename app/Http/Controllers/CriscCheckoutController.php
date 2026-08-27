<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriscCheckoutRequest;
use App\Mail\CourseEnrollmentConfirmationMail;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CriscCheckoutController extends Controller
{
    private const COURSE = 'crisc';

    public function __construct(private readonly PayPalService $paypal) {}

    public function create(CriscCheckoutRequest $request): RedirectResponse
    {
        $settings = SiteSettings::current();

        if ($settings->crisc_seats_remaining <= 0) {
            return back()->withErrors(['crisc' => 'The CRISC Online Course is fully booked. Please contact us to join the waitlist.']);
        }

        $order = $this->paypal->createOrder(
            route('crisc-course.paypal.return'),
            route('crisc-course.paypal.cancel'),
            number_format((float) $settings->crisc_price, 2, '.', ''),
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
        ]);

        return redirect()->away($approvalUrl);
    }

    public function capture(): RedirectResponse
    {
        $orderId = request()->query('token');
        $name = session('crisc_pending_name');
        $email = session('crisc_pending_email');

        if (! $orderId || ! $name || ! $email) {
            return redirect()->route('crisc-course.pricing')->withErrors(['crisc' => 'Invalid payment session.']);
        }

        $result = $this->paypal->captureOrder($orderId);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return redirect()->route('crisc-course.pricing')->withErrors(['crisc' => 'Payment capture failed. Please try again.']);
        }

        $settings = SiteSettings::current();

        $enrollment = CourseEnrollment::create([
            'course' => self::COURSE,
            'name' => $name,
            'email' => $email,
            'amount' => $settings->crisc_price,
            'currency' => $settings->crisc_currency,
            'paypal_order_id' => $orderId,
            'status' => 'completed',
        ]);

        try {
            Mail::to($email)->send(new CourseEnrollmentConfirmationMail($enrollment));
        } catch (\Throwable $e) {
            Log::error('CourseEnrollmentConfirmationMail failed', ['error' => $e->getMessage()]);
        }

        session()->forget(['crisc_pending_name', 'crisc_pending_email']);

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
