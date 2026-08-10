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
}
