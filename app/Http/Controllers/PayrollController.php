<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;

class PayrollController extends Controller
{
    // index
    public function index()
    {
        // jika role adalah HR, tampilkan semua payroll
        // jika bukan HR, tampilkan payroll dari employee_id yang login
        if (session('role') == 'HR') {
            $payrolls = Payroll::all();
        } else {
            $payrolls = Payroll::where('employee_id', session('employee_id'))->get();
        }
        return view('payrolls.index', compact('payrolls'));
    }

    // create
    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'salary' => 'required|numeric',
            'bonuses' => 'required|numeric',
            'deductions' => 'required|numeric',
            'net_salary' => 'numeric|min:0',
            'pay_date' => 'required|date',
        ]);

        // menghitung net_salary otomatis dari salary, deductions dan bonuses
        $net_Salary = $request->input('salary') - $request->input('deductions') + $request->input('bonuses');
        $request->merge(['net_salary' => $net_Salary]);

        Payroll::create($request->all());
        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully');
    }

    // edit
    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    // update
    public function update(Request $request, Payroll $payroll)
    {
        $request->validate([
            'employee_id' => 'required',
            'salary' => 'required|numeric',
            'bonuses' => 'required|numeric',
            'deductions' => 'required|numeric',
            'net_salary' => 'numeric|min:0',
            'pay_date' => 'required|date',
        ]);

        // menghitung net_salary otomatis dari salary, deductions dan bonuses
        $net_Salary = $request->input('salary') - $request->input('deductions') + $request->input('bonuses');
        $request->merge(['net_salary' => $net_Salary]);

        $payroll->update($request->all());
        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully');
    }

    // show
    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    // destroy
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully');
    }
}
