@extends ('includes.page')

@section ('content')

<div id="pageWrap">

    <div class="row mt-5">

    	<div class="col-xl-12">

			<div class="mainTitle">
				<h1>@lang('shop.order_title') <span class="text-danger">{{ $orderDATA->order_number }}</span></h1>
			</div>

    	</div>

    </div>

    <div id="cartWrap">

    <div class="row">

    	<div class="col-xl-8">

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
	                        <th class="text-center">@lang('shop.order_price')({{ setting('site.valuta') }})</th>
	                        <th class="text-center">@lang('shop.order_quantity')</th>
	                        <th class="text-center">@lang('shop.order_amount')({{ setting('site.valuta') }})</th>
	                        <th></th>
	                      </tr>
	                    </thead>
	                    <tbody>

	                    @foreach($orderDATA->orderItems as $key => $prod)
	                    <tr>
	                        <td><img src="/storage/products/{{ $prod->product->image }}" alt="{{ $prod->product->title }}"></td>
	                        <td>
	                        	<h3>{{ $prod->product->title }}</h3>
	                        	<span class="prodSKU"><label>@lang('shop.my_cart_sku'):</label> {{ $prod->product->sku }}</span>
	                        </td>
	                        <td>

	                        	@php
	                        		if ($prod->product->product_price_with_discount != null):
	                        			$displayPrice = $prod->product->product_price_with_discount;
		                        	else:
		                        		$displayPrice = $prod->product->product_price;
		                        	endif;
	                        	@endphp

		                        <div class="priceWrap">
		                        	<span class="finalPrice">{{ number_format($displayPrice,0,"",".") }}</span>
		                        </div>

	                        	@php
	                        		// konacna cena po proizvodu
	                        		$productTotal = $displayPrice * $prod->kolicina;

	                        		// kreiram sumu za konacan prikaz
	                        		$amount = $amount + $productTotal;

	                        	@endphp

	                        </td>
	                        <td class="text-center">{{ $prod->kolicina }}</td>
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

    	<div class="col-xl-4">

		    <div class="row">

	            <div class="col-xl-12">

	                <div class="card">

	                    <div class="card-header">
	                        <h4 class="card-title font-weight-bold">@lang('shop.order_invoice_amount')</h4>
	                    </div>

	                    <div class="card-body">

	                        <div id="cartAmountWrap" class="">

	                            <div id="cartAmount" class="row">
	                                <div id="cartAmount_label" class="col-xl-6"><label>@lang('shop.order_amount'):</label></div>
	                                <div id="cartAmount_txt" class="col-xl-6 text-right"><span>{{ number_format($amount,0,"",".") }}</span> {{ setting('site.valuta') }}</div>
	                            </div>

	                            <div id="cartAmount" class="row">
	                                <div id="cartAmount_label" class="col-xl-6"><label>@lang('shop.order_discount'):</label></div>
	                                <div id="cartAmount_txt" class="col-xl-6 text-right"><span>{{ $orderDATA->rabat }}</span> %</div>
	                            </div>

	                            <div id="cartShipping" class="row">
	                                <div id="cartShipping_label" class="col-xl-4"><label>@lang('shop.order_shipping'):</label></div>
	                                <div id="cartShipping_txt" class="col-xl-8 small">{{ setting('shop.shop_delivery_note') }}</div>
	                            </div>

	                            @php
	                            	$total = $amount - ($amount/100)*$orderDATA->rabat;
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

	            <div class="col-xl-12">

	                <div id="orderStatus" class="card">

	                    <div class="card-header">
	                        <h4 class="card-title font-weight-bold">@lang('shop.order_status')</h4>
	                    </div>

	                    <div class="card-body">

	                    	<div><label>@lang('shop.order_date'):</label> <span>{{ date('d.m.Y', strtotime($orderDATA->created_at)) }}</span></div>
	                    	<div><label>@lang('shop.order_status'):</label> <span>{!! $orderDATA->orderStatus->title !!}</span></div>
	                    	@if (strtotime($orderDATA->updated_at) != '')
	                    		<div><label>@lang('shop.order_update'):</label> <span>{{ date('d.m.Y', strtotime($orderDATA->updated_at)) }}</span></div>
	                    	@endif
	                    	<div><label>@lang('shop.order_proforma_invoice'):</label> <a href="/storage/proforma-invoice/{{ $orderDATA->proforma_invoice }}.pdf" target="_blank">{{ $orderDATA->proforma_invoice }}</a></div>
	                	</div>

	                </div>

	            </div>

	            @if ($orderDATA->comment != null)

	            <div class="col-xl-12">

	                <div class="card">

	                    <div class="card-header">
	                        <h4 class="card-title font-weight-bold">@lang('shop.order_comment')</h4>
	                    </div>

	                    <div class="card-body">

	                    	{!! $orderDATA->comment !!}

	                	</div>

	                </div>

	            </div>

	            @endif

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
                                <li class="mb-2"><label>@lang('shop.order_name'):</label> <span>{{ $orderDATA->user->name }} {{ $orderDATA->user->last_name }}</span></li>
                                <li><label>@lang('shop.order_address'):</label> <span>{{ $orderDATA->user->address }}</span></li>
                                <li><label>@lang('shop.order_zip'):</label> <span>{{ $orderDATA->user->zip }}</span></li>
                                <li class="mb-2"><label>@lang('shop.order_city'):</label> <span>{{ $orderDATA->user->city }}</span></li>
                                <li><label>@lang('shop.order_phone'):</label> <span>{{ $orderDATA->user->phone }}</span></li>
                                <li><label>@lang('shop.order_email'):</label> <span>{{ $orderDATA->user->email }}</span></li>
                            </ul>

                        </div>

                        <div class="col-xl-6">

                        	<h5 class="mb-3">@lang('shop.thank_you_shipping_details'):</h5>

                            <ul>
                                <li class="mb-2"><label>@lang('shop.order_name'):</label> <span>{{ $orderDATA->orderShipping->shp_name }} {{ $orderDATA->orderShipping->shp_last_name }}</span></li>
                                <li><label>@lang('shop.order_address'):</label> <span>{{ $orderDATA->orderShipping->shp_address }}</span></li>
                                <li><label>@lang('shop.order_zip'):</label> <span>{{ $orderDATA->orderShipping->shp_zip }}</span></li>
                                <li class="mb-2"><label>@lang('shop.order_city'):</label> <span>{{ $orderDATA->orderShipping->shp_city }}</span></li>
                                <li><label>@lang('shop.order_phone'):</label> <span>{{ $orderDATA->orderShipping->shp_phone }}</span></li>
                                <li><label>@lang('shop.order_email'):</label> <span>{{ $orderDATA->orderShipping->shp_email }}</span></li>
                            </ul>

                        </div>

                    </div>

                </div>

            </div>

		</div>

	</div>

	</div>

@php
// echo '<pre class="text-white">';
// print_r($orderDATA);
// echo '</pre>';
@endphp

</div>


@endsection