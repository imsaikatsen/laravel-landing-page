<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MallProduct;
use App\Models\PageRedirection;

class RedirectionController extends Controller
{
    public function index()
    {
        $redireations = PageRedirection::latest()->paginate(20);
        return view('redirection.index', compact('redireations'));
    }

    public function create()
    {
        return view('redirection.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:mall_products,title',
            'price' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'category_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['category_active'] = $request->category_id ? $request->boolean('category_active') : false;

        // Auto slug
        $slug = generate_slug($request->title);
        $count = MallProduct::where('slug', 'LIKE', "$slug%")->count();
        $data['slug'] = $count ? "{$slug}-{$count}" : $slug;

        // Image upload
        if ($request->hasFile('image')) {
            $name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('mall-products'), $name);
            $data['image'] = $name;
        }

        MallProduct::create($data);

        return redirect()->route('redirection.index')->with('success', 'Product Created');
    }


    public function edit($id)
    {
        $product = MallProduct::with('category')->findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('redirection.edit', compact('product', 'categories'));
    }



    public function update(Request $request, $id)
    {
        $product = MallProduct::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:mall_products,title,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'category_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['category_active'] = $request->category_id ? $request->boolean('category_active') : false;

        // Auto slug regenerate if title changed
        if ($request->title !== $product->title) {

            $slug = generate_slug($request->title);
            $count = MallProduct::where('slug', 'LIKE', "$slug%")
                ->where('id', '!=', $product->id)
                ->count();

            $data['slug'] = $count ? "{$slug}-{$count}" : $slug;
        }

        if ($request->hasFile('image')) {
            $name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('mall-products'), $name);
            $data['image'] = $name;
        }

        $product->update($data);

        return redirect()->route('redirection.edit', $product->id)->with('success', 'Product updated successfully.');
    }



    public function show($slug)
    {
        $item = MallProduct::with('category')->where('slug', $slug)->firstOrFail();

        return view('site.pages.mall.show', compact('item'));
    }


    public function destroy($id)
    {
        MallProduct::destroy($id);
        return back();
    }
}
