<?php

use App\Models\SiteSettings;
use App\Models\User;

beforeEach(function () {
    SiteSettings::truncate();
});

it('redirects guests from admin settings', function () {
    $this->get(route('admin.settings.edit'))
        ->assertRedirect(route('login'));
});

it('shows the settings form to authenticated users', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.settings.edit'))
        ->assertOk()
        ->assertSee('Europe (EU)')
        ->assertSee('Middle East (ME)');
});

it('defaults success stories region to eu', function () {
    expect(SiteSettings::current()->success_stories_region)->toBe('eu');
});

it('can update region to me', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'me',
            'regular_price' => 2495,
            'sale_price' => 1500,
        ])
        ->assertRedirect(route('admin.settings.edit'))
        ->assertSessionHas('success');

    expect(SiteSettings::current()->success_stories_region)->toBe('me');
});

it('rejects an invalid region', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'us',
            'regular_price' => 2495,
            'sale_price' => 1500,
        ])
        ->assertSessionHasErrors('success_stories_region');
});

it('redirects /success-stories to the eu page when region is eu', function () {
    SiteSettings::current(); // ensure default eu row exists

    $this->get(route('success-stories'))
        ->assertRedirect(route('success-stories.eu'));
});

it('redirects /success-stories to the me page when region is me', function () {
    SiteSettings::current()->update(['success_stories_region' => 'me']);

    $this->get(route('success-stories'))
        ->assertRedirect(route('success-stories.me'));
});

it('returns 200 for the eu success stories page', function () {
    $this->get(route('success-stories.eu'))->assertOk();
});

it('returns 200 for the me success stories page', function () {
    $this->get(route('success-stories.me'))->assertOk();
});
