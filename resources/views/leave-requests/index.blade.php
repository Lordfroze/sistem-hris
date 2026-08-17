@extends('layouts.dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Leave Requests</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Leave Requests</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Leave Requests
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <!-- tombol create leave request mengarah ke route create leave request -->
                    <a href="{{route('leave-requests.create')}}" class="btn btn-primary mb-3 ms-auto">New leave request</a>
                </div>
                <!-- notification success -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <!-- table leave request -->
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveRequests as $leaveRequest) <!-- loop leave request untuk menampilkan data leave request -->
                        <tr>
                            <td>{{$leaveRequest->employee->fullname}}</td><!-- menampilkan nama employee dari relasi employee dengan leave request -->
                            <td>{{$leaveRequest->leave_type}}</td>
                            <td>{{$leaveRequest->start_date}}</td>
                            <td>{{$leaveRequest->end_date}}</td>
                            <td>
                                @if($leaveRequest->status == 'approved')
                                <span class="text-success">{{$leaveRequest->status}}</span>
                                @else
                                <span class="text-warning">{{$leaveRequest->status}}</span>
                                @endif

                            </td>

                            <td>
                                <!-- tombol view payroll mengarah ke route view payroll dengan id payroll -->
                                <a href="{{route('leave-requests.show', $leaveRequest->id)}}" class="btn btn-info btn-sm">View</a>
                                <!-- tombol edit leave request mengarah ke route edit leave request dengan id leave request -->
                                <a href="{{route('leave-requests.edit', $leaveRequest->id)}}" class="btn btn-primary btn-sm">Edit</a>


                                <!-- tombol delete leave request mengarah ke route delete leave request dengan id leave request -->
                                <form action="{{route('leave-requests.destroy', $leaveRequest->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection