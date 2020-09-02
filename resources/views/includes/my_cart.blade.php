<div class="col-auto pl-1 pl-sm-2 pr-1 pr-sm-2">

	<div id="myCart" class="row rounded-pill" data-toggle="modal" data-target="#myCartModal">

		<div id="cartCount" class="col-auto pr-0">
				<span class="badge red {{ ($cartDATA['count'] > 0)? '':'d-none' }}">{{ $cartDATA['count'] }}</span>
			<img src="/images/header/korpa - icon - header.svg" alt="Moja korpa">
		</div>

		<div class="col-auto pl-2 pr-0">
			<div class="font-weight-bold small">@lang('shop.my_cart_title')</div>
				<div id="cartCountTXT" class="small font-italic {{ ($cartDATA['count'] > 0)? 'd-none':'' }}">@lang('shop.shop_my_cart_empty')</div>
		</div>

	</div>

</div>


 <div class="modal fade right" id="myCartModal" tabindex="-1" role="dialog" aria-labelledby="myCartModal" aria-hidden="true">
   <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">

     <div class="modal-content">

       <div class="modal-header">
         <p class="heading lead">@lang('shop.my_cart_title')</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <div id="cartDATA" class="modal-body">

          <span id="emptyCart_modal" class="text-white {{ ($cartDATA['count'] > 0)? 'd-none':'d-block' }}">@lang('shop.my_cart_my_cart_is_empty')</span>

          {!! $cartDATA['products'] !!}

       </div>

       <div class="modal-footer justify-content-center">
         <a id="btnMyCart" type="button" class="btn rounded-pill" href="/cart">@lang('shop.my_cart_my_cart')</a>
         <a id="btnContinue" type="button" class="btn rounded-pill" data-dismiss="modal">@lang('shop.my_cart_continue_shoppin')</a>
       </div>
     </div>

   </div>
 </div>


@php
	// echo '<pre class="text-white">';
	// print_r($cartDATA);
	// echo '</pre>';
@endphp