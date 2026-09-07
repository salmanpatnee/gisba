<?php

namespace App\Providers;

use App\Enums\WebsiteMode;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.site', function ($view) {
            $settings = SiteSettings::current();

            $region = $settings->success_stories_region;
            $view->with('successStoriesRoute', route('success-stories.'.$region));
            $view->with('successStoriesRegion', $region);

            $view->with('isPmpMode', $settings->website_mode === WebsiteMode::B2PMP->value);
        });

        // PMP course pricing appears on the PMP promo banner and article CTAs; both
        // read the same site_settings row so they cannot drift apart.
        View::composer(['partials.pmp-banner', 'pages.pmp-show'], function ($view) {
            $settings = SiteSettings::current();

            $schedule = null;
            if ($settings->pmp_date) {
                $schedule = $settings->dateRangeFor('pmp');
                if ($settings->pmp_time_start) {
                    $schedule .= ', '.$settings->pmp_time_start.'–'.$settings->pmp_time_end.' ('.$settings->pmp_timezone.')';
                }
            }

            $view->with([
                'pmpPrice' => '$'.number_format((float) $settings->pmp_price, 2),
                'pmpSchedule' => $schedule,
            ]);
        });
    }
}
