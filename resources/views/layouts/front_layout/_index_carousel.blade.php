
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
           @foreach($banners as $key => $banner)
                @if(!empty($banner['image']) && file_exists('images/banner_image/'.$banner['image']))
                <div class="item
                    @if($key === 0)
                    'active'
                @endif
                    ">
                    <div class="container">
                        <a @if(!empty( $banner['link'])) href="{{ $banner['link'] }}" @else href="javascript:void(0)" @endif
                        ><img style="width:100%" src="{{ asset('images/banner_image/'.$banner['image']) }}" alt="{{ $banner['alt'] }}" title="{{ $banner['title'] }}" />
                        </a>
                        <div class="carousel-caption">
                            <h4></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
                @endif
           @endforeach
        </div>
        @if(count($banners) > 1)
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        @endif
    </div>
</div>
