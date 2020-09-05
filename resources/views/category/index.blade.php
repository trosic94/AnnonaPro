@extends ('includes.page')

@section ('content')

<div id="pageWrap">
	<div id="bannerWrap">
				@foreach($banners_homeWide->random(1) as $bKey => $banner)
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
			
			{{-- <div class="mainTitle mt-3 mt-lg-0 pl-4 pl-lg-0 pr-4 pr-lg-0">
				<h1>{{ $category->name }}</h1>
			</div> --}}

			<div class="row pl-4 pl-lg-0 pr-4 pr-lg-0">

				@foreach ($allProducts as $key => $prod)
				<div class="col-md-3 pl-2 pl-lg-0 pr-2 pr-lg-0 pb-4 d-flex wow animated fadeIn">
			         <div class="prodOne white pl-0 pr-0 ml-3 mr-3">

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
			            			<div class="priceWrap" style="color: {{ ($prod->cat_color == null)? '#389178':'$prod->cat_color' }};">
			            				@if ($prod->prod_price_with_discount != null)
			            				<div class="row justify-content-center text-secondary">
			            					Cena:<span class="fullPrice ">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
			            				</div>
			            				<div class="row justify-content-center ">
			            					<span class="discountPrice {{ ($prod->cat_color == null)? 'primary-color':'' }} " style="color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};">{{ number_format($prod->prod_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
			            				</div>
						                @else
											<label class="text-secondary m-0" style="display: block;" align="middle">Cena:</label><span class="singlePrice m-0 " style="color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
						                @endif
			            			</div>
					            </div>
			              		<div class="row justify-content-center mt-3">
				              		<div id=""  class="rounded-pill buyButton {{ ($prod->cat_color == null)? 'primary-color':'' }} text-white  pl-3 pr-3 pt-1 pb-1" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};"  onclick="CartEvent({{ $prod->prod_id }})">
				              			 @lang('shop.btn_buy')
				              		</div>
			              		</div>
								<div class="row justify-content-center mt-3 ">
									<span class="border {{ ($prod->cat_color == null)? 'primary-color':'' }}  col-12 border-5" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};"></span>
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