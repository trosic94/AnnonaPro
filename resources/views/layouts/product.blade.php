<div class="col-md-3 pl-2 pl-lg-0 pr-2 pr-lg-0 mb-3 d-flex wow animated fadeIn">
			         <div class="prodOne white pl-0 pr-0 ml-3 mr-3 shadow-sm">

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
					            		<div class="akcijaNOTE" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};">@lang('shop.title_action')</div>
					            	@endif
					            </div>
			            	</div>
			            	
			              <a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->prod_slug }}"><img src="/storage/products/{{ ($prod->prod_image != null)? $prod->prod_image:'no_image.jpg' }}" alt="{{ $prod->prod_title }}" class="img100"></a>
			            </div>

			            <h3><a href="{{ ($prod->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $prod->pcat_slug }}/{{ $prod->cat_slug }}/{{ $prod->prod_slug }}">{{ $prod->prod_title }}</a></h3>

			            <div class="container productCardBottom">
			            		<div class="row justify-content-center">
			            			<div class="priceWrap" style="color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};">
			            				@if ($prod->prod_price_with_discount != null)
			            				<div class="row justify-content-center">
											<div class="col-12 small text-center text-secondary">Cena:</div>
											<span class="fullPrice font-weight-bold text-lowercase small col-12 text-right mt-n3">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
											<span class="discountPrice font-weight-bold text-lowercase col-12 text-center" style="color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};">{{ number_format($prod->prod_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
			            				</div>
										@else
										<div class="row justify-content-center">
											<div class="col-12 small text-center text-secondary">Cena:</div>
											<span class="singlePrice m-0 font-weight-bold text-lowercase " style="color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};">{{ number_format($prod->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
										</div>
										@endif
			            			</div>
					            </div>
			              		<div class="row justify-content-center mt-3">
				              		<button id="addTo_CART"  class="btn btn-rounded btnBuy {{ ($prod->cat_color == null)? 'primary-color':'' }} text-white  pl-3 pr-3 pt-1 pb-1" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};"  onclick="CartEvent({{ $prod->prod_id }})">
				              			 @lang('shop.btn_buy')
				              		</button>
			              		</div>
								<div class="row justify-content-center mt-3 ">
									<span class="border {{ ($prod->cat_color == null)? 'primary-color':'' }}  col-12 border-5" style="background-color: {{ ($prod->cat_color != null)? $prod->cat_color:'' }};"></span>
								</div>
			            </div>
			          </div>
		        </div>