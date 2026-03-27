<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNis2PricingRequest;
use App\Models\Nis2Pricing;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class Nis2PricingController extends Controller
{
    public function edit(): View
    {
        $pricing = Nis2Pricing::current();

        return view('admin.nis2-pricing.edit', compact('pricing'));
    }

    public function update(UpdateNis2PricingRequest $request): RedirectResponse
    {
        Nis2Pricing::current()->update($request->validated());

        return redirect()->route('admin.nis2-pricing.edit')->with('success', 'Pricing updated successfully.');
    }
}
