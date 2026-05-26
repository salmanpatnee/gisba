<?php

use App\Enums\ResourceType;
use App\Models\Chapter;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

// ── Admin upload form ─────────────────────────────────────────────────────────

it('shows quiz video input on admin resource upload form', function () {
    $chapter = Chapter::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('admin.chapters.resources.create', $chapter))
        ->assertSuccessful()
        ->assertSee('Quiz (MP4)')
        ->assertSee('name="quiz"', false);
});

it('admin can upload a quiz video', function () {
    Storage::fake('public');

    $chapter = Chapter::factory()->create();

    $this->actingAs(User::factory()->create())
        ->post(route('admin.chapters.resources.store'), [
            'chapter_id' => $chapter->id,
            'quiz' => UploadedFile::fake()->create('quiz.mp4', 5000, 'video/mp4'),
        ])
        ->assertRedirect(route('admin.chapters.show', $chapter))
        ->assertSessionHas('success');

    $resource = $chapter->resources()->first();
    expect($resource)->not->toBeNull();
    expect($resource->resource_type)->toBe(ResourceType::Quizzes);
    Storage::disk('public')->assertExists($resource->file_path);
});

it('validates quiz upload as mp4 only', function () {
    $chapter = Chapter::factory()->create();

    $this->actingAs(User::factory()->create())
        ->post(route('admin.chapters.resources.store'), [
            'chapter_id' => $chapter->id,
            'quiz' => UploadedFile::fake()->create('quiz.pdf', 100, 'application/pdf'),
        ])
        ->assertSessionHasErrors('quiz');
});

// ── Member quizzes page ───────────────────────────────────────────────────────

it('redirects guest from quizzes page to member login', function () {
    $chapter = Chapter::factory()->create();

    $this->get(route('members.chapters.quizzes', $chapter->slug))
        ->assertRedirect(route('members.login'));
});

it('member can access quizzes page', function () {
    $chapter = Chapter::factory()->create();

    $this->actingAs(User::factory()->member()->create())
        ->get(route('members.chapters.quizzes', $chapter->slug))
        ->assertSuccessful()
        ->assertSee('Quizzes');
});

it('shows quiz videos on quizzes page', function () {
    Storage::fake('public');

    $chapter = Chapter::factory()->create();
    Resource::factory()->quiz()->forChapter($chapter)->create(['file_name' => 'intro-quiz.mp4']);

    $this->actingAs(User::factory()->member()->create())
        ->get(route('members.chapters.quizzes', $chapter->slug))
        ->assertSuccessful()
        ->assertSee('intro-quiz.mp4');
});

it('shows empty state when no quizzes uploaded', function () {
    $chapter = Chapter::factory()->create();

    $this->actingAs(User::factory()->member()->create())
        ->get(route('members.chapters.quizzes', $chapter->slug))
        ->assertSuccessful()
        ->assertSee('No quiz videos uploaded yet');
});

// ── Stream — quiz type allowed ────────────────────────────────────────────────

it('streams a quiz video for authenticated member', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('quiz.mp4', 100, 'video/mp4');
    $path = $file->store('chapters/resources', 'public');

    $chapter = Chapter::factory()->create();
    $resource = Resource::factory()->quiz()->forChapter($chapter)->create(['file_path' => $path]);

    $this->actingAs(User::factory()->member()->create())
        ->get(route('members.chapters.stream', $resource->id))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'video/mp4');
});

it('streams a takeaway video for authenticated member', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('takeaway.mp4', 100, 'video/mp4');
    $path = $file->store('chapters/resources', 'public');

    $chapter = Chapter::factory()->create();
    $resource = Resource::factory()->forChapter($chapter)->create([
        'resource_type' => ResourceType::Takeaway,
        'file_path' => $path,
        'file_type' => 'video/mp4',
        'file_name' => 'takeaway.mp4',
    ]);

    $this->actingAs(User::factory()->member()->create())
        ->get(route('members.chapters.stream', $resource->id))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'video/mp4');
});

// ── Chapter show — quiz row is live ──────────────────────────────────────────

it('chapter show page has clickable quiz link', function () {
    $chapter = Chapter::factory()->create();

    $this->actingAs(User::factory()->member()->create())
        ->get(route('members.chapters.show', $chapter->slug))
        ->assertSuccessful()
        ->assertSee(route('members.chapters.quizzes', $chapter->slug));
});
