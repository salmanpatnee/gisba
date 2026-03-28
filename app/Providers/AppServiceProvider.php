<?php

namespace App\Providers;

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
            $region = SiteSettings::current()->success_stories_region;
            $view->with('successStoriesRoute', route('success-stories.'.$region));
            $view->with('successStoriesRegion', $region);
        });
    }
}
