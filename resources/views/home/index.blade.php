@extends ('includes.page')

@section ('content')

@include('home.slider')
{{-- @include('home.special_tabs') --}}
@include('home.preporuceno')
@include('home.banner_1')

@include('home.row_1')
@include('home.company_slider')


<script type="text/javascript">
$( document ).ready(function() {
	new WOW().init();
});
</script>


<link rel="stylesheet" type="text/css" href="{{ URL::to('/css/slick.css') }}">
<script type="text/javascript" src="{{ URL::to('/js/slick.min.js') }}"></script>

@endsection