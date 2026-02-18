@extends('component.template_consulta_externa')

@section('title')
    CMDLT | Consulta Externa
@endsection
@section('header')
@endsection
@section('menu_2')
@endsection
@section('content')
    <div id="App" class="fade-in h-100 d-flex align-items-center justify-content-center">
        <div class="loading-box">
            <div id="loading_box" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="w-100 d-flex  justify-content-center align-items-center">
                            <img class="heartbeat2" style="height:5em;"
                                src="/image/system/logo-cmdlt_mono.svg" alt="Logo Not Found">
                        </div>
                        <div class="d-flex m-4 justify-content-center text-white">
                            <span>
                                Espere un momento por favor...
                            </span>
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
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
        document.querySelector("body").classList.add("login-page")
        let user_centro_salud_id = 1;
        let cat_user_type_id = 2;
        let app_name_version = 'CMDLT' //'<?= json_encode(config("app.APP_NAME_VERSION") ) ?>';
        
        
        //console.log(app_name_version)
        
        const useState ={
                "user_centro_salud_id" :user_centro_salud_id,
                "cat_user_type_id" :cat_user_type_id,
                "app_name_version" :app_name_version,
                "formCreatePaciente":{
                    "tipo_registro"     : "personal",
                    "cedula_personal"   : "",
                    "cat_user_family_id"        : "",
                    "nacionalidad"      : "V",
                    "cedula"            : "",
                    "email"             : "",
                    "password"          : "",
                    "password_repeat"   : "",
                    "nombres"           : "",
                    "apellidos"         : "",
                    "genero"            : "m",
                    "fnacimiento"       : "",
                    "telefono_movil"    : "",
                    "cat_estado_id"     : "14",
                    "cat_municipio_id"  : "180",
                    "description"       : "Caracas",    //ciudad
                    "domicilio"         : "",
                    "tarjeta_soy_chacao": "",
                    "fecha_ingreso"     : "",
                    "cat_genero":[
                        {id:"m",description:"Masculino"},
                        {id:"f",description:"Femenino"},
                    ],
                    "cat_nacionalidad":[
                        {id:"V",description:"V"},
                        {id:"E",description:"E"},
                        {id:"P",description:"P"},
                        {id:"J",description:"J"},
                    ],
                },
                
                "cat_genero":[
                    {id:"m",description:"Masculino"},
                    {id:"f",description:"Femenino"},
                ],
                "cat_nacionalidad":[
                    {id:"V",description:"V"},
                    {id:"E",description:"E"},
                    {id:"P",description:"P"},
                    {id:"J",description:"J"},
                ],
                "cat_estado":[],
                "cat_municipio": [],
                "cat_especialidad":[],
                "cat_centro_salud":[],
            } 
        console.log(useState)
        //console.log(cat_user_type_id)
    </script>
    <script src="/component/App.js" type="module"></script>
    {{-- <script>
        
        
    </script>
    <script src="/component/index/index.js" type="module"></script> --}}
@endsection
@section('css')
    <style>
        .heartbeat2 {
            -webkit-animation: heartbeat2 1.5s ease-in-out infinite both;
            animation: heartbeat2 1.5s ease-in-out infinite both
        }

        @-webkit-keyframes heartbeat2 {
            from {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: center center;
                transform-origin: center center;
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            10% {
                -webkit-transform: scale(.91);
                transform: scale(.91);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            17% {
                -webkit-transform: scale(.98);
                transform: scale(.98);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            33% {
                -webkit-transform: scale(.87);
                transform: scale(.87);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            45% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }
        }

        @keyframes heartbeat2 {
            from {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: center center;
                transform-origin: center center;
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            10% {
                -webkit-transform: scale(.91);
                transform: scale(.91);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            17% {
                -webkit-transform: scale(.98);
                transform: scale(.98);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            33% {
                -webkit-transform: scale(.87);
                transform: scale(.87);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            45% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }
        }

        .swing-in-top-fwd {
            -webkit-animation: swing-in-top-fwd 1s cubic-bezier(.175, .885, .32, 1.275) both;
            animation: swing-in-top-fwd 1s cubic-bezier(.175, .885, .32, 1.275) both
        }

        @-webkit-keyframes swing-in-top-fwd {
            0% {
                -webkit-transform: rotateX(-100deg);
                transform: rotateX(-100deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 0
            }

            100% {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 1
            }
        }

        @keyframes swing-in-top-fwd {
            0% {
                -webkit-transform: rotateX(-100deg);
                transform: rotateX(-100deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 0
            }

            100% {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 1
            }
        }

        .shake-lr {
            -webkit-animation: shake-lr 3s cubic-bezier(.455, .03, .515, .955) both;
            animation: shake-lr 3s cubic-bezier(.455, .03, .515, .955) both
        }

        @-webkit-keyframes shake-lr {

            0%,
            100% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                -webkit-transform-origin: 50% 50%;
                transform-origin: 50% 50%
            }

            10% {
                -webkit-transform: rotate(8deg);
                transform: rotate(8deg)
            }

            20%,
            40%,
            60% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg)
            }

            30%,
            50%,
            70% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg)
            }

            80% {
                -webkit-transform: rotate(-8deg);
                transform: rotate(-8deg)
            }

            90% {
                -webkit-transform: rotate(8deg);
                transform: rotate(8deg)
            }
        }

        @keyframes shake-lr {

            0%,
            100% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                -webkit-transform-origin: 50% 50%;
                transform-origin: 50% 50%
            }

            10% {
                -webkit-transform: rotate(8deg);
                transform: rotate(8deg)
            }

            20%,
            40%,
            60% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg)
            }

            30%,
            50%,
            70% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg)
            }

            80% {
                -webkit-transform: rotate(-8deg);
                transform: rotate(-8deg)
            }

            90% {
                -webkit-transform: rotate(8deg);
                transform: rotate(8deg)
            }
        }

        .fade-in {
            -webkit-animation: fade-in 1.2s cubic-bezier(.39, .575, .565, 1.000) both;
            animation: fade-in 1.2s cubic-bezier(.39, .575, .565, 1.000) both
        }

        @-webkit-keyframes fade-in {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        .login-page,
        .register-page {
            -ms-flex-align: center;
            align-items: center;
            background-color: var(--primary) !important;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            height: 100vh;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .loading-box {
            display: flex;
            align-items: center;
            height: 100vh;
            overflow: auto;
        }

        .login-card-body,
        .register-card-body {
            background: transparent !important;
            border-top: 0;
            color: #666;
            padding: 20px;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: var(--light);
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 2.25rem !important;
        }

        @media (max-width: 576px) {

            .login-box,
            .register-box {
                margin-top: 0.5rem !important;
                width: 90vw !important;
            }
        }

    </style>
@endsection
