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
            'website_mode' => 'b2b',
            'regular_price' => 2495,
            'sale_price' => 1500,
            'membership_price' => 30,
            'membership_regular_price' => 59,
            'membership_currency' => 'USD',
            'crisc_price' => 9.99,
            'crisc_currency' => 'USD',
            'crisc_date' => '2026-09-21',
            'crisc_time_start' => '7:00 AM',
            'crisc_time_end' => '1:00 PM',
            'crisc_timezone' => 'GMT+3',
            'crisc_capacity' => 12,
        ])
        ->assertRedirect(route('admin.settings.edit'))
        ->assertSessionHas('success');

    expect(SiteSettings::current()->success_stories_region)->toBe('me');
});

it('rejects an invalid region', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'us',
            'website_mode' => 'b2b',
            'regular_price' => 2495,
            'sale_price' => 1500,
            'membership_price' => 30,
            'membership_regular_price' => 59,
            'membership_currency' => 'USD',
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

it('defaults membership pricing to the advertised 30 USD', function () {
    $settings = SiteSettings::current();

    expect((float) $settings->membership_price)->toBe(30.00)
        ->and((float) $settings->membership_regular_price)->toBe(59.00)
        ->and($settings->membership_currency)->toBe('USD');
});

it('can update membership pricing', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'eu',
            'website_mode' => 'b2b',
            'regular_price' => 2495,
            'sale_price' => 1500,
            'membership_price' => 45,
            'membership_regular_price' => 90,
            'membership_currency' => 'GBP',
            'crisc_price' => 9.99,
            'crisc_currency' => 'USD',
            'crisc_date' => '2026-09-21',
            'crisc_time_start' => '7:00 AM',
            'crisc_time_end' => '1:00 PM',
            'crisc_timezone' => 'GMT+3',
            'crisc_capacity' => 12,
        ])
        ->assertRedirect(route('admin.settings.edit'));

    $settings = SiteSettings::current();

    expect((float) $settings->membership_price)->toBe(45.00)
        ->and($settings->membership_currency)->toBe('GBP')
        ->and($settings->membership_discount_percent)->toBe(50);
});

it('rejects a membership price below the PayPal minimum', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'eu',
            'website_mode' => 'b2b',
            'regular_price' => 2495,
            'sale_price' => 1500,
            'membership_price' => 0,
            'membership_regular_price' => 59,
            'membership_currency' => 'USD',
        ])
        ->assertSessionHasErrors('membership_price');
});

it('rejects a was-price lower than the price actually charged', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'eu',
            'website_mode' => 'b2b',
            'regular_price' => 2495,
            'sale_price' => 1500,
            'membership_price' => 30,
            'membership_regular_price' => 10,
            'membership_currency' => 'USD',
        ])
        ->assertSessionHasErrors('membership_regular_price');
});

it('can update crisc course pricing and schedule', function () {
    $this->actingAs(User::factory()->create())
        ->put(route('admin.settings.update'), [
            'success_stories_region' => 'eu',
            'website_mode' => 'b2b',
            'regular_price' => 2495,
            'sale_price' => 1500,
            'membership_price' => 30,
            'membership_regular_price' => 59,
            'membership_currency' => 'USD',
            'crisc_price' => 14.99,
            'crisc_currency' => 'GBP',
            'crisc_date' => '2026-10-05',
            'crisc_time_start' => '9:00 AM',
            'crisc_time_end' => '3:00 PM',
            'crisc_timezone' => 'GMT+1',
            'crisc_capacity' => 20,
        ])
        ->assertRedirect(route('admin.settings.edit'));

    $settings = SiteSettings::current();

    expect((float) $settings->crisc_price)->toBe(14.99)
        ->and($settings->crisc_currency)->toBe('GBP')
        ->and($settings->crisc_date->format('Y-m-d'))->toBe('2026-10-05')
        ->and($settings->crisc_time_start)->toBe('9:00 AM')
        ->and($settings->crisc_time_end)->toBe('3:00 PM')
        ->and($settings->crisc_timezone)->toBe('GMT+1')
        ->and($settings->crisc_capacity)->toBe(20);
});

it('reports no discount when the two membership prices match', function () {
    SiteSettings::current()->update([
        'membership_price' => 30,
        'membership_regular_price' => 30,
    ]);

    expect(SiteSettings::current()->membership_discount_percent)->toBe(0);
});
