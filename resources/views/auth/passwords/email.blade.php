
@extends ('includes.master')

@section ('pageContent')

<content>

<div class="container-fluid">

    <div class="row">

        <div class="col col-lg-0 m-0 p-0">
            {{-- brendiranje --}}
        </div>

        <div class="col-xl-8 col-lg-12 minWidth">

            <div id="pageWrap">


                <div class="row mt-5">

                    <div class="col-xl-12">

                        <div class="mainTitle">
                            <h1>@lang('shop.forgot_password_title')</h1>
                        </div>

                        <div class="row mt-5">

                        <div class="col-xl-6 col-md-6">
                            {!! setting('site.change_password_email') !!}
                        </div>

                        <div class="col-xl-6 col-md-6">

                        <form class="needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>

                        {{ csrf_field() }}

                        <div class="md-form mt-3">
                            <input type="text" name="email" id="formEMAIL" class="form-control" value="{{ old('email') }}" autocomplete="off" required>
                            <label for="formEMAIL">@lang('shop.login_email')</label>
                            {!! $errors->first('email', '<div class="formERR">:message</div>') !!}
                        </div>




                        <button type="submit" class="btn btn-primary btn-block my-4">@lang('shop.btn_confirm')</button>


                        </form>


                        </div>






                    </div>

                </div>


            </div>

        </div>





        </div>

        <div class="col col-lg-0 m-0 p-0">
            {{-- brendiranje --}}
        </div>

    </div>

</div>

<script type="text/javascript">
(function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();
</script>


</content>

@endsection
