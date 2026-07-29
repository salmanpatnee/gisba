<?php

namespace App\Http\Controllers;

use App\Models\MemberPost;
use App\Models\SiteSettings;
use Illuminate\View\View;

class MembersController extends Controller
{
    public function paywall(): View
    {
        $settings = SiteSettings::current();
        $symbol = $settings->membership_currency_symbol;

        return view('pages.members', [
            'settings' => $settings,
            'price' => $symbol.number_format((float) $settings->membership_price, 0),
            'regularPrice' => $symbol.number_format((float) $settings->membership_regular_price, 0),
            'hasDiscount' => $settings->membership_discount_percent > 0,
        ]);
    }

    public function index(): View
    {
        $posts = MemberPost::query()->latest()->get();

        return view('pages.members-library', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = MemberPost::query()->where('slug', $slug)->firstOrFail();

        return view('pages.members-show', compact('post'));
    }
}
