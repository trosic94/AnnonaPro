<header>

	<div class="container-fluid pb-3 pt-1">
		<div class="row">
			<div class="col col-lg-0 m-0 p-0"></div>

			<div class="col-xl-8 col-lg-12 minWidth">

				<div class="col-lg-12 pl-0">
					<div class="row">
						<div  class="col-xl-6 small pt-2 pb-0 mb-n1 text-muted">
							{!! setting('site.kontakt') !!}
						</div>
						<div id="social" class="small col-xl-4 text-right">

						</div>
						<div id="lang" class="small col-xl-2 text-right">
							{!! setting('site.Jezik') !!}
						</div>	
					</div>
					<div class="border-bottom mb-3"></div>
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
				</div>
			</div>

			</div>

		<div class="col col-lg-0 m-0 p-0"></div>

	</div>

</header>

{!! menu('Product Menu', 'includes.nav_product') !!}

<script type="text/javascript">
$(document).ready(function() {
    new WOW().init();
});
</script>