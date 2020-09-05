<div id="row_1 " class="row">
	
	<div class="slider_company">

		<div class="col-lg-12 ">

			@if (!$banners_homeRow_3->isEmpty())
			<div id="slideWrap ">

				@foreach($banners_homeRow_3 as $bKey => $banner)
					<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}" class="img-fluid"></a>
				@endforeach

			</div>
			@endif

		</div>


    </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
          $('.slider_company').slick({
            fade: true,
              cssEase: 'linear',
              arrows: true,
              dots: false,
              draggable: true,
              infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
              slidesToShow: 5
          });
        });
    </script>
@php
// echo '<pre class="text-white">';
// print_r($productsFor_Row1);
// echo '</pre>';
@endphp


</div>