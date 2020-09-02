                                    <div class="col-xl-12">

                                        <div class="card">

                                            <div class="card-header">
                                                <h4 class="card-title font-weight-bold">@lang('shop.my_cart_order_confirmation')</h4>
                                            </div>

                                            <div class="card-body text-center">

                                                    <div id="cartTAC" class="form-check">
                                                        <input name="cartTAC" type="checkbox" class="form-check-input" id="cartTAC_confirmation" required>
                                                        <label class="form-check-label" for="cartTAC_confirmation">@lang('shop.my_cart_tac_txt')</label>
                                                    </div>

                                                <button id="orderConfirm" class="btn pounded-pill rounded-pill mt-4" onclick="submitOrder(event)" {{ ($cart)? '':'disabled' }}>@lang('shop.btn_order')</button>

                                        	</div>

                                        </div>

                                    </div>