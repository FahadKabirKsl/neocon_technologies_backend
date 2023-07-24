<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller

{
    public function index(Request $request)
    {
        $services = Service::all();
        return view('layouts.dashboard.service.index', compact('services'));
    }
    public function create(Request $request)
    {
        $services = Service::all();
        return view('layouts.dashboard.service.create', compact('services'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]
        );
        $image_path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->storeAs('Service Page', $file->getClientOriginalName(), 'public');
        }
        $service = Service::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_path,
                'subDesc' => $request->subDesc,
            ]
        );
        session()->flash('create', 'Service Created Successfully');
        return redirect()->route('service.index');
    }
    public function edit(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        return view('layouts.dashboard.service.update', compact('service'));
    }
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->subDesc = $request->input('subDesc');

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete($service->image);
            }
            $file = $request->file('image');
            $image_path = $file->storeAs('Updated_Service_Images', $file->getClientOriginalName(), 'public');
            $service->image = str_replace('public/', '', $image_path);
        }
        $service->save();
        session()->flash('update', 'Service Updated Successfully');
        return redirect()->route('service.index');
    }
    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        session()->flash('delete', 'Service Deleted Successfully');
        return redirect()->route('service.index');
    }
}
