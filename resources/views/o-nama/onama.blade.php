@extends ('includes.page')

@section ('content')

<div id="pageWrap">
    @include('includes.breadcrumb')
    <div class="row mt-4">

        <div class="col-xl-12">

            <h4 class="text-uppercase text-secondary">{{ $oNama_page->title }}</h4>

        </div>

    </div>



    <div class="staticContent">

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 pl-0"><img class="img-fluid"
                        src="storage/{{ $oNama_page->image }}" alt="{{ $oNama_page->title }}" width="600" />
                        </div>
                        <div class="col-md-6 pl-0">
                            {!! $oNama_page->body !!}
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-md-12">

                            <ul class="nav nav-tabs nav-justified">

                                @foreach($oNama_posts as $postKey => $post)

                                    <li class="nav-item"><a class="nav-link {{ ($postKey == 0)? 'active':'' }}" href="#tab_{{ $post->id }}" data-toggle="tab">{{ $post->title }}</a></li>

                                @endforeach
                                                               
                            </ul>
                            <div class="tab-content px-0">

                                @foreach($oNama_posts as $postKey => $post)

                                    <div id="tab_{{ $post->id }}" class="tab-pane container {{ ($postKey == 0)? 'active':'' }} px-0 mx-0">
                                        {!! $post->body !!}
                                    </div>

                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>


@php
    // echo '<pre>';
    // print_r($oNama_posts);
    // echo '</pre>';
@endphp

@endsection