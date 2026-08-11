<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //index
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    // create
    public function create()
    {
        return view('departments.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }
}
