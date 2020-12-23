@extends('layouts.front_layout.front_layout')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front.index') }}">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ route('front.listings.index',$productDetail->category->url) }}">{{ $productDetail->category->category_name }}</a> <span class="divider">/</span></li>
            <li class="active">{{ $productDetail->product_name }}</li>
        </ul>
        <div class="row">
            <div id="gallery" class="span3">
                <a href="{{ asset('images/product_image/large/'.$productDetail->main_image) }}" title="Blue Casual T-Shirt">
                    <img src="{{ asset('images/product_image/large/'.$productDetail->main_image) }}" style="width:100%" alt="Blue Casual T-Shirt"/>
                </a>
                <div id="differentview" class="moreOptopm carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($productDetail->product_images as $key => $images)
                                <a href="{{ asset('images/product_image/large/'.$images->image) }}">
                                    <img style="width:15%" src="{{ asset('images/product_image/large/'.$images->image)  }}" alt=""/>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!--
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                    -->
                </div>

                <div class="btn-toolbar">
                    <div class="btn-group">
                        <span class="btn"><i class="fas fa-envelope"></i></span>
                        <span class="btn" ><i class="fas fa-print"></i></span>
                        <span class="btn" ><i class="fas fa-search"></i></span>
                        <span class="btn" ><i class="fas fa-star"></i></span>
                        <span class="btn" ><i class=" fas fa-thumbs-up"></i></span>
                        <span class="btn" ><i class="fas fa-thumbs-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="span6">
                <h3>{{ $productDetail->product_name }} </h3>
                <small>- {{ $productDetail->brand->name }}</small>
                <hr class="soft"/>
                <small class="stockBySize" id="stock">{{ $stock }} items in stock</small>
                <form class="form-horizontal qtyFrm">
                    <div class="control-group">
                        <h4 class="attribute_price">&#8358;.{{ $productDetail->product_price }}</h4>
                        <select class="span2 pull-left" id="GetPriceBySize" name="size_by_price" productId="{{ $productDetail->id }}">
                            <option value="">--Select Size--</option>
                            @foreach($productDetail->attributes as $key => $attribute)
                                <option value="{{  $attribute->size }}">{{  $attribute->size }}</option>
                            @endforeach
                        </select>
                        <input type="number" class="span1" placeholder="Qty." min="0" id="qty" product-id="{{ $productDetail->id }}"/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" fas fa-shopping-cart"></i></button>
                    </div>
                </form>
                <hr class="soft clr"/>
                <p class="span6">
                    {!! $productDetail->description !!}
                </p>
                <a class="btn btn-small pull-right" href="#detail">More Details</a>
                <br class="clr"/>
                <a href="#" name="detail"></a>
                <hr class="soft"/>
            </div>

            <div class="span9">
                <ul id="productDetail" class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                    <li><a href="#profile" data-toggle="tab">Related Products</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                        <h4>Product Information</h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{ $productDetail->brand->name }}</td></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{ $productDetail->product_code}}</td></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{ $productDetail->product_color }}</td></tr>
                            @if(!empty($productDetail->fabric ))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{ $productDetail->fabric }}</td></tr>
                            @endif
                            @if(!empty($productDetail->pattern ))
                            <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{ $productDetail->pattern }}</td></tr>
                            @endif
                            @if(!empty($productDetail->fit ))
                                <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{ $productDetail->fit }}</td></tr>
                            @endif
                            @if(!empty($productDetail->slevee))
                            <tr class="techSpecRow"><td class="techSpecTD1">Slevee:</td><td class="techSpecTD2">{{ $productDetail->slevee }}</td></tr>
                            @endif
                            </tbody>
                        </table>

                        <h5>Washcare</h5>
                        <p>Machine Wash</p>
                        <h5>Disclaimer</h5>
                        <p>
                            There may be a slight color variation between the image shown and original product.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <div id="myTab" class="pull-right">
                            <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="fas fa-list"></i></span></a>
                            <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="fas fa-th-large"></i></span></a>
                        </div>
                        <br class="clr"/>
                        <hr class="soft"/>
                        <div class="tab-content">
                            <div class="tab-pane" id="listView">
                                @foreach($randomProducts as $key => $randomProduct)
                                <div class="row">
                                    <div class="span2">
                                        <img src="{{ asset('images/product_image/large/'.$randomProduct->main_image) }}" alt=""/>
                                    </div>
                                    <div class="span4">
                                        <h3>New | Available</h3>
                                        <hr class="soft"/>
                                        <h5>{{  $randomProduct->product_name }}</h5>
                                        <p class="text-truncate">
                                           {!! $randomProduct->description !!}
                                        </p>
                                        <a class="btn btn-small pull-right" href="{{ route('front.product.show',[$randomProduct->id,$randomProduct->product_code]) }}">View Details</a>
                                        <br class="clr"/>
                                    </div>
                                    <div class="span3 alignR">
                                        <form class="form-horizontal qtyFrm">
                                            <h3> &#8358;.{{  $randomProduct->product_price }}</h3>
                                            <label class="checkbox">
                                                <input type="checkbox">  Adds product to compair
                                            </label><br/>
                                            <div class="btn-group">
                                                <a href="{{ route('front.product.show',[$randomProduct->product_code,$randomProduct->id]) }}" class="btn btn-large btn-primary"> Add to <i class=" fas fa-shopping-cart"></i></a>
                                                <a href="product_details.html" class="btn btn-large"><i class="fas fa-search"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr class="soft"/>
                                @endforeach
                            </div>
                            <div class="tab-pane active" id="blockView">
                                <ul class="thumbnails">
                                    @foreach($randomProducts as $key => $randomProduct)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="{{ route('front.product.show',[$randomProduct->id,$randomProduct->product_code]) }}"><img src="{{ asset('images/product_image/large/'.$randomProduct->main_image) }}" alt=""/></a>
                                            <div class="caption">
                                                <h5>{{ $randomProduct->product_name }}</h5>
                                                <p class="text-truncate">
                                                    {!! $randomProduct->description !!}
                                                </p>
                                                <h4 style="text-align:center"><a class="btn" href="{{ route('front.product.show',[$randomProduct->product_code,$randomProduct->id]) }}">
                                                        <i class="fas fa-search"></i></a> <a class="btn" href="#">Add to
                                                        <i class="fas fa-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&#8358;.{{ $randomProduct->product_price }}</a></h4>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <hr class="soft"/>
                            </div>
                        </div>
                        <br class="clr">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
