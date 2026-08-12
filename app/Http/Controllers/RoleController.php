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
}
