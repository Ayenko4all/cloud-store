@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                <div> <h3 class="card-title">Table Products</h3></div>
                                <div>
                                    <a href="{{ route('admin.products.create') }}"  style="float: right; display: inline-block"
                                       class="btn btn-success btn-sm text-white text-right">Add product</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Product Image</th>
                                        <th>Category</th>
                                        <th>Section</th>
                                        <th>Brand</th>
                                        <th>Status</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <input type="hidden" value="{{$no++}}">
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_color }}</td>
                                            <td>
                                                @if(!empty($product->main_image) && file_exists('images/product_image/small/'.$product->main_image))
                                                <img src="{{ asset('images/product_image/small/'.$product->main_image)}}" alt="" style="width: 50px">
                                                @else
                                                    <img src="{{ asset('images/product_image/small/small-no-image.png')}}" alt="" style="width: 50px">
                                                @endif
                                            </td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td style="">
                                                @if( $product->status === 1)
                                                    <a class="updateStatus"
                                                       id="data-{{ $product->id }}"
                                                       data_id="{{ $product->id }}"
                                                       url="update-product-status"
                                                       title="Status is active"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                                @else
                                                    <a class="updateStatus"
                                                       id="data-{{ $product->id }}"
                                                       data_id="{{ $product->id }}"
                                                       url="update-product-status"
                                                       title="Status is inactive"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                                @endif
                                            </td>
                                            <td style="width: 100px">
                                                <a href="{{ route('admin.product.attribute',$product->id) }}" class="btn text-primary" title="Add Attribute">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <a href="{{ route('admin.product.images',$product->id) }}" class="btn text-primary" title="Add Product Images">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                                <a href="{{ route('admin.product.edit',$product->id) }}" class="btn text-primary" title="Edit Product"><i class="fas fa-edit"></i></a>
                                                <a {{--href="{{ route('delete.product', $product->id) }}"--}}
                                                   href="javascript:void (0)"
                                                   title="Delete Product"
                                                   class="btn text-danger confirmDelete" record="product" recordid="{{ $product->id }}">
                                                    <i class="fas fa-trash"></i>
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
