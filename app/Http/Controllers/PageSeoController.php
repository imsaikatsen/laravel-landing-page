<?php

namespace App\Http\Controllers;
use App\Models\PageSeo;
use Illuminate\Http\Request;

class PageSeoController extends Controller
{
     public function index()
    {
        $pages = PageSeo::latest()->get();
        return view('pageseo.index', compact('pages'));
    }

    public function create()
    {
        return view('pageseo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_key' => 'required|unique:page_seos',
        ]);

        PageSeo::create($request->all());

        return redirect()->route('pageseo.index')->with('success','Saved');
    }

    public function edit($id)
    {
        $seo = PageSeo::findOrFail($id);
        return view('pageseo.edit', compact('seo'));
    }

    public function update(Request $request,$id)
    {
        $seo = PageSeo::findOrFail($id);

        $seo->update($request->all());

        return redirect()->route('pageseo.index')->with('success','Updated');
    }

    public function destroy($id)
    {
        PageSeo::destroy($id);
        return back();
    }
}
