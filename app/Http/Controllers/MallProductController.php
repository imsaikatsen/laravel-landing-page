<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MallProduct;
use Illuminate\Support\Str;

class MallProductController extends Controller
{
    public function index()
    {
        $products = MallProduct::latest()->paginate(20);
        return view('mallproducts.index', compact('products'));
    }

    public function create()
    {
        return view('mallproducts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:mall_products,title',
            'price' => 'required',
        ]);

        $data = $request->all();

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

        return redirect()->route('mallproducts.index')->with('success', 'Product Created');
    }


    public function edit($id)
    {
        $product = MallProduct::findOrFail($id);
        return view('mallproducts.edit', compact('product'));
    }



    public function update(Request $request, $id)
    {
        $product = MallProduct::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:mall_products,title,' . $product->id,
        ]);

        $data = $request->all();

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

        return redirect()->route('mallproducts.index')->with('success', 'Product Updated');
    }



    public function show($slug)
    {
        $item = MallProduct::where('slug', $slug)->firstOrFail();

        return view('site.pages.mall.show', compact('item'));
    }


    public function destroy($id)
    {
        MallProduct::destroy($id);
        return back();
    }
}
