<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMDLT | Citas</title>


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
        .btn-outline-white {
            color: rgb(255, 255, 255);
            border-color: rgb(255, 255, 255);
        }
        .btn-outline-white:hover {
            color: var(--primary);
            background-color: rgb(255, 255, 255);
            border-color: rgb(255, 255, 255);
        }
    </style>
    <style>

        .navbar-main-shadow {
            -webkit-box-shadow: 0px 10px 13px -7px #000000, 38px 17px 19px 23px rgb(241 243 244 / 0%);
            box-shadow: 0px 10px 13px -7px #343a40, 38px 17px 19px 23px #f1f3f400;
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

        #navbarMain .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--primary);
            background-color: var(--white);
        }

        .btn-hover-1:hover,
        .btn-hover-1:active,
        .btn-hover-1.hover {
            background-color: #e9ecef;
            color: #2b2b2b;
            cursor: pointer;
        }

        .container-card-citas{
        display: grid;
        grid-template-columns: repeat(1,1fr);
        gap:0.5rem;
        padding: 1rem;
        border-radius: 1rem;
        }
        .card-cita{
            border: 1px solid #f2f2f2;
            padding:0.5rem;
            display: grid;
            grid-template-columns: 1fr;
            /* row-gap: 0.5rem; */
            border-radius: 1rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            grid-template-rows: auto auto auto auto 1fr auto auto auto auto;
        }
        .card-cita:hover{
        background-color: #D9D9D9;
        }
        .card-row:nth-child(1){
        display: grid;
        grid-template-columns: 1fr 50px;

        }
        .card-row:nth-child(1) h3,
        .card-row:nth-child(2) h6,
        .card-row:nth-child(3) h6,
        .card-row:nth-child(4) h6,
        .card-row:nth-child(5) h6{
        color: #00B0F0;
        }
        .card-row:nth-child(6) h6{
        color: #C00000;
        }
        .card-row:nth-child(1) h6{
        color: #b3b3b3;
        }
        .card-row:nth-child(1) h3,
        .card-row:nth-child(1) h4,
        .card-row:nth-child(1) h6 {
            margin-bottom: 0;
            font-weight: 500;
            line-height: 1.2;
        }
        .card-row:nth-child(1) h6 {
        font-size: 0.7rem;
        }
        .card-row:nth-child(1) {
        margin-bottom: 0.5rem;
        }
        .card-row:nth-child(3) article:nth-child(1){
        background-color: #dff3ff;
        }
        .card-row:nth-child(3) article:nth-child(2){
        background-color: #fff0c1;
        }
        .card-row:nth-child(3) article:nth-child(1),
        .card-row:nth-child(3) article:nth-child(2){
        display: grid;
        padding: 0.5rem;

        grid-template-rows: 35px auto;
        border-radius: 1rem;
        }
        .card-row:nth-child(3) article div{
        display: grid;
        grid-template-columns: 40px 1fr;
        }
        .card-row:nth-child(3){
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        align-items: stretch;
        margin-bottom: 0.5rem;
        }
        .card-row:nth-child(2) div:nth-child(2) {
        display:grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        text-align: center;
        white-space: nowrap;
        font-size: 0.8rem;
        padding-bottom: 0.4rem;
        }

        .card-row:nth-child(2) h6,
        .card-row:nth-child(3) h6,
        .card-row:nth-child(4) h6,
        .card-row:nth-child(5) h6,
        .card-row:nth-child(6) h6{
        text-align:center;
        font-weight: 600;
        border-bottom: 1px solid #e9e9e9;
        padding: 2px;
        }


        .card-row:nth-child(4) p,
        .card-row:nth-child(5) p,
        .card-row:nth-child(6) p{
        text-align:center;
        padding: 0.5rem;
        font-size: 1rem;
        }

        .card-row:nth-child(4),
        .card-row:nth-child(5),
        .card-row:nth-child(6){
        display:grid;
        grid-template-rows: auto 1fr;
        background-color: #F2F2F2;
        border-radius: 1rem;
        margin-bottom: 0.5rem;
        }
        .card-row:nth-child(2){
        display:grid;
        grid-template-rows: auto 1fr;
        background-color: #ebe7e7;
        border-radius: 1rem;
        margin-bottom: 0.5rem;
        }

        .card-row:nth-child(2) div:nth-child(2),
        .card-row:nth-child(4) p,
        .card-row:nth-child(5) p,
        .card-row:nth-child(6) p{
            color:rgb(75, 75, 75);
        }
        .card-row:nth-child(7){
            margin-bottom: 0.5rem;
        }
        .card-row:nth-child(8),
        .card-row:nth-child(9){
            display: grid;
            align-self: end;
        }

        @media (min-width: 576px) {
        .container-card-citas {
            grid-template-columns: repeat(2,1fr);
        }
        }

        @media (min-width: 768px) {
        .container-card-citas {
            grid-template-columns: repeat(3,1fr);
        }
        }



    </style>
    <script>
        function reemplaza_imagen(imagen) {
            imagen.onerror = "";
            imagen.src = "/image/system/icono-paciente-blanco.svg";
            return true;
        }
    </script>
</head>

<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed  sidebar-collapse">
    <div class="overlay-wrapper">
        <div id="cargando" class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
            <div class="text-bold pt-2 text-primary">Espere un momento por favor...</div>
        </div>
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center bg-primary align-items-center">
                <img class="scale-in-ver-center" src="/image/system/logo-cmdlt_mono.svg"
                    alt="AdminLTELogo" height="200" width="200">
            </div>


            <nav id="navbarMain"
                class="navbar shadow navbar-expand m-0 mt-1 rounded-pill mx-1 p-0 pr-2 fixed-top navbar-primary navbar-dark">
                <div class="container-fluid">



                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                        <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item dropdown show">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle">Dropdown</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow " style="left: 0px; right: inherit;">
                            <li><a href="#" class="dropdown-item">Some action </a></li>
                            <li><a href="#" class="dropdown-item">Some other action</a></li>

                            <li class="dropdown-divider"></li>

                            <!-- Level two dropdown-->
                            <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow " style="">
                                <li>
                                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                </li>

                                <!-- Level three dropdown-->
                                <li class="dropdown-submenu">
                                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow ">
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                </ul>
                                </li>
                                <!-- End Level three -->

                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                            </li>
                            <!-- End Level two -->
                        </ul>
                        </li> --}}
                        </ul>

                        <!-- SEARCH FORM -->

                    </div>

                    <!-- Right navbar links -->
                    <ul class="align-items-center order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <!-- Messages Dropdown Menu -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-comments"></i>
                                <span class="badge badge-danger navbar-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                style="left: inherit; right: 0px;">
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Brad Diesel
                                                <span class="float-right text-sm text-danger"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">Call me whenever you can...</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                John Pierce
                                                <span class="float-right text-sm text-muted"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">I got your message bro</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                            </div>
                        </li> --}}
                        <!-- Notifications Dropdown Menu -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="far fa-bell"></i>
                                <span class="badge badge-warning navbar-badge">15</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                style="left: inherit; right: 0px;">
                                <span class="dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                                role="button">
                                <i class="fas fa-search"></i>
                            </a>
                        </li> --}}
                        <li class="nav-item m-0 p-0">
                            <a class="navbar-brand m-0 p-0" href="#">
                                <img src="/image/system/logo-cmdlt_mono.svg"
                                    style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
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
                </ul> --}}
            </nav>


            <!-- Main Sidebar Container -->
            <aside class="main-sidebar mt-6 sidebar-light-primary elevation-4">
                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="user-panel  btn-hover-1 sidebar-paciente-edit my-3 py-3 d-flex">
                        <div class="image sidebar-paciente-edit">
                            <img onerror="reemplaza_imagen(this)"

                                class="user_card_imagen sidebar-paciente-edit img-circle elevation-2" alt="User Image"
                                style="height: 2.1rem;width: 2.1rem;">
                        </div>
                        <div class="info sidebar-paciente-edit">
                            <a href="#" class="user_card_username d-block text-primary sidebar-paciente-edit">No disponible</a>
                            <div class="sidebar-paciente-edit text-info">Editar mi datos</div>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link btn-mascota">
                                <i class="nav-icon pc-veterinario btn-mascota text-info" style="font-size: 2rem;"></i>
                                <p class="btn-mascota">
                                    Información Veterinaria
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-familiar-list">
                                <i class="nav-icon pc-familia btn-familiar-list text-info" style="font-size: 2rem;"></i>
                                <p class="btn-familiar-list">
                                    Grupo Familiar
                                {{--  <i class="right fas fa-angle-left" style="top: 1.2rem;"></i> --}}
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
            <div class="content-wrapper pt-3">
                <section class="content mt-6 mt-lg-6 mt-sm-6">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div id="profile_paciente" class="card card-primary " style="border-radius: 1.25rem;">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img onerror="reemplaza_imagen(this)" class="cursor-pointer sidebar-paciente-edit user_card_imagen imagen-perfil profile-user-img img-fluid img-circle"
                                                src="/image/system/icono-paciente-blanco.svg"
                                                style="width: 90px;height: 90px;object-fit: cover;"
                                                alt="User profile picture">
                                        </div>

                                        <h3 class="cursor-pointer sidebar-paciente-edit user_card_username text-center">{{-- Sample Name --}}</h3>

                                        <p class="cursor-pointer sidebar-paciente-edit user_card_cedula text-muted text-center">{{-- 00.000.000 --}}</p>
                                        {{-- @if (session('userData')['tarjeta_soy_chacao'] !== NULL) --}}
                                        @if (true)
                                            <a class="btn  rounded-pill btn-success btn-block text-white btn-lg btn-nueva-cita"
                                                data-cat_especialidad_id=""
                                                data-centro_salud_id=""
                                                data-user_id_medico=""
                                                data-hora=""
                                                data-cita_motivo=""
                                            >
                                                <b
                                                data-cat_especialidad_id=""
                                                data-centro_salud_id=""
                                                data-user_id_medico=""
                                                data-hora=""
                                                data-cita_motivo=""

                                                class="btn-nueva-cita">Nueva Cita</b>
                                            </a>
                                        @else
                                            <a class="btn btn-tarjeta-schacao-no-encontrada  rounded-pill btn-gray btn-block text-secondary btn-lg"
                                            >
                                                <b>Nueva Cita</b>
                                            </a>
                                        @endif

                                        <ul class="d-none d-sm-block list-group list-group-unbordered mb-3">
                                            {{-- <li class="list-group-item">
                                                <b>Récipes</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Estudios Diagnósticos</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Informes</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Citas completadas</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Récipes</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Solicitud de Estudio Diagnóstico</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Archivos</b> <a class="float-right">0</a> --}}
                                            </li>
                                        </ul>


                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-tabs">
                                                <div class="card-header p-0">
                                                    <ul class="nav justify-content-around nav-tabs"
                                                        id="navegacion_consulta_externa" role="tablist">
                                                        <li style="background-color: #e3ecf1"
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3 border-right">
                                                            <a class="active" id="custom-tabs-1-tab" data-toggle="pill"
                                                                href="#custom-tabs-1" role="tab"
                                                                aria-controls="custom-tabs-1" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-success h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class="pc-cita_por_confirmar text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Mis
                                                                            Citas</span>

                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3 border-right">
                                                            <a id="custom-tabs-2-tab" data-toggle="pill"
                                                                href="#custom-tabs-2" role="tab"
                                                                aria-controls="custom-tabs-2" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-warning h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class="pc-solid_estetoscopio text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Especialidades</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3 border-right">
                                                            <a id="custom-tabs-3-tab" data-toggle="pill"
                                                                href="#custom-tabs-3" role="tab"
                                                                aria-controls="custom-tabs-3" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-primary h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class=" pc-medico text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Médicos</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li>
                                                       {{--  <li
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-4-tab" data-toggle="pill"
                                                                href="#custom-tabs-4" role="tab"
                                                                aria-controls="custom-tabs-4" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-info h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class="fas fa-map-marker-alt text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Centros
                                                                            de Salud</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li> --}}
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-5-tab" data-toggle="pill"
                                                                href="#custom-tabs-5" role="tab"
                                                                aria-controls="custom-tabs-5" aria-selected="true">
                                                                Nueva Cita
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-6-tab" data-toggle="pill"
                                                                href="#custom-tabs-6" role="tab"
                                                                aria-controls="custom-tabs-6" aria-selected="true">
                                                                Información Veterinaria
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-7-tab" data-toggle="pill"
                                                                href="#custom-tabs-7" role="tab"
                                                                aria-controls="custom-tabs-7" aria-selected="true">
                                                                Familiares
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-8-tab" data-toggle="pill"
                                                                href="#custom-tabs-8" role="tab"
                                                                aria-controls="custom-tabs-8" aria-selected="true">
                                                                Familiar create
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-9-tab" data-toggle="pill"
                                                                href="#custom-tabs-9" role="tab"
                                                                aria-controls="custom-tabs-9" aria-selected="true">
                                                                Datos del Paciente
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-body">

                                                        <div class="tab-content" id="custom-tabs-five-tabContent">
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade active show" id="custom-tabs-1"
                                                                role="tabpanel" aria-labelledby="custom-tabs-1-tab">
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 text-primary active" id="cita-activas-tab" data-toggle="tab" href="#cita-activas" role="tab" aria-controls="cita-activas" aria-selected="true"><i class="pc-solid_estetoscopio h4 text-primary"></i> Citas Activas <span id="contador_activas" class="badge badge-info d-none">0</span></a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 text-primary" id="cita-completada-tab" data-toggle="tab" href="#cita-completada" role="tab" aria-controls="cita-completada" aria-selected="false"><i class="pc-solid-history-episode h4 text-primary"></i> Historial de citas <span id="contador_historial" class="badge badge-info d-none">0</span></a>
                                                                    </li>

                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="cita-activas" role="tabpanel" aria-labelledby="cita-activas-tab">
                                                                        <div class="container-fluid">
                                                                            <div id="container_citas_activas" class="container-card-citas">
                                                                                <div class="row">
                                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                                        <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                            <div
                                                                                                class="card-body text-center text-primary">
                                                                                                No posees citas activas.
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="cita-completada" role="tabpanel" aria-labelledby="cita-completada-tab">
                                                                        <div class="container-fluid">


                                                                            <div id="container_citas_completadas" class="container-card-citas">


                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-2" role="tabpanel"
                                                                aria-labelledby="custom-tabs-2-tab">

                                                                <div class="container-fluid">


                                                                    <div id="container_especialidades" class="row">
                                                                        <div
                                                                            class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                <div
                                                                                    class="card-body text-center text-primary">
                                                                                    No se encontraron especialidades
                                                                                    disponibles.
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-3" role="tabpanel"
                                                                aria-labelledby="custom-tabs-3-tab">


                                                                <div class="container-fluid">

                                                                    <div id="container_medicos" class="row">
                                                                        <div
                                                                            class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                <div
                                                                                    class="card-body text-center text-primary">
                                                                                    No se encontraron médicos disponibles.
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-4" role="tabpanel"
                                                                aria-labelledby="custom-tabs-4-tab">


                                                                <div class="container-fluid">

                                                                    <div id="container_centro_de_salud" class="row">
                                                                        <div
                                                                            class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                <div
                                                                                    class="card-body text-center text-primary">
                                                                                    No se encontraron Centros de Salud
                                                                                    disponibles.
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-5" role="tabpanel"
                                                                aria-labelledby="custom-tabs-5-tab">
                                                                <div class="container">
                                                                    <form>
                                                                        <div class="form-row">
                                                                            <!-- especialidad -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            1</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label id="textEspecialidad" class="h5 m-0 text-primary" for="validationServer03">Selecciona la especialidad</label>
                                                                                            <small
                                                                                                title="Especialidades disponibles."
                                                                                                class="d-none notification cat_especialidad_id badge badge-info font-weight-normal"></small>
                                                                                    </div>
                                                                                </div>
                                                                                <select name="cat_especialidad_id"
                                                                                    class="custom-select "
                                                                                    id="validationServer03"
                                                                                    aria-describedby="validationServer02Feedback"
                                                                                    required>
                                                                                </select>
                                                                                <div id="validationServer03Feedback"
                                                                                    class="invalid-feedback cat_especialidad_id">
                                                                                    Por favor selecciona una especialidad.
                                                                                </div>
                                                                            </div>
                                                                            <!-- centro de salud -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="form-number-input-centro_salud_id bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            2</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="h5 m-0 text-primary"
                                                                                            for="validationServer03">Selecciona el Centro de Salud</label>
                                                                                            <small
                                                                                            title="Centros de Salud en donde se atiende esta centro-salud"
                                                                                                class="d-none notification centro_salud_id badge badge-info font-weight-normal"></small>
                                                                                    </div>
                                                                                </div>

                                                                                <select name="centro_salud_id"
                                                                                    class="custom-select "
                                                                                    id="validationServer04"
                                                                                    aria-describedby="validationServer04Feedback"
                                                                                    required>
                                                                                </select>
                                                                                <div id="validationServer04Feedback"
                                                                                    class="invalid-feedback centro_salud_id">
                                                                                    Por favor selecciona un Centro de Salud.
                                                                                </div>
                                                                            </div>
                                                                            <!-- user_id_medico -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="form-number-input-user_id_medico bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            3</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="h5 m-0 text-primary"
                                                                                            for="validationServer03">Selecciona el médico de tu preferencia</label>
                                                                                            <small
                                                                                            title="Médicos que atienden esta especialidad"
                                                                                                class="d-none notification user_id_medico badge badge-info font-weight-normal"></small>
                                                                                    </div>
                                                                                </div>

                                                                                <select name="user_id_medico"
                                                                                    class="custom-select "
                                                                                    id="validationServer05"
                                                                                    aria-describedby="validationServer05Feedback"
                                                                                    required>
                                                                                </select>
                                                                                <div id="validationServer05Feedback"
                                                                                    class="invalid-feedback user_id_medico">
                                                                                    Por favor selecciona un médico.
                                                                                </div>
                                                                            </div>
                                                                            <!-- calendario -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="cita_dia form-number-input-cita_dia bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            4</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="cita_dia h5 m-0 text-primary"
                                                                                            for="validationServer05">
                                                                                            Indica el día de tu conveniencia
                                                                                            <small
                                                                                                title="Dias en que se atiende este médico."
                                                                                                class="d-none notification cita_dia badge badge-info font-weight-normal"><b>0</b></small>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="mensaje_dia_seleccionado" class="text-center text-secondary" style="font-size:20px">
                                                                                    Solo los días resaltados en gris están disponibles.
                                                                                </div>

                                                                                <input required id="cita_dia" name="cita_dia" type="hidden">
                                                                                <div id="calendar" class="daterange" style="width: 100%"></div>

                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_dia">
                                                                                    Por favor selecciona un día válido.
                                                                                </div>
                                                                            </div>
                                                                            <!-- hora -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="cita_hora form-number-input-cita_hora bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            5</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="cita_hora h5 m-0 text-primary"
                                                                                            for="validationServer05">
                                                                                            Escoje una hora
                                                                                            <small
                                                                                                title="Médicos que atienden esta especialidad"
                                                                                                class="d-none notification user_id_medico badge badge-info font-weight-normal"><b>0</b></small>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <input required id="cita_hora" name="cita_hora" type="hidden">
                                                                                <ul class="d-none nav justify-content-center  nav-tabs mb-3" id="horarios" role="tablist">
                                                                                    <li class="nav-item flex-fill text-center" role="presentation">
                                                                                        <a class="nav-link active" id="pills-am-tab" data-cita-horario="am" data-toggle="pill"
                                                                                            href="#pills-am" role="tab" aria-controls="pills-am" aria-selected="true">Mañana</a>
                                                                                    </li>
                                                                                    <li class="nav-item flex-fill text-center" role="presentation">
                                                                                        <a class="nav-link" id="pills-pm-tab" data-cita-horario="pm" data-toggle="pill"
                                                                                            href="#pills-pm" role="tab" aria-controls="pills-pm" aria-selected="false">Tarde</a>
                                                                                    </li>
                                                                                </ul>
                                                                                <div class="tab-content" id="pills-tabContentHoras">
                                                                                    <div class="tab-pane fade show active" id="pills-am" role="tabpanel"
                                                                                        aria-labelledby="pills-tabContentHoras">
                                                                                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                                                                                            <div class="flex-fill text-center text-secondary" style="font-size:15px">
                                                                                                Sin Horas disponibles
                                                                                            </div>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="pills-pm" role="tabpanel"
                                                                                        aria-labelledby="pills-tabContentHoras">
                                                                                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">


                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_hora">
                                                                                    Por favor selecciona una respuesta
                                                                                    válida.
                                                                                </div>
                                                                            </div>
                                                                            <!-- motivo consulta -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="cita_motivo form-number-input-cita_motivo bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            6</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="cita_motivo h5 m-0 text-primary"
                                                                                            for="validationServer05">
                                                                                            Motivo de consulta
                                                                                            <small
                                                                                                title="Médicos que atienden esta especialidad"
                                                                                                class="d-none notification cita_motivo badge badge-info font-weight-normal"><b>0</b></small>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <textarea class="form-control" placeholder="Escribe el motivo" name="cita_motivo" id="cita_motivo" rows="3"></textarea>
                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_motivo">
                                                                                    Por favor selecciona una respuesta
                                                                                    válida.
                                                                                </div>
                                                                            </div>
                                                                            <!-- cita soy ciudadano? -->
                                                                            <div class="d-none col-md-8 offset-md-2 mb-3 border-top">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">

                                                                                    <div>
                                                                                        <label class="h5 m-0 text-primary"
                                                                                            for="validationServer06">¿Has
                                                                                            solicitado cita por Soy
                                                                                            ciudadano?</label>
                                                                                    </div>
                                                                                </div>
                                                                                <select name="cita_soy_ciudadano"
                                                                                    class="custom-select "
                                                                                    id="validationServer06"
                                                                                    aria-describedby="validationServer01Feedback"
                                                                                    required>
                                                                                    <option value="No">No</option>
                                                                                    <option value="Si">Si</option>
                                                                                </select>
                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_soy_ciudadano">
                                                                                    Por favor selecciona una respuesta
                                                                                    válida.
                                                                                </div>
                                                                            </div>
                                                                            <!-- submit -->
                                                                            <div class="col-md-6 offset-md-3 mb-3">
                                                                                <button id="btn_enviar" class="btn btn-success btn-block"
                                                                                type="submit">Enviar datos</button>
                                                                            </div>
                                                                        </div>



                                                                    </form>
                                                                </div>


                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-6" role="tabpanel"
                                                                aria-labelledby="custom-tabs-6-tab">
                                                                <h3 class="text-primary"><i class="pc-veterinario" style="font-size: 2rem;"></i> Información Veterinaria</h3>
                                                                <ul id="navegacion_mascotas" class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 text-primary active" id="mascota-list-tab" data-toggle="tab" href="#mascota-list" role="tab" aria-controls="mascota-list" aria-selected="true">Listado de Mascotas <span id="contador_mascotas" class="badge badge-info d-none">0</span></a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 nav-link btn btn-success btn-mascota-create" id="mascota-crear-tab" data-toggle="tab" href="#mascota-create" role="tab" aria-controls="mascota-create" aria-selected="false">Registrar nueva mascota</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="mascota-list" role="tabpanel" aria-labelledby="cita-activas-tab">
                                                                        <div class="table-responsive">
                                                                            <table class="mascotas-list bg-white table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-primary text-center">Mascota</th>
                                                                                        <th class="text-primary text-center">Tipo</th>
                                                                                        <th class="text-primary text-center">Raza</th>
                                                                                        <th class="text-primary text-center">Color</th>
                                                                                        <th class="text-primary text-center">Adquisición</th>
                                                                                        <th class="text-primary text-center">Plaquita</th>
                                                                                        <th class="text-primary text-center">Sexo</th>
                                                                                        <th class="text-primary text-center">Edad</th>
                                                                                        <th class="text-primary text-center">Peso</th>
                                                                                        <th class="text-primary text-center">Comentarios</th>
                                                                                        <th class="text-primary text-center"></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" colspan="11">
                                                                                            Sin resultados
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="mascota-create" role="tabpanel" aria-labelledby="cita-completada-tab">
                                                                        <div class="container-fluid">
                                                                            <div class="row">

                                                                                <div class="col-12 col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="nombre" class="text-primary">Nombre de la mascota</label>
                                                                                        <input data-message="Un nombre es requerido"  type="text" name="nombre" id="nombre" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="tipo" class="text-primary">Tipo de mascota</label>
                                                                                        <select data-message="Un tipo es requerido"  class="form-control" name="tipo" id="tipo"></select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="raza" class="text-primary">Raza de la mascota</label>
                                                                                        <input type="text" data-message="Una raza es requerida"  name="raza" id="raza" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="color" class="text-primary">Color</label>
                                                                                        <input type="text" data-message="Un color es requerido"  name="color" id="color" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="t_adquisicion" class="text-primary">Tipo de Adquisición</label>
                                                                                        <select data-message="Un tipo de adquisición es requerido"  class="form-control" name="t_adquisicion" id="t_adquisicion">
                                                                                            <option value="">Seleccione</option>
                                                                                            <option value="Comprado">Comprado</option>
                                                                                            <option value="Adoptado">Adoptado</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="plaquita" class="text-primary">Plaquita de identificación</label>
                                                                                        <input type="text" data-message="Plaquita de identificación, es requerido"  class="form-control" name="plaquita" id="plaquita">
                                                                                        <small id="helpId" class="text-muted">(Dejar vacio si no posee)</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="sexo" class="text-primary">Sexo</label>
                                                                                        <select data-message="Un sexo es requerido"  class="form-control" name="sexo" id="sexo">
                                                                                            <option value="">Seleccione</option>
                                                                                            <option value="Macho">Macho</option>
                                                                                            <option value="Hembra">Hembra</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="text-primary">Edad</label>
                                                                                        <input data-message="Una edad es requerida"  type="text" class="form-control" name="edad">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="" class="text-primary">Peso</label>
                                                                                        <input data-message="Un peso es requerido"  type="text" class="form-control mb-1" name="peso">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="text-primary">Comentarios</label>
                                                                                        <textarea data-message="Un comentario es requerido" class="form-control" name="comentario" id="comentario" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="offset-2 col-8">
                                                                                    <button type="button" class="btn-mascota-store btn btn-success btn-block rounded-pill">Guardar datos</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-7" role="tabpanel"
                                                                aria-labelledby="custom-tabs-7-tab">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h3 class="text-primary">
                                                                                <i class="pc-familia" style="font-size: 2rem;"></i>
                                                                                Familiares
                                                                            </h3>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-12 col-sm-8 order-2 order-sm-1 my-1">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                  <span class="input-group-text font-weight-bold text-primary" id="cedulafamiliar">Buscar un familiar por cédula:</span>
                                                                                </div>
                                                                                <input type="number" style="height: 39px;" class="form-control" id="cedula" aria-label="cedula" aria-describedby="cedulafamiliar" placeholder="Escriba cédula del familiar registrado">
                                                                                <div class="input-group-append">
                                                                                    <button type="button" class="btn-familiar-search btn btn-success btn-block">Buscar</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-12 col-sm-4 order-1 order-sm-2 text-right my-1">
                                                                            <button type="button" class="btn-familiar-create btn btn-success"><i class="btn-familiar-create fas fa-plus"></i> Añadir hijo menor de edad</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="table-responsive">
                                                                                <table class="familiar-list bg-white table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-primary text-center">Familiar</th>
                                                                                            <th class="text-primary text-center">Cédula</th>
                                                                                            <th class="text-primary text-center">Parentesco</th>
                                                                                            <th class="text-primary text-center">Verificado</th>
                                                                                            <th class="text-primary text-center">Comentarios</th>
                                                                                            <th class="text-primary text-center"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-8" role="tabpanel"
                                                                aria-labelledby="custom-tabs-7-tab">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-md-8 col-lg-10">
                                                                            <h3 class="text-primary">
                                                                                <i class="pc-familia" style="font-size: 2rem;"></i>
                                                                                Añadir Hijo
                                                                            </h3>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="container-fluid">

                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="nombre">Nombres</label>
                                                                                            <input type="text" required
                                                                                                title="Tu primer y segundo nombre son requeridos" class="form-control"
                                                                                                name="nombres" id="nombres" aria-describedby="helpId"
                                                                                                placeholder="">
                                                                                            <small id="help_nombres" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="apellido">Apellidos</label>
                                                                                            <input type="text" title="Tu primer y segundo apellido son requeridos"
                                                                                                required class="form-control" name="apellidos" id="apellidos"
                                                                                                aria-describedby="helpId" placeholder="">
                                                                                            <small id="help_apellidos" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="genero">Género</label>
                                                                                            <select class="form-control required" name="genero" id="genero"
                                                                                                aria-describedby="helpId" placeholder="">
                                                                                                <option value="m">Masculino</option>
                                                                                                <option value="f">Femenino</option>
                                                                                            </select>
                                                                                            <small id="help_genero" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                                                                            <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                                                                                class="form-control" name="fnacimiento" id="fnacimiento"
                                                                                                aria-describedby="helpId" placeholder="">
                                                                                            <small id="help_fnacimiento" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <label class="text-primary" for="partidaNacimiento">Partida de nacimiento
                                                                                            (PDF)</label>
                                                                                        <div class="d-flex items-align-center">
                                                                                            <div class="fileImageInput">
                                                                                                <label class="heartbeat cursor-pointer" for="partidaNacimiento_familiar"
                                                                                                    style="display:flex; align-items:center;padding: 3%;border:2px dashed rgb(190, 189, 189); height:100px;width:5rem">
                                                                                                    <img onerror="this.src='/image/system/fnacimiento.svg';"
                                                                                                        id="partidaNacimiento_familiarPreview"
                                                                                                        style="height:100%;width: inherit;"
                                                                                                        src="/image/system/fnacimiento.svg" alt="User Avatar">
                                                                                                </label>
                                                                                                <input id="partidaNacimiento_familiar" type="file" style="display:none"
                                                                                                    accept="application/pdf">
                                                                                                <span class="filename"></span>
                                                                                            </div>
                                                                                            <div id="pn_preview_familiar">
                                                                                                <iframe src="#" frameborder="0" class="d-none" style="height:100px;overflow:auto;"></iframe>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="row justify-content-center">
                                                                                    <div class="col-8">
                                                                                        <button id="btnSubmit" class="btn btn-success mb-1 btn-block">Registrar hijo</button>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <button type="button" class="btn-familiar-list btn btn-block btn-primary"><i class="btn-familiar-list pc-familia"></i> Regresar</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                             <!-- datos del paciente -->
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-9" role="tabpanel"
                                                             aria-labelledby="custom-tabs-9-tab">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="text-center text-primary font-weight-bold h3">
                                                                                Mis datos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label class="text-primary" for="cedula">Foto</label>
                                                                            <div class="fileImageInput">
                                                                                <label class="heartbeat cursor-pointer" for="misdatos_userImagen"
                                                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                                                    <img onerror="this.src='/image/system/patient.svg'" id="misdatos_userImagenPreview" style="height:100%;width: inherit;"
                                                                                        src="/image/system/patient.svg" alt="User Avatar">
                                                                                </label>
                                                                                <input id="misdatos_userImagen" type="file" style="display:none"
                                                                                    accept="image/jpg, jpeg, bmp, png">
                                                                                <span class="filename"></span>
                                                                            </div>




                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="cedula">Documento de identidad <span
                                                                                        id="cedula_familiar_text" class="text-danger d-none">del
                                                                                        familiar</span></label>
                                                                                        <div id="no_edit_cedula"></div>
                                                                                <table class="w-100">
                                                                                    <tr>
                                                                                        <td style="width: auto;">
                                                                                            <select class="form-control"
                                                                                                title="Seleccione una nacionalidad" name="misdatos_nacionalidad"
                                                                                                id="misdatos_nacionalidad">
                                                                                                <option value="V">V</option>
                                                                                                <option value="E">E</option>
                                                                                                <option value="P">P</option>
                                                                                                <option value="J">J</option>
                                                                                            </select>
                                                                                            <small id="help_nacionalidad" class="notification"></small>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input required title="Un Documento de identidad es requerido"
                                                                                                type="number" maxlength="9" class="form-control"
                                                                                                name="misdatos_cedula" id="misdatos_cedula" aria-describedby="helpId"
                                                                                                placeholder="">
                                                                                            <small id="help_cedula" class="notification"></small>
                                                                                        </td>
                                                                                    </tr>

                                                                                </table>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="email">Correo Electrónico</label>
                                                                                <div id="no_edit_email"></div>
                                                                                <input type="text" required title="Un Correo Electrónico es requerido"
                                                                                    name="misdatos_email" id="misdatos_email" class="form-control"
                                                                                    aria-describedby="helpEmail">
                                                                                <small id="help_email" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="nombre">Nombres</label>
                                                                                <div id="no_edit_nombres"></div>
                                                                                <input type="text" required
                                                                                    title="Tu primer y segundo nombre son requeridos" class="form-control"
                                                                                    name="misdatos_nombres" id="misdatos_nombres" aria-describedby="helpId"
                                                                                    placeholder="">
                                                                                <small id="help_nombres" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="apellido">Apellidos</label>
                                                                                <div id="no_edit_apellidos"></div>
                                                                                <input type="text" title="Tu primer y segundo apellido son requeridos"
                                                                                    required class="form-control" name="misdatos_apellidos" id="misdatos_apellidos"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                <small id="help_apellidos" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="genero">Género</label>
                                                                                <div id="no_edit_genero"></div>
                                                                                <select class="form-control required" name="misdatos_genero" id="misdatos_genero"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                    <option value="m">Masculino</option>
                                                                                    <option value="f">Femenino</option>
                                                                                </select>
                                                                                <small id="help_genero" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                                                                <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                                                                    class="form-control" name="misdatos_fnacimiento" id="misdatos_fnacimiento"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                <small id="help_fnacimiento" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                                                                <input type="tel" required
                                                                                    title="Un teléfono de contacto es requerido"
                                                                                    onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                                                                    name="misdatos_telefono_movil" id="misdatos_telefono_movil" aria-describedby="helpId"
                                                                                    placeholder="">
                                                                                <small id="help_telefono_movil" class="notification">(preferiblemente
                                                                                    vinculado a
                                                                                    <i class="text-success">Whatsapp</i>)</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 d-none">
                                                                            <label class="text-primary" for="partidaNacimiento">Partida de nacimiento
                                                                                (PDF)</label>
                                                                            <div class="d-flex items-align-center">
                                                                                <div class="fileImageInput">
                                                                                    <label class="heartbeat cursor-pointer" for="misdatos_partidaNacimiento"
                                                                                        style="display:flex; align-items:center;padding: 3%;border:2px dashed rgb(190, 189, 189); height:100px;width:5rem">
                                                                                        <img onerror="this.src='/image/system/fnacimiento.svg';"
                                                                                            id="misdatos_partidaNacimientoPreview"
                                                                                            style="height:100%;width: inherit;"
                                                                                            src="/image/system/fnacimiento.svg" alt="User Avatar">
                                                                                    </label>
                                                                                    <input id="misdatos_partidaNacimiento" type="file" style="display:none"
                                                                                        accept="application/pdf">
                                                                                    <span class="filename"></span>
                                                                                </div>
                                                                                <div id="misdatos_pn_preview">
                                                                                    <iframe src="" frameborder="0" class="d-none" style="height:100px;overflow:auto;"></iframe>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-6">
                                                                            <div class="form-group box-cat_estado_id">
                                                                                <label class="text-primary" for="misdatos_cat_estado_id">Estado</label>
                                                                                <select required title="Un Estado es requerido"
                                                                                    class="form-control select2" name="misdatos_cat_estado_id" id="misdatos_cat_estado_id"
                                                                                    aria-describedby="helpId" placeholder=""></select>
                                                                                <small id="help_cat_estado_id" class="notification"></small>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group box-cat_municipio_id">
                                                                                <label class="text-primary" for="misdatos_cat_municipio_id">Municipio</label>
                                                                                <select required title="Un Municipio es requerido"
                                                                                    class="form-control select2" name="misdatos_cat_municipio_id"
                                                                                    id="misdatos_cat_municipio_id" aria-describedby="helpId"
                                                                                    placeholder=""></select>
                                                                                <small id="help_cat_municipio_id" class="notification"></small>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="misdatos_description">Ciudad</label>
                                                                                <input required title="Una Ciudad es requerida" type="text"
                                                                                    class="form-control" name="misdatos_description" id="misdatos_description"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                <small id="help_description" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="misdatos_domicilio">Domicilio</label>
                                                                                <input required title="Tu domicilio es requerido" class="form-control"
                                                                                    name="misdatos_domicilio" id="misdatos_domicilio">
                                                                                <small id="help_domicilio" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                                                            <div class="d-flex items-align-center">
                                                                                <div class="fileImageInput">
                                                                                    <label class="heartbeat cursor-pointer" for="misdatos_imgSoyChacao"
                                                                                        style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                                                        <img
                                                                                            onerror="this.src='/image/system/card.svg'"
                                                                                            id="misdatos_imgSoyChacaoPreview"
                                                                                            style="height:100%;width: inherit;"
                                                                                            src="/image/system/card.svg"
                                                                                            alt="User Avatar">
                                                                                    </label>
                                                                                    <input id="misdatos_imgSoyChacao" type="file" style="display:none"
                                                                                        accept="image/jpg, jpeg, bmp, png">
                                                                                    <span class="filename"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label class="text-primary" for="cedula">Foto de Documento de
                                                                                Identidad</label>
                                                                            <div class="d-flex items-align-center">
                                                                                <div class="fileImageInput">
                                                                                    <label class="heartbeat cursor-pointer" for="misdatos_imgDocIdentidad"
                                                                                        style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                                                        <img
                                                                                            onerror="this.src='/image/system/card.svg'"
                                                                                            id="misdatos_imgDocIdentidadPreview"
                                                                                            style="height:100%;width: inherit;"
                                                                                            src="/image/system/card.svg"
                                                                                            alt="User Avatar">
                                                                                    </label>
                                                                                    <input id="misdatos_imgDocIdentidad" type="file" style="display:none"
                                                                                        accept="image/jpg, jpeg, bmp, png">
                                                                                    <span class="filename"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="misdatos_tarjeta_soy_chacao">Código Tarjeta Soy
                                                                                    CMDLT <i class="text-gray">(Si tiene la tarjeta)</i></label>
                                                                                <input required
                                                                                    title="El código de la tarjeta está en la parte posterior de la misma."
                                                                                    class="form-control border-0 disabled" disabled readonly name="misdatos_tarjeta_soy_chacao">
                                                                                <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class=" offset-2 col-8">
                                                                            <button class="btn_submit_paciente_edit btn btn-success btn-block">Actualizar datos</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;border-radius: 30px;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document" style="height: auto;border-radius: 30px;">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal"
                            src="/image/system/logo-cmdlt-blanco.png">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>

                <div class="modal-body" style="background: #F1F3F4!important;">

                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/logo-cmdlt_mono.svg"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">

                    <div class="bg-light p-2">
                        <h3 class="exampleModal_title text-primary">Reprogramar Cita</h3>
                        <table>
                            <tr>
                                <th class="text-secondary">Paciente:</th>
                                <td class="exampleModal_paciente">Ramón Koens</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Médico:</th>
                                <td class="exampleModal_medico">Luis Eduardo Parodi</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Especialidad:</th>
                                <td class="exampleModal_especialidad">Urología Pediatrica</td>
                            </tr>
                        </table>

                    </div>
                    <form class="p-2" action="">
                    </form>
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
                            <img src="/image/system/logo-cmdlt_mono.svg"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                </div>
                <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fullscreen-modal fade" id="fullscreen" style="z-index: 100000;" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-between">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close" class="fas fa-times text-white "
                            style="font-size: 2em;margin-left:1%;cursor:pointer;" aria-hidden="true"></i>
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/logo-cmdlt_mono.svg"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                </div>
                <div class="modal-footer fullscreen justify-content-center">

                </div>
            </div>
        </div>
    </div>
    @include('templates.template')
    <!-- card-centro-salud -->
    <template id="artefacto_0065">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 style="font-weight: 300">
                                <b style="font-size: 0.9em !important;" class="text-primary card-title">Centro de Salud</b>
                            </h2>

                        </div>
                        <div class="col-3 text-center">
                            <i class="fas fa-map-marker-alt text-primary" style="font-size: 3em;"></i>
                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                    <b>Especialidades:</b>
                                    <ul class="card-list_items">
                                        <li>Especialidad 1</li>
                                        <li>Especialidad 2</li>
                                        <li>Especialidad 3</li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-map-marker-alt"></i></span>
                                    <b>Dirección:</b>
                                    <div class="card-text-1">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quod doloribus nisi
                                        reprehenderit! Eligendi rerum voluptatum cum assumenda illum libero
                                        perspiciatis, et accusamus nemo impedit voluptatibus eaque vel enim eveniet.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="text-right">
                        <a href="#" class="btn-location rounded-pill btn btn-sm btn-outline-primary">
                            <i class="fa fa-location"></i>
                            Ver en el mapa
                        </a>
                        <a href="#" class="d-none btn-nueva-cita rounded-pill btn btn-sm btn-primary">
                            <i class="btn-nueva-cita pc-cita_por_confirmar"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- medicos -->
    <template id="artefacto_0066">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 style="font-weight: 300">
                                <b style="font-size: 0.9em !important;" class="text-primary card-title">Médico Nombre Apellido</b>
                            </h2>
                        </div>
                        <div class="col-3 text-center">
                            <img onerror="reemplaza_imagen(this)" src="#" style="width:70px;height:70px;" alt="user-avatar"
                                class="card-image rounded-circle {{-- border-success --}} img-circle img-fluid">
                            <div class="card-turno d-none align-items-center">
                                <div>
                                    <i class="fas fa-circle ping text-success" style="font-size: 1em;"></i>
                                </div>
                                <div class="text-success" style="font-weight:600;font-size: 9.5px;">De turno</div>
                            </div>

                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span><i class="fas fa-stethoscope"></i></span>
                                    <b>Especialidad:</b>
                                    <ul class="card-list_items-3">
                                        <li>Especialidad 1</li>
                                        <li>Especialidad 2</li>
                                        <li>Especialidad 3</li>
                                    </ul>
                                </li>

                            </ul>
                            {{-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span><i class="fas fa-lg fa-clock"></i></span>
                                    <b>Días de consulta:</b>
                                    <ul class="card-list_items-1">
                                        <li>Lunes: <span class="float-right">00:00 AM A 00:00 PM</span></li>
                                        <li>Miercoles: <span class="float-right">00:00 AM A 00:00 PM</span></li>
                                        <li>Viernes: <span class="float-right">00:00 AM A 00:00 PM</span></li>

                                    </ul>
                                </li>

                            </ul> --}}
                        </div>
                        <div class="col-12">
                            {{-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span><i class="fas fa-lg fa-building"></i></span>
                                    <b>Centros de salud:</b>
                                    <ul class="card-list_items-2">
                                        <li>Centro Salud 1</li>
                                        <li>Centro Salud 2</li>
                                        <li>Centro Salud 3</li>
                                    </ul>
                                </li>

                            </ul> --}}
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="text-right">
                        <a href="#" class="d-none btn-nueva-cita rounded-pill card-agendar_cita btn btn-sm btn-primary">
                            <i class="btn-nueva-cita pc-cita_por_confirmar"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- especialidad -->
    <template id="artefacto_0067">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 style="font-weight: 300">
                                <b style="font-size: 0.9em !important;" class="text-primary card-title">Especialidad Title</b>
                            </h2>

                        </div>
                        <div class="col-3 text-center">
                            <img onerror="this.src='/image/system/especialidades/innovacion.svg'" src="#" alt="user-avatar"
                                class="card-image img-circle img-fluid">
                        </div>
                        <div class="col-12">
                            <p class="text-muted text-sm">
                                <b>Descripción: </b> <span class="card-descripcion">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit. Porro autem fuga exercitationem quam nisi dolore
                                    reiciendis minima atque, aspernatur vero sunt tempore, eligendi ducimus rem enim,
                                    doloremque dolorem veniam praesentium.</span>
                            </p>
                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                    <b>Centros de salud:</b>
                                    <ul class="card-list_items">
                                        <li>Centro Salud 1</li>
                                        <li>Centro Salud 2</li>
                                        <li>Centro Salud 3</li>

                                    </ul>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="text-right">
                        <a href="#" class="d-none btn-nueva-cita rounded-pill card-crear_cita btn btn-sm btn-primary">
                            <i class="btn-nueva-cita pc-cita_por_confirmar"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- card cita -->
    <template id="artefacto_0068">
        <div class="card-cita">
            <div class="card-row"><!-- 1 -->
                <div>
                    <h3>Nueva Cita</h3>
                    <h4 class="card-status">Por confirmar</h4>
                    <h6 class="card-created_at">Creada el 0 DIC, 0000 | 0:00:00 AM</h6>
                </div>
                <div class="info-box-icon text-center m-0 rounded-circle h4"
                    style="height: 50px;width: 50px;font-size: 1.7rem;line-height: 50px;">
                    <i class="text-white"></i>
                </div>
            </div>
            <div class="card-row"><!-- 3 -->
                <h6>Tu cita está agendada para el:</h6>
                <div>
                    <article>
                    <div>Dia</div>
                    <b class="card-cita-dia">00</b>
                    </article>
                    <article>
                    <div>Mes</div>
                    <b class="card-cita-mes">Septiembre</b>
                    </article>
                    <article>
                    <div>Año</div>
                    <b class="card-cita-anio">0000</b>
                    </article>
                    <article>
                    <div>Hora</div>
                    <b class="card-cita-hora">00:00 AM</b>
                    </article>
                </div>
            </div>
            <div class="card-row"><!-- 2 -->
                <article>
                    <h6>Especialidad</h6>
                    <div>
                    <img class="card-especialidad-imagen rounded-circle" onerror="this.src='/image/system/especialidades/innovacion.svg'" src="/image/system/especialidades/medicina_general.svg" style="width:30px;height:30px;" alt="">
                    <span class="card-especialidad">No indicado</span>
                    </div>

                </article>
                <article>
                    <h6>Médico</h6>
                    <div>
                    <img class="card-especialista-imagen rounded-circle" onerror="this.src='/image/system/especialidades/innovacion.svg'" src="/image/system/especialidades/medicina_general.svg" style="width:30px;height:30px;" alt="">
                    <span class="card-medico-nombre">No indicado</span>
                    </div>
                </article>
            </div>
            <div class="card-row"><!-- 4 -->
                <h6>Centro de Salud</h6>
                <p class="card-cita-centro-salud">
                    No indicado
                </p>
            </div>
            <div class="card-row"><!-- 5 -->
                <h6>Motivo de consulta</h6>
                <p class="card-cita-reason_for_consultation">
                    No indicado
                </p>
            </div>
            <div class="card-row box-coment-cancelation d-none"><!-- 6 -->
                <h6>Motivo de cancelación</h6>
                <p class="card-cita-coment-cancelation">
                    No indicado
                </p>
            </div>
            <div class="card-row reprogramacion bg-warning p-2 d-none text-center" style="border-radius: 1rem;">
                <h4>Esta cita ha sido reprogramada</h4>
                <b>Motivo:</b>
                <p class="motivo_reprogramacion bg-white" style="border-radius: 1rem;">

                </p>
                <p>
                    ¿Quiere confirmar o rechazar la reprogramación?
                </p>
                <div class="d-flex">
                    <button class="btn_confirmar_reprogramar btn mr-1 mb-1 btn-sm btn-outline-success w-100">Confirmar</button>
                    <button class="btn_rechazar_reprogramar btn ml-1 mb-1 btn-sm btn-outline-danger w-100">Rechazar</button>
                </div>
            </div>
            <div class="card-row">
                <button class="btn_informe_general btn btn-sm btn-outline-info w-100 d-none">Informe de Medicina General</button>
            </div>
            <div class="card-row"> <!-- 8 -->
              <button class="card-cita_cancelar btn btn-sm btn-outline-danger w-100">Cancelar cita</button>
            </div>
        </div>

    </template>
    <!--  -->
    <template id="artefacto_0069">
        <!-- medicina_general -->
        <div class="col-md-12 mb-3">
            <div class="d-flex my-2 align-items-center">
                <div>
                    <div class="form-number-input-medicina_general bg-primary rounded-circle"
                        style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                        1
                    </div>
                </div>
                <div>
                    <label class="h5 m-0 text-primary"
                        for="validationServer01">
                        ¿Fue visto previamente por un médico
                        general?
                    </label>
                </div>
            </div>
            <select name="medicina_general"
                class="custom-select "
                id="validationServer01"
                aria-describedby="validationServer01Feedback"
                required>
                <option value="">Seleccione</option>
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
            <div id="validationServer01Feedback" class="invalid-feedback medicina_general">
                Por favor selecciona una respuesta
                válida.
            </div>
        </div>
        <div id="carga_archivo_mensaje"  class="alert" style="color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;" role="alert">
            En caso de no tener una consulta previa con
            <b>Medicina General</b>, lo invitamos a
            asistir o a solicitar una orientación
            diagnóstica en el centro de salud de su
            preferencia.
        </div>
        <!-- carga de archivos -->
        <div id="carga_archivo" style="color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;" class="pb-2 d-none rounded col-md-12 mb-3">
            <div
                class="d-flex my-2 align-items-center">
                <div>
                    <label class="h5 m-0 "
                        for="validationServer02">
                        Cargue, una referencia
                        médica, antes de solicitar una
                        cita con un especialista.
                    </label>
                </div>
            </div>

            <input type="file" style="padding: 0.2rem;"
                    name="informe_medico"
                    class="form-control"
                    id="informe_medico">

        </div>
        <div id="validationServer02Feedback"
            class="invalid-feedback">
            Por favor selecciona una especialidad.
        </div>
        <button type="button" class="btn-continuar-cita btn btn-success btn-block" >Continuar</button>
    </template>

    <!-- tipo cita -->
    <template id="artefacto_0070">
        <!-- medicina_general -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-primary text-center">Seleccione el tipo de atención</h3>
                    <div class="list-group mb-3">
                        <button type="button" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-medica-create" data-option="btn-cita-medica-create"><i class="pc-medico text-primary mr-1" style="font-size: 2rem;"></i> Consulta Médica</button>
                        <button type="button" class="list-group-item list-group-item-action d-none align-items-center btn-cita-veterinaria-create" data-option="btn-cita-veterinaria-create"><i class="pc-veterinario text-primary mr-1" style="font-size: 2rem;"></i> Consulta Veterinaria</button>
                        <button type="button" class="list-group-item list-group-item-action d-none align-items-center btn-cita-laboratorio" data-option="btn-cita-laboratorio"><i class="pc-laboratorio text-primary mr-1" style="font-size: 2rem;"></i> Solicitud de Laboratorio</button>
                        <button type="button" class="list-group-item list-group-item-action d-none align-items-center btn-cita-rayosx" data-option="btn-cita-rayosx"><i class="pc-rayosx text-primary mr-1" style="font-size: 2rem;"></i> Solicitud de Imagen RX</button>
                        {{-- <button type="button" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-ecosonografia" data-option="btn-cita-ecosonografia"><i class="pc-ecosonografia text-primary mr-1" style="font-size: 2rem;"></i> Ecosonografía</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn-cancelar-cita btn btn-primary btn-block" data-dismiss="modal" >Cancelar</button>
    </template>
    <!-- select mascota -->
    <template id="artefacto_0071">
        <!-- medicina_general -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-primary text-center">Selecciona tu mascota</h3>
                    <div class="list-group mb-3">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn-continuar-cita-veterinaria btn btn-success btn-block">Continuar</button>
    </template>
    <!-- mensaje referencia de medico general -->
    <template id="artefacto_0072">

            <!-- medicina_general -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-white font-weight-bold text-center">Atención</h2>
                        {{-- <p class="text-center h3">Estimado vecino.
                            A excepción de las especialidades:
                            <i>Ginecología, Obstetricia, Odontología, y Pediatría</i>, es un
                            <b style='font-size:2.4rem;'>requisito obligatorio</b>
                            llevar a tu cita una
                            <b style='font-size:2.4rem;'>referencia médica</b> emitida <b>solo</b> por CMDLT
                            para ser atendido por un especialista,
                            <b>de lo contrario, tu cita será cancelada.</b>
                        </p> --}}
                        <div class="bg-white text-center my-2 rounded p-2 pb-3" style=" font-size:2.2rem; font-weight:600; line-height: 1.2;  border-radius: 1rem !important;">
                            <h1 class=" text-primary">¡Recuerda!</h1>
                            Es importante,<br>
                            para el día de tu cita,<br>
                            llegar con<br>
                            15 minutos de anticipación.

                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn-confirmar-mensaje-cita btn btn-outline-white btn-block">Entendido</button>

    </template>
    <template id="artefacto_0073">

            <!-- medicina_general -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-white font-weight-bold text-center">Atención</h2>
                        <p class="text-center h3">
                            Estimado usuario:<br>
                            para solicitar nuevas citas
                            en el sistema,
                            <b>requerimos que su perfil
                            esté asociado a una tarjeta
                            Soy CMDLT válida</b>.
                            Por favor,
                            dirijase al Centro médico Docente La Trinidad,
                            para actualizar sus datos.
                        </p>
                    </div>
                </div>
            </div>

            <button type="button" data-dismiss="modal" class="btn btn-outline-white btn-block">Entendido</button>

    </template>
    <template id="googleMaps">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4665.396139548923!2d-66.87099621879842!3d10.491608563768908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59556f32f44b%3A0xb0055fedcc8ad196!2sAmbulatorio%20El%20Bosque%20Salud%20Chacao!5e0!3m2!1ses!2sve!4v1647053939766!5m2!1ses!2sve"
            width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
    </template>
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
    <script src="/js/tippy-bundle.umd.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script>
        let user_id_paciente = "{{ Auth::id() }}"
        let user_cedula = "{{ session('userData')['cedula'] }}"
        let user_genero = "{{ session('userData')['genero'] }}"
        let d = document
        let paciente = ""
        let onChange_agenda_id
        let final_hora;
        let final_dia;
        let cantidad_actual_citas = 0;
        let cantidad_actual_historial = 0;

        let useState = {
            "paciente": {
                "user_id": Number("{{ Auth::id() }}"),
                "genero" : "{{ session('userData')['genero'] }}",
                "cedula" : "{{ session('userData')['cedula'] }}",
                "imagen" : "{{ session('userData')['imagen'] }}",
                "nombre" : "{{ session('userData')['nombre'] }}",
                "apellido" : "{{ session('userData')['apellido'] }}",
                "tarjeta_soy_chacao" : "{{ session('userData')['tarjeta_soy_chacao'] }}",
            },
            "especialidad_id_con_agenda": null,
            "paciente_edit"       : null,
            "estado"       : null,
            "municipio"    : null,
            "agendas"      : null,
            "centros_salud": null,
            "citas"        : {
                "activas"  : null,
                "historial": null,
            },
            "especialidades": null,
            "episodios"     : null,
            "informe"       : null,
            "archivo"       : null,
            "antecedente"   : null,
            "medicos"       : null,
            "familiares"       : null,
            "cat_user_family"       : null,
            "formNuevaCita" : {
                "user_id_paciente" : null,
                "cita_soy_ciudadano" : "No",
                "cat_especialidad_id": "",
                "centro_salud_id"    : "",
                "user_id_medico"     : "",
                "cita_dia"           : "",
                "cita_hora"          : "",
                "cita_motivo"        : "",
                "file"               : "",
            },
            "user_mascota"     : null,
            "formMascotaCreate": {
                "user_id"   : Number(user_id_paciente),
                "nombre"    : null,
                "tipo"      : null,
                "sexo"      : null,
                "raza"      : null,
                "peso"      : null,
                "comentario": null,

            },
            "formCreatePaciente":{
                "tipo_registro"     : "personal",
                "cedula_personal"   : "",
                "cat_user_family_id": "",
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
                "cat_municipio_id"  : "182",
                "description"       : "Caracas",    //ciudad
                "domicilio"         : "",
                "tarjeta_soy_chacao": "",
                "fecha_ingreso"     : "",
                "cat_genero"        : [
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
            "formEditPaciente":{
                "userImagen"            : null,
                "nacionalidad"      : "V",
                "cedula"            : "",
                "email"             : "",
                "nombres"           : "",
                "apellidos"         : "",
                "genero"            : "m",
                "fnacimiento"       : "",
                "telefono_movil"    : "",
                "partidaNacimiento" : null,
                "cat_estado_id"     : "14",
                "cat_municipio_id"  : "182",
                "description"       : "Caracas",    //ciudad
                "domicilio"         : "",
                "imgSoyChacao"      : null,
                "imgDocIdentidad"   : null,
                "tarjeta_soy_chacao": "",
                "fecha_ingreso"     : "",
            },
            "cat_estado":null,
            "cat_municipio":null,
            "formAgendaCreate": null,
        }
        let f = new Date();
            useState['formAgendaCreate'] = {
                "dias_excluidos": [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado"
                ],
                "meses_excluidos" : [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "semanas_excluidas" :{
                    "Enero": [1,2,3,4,5,6],
                    "Febrero": [1,2,3,4,5,6],
                    "Marzo":  [1,2,3,4,5,6],
                    "Abril": [1,2,3,4,5,6],
                    "Mayo":  [1,2,3,4,5,6],
                    "Junio":  [1,2,3,4,5,6],
                    "Julio":  [1,2,3,4,5,6],
                    "Agosto":  [1,2,3,4,5,6],
                    "Septiembre":  [1,2,3,4,5,6],
                    "Octubre":  [1,2,3,4,5,6],
                    "Noviembre":  [1,2,3,4,5,6],
                    "Diciembre":  [1,2,3,4,5,6],
                },
                "agenda_year": f.getFullYear(),
                "agenda_month": [],
                "cupos_por_dia": 1,
                "centro_salud_id": null,
                "user_id_medico": null,
                "cat_especialidad_id": null,
                "agenda_registradas":[],
                "resultset": [],
                "agenda_horas":{
                    "1":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "2":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "3":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "4":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "5":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "6":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "0":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                },
                "agenda":null
            }
        let paciente_edit = async ()=>{

            $('[data-widget="pushmenu"]').PushMenu('collapse')
            let $form = <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMDLT | Citas</title>


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
        .btn-outline-white {
            color: rgb(255, 255, 255);
            border-color: rgb(255, 255, 255);
        }
        .btn-outline-white:hover {
            color: var(--primary);
            background-color: rgb(255, 255, 255);
            border-color: rgb(255, 255, 255);
        }
    </style>
    <style>

        .navbar-main-shadow {
            -webkit-box-shadow: 0px 10px 13px -7px #000000, 38px 17px 19px 23px rgb(241 243 244 / 0%);
            box-shadow: 0px 10px 13px -7px #343a40, 38px 17px 19px 23px #f1f3f400;
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

        #navbarMain .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--primary);
            background-color: var(--white);
        }

        .btn-hover-1:hover,
        .btn-hover-1:active,
        .btn-hover-1.hover {
            background-color: #e9ecef;
            color: #2b2b2b;
            cursor: pointer;
        }

        .container-card-citas{
        display: grid;
        grid-template-columns: repeat(1,1fr);
        gap:0.5rem;
        padding: 1rem;
        border-radius: 1rem;
        }
        .card-cita{
            border: 1px solid #f2f2f2;
            padding:0.5rem;
            display: grid;
            grid-template-columns: 1fr;
            /* row-gap: 0.5rem; */
            border-radius: 1rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            grid-template-rows: auto auto auto auto 1fr auto auto auto auto;
        }
        .card-cita:hover{
        background-color: #D9D9D9;
        }
        .card-row:nth-child(1){
        display: grid;
        grid-template-columns: 1fr 50px;

        }
        .card-row:nth-child(1) h3,
        .card-row:nth-child(2) h6,
        .card-row:nth-child(3) h6,
        .card-row:nth-child(4) h6,
        .card-row:nth-child(5) h6{
        color: #00B0F0;
        }
        .card-row:nth-child(6) h6{
        color: #C00000;
        }
        .card-row:nth-child(1) h6{
        color: #b3b3b3;
        }
        .card-row:nth-child(1) h3,
        .card-row:nth-child(1) h4,
        .card-row:nth-child(1) h6 {
            margin-bottom: 0;
            font-weight: 500;
            line-height: 1.2;
        }
        .card-row:nth-child(1) h6 {
        font-size: 0.7rem;
        }
        .card-row:nth-child(1) {
        margin-bottom: 0.5rem;
        }
        .card-row:nth-child(3) article:nth-child(1){
        background-color: #dff3ff;
        }
        .card-row:nth-child(3) article:nth-child(2){
        background-color: #fff0c1;
        }
        .card-row:nth-child(3) article:nth-child(1),
        .card-row:nth-child(3) article:nth-child(2){
        display: grid;
        padding: 0.5rem;

        grid-template-rows: 35px auto;
        border-radius: 1rem;
        }
        .card-row:nth-child(3) article div{
        display: grid;
        grid-template-columns: 40px 1fr;
        }
        .card-row:nth-child(3){
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        align-items: stretch;
        margin-bottom: 0.5rem;
        }
        .card-row:nth-child(2) div:nth-child(2) {
        display:grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        text-align: center;
        white-space: nowrap;
        font-size: 0.8rem;
        padding-bottom: 0.4rem;
        }

        .card-row:nth-child(2) h6,
        .card-row:nth-child(3) h6,
        .card-row:nth-child(4) h6,
        .card-row:nth-child(5) h6,
        .card-row:nth-child(6) h6{
        text-align:center;
        font-weight: 600;
        border-bottom: 1px solid #e9e9e9;
        padding: 2px;
        }


        .card-row:nth-child(4) p,
        .card-row:nth-child(5) p,
        .card-row:nth-child(6) p{
        text-align:center;
        padding: 0.5rem;
        font-size: 1rem;
        }

        .card-row:nth-child(4),
        .card-row:nth-child(5),
        .card-row:nth-child(6){
        display:grid;
        grid-template-rows: auto 1fr;
        background-color: #F2F2F2;
        border-radius: 1rem;
        margin-bottom: 0.5rem;
        }
        .card-row:nth-child(2){
        display:grid;
        grid-template-rows: auto 1fr;
        background-color: #ebe7e7;
        border-radius: 1rem;
        margin-bottom: 0.5rem;
        }

        .card-row:nth-child(2) div:nth-child(2),
        .card-row:nth-child(4) p,
        .card-row:nth-child(5) p,
        .card-row:nth-child(6) p{
            color:rgb(75, 75, 75);
        }
        .card-row:nth-child(7){
            margin-bottom: 0.5rem;
        }
        .card-row:nth-child(8),
        .card-row:nth-child(9){
            display: grid;
            align-self: end;
        }

        @media (min-width: 576px) {
        .container-card-citas {
            grid-template-columns: repeat(2,1fr);
        }
        }

        @media (min-width: 768px) {
        .container-card-citas {
            grid-template-columns: repeat(3,1fr);
        }
        }



    </style>
    <script>
        function reemplaza_imagen(imagen) {
            imagen.onerror = "";
            imagen.src = "/image/system/icono-paciente-blanco.svg";
            return true;
        }
    </script>
</head>

<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed  sidebar-collapse">
    <div class="overlay-wrapper">
        <div id="cargando" class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
            <div class="text-bold pt-2 text-primary">Espere un momento por favor...</div>
        </div>
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center bg-primary align-items-center">
                <img class="scale-in-ver-center" src="/image/system/logo-cmdlt_mono.svg"
                    alt="AdminLTELogo" height="200" width="200">
            </div>


            <nav id="navbarMain"
                class="navbar shadow navbar-expand m-0 mt-1 rounded-pill mx-1 p-0 pr-2 fixed-top navbar-primary navbar-dark">
                <div class="container-fluid">



                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                        <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item dropdown show">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle">Dropdown</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow " style="left: 0px; right: inherit;">
                            <li><a href="#" class="dropdown-item">Some action </a></li>
                            <li><a href="#" class="dropdown-item">Some other action</a></li>

                            <li class="dropdown-divider"></li>

                            <!-- Level two dropdown-->
                            <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow " style="">
                                <li>
                                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                </li>

                                <!-- Level three dropdown-->
                                <li class="dropdown-submenu">
                                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow ">
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                </ul>
                                </li>
                                <!-- End Level three -->

                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                            </li>
                            <!-- End Level two -->
                        </ul>
                        </li> --}}
                        </ul>

                        <!-- SEARCH FORM -->

                    </div>

                    <!-- Right navbar links -->
                    <ul class="align-items-center order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <!-- Messages Dropdown Menu -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-comments"></i>
                                <span class="badge badge-danger navbar-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                style="left: inherit; right: 0px;">
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Brad Diesel
                                                <span class="float-right text-sm text-danger"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">Call me whenever you can...</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                John Pierce
                                                <span class="float-right text-sm text-muted"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">I got your message bro</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                            </div>
                        </li> --}}
                        <!-- Notifications Dropdown Menu -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="far fa-bell"></i>
                                <span class="badge badge-warning navbar-badge">15</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                style="left: inherit; right: 0px;">
                                <span class="dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                                role="button">
                                <i class="fas fa-search"></i>
                            </a>
                        </li> --}}
                        <li class="nav-item m-0 p-0">
                            <a class="navbar-brand m-0 p-0" href="#">
                                <img src="/image/system/logo-cmdlt_mono.svg"
                                    style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
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
                </ul> --}}
            </nav>


            <!-- Main Sidebar Container -->
            <aside class="main-sidebar mt-6 sidebar-light-primary elevation-4">
                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="user-panel  btn-hover-1 sidebar-paciente-edit my-3 py-3 d-flex">
                        <div class="image sidebar-paciente-edit">
                            <img onerror="reemplaza_imagen(this)"

                                class="user_card_imagen sidebar-paciente-edit img-circle elevation-2" alt="User Image"
                                style="height: 2.1rem;width: 2.1rem;">
                        </div>
                        <div class="info sidebar-paciente-edit">
                            <a href="#" class="user_card_username d-block text-primary sidebar-paciente-edit">No disponible</a>
                            <div class="sidebar-paciente-edit text-info">Editar mi datos</div>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link btn-mascota">
                                <i class="nav-icon pc-veterinario btn-mascota text-info" style="font-size: 2rem;"></i>
                                <p class="btn-mascota">
                                    Información Veterinaria
                                <i class="right fas fa-angle-left" style="top: 1.2rem;"></i>
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-familiar-list">
                                <i class="nav-icon pc-familia btn-familiar-list text-info" style="font-size: 2rem;"></i>
                                <p class="btn-familiar-list">
                                    Grupo Familiar
                                {{--  <i class="right fas fa-angle-left" style="top: 1.2rem;"></i> --}}
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
            <div class="content-wrapper pt-3">
                <section class="content mt-6 mt-lg-6 mt-sm-6">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div id="profile_paciente" class="card card-primary " style="border-radius: 1.25rem;">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img onerror="reemplaza_imagen(this)" class="cursor-pointer sidebar-paciente-edit user_card_imagen imagen-perfil profile-user-img img-fluid img-circle"
                                                src="/image/system/icono-paciente-blanco.svg"
                                                style="width: 90px;height: 90px;object-fit: cover;"
                                                alt="User profile picture">
                                        </div>

                                        <h3 class="cursor-pointer sidebar-paciente-edit user_card_username text-center">{{-- Sample Name --}}</h3>

                                        <p class="cursor-pointer sidebar-paciente-edit user_card_cedula text-muted text-center">{{-- 00.000.000 --}}</p>
                                        {{-- @if (session('userData')['tarjeta_soy_chacao'] !== NULL) --}}
                                        @if (true)
                                            <a class="btn  rounded-pill btn-success btn-block text-white btn-lg btn-nueva-cita"
                                                data-cat_especialidad_id=""
                                                data-centro_salud_id=""
                                                data-user_id_medico=""
                                                data-hora=""
                                                data-cita_motivo=""
                                            >
                                                <b
                                                data-cat_especialidad_id=""
                                                data-centro_salud_id=""
                                                data-user_id_medico=""
                                                data-hora=""
                                                data-cita_motivo=""

                                                class="btn-nueva-cita">Nueva Cita</b>
                                            </a>
                                        @else
                                            <a class="btn btn-tarjeta-schacao-no-encontrada  rounded-pill btn-gray btn-block text-secondary btn-lg"
                                            >
                                                <b>Nueva Cita</b>
                                            </a>
                                        @endif

                                        <ul class="d-none d-sm-block list-group list-group-unbordered mb-3">
                                            {{-- <li class="list-group-item">
                                                <b>Récipes</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Estudios Diagnósticos</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Informes</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Citas completadas</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Récipes</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Solicitud de Estudio Diagnóstico</b> <a class="float-right">0</a>
                                            </li>
                                            <li class="list-group-item bg-transparent">
                                                <b>Archivos</b> <a class="float-right">0</a> --}}
                                            </li>
                                        </ul>


                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-tabs">
                                                <div class="card-header p-0">
                                                    <ul class="nav justify-content-around nav-tabs"
                                                        id="navegacion_consulta_externa" role="tablist">
                                                        <li style="background-color: #e3ecf1"
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3 border-right">
                                                            <a class="active" id="custom-tabs-1-tab" data-toggle="pill"
                                                                href="#custom-tabs-1" role="tab"
                                                                aria-controls="custom-tabs-1" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-success h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class="pc-cita_por_confirmar text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Mis
                                                                            Citas</span>

                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3 border-right">
                                                            <a id="custom-tabs-2-tab" data-toggle="pill"
                                                                href="#custom-tabs-2" role="tab"
                                                                aria-controls="custom-tabs-2" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-warning h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class="pc-solid_estetoscopio text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Especialidades</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3 border-right">
                                                            <a id="custom-tabs-3-tab" data-toggle="pill"
                                                                href="#custom-tabs-3" role="tab"
                                                                aria-controls="custom-tabs-3" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-primary h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class=" pc-medico text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Médicos</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li>
                                                       {{--  <li
                                                            class="nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-4-tab" data-toggle="pill"
                                                                href="#custom-tabs-4" role="tab"
                                                                aria-controls="custom-tabs-4" aria-selected="true">
                                                                <div
                                                                    class="info-box align-items-center shadow-none m-0 cursor-pointer heartbeat justify-content-center bg-transparent">
                                                                    <span
                                                                        class="info-box-icon m-0 rounded-circle bg-info h4"
                                                                        style="height: 40px;width: 40px;">
                                                                        <i class="fas fa-map-marker-alt text-white"></i>
                                                                    </span>
                                                                    <div class="info-box-content p-0 pl-sm-2">
                                                                        <span
                                                                            class="d-none d-sm-block info-box-text m-0 text-primary h4 font-weight-bold">Centros
                                                                            de Salud</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                            </a>
                                                        </li> --}}
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-5-tab" data-toggle="pill"
                                                                href="#custom-tabs-5" role="tab"
                                                                aria-controls="custom-tabs-5" aria-selected="true">
                                                                Nueva Cita
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-6-tab" data-toggle="pill"
                                                                href="#custom-tabs-6" role="tab"
                                                                aria-controls="custom-tabs-6" aria-selected="true">
                                                                Información Veterinaria
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-7-tab" data-toggle="pill"
                                                                href="#custom-tabs-7" role="tab"
                                                                aria-controls="custom-tabs-7" aria-selected="true">
                                                                Familiares
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-8-tab" data-toggle="pill"
                                                                href="#custom-tabs-8" role="tab"
                                                                aria-controls="custom-tabs-8" aria-selected="true">
                                                                Familiar create
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="d-none nav-item nav-item col-3 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                            <a id="custom-tabs-9-tab" data-toggle="pill"
                                                                href="#custom-tabs-9" role="tab"
                                                                aria-controls="custom-tabs-9" aria-selected="true">
                                                                Datos del Paciente
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-body">

                                                        <div class="tab-content" id="custom-tabs-five-tabContent">
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade active show" id="custom-tabs-1"
                                                                role="tabpanel" aria-labelledby="custom-tabs-1-tab">
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 text-primary active" id="cita-activas-tab" data-toggle="tab" href="#cita-activas" role="tab" aria-controls="cita-activas" aria-selected="true"><i class="pc-solid_estetoscopio h4 text-primary"></i> Citas Activas <span id="contador_activas" class="badge badge-info d-none">0</span></a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 text-primary" id="cita-completada-tab" data-toggle="tab" href="#cita-completada" role="tab" aria-controls="cita-completada" aria-selected="false"><i class="pc-solid-history-episode h4 text-primary"></i> Historial de citas <span id="contador_historial" class="badge badge-info d-none">0</span></a>
                                                                    </li>

                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="cita-activas" role="tabpanel" aria-labelledby="cita-activas-tab">
                                                                        <div class="container-fluid">
                                                                            <div id="container_citas_activas" class="container-card-citas">
                                                                                <div class="row">
                                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                                        <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                            <div
                                                                                                class="card-body text-center text-primary">
                                                                                                No posees citas activas.
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="cita-completada" role="tabpanel" aria-labelledby="cita-completada-tab">
                                                                        <div class="container-fluid">


                                                                            <div id="container_citas_completadas" class="container-card-citas">


                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-2" role="tabpanel"
                                                                aria-labelledby="custom-tabs-2-tab">

                                                                <div class="container-fluid">


                                                                    <div id="container_especialidades" class="row">
                                                                        <div
                                                                            class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                <div
                                                                                    class="card-body text-center text-primary">
                                                                                    No se encontraron especialidades
                                                                                    disponibles.
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-3" role="tabpanel"
                                                                aria-labelledby="custom-tabs-3-tab">


                                                                <div class="container-fluid">

                                                                    <div id="container_medicos" class="row">
                                                                        <div
                                                                            class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                <div
                                                                                    class="card-body text-center text-primary">
                                                                                    No se encontraron médicos disponibles.
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-4" role="tabpanel"
                                                                aria-labelledby="custom-tabs-4-tab">


                                                                <div class="container-fluid">

                                                                    <div id="container_centro_de_salud" class="row">
                                                                        <div
                                                                            class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex align-items-stretch flex-column">
                                                                            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                                                                                <div
                                                                                    class="card-body text-center text-primary">
                                                                                    No se encontraron Centros de Salud
                                                                                    disponibles.
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-5" role="tabpanel"
                                                                aria-labelledby="custom-tabs-5-tab">
                                                                <div class="container">
                                                                    <form>
                                                                        <div class="form-row">
                                                                            <!-- especialidad -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            1</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label id="textEspecialidad" class="h5 m-0 text-primary" for="validationServer03">Selecciona la especialidad</label>
                                                                                            <small
                                                                                                title="Especialidades disponibles."
                                                                                                class="d-none notification cat_especialidad_id badge badge-info font-weight-normal"></small>
                                                                                    </div>
                                                                                </div>
                                                                                <select name="cat_especialidad_id"
                                                                                    class="custom-select "
                                                                                    id="validationServer03"
                                                                                    aria-describedby="validationServer02Feedback"
                                                                                    required>
                                                                                </select>
                                                                                <div id="validationServer03Feedback"
                                                                                    class="invalid-feedback cat_especialidad_id">
                                                                                    Por favor selecciona una especialidad.
                                                                                </div>
                                                                            </div>
                                                                            <!-- centro de salud -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="form-number-input-centro_salud_id bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            2</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="h5 m-0 text-primary"
                                                                                            for="validationServer03">Selecciona el Centro de Salud</label>
                                                                                            <small
                                                                                            title="Centros de Salud en donde se atiende esta centro-salud"
                                                                                                class="d-none notification centro_salud_id badge badge-info font-weight-normal"></small>
                                                                                    </div>
                                                                                </div>

                                                                                <select name="centro_salud_id"
                                                                                    class="custom-select "
                                                                                    id="validationServer04"
                                                                                    aria-describedby="validationServer04Feedback"
                                                                                    required>
                                                                                </select>
                                                                                <div id="validationServer04Feedback"
                                                                                    class="invalid-feedback centro_salud_id">
                                                                                    Por favor selecciona un Centro de Salud.
                                                                                </div>
                                                                            </div>
                                                                            <!-- user_id_medico -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="form-number-input-user_id_medico bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            3</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="h5 m-0 text-primary"
                                                                                            for="validationServer03">Selecciona el médico de tu preferencia</label>
                                                                                            <small
                                                                                            title="Médicos que atienden esta especialidad"
                                                                                                class="d-none notification user_id_medico badge badge-info font-weight-normal"></small>
                                                                                    </div>
                                                                                </div>

                                                                                <select name="user_id_medico"
                                                                                    class="custom-select "
                                                                                    id="validationServer05"
                                                                                    aria-describedby="validationServer05Feedback"
                                                                                    required>
                                                                                </select>
                                                                                <div id="validationServer05Feedback"
                                                                                    class="invalid-feedback user_id_medico">
                                                                                    Por favor selecciona un médico.
                                                                                </div>
                                                                            </div>
                                                                            <!-- calendario -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="cita_dia form-number-input-cita_dia bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            4</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="cita_dia h5 m-0 text-primary"
                                                                                            for="validationServer05">
                                                                                            Indica el día de tu conveniencia
                                                                                            <small
                                                                                                title="Dias en que se atiende este médico."
                                                                                                class="d-none notification cita_dia badge badge-info font-weight-normal"><b>0</b></small>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="mensaje_dia_seleccionado" class="text-center text-secondary" style="font-size:20px">
                                                                                    Solo los días resaltados en gris están disponibles.
                                                                                </div>

                                                                                <input required id="cita_dia" name="cita_dia" type="hidden">
                                                                                <div id="calendar" class="daterange" style="width: 100%"></div>

                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_dia">
                                                                                    Por favor selecciona un día válido.
                                                                                </div>
                                                                            </div>
                                                                            <!-- hora -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="cita_hora form-number-input-cita_hora bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            5</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="cita_hora h5 m-0 text-primary"
                                                                                            for="validationServer05">
                                                                                            Escoje una hora
                                                                                            <small
                                                                                                title="Médicos que atienden esta especialidad"
                                                                                                class="d-none notification user_id_medico badge badge-info font-weight-normal"><b>0</b></small>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <input required id="cita_hora" name="cita_hora" type="hidden">
                                                                                <ul class="d-none nav justify-content-center  nav-tabs mb-3" id="horarios" role="tablist">
                                                                                    <li class="nav-item flex-fill text-center" role="presentation">
                                                                                        <a class="nav-link active" id="pills-am-tab" data-cita-horario="am" data-toggle="pill"
                                                                                            href="#pills-am" role="tab" aria-controls="pills-am" aria-selected="true">Mañana</a>
                                                                                    </li>
                                                                                    <li class="nav-item flex-fill text-center" role="presentation">
                                                                                        <a class="nav-link" id="pills-pm-tab" data-cita-horario="pm" data-toggle="pill"
                                                                                            href="#pills-pm" role="tab" aria-controls="pills-pm" aria-selected="false">Tarde</a>
                                                                                    </li>
                                                                                </ul>
                                                                                <div class="tab-content" id="pills-tabContentHoras">
                                                                                    <div class="tab-pane fade show active" id="pills-am" role="tabpanel"
                                                                                        aria-labelledby="pills-tabContentHoras">
                                                                                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                                                                                            <div class="flex-fill text-center text-secondary" style="font-size:15px">
                                                                                                Sin Horas disponibles
                                                                                            </div>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="pills-pm" role="tabpanel"
                                                                                        aria-labelledby="pills-tabContentHoras">
                                                                                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">


                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_hora">
                                                                                    Por favor selecciona una respuesta
                                                                                    válida.
                                                                                </div>
                                                                            </div>
                                                                            <!-- motivo consulta -->
                                                                            <div class="col-md-8 offset-md-2 mb-3">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">
                                                                                    <div>
                                                                                        <div class="cita_motivo form-number-input-cita_motivo bg-primary rounded-circle"
                                                                                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                                                                                            6</div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <!-- is-invalid -->
                                                                                        <label class="cita_motivo h5 m-0 text-primary"
                                                                                            for="validationServer05">
                                                                                            Motivo de consulta
                                                                                            <small
                                                                                                title="Médicos que atienden esta especialidad"
                                                                                                class="d-none notification cita_motivo badge badge-info font-weight-normal"><b>0</b></small>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <textarea class="form-control" placeholder="Escribe el motivo" name="cita_motivo" id="cita_motivo" rows="3"></textarea>
                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_motivo">
                                                                                    Por favor selecciona una respuesta
                                                                                    válida.
                                                                                </div>
                                                                            </div>
                                                                            <!-- cita soy ciudadano? -->
                                                                            <div class="d-none col-md-8 offset-md-2 mb-3 border-top">
                                                                                <div
                                                                                    class="d-flex my-2 align-items-center">

                                                                                    <div>
                                                                                        <label class="h5 m-0 text-primary"
                                                                                            for="validationServer06">¿Has
                                                                                            solicitado cita por Soy
                                                                                            ciudadano?</label>
                                                                                    </div>
                                                                                </div>
                                                                                <select name="cita_soy_ciudadano"
                                                                                    class="custom-select "
                                                                                    id="validationServer06"
                                                                                    aria-describedby="validationServer01Feedback"
                                                                                    required>
                                                                                    <option value="No">No</option>
                                                                                    <option value="Si">Si</option>
                                                                                </select>
                                                                                <div id="validationServer06Feedback"
                                                                                    class="invalid-feedback cita_soy_ciudadano">
                                                                                    Por favor selecciona una respuesta
                                                                                    válida.
                                                                                </div>
                                                                            </div>
                                                                            <!-- submit -->
                                                                            <div class="col-md-6 offset-md-3 mb-3">
                                                                                <button id="btn_enviar" class="btn btn-success btn-block"
                                                                                type="submit">Enviar datos</button>
                                                                            </div>
                                                                        </div>



                                                                    </form>
                                                                </div>


                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-6" role="tabpanel"
                                                                aria-labelledby="custom-tabs-6-tab">
                                                                <h3 class="text-primary"><i class="pc-veterinario" style="font-size: 2rem;"></i> Información Veterinaria</h3>
                                                                <ul id="navegacion_mascotas" class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 text-primary active" id="mascota-list-tab" data-toggle="tab" href="#mascota-list" role="tab" aria-controls="mascota-list" aria-selected="true">Listado de Mascotas <span id="contador_mascotas" class="badge badge-info d-none">0</span></a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                      <a class="nav-link h4 nav-link btn btn-success btn-mascota-create" id="mascota-crear-tab" data-toggle="tab" href="#mascota-create" role="tab" aria-controls="mascota-create" aria-selected="false">Registrar nueva mascota</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="mascota-list" role="tabpanel" aria-labelledby="cita-activas-tab">
                                                                        <div class="table-responsive">
                                                                            <table class="mascotas-list bg-white table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-primary text-center">Mascota</th>
                                                                                        <th class="text-primary text-center">Tipo</th>
                                                                                        <th class="text-primary text-center">Raza</th>
                                                                                        <th class="text-primary text-center">Color</th>
                                                                                        <th class="text-primary text-center">Adquisición</th>
                                                                                        <th class="text-primary text-center">Plaquita</th>
                                                                                        <th class="text-primary text-center">Sexo</th>
                                                                                        <th class="text-primary text-center">Edad</th>
                                                                                        <th class="text-primary text-center">Peso</th>
                                                                                        <th class="text-primary text-center">Comentarios</th>
                                                                                        <th class="text-primary text-center"></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" colspan="11">
                                                                                            Sin resultados
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="mascota-create" role="tabpanel" aria-labelledby="cita-completada-tab">
                                                                        <div class="container-fluid">
                                                                            <div class="row">

                                                                                <div class="col-12 col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="nombre" class="text-primary">Nombre de la mascota</label>
                                                                                        <input data-message="Un nombre es requerido"  type="text" name="nombre" id="nombre" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="tipo" class="text-primary">Tipo de mascota</label>
                                                                                        <select data-message="Un tipo es requerido"  class="form-control" name="tipo" id="tipo"></select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="raza" class="text-primary">Raza de la mascota</label>
                                                                                        <input type="text" data-message="Una raza es requerida"  name="raza" id="raza" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="color" class="text-primary">Color</label>
                                                                                        <input type="text" data-message="Un color es requerido"  name="color" id="color" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="t_adquisicion" class="text-primary">Tipo de Adquisición</label>
                                                                                        <select data-message="Un tipo de adquisición es requerido"  class="form-control" name="t_adquisicion" id="t_adquisicion">
                                                                                            <option value="">Seleccione</option>
                                                                                            <option value="Comprado">Comprado</option>
                                                                                            <option value="Adoptado">Adoptado</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="plaquita" class="text-primary">Plaquita de identificación</label>
                                                                                        <input type="text" data-message="Plaquita de identificación, es requerido"  class="form-control" name="plaquita" id="plaquita">
                                                                                        <small id="helpId" class="text-muted">(Dejar vacio si no posee)</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="sexo" class="text-primary">Sexo</label>
                                                                                        <select data-message="Un sexo es requerido"  class="form-control" name="sexo" id="sexo">
                                                                                            <option value="">Seleccione</option>
                                                                                            <option value="Macho">Macho</option>
                                                                                            <option value="Hembra">Hembra</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="text-primary">Edad</label>
                                                                                        <input data-message="Una edad es requerida"  type="text" class="form-control" name="edad">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="" class="text-primary">Peso</label>
                                                                                        <input data-message="Un peso es requerido"  type="text" class="form-control mb-1" name="peso">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="text-primary">Comentarios</label>
                                                                                        <textarea data-message="Un comentario es requerido" class="form-control" name="comentario" id="comentario" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="offset-2 col-8">
                                                                                    <button type="button" class="btn-mascota-store btn btn-success btn-block rounded-pill">Guardar datos</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-7" role="tabpanel"
                                                                aria-labelledby="custom-tabs-7-tab">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h3 class="text-primary">
                                                                                <i class="pc-familia" style="font-size: 2rem;"></i>
                                                                                Familiares
                                                                            </h3>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-12 col-sm-8 order-2 order-sm-1 my-1">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                  <span class="input-group-text font-weight-bold text-primary" id="cedulafamiliar">Buscar un familiar por cédula:</span>
                                                                                </div>
                                                                                <input type="number" style="height: 39px;" class="form-control" id="cedula" aria-label="cedula" aria-describedby="cedulafamiliar" placeholder="Escriba cédula del familiar registrado">
                                                                                <div class="input-group-append">
                                                                                    <button type="button" class="btn-familiar-search btn btn-success btn-block">Buscar</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-12 col-sm-4 order-1 order-sm-2 text-right my-1">
                                                                            <button type="button" class="btn-familiar-create btn btn-success"><i class="btn-familiar-create fas fa-plus"></i> Añadir hijo menor de edad</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="table-responsive">
                                                                                <table class="familiar-list bg-white table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-primary text-center">Familiar</th>
                                                                                            <th class="text-primary text-center">Cédula</th>
                                                                                            <th class="text-primary text-center">Parentesco</th>
                                                                                            <th class="text-primary text-center">Verificado</th>
                                                                                            <th class="text-primary text-center">Comentarios</th>
                                                                                            <th class="text-primary text-center"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-8" role="tabpanel"
                                                                aria-labelledby="custom-tabs-7-tab">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-md-8 col-lg-10">
                                                                            <h3 class="text-primary">
                                                                                <i class="pc-familia" style="font-size: 2rem;"></i>
                                                                                Añadir Hijo
                                                                            </h3>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="container-fluid">

                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="nombre">Nombres</label>
                                                                                            <input type="text" required
                                                                                                title="Tu primer y segundo nombre son requeridos" class="form-control"
                                                                                                name="nombres" id="nombres" aria-describedby="helpId"
                                                                                                placeholder="">
                                                                                            <small id="help_nombres" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="apellido">Apellidos</label>
                                                                                            <input type="text" title="Tu primer y segundo apellido son requeridos"
                                                                                                required class="form-control" name="apellidos" id="apellidos"
                                                                                                aria-describedby="helpId" placeholder="">
                                                                                            <small id="help_apellidos" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="genero">Género</label>
                                                                                            <select class="form-control required" name="genero" id="genero"
                                                                                                aria-describedby="helpId" placeholder="">
                                                                                                <option value="m">Masculino</option>
                                                                                                <option value="f">Femenino</option>
                                                                                            </select>
                                                                                            <small id="help_genero" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                                                                            <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                                                                                class="form-control" name="fnacimiento" id="fnacimiento"
                                                                                                aria-describedby="helpId" placeholder="">
                                                                                            <small id="help_fnacimiento" class="notification"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <label class="text-primary" for="partidaNacimiento">Partida de nacimiento
                                                                                            (PDF)</label>
                                                                                        <div class="d-flex items-align-center">
                                                                                            <div class="fileImageInput">
                                                                                                <label class="heartbeat cursor-pointer" for="partidaNacimiento_familiar"
                                                                                                    style="display:flex; align-items:center;padding: 3%;border:2px dashed rgb(190, 189, 189); height:100px;width:5rem">
                                                                                                    <img onerror="this.src='/image/system/fnacimiento.svg';"
                                                                                                        id="partidaNacimiento_familiarPreview"
                                                                                                        style="height:100%;width: inherit;"
                                                                                                        src="/image/system/fnacimiento.svg" alt="User Avatar">
                                                                                                </label>
                                                                                                <input id="partidaNacimiento_familiar" type="file" style="display:none"
                                                                                                    accept="application/pdf">
                                                                                                <span class="filename"></span>
                                                                                            </div>
                                                                                            <div id="pn_preview_familiar">
                                                                                                <iframe src="#" frameborder="0" class="d-none" style="height:100px;overflow:auto;"></iframe>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="row justify-content-center">
                                                                                    <div class="col-8">
                                                                                        <button id="btnSubmit" class="btn btn-success mb-1 btn-block">Registrar hijo</button>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <button type="button" class="btn-familiar-list btn btn-block btn-primary"><i class="btn-familiar-list pc-familia"></i> Regresar</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                             <!-- datos del paciente -->
                                                            <div
                                                                style="height: 75vh;overflow: auto;"
                                                                class="tab-pane fade" id="custom-tabs-9" role="tabpanel"
                                                             aria-labelledby="custom-tabs-9-tab">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="text-center text-primary font-weight-bold h3">
                                                                                Mis datos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label class="text-primary" for="cedula">Foto</label>
                                                                            <div class="fileImageInput">
                                                                                <label class="heartbeat cursor-pointer" for="misdatos_userImagen"
                                                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                                                    <img onerror="this.src='/image/system/patient.svg'" id="misdatos_userImagenPreview" style="height:100%;width: inherit;"
                                                                                        src="/image/system/patient.svg" alt="User Avatar">
                                                                                </label>
                                                                                <input id="misdatos_userImagen" type="file" style="display:none"
                                                                                    accept="image/jpg, jpeg, bmp, png">
                                                                                <span class="filename"></span>
                                                                            </div>




                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="cedula">Documento de identidad <span
                                                                                        id="cedula_familiar_text" class="text-danger d-none">del
                                                                                        familiar</span></label>
                                                                                        <div id="no_edit_cedula"></div>
                                                                                <table class="w-100">
                                                                                    <tr>
                                                                                        <td style="width: auto;">
                                                                                            <select class="form-control"
                                                                                                title="Seleccione una nacionalidad" name="misdatos_nacionalidad"
                                                                                                id="misdatos_nacionalidad">
                                                                                                <option value="V">V</option>
                                                                                                <option value="E">E</option>
                                                                                                <option value="P">P</option>
                                                                                                <option value="J">J</option>
                                                                                            </select>
                                                                                            <small id="help_nacionalidad" class="notification"></small>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input required title="Un Documento de identidad es requerido"
                                                                                                type="number" maxlength="9" class="form-control"
                                                                                                name="misdatos_cedula" id="misdatos_cedula" aria-describedby="helpId"
                                                                                                placeholder="">
                                                                                            <small id="help_cedula" class="notification"></small>
                                                                                        </td>
                                                                                    </tr>

                                                                                </table>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="email">Correo Electrónico</label>
                                                                                <div id="no_edit_email"></div>
                                                                                <input type="text" required title="Un Correo Electrónico es requerido"
                                                                                    name="misdatos_email" id="misdatos_email" class="form-control"
                                                                                    aria-describedby="helpEmail">
                                                                                <small id="help_email" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="nombre">Nombres</label>
                                                                                <div id="no_edit_nombres"></div>
                                                                                <input type="text" required
                                                                                    title="Tu primer y segundo nombre son requeridos" class="form-control"
                                                                                    name="misdatos_nombres" id="misdatos_nombres" aria-describedby="helpId"
                                                                                    placeholder="">
                                                                                <small id="help_nombres" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="apellido">Apellidos</label>
                                                                                <div id="no_edit_apellidos"></div>
                                                                                <input type="text" title="Tu primer y segundo apellido son requeridos"
                                                                                    required class="form-control" name="misdatos_apellidos" id="misdatos_apellidos"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                <small id="help_apellidos" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="genero">Género</label>
                                                                                <div id="no_edit_genero"></div>
                                                                                <select class="form-control required" name="misdatos_genero" id="misdatos_genero"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                    <option value="m">Masculino</option>
                                                                                    <option value="f">Femenino</option>
                                                                                </select>
                                                                                <small id="help_genero" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                                                                <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                                                                    class="form-control" name="misdatos_fnacimiento" id="misdatos_fnacimiento"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                <small id="help_fnacimiento" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                                                                <input type="tel" required
                                                                                    title="Un teléfono de contacto es requerido"
                                                                                    onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                                                                    name="misdatos_telefono_movil" id="misdatos_telefono_movil" aria-describedby="helpId"
                                                                                    placeholder="">
                                                                                <small id="help_telefono_movil" class="notification">(preferiblemente
                                                                                    vinculado a
                                                                                    <i class="text-success">Whatsapp</i>)</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 d-none">
                                                                            <label class="text-primary" for="partidaNacimiento">Partida de nacimiento
                                                                                (PDF)</label>
                                                                            <div class="d-flex items-align-center">
                                                                                <div class="fileImageInput">
                                                                                    <label class="heartbeat cursor-pointer" for="misdatos_partidaNacimiento"
                                                                                        style="display:flex; align-items:center;padding: 3%;border:2px dashed rgb(190, 189, 189); height:100px;width:5rem">
                                                                                        <img onerror="this.src='/image/system/fnacimiento.svg';"
                                                                                            id="misdatos_partidaNacimientoPreview"
                                                                                            style="height:100%;width: inherit;"
                                                                                            src="/image/system/fnacimiento.svg" alt="User Avatar">
                                                                                    </label>
                                                                                    <input id="misdatos_partidaNacimiento" type="file" style="display:none"
                                                                                        accept="application/pdf">
                                                                                    <span class="filename"></span>
                                                                                </div>
                                                                                <div id="misdatos_pn_preview">
                                                                                    <iframe src="" frameborder="0" class="d-none" style="height:100px;overflow:auto;"></iframe>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-6">
                                                                            <div class="form-group box-cat_estado_id">
                                                                                <label class="text-primary" for="misdatos_cat_estado_id">Estado</label>
                                                                                <select required title="Un Estado es requerido"
                                                                                    class="form-control select2" name="misdatos_cat_estado_id" id="misdatos_cat_estado_id"
                                                                                    aria-describedby="helpId" placeholder=""></select>
                                                                                <small id="help_cat_estado_id" class="notification"></small>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group box-cat_municipio_id">
                                                                                <label class="text-primary" for="misdatos_cat_municipio_id">Municipio</label>
                                                                                <select required title="Un Municipio es requerido"
                                                                                    class="form-control select2" name="misdatos_cat_municipio_id"
                                                                                    id="misdatos_cat_municipio_id" aria-describedby="helpId"
                                                                                    placeholder=""></select>
                                                                                <small id="help_cat_municipio_id" class="notification"></small>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="misdatos_description">Ciudad</label>
                                                                                <input required title="Una Ciudad es requerida" type="text"
                                                                                    class="form-control" name="misdatos_description" id="misdatos_description"
                                                                                    aria-describedby="helpId" placeholder="">
                                                                                <small id="help_description" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="misdatos_domicilio">Domicilio</label>
                                                                                <input required title="Tu domicilio es requerido" class="form-control"
                                                                                    name="misdatos_domicilio" id="misdatos_domicilio">
                                                                                <small id="help_domicilio" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                                                            <div class="d-flex items-align-center">
                                                                                <div class="fileImageInput">
                                                                                    <label class="heartbeat cursor-pointer" for="misdatos_imgSoyChacao"
                                                                                        style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                                                        <img
                                                                                            onerror="this.src='/image/system/card.svg'"
                                                                                            id="misdatos_imgSoyChacaoPreview"
                                                                                            style="height:100%;width: inherit;"
                                                                                            src="/image/system/card.svg"
                                                                                            alt="User Avatar">
                                                                                    </label>
                                                                                    <input id="misdatos_imgSoyChacao" type="file" style="display:none"
                                                                                        accept="image/jpg, jpeg, bmp, png">
                                                                                    <span class="filename"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label class="text-primary" for="cedula">Foto de Documento de
                                                                                Identidad</label>
                                                                            <div class="d-flex items-align-center">
                                                                                <div class="fileImageInput">
                                                                                    <label class="heartbeat cursor-pointer" for="misdatos_imgDocIdentidad"
                                                                                        style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                                                        <img
                                                                                            onerror="this.src='/image/system/card.svg'"
                                                                                            id="misdatos_imgDocIdentidadPreview"
                                                                                            style="height:100%;width: inherit;"
                                                                                            src="/image/system/card.svg"
                                                                                            alt="User Avatar">
                                                                                    </label>
                                                                                    <input id="misdatos_imgDocIdentidad" type="file" style="display:none"
                                                                                        accept="image/jpg, jpeg, bmp, png">
                                                                                    <span class="filename"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="text-primary" for="misdatos_tarjeta_soy_chacao">Código Tarjeta Soy
                                                                                    CMDLT <i class="text-gray">(Si tiene la tarjeta)</i></label>
                                                                                <input required
                                                                                    title="El código de la tarjeta está en la parte posterior de la misma."
                                                                                    class="form-control border-0 disabled" disabled readonly name="misdatos_tarjeta_soy_chacao">
                                                                                <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class=" offset-2 col-8">
                                                                            <button class="btn_submit_paciente_edit btn btn-success btn-block">Actualizar datos</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;border-radius: 30px;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document" style="height: auto;border-radius: 30px;">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal"
                            src="/image/system/logo-cmdlt-blanco.png">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>

                <div class="modal-body" style="background: #F1F3F4!important;">

                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/logo-cmdlt_mono.svg"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">

                    <div class="bg-light p-2">
                        <h3 class="exampleModal_title text-primary">Reprogramar Cita</h3>
                        <table>
                            <tr>
                                <th class="text-secondary">Paciente:</th>
                                <td class="exampleModal_paciente">Ramón Koens</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Médico:</th>
                                <td class="exampleModal_medico">Luis Eduardo Parodi</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Especialidad:</th>
                                <td class="exampleModal_especialidad">Urología Pediatrica</td>
                            </tr>
                        </table>

                    </div>
                    <form class="p-2" action="">
                    </form>
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
                            <img src="/image/system/logo-cmdlt_mono.svg"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                </div>
                <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fullscreen-modal fade" id="fullscreen" style="z-index: 100000;" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-between">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close" class="fas fa-times text-white "
                            style="font-size: 2em;margin-left:1%;cursor:pointer;" aria-hidden="true"></i>
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/logo-cmdlt_mono.svg"
                                style="height: 3em !important;width: 120px;" alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                </div>
                <div class="modal-footer fullscreen justify-content-center">

                </div>
            </div>
        </div>
    </div>
    @include('templates.template')
    <!-- card-centro-salud -->
    <template id="artefacto_0065">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 style="font-weight: 300">
                                <b style="font-size: 0.9em !important;" class="text-primary card-title">Centro de Salud</b>
                            </h2>

                        </div>
                        <div class="col-3 text-center">
                            <i class="fas fa-map-marker-alt text-primary" style="font-size: 3em;"></i>
                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                    <b>Especialidades:</b>
                                    <ul class="card-list_items">
                                        <li>Especialidad 1</li>
                                        <li>Especialidad 2</li>
                                        <li>Especialidad 3</li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-map-marker-alt"></i></span>
                                    <b>Dirección:</b>
                                    <div class="card-text-1">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quod doloribus nisi
                                        reprehenderit! Eligendi rerum voluptatum cum assumenda illum libero
                                        perspiciatis, et accusamus nemo impedit voluptatibus eaque vel enim eveniet.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="text-right">
                        <a href="#" class="btn-location rounded-pill btn btn-sm btn-outline-primary">
                            <i class="fa fa-location"></i>
                            Ver en el mapa
                        </a>
                        <a href="#" class="d-none btn-nueva-cita rounded-pill btn btn-sm btn-primary">
                            <i class="btn-nueva-cita pc-cita_por_confirmar"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- medicos -->
    <template id="artefacto_0066">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 style="font-weight: 300">
                                <b style="font-size: 0.9em !important;" class="text-primary card-title">Médico Nombre Apellido</b>
                            </h2>
                        </div>
                        <div class="col-3 text-center">
                            <img onerror="reemplaza_imagen(this)" src="#" style="width:70px;height:70px;" alt="user-avatar"
                                class="card-image rounded-circle {{-- border-success --}} img-circle img-fluid">
                            <div class="card-turno d-none align-items-center">
                                <div>
                                    <i class="fas fa-circle ping text-success" style="font-size: 1em;"></i>
                                </div>
                                <div class="text-success" style="font-weight:600;font-size: 9.5px;">De turno</div>
                            </div>

                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span><i class="fas fa-stethoscope"></i></span>
                                    <b>Especialidad:</b>
                                    <ul class="card-list_items-3">
                                        <li>Especialidad 1</li>
                                        <li>Especialidad 2</li>
                                        <li>Especialidad 3</li>
                                    </ul>
                                </li>

                            </ul>
                            {{-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span><i class="fas fa-lg fa-clock"></i></span>
                                    <b>Días de consulta:</b>
                                    <ul class="card-list_items-1">
                                        <li>Lunes: <span class="float-right">00:00 AM A 00:00 PM</span></li>
                                        <li>Miercoles: <span class="float-right">00:00 AM A 00:00 PM</span></li>
                                        <li>Viernes: <span class="float-right">00:00 AM A 00:00 PM</span></li>

                                    </ul>
                                </li>

                            </ul> --}}
                        </div>
                        <div class="col-12">
                            {{-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span><i class="fas fa-lg fa-building"></i></span>
                                    <b>Centros de salud:</b>
                                    <ul class="card-list_items-2">
                                        <li>Centro Salud 1</li>
                                        <li>Centro Salud 2</li>
                                        <li>Centro Salud 3</li>
                                    </ul>
                                </li>

                            </ul> --}}
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="text-right">
                        <a href="#" class="d-none btn-nueva-cita rounded-pill card-agendar_cita btn btn-sm btn-primary">
                            <i class="btn-nueva-cita pc-cita_por_confirmar"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- especialidad -->
    <template id="artefacto_0067">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 style="font-weight: 300">
                                <b style="font-size: 0.9em !important;" class="text-primary card-title">Especialidad Title</b>
                            </h2>

                        </div>
                        <div class="col-3 text-center">
                            <img onerror="this.src='/image/system/especialidades/innovacion.svg'" src="#" alt="user-avatar"
                                class="card-image img-circle img-fluid">
                        </div>
                        <div class="col-12">
                            <p class="text-muted text-sm">
                                <b>Descripción: </b> <span class="card-descripcion">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit. Porro autem fuga exercitationem quam nisi dolore
                                    reiciendis minima atque, aspernatur vero sunt tempore, eligendi ducimus rem enim,
                                    doloremque dolorem veniam praesentium.</span>
                            </p>
                        </div>
                        <div class="col-12">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                    <b>Centros de salud:</b>
                                    <ul class="card-list_items">
                                        <li>Centro Salud 1</li>
                                        <li>Centro Salud 2</li>
                                        <li>Centro Salud 3</li>

                                    </ul>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="text-right">
                        <a href="#" class="d-none btn-nueva-cita rounded-pill card-crear_cita btn btn-sm btn-primary">
                            <i class="btn-nueva-cita pc-cita_por_confirmar"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- card cita -->
    <template id="artefacto_0068">
        <div class="card-cita">
            <div class="card-row"><!-- 1 -->
                <div>
                    <h3>Nueva Cita</h3>
                    <h4 class="card-status">Por confirmar</h4>
                    <h6 class="card-created_at">Creada el 0 DIC, 0000 | 0:00:00 AM</h6>
                </div>
                <div class="info-box-icon text-center m-0 rounded-circle h4"
                    style="height: 50px;width: 50px;font-size: 1.7rem;line-height: 50px;">
                    <i class="text-white"></i>
                </div>
            </div>
            <div class="card-row"><!-- 3 -->
                <h6>Tu cita está agendada para el:</h6>
                <div>
                    <article>
                    <div>Dia</div>
                    <b class="card-cita-dia">00</b>
                    </article>
                    <article>
                    <div>Mes</div>
                    <b class="card-cita-mes">Septiembre</b>
                    </article>
                    <article>
                    <div>Año</div>
                    <b class="card-cita-anio">0000</b>
                    </article>
                    <article>
                    <div>Hora</div>
                    <b class="card-cita-hora">00:00 AM</b>
                    </article>
                </div>
            </div>
            <div class="card-row"><!-- 2 -->
                <article>
                    <h6>Especialidad</h6>
                    <div>
                    <img class="card-especialidad-imagen rounded-circle" onerror="this.src='/image/system/especialidades/innovacion.svg'" src="/image/system/especialidades/medicina_general.svg" style="width:30px;height:30px;" alt="">
                    <span class="card-especialidad">No indicado</span>
                    </div>

                </article>
                <article>
                    <h6>Médico</h6>
                    <div>
                    <img class="card-especialista-imagen rounded-circle" onerror="this.src='/image/system/especialidades/innovacion.svg'" src="/image/system/especialidades/medicina_general.svg" style="width:30px;height:30px;" alt="">
                    <span class="card-medico-nombre">No indicado</span>
                    </div>
                </article>
            </div>
            <div class="card-row"><!-- 4 -->
                <h6>Centro de Salud</h6>
                <p class="card-cita-centro-salud">
                    No indicado
                </p>
            </div>
            <div class="card-row"><!-- 5 -->
                <h6>Motivo de consulta</h6>
                <p class="card-cita-reason_for_consultation">
                    No indicado
                </p>
            </div>
            <div class="card-row box-coment-cancelation d-none"><!-- 6 -->
                <h6>Motivo de cancelación</h6>
                <p class="card-cita-coment-cancelation">
                    No indicado
                </p>
            </div>
            <div class="card-row reprogramacion bg-warning p-2 d-none text-center" style="border-radius: 1rem;">
                <h4>Esta cita ha sido reprogramada</h4>
                <b>Motivo:</b>
                <p class="motivo_reprogramacion bg-white" style="border-radius: 1rem;">

                </p>
                <p>
                    ¿Quiere confirmar o rechazar la reprogramación?
                </p>
                <div class="d-flex">
                    <button class="btn_confirmar_reprogramar btn mr-1 mb-1 btn-sm btn-outline-success w-100">Confirmar</button>
                    <button class="btn_rechazar_reprogramar btn ml-1 mb-1 btn-sm btn-outline-danger w-100">Rechazar</button>
                </div>
            </div>
            <div class="card-row">
                <button class="btn_informe_general btn btn-sm btn-outline-info w-100 d-none">Informe de Medicina General</button>
            </div>
            <div class="card-row"> <!-- 8 -->
              <button class="card-cita_cancelar btn btn-sm btn-outline-danger w-100">Cancelar cita</button>
            </div>
        </div>

    </template>
    <!--  -->
    <template id="artefacto_0069">
        <!-- medicina_general -->
        <div class="col-md-12 mb-3">
            <div class="d-flex my-2 align-items-center">
                <div>
                    <div class="form-number-input-medicina_general bg-primary rounded-circle"
                        style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                        1
                    </div>
                </div>
                <div>
                    <label class="h5 m-0 text-primary"
                        for="validationServer01">
                        ¿Fue visto previamente por un médico
                        general?
                    </label>
                </div>
            </div>
            <select name="medicina_general"
                class="custom-select "
                id="validationServer01"
                aria-describedby="validationServer01Feedback"
                required>
                <option value="">Seleccione</option>
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
            <div id="validationServer01Feedback" class="invalid-feedback medicina_general">
                Por favor selecciona una respuesta
                válida.
            </div>
        </div>
        <div id="carga_archivo_mensaje"  class="alert" style="color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;" role="alert">
            En caso de no tener una consulta previa con
            <b>Medicina General</b>, lo invitamos a
            asistir o a solicitar una orientación
            diagnóstica en el centro de salud de su
            preferencia.
        </div>
        <!-- carga de archivos -->
        <div id="carga_archivo" style="color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;" class="pb-2 d-none rounded col-md-12 mb-3">
            <div
                class="d-flex my-2 align-items-center">
                <div>
                    <label class="h5 m-0 "
                        for="validationServer02">
                        Cargue, una referencia
                        médica, antes de solicitar una
                        cita con un especialista.
                    </label>
                </div>
            </div>

            <input type="file" style="padding: 0.2rem;"
                    name="informe_medico"
                    class="form-control"
                    id="informe_medico">

        </div>
        <div id="validationServer02Feedback"
            class="invalid-feedback">
            Por favor selecciona una especialidad.
        </div>
        <button type="button" class="btn-continuar-cita btn btn-success btn-block" >Continuar</button>
    </template>

    <!-- tipo cita -->
    <template id="artefacto_0070">
        <!-- medicina_general -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-primary text-center">Seleccione el tipo de atención</h3>
                    <div class="list-group mb-3">
                        <button type="button" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-medica-create" data-option="btn-cita-medica-create"><i class="pc-medico text-primary mr-1" style="font-size: 2rem;"></i> Consulta Médica</button>
                        <button type="button" class="list-group-item list-group-item-action d-none align-items-center btn-cita-veterinaria-create" data-option="btn-cita-veterinaria-create"><i class="pc-veterinario text-primary mr-1" style="font-size: 2rem;"></i> Consulta Veterinaria</button>
                        <button type="button" class="list-group-item list-group-item-action d-none align-items-center btn-cita-laboratorio" data-option="btn-cita-laboratorio"><i class="pc-laboratorio text-primary mr-1" style="font-size: 2rem;"></i> Solicitud de Laboratorio</button>
                        <button type="button" class="list-group-item list-group-item-action d-none align-items-center btn-cita-rayosx" data-option="btn-cita-rayosx"><i class="pc-rayosx text-primary mr-1" style="font-size: 2rem;"></i> Solicitud de Imagen RX</button>
                        {{-- <button type="button" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-ecosonografia" data-option="btn-cita-ecosonografia"><i class="pc-ecosonografia text-primary mr-1" style="font-size: 2rem;"></i> Ecosonografía</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn-cancelar-cita btn btn-primary btn-block" data-dismiss="modal" >Cancelar</button>
    </template>
    <!-- select mascota -->
    <template id="artefacto_0071">
        <!-- medicina_general -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-primary text-center">Selecciona tu mascota</h3>
                    <div class="list-group mb-3">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn-continuar-cita-veterinaria btn btn-success btn-block">Continuar</button>
    </template>
    <!-- mensaje referencia de medico general -->
    <template id="artefacto_0072">

            <!-- medicina_general -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-white font-weight-bold text-center">Atención</h2>
                        {{-- <p class="text-center h3">Estimado vecino.
                            A excepción de las especialidades:
                            <i>Ginecología, Obstetricia, Odontología, y Pediatría</i>, es un
                            <b style='font-size:2.4rem;'>requisito obligatorio</b>
                            llevar a tu cita una
                            <b style='font-size:2.4rem;'>referencia médica</b> emitida <b>solo</b> por CMDLT
                            para ser atendido por un especialista,
                            <b>de lo contrario, tu cita será cancelada.</b>
                        </p> --}}
                        <div class="bg-white text-center my-2 rounded p-2 pb-3" style=" font-size:2.2rem; font-weight:600; line-height: 1.2;  border-radius: 1rem !important;">
                            <h1 class=" text-primary">¡Recuerda!</h1>
                            Es importante,<br>
                            para el día de tu cita,<br>
                            llegar con<br>
                            15 minutos de anticipación.

                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn-confirmar-mensaje-cita btn btn-outline-white btn-block">Entendido</button>

    </template>
    <template id="artefacto_0073">

            <!-- medicina_general -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-white font-weight-bold text-center">Atención</h2>
                        <p class="text-center h3">
                            Estimado usuario:<br>
                            para solicitar nuevas citas
                            en el sistema,
                            <b>requerimos que su perfil
                            esté asociado a una tarjeta
                            Soy CMDLT válida</b>.
                            Por favor,
                            dirijase al Centro médico Docente La Trinidad,
                            para actualizar sus datos.
                        </p>
                    </div>
                </div>
            </div>

            <button type="button" data-dismiss="modal" class="btn btn-outline-white btn-block">Entendido</button>

    </template>
    <template id="googleMaps">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4665.396139548923!2d-66.87099621879842!3d10.491608563768908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59556f32f44b%3A0xb0055fedcc8ad196!2sAmbulatorio%20El%20Bosque%20Salud%20Chacao!5e0!3m2!1ses!2sve!4v1647053939766!5m2!1ses!2sve"
            width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
    </template>
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
    <script src="/js/tippy-bundle.umd.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script>
        let user_id_paciente = "{{ Auth::id() }}"
        let user_cedula = "{{ session('userData')['cedula'] }}"
        let user_genero = "{{ session('userData')['genero'] }}"
        let d = document
        let paciente = ""
        let onChange_agenda_id
        let final_hora;
        let final_dia;
        let cantidad_actual_citas = 0;
        let cantidad_actual_historial = 0;

        let useState = {
            "paciente": {
                "user_id": Number("{{ Auth::id() }}"),
                "genero" : "{{ session('userData')['genero'] }}",
                "cedula" : "{{ session('userData')['cedula'] }}",
                "imagen" : "{{ session('userData')['imagen'] }}",
                "nombre" : "{{ session('userData')['nombre'] }}",
                "apellido" : "{{ session('userData')['apellido'] }}",
                "tarjeta_soy_chacao" : "{{ session('userData')['tarjeta_soy_chacao'] }}",
            },
            "especialidad_id_con_agenda": null,
            "paciente_edit"       : null,
            "estado"       : null,
            "municipio"    : null,
            "agendas"      : null,
            "centros_salud": null,
            "citas"        : {
                "activas"  : null,
                "historial": null,
            },
            "especialidades": null,
            "episodios"     : null,
            "informe"       : null,
            "archivo"       : null,
            "antecedente"   : null,
            "medicos"       : null,
            "familiares"       : null,
            "cat_user_family"       : null,
            "formNuevaCita" : {
                "user_id_paciente" : null,
                "cita_soy_ciudadano" : "No",
                "cat_especialidad_id": "",
                "centro_salud_id"    : "",
                "user_id_medico"     : "",
                "cita_dia"           : "",
                "cita_hora"          : "",
                "cita_motivo"        : "",
                "file"               : "",
            },
            "user_mascota"     : null,
            "formMascotaCreate": {
                "user_id"   : Number(user_id_paciente),
                "nombre"    : null,
                "tipo"      : null,
                "sexo"      : null,
                "raza"      : null,
                "peso"      : null,
                "comentario": null,

            },
            "formCreatePaciente":{
                "tipo_registro"     : "personal",
                "cedula_personal"   : "",
                "cat_user_family_id": "",
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
                "cat_municipio_id"  : "182",
                "description"       : "Caracas",    //ciudad
                "domicilio"         : "",
                "tarjeta_soy_chacao": "",
                "fecha_ingreso"     : "",
                "cat_genero"        : [
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
            "formEditPaciente":{
                "userImagen"            : null,
                "nacionalidad"      : "V",
                "cedula"            : "",
                "email"             : "",
                "nombres"           : "",
                "apellidos"         : "",
                "genero"            : "m",
                "fnacimiento"       : "",
                "telefono_movil"    : "",
                "partidaNacimiento" : null,
                "cat_estado_id"     : "14",
                "cat_municipio_id"  : "182",
                "description"       : "Caracas",    //ciudad
                "domicilio"         : "",
                "imgSoyChacao"      : null,
                "imgDocIdentidad"   : null,
                "tarjeta_soy_chacao": "",
                "fecha_ingreso"     : "",
            },
            "cat_estado":null,
            "cat_municipio":null,
            "formAgendaCreate": null,
        }
        let f = new Date();
            useState['formAgendaCreate'] = {
                "dias_excluidos": [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado"
                ],
                "meses_excluidos" : [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "semanas_excluidas" :{
                    "Enero": [1,2,3,4,5,6],
                    "Febrero": [1,2,3,4,5,6],
                    "Marzo":  [1,2,3,4,5,6],
                    "Abril": [1,2,3,4,5,6],
                    "Mayo":  [1,2,3,4,5,6],
                    "Junio":  [1,2,3,4,5,6],
                    "Julio":  [1,2,3,4,5,6],
                    "Agosto":  [1,2,3,4,5,6],
                    "Septiembre":  [1,2,3,4,5,6],
                    "Octubre":  [1,2,3,4,5,6],
                    "Noviembre":  [1,2,3,4,5,6],
                    "Diciembre":  [1,2,3,4,5,6],
                },
                "agenda_year": f.getFullYear(),
                "agenda_month": [],
                "cupos_por_dia": 1,
                "centro_salud_id": null,
                "user_id_medico": null,
                "cat_especialidad_id": null,
                "agenda_registradas":[],
                "resultset": [],
                "agenda_horas":{
                    "1":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "2":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "3":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "4":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "5":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "6":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                    "0":{
                        "Mañana":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Mañana",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Mañana",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Mañana",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Mañana",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                }
                            ], //Publica, Privada, Personalidada
                        },
                        "Tarde":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                        "Todo el dia":{
                            "total_pacientes_por_horas":1,
                            "visibilidad":"todo_el_dia_publico",
                            "horas":[
                                {
                                    "keyArray": 0,
                                    "turno": "Todo el dia",
                                    "hora": "08:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 1,
                                    "turno": "Todo el dia",
                                    "hora": "09:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 2,
                                    "turno": "Todo el dia",
                                    "hora": "10:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 3,
                                    "turno": "Todo el dia",
                                    "hora": "11:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 4,
                                    "turno": "Tarde",
                                    "hora": "13:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 5,
                                    "turno": "Tarde",
                                    "hora": "14:00",
                                    "visibilidad": "publica"
                                },
                                {
                                    "keyArray": 6,
                                    "turno": "Tarde",
                                    "hora": "15:00",
                                    "visibilidad": "publica"
                                }
                            ],
                        },
                    },
                },
                "agenda":null
            }
        let paciente_edit = async ()=>{

            $('[data-widget="pushmenu"]').PushMenu('collapse')
            let $form = document.getElementById('custom-tabs-9')

                d.querySelector("#cargando").classList.remove("d-none")
                useState['paciente_edit'] = first(await get( location.origin+`/consultaexterna/user/paciente/show2/${user_id_paciente}`))
                d.querySelector("#cargando").classList.add("d-none")

                if (is_null( useState['cat_estado'])) {
                    d.querySelector("#cargando").classList.remove("d-none")
                    useState['cat_estado'] = await get( location.origin+`/consultaexterna/cat/estado/getAll`)
                    d.querySelector("#cargando").classList.add("d-none")
                }
                if (is_null( useState['cat_municipio'])) {
                    d.querySelector("#cargando").classList.remove("d-none")
                    useState['cat_municipio'] = await get( location.origin+`/consultaexterna/cat/municipio/getAll`)
                    "#cargando").classList.add("d-none")
                }
   $form.querySelector(`#no_edit_cedula`).textContent= paciente.nacionalidad+paciente.cedula
                $form.querySelector(`#no_edit_email`).textContent= paciente.email
                $form.querySelector(`#no_edit_nombres`).textContent= paciente.nombres
                $form.querySelector(`#no_edit_apellidos`).textContent= paciente.apellidos
                */
               console.log('Antes del for...', $form)
                for (const x in useState['paciente_edit']) {
                    if ([
                        'cedula',
                        'apellidos',
                        'nombres',
                        'email',
                        'description',
                        'domicilio',
                        'tarjeta_soy_chacao',
                        'fnacimiento',
                        'telefono_movil',
                    ].includes(x)) {
                        if([
                            'cedula',
                            'apellidos',
                            'nombres',
                            'email',
                        ].includes(x)){
                            $form.querySelector(`input[name='misdatos_${x}']`).style.display = "none"
                            $form.querySelector(`#no_edit_${x}`).textContent= useState['paciente_edit'][x]
                        }
                        $form.querySelector(`input[name='misdatos_${x}']`).value= useState['paciente_edit'][x]
                    }
                    if ([
                        'genero',
                        'nacionalidad',
                    ].includes(x)) {

                        $form.querySelector(`select[name='misdatos_${x}']`).value= useState['paciente_edit'][x]
                    }

                    if([
                        'genero',
                    ].includes(x)){
                        $form.querySelector(`select[name='misdatos_${x}']`).style.display = "none"
                        $form.querySelector(`#no_edit_genero`).textContent= useState['paciente_edit'][x] ==="f"? 'Femenino':'Masculino'

                    }
                    if([
                        'nacionalidad',
                    ].includes(x)){
                        $form.querySelector(`select[name='misdatos_${x}']`).style.display = "none"
                    }

                }

                telefonoConfig("#misdatos_telefono_movil")

                $form.querySelector("select[name='misdatos_cat_estado_id']").innerHTML= selectOptions(
                    useState['cat_estado'],
                    useState['paciente_edit']['cat_estado_id']
                    )

                $form.querySelector("select[name='misdatos_cat_municipio_id']").innerHTML= selectOptions(
                    useState['cat_municipio'].filter( x=>equalsInt( x['cat_estado_id'] , useState['paciente_edit']['cat_estado_id'] ) ),
                    useState['paciente_edit']['cat_municipio_id']
                )

                if (!is_null( useState['paciente_edit']['userImagen'] ) ) {
                    $form.querySelector("#misdatos_userImagenPreview").src= useState['paciente_edit']['userImagen']
                }
                if (!is_null( useState['paciente_edit']['partidaNacimiento'] ) ) {
                    $form.querySelector(`#misdatos_pn_preview iframe`).src= useState['paciente_edit']['partidaNacimiento']
                    d.querySelector(`#misdatos_pn_preview iframe`).classList.remove("d-none")
                }
                if (!is_null( useState['paciente_edit']['imgDocIdentidad']  ) ) {
                    $form.querySelector("#misdatos_imgDocIdentidadPreview").src= useState['paciente_edit']['imgDocIdentidad']
                }
                if (!is_null( useState['paciente_edit']['imgSoyChacao'] ) ) {
                    $form.querySelector("#misdatos_imgSoyChacaoPreview").src= useState['paciente_edit']['imgSoyChacao']
              ion_consulta_externa a[href='#custom-tabs-9']").tab('show')
        }
        let paciente_update = async()=>{

            let formData = new FormData();
            let $form = document.getElementById('custom-tabs-9')
                console.log(useState['formEditPaciente'])
                for (const x in useState['formEditPaciente']) {
                    console.log(x)
                    if ([
                        'cedula',
                        'apellidos',
                        'nombres',
                        'email',
                        'description',
                        'domicilio',
                        'tarjeta_soy_chacao',
                        'fnacimiento',
                        'telefono_movil',
                    ].includes(x)) {
                        formData.append(x, $form.querySelector(`input[name='misdatos_${x}']`).value )
                    }
                    if ([
                        'genero',
                        'nacionalidad',
                        'cat_estado_id',
                        'cat_municipio_id',

                    ].includes(x)) {
                        formData.append(x, $form.querySelector(`select[name='misdatos_${x}']`).value )

                    }
                    if ([
                        'imgDocIdentidad',
                        'imgSoyChacao',
                        'partidaNacimiento',
                    ].includes(x)) {
                        formData.append(x, document.getElementById(`misdatos_${x}`).files[0])
                    }
                    if ([
                        'userImagen',
                    ].includes(x)) {
                        formData.append("imagen", document.getElementById(`misdatos_${x}`).files[0])
                    }



                }
                formData.append("created_at",timestamps() );
                formData.append("_token",d.querySelector("#_token").value)
                d.querySelector("#cargando").classList.remove("d-none")
            let $response = await post("/consultaexterna/paciente/consultaExternaStore/store",formData)

                d.querySelector("#cargando").classList.add("d-none")
                if($response['success']){
                    message = "Datos actualizados correctamente";
                    Toast.fire({
                        icon: "success",
                        title: "Mis datos actualizados",
                        text: message,

                    })
                }else{
                    message = "Error al actualizar los datos";
                    Toast.fire({
                        icon: "error",
                        title: "Datos no actualizados",
                        text: message,

                    })
                }
                d.querySelector("#cargando").scrollTop = 0;

        }
        let getInitialContent = async () => {

                const content = await Promise.all([

                    //get( location.origin+"/user/getAutenticationData"),
                    //get( location.origin+"/cat/medico/getAllCitas"),
                    //get( location.origin+"/cat/centro_salud/getAll"),
                    //get( location.origin+"/cat/medico/especialidad/getAll"),
                    //get( location.origin+"/user/paciente/cita/show/" + user_id_paciente),
                    //get( location.origin+"/medico/agenda/getAll"),
                    //get( location.origin+"/cat_user_especialidad/index"),
                    //get( location.origin+"/cat/centro_salud/getAll"),


               ])
               return content
        }
        let inputValidation = (name) => {

                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                let feedback = d.querySelector(`.invalid-feedback.${name}`)

                let selectInput = d.querySelector(`select[name='${name}']`)

                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")


                    if ( name === "medicina_general") {
                        if ( ['No',"Si"].includes( selectInput.value ) ) {
                            inputGroup.classList.add("bg-success")
                            feedback.style.display = "none"
                            selectInput.classList.add("is-valid")
                        }else{
                            inputGroup.classList.add("bg-warning")
                            feedback.style.display = "block"
                            selectInput.classList.remove("is-valid")
                        }
                        return false
                    }
                   // console.log(selectInput.value)
                    if ( is_empty( selectInput.value ) ) {
                        inputGroup.classList.add("bg-warning")
                        feedback.style.display = "block"
                        selectInput.classList.remove("is-valid")
                    }else {
                        inputGroup.classList.add("bg-success")
                        feedback.style.display = "none"
                        selectInput.classList.add("is-valid")
                    }
        }
        let inputValidation2 = (name) => {

                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                let selectInput = d.querySelector(`input[name='${name}']`)

                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")

                    if ( is_empty( selectInput.value ) ) {
                        inputGroup.classList.add("bg-warning")
                        feedback.style.display = "block"
                        selectInput.classList.remove("is-valid")
                    }else {
                        inputGroup.classList.add("bg-success")
                        feedback.style.display = "none"
                        selectInput.classList.add("is-valid")
                    }
        }
        let inputValidation3 = (name) => {
            let inputGroup = d.querySelector(`.form-number-input-${name}`)
            let feedback = d.querySelector(`.invalid-feedback.${name}`)
            let selectInput = d.querySelector(`textarea[name='${name}']`)
                inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")

                if ( is_empty( selectInput.value ) ) {
                    inputGroup.classList.add("bg-warning")
                    feedback.style.display = "block"
                    selectInput.classList.remove("is-valid")
                }else {
                    inputGroup.classList.add("bg-success")
                    feedback.style.display = "none"
                    selectInput.classList.add("is-valid")
                }
        }
        let handleMedicinaHeneral = () => {
            let name = "medicina_general"
                inputValidation(name)

            let model_input = d.querySelector(`select[name='${name}']`)
                useState['formNuevaCita']['medicina_general'] = model_input.value
                /* $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
                if (useState['formNuevaCita']['medicina_general'] === "Si") {
                    d.querySelector("#carga_archivo_mensaje").classList.add("d-none")
                    d.querySelector("#carga_archivo").classList.remove("d-none")
                }else{

                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                } */
        }
        let get_medico_agenda_horas= (agenda_id,dia_del_mes)=>{
           /genda_id",agenda_id)

            useState['formNuevaCita']['user_id_medico']
            let model = useState['medicos'].find(x=>equalsInt(x['user_id_medico'] , medico_id ) )
                model = model['agenda']
               // console.log("model",model)
            let { horas_am, horas_pm } = model

                if (is_undefined(horas_am)) {
                    horas_am ={}
                }
                if (is_undefined(horas_pm)) {
                    horas_am ={}
                }
            let am =[]
                if (horas_am.length > 0) {
                    am = horas_am.filter(hora => {
                        let date = new Date(hora)

                            if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                return hora
                            }
                    } )
                }else{
                    am =[]
                }
            let pm =[]
                if (horas_pm.length > 0) {
                    pm = horas_pm.filter(hora => {
                            let date = new Date(hora)
                                if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                    return hora
                                }
                        } )
                }else{
                    pm =[]
                }
            return {"horas_am": am,"horas_pm": pm}
        }
        let get_medico_agenda_horasRESPALDO= (agenda_id,dia_del_mes)=>{
           // console.log("agenda_id",agenda_id)

            let medico_id = useState['formNuevaCita']['user_id_medico']
            let model = useState['medicos'].find(x=>equalsInt(x['user_id_medico'] , medico_id ) )
                model = model['agenda']
               // console.log("model",model)
            let { horas_am, horas_pm } = model

                if (is_undefined(horas_am)) {
                    horas_am ={}
                }
                if (is_undefined(horas_pm)) {
                    horas_am ={}
                }
            let am =[]
                if (horas_am.length > 0) {
                    am = horas_am.filter(hora => {
                        let date = new Date(hora)

                            if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                return hora
                            }
                    } )
                }else{
                    am =[]
                }
            let pm =[]
                if (horas_pm.length > 0) {
                    pm = horas_pm.filter(hora => {
                            let date = new Date(hora)
                                if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                    return hora
                                }
                        } )
                }else{
                    pm =[]
                }
            return {"horas_am": am,"horas_pm": pm}
        }
        let getDatesOfWeekWithHours = (weekNumber, year, dayOfWeek, hour)=> {
            // Obtenemos la fecha del primer día del año
            const firstDayOfYear = new Date(year, 0, 1);
            // Calculamos el número de milisegundos desde el primer día del año hasta el primer día de la semana actual
            const pastDaysOfYear = (weekNumber - 1) * 7;
            // Añadimos los milisegundos al primer día del año para obtener el primer día de la semana especificada
            const firstDayOfWeek = new Date(firstDayOfYear.getTime() + (pastDaysOfYear * 24 * 60 * 60 * 1000));

            // Calculamos el número de días hasta el día de la semana especificado
            const pastDaysOfWeek = (dayOfWeek - firstDayOfWeek.getUTCDay() + 7) % 7;
            // Obtenemos la fecha del día de la semana especificado sumando los días al primer día de la semana
            const dateOfWeek = new Date(firstDayOfWeek.getTime() + (pastDaysOfWeek * 24 * 60 * 60 * 1000));

            // Creamos un array para guardar las fechas con las horas especificadas
            //const datesWithHours = [];
            // Recorremos el arreglo de horas
            //for (const hour of hours) {
            // Separamos la hora y los minutos
            const [hourStr, minuteStr] = hour['hora'].split(":");
            // Convertimos las horas y minutos a números
            const hourNum = parseInt(hourStr, 10);
            const minuteNum = parseInt(minuteStr, 10);
            // Creamos una fecha con la fecha y hora especificadas
            const dateWithHour = new Date(dateOfWeek.getFullYear(), dateOfWeek.getMonth(), dateOfWeek.getDate(), hourNum, minuteNum);
            // Añadimos la fecha con la hora especificada al array de fechas con horas
            //datesWithHours.push(dateWithHour);
            //}

            // Devolvemos el array de fechas con horas
            return {"day":local_timestamps2(dateWithHour),"visibilidad":hour['visibilidad']};
            //return datesWithHours;
        }
        let configMesObject = ()=> {

            //console.log(horas)
            let mesObject
            let semanas
                //1 resetear los meses
                useState['formAgendaCreate']['resultset'] = []
                useState['formAgendaCreate']['agenda_month'] =[]
                meses.forEach((mes,mes_number)=>{

                    //2 Si el mes no está excluido, incluirlo en los disponibles
                    if(!useState['formAgendaCreate']['meses_excluidos'].includes(mes)){
                        mesObject = {
                            "number":mes_number,
                            "name": mes,
                            "weeks": {},
                        }
                        //3 Calculamos el total de semanas que vamos a agregar al mes
                        semanas = getWeeksInMonth(mes_number)

                        //4 Por cada semana agregamos los días
                        semanas.forEach((semana,semana_key)=>{
                            //5 Verificamos que la semana no esté excluida del mes.
                            if(!useState['formAgendaCreate']['semanas_excluidas'][mes].includes((semana_key+1))){
                                let dias_semana = []
                                    dias_nombres.forEach((dia,dia_number)=>{

                                        //6 Verificamos que el día no esté excluido de la semana
                                        if(!useState['formAgendaCreate']['dias_excluidos'].includes(dia)){
                                            // 7 creamos las horas que tendrá el día
                                            let {total_pacientes_por_horas,visibilidad,horas} = useState['formAgendaCreate']['agenda_horas'][dia_number][turno]

                                            //8 agregamos el día
                                            let temp_horas = horas.map(x=>x['hora'])
                                            dias_semana.push(
                                                {
                                                    "day": dia,
                                                    "turno":{
                                                        "horario":turno,
                                                        "I": horaAMPM(first(temp_horas)),
                                                        "F":  horaAMPM(last(temp_horas)),
                                                    },
                                                    "day_value": dia_number,
                                                    total_pacientes_por_horas,
                                                    hours:horas

                                                }
                                            )
                                        }
                                    })
                                    // 9 agregamos los días que tendrá la semana
                                    mesObject['weeks'][semana]=dias_semana
                            }
                        })
                        useState['formAgendaCreate']['agenda_month'].push(mesObject)
                    }
                })
                useState['formAgendaCreate']['agenda_month'].forEach(mes=>{
                    let year = useState['formAgendaCreate']['agenda_year']

                    for (const weekNumber) {
                        for (const keyWeek in mes['weeks'][weekNumber]) {
                            let {day_value,hours} = mes['weeks'][weekNumber][keyWeek]
                            //let horas = hours.map(x=>x['hora'])
                                for (const key_hours in hours) {

                              formAgendaCreate']['resultset'].push(getDatesOfWeekWithHours(weekNumber,year,day_value,hours[key_hours]))
                                }
                        }

                    }
                    //
                })



        }
        $('#calendar')("changeDate", function(e) {
            let {user_id_medico} = useState['formNuevaCita']
            let f = new Date(e.date);
            let anio = String(f.getFullYear())
            let mes  = String(f.getMonth()+1 ).padStart(2, '0')
            let dia  = String(f.getDate()).padStart(2, '0')
            let fechaIngreso = anio + "-" + mes + "-" + dia;
                useState['formNuevaCita']['cita_dia'] = fechaIngreso
                document.getElementById("cita_dia").value=fechaIngreso
                inputValidation2('cita_dia')
                document.getElementById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día seleccionado:</b><br><span class="badge  badge-info">${fechaCortaCustom1(e.date)}</span>
                `

            let medicoFechas =  useState['medicos'].find(medico=>equalsInt(medico['user_id_medico'],user_id_medico))['agenda']
                medicoFechas = JSON.parse(medicoFechas)
                medicoFechas =  medicoFechas.map(fecha=>{
                                    let fc = new Date(fecha['day'])
                                        return {
                                            "day": String(fc.getDate()).padStart(2, '0'),
                                            "month": String(fc.getMonth()+1).padStart(2, '0'),
                                            "year": String(fc.getFullYear()).padStart(2, '0'),
                                            "hour": String(fc.getHours()).padStart(2, '0')+":"+String(fc.getMinutes()).padStart(2, '0'),
                                            "visibilidad":fecha['visibilidad']
                                        }
                                })
                console.log("medicoFechas",medicoFechas)
            let medicoHoras = medicoFechas.filter(fecha=>{
                    if (
                        fecha['month'] === mes &&
                        fecha['day'] === dia &&
                        fecha['visibilidad'] === "publica"

                    ) {
                        return fecha
                    }
                }).map(fecha=>fecha['hour'])
                console.log("medicoHoras",medicoHoras)
                d.querySelector('#pills-am ul.nav').innerHTML =""
                if (medicoHoras.length == 0) {
                    d.querySelector('#pills-am ul.nav').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }else{
                    for(let key in medicoHoras){
                        let hora = medicoHoras[key]
                        let h = horaAMPM( hora ).toUpperCase()
                            d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora mr-1" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-pm-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-pm-${key}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    }

                }


        });
        let activarCalendario = ()=>{
            //console.log(useState['formNuevaCita'])
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            let fecha = new Date();

            let cat_especialidad_id = useState['formNuevaCita']['cat_especialidad_id'];
            let centro_salud_id = useState['formNuevaCita']['centro_salud_id'];
            let medico_id = useState['formNuevaCita']['user_id_medico'];
                //console.log(useState['formNuevaCita'])
            let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],medico_id))['agenda']
                agenda = JSON.parse(agenda)
                //agenda = Array.from(agenda)
                console.log("agenda",agenda)

                onChange_agenda_id = agenda['agenda_id']

            //let mesesDisponibles = agenda['agenda']['mes_del_anio']
            let diasDisponible =  agenda.filter(x=>x['visibilidad']==="publica").map(x=>{
                let fecha = new Date(x['day']);
                    return fecha.getFullYear() + "-" + String(fecha.getMonth()+1 ).padStart(2, '0') + "-" + String(fecha.getDate()).padStart(2, '0') +" 00:00"
            })
                console.log("diasDisponible",diasDisponible)
                /* if( is_undefined(mesesDisponibles) ){
                    return false
                } */


                $('#calendar').datepicker({
                    "language": "es",
                    "weekStart":0,
                    beforeShowYear: function(date){
                        if (date.getFullYear() !== new Date().getFullYear()) {
                            return false;
                        }
                    },
                    beforeShowMonth: function(date){
                        /* if (
                            !mesesDisponibles.includes(date.getMonth()+1) &&
                            date.getFullYear() === new Date().getFullYear()
                            ) {
                            return false;
                        } */
                    },
                    beforeShowDay: function(date){
                        // console.log("-->>",fechaAMD(date))
                        let f = new Date()
                        let fActual = new Date(f.getFullYear(), (f.getMonth() + 1), date.getDate())

                          //  console.log(fActual)
                        let feriados_mes =  feriados
                                            .find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                            //console.log("feriados_mes",feriados_mes)
                            if (!is_undefined(feriados_mes)) {
                                return {
                                    tooltip: `Feriado: ${feriados_mes['description']}`,
                                    classes: 'disabled bg-info'
                                };
                            }



                            //console.log(local_timestamps2(date))
                            if (
                                fActual.getTime() >= f.getTime() &&
                                (date.getMonth() + 1) >= (f.getMonth() + 1) &&
                                diasDisponible.includes(local_timestamps2(date))

                            ) {

                                return {
                                    tooltip: `Dia ${date.getDate()} de ${(meses(date.getMonth()))} disponible`,
                                    classes: 'today'
                                };
                            } else {
                                return {
                                    tooltip: `No existen horas disponibles este dia`,
                                    classes: 'disabled',
                                };
                            }
                    },
                });

        }
        let local_timestamps2=(date) =>{
            var hoy = new Date(date);

            return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
        }
        /* let activarCalendarioRESPALDO = ()=>{
            //console.log(useState['formNuevaCita'])
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            let fecha = new Date();

            let cat_especialidad_id = useState['formNuevaCita']['cat_especialidad_id'];
            let centro_salud_id = useState['formNuevaCita']['centro_salud_id'];
            let medico_id = useState['formNuevaCita']['user_id_medico'];
                console.log(useState['formNuevaCita'])
            let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],medico_id))

                //console.log("agenda",agenda)

                onChange_agenda_id = agenda['agenda_id']
            let mesesDisponibles = agenda['agenda']['mes_del_anio']
            let diasDisponible = agenda['agenda']['dias_del_mes']
                //console.log("agenda",mesesDisponibles)
                if( is_undefined(mesesDisponibles) ){
                    return false
                }


                $('#calendar').datepicker({
                    "language": "es",
                    "weekStart":0,
                    beforeShowYear: function(date){
                        if (date.getFullYear() !== new Date().getFullYear()) {
                            return false;
                        }
                    },
                    beforeShowMonth: function(date){
                        if (
                            !mesesDisponibles.includes(date.getMonth()+1) &&
                           r() === new Date().getFullYear()
                            ) {
                            return false;
                        }
                    },
                    beforeShowDay: function(date){
                         //console.log("-->>",fechaAMD(date))
                        let f = new Date()
                        let fActual = new Date( f.getFullYear() , (f.getMonth()+1), date.getDate() )
                        let feriados_mes =  feriados.find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                        //console.log('%chome.blade.php line:3170 diasDisponible.includes( fechaAMD(date) )', 'color: #007acc;', diasDisponible);

                        //console.log("feriados_mes",feriados_mes)

                        if (!is_undefined(feriados_mes)) {
                            return {
                                tooltip: `Feriado: ${feriados_mes['description']}`,
                                classes: 'disabled bg-info'
                            };
                        }
                        if (!is_undefined(diasDisponible)) {
                            if (
                                fActual.getTime() >=  f.getTime() &&
                                ( date.getMonth()+1 ) >= ( f.getMonth()+1 ) &&
                                diasDisponible.includes( fechaAMD(date) )

                            ) {

                                return {
                                tooltip: `Dia ${date.getDate()} de ${( meses( date.getMonth() ) )} disponible`,
                                classes: 'today'
                                };
                            }else{
                                return {
                                    tooltip: `No existen horas disponibles este dia`,
                                    classes: 'disabled',
                                    };
                            }
                        }else{
                            return {
                                tooltip: `No existen horas disponibles este dia`,
                                classes: 'disabled',
                                };
                            console.log('%chome.blade.php line:3192 diasDisponible', 'color: #007acc;', diasDisponible);
                        }
                    },
                });

        } */
        let btn_nueva_cita_veterinaria = async (e) =>{
            d.querySelector("#cargando").classList.remove("d-none")
            if (is_null(useState['user_mascota'])) {
                useState['user_mascota'] = await get( location.origin+"/user/mascota/showByUser/" + user_id_paciente);
            }
            d.querySelector("#cargando").classList.add("d-none")
            let $template = d.querySelector("#artefacto_0071").content.cloneNode(true)
                d.querySelector("#modelId .modal-body").innerHTML=null
                d.querySelector("#modelId .modal-body").append($template)

                let $listOption = d.querySelector("#modelId .modal-body .list-group")
                    $listOption.innerHTML=null
                    useState['user_mascota'].forEach(x=>{
                        $listOption.insertAdjacentHTML("afterbegin",`
                            <button type="button" data-user_mascota_id="${x['id']}" class="list-group-item list-group-item-action btn-mascota-option">${x['nombre']}</button>
                        `)
                    })
                    $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
                    $('#calendar').datepicker('destroy')
                    $('#calendar').empty();
                    document.getElementById('cita_hora').value = ""
                    document.getElementById('cita_dia').value = ""

                    Object.values([
                        /* "medicina_general", */
                        "cat_especialidad_id",
                        "centro_salud_id",
                        "user_id_medico"
                    ]).forEach(name=>{
                        d.querySelector(`select[name='${name}']`).innerHTML= null
                        let smallBadge = d.querySelector(`small.${name}`)
                            smallBadge.classList.add("d-none")


                        let selectInput = d.querySelector(`select[name='${name}']`)
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")

                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    })
                    d.querySelector('#pills-am ul.nav').innerHTML =""
                    d.querySelector('#pills-pm ul.nav').innerHTML =""
                    Object.values([
                        "cita_dia",
                        "cita_hora",
                        "cita_motivo",
                    ]).forEach(name=>{
                        let $model
                            $model = d.querySelector(`input[name='${name}']`)
                            if ( !is_null($model) ) {
                                let selectInput = d.querySelector(`input[name='${name}']`)
                                    selectInput.value=""
                                    selectInput.classList.remove("is-valid")
                                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                                    inputGroup.classList.add("bg-primary")
                                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                                    feedback.style.display = "none"
                            }
                            $model = d.querySelector(`textarea[name='${name}']`)
                            if ( !is_null($model) ) {
                                let selectInput = d.querySelector(`textarea[name='${name}']`)
                                    selectInput.value=""
                                    selectInput.classList.remove("is-valid")
                                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                                    inputGroup.classList.add("bg-primary")
                                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                                    feedback.style.display = "none"
                            }
                    })

                    useState['formNuevaCita'] = {
                        "medicina_general": "No",
                        "user_mascota_id": null,
                        "file": null,
                        "cat_especialidad_id": 80,
                        "centro_salud_id":  e.target.dataset['centro_salud_id'],
                        "user_id_medico":  e.target.dataset['user_id_medico'],
                        "cita_hora":  e.target.dataset['cita_hora'],
                        "cita_dia":  e.target.dataset['cita_dia'],
                        "cita_motivo":  e.target.dataset['cita_motivo'],
                    }
                    //console.log('%chome.blade.php line:2415 formNuevaCita', 'color: #007acc;', useState['formNuevaCita']);
                $("#modelId").modal("show")
        }
        let btn_nueva_cita = (e) =>{
            $("#modelId").modal("hide")
            let $template = d.querySelector("#artefacto_0069").content.cloneNode(true)
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            d.querySelector("#textEspecialidad").textContent="Seleccione la especialidad"
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            document.getElementById('cita_hora').value = ""
            document.getElementById('cita_dia').value = ""

            Object.values([
                /* "medicina_general", */
                "cat_especialidad_id",
                "centro_salud_id",
                "user_id_medico"
            ]).forEach(name=>{
                if (name === "medicina_general") {
                    d.querySelector("#informe_medico").value = ""
                    d.querySelector(`select[name='medicina_general']`).value = ""
                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                }else{
                    d.querySelector(`select[name='${name}']`).innerHTML= null
                    let smallBadge = d.querySelector(`small.${name}`)
                    //console.log(smallBadge)
                        smallBadge.classList.add("d-none")
                }


                let selectInput = d.querySelector(`select[name='${name}']`)
                    selectInput.classList.remove("is-valid")
                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                    inputGroup.classList.add("bg-primary")

                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                    feedback.style.display = "none"
            })
            d.querySelector('#pills-am ul.nav').innerHTML =""
            d.querySelector('#pills-pm ul.nav').innerHTML =""
            Object.values([
                "cita_dia",
                "cita_hora",
                "cita_motivo",
            ]).forEach(name=>{
                let $model
                    $model = d.querySelector(`input[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`input[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
                    $model = d.querySelector(`textarea[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`textarea[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
            })

            useState['formNuevaCita'] = {
                "user_id_paciente": Number(e.target.dataset['user_id_paciente']),
                "medicina_general": "",
                "file": d.querySelector("#informe_medico").files,
                "cat_especialidad_id": e.target.dataset['cat_especialidad_id'],
                "centro_salud_id":  e.target.dataset['centro_salud_id'],
                "user_id_medico":  e.target.dataset['user_id_medico'],
                "cita_hora":  e.target.dataset['cita_hora'],
                "cita_dia":  e.target.dataset['cita_dia'],
                "cita_motivo":  e.target.dataset['cita_motivo'],
            }

            let ignoredEsp = [91,87,88,90,86,89,31]
                cita_especialista_create({ignoredEsp})
            //$("#modelId").modal("show")
        }
        let btn_nueva_cita_familiar = (e) =>{
            $("#modelId").modal("hide")
            let $template = d.querySelector("#artefacto_0069").content.cloneNode(true)
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            d.querySelector("#textEspecialidad").textContent="Seleccione la especialidad"
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            document.getElementById('cita_hora').value = ""
            document.getElementById('cita_dia').value = ""

            Object.values([
                /* "medicina_general", */
                "cat_especialidad_id",
                "centro_salud_id",
                "user_id_medico"
            ]).forEach(name=>{
                if (name === "medicina_general") {
                    d.querySelector("#informe_medico").value = ""
                    d.querySelector(`select[name='medicina_general']`).value = ""
                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                }else{
                    d.querySelector(`select[name='${name}']`).innerHTML= null
                    let smallBadge = d.querySelector(`small.${name}`)
                    //console.log(smallBadge)
                        smallBadge.classList.add("d-none")
                }


                let selectInput = d.querySelector(`select[name='${name}']`)
                    selectInput.classList.remove("is-valid")
                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                    inputGroup.classList.add("bg-primary")

                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                    feedback.style.display = "none"
            })
            d.querySelector('#pills-am ul.nav').innerHTML =""
            d.querySelector('#pills-pm ul.nav').innerHTML =""
            Object.values([
                "cita_dia",
                "cita_hora",
                "cita_motivo",
            ]).forEach(name=>{
                let $model
                    $model = d.querySelector(`input[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`input[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
                    $model = d.querySelector(`textarea[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`textarea[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
            })

            useState['formNuevaCita'] = {
                "user_id_paciente": Number(e.target.dataset['user_id_paciente']),
                "medicina_general": "",
                "file": d.querySelector("#informe_medico").files,
                "cat_especialidad_id": e.target.dataset['cat_especialidad_id'],
                "centro_salud_id":  e.target.dataset['centro_salud_id'],
                "user_id_medico":  e.target.dataset['user_id_medico'],
                "cita_hora":  e.target.dataset['cita_hora'],
                "cita_dia":  e.target.dataset['cita_dia'],
                "cita_motivo":  e.target.dataset['cita_motivo'],
            }

            let ignoredEsp = [91,87,88,90,86,89]
                cita_especialista_create({ignoredEsp})
            //$("#modelId").modal("show")

        }
        let btn_nueva_cita_ecosonografia = (e) =>{
            $("#modelId").modal("hide")
            let $template = d.querySelector("#artefacto_0069").content.cloneNode(true)
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            d.querySelector("#textEspecialidad").textContent="Seleccione el Tipo de Ecosonografía"
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            document.getElementById('cita_hora').value = ""
            document.getElementById('cita_dia').value = ""

            Object.values([
                /* "medicina_general", */
                "cat_especialidad_id",
                "centro_salud_id",
                "user_id_medico"
            ]).forEach(name=>{
                if (name === "medicina_general") {
                    d.querySelector("#informe_medico").value = ""
                    d.querySelector(`select[name='medicina_general']`).value = ""
                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                }else{
                    d.querySelector(`select[name='${name}']`).innerHTML= null
                    let smallBadge = d.querySelector(`small.${name}`)
                    //console.log(smallBadge)
                        smallBadge.classList.add("d-none")
                }


                let selectInput = d.querySelector(`select[name='${name}']`)
                    selectInput.classList.remove("is-valid")
                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                    inputGroup.classList.add("bg-primary")

                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                    feedback.style.display = "none"
            })
            d.querySelector('#pills-am ul.nav').innerHTML =""
            d.querySelector('#pills-pm ul.nav').innerHTML =""
            Object.values([
                "cita_dia",
                "cita_hora",
                "cita_motivo",
            ]).forEach(name=>{
                let $model
                    $model = d.querySelector(`input[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`input[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
                    $model = d.querySelector(`textarea[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`textarea[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
            })

            useState['formNuevaCita'] = {
                "user_id_paciente": Number(e.target.dataset['user_id_paciente']),
                "medicina_general": "",
                "medicina_general": "",
                "file": d.querySelector("#informe_medico").files,
                "cat_especialidad_id": e.target.dataset['cat_especialidad_id'],
                "centro_salud_id":  e.target.dataset['centro_salud_id'],
                "user_id_medico":  e.target.dataset['user_id_medico'],
                "cita_hora":  e.target.dataset['cita_hora'],
                "cita_dia":  e.target.dataset['cita_dia'],
                "cita_motivo":  e.target.dataset['cita_motivo'],
            }

                let defaultEsp = [91,87,88,90,86,89]
                cita_especialista_create({defaultEsp})
            //$("#modelId").modal("show")
        }
        let cita_mensaje_inicial = (e) =>{
            let $template = d.querySelector("#artefacto_0072").content.cloneNode(true)
                d.querySelector("#modelId .modal-body").style.backgroundColor =null
                d.querySelector("#modelId .modal-body").classList.add("bg-primary")

                d.querySelector("#modelId .modal-body").innerHTML=null
                d.querySelector("#modelId .modal-body").append( $template )
                $("#modelId").modal("show")
        }
        let cita_mensaje_tarjetaSoyChacao = (e) =>{
            let $template = d.querySelector("#artefacto_0073").content.cloneNode(true)
                d.querySelector("#modelId .modal-body").style.backgroundColor =null
                d.querySelector("#modelId .modal-body").classList.add("bg-primary")

                d.querySelector("#modelId .modal-body").innerHTML=null
                d.querySelector("#modelId .modal-body").append( $template )
                $("#modelId").modal("show")
        }
        let menu_seleccion_familiar = async (e) =>{
            let familiares = useState['familiares'].filter(familiar=>
                                Number(familiar['revisado']) > 0 &&
                                Number(familiar['revisado_fecha']) !== null
                            )
            console.log("familiares",familiares)
            let {paciente} = useState
                if (familiares.length > 0) {
                    $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
                    let $template = d.querySelector("#artefacto_0070").content.cloneNode(true)
                    d.querySelector("#modelId .modal-body").innerHTML=null
                    let familiar = "";
                        familiares.forEach(x=>{
                            familiar +=`
                                <button type="button" data-option="${e.target.dataset['option']}" data-user_id_paciente="${x['user_id']}" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-familiar-create">${x['nombres']+" "+x['apellidos']}</button>
                            `
                        })
                        d.querySelector("#modelId .modal-body").insertAdjacentHTML("afterBegin",`
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-primary text-center">Seleccione el paciente</h3>
                                        <div class="list-group mb-3">
                                            <button type="button" data-option="${e.target.dataset['option']}" data-user_id_paciente="${paciente['user_id']}" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-familiar-create">${paciente['nombre']+" "+paciente['apellido']}</button>
                                            ${familiar}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    $("#modelId").modal("show")
      
                    //menu_tipo_cita(e)
                    // validar que no tenga mas de 2 citas activas
                    // let total_citas_activas = useState['citas']['activas'].length
                        //console.log("total_citas_activas",total_citas_activas);
                    // if (total_citas_activas > 1) {
                    //     Swal.fire(
                    //         'Máximo de citas activas superada.',
                    //         'No puede tener más de dos citas activas.',
                    //         'error'
                    //     )
                    //     return false
                    // }
                    if (e.target.dataset['option'] =="btn-cita-medica-create") {
                        btn_nueva_cita_familiar(e)
                    }
                    if (e.target.dataset['option'] =="btn-cita-ecosonografia") {
                        btn_nueva_cita_ecosonografia(e)
                    }
                }

        }
        let menu_tipo_cita = (e) =>{
            d.querySelector("#modelId .modal-body").classList.remove("bg-primary")
            d.querySelector("#modelId .modal-body").style.backgroundColor ="#F1F3F4 !important"
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            let $template = d.querySelector("#artefacto_0070").content.cloneNode(true)
                $template.querySelector(".btn-cita-medica-create").dataset['user_id_paciente'] = user_id_paciente
                // $template.querySelector(".btn-cita-ecosonografia").dataset['user_id_paciente'] = user_id_paciente
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            $("#modelId").modal("show")
        }
        let saveStatus = async (cita_id, status,motivo_cancelacion) =>{
            let formData = new FormData();
                if (status==3) {
                    formData.append("cancelada_por", "paciente")
                }
                formData.append("cita_id", cita_id)
                formData.append("coments2", motivo_cancelacion)
                formData.append("cat_user_cita_status_id", status)
                formData.append("_token", document.getElementById('_token').value)
                return await post( location.origin+"/consultaexterna/medico/cita/status", formData)
        }
        let handleLinkCentroSalud = (e) => {

            let location = e.currentTarget.dataset.location

            let $googleMaps = document.getElementById(`googleMaps`).content.cloneNode(true)
                $googleMaps.querySelector("iframe").src = location
                //console.log($googleMaps)
            let $modalBody = d.querySelector("#fullscreen div.modal-body-2.fullscreen")
                $modalBody.innerHTML = null
                $modalBody.append($googleMaps)

                /*
                    let $footer = document.getElementById(`footer_modal_cita`).content
                    $footer = d.importNode($footer, true);
                    $footer.querySelector(".col-md-8").classList.add("d-none")
                    let modalFooter = d.querySelector("#fullscreen div.modal-footer.fullscreen")
                    modalFooter.innerHTML = null
                    modalFooter.append($footer)
                */

                $("#fullscreen").modal("show")

        }
        let centros_salud_container = async () => {
            d.querySelector("#cargando").classList.remove("d-none")
            let formData = new FormData();
                formData.append("_token",d.querySelector("#_token").value)
                if (is_null(useState['centros_salud'])) {
                    console.log('1');
                    useState['centros_salud'] = await post(location.origin+`/consultaexterna/cat/centro_salud/getAll`,formData);
                }
            let model = useState['centros_salud']
            let container = d.querySelector("#container_centro_de_salud")
                if (model.length > 0) {
                    container.innerHTML = null
                    model.forEach(x => {
                        let card = d.querySelector("#artefacto_0065").content.cloneNode(true)
                            card.querySelector(".card-title").textContent = x['description']
                        let list_items = `<li>Sin Resultados</li>`
                        if (!is_null(x['especialidades_description'])) {
                            list_items = ""

                            let especialidades_description = Array.from( new Set( x['especialidades_description'].split(",") ) )
                                    especialidades_description.forEach(z => {

                                        list_items += `<li>${z}</li>`
                                    })
                        }
                        card.querySelector(".card-list_items").innerHTML = null
                        card.querySelector(".card-list_items").innerHTML = list_items
                        card.querySelector(".btn-location").dataset.location = x['location']
                        card.querySelector(".btn-location").addEventListener("click", e => {
                            //console.log(e.currentTarget)
                            handleLinkCentroSalud(e)
                        })
                        card.querySelector(".card-text-1").innerHTML = x['coments']
                        container.append(card)
                    })
                }
                d.querySelector("#cargando").classList.add("d-none")
        }
        let medicos_container = async () => {
            d.querando").classList.remove("d-n  let formData = new FormData();
                formData.append("_token",d.querySelector("#_token").value)
                if (is_null(useState['medicos'])) {
                    useState['medicos'] = await post(location.origin+`/consultaexterna/medicos/getAllCitas`,formData);
                }
            let model = useState['medicos']
            let container = d.querySelector("#container_medicos")
                if (model.length > 0) {
                    container.innerHdocument.getElementById('custom-tabs-9')

                d.querySelector("#cargando").classList.remove("d-none")
                useState['paciente_edit'] = first(await get( location.origin+`/consultaexterna/user/paciente/show2/${user_id_paciente}`))
                d.querySelector("#cargando").classList.add("d-none")

                if (is_null( useState['cat_estado'])) {
                    d.querySelector("#cargando").classList.remove("d-none")
                    useState['cat_estado'] = await get( location.origin+`/consultaexterna/cat/estado/getAll`)
                    d.querySelector("#cargando").classList.add("d-none")
                }
                if (is_null( useState['cat_municipio'])) {
                    d.querySelector("#cargando").classList.remove("d-none")
                    useState['cat_municipio'] = await get( location.origin+`/consultaexterna/cat/municipio/getAll`)
                    d.querySelector("#cargando").classList.add("d-none")
                }
               /*  $form.querySelector(`#no_edit_cedula`).textContent= paciente.nacionalidad+paciente.cedula
                $form.querySelector(`#no_edit_email`).textContent= paciente.email
                $form.querySelector(`#no_edit_nombres`).textContent= paciente.nombres
                $form.querySelector(`#no_edit_apellidos`).textContent= paciente.apellidos
                */
               console.log('Antes del for...', $form)
                for (const x in useState['paciente_edit']) {
                    if ([
                        'cedula',
                        'apellidos',
                        'nombres',
                        'email',
                        'description',
                        'domicilio',
                        'tarjeta_soy_chacao',
                        'fnacimiento',
                        'telefono_movil',
                    ].includes(x)) {
                        if([
                            'cedula',
                            'apellidos',
                            'nombres',
                            'email',
                        ].includes(x)){
                            $form.querySelector(`input[name='misdatos_${x}']`).style.display = "none"
                            $form.querySelector(`#no_edit_${x}`).textContent= useState['paciente_edit'][x]
                        }
                        $form.querySelector(`input[name='misdatos_${x}']`).value= useState['paciente_edit'][x]
                    }
                    if ([
                        'genero',
                        'nacionalidad',
                    ].includes(x)) {

                        $form.querySelector(`select[name='misdatos_${x}']`).value= useState['paciente_edit'][x]
                    }

                    if([
                        'genero',
                    ].includes(x)){
                        $form.querySelector(`select[name='misdatos_${x}']`).style.display = "none"
                        $form.querySelector(`#no_edit_genero`).textContent= useState['paciente_edit'][x] ==="f"? 'Femenino':'Masculino'

                    }
                    if([
                        'nacionalidad',
                    ].includes(x)){
                        $form.querySelector(`select[name='misdatos_${x}']`).style.display = "none"
                    }

                }

                telefonoConfig("#misdatos_telefono_movil")

                $form.querySelector("select[name='misdatos_cat_estado_id']").innerHTML= selectOptions(
                    useState['cat_estado'],
                    useState['paciente_edit']['cat_estado_id']
                    )

                $form.querySelector("select[name='misdatos_cat_municipio_id']").innerHTML= selectOptions(
                    useState['cat_municipio'].filter( x=>equalsInt( x['cat_estado_id'] , useState['paciente_edit']['cat_estado_id'] ) ),
                    useState['paciente_edit']['cat_municipio_id']
                )

                if (!is_null( useState['paciente_edit']['userImagen'] ) ) {
                    $form.querySelector("#misdatos_userImagenPreview").src= useState['paciente_edit']['userImagen']
                }
                if (!is_null( useState['paciente_edit']['partidaNacimiento'] ) ) {
                    $form.querySelector(`#misdatos_pn_preview iframe`).src= useState['paciente_edit']['partidaNacimiento']
                    d.querySelector(`#misdatos_pn_preview iframe`).classList.remove("d-none")
                }
                if (!is_null( useState['paciente_edit']['imgDocIdentidad']  ) ) {
                    $form.querySelector("#misdatos_imgDocIdentidadPreview").src= useState['paciente_edit']['imgDocIdentidad']
                }
                if (!is_null( useState['paciente_edit']['imgSoyChacao'] ) ) {
                    $form.querySelector("#misdatos_imgSoyChacaoPreview").src= useState['paciente_edit']['imgSoyChacao']
                }

                $("#navegacion_consulta_externa a[href='#custom-tabs-9']").tab('show')
        }
        let paciente_update = async()=>{

            let formData = new FormData();
            let $form = document.getElementById('custom-tabs-9')
                console.log(useState['formEditPaciente'])
                for (const x in useState['formEditPaciente']) {
                    console.log(x)
                    if ([
                        'cedula',
                        'apellidos',
                        'nombres',
                        'email',
                        'description',
                        'domicilio',
                        'tarjeta_soy_chacao',
                        'fnacimiento',
                        'telefono_movil',
                    ].includes(x)) {
                        formData.append(x, $form.querySelector(`input[name='misdatos_${x}']`).value )
                    }
                    if ([
                        'genero',
                        'nacionalidad',
                        'cat_estado_id',
                        'cat_municipio_id',

                    ].includes(x)) {
                        formData.append(x, $form.querySelector(`select[name='misdatos_${x}']`).value )

                    }
                    if ([
                        'imgDocIdentidad',
                        'imgSoyChacao',
                        'partidaNacimiento',
                    ].includes(x)) {
                        formData.append(x, document.getElementById(`misdatos_${x}`).files[0])
                    }
                    if ([
                        'userImagen',
                    ].includes(x)) {
                        formData.append("imagen", document.getElementById(`misdatos_${x}`).files[0])
                    }



                }
                formData.append("created_at",timestamps() );
                formData.append("_token",d.querySelector("#_token").value)
                d.querySelector("#cargando").classList.remove("d-none")
            let $response = await post("/consultaexterna/paciente/consultaExternaStore/store",formData)

                d.querySelector("#cargando").classList.add("d-none")
                if($response['success']){
                    message = "Datos actualizados correctamente";
                    Toast.fire({
                        icon: "success",
                        title: "Mis datos actualizados",
                        text: message,

                    })
                }else{
                    message = "Error al actualizar los datos";
                    Toast.fire({
                        icon: "error",
                        title: "Datos no actualizados",
                        text: message,

                    })
                }
                d.querySelector("#cargando").scrollTop = 0;

        }
        let getInitialContent = async () => {

                const content = await Promise.all([

                    //get( location.origin+"/user/getAutenticationData"),
                    //get( location.origin+"/cat/medico/getAllCitas"),
                    //get( location.origin+"/cat/centro_salud/getAll"),
                    //get( location.origin+"/cat/medico/especialidad/getAll"),
                    //get( location.origin+"/user/paciente/cita/show/" + user_id_paciente),
                    //get( location.origin+"/medico/agenda/getAll"),
                    //get( location.origin+"/cat_user_especialidad/index"),
                    //get( location.origin+"/cat/centro_salud/getAll"),


                ])
                return content
        }
        let inputValidation = (name) => {

                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                let feedback = d.querySelector(`.invalid-feedback.${name}`)

                let selectInput = d.querySelector(`select[name='${name}']`)

                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")


                    if ( name === "medicina_general") {
                        if ( ['No',"Si"].includes( selectInput.value ) ) {
                            inputGroup.classList.add("bg-success")
                            feedback.style.display = "none"
                            selectInput.classList.add("is-valid")
                        }else{
                            inputGroup.classList.add("bg-warning")
                            feedback.style.display = "block"
                            selectInput.classList.remove("is-valid")
                        }
                        return false
                    }
                   // console.log(selectInput.value)
                    if ( is_empty( selectInput.value ) ) {
                        inputGroup.classList.add("bg-warning")
                        feedback.style.display = "block"
                        selectInput.classList.remove("is-valid")
                    }else {
                        inputGroup.classList.add("bg-success")
                        feedback.style.display = "none"
                        selectInput.classList.add("is-valid")
                    }
        }
        let inputValidation2 = (name) => {

                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                let selectInput = d.querySelector(`input[name='${name}']`)

                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")

                    if ( is_empty( selectInput.value ) ) {
                        inputGroup.classList.add("bg-warning")
                        feedback.style.display = "block"
                        selectInput.classList.remove("is-valid")
                    }else {
                        inputGroup.classList.add("bg-success")
                        feedback.style.display = "none"
                        selectInput.classList.add("is-valid")
                    }
        }
        let inputValidation3 = (name) => {
            let inputGroup = d.querySelector(`.form-number-input-${name}`)
            let feedback = d.querySelector(`.invalid-feedback.${name}`)
            let selectInput = d.querySelector(`textarea[name='${name}']`)
                inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")

                if ( is_empty( selectInput.value ) ) {
                    inputGroup.classList.add("bg-warning")
                    feedback.style.display = "block"
                    selectInput.classList.remove("is-valid")
                }else {
                    inputGroup.classList.add("bg-success")
                    feedback.style.display = "none"
                    selectInput.classList.add("is-valid")
                }
        }
        let handleMedicinaHeneral = () => {
            let name = "medicina_general"
                inputValidation(name)

            let model_input = d.querySelector(`select[name='${name}']`)
                useState['formNuevaCita']['medicina_general'] = model_input.value
                /* $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
                if (useState['formNuevaCita']['medicina_general'] === "Si") {
                    d.querySelector("#carga_archivo_mensaje").classList.add("d-none")
                    d.querySelector("#carga_archivo").classList.remove("d-none")
                }else{

                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                } */
        }
        let get_medico_agenda_horas= (agenda_id,dia_del_mes)=>{
           // console.log("agenda_id",agenda_id)

            let medico_id = useState['formNuevaCita']['user_id_medico']
            let model = useState['medicos'].find(x=>equalsInt(x['user_id_medico'] , medico_id ) )
                model = model['agenda']
               // console.log("model",model)
            let { horas_am, horas_pm } = model

                if (is_undefined(horas_am)) {
                    horas_am ={}
                }
                if (is_undefined(horas_pm)) {
                    horas_am ={}
                }
            let am =[]
                if (horas_am.length > 0) {
                    am = horas_am.filter(hora => {
                        let date = new Date(hora)

                            if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                return hora
                            }
                    } )
                }else{
                    am =[]
                }
            let pm =[]
                if (horas_pm.length > 0) {
                    pm = horas_pm.filter(hora => {
                            let date = new Date(hora)
                                if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                    return hora
                                }
                        } )
                }else{
                    pm =[]
                }
            return {"horas_am": am,"horas_pm": pm}
        }
        let get_medico_agenda_horasRESPALDO= (agenda_id,dia_del_mes)=>{
           // console.log("agenda_id",agenda_id)

            let medico_id = useState['formNuevaCita']['user_id_medico']
            let model = useState['medicos'].find(x=>equalsInt(x['user_id_medico'] , medico_id ) )
                model = model['agenda']
               // console.log("model",model)
            let { horas_am, horas_pm } = model

                if (is_undefined(horas_am)) {
                    horas_am ={}
                }
                if (is_undefined(horas_pm)) {
                    horas_am ={}
                }
            let am =[]
                if (horas_am.length > 0) {
                    am = horas_am.filter(hora => {
                        let date = new Date(hora)

                            if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                return hora
                            }
                    } )
                }else{
                    am =[]
                }
            let pm =[]
                if (horas_pm.length > 0) {
                    pm = horas_pm.filter(hora => {
                            let date = new Date(hora)
                                if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                    return hora
                                }
                        } )
                }else{
                    pm =[]
                }
            return {"horas_am": am,"horas_pm": pm}
        }
        let getDatesOfWeekWithHours = (weekNumber, year, dayOfWeek, hour)=> {
            // Obtenemos la fecha del primer día del año
            const firstDayOfYear = new Date(year, 0, 1);
            // Calculamos el número de milisegundos desde el primer día del año hasta el primer día de la semana actual
            const pastDaysOfYear = (weekNumber - 1) * 7;
            // Añadimos los milisegundos al primer día del año para obtener el primer día de la semana especificada
            const firstDayOfWeek = new Date(firstDayOfYear.getTime() + (pastDaysOfYear * 24 * 60 * 60 * 1000));

            // Calculamos el número de días hasta el día de la semana especificado
            const pastDaysOfWeek = (dayOfWeek - firstDayOfWeek.getUTCDay() + 7) % 7;
            // Obtenemos la fecha del día de la semana especificado sumando los días al primer día de la semana
            const dateOfWeek = new Date(firstDayOfWeek.getTime() + (pastDaysOfWeek * 24 * 60 * 60 * 1000));

            // Creamos un array para guardar las fechas con las horas especificadas
            //const datesWithHours = [];
            // Recorremos el arreglo de horas
            //for (const hour of hours) {
            // Separamos la hora y los minutos
            const [hourStr, minuteStr] = hour['hora'].split(":");
            // Convertimos las horas y minutos a números
            const hourNum = parseInt(hourStr, 10);
            const minuteNum = parseInt(minuteStr, 10);
            // Creamos una fecha con la fecha y hora especificadas
            const dateWithHour = new Date(dateOfWeek.getFullYear(), dateOfWeek.getMonth(), dateOfWeek.getDate(), hourNum, minuteNum);
            // Añadimos la fecha con la hora especificada al array de fechas con horas
            //datesWithHours.push(dateWithHour);
            //}

            // Devolvemos el array de fechas con horas
            return {"day":local_timestamps2(dateWithHour),"visibilidad":hour['visibilidad']};
            //return datesWithHours;
        }
        let configMesObject = ()=> {

            //console.log(horas)
            let mesObject
            let semanas
                //1 resetear los meses
                useState['formAgendaCreate']['resultset'] = []
                useState['formAgendaCreate']['agenda_month'] =[]
                meses.forEach((mes,mes_number)=>{

                    //2 Si el mes no está excluido, incluirlo en los disponibles
                    if(!useState['formAgendaCreate']['meses_excluidos'].includes(mes)){
                        mesObject = {
                            "number":mes_number,
                            "name": mes,
                            "weeks": {},
                        }
                        //3 Calculamos el total de semanas que vamos a agregar al mes
                        semanas = getWeeksInMonth(mes_number)

                        //4 Por cada semana agregamos los días
                        semanas.forEach((semana,semana_key)=>{
                            //5 Verificamos que la semana no esté excluida del mes.
                            if(!useState['formAgendaCreate']['semanas_excluidas'][mes].includes((semana_key+1))){
                                let dias_semana = []
                                    dias_nombres.forEach((dia,dia_number)=>{

                                        //6 Verificamos que el día no esté excluido de la semana
                                        if(!useState['formAgendaCreate']['dias_excluidos'].includes(dia)){
                                            // 7 creamos las horas que tendrá el día
                                            let {total_pacientes_por_horas,visibilidad,horas} = useState['formAgendaCreate']['agenda_horas'][dia_number][turno]

                                            //8 agregamos el día
                                            let temp_horas = horas.map(x=>x['hora'])
                                            dias_semana.push(
                                                {
                                                    "day": dia,
                                                    "turno":{
                                                        "horario":turno,
                                                        "I": horaAMPM(first(temp_horas)),
                                                        "F":  horaAMPM(last(temp_horas)),
                                                    },
                                                    "day_value": dia_number,
                                                    total_pacientes_por_horas,
                                                    hours:horas

                                                }
                                            )
                                        }
                                    })
                                    // 9 agregamos los días que tendrá la semana
                                    mesObject['weeks'][semana]=dias_semana
                            }
                        })
                        useState['formAgendaCreate']['agenda_month'].push(mesObject)
                    }
                })
                useState['formAgendaCreate']['agenda_month'].forEach(mes=>{
                    let year = useState['formAgendaCreate']['agenda_year']

                    for (const weekNumber in mes['weeks']) {
                        for (const keyWeek in mes['weeks'][weekNumber]) {
                            let {day_value,hours} = mes['weeks'][weekNumber][keyWeek]
                            //let horas = hours.map(x=>x['hora'])
                                for (const key_hours in hours) {

                                    useState['formAgendaCreate']['resultset'].push(getDatesOfWeekWithHours(weekNumber,year,day_value,hours[key_hours]))
                                }
                        }

                    }
                    //
                })



        }
        $('#calendar').datepicker().on("changeDate", function(e) {
            let {user_id_medico} = useState['formNuevaCita']
            let f = new Date(e.date);
            let anio = String(f.getFullYear())
            let mes  = String(f.getMonth()+1 ).padStart(2, '0')
            let dia  = String(f.getDate()).padStart(2, '0')
            let fechaIngreso = anio + "-" + mes + "-" + dia;
                useState['formNuevaCita']['cita_dia'] = fechaIngreso
                document.getElementById("cita_dia").value=fechaIngreso
                inputValidation2('cita_dia')
                document.getElementById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día seleccionado:</b><br><span class="badge  badge-info">${fechaCortaCustom1(e.date)}</span>
                `

            let medicoFechas =  useState['medicos'].find(medico=>equalsInt(medico['user_id_medico'],user_id_medico))['agenda']
                medicoFechas = JSON.parse(medicoFechas)
                medicoFechas =  medicoFechas.map(fecha=>{
                                    let fc = new Date(fecha['day'])
                                        return {
                                            "day": String(fc.getDate()).padStart(2, '0'),
                                            "month": String(fc.getMonth()+1).padStart(2, '0'),
                                            "year": String(fc.getFullYear()).padStart(2, '0'),
                                            "hour": String(fc.getHours()).padStart(2, '0')+":"+String(fc.getMinutes()).padStart(2, '0'),
                                            "visibilidad":fecha['visibilidad']
                                        }
                                })
                console.log("medicoFechas",medicoFechas)
            let medicoHoras = medicoFechas.filter(fecha=>{
                    if (
                        fecha['month'] === mes &&
                        fecha['day'] === dia &&
                        fecha['visibilidad'] === "publica"

                    ) {
                        return fecha
                    }
                }).map(fecha=>fecha['hour'])
                console.log("medicoHoras",medicoHoras)
                d.querySelector('#pills-am ul.nav').innerHTML =""
                if (medicoHoras.length == 0) {
                    d.querySelector('#pills-am ul.nav').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }else{
                    for(let key in medicoHoras){
                        let hora = medicoHoras[key]
                        let h = horaAMPM( hora ).toUpperCase()
                            d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora mr-1" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-pm-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-pm-${key}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    }

                }


        });
        let activarCalendario = ()=>{
            //console.log(useState['formNuevaCita'])
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            let fecha = new Date();

            let cat_especialidad_id = useState['formNuevaCita']['cat_especialidad_id'];
            let centro_salud_id = useState['formNuevaCita']['centro_salud_id'];
            let medico_id = useState['formNuevaCita']['user_id_medico'];
                //console.log(useState['formNuevaCita'])
            let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],medico_id))['agenda']
                agenda = JSON.parse(agenda)
                //agenda = Array.from(agenda)
                console.log("agenda",agenda)

                onChange_agenda_id = agenda['agenda_id']

            //let mesesDisponibles = agenda['agenda']['mes_del_anio']
            let diasDisponible =  agenda.filter(x=>x['visibilidad']==="publica").map(x=>{
                let fecha = new Date(x['day']);
                    return fecha.getFullYear() + "-" + String(fecha.getMonth()+1 ).padStart(2, '0') + "-" + String(fecha.getDate()).padStart(2, '0') +" 00:00"
            })
                console.log("diasDisponible",diasDisponible)
                /* if( is_undefined(mesesDisponibles) ){
                    return false
                } */


                $('#calendar').datepicker({
                    "language": "es",
                    "weekStart":0,
                    beforeShowYear: function(date){
                        if (date.getFullYear() !== new Date().getFullYear()) {
                            return false;
                        }
                    },
                    beforeShowMonth: function(date){
                        /* if (
                            !mesesDisponibles.includes(date.getMonth()+1) &&
                            date.getFullYear() === new Date().getFullYear()
                            ) {
                            return false;
                        } */
                    },
                    beforeShowDay: function(date){
                        // console.log("-->>",fechaAMD(date))
                        let f = new Date()
                        let fActual = new Date(f.getFullYear(), (f.getMonth() + 1), date.getDate())

                          //  console.log(fActual)
                        let feriados_mes =  feriados
                                            .find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                            //console.log("feriados_mes",feriados_mes)
                            if (!is_undefined(feriados_mes)) {
                                return {
                                    tooltip: `Feriado: ${feriados_mes['description']}`,
                                    classes: 'disabled bg-info'
                                };
                            }



                            //console.log(local_timestamps2(date))
                            if (
                                fActual.getTime() >= f.getTime() &&
                                (date.getMonth() + 1) >= (f.getMonth() + 1) &&
                                diasDisponible.includes(local_timestamps2(date))

                            ) {

                                return {
                                    tooltip: `Dia ${date.getDate()} de ${(meses(date.getMonth()))} disponible`,
                                    classes: 'today'
                                };
                            } else {
                                return {
                                    tooltip: `No existen horas disponibles este dia`,
                                    classes: 'disabled',
                                };
                            }
                    },
                });

        }
        let local_timestamps2=(date) =>{
            var hoy = new Date(date);

            return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
        }
        /* let activarCalendarioRESPALDO = ()=>{
            //console.log(useState['formNuevaCita'])
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            let fecha = new Date();

            let cat_especialidad_id = useState['formNuevaCita']['cat_especialidad_id'];
            let centro_salud_id = useState['formNuevaCita']['centro_salud_id'];
            let medico_id = useState['formNuevaCita']['user_id_medico'];
                console.log(useState['formNuevaCita'])
            let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],medico_id))

                //console.log("agenda",agenda)

                onChange_agenda_id = agenda['agenda_id']
            let mesesDisponibles = agenda['agenda']['mes_del_anio']
            let diasDisponible = agenda['agenda']['dias_del_mes']
                //console.log("agenda",mesesDisponibles)
                if( is_undefined(mesesDisponibles) ){
                    return false
                }


                $('#calendar').datepicker({
                    "language": "es",
                    "weekStart":0,
                    beforeShowYear: function(date){
                        if (date.getFullYear() !== new Date().getFullYear()) {
                            return false;
                        }
                    },
                    beforeShowMonth: function(date){
                        if (
                            !mesesDisponibles.includes(date.getMonth()+1) &&
                            date.getFullYear() === new Date().getFullYear()
                            ) {
                            return false;
                        }
                    },
                    beforeShowDay: function(date){
                         //console.log("-->>",fechaAMD(date))
                        let f = new Date()
                        let fActual = new Date( f.getFullYear() , (f.getMonth()+1), date.getDate() )
                        let feriados_mes =  feriados.find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                        //console.log('%chome.blade.php line:3170 diasDisponible.includes( fechaAMD(date) )', 'color: #007acc;', diasDisponible);

                        //console.log("feriados_mes",feriados_mes)

                        if (!is_undefined(feriados_mes)) {
                            return {
                                tooltip: `Feriado: ${feriados_mes['description']}`,
                                classes: 'disabled bg-info'
                            };
                        }
                        if (!is_undefined(diasDisponible)) {
                            if (
                                fActual.getTime() >=  f.getTime() &&
                                ( date.getMonth()+1 ) >= ( f.getMonth()+1 ) &&
                                diasDisponible.includes( fechaAMD(date) )

                            ) {

                                return {
                                tooltip: `Dia ${date.getDate()} de ${( meses( date.getMonth() ) )} disponible`,
                                classes: 'today'
                                };
                            }else{
                                return {
                                    tooltip: `No existen horas disponibles este dia`,
                                    classes: 'disabled',
                                    };
                            }
                        }else{
                            return {
                                tooltip: `No existen horas disponibles este dia`,
                                classes: 'disabled',
                                };
                            console.log('%chome.blade.php line:3192 diasDisponible', 'color: #007acc;', diasDisponible);
                        }
                    },
                });

        } */
        let btn_nueva_cita_veterinaria = async (e) =>{
            d.querySelector("#cargando").classList.remove("d-none")
            if (is_null(useState['user_mascota'])) {
                useState['user_mascota'] = await get( location.origin+"/user/mascota/showByUser/" + user_id_paciente);
            }
            d.querySelector("#cargando").classList.add("d-none")
            let $template = d.querySelector("#artefacto_0071").content.cloneNode(true)
                d.querySelector("#modelId .modal-body").innerHTML=null
                d.querySelector("#modelId .modal-body").append($template)

                let $listOption = d.querySelector("#modelId .modal-body .list-group")
                    $listOption.innerHTML=null
                    useState['user_mascota'].forEach(x=>{
                        $listOption.insertAdjacentHTML("afterbegin",`
                            <button type="button" data-user_mascota_id="${x['id']}" class="list-group-item list-group-item-action btn-mascota-option">${x['nombre']}</button>
                        `)
                    })
                    $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
                    $('#calendar').datepicker('destroy')
                    $('#calendar').empty();
                    document.getElementById('cita_hora').value = ""
                    document.getElementById('cita_dia').value = ""

                    Object.values([
                        /* "medicina_general", */
                        "cat_especialidad_id",
                        "centro_salud_id",
                        "user_id_medico"
                    ]).forEach(name=>{
                        d.querySelector(`select[name='${name}']`).innerHTML= null
                        let smallBadge = d.querySelector(`small.${name}`)
                            smallBadge.classList.add("d-none")


                        let selectInput = d.querySelector(`select[name='${name}']`)
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")

                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    })
                    d.querySelector('#pills-am ul.nav').innerHTML =""
                    d.querySelector('#pills-pm ul.nav').innerHTML =""
                    Object.values([
                        "cita_dia",
                        "cita_hora",
                        "cita_motivo",
                    ]).forEach(name=>{
                        let $model
                            $model = d.querySelector(`input[name='${name}']`)
                            if ( !is_null($model) ) {
                                let selectInput = d.querySelector(`input[name='${name}']`)
                                    selectInput.value=""
                                    selectInput.classList.remove("is-valid")
                                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                                    inputGroup.classList.add("bg-primary")
                                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                                    feedback.style.display = "none"
                            }
                            $model = d.querySelector(`textarea[name='${name}']`)
                            if ( !is_null($model) ) {
                                let selectInput = d.querySelector(`textarea[name='${name}']`)
                                    selectInput.value=""
                                    selectInput.classList.remove("is-valid")
                                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                                    inputGroup.classList.add("bg-primary")
                                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                                    feedback.style.display = "none"
                            }
                    })

                    useState['formNuevaCita'] = {
                        "medicina_general": "No",
                        "user_mascota_id": null,
                        "file": null,
                        "cat_especialidad_id": 80,
                        "centro_salud_id":  e.target.dataset['centro_salud_id'],
                        "user_id_medico":  e.target.dataset['user_id_medico'],
                        "cita_hora":  e.target.dataset['cita_hora'],
                        "cita_dia":  e.target.dataset['cita_dia'],
                        "cita_motivo":  e.target.dataset['cita_motivo'],
                    }
                    //console.log('%chome.blade.php line:2415 formNuevaCita', 'color: #007acc;', useState['formNuevaCita']);
                $("#modelId").modal("show")
        }
        let btn_nueva_cita = (e) =>{
            $("#modelId").modal("hide")
            let $template = d.querySelector("#artefacto_0069").content.cloneNode(true)
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            d.querySelector("#textEspecialidad").textContent="Seleccione la especialidad"
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            document.getElementById('cita_hora').value = ""
            document.getElementById('cita_dia').value = ""

            Object.values([
                /* "medicina_general", */
                "cat_especialidad_id",
                "centro_salud_id",
                "user_id_medico"
            ]).forEach(name=>{
                if (name === "medicina_general") {
                    d.querySelector("#informe_medico").value = ""
                    d.querySelector(`select[name='medicina_general']`).value = ""
                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                }else{
                    d.querySelector(`select[name='${name}']`).innerHTML= null
                    let smallBadge = d.querySelector(`small.${name}`)
                    //console.log(smallBadge)
                        smallBadge.classList.add("d-none")
                }


                let selectInput = d.querySelector(`select[name='${name}']`)
                    selectInput.classList.remove("is-valid")
                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                    inputGroup.classList.add("bg-primary")

                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                    feedback.style.display = "none"
            })
            d.querySelector('#pills-am ul.nav').innerHTML =""
            d.querySelector('#pills-pm ul.nav').innerHTML =""
            Object.values([
                "cita_dia",
                "cita_hora",
                "cita_motivo",
            ]).forEach(name=>{
                let $model
                    $model = d.querySelector(`input[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`input[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
                    $model = d.querySelector(`textarea[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`textarea[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
            })

            useState['formNuevaCita'] = {
                "user_id_paciente": Number(e.target.dataset['user_id_paciente']),
                "medicina_general": "",
                "file": d.querySelector("#informe_medico").files,
                "cat_especialidad_id": e.target.dataset['cat_especialidad_id'],
                "centro_salud_id":  e.target.dataset['centro_salud_id'],
                "user_id_medico":  e.target.dataset['user_id_medico'],
                "cita_hora":  e.target.dataset['cita_hora'],
                "cita_dia":  e.target.dataset['cita_dia'],
                "cita_motivo":  e.target.dataset['cita_motivo'],
            }

            let ignoredEsp = [91,87,88,90,86,89,31]
                cita_especialista_create({ignoredEsp})
            //$("#modelId").modal("show")
        }
        let btn_nueva_cita_familiar = (e) =>{
            $("#modelId").modal("hide")
            let $template = d.querySelector("#artefacto_0069").content.cloneNode(true)
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            d.querySelector("#textEspecialidad").textContent="Seleccione la especialidad"
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            document.getElementById('cita_hora').value = ""
            document.getElementById('cita_dia').value = ""

            Object.values([
                /* "medicina_general", */
                "cat_especialidad_id",
                "centro_salud_id",
                "user_id_medico"
            ]).forEach(name=>{
                if (name === "medicina_general") {
                    d.querySelector("#informe_medico").value = ""
                    d.querySelector(`select[name='medicina_general']`).value = ""
                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                }else{
                    d.querySelector(`select[name='${name}']`).innerHTML= null
                    let smallBadge = d.querySelector(`small.${name}`)
                    //console.log(smallBadge)
                        smallBadge.classList.add("d-none")
                }


                let selectInput = d.querySelector(`select[name='${name}']`)
                    selectInput.classList.remove("is-valid")
                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                    inputGroup.classList.add("bg-primary")

                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                    feedback.style.display = "none"
            })
            d.querySelector('#pills-am ul.nav').innerHTML =""
            d.querySelector('#pills-pm ul.nav').innerHTML =""
            Object.values([
                "cita_dia",
                "cita_hora",
                "cita_motivo",
            ]).forEach(name=>{
                let $model
                    $model = d.querySelector(`input[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`input[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
                    $model = d.querySelector(`textarea[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`textarea[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
            })

            useState['formNuevaCita'] = {
                "user_id_paciente": Number(e.target.dataset['user_id_paciente']),
                "medicina_general": "",
                "file": d.querySelector("#informe_medico").files,
                "cat_especialidad_id": e.target.dataset['cat_especialidad_id'],
                "centro_salud_id":  e.target.dataset['centro_salud_id'],
                "user_id_medico":  e.target.dataset['user_id_medico'],
                "cita_hora":  e.target.dataset['cita_hora'],
                "cita_dia":  e.target.dataset['cita_dia'],
                "cita_motivo":  e.target.dataset['cita_motivo'],
            }

            let ignoredEsp = [91,87,88,90,86,89]
                cita_especialista_create({ignoredEsp})
            //$("#modelId").modal("show")

        }
        let btn_nueva_cita_ecosonografia = (e) =>{
            $("#modelId").modal("hide")
            let $template = d.querySelector("#artefacto_0069").content.cloneNode(true)
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            d.querySelector("#textEspecialidad").textContent="Seleccione el Tipo de Ecosonografía"
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            $('#calendar').datepicker('destroy')
            $('#calendar').empty();
            document.getElementById('cita_hora').value = ""
            document.getElementById('cita_dia').value = ""

            Object.values([
                /* "medicina_general", */
                "cat_especialidad_id",
                "centro_salud_id",
                "user_id_medico"
            ]).forEach(name=>{
                if (name === "medicina_general") {
                    d.querySelector("#informe_medico").value = ""
                    d.querySelector(`select[name='medicina_general']`).value = ""
                    d.querySelector("#carga_archivo_mensaje").classList.remove("d-none")
                    d.querySelector("#carga_archivo").classList.add("d-none")
                }else{
                    d.querySelector(`select[name='${name}']`).innerHTML= null
                    let smallBadge = d.querySelector(`small.${name}`)
                    //console.log(smallBadge)
                        smallBadge.classList.add("d-none")
                }


                let selectInput = d.querySelector(`select[name='${name}']`)
                    selectInput.classList.remove("is-valid")
                let inputGroup = d.querySelector(`.form-number-input-${name}`)
                    inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                    inputGroup.classList.add("bg-primary")

                let feedback = d.querySelector(`.invalid-feedback.${name}`)
                    feedback.style.display = "none"
            })
            d.querySelector('#pills-am ul.nav').innerHTML =""
            d.querySelector('#pills-pm ul.nav').innerHTML =""
            Object.values([
                "cita_dia",
                "cita_hora",
                "cita_motivo",
            ]).forEach(name=>{
                let $model
                    $model = d.querySelector(`input[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`input[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
                    $model = d.querySelector(`textarea[name='${name}']`)
                    if ( !is_null($model) ) {
                        let selectInput = d.querySelector(`textarea[name='${name}']`)
                            selectInput.value=""
                            selectInput.classList.remove("is-valid")
                        let inputGroup = d.querySelector(`.form-number-input-${name}`)
                            inputGroup.classList.remove("bg-primary", "bg-success", "bg-warning")
                            inputGroup.classList.add("bg-primary")
                        let feedback = d.querySelector(`.invalid-feedback.${name}`)
                            feedback.style.display = "none"
                    }
            })

            useState['formNuevaCita'] = {
                "user_id_paciente": Number(e.target.dataset['user_id_paciente']),
                "medicina_general": "",
                "medicina_general": "",
                "file": d.querySelector("#informe_medico").files,
                "cat_especialidad_id": e.target.dataset['cat_especialidad_id'],
                "centro_salud_id":  e.target.dataset['centro_salud_id'],
                "user_id_medico":  e.target.dataset['user_id_medico'],
                "cita_hora":  e.target.dataset['cita_hora'],
                "cita_dia":  e.target.dataset['cita_dia'],
                "cita_motivo":  e.target.dataset['cita_motivo'],
            }

                let defaultEsp = [91,87,88,90,86,89]
                cita_especialista_create({defaultEsp})
            //$("#modelId").modal("show")
        }
        let cita_mensaje_inicial = (e) =>{
            let $template = d.querySelector("#artefacto_0072").content.cloneNode(true)
                d.querySelector("#modelId .modal-body").style.backgroundColor =null
                d.querySelector("#modelId .modal-body").classList.add("bg-primary")

                d.querySelector("#modelId .modal-body").innerHTML=null
                d.querySelector("#modelId .modal-body").append( $template )
                $("#modelId").modal("show")
        }
        let cita_mensaje_tarjetaSoyChacao = (e) =>{
            let $template = d.querySelector("#artefacto_0073").content.cloneNode(true)
                d.querySelector("#modelId .modal-body").style.backgroundColor =null
                d.querySelector("#modelId .modal-body").classList.add("bg-primary")

                d.querySelector("#modelId .modal-body").innerHTML=null
                d.querySelector("#modelId .modal-body").append( $template )
                $("#modelId").modal("show")
        }
        let menu_seleccion_familiar = async (e) =>{
            let familiares = useState['familiares'].filter(familiar=>
                                Number(familiar['revisado']) > 0 &&
                                Number(familiar['revisado_fecha']) !== null
                            )
            console.log("familiares",familiares)
            let {paciente} = useState
                if (familiares.length > 0) {
                    $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
                    let $template = d.querySelector("#artefacto_0070").content.cloneNode(true)
                    d.querySelector("#modelId .modal-body").innerHTML=null
                    let familiar = "";
                        familiares.forEach(x=>{
                            familiar +=`
                                <button type="button" data-option="${e.target.dataset['option']}" data-user_id_paciente="${x['user_id']}" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-familiar-create">${x['nombres']+" "+x['apellidos']}</button>
                            `
                        })
                        d.querySelector("#modelId .modal-body").insertAdjacentHTML("afterBegin",`
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-primary text-center">Seleccione el paciente</h3>
                                        <div class="list-group mb-3">
                                            <button type="button" data-option="${e.target.dataset['option']}" data-user_id_paciente="${paciente['user_id']}" class="list-group-item list-group-item-action d-flex align-items-center btn-cita-familiar-create">${paciente['nombre']+" "+paciente['apellido']}</button>
                                            ${familiar}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    $("#modelId").modal("show")
                }else{
                    //menu_tipo_cita(e)
                    // validar que no tenga mas de 2 citas activas
                    // let total_citas_activas = useState['citas']['activas'].length
                        //console.log("total_citas_activas",total_citas_activas);
                    // if (total_citas_activas > 1) {
                    //     Swal.fire(
                    //         'Máximo de citas activas superada.',
                    //         'No puede tener más de dos citas activas.',
                    //         'error'
                    //     )
                    //     return false
                    // }
                    if (e.target.dataset['option'] =="btn-cita-medica-create") {
                        btn_nueva_cita_familiar(e)
                    }
                    if (e.target.dataset['option'] =="btn-cita-ecosonografia") {
                        btn_nueva_cita_ecosonografia(e)
                    }
                }

        }
        let menu_tipo_cita = (e) =>{
            d.querySelector("#modelId .modal-body").classList.remove("bg-primary")
            d.querySelector("#modelId .modal-body").style.backgroundColor ="#F1F3F4 !important"
            $("#navegacion_consulta_externa a[href='#custom-tabs-1']").tab('show')
            let $template = d.querySelector("#artefacto_0070").content.cloneNode(true)
                $template.querySelector(".btn-cita-medica-create").dataset['user_id_paciente'] = user_id_paciente
                // $template.querySelector(".btn-cita-ecosonografia").dataset['user_id_paciente'] = user_id_paciente
            d.querySelector("#modelId .modal-body").innerHTML=null
            d.querySelector("#modelId .modal-body").append($template)
            $("#modelId").modal("show")
        }
        let saveStatus = async (cita_id, status,motivo_cancelacion) =>{
            let formData = new FormData();
                if (status==3) {
                    formData.append("cancelada_por", "paciente")
                }
                formData.append("cita_id", cita_id)
                formData.append("coments2", motivo_cancelacion)
                formData.append("cat_user_cita_status_id", status)
                formData.append("_token", document.getElementById('_token').value)
                return await post( location.origin+"/consultaexterna/medico/cita/status", formData)
        }
        let handleLinkCentroSalud = (e) => {

            let location = e.currentTarget.dataset.location

            let $googleMaps = document.getElementById(`googleMaps`).content.cloneNode(true)
                $googleMaps.querySelector("iframe").src = location
                //console.log($googleMaps)
            let $modalBody = d.querySelector("#fullscreen div.modal-body-2.fullscreen")
                $modalBody.innerHTML = null
                $modalBody.append($googleMaps)

                /*
                    let $footer = document.getElementById(`footer_modal_cita`).content
                    $footer = d.importNode($footer, true);
                    $footer.querySelector(".col-md-8").classList.add("d-none")
                    let modalFooter = d.querySelector("#fullscreen div.modal-footer.fullscreen")
                    modalFooter.innerHTML = null
                    modalFooter.append($footer)
                */

                $("#fullscreen").modal("show")

        }
        let centros_salud_container = async () => {
            d.querySelector("#cargando").classList.remove("d-none")
            let formData = new FormData();
                formData.append("_token",d.querySelector("#_token").value)
                if (is_null(useState['centros_salud'])) {
                    console.log('1');
                    useState['centros_salud'] = await post(location.origin+`/consultaexterna/cat/centro_salud/getAll`,formData);
                }
            let model = useState['centros_salud']
            let container = d.querySelector("#container_centro_de_salud")
                if (model.length > 0) {
                    container.innerHTML = null
                    model.forEach(x => {
                        let card = d.querySelector("#artefacto_0065").content.cloneNode(true)
                            card.querySelector(".card-title").textContent = x['description']
                        let list_items = `<li>Sin Resultados</li>`
                        if (!is_null(x['especialidades_description'])) {
                            list_items = ""

                            let especialidades_description = Array.from( new Set( x['especialidades_description'].split(",") ) )
                                    especialidades_description.forEach(z => {

                                        list_items += `<li>${z}</li>`
                                    })
                        }
                        card.querySelector(".card-list_items").innerHTML = null
                        card.querySelector(".card-list_items").innerHTML = list_items
                        card.querySelector(".btn-location").dataset.location = x['location']
                        card.querySelector(".btn-location").addEventListener("click", e => {
                            //console.log(e.currentTarget)
                            handleLinkCentroSalud(e)
                        })
                        card.querySelector(".card-text-1").innerHTML = x['coments']
                        container.append(card)
                    })
                }
                d.querySelector("#cargando").classList.add("d-none")
        }
        let medicos_container = async () => {
            d.querySelector("#cargando").classList.remove("d-none")
            let formData = new FormData();
                formData.append("_token",d.querySelector("#_token").value)
                if (is_null(useState['medicos'])) {
                    useState['medicos'] = await post(location.origin+`/consultaexterna/medicos/getAllCitas`,formData);
                }
            let model = useState['medicos']
            let container = d.querySelector("#container_medicos")
                if (model.length > 0) {
                    container.innerHTML = null
     