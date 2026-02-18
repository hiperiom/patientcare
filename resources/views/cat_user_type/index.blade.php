@extends('component.template_1')

@section('title')
    CMDLT | Patientcare@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    {{--@include('component.menu_paciente')--}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="wrapper">
            @yield('menu_2')
            <div class="content">
                <div class="container">
                    <div class="row mt-3 mb-3 pl-3 pr-3 justify-content-center">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                            <h1 class="display-5 text-primary" style="font-weight: 400 !important;" >Bienvenido al <br>sistema de atención</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="card-deck">
                        <div class="card" data-opcion="{{$paciente_id}}">
                              <img class="card-img-top" src="{{asset('image/system/icono-paciente-color-sinborde.svg')}}" alt="Card image cap">
                              <div class="card-body text-center">
                                <h5 class="card-title display-5 width-100 text-primary">Paciente</h5>
                                <p class="card-text">Acceso para personas que desean afiliarse al programa de atención domiliciliaria.</p>
                                <p class="card-text"><small class="text-muted"></small></p>
                              </div>
                            </div>
                            <div class="card" data-opcion="{{$medico_id}}">
                              <img class="card-img-top" src="{{asset('image/system/icono-medico-color-3.svg')}}" alt="Card image cap">
                              <div class="card-body text-center">
                                <h5 class="card-title display-5 width-100 text-primary">Equipo de salud</h5>
                                <p class="card-text">Acceso para personal de salud.</p>
                                <p class="card-text"><small class="text-muted"></small></p>
                              </div>
                            </div>
                            <div class="card" data-opcion="{{$familiar_id}}">
                              <img class="card-img-top" src="{{asset('image/system/icono-paciente-familia.svg')}}" alt="Card image cap">
                              <div class="card-body text-center">
                                <h5 class="card-title display-5 width-100 text-primary">Familiar</h5>
                                <p class="card-text">Asseso para familiares de pacientes registrados.</p>
                                <p class="card-text"><small class="text-muted"></small></p>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
@section('script')
<script>
        $(".card").click(function (e) {
            e.preventDefault();
            //alert();
            irA($(this).data('opcion'))
        });
        var tipoUsuario= [
            {"id":0,"description":"Paciente"},
            {"id":1,"description":"Médico"},
            {"id":2,"description":"Enfermero"}
        ];
    function irA(params) {
        location.href="auth/login/"+params
    }
    $(document).ready(function () {

        //cargarPagina('mensaje','.mensaje')
        //cargarPagina('notificacion','.notificacion')
    });
</script>
@endsection
@section('css')
    <style>
        .card:hover{
            -webkit-box-shadow: 24px 40px 79px 12px rgba(0,0,0,0.27);
            -moz-box-shadow: 24px 40px 79px 12px rgba(0,0,0,0.27);
            box-shadow: 24px 40px 79px 12px rgba(0,0,0,0.27);
            cursor:pointer;
            transform: scale(1.1);
            -webkit-transition: all 500ms ease-in-out;
            -moz-transition: all 500ms ease-in-out;
            -ms-transition: all 500ms ease-in-out;
            -o-transition: all 500ms ease-in-out;
            z-index: 1000;
            background-color: #E2E6EA;
        }
    </style>
@endsection
