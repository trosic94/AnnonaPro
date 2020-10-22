@extends ('includes.page')

@section ('content')

<div id="pageWrap">

    @include('includes.breadcrumb')

    <div class="row mt-4">

        <div class="col-xl-12">

            <h4 class="text-uppercase text-secondary">{{ $category->name }}</h4>

        </div>

    </div>

    <div class="staticContent m">

        <div class="container-fluid px-0 mt-5">

            <div class="row">

                <div class="col-xl-12">
                    <img src="/storage/{{ $category->cat_image }}" alt="{{ $category->name }}" class="img-fluid">
                </div>

            </div>

        </div>

    </div>


@php
    echo '<pre>';
    print_r($category);
    echo '</pre>';
@endphp

</div>
@endsection