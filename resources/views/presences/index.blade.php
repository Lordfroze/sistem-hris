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
                <h3>Presences</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Presences</li>
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
                    <!-- tombol create presence mengarah ke route create presence -->
                    <a href="{{route('presences.create')}}" class="btn btn-primary mb-3 ms-auto">New presence</a>
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
                            <th>Employee Name</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($presences as $presence) <!-- loop presence untuk menampilkan data presence -->
                        <tr>
                            <td>{{$presence->employee->fullname}}</td><!-- menampilkan nama employee dari relasi employee dengan presence -->
                            <td>{{$presence->check_in}}</td>
                            <td>{{$presence->check_out}}</td>
                            <td>{{$presence->date}}</td>
                            <td>
                                <!-- menampilkan status presence -->
                                @if($presence->status == 'present')
                                <span class="text-success">Present</span>
                                @else
                                <span class="text-danger">{{$presence->status}}</span>
                                @endif
                            </td>
                            <td>
                                <!-- tombol edit presence mengarah ke route edit presence dengan id presence -->
                                <a href="{{route('presences.edit', $presence->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <!-- tombol delete presence mengarah ke route delete presence dengan id presence -->
                                <form action="{{route('presences.destroy', $presence->id)}}" method="POST" class="d-inline">
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