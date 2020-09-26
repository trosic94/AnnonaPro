@if (count($navCategory) > 0)

<!-- Accordion card -->
	

		<nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse ">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link pl-0 text-nowrap" href="#"><i class="fa fa-bullseye fa-fw"></i> <span class="font-weight-bold">Brand</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Codeply</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-star codeply fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-star fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
	
				{{-- 	<div id="lefNav" class="card">
						@foreach($navCategory as $navCategory1)
								    <h5 id="filterTitle" class="mb-0 ">
								      {{$navCategory1['name']}}
								    </h5>
								
								  <div class="card-body p-0 pb-3 text-white">

								  	<ul id="catNAV" class="">
								  		
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