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
            var pacientes = @json($pacientes, JSON_PRETTY_PRINT);
            var hospitalizados = @json($hospitalizados, JSON_PRETTY_PRINT);
            var pad = @json($pad, JSON_PRETTY_PRINT);
            loading("#content_1")
            Component.viewMedico("#content_1",{pacientes:pacientes,hospitalizados:hospitalizados,pad:pad})

        });
    </script>
@endsection
@section('css')
    <style>

    </style>
@endsection
