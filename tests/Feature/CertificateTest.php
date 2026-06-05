<?php

use App\Models\Certificate;
use App\Models\Chapter;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function completedMember(int $resourceCount = 3): array
{
    $member = User::factory()->member()->create();
    $chapter = Chapter::factory()->create(['section' => 1]);
    $resources = Resource::factory()->count($resourceCount)->forChapter($chapter)->create();
    $member->watchedResources()->attach(
        $resources->mapWithKeys(fn ($r) => [$r->id => ['completed_at' => now()]])->all()
    );

    return [$member, $chapter, $resources];
}

it('redirects a guest from the certificate page', function () {
    $this->get(route('members.certificate'))->assertRedirect(route('members.login'));
});

it('redirects a non-member from the certificate page', function () {
    $this->actingAs(User::factory()->create(['is_member' => false]))
        ->get(route('members.certificate'))
        ->assertRedirect(route('members.paywall'));
});

it('forbids a member who has not finished the training', function () {
    $member = User::factory()->member()->create();
    $chapter = Chapter::factory()->create(['section' => 1]);
    $resources = Resource::factory()->count(3)->forChapter($chapter)->create();
    $member->watchedResources()->attach($resources->take(1)->pluck('id'), ['completed_at' => now()]);

    $this->actingAs($member)->get(route('members.certificate'))->assertForbidden();
});

it('shows the certificate to a member who completed all resources', function () {
    [$member] = completedMember();

    $this->actingAs($member)
        ->get(route('members.certificate'))
        ->assertOk()
        ->assertSee($member->name)
        ->assertSee('PMP Comprehensive Training Aligned with PMBOK 8th Edition')
        ->assertSee('GISBA-');
});

it('issues a stable certificate number across repeat visits', function () {
    [$member] = completedMember();

    $this->actingAs($member)->get(route('members.certificate'))->assertOk();
    $first = Certificate::where('user_id', $member->id)->value('certificate_number');

    $this->actingAs($member)->get(route('members.certificate'))->assertOk();

    expect(Certificate::where('user_id', $member->id)->count())->toBe(1);
    expect($first)->toStartWith('GISBA-')
        ->and(Certificate::where('user_id', $member->id)->value('certificate_number'))->toBe($first);
});
