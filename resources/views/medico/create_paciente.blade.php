@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
        @yield('menu_2')
        <div class="content-wrapper">
            <div class="wrapper">
                <div class="container">
                    <div id="content_1" class="mb-3">

                        <div class="d-flex m-4 justify-content-center text-primary">
                            Cargando...
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                    </div>
                    <div id="loading" style="display: none" class="mb-3">

                        <div class="d-flex m-4 justify-content-center text-primary">
                            Cargando...
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script src="{{ mix('js/app_registro_paciente_interno.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready( function () {

        });
    </script>
@endsection
@section('css')
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
    </style>
@endsection
