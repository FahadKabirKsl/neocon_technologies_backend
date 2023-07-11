<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
         // Iterate through each service and update the "name" value
         foreach ($services as $service) {
            $service->name = json_decode($service->name);
        }
        return response()->json($services, 200);
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
                'subName' => $request->subName,
                'subTitle' => $request->subTitle,
                'image' => $image_path,
                'subDesc' => $request->subDesc,
            ]
        );
        return response()->json(
            [
                'message' => 'Service Created Successfully',
                'status' => 'success'
            ],
            200
        );
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
        $service->subName = $request->input('subName');
        $service->subTitle = $request->input('subTitle');
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
        return response()->json(
            [
                'message' => 'Service Updated Successfully',
                'status' => 'updated'
            ]
        );
    }
    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if (!$service) {
            return response()->json([
                'message' => 'Service Not Found',
                'status' => 'error'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service Deleted Successfully',
            'status' => 'success'
        ], 200);
    }
}
