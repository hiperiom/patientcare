@extends('layouts.app')
@section('title')
    CMDLT | Estadísticas
@endsection
@section('css')
    <style>
        .card-header-coments:hover{
            background-color:var(--light);
            color:var(--primary);
        }
        .input-date:hover{
            background-color:var(--light);
            cursor:pointer;
        }
        .small-box {
            border-radius: 2rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }
        .small-box>.small-box-footer {
            background: rgba(0, 0, 0, 0.1);
            color: rgba(255, 255, 255, 0.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
            border-radius: 0px 0px 30px 30px;
        }
        .bg-warning, .bg-warning>a {
            color: #ffffff !important;
        }
        ol {
            list-style: none;

        }
        ol li.titulo-section {
            counter-increment: my-awesome-counter;

        }
        ol li.titulo-section::before {
            content: counter(my-awesome-counter) " | ";


            color: var(--secondary);
            font-weight: bold;


            font-size: 1.5em;
            text-align: center;
        }
        .direct-chat-messages {
            height: auto;
            padding: 0px;
        }
        .card-body {
            padding: 0px;
        }
    </style>
@endsection
@section('header')
<header>
    <nav class="navbar navbar-expand navbar-primary navbar-light navbar-v2 justify-content-between">
    <div>
            <a href="/auth/menu_inicial_satisfaccion" class="ml-2 text-white"><i class="fas fa-reply"></i> VOLVER</a>
        </div>
        <div>
            <a class="mr-2" id="logoSystem" href="#"><img loading="lazy" style="height: 2em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"></a>
        </div>
    </nav>
</header>
<div class="h3 p-1 text-primary font-weight-bold text-center rounded" style="background-color: var(--light);">
    Encuestas hospitalarias CMDLT
</div>
@endsection

@section('content')
<index-statistics-component base_url="{{env('APP_URL')}}"></index-statistics-component>
@endsection
