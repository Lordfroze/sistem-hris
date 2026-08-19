<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Employee;

class LeaveRequestController extends Controller
{
    //index
    public function index()
    {
        $leaveRequests = LeaveRequest::all();
        return view('leave-requests.index', compact('leaveRequests'));
    }

    // create
    public function create()
    {
        $employees = Employee::all();
        return view('leave-requests.create', compact('employees'));
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // set default status to pending
        $request->merge([
            'status' => 'pending'
        ]);

        LeaveRequest::create($request->all());
        return redirect()->route('leave-requests.index')->with('success', 'Leave request created successfully');
    }

    // edit
    public function edit(LeaveRequest $leaveRequest)
    {
        $employees = Employee::all();
        return view('leave-requests.edit', compact('leaveRequest', 'employees'));
    }

    // update
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $leaveRequest->update($request->all());
        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully');
    }

    // confirm
    public function confirm(int $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update([
            'status' => 'confirm'
        ]);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request confirmed successfully');
    }

    // reject
    public function reject(int $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update([
            'status' => 'reject'
        ]);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request rejected successfully');
    }
}
