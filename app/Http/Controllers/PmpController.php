<?php

namespace App\Http\Controllers;

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

        return view('pages.pmp', compact('categorizedPosts'));
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
