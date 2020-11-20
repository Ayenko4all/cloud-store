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
                            <h1>Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Categories</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                  <form action="{{ empty($categoryData) ? route('admin.add.edit.category') : route('admin.add.edit.category',$categoryData['id']) }}" name="categoryForm" id="categoryForm"
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
                                          <label for="exampleInputEmail1">Category Name</label>
                                          <input type="text"  name="category_name"
                                                 class="form-control @error('category_name') is-invalid @enderror"
                                                 id="category_name"
                                                 value="{{ !empty($categoryData)? $categoryData['category_name'] : old('category_name') }}"
                                                 placeholder="Enter Category Name">
                                          @error('category_name')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                      </div>
                                      {{--category level--}}
                                      <div id="appendCategoriesLevel">
                                          @include('admin.categories.append_categories_level')
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Select Section</label>
                                          <select name="section_id" id="section_id"
                                                  class="form-control select2 @error('section_id') is-invalid @enderror"
                                                  style="width: 100%;">
                                              <option selected="selected">--Select--</option>
                                              @foreach( $getSections as $section)
                                                  <option value="{{ $section->id }}"
                                                       @if(!empty($categoryData))
                                                       @if(!empty($categoryData['section_id'] && $categoryData['section_id'] === $section->id)) selected @endif
                                                       @endif
                                                  >
                                                      {{ $section->name }}
                                                  </option>
                                              @endforeach
                                          </select>
                                          @error('section_id')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Category Image</label>
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file"  name="image"
                                                         class="form-control @error('image') is-invalid @enderror"
                                                         id="image">
                                                  <label for="image" class="custom-file-label">Choose file</label>
                                                  @error('image')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </div>
                                              <div class="input-group-append">
                                                  <span class="input-group-text">Upload</span>
                                              </div>
                                          </div>
                                          @if(!empty($categoryData['image']))
                                              <div >
                                                  <img src="{{ asset($categoryData['image']) }}" alt="" style="margin-top: 5px; width: 60px">
                                                  &nbsp;
                                                  <a {{--href="{{ route('delete.category.image', $categoryData['id']) }}"--}}
                                                     href="javascript:void (0)" class="confirmDelete" record="category-image" recordid="{{ $categoryData['id'] }}"
                                                  >
                                                      Delete image
                                                  </a>
                                              </div>
                                          @endif
                                      </div>
                                  </div>
                                  <!-- /.col -->
                              </div>
                              <!-- /.row -->

                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Category Discount</label>
                                          <input type="text"  name="category_discount"
                                                 class="form-control @error('category_discount') is-invalid @enderror"
                                                 id="category_discount"
                                                 value="{{!empty($categoryData)? $categoryData['category_discount'] : old('category_discount')}}"
                                                 placeholder="Enter Category discount">
                                          @error('category_discount')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="description">Category Description</label>
                                          <input id="description" type="hidden" name="description"
                                          value=" {{ !empty($categoryData)? $categoryData['description'] : old('description') }}"
                                                 class="form-control @error('description') is-invalid @enderror">
                                          <trix-editor input="description"></trix-editor>
                                          @error('description')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="url">Category Url</label>
                                          <input type="text"  name="url"
                                                 class="form-control @error('url') is-invalid @enderror" id="url"
                                                 value="{{ !empty($categoryData)? $categoryData['url'] : old('url') }}"
                                                 placeholder="Enter Category Url">
                                          @error('url')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="meta_title">Meta Title</label>
                                          <input type="text" name="meta_title" id="meta_title"
                                                 class="form-control @error('meta_title') is-invalid @enderror"
                                                 placeholder="Enter Meta Title"
                                          value="{{ !empty($categoryData)? $categoryData['meta_title'] : old('meta_title') }}">
                                          @error('meta_title')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Meta Keywords</label>
                                          <input id="meta_keywords" type="hidden"
                                                 name="meta_keywords"
                                                value="{{ !empty($categoryData)? $categoryData['meta_keywords'] : old('meta_keywords') }}"
                                                 class="form-control @error('meta_keywords') is-invalid @enderror">
                                          <trix-editor input="meta_keywords"></trix-editor>
                                          @error('meta_keywords')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Meta Description</label>
                                          <input id="meta_description" type="hidden" name="meta_description"
                                              value="{{ !empty($categoryData)? $categoryData['meta_description'] : old('meta_description') }}"
                                              class="form-control @error('meta_description') is-invalid @enderror">
                                          <trix-editor input="meta_description" ></trix-editor>
                                          @error('meta_description')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                              </div>
                              <!-- /.row -->
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit" class="btn btn-sm btn-success">
                                  {{ empty($categoryData) ? 'Submit' : 'Update' }}
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
