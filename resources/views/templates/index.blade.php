@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal_v2')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
        @yield('menu_2')
        <div class="">
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

@endsection
@section('script')


@endsection
@section('css')

@endsection
