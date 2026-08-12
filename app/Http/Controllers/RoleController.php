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

    // edit dengan menggunakan Role Model
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // update dengan menggunakan Role Model
    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'nullable'
            ]
        );
        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    // destroy dengan menggunakan Role Model
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
