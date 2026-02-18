@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user_menu')
    @endif
@endsection
@section('content')
        @yield('menu_2')
        <div class="">
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

@endsection
@section('script')
    <script>
        document.addEventListener("click",async(e)=> {
            if (e.target.matches(".btn-alert")) {
                let model = new UserCuestAlert({ "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']});
                    model.create()
            }
            if (e.target.matches(".btn-resbalar")) {
                let model = new UserCuestResbalar({ "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']});
                    model.create()
            }
            if (e.target.matches(".btn-cirugia")) {
                let model = new UserCuestRiesgoQuirurgico({ "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']});
                    model.create()
            }
            if (e.target.matches(".btn-vip")) {
                let model = new UserVIP({ "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']});
                    model.create()
            }
            if (e.target.matches("#submit_vip")) {
                let model = new UserVIP( { "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']} );
                    model.store()
            }
            if (e.target.matches("#submit_alert")) {
                let model = new UserCuestAlert( { "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']} );
                    model.store()
            }
            if (e.target.matches("#submit_resbalar")) {
                let model = new UserCuestResbalar( { "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']} );
                    model.store()
            }
            if (e.target.matches("#submit_cirugia")) {
                let model = new UserCuestRiesgoQuirurgico( { "value":e.target.dataset['value'],"episodio_id":e.target.dataset['episodio_id'],"user_id_paciente":e.target.dataset['user_id_paciente']} );
                    model.store()
            }
        })

        $(document).ready( function () {

            UserMedico.getMedicosByCargo();


            var minutos =1;//valor a cambiar
            var milisegundos = minutos*60000;
            setInterval(function () {
                get('/sessionExist')
                .then(response=>{
                    if(response){

                        message = Component.alertMessage("expire_sesion");
                        Toast.fire({
                            icon: message['imagen'],
                            title: message['title'],
                            text: message['message'],
                            timer:15000,
                            didOpen: () => {
                                setInterval(() => {
                                    location.href = '/finalizarSesion'
                                }, 14000)
                            },
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                location.href = '/finalizarSesion'
                            }
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.href = '/finalizarSesion'
                            }
                        })
                        //location.href = '/finalizarSesion'
                        //alert("Su sesión ha finalizado por inactividad")
                    }
                })
            },milisegundos);


            /*
            UserMedico.getMedicos()
            .then(response=>{
                console.log(response)
                if (Object.keys(response).length) {
                   medico_tratante =  response.filter(param => param.cat_user_medico_cargo_id == 1);
                }
                console.log(medico_tratante)
            });*/

            Component.viewCovid("#content_1")
            .then(function () {
                Component.menuAreas("#cat_user_ubicacion_menu")

            })
            .then(function () {
                Component.newsSignos(".marquee-with-options");
                setInterval(function() {
                    Component.newsSignos(".marquee-with-options");
                }, 300000) //5min
            })
            .then(function () {

                Component.menu('te')
                activarTooltip();
            })

        });

    </script>

@endsection
@section('css')
    <style>
            .heartbeat_infinity{-webkit-animation:heartbeat2 1.5s ease-in-out infinite both;animation:heartbeat2 1.5s ease-in-out infinite both}
            @-webkit-keyframes heartbeat2{from{-webkit-transform:scale(1);transform:scale(1);-webkit-transform-origin:center center;transform-origin:center center;-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}10%{-webkit-transform:scale(.91);transform:scale(.91);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}17%{-webkit-transform:scale(.98);transform:scale(.98);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}33%{-webkit-transform:scale(.87);transform:scale(.87);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}45%{-webkit-transform:scale(1);transform:scale(1);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}}@keyframes heartbeat2{from{-webkit-transform:scale(1);transform:scale(1);-webkit-transform-origin:center center;transform-origin:center center;-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}10%{-webkit-transform:scale(.91);transform:scale(.91);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}17%{-webkit-transform:scale(.98);transform:scale(.98);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}33%{-webkit-transform:scale(.87);transform:scale(.87);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}45%{-webkit-transform:scale(1);transform:scale(1);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}}
            .prealta {

                -webkit-animation: mymove 2s infinite; /* Chrome, Safari, Opera */
                animation: mymove 2s infinite;
            }
            /* Chrome, Safari, Opera */
            @-webkit-keyframes mymove {
                from {background-color:#e7e8e8b3;color:var(--color-esperanza-light)}
                to {background-color: white;color: var(--color-custom-primary) }
            }

            /* Standard syntax */
            @keyframes mymove {
                from {background-color: #e7e8e8b3;color:var(--color-esperanza-light)}
                to {background-color: white;color: var(--color-custom-primary) }
            }
            #menu-pad > .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                color: #ffffff !important;
                background-color: var(--success);
            }
            .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                color: var(--white) !important;
                background-color: var(--success);
            }
            #menu-pad >.badge-gray {
                background-color: var(--white) !important;
            }
            #menu-pad.bg-light, .bg-light>a {
                color: var(--primary) !important;
            }
            .datepicker table tr td.active.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover.active, .datepicker table tr td.active.disabled:hover.disabled, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active.disabled:hover[disabled], .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active:active, .datepicker table tr td.active:hover, .datepicker table tr td.active:hover.active, .datepicker table tr td.active:hover.disabled, .datepicker table tr td.active:hover:active, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active:hover[disabled], .datepicker table tr td.active[disabled] {
            background-color: var(--primary) !important;
        }
        .datepicker table tr td.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: -ms-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: -webkit-gradient(linear,0 0,0 100%,from(var(--primary)),to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: -o-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: linear-gradient(to bottom,var(--primary),var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }
        .next,
        .prev,
        .datepicker-switch,
        .dow{
            color:var(--primary) !important;
        }
        .datepicker-inline {
            width: 100%;
        }
    </style>
@endsection
