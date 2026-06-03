<?php

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('persists division when creating a Part 2 chapter', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.chapters.store'), [
        'title' => 'Develop a Common Vision',
        'slug' => '',
        'section' => 2,
        'division' => 1,
    ])->assertRedirect(route('admin.chapters.index'));

    $this->assertDatabaseHas('chapters', [
        'title' => 'Develop a Common Vision',
        'section' => 2,
        'division' => 1,
    ]);
});

it('requires a division when section is Part 2', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.chapters.store'), [
        'title' => 'No Division Chapter',
        'slug' => '',
        'section' => 2,
    ])->assertSessionHasErrors('division');
});

it('allows a null division for non-Part 2 sections', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.chapters.store'), [
        'title' => 'Practical Tip',
        'slug' => '',
        'section' => 3,
    ])->assertRedirect(route('admin.chapters.index'));

    $this->assertDatabaseHas('chapters', [
        'title' => 'Practical Tip',
        'section' => 3,
        'division' => null,
    ]);
});

it('updates the division of an existing chapter', function () {
    $this->actingAs(User::factory()->create());

    $chapter = Chapter::factory()->create(['section' => 2, 'division' => 1]);

    $this->put(route('admin.chapters.update', $chapter), [
        'title' => $chapter->title,
        'slug' => '',
        'section' => 2,
        'division' => 3,
    ])->assertRedirect(route('admin.chapters.index'));

    expect($chapter->fresh()->division)->toBe(3);
});

it('groups Part 2 chapters by division on the members index', function () {
    $this->actingAs(User::factory()->member()->create());

    Chapter::factory()->create(['title' => 'People Ch', 'section' => 2, 'division' => 1]);
    Chapter::factory()->create(['title' => 'Process Ch', 'section' => 2, 'division' => 2]);
    Chapter::factory()->create(['title' => 'Business Ch', 'section' => 2, 'division' => 3]);

    $this->get(route('members.chapters.index'))
        ->assertSuccessful()
        ->assertSeeInOrder(['People', 'Process', 'Business Environment']);
});
