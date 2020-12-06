<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{ asset('images/front_image/ico-cart.png') }}" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($sections as $section)
            @if ( count($section->categories) > 0)
                <li class="subMenu"><a>{{ $section->name }}</a>
                    @foreach($section->categories as $category)
                        <ul>
                            <li><a href="{{route('front.listings.index',$category->url)}}"><i class="icon-chevron-right"></i><strong>{{ $category->category_name }}</strong></a></li>
                            @foreach($category->subcategories as $subcategory)
                            <li><a href="{{route('front.listings.index',$subcategory->url)}}">&nbsp;&nbsp;<i class="icon-chevron-right"></i>{{ $subcategory->category_name }}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </li>
            @endif
      @endforeach
    </ul>
    <br/>
    @if(request()->routeIs('front.listings.index'))
        <div class="well well-small">
            <h5><i class="fas fa-filter" aria-hidden="true"></i>Filter By</h5>
            <h5>Fabric</h5>
            @foreach($productFilters['fabricArray'] as $fabric)
                <input class="fabric" type="checkbox" value="{{ $fabric }}" name="fabric[]" id="{{ $fabric }}" style="margin-top: -3px">
                &nbsp;&nbsp;{{ $fabric }}<br>
            @endforeach
            <h5>Occasion</h5>
            @foreach($productFilters['occasionArray'] as $occasion)
                <input class="occasion" type="checkbox" value="{{ $occasion }}" name="occasion[]" id="{{ $occasion }}" style="margin-top: -3px">
                &nbsp;&nbsp;{{ $occasion }}<br>
            @endforeach
            <h5>Fit</h5>
            @foreach($productFilters['fitArray'] as $fit)
                <input class="fit" type="checkbox" value="{{ $fit }}" name="fit[]" id="{{ $fit }}" style="margin-top: -3px">
                &nbsp;&nbsp;{{ $fit }}<br>
            @endforeach
            <h5>Pattern</h5>
            @foreach($productFilters['patternArray'] as $pattern)
                <input class="pattern"  type="checkbox" value="{{ $pattern }}" name="pattern[]" id="{{ $pattern }}" style="margin-top: -3px">
                &nbsp;&nbsp;{{ $pattern }}<br>
            @endforeach
            <h5>Sleeve</h5>
            @foreach($productFilters['sleeveArray'] as $sleeve)
                <input class="sleeve" type="checkbox" value="{{ $sleeve }}" name="sleeve[]" id="{{ $sleeve }}" style="margin-top: -3px">
                &nbsp;&nbsp;{{ $sleeve }}<br>
            @endforeach
        </div>
    @endif
    <br />
    <div class="thumbnail">
        <img src="{{ asset('images/front_image/payment_methods.png') }}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
