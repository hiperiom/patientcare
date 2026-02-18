<!DOCTYPE html>
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        @yield('title')
    </title>
    <!-- INICIO LIMPIAR CACHE -->
    {{-- <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache"> --}}
    <!-- FIN LIMPIAR CACHE -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#185BA9">
    <meta name="MobiledObtimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    {{-- <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css"> --}}
    <link rel="apple-touch-startup-image" href="{{ asset('/image/system/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/image/system/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/image/system/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/image/system/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/image/system/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/image/system/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/image/system/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/image/system/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/image/system/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/image/system/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('/image/system/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/image/system/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/image/system/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/image/system/favicon/favicon-16x16.png') }}">
    <link rel="stylesheet" href="https://icdcdn.who.int/embeddedct/icd11ect-1.3.css">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="{{ asset('#ffffff') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/ms-icon-144x144.png') }}">



    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/bootstrap-4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <style>
        :root {
            --primary: #185BA9;
            --blue: var(--primary);
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #f278b0;
            --red: #DC3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #ffffff;
            --gray: #D9D9D9;
            --gray-dark: #343a40;

            --secondary: #6c757d;
            --success: #2FA600;
            --info: #00AAFF;
            --warning: #b18607;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --parodis: #1DBA9B;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
        }

        .text-gray {
            color: #6c757d !important;
        }

        li.menuArea a {
            color: var(--secondary);
            text-decoration: none;
            background-color: transparent;
            font-weight: 600;
        }

        .btn-primary {
            color: #ffffff;
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: none;
        }

        .btn-primary:hover {
            color: #ffffff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-primary:focus,
        .btn-primary.focus {
            color: #ffffff;
            background-color: var(--blue);
            border-color: var(--blue);
            box-shadow: none, 0 0 0 0 rgba(38, 143, 255, 0.5);
        }

        .btn-primary.disabled,
        .btn-primary:disabled {
            color: #ffffff;
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:not(:disabled):not(.disabled):active,
        .btn-primary:not(:disabled):not(.disabled).active,
        .show>.btn-primary.dropdown-toggle {
            color: #ffffff;
            background-color: #0062cc;
            border-color: #005cbf;
        }

        .btn-primary:not(:disabled):not(.disabled):active:focus,
        .btn-primary:not(:disabled):not(.disabled).active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0 rgba(38, 143, 255, 0.5);
        }

        .badge-primary {
            color: #ffffff;
            background-color: var(--primary);
        }

        a.badge-primary:hover,
        a.badge-primary:focus {
            color: #ffffff;
            background-color: #0062cc;
        }

        .badge-pink {
            color: #ffffff;
            background-color: #f278b0;
        }

        a.badge-primary:focus,
        a.badge-primary.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        a.bg-primary:hover,
        a.bg-primary:focus,
        button.bg-primary:hover,
        button.bg-primary:focus {
            background-color: #0062cc !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        a.text-primary:hover,
        a.text-primary:focus {
            color: var(--primary) !important;
        }

        .timeline {
            margin: 0 0 45px;
            padding: 0;
            position: relative;
        }

        .timeline>div {
            margin-bottom: 15px;
            margin-right: 10px;
            position: relative;
        }

        .timeline>div::before,
        .timeline>div::after {
            content: "";
            display: table;
        }

        .timeline::before {
            border-radius: 0.25rem;
            background: #dee2e6;
            bottom: 0;
            content: '';
            left: 31px;
            margin: 0;
            position: absolute;
            top: 0;
            width: 4px;
        }

        .timeline>div>.fa,
        .timeline>div>.fas,
        .timeline>div>.far,
        .timeline>div>.fab,
        .timeline>div>.glyphicon,
        .timeline>div>.ion {
            background: #adb5bd;
            border-radius: 50%;
            font-size: 15px;
            height: 30px;
            left: 18px;
            line-height: 30px;
            position: absolute;
            text-align: center;
            top: 0;
            width: 30px;
        }

        .timeline>.time-label>span {
            border-radius: 4px;
            background-color: #ffffff;
            color: white;
            display: inline-block;
            font-weight: 600;
            padding: 5px;
            font-size: 0.5em;
        }

        .timeline>div>.timeline-item {
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            border-radius: 0.25rem;
            background: #ffffff;
            color: #495057;
            margin-left: 60px;
            margin-right: 15px;
            margin-top: 0;
            padding: 0;
            position: relative;
        }

        .timeline-inverse>div>.timeline-item {
            box-shadow: none;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .timeline>div>.timeline-item>.time {
            color: #999;
            float: right;
            font-size: 12px;
            padding: 10px;
        }

        .timeline-inverse>div>.timeline-item>.timeline-header {
            border-bottom-color: #dee2e6;
        }

        .timeline>div>.timeline-item>.timeline-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            color: #495057;
            font-size: 16px;
            line-height: 1.1;
            margin: 0;
            padding: 10px;
        }

        .timeline>div>.timeline-item>.timeline-body,
        .timeline>div>.timeline-item>.timeline-footer {
            padding: 10px;
        }

        .timeline>div>.timeline-item>.timeline-body,
        .timeline>div>.timeline-item>.timeline-footer {
            padding: 10px;
        }
        input:focus{
            outline-color: var(--secondary) !important;
        }
        .shadow-inset-center:hover{-webkit-animation:shadow-inset-center .4s cubic-bezier(.25,.46,.45,.94) both;animation:shadow-inset-center .4s cubic-bezier(.25,.46,.45,.94) both}
        @-webkit-keyframes shadow-inset-center{0%{border:1px solid transparent; -webkit-box-shadow:inset 0 0 0 0 transparent;box-shadow:inset 0 0 0 0 transparent}100%{border:2px solid var(--secondary); -webkit-box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%);box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%)}}@keyframes shadow-inset-center{0%{border:1px solid transparent; -webkit-box-shadow:inset 0 0 0 0 transparent;box-shadow:inset 0 0 0 0 transparent}100%{border:1px solid var(--secondary); -webkit-box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%);;box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%);}}    </style>
    {{-- <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css') }}">
    {{--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
    <!-- Theme style -->
    {{--     <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}">
        <link href="/css/scale.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{ asset('css/stylePatientcare.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('image/system/icomoon/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('image/system/icomoon3/style.css') }}">
    <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">

    <link href="/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">

    <style>
        .loadingScreen {
            background-color: rgba(0, 0, 0, .5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: fixed;
            z-index: 1111111111111111;
            height: 100vh;
            width: 100%;
        }
        .vh-100 {
            height: 100vh;
        }

        .h-img-custom-1 {
            height: 1.8em;
        }

        .h-img-custom-2 {
            height: 3em;
        }


        .glassmod-effect {
            background-color: rgb(255 255 255 / 50%);
            backdrop-filter: blur(20px);
        }

        .rounded-pill {
            border-radius: 30px !important
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0em;
            vertical-align: 0em;
            content: "";
            border-top: 0em solid;
            border-right: 0em solid transparent;
            border-bottom: 0;
            border-left: 0em solid transparent;
        }

        .select2-container {

            width: 20em !important;

        }

        .heartbeat_infinity {
            -webkit-animation: heartbeat2 1.5s ease-in-out infinite both;
            animation: heartbeat2 1.5s ease-in-out infinite both
        }

        @-webkit-keyframes hea@rtbeat2 {
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

        .prealta {

            -webkit-animation: mymove 2s infinite;
            /* Chrome, Safari, Opera */
            animation: mymove 2s infinite;
        }

        /* Chrome, Safari, Opera */
        @-webkit-keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        /* Standard syntax */
        @keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        #menu-pad>.nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--success);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--success);
        }

        #menu-pad>.badge-gray {
            background-color: var(--white) !important;
        }

        #menu-pad.bg-light,
        .bg-light>a {
            color: var(--primary) !important;
        }

        .datepicker table tr td.active.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled.disabled,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active.disabled:hover.active,
        .datepicker table tr td.active.disabled:hover.disabled,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.disabled:hover:hover,
        .datepicker table tr td.active.disabled:hover[disabled],
        .datepicker table tr td.active.disabled[disabled],
        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active:hover.disabled,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active:hover:hover,
        .datepicker table tr td.active:hover[disabled],
        .datepicker table tr td.active[disabled] {
            background-color: var(--primary) !important;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -ms-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(var(--primary)), to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -o-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: linear-gradient(to bottom, var(--primary), var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }

        .next,
        .prev,
        .datepicker-switch,
        .dow {
            color: var(--primary) !important;
        }

        .datepicker-inline {
            width: 100%;
        }



        button.card-user-admin-serv {
            border: 1px solid rgb(203, 203, 203);
            color: var(--secondary);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            transition-duration: 0.3s;
        }

        button.card-user-admin-serv .status {
            color: var(--primary);
        }

        button.card-user-admin-serv .status::before {
            content: 'Activar' !important;
        }

        button.card-user-admin-serv.active,
        button.card-user-admin-serv:hover,
        button.card-user-admin-serv:focus {
            border: 1px solid rgb(203, 203, 203) !important;
            color: var(--white);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            outline: 5px auto white;
        }

        button.card-user-admin-serv.active .status,
        button.card-user-admin-serv:hover .status,
        button.card-user-admin-serv:focus .status {
            color: var(--secondary);
        }

        button.card-user-admin-serv.info.active,
        button.card-user-admin-serv.info:hover,
        button.card-user-admin-serv.info:focus {
            background-color: var(--info);
        }

        button.card-user-admin-serv.success.active,
        button.card-user-admin-serv.success:hover,
        button.card-user-admin-serv.success:focus {
            background-color: var(--success);
        }

        button.card-user-admin-serv.primary.active,
        button.card-user-admin-serv.primary:hover,
        button.card-user-admin-serv.primary:focus {
            background-color: var(--primary);
        }

        button.card-user-admin-serv:focus .status::before {
            content: 'Desactivar' !important;
        }

        .card-user-admin-serv b.title {
            font-size: 1.1rem;
        }

        .card-user-admin-serv.active {
            border: 5px inset var(--secondary)
        }

        .card-user-admin-serv i.icon-check {
            display: none;
        }

        .card-user-admin-serv.active i.icon-check {
            display: block;
        }

        .card-user-admin-serv i.icon-no-check {
            display: block;
        }

        .card-user-admin-serv.active i.icon-no-check {
            display: none;
        }

        .card-user-admin-serv i.icon-no-check,
        .card-user-admin-serv i.icon-check {
            font-size: 3em;
        }

        .card-description {
            background: rgb(52 58 64 / 20%);
            border-radius: 10px;
            padding: 0.5rem;
        }
    </style>
    <style>
        /* .modal-body-2 .tab-content>.tab-pane {
                display: flex !important;
            } */
        .text-gray {
            color: #6c757d !important;
        }

        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }

        .text-orange {
            color: #fd7e14 !important;
        }

        .text-purple {
            color: #6f42c1 !important;
        }

        .sticky-top {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .menu-nivel-4 {
            background-color: var(--gray);
            text-align: center;
            padding: 0.5rem !important;
            top: -1px;
            color: var(--secondary) !important;
        }

        .img-logo {
            height: 50px;
            width: 120px;
        }

        .img-user-size {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .btn-user-home button {
            background-color: transparent;
            display: flex;
            color: white;
            align-items: center;
            border: 0px;
        }

        .btn-user-home button:focus {
            outline: 1px dotted;
            outline: 0px !important;
        }

        .btn-user-home .username {
            font-weight: bold;
            font-size: 1rem;
            text-wrap: nowrap;
            overflow: hidden;
            width: 117px;
            /*border: 1px solid red;*/
        }

        .sv-hover {
            padding: 10px;
            border-radius: 10px;
        }

        .sv-hover:hover {
            background-color: #d6d6d6;
        }

        .width-custom {
            width: auto;
        }

        @media (min-width: 576px) {
            .btn-user-home .username {
                font-weight: bold;
                font-size: 1.5rem;
                text-wrap: nowrap;
                overflow: hidden;
                width: auto;
                /*border: 1px solid red;*/
            }

        }

        .btn_home_sidebar:hover {
            background-color: #0e52a1;
        }

        .card-primary.card-outline {
            border-top: 3px solid var(--primary);
        }

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }

        .collapsed-card .card-header {
            border-bottom: 0;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            position: relative;
        }

        .card-title {
            float: left;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
        }

        .show .btn-tool,
        .btn-tool:focus {
            box-shadow: none !important;
        }

        .btn-tool {
            background: transparent;
            color: #adb5bd;
            font-size: 0.875rem;
            margin: -0.75rem 0;
            padding: 0.25rem 0.5rem;
        }

        .card-header::after,
        .card-body::after,
        .card-footer::after {
            display: block;
            clear: both;
            content: "";
        }

        .user-block img {
            float: left;
            height: 40px;
            width: 40px;
        }

        .user-block .description {
            color: #6c757d;
            font-size: 13px;
            margin-top: -3px;
        }

        .btn-light {
            color: var(--secondary);
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }

        .btn-transparent {
            background-color: transparent;
            color: var(--secondary) !important;
        }

        .btn-link {
            font-weight: 400;
            color: var(--secondary);
            text-decoration: none !important;
        }

        .btn-link b {
            font-size: 0.8rem;

        }

        .post .user-block {
            margin-bottom: 15px;
            width: 100%;
        }

        .user-block {
            float: left;
        }

        .mailbox-attachments {
            padding-left: 0;
            list-style: none;
        }

        .mailbox-attachment-icon.has-img {
            padding: 0;
        }

        .mailbox-attachments li {
            border: 1px solid #eee;
            float: left;
            margin-bottom: 10px;
            margin-right: 10px;
            width: 200px;
        }

        .mailbox-attachment-icon {
            color: #666;
            font-size: 65px;
            max-height: 132.5px;
            padding: 20px 10px;
            text-align: center;
        }

        .mailbox-attachment-icon,
        .mailbox-attachment-info,
        .mailbox-attachment-size {
            display: block;
        }

        .mailbox-attachment-size {
            color: #999;
            font-size: 12px;
        }

        .mailbox-attachment-info {
            background: #f8f9fa;
            padding: 10px;
        }

        .btn-small-custom {
            padding: 0.2% !important;
            font-size: 0.8rem !important;
            /*line-height: 1.5;
                border-radius: 0.2rem; */
        }

        .modal-loading {
            position: absolute;
            width: 100%;
            background-color: rgb(89 88 88 / 10%);
            height: 100%;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            /* text-shadow: 4px 4px 2px rgba(0,0,0,0.6); */
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6);
        }
    </style>
    <style>
        button.card-user-admin-serv {
            border: 1px solid rgb(203, 203, 203);
            color: var(--secondary);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            transition-duration: 0.3s;
        }

        button.card-user-admin-serv .status {
            color: var(--primary);
        }

        button.card-user-admin-serv .status::before {
            content: 'Activar' !important;
        }

        button.card-user-admin-serv.active,
        button.card-user-admin-serv:hover,
        button.card-user-admin-serv:focus {
            border: 1px solid rgb(203, 203, 203) !important;
            color: var(--white);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            outline: 5px auto white;
        }

        button.card-user-admin-serv.active .status,
        button.card-user-admin-serv:hover .status,
        button.card-user-admin-serv:focus .status {
            color: var(--secondary);
        }

        button.card-user-admin-serv.info.active,
        button.card-user-admin-serv.info:hover,
        button.card-user-admin-serv.info:focus {
            background-color: var(--info);
        }

        button.card-user-admin-serv.success.active,
        button.card-user-admin-serv.success:hover,
        button.card-user-admin-serv.success:focus {
            background-color: var(--success);
        }

        button.card-user-admin-serv.primary.active,
        button.card-user-admin-serv.primary:hover,
        button.card-user-admin-serv.primary:focus {
            background-color: var(--primary);
        }

        button.card-user-admin-serv:focus .status::before {
            content: 'Desactivar' !important;
        }

        .card-user-admin-serv b.title {
            font-size: 1.1rem;
        }

        .card-user-admin-serv.active {
            border: 5px inset var(--secondary)
        }

        .card-user-admin-serv i.icon-check {
            display: none;
        }

        .card-user-admin-serv.active i.icon-check {
            display: block;
        }

        .card-user-admin-serv i.icon-no-check {
            display: block;
        }

        .card-user-admin-serv.active i.icon-no-check {
            display: none;
        }

        .card-user-admin-serv i.icon-no-check,
        .card-user-admin-serv i.icon-check {
            font-size: 3em;
        }

        .card-description {
            background: rgb(52 58 64 / 20%);
            border-radius: 10px;
            padding: 0.5rem;
        }
    </style>
    <style>
        .h-100 {
            height: 100vh !important;
        }

        .small-title {
            font-size: 0.7rem;
        }

        .card-prealta {
            display: none;
        }

        .btn-prealta {
            display: flex;
        }

        .btn-prealta.active {
            display: none;
        }

        .card-prealta {
            display: none;
        }

        .card-prealta.active {
            display: flex;
        }

        /*.bg-light{
              background-color: #E1E1E1 !important;
            }
            .bg-gray{
              background-color: #CBCDD0 !important;
            }*/
        .bg-gray {
            background-color: var(--gray) !important;
        }

        .img-user-circle {
            width: 50px;
            height: 50px;
            border-radius: 50px
        }

        .text-user-name {
            font-weight: 500;
            font-size: 1.2rem;
        }

        .tag-box {
            font-size: 0.7rem
        }

        .btn-outline-gray {
            color: var(--secondary);
            border-color: var(--gray);
        }

        .btn-outline-gray:hover {
            background-color: var(--gray);
            color: var(--secondary);
            border-color: var(--gray);
        }
    </style>
    <style>
        /* body {
              background-color:whitesmoke;
            }
            .h-100{
              height: 100vh !important;
            }

            .text-gray{
              color:gray;
            } */
        .gap-1 {
            gap: 0.2rem;
        }

        .input-full-height {
            height: 100%;
            resize: none;
        }

        .last-result-box {
            background-color: whitesmoke;
            /* height:40px; */
        }

        .w-last-result-box {
            width: 100%;
        }

        .btn-outline-gray {
            color: var(--secondary);
            border-color: var(--gray);
        }

        .btn-outline-gray:hover {
            background-color: var(--gray);
            color: var(--white);
            border-color: var(--gray);
        }

        /* .w-custom-1 {
              width:200px;
            } */
        .border-custom-1 {
            border-top: 0px;
            border-right: 0px;
            border-left: 0px;
            border-bottom: 1px solid #dee2e6 !important;
        }

        .height-100 {
            height: 100%;
        }

        .w-custom-1 {
            width: 150px;
        }

        /* .collapseVitalsign .collapse.show {
                display:block;
            } */
        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {}

        /* // Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) {
            .w-last-result-box {
                width: 100%;
            }

            .height-100 {
                height: auto;
            }

        }

        /* // Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {
            .width-custom {
                width: 350px;
                ;
            }

            .border-custom-1 {
                border-top: 0px;
                border-right: 1px solid #dee2e6 !important;
                border-left: 0px;
                border-bottom: 0px !important;
            }

            /* .collapseVitalsign .collapse.show {
                display:flex;
              } */
        }

        /* // Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .w-custom-1 {
                width: 100%;
            }

            .collapseVitalsign.collapse:not(.show) {
                display: block !important;
            }
        }

        .badge-pink {
            color: #ffffff;
            background-color: #f278b0;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
    <style>
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0em;
            vertical-align: 0em;
            content: "";
            border-top: 0em solid;
            border-right: 0em solid transparent;
            border-bottom: 0;
            border-left: 0em solid transparent;
        }

        .select2-container {

            width: 20em !important;

        }

        .heartbeat_infinity {
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

        .prealta {

            -webkit-animation: mymove 2s infinite;
            /* Chrome, Safari, Opera */
            animation: mymove 2s infinite;
        }

        /* Chrome, Safari, Opera */
        @-webkit-keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        /* Standard syntax */
        @keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        #menu-pad>.nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--success);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--success);
        }

        #menu-pad>.badge-gray {
            background-color: var(--white) !important;
        }

        #menu-pad.bg-light,
        .bg-light>a {
            color: var(--primary) !important;
        }

        .datepicker table tr td.active.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled.disabled,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active.disabled:hover.active,
        .datepicker table tr td.active.disabled:hover.disabled,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.disabled:hover:hover,
        .datepicker table tr td.active.disabled:hover[disabled],
        .datepicker table tr td.active.disabled[disabled],
        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active:hover.disabled,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active:hover:hover,
        .datepicker table tr td.active:hover[disabled],
        .datepicker table tr td.active[disabled] {
            background-color: var(--primary) !important;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -ms-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(var(--primary)), to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -o-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: linear-gradient(to bottom, var(--primary), var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }

        .next,
        .prev,
        .datepicker-switch,
        .dow {
            color: var(--primary) !important;
        }

        .datepicker-inline {
            width: 100%;
        }
    </style>
</head>

<body>
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <div class="d-flex flex-column overflow-auto vh-100">
            <div id="loadingScreen" class="loadingScreen d-none">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <img
                        loading="lazy"
                        onerror="this.src='/image/system/patient.svg'"
                        src="/image/system/logo-cmdlt-blanco.svg"
                        alt="Cmdlt"
                        class="mb-3"
                        style="width: 140px; height: 80px;"
                    >
                    <div class="d-flex align-items-center text-white justify-content-center">
                    <div role="status" class="spinner-border">
                        <span class="visually-hidden"></span>
                    </div>
                    <h4 class="pl-2">Por favor espere un momento...</h4>
                </div>
            </div>
        </div>
        <nav class="d-flex justify-content-between bg-primary rounded-pill m-1 ">
            <div class="btn-user-home d-flex align-items-center">
                <button onclick="location.href='/auth/menu_inicial_principal'" class="btn_home_sidebar rounded-pill">
                    <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i
                            class="fas fa-bars text-white"></i></span>
                    <div class="d-flex align-items-center ">
                        <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-user-size"
                            src="{{ session('userData')['imagen'] }}">
                        <span
                            class="ml-1 mr-3 align-items-start justify-content-center d-flex flex-column overflow-hidden"
                            style="line-height: 1.1;">
                            <i class="message-wellcome">
                                @if (isset(session('userData')['genero']) && session('userData')['genero'] == 'f')
                                    ¡Bienvenida!
                                @else
                                    ¡Bienvenido!
                                @endif
                            </i>
                            <div class="username text-left">
                                {{ !is_null(session('userData')['prefijo']) && session('userData')['prefijo'] !== 'null' ? session('userData')['prefijo'] : '' }}
                                {{ session('userData')['nombre'] }} {{ session('userData')['apellido'] }}</div>
                        </span>
                    </div>

                </button>
                <!-- otros items -->
                {{-- <span  class="principal-menu-toggle btn" id="menu-toggle-right"></span> --}}
            </div>
            <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
        </nav>
        <nav class="row bg-light rounded border mx-1 mb-1">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 p-1 orden-1 overflow-auto"
                id="cat_user_ubicacion_menu">
                <ul id="App_nav_menu_areas" class="nav nav-pills flex-nowrap" role="tablist">
                </ul>
            </div>
            <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xl-2 order-4 order-lg-2 p-1">
                <button id="btn_paciente_create" onclick="window.location='/medico/create_paciente'"
                    class="btn btn-success btn-block text-nowrap rounded font-weight-bold btn-block">Nuevo
                    Paciente</button>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-8 col-xl-8 d-none d-md-block order-2 order-lg-2 p-1">
                <div class="d-flex justify-content-end" id="btnNotificaciones"></div>
            </div>
            <div class="col-7 col-sm-8 col-md-4 col-lg-4 col-xl-4 p-1 order-2 ">
                <input type="search" class="form-control" id="busquedapaciente" placeholder="Buscar paciente..."
                    aria-label="Buscar paciente..." aria-describedby="button-addon2">
            </div>
            <div class="col-12 row order-4 align-items-center">
                <div id="titleArea" class="mx-2 text-primary font-weight-bold text-nowrap">
                    <button
                        data-tippy-content="Pulse para ver el Equipo Médico en el área"
                        type="button"
                        class="btn btn-light btn-block"
                    >
                        <span
                            id="areaName"
                            style="font-weight:bold;color:var(--primary)!important"
                        >
                        </span>
                    </button>
                </div>
                <div id="signosP" class="col marquee-with-options" style="height: 30px;">
                    <marquee class="cursor-pointer" onmouseout="this.start()" onmouseover="this.stop()"
                        scrollamount="5" style="width:100%"></marquee>
                </div>
            </div>

        </nav>
        <div id="AppRowVitalSign" class="d-flex flex-wrap  rounded border mx-1 overflow-auto">

        </div>

    </div>

    <!-- Modal -->

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="height: 90vh;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal" src="/image/system/logo-cmdlt-blanco.png">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>
                <!-- style="height: 80vh;" -->
                <div class="modal-body">
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="doctorsListModal" style="z-index: 100000;" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content d-flex flex-column vh-100">
                <div class="modal-header d-flex align-items-center justify-content-between text-white">
                    <h5 class="modal-title" id="doctorsListModalLabel">Modal title</h5>
                    <button type="button" class="btn btn-default p-1" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-3 container-fluid p-0 d-flex flex-column overflow-auto">
                    <div id="modalLoading" class="modal-loading d-none">
                        <div class="d-flex">
                            <div class="spinner-border mr-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div>
                                Por favor, espera un momento...
                            </div>

                        </div>
                    </div>
                    <div class="flex-fill d-flex flex-wrap overflow-auto">
                        <div class="order-2 order-md-1 col-12 col-sm-12 col-md-6 d-flex flex-column  overflow-auto">
                            <h4 class="title_create text-dark">Añadir nuevo Tratante:</h4>
                            <input type="search" id="modal_search_medico" placeholder="Buscar médico..."
                                class="form-control">
                            <div class="alert alert-success my-1">
                                <b>Pulsa</b> en un médico del siguiente listado para asignarlo al paciente.
                            </div>
                            <div class="flex-fill   overflow-auto">
                                <ul id="modal-listado_medicos"
                                    class="mt-1 border rounded border-gray list-group list-group-flush overflow-auto col-listado-paciente-height">

                                </ul>
                            </div>
                            <div id="total_result" class="text-center">

                            </div>
                        </div>
                        <div class="order-1 order-md-2 col-12 col-sm-12 col-md-6 d-flex flex-column overflow-auto">
                            <h4 class="title_index text-dark">Equipo Tratante:</h4>
                            <div class="flex-fill   overflow-auto">
                                <ul id="modal-listado_medicos_asignados"
                                    class="mt-1  rounded border-gray list-group list-group-flush overflow-auto col-listado-paciente-height">

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
                    <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modal-patient-item" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content d-flex flex-column overflow-auto vh-100">
                <div class="modal-header p-0">
                    <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;"
                            aria-hidden="true"></i>

                        <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                    </nav>
                </div>
                <div class="modal-body-2 container-fluid  fullscreen d-flex flex-column overflow-auto">

                </div>

            </div>
        </div>
    </div>
    <!-- ModalMensajes -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <img src="/image/system/logo-cmdlt_color.svg" style="height: 3em;" class="img-fluid float-right"
                        alt="Imagen CMDLT">
                    <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                </div>
            </div>
        </div>
    </div>
    <template id="historia_inicial">
        <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
        <div style="margin-top: 190px !important;" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3 class="text-primary">Historia Preliminar de Emergencia</h3>
                </div>
                <div class="col-md-4">
                    <div id="cardInfoPaciente1"></div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Signos Vitales</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="signosVitales" class="card-body p-0"
                            style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">PESO</span>
                                        </div>
                                        <input name="user_peso" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">Kg.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">TALLA</span>
                                        </div>
                                        <input name="user_talla" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">Cm.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">TEMP.</span>
                                        </div>
                                        <input name="user_temperatura" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">°C</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">OXI</span>
                                        </div>
                                        <input name="user_oximetria" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">F.C.</span>
                                        </div>
                                        <input name="user_fc" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">lat/min</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">F.R.</span>
                                        </div>
                                        <input name="user_fr" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">resp/min</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">GL.</span>
                                        </div>
                                        <input name="user_glic" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">mg/dL</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">
                                    <div class="input-group m-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">T.A.</span>
                                        </div>
                                        <input name="user_ta_sis" placeholder="Sistólica" type="text"
                                            aria-label="First name" class="form-control rounded-0 border-0">
                                        <input name="user_ta_dia" placeholder="Diastólica" type="text"
                                            aria-label="Last name" class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">mmHg</span>
                                        </div>
                                    </div>

                                </li>


                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente requerirá:
                            </h3>
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
                                        <select class="form-control border-0" name="caso_tipo_medico"
                                            id="caso_tipo_medico">
                                            <option value="">Seleccione</option>
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                </li>
                                <li class="list-group-item p-1">
                                    <div class="form-group mb-0">
                                        <label class="text-gray mb-0" for="">Clasificación del Triaje:</label>
                                        <select class="form-control border-0" name="nivel_triaje" id="nivel_triaje">
                                            <option value="">Seleccione</option>
                                            <option value="1">Nivel 1</option>
                                            <option value="2">Nivel 2</option>
                                            <option value="3">Nivel 3</option>
                                            <option value="4">Nivel 4</option>
                                            <option value="5">Nivel 5</option>
                                        </select>
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>


                </div>
                <div id="datos_ingreso" class="col-md-8">


                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus" data-card-widget="collapse"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Escriba aquí por qué el paciente acudió a la emergencia"
                                name="user_motivo_consulta" id="user_problema_salud" rows="3"></textarea>

                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Antecedentes
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Escriba aquí los antecedentes del paciente"
                                name="user_antecedentes" id="user_antecedentes" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Describa aquí el problema de salud actual"
                                name="user_enfermedad_actual" id="user_problema_salud" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea"
                                placeholder="Describa brevemente los hallazgos positivos del examen físico realizado." name="user_examen_fisico"
                                id="user_examen_fisico" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Problema de ingreso
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Escriba aquí el diagnóstico presuntivo del paciente"
                                name="user_diagnostico_presuntivo" id="user_diagnostico_presuntivo" rows="3"></textarea>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <button id="guardarHistoriaInicial" type="button" class="btn btn-success btn-block mb-1"
                        {{-- data-dismiss="modal" --}}>Guardar</button>
                </div>
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </template>
    <template id="historialEpisodios">
        <section class="content my-1">
            <h1 class="text-primary">Historia de Episodios</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overlay-wrapper">
                            <div class="overlay text-primary d-none">
                                <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
                                <div class="text-bold pt-2">
                                    Espere un momento por favor...
                                </div>
                            </div>
                            <div id=episodes>
                                <div id="episode_1" class="card card-outline card-primary mb-1 collapsed-card">
                                    <div class="card-header cursor-pointer overflow-auto" data-card-widget="collapse">
                                        <div class="user-block">
                                            <div class="d-flex align-items-end">
                                                <div class="px-3 border-right">
                                                    <div class="m-0 description">
                                                        Episodio
                                                    </div>
                                                    <div class="text-center">
                                                        <a id="user_fullname" href="#"
                                                            class="h4 text-primary font-weight-bold">
                                                            1
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="px-1">
                                                    <img id="user_image" class="img-circle"
                                                        src="/AdminLTE-3.2.0/dist/img/user1-128x128.jpg"
                                                        alt="User Image">
                                                </div>
                                                <div class="px-1 border-right">
                                                    <div>
                                                        <a id="user_fullname" href="#"
                                                            class="font-weight-bold">
                                                            Jonathan Burke Jr.
                                                        </a>
                                                    </div>
                                                    <div class="m-0 description">
                                                        <b>Cédula:</b> <span id="user_document_id">00.000.000</span>
                                                    </div>
                                                </div>
                                                <div class="px-1 border-right">
                                                    <div class="m-0 description">
                                                        <b>Ingreso:</b> <span
                                                            id="episode_admision_date">01/01/2022</span>
                                                    </div>
                                                    <div class="m-0 description">
                                                        <b>Egreso:</b> <span
                                                            id="episode_departure_date">10/01/2022</span>
                                                    </div>
                                                </div>
                                                <div class="px-1">
                                                    <div class="m-0 description">
                                                        <b>Días de Hospitalización:</b> <span
                                                            id="episode_num_days">8</span>
                                                    </div>
                                                    <div class="m-0 description">
                                                        <b>Ubicación:</b>
                                                        <span id="episode_num_days">Pad Covid - 1</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool text-primary"
                                                data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-2" style="display: none;">

                                        <div class="row">
                                            <div class="col-5 col-sm-3">
                                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab"
                                                    role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link active" id="vert-tabs-home-tab"
                                                        data-toggle="pill" href="#vert-tabs-home" role="tab"
                                                        aria-controls="vert-tabs-home"
                                                        aria-selected="true">Laboratorio</a>
                                                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                                        href="#vert-tabs-profile" role="tab"
                                                        aria-controls="vert-tabs-profile"
                                                        aria-selected="false">Imagen</a>
                                                    <a class="nav-link" id="vert-tabs-messages-tab"
                                                        data-toggle="pill" href="#vert-tabs-messages" role="tab"
                                                        aria-controls="vert-tabs-messages"
                                                        aria-selected="false">Fotografía
                                                        <span class="badge badge-primary">1</span></a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings" aria-selected="false">Otros
                                                        Archivo <span class="badge badge-primary">4</span></a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Probabilidad Diagnóstica
                                                        <span class="badge badge-primary">1</span></a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Evolución</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Plan</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Récipe</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Estudio
                                                        Diagnóstico</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Comorbilidad</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Informe</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings" aria-selected="false">Orden
                                                        Médica</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Monitoreo
                                                        indicadores</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">PAD</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Doctores</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Historia
                                                        Inicial</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Ubicaciones</a>
                                                </div>
                                            </div>
                                            <div class="col-7 col-sm-9">
                                                <div class="tab-content" id="vert-tabs-tabContent">
                                                    <div class="tab-pane text-left fade active show"
                                                        id="vert-tabs-home" role="tabpanel"
                                                        aria-labelledby="vert-tabs-home-tab">
                                                        <div class="post">
                                                            <div class="user-block">
                                                                <img class="img-circle img-bordered-sm"
                                                                    src="/AdminLTE-3.2.0/dist/img/user8-128x128.jpg"
                                                                    alt="user-img 128x128">
                                                                <span class="username">
                                                                    <a href="#">Jonathan Burke Jr.</a>
                                                                    <a href="#" class="float-right btn-tool"><i
                                                                            class="fas fa-times"></i></a>
                                                                </span>
                                                                <span class="description">Shared publicly - 7:30 PM
                                                                    today</span>
                                                            </div>
                                                            <!-- /.user-block -->
                                                            <p>
                                                                Lorem ipsum represents a long-held tradition for
                                                                designers,
                                                                typographers and the like. Some people hate it and argue
                                                                for
                                                                its demise, but others ignore the hate as they create
                                                                awesome
                                                                tools to help create filler text for everyone from bacon
                                                                lovers
                                                                to Charlie Sheen fans.
                                                            </p>
                                                            <div class="card-footer bg-white">
                                                                <ul
                                                                    class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                                    <li>
                                                                        <span class="mailbox-attachment-icon"><i
                                                                                class="far fa-file-pdf"></i></span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name"><i
                                                                                    class="fas fa-paperclip"></i>
                                                                                Sep2014-report.pdf</a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>1,245 KB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <span
                                                                            class="mailbox-attachment-icon has-img"><img
                                                                                src="/AdminLTE-3.2.0/dist/img/photo1.png"
                                                                                alt="Attachment"></span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name"><i
                                                                                    class="fas fa-camera"></i>
                                                                                photo1.png</a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>2.67 MB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <span class="mailbox-attachment-icon has-img">
                                                                            <img src="/AdminLTE-3.2.0/dist/img/photo2.png"
                                                                                alt="Attachment">
                                                                        </span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name">
                                                                                <i class="fas fa-camera"></i>
                                                                                photo2.png
                                                                            </a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>1.9 MB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <span class="mailbox-attachment-icon">
                                                                            <i class="far fa-file-word"></i>
                                                                        </span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name"><i
                                                                                    class="fas fa-paperclip"></i> App
                                                                                Description.docx</a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>1,245 KB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                                        aria-labelledby="vert-tabs-profile-tab">

                                                    </div>
                                                    <div class="tab-pane fade" id="vert-tabs-messages"
                                                        role="tabpanel" aria-labelledby="vert-tabs-messages-tab">

                                                    </div>
                                                    <div class="tab-pane fade" id="vert-tabs-settings"
                                                        role="tabpanel" aria-labelledby="vert-tabs-settings-tab">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row justify-content-center">

                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary btn-block"
                                data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <template id="cargando">
        <div id="carga" class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Espere un momento por favor...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <script>
        function filterPacientes(texto){
            // Convertir el texto a minúsculas para hacer la búsqueda insensible a mayúsculas y minúsculas
            const textoMinusculas = texto.toLowerCase();

            // Obtener todos los elementos div dentro del elemento con el id "row_pacientes"
            const divs = document.querySelectorAll('#AppRowVitalSign div.row-paciente');

            // Iterar sobre cada div
            divs.forEach(div => {
            // Obtener el texto dentro del div y convertirlo a minúsculas
                const textoDiv = div.innerHTML.toLowerCase();
                // Mostrar o ocultar el div según si el texto buscado está presente en el texto del div
                if (textoDiv.includes(textoMinusculas)) {
                    div.style.display = 'block'; // Mostrar el div
                } else {
                    div.style.display = 'none'; // Ocultar el div
                }
            });
        }
        document.getElementById("busquedapaciente").addEventListener("change",(e)=>{
            const textoBuscado = e.target.value; // Texto que deseas buscar
            filterPacientes(textoBuscado);
        })
    </script>
</body>
@php
    $version = '1.0.6';
@endphp
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> --}}

<script src="{{ asset('AdminLTE-3.0.5/plugins/jquery/jquery.min.js') }}"></script>
{{-- <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.min.js" ></script> --}}
<script src="/js/sweetalert2@10.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="/bootstrap-4.6.2/js/bootstrap.bundle.min.js"></script>
{{-- <script src="/AdminLTE-3.2.0/plugins/popper/popper.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/2.5.4/tippy.all.js" integrity="sha512-jIIh0z4fzfV4cFju6uTH2QY9Q/UrRd09aa35FKbh759/sl4VyIlA9JMbjM3nSFLNESeiih6pzDlsB4GLd0JZlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="/js/select2.min.js"></script> --}}

{{-- <script src="/js/tippy-bundle.umd.min.js"></script> --}}
<script src="/js/select2.min.js"></script>
<script src="/plugin/intl-tel-input/build/js/intlTelInput.js"></script>
<script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
<script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.es.min.js"></script>


<script src="/js/scripts.js?{{ $version }}"></script>
<script src="/class_js/CatUserEspecialidad.js?{{ $version }}"></script>
<script src="/class_js/CatUserEstado.js?{{ $version }}"></script>
<script src="/class_js/CatUserMunicipio.js?{{ $version }}"></script>
<script src="/class_js/CatUserUbicacion.js?{{ $version }}"></script>
<script src="/class_js/Component.js?{{ $version }}"></script>
<script src="/class_js/User.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAntecedente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAntg.js?{{ $version }}"></script>
<script src="/class_js/UserCuestChat.js?{{ $version }}"></script>
<script src="/class_js/UserCuestDireccion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEstudioDiagnostico.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEvolucion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFc.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFichaMedica.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFotografia.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFr.js?{{ $version }}"></script>
<script src="/class_js/UserCuestGl.js?{{ $version }}"></script>
<script src="/class_js/UserCuestHistoria.js?{{ $version }}"></script>
<script src="/class_js/UserCuestImagen.js?{{ $version }}"></script>
<script src="/class_js/UserCuestImpresionDiagnostica.js?{{ $version }}"></script>
<script src="/class_js/UserCuestIncidencia.js?{{ $version }}"></script>
<script src="/class_js/UserCuestInforme.js?{{ $version }}"></script>
<script src="/class_js/UserCuestLaboratorio.js?{{ $version }}"></script>
<script src="/class_js/UserCuestObservacion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOtroArchivo.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOxigenoterapia.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOximetria.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPaciente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPad.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPcr.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPdr.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPendiente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPlan.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPruebaCovid.js?{{ $version }}"></script>
<script src="/class_js/UserCuestRecipe.js?{{ $version }}"></script>
<script src="/class_js/UserCuestSintoma.js?{{ $version }}"></script>
<script src="/class_js/UserCuestTa.js?{{ $version }}"></script>
<script src="/class_js/UserCuestTac.js?{{ $version }}"></script>
<script src="/class_js/UserCuestTemperatura.js?{{ $version }}"></script>
<script src="/class_js/UserCuestUbicacion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestValoracion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestVinculoInstitucion.js?{{ $version }}"></script>
<script src="/class_js/UserEquipoSalud.js?{{ $version }}"></script>
<script src="/class_js/UserEspecialidad.js?{{ $version }}"></script>
<script src="/class_js/UserFamily.js?{{ $version }}"></script>
<script src="/class_js/UserMedico.js?{{ $version }}"></script>
<script src="/class_js/UserProfile.js?{{ $version }}"></script>
<script src="/class_js/UserType.js?{{ $version }}"></script>
<script src="/class_js/UserCuestMedicoPaciente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestComorbilidad.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEpisodio.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEgreso.js?{{ $version }}"></script>
<script src="/class_js/SystemIncidencia.js?{{ $version }}"></script>
<script src="/class_js/UserMedicoPosicion.js?{{ $version }}"></script>
<script src="/class_js/UserPostCovid.js?{{ $version }}"></script>
<script src="/class_js/UserEncuesta.js?{{ $version }}"></script>
<script src="/class_js/UserVIP.js?{{ $version }}"></script>
<script src="/class_js/UserMedicoAgenda.js?{{ $version }}"></script>
<script src="/class_js/UserProblemaSalud.js?{{ $version }}"></script>
<script src="/class_js/UserEnfermedadActual.js?{{ $version }}"></script>
<script src="/class_js/UserExamenFisico.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOrdenMedica.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAlert.js?{{ $version }}"></script>
<script src="/class_js/UserCuestResbalar.js?{{ $version }}"></script>
<script src="/class_js/UserCuestRiesgoQuirurgico.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAdministracion.js?{{ $version }}"></script>
<script src="/vue/vue.js"></script>


<script>
    let d = document
    let component = new Component()
        component.ViewEnfermeria()

</script>


<script>

    let nombreIdModal = "doctorsListModal"
    let modal = <!DOCTYPE html>
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        @yield('title')
    </title>
    <!-- INICIO LIMPIAR CACHE -->
    {{-- <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache"> --}}
    <!-- FIN LIMPIAR CACHE -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#185BA9">
    <meta name="MobiledObtimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    {{-- <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css"> --}}
    <link rel="apple-touch-startup-image" href="{{ asset('/image/system/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/image/system/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/image/system/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/image/system/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/image/system/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/image/system/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/image/system/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/image/system/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/image/system/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/image/system/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('/image/system/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/image/system/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/image/system/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/image/system/favicon/favicon-16x16.png') }}">
    <link rel="stylesheet" href="https://icdcdn.who.int/embeddedct/icd11ect-1.3.css">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="{{ asset('#ffffff') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/ms-icon-144x144.png') }}">



    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/bootstrap-4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <style>
        :root {
            --primary: #185BA9;
            --blue: var(--primary);
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #f278b0;
            --red: #DC3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #ffffff;
            --gray: #D9D9D9;
            --gray-dark: #343a40;

            --secondary: #6c757d;
            --success: #2FA600;
            --info: #00AAFF;
            --warning: #b18607;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --parodis: #1DBA9B;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
        }

        .text-gray {
            color: #6c757d !important;
        }

        li.menuArea a {
            color: var(--secondary);
            text-decoration: none;
            background-color: transparent;
            font-weight: 600;
        }

        .btn-primary {
            color: #ffffff;
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: none;
        }

        .btn-primary:hover {
            color: #ffffff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-primary:focus,
        .btn-primary.focus {
            color: #ffffff;
            background-color: var(--blue);
            border-color: var(--blue);
            box-shadow: none, 0 0 0 0 rgba(38, 143, 255, 0.5);
        }

        .btn-primary.disabled,
        .btn-primary:disabled {
            color: #ffffff;
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:not(:disabled):not(.disabled):active,
        .btn-primary:not(:disabled):not(.disabled).active,
        .show>.btn-primary.dropdown-toggle {
            color: #ffffff;
            background-color: #0062cc;
            border-color: #005cbf;
        }

        .btn-primary:not(:disabled):not(.disabled):active:focus,
        .btn-primary:not(:disabled):not(.disabled).active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0 rgba(38, 143, 255, 0.5);
        }

        .badge-primary {
            color: #ffffff;
            background-color: var(--primary);
        }

        a.badge-primary:hover,
        a.badge-primary:focus {
            color: #ffffff;
            background-color: #0062cc;
        }

        .badge-pink {
            color: #ffffff;
            background-color: #f278b0;
        }

        a.badge-primary:focus,
        a.badge-primary.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        a.bg-primary:hover,
        a.bg-primary:focus,
        button.bg-primary:hover,
        button.bg-primary:focus {
            background-color: #0062cc !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        a.text-primary:hover,
        a.text-primary:focus {
            color: var(--primary) !important;
        }

        .timeline {
            margin: 0 0 45px;
            padding: 0;
            position: relative;
        }

        .timeline>div {
            margin-bottom: 15px;
            margin-right: 10px;
            position: relative;
        }

        .timeline>div::before,
        .timeline>div::after {
            content: "";
            display: table;
        }

        .timeline::before {
            border-radius: 0.25rem;
            background: #dee2e6;
            bottom: 0;
            content: '';
            left: 31px;
            margin: 0;
            position: absolute;
            top: 0;
            width: 4px;
        }

        .timeline>div>.fa,
        .timeline>div>.fas,
        .timeline>div>.far,
        .timeline>div>.fab,
        .timeline>div>.glyphicon,
        .timeline>div>.ion {
            background: #adb5bd;
            border-radius: 50%;
            font-size: 15px;
            height: 30px;
            left: 18px;
            line-height: 30px;
            position: absolute;
            text-align: center;
            top: 0;
            width: 30px;
        }

        .timeline>.time-label>span {
            border-radius: 4px;
            background-color: #ffffff;
            color: white;
            display: inline-block;
            font-weight: 600;
            padding: 5px;
            font-size: 0.5em;
        }

        .timeline>div>.timeline-item {
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            border-radius: 0.25rem;
            background: #ffffff;
            color: #495057;
            margin-left: 60px;
            margin-right: 15px;
            margin-top: 0;
            padding: 0;
            position: relative;
        }

        .timeline-inverse>div>.timeline-item {
            box-shadow: none;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .timeline>div>.timeline-item>.time {
            color: #999;
            float: right;
            font-size: 12px;
            padding: 10px;
        }

        .timeline-inverse>div>.timeline-item>.timeline-header {
            border-bottom-color: #dee2e6;
        }

        .timeline>div>.timeline-item>.timeline-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            color: #495057;
            font-size: 16px;
            line-height: 1.1;
            margin: 0;
            padding: 10px;
        }

        .timeline>div>.timeline-item>.timeline-body,
        .timeline>div>.timeline-item>.timeline-footer {
            padding: 10px;
        }

        .timeline>div>.timeline-item>.timeline-body,
        .timeline>div>.timeline-item>.timeline-footer {
            padding: 10px;
        }
        input:focus{
            outline-color: var(--secondary) !important;
        }
        .shadow-inset-center:hover{-webkit-animation:shadow-inset-center .4s cubic-bezier(.25,.46,.45,.94) both;animation:shadow-inset-center .4s cubic-bezier(.25,.46,.45,.94) both}
        @-webkit-keyframes shadow-inset-center{0%{border:1px solid transparent; -webkit-box-shadow:inset 0 0 0 0 transparent;box-shadow:inset 0 0 0 0 transparent}100%{border:2px solid var(--secondary); -webkit-box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%);box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%)}}@keyframes shadow-inset-center{0%{border:1px solid transparent; -webkit-box-shadow:inset 0 0 0 0 transparent;box-shadow:inset 0 0 0 0 transparent}100%{border:1px solid var(--secondary); -webkit-box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%);;box-shadow:inset 0 0 14px 0 rgb(202 202 202 / 50%);}}    </style>
    {{-- <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css') }}">
    {{--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
    <!-- Theme style -->
    {{--     <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}">
        <link href="/css/scale.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{ asset('css/stylePatientcare.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('image/system/icomoon/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('image/system/icomoon3/style.css') }}">
    <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">

    <link href="/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">

    <style>
        .loadingScreen {
            background-color: rgba(0, 0, 0, .5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: fixed;
            z-index: 1111111111111111;
            height: 100vh;
            width: 100%;
        }
        .vh-100 {
            height: 100vh;
        }

        .h-img-custom-1 {
            height: 1.8em;
        }

        .h-img-custom-2 {
            height: 3em;
        }


        .glassmod-effect {
            background-color: rgb(255 255 255 / 50%);
            backdrop-filter: blur(20px);
        }

        .rounded-pill {
            border-radius: 30px !important
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0em;
            vertical-align: 0em;
            content: "";
            border-top: 0em solid;
            border-right: 0em solid transparent;
            border-bottom: 0;
            border-left: 0em solid transparent;
        }

        .select2-container {

            width: 20em !important;

        }

        .heartbeat_infinity {
            -webkit-animation: heartbeat2 1.5s ease-in-out infinite both;
            animation: heartbeat2 1.5s ease-in-out infinite both
        }

        @-webkit-keyframes hea@rtbeat2 {
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

        .prealta {

            -webkit-animation: mymove 2s infinite;
            /* Chrome, Safari, Opera */
            animation: mymove 2s infinite;
        }

        /* Chrome, Safari, Opera */
        @-webkit-keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        /* Standard syntax */
        @keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        #menu-pad>.nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--success);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--success);
        }

        #menu-pad>.badge-gray {
            background-color: var(--white) !important;
        }

        #menu-pad.bg-light,
        .bg-light>a {
            color: var(--primary) !important;
        }

        .datepicker table tr td.active.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled.disabled,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active.disabled:hover.active,
        .datepicker table tr td.active.disabled:hover.disabled,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.disabled:hover:hover,
        .datepicker table tr td.active.disabled:hover[disabled],
        .datepicker table tr td.active.disabled[disabled],
        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active:hover.disabled,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active:hover:hover,
        .datepicker table tr td.active:hover[disabled],
        .datepicker table tr td.active[disabled] {
            background-color: var(--primary) !important;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -ms-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(var(--primary)), to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -o-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: linear-gradient(to bottom, var(--primary), var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }

        .next,
        .prev,
        .datepicker-switch,
        .dow {
            color: var(--primary) !important;
        }

        .datepicker-inline {
            width: 100%;
        }



        button.card-user-admin-serv {
            border: 1px solid rgb(203, 203, 203);
            color: var(--secondary);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            transition-duration: 0.3s;
        }

        button.card-user-admin-serv .status {
            color: var(--primary);
        }

        button.card-user-admin-serv .status::before {
            content: 'Activar' !important;
        }

        button.card-user-admin-serv.active,
        button.card-user-admin-serv:hover,
        button.card-user-admin-serv:focus {
            border: 1px solid rgb(203, 203, 203) !important;
            color: var(--white);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            outline: 5px auto white;
        }

        button.card-user-admin-serv.active .status,
        button.card-user-admin-serv:hover .status,
        button.card-user-admin-serv:focus .status {
            color: var(--secondary);
        }

        button.card-user-admin-serv.info.active,
        button.card-user-admin-serv.info:hover,
        button.card-user-admin-serv.info:focus {
            background-color: var(--info);
        }

        button.card-user-admin-serv.success.active,
        button.card-user-admin-serv.success:hover,
        button.card-user-admin-serv.success:focus {
            background-color: var(--success);
        }

        button.card-user-admin-serv.primary.active,
        button.card-user-admin-serv.primary:hover,
        button.card-user-admin-serv.primary:focus {
            background-color: var(--primary);
        }

        button.card-user-admin-serv:focus .status::before {
            content: 'Desactivar' !important;
        }

        .card-user-admin-serv b.title {
            font-size: 1.1rem;
        }

        .card-user-admin-serv.active {
            border: 5px inset var(--secondary)
        }

        .card-user-admin-serv i.icon-check {
            display: none;
        }

        .card-user-admin-serv.active i.icon-check {
            display: block;
        }

        .card-user-admin-serv i.icon-no-check {
            display: block;
        }

        .card-user-admin-serv.active i.icon-no-check {
            display: none;
        }

        .card-user-admin-serv i.icon-no-check,
        .card-user-admin-serv i.icon-check {
            font-size: 3em;
        }

        .card-description {
            background: rgb(52 58 64 / 20%);
            border-radius: 10px;
            padding: 0.5rem;
        }
    </style>
    <style>
        /* .modal-body-2 .tab-content>.tab-pane {
                display: flex !important;
            } */
        .text-gray {
            color: #6c757d !important;
        }

        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }

        .text-orange {
            color: #fd7e14 !important;
        }

        .text-purple {
            color: #6f42c1 !important;
        }

        .sticky-top {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .menu-nivel-4 {
            background-color: var(--gray);
            text-align: center;
            padding: 0.5rem !important;
            top: -1px;
            color: var(--secondary) !important;
        }

        .img-logo {
            height: 50px;
            width: 120px;
        }

        .img-user-size {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .btn-user-home button {
            background-color: transparent;
            display: flex;
            color: white;
            align-items: center;
            border: 0px;
        }

        .btn-user-home button:focus {
            outline: 1px dotted;
            outline: 0px !important;
        }

        .btn-user-home .username {
            font-weight: bold;
            font-size: 1rem;
            text-wrap: nowrap;
            overflow: hidden;
            width: 117px;
            /*border: 1px solid red;*/
        }

        .sv-hover {
            padding: 10px;
            border-radius: 10px;
        }

        .sv-hover:hover {
            background-color: #d6d6d6;
        }

        .width-custom {
            width: auto;
        }

        @media (min-width: 576px) {
            .btn-user-home .username {
                font-weight: bold;
                font-size: 1.5rem;
                text-wrap: nowrap;
                overflow: hidden;
                width: auto;
                /*border: 1px solid red;*/
            }

        }

        .btn_home_sidebar:hover {
            background-color: #0e52a1;
        }

        .card-primary.card-outline {
            border-top: 3px solid var(--primary);
        }

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }

        .collapsed-card .card-header {
            border-bottom: 0;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            position: relative;
        }

        .card-title {
            float: left;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
        }

        .show .btn-tool,
        .btn-tool:focus {
            box-shadow: none !important;
        }

        .btn-tool {
            background: transparent;
            color: #adb5bd;
            font-size: 0.875rem;
            margin: -0.75rem 0;
            padding: 0.25rem 0.5rem;
        }

        .card-header::after,
        .card-body::after,
        .card-footer::after {
            display: block;
            clear: both;
            content: "";
        }

        .user-block img {
            float: left;
            height: 40px;
            width: 40px;
        }

        .user-block .description {
            color: #6c757d;
            font-size: 13px;
            margin-top: -3px;
        }

        .btn-light {
            color: var(--secondary);
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }

        .btn-transparent {
            background-color: transparent;
            color: var(--secondary) !important;
        }

        .btn-link {
            font-weight: 400;
            color: var(--secondary);
            text-decoration: none !important;
        }

        .btn-link b {
            font-size: 0.8rem;

        }

        .post .user-block {
            margin-bottom: 15px;
            width: 100%;
        }

        .user-block {
            float: left;
        }

        .mailbox-attachments {
            padding-left: 0;
            list-style: none;
        }

        .mailbox-attachment-icon.has-img {
            padding: 0;
        }

        .mailbox-attachments li {
            border: 1px solid #eee;
            float: left;
            margin-bottom: 10px;
            margin-right: 10px;
            width: 200px;
        }

        .mailbox-attachment-icon {
            color: #666;
            font-size: 65px;
            max-height: 132.5px;
            padding: 20px 10px;
            text-align: center;
        }

        .mailbox-attachment-icon,
        .mailbox-attachment-info,
        .mailbox-attachment-size {
            display: block;
        }

        .mailbox-attachment-size {
            color: #999;
            font-size: 12px;
        }

        .mailbox-attachment-info {
            background: #f8f9fa;
            padding: 10px;
        }

        .btn-small-custom {
            padding: 0.2% !important;
            font-size: 0.8rem !important;
            /*line-height: 1.5;
                border-radius: 0.2rem; */
        }

        .modal-loading {
            position: absolute;
            width: 100%;
            background-color: rgb(89 88 88 / 10%);
            height: 100%;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            /* text-shadow: 4px 4px 2px rgba(0,0,0,0.6); */
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6);
        }
    </style>
    <style>
        button.card-user-admin-serv {
            border: 1px solid rgb(203, 203, 203);
            color: var(--secondary);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            transition-duration: 0.3s;
        }

        button.card-user-admin-serv .status {
            color: var(--primary);
        }

        button.card-user-admin-serv .status::before {
            content: 'Activar' !important;
        }

        button.card-user-admin-serv.active,
        button.card-user-admin-serv:hover,
        button.card-user-admin-serv:focus {
            border: 1px solid rgb(203, 203, 203) !important;
            color: var(--white);
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            line-height: 1;
            padding: 0.5rem;
            box-sizing: content-box;
            outline: 5px auto white;
        }

        button.card-user-admin-serv.active .status,
        button.card-user-admin-serv:hover .status,
        button.card-user-admin-serv:focus .status {
            color: var(--secondary);
        }

        button.card-user-admin-serv.info.active,
        button.card-user-admin-serv.info:hover,
        button.card-user-admin-serv.info:focus {
            background-color: var(--info);
        }

        button.card-user-admin-serv.success.active,
        button.card-user-admin-serv.success:hover,
        button.card-user-admin-serv.success:focus {
            background-color: var(--success);
        }

        button.card-user-admin-serv.primary.active,
        button.card-user-admin-serv.primary:hover,
        button.card-user-admin-serv.primary:focus {
            background-color: var(--primary);
        }

        button.card-user-admin-serv:focus .status::before {
            content: 'Desactivar' !important;
        }

        .card-user-admin-serv b.title {
            font-size: 1.1rem;
        }

        .card-user-admin-serv.active {
            border: 5px inset var(--secondary)
        }

        .card-user-admin-serv i.icon-check {
            display: none;
        }

        .card-user-admin-serv.active i.icon-check {
            display: block;
        }

        .card-user-admin-serv i.icon-no-check {
            display: block;
        }

        .card-user-admin-serv.active i.icon-no-check {
            display: none;
        }

        .card-user-admin-serv i.icon-no-check,
        .card-user-admin-serv i.icon-check {
            font-size: 3em;
        }

        .card-description {
            background: rgb(52 58 64 / 20%);
            border-radius: 10px;
            padding: 0.5rem;
        }
    </style>
    <style>
        .h-100 {
            height: 100vh !important;
        }

        .small-title {
            font-size: 0.7rem;
        }

        .card-prealta {
            display: none;
        }

        .btn-prealta {
            display: flex;
        }

        .btn-prealta.active {
            display: none;
        }

        .card-prealta {
            display: none;
        }

        .card-prealta.active {
            display: flex;
        }

        /*.bg-light{
              background-color: #E1E1E1 !important;
            }
            .bg-gray{
              background-color: #CBCDD0 !important;
            }*/
        .bg-gray {
            background-color: var(--gray) !important;
        }

        .img-user-circle {
            width: 50px;
            height: 50px;
            border-radius: 50px
        }

        .text-user-name {
            font-weight: 500;
            font-size: 1.2rem;
        }

        .tag-box {
            font-size: 0.7rem
        }

        .btn-outline-gray {
            color: var(--secondary);
            border-color: var(--gray);
        }

        .btn-outline-gray:hover {
            background-color: var(--gray);
            color: var(--secondary);
            border-color: var(--gray);
        }
    </style>
    <style>
        /* body {
              background-color:whitesmoke;
            }
            .h-100{
              height: 100vh !important;
            }

            .text-gray{
              color:gray;
            } */
        .gap-1 {
            gap: 0.2rem;
        }

        .input-full-height {
            height: 100%;
            resize: none;
        }

        .last-result-box {
            background-color: whitesmoke;
            /* height:40px; */
        }

        .w-last-result-box {
            width: 100%;
        }

        .btn-outline-gray {
            color: var(--secondary);
            border-color: var(--gray);
        }

        .btn-outline-gray:hover {
            background-color: var(--gray);
            color: var(--white);
            border-color: var(--gray);
        }

        /* .w-custom-1 {
              width:200px;
            } */
        .border-custom-1 {
            border-top: 0px;
            border-right: 0px;
            border-left: 0px;
            border-bottom: 1px solid #dee2e6 !important;
        }

        .height-100 {
            height: 100%;
        }

        .w-custom-1 {
            width: 150px;
        }

        /* .collapseVitalsign .collapse.show {
                display:block;
            } */
        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {}

        /* // Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) {
            .w-last-result-box {
                width: 100%;
            }

            .height-100 {
                height: auto;
            }

        }

        /* // Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {
            .width-custom {
                width: 350px;
                ;
            }

            .border-custom-1 {
                border-top: 0px;
                border-right: 1px solid #dee2e6 !important;
                border-left: 0px;
                border-bottom: 0px !important;
            }

            /* .collapseVitalsign .collapse.show {
                display:flex;
              } */
        }

        /* // Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .w-custom-1 {
                width: 100%;
            }

            .collapseVitalsign.collapse:not(.show) {
                display: block !important;
            }
        }

        .badge-pink {
            color: #ffffff;
            background-color: #f278b0;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
    <style>
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0em;
            vertical-align: 0em;
            content: "";
            border-top: 0em solid;
            border-right: 0em solid transparent;
            border-bottom: 0;
            border-left: 0em solid transparent;
        }

        .select2-container {

            width: 20em !important;

        }

        .heartbeat_infinity {
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

        .prealta {

            -webkit-animation: mymove 2s infinite;
            /* Chrome, Safari, Opera */
            animation: mymove 2s infinite;
        }

        /* Chrome, Safari, Opera */
        @-webkit-keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        /* Standard syntax */
        @keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        #menu-pad>.nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--success);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--success);
        }

        #menu-pad>.badge-gray {
            background-color: var(--white) !important;
        }

        #menu-pad.bg-light,
        .bg-light>a {
            color: var(--primary) !important;
        }

        .datepicker table tr td.active.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled.disabled,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active.disabled:hover.active,
        .datepicker table tr td.active.disabled:hover.disabled,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.disabled:hover:hover,
        .datepicker table tr td.active.disabled:hover[disabled],
        .datepicker table tr td.active.disabled[disabled],
        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active:hover.disabled,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active:hover:hover,
        .datepicker table tr td.active:hover[disabled],
        .datepicker table tr td.active[disabled] {
            background-color: var(--primary) !important;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -ms-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(var(--primary)), to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -o-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: linear-gradient(to bottom, var(--primary), var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }

        .next,
        .prev,
        .datepicker-switch,
        .dow {
            color: var(--primary) !important;
        }

        .datepicker-inline {
            width: 100%;
        }
    </style>
</head>

<body>
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <div class="d-flex flex-column overflow-auto vh-100">
            <div id="loadingScreen" class="loadingScreen d-none">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <img
                        loading="lazy"
                        onerror="this.src='http://via.placeholder.com/640x360'"
                        src="/image/system/logo-cmdlt-blanco.svg"
                        alt="Cmdlt"
                        class="mb-3"
                        style="width: 140px; height: 80px;"
                    >
                    <div class="d-flex align-items-center text-white justify-content-center">
                    <div role="status" class="spinner-border">
                        <span class="visually-hidden"></span>
                    </div>
                    <h4 class="pl-2">Por favor espere un momento...</h4>
                </div>
            </div>
        </div>
        <nav class="d-flex justify-content-between bg-primary rounded-pill m-1 ">
            <div class="btn-user-home d-flex align-items-center">
                <button onclick="location.href='/auth/menu_inicial_principal'" class="btn_home_sidebar rounded-pill">
                    <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i
                            class="fas fa-bars text-white"></i></span>
                    <div class="d-flex align-items-center ">
                        <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-user-size"
                            src="{{ session('userData')['imagen'] }}">
                        <span
                            class="ml-1 mr-3 align-items-start justify-content-center d-flex flex-column overflow-hidden"
                            style="line-height: 1.1;">
                            <i class="message-wellcome">
                                @if (isset(session('userData')['genero']) && session('userData')['genero'] == 'f')
                                    ¡Bienvenida!
                                @else
                                    ¡Bienvenido!
                                @endif
                            </i>
                            <div class="username text-left">
                                {{ !is_null(session('userData')['prefijo']) && session('userData')['prefijo'] !== 'null' ? session('userData')['prefijo'] : '' }}
                                {{ session('userData')['nombre'] }} {{ session('userData')['apellido'] }}</div>
                        </span>
                    </div>

                </button>
                <!-- otros items -->
                {{-- <span  class="principal-menu-toggle btn" id="menu-toggle-right"></span> --}}
            </div>
            <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
        </nav>
        <nav class="row bg-light rounded border mx-1 mb-1">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 p-1 orden-1 overflow-auto"
                id="cat_user_ubicacion_menu">
                <ul id="App_nav_menu_areas" class="nav nav-pills flex-nowrap" role="tablist">
                </ul>
            </div>
            <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xl-2 order-4 order-lg-2 p-1">
                <button id="btn_paciente_create" onclick="window.location='/medico/create_paciente'"
                    class="btn btn-success btn-block text-nowrap rounded font-weight-bold btn-block">Nuevo
                    Paciente</button>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-8 col-xl-8 d-none d-md-block order-2 order-lg-2 p-1">
                <div class="d-flex justify-content-end" id="btnNotificaciones"></div>
            </div>
            <div class="col-7 col-sm-8 col-md-4 col-lg-4 col-xl-4 p-1 order-2 ">
                <input type="search" class="form-control" id="busquedapaciente" placeholder="Buscar paciente..."
                    aria-label="Buscar paciente..." aria-describedby="button-addon2">
            </div>
            <div class="col-12 row order-4 align-items-center">
                <div id="titleArea" class="mx-2 text-primary font-weight-bold text-nowrap">
                    <button
                        data-tippy-content="Pulse para ver el Equipo Médico en el área"
                        type="button"
                        class="btn btn-light btn-block"
                    >
                        <span
                            id="areaName"
                            style="font-weight:bold;color:var(--primary)!important"
                        >
                        </span>
                    </button>
                </div>
                <div id="signosP" class="col marquee-with-options" style="height: 30px;">
                    <marquee class="cursor-pointer" onmouseout="this.start()" onmouseover="this.stop()"
                        scrollamount="5" style="width:100%"></marquee>
                </div>
            </div>

        </nav>
        <div id="AppRowVitalSign" class="d-flex flex-wrap  rounded border mx-1 overflow-auto">

        </div>

    </div>

    <!-- Modal -->

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="height: 90vh;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal" src="/image/system/logo-cmdlt-blanco.png">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>
                <!-- style="height: 80vh;" -->
                <div class="modal-body">
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="doctorsListModal" style="z-index: 100000;" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content d-flex flex-column vh-100">
                <div class="modal-header d-flex align-items-center justify-content-between text-white">
                    <h5 class="modal-title" id="doctorsListModalLabel">Modal title</h5>
                    <button type="button" class="btn btn-default p-1" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-3 container-fluid p-0 d-flex flex-column overflow-auto">
                    <div id="modalLoading" class="modal-loading d-none">
                        <div class="d-flex">
                            <div class="spinner-border mr-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div>
                                Por favor, espera un momento...
                            </div>

                        </div>
                    </div>
                    <div class="flex-fill d-flex flex-wrap overflow-auto">
                        <div class="order-2 order-md-1 col-12 col-sm-12 col-md-6 d-flex flex-column  overflow-auto">
                            <h4 class="title_create text-dark">Añadir nuevo Tratante:</h4>
                            <input type="search" id="modal_search_medico" placeholder="Buscar médico..."
                                class="form-control">
                            <div class="alert alert-success my-1">
                                <b>Pulsa</b> en un médico del siguiente listado para asignarlo al paciente.
                            </div>
                            <div class="flex-fill   overflow-auto">
                                <ul id="modal-listado_medicos"
                                    class="mt-1 border rounded border-gray list-group list-group-flush overflow-auto col-listado-paciente-height">

                                </ul>
                            </div>
                            <div id="total_result" class="text-center">

                            </div>
                        </div>
                        <div class="order-1 order-md-2 col-12 col-sm-12 col-md-6 d-flex flex-column overflow-auto">
                            <h4 class="title_index text-dark">Equipo Tratante:</h4>
                            <div class="flex-fill   overflow-auto">
                                <ul id="modal-listado_medicos_asignados"
                                    class="mt-1  rounded border-gray list-group list-group-flush overflow-auto col-listado-paciente-height">

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
                    <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modal-patient-item" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content d-flex flex-column overflow-auto vh-100">
                <div class="modal-header p-0">
                    <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;"
                            aria-hidden="true"></i>

                        <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                    </nav>
                </div>
                <div class="modal-body-2 container-fluid  fullscreen d-flex flex-column overflow-auto">

                </div>

            </div>
        </div>
    </div>
    <!-- ModalMensajes -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <img src="/image/system/logo-cmdlt_color.svg" style="height: 3em;" class="img-fluid float-right"
                        alt="Imagen CMDLT">
                    <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                </div>
            </div>
        </div>
    </div>
    <template id="historia_inicial">
        <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
        <div style="margin-top: 190px !important;" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3 class="text-primary">Historia Preliminar de Emergencia</h3>
                </div>
                <div class="col-md-4">
                    <div id="cardInfoPaciente1"></div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Signos Vitales</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="signosVitales" class="card-body p-0"
                            style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">PESO</span>
                                        </div>
                                        <input name="user_peso" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">Kg.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">TALLA</span>
                                        </div>
                                        <input name="user_talla" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">Cm.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">TEMP.</span>
                                        </div>
                                        <input name="user_temperatura" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">°C</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">OXI</span>
                                        </div>
                                        <input name="user_oximetria" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">F.C.</span>
                                        </div>
                                        <input name="user_fc" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">lat/min</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">F.R.</span>
                                        </div>
                                        <input name="user_fr" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">resp/min</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item p-0">

                                    <div class="input-group m-0 rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">GL.</span>
                                        </div>
                                        <input name="user_glic" type="text" aria-label="First name"
                                            class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">mg/dL</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item p-0">
                                    <div class="input-group m-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 60px;">T.A.</span>
                                        </div>
                                        <input name="user_ta_sis" placeholder="Sistólica" type="text"
                                            aria-label="First name" class="form-control rounded-0 border-0">
                                        <input name="user_ta_dia" placeholder="Diastólica" type="text"
                                            aria-label="Last name" class="form-control rounded-0 border-0">
                                        <div class="input-group-prepend rounded-0 border-0">
                                            <span class="input-group-text rounded-0 border-0"
                                                style="width: 75px;">mmHg</span>
                                        </div>
                                    </div>

                                </li>


                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente requerirá:
                            </h3>
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
                                        <select class="form-control border-0" name="caso_tipo_medico"
                                            id="caso_tipo_medico">
                                            <option value="">Seleccione</option>
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                </li>
                                <li class="list-group-item p-1">
                                    <div class="form-group mb-0">
                                        <label class="text-gray mb-0" for="">Clasificación del Triaje:</label>
                                        <select class="form-control border-0" name="nivel_triaje" id="nivel_triaje">
                                            <option value="">Seleccione</option>
                                            <option value="1">Nivel 1</option>
                                            <option value="2">Nivel 2</option>
                                            <option value="3">Nivel 3</option>
                                            <option value="4">Nivel 4</option>
                                            <option value="5">Nivel 5</option>
                                        </select>
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>


                </div>
                <div id="datos_ingreso" class="col-md-8">


                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus" data-card-widget="collapse"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Escriba aquí por qué el paciente acudió a la emergencia"
                                name="user_motivo_consulta" id="user_problema_salud" rows="3"></textarea>

                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Antecedentes
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Escriba aquí los antecedentes del paciente"
                                name="user_antecedentes" id="user_antecedentes" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Describa aquí el problema de salud actual"
                                name="user_enfermedad_actual" id="user_problema_salud" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea"
                                placeholder="Describa brevemente los hallazgos positivos del examen físico realizado." name="user_examen_fisico"
                                id="user_examen_fisico" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card card-outline collapsed-card card-primary"
                        style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="card-header cursor-pointer" data-card-widget="collapse">
                            <h3 class="card-title text-primary font-weight-bold">Problema de ingreso
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                            <textarea class="form-control textarea" placeholder="Escriba aquí el diagnóstico presuntivo del paciente"
                                name="user_diagnostico_presuntivo" id="user_diagnostico_presuntivo" rows="3"></textarea>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <button id="guardarHistoriaInicial" type="button" class="btn btn-success btn-block mb-1"
                        {{-- data-dismiss="modal" --}}>Guardar</button>
                </div>
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </template>
    <template id="historialEpisodios">
        <section class="content my-1">
            <h1 class="text-primary">Historia de Episodios</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overlay-wrapper">
                            <div class="overlay text-primary d-none">
                                <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
                                <div class="text-bold pt-2">
                                    Espere un momento por favor...
                                </div>
                            </div>
                            <div id=episodes>
                                <div id="episode_1" class="card card-outline card-primary mb-1 collapsed-card">
                                    <div class="card-header cursor-pointer overflow-auto" data-card-widget="collapse">
                                        <div class="user-block">
                                            <div class="d-flex align-items-end">
                                                <div class="px-3 border-right">
                                                    <div class="m-0 description">
                                                        Episodio
                                                    </div>
                                                    <div class="text-center">
                                                        <a id="user_fullname" href="#"
                                                            class="h4 text-primary font-weight-bold">
                                                            1
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="px-1">
                                                    <img id="user_image" class="img-circle"
                                                        src="/AdminLTE-3.2.0/dist/img/user1-128x128.jpg"
                                                        alt="User Image">
                                                </div>
                                                <div class="px-1 border-right">
                                                    <div>
                                                        <a id="user_fullname" href="#"
                                                            class="font-weight-bold">
                                                            Jonathan Burke Jr.
                                                        </a>
                                                    </div>
                                                    <div class="m-0 description">
                                                        <b>Cédula:</b> <span id="user_document_id">00.000.000</span>
                                                    </div>
                                                </div>
                                                <div class="px-1 border-right">
                                                    <div class="m-0 description">
                                                        <b>Ingreso:</b> <span
                                                            id="episode_admision_date">01/01/2022</span>
                                                    </div>
                                                    <div class="m-0 description">
                                                        <b>Egreso:</b> <span
                                                            id="episode_departure_date">10/01/2022</span>
                                                    </div>
                                                </div>
                                                <div class="px-1">
                                                    <div class="m-0 description">
                                                        <b>Días de Hospitalización:</b> <span
                                                            id="episode_num_days">8</span>
                                                    </div>
                                                    <div class="m-0 description">
                                                        <b>Ubicación:</b>
                                                        <span id="episode_num_days">Pad Covid - 1</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool text-primary"
                                                data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-2" style="display: none;">

                                        <div class="row">
                                            <div class="col-5 col-sm-3">
                                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab"
                                                    role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link active" id="vert-tabs-home-tab"
                                                        data-toggle="pill" href="#vert-tabs-home" role="tab"
                                                        aria-controls="vert-tabs-home"
                                                        aria-selected="true">Laboratorio</a>
                                                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                                        href="#vert-tabs-profile" role="tab"
                                                        aria-controls="vert-tabs-profile"
                                                        aria-selected="false">Imagen</a>
                                                    <a class="nav-link" id="vert-tabs-messages-tab"
                                                        data-toggle="pill" href="#vert-tabs-messages" role="tab"
                                                        aria-controls="vert-tabs-messages"
                                                        aria-selected="false">Fotografía
                                                        <span class="badge badge-primary">1</span></a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings" aria-selected="false">Otros
                                                        Archivo <span class="badge badge-primary">4</span></a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Probabilidad Diagnóstica
                                                        <span class="badge badge-primary">1</span></a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Evolución</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Plan</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Récipe</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Estudio
                                                        Diagnóstico</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Comorbilidad</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Informe</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings" aria-selected="false">Orden
                                                        Médica</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Monitoreo
                                                        indicadores</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">PAD</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Doctores</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Historia
                                                        Inicial</a>
                                                    <a class="nav-link" id="vert-tabs-settings-tab"
                                                        data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                        aria-controls="vert-tabs-settings"
                                                        aria-selected="false">Ubicaciones</a>
                                                </div>
                                            </div>
                                            <div class="col-7 col-sm-9">
                                                <div class="tab-content" id="vert-tabs-tabContent">
                                                    <div class="tab-pane text-left fade active show"
                                                        id="vert-tabs-home" role="tabpanel"
                                                        aria-labelledby="vert-tabs-home-tab">
                                                        <div class="post">
                                                            <div class="user-block">
                                                                <img class="img-circle img-bordered-sm"
                                                                    src="/AdminLTE-3.2.0/dist/img/user8-128x128.jpg"
                                                                    alt="user-img 128x128">
                                                                <span class="username">
                                                                    <a href="#">Jonathan Burke Jr.</a>
                                                                    <a href="#" class="float-right btn-tool"><i
                                                                            class="fas fa-times"></i></a>
                                                                </span>
                                                                <span class="description">Shared publicly - 7:30 PM
                                                                    today</span>
                                                            </div>
                                                            <!-- /.user-block -->
                                                            <p>
                                                                Lorem ipsum represents a long-held tradition for
                                                                designers,
                                                                typographers and the like. Some people hate it and argue
                                                                for
                                                                its demise, but others ignore the hate as they create
                                                                awesome
                                                                tools to help create filler text for everyone from bacon
                                                                lovers
                                                                to Charlie Sheen fans.
                                                            </p>
                                                            <div class="card-footer bg-white">
                                                                <ul
                                                                    class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                                    <li>
                                                                        <span class="mailbox-attachment-icon"><i
                                                                                class="far fa-file-pdf"></i></span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name"><i
                                                                                    class="fas fa-paperclip"></i>
                                                                                Sep2014-report.pdf</a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>1,245 KB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <span
                                                                            class="mailbox-attachment-icon has-img"><img
                                                                                src="/AdminLTE-3.2.0/dist/img/photo1.png"
                                                                                alt="Attachment"></span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name"><i
                                                                                    class="fas fa-camera"></i>
                                                                                photo1.png</a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>2.67 MB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <span class="mailbox-attachment-icon has-img">
                                                                            <img src="/AdminLTE-3.2.0/dist/img/photo2.png"
                                                                                alt="Attachment">
                                                                        </span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name">
                                                                                <i class="fas fa-camera"></i>
                                                                                photo2.png
                                                                            </a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>1.9 MB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <span class="mailbox-attachment-icon">
                                                                            <i class="far fa-file-word"></i>
                                                                        </span>

                                                                        <div class="mailbox-attachment-info">
                                                                            <a href="#"
                                                                                class="mailbox-attachment-name"><i
                                                                                    class="fas fa-paperclip"></i> App
                                                                                Description.docx</a>
                                                                            <span
                                                                                class="mailbox-attachment-size clearfix mt-1">
                                                                                <span>1,245 KB</span>
                                                                                <a href="#"
                                                                                    class="btn btn-default btn-sm float-right"><i
                                                                                        class="fas fa-cloud-download-alt"></i></a>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                                        aria-labelledby="vert-tabs-profile-tab">

                                                    </div>
                                                    <div class="tab-pane fade" id="vert-tabs-messages"
                                                        role="tabpanel" aria-labelledby="vert-tabs-messages-tab">

                                                    </div>
                                                    <div class="tab-pane fade" id="vert-tabs-settings"
                                                        role="tabpanel" aria-labelledby="vert-tabs-settings-tab">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row justify-content-center">

                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary btn-block"
                                data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <template id="cargando">
        <div id="carga" class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Espere un momento por favor...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <script>
        function filterPacientes(texto){
            // Convertir el texto a minúsculas para hacer la búsqueda insensible a mayúsculas y minúsculas
            const textoMinusculas = texto.toLowerCase();

            // Obtener todos los elementos div dentro del elemento con el id "row_pacientes"
            const divs = document.querySelectorAll('#AppRowVitalSign div.row-paciente');

            // Iterar sobre cada div
            divs.forEach(div => {
            // Obtener el texto dentro del div y convertirlo a minúsculas
                const textoDiv = div.innerHTML.toLowerCase();
                // Mostrar o ocultar el div según si el texto buscado está presente en el texto del div
                if (textoDiv.includes(textoMinusculas)) {
                    div.style.display = 'block'; // Mostrar el div
                } else {
                    div.style.display = 'none'; // Ocultar el div
                }
            });
        }
        document.getElementById("busquedapaciente").addEventListener("change",(e)=>{
            const textoBuscado = e.target.value; // Texto que deseas buscar
            filterPacientes(textoBuscado);
        })
    </script>
</body>
@php
    $version = '1.0.6';
@endphp
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> --}}

<script src="{{ asset('AdminLTE-3.0.5/plugins/jquery/jquery.min.js') }}"></script>
{{-- <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.min.js" ></script> --}}
<script src="/js/sweetalert2@10.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="/bootstrap-4.6.2/js/bootstrap.bundle.min.js"></script>
{{-- <script src="/AdminLTE-3.2.0/plugins/popper/popper.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/2.5.4/tippy.all.js" integrity="sha512-jIIh0z4fzfV4cFju6uTH2QY9Q/UrRd09aa35FKbh759/sl4VyIlA9JMbjM3nSFLNESeiih6pzDlsB4GLd0JZlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="/js/select2.min.js"></script> --}}

{{-- <script src="/js/tippy-bundle.umd.min.js"></script> --}}
<script src="/js/select2.min.js"></script>
<script src="/plugin/intl-tel-input/build/js/intlTelInput.js"></script>
<script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
<script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.es.min.js"></script>


<script src="/js/scripts.js?{{ $version }}"></script>
<script src="/class_js/CatUserEspecialidad.js?{{ $version }}"></script>
<script src="/class_js/CatUserEstado.js?{{ $version }}"></script>
<script src="/class_js/CatUserMunicipio.js?{{ $version }}"></script>
<script src="/class_js/CatUserUbicacion.js?{{ $version }}"></script>
<script src="/class_js/Component.js?{{ $version }}"></script>
<script src="/class_js/User.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAntecedente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAntg.js?{{ $version }}"></script>
<script src="/class_js/UserCuestChat.js?{{ $version }}"></script>
<script src="/class_js/UserCuestDireccion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEstudioDiagnostico.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEvolucion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFc.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFichaMedica.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFotografia.js?{{ $version }}"></script>
<script src="/class_js/UserCuestFr.js?{{ $version }}"></script>
<script src="/class_js/UserCuestGl.js?{{ $version }}"></script>
<script src="/class_js/UserCuestHistoria.js?{{ $version }}"></script>
<script src="/class_js/UserCuestImagen.js?{{ $version }}"></script>
<script src="/class_js/UserCuestImpresionDiagnostica.js?{{ $version }}"></script>
<script src="/class_js/UserCuestIncidencia.js?{{ $version }}"></script>
<script src="/class_js/UserCuestInforme.js?{{ $version }}"></script>
<script src="/class_js/UserCuestLaboratorio.js?{{ $version }}"></script>
<script src="/class_js/UserCuestObservacion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOtroArchivo.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOxigenoterapia.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOximetria.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPaciente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPad.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPcr.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPdr.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPendiente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPlan.js?{{ $version }}"></script>
<script src="/class_js/UserCuestPruebaCovid.js?{{ $version }}"></script>
<script src="/class_js/UserCuestRecipe.js?{{ $version }}"></script>
<script src="/class_js/UserCuestSintoma.js?{{ $version }}"></script>
<script src="/class_js/UserCuestTa.js?{{ $version }}"></script>
<script src="/class_js/UserCuestTac.js?{{ $version }}"></script>
<script src="/class_js/UserCuestTemperatura.js?{{ $version }}"></script>
<script src="/class_js/UserCuestUbicacion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestValoracion.js?{{ $version }}"></script>
<script src="/class_js/UserCuestVinculoInstitucion.js?{{ $version }}"></script>
<script src="/class_js/UserEquipoSalud.js?{{ $version }}"></script>
<script src="/class_js/UserEspecialidad.js?{{ $version }}"></script>
<script src="/class_js/UserFamily.js?{{ $version }}"></script>
<script src="/class_js/UserMedico.js?{{ $version }}"></script>
<script src="/class_js/UserProfile.js?{{ $version }}"></script>
<script src="/class_js/UserType.js?{{ $version }}"></script>
<script src="/class_js/UserCuestMedicoPaciente.js?{{ $version }}"></script>
<script src="/class_js/UserCuestComorbilidad.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEpisodio.js?{{ $version }}"></script>
<script src="/class_js/UserCuestEgreso.js?{{ $version }}"></script>
<script src="/class_js/SystemIncidencia.js?{{ $version }}"></script>
<script src="/class_js/UserMedicoPosicion.js?{{ $version }}"></script>
<script src="/class_js/UserPostCovid.js?{{ $version }}"></script>
<script src="/class_js/UserEncuesta.js?{{ $version }}"></script>
<script src="/class_js/UserVIP.js?{{ $version }}"></script>
<script src="/class_js/UserMedicoAgenda.js?{{ $version }}"></script>
<script src="/class_js/UserProblemaSalud.js?{{ $version }}"></script>
<script src="/class_js/UserEnfermedadActual.js?{{ $version }}"></script>
<script src="/class_js/UserExamenFisico.js?{{ $version }}"></script>
<script src="/class_js/UserCuestOrdenMedica.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAlert.js?{{ $version }}"></script>
<script src="/class_js/UserCuestResbalar.js?{{ $version }}"></script>
<script src="/class_js/UserCuestRiesgoQuirurgico.js?{{ $version }}"></script>
<script src="/class_js/UserCuestAdministracion.js?{{ $version }}"></script>
<script src="/vue/vue.js"></script>


<script>
    let d = document
    let component = new Component()
        component.ViewEnfermeria()

</script>


<script>

    let nombreIdModal = "doctorsListModal"
    let modal = document.getElementById(nombreIdModal)
    let cat_ubicaciones = []
    let modalJQ = $("#" + nombreIdModal)
        class MedicosPaciente {
            constructor({
                attrSelectorId = "doctorsList",
                episode_id = null,
                medic_teem_patient = [], //GUARDA LOS MEDICOS ASIGNADOS AL PACIENTE
                medic_teem_to_show = [], //GUARDA LOS ID DE LOS GRUPOS DE MEDICOS A MOSTRAR EN LA TARJETA
            }) {
                //console.log("MedicosPaciente episode_id",episode_id)
                let that = this
                this.episode_id = episode_id
                //DATOS DE EPISODIO DEL PACIENTE
                this.paciente = pacientes_datos.find(paciente => equalsInt(paciente['episodio'], episode_id))
                //INDICE EPISODIO EN EL OBJETO
                this.episodio_index = pacientes_datos.findIndex(paciente => equalsInt(paciente['episodio'], episode_id))
                // MEDICOS QUE ATIENDEN AL PACIENTE
                this.medic_teem_patient = this.paciente['medico_paciente']
                //LISTA DE BOTONES DE MEDICOS A MOSTRAR
                this.medic_teem_to_show = medic_teem_to_show
                //ETIQUETA DONDE SE DESPLEGARÁ LA LISTA DE GRUPOS DE MEDICOS
                this.selector = document.getElementById(attrSelectorId)
                //CATALOGO DE CARGOS MEDICOS
                this.cat_items = [{
                        id: [1],
                        grupos_medicos_to_show: [1],
                        description: "Tratante",
                        selector_description: function() {
                            return that.getSelectorText(this.description)
                        },
                        color: 'success',
                        className: ['fa-solid', 'fa-user-doctor'],
                        sigla() {
                            return this.description.slice(0, 2).toUpperCase()
                        },
                        medicos_paciente: [],
                    },
                    {
                        id: [2],
                        grupos_medicos_to_show: [1, 2],
                        description: "Interconsultante",
                        selector_description: function() {
                            return that.getSelectorText(this.description)
                        },
                        color: 'info',
                        className: ['fa-solid', 'fa-user-doctor'],
                        sigla() {
                            return this.description.slice(0, 2).toUpperCase()
                        },
                        medicos_paciente: [],
                    },
                    {
                        id: [3, 4],
                        grupos_medicos_to_show: [3, 4],
                        description: "Fellow",
                        selector_description: function() {
                            return that.getSelectorText(this.description)
                        },
                        color: 'orange',
                        className: ['fa-solid', 'fa-user-doctor'],
                        sigla() {
                            return this.description.slice(0, 2).toUpperCase()
                        },
                        medicos_paciente: [],
                    },
                    {
                        id: [5, 6, 7, 8],
                        grupos_medicos_to_show: [5, 6, 7, 8],
                        description: "Residente",
                        selector_description: function() {
                            return that.getSelectorText(this.description)
                        },
                        color: 'secondary',
                        className: ['fa-solid', 'fa-user-doctor'],
                        sigla() {
                            return this.description.slice(0, 2).toUpperCase()
                        },
                        medicos_paciente: [],
                    },
                    {
                        id: [9],
                        grupos_medicos_to_show: [9],
                        description: "RAMH",
                        selector_description: function() {
                            return that.getSelectorText(this.description)
                        },
                        color: 'purple',
                        className: ['fa-solid', 'fa-user-doctor'],
                        sigla() {
                            return this.description.slice(0, 2).toUpperCase()
                        },
                        medicos_paciente: [],
                    },
                    {
                        id: [10],
                        grupos_medicos_to_show: [10],
                        description: "Enfermería",
                        selector_description: function() {
                            return that.getSelectorText(this.description)
                        },
                        color: 'warning',
                        className: ['fa-solid', 'fa-user-nurse'],
                        sigla() {
                            return this.description.slice(0, 2).toUpperCase()
                        },
                        medicos_paciente: [],
                    },
                ]


            }
            cat_medic_teem_to_show() {
                let resultset = []
                let medic_teem = []
                if (this.medic_teem_to_show.length === 0) {
                    this.medic_teem_to_show = [1, 2, 3, 7, 9, 10]
                }
                this.medic_teem_to_show.forEach(id => {
                    let result = this.cat_items.find(x => x['id'].includes(id))
                    if (!is_undefined(result)) {
                        resultset.push(result)
                    }
                })

                return resultset
            }
            getSelectorText(description) {
                return description.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase()
            }
            modalColor({
                color = null,
                group_cargo = null,
                medicos_disponibles = [],
                title = null
            }) {
                //console.log(color)
                //ELIMINAR TODOS LOS COLORES DE LA MODAL
                let colores = this.cat_items.map(x => x.color)
                //console.log("colores",colores)
                colores.forEach(color => {
                    modal.querySelector(".modal-header").classList.remove('bg-' + color)
                    modal.querySelector("#total_result").classList.remove('text-' + color)

                    modal.querySelectorAll(".modal-footer button").forEach((button, key) => {
                        button.classList.remove('btn-' + color)
                        //button.classList.remove('border-'+x.color)
                    })

                })
                //ASIGNAR NUEVO COLOR A LA MODAL
                modal.querySelectorAll(".modal-footer button")[0].classList.add('btn-' + color)
                modal.querySelector(".modal-header").classList.add('bg-' + color)
                modal.querySelector("#total_result").classList.add('text-' + color)

                //TEXTOS PREDEFINIDOS EN LA MODAL
                modal.querySelector(".modal-title").textContent = `Equipo ${group_cargo}`
                modal.querySelector(".title_index").textContent = `Equipo ${group_cargo}:`
                modal.querySelector(".title_create").textContent = `Añadir nuevo ${group_cargo}:`
                modal.querySelector("#modal_search_medico").placeholder = `Escribe ${group_cargo} a buscar...`
                modal.querySelector("#total_result").innerHTML =
                    `Mostrando <b>${medicos_disponibles.length}</b> resultados`


            }
            handleOptionListModal({
                color,
                group_cargo,
                grupos_medicos_to_show,
                position_id,
                selector_cargo,
                tippyContent,
            }) {
                let that = this
                /* d.querySelector("#modalLoading").classList.remove("d-none") */
                //console.log(event )
                //ID DE LOS CARGOS
                let posiciones_id = position_id.split(",").map(x => Number(x))
                //console.log(posiciones_id);
                //console.log(posiciones_id.toString());

                /*  if(["1","2"].includes(posiciones_id.toString())){
                    posiciones_id =[1,2,3,4,5,6,7,8,9,10]
                } */
                //console.log("---------->",grupos_medicos_to_show)
                //MEDICOS DISPONIBLES EN LOS CARGOS
                let medicos_disponibles = medicos_datos.filter(med => grupos_medicos_to_show.split(",").map(x => Number(
                    x)).includes(Number(med.posicion_id)))
                //console.log(medicos_disponibles)
                //OBTENER ESPECIALIDADES MEDICAS PARA AGRUPAR LOS MEDICOS
                let especialidades_id = Array.from(new Set(medicos_disponibles.map(med => med
                    .cat_user_especialidad_id)))

                //MEDICOS ASIGNADOS AL PACIENTE
                let medicosAsignadosAlPaciente = this.medic_teem_patient.filter(x => posiciones_id.includes(x
                    .cat_user_medico_posicion_id))
                //console.log(medicosAsignadosAlPaciente)

                //OBTENER ID DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS POR ESPECIALIDAD
                let user_id_asignados = Array.from(new Set(medicosAsignadosAlPaciente.map(med => med.user_id_medico)))
                //console.log(user_id_asignados)

                //OBTENER ESPECIALIDADES DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS
                let medicos_disponibles_asignados = medicos_disponibles.filter(med => user_id_asignados.includes(Number(
                    med.user_id)))
                //console.log(medicos_disponibles_asignados)

                //OBTENER ESPECIALIDADES MEDICAS DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS
                let especialidades_id_asignados = Array.from(new Set(medicos_disponibles_asignados.map(med => med
                    .cat_user_especialidad_id)))
                //console.log(especialidades_id_asignados)

                /*ASIGNADOS*/
                //console.log(modal.querySelector('#modal-listado_medicos_asignados'))
                let modalListadoMedicoAsignados = modal.querySelector('#modal-listado_medicos_asignados')
                modalListadoMedicoAsignados.innerHTML = null

                if (especialidades_id_asignados.length > 0) {
                    //let grupoMedicosAsignadosAlPaciente = medicosAsignadosAlPaciente.filter(x=> posiciones_id.includes(x.user_cuest_medico_posicion_id) )
                    //console.log(grupoMedicosAsignadosAlPaciente)
                    especialidades_id_asignados.forEach(especialidad_id => {
                        //POR CADA ESPECIALIDAD OBTENER LOS MEDICOS
                        let medicos_disponibles_x_especialidad = medicos_disponibles_asignados.filter(med =>
                            Number(med.cat_user_especialidad_id) === Number(especialidad_id))
                        //OBTENER NOMBRE DE LA ESPECIALIDAD
                        let especialidad_nombre = medicos_disponibles_x_especialidad[0]

                        //MOSTRAMOS LA ESPECIALIDAD QUE AGRUPARA LOS MEDICOS
                        /* modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                            <li class="list-group-item d-flex text-${color} font-weight-bold disabled list-group-item-action p-1">
                                <div>${especialidad_nombre.especialidad}</div>
                            </li>
                        `) */

                        medicos_disponibles_x_especialidad.forEach(medico => {
                            let activo = false
                            let medicoActivoClass = ""
                            //console.log(medicosPaciente)
                            let medicoActivo = medicosAsignadosAlPaciente.find(mp => equalsInt(mp[
                                'user_id_medico'], medico['user_id']))

                            //RESALTAMOS EN EL LISTADO DE MEDICOS DISPONIBLES LOS MEDICOS YA ASIGNADOS
                            if (!is_undefined(medicoActivo)) {
                                activo = true
                                medicoActivoClass = `bg-${color} text-white`
                            }
                            //console.log(medico)
                            //MOSTRAMOS EL MEDICO DISPONIBLE
                            let temp_medico_posicion_id = medico.posicion_id
                            if (grupos_medicos_to_show === "1,2") {
                                temp_medico_posicion_id = 2
                            }
                            modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                                                <li
                                                    data-position_id="${temp_medico_posicion_id}"
                                                    data-selector_cargo="${selector_cargo}"
                                                    data-tippyContent="${tippyContent}"
                                                    data-paciente_name ="${that.paciente['paciente']}"
                                                    data-medico_name ="${medico['medico']}"
                                                    data-group_cargo="${group_cargo}"
                                                    data-activo="${activo}"
                                                    data-user_id_medico="${medico.user_id}"
                                                    data-color="${color}"
                                                    class="bg-light list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                                                >
                                                    <div class="d-flex align-items-center scale-in-hor-left">
                                                        <div class="d-flex align-items-center">
                                                            <img loading="lazy" style="width: 30px;height: 30px;border-radius: 20px;" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="${medico.imagen}">
                                                            <div class="ml-1">
                                                                ${medico.medico}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column flex-md-row flex-wrap align-items-start">
                                                            <span class="ml-1 mb-1 badge badge-primary"> ${medico.especialidad}</span>
                                                            <button class="ml-1 mb-1 btn btn-outline-primary btn-small-custom tooltip-primary text-nowrap" data-tippy-content="Teléfono contacto del médico: ${medico.telefono_movil}" onclick="window.open('https://api.whatsapp.com/send?phone=${medico.telefono_movil}')">
                                                                <i class="ml-1 fab fa-whatsapp text-success"></i> ${medico.telefono_movil}
                                                            </button>
                                                            <a class="ml-1 mb-1 btn btn-outline-${medico.extension_telefonica ===null ?'secondary':'purple'} btn-small-custom text-nowrap" href="tel:+584149320905"><i class="ml-1 fas fa-phone"></i> ${medico.extension_telefonica ===null ?'Sin Asterísco':medico.extension_telefonica}</a>
                                                        </div>
                                                    </div>
                                                    <button
                                                        data-grupos_medicos_to_show="${grupos_medicos_to_show}"
                                                        data-position_id="${medico.posicion_id}"
                                                        data-selector_cargo="${selector_cargo}"
                                                        data-tippyContent="${tippyContent}"
                                                        data-paciente_name ="${that.paciente['paciente']}"
                                                        data-medico_name ="${medico['medico']}"
                                                        data-group_cargo="${group_cargo}"
                                                        data-activo="${activo}"
                                                        data-user_id_medico="${medico.user_id}"
                                                        data-color="${color}"
                                                        style="width: 30px;height: 30px;font-size: 0.5em;"
                                                        class="medico-asignado tooltip-danger delete-row btn btn-danger"
                                                    >
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                </li>
                                            `)
                        })
                    })
                } else {
                    modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                                    <li class="text-center text-${color} list-group-item list-group-item-action p-1">
                                        No se encontraron ${group_cargo} asignados
                                    </li>
                                `)
                }
                /*DISPONIBLES*/
                let modalListadoMedicoDisponibles = modal.querySelector('#modal-listado_medicos')
                modalListadoMedicoDisponibles.innerHTML = null
                if (especialidades_id.length > 0) {

                    especialidades_id.forEach(especialidad_id => {
                        //POR CADA ESPECIALIDAD OBTENER LOS MEDICOS
                        let medicos_disponibles_x_especialidad = medicos_disponibles.filter(med => Number(med
                            .cat_user_especialidad_id) === Number(especialidad_id))
                        //OBTENER NOMBRE DE LA ESPECIALIDAD
                        let especialidad_nombre = medicos_disponibles_x_especialidad[0]

                        //MOSTRAMOS LA ESPECIALIDAD QUE AGRUPARA LOS MEDICOS
                        modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                        <li class="list-group-item d-flex text-${color} font-weight-bold disabled list-group-item-action p-1">
                                            <div>${especialidad_nombre.especialidad}</div>
                                        </li>
                                    `)

                        medicos_disponibles_x_especialidad.forEach(medico => {
                            let activo = false
                            let medicoActivoClass = ""
                            //console.log(medicosPaciente)
                            let medicoActivo = medicosAsignadosAlPaciente.find(mp => equalsInt(mp[
                                'user_id_medico'], medico['user_id']))

                            //RESALTAMOS EN EL LISTADO DE MEDICOS DISPONIBLES LOS MEDICOS YA ASIGNADOS
                            if (is_undefined(medicoActivo)) {
                                //activo = true
                                //medicoActivoClass =`bg-${color} text-white`
                                let temp_medico_posicion_id = medico.posicion_id
                                if (grupos_medicos_to_show === "1,2") {
                                    temp_medico_posicion_id = 2
                                }
                                //MOSTRAMOS EL MEDICO DISPONIBLE
                                modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                                <li
                                                    data-grupos_medicos_to_show="${grupos_medicos_to_show}"
                                                    data-position_id="${temp_medico_posicion_id}"
                                                    data-selector_cargo="${selector_cargo}"
                                                    data-tippyContent="${tippyContent}"
                                                    data-paciente_name ="${that.paciente['paciente']}"
                                                    data-medico_name ="${medico['medico']}"
                                                    data-group_cargo="${group_cargo}"
                                                    data-activo="${activo}"
                                                    data-user_id_medico="${medico.user_id}"
                                                    data-color="${color}"
                                                    class="${medicoActivoClass} list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                                                >

                                                    <div class="d-flex align-items-center">
                                                        <img loading="lazy" style="width: 30px;height: 30px;border-radius: 20px;" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="${medico.imagen}">
                                                        <div class="ml-1">
                                                            ${medico.medico}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column flex-md-row align-items-start">
                                                        <button class="ml-1 mb-1 btn btn-outline-primary btn-small-custom tooltip-primary text-nowrap" data-tippy-content="Teléfono contacto del médico: ${medico.telefono_movil}" onclick="window.open('https://api.whatsapp.com/send?phone=${medico.telefono_movil}')">
                                                            <i class="ml-1 fab fa-whatsapp text-success"></i> ${medico.telefono_movil}
                                                        </button>
                                                        <a class="ml-1 mb-1 btn btn-outline-${medico.extension_telefonica ===null ?'secondary':'purple'} btn-small-custom text-nowrap" href="tel:+584149320905"><i class="ml-1 fas fa-phone"></i> ${medico.extension_telefonica ===null ?'Sin Asterísco':medico.extension_telefonica}</a>
                                                    </div>

                                                </li>
                                            `)
                            }
                        })

                    })
                    //EVENTO CLICK A CADA MEDICO DISPONIBLE
                    modalListadoMedicoDisponibles.querySelectorAll("li").forEach(handleMedicoDisponible => {
                        handleMedicoDisponible.addEventListener("click", (e) => {
                            that.handleMedicoDisponible(e)
                        })
                    })
                    //EVENTO CLICK A CADA MEDICO ASIGNADO
                    modalListadoMedicoAsignados.querySelectorAll("li button.medico-asignado").forEach(
                        handleMedicoAsignados => {
                            handleMedicoAsignados.addEventListener("click", (e) => {
                                that.handleMedicoDisponible(e)
                            })
                        })
                    //
                    setTimeout(() => {
                        that.filtroModalMedicos()
                        modal.querySelector("#modal_search_medico").focus()
                    }, 500)
                } else {
                    modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                    <li class="text-center text-${color} list-group-item list-group-item-action p-1">
                                        No se encontraron ${group_cargo}
                                    </li>
                                `)
                }

                //COLORES DE LA MODAL
                this.modalColor({
                    color,
                    group_cargo,
                    medicos_disponibles,
                    title: tippyContent,
                })



                //EVENTOS

                //MOSTRAR MODAL
                modalJQ.modal("show")
                /* d.querySelector("#modalLoading").classList.add("d-none") */
            }
            filtroModalMedicos() {
                let busqueda = modal.querySelector('#modal_search_medico');
                let table = modal.querySelectorAll("#modal-listado_medicos li");
                let buscaTabla = function() {
                    let texto = busqueda.value.toLowerCase();
                    let dFlexCount = 0;
                    let dNoneCount = 0;
                    setTimeout(() => {
                        if (table.length > 0) {
                            table.forEach((row, r) => {
                                //console.log(row)
                                if (row.querySelector("div").innerText.toLowerCase().indexOf(
                                        texto) !== -1) {
                                    row.classList.replace('d-none', 'd-flex');
                                } else {
                                    //console.log(row)
                                    row.classList.replace('d-flex', 'd-none');
                                }
                                if (row.classList.contains('d-flex')) {
                                    dFlexCount++;
                                } else if (row.classList.contains('d-none')) {
                                    dNoneCount++;
                                }
                            })
                            modal.querySelector('#total_result').innerHTML =
                                `Mostrando <b>${dFlexCount.toString()}</b> resultados`

                        }

                    }, 100);
                }
                busqueda.addEventListener('change', buscaTabla);
                busqueda.addEventListener('input', function(event) {
                    // Se está escribiendo o borrando texto en el input
                    if (event.target.value === '') {
                        buscaTabla()
                        /* console.log('Se borró todo el texto del input'); */
                    }
                });
            }
            async destroy(medico_paciente_id) {
                ///user_cuest_medico_paciente/eliminarById
                let formdata = new FormData();
                formdata.append("id", medico_paciente_id)
                formdata.append("_token", $("#_token").val())
                formdata.append("created_at", timestamps())
                return await post(location.origin + "/user_cuest_medico_paciente/eliminarById", formdata)
            }
            async store(user_id_medico, position_id) {

                let formdata = new FormData();
                formdata.append("episodio_id", this.paciente['episodio'])
                formdata.append("user_id_medico", user_id_medico)
                formdata.append("user_id_paciente", this.paciente['user_id'])
                formdata.append("position_id", position_id)
                formdata.append("_token", $("#_token").val())
                formdata.append("created_at", timestamps())
                return await post(location.origin + "/user_cuest_medico_paciente/store", formdata)
            }
            async handleMedicoDisponible(event) {
                let that = this
                let {
                    grupos_medicos_to_show,
                    position_id,
                    selector_cargo,
                    tippyContent,
                    paciente_name,
                    medico_name,
                    group_cargo,
                    activo,
                    user_id_medico,
                    color,
                    episodio_id
                } = event.currentTarget.dataset
                //VALIDAMOS QUE EL MEDICO NO ESTE ASIGNADO
                let medicosAsignadosAlPaciente = that.medic_teem_patient
                //console.log("medicosAsignadosAlPaciente",medicosAsignadosAlPaciente)
                let medicoEstaAsignado = medicosAsignadosAlPaciente.find(med => Number(med.user_id_medico) === Number(
                    user_id_medico))
                //console.log(medicosAsignadosAlPaciente)
                //console.log(medicoEstaAsignado)
                if (is_undefined(medicoEstaAsignado)) {
                    /*   Swal.fire({
                        title: `¿Asignar ${group_cargo}?`,
                        text:`¿Quieres asignar el ${group_cargo} ${medico_name} al paciente ${paciente_name}?`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, asignar!',
                        cancelButtonText: 'No, aún no!'
                    }).then( async(result) => {
                        if (result.isConfirmed) { */
                    //GUARDAMOS LA ASIGNACION
                    d.querySelector("#modalLoading").classList.remove("d-none")



                    let model = await that.store(user_id_medico, position_id)
                    d.querySelector("#modalLoading").classList.add("d-none")
                    this.medic_teem_patient = model
                    pacientes_datos[that.episodio_index]['medico_paciente'] = model
                    that.deployMedicoPacienteList()

                    that.handleOptionListModal({
                        grupos_medicos_to_show,
                        color,
                        group_cargo,
                        position_id,
                        selector_cargo,
                        tippyContent,
                    })
                    modalJQ.modal("hide")
                    /* Swal.fire(
                        `${group_cargo} asignado!`,
                        `El ${group_cargo} se asignó correctamente.`,
                        'success'
                    ) */
                    /* } */
                    /*  }) */
                } else {
                    Swal.fire({
                        title: `¿Retirar ${group_cargo}?`,
                        text: `¿Quieres retirar el ${group_cargo} ${medico_name} del paciente ${paciente_name}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, retirar!',
                        cancelButtonText: 'No, aún no!'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            d.querySelector("#modalLoading").classList.remove("d-none")
                            let temp_medico_posicion_id = position_id
                            if (grupos_medicos_to_show === "1,2") {
                                temp_medico_posicion_id = 2
                            }
                            let medico_paciente_id = this.medic_teem_patient.find((mp, key) => Number(mp
                                    .cat_user_medico_posicion_id) === Number(temp_medico_posicion_id) &&
                                Number(mp.user_id_medico) === Number(user_id_medico))[
                                'medico_paciente_id']
                            //console.log(medico_paciente_id)
                            let model = await that.destroy(medico_paciente_id)
                            d.querySelector("#modalLoading").classList.add("d-none")
                            //console.log("user_id_medico",user_id_medico)
                            //console.log(pacientes_datos[ that.episodio_index ]['medico_paciente'])
                            this.medic_teem_patient = this.medic_teem_patient.filter((mp, key) => Number(mp
                                .user_id_medico) !== Number(user_id_medico))
                            pacientes_datos[that.episodio_index]['medico_paciente'] = pacientes_datos[that
                                .episodio_index]['medico_paciente'].filter((mp, key) => Number(mp
                                .user_id_medico) !== Number(user_id_medico))
                            //console.log(pacientes_datos[ that.episodio_index ]['medico_paciente'])
                            that.deployMedicoPacienteList()
                            that.handleOptionListModal({
                                grupos_medicos_to_show,
                                color,
                                group_cargo,
                                position_id,
                                selector_cargo,
                                tippyContent,
                            })
                            Swal.fire(
                                `${group_cargo} retirado!`,
                                `El ${group_cargo} se retiró correctamente.`,
                                'success'
                            )
                        }
                    })
                }

            }
            renderListOption({
                grupos_medicos_to_show,
                medicoAsignado = false,
                position_id = null,
                color = "default",
                selector_cargo = null,
                group_cargo = null,
                group_cargo_siglas = "",
                imgError = "/image/system/patient.svg",
                imgDoctor = null,
                nameDoctor = "",
            }) {
                return /*html*/ `
                            <li
                                data-grupos_medicos_to_show="${grupos_medicos_to_show.join()}"
                                data-episodio_id="${this.paciente['episodio']}"
                                data-position_id="${position_id}"
                                data-color="${color}"
                                data-selector_cargo="${selector_cargo}"
                                data-group_cargo="${group_cargo}"
                                data-tippy-content="Equipo ${group_cargo}"
                                class="tooltip-${color} list-group-item cursor-pointer list-group-item-action p-0"
                            >
                                <div class="d-flex flex-column">
                                    <!-- Tarjeta activa -->
                                    <div class="card-medic-team-active d-${medicoAsignado ? 'flex':'none'} align-items-center py-1">
                                        <div class="badge badge-${color} mx-2 medico-badge-width scale-in-hor-left">${group_cargo_siglas}</div>
                                        <img loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1" onerror="this.src='${imgError}'"  src="${imgDoctor}">
                                        <b class="text-nowrap">
                                            ${nameDoctor}
                                        </b>
                                    </div>
                                    <!-- Tarjeta inactiva -->
                                    <div class="card-medic-team-inactive d-${!medicoAsignado ? 'flex':'none'}  align-items-center">
                                        <div class="badge badge-${color} mx-2 medico-badge-width">${group_cargo_siglas}</div>
                                        <div class="overflow-hidden text-nowrap ">${group_cargo}</div>
                                    </div>
                                </div>
                            </li>
                        `
            }
            renderMedicoPacienteList() {

                this.selector.innerHTML = null
                this.selector.innerHTML = `
                            <ul class="list-group list-group-flush">

                            </ul>
                        `

            }
            getMedicosAsignados(item) {
                return this.medic_teem_patient.filter(medic => item['id'].includes(medic[
                    'cat_user_medico_posicion_id']))
            }
            deployMedicoPacienteList() {
                let that = this
                this.renderMedicoPacienteList()

                this.cat_medic_teem_to_show().forEach((item, key) => {
                    //console.log(item)
                    //BUSCAR MEDICOS ASIGNADOS
                    let medicosAsignados = this.getMedicosAsignados(item)
                    //console.log({medicosAsignados});
                    //OBTENER ULTIMO MEDICO ASIGNADO
                    let object = {
                        grupos_medicos_to_show: item['grupos_medicos_to_show'],
                        position_id: item['id'].join(),
                        color: item['color'],
                        selector_cargo: item['selector_description'](),
                        group_cargo: item['description'],
                        group_cargo_siglas: item['sigla'](),
                    }
                    let ultimoMedicoAsignado = medicosAsignados.reduce((max, obj) => (obj.medico_paciente_id >
                        max.medico_paciente_id ? obj : max), medicosAsignados[0]);
                    //console.log('ultimoMedicoAsignado',item['grupos_medicos_to_show'].join().split(","))
                    if (!is_undefined(ultimoMedicoAsignado)) {
                        object = {
                            grupos_medicos_to_show: item['grupos_medicos_to_show'],
                            medicoAsignado: true,
                            position_id: item['id'].join(),
                            color: item['color'],
                            selector_cargo: item['selector_description'](),
                            group_cargo: item['description'],
                            group_cargo_siglas: item['sigla'](),
                            nameDoctor: ultimoMedicoAsignado['medico'],
                            imgDoctor: ultimoMedicoAsignado['medico_img']
                        }
                    }
                    //console.log(object)

                    let option = that.renderListOption(object)
                    that.selector.querySelector(`ul`).insertAdjacentHTML("beforeend", option)


                })
                //EVENTO CLICK PARA CADA OPCIÓN
                this.selector.querySelectorAll("li").forEach(optionHTML => {
                    optionHTML.addEventListener("click", (event) => {
                        //$("#modal-patient-item").modal("hide");
                        let {
                            grupos_medicos_to_show,
                            color,
                            group_cargo,
                            position_id,
                            selector_cargo,
                            tippyContent,
                        } = event.currentTarget.dataset
                        //console.log(event.currentTarget.dataset)
                        that.handleOptionListModal({
                            grupos_medicos_to_show,
                            color,
                            group_cargo,
                            position_id,
                            selector_cargo,
                            tippyContent,
                        })
                    })
                })

            }
        }
        d.addEventListener("DOMContentLoaded", async () => {
            cat_ubicaciones = [
                {
                    "id": 1,
                    "area_lv_1":"TP",
                    "area_lv_2":"SE",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Todos los pacientes",
                    "description": "TP",
                    "parent_cat_user_ubicacion_id": null,
                    "coments": "TP",
                    "orden": 1,
                    "route": "medico/tp",
                    "grupo": null,
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 2,
                    "area_lv_1":"EA",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Emergencia Adulto",
                    "description": "EA",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "EA",
                    "orden": 2,
                    "route": "medico/ea",
                    "grupo": "emergencia_adulto",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 3,
                    "area_lv_1":"EA",
                    "area_lv_2":"Triaje",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "EA Triaje",
                    "description": "EA",
                    "parent_cat_user_ubicacion_id": 2,
                    "coments": "Triaje",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_adulto_triaje",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 4,
                    "area_lv_1":"EA",
                    "area_lv_2":"Triaje",
                    "area_lv_3":"A",
                    "area_lv_4":"",
                    "name": "EA Triaje A",
                    "description": "EA",
                    "parent_cat_user_ubicacion_id": 3,
                    "coments": "A",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_adulto_triaje_a",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 5,
                    "area_lv_1":"EA",
                    "area_lv_2":"Triaje",
                    "area_lv_3":"B",
                    "area_lv_4":"",
                    "name": "EA Triaje B",
                    "description": "EA",
                    "parent_cat_user_ubicacion_id": 3,
                    "coments": "B",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_adulto_triaje_b",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 28,
                    "area_lv_1":"EP",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Emergencia Pediátrica",
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "EP",
                    "orden": 3,
                    "route": "medico/ep",
                    "grupo": "emergencia_pediatrica",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 29,
                    "area_lv_1":"EP",
                    "area_lv_2":"Triaje",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 28,
                    "coments": "Triaje",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_triaje",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 30,
                    "area_lv_1":"EP",
                    "area_lv_2":"Triaje",
                    "area_lv_3":"A",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 29,
                    "coments": "Ubi A",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_triaje_a",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 31,
                    "area_lv_1":"EP",
                    "area_lv_2":"Triaje",
                    "area_lv_3":"B",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 29,
                    "coments": "Ubi B",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_triaje_b",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 32,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 28,
                    "coments": "Obs",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 33,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 1",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 1",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_1",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 34,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 2",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 2",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_2",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 35,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 3",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 3",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_3",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 36,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 4",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 4",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_4",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 37,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 5",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 5",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_5",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 38,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 6",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 6",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_6",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 39,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 7",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 7",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_7",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 40,
                    "area_lv_1":"EP",
                    "area_lv_2":"OBS",
                    "area_lv_3":"CUB 8",
                    "area_lv_4":"",
                    "name": null,
                    "description": "EP",
                    "parent_cat_user_ubicacion_id": 32,
                    "coments": "Cub. 8",
                    "orden": null,
                    "route": null,
                    "grupo": "emergencia_pediatrica_obs_8",
                    "level": null,
                    "survey_id": 2,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 41,
                    "area_lv_1":"AQX",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Área Quirúrgica",
                    "description": "AQ",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "AQ",
                    "orden": 4,
                    "route": "medico/aq",
                    "grupo": "area_quirurgica",
                    "level": null,
                    "survey_id": 10,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 42,
                    "area_lv_1":"HP2",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Hospitalización Piso 2",
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "HP2",
                    "orden": 5.1,
                    "route": "medico/hp2",
                    "grupo": "hospitalizacion_piso_2",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 44,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2201",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2201",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_1",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 45,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2202",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2202",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_2",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 46,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2203",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2203",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_3",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 47,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2204",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2204",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_4",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 48,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2205",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2205",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_5",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 49,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2206",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2206",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_6",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 50,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2207",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2207",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_7",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 51,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2208",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2208",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_8",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 52,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2209",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2209",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_9",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 53,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2210",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2210",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_10",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 54,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2211",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2211",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_11",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:53",
                    "updated_at": "2020-12-15 06:12:53",
                    "deleted_at": null
                },
                {
                    "id": 55,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2212",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2212",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_12",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 56,
                    "area_lv_1":"HP2",
                    "area_lv_2":"A",
                    "area_lv_3":"2213",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2213",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_13",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 57,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2214",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2214",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_14",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 58,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2215",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2215",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_15",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 59,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2216",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2216",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_16",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 60,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2217",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2217",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_17",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 61,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2218",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2218",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_18",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 62,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2219",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2219",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_19",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 63,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2220",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2220",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_20",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 64,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2221",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2221",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_21",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 65,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2222",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2222",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_22",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 66,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2223",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2223",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_23",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 67,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2224",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2224",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_24",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 68,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2225",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": 42,
                    "coments": "Hab. 2225",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_25",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 69,
                    "area_lv_1":"HP2",
                    "area_lv_2":"B",
                    "area_lv_3":"2226",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP2",
                    "parent_cat_user_ubicacion_id": null,
                    "coments": "Hab. 2226",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_2_26",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 70,
                    "area_lv_1":"HP3",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Hospitalización Piso 3",
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "HP3",
                    "orden": 6,
                    "route": "medico/hp3",
                    "grupo": "hospitalizacion_piso_3",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 71,
                    "area_lv_1":"HP3",
                    "area_lv_2":"ALA A",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "HP3-A",
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 70,
                    "coments": "Ala A",
                    "orden": null,
                    "route": null,
                    "grupo": null,
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 72,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2301",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2301",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_1",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 73,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2302",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2302",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_2",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 74,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2303",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2303",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_3",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 75,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2304",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2304",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_4",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 76,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2305",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2305",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_5",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 77,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2306",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2306",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_6",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 78,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2307",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2307",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_7",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 79,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2308",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2308",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_8",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 80,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2309",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2309",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_9",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 81,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2310",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2310",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_10",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 82,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2311",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2311",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_11",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 83,
                    "area_lv_1":"HP3",
                    "area_lv_2":"A",
                    "area_lv_3":"2312",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 71,
                    "coments": "Hab. 2312",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_12",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 84,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2313",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2313",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_13",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 85,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2314",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2314",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_14",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 86,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2315",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2315",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_15",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 87,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2316",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2316",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_16",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 88,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2317",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2317",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_17",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 89,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2318",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2318",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_18",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 90,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2319",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2319",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_19",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 91,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2320",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2320",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_20",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 92,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2321",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2321",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_21",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 93,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2322",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2322",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_22",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 94,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2323",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2323",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_23",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 95,
                    "area_lv_1":"HP3",
                    "area_lv_2":"B",
                    "area_lv_3":"2324",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP3",
                    "parent_cat_user_ubicacion_id": 235,
                    "coments": "Hab. 2324",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_3_24",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 98,
                    "area_lv_1":"HP4",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Hospitalización Piso 4",
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "HP4",
                    "orden": 7,
                    "route": "medico/hp4",
                    "grupo": "hospitalizacion_piso_4",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 99,
                    "area_lv_1":"HP4",
                    "area_lv_2":"ALA B",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "HP4-B",
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 98,
                    "coments": "Ala B",
                    "orden": null,
                    "route": null,
                    "grupo": null,
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 100,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2401",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2401",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_1",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 101,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2402",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2402",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_2",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 102,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2403",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2403",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_3",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 103,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2404",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2404",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_4",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 104,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2405",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2405",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_5",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 105,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2406",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2406",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_6",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 106,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2407",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2407",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_7",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 107,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2408",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2408",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_8",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 108,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2409",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2409",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_9",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 109,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2410",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2410",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_10",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 110,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2411",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2411",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_11",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 111,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2412",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2412",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_12",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 112,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2413",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2413",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_13",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 113,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2414",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2414",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_14",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 114,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2415",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2415",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_15",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 115,
                    "area_lv_1":"HP4",
                    "area_lv_2":"A",
                    "area_lv_3":"2416",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 236,
                    "coments": "Hab. 2416",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_16",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 116,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2417",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2417",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_17",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 117,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2418",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2418",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_18",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 118,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2419",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2419",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_19",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 119,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2420",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2420",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_20",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 120,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2421",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2421",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_21",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 121,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2422",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2422",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_22",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 122,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2423",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2423",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_23",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 123,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2424",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2424",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_24",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 124,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2425",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2425",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_25",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 125,
                    "area_lv_1":"HP4",
                    "area_lv_2":"B",
                    "area_lv_3":"2426",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP4",
                    "parent_cat_user_ubicacion_id": 99,
                    "coments": "Hab. 2426",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_4_26",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 126,
                    "area_lv_1":"HP5",
                    "area_lv_2":"",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "Hospitalización Piso 5",
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 1,
                    "coments": "HP5",
                    "orden": 8,
                    "route": "medico/hp5",
                    "grupo": "hospitalizacion_piso_5",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 127,
                    "area_lv_1":"HP5",
                    "area_lv_2":"ALA A",
                    "area_lv_3":"",
                    "area_lv_4":"",
                    "name": "HP5-A",
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 126,
                    "coments": "Ala A",
                    "orden": null,
                    "route": null,
                    "grupo": null,
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 128,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2501",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2501",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_1",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 129,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2502",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2502",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_2",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 130,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2503",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2503",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_3",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 131,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2504",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2504",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_4",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 132,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2505",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2505",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_5",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 133,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2506",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2506",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_6",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 134,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2507",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2507",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_7",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 135,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2508",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2508",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_8",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 136,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2509",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2509",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_9",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 137,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2510",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2510",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_10",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 138,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2511",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2511",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_11",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 139,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2512",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2512",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_12",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 140,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2513",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2513",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_13",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 141,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2514",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2514",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_14",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 142,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2515",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2515",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_15",
                    "level": null,
                    "survey_id": 1,
                    "active": "1",
                    "user_id_medico": null,
                    "created_at": "2020-12-15 06:12:54",
                    "updated_at": "2020-12-15 06:12:54",
                    "deleted_at": null
                },
                {
                    "id": 143,
                    "area_lv_1":"HP5",
                    "area_lv_2":"A",
                    "area_lv_3":"2516",
                    "area_lv_4":"",
                    "name": null,
                    "description": "HP5",
                    "parent_cat_user_ubicacion_id": 127,
                    "coments": "Hab. 2516",
                    "orden": null,
                    "route": null,
                    "grupo": "hospitalizacion_piso_5_16",
                    "level": null,
