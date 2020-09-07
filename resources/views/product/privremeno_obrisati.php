<div id="productDATA">

			<form id="addToCart" method="POST" action="/add-to-cart" enctype="multipart/form-data">

				{{-- TITLE / FAV --}}
				<div class="row">

					<div class="col-10">
						<div class="mainTitle">
							<h1>{{ $productDATA->prod_title }}</h1>
						</div>
					</div>
					<div class="col-2 text-right">
	                    <div id="addTo_FAV" class="prod_{{ $productDATA->prod_id }}" onclick="FavEvent({{ $productDATA->prod_id }})">
			                      <i class="far fa-heart fa-2x red-text {{ (in_array($productDATA->prod_id,$favLIST))? 'd-none':'d-block' }}"></i>
			                      <i class="fas fa-heart fa-2x red-text {{ (in_array($productDATA->prod_id,$favLIST))? 'd-block':'d-none' }}"></i>
	                    </div>
					</div>

				</div>
				{{-- TITLE / FAV --}}

				{{-- PUBLISHER / STOCK --}}
				<div class="row">

					<div class="col-lg-6">

						<label>@lang('shop.title_category'):</label><span>{{ $productDATA->cat_name }}</span>

					</div>
					<div class="col-lg-6">
						
						<label>@lang('shop.title_code'):</label><span>{{ $productDATA->prod_sku }}</span>

					</div>

					<div class="col-lg-6">

						<label>@lang('shop.title_publisher'):</label><span>{{ $productDATA->mnf_name }}</span>

					</div>
					<div class="col-lg-6">
						
						<label>@lang('shop.title_available'):</label><span>{{ ($productDATA->prod_status == 1)? trans('shop.title_on_stock'):trans('shop.title_not_on_stock') }}</span>

					</div>

				</div>
				{{-- PUBLISHER / STOCK --}}

				{{-- ATTRIBUTES --}}
				@if (count($selectedAttributes) > 0)

					@include ('product.attributes')

				@endif
				{{-- ATTRIBUTES --}}

				<div id="prodFooterWrap" class="{{ (count($selectedAttributes) == 0)? 'alignElementToBottom':'' }}">

					{{-- PRICE --}}
					@include ('product.price')
		          	{{-- PRICE --}}

		          	{{-- BUY --}}
		          	@include ('product.buy')
		          	{{-- BUY --}}

	          	</div>

			</form>

			</div>