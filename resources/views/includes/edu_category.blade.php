@if (count($navCategory) > 0)

<!-- Accordion card -->
@foreach($navCategory as $navCategory1)
	<div id="lefNav" class="accordion modified-accordion p-0">
	  <div class="card bg-white  border-0">
	    <div class="card-header text-primary p-0" id="headingOne">
	      	<h5 id="filterTitle" class="mb-0 p-0" data-toggle="collapse" data-target="#collapse{{$navCategory1['name']}}" aria-expanded="true" aria-controls="collapse{{$navCategory1['name']}}">
		 		{{$navCategory1['name']}}
		    </h5>
	    </div>

	    <div id="collapse{{$navCategory1['name']}}" class="collapse show " aria-labelledby="headingOne">
	      <div class="card-body p-0 pb-3">
	      		<ul id="catNAV" class="pt-3">
					@foreach($navCategory1['posts'] as $post)
						<li >
							<a href="edukacija/{{ $post['slug'] }}">{{ $post['title'] }}</a>
						</li>
					@endforeach
				</ul>
	  	  </div>
	    </div>
	  </div>
	</div>
@endforeach

					{{-- <div id="lefNav" class="card">
						@foreach($navCategory as $navCategory1)
								    <h5 id="filterTitle" class="mb-0 ">
								      {{$navCategory1['name']}}
								    </h5>
								
								  <div class="card-body p-0 pb-3 text-white">

								  	<ul id="catNAV" class="pt-3">
								  		
								  		@php

								  		@endphp

									@foreach($navCategory1['posts'] as $post)
										<li>
											<a href="edukacija/{{ $post['slug'] }}">{{ $post['title'] }}</a>
										</li>
									@endforeach
									</ul>

								  </div>
								  @endforeach
					</div>	 --}}
			
		


@endif