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
        <input type="hidden" id="ingreso" value="{{ date('Y-m-d H:i:s') }}">
        <div class="content-wrapper">
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
    @include('component.menu_footer')
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            Component.viewPendientes("#content_1")
            //$("#modelId").modal("show")
        });
    </script>
@endsection
@section('css')
    <style>

    </style>
@endsection
