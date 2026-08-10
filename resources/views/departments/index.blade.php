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
                <h3>Department</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Department</li>
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
                    <!-- tombol create department mengarah ke route create department -->
                    <a href="{{route('departments.create')}}" class="btn btn-primary mb-3 ms-auto">New department</a>
                </div>
                <!-- notification success -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <!-- table depa$department -->
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department) <!-- loop depa$department untuk menampilkan data depa$department -->
                        <tr>
                            <td>{{$department->name}}</td>
                            <td>{{$department->description}}</td>
                            <td>
                                <!-- status depa$department -->
                                @if($department->status == 'inactive')
                                <span class="text-warning">{{$department->status}}</span>
                                @else
                                <span class="text-success">{{$department->status}}</span>
                                @endif
                            </td>
                            <td>
                                <!-- tombol edit department mengarah ke route edit department dengan id department -->
                                <a href="{{route('departments.edit', $department->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <!-- tombol delete department mengarah ke route delete department dengan id department -->
                                <form action="{{route('departments.destroy', $department->id)}}" method="POST" class="d-inline">
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