@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Brands</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-md-12 mt-3">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Table Brand</h3>
                                <div>
                                    <a href="{{ route('admin.brands.create') }}"  style="float: right; display: inline-block"
                                       class="btn btn-success btn-sm text-white text-right">Add Brand</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="brands" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $brand)
                                        <input type="hidden" value="{{$no++}}">
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                @if( $brand->status === 1)
                                                    <a class="updateStatus"
                                                       id="data-{{ $brand->id }}"
                                                       data_id="{{ $brand->id }}"
                                                       url="update-brand-status"
                                                       title="status is active"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                                @else
                                                    <a class="updateStatus"
                                                       id="data-{{ $brand->id }}"
                                                       data_id="{{ $brand->id }}"
                                                       url="update-brand-status"
                                                       title="status is inactive"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.brand.edit',$brand->id) }}" class="btn text-primary" title="Edit Brand">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void (0)"
                                                   title="Delete Brand"
                                                   class="btn text-danger confirmDelete" record="brand" recordid="{{ $brand->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
