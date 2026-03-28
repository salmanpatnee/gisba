<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingsRequest;
use App\Models\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.site-settings.edit', [
            'settings' => SiteSettings::current(),
        ]);
    }

    public function update(UpdateSiteSettingsRequest $request): RedirectResponse
    {
        SiteSettings::current()->update($request->validated());

        return redirect()->route('admin.settings.edit')->with('success', 'Settings saved.');
    }
}
