<?php

namespace App\Http\Controllers;

use App\Models\MiniApp;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MiniAppController extends Controller
{
    public function index(): View
    {
        $apps = MiniApp::with('category')->latest()->get();
        return view('miniapp.index', compact('apps'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('miniapp.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'appTitle' => 'required|unique:mini_apps,appTitle',
            'description' => 'required',
            'appImage' => 'required|image',
            'category_id' => 'nullable|exists:categories,id',
            'category_active' => 'nullable|boolean',
        ]);

        $categoryId = $validated['category_id'] ?? null;
        $categoryActive = $categoryId ? $request->boolean('category_active') : false;

        $imageName = time() . '.' . $request->appImage->extension();
        $request->appImage->move(public_path('miniapps'), $imageName);

        MiniApp::create([
            'appTitle' => $validated['appTitle'],
            'description' => $validated['description'],
            'slug' => generate_slug($validated['appTitle']),
            'appImage' => $imageName,
            'category_id' => $categoryId,
            'category_active' => $categoryActive,
            'metaKeywords' => $request->metaKeywords,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'customScript' => $request->customScript
        ]);

        return redirect()->route('miniapp.index')->with('success', 'Mini App Added');
    }

    public function edit($id): View
    {
        $app = MiniApp::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('miniapp.edit', compact('app', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $app = MiniApp::findOrFail($id);

        $validated = $request->validate([
            'appTitle' => 'required|unique:mini_apps,appTitle,' . $app->id,
            'description' => 'required',
            'appImage' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
            'category_active' => 'nullable|boolean',
        ]);

        $categoryId = $validated['category_id'] ?? null;
        $categoryActive = $categoryId ? $request->boolean('category_active') : false;

        if ($request->hasFile('appImage')) {
            $existingImagePath = public_path('miniapps/' . $app->appImage);

            if ($app->appImage && file_exists($existingImagePath)) {
                unlink($existingImagePath);
            }

            $imageName = time() . '.' . $request->appImage->extension();
            $request->appImage->move(public_path('miniapps'), $imageName);
            $app->appImage = $imageName;
        }

        $app->update([
            'appTitle' => $validated['appTitle'],
            'description' => $validated['description'],
            'slug' => generate_slug($validated['appTitle']),
            'category_id' => $categoryId,
            'category_active' => $categoryActive,
            'metaKeywords' => $request->metaKeywords,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'customScript' => $request->customScript
        ]);

        return redirect()->route('miniapp.index')->with('success', 'Updated');
    }

    public function show($slug)
    {
        $item = MiniApp::with('category')->where('slug', $slug)->firstOrFail();
        return view('site.pages.miniapp.show', compact('item'));
    }

    public function destroy($id)
    {
        $app = MiniApp::findOrFail($id);
        $imagePath = public_path('miniapps/' . $app->appImage);

        if ($app->appImage && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $app->delete();

        return back()->with('success', 'Deleted');
    }
}
