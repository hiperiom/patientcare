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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/propia.css') }}" rel="stylesheet">

    <!-- Theme style -->
    <link href="/css/scale.css" rel="stylesheet"/>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
    <link rel="stylesheet" href="{{asset('image/system/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
    <style>
        :root {
            --blue: var(--primary);
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #DC3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #ffffff;
            --gray: #D9D9D9;
            --gray-dark: #343a40;
            --primary: #185BA9;
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
            --breakpoint-xl: 1200px;
        }
        .bg-primary{
            background-color: var(--primary) !important;
        }
        .btn-primary{
            background-color: var(--primary) !important;
        }
        .text-bg-primary{
            background-color: var(--primary) !important;
        }
        .text-primary{
            color: var(--primary) !important;
        }
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
        /* .body {
            font-family: 'Titillium Web', sans-serif;
        } */
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @yield('css')
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/propia.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script> --}}
</body>
</html>
