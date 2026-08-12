<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //index
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    //create
    public function create()
    {
        return view('roles.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'nullable'
            ]
        );
        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }
}
