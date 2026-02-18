<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/propia.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/dist/css/adminlte.css')}}">
    <link href="/css/scale.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
    <link rel="stylesheet" href="{{asset('image/system/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
    <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">

    @yield('css')
    <style>
        .loadingScreen {
            background-color: rgb(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: fixed;
            z-index: 1111111111111111;
            height: 100vh;
            width: 100%;
        }
        .tooltip-primary .tooltip-inner {background-color:var(--primary) !important;}
        .tooltip-secondary .tooltip-inner {background-color:var(--secondary) !important;}
        .tooltip-warning .tooltip-inner {background-color:var(--warning) !important;}
        .tooltip-success .tooltip-inner {background-color:var(--success) !important;}
        .tooltip-danger .tooltip-inner {background-color:var(--danger) !important;}
        .tooltip-info .tooltip-inner {background-color:var(--info) !important;}
    </style>
</head>
<body>
    <!-- inicio del velo -->

    <div id="loadingScreen" class="loadingScreen">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img loading="lazy" onerror="this.src='/image/system/patient.svg'" src="/image/system/logo-cmdlt-blanco.svg" class="mb-3" alt="Cmdlt" style="width: 140px; height: 80px">
            <div class="d-flex align-items-center  text-white justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
                <h4 class="pl-2 ">Por favor espere un momento...</h4>
            </div>
        </div>
    </div>

    <!-- Fin del velo  -->
    <div id="app">
        @yield('header')

        @yield('content')

        @yield('footer')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
