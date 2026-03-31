<?php

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the blog index page with posts', function () {
    BlogPost::factory()->count(3)->create();

    $this->get(route('nis2'))
        ->assertSuccessful()
        ->assertViewIs('pages.blog')
        ->assertViewHas('categorizedPosts');
});

it('shows a blog post on the detail page', function () {
    $category = Category::create(['name' => 'Cybersecurity']);
    
    $post = BlogPost::factory()->create([
        'title' => 'Test Article',
        'slug' => 'test-article',
        'category_id' => $category->id,
    ]);

    $this->get(route('nis2.show', $post->slug))
        ->assertSuccessful()
        ->assertViewIs('pages.blog-show')
        ->assertSee($post->title);
});

it('returns 404 for a non-existent blog slug', function () {
    $this->get(route('nis2.show', 'does-not-exist'))
        ->assertNotFound();
});

it('passes related posts to the detail view', function () {
    $post = BlogPost::factory()->create();
    BlogPost::factory()->count(2)->create();

    $response = $this->get(route('nis2.show', $post->slug));

    $response->assertSuccessful()
        ->assertViewHas('related');

    expect($response->viewData('related'))->toHaveCount(2);
});
