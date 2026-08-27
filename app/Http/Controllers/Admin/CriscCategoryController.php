<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriscCategoryRequest;
use App\Http\Requests\UpdateCriscCategoryRequest;
use App\Models\CriscCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CriscCategoryController extends Controller
{
    public function index(): View
    {
        $categories = CriscCategory::query()->withCount('criscPosts')->latest()->paginate(15);

        return view('admin.crisc-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.crisc-categories.create');
    }

    public function store(StoreCriscCategoryRequest $request): RedirectResponse
    {
        CriscCategory::create($request->validated());

        return redirect()->route('admin.crisc-categories.index')
            ->with('success', 'CRISC category created successfully.');
    }

    public function edit(CriscCategory $criscCategory): View
    {
        return view('admin.crisc-categories.edit', compact('criscCategory'));
    }

    public function update(UpdateCriscCategoryRequest $request, CriscCategory $criscCategory): RedirectResponse
    {
        $criscCategory->update($request->validated());

        return redirect()->route('admin.crisc-categories.index')
            ->with('success', 'CRISC category updated successfully.');
    }

    public function destroy(CriscCategory $criscCategory): RedirectResponse
    {
        if ($criscCategory->criscPosts()->count() > 0) {
            return redirect()->route('admin.crisc-categories.index')
                ->with('error', 'Cannot delete category with existing CRISC posts.');
        }

        $criscCategory->delete();

        return redirect()->route('admin.crisc-categories.index')
            ->with('success', 'CRISC category deleted successfully.');
    }
}
