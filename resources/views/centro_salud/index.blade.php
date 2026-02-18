@extends('component.template')

@section('title', 'Lista de Centro de Salud')

<a href="{{route('centro_salud.create')}}" class="btn btn-success btn-sm float-right" data-toggle="tooltip" rel="tooltip" title="Crear Centro de Salud"><i class="fas fa-plus fa-fw"></i> Crear Centro de Salud</a>
<h1> Centro de Salud</h1>

@section('content')
    <div>
        <div class="card">
            @if($centro_salud->count())
                @include('include.mensaje')            
                <div class="card-body">
                    <table class="table table-striped" id="pricing-table" data-order='[[ 0, "desc" ]]'>
                        <thead>
                            <tr>
                                <th class="d-none">Id</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($centro_salud as $item)
                                <tr>
                                    <td class="d-none">{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td width="150px" class="text-center">

                                        <a onclick="ver('{{route('centro_salud.show', $item)}}')" class="btn btn-sm btn-primary mr-2" data-toggle="tooltip" rel="tooltip" title="Mostrar Centro de Salud">
                                            <i class="fas fa-eye"></i> 
                                        </a>  

                                        <a href="{{route('centro_salud.edit', $item)}}" class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" rel="tooltip" title="Editar Centro de Salud">
                                            <i class="fas fa-edit"></i> 
                                        </a>

                                        <form action="{{route('centro_salud.destroy', $item)}}" method="POST" class="formulario-eliminar d-inline">                                                
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" rel="tooltip" title="Eliminar Centro de Salud">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>        
            @else
                <div class="card-body">
                    @include('include.sin-registros')
                </div>
            @endif
        </div>
    </div>
@stop

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset("js/pricing-table.js")}}" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('include.acciones')