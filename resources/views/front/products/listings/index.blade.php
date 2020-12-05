@extends('layouts.front_layout.front_layout')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">{!! $categoryDetails['breadcrumbs'] !!}</li>
        </ul>
        <h3> {{ $categoryDetails['catDetails']['category_name'] }} <small class="pull-right">{{count($categoryProduct)}} products are available </small></h3>
        <hr class="soft"/>
        <p>
            {!! $categoryDetails['catDetails']['description'] !!}
        </p>
        <hr class="soft"/>
        <form class="form-horizontal span6" id="sortProduct" name="sortProduct">
            <input type="hidden" name="url" value="{{ $url }}" id="url">
            <div class="control-group">
                <label class="control-label alignL">Sort By </label>
                <select name="sort" id="sort">
                    <option value="">Select</option>
                    <option value="product_latest"{{ isset($_GET['sort'])&&$_GET['sort']=='product_latest'? 'selected':'' }}>Latest Products</option>
                    <option value="product_name_a_z"{{ isset($_GET['sort'])&&$_GET['sort']=='product_name_a_z'? 'selected':'' }}>Product name A - Z</option>
                    <option value="product_name_z_a"{{ isset($_GET['sort'])&&$_GET['sort']=='product_name_z_a'? 'selected':'' }}>Product name Z - A</option>
                    <option value="product_highest_price"{{ isset($_GET['sort'])&&$_GET['sort']=='product_highest_price'? 'selected':'' }}>Price highest price</option>
                    <option value="product_lowest_price"{{ isset($_GET['sort'])&&$_GET['sort']=='product_lowest_price'? 'selected':'' }}>Price Lowest price</option>
                </select>
            </div>
        </form>

        <div id="myTab" class="pull-right">
            <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="fas fa-list"></i></span></a>
            <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="fas fa-th-large"></i></span></a>
        </div>
        <br class="clr"/>
        <div class="tab-content filter_products">
            @include('front.products.listings.product_ajax_listings')
        </div>
        <a href="compair.html" class="btn btn-small pull-right">Compair Product</a>
        <div class="pagination">
            <div>{{ (isset($_GET['sort']) && !empty($_GET['sort'])) ? $categoryProduct->appends(['sort' => $_GET['sort']])->links() : $categoryProduct->links()}}</div>
        </div>
        <br class="clr"/>
    </div>
@stop
