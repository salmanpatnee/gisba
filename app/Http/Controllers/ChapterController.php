<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        $chapters = Chapter::query()
            ->withCount([
                'resources',
                'resources as watched_count' => fn ($q) => $q
                    ->whereHas('watchers', fn ($w) => $w->where('users.id', $userId)),
            ])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $totalResources = (int) $chapters->sum('resources_count');
        $totalWatched = (int) $chapters->sum('watched_count');

        return view('pages.members.chapters.index', [
            'part1' => $chapters->where('section', 1),
            'part2' => $chapters->where('section', 2),
            'part3' => $chapters->where('section', 3),
            'totalResources' => $totalResources,
            'totalWatched' => $totalWatched,
            'overallPercent' => $totalResources > 0 ? (int) round($totalWatched / $totalResources * 100) : 0,
        ]);
    }

    public function show(Chapter $chapter): View
    {
        $userId = auth()->id();

        $chapter->load(['resources.watchers' => fn ($w) => $w->where('users.id', $userId)]);

        // Per-category progress keyed by ResourceType value: ['total' => x, 'watched' => y, 'done' => bool]
        $categoryProgress = $chapter->resources
            ->groupBy(fn ($resource) => $resource->resource_type->value)
            ->map(function ($group) {
                $total = $group->count();
                $watched = $group->filter(fn ($resource) => $resource->watchers->isNotEmpty())->count();

                return ['total' => $total, 'watched' => $watched, 'done' => $total > 0 && $watched === $total];
            });

        $prevChapter = Chapter::query()
            ->where('sort_order', '<', $chapter->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        $nextChapter = Chapter::query()
            ->where('sort_order', '>', $chapter->sort_order)
            ->orderBy('sort_order')
            ->first();

        return view('pages.members.chapters.show', compact('chapter', 'categoryProgress', 'prevChapter', 'nextChapter'));
    }
}
