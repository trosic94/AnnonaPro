@extends ('includes.master')

@section ('pageContent')

<content>

<div class="container-fluid">

	<div class="row">

		<div class="col col-lg-0 m-0 p-0">
			
			@if (count($banners['left']) > 0)
			<div id="bannerWrap">

				@foreach($banners['left']->random(1) as $bKey => $banner)
					<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}"></a>
				@endforeach

			</div>
			@endif

		</div>

		<div class="col-xl-8 col-lg-12 p-0 minWidth">

			@yield('content')



		</div>

		<div class="col col-lg-0 m-0 p-0">

			@if (count($banners['right']) > 0)
			<div id="bannerWrap">

				@foreach($banners['right']->random(1) as $bKey => $banner)
					<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}"></a>
				@endforeach

			</div>
			@endif

		</div>
		

	</div>

</div>

</content>

<script type="text/javascript">
$( document ).ready(function() {



});
</script>

@endsection