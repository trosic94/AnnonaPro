@extends ('includes.page')

@section ('content')

<div id="pageWrap">

    @include('includes.breadcrumb')

    <div class="row mt-4">

        <div class="col-xl-12">

            <h4 class="text-uppercase text-secondary">{{ $category->name }}</h4>

        </div>

    </div>

    <div class="staticContent">

        <div class="px-0 mt-5">

            <div class="row">

                <div class="col-xl-12 wow animated fadeIn">
                    <img src="/storage/{{ $category->cat_image }}" alt="{{ $category->name }}" class="img-fluid">
                </div>

            </div>

            <div id="priceListDownloadLink" class="row m-0">
                <div class="col-lg-7 py-2 priceListTXT">@lang('shop.title_pricelist_overview')</div>
                <a class="col-lg-5 py-2 priceListLNK" href="/storage/pdf/AnnonaPro-Cenovnik.pdf" target="_blank"><i class="fas fa-download"></i> @lang('shop.btn_download_pdf')</a>
            </div>

            @foreach ($subCAT as $cKey => $cat)
            <div id="salonWrap" class="row mt-5 wow animated slideInUp mb-5 mb-lg-0">
                <div id="col_{{ $cat->id }}" class="col-lg-6 mb-3 mb-lg-0" style="position: relative;">
                    @if ($cKey == 0)

                        <h3>{{ $cat->name }}</h3>

                        <div class="row">
                        @foreach($posts->where('category_id',$cat->id) as $pKey => $post)
                            <div class="col-lg-6">
                                <div class="serviceTitle" onclick="getContent({{$post->id}},{{ $cat->id }})">{{ $post->title }}</div>
                            </div>
                        @endforeach
                        </div>

                    @else

                        @include('includes.preloader_small')

                        @php
                            $rndService = $posts->where('category_id',$cat->id)->random();
                        @endphp

                        <div class="serviceOne_{{ $cat->id }}">
                            <img src="/storage/{{ $rndService->image }}" alt="{{ $rndService->title }}" class="img-fluid">
                            <h4>{{ $rndService->title }}</h4>
                            <div>{!! $rndService->body !!}</div>
                        </div>

                    @endif
                </div>
                <div id="col_{{ $cat->id }}" class="col-lg-6 mb-3 mb-lg-0" style="position: relative;">
                    @if ($cKey == 0)

                        @include('includes.preloader_small')

                        @php
                            $rndService = $posts->where('category_id',$cat->id)->random();
                        @endphp

                        <div class="serviceOne_{{ $cat->id }}">
                            <img src="/storage/{{ $rndService->image }}" alt="{{ $rndService->title }}" class="img-fluid">
                            <h4>{{ $rndService->title }}</h4>
                            <div>{!! $rndService->body !!}</div>
                        </div>
                    @else
                        <h3>{{ $cat->name }} {{ $cat->id }}</h3>

                        <div class="row">
                        @foreach($posts->where('category_id',$cat->id) as $pKey => $post)
                            <div class="col-lg-6">
                                <div class="serviceTitle" onclick="getContent({{$post->id}},{{ $cat->id }})">{{ $post->title }}</div>
                            </div>
                        @endforeach
                        </div>

                    @endif
                </div>
            </div>
            @endforeach

        </div>

    </div>

<script type="text/javascript">
$( document ).ready(function() {
    new WOW().init();
});
</script>

</div>
@endsection