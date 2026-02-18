<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMDLT | Consulta Externa</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <link href="/css/select2.min.css" rel="stylesheet" />
    <!-- summernote -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('css/stylePatientcare.css') }}">
    <link rel="stylesheet" href="{{ asset('image/system/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('image/system/icomoon3/style.css') }}">
    <style>
        :root{
                --bg-primary: #185BA9;
                --bs-primary-rgb: rgb(24,91,169);
                --bs-primary-rgb-hover: rgb(21, 75, 138) ;
                --primary:var(--bs-primary-rgb) !important;
                --primary-hover: var(--bs-primary-rgb-hover) !important;
            }

        .btn-primary:hover {
            color: #ffffff;
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
        }
    </style>
    <style>
        .navbar-main-shadow {
            -webkit-box-shadow: 0px 10px 13px -7px #000000, 38px 17px 19px 23px rgb(241 243 244 / 0%);
            box-shadow: 0px 10px 13px -7px #343a40, 38px 17px 19px 23px #f1f3f400;
        }
        .fade-in{-webkit-animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both;animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both}
        @-webkit-keyframes fade-in{0%{opacity:0}100%{opacity:1}}@keyframes fade-in{0%{opacity:0}100%{opacity:1}}


        .heartbeat-infinity {
            -webkit-animation: heartbeat-infinity 1.5s ease-in-out infinite both;
            animation: heartbeat-infinity 1.5s ease-in-out infinite both
        }

        @-webkit-keyframes heartbeat-infinity {
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

        @keyframes heartbeat {
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

        .scale-in-hor-left {
            -webkit-animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-hor-left {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }
        }

        @keyframes scale-in-hor-left {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }
        }

        .scale-in-hor-right {
            -webkit-animation: scale-in-hor-right .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-hor-right .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-hor-right {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }
        }

        @keyframes scale-in-hor-right {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }
        }

        .scale-in-ver-top {
            -webkit-animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-ver-top {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }
        }

        @keyframes scale-in-ver-top {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }
        }

        .scale-in-ver-center {
            -webkit-animation: scale-in-ver-center .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-ver-center .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-ver-center {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                opacity: 1
            }
        }

        @keyframes scale-in-ver-center {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                opacity: 1
            }
        }

        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {
            .dropdown-menu li {
                position: relative;
            }

            .nav-item .submenu {
                display: none;
                position: absolute;
                left: 100%;
                top: -7px;
            }

            .nav-item .submenu-left {
                right: 100%;
                left: auto;
            }

            .dropdown-menu>li:hover {
                background-color: #f1f1f1
            }

            .dropdown-menu>li:hover>.submenu {
                display: block;
            }
        }
        .text-warning-disabled {
            color: var(--warning) !important;
            opacity: 0.4;
        }
        .bg-secondary-cortesia {
            background-color: #d5d6d7 !important;
            width: 100%;
            border: 0;
            color: #000000 !important;
            border-top: 3px solid #ffbf00 !important;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 1rem 3rem rgb(0 0 0 / 18%) !important;
        }
        /* ============ desktop view .end// ============ */

        /* ============ small devices ============ */
        @media (max-width: 991px) {
            .dropdown-menu .dropdown-menu {
                margin-left: 0.7rem;
                margin-right: 0.7rem;
                margin-bottom: .5rem;
            }
        }
        .navbar-dark .form-control-navbar+.input-group-append>.btn-navbar {
            color: var(--primary);
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: var(--secondary);
            border: 1px solid var(--secondary);
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            margin-left: 5px;
            margin-top: 5px;
            padding: 0;
            padding-left: 25px;
            position: relative;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: bottom;
            white-space: nowrap;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: var(--white) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background-color: transparent;
            border: none;
            border-right: 1px solid var(--light);
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            color: var(--white) !important;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            padding: 0 4px;
            position: absolute;
            left: 0;
            top: 0;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 0px !important;
            border-radius: 4px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }

        .select2-cat_especialidad_id>.select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            /* border-color: #80bdff; */
            border: 0 !important;
            color: var(--gray) !important;
            background-color: var(--white) !important;
            z-index: 2;
        }

        .mt-6,
        .my-6 {
            margin-top: 4rem !important;
        }

        [class*='sidebar-light-'] {
            background-color: #f1f3f4 !important;
        }

        .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
            margin-top: 0 !important;
        }

        .layout-navbar-fixed .wrapper .content-wrapper {
            margin-top: 0 !important;
        }

        .direct-chat-text-custom {
            border-radius: 0.3rem;
            background-color: #d2d6de;
            border: 1px solid #d2d6de;
            color: #444;
            margin: 5px 0 0 50px;
            padding: 5px 10px;
            position: relative;
        }

        .cat-cita-status-title {
            font-weight: 800 !important;
            line-height: 1.2;
            color: var(--primary);
            font-size: 1.5em !important;
        }

        .animation__shake {
            -webkit-animation: shake 1500ms;
            animation: shake 1500ms;
        }

        .animation__wobble {
            -webkit-animation: wobble 1500ms;
            animation: wobble 1500ms;
        }

        .preloader {
            display: -ms-flexbox;
            display: flex;
            background-color: #f4f6f9;
            height: 100vh;
            width: 100%;
            transition: height 200ms linear;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 9999;
        }

        .dark-mode .preloader {
            background-color: #454d55 !important;
            color: #fff;
        }

        .bg-chacao {
            height: 100%;
            background: linear-gradient(90deg, #292929 50%, #185BA9 50%);
        }

        .text-black {
            color: #292929;
        }

        .item-text {
            border-radius: 0.3rem;
            background: #d2d6de;
            border: 1px solid #d2d6de;
            color: #444;
            margin: 1%;
            padding: 5px 10px;
            position: relative;
        }
        #headerCitaStatusOptions .small-box {
            border-radius: 1.25rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }
        #headerCitaStatusOptions .small-box>.small-box-footer {
            background: rgba(0, 0, 0, 0.1);
            color: rgba(255, 255, 255, 0.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
            border-bottom-left-radius: 1.25rem;
            border-bottom-right-radius: 1.25rem;
        }
        .btn-warning {
            color: #1F2D3D !important;
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            box-shadow: none;
        }

        .content-wrapper {
            background: #F1F3F4 !important;

            background-color: #F1F3F4 !important;
        }

        body {
            background: #F1F3F4 !important;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #F4F7F7 !important;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #F4F7F7;
            border-top: 0 solid rgba(0, 0, 0, 0.125);
        }
        }

        .shadow-lg-danger {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--danger) !important;
        }

        .shadow-lg-primary {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--primary) !important;
        }

        .shadow-lg-success {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--success) !important;
        }

        .shadow-lg-warning {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--warning) !important;
        }

        .shadow-lg-info {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--info) !important;
        }

        #pills-tab-historial-citas-opaciente2 .nav-link.active,
        #pills-tab-historial-citas-opaciente .nav-link.active {
            color: #ffffff;
            background-color: #00aaff !important;
        }

        #pills-tab-historial-citas-opaciente2 .nav-link.active .badge-secondary,
        #pills-tab-historial-citas-opaciente .nav-link.active .badge-secondary {
            color: var(--info);
            background-color: var(--white);
        }
        .navbar-search-block {
            position: absolute;
            padding: 0 1rem;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
            display: none;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: initial;
        }


        .navbar-search-block.navbar-search-open {
            display: -ms-flexbox;
            display: flex;
        }
        #navbarMain .nav-pills .nav-link {
            color: #c5c5c5;
        }
        #navbarMain .nav-pills .nav-link:not(.active):hover {
            color: var(--white);
        }
        #navbarMain .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: var(--primary);
            background-color: var(--white);
        }
        .btn-hover-1:hover,
        .btn-hover-1:active,
        .btn-hover-1.hover
        {
            background-color: #e9ecef;
            color: #2b2b2b;
            cursor: pointer;
        }
        #example_filter input {
            border-radius: 5px;
        }

    </style>
    <script>
        function reemplaza_imagen(imagen) {
            imagen.onerror = "";
            imagen.src = "/image/system/medic.svg";
            return true;
        }
    </script>
</head>

<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed  sidebar-collapse">
    {{-- <body class="control-sidebar-slide-open layout-navbar-fixed sidebar-collapse sidebar-mini"> --}} <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center bg-primary align-items-center">
            <img class="animation__shake" src="/image/system/logo-cmdlt_mono.svg"
                alt="AdminLTELogo" height="200" width="200">
        </div>

        <nav id="navbarMain" class="navbar shadow navbar-expand m-0 mt-1 rounded-pill mx-1 p-0 pr-2 fixed-top navbar-primary navbar-dark">

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block inicio"">
                    <a href="#" class="nav-link rounded-pill  active inicio" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">
                        <i class="pc-home inicio"></i>
                        <span class="inicio">Inicio</span>
                    </a>
                </li>

                <li class="nav-item d-none d-sm-inline-block paciente-create">
                    <a href="#" class="nav-link rounded-pill paciente-create" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="true">
                        <i class="pc-paciente paciente-create"></i>
                        <span class="paciente-create">Paciente</span>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block paciente_create_cita">
                    <a href="#" class="nav-link rounded-pill paciente_create_cita"  data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="true">
                        <i class="pc-cita_por_confirmar paciente_create_cita"></i>
                        <span class="paciente_create_cita">Cita</span>
                    </a>
                </li>
                <li class="nav-item paciente_search">
                    <a class="nav-link rounded-pill paciente_search" data-widget="navbar-search" data-target="#navbar-search3" role="button"  data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="true">
                        <span class="pc-buscar paciente_search"></span>
                        <span class="paciente_search">Buscar</span>
                    </a>
                    <div class="navbar-search-block" id="navbar-search3" style="display: none;">
                        <div class="form-buscar-paciente">
                            <div class="input-group bg-white input-group-sm">
                                <input title="Escribe un texto a buscar aquí" name="search_value" class="form-control form-control-navbar" type="search"
                                    placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar btn_submit_paciente_search" type="bottom">
                                        <i class="fas fa-search btn_submit_paciente_search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li title="Activar/Desactivar Pantalla Completa"  class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center ml-auto">


                <li class="nav-item m-0 p-0">
                    <a class="navbar-brand m-0 p-0" href="#">
                        <img src="/image/system/logo-cmdlt_mono.svg"
                            style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                    </a>
                </li>
            </ul>
        </nav>


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar mt-6 sidebar-light-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel  btn-hover-1 sidebar-medico-edit my-3 py-3 d-flex">
                    <div class="image sidebar-medico-edit">
                        <img onerror="reemplaza_imagen(this)" src="{{ session('userData')['imagen'] }}" class="sidebar-medico-edit img-circle elevation-2"
                            alt="User Image" style="height: 2.1rem;width: 2.1rem;">
                    </div>
                    <div class="info sidebar-medico-edit">
                        <a href="#" class="d-block text-primary sidebar-medico-edit">{{ session('userData')['fullname'] }}</a>
                    </div>
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-cita_por_confirmar" style="font-size: 2rem;"></i>
                            <p>
                                Citas
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item paciente_create_cita">
                                <a href="#" class="nav-link paciente_create_cita">
                                    <i class="far fa-circle nav-icon paciente_create_cita"></i>
                                    <p class="paciente_create_cita">Nueva Cita</p>
                                </a>
                            </li>
                            <li class="sidebar-por-confirmar nav-item aprobar-cita" data-cat_user_cita_status_id="1"
                                data-name="Citas por confirmar">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Por Confirmar <span class="badge badge-gray total-citas-poraprobar">0</span></p>
                                </a>
                            </li>
                            <li class="sidebar-confirmadas nav-item" data-cat_user_cita_status_id="4"
                                data-name="Citas confirmadas">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Confirmadas <span class="badge badge-gray total-citas-aprobadas">0</span></p>
                                </a>
                            </li>
                            <li class="sidebar-preconsulta nav-item" data-cat_user_cita_status_id="5"
                                data-name="Preconsulta">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Preconsulta <span class="badge badge-gray total-citas-preconsulta">0</span></p>
                                </a>
                            </li>
                            @if (session('cat_user_type_id') == 2)
                                <li class="sidebar-consulta nav-item" data-cat_user_cita_status_id="6"
                                    data-name="Consulta">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta <span class="badge badge-gray total-citas-consulta">0</span></p>
                                    </a>
                                </li>
                            @endif
                            <li class="sidebar-reprogramadas nav-item" data-cat_user_cita_status_id="2"
                                data-name="Reprogramadas">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reprogramadas <span class="badge badge-gray total-citas-reprogramadas">0</span>
                                    </p>
                                </a>
                            </li>
                            {{-- <li data-cat_user_cita_status_id="7" data-name="Citas Completadas" class="sidebar-completadas nav-item" data-cat_user_cita_status_id="2"
                                data-name="Reprogramadas">
                                <a href="#" class="nav-link sidebar-completadas">
                                    <i class="sidebar-completadas far fa-circle nav-icon"></i>
                                    <p>
                                        Completadas <span class="sidebar-completadas badge badge-gray total-citas-completadas">0</span>
                                    </p>
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Completadas
                                        <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item sidebar-completadas-hoy" >
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Hoy</p>
                                        </a>
                                    </li>
                                    <li class="nav-item sidebar-completadas-semana" >
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Semana</p>
                                        </a>
                                    </li>
                                    <li class="nav-item sidebar-completadas-hoy" >
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Mes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- <li class="sidebar-canceladas nav-item" data-cat_user_cita_status_id="2"
                                data-name="Canceladas">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Canceladas <span class="badge badge-gray total-citas-canceladas">0</span>
                                    </p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-paciente" style="font-size: 2rem;"></i>
                            <p>
                                Pacientes
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           {{--  <li class="nav-item paciente_search">
                                <a href="#" class="nav-link paciente_search">
                                    <i class="far fa-circle nav-icon paciente_search"></i>
                                    <p class="paciente_search">Buscar</p>
                                </a>
                            </li> --}}

                            <li class="nav-item paciente-create">
                                <a href="#" class="nav-link paciente-create">
                                    <i class="far fa-circle nav-icon paciente-create"></i>
                                    <p class="paciente-create">Registrar</p>
                                </a>
                            </li>
                            <li class="nav-item paciente-update-password">
                                <a href="#" class="nav-link paciente-update-password">
                                    <i class="far fa-circle nav-icon paciente-update-password"></i>
                                    <p class="paciente-update-password">Restablecer Contraseña</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item" onclick="alert('Proximamente disponible.')">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Atendidos</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item
                            @php
                                if (!in_array(session('roles'),[4,6])) {
                                    echo 'd-none';
                                }
                            @endphp
                        ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-medico" style="font-size: 2rem;"></i>
                            <p>
                                Médico
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item sidebar-medico-create">
                                <a href="#" class="nav-link sidebar-medico-index">
                                    <i class="sidebar-medico-index far fa-circle nav-icon"></i>
                                    <p class="sidebar-medico-index">Listado</p>
                                </a>
                            </li> --}}
                            <li class="nav-item sidebar-medico-create">
                                <a href="#" class="nav-link sidebar-medico-create">
                                    <i class="sidebar-medico-create far fa-circle nav-icon"></i>
                                    <p class="sidebar-medico-create">Registrar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Agenda de citas
                                        <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item agenda-create">
                                        <a href="#" class="nav-link agenda-create">
                                            <i class="far fa-circle nav-icon agenda-create"></i>
                                            <p class="agenda-create">Nueva agenda</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item" onclick="alert('Proximamente disponible.')">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ver agenda</p>
                                        </a>
                                    </li> --}}


                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item
                            @php
                                if (in_array(session('roles'),[7,4,9])) {
                                    echo 'd-none';
                                }
                            @endphp
                        ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-reportes" style="font-size: 2rem;"></i>
                            <p>
                                Reportes
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item sidebar-medico-create">
                                <a href="#" class="nav-link sidebar-medico-index">
                                    <i class="sidebar-medico-index far fa-circle nav-icon"></i>
                                    <p class="sidebar-medico-index">Listado</p>
                                </a>
                            </li> --}}
                            <li class="nav-item sidebar-medico-create">
                               <div class="d-flex flex-column">
                                    <div class="flex-fill d-flex mb-1">
                                       <label style="width:50px;" for="dateStart">Desde:</label>
                                       <input style="border-radius: 5px;border: 1px solid var(--gray);" id="dateStart" type="date" value="{{ date("Y-m")."-01" }}">
                                    </div>
                                    <div class="flex-fill d-flex">
                                       <label style="width:50px;" for="dateEnd">Hasta:</label>
                                       <input style="border-radius: 5px;border: 1px solid var(--gray);" id="dateEnd" type="date" value="{{ date("Y-m-d") }}">
                                    </div>
                               </div>
                            </li>
                            <hr>
                            <li class="nav-item reporte_solicitud_de_citas">
                                <a href="#" class="nav-link reporte_solicitud_de_citas">
                                    <i class="reporte_solicitud_de_citas pc-excel text-success nav-icon"></i>
                                    <p class="reporte_solicitud_de_citas">Solicitudes de citas</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="/consultaexterna/finalizarSesion" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt text-secondary" style="font-size: 1.5rem;"></i>
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>
                </ul>




            </div>

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="overlay-wrapper">
                <div id="cargando" style="height:100vh" class="overlay text-primary d-none">
                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                </div>
                <!-- Content Header (Page header) -->
                <div class="content-header mt-6">
                    <div class="container-fluid">
                        <div class="row" style="height: 60px;">
                            <div class="col-sm-6">
                                <small>{{ $centro_salud_nombre }}</small>
                                <h1 class="m-0 cat-cita-status-title">Consulta externa</h1>

                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    @php
                                        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                    @endphp

                                    <li class="breadcrumb-item active">{{ date('d') }} de {{ $meses[(int) (date('m') - 1)] }}, {{ date('Y') }}</li>
                                {{--  <li title="Actualizar listado de citas" class="breadcrumb-item updateCitas"><a href="#"
                                            class="btn border-0 heartbeat updateCitas"><i
                                                class="fas fa-1x fa-sync-alt text-primary updateCitas"></i></a></li> --}}
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>


                <section class="content">
                    <div class="container-fluid">
                        <div id="headerCitaStatusOptions" class="row">
                            @php
                                $col = 6;
                                $col_lg = 4;
                                if (session('cat_user_type_id') == 2){
                                    $col_lg = 3;
                                }
                            @endphp
                            <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="1"
                                data-name="Citas por confirmar">
                                <!-- small box -->
                                <div class="small-box bg-primary shadow-lg-primary" data-shadow-color="primary">
                                    <div class="inner">
                                        <h3 class="total-citas-poraprobar">0</h3>
                                        <p></p>
                                    </div>
                                    <div class="icon">

                                        <i class="pc-cita_por_confirmar text-white"></i>
                                    </div>
                                    <a href="#" class="small-box-footer h43">
                                        Por Confirmar
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="4"
                                data-name="Citas confirmadas">
                                <!-- small box -->
                                <div class="small-box bg-success" data-shadow-color="success">
                                    <div class="inner">
                                        <h3 class="total-citas-aprobadas">0</h3>
                                        <p></p>
                                    </div>
                                    <div class="icon">

                                        <i class="pc-cita_confirmada text-white"></i> {{-- <i style="top: -25px !important;" ><img style="height:0.8em;opacity: 0.3;" src="/image/system/calendar-check.svg" alt=""></i> --}}
                                    </div>
                                    <a href="#" class="small-box-footer h43">
                                        Confirmadas
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="5"
                                data-name="Preconsulta">
                                <!-- small box -->
                                <div class="small-box bg-warning" data-shadow-color="warning">
                                    <div class="inner">
                                        <h3 class="total-citas-preconsulta  text-white">0</h3>
                                        <p></p>
                                    </div>
                                    <div class="icon">
                                        <i class="pc-preconsulta text-white"></i>
                                    </div>
                                    <a href="#" class="small-box-footer  h43" style="color:white !important">
                                        Preconsulta
                                    </a>
                                </div>
                            </div>
                            @if (session('cat_user_type_id') == 2)
                                <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="6"
                                    data-name="Consulta">
                                    <!-- small box -->
                                    <div class="small-box bg-info" data-shadow-color="info">
                                        <div class="inner">
                                            <h3 class="total-citas-consulta">0</h3>
                                            <p></p>
                                        </div>
                                        <div class="icon">
                                            <i class="pc-consulta text-white"></i>
                                        </div>
                                        <a href="#" class="small-box-footer  text-white h43">
                                            Consulta
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div id="tab_app"  class="d-none"> <!-- fade-in -->
                            <div class="overlay-wrapper">
                                <div id="tab_app_overlay" class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                <div id="App"></div>
                            </div>
                        </div>
                        <div id="tab_citas" class="row" > <!-- scale-in-ver-center -->
                            <!-- Left col -->
                            <section class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-transparent">

                                        <ul id="grupo_filtrar_por" class="navbar-nav d-none">
                                            <li class="nav-item dropdown">
                                                <a title="Filtrar por"
                                                    class="p-1 border-0 btn btn-default dropdown-toggle card-title"
                                                    href="#" data-toggle="dropdown" aria-expanded="true">
                                                <i class="ml-2 fas fa-filter text-info"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <h3 class="dropdown-header text-primary"><b>Filtrar por:</b></h3>
                                                    <li>
                                                        <a data-filtrar_por="solo_yo" class="filtrar_por dropdown-item active"
                                                            href="#">Mis Citas</a>
                                                    </li>
                                                    <li><a data-filtrar_por="todas"
                                                            class="filtrar_por dropdown-item" href="#">Todas las
                                                            citas</a></li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap mb-2">
                                            <div class="col-12 col-sm-6 pl-0">
                                                {{-- <h3 id="title_lista">Por confirmar</h3> --}}
                                            </div>
                                            <div class="col-12 col-sm-6 pr-0 d-flex align-items-center">
                                                <label class="text-primary mb-0 mr-1" for="">Buscar:</label>
                                                <input type="search" placeholder="Escribe el texto a buscar" class="form-control" id="buscar_cita_listado">
                                            </div>
                                        </div>
                                        <div class="overlay-wrapper">
                                            <div class="overlay text-primary d-none">
                                                <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                                <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="citas_pacientes"
                                                    class="table bg-white table-bordered table-hover">
                                                    <thead style="font-size: 1.2em;">
                                                        <tr>
                                                            <th class="text-primary text-center"
                                                                title="Día en que se solicitó la cita">Fecha</th>
                                                            <th class="text-primary text-center">Paciente</th>
                                                            <th class="text-primary">Medico</th>
                                                            <th class="text-primary">Especialidad</th>
                                                            <th class="text-primary">Fecha Cita</th>
                                                            <th class="text-primary">Hora</th>
                                                            <th class="text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="7" class="text-primary text-center">
                                                                Sin pacientes
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="tab_preconsulta" class="d-none" > <!-- fade-in -->
                            <div class="row overlay-wrapper">
                                <div id="tab_preconsulta_overlay" class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                <section class="col-lg-3 connectedSortable">
                                    <div class="card-paciente"></div>
                                    <div class="card-archivos"></div>
                                </section>
                                <section class="col-lg-6">
                                    <div class="group_items_paciente connectedSortable"></div>
                                </section>
                                <section class="col-lg-3">
                                    <div class="group_vital_signs connectedSortable"></div>
                                </section>
                                <section class="col-lg-6 offset-lg-3 connectedSortable">
                                    <button id="submit_preconsulta"
                                        class="submit_preconsulta btn btn-success btn-block btn-lg">Completar y pasar a
                                        consulta</button>
                                </section>
                            </div>

                        </div>
                        <div id="tab_consulta" class="d-none" > <!-- scale-in-hor-right -->
                            <div class="row overlay-wrapper">
                                <div id="tab_consulta_overlay" class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                    <section class="col-lg-3 connectedSortable">
                                        <div class="card collapsed-card">
                                            <div class="card-header" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Historial de Citas</h3>
                                                <div class="card-tools">
                                                    <span
                                                        class="item-counter badge d-none item-counter-user_historial badge-success">0</span>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="acceso-citas-historial-paciente card-body p-0" style="display:none">
                                                <div class="overlay-wrapper">
                                                    <div class="overlay text-primary d-none">
                                                        <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                                        <div class="text-bold pt-2">Por favor espere un momento...</div>
                                                    </div>
                                                    <!--
                                                                    <div class="d-flex align-items-center justify-content-end flex-fill">
                                                                    <div class="dropdown">
                                                                        <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            o
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                            <a class="dropdown-item" href="#"><i class="fas fa-file-pdf text-danger"></i> Imprimir PDF »</a>
                                                                        </div>
                                                                        </div>
                                                                    </div> -->

                                                    <ul class="nav bg-white nav-pills flex-column p-1"
                                                        id="pills-tab-historial-citas-opaciente" role="tablist">
                                                        <li class="nav-item text-center" role="presentation">
                                                            <a class="nav-link" id="pills-contact-tab">No posee citas
                                                                anteriores</a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-paciente"></div>
                                        <div class="card-archivos"></div>
                                        <div class="card d-none">
                                            <div class="card-header">
                                                <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente
                                                    requerirá:</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div id="evaluacionIngreso" class="card-body p-0"
                                                style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item p-1 d-none">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Solo Atención de
                                                                Emergencia</label>

                                                            <select class="form-control border-0" name="atencion_emergencia"
                                                                id="atencion_emergencia">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item p-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Hospitalización:</label>
                                                            <select class="form-control border-0" name="hospitalizacion"
                                                                id="hospitalizacion">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item p-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Terapia Intensiva:</label>
                                                            <select class="form-control border-0" name="terapia_intensiva"
                                                                id="terapia_intensiva">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>

                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item p-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Cirugía:</label>
                                                            <select class="form-control border-0" name="cirugia" id="cirugia">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>
                                                            </select>
                                                        </div>
                                                    </li>



                                                </ul>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>


                                    </section>
                                    <section class="col-lg-6 connectedSortable">

                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus" data-card-widget="collapse"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_motivo_consulta"
                                                    placeholder="Escriba aquí por qué el paciente acudió a la emergencia"
                                                    name="user_motivo_consulta" id="user_motivo_consulta" rows="3"></textarea>

                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_enfermedad_actual" placeholder="Describa aquí el problema de salud actual"
                                                    name="user_enfermedad_actual" id="user_enfermedad_actual" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_examen_fisico"
                                                    placeholder="Describa brevemente los hallazgos positivos del examen físico realizado."
                                                    name="user_examen_fisico" id="user_examen_fisico" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Impresión diagnóstica</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_impresion_diagnostica"
                                                    placeholder="Describa brevemente sus impresiones de cómo ve al paciente."
                                                    name="user_impresion_diagnostica" id="user_impresion_diagnostica"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Plan</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_plan" placeholder="Describa brevemente el plan a aplicarsele al paciente."
                                                    name="user_plan" id="user_plan" rows="3"></textarea>
                                            </div>
                                        </div>


                                    </section>

                                    <section class="col-lg-3">
                                        <div class="group_vital_signs connectedSortable"></div>
                                        <div class="group_items_paciente connectedSortable"></div>
                                    </section>
                                    <section class="col-lg-6 offset-lg-3 connectedSortable">
                                        {{-- <div class="alert alert-warning mt-2" role="alert">
                                            <b>Hora 5:00 am 24/04/2022. NIVEL DE DESARROLLO:</b> Agregar menú de culminación: opciones (1) Generar próxima cita. (2) Completar cita con generación de informe, (3) Generar solicitid de cita para cirugía.
                                        </div> --}}
                                        <button id="submit_consulta"
                                            class="submit_consulta btn btn-success btn-block btn-lg">Completar cita médica</button>
                                    </section>


                                </div>
                        </div>
                        <div id="tab_paciente_create" class="row d-none"> <!--  scale-in-ver-top -->
                            <section class="col-lg-12">
                                <div class="card" style="height:70vh;overflow:auto;">
                                    <div class="card-header border-transparent">

                                    </div>

                                    <div class="card-body">
                                        <div id="form_nuevo_paciente"></div>
                                        <div id="form_nuevo_medico">


                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="tab_agenda_create" class="row d-none"> <!--  scale-in-ver-top -->
                            <section class="col-lg-12">
                                <div class="card" style="height:70vh;overflow:auto;">
                                    <div class="card-header border-transparent">

                                    </div>

                                    <div class="card-body">
                                        <div id="form_agenda_create"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="tab_medico_create" class="row d-none"> <!--  scale-in-ver-top -->
                            <section class="col-lg-12">
                                <div class="card" style="height:70vh;overflow:auto;">
                                    <div class="card-header border-transparent">

                                    </div>

                                    <div class="card-body">
                                        <div id="form_nuevo_paciente"></div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </section>
            </div>
        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="height: auto;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal"
                            src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>
                <!-- style="height: 80vh;" -->
                <div class="modal-body" style="background: #F1F3F4!important;">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn flex-fill btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="reprogramacion_store" type="button" class="btn flex-fill btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCancelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">
                    <div class="exampleModal_title"></div>
                    <form></form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fullscreen-modal fade" id="modal-fullscreen" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-between">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white heartbeat"
                            style="font-size: 2em;margin-left:2%;cursor:pointer;" aria-hidden="true"></i>
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                </div>
                <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                </div>
            </div>
        </div>
    </div>
    @include('templates.template_consulta_externa')


    <!-- jQuery -->
    <script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/js/sweetalert2@10.js"></script>
    <script src="/plugin/intl-tel-input/build/js/intlTelInput.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
    <script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/tippy-bundle.umd.min.js"></script>
    <script src="/js/scripts.js?version = 0.1"></script>
    <script>
        let d = document

        let resulset = @json($citas, JSON_PRETTY_PRINT);
        let user_id_medico = Number("{{ Auth::id() }}");
        let user_type_id = Number("{{ session('cat_user_type_id') }}");
        //console.log("user_type_id: ",user_type_id)
        let host_patientcare = "{{ config('app.url') }}";
        let cat_grupo_centro_salud_id = Number("{{ config('app.APP_GRUPO_CENTRO_SALUD_ID') }}");
        let user_centro_salud_id = Number("{{ session('user_centro_salud_id') }}");
        let filtrar_por = "{{ session('filtrar_por') }}";
        let ver_citas_privadas = Number("{{ session('ver_citas_privadas') }}");
        let medico_fullname = "{{ session('userData')['fullname'] }}";
        let medico_genero = "{{ session('userData')['genero'] }}";
        const useState ={
                "user_id_medico":"",
                "user_id_gerente": Number("{{ session('user_id_gerente') }}"),
                "gerente_nombre": "{{ session('gerente_nombre') }}",
                "ver_citas_privadas":ver_citas_privadas,
                "medico_genero":medico_genero,
                "user_type_id":user_type_id,
                "medico_fullname":medico_fullname,
                "host_patientcare":host_patientcare,
                "cat_grupo_centro_salud_id":cat_grupo_centro_salud_id,
                "user_centro_salud_id":user_centro_salud_id,
                "medicos"                :resulset.medicos,
                "medico"                :resulset.medico,
                "users"                : resulset.users,
                "especialidades"       : [],
                "pacientes"            : resulset.pacientes,
                "citas"                : resulset.citas,
                "tarjetasoychacao"     : resulset.tarjetasoychacao,
                "user_condicion_medica": resulset.user_condicion_medica,
                "user_medicamento"     : resulset.user_medicamento,
                "user_antecedente"     : resulset.user_antecedente,
                "user_alergias"        : resulset.user_alergias,
                "medicos_agenda"        : resulset.medicos_agenda,
                "centro_salud"        : resulset.centro_salud,
                "user_recipe": resulset.user_recipe,
                "user_estudio": resulset.user_estudio,
                "user_laboratorio": resulset.user_laboratorio,
                "user_fotografia": resulset.user_fotografia,
                "user_imagenes": resulset.user_imagenes,
                "user_otro_archivo": resulset.user_otro_archivo,
                "formRecipeCreate":{
                    "recipe_num":null,
                    "user_id":null,
                    "recipe_id":null,
                    "user_cita_id":"",
                    "value":"",
                    "value2":"",
                    "value3":"",
                    "value4":1,
                },
                "formFileCreate":{
                    "user_id":null,
                    "user_cita_id":null,
                },
                "formEstudioCreate":{
                    "estudio_num":null,
                    "user_id":null,
                    "user_cita_id":"",
                    "value":"",
                    "value2":"",
                    "estudio_id":null,
                    "coments":"",
                },
                "formAgendaCreate":{
                    "agenda_year": "",
                    "agenda_month":[],
                    "agenda_day_week":[],
                    "agenda_hour":[],
                    "cupos_por_dia":1,// pacientes por hora
                    "centro_salud_id":"",
                    "user_id_medico":"",
                    "cat_especialidad_id":"",
                    "agenda":[]
                },
                "formReprogramar"      : {
                    "cat_user_cita_status_id": 2,
                    "fecha"                  : "aaaa-mm-dd",
                    "year"                   : "aaaa",
                    "month"                  : "mm",
                    "day"                    : "dd",
                    "hour"                   : "00:00",
                    "coments"                : "",
                    "coments2"               : "",
                    "created_at"             : timestamps()
                },
                "formCreateCita": {
                    "file": null,
                    "user_id_paciente"    : "",
                    "cat_especialidad_id"    : "",
                    "centro_salud_id"     : "",
                    "cita_dia"            : "",
                    "cita_hora"           : "",
                    "user_id_medico"      : "",
                    "condicion_administrativa": "Particular",
                    "cita_motivo"         : "",
                    "enfermedad_actual"   : "",
                    "cat_user_cita_status_id": 1,
                },
                "formCreateMedico":{
                    "nacionalidad"            : "V",
                    "cedula"                  : "",
                    "email"                   : "",
                    "password"                : "123456",
                    "password_repeat"         : "123456",
                    "nombres"                 : "",
                    "apellidos"               : "",
                    "genero"                  : "m",
                    "prefijo"                 : "Dr.",
                    "fnacimiento"             : "",
                    "telefono_movil"          : "",
                    "cat_estado_id"           : "14",
                    "cat_municipio_id"        : "180",
                    "description"             : "Caracas",      //ciudad
                    "domicilio"               : "",
                    "tarjeta_soy_chacao"      : "",
                    "fecha_ingreso"           : timestamps(),
                    "cat_user_equipo_salud_id": "1",
                    "cat_user_especialidad_id": [],
                    "cat_medico_posicion_id"  : "1",
                    "colegio_medico"          : "",
                    "mpps"                    : "",
                    "sello"                   : "",
                    "firma"                   : "",
                    "centro_salud_id"         : [1],
                    "cat_user_type_id"         : [1,2],
                },
                "formCreatePaciente":{
                    "nacionalidad"    : "V",
                    "cedula"          : "",
                    "email"           : "",
                    "password"        : "",
                    "password_repeat" : "",
                    "nombres"         : "",
                    "apellidos"       : "",
                    "genero"          : "m",
                    "fnacimiento"     : "",
                    "telefono_movil"  : "",
                    "cat_estado_id"   : "14",
                    "cat_municipio_id": "180",
                    "description"     : "Caracas",    //ciudad
                    "domicilio"       : "",
                    "tarjeta_soy_chacao": "",
                    "fecha_ingreso" :"",
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

                "search_resultset": [],
                "status_current_tab": 1,
                "user_id_medico"    : parseInt(user_id_medico),
                "user_type_id"      : parseInt(user_type_id),
                "filtrar_por"       : filtrar_por,
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
        console.log('useState --> ',useState)
        d.addEventListener("click",function (e) {
            if (e.target.matches(".reporte_solicitud_de_citas")) {
                let dateStart = <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMDLT | Consulta Externa</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <link href="/css/select2.min.css" rel="stylesheet" />
    <!-- summernote -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('css/stylePatientcare.css') }}">
    <link rel="stylesheet" href="{{ asset('image/system/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('image/system/icomoon3/style.css') }}">
    <style>
        :root{
                --bg-primary: #185BA9;
                --bs-primary-rgb: rgb(24,91,169);
                --bs-primary-rgb-hover: rgb(21, 75, 138) ;
                --primary:var(--bs-primary-rgb) !important;
                --primary-hover: var(--bs-primary-rgb-hover) !important;
            }

        .btn-primary:hover {
            color: #ffffff;
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
        }
    </style>
    <style>
        .navbar-main-shadow {
            -webkit-box-shadow: 0px 10px 13px -7px #000000, 38px 17px 19px 23px rgb(241 243 244 / 0%);
            box-shadow: 0px 10px 13px -7px #343a40, 38px 17px 19px 23px #f1f3f400;
        }
        .fade-in{-webkit-animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both;animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both}
        @-webkit-keyframes fade-in{0%{opacity:0}100%{opacity:1}}@keyframes fade-in{0%{opacity:0}100%{opacity:1}}


        .heartbeat-infinity {
            -webkit-animation: heartbeat-infinity 1.5s ease-in-out infinite both;
            animation: heartbeat-infinity 1.5s ease-in-out infinite both
        }

        @-webkit-keyframes heartbeat-infinity {
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

        @keyframes heartbeat {
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

        .scale-in-hor-left {
            -webkit-animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-hor-left {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }
        }

        @keyframes scale-in-hor-left {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
                opacity: 1
            }
        }

        .scale-in-hor-right {
            -webkit-animation: scale-in-hor-right .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-hor-right .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-hor-right {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }
        }

        @keyframes scale-in-hor-right {
            0% {
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                -webkit-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
                opacity: 1
            }
        }

        .scale-in-ver-top {
            -webkit-animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-ver-top {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }
        }

        @keyframes scale-in-ver-top {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                opacity: 1
            }
        }

        .scale-in-ver-center {
            -webkit-animation: scale-in-ver-center .5s cubic-bezier(.25, .46, .45, .94) both;
            animation: scale-in-ver-center .5s cubic-bezier(.25, .46, .45, .94) both
        }

        @-webkit-keyframes scale-in-ver-center {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                opacity: 1
            }
        }

        @keyframes scale-in-ver-center {
            0% {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
                opacity: 1
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
                opacity: 1
            }
        }

        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {
            .dropdown-menu li {
                position: relative;
            }

            .nav-item .submenu {
                display: none;
                position: absolute;
                left: 100%;
                top: -7px;
            }

            .nav-item .submenu-left {
                right: 100%;
                left: auto;
            }

            .dropdown-menu>li:hover {
                background-color: #f1f1f1
            }

            .dropdown-menu>li:hover>.submenu {
                display: block;
            }
        }
        .text-warning-disabled {
            color: var(--warning) !important;
            opacity: 0.4;
        }
        .bg-secondary-cortesia {
            background-color: #d5d6d7 !important;
            width: 100%;
            border: 0;
            color: #000000 !important;
            border-top: 3px solid #ffbf00 !important;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 1rem 3rem rgb(0 0 0 / 18%) !important;
        }
        /* ============ desktop view .end// ============ */

        /* ============ small devices ============ */
        @media (max-width: 991px) {
            .dropdown-menu .dropdown-menu {
                margin-left: 0.7rem;
                margin-right: 0.7rem;
                margin-bottom: .5rem;
            }
        }
        .navbar-dark .form-control-navbar+.input-group-append>.btn-navbar {
            color: var(--primary);
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: var(--secondary);
            border: 1px solid var(--secondary);
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            margin-left: 5px;
            margin-top: 5px;
            padding: 0;
            padding-left: 25px;
            position: relative;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: bottom;
            white-space: nowrap;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: var(--white) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background-color: transparent;
            border: none;
            border-right: 1px solid var(--light);
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            color: var(--white) !important;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            padding: 0 4px;
            position: absolute;
            left: 0;
            top: 0;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 0px !important;
            border-radius: 4px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }

        .select2-cat_especialidad_id>.select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            /* border-color: #80bdff; */
            border: 0 !important;
            color: var(--gray) !important;
            background-color: var(--white) !important;
            z-index: 2;
        }

        .mt-6,
        .my-6 {
            margin-top: 4rem !important;
        }

        [class*='sidebar-light-'] {
            background-color: #f1f3f4 !important;
        }

        .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
            margin-top: 0 !important;
        }

        .layout-navbar-fixed .wrapper .content-wrapper {
            margin-top: 0 !important;
        }

        .direct-chat-text-custom {
            border-radius: 0.3rem;
            background-color: #d2d6de;
            border: 1px solid #d2d6de;
            color: #444;
            margin: 5px 0 0 50px;
            padding: 5px 10px;
            position: relative;
        }

        .cat-cita-status-title {
            font-weight: 800 !important;
            line-height: 1.2;
            color: var(--primary);
            font-size: 1.5em !important;
        }

        .animation__shake {
            -webkit-animation: shake 1500ms;
            animation: shake 1500ms;
        }

        .animation__wobble {
            -webkit-animation: wobble 1500ms;
            animation: wobble 1500ms;
        }

        .preloader {
            display: -ms-flexbox;
            display: flex;
            background-color: #f4f6f9;
            height: 100vh;
            width: 100%;
            transition: height 200ms linear;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 9999;
        }

        .dark-mode .preloader {
            background-color: #454d55 !important;
            color: #fff;
        }

        .bg-chacao {
            height: 100%;
            background: linear-gradient(90deg, #292929 50%, #185BA9 50%);
        }

        .text-black {
            color: #292929;
        }

        .item-text {
            border-radius: 0.3rem;
            background: #d2d6de;
            border: 1px solid #d2d6de;
            color: #444;
            margin: 1%;
            padding: 5px 10px;
            position: relative;
        }
        #headerCitaStatusOptions .small-box {
            border-radius: 1.25rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }
        #headerCitaStatusOptions .small-box>.small-box-footer {
            background: rgba(0, 0, 0, 0.1);
            color: rgba(255, 255, 255, 0.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
            border-bottom-left-radius: 1.25rem;
            border-bottom-right-radius: 1.25rem;
        }
        .btn-warning {
            color: #1F2D3D !important;
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            box-shadow: none;
        }

        .content-wrapper {
            background: #F1F3F4 !important;

            background-color: #F1F3F4 !important;
        }

        body {
            background: #F1F3F4 !important;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #F4F7F7 !important;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #F4F7F7;
            border-top: 0 solid rgba(0, 0, 0, 0.125);
        }
        }

        .shadow-lg-danger {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--danger) !important;
        }

        .shadow-lg-primary {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--primary) !important;
        }

        .shadow-lg-success {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--success) !important;
        }

        .shadow-lg-warning {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--warning) !important;
        }

        .shadow-lg-info {
            border: 2px solid white;
            box-shadow: 0 0.5rem 1rem var(--info) !important;
        }

        #pills-tab-historial-citas-opaciente2 .nav-link.active,
        #pills-tab-historial-citas-opaciente .nav-link.active {
            color: #ffffff;
            background-color: #00aaff !important;
        }

        #pills-tab-historial-citas-opaciente2 .nav-link.active .badge-secondary,
        #pills-tab-historial-citas-opaciente .nav-link.active .badge-secondary {
            color: var(--info);
            background-color: var(--white);
        }
        .navbar-search-block {
            position: absolute;
            padding: 0 1rem;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
            display: none;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: initial;
        }


        .navbar-search-block.navbar-search-open {
            display: -ms-flexbox;
            display: flex;
        }
        #navbarMain .nav-pills .nav-link {
            color: #c5c5c5;
        }
        #navbarMain .nav-pills .nav-link:not(.active):hover {
            color: var(--white);
        }
        #navbarMain .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: var(--primary);
            background-color: var(--white);
        }
        .btn-hover-1:hover,
        .btn-hover-1:active,
        .btn-hover-1.hover
        {
            background-color: #e9ecef;
            color: #2b2b2b;
            cursor: pointer;
        }
        #example_filter input {
            border-radius: 5px;
        }

    </style>
    <script>
        function reemplaza_imagen(imagen) {
            imagen.onerror = "";
            imagen.src = "/image/system/medic.svg";
            return true;
        }
    </script>
</head>

<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed  sidebar-collapse">
    {{-- <body class="control-sidebar-slide-open layout-navbar-fixed sidebar-collapse sidebar-mini"> --}} <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center bg-primary align-items-center">
            <img class="animation__shake" src="/image/system/logo-cmdlt_mono.svg"
                alt="AdminLTELogo" height="200" width="200">
        </div>

        <nav id="navbarMain" class="navbar shadow navbar-expand m-0 mt-1 rounded-pill mx-1 p-0 pr-2 fixed-top navbar-primary navbar-dark">

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block inicio"">
                    <a href="#" class="nav-link rounded-pill  active inicio" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">
                        <i class="pc-home inicio"></i>
                        <span class="inicio">Inicio</span>
                    </a>
                </li>

                <li class="nav-item d-none d-sm-inline-block paciente-create">
                    <a href="#" class="nav-link rounded-pill paciente-create" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="true">
                        <i class="pc-paciente paciente-create"></i>
                        <span class="paciente-create">Paciente</span>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block paciente_create_cita">
                    <a href="#" class="nav-link rounded-pill paciente_create_cita"  data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="true">
                        <i class="pc-cita_por_confirmar paciente_create_cita"></i>
                        <span class="paciente_create_cita">Cita</span>
                    </a>
                </li>
                <li class="nav-item paciente_search">
                    <a class="nav-link rounded-pill paciente_search" data-widget="navbar-search" data-target="#navbar-search3" role="button"  data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="true">
                        <span class="pc-buscar paciente_search"></span>
                        <span class="paciente_search">Buscar</span>
                    </a>
                    <div class="navbar-search-block" id="navbar-search3" style="display: none;">
                        <div class="form-buscar-paciente">
                            <div class="input-group bg-white input-group-sm">
                                <input title="Escribe un texto a buscar aquí" name="search_value" class="form-control form-control-navbar" type="search"
                                    placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar btn_submit_paciente_search" type="bottom">
                                        <i class="fas fa-search btn_submit_paciente_search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li title="Activar/Desactivar Pantalla Completa"  class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center ml-auto">


                <li class="nav-item m-0 p-0">
                    <a class="navbar-brand m-0 p-0" href="#">
                        <img src="/image/system/logo-cmdlt_mono.svg"
                            style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                    </a>
                </li>
            </ul>
        </nav>


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar mt-6 sidebar-light-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel  btn-hover-1 sidebar-medico-edit my-3 py-3 d-flex">
                    <div class="image sidebar-medico-edit">
                        <img onerror="reemplaza_imagen(this)" src="{{ session('userData')['imagen'] }}" class="sidebar-medico-edit img-circle elevation-2"
                            alt="User Image" style="height: 2.1rem;width: 2.1rem;">
                    </div>
                    <div class="info sidebar-medico-edit">
                        <a href="#" class="d-block text-primary sidebar-medico-edit">{{ session('userData')['fullname'] }}</a>
                    </div>
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-cita_por_confirmar" style="font-size: 2rem;"></i>
                            <p>
                                Citas
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item paciente_create_cita">
                                <a href="#" class="nav-link paciente_create_cita">
                                    <i class="far fa-circle nav-icon paciente_create_cita"></i>
                                    <p class="paciente_create_cita">Nueva Cita</p>
                                </a>
                            </li>
                            <li class="sidebar-por-confirmar nav-item aprobar-cita" data-cat_user_cita_status_id="1"
                                data-name="Citas por confirmar">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Por Confirmar <span class="badge badge-gray total-citas-poraprobar">0</span></p>
                                </a>
                            </li>
                            <li class="sidebar-confirmadas nav-item" data-cat_user_cita_status_id="4"
                                data-name="Citas confirmadas">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Confirmadas <span class="badge badge-gray total-citas-aprobadas">0</span></p>
                                </a>
                            </li>
                            <li class="sidebar-preconsulta nav-item" data-cat_user_cita_status_id="5"
                                data-name="Preconsulta">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Preconsulta <span class="badge badge-gray total-citas-preconsulta">0</span></p>
                                </a>
                            </li>
                            @if (session('cat_user_type_id') == 2)
                                <li class="sidebar-consulta nav-item" data-cat_user_cita_status_id="6"
                                    data-name="Consulta">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta <span class="badge badge-gray total-citas-consulta">0</span></p>
                                    </a>
                                </li>
                            @endif
                            <li class="sidebar-reprogramadas nav-item" data-cat_user_cita_status_id="2"
                                data-name="Reprogramadas">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reprogramadas <span class="badge badge-gray total-citas-reprogramadas">0</span>
                                    </p>
                                </a>
                            </li>
                            {{-- <li data-cat_user_cita_status_id="7" data-name="Citas Completadas" class="sidebar-completadas nav-item" data-cat_user_cita_status_id="2"
                                data-name="Reprogramadas">
                                <a href="#" class="nav-link sidebar-completadas">
                                    <i class="sidebar-completadas far fa-circle nav-icon"></i>
                                    <p>
                                        Completadas <span class="sidebar-completadas badge badge-gray total-citas-completadas">0</span>
                                    </p>
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Completadas
                                        <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item sidebar-completadas-hoy" >
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Hoy</p>
                                        </a>
                                    </li>
                                    <li class="nav-item sidebar-completadas-semana" >
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Semana</p>
                                        </a>
                                    </li>
                                    <li class="nav-item sidebar-completadas-hoy" >
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Mes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- <li class="sidebar-canceladas nav-item" data-cat_user_cita_status_id="2"
                                data-name="Canceladas">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Canceladas <span class="badge badge-gray total-citas-canceladas">0</span>
                                    </p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-paciente" style="font-size: 2rem;"></i>
                            <p>
                                Pacientes
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           {{--  <li class="nav-item paciente_search">
                                <a href="#" class="nav-link paciente_search">
                                    <i class="far fa-circle nav-icon paciente_search"></i>
                                    <p class="paciente_search">Buscar</p>
                                </a>
                            </li> --}}

                            <li class="nav-item paciente-create">
                                <a href="#" class="nav-link paciente-create">
                                    <i class="far fa-circle nav-icon paciente-create"></i>
                                    <p class="paciente-create">Registrar</p>
                                </a>
                            </li>
                            <li class="nav-item paciente-update-password">
                                <a href="#" class="nav-link paciente-update-password">
                                    <i class="far fa-circle nav-icon paciente-update-password"></i>
                                    <p class="paciente-update-password">Restablecer Contraseña</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item" onclick="alert('Proximamente disponible.')">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Atendidos</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item
                            @php
                                if (!in_array(session('roles'),[4,6])) {
                                    echo 'd-none';
                                }
                            @endphp
                        ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-medico" style="font-size: 2rem;"></i>
                            <p>
                                Médico
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item sidebar-medico-create">
                                <a href="#" class="nav-link sidebar-medico-index">
                                    <i class="sidebar-medico-index far fa-circle nav-icon"></i>
                                    <p class="sidebar-medico-index">Listado</p>
                                </a>
                            </li> --}}
                            <li class="nav-item sidebar-medico-create">
                                <a href="#" class="nav-link sidebar-medico-create">
                                    <i class="sidebar-medico-create far fa-circle nav-icon"></i>
                                    <p class="sidebar-medico-create">Registrar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Agenda de citas
                                        <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item agenda-create">
                                        <a href="#" class="nav-link agenda-create">
                                            <i class="far fa-circle nav-icon agenda-create"></i>
                                            <p class="agenda-create">Nueva agenda</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item" onclick="alert('Proximamente disponible.')">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ver agenda</p>
                                        </a>
                                    </li> --}}


                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item
                            @php
                                if (in_array(session('roles'),[7,4,9])) {
                                    echo 'd-none';
                                }
                            @endphp
                        ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon pc-reportes" style="font-size: 2rem;"></i>
                            <p>
                                Reportes
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item sidebar-medico-create">
                                <a href="#" class="nav-link sidebar-medico-index">
                                    <i class="sidebar-medico-index far fa-circle nav-icon"></i>
                                    <p class="sidebar-medico-index">Listado</p>
                                </a>
                            </li> --}}
                            <li class="nav-item sidebar-medico-create">
                               <div class="d-flex flex-column">
                                    <div class="flex-fill d-flex mb-1">
                                       <label style="width:50px;" for="dateStart">Desde:</label>
                                       <input style="border-radius: 5px;border: 1px solid var(--gray);" id="dateStart" type="date" value="{{ date("Y-m")."-01" }}">
                                    </div>
                                    <div class="flex-fill d-flex">
                                       <label style="width:50px;" for="dateEnd">Hasta:</label>
                                       <input style="border-radius: 5px;border: 1px solid var(--gray);" id="dateEnd" type="date" value="{{ date("Y-m-d") }}">
                                    </div>
                               </div>
                            </li>
                            <hr>
                            <li class="nav-item reporte_solicitud_de_citas">
                                <a href="#" class="nav-link reporte_solicitud_de_citas">
                                    <i class="reporte_solicitud_de_citas pc-excel text-success nav-icon"></i>
                                    <p class="reporte_solicitud_de_citas">Solicitudes de citas</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="/consultaexterna/finalizarSesion" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt text-secondary" style="font-size: 1.5rem;"></i>
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>
                </ul>




            </div>

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="overlay-wrapper">
                <div id="cargando" style="height:100vh" class="overlay text-primary d-none">
                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                </div>
                <!-- Content Header (Page header) -->
                <div class="content-header mt-6">
                    <div class="container-fluid">
                        <div class="row" style="height: 60px;">
                            <div class="col-sm-6">
                                <small>{{ $centro_salud_nombre }}</small>
                                <h1 class="m-0 cat-cita-status-title">Consulta externa</h1>

                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    @php
                                        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                    @endphp

                                    <li class="breadcrumb-item active">{{ date('d') }} de {{ $meses[(int) (date('m') - 1)] }}, {{ date('Y') }}</li>
                                {{--  <li title="Actualizar listado de citas" class="breadcrumb-item updateCitas"><a href="#"
                                            class="btn border-0 heartbeat updateCitas"><i
                                                class="fas fa-1x fa-sync-alt text-primary updateCitas"></i></a></li> --}}
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>


                <section class="content">
                    <div class="container-fluid">
                        <div id="headerCitaStatusOptions" class="row">
                            @php
                                $col = 6;
                                $col_lg = 4;
                                if (session('cat_user_type_id') == 2){
                                    $col_lg = 3;
                                }
                            @endphp
                            <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="1"
                                data-name="Citas por confirmar">
                                <!-- small box -->
                                <div class="small-box bg-primary shadow-lg-primary" data-shadow-color="primary">
                                    <div class="inner">
                                        <h3 class="total-citas-poraprobar">0</h3>
                                        <p></p>
                                    </div>
                                    <div class="icon">

                                        <i class="pc-cita_por_confirmar text-white"></i>
                                    </div>
                                    <a href="#" class="small-box-footer h43">
                                        Por Confirmar
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="4"
                                data-name="Citas confirmadas">
                                <!-- small box -->
                                <div class="small-box bg-success" data-shadow-color="success">
                                    <div class="inner">
                                        <h3 class="total-citas-aprobadas">0</h3>
                                        <p></p>
                                    </div>
                                    <div class="icon">

                                        <i class="pc-cita_confirmada text-white"></i> {{-- <i style="top: -25px !important;" ><img style="height:0.8em;opacity: 0.3;" src="/image/system/calendar-check.svg" alt=""></i> --}}
                                    </div>
                                    <a href="#" class="small-box-footer h43">
                                        Confirmadas
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="5"
                                data-name="Preconsulta">
                                <!-- small box -->
                                <div class="small-box bg-warning" data-shadow-color="warning">
                                    <div class="inner">
                                        <h3 class="total-citas-preconsulta  text-white">0</h3>
                                        <p></p>
                                    </div>
                                    <div class="icon">
                                        <i class="pc-preconsulta text-white"></i>
                                    </div>
                                    <a href="#" class="small-box-footer  h43" style="color:white !important">
                                        Preconsulta
                                    </a>
                                </div>
                            </div>
                            @if (session('cat_user_type_id') == 2)
                                <div class="col-lg-{{$col_lg}} col-{{$col}} cursor-pointer" data-cat_user_cita_status_id="6"
                                    data-name="Consulta">
                                    <!-- small box -->
                                    <div class="small-box bg-info" data-shadow-color="info">
                                        <div class="inner">
                                            <h3 class="total-citas-consulta">0</h3>
                                            <p></p>
                                        </div>
                                        <div class="icon">
                                            <i class="pc-consulta text-white"></i>
                                        </div>
                                        <a href="#" class="small-box-footer  text-white h43">
                                            Consulta
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div id="tab_app"  class="d-none"> <!-- fade-in -->
                            <div class="overlay-wrapper">
                                <div id="tab_app_overlay" class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                <div id="App"></div>
                            </div>
                        </div>
                        <div id="tab_citas" class="row" > <!-- scale-in-ver-center -->
                            <!-- Left col -->
                            <section class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-transparent">

                                        <ul id="grupo_filtrar_por" class="navbar-nav d-none">
                                            <li class="nav-item dropdown">
                                                <a title="Filtrar por"
                                                    class="p-1 border-0 btn btn-default dropdown-toggle card-title"
                                                    href="#" data-toggle="dropdown" aria-expanded="true">
                                                <i class="ml-2 fas fa-filter text-info"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <h3 class="dropdown-header text-primary"><b>Filtrar por:</b></h3>
                                                    <li>
                                                        <a data-filtrar_por="solo_yo" class="filtrar_por dropdown-item active"
                                                            href="#">Mis Citas</a>
                                                    </li>
                                                    <li><a data-filtrar_por="todas"
                                                            class="filtrar_por dropdown-item" href="#">Todas las
                                                            citas</a></li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap mb-2">
                                            <div class="col-12 col-sm-6 pl-0">
                                                {{-- <h3 id="title_lista">Por confirmar</h3> --}}
                                            </div>
                                            <div class="col-12 col-sm-6 pr-0 d-flex align-items-center">
                                                <label class="text-primary mb-0 mr-1" for="">Buscar:</label>
                                                <input type="search" placeholder="Escribe el texto a buscar" class="form-control" id="buscar_cita_listado">
                                            </div>
                                        </div>
                                        <div class="overlay-wrapper">
                                            <div class="overlay text-primary d-none">
                                                <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                                <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="citas_pacientes"
                                                    class="table bg-white table-bordered table-hover">
                                                    <thead style="font-size: 1.2em;">
                                                        <tr>
                                                            <th class="text-primary text-center"
                                                                title="Día en que se solicitó la cita">Fecha</th>
                                                            <th class="text-primary text-center">Paciente</th>
                                                            <th class="text-primary">Medico</th>
                                                            <th class="text-primary">Especialidad</th>
                                                            <th class="text-primary">Fecha Cita</th>
                                                            <th class="text-primary">Hora</th>
                                                            <th class="text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="7" class="text-primary text-center">
                                                                Sin pacientes
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="tab_preconsulta" class="d-none" > <!-- fade-in -->
                            <div class="row overlay-wrapper">
                                <div id="tab_preconsulta_overlay" class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                <section class="col-lg-3 connectedSortable">
                                    <div class="card-paciente"></div>
                                    <div class="card-archivos"></div>
                                </section>
                                <section class="col-lg-6">
                                    <div class="group_items_paciente connectedSortable"></div>
                                </section>
                                <section class="col-lg-3">
                                    <div class="group_vital_signs connectedSortable"></div>
                                </section>
                                <section class="col-lg-6 offset-lg-3 connectedSortable">
                                    <button id="submit_preconsulta"
                                        class="submit_preconsulta btn btn-success btn-block btn-lg">Completar y pasar a
                                        consulta</button>
                                </section>
                            </div>

                        </div>
                        <div id="tab_consulta" class="d-none" > <!-- scale-in-hor-right -->
                            <div class="row overlay-wrapper">
                                <div id="tab_consulta_overlay" class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                    <section class="col-lg-3 connectedSortable">
                                        <div class="card collapsed-card">
                                            <div class="card-header" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Historial de Citas</h3>
                                                <div class="card-tools">
                                                    <span
                                                        class="item-counter badge d-none item-counter-user_historial badge-success">0</span>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="acceso-citas-historial-paciente card-body p-0" style="display:none">
                                                <div class="overlay-wrapper">
                                                    <div class="overlay text-primary d-none">
                                                        <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                                        <div class="text-bold pt-2">Por favor espere un momento...</div>
                                                    </div>
                                                    <!--
                                                                    <div class="d-flex align-items-center justify-content-end flex-fill">
                                                                    <div class="dropdown">
                                                                        <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            o
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                            <a class="dropdown-item" href="#"><i class="fas fa-file-pdf text-danger"></i> Imprimir PDF »</a>
                                                                        </div>
                                                                        </div>
                                                                    </div> -->

                                                    <ul class="nav bg-white nav-pills flex-column p-1"
                                                        id="pills-tab-historial-citas-opaciente" role="tablist">
                                                        <li class="nav-item text-center" role="presentation">
                                                            <a class="nav-link" id="pills-contact-tab">No posee citas
                                                                anteriores</a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-paciente"></div>
                                        <div class="card-archivos"></div>
                                        <div class="card d-none">
                                            <div class="card-header">
                                                <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente
                                                    requerirá:</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div id="evaluacionIngreso" class="card-body p-0"
                                                style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item p-1 d-none">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Solo Atención de
                                                                Emergencia</label>

                                                            <select class="form-control border-0" name="atencion_emergencia"
                                                                id="atencion_emergencia">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item p-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Hospitalización:</label>
                                                            <select class="form-control border-0" name="hospitalizacion"
                                                                id="hospitalizacion">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item p-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Terapia Intensiva:</label>
                                                            <select class="form-control border-0" name="terapia_intensiva"
                                                                id="terapia_intensiva">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>

                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item p-1">
                                                        <div class="form-group mb-0">
                                                            <label class="text-gray mb-0" for="">Cirugía:</label>
                                                            <select class="form-control border-0" name="cirugia" id="cirugia">
                                                                <option value="">Seleccione</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>
                                                            </select>
                                                        </div>
                                                    </li>



                                                </ul>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>


                                    </section>
                                    <section class="col-lg-6 connectedSortable">

                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus" data-card-widget="collapse"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_motivo_consulta"
                                                    placeholder="Escriba aquí por qué el paciente acudió a la emergencia"
                                                    name="user_motivo_consulta" id="user_motivo_consulta" rows="3"></textarea>

                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_enfermedad_actual" placeholder="Describa aquí el problema de salud actual"
                                                    name="user_enfermedad_actual" id="user_enfermedad_actual" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_examen_fisico"
                                                    placeholder="Describa brevemente los hallazgos positivos del examen físico realizado."
                                                    name="user_examen_fisico" id="user_examen_fisico" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Impresión diagnóstica</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_impresion_diagnostica"
                                                    placeholder="Describa brevemente sus impresiones de cómo ve al paciente."
                                                    name="user_impresion_diagnostica" id="user_impresion_diagnostica"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header cursor-pointer" data-card-widget="collapse">
                                                <h3 class="card-title text-primary font-weight-bold">Plan</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <textarea class="form-control textarea user_plan" placeholder="Describa brevemente el plan a aplicarsele al paciente."
                                                    name="user_plan" id="user_plan" rows="3"></textarea>
                                            </div>
                                        </div>


                                    </section>

                                    <section class="col-lg-3">
                                        <div class="group_vital_signs connectedSortable"></div>
                                        <div class="group_items_paciente connectedSortable"></div>
                                    </section>
                                    <section class="col-lg-6 offset-lg-3 connectedSortable">
                                        {{-- <div class="alert alert-warning mt-2" role="alert">
                                            <b>Hora 5:00 am 24/04/2022. NIVEL DE DESARROLLO:</b> Agregar menú de culminación: opciones (1) Generar próxima cita. (2) Completar cita con generación de informe, (3) Generar solicitid de cita para cirugía.
                                        </div> --}}
                                        <button id="submit_consulta"
                                            class="submit_consulta btn btn-success btn-block btn-lg">Completar cita médica</button>
                                    </section>


                                </div>
                        </div>
                        <div id="tab_paciente_create" class="row d-none"> <!--  scale-in-ver-top -->
                            <section class="col-lg-12">
                                <div class="card" style="height:70vh;overflow:auto;">
                                    <div class="card-header border-transparent">

                                    </div>

                                    <div class="card-body">
                                        <div id="form_nuevo_paciente"></div>
                                        <div id="form_nuevo_medico">


                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="tab_agenda_create" class="row d-none"> <!--  scale-in-ver-top -->
                            <section class="col-lg-12">
                                <div class="card" style="height:70vh;overflow:auto;">
                                    <div class="card-header border-transparent">

                                    </div>

                                    <div class="card-body">
                                        <div id="form_agenda_create"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="tab_medico_create" class="row d-none"> <!--  scale-in-ver-top -->
                            <section class="col-lg-12">
                                <div class="card" style="height:70vh;overflow:auto;">
                                    <div class="card-header border-transparent">

                                    </div>

                                    <div class="card-body">
                                        <div id="form_nuevo_paciente"></div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </section>
            </div>
        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="height: auto;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal"
                            src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>
                <!-- style="height: 80vh;" -->
                <div class="modal-body" style="background: #F1F3F4!important;">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn flex-fill btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="reprogramacion_store" type="button" class="btn flex-fill btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCancelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">
                    <div class="exampleModal_title"></div>
                    <form></form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fullscreen-modal fade" id="modal-fullscreen" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-between">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white heartbeat"
                            style="font-size: 2em;margin-left:2%;cursor:pointer;" aria-hidden="true"></i>
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                </div>
                <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                </div>
            </div>
        </div>
    </div>
    @include('templates.template_consulta_externa')


    <!-- jQuery -->
    <script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/js/sweetalert2@10.js"></script>
    <script src="/plugin/intl-tel-input/build/js/intlTelInput.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
    <script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/tippy-bundle.umd.min.js"></script>
    <script src="/js/scripts.js?version = 0.1"></script>
    <script>
        let d = document

        let resulset = @json($citas, JSON_PRETTY_PRINT);
        let user_id_medico = Number("{{ Auth::id() }}");
        let user_type_id = Number("{{ session('cat_user_type_id') }}");
        //console.log("user_type_id: ",user_type_id)
        let host_patientcare = "{{ config('app.url') }}";
        let cat_grupo_centro_salud_id = Number("{{ config('app.APP_GRUPO_CENTRO_SALUD_ID') }}");
        let user_centro_salud_id = Number("{{ session('user_centro_salud_id') }}");
        let filtrar_por = "{{ session('filtrar_por') }}";
        let ver_citas_privadas = Number("{{ session('ver_citas_privadas') }}");
        let medico_fullname = "{{ session('userData')['fullname'] }}";
        let medico_genero = "{{ session('userData')['genero'] }}";
        const useState ={
                "user_id_medico":"",
                "user_id_gerente": Number("{{ session('user_id_gerente') }}"),
                "gerente_nombre": "{{ session('gerente_nombre') }}",
                "ver_citas_privadas":ver_citas_privadas,
                "medico_genero":medico_genero,
                "user_type_id":user_type_id,
                "medico_fullname":medico_fullname,
                "host_patientcare":host_patientcare,
                "cat_grupo_centro_salud_id":cat_grupo_centro_salud_id,
                "user_centro_salud_id":user_centro_salud_id,
                "medicos"                :resulset.medicos,
                "medico"                :resulset.medico,
                "users"                : resulset.users,
                "especialidades"       : [],
                "pacientes"            : resulset.pacientes,
                "citas"                : resulset.citas,
                "tarjetasoychacao"     : resulset.tarjetasoychacao,
                "user_condicion_medica": resulset.user_condicion_medica,
                "user_medicamento"     : resulset.user_medicamento,
                "user_antecedente"     : resulset.user_antecedente,
                "user_alergias"        : resulset.user_alergias,
                "medicos_agenda"        : resulset.medicos_agenda,
                "centro_salud"        : resulset.centro_salud,
                "user_recipe": resulset.user_recipe,
                "user_estudio": resulset.user_estudio,
                "user_laboratorio": resulset.user_laboratorio,
                "user_fotografia": resulset.user_fotografia,
                "user_imagenes": resulset.user_imagenes,
                "user_otro_archivo": resulset.user_otro_archivo,
                "formRecipeCreate":{
                    "recipe_num":null,
                    "user_id":null,
                    "recipe_id":null,
                    "user_cita_id":"",
                    "value":"",
                    "value2":"",
                    "value3":"",
                    "value4":1,
                },
                "formFileCreate":{
                    "user_id":null,
                    "user_cita_id":null,
                },
                "formEstudioCreate":{
                    "estudio_num":null,
                    "user_id":null,
                    "user_cita_id":"",
                    "value":"",
                    "value2":"",
                    "estudio_id":null,
                    "coments":"",
                },
                "formAgendaCreate":{
                    "agenda_year": "",
                    "agenda_month":[],
                    "agenda_day_week":[],
                    "agenda_hour":[],
                    "cupos_por_dia":1,// pacientes por hora
                    "centro_salud_id":"",
                    "user_id_medico":"",
                    "cat_especialidad_id":"",
                    "agenda":[]
                },
                "formReprogramar"      : {
                    "cat_user_cita_status_id": 2,
                    "fecha"                  : "aaaa-mm-dd",
                    "year"                   : "aaaa",
                    "month"                  : "mm",
                    "day"                    : "dd",
                    "hour"                   : "00:00",
                    "coments"                : "",
                    "coments2"               : "",
                    "created_at"             : timestamps()
                },
                "formCreateCita": {
                    "file": null,
                    "user_id_paciente"    : "",
                    "cat_especialidad_id"    : "",
                    "centro_salud_id"     : "",
                    "cita_dia"            : "",
                    "cita_hora"           : "",
                    "user_id_medico"      : "",
                    "condicion_administrativa": "Particular",
                    "cita_motivo"         : "",
                    "enfermedad_actual"   : "",
                    "cat_user_cita_status_id": 1,
                },
                "formCreateMedico":{
                    "nacionalidad"            : "V",
                    "cedula"                  : "",
                    "email"                   : "",
                    "password"                : "123456",
                    "password_repeat"         : "123456",
                    "nombres"                 : "",
                    "apellidos"               : "",
                    "genero"                  : "m",
                    "prefijo"                 : "Dr.",
                    "fnacimiento"             : "",
                    "telefono_movil"          : "",
                    "cat_estado_id"           : "14",
                    "cat_municipio_id"        : "180",
                    "description"             : "Caracas",      //ciudad
                    "domicilio"               : "",
                    "tarjeta_soy_chacao"      : "",
                    "fecha_ingreso"           : timestamps(),
                    "cat_user_equipo_salud_id": "1",
                    "cat_user_especialidad_id": [],
                    "cat_medico_posicion_id"  : "1",
                    "colegio_medico"          : "",
                    "mpps"                    : "",
                    "sello"                   : "",
                    "firma"                   : "",
                    "centro_salud_id"         : [1],
                    "cat_user_type_id"         : [1,2],
                },
                "formCreatePaciente":{
                    "nacionalidad"    : "V",
                    "cedula"          : "",
                    "email"           : "",
                    "password"        : "",
                    "password_repeat" : "",
                    "nombres"         : "",
                    "apellidos"       : "",
                    "genero"          : "m",
                    "fnacimiento"     : "",
                    "telefono_movil"  : "",
                    "cat_estado_id"   : "14",
                    "cat_municipio_id": "180",
                    "description"     : "Caracas",    //ciudad
                    "domicilio"       : "",
                    "tarjeta_soy_chacao": "",
                    "fecha_ingreso" :"",
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

                "search_resultset": [],
                "status_current_tab": 1,
                "user_id_medico"    : parseInt(user_id_medico),
                "user_type_id"      : parseInt(user_type_id),
                "filtrar_por"       : filtrar_por,
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
        console.log('useState --> ',useState)
        d.addEventListener("click",function (e) {
            if (e.target.matches(".reporte_solicitud_de_citas")) {
                let dateStart = 