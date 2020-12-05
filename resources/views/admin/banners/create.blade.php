@extends('layouts.admin_layout.admin_layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Banner</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Banner</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <div class="card card-light">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ empty($bannerData) ? route('admin.banners.store') : route('admin.banners.update', $bannerData->id)}}" name="updateBanner"
                                  id="updateBanner" enctype="multipart/form-data">
                                @csrf
                                @if(!empty($bannerData))
                                    @method('PATCH')
                                @endif
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
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                                               placeholder="Enter banner title" required
                                               value="{{ !empty($bannerData) ? $bannerData->title : old('title')}}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Link</label>
                                        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link"
                                               placeholder="Enter banner link"
                                               value="{{ !empty($bannerData) ? $bannerData->link : old('link')}}">
                                        @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alt</label>
                                        <input type="text" name="alt" class="form-control @error('alt') is-invalid @enderror" id="alt"
                                               placeholder="Enter banner alternative text" required
                                               value="{{ !empty($bannerData) ? $bannerData->alt : old('alt')}}">
                                        @error('alt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">image</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image"
                                        {{ empty($bannerData) ? 'required' : ''}}>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if(isset($bannerData))
                                            @if(!empty($bannerData->image))
                                                <div >
                                                    <img src="{{ asset('images/banner_image/'.$bannerData->image) }}" alt="" style="margin-top: 7px; width: 50%">
                                                    &nbsp;
                                                    <a href="javascript:void (0)" class="confirmDelete" record="banner-image" recordid="{{ $bannerData->id }}"
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
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        {{ empty($bannerData) ? 'Add Banner' : 'Update Banner' }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection
