<?php

namespace App\Support;

use Illuminate\Support\Str;

final class PageVisitLabeler
{
    /**
     * Route names whose auto-derived label would read awkwardly.
     */
    private const LABEL_OVERRIDES = [
        'members.chapters.stream' => 'Watched Resource',
        'members.chapters.view' => 'Viewed Resource',
        'members.chapters.download' => 'Downloaded Resource',
    ];

    public static function label(string $routeName): string
    {
        if (array_key_exists($routeName, self::LABEL_OVERRIDES)) {
            return self::LABEL_OVERRIDES[$routeName];
        }

        $segments = explode('.', $routeName);
        $last = end($segments);

        if (in_array($last, ['index', 'show', 'create', 'edit'], true) && count($segments) >= 2) {
            return Str::headline($segments[count($segments) - 2]);
        }

        return Str::headline($last);
    }

    public static function module(string $routeName): string
    {
        $segments = explode('.', $routeName);

        return Str::headline($segments[0]);
    }
}
