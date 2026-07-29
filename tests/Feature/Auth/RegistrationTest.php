<?php

use App\Models\User;

test('registration screen is not reachable', function () {
    $this->get('/register')->assertNotFound();
});

test('users cannot register', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertNotFound();

    $this->assertGuest();
    expect(User::where('email', 'test@example.com')->exists())->toBeFalse();
});

test('the register route is no longer registered', function () {
    expect(Route::has('register'))->toBeFalse();
});

test('admin accounts are created through the console command', function () {
    $this->artisan('admin:create', ['--name' => 'Ops Admin', '--email' => 'ops@gisba.test'])
        ->expectsQuestion('Password', 'correct-horse-battery-staple')
        ->assertSuccessful();

    expect(User::where('email', 'ops@gisba.test')->exists())->toBeTrue();
});

test('the console command rejects a duplicate email', function () {
    User::factory()->create(['email' => 'taken@gisba.test']);

    $this->artisan('admin:create', ['--name' => 'Ops Admin', '--email' => 'taken@gisba.test'])
        ->expectsQuestion('Password', 'correct-horse-battery-staple')
        ->assertFailed();
});
