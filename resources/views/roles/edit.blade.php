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
                    Edit Role
                </h5>
            </div>
            <div class="card-body">
                <!-- form edit role dengan menggunakan Role Model -->
                <form action="{{route('roles.update', $role->id)}}" method="post">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{old('title', $role->title)}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{old('description', $role->description)}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{message}}</div>
                        @enderror
                    </div>


                    <!-- tombol submit form -->
                    <button type="submit" class="btn btn-primary">Update Role</button>
                    <a href="{{route('roles.index')}}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>

    </section>
</div>
@endsection