@extends ('includes.page')

@section ('content')

<div id="pageWrap">

	@include('includes.breadcrumb')

	<div class="row pr-0 mr-md-4">

		<div class="col-lg-3">
			
			@include ('includes.left')

		</div>

		<div class="col-lg-9">
			
			<div class="mainTitle mt-3 mt-lg-0 pl-4 pl-lg-0 pr-4 pr-lg-0">
				<h1>{{ $currentCAT->name }}</h1>
			</div>

			<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0">

				@foreach ($productsFor_CAT as $key => $prod)
				<div class="col-md-4 pl-2 pl-lg-0 pr-2 pr-lg-0 pb-4 d-flex wow animated fadeIn">
			          <div class="prodOne white pl-0 pr-0 ml-2 mr-2 text-default">

			             <div class="imgWrap">
			            	<div class="row pr-3 pl-3">
				            	<div class="col">
				              		<div id="addTo_FAV" class="prod_{{ $prod->prod_id }}" onclick="FavEvent({{ $prod->prod_id }})">
				                      <i class="far fa-heart fa-2x text-primary {{ (in_array($prod->prod_id,$favLIST))? 'd-none':'d-block' }}"></i>
				                      <i class="fas fa-heart fa-2x text-primary {{ (in_array($prod->prod_id,$favLIST))? 'd-block':'d-none' }}"></i>
				              		</div>
				              	</div>
				              	<div class="col">
					            	@if ($prod->sop_count > 0)
					            		<div class="akcijaNOTE">@lang('shop.title_action')</div>
					            	@endif
					            </div>
			            	</div>
			            	
			              <a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->prod_slug }}"><img src="/storage/products/{{ ($prod->prod_image != null)? $prod->prod_image:'no_image.jpg' }}" alt="{{ $prod->prod_title }}" class="img100"></a>
			            </div>

			            <h3><a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->prod_slug }}">{{ $prod->prod_title }}</a></h3>
			            
			            <div class="container productCardBottom">
			            		<div class="row justify-content-center">
			            			<div class="priceWrap" style="color: {{ ($prod->cat_color == null)? '#389178':'$prod->cat_colo' }};">
			            				@if ($prod->prod_price_with_discount != null)
			            				<div class="row justify-content-center">
			            					<span class="fullPriceDiscounted"><div class="pt-2 col-12 text-center small text-secondary">Cena:</div><div class="col-12 text-lowercase font-weight-bold">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</div></span>
			            				</div>
			            				<div class="row justify-content-center">
			            					<span class="discountPrice"><div class="pt-2 col-12 text-center small text-secondary">Cena:</div><div class="col-12 text-lowercase font-weight-bold">{{ number_format($prod->prod_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</div></span>
			            				</div>
						                @else
						                	<span class="singlePrice"><div class="pt-2 col-12 text-center small text-secondary">Cena:</div><div class="col-12 text-lowercase font-weight-bold">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</div></span>
						                @endif
			            			</div>
					            </div>
								<div class="row justify-content-center mt-3">
									<div id="" class="rounded-pill btnBuy {{ ($prod->cat_color == null)? 'primary-color':'' }} text-white pt-1 pb-2 pl-3 pr-3 align-middle" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};"  onclick="CartEvent({{ $prod->prod_id }})">
										 @lang('shop.btn_buy')
									</div>
								</div>
								{{-- style="color: {{ ($prod->cat_color != null)? $prod->cat_color:'#7C7C7C' }};" --}}
							  <div class="row justify-content-center mt-3">
								  <span class="border {{ ($prod->cat_color == null)? 'primary-color':'' }}  col-12 border-5" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};"></span>
							  </div>
			              		
			            </div>

			          </div>
		        </div>
				@endforeach

			</div>
			<div class="row">
				<div id="paginateBlock">
					{{ $productsFor_CAT->links() }}
				</div>
			</div>

		</div>

	</div>
@php
    // echo '<pre class="white">';
    // print_r($productsFor_CAT);
    // echo '</pre>';
@endphp

</div>

@endsection