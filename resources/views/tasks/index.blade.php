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
                    Simple Datatable
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <!-- tombol create task mengarah ke route create task -->
                    <a href="{{route('tasks.create')}}" class="btn btn-primary mb-3 ms-auto">New Task</a>
                </div>
                <!-- notification success -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <!-- table task -->
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Assigned To</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task) <!-- loop task untuk menampilkan data task -->
                        <tr>
                            <td>{{$task->title}}</td>
                            <td>{{$task->employee->fullname}}</td>
                            <td>{{$task->due_date}}</td>
                            <td>
                                <!-- status task -->
                                @if($task->status == 'pending')
                                <span class="badge bg-warning">{{$task->status}}</span>
                                @elseif($task->status == 'done')
                                <span class="badge bg-success">{{$task->status}}</span>
                                @else
                                <span class="badge bg-danger">{{$task->status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('tasks.show', $task->id)}}" class="btn btn-info btn-sm">View</a>
                                @if($task->status == 'pending')
                                <a href="{{route('tasks.done', $task->id)}}" class="btn btn-success btn-sm">Mark Done</a>
                                @elseif($task->status == 'done')
                                <a href="{{route('tasks.pending', $task->id)}}" class="btn btn-warning btn-sm">Mark Pending</a>
                                @endif
                                <!-- tombol edit task mengarah ke route edit task dengan id task  -->
                                <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <!-- tombol delete task mengarah ke route delete task dengan id task -->
                                <form action="{{route('tasks.destroy', $task->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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