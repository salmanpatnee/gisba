<?php

use App\Models\CriscCategory;
use App\Models\CriscPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('shows the crisc articles section on the course landing page', function () {
    $category = CriscCategory::create(['name' => 'Risk Assessment']);
    CriscPost::factory()->count(3)->create(['category_id' => $category->id]);

    $this->get(route('crisc-course'))
        ->assertSuccessful()
        ->assertViewIs('pages.crisc-course')
        ->assertViewHas('categorizedPosts');
});

it('shows a crisc post on the detail page', function () {
    $category = CriscCategory::create(['name' => 'Risk Assessment']);

    $post = CriscPost::factory()->create([
        'title' => 'Test CRISC Article',
        'slug' => 'test-crisc-article',
        'category_id' => $category->id,
    ]);

    $this->get(route('crisc.show', $post->slug))
        ->assertSuccessful()
        ->assertViewIs('pages.crisc-show')
        ->assertSee($post->title);
});

it('returns 404 for a non-existent crisc slug', function () {
    $this->get(route('crisc.show', 'does-not-exist'))
        ->assertNotFound();
});

it('lets an admin create a crisc post', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = CriscCategory::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.crisc.store'), [
            'title' => 'New CRISC Post',
            'body' => '<p>Body content</p>',
            'category_id' => $category->id,
            'featured_image' => UploadedFile::fake()->image('cover.jpg'),
        ])
        ->assertRedirect(route('admin.crisc.index'));

    expect(CriscPost::where('slug', 'new-crisc-post')->exists())->toBeTrue();
});

it('lets an admin update a crisc post', function () {
    $user = User::factory()->create();
    $post = CriscPost::factory()->create(['title' => 'Old Title']);
    $category = CriscCategory::factory()->create();

    $this->actingAs($user)
        ->put(route('admin.crisc.update', $post), [
            'title' => 'Updated Title',
            'body' => $post->body,
            'category_id' => $category->id,
        ])
        ->assertRedirect(route('admin.crisc.index'));

    expect($post->fresh()->title)->toBe('Updated Title');
});

it('lets an admin delete a crisc post', function () {
    $user = User::factory()->create();
    $post = CriscPost::factory()->create();

    $this->actingAs($user)
        ->delete(route('admin.crisc.destroy', $post))
        ->assertRedirect(route('admin.crisc.index'));

    expect(CriscPost::find($post->id))->toBeNull();
});

it('lets an admin create and delete a crisc category', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.crisc-categories.store'), ['name' => 'New Category'])
        ->assertRedirect(route('admin.crisc-categories.index'));

    $category = CriscCategory::where('name', 'New Category')->firstOrFail();

    $this->actingAs($user)
        ->delete(route('admin.crisc-categories.destroy', $category))
        ->assertRedirect(route('admin.crisc-categories.index'));

    expect(CriscCategory::find($category->id))->toBeNull();
});

it('blocks deleting a crisc category that still has posts', function () {
    $user = User::factory()->create();
    $category = CriscCategory::factory()->create();
    CriscPost::factory()->create(['category_id' => $category->id]);

    $this->actingAs($user)
        ->delete(route('admin.crisc-categories.destroy', $category))
        ->assertRedirect(route('admin.crisc-categories.index'))
        ->assertSessionHas('error');

    expect(CriscCategory::find($category->id))->not->toBeNull();
});
