<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePmpCategoryRequest;
use App\Http\Requests\UpdatePmpCategoryRequest;
use App\Models\PmpCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PmpCategoryController extends Controller
{
    public function index(): View
    {
        $categories = PmpCategory::query()->withCount('pmpPosts')->latest()->paginate(15);

        return view('admin.pmp-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.pmp-categories.create');
    }

    public function store(StorePmpCategoryRequest $request): RedirectResponse
    {
        PmpCategory::create($request->validated());

        return redirect()->route('admin.pmp-categories.index')
            ->with('success', 'PMP category created successfully.');
    }

    public function edit(PmpCategory $pmpCategory): View
    {
        return view('admin.pmp-categories.edit', compact('pmpCategory'));
    }

    public function update(UpdatePmpCategoryRequest $request, PmpCategory $pmpCategory): RedirectResponse
    {
        $pmpCategory->update($request->validated());

        return redirect()->route('admin.pmp-categories.index')
            ->with('success', 'PMP category updated successfully.');
    }

    public function destroy(PmpCategory $pmpCategory): RedirectResponse
    {
        if ($pmpCategory->pmpPosts()->count() > 0) {
            return redirect()->route('admin.pmp-categories.index')
                ->with('error', 'Cannot delete category with existing PMP posts.');
        }

        $pmpCategory->delete();

        return redirect()->route('admin.pmp-categories.index')
            ->with('success', 'PMP category deleted successfully.');
    }
}
