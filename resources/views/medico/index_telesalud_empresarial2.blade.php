@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user_menu')
    @endif
@endsection
@section('content')
    @yield('menu_2')
    <div id="loading" class="loading">
        <div class="d-flex">
            <div class="text-primary">
                Espere un momento por favor...
            </div>
            <div>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div id="area_title" class="col-sm-7 h2 text-primary">
                Estadísticas Telesalud Empresarial
            </div>
            <div class="col-sm-5">
                <ul class="nav nav-pills justify-content-end" id="pills-telesalud-empresarial-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="btn-dashboard nav-link active" id="pills-dashboard-tab" data-toggle="pill"
                            href="#pills-dashboard" role="tab" aria-controls="pills-dashboard"
                            aria-selected="false">Dashboard</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn-orientaciones" id="pills-orientaciones-tab" data-toggle="pill"
                            href="#pills-orientaciones" role="tab" aria-controls="pills-orientaciones"
                            aria-selected="true">Orientaciones</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-pacientes-tab" data-toggle="pill" href="#pills-pacientes"
                            role="tab" aria-controls="pills-pacientes" aria-selected="false">Pacientes</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-empresas-tab" data-toggle="pill" href="#pills-empresas" role="tab"
                            aria-controls="pills-empresas" aria-selected="false">Empresas</a>
                    </li>


                </ul>

            </div>
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <!-- dashboard -->
                    <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                        aria-labelledby="pills-empresas">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-3 offset-md-3">
                                    <div class="form-group">
                                        <label class="text-primary float-left float-md-right"
                                            for="fecha_desde">Desde</label>
                                        <input type="date" value="{{ date('Y') . '-01-01' }}" name="fecha_desde"
                                            id="fecha_desde" class="form-control" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label class="text-primary" for="fecha_hasta">Hasta</label>
                                        <input type="date" value="{{ date('Y-m-d') }}" name="fecha_hasta"
                                            id="fecha_hasta" class="form-control" aria-describedby="helpId">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <div id="carouselExampleFade" class="carousel slide" data-ride="false">
                                        <div class="carousel-inner">
                                            <div class="container-fluid overflow-auto carousel-item active">
                                                <div class="row">
                                                    <div class="col-12 h3 text-center font-weight-bold text-primary">
                                                        Orientaciones
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                                                        <div class="total-item-1 d-flex flex-column align-items-center justify-content-start">
                                                            <div title="Total en el período anterior" class="total-item-anterior" style="position: relative;top: 80px;right: -75px;">
                                                                <small class="text-center">
                                                                    Período<br>
                                                                    anterior
                                                                </small>
                                                                <div id="orientaciones_total_anterior">
                                                                    0
                                                                </div>
                                                            </div>
                                                            <span id="orientaciones_total">00</span>
                                                            <h2 class="text-primary text-center">Orientaciones</h2>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                                        <div class="container-fluid">
                                                            <div class="row overflow-auto" id="orientaciones_subtotales">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid overflow-auto carousel-item">
                                                <div class="row">
                                                    <div class="col-12 h3 text-center font-weight-bold text-primary">
                                                        Pacientes
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                                                        <div class="total-item-1 d-flex flex-column align-items-center justify-content-start">
                                                            <div class="total-item-anterior"  style="position: relative;top: 80px;right: -75px;">
                                                                <small>
                                                                    Anterior
                                                                </small>
                                                                <div id="pacientes_total_anterior">
                                                                    0
                                                                </div>
                                                            </div>
                                                            <span id="pacientes_total">00</span>
                                                            <h2 class="text-primary text-center">Pacientes</h2>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                                        <div class="container-fluid">
                                                            <div class="row overflow-auto" id="pacientes_subtotales">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid overflow-auto carousel-item">
                                                <div class="row">
                                                    <div class="col-12 h3 text-center font-weight-bold text-primary">
                                                        Empresas
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                                                        <div class="total-item-1 d-flex flex-column align-items-center justify-content-start">
                                                            <div class="total-item-anterior"  style="position: relative;top: 80px;right: -75px;">
                                                                <small>
                                                                    Anterior
                                                                </small>
                                                                <div id="empresas_total_anterior">
                                                                    0
                                                                </div>
                                                            </div>
                                                            <span id="empresas_total">00</span>
                                                            <h2 class="text-primary text-center">Empresas</h2>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                                        <div class="container-fluid">
                                                            <div class="row overflow-auto" id="empresas_subtotales">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- orientaciones -->
                    <div class="tab-pane fade" id="pills-orientaciones" role="tabpanel"
                        aria-labelledby="pills-empresas">
                        <ul class="nav nav-pills mb-3" id="pills-orientaciones-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-orientaciones-list-tab" data-toggle="pill"
                                    href="#pills-orientaciones-list" role="tab"
                                    aria-controls="pills-orientaciones-list" aria-selected="true">Listado de
                                    orientaciones</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-orientaciones-create-tab" data-toggle="pill"
                                    href="#pills-orientaciones-create" role="tab"
                                    aria-controls="pills-orientaciones-create" aria-selected="false">Nueva
                                    orientación</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-orientaciones-list" role="tabpanel"
                                aria-labelledby="pills-orientaciones-list-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Listado de orientaciones</h3>
                                        </div>
                                        <div class="col-4">
                                            <input id="search_orientacion" type="search"
                                                placeholder="Escribe el texto a buscar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="table_orientacion" class="table table-bordered">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center text-primary">Fecha</th>
                                                            <th class="text-center text-primary">Paciente</th>
                                                            <th class="text-center text-primary">Empresa</th>
                                                            <th class="text-center text-primary">Tipo orientación</th>
                                                            <th class="text-center text-primary">Tipo comunicación</th>
                                                            <th class="text-center text-primary">Orientado por</th>
                                                            <th class="text-center text-primary">Especialidad</th>
                                                            <th class="text-center text-primary">Comentarios</th>
                                                            <th class="text-center text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary">No se
                                                                encontraron registros</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-orientaciones-create" role="tabpanel"
                                aria-labelledby="pills-orientaciones-create-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Nueva orientación</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cedula">Cédula del paciente:</label>
                                                <input type="text" class="form-control" id="cedula"
                                                    aria-describedby="cedulaHelp">
                                                <small id="cedulaHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="medico">Médico orientador:</label>
                                                <select class="form-control" id="medico"
                                                    aria-describedby="medicoHelp">
                                                    <!-- <option value="1">Medico 1</option>
                                                            <option value="2">Medico 2</option>
                                                            <option value="3">Medico 3</option> -->
                                                </select>
                                                <small id="medicoHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="medio_comunicacion">Tipo de comunicación:</label>
                                                <select class="form-control" id="medio_comunicacion"
                                                    aria-describedby="medio_comunicacionHelp">
                                                    <option value="2">Chat Motivapp</option>
                                                    <option value="1">Videollamada Pstelemed</option>
                                                    <option value="4">Llamada Telefónica</option>
                                                    <option value="3">Chat Whatsapp</option>
                                                    <option value="5">Llamada Whatsapp</option>
                                                </select>
                                                <small id="medio_comunicacionHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tipo_orientacion">Tipo de orientación:</label>
                                                <select class="form-control" id="tipo_orientacion"
                                                    aria-describedby="tipo_orientacionHelp">
                                                    <option value="1">Apoyo Emocional</option>
                                                    <option value="2">Salud</option>

                                                </select>
                                                <small id="tipo_orientacionHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="chat_text">Chat con el paciente:</label>
                                                <textarea class="form-control" id="chat_text" rows="5" aria-describedby="chat_textHelp"></textarea>
                                                <small id="chat_textHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="comentarios">Comentarios: <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <textarea class="form-control" id="comentarios" rows="2" aria-describedby="comentariosHelp"></textarea>
                                                <small id="comentariosHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="fecha_orientacion">Fecha de orientación:</label>
                                                <input class="form-control" type="date" value="{{ date('Y-m-d') }}"
                                                    id="fecha_orientacion">
                                                <small id="fecha_orientacionHelp" class="form-text text-muted"></small>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="chat_text">Suba Archivos:</label>
                                                <input class="form-control" type="file" multiple
                                                    style="height: 2.7rem;" id="chat_files">
                                                <small id="chat_textHelp" class="form-text text-muted"></small>
                                                <div id="chat_files_adjuntos" class="row justify-content-center"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row justify-content-center mb-5">
                                        <div class="col-6">
                                            <button id="orientacion_submit" class="btn btn-success btn-block">Guardar</button>
                                            <button id="orientacion_update" class="btn d-none btn-success btn-block">Actualizar</button>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>






                    </div>
                    <!-- pacientes -->
                    <div class="tab-pane fade" id="pills-pacientes" role="tabpanel" aria-labelledby="pills-pacientes">
                        <ul class="nav nav-pills mb-3" id="pills-pacientes-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-paciente-list-tab" data-toggle="pill"
                                    href="#pills-paciente-list" role="tab" aria-controls="pills-paciente-list"
                                    aria-selected="true">Listado de pacientes</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-paciente-create-tab" data-toggle="pill"
                                    href="#pills-paciente-create" role="tab" aria-controls="pills-paciente-create"
                                    aria-selected="false">Nuevo paciente</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-paciente-list" role="tabpanel"
                                aria-labelledby="pills-paciente-list-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Listado de pacientes</h3>
                                        </div>
                                        <div class="col-4">
                                            <input id="search_pacientes" type="search"
                                                placeholder="Escribe el texto a buscar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="table_pacientes" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-primary">#</th>
                                                            <th class="text-center text-primary">Paciente</th>
                                                            <th class="text-center text-primary">Cédula</th>
                                                            <th class="text-center text-primary">Género</th>
                                                            <th class="text-center text-primary">Teléfono</th>
                                                            <th class="text-center text-primary">Correo</th>
                                                            <th class="text-center text-primary">Empresa</th>
                                                            <th class="text-center text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="8" class="text-center text-primary">No se
                                                                encontraron pacientes</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-paciente-create" role="tabpanel"
                                aria-labelledby="pills-paciente-create-tab">
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-primary">Datos del paciente</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cedulapaciente">Cédula</label>
                                                <input type="text" class="form-control" id="cedulapaciente"
                                                    aria-describedby="cedulapacienteHelp">
                                                <small id="cedulapacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Correo electrónico <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="email"
                                                    aria-describedby="emailHelp">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="nombrespaciente">Nombres:</label>
                                                <input type="text" class="form-control" id="nombrespaciente"
                                                    aria-describedby="nombrespacienteHelp">
                                                <small id="nombrespacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="apellidospaciente">Apellidos:</label>
                                                <input type="text" class="form-control" id="apellidospaciente"
                                                    aria-describedby="apellidospacienteHelp">
                                                <small id="apellidospacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="generopaciente">Género:</label>
                                                <select type="text" class="form-control" id="generopaciente"
                                                    aria-describedby="generopacienteHelp">
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                </select>
                                                <small id="generopacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="telefono_movilpaciente">Teléfono <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="telefono_movilpaciente"
                                                    aria-describedby="telefono_movilpacienteHelp">
                                                <small id="telefono_movilpacienteHelp"
                                                    class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="empresa">Empresa:</label>
                                                <select type="text" class="form-control" id="empresa"
                                                    aria-describedby="empresaHelp">
                                                    <option value="1">Polar</option>

                                                </select>
                                                <small id="empresaHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <button id="paciente_submit"
                                                class="btn btn-success btn-block">Guardar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- empresas -->
                    <div class="tab-pane fade" id="pills-empresas" role="tabpanel"
                        aria-labelledby="pills-orientaciones">
                        <ul class="nav nav-pills mb-3" id="pills-empresas-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-empresa-list-tab" data-toggle="pill"
                                    href="#pills-empresa-list" role="tab" aria-controls="pills-empresa-list"
                                    aria-selected="true">Listado de Empresas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-none" id="pills-empresa-create-tab" data-toggle="pill"
                                    href="#pills-empresa-create" role="tab" aria-controls="pills-empresa-create"
                                    aria-selected="false">Nueva Empresa</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-empresa-list" role="tabpanel"
                                aria-labelledby="pills-empresa-list-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Empresas</h3>
                                        </div>
                                        <div class="col-4">
                                            <input ID="search_empresa" type="search"
                                                placeholder="Escribe el texto a buscar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="table_empresas" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-primary">#</th>
                                                            <th class="text-center text-primary">Razón Social</th>
                                                            <th class="text-center text-primary">RIF</th>
                                                            <th class="text-center text-primary">Imagen</th>
                                                            <th class="text-center text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary">No se
                                                                encontraron registros</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-empresa-create" role="tabpanel"
                                aria-labelledby="pills-empresa-create-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-primary">Datos de la empresa</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="nombresEmpresa">Nombre de la empresa:</label>
                                                <input type="text" class="form-control" id="nombresEmpresa"
                                                    aria-describedby="nombresEmpresaHelp">
                                                <small id="nombresEmpresaHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="rif">Rif</label>
                                                <input type="text" class="form-control" id="rif"
                                                    aria-describedby="rifHelp">
                                                <small id="rifHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="telefono_movil">Teléfono <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="telefono_movil"
                                                    aria-describedby="telefono_movilHelp">
                                                <small id="telefono_movilHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="correo_movil">Correo electrónico <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="correo_movil"
                                                    aria-describedby="correo_movilHelp">
                                                <small id="correo_movilHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalOrientacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Chat paciente: <span id="modal-nombre_paciente"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div id="modal_chat_text" class="overflow-auto text-left"
                                    style="max-height:50vh;white-space: break-spaces;"></div>
                            </div>
                        </div>
                        <div id="modal_adjuntos" class="row justify-content-center"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Regresar</button>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
@endsection
@section('script')
    <script>
        //DEFINICION DE VARIABLES
        let tempCounter = 1
        let useState = {
            empresas: [],
            pacientes: [],
            medicos: [],
            orientacion: [],
            tipo_comunicacion:[
                {
                    id:1,
                    description:"Videollamada Pstelemed",
                    active:1
                },
                {
                    id:2,
                    description:"Chat Motivapp",
                    active:1
                },
                {
                    id:3,
                    description:"Chat Whatsapp",
                    active:1
                },
                {
                    id:4,
                    description:"Llamada telefónica",
                    active:1
                },
                {
                    id:5,
                    description:"Llamada Whatsapp",
                    active:1
                },
            ],

        }
        let d = document
        let $loading = entById("loading")
        let $container = d.querySelector("#pills-telesalud-empresarial-tab")
        let area_title = entById('area_title')
        let fecha_desde
        let fecha_hasta
        let fecha_desde_anterior
        let fecha_hasta_anterior

        //let area_title = entById('area_title')
        let orientaciones_total = entById('orientaciones_total')
        let orientaciones_total_anterior = entById('orientaciones_total_anterior')

        let pacientes_total = entById('pacientes_total')
        let pacientes_total_anterior = entById('pacientes_total_anterior')

        let empresas_total = entById('empresas_total')
        let empresas_total_anterior = entById('empresas_total_anterior')

        let total_motivapp = entById('total_motivapp')
        let orientaciones_subtotales = entById('orientaciones_subtotales')


        //FUNCIONES
        let fechaEnMilisegundos = (fecha)=>{
            let [anio, mes, dia] = fecha.split("-")
            let newfecha = new Date(Number(anio),(Number(mes)-1),Number(dia))
                //console.log(newfecha)
                return newfecha.getTime()

        }
        let dashboard_empresas = async ()=>{
            let {
                tipo_comunicacion,
                empresas
            } = useState

            let pacientes_anteriores =  empresas.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde_anterior) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta_anterior)
                )
            let pacientes_actuales = empresas.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta)
                )

            // orientaciones_subtotales.innerHTML = null

            pacientes_total_anterior.textContent =  pacientes_anteriores.length
            pacientes_total.textContent =  pacientes_actuales.length


        }
        let dashboard_pacientes = async ()=>{
            let {

                pacientes
            } = useState

            let pacientes_anteriores =  pacientes.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde_anterior) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta_anterior)
                )
            let pacientes_actuales = pacientes.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta)
                )

            // orientaciones_subtotales.innerHTML = null

            pacientes_total_anterior.textContent =  pacientes_anteriores.length
            pacientes_total.textContent =  pacientes_actuales.length


        }
        let dashboard_orientaciones = async ()=>{
            let {
                tipo_comunicacion,
                orientacion
            } = useState

            let orientaciones_anteriores =  orientacion.filter(x=>
                    fechaEnMilisegundos(x['fecha_orientacion']) >= fechaEnMilisegundos(fecha_desde_anterior) &&
                    fechaEnMilisegundos(x['fecha_orientacion']) <= fechaEnMilisegundos(fecha_hasta_anterior)
                )
            let orientaciones_actuales = orientacion.filter(x=>
                    fechaEnMilisegundos(x['fecha_orientacion']) >= fechaEnMilisegundos(fecha_desde) &&
                    fechaEnMilisegundos(x['fecha_orientacion']) <= fechaEnMilisegundos(fecha_hasta)
                )

            orientaciones_subtotales.innerHTML = null

            orientaciones_total_anterior.textContent =  orientaciones_anteriores.length
            orientaciones_total.textContent =  orientaciones_actuales.length

            tipo_comunicacion.forEach(el => {
                let {description,id} = el
                let actual = orientaciones_actuales.filter(item=>equalsInt(item['cat_tipo_comunicacion'],id))
                let anterior = orientaciones_anteriores.filter(item=>equalsInt(item['cat_tipo_comunicacion'],id))

                    orientaciones_subtotales.insertAdjacentHTML("beforeend",`
                        <div id="${id}" class="col-6 col-lg-4">
                            <div class="total-item-2 d-flex flex-column align-items-center justify-content-start">
                                <div title="Total en el período anterior" class="total-item-anterior">
                                    <small class="text-center">
                                        Período<br>
                                        anterior
                                    </small>
                                    <div>
                                        ${anterior.length}
                                    </div>
                                </div>
                                <span>${actual.length}</span>
                                <h2 class="text-primary text-center">${description}</h2>
                            </div>
                        </div>
                    `)
            });
        }
        let dashboard_container = async () => {
            let fechaHoy = new Date();
                $loading.classList.remove("d-none")

                fecha_desde = entById("fecha_desde").value
                fecha_hasta = entById("fecha_hasta").value

            let milisegundosArestar = ( fechaEnMilisegundos(fecha_hasta) - fechaEnMilisegundos(fecha_desde) )
            let fechaDesdeMilisegundosAnterior =   fechaEnMilisegundos(fecha_desde) - milisegundosArestar
                fecha_desde_anterior = new Date(fechaDesdeMilisegundosAnterior)
                console.log( `${fecha_desde_anterior.getFullYear()}-${fecha_desde_anterior.getMonth()+1}-${fecha_desde_anterior.getDate()}`)
                //console.log(fechaEnMilisegundos(fecha_desde))
            let [anio_hasta, mes_hasta, dia_hasta] = fecha_hasta.split("-")
            let [anio_desde, mes_desde, dia_desde] = fecha_desde.split("-")

                fecha_desde_anterior = `${fecha_desde_anterior.getFullYear()}-${String(fecha_desde_anterior.getMonth()+1).padStart(2, '0')}-${String(fecha_desde_anterior.getDate())}`
                fecha_hasta_anterior = `${anio_desde}-${mes_desde}-${dia_desde}`

                useState['orientacion'] = await get(location.origin + `/user/orientacion/index/${fecha_desde_anterior}/${fecha_hasta}`)
                useState['pacientes'] = await get(location.origin + `/user/profile/empresa/index/${fecha_desde_anterior}/${fecha_hasta}`)

                dashboard_orientaciones()
                dashboard_pacientes()
                dashboard_empresas()
                $loading.classList.add("d-none")
        }
        let filtroTablas = (selector1, selector2) => {
            //$("#busquedapaciente").val(paramPaciente)
            var table = document.getElementById(selector2).tBodies[0];
            let texto = document.getElementById(selector1).value.toLowerCase();
            var r = 0;
            while (row = table.rows[r++]) {
                if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                    row.style.display = null;
                else
                    row.style.display = 'none';
            }


        }

        let orientaciones_listado_container = async () => {
            if (is_null(useState['orientacion'])) {
                let fecha_desde = entById("fecha_desde").value
                let fecha_hasta = entById("fecha_hasta").value
                useState['orientacion'] = await get(location.origin +
                    `/user/orientacion/index/${fecha_desde}/${fecha_hasta}`)
            }
            let $orientaciones_listado = d.querySelector(`#pills-orientaciones-list table tbody`)
            let {
                orientacion
            } = useState

            if (orientacion.length === 0) {
                let totalColumnas = d.querySelector(`#pills-orientaciones-list table thead tr th`).length
                console.log(totalColumnas)
                $orientaciones_listado.innerHTML = `
                    <tr>
                        <td colspan="10" class="text-center text-primary">No se encontraron orientaciones</td>
                    </tr>
                `
            } else {


                let cat_tipo_comunicacion = {}
                cat_tipo_comunicacion["1"] = "Videollamada Pstelemed"
                cat_tipo_comunicacion["2"] = "Chat Motivapp"
                cat_tipo_comunicacion["3"] = "Chat whatsapp"
                cat_tipo_comunicacion["4"] = "Llamada Telefónica"
                cat_tipo_comunicacion["5"] = "Llamada whatsapp"

                $orientaciones_listado.innerHTML = null
                let total = orientacion.length
                orientacion.forEach((value, key) => {
                    let f = value['fecha_orientacion'].split("-")

                    let paciente = useState['pacientes'].find(x=>equalsInt( x['id'] , value['user_id_paciente'] ) )
                    console.log(paciente);
                    $orientaciones_listado.insertAdjacentHTML("beforeend", `
                        <tr id="row_${value['id']}">

                            <td class="text-nowrap">
                                ${f[2]}-${f[1]}-${f[0]}
                                <div class="text-white">
                                    ${value['user_id_paciente']}
                                </div>
                            </td>
                            <td>${paciente !== undefined ? paciente['paciente'] : ''}</td>
                            <td>${useState['empresas'].find(x=>equalsInt(x['id'],value['cat_empresa_id']))['razon_social']}</td>
                            <td>${value['cat_tipo_orientacion'] == 1?'Crecimiento Personal':'Salud'}</td>
                            <td>${cat_tipo_comunicacion[ value['cat_tipo_comunicacion'] ]  }</td>
                            <td>${useState['medicos'].find(x=> equalsInt( x['user_id'],value['user_id_medico'] ) )['medico']}</td>
                            <td>${useState['medicos'].find(x=>equalsInt(x['user_id'],value['user_id_medico']))['especialidad']}</td>
                            <td>${value['comentarios']===null?'':value['comentarios']}</td>
                            <td class="text-center text-nowrap">
                                <button title="Ver Chat" data-id="${value['id']}" class="btn-chat btn btn-default text-primary">
                                    <i data-id="${value['id']}" class="btn-chat fas fa-comment"></i>
                                </button>
                                <button title="Editar Orientación" data-id="${value['id']}" class="btn-edit btn btn-default text-primary">
                                    <i data-id="${value['id']}" class="btn-edit fas fa-edit"></i>
                                </button>
                                <button title="Eliminar registro" data-id="${value['id']}" class="btn-delete btn btn-default text-primary">
                                    <i data-id="${value['id']}" class="btn-delete fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `)
                })
            }
        }
        let orientaciones_store = async ()=>{
            let input = d.querySelector(`#pills-orientaciones-create #cedula`)

                if (input.value === "") {
                    alert("Debe escribir una cédula del paciente")
                    input.focus()
                    return false
                }
                input = d.querySelector(`#pills-orientaciones-create #chat_text`)

                if (input.value === "") {
                    alert("Debe escribir un texto en el campo del chat")
                    input.focus()
                    return false
                }

                $loading.classList.remove("d-none")

            let formData = new FormData();
            let date = new Date()
                formData.append("cat_empresa_id", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['cat_empresa_id'])
                formData.append("user_id_medico", d.querySelector(`#pills-orientaciones-create #medico`).value)
                formData.append("user_id_paciente", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['id'])
                formData.append("cat_tipo_orientacion", d.querySelector(
                `#pills-orientaciones-create #tipo_orientacion`).value)
                formData.append("cat_tipo_comunicacion", d.querySelector(
                `#pills-orientaciones-create #medio_comunicacion`).value)
                formData.append("fecha_orientacion", d.querySelector(
                `#pills-orientaciones-create #fecha_orientacion`).value)
                formData.append("chat", d.querySelector(`#pills-orientaciones-create #chat_text`).value)
                formData.append("comentarios", d.querySelector(`#pills-orientaciones-create #comentarios`)
                .value)
            let files = d.querySelector(`#pills-orientaciones-create #chat_files`).files
                formData.append("total_files", files.length)

                for (let i = 0; i < files.length; i++) {
                    formData.append(`file_${i}`, files[i])
                }

                formData.append("created_at", timestamps())
                formData.append("_token", d.querySelector("#_token").value)
            let orientacion_id = d.querySelector(`#pills-orientaciones-create`).dataset.orientacion_id
            let resultSet = await post(location.origin + `/user/orientacion/store`, formData)

                //console.log(resultSet)

                useState['orientacion'].unshift({
                    id: resultSet['id'],
                    cat_empresa_id: resultSet['cat_empresa_id'],

                    user_id_medico: resultSet['user_id_medico'],
                    user_id_paciente: resultSet['user_id_paciente'],
                    cat_tipo_orientacion: resultSet['cat_tipo_orientacion'],
                    cat_tipo_comunicacion: resultSet['cat_tipo_comunicacion'],
                    chat: resultSet['chat'],
                    comentarios: resultSet['comentarios'],
                    fecha_orientacion: resultSet['fecha_orientacion'],
                    created_at: resultSet['created_at'],

                    paciente: useState['pacientes'].find(x => equalsInt(x['id'], resultSet[
                        'user_id_paciente']))['paciente'],
                    empresa: useState['empresas'].find(x => equalsInt(x['id'], resultSet[
                        'cat_empresa_id']))['razon_social'],
                    medico: useState['medicos'].find(x => equalsInt(x['user_id'], resultSet[
                        'user_id_medico']))['medico'],
                    files: resultSet['files'],
                    especialidad_descripcion: useState['medicos'].find(x => equalsInt(x['user_id'],
                        resultSet['user_id_medico']))['especialidad'],
                }, )
                $loading.classList.add("d-none")

                Swal.fire(
                    'Registro exitoso',
                    'Los datos han sido guardado correctamente.',
                    'success'
                )

                orientaciones_listado_container()
                $('#pills-orientaciones a[href="#pills-orientaciones-list"]').tab('show')
                console.log(useState['orientacion']);
        }
        let orientaciones_update = async ()=>{
            let input = d.querySelector(`#pills-orientaciones-create #cedula`)

                if (input.value === "") {
                    alert("Debe escribir una cédula del paciente")
                    input.focus()
                    return false
                }
                input = d.querySelector(`#pills-orientaciones-create #chat_text`)

                if (input.value === "") {
                    alert("Debe escribir un texto en el campo del chat")
                    input.focus()
                    return false
                }

                $loading.classList.remove("d-none")

            let formData = new FormData();
            let date = new Date()
                formData.append("cat_empresa_id", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['cat_empresa_id'])
                formData.append("user_id_medico", d.querySelector(`#pills-orientaciones-create #medico`).value)
                formData.append("user_id_paciente", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['id'])
                formData.append("cat_tipo_orientacion", d.querySelector(
                `#pills-orientaciones-create #tipo_orientacion`).value)
                formData.append("cat_tipo_comunicacion", d.querySelector(
                `#pills-orientaciones-create #medio_comunicacion`).value)
                formData.append("fecha_orientacion", d.querySelector(
                `#pills-orientaciones-create #fecha_orientacion`).value)
                formData.append("chat", d.querySelector(`#pills-orientaciones-create #chat_text`).value)
                formData.append("comentarios", d.querySelector(`#pills-orientaciones-create #comentarios`)
                .value)
            let files = d.querySelector(`#pills-orientaciones-create #chat_files`).files
                formData.append("total_files", files.length)

                for (let i = 0; i < files.length; i++) {
                    formData.append(`file_${i}`, files[i])
                }

                formData.append("created_at", timestamps())
                formData.append("_token", d.querySelector("#_token").value)
            let orientacion_id = d.querySelector(`#pills-orientaciones-create`).dataset.orientacion_id
            let resultSet = await post(location.origin + `/user/orientacion/update/${orientacion_id}`, formData)

                //console.log(resultSet)
                let index = useState['orientacion'].findIndex(x=>equalsInt(x['id'],orientacion_id))
                useState['orientacion'][index] ={
                    id: resultSet['id'],
                    cat_empresa_id: resultSet['cat_empresa_id'],

                    user_id_medico: resultSet['user_id_medico'],
                    user_id_paciente: resultSet['user_id_paciente'],
                    cat_tipo_orientacion: resultSet['cat_tipo_orientacion'],
                    cat_tipo_comunicacion: resultSet['cat_tipo_comunicacion'],
                    chat: resultSet['chat'],
                    comentarios: resultSet['comentarios'],
                    fecha_orientacion: resultSet['fecha_orientacion'],
                    created_at: resultSet['created_at'],

                    paciente: useState['pacientes'].find(x => equalsInt(x['id'], resultSet[
                        'user_id_paciente']))['paciente'],
                    empresa: useState['empresas'].find(x => equalsInt(x['id'], resultSet[
                        'cat_empresa_id']))['razon_social'],
                    medico: useState['medicos'].find(x => equalsInt(x['user_id'], resultSet[
                        'user_id_medico']))['medico'],
                    files: resultSet['files'],
                    especialidad_descripcion: useState['medicos'].find(x => equalsInt(x['user_id'],
                        resultSet['user_id_medico']))['especialidad'],
                }

                $loading.classList.add("d-none")

                Swal.fire(
                    'Registro exitoso',
                    'Los datos han sido guardado correctamente.',
                    'success'
                )

                orientaciones_listado_container()
                $('#pills-orientaciones a[href="#pills-orientaciones-list"]').tab('show')
                console.log(useState['orientacion']);
        }
        let container_pacientes_listado = async () => {

            let $pacientes_listado = d.querySelector(`#pills-paciente-list table tbody`)
                if (is_null(useState['pacientes'])) {
                    let fecha_desde = entById("fecha_desde").value
                    let fecha_hasta = entById("fecha_hasta").value
                    useState['pacientes'] = await get(location.origin +
                        `/user/profile/empresa/index/${fecha_desde}/${fecha_hasta}`)
                }

            let {
                    pacientes
                } = useState

                if (pacientes.length === 0) {
                    let totalColumnas = d.querySelector(`#pills-paciente-list table thead tr th`).length
                    console.log(totalColumnas)
                    $pacientes_listado.innerHTML = `
                        <tr>
                            <td colspan="9" class="text-center text-primary">No se encontraron pacientes</td>
                        </tr>
                    `
                } else {
                    $pacientes_listado.innerHTML = null
                    let total = pacientes.length
                    pacientes.forEach((value, key) => {
                        $pacientes_listado.insertAdjacentHTML("beforeend", `
                                <tr id="row_${value['id']}">
                                    <td>${total--}</td>
                                    <td>${value['paciente']}</td>
                                    <td>${value['cedula']}</td>
                                    <td>${value['genero']==="f"?'Femenino':'Masculino'}</td>
                                    <td>${value['telefono_movil']===null?'':value['telefono_movil']}</td>
                                    <td>${value['correo']===null?'':value['correo']}</td>
                                    <td>${value['razon_social']===null?'':value['razon_social']}</td>
                                    <td class="text-center text-nowrap">
                                        <button title="Editar paciente" data-id="${value['id']}" class="btn-edit btn btn-default text-primary">
                                            <i data-id="${value['id']}" class="btn-edit fas fa-edit"></i>
                                        </button>
                                        <button title="Eliminar registro" data-id="${value['id']}" class="btn-delete btn btn-default text-primary">
                                            <i data-id="${value['id']}" class="btn-delete fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            `)
                    })
                }
        }
        let container_empresas_listado = async () => {
            let $empresas_listado = d.querySelector(`#pills-empresa-list table tbody`)
            if (is_empty(useState['empresas'])) {
                let fecha_desde = entById("fecha_desde").value
                let fecha_hasta = entById("fecha_hasta").value
                useState['empresas'] = await get(location.origin + `/cat/empresa/index`)
            }

            let {
                empresas
            } = useState
            console.log(useState['empresas'])
            if (useState['empresas'].length === 0) {
                let totalColumnas = d.querySelector(`#pills-paciente-list table thead tr th`).length
                console.log(totalColumnas)
                $empresas_listado.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-primary">No se encontraron empresas</td>
                    </tr>
                `
            } else {
                /*
                <td>${total--}</td>
                                <td>${value['paciente']}</td>
                                <td>${value['cedula']}</td>
                                <td>${value['genero']==="f"?'Femenino':'Masculino'}</td>
                                <td>${value['telefono_movil']===null?'':value['telefono_movil']}</td>
                                <td>${value['correo']===null?'':value['correo']}</td>
                                <td>${value['razon_social']===null?'':value['razon_social']}</td>
                */
                $empresas_listado.innerHTML = null
                let total = useState['empresas'].length
                empresas.forEach((value, key) => {
                    $empresas_listado.insertAdjacentHTML("beforeend", `
                            <tr id="row_${value['id']}">
                                <td>${value['id']}</td>
                                <td>${value['razon_social']}</td>
                                <td>${value['rif']}</td>
                                <td></td>
                                <td class="text-center text-nowrap">
                                    <button title="Editar paciente" data-id="${value['id']}" class="btn-edit btn btn-default text-primary">
                                        <i data-id="${value['id']}" class="btn-edit fas fa-edit"></i>
                                    </button>
                                    <button title="Eliminar registro" data-id="${value['id']}" class="btn-delete btn btn-default text-primary">
                                        <i data-id="${value['id']}" class="btn-delete fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `)
                })
            }
        }

        //INVOCACION DE FUNCIONES
        d.addEventListener("DOMContentLoaded", async ()=>{
            useState['medicos'] = await get(location.origin + `/medico/getMedicos`)
            useState['empresas'] = await get(location.origin + `/cat/empresa/index`)
            dashboard_container()

            //container_empresas_listado()
            $('#carouselExampleFade').carousel({
                interval: false,
            });
        })


        //EVENTOS
        d.querySelector("#fecha_desde").addEventListener("change", async (e) => {
            setTimeout(async () => {
                dashboard_container()
            }, 1000);

        })
        d.querySelector("#fecha_hasta").addEventListener("change", async (e) => {
            setTimeout(async () => {
                dashboard_container()
            }, 1000);
        })
        d.addEventListener("click", function(e) {
            if (e.target.matches("#pills-dashboard-tab")) {
                area_title.textContent = 'Estadísticas Telesalud Empresarial'
                dashboard_orientaciones()
            }
            if (e.target.matches("#pills-orientaciones-tab")) {
                area_title.textContent = 'Orientaciones'
                orientaciones_listado_container()
            }
            if (e.target.matches("#pills-pacientes-tab")) {
                area_title.textContent = 'Pacientes'
                container_pacientes_listado()
            }
            if (e.target.matches("#pills-empresas-tab")) {
                area_title.textContent = 'Empresas'
                console.log(e.target)
                container_empresas_listado()
            }
            if (e.target.matches("#pills-orientaciones-list-tab")) {
                //console.log(e.target )
                orientaciones_listado_container()
            }
            if (e.target.matches("#pills-orientaciones-create-tab")) {
                //console.log(e.target )
                d.querySelector(`#pills-orientaciones-create #medico`).innerHTML = null
                let medicos = useState['medicos'].map(medico => {
                    return {
                        id: medico['user_id'],
                        description: medico['medico']
                    }
                }).filter(x=>[18335,16906].includes(Number(x['id'])))

                medicos.forEach(x => {
                    d.querySelector(`#pills-orientaciones-create #medico`).insertAdjacentHTML("beforeend", `
                            <option value="${x['id']}">${x['description']}</option>
                        `)
                })
                let $form = d.querySelector('#pills-orientaciones-create')
                    $form.querySelector("#orientacion_submit").classList.remove('d-none')
                    $form.querySelector("#orientacion_update").classList.add('d-none')
            }
            if (e.target.matches("#pills-paciente-list-tab")) {
                //console.log(e.target )
                container_pacientes_listado()
            }
            if (e.target.matches("#pills-paciente-create-tab")) {
                let empresas = useState['empresas'].map(medico => {
                    return {
                        id: medico['id'],
                        description: medico['razon_social']
                    }
                })
                d.querySelector("#paciente_submit").classList.remove("paciente-update")
                d.querySelector("#paciente_submit").classList.add("paciente-store")

                d.querySelector(`#pills-paciente-create #empresa`).innerHTML = null
                empresas.forEach(x => {
                    d.querySelector(`#pills-paciente-create #empresa`).insertAdjacentHTML("beforeend", `
                            <option value="${x['id']}">${x['description']}</option>
                        `)
                })
            }

            if (e.target.matches("#pills-empresa-list-tab")) {
                console.log(e.target)
            }
            if (e.target.matches("#pills-empresa-create-tab")) {
                console.log(e.target)
            }

        })
        d.querySelector("#pills-paciente-list").addEventListener("click", async (e) => {
            //console.log(e.target)
            if (e.target.matches(".btn-edit")) {
                let empresas = useState['empresas'].map(medico => {
                    return {
                        id: medico['id'],
                        description: medico['razon_social']
                    }
                })
                d.querySelector("#paciente_submit").dataset['id'] = e.target.dataset['id']

                d.querySelector("#paciente_submit").classList.add("paciente-update")
                d.querySelector("#paciente_submit").classList.remove("paciente-store")
                d.querySelector(`#pills-paciente-create #empresa`).innerHTML = null
                empresas.forEach(x => {
                    d.querySelector(`#pills-paciente-create #empresa`).insertAdjacentHTML("beforeend", `
                            <option value="${x['id']}">${x['description']}</option>
                        `)
                })
                let user_id = e.target.dataset['id']
                let paciente = useState['pacientes'].find(paciente => equalsInt(paciente['id'], user_id))
                console.log(paciente)
                entById('cedulapaciente').value = paciente['cedula']
                entById('nombrespaciente').value = paciente['nombres']
                entById('apellidospaciente').value = paciente['apellidos']
                entById('email').value = paciente['correo']
                entById('generopaciente').value = paciente['genero']
                entById('telefono_movilpaciente').value = paciente['telefono_movil']
                @extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user_menu')
    @endif
@endsection
@section('content')
    @yield('menu_2')
    <div id="loading" class="loading">
        <div class="d-flex">
            <div class="text-primary">
                Espere un momento por favor...
            </div>
            <div>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div id="area_title" class="col-sm-7 h2 text-primary">
                Estadísticas Telesalud Empresarial
            </div>
            <div class="col-sm-5">
                <ul class="nav nav-pills justify-content-end" id="pills-telesalud-empresarial-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="btn-dashboard nav-link active" id="pills-dashboard-tab" data-toggle="pill"
                            href="#pills-dashboard" role="tab" aria-controls="pills-dashboard"
                            aria-selected="false">Dashboard</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn-orientaciones" id="pills-orientaciones-tab" data-toggle="pill"
                            href="#pills-orientaciones" role="tab" aria-controls="pills-orientaciones"
                            aria-selected="true">Orientaciones</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-pacientes-tab" data-toggle="pill" href="#pills-pacientes"
                            role="tab" aria-controls="pills-pacientes" aria-selected="false">Pacientes</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-empresas-tab" data-toggle="pill" href="#pills-empresas" role="tab"
                            aria-controls="pills-empresas" aria-selected="false">Empresas</a>
                    </li>


                </ul>

            </div>
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <!-- dashboard -->
                    <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                        aria-labelledby="pills-empresas">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-3 offset-md-3">
                                    <div class="form-group">
                                        <label class="text-primary float-left float-md-right"
                                            for="fecha_desde">Desde</label>
                                        <input type="date" value="{{ date('Y') . '-01-01' }}" name="fecha_desde"
                                            id="fecha_desde" class="form-control" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label class="text-primary" for="fecha_hasta">Hasta</label>
                                        <input type="date" value="{{ date('Y-m-d') }}" name="fecha_hasta"
                                            id="fecha_hasta" class="form-control" aria-describedby="helpId">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <div id="carouselExampleFade" class="carousel slide" data-ride="false">
                                        <div class="carousel-inner">
                                            <div class="container-fluid overflow-auto carousel-item active">
                                                <div class="row">
                                                    <div class="col-12 h3 text-center font-weight-bold text-primary">
                                                        Orientaciones
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                                                        <div class="total-item-1 d-flex flex-column align-items-center justify-content-start">
                                                            <div title="Total en el período anterior" class="total-item-anterior" style="position: relative;top: 80px;right: -75px;">
                                                                <small class="text-center">
                                                                    Período<br>
                                                                    anterior
                                                                </small>
                                                                <div id="orientaciones_total_anterior">
                                                                    0
                                                                </div>
                                                            </div>
                                                            <span id="orientaciones_total">00</span>
                                                            <h2 class="text-primary text-center">Orientaciones</h2>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                                        <div class="container-fluid">
                                                            <div class="row overflow-auto" id="orientaciones_subtotales">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid overflow-auto carousel-item">
                                                <div class="row">
                                                    <div class="col-12 h3 text-center font-weight-bold text-primary">
                                                        Pacientes
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                                                        <div class="total-item-1 d-flex flex-column align-items-center justify-content-start">
                                                            <div class="total-item-anterior"  style="position: relative;top: 80px;right: -75px;">
                                                                <small>
                                                                    Anterior
                                                                </small>
                                                                <div id="pacientes_total_anterior">
                                                                    0
                                                                </div>
                                                            </div>
                                                            <span id="pacientes_total">00</span>
                                                            <h2 class="text-primary text-center">Pacientes</h2>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                                        <div class="container-fluid">
                                                            <div class="row overflow-auto" id="pacientes_subtotales">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid overflow-auto carousel-item">
                                                <div class="row">
                                                    <div class="col-12 h3 text-center font-weight-bold text-primary">
                                                        Empresas
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center">
                                                        <div class="total-item-1 d-flex flex-column align-items-center justify-content-start">
                                                            <div class="total-item-anterior"  style="position: relative;top: 80px;right: -75px;">
                                                                <small>
                                                                    Anterior
                                                                </small>
                                                                <div id="empresas_total_anterior">
                                                                    0
                                                                </div>
                                                            </div>
                                                            <span id="empresas_total">00</span>
                                                            <h2 class="text-primary text-center">Empresas</h2>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                                        <div class="container-fluid">
                                                            <div class="row overflow-auto" id="empresas_subtotales">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- orientaciones -->
                    <div class="tab-pane fade" id="pills-orientaciones" role="tabpanel"
                        aria-labelledby="pills-empresas">
                        <ul class="nav nav-pills mb-3" id="pills-orientaciones-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-orientaciones-list-tab" data-toggle="pill"
                                    href="#pills-orientaciones-list" role="tab"
                                    aria-controls="pills-orientaciones-list" aria-selected="true">Listado de
                                    orientaciones</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-orientaciones-create-tab" data-toggle="pill"
                                    href="#pills-orientaciones-create" role="tab"
                                    aria-controls="pills-orientaciones-create" aria-selected="false">Nueva
                                    orientación</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-orientaciones-list" role="tabpanel"
                                aria-labelledby="pills-orientaciones-list-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Listado de orientaciones</h3>
                                        </div>
                                        <div class="col-4">
                                            <input id="search_orientacion" type="search"
                                                placeholder="Escribe el texto a buscar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="table_orientacion" class="table table-bordered">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center text-primary">Fecha</th>
                                                            <th class="text-center text-primary">Paciente</th>
                                                            <th class="text-center text-primary">Empresa</th>
                                                            <th class="text-center text-primary">Tipo orientación</th>
                                                            <th class="text-center text-primary">Tipo comunicación</th>
                                                            <th class="text-center text-primary">Orientado por</th>
                                                            <th class="text-center text-primary">Especialidad</th>
                                                            <th class="text-center text-primary">Comentarios</th>
                                                            <th class="text-center text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary">No se
                                                                encontraron registros</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-orientaciones-create" role="tabpanel"
                                aria-labelledby="pills-orientaciones-create-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Nueva orientación</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cedula">Cédula del paciente:</label>
                                                <input type="text" class="form-control" id="cedula"
                                                    aria-describedby="cedulaHelp">
                                                <small id="cedulaHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="medico">Médico orientador:</label>
                                                <select class="form-control" id="medico"
                                                    aria-describedby="medicoHelp">
                                                    <!-- <option value="1">Medico 1</option>
                                                            <option value="2">Medico 2</option>
                                                            <option value="3">Medico 3</option> -->
                                                </select>
                                                <small id="medicoHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="medio_comunicacion">Tipo de comunicación:</label>
                                                <select class="form-control" id="medio_comunicacion"
                                                    aria-describedby="medio_comunicacionHelp">
                                                    <option value="2">Chat Motivapp</option>
                                                    <option value="1">Videollamada Pstelemed</option>
                                                    <option value="4">Llamada Telefónica</option>
                                                    <option value="3">Chat Whatsapp</option>
                                                    <option value="5">Llamada Whatsapp</option>
                                                </select>
                                                <small id="medio_comunicacionHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tipo_orientacion">Tipo de orientación:</label>
                                                <select class="form-control" id="tipo_orientacion"
                                                    aria-describedby="tipo_orientacionHelp">
                                                    <option value="1">Apoyo Emocional</option>
                                                    <option value="2">Salud</option>

                                                </select>
                                                <small id="tipo_orientacionHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="chat_text">Chat con el paciente:</label>
                                                <textarea class="form-control" id="chat_text" rows="5" aria-describedby="chat_textHelp"></textarea>
                                                <small id="chat_textHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="comentarios">Comentarios: <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <textarea class="form-control" id="comentarios" rows="2" aria-describedby="comentariosHelp"></textarea>
                                                <small id="comentariosHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="fecha_orientacion">Fecha de orientación:</label>
                                                <input class="form-control" type="date" value="{{ date('Y-m-d') }}"
                                                    id="fecha_orientacion">
                                                <small id="fecha_orientacionHelp" class="form-text text-muted"></small>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="chat_text">Suba Archivos:</label>
                                                <input class="form-control" type="file" multiple
                                                    style="height: 2.7rem;" id="chat_files">
                                                <small id="chat_textHelp" class="form-text text-muted"></small>
                                                <div id="chat_files_adjuntos" class="row justify-content-center"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row justify-content-center mb-5">
                                        <div class="col-6">
                                            <button id="orientacion_submit" class="btn btn-success btn-block">Guardar</button>
                                            <button id="orientacion_update" class="btn d-none btn-success btn-block">Actualizar</button>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>






                    </div>
                    <!-- pacientes -->
                    <div class="tab-pane fade" id="pills-pacientes" role="tabpanel" aria-labelledby="pills-pacientes">
                        <ul class="nav nav-pills mb-3" id="pills-pacientes-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-paciente-list-tab" data-toggle="pill"
                                    href="#pills-paciente-list" role="tab" aria-controls="pills-paciente-list"
                                    aria-selected="true">Listado de pacientes</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-paciente-create-tab" data-toggle="pill"
                                    href="#pills-paciente-create" role="tab" aria-controls="pills-paciente-create"
                                    aria-selected="false">Nuevo paciente</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-paciente-list" role="tabpanel"
                                aria-labelledby="pills-paciente-list-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Listado de pacientes</h3>
                                        </div>
                                        <div class="col-4">
                                            <input id="search_pacientes" type="search"
                                                placeholder="Escribe el texto a buscar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="table_pacientes" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-primary">#</th>
                                                            <th class="text-center text-primary">Paciente</th>
                                                            <th class="text-center text-primary">Cédula</th>
                                                            <th class="text-center text-primary">Género</th>
                                                            <th class="text-center text-primary">Teléfono</th>
                                                            <th class="text-center text-primary">Correo</th>
                                                            <th class="text-center text-primary">Empresa</th>
                                                            <th class="text-center text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="8" class="text-center text-primary">No se
                                                                encontraron pacientes</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-paciente-create" role="tabpanel"
                                aria-labelledby="pills-paciente-create-tab">
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-primary">Datos del paciente</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cedulapaciente">Cédula</label>
                                                <input type="text" class="form-control" id="cedulapaciente"
                                                    aria-describedby="cedulapacienteHelp">
                                                <small id="cedulapacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Correo electrónico <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="email"
                                                    aria-describedby="emailHelp">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="nombrespaciente">Nombres:</label>
                                                <input type="text" class="form-control" id="nombrespaciente"
                                                    aria-describedby="nombrespacienteHelp">
                                                <small id="nombrespacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="apellidospaciente">Apellidos:</label>
                                                <input type="text" class="form-control" id="apellidospaciente"
                                                    aria-describedby="apellidospacienteHelp">
                                                <small id="apellidospacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="generopaciente">Género:</label>
                                                <select type="text" class="form-control" id="generopaciente"
                                                    aria-describedby="generopacienteHelp">
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                </select>
                                                <small id="generopacienteHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="telefono_movilpaciente">Teléfono <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="telefono_movilpaciente"
                                                    aria-describedby="telefono_movilpacienteHelp">
                                                <small id="telefono_movilpacienteHelp"
                                                    class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="empresa">Empresa:</label>
                                                <select type="text" class="form-control" id="empresa"
                                                    aria-describedby="empresaHelp">
                                                    <option value="1">Polar</option>

                                                </select>
                                                <small id="empresaHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <button id="paciente_submit"
                                                class="btn btn-success btn-block">Guardar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- empresas -->
                    <div class="tab-pane fade" id="pills-empresas" role="tabpanel"
                        aria-labelledby="pills-orientaciones">
                        <ul class="nav nav-pills mb-3" id="pills-empresas-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-empresa-list-tab" data-toggle="pill"
                                    href="#pills-empresa-list" role="tab" aria-controls="pills-empresa-list"
                                    aria-selected="true">Listado de Empresas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-none" id="pills-empresa-create-tab" data-toggle="pill"
                                    href="#pills-empresa-create" role="tab" aria-controls="pills-empresa-create"
                                    aria-selected="false">Nueva Empresa</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-empresa-list" role="tabpanel"
                                aria-labelledby="pills-empresa-list-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="text-primary">Empresas</h3>
                                        </div>
                                        <div class="col-4">
                                            <input ID="search_empresa" type="search"
                                                placeholder="Escribe el texto a buscar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="table_empresas" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-primary">#</th>
                                                            <th class="text-center text-primary">Razón Social</th>
                                                            <th class="text-center text-primary">RIF</th>
                                                            <th class="text-center text-primary">Imagen</th>
                                                            <th class="text-center text-primary">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary">No se
                                                                encontraron registros</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-empresa-create" role="tabpanel"
                                aria-labelledby="pills-empresa-create-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-primary">Datos de la empresa</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="nombresEmpresa">Nombre de la empresa:</label>
                                                <input type="text" class="form-control" id="nombresEmpresa"
                                                    aria-describedby="nombresEmpresaHelp">
                                                <small id="nombresEmpresaHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="rif">Rif</label>
                                                <input type="text" class="form-control" id="rif"
                                                    aria-describedby="rifHelp">
                                                <small id="rifHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="telefono_movil">Teléfono <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="telefono_movil"
                                                    aria-describedby="telefono_movilHelp">
                                                <small id="telefono_movilHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="correo_movil">Correo electrónico <i
                                                        class="text-muted">(Opcional)</i></label>
                                                <input type="text" class="form-control" id="correo_movil"
                                                    aria-describedby="correo_movilHelp">
                                                <small id="correo_movilHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalOrientacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Chat paciente: <span id="modal-nombre_paciente"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div id="modal_chat_text" class="overflow-auto text-left"
                                    style="max-height:50vh;white-space: break-spaces;"></div>
                            </div>
                        </div>
                        <div id="modal_adjuntos" class="row justify-content-center"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Regresar</button>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
@endsection
@section('script')
    <script>
        //DEFINICION DE VARIABLES
        let tempCounter = 1
        let useState = {
            empresas: [],
            pacientes: [],
            medicos: [],
            orientacion: [],
            tipo_comunicacion:[
                {
                    id:1,
                    description:"Videollamada Pstelemed",
                    active:1
                },
                {
                    id:2,
                    description:"Chat Motivapp",
                    active:1
                },
                {
                    id:3,
                    description:"Chat Whatsapp",
                    active:1
                },
                {
                    id:4,
                    description:"Llamada telefónica",
                    active:1
                },
                {
                    id:5,
                    description:"Llamada Whatsapp",
                    active:1
                },
            ],

        }
        let d = document
        let $loading = document.getElementById("loading")
        let $container = d.querySelector("#pills-telesalud-empresarial-tab")
        let area_title = document.getElementById('area_title')
        let fecha_desde
        let fecha_hasta
        let fecha_desde_anterior
        let fecha_hasta_anterior

        //let area_title = document.getElementById('area_title')
        let orientaciones_total = document.getElementById('orientaciones_total')
        let orientaciones_total_anterior = document.getElementById('orientaciones_total_anterior')

        let pacientes_total = document.getElementById('pacientes_total')
        let pacientes_total_anterior = document.getElementById('pacientes_total_anterior')

        let empresas_total = document.getElementById('empresas_total')
        let empresas_total_anterior = document.getElementById('empresas_total_anterior')

        let total_motivapp = document.getElementById('total_motivapp')
        let orientaciones_subtotales = document.getElementById('orientaciones_subtotales')


        //FUNCIONES
        let fechaEnMilisegundos = (fecha)=>{
            let [anio, mes, dia] = fecha.split("-")
            let newfecha = new Date(Number(anio),(Number(mes)-1),Number(dia))
                //console.log(newfecha)
                return newfecha.getTime()

        }
        let dashboard_empresas = async ()=>{
            let {
                tipo_comunicacion,
                empresas
            } = useState

            let pacientes_anteriores =  empresas.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde_anterior) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta_anterior)
                )
            let pacientes_actuales = empresas.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta)
                )

            // orientaciones_subtotales.innerHTML = null

            pacientes_total_anterior.textContent =  pacientes_anteriores.length
            pacientes_total.textContent =  pacientes_actuales.length


        }
        let dashboard_pacientes = async ()=>{
            let {

                pacientes
            } = useState

            let pacientes_anteriores =  pacientes.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde_anterior) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta_anterior)
                )
            let pacientes_actuales = pacientes.filter(x=>
                    fechaEnMilisegundos(x['created_at']) >= fechaEnMilisegundos(fecha_desde) &&
                    fechaEnMilisegundos(x['created_at']) <= fechaEnMilisegundos(fecha_hasta)
                )

            // orientaciones_subtotales.innerHTML = null

            pacientes_total_anterior.textContent =  pacientes_anteriores.length
            pacientes_total.textContent =  pacientes_actuales.length


        }
        let dashboard_orientaciones = async ()=>{
            let {
                tipo_comunicacion,
                orientacion
            } = useState

            let orientaciones_anteriores =  orientacion.filter(x=>
                    fechaEnMilisegundos(x['fecha_orientacion']) >= fechaEnMilisegundos(fecha_desde_anterior) &&
                    fechaEnMilisegundos(x['fecha_orientacion']) <= fechaEnMilisegundos(fecha_hasta_anterior)
                )
            let orientaciones_actuales = orientacion.filter(x=>
                    fechaEnMilisegundos(x['fecha_orientacion']) >= fechaEnMilisegundos(fecha_desde) &&
                    fechaEnMilisegundos(x['fecha_orientacion']) <= fechaEnMilisegundos(fecha_hasta)
                )

            orientaciones_subtotales.innerHTML = null

            orientaciones_total_anterior.textContent =  orientaciones_anteriores.length
            orientaciones_total.textContent =  orientaciones_actuales.length

            tipo_comunicacion.forEach(el => {
                let {description,id} = el
                let actual = orientaciones_actuales.filter(item=>equalsInt(item['cat_tipo_comunicacion'],id))
                let anterior = orientaciones_anteriores.filter(item=>equalsInt(item['cat_tipo_comunicacion'],id))

                    orientaciones_subtotales.insertAdjacentHTML("beforeend",`
                        <div id="${id}" class="col-6 col-lg-4">
                            <div class="total-item-2 d-flex flex-column align-items-center justify-content-start">
                                <div title="Total en el período anterior" class="total-item-anterior">
                                    <small class="text-center">
                                        Período<br>
                                        anterior
                                    </small>
                                    <div>
                                        ${anterior.length}
                                    </div>
                                </div>
                                <span>${actual.length}</span>
                                <h2 class="text-primary text-center">${description}</h2>
                            </div>
                        </div>
                    `)
            });
        }
        let dashboard_container = async () => {
            let fechaHoy = new Date();
                $loading.classList.remove("d-none")

                fecha_desde = document.getElementById("fecha_desde").value
                fecha_hasta = document.getElementById("fecha_hasta").value

            let milisegundosArestar = ( fechaEnMilisegundos(fecha_hasta) - fechaEnMilisegundos(fecha_desde) )
            let fechaDesdeMilisegundosAnterior =   fechaEnMilisegundos(fecha_desde) - milisegundosArestar
                fecha_desde_anterior = new Date(fechaDesdeMilisegundosAnterior)
                console.log( `${fecha_desde_anterior.getFullYear()}-${fecha_desde_anterior.getMonth()+1}-${fecha_desde_anterior.getDate()}`)
                //console.log(fechaEnMilisegundos(fecha_desde))
            let [anio_hasta, mes_hasta, dia_hasta] = fecha_hasta.split("-")
            let [anio_desde, mes_desde, dia_desde] = fecha_desde.split("-")

                fecha_desde_anterior = `${fecha_desde_anterior.getFullYear()}-${String(fecha_desde_anterior.getMonth()+1).padStart(2, '0')}-${String(fecha_desde_anterior.getDate())}`
                fecha_hasta_anterior = `${anio_desde}-${mes_desde}-${dia_desde}`

                useState['orientacion'] = await get(location.origin + `/user/orientacion/index/${fecha_desde_anterior}/${fecha_hasta}`)
                useState['pacientes'] = await get(location.origin + `/user/profile/empresa/index/${fecha_desde_anterior}/${fecha_hasta}`)

                dashboard_orientaciones()
                dashboard_pacientes()
                dashboard_empresas()
                $loading.classList.add("d-none")
        }
        let filtroTablas = (selector1, selector2) => {
            //$("#busquedapaciente").val(paramPaciente)
            var table = document.getElementById(selector2).tBodies[0];
            let texto = document.getElementById(selector1).value.toLowerCase();
            var r = 0;
            while (row = table.rows[r++]) {
                if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                    row.style.display = null;
                else
                    row.style.display = 'none';
            }


        }

        let orientaciones_listado_container = async () => {
            if (is_null(useState['orientacion'])) {
                let fecha_desde = document.getElementById("fecha_desde").value
                let fecha_hasta = document.getElementById("fecha_hasta").value
                useState['orientacion'] = await get(location.origin +
                    `/user/orientacion/index/${fecha_desde}/${fecha_hasta}`)
            }
            let $orientaciones_listado = d.querySelector(`#pills-orientaciones-list table tbody`)
            let {
                orientacion
            } = useState

            if (orientacion.length === 0) {
                let totalColumnas = d.querySelector(`#pills-orientaciones-list table thead tr th`).length
                console.log(totalColumnas)
                $orientaciones_listado.innerHTML = `
                    <tr>
                        <td colspan="10" class="text-center text-primary">No se encontraron orientaciones</td>
                    </tr>
                `
            } else {


                let cat_tipo_comunicacion = {}
                cat_tipo_comunicacion["1"] = "Videollamada Pstelemed"
                cat_tipo_comunicacion["2"] = "Chat Motivapp"
                cat_tipo_comunicacion["3"] = "Chat whatsapp"
                cat_tipo_comunicacion["4"] = "Llamada Telefónica"
                cat_tipo_comunicacion["5"] = "Llamada whatsapp"

                $orientaciones_listado.innerHTML = null
                let total = orientacion.length
                orientacion.forEach((value, key) => {
                    let f = value['fecha_orientacion'].split("-")

                    let paciente = useState['pacientes'].find(x=>equalsInt( x['id'] , value['user_id_paciente'] ) )
                    console.log(paciente);
                    $orientaciones_listado.insertAdjacentHTML("beforeend", `
                        <tr id="row_${value['id']}">

                            <td class="text-nowrap">
                                ${f[2]}-${f[1]}-${f[0]}
                                <div class="text-white">
                                    ${value['user_id_paciente']}
                                </div>
                            </td>
                            <td>${paciente !== undefined ? paciente['paciente'] : ''}</td>
                            <td>${useState['empresas'].find(x=>equalsInt(x['id'],value['cat_empresa_id']))['razon_social']}</td>
                            <td>${value['cat_tipo_orientacion'] == 1?'Crecimiento Personal':'Salud'}</td>
                            <td>${cat_tipo_comunicacion[ value['cat_tipo_comunicacion'] ]  }</td>
                            <td>${useState['medicos'].find(x=> equalsInt( x['user_id'],value['user_id_medico'] ) )['medico']}</td>
                            <td>${useState['medicos'].find(x=>equalsInt(x['user_id'],value['user_id_medico']))['especialidad']}</td>
                            <td>${value['comentarios']===null?'':value['comentarios']}</td>
                            <td class="text-center text-nowrap">
                                <button title="Ver Chat" data-id="${value['id']}" class="btn-chat btn btn-default text-primary">
                                    <i data-id="${value['id']}" class="btn-chat fas fa-comment"></i>
                                </button>
                                <button title="Editar Orientación" data-id="${value['id']}" class="btn-edit btn btn-default text-primary">
                                    <i data-id="${value['id']}" class="btn-edit fas fa-edit"></i>
                                </button>
                                <button title="Eliminar registro" data-id="${value['id']}" class="btn-delete btn btn-default text-primary">
                                    <i data-id="${value['id']}" class="btn-delete fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `)
                })
            }
        }
        let orientaciones_store = async ()=>{
            let input = d.querySelector(`#pills-orientaciones-create #cedula`)

                if (input.value === "") {
                    alert("Debe escribir una cédula del paciente")
                    input.focus()
                    return false
                }
                input = d.querySelector(`#pills-orientaciones-create #chat_text`)

                if (input.value === "") {
                    alert("Debe escribir un texto en el campo del chat")
                    input.focus()
                    return false
                }

                $loading.classList.remove("d-none")

            let formData = new FormData();
            let date = new Date()
                formData.append("cat_empresa_id", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['cat_empresa_id'])
                formData.append("user_id_medico", d.querySelector(`#pills-orientaciones-create #medico`).value)
                formData.append("user_id_paciente", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['id'])
                formData.append("cat_tipo_orientacion", d.querySelector(
                `#pills-orientaciones-create #tipo_orientacion`).value)
                formData.append("cat_tipo_comunicacion", d.querySelector(
                `#pills-orientaciones-create #medio_comunicacion`).value)
                formData.append("fecha_orientacion", d.querySelector(
                `#pills-orientaciones-create #fecha_orientacion`).value)
                formData.append("chat", d.querySelector(`#pills-orientaciones-create #chat_text`).value)
                formData.append("comentarios", d.querySelector(`#pills-orientaciones-create #comentarios`)
                .value)
            let files = d.querySelector(`#pills-orientaciones-create #chat_files`).files
                formData.append("total_files", files.length)

                for (let i = 0; i < files.length; i++) {
                    formData.append(`file_${i}`, files[i])
                }

                formData.append("created_at", timestamps())
                formData.append("_token", d.querySelector("#_token").value)
            let orientacion_id = d.querySelector(`#pills-orientaciones-create`).dataset.orientacion_id
            let resultSet = await post(location.origin + `/user/orientacion/store`, formData)

                //console.log(resultSet)

                useState['orientacion'].unshift({
                    id: resultSet['id'],
                    cat_empresa_id: resultSet['cat_empresa_id'],

                    user_id_medico: resultSet['user_id_medico'],
                    user_id_paciente: resultSet['user_id_paciente'],
                    cat_tipo_orientacion: resultSet['cat_tipo_orientacion'],
                    cat_tipo_comunicacion: resultSet['cat_tipo_comunicacion'],
                    chat: resultSet['chat'],
                    comentarios: resultSet['comentarios'],
                    fecha_orientacion: resultSet['fecha_orientacion'],
                    created_at: resultSet['created_at'],

                    paciente: useState['pacientes'].find(x => equalsInt(x['id'], resultSet[
                        'user_id_paciente']))['paciente'],
                    empresa: useState['empresas'].find(x => equalsInt(x['id'], resultSet[
                        'cat_empresa_id']))['razon_social'],
                    medico: useState['medicos'].find(x => equalsInt(x['user_id'], resultSet[
                        'user_id_medico']))['medico'],
                    files: resultSet['files'],
                    especialidad_descripcion: useState['medicos'].find(x => equalsInt(x['user_id'],
                        resultSet['user_id_medico']))['especialidad'],
                }, )
                $loading.classList.add("d-none")

                Swal.fire(
                    'Registro exitoso',
                    'Los datos han sido guardado correctamente.',
                    'success'
                )

                orientaciones_listado_container()
                $('#pills-orientaciones a[href="#pills-orientaciones-list"]').tab('show')
                console.log(useState['orientacion']);
        }
        let orientaciones_update = async ()=>{
            let input = d.querySelector(`#pills-orientaciones-create #cedula`)

                if (input.value === "") {
                    alert("Debe escribir una cédula del paciente")
                    input.focus()
                    return false
                }
                input = d.querySelector(`#pills-orientaciones-create #chat_text`)

                if (input.value === "") {
                    alert("Debe escribir un texto en el campo del chat")
                    input.focus()
                    return false
                }

                $loading.classList.remove("d-none")

            let formData = new FormData();
            let date = new Date()
                formData.append("cat_empresa_id", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['cat_empresa_id'])
                formData.append("user_id_medico", d.querySelector(`#pills-orientaciones-create #medico`).value)
                formData.append("user_id_paciente", useState['pacientes'].find(x => x['cedula'] == d
                .querySelector(`#pills-orientaciones-create #cedula`).value)['id'])
                formData.append("cat_tipo_orientacion", d.querySelector(
                `#pills-orientaciones-create #tipo_orientacion`).value)
                formData.append("cat_tipo_comunicacion", d.querySelector(
                `#pills-orientaciones-create #medio_comunicacion`).value)
                formData.append("fecha_orientacion", d.querySelector(
                `#pills-orientaciones-create #fecha_orientacion`).value)
                formData.append("chat", d.querySelector(`#pills-orientaciones-create #chat_text`).value)
                formData.append("comentarios", d.querySelector(`#pills-orientaciones-create #comentarios`)
                .value)
            let files = d.querySelector(`#pills-orientaciones-create #chat_files`).files
                formData.append("total_files", files.length)

                for (let i = 0; i < files.length; i++) {
                    formData.append(`file_${i}`, files[i])
                }

                formData.append("created_at", timestamps())
                formData.append("_token", d.querySelector("#_token").value)
            let orientacion_id = d.querySelector(`#pills-orientaciones-create`).dataset.orientacion_id
            let resultSet = await post(location.origin + `/user/orientacion/update/${orientacion_id}`, formData)

                //console.log(resultSet)
                let index = useState['orientacion'].findIndex(x=>equalsInt(x['id'],orientacion_id))
                useState['orientacion'][index] ={
                    id: resultSet['id'],
                    cat_empresa_id: resultSet['cat_empresa_id'],

                    user_id_medico: resultSet['user_id_medico'],
                    user_id_paciente: resultSet['user_id_paciente'],
                    cat_tipo_orientacion: resultSet['cat_tipo_orientacion'],
                    cat_tipo_comunicacion: resultSet['cat_tipo_comunicacion'],
                    chat: resultSet['chat'],
                    comentarios: resultSet['comentarios'],
                    fecha_orientacion: resultSet['fecha_orientacion'],
                    created_at: resultSet['created_at'],

                    paciente: useState['pacientes'].find(x => equalsInt(x['id'], resultSet[
                        'user_id_paciente']))['paciente'],
                    empresa: useState['empresas'].find(x => equalsInt(x['id'], resultSet[
                        'cat_empresa_id']))['razon_social'],
                    medico: useState['medicos'].find(x => equalsInt(x['user_id'], resultSet[
                        'user_id_medico']))['medico'],
                    files: resultSet['files'],
                    especialidad_descripcion: useState['medicos'].find(x => equalsInt(x['user_id'],
                        resultSet['user_id_medico']))['especialidad'],
                }

                $loading.classList.add("d-none")

                Swal.fire(
                    'Registro exitoso',
                    'Los datos han sido guardado correctamente.',
                    'success'
                )

                orientaciones_listado_container()
                $('#pills-orientaciones a[href="#pills-orientaciones-list"]').tab('show')
                console.log(useState['orientacion']);
        }
        let container_pacientes_listado = async () => {

            let $pacientes_listado = d.querySelector(`#pills-paciente-list table tbody`)
                if (is_null(useState['pacientes'])) {
                    let fecha_desde = document.getElementById("fecha_desde").value
                    let fecha_hasta = document.getElementById("fecha_hasta").value
                    useState['pacientes'] = await get(location.origin +
                        `/user/profile/empresa/index/${fecha_desde}/${fecha_hasta}`)
                }

            let {
                    pacientes
                } = useState

                if (pacientes.length === 0) {
                    let totalColumnas = d.querySelector(`#pills-paciente-list table thead tr th`).length
                    console.log(totalColumnas)
                    $pacientes_listado.innerHTML = `
                        <tr>
                            <td colspan="9" class="text-center text-primary">No se encontraron pacientes</td>
                        </tr>
                    `
                } else {
                    $pacientes_listado.innerHTML = null
                    let total = pacientes.length
                    pacientes.forEach((value, key) => {
                        $pacientes_listado.insertAdjacentHTML("beforeend", `
                                <tr id="row_${value['id']}">
                                    <td>${total--}</td>
                                    <td>${value['paciente']}</td>
                                    <td>${value['cedula']}</td>
                                    <td>${value['genero']==="f"?'Femenino':'Masculino'}</td>
                                    <td>${value['telefono_movil']===null?'':value['telefono_movil']}</td>
                                    <td>${value['correo']===null?'':value['correo']}</td>
                                    <td>${value['razon_social']===null?'':value['razon_social']}</td>
                                    <td class="text-center text-nowrap">
                                        <button title="Editar paciente" data-id="${value['id']}" class="btn-edit btn btn-default text-primary">
                                            <i data-id="${value['id']}" class="btn-edit fas fa-edit"></i>
                                        </button>
                                        <button title="Eliminar registro" data-id="${value['id']}" class="btn-delete btn btn-default text-primary">
                                            <i data-id="${value['id']}" class="btn-delete fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            `)
                    })
                }
        }
        let container_empresas_listado = async () => {
            let $empresas_listado = d.querySelector(`#pills-empresa-list table tbody`)
            if (is_empty(useState['empresas'])) {
                let fecha_desde = document.getElementById("fecha_desde").value
                let fecha_hasta = document.getElementById("fecha_hasta").value
                useState['empresas'] = await get(location.origin + `/cat/empresa/index`)
            }

            let {
                empresas
            } = useState
            console.log(useState['empresas'])
            if (useState['empresas'].length === 0) {
                let totalColumnas = d.querySelector(`#pills-paciente-list table thead tr th`).length
                console.log(totalColumnas)
                $empresas_listado.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-primary">No se encontraron empresas</td>
                    </tr>
                `
            } else {
                /*
                <td>${total--}</td>
                                <td>${value['paciente']}</td>
                                <td>${value['cedula']}</td>
                                <td>${value['genero']==="f"?'Femenino':'Masculino'}</td>
                                <td>${value['telefono_movil']===null?'':value['telefono_movil']}</td>
                                <td>${value['correo']===null?'':value['correo']}</td>
                                <td>${value['razon_social']===null?'':value['razon_social']}</td>
                */
                $empresas_listado.innerHTML = null
                let total = useState['empresas'].length
                empresas.forEach((value, key) => {
                    $empresas_listado.insertAdjacentHTML("beforeend", `
                            <tr id="row_${value['id']}">
                                <td>${value['id']}</td>
                                <td>${value['razon_social']}</td>
                                <td>${value['rif']}</td>
                                <td></td>
                                <td class="text-center text-nowrap">
                                    <button title="Editar paciente" data-id="${value['id']}" class="btn-edit btn btn-default text-primary">
                                        <i data-id="${value['id']}" class="btn-edit fas fa-edit"></i>
                                    </button>
                                    <button title="Eliminar registro" data-id="${value['id']}" class="btn-delete btn btn-default text-primary">
                                        <i data-id="${value['id']}" class="btn-delete fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `)
                })
            }
        }

        //INVOCACION DE FUNCIONES
        d.addEventListener("DOMContentLoaded", async ()=>{
            useState['medicos'] = await get(location.origin + `/medico/getMedicos`)
            useState['empresas'] = await get(location.origin + `/cat/empresa/index`)
            dashboard_container()

            //container_empresas_listado()
            $('#carouselExampleFade').carousel({
                interval: false,
            });
        })


        //EVENTOS
        d.querySelector("#fecha_desde").addEventListener("change", async (e) => {
            setTimeout(async () => {
                dashboard_container()
            }, 1000);

        })
        d.querySelector("#fecha_hasta").addEventListener("change", async (e) => {
            setTimeout(async () => {
                dashboard_container()
            }, 1000);
        })
        d.addEventListener("click", function(e) {
            if (e.target.matches("#pills-dashboard-tab")) {
                area_title.textContent = 'Estadísticas Telesalud Empresarial'
                dashboard_orientaciones()
            }
            if (e.target.matches("#pills-orientaciones-tab")) {
                area_title.textContent = 'Orientaciones'
                orientaciones_listado_container()
            }
            if (e.target.matches("#pills-pacientes-tab")) {
                area_title.textContent = 'Pacientes'
                container_pacientes_listado()
            }
            if (e.target.matches("#pills-empresas-tab")) {
                area_title.textContent = 'Empresas'
                console.log(e.target)
                container_empresas_listado()
            }
            if (e.target.matches("#pills-orientaciones-list-tab")) {
                //console.log(e.target )
                orientaciones_listado_container()
            }
            if (e.target.matches("#pills-orientaciones-create-tab")) {
                //console.log(e.target )
                d.querySelector(`#pills-orientaciones-create #medico`).innerHTML = null
                let medicos = useState['medicos'].map(medico => {
                    return {
                        id: medico['user_id'],
                        description: medico['medico']
                    }
                }).filter(x=>[18335,16906].includes(Number(x['id'])))

                medicos.forEach(x => {
                    d.querySelector(`#pills-orientaciones-create #medico`).insertAdjacentHTML("beforeend", `
                            <option value="${x['id']}">${x['description']}</option>
                        `)
                })
                let $form = d.querySelector('#pills-orientaciones-create')
                    $form.querySelector("#orientacion_submit").classList.remove('d-none')
                    $form.querySelector("#orientacion_update").classList.add('d-none')
            }
            if (e.target.matches("#pills-paciente-list-tab")) {
                //console.log(e.target )
                container_pacientes_listado()
            }
            if (e.target.matches("#pills-paciente-create-tab")) {
                let empresas = useState['empresas'].map(medico => {
                    return {
                        id: medico['id'],
                        description: medico['razon_social']
                    }
                })
                d.querySelector("#paciente_submit").classList.remove("paciente-update")
                d.querySelector("#paciente_submit").classList.add("paciente-store")

                d.querySelector(`#pills-paciente-create #empresa`).innerHTML = null
                empresas.forEach(x => {
                    d.querySelector(`#pills-paciente-create #empresa`).insertAdjacentHTML("beforeend", `
                            <option value="${x['id']}">${x['description']}</option>
                        `)
                })
            }

            if (e.target.matches("#pills-empresa-list-tab")) {
                console.log(e.target)
            }
            if (e.target.matches("#pills-empresa-create-tab")) {
                console.log(e.target)
            }

        })
        d.querySelector("#pills-paciente-list").addEventListener("click", async (e) => {
            //console.log(e.target)
            if (e.target.matches(".btn-edit")) {
                let empresas = useState['empresas'].map(medico => {
                    return {
                        id: medico['id'],
                        description: medico['razon_social']
                    }
                })
                d.querySelector("#paciente_submit").dataset['id'] = e.target.dataset['id']

                d.querySelector("#paciente_submit").classList.add("paciente-update")
                d.querySelector("#paciente_submit").classList.remove("paciente-store")
                d.querySelector(`#pills-paciente-create #empresa`).innerHTML = null
                empresas.forEach(x => {
                    d.querySelector(`#pills-paciente-create #empresa`).insertAdjacentHTML("beforeend", `
                            <option value="${x['id']}">${x['description']}</option>
                        `)
                })
                let user_id = e.target.dataset['id']
                let paciente = useState['pacientes'].find(paciente => equalsInt(paciente['id'], user_id))
                console.log(paciente)
                document.getElementById('cedulapaciente').value = paciente['cedula']
                document.getElementById('nombrespaciente').value = paciente['nombres']
                document.getElementById('apellidospaciente').value = paciente['apellidos']
                document.getElementById('email').value = paciente['correo']
                document.getElementById('generopaciente').value = paciente['genero']
                document.getElementById('telefono_movilpaciente').value = paciente['telefono_movil']
                document.getElem