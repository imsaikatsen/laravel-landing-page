<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatingZone;
use Illuminate\Support\Str;

class DatingZoneController extends Controller
{
    public function index()
    {
        $zones = DatingZone::latest()->get();
        return view('datingzone.index', compact('zones'));
    }

    public function create()
    {
        return view('datingzone.create');
    }

    public function store(Request $request)
    {
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
        ]);

        return redirect()->route('datingzone.index');
    }

    public function edit($id)
    {
        $zone = DatingZone::findOrFail($id);
        return view('datingzone.edit', compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $zone = DatingZone::findOrFail($id);

        if ($request->hasFile('image')) {
            unlink(public_path('datingzones/' . $zone->image));
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('datingzones'), $imageName);
            $zone->image = $imageName;
        }

        $zone->update($request->except('image'));

        return redirect()->route('datingzone.index');
    }

    public function show($slug)
    {
        $item = DatingZone::where('slug', $slug)->firstOrFail();
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
