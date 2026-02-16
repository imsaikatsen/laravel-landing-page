<?php

namespace App\Http\Controllers;

use App\Models\MiniApp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MiniAppController extends Controller
{
    public function index()
    {
        $apps = MiniApp::latest()->get();
        return view('miniapp.index', compact('apps'));
    }

    public function create()
    {
        return view('miniapp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'appTitle' => 'required',
            'description' => 'required',
            'appImage' => 'required|image'
        ]);

        $imageName = time() . '.' . $request->appImage->extension();
        $request->appImage->move(public_path('miniapps'), $imageName);

        
        MiniApp::create([
            'appTitle' => $request->appTitle,
            'description' => $request->description,
            'slug' => generate_slug($request->appTitle),
            'appImage' => $imageName,
            'metaKeywords' => $request->metaKeywords,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'customScript' => $request->customScript
        ]);

        return redirect()->route('miniapp.index')->with('success', 'Mini App Added');
    }

    public function edit($id)
    {
        $app = MiniApp::findOrFail($id);
        return view('miniapp.edit', compact('app'));
    }

    public function update(Request $request, $id)
    {
        $app = MiniApp::findOrFail($id);

        if ($request->hasFile('appImage')) {
            unlink(public_path('miniapps/' . $app->appImage));
            $imageName = time() . '.' . $request->appImage->extension();
            $request->appImage->move(public_path('miniapps'), $imageName);
            $app->appImage = $imageName;
        }

        $app->update([
            'appTitle' => $request->appTitle,
            'description' => $request->description,
            'slug' => generate_slug($request->appTitle),
            'metaKeywords' => $request->metaKeywords,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'customScript' => $request->customScript
        ]);

        return redirect()->route('miniapp.index')->with('success', 'Updated');
    }

    public function show($slug)
    {
        $app = MiniApp::where('slug', $slug)->firstOrFail();
        return view('site.pages.miniapp.show', compact('app'));
    }


    public function destroy($id)
    {
        $app = MiniApp::findOrFail($id);
        unlink(public_path('miniapps/' . $app->appImage));
        $app->delete();

        return back()->with('success', 'Deleted');
    }
}
