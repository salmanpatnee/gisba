<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\PmpPost;
use Illuminate\View\View;

class PmpController extends Controller
{
    public function index(): View
    {
        $categorizedPosts = PmpPost::query()
            ->with('category')
            ->latest()
            ->get()
            ->groupBy(fn (PmpPost $post): string => $post->category?->name ?? 'Uncategorized')
            ->filter(fn ($posts): bool => $posts->isNotEmpty());

        // Course outline shown to guests (no per-user progress).
        $chapters = Chapter::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $part2 = $chapters->where('section', 2);

        return view('pages.pmp', [
            'categorizedPosts' => $categorizedPosts,
            'outlinePart1' => $chapters->where('section', 1),
            'outlinePart2Divisions' => [
                1 => $part2->where('division', 1),
                2 => $part2->where('division', 2),
                3 => $part2->where('division', 3),
            ],
            'outlinePart3' => $chapters->where('section', 3),
            'outlineChapterCount' => $chapters->count(),
        ]);
    }

    public function show(string $slug): View
    {
        $post = PmpPost::query()
            ->with('attachments')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = PmpPost::query()
            ->where('slug', '!=', $slug)
            ->where('category_id', $post->category_id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.pmp-show', compact('post', 'related'));
    }
}
