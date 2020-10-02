@extends ('includes.page')

@section ('content')

<div id="pageWrap">
    @include('includes.breadcrumb')
    <div class="row mt-5">

        <div class="col-xl-12">

            <div class="mainTitle">

            </div>

        </div>

    </div>



    <div class="staticContent">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 pl-0"><img class="img-fluid"
                        src="storage/{!! setting('company.o_nama_slika') !!}" alt="{!! setting('company.company_name') !!}" width="600" />
                        </div>
                        <div class="col-md-6 pl-0">
                            {!! setting('company.o_nama_text') !!}
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-md-12">

                            <ul class="nav nav-tabs nav-justified">
                                
                                    <li class="nav-item col-xs-6"><a class="nav-link active" href="#edukacija" data-toggle="tab">edukacija</a></li>
                               
                                    <li class="nav-item col-xs-6"><a class="nav-link" href="#kozmeticki_preparati" data-toggle="tab">kozmetički preparati</a></li>
                             
                                    <li class="nav-item col-xs-6"><a class="nav-link" href="#kozmeticki_program" data-toggle="tab">kozmetički program</a></li>
                          
                                    <li class="nav-item col-xs-6"><a class="nav-link" href="#nadogradnja_trepavica" data-toggle="tab">nadogradnja trepavica</a></li>
                             
                                    <li class="nav-item col-xs-6"><a class="nav-link" href="#trajna_sminka" data-toggle="tab">trajna šminka</a></li>
                               
                            </ul>
                            <div class="tab-content px-0">
                                <div id="edukacija" class="tab-pane container active px-0 mx-0">
                                    {!! setting('company.edukacija_text') !!}
                                </div>
                                <div id="kozmeticki_preparati" class="tab-pane container fade px-0 mx-0">
                                    {!! setting('company.k_preparati_text') !!}
                                </div>
                                <div id="kozmeticki_program" class="tab-pane container fad px-0 mx-0e">
                                    {!! setting('company.k_program_text') !!}
                                </div>
                                <div id="nadogradnja_trepavica" class="tab-pane container fade px-0 mx-0">
                                    {!! setting('company.n_trepavica_text') !!}
                                </div>
                                <div id="trajna_sminka" class="tab-pane container fade px-0 mx-0">
                                    {!! setting('company.t_sminka_text') !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>


@endsection