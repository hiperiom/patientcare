<!DOCTYPE html>
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        @yield('title')
    </title>
    <!-- INICIO LIMPIAR CACHE -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
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
    <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css">
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
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/dist/css/adminlte.css') }}">
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

    {{--         <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">
 --}}
    <link href="/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    <style>
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

        .datepicker table {
            margin: 0;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: 100% !important;
            height: 350px;
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
            width: 100% !important;
        }
    </style>


</head>

<body>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div id="app"></div>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="/js/sweetalert2@10.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="/js/select2.min.js"></script>
<script src="/plugin/intl-tel-input/build/js/intlTelInput.js"></script>

@yield('script')

</html>
