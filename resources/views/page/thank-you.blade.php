
@php
	$orderTotal = Session::get('orderDATA');

	//$orderTotal = Session::get('ordTEST'); // koristim kod testiranja prikaza podatak
	//Session::forget('ordTEST');
@endphp

<div id="cartWrap">


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

		<div class="col-lg-8">

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
	                        <th class="text-center">@lang('shop.thank_you_price')({{ setting('site.valuta') }})</th>
	                        <th class="text-center">@lang('shop.thank_you_quantity')</th>
	                        <th class="text-center">@lang('shop.thank_you_amount')({{ setting('site.valuta') }})</th>
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
	                        </td>
	                        <td>
		                        <div class="priceWrap">
		                        	<span class="finalPrice">{{ number_format($prod['display_price'],0,"",".") }}</span>
		                        </div>

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

	            </div>

	        </div>

		</div>

		<div class="col-lg-4">

		    <div class="row">

	            <div class="col-xl-12">

	                <div class="card">

	                    <div class="card-header">
	                        <h4 class="card-title font-weight-bold">@lang('shop.thank_you_invoice_amount')</h4>
	                    </div>

	                    <div class="card-body">

	                        <div id="cartAmountWrap" class="">

	                            <div id="cartAmount" class="row">
	                                <div id="cartAmount_label" class="col-xl-6"><label>@lang('shop.thank_you_amount'):</label></div>
	                                <div id="cartAmount_txt" class="col-xl-6 text-right"><span>{{ number_format($amount,0,"",".") }}</span> {{ setting('site.valuta') }}</div>
	                            </div>

	                            <div id="cartAmount" class="row">
	                                <div id="cartAmount_label" class="col-xl-6"><label>@lang('shop.thank_you_discount'):</label></div>
	                                <div id="cartAmount_txt" class="col-xl-6 text-right"><span>{{ $orderTotal['order']['rabat'] }}</span> %</div>
	                            </div>

	                            <div id="cartShipping" class="row">
	                                <div id="cartShipping_label" class="col-xl-4"><label>@lang('shop.thank_you_shipping'):</label></div>
	                                <div id="cartShipping_txt" class="col-xl-8 small">{{ setting('shop.shop_delivery_note') }}</div>
	                            </div>

	                            @php
	                            	$total = $amount - ($amount/100)*$orderTotal['order']['rabat'];
	                            @endphp


	                            <div id="cartTotal" class="row">
	                                <div id="cartTotal_label" class="col-xl-6">
	                                    <label>@lang('shop.thank_you_total'):</label>
	                                    <span>(@lang('shop.thank_you_amount_total_vat'))</span>
	                                </div>
	                                <div id="cartTotal_txt" class="col-xl-6 text-right"><label>{{ number_format($total,0,"",".") }}</label> {{ setting('site.valuta') }}</div>
	                            </div>

	                        </div>

	                	</div>

	                </div>

	            </div>


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