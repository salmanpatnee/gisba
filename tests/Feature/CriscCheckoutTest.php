<?php

use App\Mail\CourseEnrollmentConfirmationMail;
use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
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

    SiteSettings::current()->update([
        'crisc_price' => 9.99,
        'crisc_currency' => 'USD',
        'crisc_capacity' => 12,
    ]);

    Http::fake([
        '*oauth2/token*' => Http::response(['access_token' => 'fake-token', 'expires_in' => 28800], 200),
        '*checkout/orders' => Http::response([
            'id' => 'ORDER-CRISC-1',
            'status' => 'CREATED',
            'links' => [
                ['rel' => 'approve', 'href' => 'https://paypal.com/approve?token=ORDER-CRISC-1'],
            ],
        ], 201),
        '*orders/ORDER-CRISC-1/capture*' => Http::response([
            'id' => 'ORDER-CRISC-1',
            'status' => 'COMPLETED',
        ], 201),
    ]);
});

it('rejects an invalid email', function () {
    $this->post(route('crisc-course.checkout'), ['name' => 'Jane Doe', 'email' => 'not-an-email'])
        ->assertRedirect()
        ->assertSessionHasErrors('email');
});

it('rejects a free-mail address via the business email rule', function () {
    $this->post(route('crisc-course.checkout'), ['name' => 'Jane Doe', 'email' => 'jane@gmail.com'])
        ->assertRedirect()
        ->assertSessionHasErrors('email');
});

it('redirects to PayPal with the configured price on valid checkout', function () {
    $response = $this->post(route('crisc-course.checkout'), [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
    ]);

    $response->assertRedirect('https://paypal.com/approve?token=ORDER-CRISC-1');
    expect(session('crisc_pending_email'))->toBe('jane@example.com');

    Http::assertSent(function ($request) {
        if (! str_contains($request->url(), 'checkout/orders')) {
            return false;
        }

        return $request['purchase_units'][0]['amount'] === [
            'currency_code' => 'USD',
            'value' => '9.99',
        ];
    });
});

it('rejects checkout once the course is fully booked', function () {
    CourseEnrollment::factory()->count(12)->create(['course' => 'crisc']);

    $this->post(route('crisc-course.checkout'), ['name' => 'Jane Doe', 'email' => 'jane@example.com'])
        ->assertRedirect()
        ->assertSessionHasErrors('crisc');

    Http::assertNotSent(fn ($request) => str_contains($request->url(), 'checkout/orders'));
});

it('creates an enrollment and sends a confirmation email on capture', function () {
    Mail::fake();
    session(['crisc_pending_name' => 'Jane Doe', 'crisc_pending_email' => 'jane@example.com']);

    $response = $this->get(route('crisc-course.paypal.return', ['token' => 'ORDER-CRISC-1']));

    $response->assertRedirect(route('crisc-course.enrolled'));

    $enrollment = CourseEnrollment::where('paypal_order_id', 'ORDER-CRISC-1')->firstOrFail();
    expect($enrollment->course)->toBe('crisc');
    expect($enrollment->name)->toBe('Jane Doe');
    expect($enrollment->email)->toBe('jane@example.com');
    expect((float) $enrollment->amount)->toBe(9.99);
    expect($enrollment->status)->toBe('completed');

    Mail::assertSent(CourseEnrollmentConfirmationMail::class, fn ($mail) => $mail->hasTo('jane@example.com'));
});
