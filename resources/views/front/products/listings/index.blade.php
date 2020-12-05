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
        <form class="form-horizontal span6" id="sortProduct">
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
        <div class="tab-content">
            <div class="tab-pane" id="listView">
                @foreach($categoryProduct as $key => $product)
                <div class="row">
                    <div class="span2">
                        @if(!empty($product['main_image']) && file_exists('images/product_image/small/'.$product['main_image']))
                            <img src="{{ asset('images/product_image/small/'.$product['main_image']) }}" alt="" >
                        @else
                            <img src="{{ asset('images/product_image/small/small-no-image.png')}}" >
                        @endif
                    </div>
                    <div class="span4">
                        <h3>{{ $product['brand']['name'] }}</h3>
                        <hr class="soft"/>
                        <h5>{{ $product['product_name'] }}</h5>
                        <p>
                          {!! $product['description'] !!}
                        </p>
                        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                        <br class="clr"/>
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3>&#8358;.{{$product['product_price']}}</h3>
                            <label class="checkbox">
                                <input type="checkbox">  Adds product to compair
                            </label><br/>

                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" fas fa-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="fa fa-search"></i></a>

                        </form>
                    </div>
                </div>
                <hr class="soft"/>
                @endforeach
            </div>
            <div class="tab-pane  active" id="blockView">
                <ul class="thumbnails">
                    @foreach($categoryProduct as $key => $product)
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="product_details.html">
                                    @if(!empty($product['main_image']) && file_exists('images/product_image/small/'.$product['main_image']))
                                        <img src="{{ asset('images/product_image/small/'.$product['main_image']) }}" alt="" style="width: 140px">
                                    @else
                                        <img src="{{ asset('images/product_image/small/small-no-image.png')}}" style="width: 140px">
                                    @endif
                                </a>
                                <div class="caption">
                                    <h5>{{ $product['product_name'] }}</h5>
                                    <p>
                                       {{ $product['brand']['name'] }}
                                    </p>
                                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="fa fa-search"></i></a> <a class="btn" href="#">Add to <i class="fas fa-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&#8358;.{{$product['product_price']}}</a></h4>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <hr class="soft"/>
            </div>
        </div>
        <a href="compair.html" class="btn btn-small pull-right">Compair Product</a>
        <div class="pagination">
            <div>{{ (isset($_GET['sort']) && !empty($_GET['sort'])) ? $categoryProduct->appends(['sort' => $_GET['sort']])->links() : $categoryProduct->links()}}</div>
        </div>
        <br class="clr"/>
    </div>
@stop
