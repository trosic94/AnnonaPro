
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
                            <h1>@lang('shop.login_title')</h1>
                        </div>

                        <div class="row">

                            <div class="col-xl-6 col-md-6">
                                {!! setting('site.login_text') !!}
                            </div>

                            <div class="col-xl-6 col-md-6">

                                @include('auth.includes.form_login')

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
