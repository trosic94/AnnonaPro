<h4 onclick="leftCatNav()">Asortiman</h4>
<ul class="catNAV">

@foreach($shared['catOznake'] as $key => $kategorija)

	<li><a href="/oznake/{{ $kategorija->slug }}" title="{{ $kategorija->name }}">{{ $kategorija->name }} ({{ $kategorija->product_count }})</a></li>

@endforeach

</ul>

<script type="text/javascript">
$(document).ready(function() {

});	
</script>