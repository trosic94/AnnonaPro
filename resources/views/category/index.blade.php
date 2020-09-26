@extends ('includes.page')

@section ('content')

<div id="pageWrap">
	<div id="bannerWrap">
				@foreach($banners_homeWide as $bKey => $banner)
					<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}"></a>
				}
				}
				@endforeach
		
	</div>
	@include('includes.breadcrumb')

	<div class="row mt-5" >

		<div class="col-lg-3">
			
			@include ('includes.left')

		</div>

		<div class="col-lg-9">
			
			{{-- <div class="mainTitle mt-3 mt-lg-0 pl-4 pl-lg-0 pr-4 pr-lg-0">
				<h1>{{ $category->name }}</h1>
			</div> --}}

			<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0">

				@foreach ($allProducts as $key => $prod)
					@include('layouts.product', ['prod' => $prod])
				@endforeach

			</div>
			<div class="row">
				<div id="paginateBlock">
					{{ $allProducts->links() }}
				</div>
			</div>

		</div>

	</div>



</div>

@php
    // echo '<pre class="white">';
    // print_r($allProducts);
    // echo '</pre>';
@endphp

@endsection