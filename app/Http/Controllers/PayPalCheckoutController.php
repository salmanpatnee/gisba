<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitiatePayPalRequest;
use App\Mail\WelcomeMemberMail;
use App\Models\MemberAccessToken;
use App\Models\SiteSettings;
use App\Models\User;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PayPalCheckoutController extends Controller
{
    private const COUPON_CODES = ['ISACA50', 'MEPAK50'];

    private const COUPON_PRICE = 499.99;

    public function __construct(private readonly PayPalService $paypal) {}

    public function create(InitiatePayPalRequest $request): RedirectResponse
    {
        $existing = User::where('email', $request->email)->first();

        if ($existing && $existing->isMember()) {
            return redirect()->route('members.login')
                ->with('info', 'You already have an active membership. Please log in.');
        }

        $settings = SiteSettings::current();

        $couponCode = $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null;
        $couponApplied = in_array($couponCode, self::COUPON_CODES, true);

        $amount = $couponApplied ? self::COUPON_PRICE : (float) $settings->membership_price;

        $order = $this->paypal->createOrder(
            route('members.paypal.return', ['email' => $request->email]),
            route('members.paypal.cancel'),
            number_format($amount, 2, '.', ''),
            $settings->membership_currency
        );

        $approvalUrl = collect($order['links'] ?? [])
            ->firstWhere('rel', 'approve')['href'] ?? null;

        if (! $approvalUrl) {
            return back()->withErrors(['paypal' => 'Could not initiate PayPal checkout. Please try again.']);
        }

        session([
            'paypal_pending_email' => $request->email,
            'paypal_pending_amount' => $amount,
            'paypal_pending_coupon_code' => $couponApplied ? $couponCode : null,
        ]);

        return redirect()->away($approvalUrl);
    }

    public function capture(): RedirectResponse
    {
        $orderId = request()->query('token');
        $email = session('paypal_pending_email');
        $couponCode = session('paypal_pending_coupon_code');

        if (! $orderId || ! $email) {
            return redirect()->route('members.paywall')->withErrors(['paypal' => 'Invalid payment session.']);
        }

        $amount = session('paypal_pending_amount', fn () => (float) SiteSettings::current()->membership_price);

        $result = $this->paypal->captureOrder($orderId);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return redirect()->route('members.paywall')->withErrors(['paypal' => 'Payment capture failed. Please try again.']);
        }

        $user = User::where('email', $email)->first();
        $plainPassword = null;

        if (! $user) {
            $plainPassword = Str::password(12, symbols: false);
            $user = User::create([
                'name' => explode('@', $email)[0],
                'email' => $email,
                'password' => bcrypt($plainPassword),
                'email_verified_at' => now(),
            ]);
        }

        $user->update([
            'is_member' => true,
            'member_since' => now(),
        ]);

        $expiresAt = now()->addMonths(6);

        MemberAccessToken::create([
            'email' => $email,
            'token' => Str::random(64),
            'paypal_order_id' => $orderId,
            'amount_paid' => $amount,
            'coupon_code' => $couponCode,
            'expires_at' => $expiresAt,
        ]);

        try {
            Mail::to($email)->send(new WelcomeMemberMail($email, $plainPassword, $expiresAt->format('F j, Y')));
        } catch (\Throwable $e) {
            Log::error('WelcomeMemberMail failed', ['error' => $e->getMessage()]);
        }

        session()->forget(['paypal_pending_email', 'paypal_pending_amount', 'paypal_pending_coupon_code']);

        return redirect()->route('members.email-sent')->with([
            'member_email' => $email,
            'plain_password' => $plainPassword,
            'member_expires_at' => $expiresAt->format('F j, Y'),
        ]);
    }

    public function cancel(): RedirectResponse
    {
        return redirect()->route('members.paywall')->with('info', 'Payment cancelled. You can try again anytime.');
    }
}
