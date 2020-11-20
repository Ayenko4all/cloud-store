@extends('layouts.admin_layout.admin_layout')

@section('content')

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                  <form action="{{ route('admin.product.images',$productData->id) }}" name="attributeForm" id="attributeForm"
                  enctype="multipart/form-data" method="post">
                      @csrf
                      <div class="card card-default">
                          <div class="card-header">
                              <h3 class="card-title">{{$title}}</h3>

                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                              </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              @if(session()->has('error'))
                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      {{ session()->get('error') }}
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                              @endif
                                  @if(session()->has('success'))
                                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          {{ session()->get('success') }}
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                  @endif

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Name:</label>
                                          {{$productData->product_name}}
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Code:</label>
                                          {{$productData->product_code}}
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Color:</label>
                                          {{$productData->product_color}}
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          @if(!empty($productData->main_image))
                                              <div >
                                                  <img src="{{ asset('images/product_image/small/'.$productData->main_image) }}" alt="" style="margin-top: 5px; width: 24.5%">
                                              </div>
                                          @else
                                              <div >
                                                  <img src="{{ asset('images/product_image/small/No_Image_small.png')}}" alt="" style="margin-top: 5px; width: 24.5%">
                                              </div>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <div class="image_field_wrapper">
                                              <div>
                                                  <input type="file" name="images[]" id="images" value="" class="mb-2" placeholder="Image" multiple required/>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- /.col -->
                              </div>
                              <!-- /.row -->


                              <!-- /.row -->
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit" class="btn btn-sm btn-success">
                               Add Product Image
                              </button>
                          </div>
                      </div>
                  </form>

                </div>
            </section>
            <!-- /.content -->
        </div>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <div> <h3 class="card-title">Table Product Images</h3></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <table id="productAttribute" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productData->product_images as $images)
                                        <input type="hidden" value="{{$no++}}">
{{--                                        <input type="text" name="product_images_id[]" value="{{ $images->id}}" hidden>--}}
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>
{{--                                                <input type="file" name="images[]" id="images[]" value="" class="mb-2" placeholder="Image" />--}}
                                                <img src="{{ asset('images/product_image/small/'.$images->image) }}" alt="" style="margin-top: 5px; width: 15%">
                                            </td>
                                            <td>
                                                @if( $images->status === 1)
                                                    <a class="updateStatus"
                                                       id="data-{{ $images->id }}"
                                                       data_id="{{ $images->id }}"
                                                       url="update-product-images-status"
                                                       href="javascript:void (0)">Active</a>
                                                @else
                                                    <a class="updateStatus"
                                                       id="data-{{ $images->id }}"
                                                       data_id="{{ $images->id }}"
                                                       url="update-product-images-status"
                                                       href="javascript:void (0)">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void (0)"
                                                   title="Delete Images"
                                                   class="btn text-danger confirmDelete" record="product-images" recordid="{{ $images->id }}">
                                                    <i class="fas fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </section>
            <!-- /.content -->
        </div>



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>





@endsection
