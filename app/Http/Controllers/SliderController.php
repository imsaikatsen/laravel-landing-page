<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('sliders'), $name);

        Slider::create([
            'image' => $name
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider Added');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('sliders'), $name);

            // delete old image
            if (file_exists(public_path('sliders/' . $slider->image))) {
                unlink(public_path('sliders/' . $slider->image));
            }

            $slider->image = $name;
        }

        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider Updated');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete image file
        if (file_exists(public_path('sliders/' . $slider->image))) {
            unlink(public_path('sliders/' . $slider->image));
        }

        $slider->delete();

        return back()->with('success', 'Slider Deleted');
    }
}
