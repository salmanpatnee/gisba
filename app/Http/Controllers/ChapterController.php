<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(): View
    {
        $chapters = Chapter::query()->orderBy('sort_order')->orderBy('title')->get();

        return view('pages.members.chapters.index', [
            'part1' => $chapters->where('section', 1),
            'part2' => $chapters->where('section', 2),
            'part3' => $chapters->where('section', 3),
        ]);
    }

    public function show(Chapter $chapter): View
    {
        $prevChapter = Chapter::query()
            ->where('sort_order', '<', $chapter->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        $nextChapter = Chapter::query()
            ->where('sort_order', '>', $chapter->sort_order)
            ->orderBy('sort_order')
            ->first();

        return view('pages.members.chapters.show', compact('chapter', 'prevChapter', 'nextChapter'));
    }
}
