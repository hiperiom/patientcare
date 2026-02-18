@extends('component.template')

@section('title')
    CMDLT | Patientcare@endsection
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @include('component.menu_paciente')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="wrapper">
            @yield('menu_2')
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

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
<script>
    $(document).ready(function () {
        //cargarPagina('mensaje','.mensaje')
        //cargarPagina('notificacion','.notificacion')
    });
</script>
@endsection
@section('css')

@endsection
