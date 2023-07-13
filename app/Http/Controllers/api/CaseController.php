<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\caseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    public function index()
    {
        $caseStudies = caseStudy::all();
        return response()->json($caseStudies, 200);
    }
    public function store(Request $request)
    {
        $caseStudies = $request->validate(
            [
                'name' => 'required|string',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]
        );
        $image_path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->storeAs('Created_Case-Studies_Images', $file->getClientOriginalName(), 'public');
        }
        $caseStudies = caseStudy::create(
            [
                'tags' => $request->tags,
                'image' => $image_path,
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link

            ]
        );
        return response()->json([
            'message' => 'Case-Study Created Successfully',
            'status' => 'success',
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $caseStudies = caseStudy::findOrFail($id);
        $caseStudies->tags = $request->input('tags');
        $caseStudies->name = $request->input('name');
        $caseStudies->title = $request->input('title');
        $caseStudies->description = $request->input('description');
        $caseStudies->link = $request->input('link');

        if ($request->hasFile('image')) {
            if ($caseStudies->image) {
                Storage::delete($caseStudies->image);
            }
            $file = $request->file('image');
            $image_path = $file->storeAs('Updated_Case-Studies_Images', $file->getClientOriginalName(), 'public');
            $caseStudies->image = str_replace('public/', '', $image_path);
        }
        $caseStudies->save();
        return response()->json(
            [
                'message' => 'Case-Study Updated Successfully',
                'status' => 'updated'
            ]
        );
    }
    public function destroy(Request $request, $id)
    {
        $caseStudies = caseStudy::where('id', $id)->first();
        if (!$caseStudies) {
            return response()->json([
                'message' => 'Case-Study Not Found',
                'status' => 'error'
            ], 404);
        }
        $caseStudies->delete();
        return response()->json([
            'message' => 'Case-Study Deleted Successfully',
            'status' => 'success'
        ], 200);
    }
}
