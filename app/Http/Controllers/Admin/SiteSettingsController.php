<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingsRequest;
use App\Models\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
        $settings = SiteSettings::current();
        $data = $request->safe()->except('toolkit_zip');

        if ($request->hasFile('toolkit_zip')) {
            if ($settings->toolkit_zip_path) {
                Storage::disk('public')->delete($settings->toolkit_zip_path);
            }
            $data['toolkit_zip_path'] = $request->file('toolkit_zip')
                ->storeAs('toolkit', $request->file('toolkit_zip')->getClientOriginalName(), 'public');
        }

        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings saved.');
    }
}
