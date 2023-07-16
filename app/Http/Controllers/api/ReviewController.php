<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews, 200);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'type' => 'required|in:customer,partner',
                'iamge' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048'
            ]
        );

        $image_path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->storeAs('Created_Review_Images', $file->getClientOriginalName(), 'public');
        }
        $reviews = Review::create(
            [
                'name' => $request->name,
                'type' => $request->type,
                'image' => $image_path,
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );
        return response()->json(
            [
                'message' => 'Review Created Successfully',
                'status' => 'success'
            ],
            200
        );
    }
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->name = $request->input('name');
        $review->type = $request->input('type');
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        if ($request->hasFile('image')) {
            if ($review->image) {
                Storage::delete($review->image);
            }
            $file = $request->file('image');
            $image_path = $file->storeAs('Updated_Review_Images', $file->getClientOriginalName(), 'public');
            $review->image = str_replace('public/', '', $image_path);
        }
        $review->save();
        return response()->json(
            [
                'message' => 'Review Updated Successfully',
                'status' => 'updated'
            ]
        );
    }
    public function destroy(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        if (!$review) {
            return response()->json([
                'message' => 'Review Not Found',
                'status' => 'error'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'message' => 'Review Deleted Successfully',
            'status' => 'success'
        ], 200);
    }
}
