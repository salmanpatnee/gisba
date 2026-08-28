<?php

use App\Models\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the configured price, date, time, and capacity on the cissp landing page', function () {
    SiteSettings::current()->update([
        'cissp_price' => 999.99,
        'cissp_date' => '2026-10-12',
        'cissp_time_start' => '9:00 AM',
        'cissp_time_end' => '5:00 PM',
        'cissp_timezone' => 'GMT+3',
        'cissp_capacity' => 15,
    ]);

    $this->get(route('cissp'))
        ->assertSuccessful()
        ->assertSee('999.99')
        ->assertSee('October 12, 2026')
        ->assertSee('9:00 AM')
        ->assertSee('5:00 PM')
        ->assertSee('GMT+3')
        ->assertSee('15');
});

it('shows the configured price and seats remaining on the cissp pricing page', function () {
    SiteSettings::current()->update([
        'cissp_price' => 999.99,
        'cissp_capacity' => 15,
    ]);

    $this->get(route('cissp.pricing'))
        ->assertSuccessful()
        ->assertSee('999.99')
        ->assertSee('15 of 15 seats remaining');
});

it('shows the configured price, date, time, and capacity on the prince2 landing page', function () {
    SiteSettings::current()->update([
        'prince2_price' => 999.99,
        'prince2_date' => '2026-11-02',
        'prince2_time_start' => '8:00 AM',
        'prince2_time_end' => '4:00 PM',
        'prince2_timezone' => 'GMT+3',
        'prince2_capacity' => 15,
    ]);

    $this->get(route('prince2'))
        ->assertSuccessful()
        ->assertSee('999.99')
        ->assertSee('November 2, 2026')
        ->assertSee('8:00 AM')
        ->assertSee('4:00 PM')
        ->assertSee('GMT+3')
        ->assertSee('15');
});

it('shows the configured price and seats remaining on the prince2 pricing page', function () {
    SiteSettings::current()->update([
        'prince2_price' => 999.99,
        'prince2_capacity' => 15,
    ]);

    $this->get(route('prince2.pricing'))
        ->assertSuccessful()
        ->assertSee('999.99')
        ->assertSee('15 of 15 seats remaining');
});
