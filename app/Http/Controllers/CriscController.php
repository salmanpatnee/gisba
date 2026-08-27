<?php

namespace App\Http\Controllers;

use App\Models\CriscPost;
use Illuminate\View\View;

class CriscController extends Controller
{
    public function index(): View
    {
        $categorizedPosts = CriscPost::query()
            ->with('category')
            ->latest()
            ->get()
            ->groupBy(fn (CriscPost $post): string => $post->category?->name ?? 'Uncategorized')
            ->filter(fn ($posts): bool => $posts->isNotEmpty());

        return view('pages.crisc', compact('categorizedPosts'));
    }

    public function show(string $slug): View
    {
        $post = CriscPost::query()
            ->with('attachments')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = CriscPost::query()
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.crisc-show', compact('post', 'related'));
    }
}
