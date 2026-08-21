<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Employee;
use Carbon\Carbon;

class PresenceController extends Controller
{
    //index
    public function index()
    {
        // jika role HR, tampilkan semua presensi
        if (session('role') == 'HR') {
            $presences = Presence::all();
        } else {
            // jika role employee, tampilkan presensi employee tersebut
            $presences = Presence::where('employee_id', session('employee_id'))->get();
        }

        return view('presences.index', compact('presences'));
    }

    // create
    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    // store
    public function store(Request $request)
    {
        // jika role HR bisa membuat presensi untuk semua employee
        if (session('role') == 'HR') {
            $request->validate([
                'employee_id' => 'required',
                'check_in' => 'required',
                'check_out' => 'required',
                'date' => 'required|date',
                'status' => 'required|string',
            ]);

            Presence::create($request->all());
        } else {
            // jika role employee, hanya bisa membuat presensi untuk diri sendiri
            Presence::create([
                'employee_id' => session('employee_id'),
                'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
                'check_out' => $request->check_out,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'present'
            ]);
        }
        return redirect()->route('presences.index')->with('success', 'Presence created successfully');
    }

    // edit
    public function edit(Presence $presence)
    {
        $employees = Employee::all();
        return view('presences.edit', compact('presence', 'employees'));
    }

    // update
    public function update(Request $request, Presence $presence)
    {
        $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        $presence->update($request->all());
        return redirect()->route('presences.index')->with('success', 'Presence updated successfully');
    }

    // destroy
    public function destroy(Presence $presence)
    {
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully');
    }
}
