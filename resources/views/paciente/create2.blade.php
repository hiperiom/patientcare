@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if(!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')

<div class="content-wrapper">
    <div class="wrapper">
        <div id="paso1_cuestionario">
            <div class="d-flex justify-content-center mt-5 text-primary">
                <span class="float-left font-weight-bold">
                    Espere un momento por favor...
                </span>
                <span class="spinner-border float-right" role="status">
                    <span class="sr-only"></span>
                </span>
            </div>
        </div>
        <div id="paso2_recomendacion" style="display:none;"></div>
        <input type="hidden" id="cat_user_ubicacion_id" value="386">
        <input type="hidden" id="prioridad_lista" value="0">
    </div>
</div>
@endsection
@section('footer')
@include('component.menu_footer')
@endsection
@section('script')
<script>
    $(document).ready(function () {
        UserCuestPaciente.create3("#paso1_cuestionario")
    });
</script>
@endsection
@section('css')
<style>

</style>
@endsection
