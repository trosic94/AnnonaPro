<header>

	<div class="container-fluid pb-2 pt-1">
		<div class="row">
			<div class="col col-lg-0 m-0 p-0"></div>

			<div class="col-xl-8 col-lg-12 minWidth p-0">

				<div class="col-12 pl-0 pr-0">
					<div class="row">
						<div id="contactINFOhead" class="col-12 col-md-8 small pb-1 mb-n1 text-muted">
							{!! setting('site.kontakt') !!}
						</div>
						<div id="contactINFOhead" class="col-6 col-md-2 small text-right pt-2 pb-0 mb-n1">
							<div class="row">
								<div class="col-6 text-right pr-2">
									<a href="{!! setting('site.facebook') !!}" target="_blank"><i class="fab fa-facebook-f text-primary {{ (setting('site.facebook') == '')? 'd-none':'d-block' }}"></i></a>
								</div>	
								<div class="col-6 text-left pl-2">
									<a href="{!! setting('site.instagram') !!}" target="_blank"><i class="fab fa-instagram text-primary {{ (setting('site.instagram') == '')? 'd-none':'d-block' }}"></i></a>
								</div>
							</div>
						</div>
						<div id="langHead" class="col-6 col-md-2 small text-left pb-md-0 pb-2 pr-4 ">
							{{-- {!! setting('site.jezik') !!} --}}
							<select class="mdb-select">
								<option value="sr" data-icon="https://cdn.countryflags.com/thumbs/serbia/flag-round-250.png" class="rounded-circle">
								  SRB</option>
								<option value="en" data-icon="https://cdn.countryflags.com/thumbs/united-states-of-america/flag-round-250.png" class="rounded-circle">
								  ENG</option>
							  </select>
						</div>	
					</div>
					<div class="border-bottom mb-3 p-0"></div>
				</div>
				
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<a href="/" title="{{ setting('site.title') }}"><img src="/storage/{{ setting('site.logo') }}" alt="{{ setting('site.title') }}"></a>
					</div>
					<div class="col-lg-10">
						<div class="row justify-content-end pr-3">
							@include ('includes.search_form')
							@include ('includes.my_favourites')
							@include ('includes.my_cart')
							@include ('includes.my_profile')
						</div>
						<div class="row justify-content-end pr-3">
							{!! menu('Glavni Meni', 'includes.nav_glavni') !!}
						</div>
					</div>
				</div>

			</div>

		<div class="col col-lg-0 m-0 p-0"></div>

	</div>

</header>



<script type="text/javascript">
$(document).ready(function() {
	new WOW().init();
	$('.mdb-select').materialSelect();
});
</script>