<?php

namespace App\Http\Controllers;
use App\Models\LiveZone;
use Illuminate\Http\Request;

class LiveZoneController extends Controller
{
      public function index()
    {
        $zones = LiveZone::latest()->get();
        return view('livezone.index', compact('zones'));
    }

    public function create()
    {
        return view('livezone.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:live_zones,slug',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'slug', 'description', 'tag1', 'tag2', 'count', 'metaKeywords', 'metaTitle', 'metaDescription', 'customScript'
        ]);

        $data['slug'] = generate_slug($request->title);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('livezones'), $imageName);
            $data['image'] = $imageName;
        }

        LiveZone::create($data);

        return redirect()->route('livezone.index')->with('success', 'Live Zone added successfully.');
    }

    public function edit($id)
    {
        $zone = LiveZone::findOrFail($id);
        return view('livezone.edit', compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $zone = LiveZone::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:live_zones,slug,'.$zone->id,
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'slug', 'description', 'tag1', 'tag2', 'count', 'metaKeywords', 'metaTitle', 'metaDescription', 'customScript'
        ]);

        $data['slug'] = generate_slug($request->title);

        if($request->hasFile('image')){
            if($zone->image && file_exists(public_path('livezones/'.$zone->image))){
                unlink(public_path('livezones/'.$zone->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('livezones'), $imageName);
            $data['image'] = $imageName;
        }

        $zone->update($data);

        return redirect()->route('livezone.index')->with('success', 'Live Zone updated successfully.');
    }

    public function show($slug)
    {
        $item = LiveZone::where('slug',$slug)->firstOrFail();
        return view('site.pages.livezone.show',compact('item'));
    }

    public function destroy($id)
    {
        $zone = LiveZone::findOrFail($id);
        if($zone->image && file_exists(public_path('livezones/'.$zone->image))){
            unlink(public_path('livezones/'.$zone->image));
        }
        $zone->delete();

        return redirect()->route('livezone.index')->with('success', 'Live Zone deleted successfully.');
    }
}
