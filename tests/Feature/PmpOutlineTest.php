<?php

use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the course outline to guests on the pmp page', function () {
    $chapter = Chapter::factory()->create([
        'title' => 'Risk Management Essentials',
        'section' => 1,
    ]);
    Resource::factory()->forChapter($chapter)->count(2)->create();
    Resource::factory()->forChapter($chapter)->quiz()->create();

    $this->get(route('pmp'))
        ->assertSuccessful()
        ->assertViewHas('outlineChapterCount')
        ->assertSee('Risk Management Essentials');
});

it('links guest outline cards to the paywall, not the members area', function () {
    Chapter::factory()->create(['section' => 1]);

    $this->get(route('pmp'))
        ->assertSuccessful()
        ->assertSee(route('members.paywall'))
        ->assertSee('Unlock with membership');
});

it('hides the outline section when no chapters exist', function () {
    $this->get(route('pmp'))
        ->assertSuccessful()
        ->assertViewHas('outlineChapterCount', 0)
        ->assertDontSee('What You\'ll Master');
});
