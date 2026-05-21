<?php

use App\Models\MemberPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows paywall to guest', function () {
    $this->get(route('members.paywall'))->assertSuccessful();
});

it('redirects guest from library to member login', function () {
    $this->get(route('members.index'))
        ->assertRedirect(route('members.login'));
});

it('redirects authenticated non-member from library', function () {
    $user = User::factory()->create(['is_member' => false]);

    $this->actingAs($user)
        ->get(route('members.index'))
        ->assertRedirect(route('members.paywall'));
});

it('allows authenticated member to access library', function () {
    $user = User::factory()->create(['is_member' => true]);
    MemberPost::factory()->count(2)->create();

    $this->actingAs($user)
        ->get(route('members.index'))
        ->assertSuccessful();
});

it('allows member to view a post', function () {
    $user = User::factory()->create(['is_member' => true]);
    $post = MemberPost::factory()->create();

    $this->actingAs($user)
        ->get(route('members.show', $post->slug))
        ->assertSuccessful()
        ->assertSee($post->title);
});
