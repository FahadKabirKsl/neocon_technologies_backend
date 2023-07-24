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
                'image' => 'array',
                'single_iamge' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048'
            ]
        );
        //single image
        $single_images = null;
        if ($request->hasFile('single_image')) {
            $file = $request->file('single_image');
            $single_images = $file->storeAs('Created_Single_Images', $file->getClientOriginalName(), 'public');
        }
        //multiple_image
        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $image_path = $file->storeAs('Created_Multiple_Product_Images', $file->getClientOriginalName(), 'public');
                $images[] = $image_path;
            }
        }

        $products = Product::create([
            'name' => $request->name,
            'title' => $request->title,
            'image' => $images, //multiple_image
            'single_image' => $single_images,
            'description' => $request->description,
        ]);
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

        //single image
        $single_image_path = null;
        if ($request->hasFile('single_image')) {
            $file = $request->file('single_image');
            $single_image_path = $file->storeAs('Updated_Single_Images', $file->getClientOriginalName(), 'public');
        }

        //multiple_image
        $existingImages = $product->image ?? []; // Get the existing images or initialize an empty array

        if ($request->hasFile('image')) {
            $newImages = [];
            foreach ($request->file('image') as $file) {
                $multiple_image_path = $file->storeAs('Updated_Product_Images', $file->getClientOriginalName(), 'public');
                $newImages[] = str_replace('public/', '', $multiple_image_path);
            }

            // Merge new images with existing images
            $product->image = array_merge($existingImages, $newImages);
        }

        // Check if any images are to be removed
        if ($request->has('remove_images')) {
            $imagesToRemove = $request->input('remove_images');
            foreach ($imagesToRemove as $index) {
                if (isset($existingImages[$index])) {
                    $imagePath = 'public/' . $existingImages[$index];
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                    unset($existingImages[$index]); // Remove the image from the existing images array
                }
            }
            $product->image = array_values($existingImages); // Reindex the array after removing elements 
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
