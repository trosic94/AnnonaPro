@extends ('includes.page')

@section ('content')

<div id="pageWrap">

    <div class="row mt-5">

    	<div class="col-xl-12">

			<div class="mainTitle">
				<h1>{{ $page->title }}</h1>
			</div>

    	</div>

    </div>


	@switch($page->id)
		@case(9)

			@include ('page.contact')

			@break

		@case(10)

			@include ('page.payment-error')

			@break

		@case(11)

			@include ('page.thank-you')

			@break		

		@default

			<div class="staticContent"> 

				{!! $page->body !!}

			</div>

	@endswitch

@php
    // echo '<pre>';
    // print_r($page);
    // echo '</pre>';
@endphp

</div>


@endsection