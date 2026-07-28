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
    }
}
