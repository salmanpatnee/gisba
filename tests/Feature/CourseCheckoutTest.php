<?php

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
        'cissp_price' => 9.99,
        'cissp_currency' => 'USD',
        'cissp_capacity' => 15,
        'prince2_price' => 9.99,
        'prince2_currency' => 'USD',
        'prince2_capacity' => 15,
    ]);
});

dataset('courses', ['cissp', 'prince2']);

it('rejects an invalid email', function (string $course) {
    $this->post(route("{$course}.checkout"), ['name' => 'Jane Doe', 'email' => 'not-an-email'])
        ->assertRedirect()
        ->assertSessionHasErrors('email');
})->with('courses');

it('redirects to PayPal with the configured price on valid checkout', function (string $course) {
    Http::fake([
        '*oauth2/token*' => Http::response(['access_token' => 'fake-token', 'expires_in' => 28800], 200),
        '*checkout/orders' => Http::response([
            'id' => "ORDER-{$course}-1",
            'status' => 'CREATED',
            'links' => [
                ['rel' => 'approve', 'href' => "https://paypal.com/approve?token=ORDER-{$course}-1"],
            ],
        ], 201),
    ]);

    $response = $this->post(route("{$course}.checkout"), [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
    ]);

    $response->assertRedirect("https://paypal.com/approve?token=ORDER-{$course}-1");
    expect(session("{$course}_pending_email"))->toBe('jane@example.com');

    Http::assertSent(function ($request) {
        if (! str_contains($request->url(), 'checkout/orders')) {
            return false;
        }

        return $request['purchase_units'][0]['amount'] === [
            'currency_code' => 'USD',
            'value' => '9.99',
        ];
    });
})->with('courses');

it('rejects checkout once the course is fully booked', function (string $course) {
    CourseEnrollment::factory()->count(15)->create(['course' => $course]);

    $this->post(route("{$course}.checkout"), ['name' => 'Jane Doe', 'email' => 'jane@example.com'])
        ->assertRedirect()
        ->assertSessionHasErrors($course);

    Http::assertNothingSent();
})->with('courses');

it('creates an enrollment without sending a confirmation email on capture', function (string $course) {
    Http::fake([
        '*oauth2/token*' => Http::response(['access_token' => 'fake-token', 'expires_in' => 28800], 200),
        "*orders/ORDER-{$course}-1/capture*" => Http::response([
            'id' => "ORDER-{$course}-1",
            'status' => 'COMPLETED',
        ], 201),
    ]);

    Mail::fake();
    session(["{$course}_pending_name" => 'Jane Doe', "{$course}_pending_email" => 'jane@example.com']);

    $response = $this->get(route("{$course}.paypal.return", ['token' => "ORDER-{$course}-1"]));

    $response->assertRedirect(route("{$course}.enrolled"));

    $enrollment = CourseEnrollment::where('paypal_order_id', "ORDER-{$course}-1")->firstOrFail();
    expect($enrollment->course)->toBe($course);
    expect($enrollment->name)->toBe('Jane Doe');
    expect($enrollment->email)->toBe('jane@example.com');
    expect((float) $enrollment->amount)->toBe(9.99);
    expect($enrollment->status)->toBe('completed');

    Mail::assertNothingSent();
})->with('courses');
