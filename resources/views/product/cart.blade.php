
@extends ('includes.master')

@section ('pageContent')

<content>

<div class="container-fluid">

    <div class="row">

        <div class="col-xl-2">
            {{-- brendiranje --}}
        </div>

        <div class="col-xl-8">

            <div id="pageWrap">


                <div class="row mt-5">

                    <div class="col-xl-12">

                        <div class="mainTitle">
                            <h1>@lang('shop.shop_my_cart_title')</h1>
                        </div>

                        @if(!Auth::guest())
                            <form id="confirmOrder" class="needs-validation" method="POST" action="/confirm-order" novalidate>
                        @endif
                        {{ csrf_field() }}

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


                                        @if ($cart)

                                            <div class="table-responsive">

                                            <table id="cartTable" class="table">
                                                <thead>
                                                  <tr>
                                                    <th></th>
                                                    <th>@lang('shop.my_cart_product_title')</th>
                                                    <th>@lang('shop.my_cart_quantity')</th>
                                                    <th>@lang('shop.my_cart_amount') ({{ setting('site.valuta') }})</th>
                                                    <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($cart['products'] as $cartKey => $prod)
                                                    <tr id="row_{{ $prod['prod_id'] }}">
                                                        <td><img src="/storage/products/{{ ($prod['prod_image'] != null)? $prod['prod_image']:'no_image.jpg' }}" alt="{{ $prod['prod_title'] }}" style="min-width: 80px;"></td>
                                                        <td>
                                                            <h3>{{ $prod['prod_title'] }}</h3>
                                                            <span class="prodSKU"><label>@lang('shop.my_cart_sku'):</label> {{ $prod['prod_sku'] }}</span>
                                                        </td>
                                                        <td>
                                                            <div id="qtyWrap" class="">
                                                                <div id="btnMinus_{{ $prod['prod_id'] }}" class="btnMINUS" onclick="qtyMINUS({{ $prod['prod_id'] }})"><i class="fas fa-minus"></i></div>
                                                                <input id="prodQuantity_{{ $prod['prod_id'] }}" class="prod_quantity" name="prod_quantity_{{ $prod['prod_id'] }}" class="" value="{{ $prod['quantity'] }}" readonly="">
                                                                <div id="btnPlus_{{ $prod['prod_id'] }}" class="btnPLUS" onclick="qtyPLUS({{ $prod['prod_id'] }})"><i class="fas fa-plus"></i></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="priceWrap">

                                                            @php

                                                                $prod_price = $prod['quantity'] * $prod['prod_price'];
                                                                $prod_price_with_discount = $prod['quantity'] * $prod['prod_price_with_discount'];
                                                                
                                                            @endphp

                                                            @if ($prod['prod_price_with_discount'] != null)

                                                                <span class="fullPrice">{{ number_format($prod_price,0,"",".") }}</span>
                                                                <span class="finalPrice">{{ number_format($prod_price_with_discount,0,"",".") }}</span>

                                                                <input type="hidden" name="start_discount_price_{{ $prod['prod_id'] }}" value="{{ $prod['prod_price'] }}">
                                                                <input type="hidden" name="start_final_price_{{ $prod['prod_id'] }}" value="{{ $prod['prod_price_with_discount'] }}">

                                                                <input type="hidden" name="discount_price_{{ $prod['prod_id'] }}" value="{{ $prod_price }}">
                                                                <input type="hidden" id="finalPRICE" name="final_price_{{ $prod['prod_id'] }}" value="{{ $prod_price_with_discount }}">

                                                                @php
                                                                    $amount = $amount + $prod_price_with_discount;
                                                                    $total = $total + $prod_price_with_discount;
                                                                @endphp

                                                            @else

                                                                <span class="finalPrice">{{ number_format($prod_price,0,"",".") }}</span>

                                                                <input type="hidden" name="start_discount_price_{{ $prod['prod_id'] }}" value="0">
                                                                <input type="hidden" name="start_final_price_{{ $prod['prod_id'] }}" value="{{ $prod['prod_price'] }}">

                                                                <input type="hidden" name="discount_price_{{ $prod['prod_id'] }}" value="0">
                                                                <input type="hidden" id="finalPRICE" name="final_price_{{ $prod['prod_id'] }}" value="{{ $prod_price }}">

                                                                @php
                                                                    $amount = $amount + $prod_price;
                                                                    $total = $total + $prod_price;
                                                                @endphp

                                                            @endif

                                                            </div>

                                                        </td>
                                                        <td><i id="delCart" class="fas fa-times-circle" onclick="remove_CartEvent({{ $prod['prod_id'] }})"></i></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                            </div>

                                        @else

                                            <h3>@lang('shop.my_cart_my_cart_is_empty')</h3>

                                        @endif

                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-4">

                                    <div class="row">

                                        @include('product.cart_invoice')
                                        {{-- @include('product.cart_shipping') --}}
                                        @include('product.cart_comment')
                                        @include('product.cart_payment')

                                    </div>

                                </div>

                            </div>

                            <div id="shippingAddress" class="row">

                                @include('product.cart_shipping_location')

                            </div>

                            <div id="orderConfirmation" class="row">

                                @if (!Auth::guest())

                                    @include('product.cart_order_confirmation')

                                @endif

                            </div>

                        </div>

                        @if(!Auth::guest())

                        </form>

                        @endif

                    </div>

                </div>


            </div>





        </div>

        <div class="col-xl-2">
            {{-- brendiranje --}}
        </div>

    </div>

</div>

@php
// echo '<pre>';
// print_r($cart);
// echo '</pre>';
@endphp

{{-- <script type="text/javascript">
    $('document').ready(function () {

        $('.mdb-select').materialSelect();

    });
</script> --}}

</content>



@endsection
