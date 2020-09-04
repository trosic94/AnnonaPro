<div class="productNAV">

	<div class="container-fluid pr-0">

		<div class="row text-right pt-3 d-flex justify-content-end">

				<div class="col-xl-8 col-lg-12">

				<ul class="nav d-flex justify-content-end">

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
				        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" class="" style="{{ $styles }}">
				            {!! $icon !!}
				            <span class="ml-2">{{ $item->title }}</span>
				        </a>
				    </li>
@endforeach

				</ul>

				</div>


		</div>

	</div>

</div>