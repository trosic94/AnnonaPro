					<div id="relatedProductsWrap" class="row">
						
						<div class="col-xl-12 pb-3">

							<h3 id="blockTitle">@lang('shop.title_related_products')</h3>

							<div id="relatedSlider" class="row">

								@foreach ($relatedProducts as $key => $prod)
									@if ($key < 4)
										@include('layouts.product')
									@endif
								@endforeach

							</div>

		          		</div>

		          	</div>


@php
// echo count($relatedProducts).'<br>';
// echo '<pre>';
// print_r($relatedProducts);
// echo '</pre>';
@endphp

<script type="text/javascript">
$(document).ready(function(){

$('.animated').removeClass('col-md-3');

  $('#relatedSlider').slick({
    arrows: false,
    dots: true,
    draggable: true,
    infinite: false,
    autoplay: true,
    autoplaySpeed: 4000,
    slidesToShow: 4,
    slidesToScroll: 4,
    row: 0,
    responsive: [
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
      }
    ]
  }).on('setPosition', function (event, slick) {
      slick.$slides.css('height', slick.$slideTrack.height() + 'px');
  });

});
</script>

<link rel="stylesheet" type="text/css" href="{{ URL::to('/css/slick.css') }}">
<script type="text/javascript" src="{{ URL::to('/js/slick.min.js') }}"></script>