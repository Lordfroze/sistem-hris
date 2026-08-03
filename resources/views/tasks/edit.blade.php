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
                <!-- message error -->
                @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                <!-- form edit task dengan id task -->
                <form action="{{route('tasks.update', $task->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{old('title', $task->title)}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Employee</label>
                        <select name="assigned_to" id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                            <!-- jika employee id sama dengan assigned_to task, maka pilih -->
                            <option value="{{$employee->id}}" @if(old('assigned_to', $task->assigned_to) == $employee->id) selected @endif>{{$employee->fullname}}</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Due date</label>
                        <!-- date picker untuk memilih tanggal -->
                        <input type="datetime-local" class="form-control date @error('due_date') is-invalid @enderror" value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '') }}" name="due_date" required>
                        @error('due_date')
                        <div class=" invalid-feedback">{{message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <!-- jika status task sama dengan pending, maka pilih -->
                            <option value="pending" @if(old('status', $task->status) == 'pending') selected @endif>Pending</option>
                            <!-- jika status task sama dengan on progress, maka pilih -->
                            <option value="on progress" @if(old('status', $task->status) == 'on progress') selected @endif>On Progress</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <!-- textarea untuk deskripsi task -->
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{old('description', $task->description)}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <!-- tombol submit form -->
                    <button type="submit" class="btn btn-primary">Update Task</button>
                    <a href="{{route('tasks.index')}}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>

    </section>
</div>
@endsection