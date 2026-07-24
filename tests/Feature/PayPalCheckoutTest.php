<?php

use App\Mail\WelcomeMemberMail;
use App\Models\MemberAccessToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

beforeEach(function () {
    config([
        'services.paypal.client_id' => 'test-client-id',
        'services.paypal.client_secret' => 'test-secret',
        'services.paypal.mode' => 'sandbox',
        'services.paypal.fake' => false,
    ]);

    Cache::forget('paypal_access_token');

    Http::fake([
        '*oauth2/token*' => Http::response(['access_token' => 'fake-token', 'expires_in' => 28800], 200),
        '*checkout/orders' => Http::response([
            'id' => 'ORDER-123',
            'status' => 'CREATED',
            'links' => [
                ['rel' => 'approve', 'href' => 'https://paypal.com/approve?token=ORDER-123'],
            ],
        ], 201),
        '*orders/ORDER-123/capture*' => Http::response([
            'id' => 'ORDER-123',
            'status' => 'COMPLETED',
        ], 201),
    ]);
});

it('redirects existing member to login instead of PayPal', function () {
    $user = User::factory()->member()->create(['email' => 'member@example.com']);

    $this->post(route('members.checkout'), ['email' => 'member@example.com'])
        ->assertRedirect(route('members.login'))
        ->assertSessionHas('info');
});

it('rejects invalid email', function () {
    $this->post(route('members.checkout'), ['email' => 'not-an-email'])
        ->assertRedirect()
        ->assertSessionHasErrors('email');
});

it('redirects to PayPal on valid checkout', function () {
    $response = $this->post(route('members.checkout'), ['email' => 'test@example.com']);

    $response->assertRedirect('https://paypal.com/approve?token=ORDER-123');
    expect(session('paypal_pending_email'))->toBe('test@example.com');
});

it('creates user, stores audit token, sends welcome email, and redirects to success page on capture', function () {
    Mail::fake();
    session(['paypal_pending_email' => 'buyer@example.com']);

    $response = $this->get(route('members.paypal.return', ['token' => 'ORDER-123']));

    $response->assertRedirect(route('members.email-sent'));
    $response->assertSessionHas('member_email', 'buyer@example.com');
    $response->assertSessionHas('plain_password', fn ($password) => ! empty($password));

    $this->assertGuest();
    expect(User::where('email', 'buyer@example.com')->value('is_member'))->toBeTrue();
    expect(MemberAccessToken::where('email', 'buyer@example.com')->exists())->toBeTrue();
    Mail::assertSent(WelcomeMemberMail::class, fn ($mail) => $mail->hasTo('buyer@example.com'));

    $plainPassword = session('plain_password');
    $this->get(route('members.email-sent'))
        ->assertOk()
        ->assertSee('buyer@example.com')
        ->assertSee($plainPassword);
});

it('sets is_member on existing user without changing password', function () {
    Mail::fake();
    $user = User::factory()->create(['email' => 'existing@example.com', 'is_member' => false]);
    $oldHash = $user->password;
    session(['paypal_pending_email' => 'existing@example.com']);

    $response = $this->get(route('members.paypal.return', ['token' => 'ORDER-123']));

    expect($user->fresh()->is_member)->toBeTrue();
    expect($user->fresh()->password)->toBe($oldHash);
    Mail::assertSent(WelcomeMemberMail::class, fn ($m) => $m->password === null);

    $response->assertSessionHas('plain_password', null);

    $this->get(route('members.email-sent'))
        ->assertOk()
        ->assertSee('existing@example.com')
        ->assertSee('Use your existing password');
});

it('still redirects to success page and provisions membership when the welcome email fails to send', function () {
    Mail::shouldReceive('to')->andThrow(new RuntimeException('Unable to connect with STARTTLS'));
    session(['paypal_pending_email' => 'buyer@example.com']);

    $response = $this->get(route('members.paypal.return', ['token' => 'ORDER-123']));

    $response->assertRedirect(route('members.email-sent'));
    $response->assertSessionHas('member_email', 'buyer@example.com');

    expect(User::where('email', 'buyer@example.com')->value('is_member'))->toBeTrue();
    expect(MemberAccessToken::where('email', 'buyer@example.com')->exists())->toBeTrue();

    $this->get(route('members.email-sent'))
        ->assertOk()
        ->assertSee('buyer@example.com');
});

it('shows a generic fallback on the success page when visited without a fresh payment', function () {
    $this->get(route('members.email-sent'))
        ->assertOk()
        ->assertSee('Thanks for your recent purchase')
        ->assertSee('Reset it here');
});

it('redirects to paywall on missing session', function () {
    $this->get(route('members.paypal.return', ['token' => 'ORDER-123']))
        ->assertRedirect(route('members.paywall'));
});

it('redirects to paywall on cancel', function () {
    $this->get(route('members.paypal.cancel'))
        ->assertRedirect(route('members.paywall'));
});
