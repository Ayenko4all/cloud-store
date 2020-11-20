@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                               <div> <h3 class="card-title">Table Categories</h3></div>
                                <div>
                                    <a href="{{ route('admin.add.edit.category') }}"  style="float: right; display: inline-block"
                                       class="btn btn-success btn-sm text-white text-right">Add Category</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Parent Category</th>
                                        <th>Section</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <input type="hidden" value="{{$no++}}">
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            @if($category->parentCategory)
                                                {{ $category->parentCategory->category_name }}
                                            @else
                                                Root
                                            @endif
                                        </td>
                                        <td>{{ $category->section->name }}</td>
                                        <td>{{ $category->url }}</td>
                                        <td>
                                            @if( $category->status === 1)
                                                <a class="updateStatus"
                                                   id="data-{{ $category->id }}"
                                                   data_id="{{ $category->id }}"
                                                   url="update-category-status"
                                                   title="Status is active"
                                                   href="javascript:void (0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                            @else
                                                <a class="updateStatus"
                                                   id="data-{{ $category->id }}"
                                                   data_id="{{ $category->id }}"
                                                   url="update-category-status"
                                                   title="Status is inactive"
                                                   href="javascript:void (0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.add.edit.category', $category->id) }}" class="btn text-primary">Edit</a>
                                            <a {{--href="{{ route('delete.category', $category->id) }}"--}}
                                                href="javascript:void (0)"
                                               class="btn text-danger confirmDelete" record="category" recordid="{{ $category->id }}">
                                                Delete
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
