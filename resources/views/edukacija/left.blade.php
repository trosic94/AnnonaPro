<div class="leftCol  pr-3">

	<!--Accordion wrapper-->
	<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

	<form id="prodSearch" method="POST">

	@include ('includes.edu_category')
	{{-- @include ('includes.nav_manufacturer') --}}
	{{-- @include ('includes.nav_available') --}}
{{-- 	@include ('includes.nav_price') --}}


	{{-- <input type="hidden" name="CATCurrent" value="{{ $CATCurrent }}"> --}}

	</form>


	</div>
	<!-- Accordion wrapper -->

<script type="text/javascript">
$( document ).ready(function() {

	accordianEvent();

});
</script>

</div>