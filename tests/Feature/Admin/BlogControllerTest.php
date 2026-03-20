<?php

use App\Enums\Category;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

// ── Guests are redirected ─────────────────────────────────────────────────────

it('redirects guests away from the admin blog index', function () {
    $this->get(route('admin.blog.index'))->assertRedirect(route('login'));
});

it('redirects guests away from the create form', function () {
    $this->get(route('admin.blog.create'))->assertRedirect(route('login'));
});

// ── Authenticated access ──────────────────────────────────────────────────────

it('shows the admin blog index to authenticated users', function () {
    $this->actingAs(User::factory()->create());

    BlogPost::factory()->count(2)->create();

    $this->get(route('admin.blog.index'))
        ->assertSuccessful()
        ->assertViewIs('admin.blog.index');
});

it('shows the create form to authenticated users', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('admin.blog.create'))
        ->assertSuccessful()
        ->assertViewIs('admin.blog.create');
});

it('stores a new blog post', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.blog.store'), [
        'title' => 'A New Post',
        'body' => '<p>Post content here.</p>',
        'category' => Category::Governance->value,
        'featured_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => 'A New Post | GISBA',
        'meta_description' => 'Short description.',
    ])->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseHas('blog_posts', [
        'title' => 'A New Post',
        'slug' => 'a-new-post',
        'category' => Category::Governance->value,
        'author' => 'GISBA Editorial Team',
    ]);
});

it('validates required fields on store', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.blog.store'), [])
        ->assertSessionHasErrors(['title', 'body', 'category']);
});

it('shows the edit form for an existing post', function () {
    $this->actingAs(User::factory()->create());
    $post = BlogPost::factory()->create();

    $this->get(route('admin.blog.edit', $post))
        ->assertSuccessful()
        ->assertViewIs('admin.blog.edit')
        ->assertSee($post->title);
});

it('updates an existing blog post', function () {
    $this->actingAs(User::factory()->create());
    $post = BlogPost::factory()->create();

    $this->put(route('admin.blog.update', $post), [
        'title' => 'Updated Title',
        'body' => '<p>Updated body.</p>',
        'category' => Category::News->value,
    ])->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseHas('blog_posts', [
        'id' => $post->id,
        'title' => 'Updated Title',
        'category' => Category::News->value,
    ]);
});

it('deletes a blog post', function () {
    $this->actingAs(User::factory()->create());
    $post = BlogPost::factory()->create();

    $this->delete(route('admin.blog.destroy', $post))
        ->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
});
