<div class="homeSlider">
	@foreach ($sliderHOME as $key => $slide)
	<div id="slideWrap">
		@if ($slide->url != null)
			<a href="{{ $slide->url }}" target="{{ $slide->url_target }}">
		@endif

			@if ($slide->text != null)
				<div class="slideContent">
					<h2>{{ $slide->title }}</h2>
					<div class="slideTXT">{{ $slide->text }}</div>
				</div>
			@endif

			<img src="/storage/slides/{{ $slide->image }}">

		@if ($slide->url != null)
			</a>
		@endif
	</div>
	@endforeach
</div>



<script type="text/javascript">
$(document).ready(function(){
  $('.homeSlider').slick({
	fade: true,
  	cssEase: 'linear',
  	arrows: false,
  	dots: true,
  	draggable: true,
  	infinite: true,
	autoplay: true,
	autoplaySpeed: 4000,
  	slidesToShow: 1
  });
});
</script>

@php
// echo '<pre>';
// print_r($sliderHOME);
// echo '</pre>';
@endphp