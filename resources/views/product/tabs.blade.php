	
	
<div class="col-12">
	@if ($productDATA->prod_body != '' || $productDATA->prod_specification != '' || $productDATA->prod_video != '')
	<div class="row">

		<div class="col-xl-12 p-0">

			<div class="prodTABs">

				<ul class="nav nav-tabs  md-tabs blue ml-0 mr-0 p-0 rounded-0 z-depth-0" id="tabsProduct" role="tablist">

					@if ($productDATA->prod_body != '')
					<li class="nav-item">
						<a class="nav-link rounded-0 active" id="body-tab-md" data-toggle="tab" href="#body-md" role="tab" aria-controls="body-md" aria-selected="true">@lang('shop.title_description')</a>
					</li>
					@endif

					@if ($productDATA->prod_specification != '')
					<li class="nav-item">
						<a class="nav-link rounded-0" id="specification-tab-md" data-toggle="tab" href="#specification-md" role="tab" aria-controls="specification-md" aria-selected="false">@lang('shop.title_specification')</a>
					</li>
					@endif

					@if ($productDATA->prod_video != '')
					<li class="nav-item">
						<a class="nav-link rounded-0" id="video-tab-md" data-toggle="tab" href="#video-md" role="tab" aria-controls="video-md" aria-selected="false">@lang('shop.title_video')</a>
					</li>
					@endif

				</ul>

				<div class="tab-content card p-0 pt-3 rounded-0 z-depth-0" id="tabsProductContent">

					@if ($productDATA->prod_body != '')
					<div class="tab-pane fade show active" id="body-md" role="tabpanel" aria-labelledby="body-tab-md">
						{!! $productDATA->prod_body !!}
					</div>
					@endif

					@if ($productDATA->prod_specification != '')
					<div class="tab-pane fade" id="specification-md" role="tabpanel" aria-labelledby="specification-tab-md">
						{!! $productDATA->prod_specification !!}
					</div>
					@endif

					@if ($productDATA->prod_video != '')
					<div class="tab-pane fade" id="video-md" role="tabpanel" aria-labelledby="video-tab-md">

						<div class="ytEmbedContainter mar_b_10">
							<iframe width="100%" height="auto" src="https://www.youtube.com/embed/{{ $productDATA->prod_video }}"></iframe>
						</div>

					</div>
					@endif

				</div>

			</div>

		</div>

	</div>
	@endif
	<div class="row prodDetails mb-2">
		<div class="d-inline mr-5">
			<label class="text-secondary">Zapremina:</label><label class="annonaOrange">{{$productDATA->zapremina}}</label>
		</div>
		<div class="d-inline ">
			<label class="text-secondary">Dodaj u listu želja:</label>
			<div id="addTo_FAV" class="prod_{{ $productDATA->prod_id }}" onclick="FavEvent({{ $productDATA->prod_id }})">
              <i class="far fa-heart text-primary {{ (in_array($productDATA->prod_id,$favLIST))? 'd-none':'d-block' }}"></i>
              <i class="fas fa-heart text-primary {{ (in_array($productDATA->prod_id,$favLIST))? 'd-block':'d-none' }}"></i>
      		</div>
		</div>
	</div>
	{{-- <div class="row"> --}}
	<div class="row mt-3">
		<div class="col-xl-12">
		<div class="col-md-4 col-xs-12">
			<div class="row justify-content-start">
				<div class="priceWrap" style="color: {{ ($productDATA->cat_color == null)? '#389178':'$prod->cat_color' }};">
					@if ($productDATA->prod_price_with_discount != null)
					<div class="row justify-content-start text-secondary">
						<span class="fullPrice font-weight-bold text-lowercase">{{ number_format($productDATA->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
					</div>
					<div class="row justify-content-center text-secondary">
						<div class="  ">Cena:</div><span class="discountPrice font-weight-bold text-lowercase {{ ($productDATA->cat_color == null)? 'primary-color':'' }} " style="color: {{ ($productDATA->cat_color != null)? $productDATA->cat_color:'' }};">{{ number_format($productDATA->prod_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
					</div>
	                @else
	                <div class="row">
	                	<div class="d-inline m-0 text-secondary align-bottom">Cena:</div><span class="singlePrice m-0 font-weight-bold text-lowercase " style="color: {{ ($productDATA->cat_color != null)? $productDATA->cat_color:'' }};">{{ number_format($productDATA->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
	                </div>
					
	                @endif
				</div>
	        </div>
	  		
		</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12 p-0">
			<div class="col-md-5 p-0">
			<button id="addTo_CART"  class="btn btn-rounded btnBuy text-white {{ ($productDATA->cat_color == null)? 'primary-color':'' }} m-0  pl-5 pr-5 pt-3 pb-3" style="background-color: {{ ($productDATA->cat_color != null)? $productDATA->cat_color:'' }};"  onclick="CartEvent({{ $productDATA->prod_id }})">
				 @lang('shop.btn_buy')
			</button>
			</div>
		</div>
		
		
	</div>
	{{-- </div> --}}

	</div>

	