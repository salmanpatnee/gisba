<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows paywall to guest', function () {
    $this->get(route('members.paywall'))->assertSuccessful();
});

it('redirects guest from chapters to member login', function () {
    $this->get(route('members.chapters.index'))
        ->assertRedirect(route('members.login'));
});

it('redirects authenticated non-member from chapters', function () {
    $user = User::factory()->create(['is_member' => false]);

    $this->actingAs($user)
        ->get(route('members.chapters.index'))
        ->assertRedirect(route('members.paywall'));
});

it('allows authenticated member to access chapters', function () {
    $user = User::factory()->create(['is_member' => true]);

    $this->actingAs($user)
        ->get(route('members.chapters.index'))
        ->assertSuccessful();
});
