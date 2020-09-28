<footer class="annona-footer-bg">

	{{-- <div id="freeSHIPPING" class="primary-color p-3 text-center">
		{!! setting('site.free_shipping') !!}
	</div> --}}

	<div class="container-fluid pb-3 minWidth ">

		<div class="row d-flex justify-content-center">

			{{-- <div class="col col-lg-0 m-0 p-0"></div> --}}

			<div class="col-xl-8 col-lg-8 pt-2">

				<div class="row pt-2 pb-4">

					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left">
						<h5>@lang('shop.title_glavni_meni')</h5>
						<div class="border-annona w-25"></div>
						<div class="pt-3">{{ menu('Glavni meni') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left pt-3 pt-md-0">
						<h5>@lang('shop.title_prodavnica')</h5>
						<div class="border-annona w-25"></div>
						<div class="pt-3">{{ menu('Product Menu') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left pt-3 pt-md-0">
						<h5>@lang('shop.title_online_kupovina')</h5>
						<div class="border-annona w-25"></div>
						<div class="pt-3">{{ menu('Online kupovina') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-2 col-md-4 text-center text-md-left pt-3 pt-xl-0">
						<h5>@lang('shop.title_radno_vreme')</h5>
						<div class="border-annona w-25"></div>
						<div class="pt-3">{{ menu('Radno vreme') }}</div>
					</div>
					<div id="shopNAV" class="col-xl-4 col-md-8 text-center text-md-left pt-3 pt-xl-0">
						<h5>@lang('shop.title_newsletter')</h5>
						<div class="border-annona w-25"></div>
						<div class="pt-3 text-justify small">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						<div class="pt-2">
							<div class="md-form white md-bg input-with-post-icon rounded-pill">
								<i class="far fa-envelope input-prefix rounded-circle text-white primary-color p-2 mr-n3"></i>
								<input type="text" id="form2_0" class="form-control rounded-pill" style="padding:0.3rem 0.7rem 0.2rem !important">
								<label for="form2_0" class="mt-n2">unesi e-mail adresu </label>
							  </div>
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

					{{-- <div class="col-xl-7 col-lg-12">
						<div id="contactINFOfooter" class="col-xl-12 text-right small pr-0 pt-4">
							{!! setting('site.kontakt') !!}
						</div>
					</div> --}}
				</div>

			</div>

			{{-- <div class="col col-lg-0 m-0 p-0"></div> --}}

		</div>

		<div class="row d-flex justify-content-center">
			<div class="row col-xl-8 col-lg-8 minWidth">
				<div class="col-lg-2 col-md-6 text-center text-lg-left">
					<a href="/" title="{{ setting('site.title') }}"><img src="/storage/{{ setting('site.footer_logo') }}" alt="{{ setting('site.title') }}" class="img-fluid"></a>
				</div>
				<div class="col-lg-10 col-md-6 border-annona">
				</div>

			</div>

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