@extends('component.template')

@section('title')
    CMDLT | Patientcare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    {{--@include('component.menu_paciente')--}}
@endsection
@section('content')
<div class="content-wrapper">
    <div class="wrapper" style="min-height: calc(100vh - 123px) !important;">
            <div id="content_1" >
                @yield('menu_2')
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                            <div id="carouselExampleSlidesOnly" class="carousel slide align-middle mt-5" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">

                                        <img class="d-block w-100 img-fluid p-3" style="margin-top: 5rem !important;" src="{{asset('image/system/patientcarelogo.svg')}}" alt="Bienvenidos al mundo de la telemedicina">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="p-3 mt-5">
                                <form action="{{route('verificarCredenciales')}}" method="POST">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="email">Correo electrónico</label>
                                        <input type="email" class="form-control form-control-lg bg-gray-footer-parodi" name="email" id="email" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="password">Contraseña</label>
                                        <input type="password" class="form-control form-control-lg bg-gray-footer-parodi" name="password" id="password" aria-describedby="helpId" placeholder="">
                                        <small id="helpId2" class="form-text text-muted"></small>
                                    </div>
                                    <input type="hidden" value="{{$message}}" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_type_id" id="cat_user_type_id" aria-describedby="helpId" placeholder="">
                                    <br>
                                    <div class="form-group text-center">
                                        <a href="/passwordReset" class="text-primary">¿Cambiar o recuperar tu contraseña?</a>
                                    </div>
                                    <button id="sendForm" type="submit" class="btn btn-primary btn-lg btn-block mb-3">Iniciar Sesión</button>
                                    {{--<a class="btn btn-default bg-secondary btn-flat btn-block" href="{{route('/')}}">Regresar</a>--}}

                                </form>
                            </div>
                        </div>
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
    message = "{{$message}}";
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

        return true;
    }
    $("#sendForm").click(function (e) {
        if (validate(e)) {
            $('form').submit()
        }
    });
    $(document).ready(function () {




        if (message != 1 && message != 2 && message != 3) {
            $(".modal-body").html(messaje("cat_user_type-error"))
            $("#modelId").modal("show")
        }
        if (getParameterByName("message") == "user-register-success") {
            $(".modal-body").html(messaje(getParameterByName("message")))
            $("#modelId").modal("show")
        }
        if (getParameterByName("message") == "user-register-no-found") {
            $(".modal-body").html(messaje(getParameterByName("message")))
            $("#modelId").modal("show")
        }
        if (getParameterByName("message") == "user-register-error") {
            $(".modal-body").html(messaje(getParameterByName("message")))
            $("#modelId").modal("show")
        }
        //cargarPagina('mensaje','.mensaje')
        //cargarPagina('notificacion','.notificacion')
    });

</script>
@endsection
@section('css')
    <style>
        .userIcon {
            position: absolute;
            height: 1.5em;
            left: 0;
            top: -8px;
        }
    </style>
@endsection
