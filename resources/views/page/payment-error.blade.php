@php
	$orderTotal = Session::get('mailData');
@endphp

{!! $page->body !!}
<br><br>

<div class="checkOutCart">
	<ul class="chkROWth">
		<li class="chkTH col1 textCenter">RB</li>
		<li class="chkTH col2 textCenter">Slika</li>
		<li class="chkTH col3" id="lrgSCRProd">Proizvod</li>
		<li class="chkTH col4 textCenter" id="lrgSCR">Šifra</li>
		<li class="chkTH col5 textCenter" id="lrgSCR">Količina</li>
		<li class="chkTH col6 textRight" id="lrgSCR">Cena ({{ setting('site.valuta') }})</li>
	</ul>
	@php
		$ukupno = 0;
	@endphp
	@for ($p = 0; $p<count($orderTotal['orders_items']); $p++)

	@php
		$totalZaProizvodBezRabata = $orderTotal['orders_items'][$p]['single_item_price'] * $orderTotal['orders_items'][$p]['item_quantity'];
	@endphp
		<ul class="chkROWtd" id="lrgSCR">
			<li class="chkTD col1 textCenter"><strong>{{ $p+1 }}</strong></li>
			<li class="chkTD col2 textCenter"><img src="/storage/{{ $orderTotal['orders_items'][$p]['item_image'] }}" alt="{{ $orderTotal['orders_items'][$p]['item_title'] }}"></li>
			<li class="chkTD col3">
				<ul class="productDetails">
					<li><label>Oznaka: </label>{{ $orderTotal['orders_items'][$p]['item_title'] }}</li>
					<li><label>Materijal: </label>{{ $orderTotal['orders_items'][$p]['material_name'] }}</li>
					<li><label>Dimanzija: </label>{{ $orderTotal['orders_items'][$p]['dimensions_value'] }}</li>
				</ul>
			</li>
			<li class="chkTD col4 textCenter">{{ $orderTotal['orders_items'][$p]['item_sku'] }}</li>
			<li class="chkTD col5 textCenter">{{ $orderTotal['orders_items'][$p]['item_quantity'] }}</li>
			<li class="chkTD col6 textRight">{{ number_format($totalZaProizvodBezRabata,2,".","") }}</li>
		</ul>

		<ul id="smlSCR">
			<li class="col1 textCenter"><strong>{{ $p+1 }}</strong></li>
			<li class="col2 textCenter"><img src="/storage/{{ $orderTotal['orders_items'][$p]['item_image'] }}" alt="{{ $orderTotal['orders_items'][$p]['item_title'] }}"></li>
			<li class="col3">
				<ul class="productDetails">
					<li><label>Oznaka: </label>{{ $orderTotal['orders_items'][$p]['item_title'] }}</li>
					<li><label>Materijal: </label>{{ $orderTotal['orders_items'][$p]['material_name'] }}</li>
					<li><label>Dimanzija: </label>{{ $orderTotal['orders_items'][$p]['dimensions_value'] }}</li>
				</ul>
			</li>
			<li class="chkTD col4 textCenter"><span>Šifra:</span> {{ $orderTotal['orders_items'][$p]['item_sku'] }}</li>
			<li class="chkTD col5 textCenter"><span>Količina:</span> {{ $orderTotal['orders_items'][$p]['item_quantity'] }}</li>
			<li class="chkTD col6 textRight"><span>Cena:</span> {{ number_format($totalZaProizvodBezRabata,2,".","") }} {{ setting('site.valuta') }}</li>
		</ul>

		@php
			$ukupno = $ukupno + $totalZaProizvodBezRabata;
		@endphp
	@endfor

	<ul class="chkROWRabat">
		<li class="c_col1"></li>
		<li class="chkRabat c_col2 textRight"><strong>Popust: </strong></li>
		<li class="chkRabat c_col3 textRight">{{ $orderTotal['orders']['discount'] }}%</li>
	</ul>

	@php
		$rabat = ($ukupno/100)*$orderTotal['orders']['discount'];
		$ukupno = $ukupno - $rabat;
	@endphp
	<ul class="chkROWUkupno">
		<li class="c_col1"></li>
		<li class="chkUkupno c_col2 textRight"><strong>U K U P N O: </strong></li>
		<li class="chkUkupno c_col3 textRight"><strong>{{ number_format($ukupno,2,".","") }}</strong></li>
	</ul>

	<ul class="chkROWShipping">
		<li class="c_col1"></li>
		<li class="chkShippingtextRight" style="width: 40%; line-height: normal; font-size: 80%; padding: 10px 0;"><strong>Isporuka:</strong> Prema važećem cenovniku Royal Express kurirske službe.</li>
		{{-- <li class="chkShipping c_col2 textRight">Poštarina: </li> --}}
		{{-- <li class="chkShipping c_col3 textRight">{{ number_format(setting('site.postarina'),2,".","") }}</li> --}}
	</ul>

	@php
		// $total = $ukupno + setting('site.postarina');
		$total = $ukupno;
	@endphp
	<ul class="chkROWTotal">
		<li class="c_col1"></li>
		<li class="chkTotal c_col2 textRight">T O T A L: </li>
		<li class="chkTotal c_col3 textRight">{{ number_format(round($total),2,".","") }}</li>
	</ul>
	<div class="PDVnote textRight">*U cenu je uračunat PDV</div>
</div>

	<div class="col50">

		<div class="kupacInfo">
			<h2>Kupac</h2>

			<table class="kupacData" cellpadding="0" cellspacing="0">
				<tr>
					<td><label>Ime i prezime: </label></td>
					<td>{{ $orderTotal['orders']['customer_name'] }}</td>
				</tr>
				<tr>
					<td><label>Firma: </label></td>
					<td>{{ $orderTotal['orders']['customer_company'] }}</td>
				</tr>
				<tr>
					<td><label>Adresa: </label></td>
					<td>{{ $orderTotal['orders']['customer_address'] }}</td>
				</tr>
				<tr>
					<td><label>E-mail: </label></td>
					<td>{{ $orderTotal['orders']['customer_mail'] }}</td>
				</tr>
				<tr>
					<td><label>Telefon: </label></td>
					<td>{{ $orderTotal['orders']['customer_phone'] }}</td>
				</tr>
				<tr>
					<td><label>PIB: </label></td>
					<td>{{ $orderTotal['orders']['customer_vat'] }}</td>
				</tr>
			</table>

		</div>

	</div>

	<div class="col50">
		<div class="kupacInfo">
		<h2>Podaci o zahtevu za plaćanje</h2>

		@if ($orderTotal['orders']['order_nacin_placanja'] == 1)

			<table class="kupacData" cellpadding="0" cellspacing="0">
				<tr>
					<td><label>Broj narudžbine: </label></td>
					<td>{{ $orderTotal['transaction']['pgOrderId'] }}</td>
				</tr>
				<tr>
					<td><label>Status transakcije: </label></td>
					<td>{{ $orderTotal['transaction']['responseMsg'] }}</td>
				</tr>
				<tr>
					<td><label>Kod statusa transakcije: </label></td>
					<td>{{ $orderTotal['transaction']['responseCode'] }}</td>
				</tr>
				<tr>
					<td><label>Broj transakcije: </label></td>
					<td>{{ $orderTotal['transaction']['pgTranId'] }}</td>
				</tr>
				<tr>
					<td><label>Datum transakcije: </label></td>
					<td>
						@if ($orderTotal['transaction']['pgTranDate'] != '')
						{{ date('d.m.Y H:i:s', strtotime($orderTotal['transaction']['pgTranDate'])) }}
						@endif
					</td>
				</tr>
				<tr>
					<td><label>Iznos transakcije: </label></td>
					<td>{{ number_format(round($ukupno),2,".","") }}</td>
				</tr>
				<tr>
					<td><label>Referentni ID transakcije: </label></td>
					<td>{{ $orderTotal['transaction']['pgTranRefId'] }}</td>
				</tr>
			</table>
		@else

			Predračun sa instrukcijama za uplatu, možete da preuzmete sa sledećeg <a href="https://www.oznake.rs/storage/proforma-invoice/{{ $orderTotal['orders']['order_proforma_invoice_name'] }}.pdf" target="_blank" style="text-decoration: none; color: #ffcb1f; font-weight: bold;">linka</a>.<br>
			
		@endif
	</div>

	</div>