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
                    Create Task
                </h5>
            </div>
            <div class="card-body">
                <!-- form create task -->
                <form action="{{route('tasks.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                        @error('title')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Employee</label>
                        <select name="assigned_to" id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->fullname}}</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Due date</label>
                        <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" value="{{@old('due_date')}}" required name="due_date" required>
                        @error('due_date')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="pending">Pending</option>
                            <option value="on progress">On Progress</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" value="{{@old('description')}}"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <!-- tombol submit form -->
                    <button type="submit" class="btn btn-primary">Create Task</button>
                    <a href="{{route('tasks.index')}}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>

    </section>
</div>
@endsection