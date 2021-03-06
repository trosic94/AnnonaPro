<footer class="annona-footer-bg">

	{{-- <div id="freeSHIPPING" class="primary-color p-3 text-center">
		{!! setting('site.free_shipping') !!}
	</div> --}}

	<div class="container-fluid pb-3">

		<div class="row">

			<div class="col col-lg-0 m-0 p-0"></div>

			<div class="col-xl-8 col-lg-12 pt-2 minWidth">

				<div class="row pt-2 pb-4">

					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left">
						<h5>@lang('shop.title_glavni_meni')</h5>
						<div class="border-annona"></div>
						<div class="pt-3">{{ menu('Glavni meni') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left pt-3 pt-md-0">
						<h5>@lang('shop.title_prodavnica')</h5>
						<div class="border-annona"></div>
						<div class="pt-3">{{ menu('Product Menu') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left pt-3 pt-md-0">
						<h5>@lang('shop.title_online_kupovina')</h5>
						<div class="border-annona"></div>
						<div class="pt-3">{{ menu('Online kupovina') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left pt-3 pt-xl-0">
						<h5>@lang('shop.title_radno_vreme')</h5>
						<div class="border-annona"></div>
						<div class="pt-3 text-white">{!! setting('site.radno_vreme') !!}</div>
					</div>
					<div id="shopNAV" class="col-xl-4 col-md-8 text-center text-md-left pt-3 pt-xl-0">
						<h5>@lang('shop.title_newsletter')</h5>
						<div class="border-annona"></div>
						<div class="pt-3 text-justify small text-white">{!! setting('site.nl_subscribe_text') !!}</div>
						<div class="pt-2">
							<form class="needs-validation" method="POST" action="/subscribe-newsletter" novalidate>
                			{{ csrf_field() }}
                			<div class="col-12">
                				@if (\Session::has('mailSentFooter'))
		                            <div class="alert alert-success" role="alert">{!! \Session::get('mailSentFooter') !!}</div>
		                        @endif
		                        @if (\Session::has('emailDuplicate'))
		                            <div class="alert alert-warning" role="alert">{!! \Session::get('emailDuplicate') !!}</div>
		                        @endif
								{!! $errors->first('email', '<div class="alert alert-danger" role="alert">:message</div>') !!}
                				<div class="row bg-white rounded-pill">
	                				<input type="email" name="email" placeholder="@lang('shop.title_enter_email')" class="col-10 ml-2 rounded-pill form-control" style="border: 0">
	                				<button type="submit" class="btn btn-primary btn-circle col-1"><i class="far fa-envelope"></i>
	                            	</button>
	                			</div>
                			</div>
							</form>
						</div>
						<div class="row pt-4">
							<div class="col-auto text-left pr-2">
								<a href="{!! setting('site.facebook') !!}" target="_blank"><i class="fab fa-facebook-f text-primary {{ (setting('site.facebook') == '')? 'd-none':'d-block' }}"></i></a>
							</div>	
							<div class="col-auto text-left pl-2">
								<a href="{!! setting('site.instagram') !!}" target="_blank"><i class="fab fa-instagram text-primary {{ (setting('site.instagram') == '')? 'd-none':'d-block' }}"></i></a>
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="col col-lg-0 m-0 p-0"></div>

		</div>

		<div class="row">
			<div class="col col-lg-0 m-0 p-0"></div>
			<div class="row col-xl-8 col-lg-12 minWidth">
				<div class="col-lg-2 col-md-6 text-center text-lg-left">
					<a href="/" title="{{ setting('site.title') }}"><img src="/storage/{{ setting('site.footer_logo') }}" alt="{{ setting('site.title') }}" class="img-fluid"></a>
				</div>
				<div class="col-lg-10 col-md-6 border-annona">
				</div>

			</div>
			<div class="col col-lg-0 m-0 p-0"></div>

		</div>

	</div>


	<div class="black text-white pt-1 pb-1 small text-center">
		@lang('shop.footer_copy_1') <span class="vLine">|</span> <span class="OSM">Design by <a href="https://www.onestopmarketing.rs" target="_blank" title="One Stop Marketing"><img src="{{ URL::asset('/images/footer/osm-logo.png') }}" alt="One Stop Marketing"></a></span>
	</div>

</footer>

@include ('includes.cookie')

@php
// echo '<pre>';
// print_r($catOznake);
// echo '</pre>';
@endphp