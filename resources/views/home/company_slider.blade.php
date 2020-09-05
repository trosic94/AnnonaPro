<div id="row_1 " class="container-fluid minWidth p-0">
	
	<div class="slider_company d-flex justify-content-center">

		<div class="col-lg-12">

			@if (!$banners_homeRow_3->isEmpty())
			<div id="slideWrap">

                @foreach($banners_homeRow_3 as $bKey => $banner)
                <div>
                    <a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')">
                        <img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}" class="img-fluid">
                    </a>
                </div>
				@endforeach

			</div>
			@endif

		</div>


    </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#slideWrap').slick({
                dots: false,
                arrows: false,
                infinite: true,
                speed: 600,
                autoplay: true,
                autoplaySpeed: 3000,
                slidesToShow: 6,
                slidesToScroll: 4,
                responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                    },
                    {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                    },
                    {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
                }).on('setPosition', function (event, slick) {
                    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
            });			
        });
    </script>

@php
// echo '<pre class="text-white">';
// print_r($productsFor_Row1);
// echo '</pre>';
@endphp


</div>