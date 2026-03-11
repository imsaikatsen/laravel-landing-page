<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DatingZone;

class DatingZoneController extends Controller
{
    public function index()
    {
        $zones = DatingZone::with('category')->latest()->get();
        return view('datingzone.index', compact('zones'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('datingzone.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'category_active' => 'nullable|boolean',
        ]);

        $categoryId = $request->category_id;
        $categoryActive = $categoryId ? $request->boolean('category_active') : false;

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('datingzones'), $imageName);

        DatingZone::create([
            'title' => $request->title,
            'slug' => generate_slug($request->title),
            'description' => $request->description,
            'tag1' => $request->tag1,
            'tag2' => $request->tag2,
            'count' => $request->count,
            'metaKeywords' => $request->metaKeywords,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'customScript' => $request->customScript,
            'image' => $imageName,
            'category_id' => $categoryId,
            'category_active' => $categoryActive,
        ]);

        return redirect()->route('datingzone.index');
    }

    public function edit($id)
    {
        $zone = DatingZone::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('datingzone.edit', compact('zone', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $zone = DatingZone::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'category_active' => 'nullable|boolean',
        ]);

        $categoryId = $request->category_id;
        $categoryActive = $categoryId ? $request->boolean('category_active') : false;

        if ($request->hasFile('image')) {
            unlink(public_path('datingzones/' . $zone->image));
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('datingzones'), $imageName);
            $zone->image = $imageName;
        }

        $zone->update([
            'title' => $request->title,
            'slug' => generate_slug($request->title),
            'description' => $request->description,
            'tag1' => $request->tag1,
            'tag2' => $request->tag2,
            'count' => $request->count,
            'metaKeywords' => $request->metaKeywords,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'customScript' => $request->customScript,
            'category_id' => $categoryId,
            'category_active' => $categoryActive,
        ]);

        return redirect()->route('datingzone.index');
    }

    public function show($slug)
    {
        $item = DatingZone::with('category')->where('slug', $slug)->firstOrFail();
        return view('site.pages.datingzone.show', compact('item'));
    }


    public function destroy($id)
    {
        $zone = DatingZone::findOrFail($id);
        if ($zone->image && file_exists(public_path('datingzones/' . $zone->image))) {
            unlink(public_path('datingzones/' . $zone->image));
        }
        $zone->delete();

        return back();
    }
}
