@extends ('includes.page')

@section ('content')

<div id="pageWrap">
	@include('includes.breadcrumb')

	<div class="row mt-5 mb-5" >
		<div class="col-lg-3 col-md-3 col-xs-12 ml-3 ml-md-0">
			@include ('edukacija.left')
		</div>
		<div class="col-lg-9 col-md-9 col-xs-12">
			<div id="bannerWrap">
						<img src="/storage/{{$Post['image']}}" class="img-fluid" alt="Responsive image">
			</div>
			<div class="mt-4 p-2 p-md-0 font-weight-bold">
				<label class="text-primary">{{$Post['title']}}</label>		
			</div>
			<div class=" text-secondary p-2 p-md-0">
				{!! $Post['body'] !!}
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