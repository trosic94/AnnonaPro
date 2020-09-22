@extends ('includes.page')

@section ('content')

<div id="pageWrap">

	<div class="row mt-5">

		<div class="col-lg-12">
			
			<div class="mainTitle pl-4 pl-xl-0 pr-4 pr-xl-0">
				<h1>@lang('shop.title_favourites')</h1>
			</div>

			<div class="row pl-4 pl-xl-0 pr-4 pr-xl-0">

				@if ($productsFor_FAV->isEmpty())
					<div class="col-lg-12">
						@lang('shop.title_favourites_none_note')
					</div>
				@endif

				@foreach ($productsFor_FAV as $key => $prod)
		        	@include('layouts.product', ['prod' => $prod])
				@endforeach

			</div>
			<div class="row">
				<div id="paginateBlock">
					{{ $productsFor_FAV->links() }}
				</div>
			</div>

		</div>

	</div>
	
@php
    //echo '<pre class="text-white">';
    //print_r($productsFor_FAV);
    //echo '</pre>';
@endphp

</div>

@endsection