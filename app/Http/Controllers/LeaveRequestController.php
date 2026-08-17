<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    //index
    public function index()
    {
        $leaveRequests = LeaveRequest::all();
        return view('leave-requests.index', compact('leaveRequests'));
    }
}
