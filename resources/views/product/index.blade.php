@extends ('includes.page')

@section ('content')

<div id="pageWrap">

	@include('includes.breadcrumb')
	<div class="row">
			<div class="col-10">
						<div class="mainTitle">
							<h1>{{ $productDATA->prod_title }}</h1>
						</div>
					</div>
		</div>
	<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0 mt-5">
	

		{{-- IMAGE --}}
		<div class="col-md-5">

			<div class="container">
			  <div class="row">
			    <a href="https://unsplash.it/1200/768.jpg?image=251" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
			      <img src="https://unsplash.it/600.jpg?image=251" class="img-fluid rounded">
			    </a>
			    <a href="https://unsplash.it/1200/768.jpg?image=252" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
			      <img src="https://unsplash.it/600.jpg?image=252" class="img-fluid rounded">
			    </a>
			    <a href="https://unsplash.it/1200/768.jpg?image=253" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
			      <img src="https://unsplash.it/600.jpg?image=253" class="img-fluid rounded">
			    </a>
			  </div>
			  <div class="row">
			    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
			      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">
			    </a>
			    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
			      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">
			    </a>
			    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
			      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">
			    </a>
			  </div>
			</div>
			{{-- <img src="/storage/products/{{ $productDATA->prod_image }}" class="img100" alt="{{ $productDATA->prod_title }}"> --}}

		</div>
		{{-- IMAGE --}}

		<div class="col-md-7 mt-5 mt-md-0">

			

		</div>

	</div>


	{{-- TABs --}}
	{{-- @include ('product.tabs') --}}
	{{-- TABs --}}




@php
     // echo '<pre style="color: white;">';
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
