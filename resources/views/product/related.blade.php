					<div id="relatedProductsWrap" class="row">
						
						<div class="col-xl-12 pb-3">

							<h3 class="mb-3">@lang('shop.title_related_products')</h3>

							<div class="row">

								@foreach ($relatedProducts as $key => $prod)
									@if ($key < 4)
										@include('layouts.product')
									@endif
								@endforeach

							</div>

		          		</div>

		          	</div>


@php
// echo count($relatedProducts).'<br>';
// echo '<pre>';
// print_r($relatedProducts);
// echo '</pre>';
@endphp