<?php

namespace App\Http\Controllers;

use App\Enums\ResourceType;
use App\Models\Chapter;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        $chapters = Chapter::query()
            ->withCount([
                'resources' => fn ($q) => $q->whereIn('resource_type', ResourceType::completable()),
                'resources as watched_count' => fn ($q) => $q
                    ->whereIn('resource_type', ResourceType::completable())
                    ->whereHas('watchers', fn ($w) => $w->where('users.id', $userId)),
            ])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $totalResources = (int) $chapters->sum('resources_count');
        $totalWatched = (int) $chapters->sum('watched_count');

        $part2 = $chapters->where('section', 2);

        return view('pages.members.chapters.index', [
            'part1' => $chapters->where('section', 1),
            'part2' => $part2,
            'part2Divisions' => [
                1 => $part2->where('division', 1),
                2 => $part2->where('division', 2),
                3 => $part2->where('division', 3),
            ],
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
            ->where('section', $chapter->section)
            ->where('sort_order', '<', $chapter->sort_order)
            ->orderBy('sort_order', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        $nextChapter = Chapter::query()
            ->where('section', $chapter->section)
            ->where('sort_order', '>', $chapter->sort_order)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        return view('pages.members.chapters.show', compact('chapter', 'categoryProgress', 'prevChapter', 'nextChapter'));
    }
}
