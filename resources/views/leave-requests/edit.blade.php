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
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Edit Leave Request
                </h5>
            </div>
            <div class="card-body">
                <!-- if error -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- form edit leave request -->
                <form action="{{route('leave-requests.update', $leaveRequest->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="" class="form-label">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}" {{$leaveRequest->employee_id == $employee->id ? 'selected' : ''}}>{{$employee->fullname}}</option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Leave type</label>
                        <select name="leave_type" id="leave_type" class="form-control">
                            <option value="sick_leave" {{$leaveRequest->leave_type == 'sick_leave' ? 'selected' : ''}}>Sick Leave</option>
                            <option value="vacation" {{$leaveRequest->leave_type == 'vacation' ? 'selected' : ''}}>Vacation</option>
                            <option value="birth_leave" {{$leaveRequest->leave_type == 'birth_leave' ? 'selected' : ''}}>Birth Leave</option>
                        </select>

                        @error('leave_type')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Start date</label>
                        <input type="text" class="form-control date" name="start_date" value="{{old('start_date', $leaveRequest->start_date)}}" required>
                        @error('start_date')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">End date</label>
                        <input type="text" class="form-control date" name="end_date" value="{{old('end_date', $leaveRequest->end_date)}}" required>
                        @error('end_date')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <!-- tombol submit form -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('leave-requests.index')}}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>

    </section>
</div>
@endsection