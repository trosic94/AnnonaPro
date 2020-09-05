<div id="row_1">
	
	<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0">

		<div class="col-lg-6">

			@if (!$banners_homeRow_1->isEmpty())
			<div id="bannerWrap">

				@foreach($banners_homeRow_1 as $bKey => $banner)
					<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}"></a>
				@endforeach

			</div>
			@endif

		</div>
		<div class="col-lg-6 mt-3 mt-lg-0">
			@if (!$banners_homeRow_2->isEmpty())
			<div id="bannerWrap">

				@foreach($banners_homeRow_2 as $bKey => $banner)
					<a href="{{ $banner->ban_url }}" target="{{ $banner->ban_target }}" title="{{ $banner->ban_name }}" onclick="clickCount(event,{{ $banner->ban_id }},{{ $banner->ban_position_id }},'{{ $banner->ban_url }}','{{ $banner->ban_target }}')"><img src="/storage/banners/{{ $banner->ban_image }}" alt="{{ $banner->ban_name }}"></a>
				@endforeach

			</div>
			@endif

		</div>

		{{-- <div class="col-lg-6">

			<div class="row">

	        @foreach($productsFor_Row1 as $key => $prod)

	        	@if ($prod->sop_id == 5)

	        	@php
	        		$boxBadge = trans('shop.title_action');
	        	

	        	foreach($productsFor_Row1 as $bKey => $badgeTitle):

	        		if ($badgeTitle->sop_id != 5 && $badgeTitle->p_id == $prod->p_id):
	        			$boxBadge = $badgeTitle->so_title;
	        		endif;

	        	endforeach;

	        	@endphp

		        <div class="col-md-6 pl-2 pl-lg-0 pr-2 pr-lg-0 mt-3 m-lg-0 d-flex wow animated fadeIn">
			          <div class="prodOne white pl-0 pr-0 ml-2 mr-2 text-default">

			            <div class="imgWrap">
			              <div class="akcijaNOTE">{{ $boxBadge }}</div>
			              <a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->p_slug }}"><img src="/storage/products/{{ ($prod->p_image != null)? $prod->p_image:'no_image.jpg' }}" alt="{{ $prod->p_title }}" class="img100"></a>
			            </div>

			            <h3><a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->p_slug }}">{{ $prod->p_title }}</a></h3>

			            <div class="prodFooter">

			              <div class="priceWrap">
			              	@if ($prod->p_product_price_with_discount != null)
				                <span class="fullPrice">{{ number_format($prod->p_product_price,0,"",".") }} {{ setting('site.valuta') }}</span>
				                <span class="discountPrice">{{ number_format($prod->p_product_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
			                @else
			                	<span class="singlePrice">{{ number_format($prod->p_product_price,0,"",".") }} {{ setting('site.valuta') }}</span>
			                @endif
			              </div>

			                <div class="row">
			                  <div class="col">
			                    <div id="addTo_FAV" class="prod_{{ $prod->p_id }}" onclick="FavEvent({{ $prod->p_id }})">
			                      <i class="far fa-heart fa-2x red-text {{ (in_array($prod->p_id,$favLIST))? 'd-none':'d-block' }}"></i>
			                      <i class="fas fa-heart fa-2x red-text {{ (in_array($prod->p_id,$favLIST))? 'd-block':'d-none' }}"></i>
			                    </div>
			                  </div>
			                  <div class="col"><div id="addTo_CART" class="rounded-pill yellow btnBuy" onclick="CartEvent({{ $prod->p_id }})"><i class="fas fa-shopping-cart"></i> @lang('shop.btn_buy')</div></div>
			                </div>
			            </div>

			          </div>
		        </div>

		        @endif

	        @endforeach

			</div>

		</div> --}}

	</div>

@php
// echo '<pre class="text-white">';
// print_r($productsFor_Row1);
// echo '</pre>';
@endphp


</div>