@if (count($navCategory) > 0)

<!-- Accordion card -->
<div id="lefNav" class="card">

	<div class="card-header p-0 pb-3 pt-3" role="tab" id="categories">
	  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseCAT" aria-expanded="true" aria-controls="collapseCAT">
	    <h5 id="filterTitle" class="mb-0">
	      @lang('shop.title_categories') <i class="fas fa-angle-down rotate-icon"></i>
	    </h5>
	  </a>
	</div>

	<div id="collapseCAT" class="collapse show" role="tabpanel" aria-labelledby="categories" data-parent="#accordionEx">
	  <div class="card-body p-0 pb-3 text-white">

	  	<ul id="catNAV" class="">

	  		@php
	  			// proveravam da li se se nalazimo na SEARCH
	  			// ako jeste, dodaje se 'products' na URL
	  			$currURL_arr = explode('/', url()->current());
	  			$daLiJeSearch = end($currURL_arr);		
	  		@endphp

		@for ($c = 0; $c < count($navCategory); $c++)

			<li>
				
			@if ($daLiJeSearch == 'search' && $navCategory[$c]['pcat_slug'] != 'products')
				<a href="products/{{ $navCategory[$c]['pcat_slug'] }}/{{ $navCategory[$c]['cat_slug'] }}">{{ $navCategory[$c]['cat_name'] }} {{-- <span class="ml-2">({{ $navCategory[$c]['prod_count'] }})</span> --}}</a>
			@else
				<a href="{{ $navCategory[$c]['pcat_slug'] }}/{{ $navCategory[$c]['cat_slug'] }}">{{ $navCategory[$c]['cat_name'] }} {{-- <span class="ml-2">({{ $navCategory[$c]['prod_count'] }})</span> --}}</a>
			@endif

			</li>
		@endfor
		</ul>

	  </div>
	</div>

</div>

@php
// echo '<pre class="text-white">';
// print_r($navCategory);
// echo '</pre>';
@endphp

@endif