@extends('layouts.front_layout.front_layout')

@section('carousel')
    @include('layouts.front_layout._index_carousel')
@endsection
@section('content')

    <div class="span9">
        <div class="well well-small">
            <h4>Featured Products <small class="pull-right">{{ \App\Product::featureCount() }}+ featured products</small></h4>
            <div class="row-fluid">
                <div id="featured" class="@if(\App\Product::featureCount() > 4)  carousel slide @endif">
                    <div class="carousel-inner">
                        @foreach( $featureChunk as $key => $featuresItem)
                        <div class="item @if($key ==1) active @endif">
                            <ul class="thumbnails">
                                @foreach($featuresItem as $item)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>
                                        <a href="product_details.html">
                                            @if(!empty($item['main_image']) && file_exists('images/product_image/small/'.$item['main_image']))
                                                <img src="{{ asset('images/product_image/small/'.$item['main_image']) }}" alt="">
                                            @else
                                                <img src="{{ asset('images/product_image/small/small-no-image.png')}}" >
                                            @endif
                                        </a>
                                        <div class="caption">
                                            <h5>{{ $item['product_name'] }}</h5>
                                            <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">&#8358;.{{ $item['product_price'] }}</span></h4>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>

{{--                        <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>--}}
{{--                        <a class="right carousel-control" href="#featured" data-slide="next">›</a>--}}

                </div>
            </div>
        </div>
        <h4>Latest Products </h4>
        <ul class="thumbnails">
            @foreach($newProducts as $newProduct)
            <li class="span3">
                <div class="thumbnail">
                    <a  href="product_details.html">
                        @if(!empty($newProduct['main_image']) && file_exists('images/product_image/small/'.$newProduct['main_image']))
                            <img src="{{ asset('images/product_image/small/'.$newProduct['main_image']) }}" alt="" >
                        @else
                            <img src="{{ asset('images/product_image/small/small-no-image.png')}}" >
                        @endif
                    </a>
                    <div class="caption">
                        <h5>{{ $newProduct['product_name'] }}</h5>
                        <p class="text-center">
                           {{ $newProduct['product_code'] }} .
                        </p>

                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="fa fa-search"></i></a> <a class="btn" href="#">Add to <i class="fas fa-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&#8358;.{{$newProduct['product_price']}}</a></h4>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

@endsection
