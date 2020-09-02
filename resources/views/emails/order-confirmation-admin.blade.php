@include('emails.mail_header')

			<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" bgcolor="#231f20">
				<tr bgcolor="#231f20">
					<td>
					<table border="0" cellpadding="0" cellspacing="0" width="540" align="center">
						<tr>
							<td width="50%" style="color: #ffffff; text-transform: uppercase; font-size: 18px; padding: 5px 10px; font-family: Arial, Helvetica, sans-serif;">@lang('shop.email_order_title')</td>
							<td width="50%" style="color: #ffffff; text-transform: uppercase; font-size: 18px; padding: 5px 10px; font-family: Arial, Helvetica, sans-serif; text-align: right;">{{ $dateTime }}</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>

			&nbsp;<br>
			<table cellpadding="0" cellspacing="0" width="600" align="center">
				<tr>
					<td style="padding: 25px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #231f20;">
					@lang('shop.email_hello'),
					<br>
					<br>
					@if ($order['payment_method'] == 1)
						@lang('shop.email_cc_payment_intro_note')<br>
					@else
						@lang('shop.email_other_payment_intro_note_admin_1') <strong>{{ $order['order_number'] }}</strong> @lang('shop.email_other_payment_intro_note_admin_2')<br>
						@lang('shop.email_other_payment_intro_note_admin_3') <a href="{{ $url }}/storage/proforma-invoice/{{ $order['proforma_invoice'] }}.pdf" target="_blank" style="text-decoration: none; color: #0DACD2; font-weight: bold;">@lang('shop.email_other_payment_intro_link')</a>.<br>
					@endif
					<br>
					<table width="100%" cellpadding="0" cellspacing="0">
						<thead>
							<tr bgcolor="#0DACD2">
								<th style="padding: 3px; color: #ffffff;">@lang('shop.email_product_tbl_no')</th>
								<th style="padding: 3px; color: #ffffff;">@lang('shop.email_product_tbl_image')</th>
								<th style="padding: 3px; color: #ffffff;">@lang('shop.email_product_tbl_product')</th>
								<th style="padding: 3px; color: #ffffff;">@lang('shop.email_product_tbl_quantity')</th>
								<th style="padding: 3px; color: #ffffff;">@lang('shop.email_product_tbl_price') ({{ setting('site.valuta') }})</th>
							</tr>
						</thead>
						<tbody>
							@php
								// kreiram konacnu sumu za racun
								$suma = 0;
							@endphp
							@for ($oi=0; $oi<count($order_items); $oi++)

							<tr>
								<td valign="top" style="padding: 3px; border-bottom: 1px solid #231f20; text-align: center;">{{ $oi+1 }}</td>
								<td valign="top" style="padding: 3px; border-bottom: 1px solid #231f20; text-align: center;"><img src="{{ $order_items[$oi]['prod_image'] }}" width="70" height="auto"></td>
								<td valign="top" style="padding: 3px; border-bottom: 1px solid #231f20;">
									{{ $order_items[$oi]['prod_title'] }}<br>
									<br>
									<span style="color: #D93648; font-weight: bold;">@lang('shop.email_product_tbl_sku'):</span> <span>{{ $order_items[$oi]['prod_sku'] }}</span>
								</td>
								<td valign="top" style="padding: 3px; border-bottom: 1px solid #231f20; text-align: center;">{{ $order_items[$oi]['quantity'] }}</td>
								<td valign="top" style="padding: 3px; border-bottom: 1px solid #231f20; text-align: right;">{{ number_format($order_items[$oi]['total'],0,".","") }}</td>
							</tr>

							@php
								// kreiram konacnu sumu za racun
								$suma = $suma + $order_items[$oi]['total'];
							@endphp

							@endfor
							<tr bgcolor="#f0f0f0">
								<td colspan="3" style="padding: 3px; border-bottom: 1px solid #231f20; text-align: right; font-weight: bold;">@lang('shop.email_product_tbl_discount'):</td>
								<td colspan="3" style="padding: 3px; border-bottom: 1px solid #231f20; text-align: right; font-weight: bold;">{{ $order['rabat'] }}%</td>
							</tr>
		                    @php
		                        // $rabat = ($orders['amountTotal']/100)*$orders['discount'];
		                        // $ukupno = $orders['amountTotal'] - $rabat;
		                    	$ukupno = $suma - ($suma/100)*$order['rabat'];
		                    @endphp
							<tr bgcolor="#f0f0f0">
								<td colspan="3" style="padding: 3px; text-align: right; font-weight: bold;">@lang('shop.email_product_tbl_total'):</td>
								<td colspan="3" style="padding: 3px; text-align: right; font-weight: bold;">{{ number_format($ukupno,0,".","") }} {{ setting('site.valuta') }}</td>
							</tr>
							<tr>
								<td colspan="6" style="padding: 3px; text-align: right; font-size: 80%;"><strong>@lang('shop.email_product_tbl_delivery'):</strong> {{ setting('shop.shop_delivery_note') }}</td>
							</tr>
		                    @php
		                        $total = $ukupno;
		                    @endphp
							<tr bgcolor="#D93648">
								<td colspan="3" style="padding: 3px; color: #ffffff; text-align: right; font-weight: bold; font-size: 16px;">@lang('shop.email_product_tbl_order_total')</td>
								<td colspan="3" style="padding: 3px; color: #ffffff; text-align: right; font-weight: bold; font-size: 16px;">{{ number_format($total,0,".","") }} {{ setting('site.valuta') }}</td>
							</tr>
						</tbody>
					</table>
					<br>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td width="50%">
								<strong>@lang('shop.email_customer'):</strong><br>
								@lang('shop.email_name'): {{ $customer['name'] }} {{ $customer['last_name'] }}<br>
								@lang('shop.email_address'): {{ $customer['address'] }}, {{ $customer['zip'] }} {{ $customer['city'] }}
							</td>
							<td width="50%">
								<strong>@lang('shop.email_shipping_data'):</strong><br>
								@lang('shop.email_name'): {{ $order_shipping['shp_name'] }} {{ $order_shipping['shp_last_name'] }}<br>
								@lang('shop.email_address'): {{ $order_shipping['shp_address'] }}, {{ $order_shipping['shp_zip'] }} {{ $order_shipping['shp_city'] }}
							</td>
						</tr>
					</table>


					<br>
					<br>
					</td>
				</tr>
			</table>
			&nbsp;<br>

@include('emails.mail_footer')