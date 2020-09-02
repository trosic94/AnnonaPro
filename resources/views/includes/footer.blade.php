<footer class="grey">

	<div id="freeSHIPPING" class="blue p-3 text-center">
		{!! setting('site.free_shipping') !!}
	</div>

	<div class="container-fluid pt-5 pb-3">

		<div class="row">

			<div class="col col-lg-0 m-0 p-0"></div>

			<div class="col-xl-8 col-lg-12 minWidth">

				<div class="row border-top border-light pt-4 pb-4">

					<div class="col-xl-2 col-md-6 text-center text-lg-left">
						<a href="/" title="M Games" ><img src="/storage/{{ setting('site.footer_logo') }}" alt="{{ setting('site.title') }}"></a>
					</div>

					<div id="shopNAV" class="col-xl-3 col-md-6 text-center text-md-left">
						<h5>@lang('shop.title_online_kupovina')</h5>
						{{ menu('Online kupovina') }}
					</div>

					<div class="col-xl-7 col-lg-12">
						<div id="contactINFOfooter" class="col-xl-12 text-right small pr-0 pt-4">
							{!! setting('site.kontakt') !!}
						</div>
					</div>
				</div>

			</div>

			<div class="col col-lg-0 m-0 p-0"></div>

		</div>

	</div>


	<div class="black text-white pt-3 pb-3 small text-center">
		@lang('shop.footer_copy_1') <span class="vLine">|</span> <span class="OSM">Design by <a href="https://www.onestopmarketing.rs" target="_blank" title="One Stop Marketing"><img src="{{ URL::asset('/images/footer/osm-logo.png') }}" alt="One Stop Marketing"></a></span>
	</div>

</footer>

@include ('includes.cookie')

@php
// echo '<pre>';
// print_r($catOznake);
// echo '</pre>';
@endphp