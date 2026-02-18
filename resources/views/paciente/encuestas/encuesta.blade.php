@extends('layouts.app')
@section('title')
    CMDLT | Encuesta | {{ ucfirst($survey->name) }}
@endsection
@section('header')
<header>
    <nav class="navbar navbar-expand navbar-primary navbar-light navbar-v2 justify-content-end">
        <div>
        <a class="mr-2" id="logoSystem" href="#"><img loading="lazy" style="height: 2em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"></a>
        </div>
    </nav>
</header>
<div class="container">
    <div class="bg-primary h1 text-center rounded">{{$survey->description}}</div>
    <div class="h4 text-center rounded" style="background-color: rgb(243, 238, 238); color: var(--primary);">Responda las siguientes preguntas en relación a:</div>
</div>
@endsection

@section('content')
{{-- Usuario está logeado? {{$userIsLogged}} --}}
    <survey-component :survey="{{json_encode($survey)}}" logged="{{$userIsLogged}}" base_url="{{env('APP_URL')}}" :discharged="{{json_encode($discharged)}}" :platform="{{$platform}}"/>
@endsection
