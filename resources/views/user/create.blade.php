@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
        @yield('menu_2')
        <div class="content-wrapper">
            <div class="wrapper">
                <div id="content_1" >
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Cargando...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script>

        /*
        function validate(e) {
            if($("#email").val()==""){
                alert("Este campo no puede estar vacio")
                $("#email").focus()
                e.preventDefault();
                return false;
            }
            if($("#password").val()==""){
                alert("Este campo no puede estar vacio")
                $("#password").focus()
                e.preventDefault();
                return false;
            }
            if($("#password").val()!=$("#re_password").val()){
                alert("Las contraseñas no son iguales")
                $("#re_password").focus()
                e.preventDefault();
                return false;
            }

            return true;
        }
        $("#sendForm").click(function (e) {
            if (validate(e)) {
                $('form').submit()
            }
        });
        $(document).ready( function () {

        });*/
    </script>
@endsection
@section('css')
    <style>

    </style>
@endsection

