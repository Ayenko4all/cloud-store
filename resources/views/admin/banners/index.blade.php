@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Banners</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Banners</li>
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
                                <h3 class="card-title">Table Banner</h3>
                                <div>
                                    <a href="{{ route('admin.banners.create') }}"  style="float: right; display: inline-block"
                                       class="btn btn-success btn-sm text-white text-right">Add Banner</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="banners" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                        <input type="hidden" value="{{$no++}}">
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>
                                                @if(!empty($banner->image) && file_exists('images/banner_image/'.$banner->image))
                                                    <img src="{{ asset('images/banner_image/'.$banner->image)}}" alt="" style="width: 100px">
                                                @else
                                                    <img src="{{ asset('images/product_image/small/No_Image_small.png')}}" alt="" style="width: 40px">
                                                @endif
                                            </td>
                                            <td>{{ $banner->title }}</td>
                                            <td>
                                                @if( $banner->status === 1)
                                                    <a class="updateStatus"
                                                       id="data-{{ $banner->id }}"
                                                       data_id="{{ $banner->id }}"
                                                       url="update-banner-status"
                                                       title="status is active"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                                @else
                                                    <a class="updateStatus"
                                                       id="data-{{ $banner->id }}"
                                                       data_id="{{ $banner->id }}"
                                                       url="update-banner-status"
                                                       title="status is inactive"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn text-primary" title="Edit banner">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void (0)"
                                                   title="Delete banner"
                                                   class="btn text-danger confirmDelete" record="banner" recordid="{{ $banner->id }}">
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
