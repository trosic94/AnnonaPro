@extends ('includes.page')

@section ('content')

<div id="pageWrap">
	<div id="bannerWrap">
			@foreach($banners_homeWide->random(1) as $bKey => $banner)
			{{"radd"}}
				<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}"></a>
			}
			}
			@endforeach
		
	</div>
	@include('includes.breadcrumb')
	
	<div class="row">

		<div class="col-lg-3">

			@include ('includes.left')

		</div>

		<div class="col-lg-9">
			
{{-- 			<div class="mainTitle mt-3 mt-lg-0 pl-4 pl-lg-0 pr-4 pr-lg-0">
				<h1>
					{{ $currentCAT->name }}  --}}
					{{-- @lang('shop.title_search') --}}
				{{-- </h1>
			</div>
 --}}
			<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0">

			@if (!$searchREZ->isEmpty())

				@foreach ($searchREZ as $key => $prod)
		        	@include('layouts.product', ['prod' => $prod])
				@endforeach

			</div>
			<div class="row">
				<div id="paginateBlock">
					{{ $searchREZ->appends(Request::except('page'))->links() }}
				</div>
			</div>

			@else

				<div class="col-xl-12">
					<h4>@lang('shop.title_search_no_result')</h4>
				</div>

			@endif

		</div>

	</div>
@php
    // echo '<pre class="text-white">';
    // print_r($currentCAT);
    // print_r($searchREZ);
    // echo '</pre>';
@endphp

</div>

@endsection