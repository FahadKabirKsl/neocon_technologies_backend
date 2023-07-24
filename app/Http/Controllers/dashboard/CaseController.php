<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\caseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    public function index()
    {
        $caseStudies = caseStudy::all();
        return view('layouts.dashboard.caseStudy.index', compact('caseStudies'));
    }
    public function create()
    {
        $caseStudies = caseStudy::all();
        return view('layouts.dashboard.caseStudy.create', compact('caseStudies'));
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
                'subHeader' => $request->subHeader

            ]
        );
        session()->flash('create', 'Case-Study Created Successfully');
        return redirect()->route('caseStudy.index');
    }
    public function edit(Request $request, $id)
    {
        $caseStudies = caseStudy::findOrFail($id);
        return view('layouts.dashboard.caseStudy.update', compact('caseStudies'));
    }
    public function update(Request $request, $id)
    {
        $caseStudies = caseStudy::findOrFail($id);
        $caseStudies->tags = $request->input('tags');
        $caseStudies->name = $request->input('name');
        $caseStudies->title = $request->input('title');
        $caseStudies->description = $request->input('description');
        $caseStudies->subHeader = $request->input('subHeader');

        if ($request->hasFile('image')) {
            if ($caseStudies->image) {
                Storage::delete($caseStudies->image);
            }
            $file = $request->file('image');
            $image_path = $file->storeAs('Updated_Case-Studies_Images', $file->getClientOriginalName(), 'public');
            $caseStudies->image = str_replace('public/', '', $image_path);
        }
        $caseStudies->save();
        session()->flash('update', 'Case-Study Updated Successfully');
        return redirect()->route('caseStudy.index');
    }
    public function destroy(Request $request, $id)
    {
        $caseStudies = caseStudy::findOrFail($id);
        $caseStudies->delete();
        session()->flash('delete', 'Case-Study Deleted Successfully');
        return redirect()->route('caseStudy.index');
    }
}
