<?php

use App\Models\MemberPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects guest to login on index', function () {
    $this->get(route('admin.member-posts.index'))
        ->assertRedirect(route('login'));
});

it('shows index to authenticated user', function () {
    $user = User::factory()->create();
    MemberPost::factory()->count(3)->create();

    $this->actingAs($user)
        ->get(route('admin.member-posts.index'))
        ->assertSuccessful();
});

it('shows create form', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.member-posts.create'))
        ->assertSuccessful();
});

it('stores a new post', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.member-posts.store'), [
            'title' => 'My Member Post',
            'body' => '<p>Content here.</p>',
        ])
        ->assertRedirect(route('admin.member-posts.index'));

    expect(MemberPost::where('title', 'My Member Post')->exists())->toBeTrue();
});

it('validates required fields on store', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.member-posts.store'), [])
        ->assertSessionHasErrors(['title', 'body']);
});

it('shows edit form', function () {
    $user = User::factory()->create();
    $post = MemberPost::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.member-posts.edit', $post))
        ->assertSuccessful()
        ->assertSee($post->title);
});

it('updates a post', function () {
    $user = User::factory()->create();
    $post = MemberPost::factory()->create();

    $this->actingAs($user)
        ->put(route('admin.member-posts.update', $post), [
            'title' => 'Updated Title',
            'body' => '<p>Updated body.</p>',
        ])
        ->assertRedirect(route('admin.member-posts.index'));

    expect($post->fresh()->title)->toBe('Updated Title');
});

it('validates required fields on update', function () {
    $user = User::factory()->create();
    $post = MemberPost::factory()->create();

    $this->actingAs($user)
        ->put(route('admin.member-posts.update', $post), [])
        ->assertSessionHasErrors(['title', 'body']);
});

it('destroys a post', function () {
    $user = User::factory()->create();
    $post = MemberPost::factory()->create();

    $this->actingAs($user)
        ->delete(route('admin.member-posts.destroy', $post))
        ->assertRedirect(route('admin.member-posts.index'));

    expect(MemberPost::find($post->id))->toBeNull();
});
