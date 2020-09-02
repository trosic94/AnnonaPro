                                    <div class="col-xl-12">

                                    	<div class="card">

                                            <div class="card-header">
                                                <h4 class="card-title font-weight-bold">@lang('shop.my_cart_payment_options')</h4>
                                            </div>

                                            <div class="card-body">

                                            	<p>@lang('shop.my_cart_payment_note')</p>

		                                        <select class="mdb-select md-form" name="payment">
		                                            {{-- <option value="" selected>@lang('shop.title_choose')</option> --}}

		                                            @foreach ($paymenOptions as $key => $payment)
		                                                <option value="{{ $payment->id }}">{{ $payment->title }}</option>
		                                            @endforeach

		                                        </select>

                                    		</div>

                                    	</div>

                                    </div>