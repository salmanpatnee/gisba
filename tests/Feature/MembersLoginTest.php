<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the member login form to guests', function () {
    $this->get(route('members.login'))->assertOk()->assertViewIs('pages.members-login');
});

it('redirects already-authenticated members away from login form', function () {
    $user = User::factory()->member()->create();

    $this->actingAs($user)
        ->get(route('members.login'))
        ->assertRedirect(route('members.chapters.index'));
});

it('logs in a valid member and redirects to chapters', function () {
    $user = User::factory()->member()->create(['password' => bcrypt('secret123')]);

    $this->post(route('members.login.submit'), ['email' => $user->email, 'password' => 'secret123'])
        ->assertRedirect(route('members.chapters.index'));

    $this->assertAuthenticated();
});

it('rejects valid credentials for a non-member account', function () {
    $user = User::factory()->create(['is_member' => false, 'password' => bcrypt('secret123')]);

    $this->post(route('members.login.submit'), ['email' => $user->email, 'password' => 'secret123'])
        ->assertRedirect()
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('rejects wrong password', function () {
    $user = User::factory()->create(['is_member' => true, 'password' => bcrypt('correct')]);

    $this->post(route('members.login.submit'), ['email' => $user->email, 'password' => 'wrong'])
        ->assertRedirect()
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('validates email field is required', function () {
    $this->post(route('members.login.submit'), ['email' => '', 'password' => 'secret'])
        ->assertSessionHasErrors('email');
});

it('logs out and redirects to home', function () {
    $user = User::factory()->create(['is_member' => true]);

    $this->actingAs($user)
        ->post(route('members.logout'))
        ->assertRedirect(route('home'));

    $this->assertGuest();
});
