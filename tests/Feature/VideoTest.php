<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

// ── View tracking ────────────────────────────────────────────────────────────

it('increments the view count when a video is played', function () {
    $video = Video::factory()->create(['views' => 0]);

    $this->post(route('videos.record-view', $video))
        ->assertSuccessful()
        ->assertJson(['views' => 1]);

    expect($video->fresh()->views)->toBe(1);
});

it('does not double-count on repeated requests from the same play session', function () {
    $video = Video::factory()->create(['views' => 5]);

    $this->post(route('videos.record-view', $video));
    $this->post(route('videos.record-view', $video));

    expect($video->fresh()->views)->toBe(7);
});

// ── Public page ───────────────────────────────────────────────────────────────

it('shows the public video resources page', function () {
    $this->get(route('video-resources'))->assertSuccessful();
});

it('shows videos on the public page', function () {
    Storage::fake('public');

    $video = Video::factory()->create(['title' => 'NIS2 Intro Video']);

    $this->get(route('video-resources'))
        ->assertSuccessful()
        ->assertSee('NIS2 Intro Video');
});

it('shows empty state when no videos exist', function () {
    $this->get(route('video-resources'))
        ->assertSuccessful()
        ->assertSee('No Videos Yet');
});

// ── Admin access ──────────────────────────────────────────────────────────────

it('redirects guests from admin videos index', function () {
    $this->get(route('admin.videos.index'))->assertRedirect(route('login'));
});

it('shows admin videos index to authenticated users', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.videos.index'))
        ->assertSuccessful();
});

it('shows admin video upload form', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.videos.create'))
        ->assertSuccessful()
        ->assertSee('Upload Video');
});

// ── Upload ────────────────────────────────────────────────────────────────────

it('uploads a video successfully', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())
        ->post(route('admin.videos.store'), [
            'title' => 'Test Training Video',
            'video' => UploadedFile::fake()->create('test.mp4', 5000, 'video/mp4'),
        ])
        ->assertRedirect(route('admin.videos.index'))
        ->assertSessionHas('success');

    expect(Video::where('title', 'Test Training Video')->exists())->toBeTrue();
    Storage::disk('public')->assertExists(Video::first()->path);
});

it('validates the video title is required', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.videos.store'), [
            'title' => '',
            'video' => UploadedFile::fake()->create('test.mp4', 5000, 'video/mp4'),
        ])
        ->assertSessionHasErrors('title');
});

it('validates the video file is required', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.videos.store'), [
            'title' => 'Some Video',
        ])
        ->assertSessionHasErrors('video');
});

it('rejects invalid video file types', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.videos.store'), [
            'title' => 'Some Video',
            'video' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        ])
        ->assertSessionHasErrors('video');
});

// ── Edit / Update ─────────────────────────────────────────────────────────────

it('shows the admin video edit form', function () {
    $video = Video::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('admin.videos.edit', $video))
        ->assertSuccessful()
        ->assertSee('Edit Video')
        ->assertSee($video->title);
});

it('updates the video title only', function () {
    $video = Video::factory()->create(['title' => 'Old Title']);

    $this->actingAs(User::factory()->create())
        ->patch(route('admin.videos.update', $video), ['title' => 'New Title'])
        ->assertRedirect(route('admin.videos.index'))
        ->assertSessionHas('success');

    expect($video->fresh()->title)->toBe('New Title');
    expect($video->fresh()->path)->toBe($video->path);
});

it('replaces the video file when a new one is uploaded', function () {
    Storage::fake('public');

    $oldFile = UploadedFile::fake()->create('old.mp4', 100, 'video/mp4');
    $oldPath = $oldFile->store('videos', 'public');
    $video = Video::factory()->create(['path' => $oldPath]);

    $this->actingAs(User::factory()->create())
        ->patch(route('admin.videos.update', $video), [
            'title' => $video->title,
            'video' => UploadedFile::fake()->create('new.mp4', 200, 'video/mp4'),
        ])
        ->assertRedirect(route('admin.videos.index'))
        ->assertSessionHas('success');

    Storage::disk('public')->assertMissing($oldPath);
    Storage::disk('public')->assertExists($video->fresh()->path);
});

// ── Delete ────────────────────────────────────────────────────────────────────

it('deletes a video and removes the file', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('video.mp4', 100, 'video/mp4');
    $path = $file->store('videos', 'public');

    $video = Video::factory()->create(['path' => $path]);

    $this->actingAs(User::factory()->create())
        ->delete(route('admin.videos.destroy', $video))
        ->assertRedirect(route('admin.videos.index'))
        ->assertSessionHas('success');

    expect(Video::find($video->id))->toBeNull();
    Storage::disk('public')->assertMissing($path);
});
