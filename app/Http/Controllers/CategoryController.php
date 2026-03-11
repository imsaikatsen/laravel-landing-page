<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->get();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => generate_slug($validated['name']),
        ]);

        return redirect()->route('category.index')->with('success', 'Category added');
    }

    public function edit($id): View
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => generate_slug($validated['name']),
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated');
    }

    public function destroy($id): RedirectResponse
    {
        $category = Category::withCount(['miniApps', 'datingZones', 'liveZones', 'mallProducts'])->findOrFail($id);

        if (($category->mini_apps_count + $category->dating_zones_count + $category->live_zones_count + $category->mall_products_count) > 0) {
            return back()->withErrors(['delete' => 'This category is already assigned to content.']);
        }

        $category->delete();

        return back()->with('success', 'Category deleted');
    }
}
