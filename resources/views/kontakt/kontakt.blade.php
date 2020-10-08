@extends ('includes.page')

@section ('content')

<div id="pageWrap">
    @include('includes.breadcrumb')
    <div class="row mt-4">

        <div class="col-xl-12">

            <h4 class="text-uppercase text-secondary">{{ $pageDATA->title }}</h4>

        </div>

    </div>



    <div class="staticContent">

        <div class="container-fluid px-0 mt-5">
            <p>{!! $pageDATA->body !!} </p>
            <div class="row mt-5">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="contact-bg">
                        @if (\Session::has('mailSent'))
                            <div style="display: block; font-weight: bold; margin-bottom: 20px;"> {!! \Session::get('mailSent') !!}</div>
                        @endif
                    
                        {!! Form::open(['url' => '/posalji-kontakt','class' => 'formWrap', 'id' => 'btnToSend']) !!}
                    
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="formLabel">Ime*</label>
                                {!! Form::text('ime','',['class' => 'form-control border-0']) !!}
                                {!! $errors->first('ime', '<div class="formERR">:message</div>') !!}
                            </div>
                            <div class="col-12 col-md-6 pr-sm-0 ">
                                <label class="formLabel">Prezime*</label>
                                {!! Form::text('prezime','',['class' => 'form-control border-0']) !!}
                                {!! $errors->first('prezime', '<div class="formERR">:message</div>') !!}
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="formLabel">E-mail adresa*</label>
                                {!! Form::text('email','',['class' => 'form-control border-0']) !!}
                                {!! $errors->first('email', '<div class="formERR">:message</div>') !!}
                            </div>
                            <div class="col-12 col-md-6 pr-sm-0">
                                <label class="formLabel">Broj telefona</label>
                                {!! Form::text('telefon','',['class' => 'form-control border-0']) !!}
                                {!! $errors->first('telefon', '<div class="formERR">:message</div>') !!}
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-12">
                                <label class="formLabel">Tekst poruke*</label>
                                {!! Form::textarea('poruka','',['class' => 'form-control border-0']) !!}
                                {!! $errors->first('poruka', '<div class="formERR">:message</div>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                        {!! Form::hidden('hpASSdDGT3e5345345','') !!}
                            <button id="btnToSend" class="btn btn-primary btn-sm mt-3 rounded-pill">Pošalji poruku</button>
                        {!! Form::close() !!}
                            </div>
                        </div>
                   
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 mt-4 mt-sm-0">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">
                            
                            <div id="contactNav" class="quick-contact-widget"> 
                                <h5>{{ setting('company.company_name') }}</h5>
                                <div id="contactINFOhead" class="col-10 small pb-1 mb-n1 text-muted px-0">
                                    {!! setting('site.kontakt') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <div id="contactNav" class="text-md-left pt-3 pt-xl-0">
                                <h5>@lang('shop.title_radno_vreme')</h5>
                                <div class="small">{!! setting('site.radno_vreme') !!}</div>
                            </div>
                        </div>

                    </div>
                    <div class="p-2 white-bg mt-3">
                    <iframe src="{!! setting('company.kontakt_mapa') !!}"  width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@php
    // echo '<pre>';
    // print_r($pageDATA);
    // echo '</pre>';
@endphp

@endsection