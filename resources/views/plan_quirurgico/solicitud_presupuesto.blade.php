<!DOCTYPE html>
<html>

<head>
    <title>Solicitud de Presupusto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
    <style>
        .bg-gray-footer-parodi {
            background-color: #E0E0E0;
        }

        .vh-100 {
            height: 100vh;
        }
        // Extra small devices (portrait phones, less than 576px)
        // No media query for `xs` since this is the default in Bootstrap

        // Small devices (landscape phones, 576px and up)
        @media (min-width: 576px) {

        }

        // Medium devices (tablets, 768px and up)
        @media (min-width: 768px) {

        }

        // Large devices (desktops, 992px and up)
        @media (min-width: 992px) {

        }

        // Extra large devices (large desktops, 1200px and up)
        @media (min-width: 1200px) {

        }

    </style>
</head>

<body>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="container">
        <h3 class="text-primary">Solicitud de Presupuesto</h3>
        <form class=" my-3">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column flex-sm-row align-items-center">
                        <div class="d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                            <input checked type="radio" id="solicitud_hora" name="a" value="1" style="width:20px;height:20px;" class="mr-1">
                            <label for="solicitud_hora" class="mb-0">Particular:</label>
                        </div>
                        <div class="w-100 d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                            <input type="radio" id="solicitud_hora22"  name="a" value="2" style="width:20px;height:20px;" class="mr-1">
                            <label for="solicitud_hora22" class="mb-0 mr-1">Seguro:</label>
                            <input id="" style="width:90%;" class=" form-control bg-gray-footer-parodi">
                        </div>
                        <div class="w-100 d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                            <label for="solicitud_fecha" style="width:100px;" class="mb-0 mr-1">Fecha:</label>
                            <input id="solicitud_fecha" value="06/10/2023" readonly class="border-0 form-control bg-gray-footer-parodi">
                        </div>
                    </div>
                </div>

                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Datos del paciente
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="cedula">Documento de identidad</label>
                      <div class="d-flex">
                        <select class="flex-shrink-1 form-control bg-gray-footer-parodi" name="nacionalidad" id="nacionalidad" style="width: fit-content;">
                          <option title="Venezolano" value="V">V</option>
                          <option title="Extrangero" value="E">E</option>
                          <option title="Pasaporte" value="P">P</option>
                        </select>
                        <input type="number" max="9" class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi" name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                      </div>
                      <small id="sms_cedula" class="form-text text-danger notification"></small>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="email">Correo electrónico</label>
                      <input type="email" class="form-control bg-gray-footer-parodi" name="email" id="email" aria-describedby="helpId" placeholder="">
                      <small id="sms_email" class="form-text text-danger notification"></small>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="nombre">Nombres</label>
                      <input type="text" class="form-control bg-gray-footer-parodi" name="nombres" id="nombres" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="apellido">Apellidos</label>
                      <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="genero">Género</label>
                      <select class="form-control bg-gray-footer-parodi" name="genero" id="genero" aria-describedby="helpId" placeholder="">
                        <option value="">Seleccione</option>
                        <option value="m">Masculino</option>
                        <option value="f">Femenino</option>
                      </select>
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="fnacimiento">Fecha de nacimiento</label>
                      <input type="date" class="form-control bg-gray-footer-parodi" name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="telefono_movil">Teléfono contacto</label>
                      <input type="number" class="form-control bg-gray-footer-parodi" name="telefonomovil" id="telefonomovil" aria-describedby="helpId" placeholder="">
                      <small id="help_telefonomovil" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="telefono_hogar">Teléfono secundario</label>
                      <input type="number" class="form-control bg-gray-footer-parodi" name="telefono_hogar" id="telefono_hogar" aria-describedby="helpId" placeholder="">
                      <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                    </div>
                  </div>

                <div class="col-12">
                    <div class="d-flex my-3 flex-column flex-sm-row align-items-center">
                        <div class="d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                            <input checked type="radio" id="solicitud_hora1" name="a1" value="1" style="width:20px;height:20px;" class="mr-1">
                            <label for="solicitud_hora1" class="mb-0 font-weight-bold h5 text-secondary">Intervención</label>
                        </div>
                        <div class="d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                            <input  type="radio" id="solicitud_hora2" name="a1" value="2" style="width:20px;height:20px;" class="mr-1">
                            <label for="solicitud_hora2" class="mb-0 font-weight-bold h5 text-secondary">Tratamiento</label>
                        </div>
                        <div class="d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                            <input  type="radio" id="solicitud_hora3" name="a1" value="3" style="width:20px;height:20px;" class="mr-1">
                            <label for="solicitud_hora3" class="mb-0 font-weight-bold h5 text-secondary">Procedimiento</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="apellido">Tipo de intervención</label>
                      <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label class="label-text" for="apellido">Procedimiento</label>
                      <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                <div class="col-12">
                    <div class="form-group">
                      <label class="label-text" for="apellido">Diagnóstico</label>
                      <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                <div class="col-12">
                    <div class="form-group">
                      <label class="label-text" for="apellido">Descripción del tratamiento</label>
                      <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                      <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                  </div>
                <div class="col-12 col-sm-5">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Tiempo quirúrgico aproximado (horas)</label>
                        <input type="number" value="1" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Días de hospitalización</label>
                        <input type="number" value="1" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-2">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Piso</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 2">Piso 2</option>
                            <option value="Piso 3">Piso 3</option>
                            <option value="Piso 4">Piso 4</option>
                            <option value="Piso 5">Piso 5</option>
                            <option value="Piso 6">Piso 6</option>

                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-2">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Días UTI</label>
                        <input type="number" value="1" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Médicos
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Médico Tratante</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Cirujano Principal</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Anestesiólogo</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">1er Ayudante</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Cirujano 2</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">2er Ayudante</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">1er Ayudante (Cirujano 2)</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">3er Ayudante</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">2er Ayudante (Cirujano 2)</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="">Seleccione</option>
                            <option value="Piso 2">Medico 1</option>
                            <option value="Piso 3">Medico 2</option>
                            <option value="Piso 4">Medico 3</option>
                            <option value="Piso 5">Medico 4</option>
                            <option value="Piso 6">Medico 5</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
            <div class="row mt-3 align-items-center">
                <div class="col-12 col-sm-3">
                    <div class="w-100 d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                        <label for="solicitud_hora22" class="mb-0 mr-1 text-nowrap">Equipo del Cirujano principal:</label>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="w-100 d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                        <input id="" class=" form-control bg-gray-footer-parodi">
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="w-100 d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                        <label for="solicitud_hora22" class="mb-0 mr-1 text-nowrap">Equipo del Cirujano 2:</label>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="w-100 d-flex align-items-center mb-1 mb-sm-0 mr-sm-4">
                        <input id="" class=" form-control bg-gray-footer-parodi">
                    </div>
                </div>
                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                   Otros profesionales
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido"></label>
                        <input id="" class=" form-control bg-gray-footer-parodi">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido"></label>
                        <input id="" class=" form-control bg-gray-footer-parodi">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Honorarios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>



                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Estudios y Exámenes
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Uso de derivados sanguíneos</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 3">No</option>
                            <option value="Piso 2">Si</option>

                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Anatomía Patológica</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 3">Estándar</option>
                            <option value="Piso 2">Extemporánea</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Concentrado globular</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Plaquetas</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Plasma</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-9">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Otros estudios</label>
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Equipos especiales
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Bisturí armónico</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 3">No</option>
                            <option value="Piso 2">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Microscopio</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 3">No</option>
                            <option value="Piso 2">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Torre de Laparoscopia</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 3">No</option>
                            <option value="Piso 2">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label class="label-text" for="apellido">Instrumental de Laparoscopia</label>
                        <select type="number" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos">
                            <option value="Piso 3">No</option>
                            <option value="Piso 2">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Observaciones
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>







                <!-- <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Servicio médico solicitante
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="solicitud_tipo_cupo">Tipo de cupo:</label>
                        <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="solicitud_tipo_cupo">
                            <option value="Quirúrgico">Quirúrgico</option>
                            <option value="Procedimiento">Procedimiento</option>
                            <option value="Estudio">Estudio</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="solicitud_motivo">Motivo de asignación de quirófano:</label>
                        <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="solicitud_motivo">
                            <option value="Emergencia">Emergencia</option>
                            <option value="Urgencia">Urgencia</option>
                            <option value="Electiva">Electiva</option>
                        </select>
                    </div>
                </div>


                <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                    Datos de la intervención, procedimiento o estudio
                </div>











                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="h_inicio">Hora de inicio:</label>
                        <input type="time" class="form-control bg-gray-footer-parodi" id="h_inicio">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="h_fin">Hora (estimada) de fin:</label>
                        <input type="time" class="form-control bg-gray-footer-parodi" id="h_fin">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="intervencion">Intervención:</label>
                        <div class="d-flex">
                            <input type="text" class="form-control bg-gray-footer-parodi mr-1" id="intervencion">
                            <button type="button" class="btn btn-primary font-weight-bold"
                                id="intervencionBtn">+</button>
                        </div>
                        <ul class="list-group mt-1" id="intervencionList">

                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="equipos_especiales">Equipos especiales:</label>
                        <div class="d-flex">
                            <input type="text" class="form-control bg-gray-footer-parodi mr-1" id="equipos_especiales">
                            <button type="button" class="btn btn-primary font-weight-bold"
                                id="equipos_especialesBtn">+</button>
                        </div>
                        <ul class="list-group mt-1" id="equipos_especialesList">

                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="cirujanoPrincipal">Cirujano Principal:</label>
                        <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="cirujano_principal">
                            <option value="">Selecione</option>
                            <option value="1">Cirujano 1</option>
                            <option value="2">Cirujano 2</option>
                            <option value="3">Cirujano 3</option>
                            <option value="4">Cirujano 4</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="cirujanoPrincipal">Anestesiologo:</label>
                        <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="anestesiologo">
                            <option value="">Selecione</option>
                            <option value="1">Anestesiologo 1</option>
                            <option value="2">Anestesiologo 2</option>
                            <option value="3">Anestesiologo 3</option>
                            <option value="4">Anestesiologo 4</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <select class="form-control bg-gray-footer-parodi" id="destino">
                            <option value="Habitación">Habitación</option>
                            <option value="Domicilio">Domicilio</option>
                        </select>
                    </div>
                </div>
             -->






            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <script>
        let d = document
        let date = new Date()
        let useState = {
            "h_inicio": null,
            "h_fin": null,
            "cirujano_principal": "[]",
            "anestesiologo": "[]",
            "intervencion": "[]",
            "equipos_especiales": "[]",
            "destino": "Habitación",
        }
        d.querySelector("form").addEventListener("change", function(e) {
            console.log(e.target.id)
            if (e.target.matches("input")) {
                if (["h_inicio", "h_fin"].includes(e.target.id)) {
                    useState[e.target.id] =
                        `${ date.getFullYear() }-${ String( date.getMonth() ).padStart(2, '0') }-${String(date.getDate()).padStart(2, '0') } ${e.target.value}`
                }

            }
            if (e.target.matches("select")) {
                if (["destino", "cirujano_principal", "anestesiologo"].includes(e.target.id)) {
                    useState[e.target.id] = JSON.stringify([{
                        "id": e.target.value,
                        "description": e.target.selectedOptions[0].text
                    }])
                }
            }
            console.log(useState)
        })
        d.querySelector("form").addEventListener("submit", async function(e) {
            e.preventDefault()
            if (validate()) {
                let formdata = new FormData()
                for (const key in useState) {
                    if (Object.hasOwnProperty.call(useState, key)) {
                        const element = useState[key];
                        formdata.append(key, element)
                    }
                }
                formdata.append("user_id_paciente", 22)
                formdata.append("user_id_medico", 22)
                formdata.append("_token", entById("_token").value)
                let result = await post(location.origin + "/areaquirurgica/store", formdata)
                console.log(result)
            }

        })
        let validate = () => {
            if (useState['h_inicio'] === null) {
                alert("Una hora de inicio es requerida")
                entById('h_inicio').focus()
                return false
            }
            if (useState['h_fin'] === null) {
                alert("Una hora de fin es requerida")
                entById('h_fin').focus()
                return false
            }

            if (Object.values(JSON.parse(useState['intervencion'])).length === 0) {
                alert("Escribe una intervención a realizar")
                entById('intervencion').focus()
                return false
            }
            if (Object.values(JSON.parse(useState['equipos_especiales'])).length === 0) {
                alert("Escribe un equipos especiales a utilizar")
                entById('equipos_especiales').focus()
                return false
            }
            if (Object.values(JSON.parse(useState['cirujano_principal'])).length === 0) {
                alert("Selecciona el cirujano principal")
                entById('cirujano_principal').focus()
                return false
            }
            if (Object.values(JSON.parse(useState['anestesiologo'])).length === 0) {
                alert("Selecciona el anestesiologo")
                entById('anestesiologo').focus()
                return false
            }
            return true
        }
        let post = async (url, data) => {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: data
                });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        let get = async (url, data) => {
            try {
                const response = await fetch(
                    url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        let handleList = function(objectKey) {
            //Contador de tareas
            let taskCounter1 = 1;
            //let objectKey = "intervencion"
            // Btn Agregar tarea
            let addTaskButton = entById(objectKey + 'Btn')
            addTaskButton.addEventListener('click', function(e) {

                let newTask = document.getElementById(objectKey);
                if (newTask.value !== '') {
                    let temp_object = JSON.parse(useState[objectKey])
                    temp_object.push({
                        "id": taskCounter1,
                        "description": newTask.value,
                    })
                    useState[objectKey] = JSON.stringify(temp_object)
                    newTask.value = '';

                    console.log(useState[objectKey])

                    entById(objectKey + 'List').innerHTML = null

                    temp_object.forEach((item, index) => {
                        let listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');
                        listItem.textContent = item.id + '. ' + item.description;

                        let deleteButton = document.createElement('button');
                        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'float-right',
                            'font-weight-bold');
                        deleteButton.textContent = '-';
                        deleteButton.dataset['index'] = item.id

                        deleteButton.addEventListener('click', function(e) {

                            let indiceAEliminar = e.target.dataset[
                            'index']; // Índice del objeto que deseas eliminar
                            //console.log(indiceAEliminar)

                            let temp_object = JSON.parse(useState[objectKey])
                            temp_object = temp_object.filter((item, key) => item.id !== Number(
                                indiceAEliminar))
                            useState[objectKey] = JSON.stringify(temp_object)

                            this.parentNode.remove();
                            taskCounter1--
                            console.log(useState[objectKey])

                        })

                        listItem.appendChild(deleteButton);
                        entById(objectKey + 'List').appendChild(listItem);
                    })




                    taskCounter1++;
                }
            })
        }
        let handleInterventionList = function() {
            handleList("intervencion")
        }
        let handleEquipoEspecialList = function() {
            handleList("equipos_especiales")
        }
        handleInterventionList()
        handleEquipoEspecialList()
    </script>
</body>

</html>
