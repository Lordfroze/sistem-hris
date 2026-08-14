<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;

class PayrollController extends Controller
{
    // index
    public function index()
    {
        $payrolls = Payroll::all();
        return view('payrolls.index', compact('payrolls'));
    }
}
