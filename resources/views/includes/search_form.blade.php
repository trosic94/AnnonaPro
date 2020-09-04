<div class="col-12 col-md-auto mb-3 mb-md-0 pr-5">
{!! Form::open(['url' => '/search', 'method' => 'POST','id' => 'siteSearch']) !!}
{!! Form::text('PRETRAGA','',['class' => 'form-control  rounded-pill border-0']) !!}
{!! Form::hidden('CATCurrent',3) !!}
{!! Form::close() !!}
</div>