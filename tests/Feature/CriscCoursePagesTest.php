<?php

use App\Models\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the configured price, date, time, and capacity on the landing page', function () {
    SiteSettings::current()->update([
        'crisc_price' => 9.99,
        'crisc_date' => '2026-09-21',
        'crisc_time_start' => '7:00 AM',
        'crisc_time_end' => '1:00 PM',
        'crisc_timezone' => 'GMT+3',
        'crisc_capacity' => 12,
    ]);

    $this->get(route('crisc-course'))
        ->assertSuccessful()
        ->assertSee('9.99')
        ->assertSee('September 21, 2026')
        ->assertSee('7:00 AM')
        ->assertSee('1:00 PM')
        ->assertSee('GMT+3')
        ->assertSee('12');
});

it('shows the configured price and seats remaining on the pricing page', function () {
    SiteSettings::current()->update([
        'crisc_price' => 9.99,
        'crisc_capacity' => 12,
    ]);

    $this->get(route('crisc-course.pricing'))
        ->assertSuccessful()
        ->assertSee('9.99')
        ->assertSee('12 of 12 seats remaining');
});
