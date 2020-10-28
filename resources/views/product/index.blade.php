@extends ('includes.page')

@section ('content')

<div id="pageWrap">

	@include('includes.breadcrumb')
	<div class="row">
			<div class="col-10 mt-2">
				<div class="mainTitle">
					<h1>{{ $productDATA->prod_title }}</h1>
				</div>
			</div>
		</div>

	<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0  mb-5">
	
		
			{{-- IMAGE --}}
			<div class="col-md-6">
				
				  <div class="row m-0">
				  	<div class="row col-7">
				  		<div class="row align-items-center">
				  			<a href="/storage/products/{{$productDATA->prod_image}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-12">
						      <img src="/storage/products/{{$productDATA->prod_image}}" class="img-fluid rounded">
						    </a>
				  		</div>
				  	</div>
				  	<div class="row col-5">
				  		@isset ($productImages[0]['image'])
				  		<div class="row align-items-start m-1">
				  			<a href="/storage/{{$productImages[0]['image']}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-12">
					          <img src="/storage/{{$productImages[0]['image']}}" class="img-fluid rounded">
						    </a>
				  		</div>
				  		@endisset
				  		@isset ($productImages[1]['image'])
				  		<div class="row align-items-end m-1">
				  			<a href="/storage/{{$productImages[1]['image']}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-12">
						      <img src="/storage/{{$productImages[1]['image']}}" class="img-fluid rounded">
						    </a>
				  		</div>
				  		@endisset
				  	</div>
				  </div>
			</div>
			{{-- IMAGE --}}

			<div class="col-md-6  mt-md-0 p-0 m-0">
				<div class="row m-0">
					@include ('product.tabs', ['productDATA' => $productDATA,'favLIST'=>$favLIST]) 
				</div>
				
			</div>
	</div>

  	{{-- RATING --}}
  	@if (setting('shop.rating') != 0 || setting('shop.rating_comments') != 0)
  	@include ('product.rating')
  	@endif
  	{{-- RATING --}}


	@if (!$relatedProducts->isEmpty())
	<div class="row">

		<div class="col-xl-12">
		  	{{-- RELATED PRODUCTS --}}
		  	@include ('product.related')
		  	{{-- RELATED PRODUCTS --}}
		</div>

	</div>
	@endif


	{{-- TABs --}}
	{{-- @include ('product.tabs') --}}
	{{-- TABs --}}




@php
     // echo '<pre>';
     // print_r($productDATA);
     // echo '</pre>';
@endphp
	<script>
		$(document).on("click", '[data-toggle="lightbox"]', function(event) {
		  event.preventDefault();
		  $(this).ekkoLightbox();
		});

		
	</script>
</div>

@endsection
