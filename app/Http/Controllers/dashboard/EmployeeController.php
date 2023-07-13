<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('layouts.dashboard.employee.index', compact('employees'));
    }
    public function create(Request $request)
    {
        $employees = Employee::all();
        return view('layouts.dashboard.employee.create', compact('employees'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'type' => 'required|in:director,team',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]
        );
        $image_path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->storeAs('Created_Employee_Images', $file->getClientOriginalName(), 'public');
        }
        $employee = Employee::create(
            [
                'type' => $request->type,
                'name' => $request->name,
                'designation' => $request->designation,
                'about' => $request->about,
                'heading' => $request->heading,
                'message' => $request->message,
                'image' => $image_path,
            ]
        );
        session()->flash('create', 'Employee Created Successfully');
        return redirect()->route('employee.index');
    }
    public function edit(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        return view('layouts.dashboard.employee.update', compact('employee'));
    }
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->type = $request->input('type');
        $employee->name = $request->input('name');
        $employee->designation = $request->input('designation');
        $employee->about = $request->input('about');
        $employee->heading = $request->input('heading');
        $employee->message = $request->input('message');

        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::delete($employee->image);
            }
            $file = $request->file('image');
            $image_path = $file->storeAs('Updated_Employee_Images', $file->getClientOriginalName(), 'public');
            $employee->image = str_replace('public/', '', $image_path);
        }
        $employee->save();
        session()->flash('update', 'Employee Updated Successfully');
        return redirect()->route('employee.index');
    }
    public function destroy(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        session()->flash('delete', 'Employee Deleted Successfully');
        return redirect()->route('employee.index');
    }
}