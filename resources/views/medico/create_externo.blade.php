@extends('component.template')

@section('title')
    CMDLT | Patientcare@endsection
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
            <div id="content_1" class="mb-4"></div>
        </div>
    </div>
@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script>
        $(function () {
            //CatUserEspecialidad.getIndex();
            UserMedico.create_externo("#content_1")
        });
    </script>
@endsection
@section('css')
    <style>

    </style>
@endsection
