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

                  <form action="{{ empty($productData) ? route('admin.product.store') : route('admin.product.update',$productData['id']) }}" name="productForm" id="productForm"
                  enctype="multipart/form-data" method="post">
                      @csrf
                      @if(!empty($productData))
                          @method('PATCH')
                      @endif
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
                                          <label>Select Category</label>
                                          <select name="category_id" id="category_id"
                                                  class="form-control select2 @error('category_id') is-invalid @enderror"
                                                  value=""
                                                  style="width: 100%;">
                                              <option selected="selected">--Select--</option>
                                              @foreach($categories as $section)
                                                  <optgroup label="{{ $section['name'] }}"></optgroup>
                                                  @foreach($section['categories'] as $category)
                                                      <option value="{{ $category['id'] }}"
                                                      @if(!empty(old('category_id') && $category['id'] == old('category_id'))) selected
                                                      @else
                                                          @if(!empty($productData))
                                                              @if(!empty($productData && $productData['category_id'] === $category['id'])) selected
                                                              @endif
                                                          @endif
                                                      @endif>
                                                          &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;
                                                          {{ $category['category_name'] }}</option>
                                                      @foreach($category['subcategories'] as $subcategory)
                                                          <option value="{{ $subcategory['id'] }}"
                                                          @if(!empty(old('category_id') &&  $subcategory['id'] == old('category_id'))) selected
                                                          @else
                                                              @if(!empty($productData))
                                                                  @if(!empty($productData['category_id'] && $productData['category_id'] === $subcategory['id'])) selected
                                                                  @endif
                                                              @endif
                                                          @endif>
                                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;
                                                              {{ $subcategory['category_name'] }}</option>
                                                      @endforeach
                                                  @endforeach
                                              @endforeach
                                          </select>
                                          @error('category_id')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Code</label>
                                          <input type="text"  name="product_code"
                                                 class="form-control @error('product_code') is-invalid @enderror"
                                                 id="product_code"
                                                 value="{{ !empty($productData)? $productData['product_code'] : old('product_code') }}"
                                                 placeholder="Enter Product Code">
                                          @error('product_code')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Name</label>
                                          <input type="text"  name="product_name"
                                                 class="form-control @error('product_name') is-invalid @enderror"
                                                 id="product_name"
                                                 value="{{ !empty($productData)? $productData['product_name'] : old('product_name') }}"
                                                 placeholder="Enter Product Name">
                                          @error('product_name')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Color</label>
                                          <input type="text"  name="product_color"
                                                 class="form-control @error('product_color') is-invalid @enderror"
                                                 id="product_color"
                                                 value="{{ !empty($productData)? $productData['product_color'] : old('product_color') }}"
                                                 placeholder="Enter Product Color">
                                          @error('product_color')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Main Image</label>
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file"  name="main_image"
                                                         class="form-control @error('main_image') is-invalid @enderror"
                                                         id="main_image">
                                                  <label for="main_image" class="custom-file-label">Choose file</label>
                                                  @error('main_image')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </div>
                                              <div class="input-group-append">
                                                  <span class="input-group-text">Upload</span>
                                              </div>
                                          </div>
                                        @if($productData)
                                              @if(!empty($productData['main_image']))
                                                  <div >
                                                      <img src="{{ asset('images/product_image/small/'.$productData['main_image']) }}" alt="" style="margin-top: 5px; width: 24.5%">
                                                      &nbsp;
                                                      <a {{--href="{{ route('delete.category.image', $categoryData['id']) }}"--}}
                                                         href="javascript:void (0)" class="confirmDelete" record="product-image" recordid="{{ $productData['id'] }}"
                                                      >
                                                          Delete image
                                                      </a>
                                                  </div>
                                              @else
                                                  <div >
                                                      <img src="{{ asset('images/product_image/small/small-no-image.png')}}" alt="" style="margin-top: 5px; width: 24.5%">
                                                  </div>
                                              @endif
                                        @endif
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Discount (%)</label>
                                          <input type="text"  name="product_discount"
                                                 class="form-control @error('product_discount') is-invalid @enderror"
                                                 id="product_discount"
                                                 value="{{ !empty($productData)? $productData['product_discount'] : old('product_discount') }}"
                                                 placeholder="Enter Product Discount">
                                          @error('product_discount')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Video</label>
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file"  name="product_video"
                                                         class="form-control @error('product_video') is-invalid @enderror"
                                                         id="product_video">
                                                  <label for="product_video" class="custom-file-label">Choose file</label>
                                                  @error('product_video')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </div>
                                              <div class="input-group-append">
                                                  <span class="input-group-text">Upload</span>
                                              </div>
                                          </div>
                                            @if($productData)
                                              @if(!empty($productData['product_video']))
                                                  <div >
                                                      <video style="margin-top: 5px; width: 50%" controls>
                                                          <source src="{{ asset('videos/product_video/'.$productData['product_video']) }}" type="video/mp4">
                                                      </video>
                                                      &nbsp;
                                                      <a {{--href="{{ route('delete.category.image', $categoryData['id']) }}"--}}
                                                         href="javascript:void (0)" class="confirmDelete" record="product-video" recordid="{{ $productData['id'] }}"
                                                      >
                                                          Delete video
                                                      </a> |
                                                      <a href="{{ asset($productData['product_video']) }}" download target="_blank">Download video</a>
                                                  </div>
                                              @else
                                                  <div >
                                                      <video style="margin-top: 5px; width: 56%" controls>
                                                          <source src="{{ asset('videos/product_video/small_video.png')}}" type="video/mp4">
                                                      </video>
                                                  </div>
                                              @endif
                                            @endif
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Price</label>
                                          <input type="text"  name="product_price"
                                                 class="form-control @error('product_price') is-invalid @enderror"
                                                 id="product_price"
                                                 value="{{ !empty($productData)? $productData['product_price'] : old('product_price') }}"
                                                 placeholder="Enter Product Price">
                                          @error('product_price')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="product_weight">Product Weight</label>
                                          <input type="text"  name="product_weight"
                                                 class="form-control @error('product_weight') is-invalid @enderror"
                                                 id="product_discount"
                                                 value="{{ !empty($productData)? $productData['product_weight'] : old('product_weight') }}"
                                                 placeholder="Enter Product Weight">
                                          @error('product_weight')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="meta_keywords">Sleeve</label>
                                          <select name="sleeve" id="sleeve" class="form-control">
                                              <option value="">--Select--</option>
                                              @foreach($sleeveArray as $sleeve)
                                                  <option value="{{ $sleeve }}"
                                                          @if(!empty(old('sleeve') && $sleeve == old('sleeve'))) selected
                                                          @else
                                                              @if(!empty($productData && $productData['sleeve'] === $sleeve)) selected
                                                              @endif
                                                          @endif>
                                                      {{ $sleeve }}</option>
                                              @endforeach
                                          </select>
                                          @error('sleeve')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="pattern">Pattern</label>
                                          <select name="pattern" id="pattern" class="form-control">
                                              <option value="">--Select--</option>
                                              @foreach($patternArray as $pattern)
                                                  <option value="{{ $pattern }}"
                                                      @if(!empty(old('pattern') && $pattern == old('pattern'))) selected
                                                      @else
                                                          @if(!empty($productData && $productData['pattern'] === $pattern)) selected
                                                          @endif
                                                      @endif>
                                                      {{ $pattern }}</option>
                                              @endforeach
                                          </select>
                                          @error('pattern')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="meta_keywords">Select Fit</label>
                                          <select name="fit" id="fit" class="form-control">
                                              <option value="">--Select--</option>
                                              @foreach($fitArray as $fit)
                                                  <option value="{{ $fit }}"
                                                      @if(!empty(old('fit') && $fit == old('fit'))) selected
                                                      @else
                                                          @if(!empty($productData && $productData['fit'] === $fit)) selected
                                                          @endif
                                                      @endif>
                                                      {{ $fit }}</option>
                                              @endforeach
                                          </select>
                                          @error('fit')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="occasion">Select Occasion</label>
                                          <select name="occasion" id="occasion" class="form-control">
                                              <option value="">--Select--</option>
                                              @foreach($occasionArray as $occasion)
                                                  <option value="{{ $occasion }}"
                                                      @if(!empty(old('occasion') && $occasion == old('occasion'))) selected
                                                      @else
                                                          @if(!empty($productData && $productData['occasion'] === $occasion)) selected
                                                          @endif
                                                      @endif>
                                                      {{ $occasion }}</option>
                                              @endforeach
                                          </select>
                                          @error('occasion')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="meta_keywords">Fabric</label>
                                          <select name="fabric" id="fabric" class="form-control">
                                              <option value="">--Select--</option>
                                              @foreach($fabricArray as $fabric)
                                                  <option value="{{ $fabric }}"
                                                      @if(!empty(old('fabric') && $fabric == old('fabric'))) selected
                                                      @else
                                                          @if(!empty($productData && $productData['fabric'] === $fabric)) selected
                                                          @endif
                                                      @endif>
                                                      {{ $fabric }}</option>
                                              @endforeach
                                          </select>
                                          @error('fabric')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">

                                      <div class="form-group">
                                          <label for="description">Product Description</label>
                                          <input id="description" type="hidden" name="description"
                                                 value=" {{ !empty($productData)? $productData['description'] : old('description') }}"
                                                 class="form-control @error('description') is-invalid @enderror">
                                          <trix-editor input="description"></trix-editor>
                                          @error('description')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="meta_title">Meta Title</label>
                                          <input id="meta_title" type="hidden" name="meta_title"
                                                 value=" {{ !empty($productData)? $productData['meta_title'] : old('meta_title') }}"
                                                 class="form-control @error('meta_title') is-invalid @enderror">
                                          <trix-editor input="meta_title"></trix-editor>
                                          @error('meta_title')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="meta_keywords">Meta Keywords</label>
                                          <input id="meta_keywords" type="hidden" name="meta_keywords"
                                                 value=" {{ !empty($productData)? $productData['meta_keywords'] : old('meta_keywords') }}"
                                                 class="form-control @error('meta_keywords') is-invalid @enderror">
                                          <trix-editor input="meta_keywords"></trix-editor>
                                          @error('meta_keywords')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="meta_description">Meta Description</label>
                                          <input id="meta_description" type="hidden" name="meta_description"
                                                 value=" {{ !empty($productData)? $productData['meta_description'] : old('meta_description') }}"
                                                 class="form-control @error('meta_description') is-invalid @enderror">
                                          <trix-editor input="meta_description"></trix-editor>
                                          @error('meta_description')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Brand</label>
                                          <select name="brand_id" id="brand_id" class="form-control">
                                              <option value="">--Select--</option>
                                              @foreach($brands as $brand)
                                                  <option value="{{$brand->id}}"
                                                      @if(!empty(old('brand_id') && $brand->id == old('brand_id'))) selected
                                                      @else
                                                        @if(!empty($productData && $productData['brand_id'] === $brand->id)) selected
                                                        @endif
                                                      @endif>
                                                      {{ $brand->name }}
                                                  </option>
                                              @endforeach
                                          </select>
                                          @error('product_color')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="is_featured">Featured</label>
                                          <div class="input-group">
                                              <input type="checkbox" name="is_featured" id="is_featured"
                                                     value="Yes" @if(!empty($productData && $productData['is_featured'] == "Yes")) checked
                                                  @endif >
                                          </div>
                                          @error('is_featured')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="wash_care">Wash Care</label>
                                          <input id="wash_care" type="hidden" name="wash_care"
                                                 value=" {{ !empty($productData)? $productData['wash_care'] : old('wash_care') }}"
                                                 class="form-control @error('wash_care') is-invalid @enderror">
                                          <trix-editor input="wash_care"></trix-editor>
                                          @error('wash_care')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
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
                                 {{ empty($productData) ? 'Submit':'Update' }}
                              </button>
                          </div>
                      </div>
                  </form>

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
