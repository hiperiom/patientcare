@extends('include.modal-content')

@section('titulo')
  <h3> Mostrar Centro de Salud</h3>
@endsection

@section('cuerpo')
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Nombre: </strong>{{$centro_salud->name}}</li>
    <li class="list-group-item"><strong>Fecha y hora de Creación: </strong>{{ \Carbon\Carbon::parse($centro_salud->created_at)->format('d/m/Y')}}</li>
  </ul>
@endsection

@section('footer')
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
@endsection