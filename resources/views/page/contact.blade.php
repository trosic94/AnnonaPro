<div class="col50" style="padding: 0 20px 0 0;">
	{!! $page->body !!}
</div>
<div class="col50">

	@if (\Session::has('mailSent'))
		<div style="display: block; font-weight: bold; margin-bottom: 20px;"> {!! \Session::get('mailSent') !!}</div>
	@endif

	{!! Form::open(['url' => '/posalji-kontakt','class' => 'formWrap', 'id' => 'btnToSend']) !!}

	<div class="formRow">
		<label class="formLabel">Ime i prezime*</label>
		{!! Form::text('ime','',['class' => 'txtInput']) !!}
		{!! $errors->first('ime', '<div class="formERR">:message</div>') !!}
	</div>

	<div class="formRow">
		<label class="formLabel">E-mail*</label>
		{!! Form::text('email','',['class' => 'txtInput']) !!}
		{!! $errors->first('email', '<div class="formERR">:message</div>') !!}
	</div>

	<div class="formRow">
		<label class="formLabel">Poruka*</label>
		{!! Form::textarea('poruka','',['class' => 'txtTextarea']) !!}
		{!! $errors->first('poruka', '<div class="formERR">:message</div>') !!}

	</div>

	{!! Form::hidden('hpASSdDGT3e5345345','') !!}
	<button id="btnToSend">Pošalji</button>
	{!! Form::close() !!}

</div>

@php
echo '<pre>';
print_r($page);
echo '</pre>';
@endphp