@extends ('includes.page')

@section ('content')

<div id="pageWrap">
	@include('includes.breadcrumb')

	<div class="row mt-5 mb-5" >
		<div class="col-3">
			@include ('edukacija.left')
		</div>
		<div class="col-9">
			<div id="bannerWrap">
						<img src="/storage/{{$Post['image']}}" class="img-fluid" alt="Responsive image">
			</div>
			<div class="mt-5">
				<label class="text-primary">{{$Post['title']}}</label>		
			</div>
			<div class=" text-secondary">
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