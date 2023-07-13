<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
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
        return response()->json(
            [
                'message' => 'Product Created Successfully',
                'status' => 'success'
            ],
            200
        );
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
        return response()->json(
            [
                'message' => 'Product Updated Successfully',
                'status' => 'updated'
            ]
        );
    }
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product Not Found',
                'status' => 'error'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product Deleted Successfully',
            'status' => 'success'
        ], 200);
    }
}
