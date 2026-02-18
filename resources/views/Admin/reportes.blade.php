<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMDLT</title>

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        :root{
            --bs-primary-rgb: <?= config("app.APP_BS_PRIMARY") ?> ;
            --bs-primary-rgb-hover: <?=config("app.APP_BS_PRIMARY_HOVER") ?> ;
            --primary:rgb(var(--bs-primary-rgb)) !important;
            --primary-hover: rgb( var(--bs-primary-rgb-hover)) !important;
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
        .jumbotron h2,
        .jumbotron li,
        .jumbotron i,
        .jumbotron input{
            color: var(--primary) ;
        }
        .jumbotron:hover,
        .jumbotron:hover h2,
        .jumbotron:hover a.users-list-name,
        .jumbotron:hover span.users-list-date,
        .jumbotron:hover span.description-percentage,
        .jumbotron:hover span.description-text,
        .jumbotron:hover h5.description-header,
        .jumbotron:hover table,
        .jumbotron:hover li,
        .jumbotron:hover h4,
        .jumbotron:hover i
        {
            background-color: var(--primary) !important ;
            color:white !important;
            cursor:pointer;
        }

        .jumbotron:hover input
        {
            background-color: var(--white) !important ;
            color: var(--primary) ;
            cursor:pointer;
        }
    </style>
    <style>
        .card-title {
            float: left;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }
        body {
            background: #eeeeee !important;
        }
        .content-wrapper {
            background: transparent !important;
        }
        .text-xl {
            font-size: 3rem !important;
        }
        /* table {
        border-collapse: separate;
        border-spacing: 0;
        }

        td {
        border: solid 1px #000;
        border-style: none solid solid none;
        padding: 10px;
        }

        tr:first-child td:first-child { border-top-left-radius: 10px; }
        tr:first-child td:last-child { border-top-right-radius: 10px; }

        tr:last-child td:first-child { border-bottom-left-radius: 10px; }
        tr:last-child td:last-child { border-bottom-right-radius: 10px; }

        tr:first-child td { border-top-style: solid; }
        tr td:first-child { border-left-style: solid; } */
    </style>

    <script>
        function reemplaza_imagen(imagen) {
            imagen.onerror = "";
            imagen.src = "/image/system/medic.svg";
            return true;
        }
    </script>
    <style>
        .card-reporte-excel{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem !important;
        }
        .card-reporte-excel i,
        .card-reporte-excel small{
            color:var(--success);
        }
        .card-reporte-excel:hover{
            color: #ffffff;
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
        }
        .card-reporte-excel:hover i,
        .card-reporte-excel:hover small{
            color: #ffffff;
        }
    </style>
</head>

<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed  sidebar-collapse">
    {{-- <body class="control-sidebar-slide-open layout-navbar-fixed sidebar-collapse sidebar-mini"> --}} <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center bg-primary align-items-center">
            <img class="animation__shake" src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
                alt="AdminLTELogo" height="200" width="200">
        </div>

        <nav id="navbarMain"
            class="navbar shadow navbar-expand m-0 mt-1 rounded-pill mx-1 p-0 pr-2 fixed-top navbar-primary navbar-dark">

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars text-white"></i>
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav align-items-center ml-auto">
                <li class="nav-item m-0 p-0">
                    <a class="navbar-brand m-0 p-0" href="#">
                        <img src="/image/system/{{ config('app.APP_LOGO_VERSION_MONO') }}"
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
                        <img onerror="reemplaza_imagen(this)" src="{{ session('userData')['imagen'] }}"
                            class="sidebar-medico-edit img-circle elevation-2" alt="User Image"
                            style="height: 2.1rem;width: 2.1rem;">
                    </div>
                    <div class="info sidebar-medico-edit">
                        <a href="#"
                            class="d-block text-primary sidebar-medico-edit">{{ session('userData')['fullname'] }}</a>
                    </div>
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link btn-dashboard-reportes">
                            <i class="fas fa-tachometer-alt text-info"></i>
                            <p>
                                Reportes CMDLT
                               {{--  <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 mt-6">
                        <div class="col-12 text-center text-uppercase">
                            <small>Bienvenidos</small>
                            <h1 class="m-0 text-primary cat-cita-status-title">Reportes CMDLT</h1>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

                <div class="overlay-wrapper">
                    <div id="cargando" class="overlay d-none"><i class="fas fa-3x text-primary fa-sync-alt fa-spin"></i><div class="text-bold text-primary pt-2">Por favor espere...</div></div>
                    <div id="App"></div>
                </div>    <!-- /.row -->

                <!-- /.container-fluid -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


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
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/tippy-bundle.umd.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script>
        let d = document;
        let $App = d.querySelector(`#App`)
        let useState = {

            }

    </script>
    <script src="/component/App.js" type="module"></script>
