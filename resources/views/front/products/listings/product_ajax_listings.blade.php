
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
                <a class="btn btn-small pull-right" href="{{ route('front.product.show',[$product['id'],$product['product_code']]) }}">View Details</a>
                <br class="clr"/>
            </div>
            <div class="span3 alignR">
                <form class="form-horizontal qtyFrm">
                    <h3>&#8358;.{{$product['product_price']}}</h3>
                    <label class="checkbox">
                        <input type="checkbox">  Adds product to compair
                    </label><br/>

                    <a href="{{ route('front.product.show',[$product['id'],$product['product_code']]) }}" class="btn btn-large btn-primary"> Add to <i class=" fas fa-shopping-cart"></i></a>
                    <a href="{{ route('front.product.show',[$product['id'],$product['product_code']]) }}" class="btn btn-large"><i class="fa fa-search"></i></a>

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
                    <a href="{{ route('front.product.show',[$product['id'],$product['product_code']]) }}">
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
                        <h4 style="text-align:center"><a class="btn" href="{{ route('front.product.show',[$product['id'],$product['product_code']]) }}"> <i class="fa fa-search"></i></a> <a class="btn" href="#">Add to <i class="fas fa-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&#8358;.{{$product['product_price']}}</a></h4>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>
