<div id="myFAV" class="col-auto pl-1 pl-sm-2 mr-2 pr-sm-2">
	<a class="rounded-pill favouritesLNK" href="/favourites">
		<span class="badge red text-prim {{ ($favouritesCNT > 0)? '':'d-none' }}">{{ $favouritesCNT }}</span>
        <div id="addTo_FAV">
			<i class="far fa-heart fa-2x text-primary {{ ($favouritesCNT > 0)? 'd-none':'d-block' }}"></i>
			<i class="fas fa-heart fa-2x text-primary {{ ($favouritesCNT > 0)? 'd-block':'d-none' }}"></i>
        </div>
	</a>
</div>

@php
// echo '<pre>';
// print_r($userDATA);
// echo '</pre>';
@endphp