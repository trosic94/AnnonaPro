<!-- Accordion card -->
<div id="lefNav" class="card">

	<div class="card-header p-0 pb-3 pt-3" role="tab" id="manufacturer">
	  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseMNFC" aria-expanded="true" aria-controls="collapseMNFC">
	    <h5 id="filterTitle" class="mb-0">
	      @lang('shop.title_manufacturer') <i class="fas fa-angle-down rotate-icon"></i>
	    </h5>
	  </a>
	</div>

	<div id="collapseMNFC" class="collapse show" role="tabpanel" aria-labelledby="manufacturer" data-parent="#accordionEx">
	  <div class="card-body p-0 pb-3 .text-annona-gray">

	  	<div id="mfcCHKwrap" class="mnfcScroll my-custom-scrollbar-primary">

	  	@foreach ($manufacturers as $mfcKey => $manufacturer)

		<div class="form-check">
		    <input type="checkbox" name="manufacturers" class="form-check-input" id="mnfc_{{ $manufacturer->id }}" value="{{ $manufacturer->id }}" onclick='getVal()' {{ (in_array($manufacturer->id, $searchREQ['mfc']))? 'checked':'' }}>
		    <label class="form-check-label" for="mnfc_{{ $manufacturer->id }}">{{ $manufacturer->name }} <span class="ml-2">({{ $manufacturer->prod_count }})</span></label>
		</div>

		@endforeach

		</div>




	  </div>
	</div>

<script type="text/javascript">
	var myCustomScrollbar = document.querySelector('.mnfcScroll');
	var ps = new PerfectScrollbar(myCustomScrollbar);

	var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');

	myCustomScrollbar.onscroll = function () {
	  scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; right: ${-this.scrollLeft}px`;
	}
</script>

</div>

@php
// echo '<pre class="white">';
// echo count($manufacturers).'<br>';
// print_r($manufacturers);
// echo '</pre>';
@endphp