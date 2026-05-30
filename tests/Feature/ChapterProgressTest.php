<?php

use App\Models\Chapter;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects a guest from the mark-complete endpoint', function () {
    $resource = Resource::factory()->create();

    $this->post(route('members.chapters.resource.complete', $resource->id))
        ->assertRedirect(route('members.login'));
});

it('redirects a non-member from the mark-complete endpoint', function () {
    $resource = Resource::factory()->create();

    $this->actingAs(User::factory()->create(['is_member' => false]))
        ->post(route('members.chapters.resource.complete', $resource->id))
        ->assertRedirect(route('members.paywall'));
});

it('marks a resource watched for a member', function () {
    $member = User::factory()->member()->create();
    $resource = Resource::factory()->create();

    $this->actingAs($member)
        ->post(route('members.chapters.resource.complete', $resource->id))
        ->assertOk()
        ->assertJson(['watched' => true]);

    expect($member->watchedResources()->whereKey($resource->id)->exists())->toBeTrue();
    expect($member->watchedResources()->first()->pivot->completed_at)->not->toBeNull();
});

it('is idempotent when posting twice', function () {
    $member = User::factory()->member()->create();
    $resource = Resource::factory()->create();

    $this->actingAs($member)->post(route('members.chapters.resource.complete', $resource->id))->assertOk();
    $this->actingAs($member)->post(route('members.chapters.resource.complete', $resource->id))->assertOk();

    expect($member->watchedResources()->count())->toBe(1);
});

it('reports a chapter complete only when all its resources are watched', function () {
    $member = User::factory()->member()->create();
    $chapter = Chapter::factory()->create();
    $resources = Resource::factory()->count(4)->forChapter($chapter)->create();

    expect($chapter->isCompletedBy($member))->toBeFalse();

    $member->watchedResources()->attach($resources->take(3)->pluck('id'), ['completed_at' => now()]);
    expect($chapter->fresh()->isCompletedBy($member))->toBeFalse();

    $member->watchedResources()->attach([$resources->last()->id => ['completed_at' => now()]]);
    expect($chapter->fresh()->isCompletedBy($member))->toBeTrue();
});

it('shows the correct overall percentage on the chapters index', function () {
    $member = User::factory()->member()->create();
    $chapter = Chapter::factory()->create(['section' => 1]);
    $resources = Resource::factory()->count(4)->forChapter($chapter)->create();

    $member->watchedResources()->attach($resources->take(2)->pluck('id'), ['completed_at' => now()]);

    $this->actingAs($member)
        ->get(route('members.chapters.index'))
        ->assertOk()
        ->assertViewHas('overallPercent', 50)
        ->assertViewHas('totalWatched', 2)
        ->assertViewHas('totalResources', 4);
});
