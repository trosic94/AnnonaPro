    <div class="productNAV mt-n1">

        <div class="container-fluid pr-0 pl-2">

            <div class="row text-lg-right text-sm-center d-flex justify-content-lg-end justify-content-sm-center">
                <nav class="navbar navbar-light navbar-expand-md shadow-none py-lg-0">
                    <button class="navbar-toggler first-button" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="animated-icon1"><span></span><span></span><span></span></div>
                  </button>
                    {{-- 
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button> --}}
                    <div class="col-12 collapse navbar-collapse pr-lg-0" id="navbarTogglerDemo02">

                        <ul class="navbar-nav">

@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp


@foreach ($items as $item)

    @php

        $originalItem = $item;
        if (Voyager::translatable($item)) {
            $item = $item->translate($options->locale);
        }

        $isActive = null;
        $styles = null;
        $icon = null;

        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:'.$item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:'.$item->color;
        }

        // Check if link is current
        if(url($item->link()) == url()->current()){
            $isActive = 'active';
        }

        // Posavlja se slika na osnovu URLa koji je postavljen
        if($item->icon_class != null) {
            $icon = '<img src="'.$item->icon_class.'">';
        }

    @endphp

				    <li class="{{ $isActive }} nav-item col-auto px-3 py-2">
				        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" class="nav-link" style="background-color: unset;">
				            {!! $icon !!}
				            <span class="ml-2">{{ $item->title }}</span>
				        </a>
				    </li>
@endforeach

				</ul>

                </div>
                </nav>


		</div>

	</div>

</div>