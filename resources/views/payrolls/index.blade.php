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
                <h3>Payrolls</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payrolls</li>
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
                    @if(session('role') == 'HR')
                    <!-- tombol create payroll mengarah ke route create payroll -->
                    <a href="{{route('payrolls.create')}}" class="btn btn-primary mb-3 ms-auto">New payroll</a>
                    @endif
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
                            <th>Employee</th>
                            <th>Salary</th>
                            <th>Deductions</th>
                            <th>Bonuses</th>
                            <th>Net Salary</th>
                            <th>Pay Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payrolls as $payroll) <!-- loop payroll untuk menampilkan data payroll -->
                        <tr>
                            <td>{{$payroll->employee->fullname}}</td><!-- menampilkan nama employee dari relasi employee dengan payroll -->
                            <td>{{number_format($payroll->salary)}}</td>
                            <td>{{number_format($payroll->deductions)}}</td>
                            <td>{{number_format($payroll->bonuses)}}</td>
                            <td>{{number_format($payroll->net_salary)}}</td>
                            <td>{{$payroll->pay_date}}</td>

                            <td>
                                <!-- tombol view payroll mengarah ke route view payroll dengan id payroll -->
                                <a href="{{route('payrolls.show', $payroll->id)}}" class="btn btn-info btn-sm">Salary Slip</a>
                                <!-- tombol edit payroll mengarah ke route edit payroll dengan id payroll -->
                                @if(session('role') == 'HR')
                                <a href="{{route('payrolls.edit', $payroll->id)}}" class="btn btn-primary btn-sm">Edit</a>


                                <!-- tombol delete payroll mengarah ke route delete payroll dengan id payroll -->
                                <form action="{{route('payrolls.destroy', $payroll->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                @endif
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