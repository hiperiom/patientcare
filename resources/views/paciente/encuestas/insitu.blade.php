@extends('layouts.app')
@section('title')
    CMDLT | Encuestas Insitu
@endsection
@section('header')
<header>
    <nav class="navbar navbar-expand bg-primary navbar-light navbar-v2 justify-content-between ">
        <div>
            <a href="/auth/menu_inicial_principal" class="ml-2 text-white"><i class="fas fa-reply"></i> VOLVER</a>
        </div>
        <div>
            <a class="mr-2" id="logoSystem" href="#"><img loading="lazy" style="height: 2em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"></a>
        </div>
    </nav>
</header>
<div class="h3 mx-3 text-primary font-weight-bold rounded text-center" style="background-color: var(--light);">
    <h4>Panel de pacientes con alta y pre-alta médica en el área de hospitalización</h4>
</div>
@endsection
@section('content')
<list-surveys-insitu></list-surveys-insitu>
@endsection

@section('css')
@endsection
