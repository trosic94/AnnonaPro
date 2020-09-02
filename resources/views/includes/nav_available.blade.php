<!-- Accordion card -->
<div id="lefNav" class="card">

	<div class="card-header p-0 pb-3 pt-3" role="tab" id="available">
	  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseAVL" aria-expanded="true" aria-controls="collapseAVL">
	    <h5 id="filterTitle" class="mb-0">
	      @lang('shop.title_available') <i class="fas fa-angle-down rotate-icon"></i>
	    </h5>
	  </a>
	</div>

	<div id="collapseAVL" class="collapse show" role="tabpanel" aria-labelledby="available" data-parent="#accordionEx">
	  <div id="availableCHKwrap" class="card-body p-0 pb-3 text-white">

		<div class="form-check">
			<input type="radio" name="available" class="form-check-input" id="availableYES" value="1" onclick='getVal()' checked>
			<label class="form-check-label" for="availableYES">@lang('shop.title_on_stock')</label>
		</div>

		<div class="form-check">
			<input type="radio" name="available" class="form-check-input" id="availableNO" value="0" onclick='getVal()' {{ ($searchREQ['available'] == 0)? 'checked':'' }}>
			<label class="form-check-label" for="availableNO">@lang('shop.title_not_on_stock')</label>
		</div>

	  </div>
	</div>

</div>