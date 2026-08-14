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
                    Edit Presence
                </h5>
            </div>
            <div class="card-body">
                <!-- form Edit presence membawa presence  id-->
                <form action="{{route('presences.update', $presence->id)}}" method="post">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="" class="form-label">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}" {{ ($employee->id == $presence->employee_id) ? 'selected' : '' }}> {{$employee->fullname}}</option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Check-in</label>
                        <input type="text" class="form-control datetime" name="check_in" value="{{old('check_in', $presence->check_in)}}" required>
                        @error('check_in')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Check-out</label>
                        <input type="text" class="form-control datetime" name="check_out" value="{{old('check_out', $presence->check_out)}}" required>
                        @error('check_out')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Date</label>
                        <input type="text" class="form-control date" name="date" value="{{old('date', $presence->date)}}" required>
                        @error('date')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="present" {{ ($presence->status == 'present') ? 'selected' : '' }}>Present</option>
                            <option value="absent" {{ ($presence->status == 'absent') ? 'selected' : '' }}>Absent</option>
                            <option value="leave" {{ ($presence->status == 'leave') ? 'selected' : '' }}>Leave</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <!-- tombol submit form -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('presences.index')}}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>

    </section>
</div>
@endsection