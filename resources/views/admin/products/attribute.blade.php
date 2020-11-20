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

                  <form action="{{ route('admin.product.attribute',$productData['id']) }}" name="attributeForm" id="attributeForm"
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
                                          {{$productData['product_name']}}
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Code:</label>
                                          {{$productData['product_code']}}
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Color:</label>
                                          {{$productData['product_color']}}
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          @if(!empty($productData['main_image']))
                                              <div >
                                                  <img src="{{ asset('images/product_image/small/'.$productData['main_image']) }}" alt="" style="margin-top: 5px; width: 24.5%">
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
                                          <div class="field_wrapper">
                                              <div>
                                                  <input type="text" name="size[]" id="size" value="" class="mb-2" placeholder="Size" required/>
                                                  <input type="number" name="price[]" id="price" value="" class="mb-2" placeholder="Price" min="0"/>
                                                  <input type="text" name="sku[]" id="sku" value="" class="mb-2" placeholder="Sku"  required/>
                                                  <input type="number" name="stock[]" id="stock" value="" class="mb-2" placeholder="Stock" min="0"/>
                                                  <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus-circle"></i></a>
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
                               Add Attribute
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
                            <div> <h3 class="card-title">Table Product Attribute</h3></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.product.edit.attribute',$productData['id']) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <table id="productAttribute" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Size</th>
                                        <th>Sku</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productData->attributes as $attribute)
                                        <input type="hidden" value="{{$no++}}">
                                        <input type="text" name="attribute_id[]" value="{{ $attribute->id}}" hidden>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $attribute->size}}</td>
                                            <td>{{ $attribute->sku}}</td>
                                            <td><input type="number" name="price[]" value="{{ $attribute->price}}" min="0"></td>
                                            <td><input type="number" name="stock[]" value="{{ $attribute->stock}}" min="0"></td>
                                            <td>
                                                @if( $attribute->status === 1)
                                                    <a class="updateStatus"
                                                       id="data-{{ $attribute->id }}"
                                                       data_id="{{ $attribute->id }}"
                                                       url="update-product-attribute-status"
                                                       title="Status is active"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                                @else
                                                    <a class="updateStatus"
                                                       id="data-{{ $attribute->id }}"
                                                       data_id="{{ $attribute->id }}"
                                                       url="update-product-attribute-status"
                                                       title="status is inactive"
                                                       href="javascript:void (0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                                @endif
                                                <a href="javascript:void (0)"
                                                   title="Delete Attribute"
                                                   class="btn text-danger confirmDelete" record="product-attribute" recordid="{{ $attribute->id }}">
                                                    <i class="fas fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Update Attribute
                                    </button>
                                </div>
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
