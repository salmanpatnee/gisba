<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('members:send-expiry-reminders')->dailyAt('08:00');
Schedule::command('sessions:close-stale')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('sessions:prune-activities')->daily()->withoutOverlapping();
