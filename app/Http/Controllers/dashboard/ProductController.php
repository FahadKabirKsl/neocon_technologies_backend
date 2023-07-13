<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('layouts.dashboard.product.index', compact('products'));
    }
    public function create()
    {
        $products = Product::all();
        return view('layouts.dashboard.product.create', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'iamge' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048'
            ]
        );

        $image_path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->storeAs('Created_Product_Images', $file->getClientOriginalName(), 'public');
        }
        $products = Product::create(
            [
                'name' => $request->name,
                'title' => $request->title,
                'image' => $image_path,
                'description' => $request->description
            ]
        );
        session()->flash('create', 'Product Created Successfully');
        return redirect()->route('product.index');
    }
    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return view('layouts.dashboard.product.update', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $file = $request->file('image');
            $image_path = $file->storeAs('Updated_Product_Images', $file->getClientOriginalName(), 'public');
            $product->image = str_replace('public/', '', $image_path);
        }
        $product->save();
        session()->flash('update', 'Product Updated Successfully');
        return redirect()->route('product.index');
    }
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        session()->flash('delete', 'Product Deleted Successfully');
        return redirect()->route('product.index');
    }
}
