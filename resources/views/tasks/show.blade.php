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
                <div class="mb-3">
                    <label for="">Title</label>
                    <p>{{$task->title}}</p>
                </div>

                <div class="mb-3">
                    <label for="">Employee</label>
                    <p>{{$task->employee->fullname}}</p>
                </div>

                <div class="mb-3">
                    <label for="">Due Date</label>
                    <p>{{\Carbon\Carbon::parse($task->due_date)->format('d-m-Y')}}</p>
                </div>

                <div class="mb-3">
                    <label for="">Status</label>
                    @if($task->status == 'pending')
                    <p class="text-warning">Task is pending</p>
                    @else
                    <p class="text-success">Task is done</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <p>{{$task->description}}</p>
                </div>

                <a href="{{route('tasks.index')}}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
        @endsection