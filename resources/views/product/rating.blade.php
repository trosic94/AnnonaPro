					<div id="ratingWrap" class="row">
						
						<div class="col-xl-12 pb-3">

							

							<div class="row">

								<div class="col-lg-6">
									@if (!$ratingComments->isEmpty())
									<h3 class="mb-3">@lang('shop.rate_comment_title')</h3>
									@endif

									<div class="row">
										@if ($ratingComments)
											@foreach ($ratingComments as $rcKey => $comment)
											<div class="col-md-12 mb-4">
												<div class="row pr-5 commentHead">
													<div class="col-lg-6 p-0">
														<div>{{ $comment->u_name }} {{ $comment->u_last_name }}</div>
													</div>
													<div class="col-lg-6 p-0 text-right">
														@lang('shop.title_rate'): {{ $comment->rate }}
													</div>
												</div>
												<div class="commentTXT">
													<div class="col-lg-12 p-0">{{ $comment->prod_comment }}</div>
												</div>
											</div>
											@endforeach
										@else
											<div class="col-md-12">
											@if ($daLiMozeDaOcenjujeIKomentarise == 1)
												@lang('shop.rate_comment_first')
											@else
												@lang('shop.rate_no_comments')
											@endif
											</div>
										@endif
									</div>

								</div>

								<div class="col-lg-6">

									<h3 class="mb-3">@lang('shop.title_rate_product')</h3>


									@if (setting('shop.rating') == 1)

										<div id="rateOptions" class="w-auto" onmouseout="rateOF({{ count($ratingOptions) }},{{ $productRate }})">

											@foreach ($ratingOptions as $rKey => $rate)

												<span
													@if ($daLiMozeDaOcenjujeIKomentarise != 1)
													class="blank"
													@endif
													id="rate{{ $rKey }}" 
													data-toggle="tooltip" 
													title="{{ $rate->ro_name }}"
													@if ($daLiMozeDaOcenjujeIKomentarise == 1)
													onmouseover="rateON({{ $rate->ro_id }},{{ count($ratingOptions) }})" 
													onclick="rateMe({{ $rate->ro_id }},{{ $rate->ro_value }},{{ $productDATA->prod_id }},{{ $rKey }})"
													@endif
													>
													<i class="fas fa-star {{ ($productRate > $rKey)? 'starON':'starOFF' }}"></i>
												</span>

											@endforeach

										</div>

									@endif

									<div class="rate">@lang('shop.title_rate'): <span id="rateVal">{{ $productRate }}</span></div>

									@if ($daLiMozeDaOcenjujeIKomentarise == 1)
									<div id="rateMSG"></div>
									@endif


									@if (setting('shop.rating_comments') == 1)

										@include ('product.rating_comments')

									@endif

								</div>


							</div>

		          		</div>

		          	</div>


@php
// echo '<pre>';
// print_r($daLiJeKupioProizvod);
// print_r($ulogovan);
// echo '</pre>';
@endphp