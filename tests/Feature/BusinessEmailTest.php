<?php

use App\Rules\BusinessEmail;

it('blocks common free email providers', function (string $email) {
    $rule = new BusinessEmail;
    $failed = false;

    $rule->validate('email', $email, function () use (&$failed) {
        $failed = true;
    });

    expect($failed)->toBeTrue();
})->with([
    'gmail'      => 'user@gmail.com',
    'yahoo'      => 'user@yahoo.com',
    'outlook'    => 'user@outlook.com',
    'hotmail'    => 'user@hotmail.com',
    'live'       => 'user@live.com',
    'aol'        => 'user@aol.com',
    'icloud'     => 'user@icloud.com',
    'mail.com'   => 'user@mail.com',
    'protonmail' => 'user@protonmail.com',
    'zoho'       => 'user@zoho.com',
]);

it('allows business email addresses', function (string $email) {
    $rule = new BusinessEmail;
    $failed = false;

    $rule->validate('email', $email, function () use (&$failed) {
        $failed = true;
    });

    expect($failed)->toBeFalse();
})->with([
    'company'   => 'user@company.com',
    'gisba'     => 'contact@gisba.net',
    'corporate' => 'admin@enterprise.org',
]);

it('rejects a free email domain via the contact form endpoint', function () {
    $payload = [
        'name'       => 'Test User',
        'email'      => 'user@gmail.com',
        'heard_from' => 'google',
        'message'    => 'This is a test message with enough length.',
    ];

    $this->postJson(route('contact.send'), $payload)
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('email');
});
