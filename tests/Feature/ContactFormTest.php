<?php

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();
});

it('sends an enquiry and returns success json', function () {
    $this->postJson(route('contact.send'), [
        'name'    => 'Jane Doe',
        'email'   => 'jane@example.com',
        'message' => 'I would like to learn more about NIS2.',
    ])
        ->assertSuccessful()
        ->assertJson(['success' => true]);

    Mail::assertSent(ContactMail::class, function (ContactMail $mail) {
        return $mail->hasTo(config('mail.enquiry_recipient', 'support@gisba.net'))
            && $mail->name === 'Jane Doe'
            && $mail->email === 'jane@example.com';
    });
});

it('validates required fields', function (array $payload, string $field) {
    $this->postJson(route('contact.send'), $payload)
        ->assertUnprocessable()
        ->assertJsonValidationErrors([$field]);
})->with([
    'missing name'    => [['email' => 'a@b.com', 'message' => 'Hello world test.'], 'name'],
    'short name'      => [['name' => 'A', 'email' => 'a@b.com', 'message' => 'Hello world test.'], 'name'],
    'missing email'   => [['name' => 'Jane', 'message' => 'Hello world test.'], 'email'],
    'invalid email'   => [['name' => 'Jane', 'email' => 'not-an-email', 'message' => 'Hello world test.'], 'email'],
    'missing message' => [['name' => 'Jane', 'email' => 'a@b.com'], 'message'],
    'short message'   => [['name' => 'Jane', 'email' => 'a@b.com', 'message' => 'Too short'], 'message'],
]);

it('rejects an invalid phone number', function () {
    $this->postJson(route('contact.send'), [
        'name'    => 'Jane Doe',
        'email'   => 'jane@example.com',
        'phone'   => 'abc',
        'message' => 'I would like to learn more about NIS2.',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['phone']);
});

it('accepts an optional phone number in valid format', function () {
    $this->postJson(route('contact.send'), [
        'name'    => 'Jane Doe',
        'email'   => 'jane@example.com',
        'phone'   => '+973 3839 7453',
        'message' => 'I would like to learn more about NIS2.',
    ])->assertSuccessful()->assertJson(['success' => true]);
});

it('does not send mail when validation fails', function () {
    $this->postJson(route('contact.send'), [])->assertUnprocessable();

    Mail::assertNothingSent();
});
