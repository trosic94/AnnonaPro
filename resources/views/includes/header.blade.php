<header>
	<div class="container-fluid pt-3 pb-3">

		<div class="row">

			<div class="col col-lg-0 m-0 p-0"></div>

			<div class="col-xl-8 col-lg-12 minWidth">

			<div class="row">
			    <div class="col-lg-2 text-center text-lg-left">
			    	<a href="/" title="M Games"><img src="/storage/{{ setting('site.logo') }}" alt="{{ setting('site.title') }}"></a>
			    </div>
				<div class="col-lg-10">
					<div class="row">
						<div id="contactINFOhead" class="col-xl-12  text-center text-lg-right small">
							{!! setting('site.kontakt') !!}
						</div>
					</div>
					<div class="row justify-content-end pr-3">
						@include ('includes.search_form')
						@include ('includes.my_favourites')
						@include ('includes.my_profile')
						@include ('includes.my_cart')
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