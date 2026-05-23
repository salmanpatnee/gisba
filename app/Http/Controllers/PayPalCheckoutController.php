<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitiatePayPalRequest;
use App\Mail\WelcomeMemberMail;
use App\Models\MemberAccessToken;
use App\Models\User;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PayPalCheckoutController extends Controller
{
    public function __construct(private readonly PayPalService $paypal) {}

    public function create(InitiatePayPalRequest $request): RedirectResponse
    {
        $existing = User::where('email', $request->email)->first();

        if ($existing && $existing->isMember()) {
            return redirect()->route('members.login')
                ->with('info', 'You already have an active membership. Please log in.');
        }

        $order = $this->paypal->createOrder(
            route('members.paypal.return', ['email' => $request->email]),
            route('members.paypal.cancel')
        );

        $approvalUrl = collect($order['links'] ?? [])
            ->firstWhere('rel', 'approve')['href'] ?? null;

        if (! $approvalUrl) {
            return back()->withErrors(['paypal' => 'Could not initiate PayPal checkout. Please try again.']);
        }

        session(['paypal_pending_email' => $request->email]);

        return redirect()->away($approvalUrl);
    }

    public function capture(): RedirectResponse
    {
        $orderId = request()->query('token');
        $email = session('paypal_pending_email');

        if (! $orderId || ! $email) {
            return redirect()->route('members.paywall')->withErrors(['paypal' => 'Invalid payment session.']);
        }

        $result = $this->paypal->captureOrder($orderId);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return redirect()->route('members.paywall')->withErrors(['paypal' => 'Payment capture failed. Please try again.']);
        }

        $user = User::where('email', $email)->first();
        $plainPassword = null;

        if (! $user) {
            $plainPassword = Str::password(12);
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

        MemberAccessToken::create([
            'email' => $email,
            'token' => Str::random(64),
            'paypal_order_id' => $orderId,
            'expires_at' => now()->addMonths(6),
        ]);

        Mail::to($email)->send(new WelcomeMemberMail($email, $plainPassword, now()->addMonths(6)->format('F j, Y')));

        session()->forget('paypal_pending_email');

        return redirect()->route('members.email-sent');
    }

    public function cancel(): RedirectResponse
    {
        return redirect()->route('members.paywall')->with('info', 'Payment cancelled. You can try again anytime.');
    }
}
