<?php

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('stores attachments when creating a blog post', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $category = Category::create(['name' => 'Cybersecurity Governance']);

    $this->post(route('admin.blog.store'), [
        'title' => 'Post With Attachments',
        'body' => '<p>Content.</p>',
        'category_id' => $category->id,
        'attachments' => [
            UploadedFile::fake()->create('report.pdf', 100, 'application/pdf'),
            UploadedFile::fake()->image('diagram.png'),
        ],
    ])->assertRedirect(route('admin.blog.index'));

    $post = BlogPost::where('slug', 'post-with-attachments')->firstOrFail();

    expect($post->attachments)->toHaveCount(2);
    expect($post->attachments->pluck('filename'))->toContain('report.pdf', 'diagram.png');

    Storage::disk('public')->assertExists($post->attachments->first()->path);
});

it('shows existing attachments on the edit form', function () {
    $this->actingAs(User::factory()->create());
    $post = BlogPost::factory()->create();
    $attachment = $post->attachments()->create([
        'filename' => 'guide.pdf',
        'path' => 'blog/attachments/guide.pdf',
        'mime_type' => 'application/pdf',
        'size' => 2048,
    ]);

    $this->get(route('admin.blog.edit', $post))
        ->assertSuccessful()
        ->assertSee('guide.pdf');
});

it('deletes marked attachments when updating a blog post', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $category = Category::create(['name' => 'Cybersecurity Governance']);
    $post = BlogPost::factory()->create(['category_id' => $category->id]);
    $file = UploadedFile::fake()->create('old-file.pdf', 50, 'application/pdf');
    $path = $file->store('blog/attachments', 'public');

    $attachment = $post->attachments()->create([
        'filename' => 'old-file.pdf',
        'path' => $path,
        'mime_type' => 'application/pdf',
        'size' => 51200,
    ]);

    $this->put(route('admin.blog.update', $post), [
        'title' => $post->title,
        'body' => $post->body,
        'category_id' => $category->id,
        'delete_attachments' => [$attachment->id],
    ])->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseMissing('blog_post_attachments', ['id' => $attachment->id]);
    Storage::disk('public')->assertMissing($path);
});

it('adds new attachments when updating a blog post', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $category = Category::create(['name' => 'Cybersecurity Governance']);
    $post = BlogPost::factory()->create(['category_id' => $category->id]);

    $this->put(route('admin.blog.update', $post), [
        'title' => $post->title,
        'body' => $post->body,
        'category_id' => $category->id,
        'attachments' => [
            UploadedFile::fake()->create('new-doc.docx', 80, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        ],
    ])->assertRedirect(route('admin.blog.index'));

    expect($post->fresh()->attachments)->toHaveCount(1);
});

it('deletes all attachments when deleting a blog post', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $post = BlogPost::factory()->create();
    $file = UploadedFile::fake()->create('doc.pdf', 50, 'application/pdf');
    $path = $file->store('blog/attachments', 'public');

    $post->attachments()->create([
        'filename' => 'doc.pdf',
        'path' => $path,
        'mime_type' => 'application/pdf',
        'size' => 51200,
    ]);

    $this->delete(route('admin.blog.destroy', $post))
        ->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
    $this->assertDatabaseMissing('blog_post_attachments', ['blog_post_id' => $post->id]);
    Storage::disk('public')->assertMissing($path);
});

it('rejects invalid file types for attachments', function () {
    $this->actingAs(User::factory()->create());

    $category = Category::create(['name' => 'Cybersecurity Governance']);

    $this->post(route('admin.blog.store'), [
        'title' => 'Post',
        'body' => '<p>Content.</p>',
        'category_id' => $category->id,
        'attachments' => [
            UploadedFile::fake()->create('script.exe', 10, 'application/x-msdownload'),
        ],
    ])->assertSessionHasErrors('attachments.*');
});

it('shows downloadable resources on the public blog show page', function () {
    $post = BlogPost::factory()->create();
    $post->attachments()->create([
        'filename' => 'nis2-guide.pdf',
        'path' => 'blog/attachments/nis2-guide.pdf',
        'mime_type' => 'application/pdf',
        'size' => 102400,
    ]);

    $this->get(route('nis2.show', $post->slug))
        ->assertSuccessful()
        ->assertSee('Downloadable Resources')
        ->assertSee('nis2-guide.pdf');
});

it('hides the downloadable resources section when a post has no attachments', function () {
    $post = BlogPost::factory()->create();

    $this->get(route('nis2.show', $post->slug))
        ->assertSuccessful()
        ->assertDontSee('class="resources-section"', escape: false);
});
