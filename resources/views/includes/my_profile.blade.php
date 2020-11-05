<div class="col-auto pl-0 pl-sm-2 pr-0 pr-sm-2">
	<a id="myProfile" class="rounded-pill profileLNK justify-content-md-center" href="/profil" @auth data-toggle="modal" data-target="#myProfileModal" @endauth>
		<div class="row justify-content-center">
		<div class="col-auto px-0">
			<img class="align-top pt-2" src="/images/header/profil - icon - header.svg" alt="Moj profil">
		</div>
		<div class="col-auto pl-3 pr-3 small d-none d-sm-block">
			{{ $userDATA['msg'] }}
		</div>
		</div>
	</a>
</div>

@auth
 <div class="modal fade right" id="myProfileModal" tabindex="-1" role="dialog" aria-labelledby="myProfileModal" aria-hidden="true">
   <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">

     <div class="modal-content">

       <div class="modal-header">
         <p class="heading lead">@lang('shop.profile_title')</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <div id="profilDATA" class="modal-body">

          <h3>{{ $userDATA['customer']['name'] }} {{ $userDATA['customer']['last_name'] }}</h3>

			<hr>

			<h5>@lang('shop.profile_order_overview')</h5>

          <table class="table table-sm">
            <tbody>
            @foreach ($userDATA['orders'] as $key => $order)

              <tr>
                <td><a href="/profil/order-details/{{ $order->id }}" class="orderToolTip" data-placement="right" data-toggle="tooltip" title="{{ $order->order_status_title }}">{{ $order->order_number }}</a></td>
                <td>{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
                <td class="text-right">{{ number_format($order->total,0,"",".") }} {{ setting('site.valuta') }}</td>
              </tr>

            @endforeach
            </tbody>
          </table>

        	<hr>

          @if ($userDATA['loy'] != '' && $userDATA['customer']['barcode'] != '')
          <div>

            @if (property_exists($userDATA['loy'], 'info'))
            <h3>@lang('shop.title_loyalty_program')</h3>
            <div class="row">
              
              <div class="col-lg-12">

                <div><label>@lang('shop.title_number_of_points')</label>: {{ $userDATA['loy']->info->points_amount }}</div>
                <div><label>@lang('shop.title_rang')</label>: {{ $userDATA['loy']->info->rank_title }}</div>

              </div>

            </div>
            @endif

            @if ($userDATA['loy']->coupons)
            <h3>@lang('shop.title_available_coupons')</h3>

            <div class="row mb-4">
              
              <div class="col-lg-12">

                @foreach ($userDATA['loy']->coupons as $cKey => $coupon)
                  <div class="mb-3">
                    <h4 class="small">{{ $coupon->name }}</h4>
                    <img src="{{ $coupon->image_url }}" class="img-fluid w-100">
                  </div>
                @endforeach

              </div>

            </div>
            @endif

            @if ($userDATA['loy']->coupons_challenge_quantity && !array_key_exists('errors', $userDATA['loy']->coupons_challenge_quantity))

            <div class="row mb-4">
              
              <div class="col-lg-12">

                @foreach ($userDATA['loy']->coupons_challenge_quantity as $qKey => $couponChallengeQuantity)
                  <div>
                    <h4 class="small">{{ $couponChallengeQuantity->coupon_title }}</h4>
                    <img src="{{ $couponChallengeQuantity->image }}" class="img-fluid w-100">
                  </div>
                  <div>
                    @for ($i=0; $i<$couponChallengeQuantity->challenged_quantity; $i++)

                      @if ($i < $couponChallengeQuantity->purchased_quantity)
                      <img src="{{ $couponChallengeQuantity->sticker_on }}" class="img-fluid" style="width: 40px;">
                      @else
                      <img src="{{ $couponChallengeQuantity->sticker_off }}" class="img-fluid" style="width: 40px;">
                      @endif

                    @endfor
                  </div>
                  <div class="small">@lang('shop.title_coupons_won'): {{ $couponChallengeQuantity->coupons_won }}</div>
                  <div class="small">@lang('shop.title_purchased'): {{ $couponChallengeQuantity->purchased_quantity }}</div>
                  <div class="small">@lang('shop.title_required_amount_to_win_the_coupon'): {{ $couponChallengeQuantity->challenged_quantity }}</div>
                @endforeach

              </div>

            </div>
            @endif

          </div>
          @endif

@php
// echo '<pre class="text-white">';
// print_r($userDATA['orders']);
// echo '</pre>';
@endphp



       </div>

       <div class="modal-footer justify-content-center">
         <a id="btnProfil" type="button" class="btn rounded-pill" href="/profil">@lang('shop.profile_title')</a>
         <a id="btnLogout" type="button" class="btn rounded-pill" href="/logout">@lang('shop.btn_logout')</a>
       </div>

     </div>

   </div>
 </div>

<script type="text/javascript">
  toolTipINIT('orderToolTip');
</script>


@endauth