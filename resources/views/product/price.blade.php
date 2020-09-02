					<div class="row">
						
						<div class="col-xl-12">

							<div class="priceWrap">
								@if ($productDATA->prod_price_with_discount != null)
									<span class="fullPrice">{{ number_format($productDATA->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
									<span class="discountPrice">{{ number_format($productDATA->prod_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
								@else
									<span class="singlePrice">{{ number_format($productDATA->prod_price,0,"",".") }} {{ setting('site.valuta') }}</span>
								@endif
							</div>

		          		</div>

		          	</div>