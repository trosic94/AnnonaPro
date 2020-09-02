@extends ('includes.page')

@section ('content')

<div id="pageWrap">

	@include('includes.breadcrumb')

	<div class="row pr-4">

		<div class="col-lg-3">
			
			@include ('includes.left')

		</div>

		<div class="col-lg-9">
			
			<div class="mainTitle mt-3 mt-lg-0 pl-4 pl-lg-0 pr-4 pr-lg-0">
				<h1>{{ $category->name }}</h1>
			</div>

			<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0">

				@foreach ($allProducts as $key => $prod)
				<div class="col-md-4 pl-2 pl-lg-0 pr-2 pr-lg-0 pb-4 d-flex wow animated fadeIn">
			          <div class="prodOne white pl-0 pr-0 ml-2 mr-2 text-default">

			            <div class="imgWrap">
			            	@if ($prod->sop_count > 0)
			            		<div class="akcijaNOTE">@lang('shop.title_action')</div>
			            	@endif
			              <a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->prod_slug }}"><img src="/storage/products/{{ ($prod->prod_image != null)? $prod->prod_image:'no_image.jpg' }}" alt="{{ $prod->prod_title }}" class="img100"></a>
			            </div>

			            <h3><a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->prod_slug }}">{{ $prod->prod_title }}</a></h3>

			            <div class="prodFooter">

			              <div class="priceWrap">
			              	@if ($prod->prod_price_with_discount != null)
				                <span class="fullPrice">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
				                <span class="discountPrice">{{ number_format($prod->prod_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
			                @else
			                	<span class="singlePrice">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
			                @endif
			              </div>

			              <div class="row">
			              	<div class="col">
			              		<div id="addTo_FAV" class="prod_{{ $prod->prod_id }}" onclick="FavEvent({{ $prod->prod_id }})">
			                      <i class="far fa-heart fa-2x red-text {{ (in_array($prod->prod_id,$favLIST))? 'd-none':'d-block' }}"></i>
			                      <i class="fas fa-heart fa-2x red-text {{ (in_array($prod->prod_id,$favLIST))? 'd-block':'d-none' }}"></i>
			              		</div>
			              	</div>
			              	<div class="col"><div id="addTo_CART" class="rounded-pill yellow btnBuy" onclick="CartEvent({{ $prod->prod_id }})"><i class="fas fa-shopping-cart"></i> @lang('shop.btn_buy')</div></div>
			              </div>

			            </div>

			          </div>
		        </div>
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