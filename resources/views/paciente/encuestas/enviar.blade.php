@extends('layouts.app2')
@section('title')
    CMDLT | Panel de envío de encuestas
@endsection
@section('header')
<header>
    <nav class="navbar navbar-expand bg-primary navbar-light navbar-v2 justify-content-between ">
        <div>
            <a href="/auth/menu_inicial_satisfaccion" class="ml-2 text-white"><i class="fas fa-reply"></i> VOLVER</a>
        </div>
        <div>
            <a class="mr-2" id="logoSystem" href="#"><img loading="lazy" style="height: 2em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"></a>
        </div>
    </nav>
</header>
<div class="h3 mx-3 text-primary font-weight-bold rounded text-center" style="background-color: var(--light);">
    <h4>Panel de envío de encuestas a los pacientes dados de alta</h4>
</div>
@endsection
@section('content')
    {{-- <list-dischargeds-component to_send="{{$toSend}}" send="{{$send}}" no_send="{{$noSend}}" sent="{{$sent}}"></list-dischargeds-component> --}}
    <list-dischargeds-component></list-dischargeds-component>
@endsection

@section('css')
@endsection
