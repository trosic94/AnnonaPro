@php
	$orderTotal = Session::get('orderDATA');

	//$orderTotal = Session::get('ordTEST'); // koristim kod testiranja prikaza podatak
	//Session::forget('ordTEST');
@endphp

<div id="cartWrap" class="mb-5">


	@if ($orderTotal)

	<div class="row">

		<div class="col-xl-12">

			<p>@lang('shop.thank_you_hello') {{ $orderTotal['customer']['name'] }},</p>
			@if ($orderTotal['order']['payment_method'] == 1)
				<p>@lang('shop.thank_you_cc_payment_note')</p>
			@endif
			<p>@lang('shop.thank_you_other_payment_note_1') <span class="font-weight-bold">{{ $orderTotal['order']['order_number'] }}</span> @lang('shop.thank_you_other_payment_note_2')<br></p>

		</div>

	</div>

	<div class="row">

		<div class="col-xl-12">

	        @php
	            $amount = 0;
	            $total = 0;
	        @endphp

	        <div class="card">

	            <div class="card-header">
	                <h4 class="card-title font-weight-bold">@lang('shop.my_cart_items')</h4>
	            </div>

	            <div class="card-body">

	                <div class="table-responsive">

	                <table id="cartTable" class="table">
	                    <thead>
	                      <tr>
	                        <th></th>
	                        <th>@lang('shop.thank_you_product_title')</th>
	                        <th class="text-center">@lang('shop.order_price')</th>
	                        <th class="text-center">@lang('shop.title_discount')%</th>
							<th class="text-center">@lang('shop.title_price_with_discount')</th>
	                        <th class="text-center">@lang('shop.order_quantity')</th>
	                        <th class="text-center">@lang('shop.order_amount')({{ setting('site.valuta') }})</th>
	                        <th></th>
	                      </tr>
	                    </thead>
	                    <tbody>

	                    @foreach($orderTotal['order_items'] as $cartKey => $prod)
	                    <tr>
	                        <td><img src="{{ $prod['prod_image'] }}" alt="{{ $prod['prod_title'] }}" style="min-width: 80px;"></td>
	                        <td>
	                        	<h3>{{ $prod['prod_title'] }}</h3>
	                        	<span class="prodSKU"><label>@lang('shop.my_cart_sku'):</label> {{ $prod['prod_sku'] }}</span>

	                        	@if (array_key_exists('attr',$prod))

		                        	@php

		                        		foreach ($prod['attr'] as $attrKey => $attr):

                        					$i = 0;
                        					$iMAX = 0;
                        					$attrLABELs = '';

											// ispis Labele
											echo '<span class="font-weight-bold mr-1">'.$attr['title'].'</span>: ';

											//ispis odabranih dinamickih atributa
                        					foreach ($prod['attr'] as $attrLBLKey => $attrLBL) {

                        						if ($attr['id'] == $attrLBL['id']):

                        							foreach ($attrLBL['val'] as $vKey => $attrData) {

	                        							$attrLABELs .= $attrData['label'].', ';
	                        							$i++;
	                        							$iMAX++;
                        								
                        							}

                        						endif;

                        					}
				                            // sklanjam zarez sa iza poslednje ispisane vrednosti
				                            if ($i == 1 || $i == $iMAX):
				                                $attrLABELs = substr($attrLABELs, 0, -2);
				                            endif;

				                            echo '<span>'.$attrLABELs.'</span>';
                        					echo '<br>';

		                        		endforeach;


		                        	@endphp

	                        	@endif


	                        </td>
	                        <td class="text-right">
								{{ number_format($prod['prod_price'],0,"",".") }}
	                        </td>
	                        <td class="text-center">
	                        	{{ $prod['prod_discount'] }}
	                        </td>
	                        <td class="text-right">
		                        {{ number_format($prod['display_price'],0,"",".") }}

	                        	@php
	                        		// konacna cena po proizvodu
	                        		$productTotal = $prod['display_price'] * $prod['quantity'];

	                        		// kreiram sumu za konacan prikaz
	                        		$amount = $amount + $productTotal;

	                        	@endphp

	                        </td>
	                        <td class="text-center">{{ $prod['quantity'] }}</td>
	                        <td>
		                        <div class="priceWrap">
		                        	<span class="finalPrice">{{ number_format($productTotal,0,"",".") }}</span>
		                        </div>
		                    </td>
	                    </tr>
	                    @endforeach

	                    </tbody>
	                </table>

	                </div>

                    <div class="row">

			            <div class="col-xl-12">

	                        <div id="cartAmountWrap" class="">

	                            <div id="cartAmount" class="row">
	                                <div id="cartAmount_label" class="col-xl-6"><label>@lang('shop.order_amount'):</label></div>
	                                <div id="cartAmount_txt" class="col-xl-6 text-right"><span>{{ number_format($amount,0,"",".") }}</span> {{ setting('site.valuta') }}</div>
	                            </div>

	                            <div id="cartAmount" class="row">
	                                <div id="cartAmount_label" class="col-xl-6"><label>@lang('shop.order_discount'):</label></div>
	                                <div id="cartAmount_txt" class="col-xl-6 text-right"><span>{{ $orderTotal['order']['rabat'] }}</span> %</div>
	                            </div>

	                            <div id="cartShipping" class="row">
	                                <div id="cartShipping_label" class="col-xl-4"><label>@lang('shop.order_shipping'):</label></div>
	                                <div id="cartShipping_txt" class="col-xl-8 small text-right">{{ setting('shop.shop_delivery_note') }}</div>
	                            </div>

	                            @php
	                            	$total = $amount - ($amount/100)*$orderTotal['order']['rabat'];
	                            @endphp


	                            <div id="cartTotal" class="row">
	                                <div id="cartTotal_label" class="col-xl-6">
	                                    <label>@lang('shop.order_total'):</label>
	                                    <span>(@lang('shop.order_amount_total_vat'))</span>
	                                </div>
	                                <div id="cartTotal_txt" class="col-xl-6 text-right"><label>{{ number_format($total,0,"",".") }}</label> {{ setting('site.valuta') }}</div>
	                            </div>

	                        </div>

			            </div>

                    </div>





	            </div>

	        </div>

		</div>

		<div class="col-xl-12">

		    <div class="row">

	            <div class="col-xl-12">

	                <div class="card">

	                    <div class="card-header">
	                        <h4 class="card-title font-weight-bold">@lang('shop.thank_you_comment')</h4>
	                    </div>

	                    <div class="card-body">

	                    	{!! $orderTotal['order']['comment'] !!}

	                	</div>

	                </div>

	            </div>

		    </div>

		</div>

	</div>

	<div class="row">

		<div class="col-xl-12">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title font-weight-bold">@lang('shop.thank_you_shipping')</h4>
                </div>

                <div class="card-body">

                    <div id="shippingAddress" class="row">
                        <div class="col-xl-6">

                        	<h5 class="mb-3">@lang('shop.thank_you_customer_details'):</h5>

                            <ul>
                                <li class="mb-2"><label>@lang('shop.thank_you_name'):</label> <span>{{ $orderTotal['customer']['name'] }} {{ $orderTotal['customer']['last_name'] }}</span></li>
                                <li><label>@lang('shop.thank_you_address'):</label> <span>{{ $orderTotal['customer']['address'] }}</span></li>
                                <li><label>@lang('shop.thank_you_zip'):</label> <span>{{ $orderTotal['customer']['zip'] }}</span></li>
                                <li class="mb-2"><label>@lang('shop.thank_you_city'):</label> <span>{{ $orderTotal['customer']['city'] }}</span></li>
                                <li><label>@lang('shop.thank_you_phone'):</label> <span>{{ $orderTotal['customer']['phone'] }}</span></li>
                                <li><label>@lang('shop.thank_you_email'):</label> <span>{{ $orderTotal['customer']['email'] }}</span></li>
                            </ul>

                        </div>

                        <div class="col-xl-6">

                        	<h5 class="mb-3">@lang('shop.thank_you_shipping_details'):</h5>

                            <ul>
                                <li class="mb-2"><label>@lang('shop.thank_you_name'):</label> <span>{{ $orderTotal['order_shipping']['shp_name'] }} {{ $orderTotal['order_shipping']['shp_last_name'] }}</span></li>
                                <li><label>@lang('shop.thank_you_address'):</label> <span>{{ $orderTotal['order_shipping']['shp_address'] }}</span></li>
                                <li><label>@lang('shop.thank_you_zip'):</label> <span>{{ $orderTotal['order_shipping']['shp_zip'] }}</span></li>
                                <li class="mb-2"><label>@lang('shop.thank_you_city'):</label> <span>{{ $orderTotal['order_shipping']['shp_city'] }}</span></li>
                                <li><label>@lang('shop.thank_you_phone'):</label> <span>{{ $orderTotal['order_shipping']['shp_phone'] }}</span></li>
                                <li><label>@lang('shop.thank_you_email'):</label> <span>{{ $orderTotal['order_shipping']['shp_email'] }}</span></li>
                            </ul>

                        </div>

                    </div>

                </div>

            </div>

		</div>

	</div>

	@else

		Nastavite sa kupovinom...

	@endif

@php
    // echo '<pre>';
    // print_r($orderTotal);
    // echo '</pre>';
@endphp

</div>