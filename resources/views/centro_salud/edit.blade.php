@extends('component.template')

@section('title', 'Editar Centro de Salud')


<a href="{{route('centro_salud.index')}}" class="btn btn-secondary btn-sm float-right" data-toggle="tooltip" rel="tooltip" title="Regresar"><i class="fas fa-reply-all fa-fw"></i> Regresar</a>
<h1> Editar Centro de Salud</h1>

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('centro_salud.update', ['centro_salud' => $data->id])}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                @method('put')
                @csrf
                <div class="card-body">
                    @include('include.form-error')
                    @include('include.mensaje')
                    @include('centro_salud.partials.form')
                </div>
                <div class="card-footer text-muted">
                    @include('include.boton-form-editar')
                </div>
            </form>
        </div>
    </div>
@stop