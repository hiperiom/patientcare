<template id="nav_info_paciente">
    <nav class="navbar navbar-light bg-light justify-content-around">
        <div class="container-fluid">
            <div class="row">
                <div class="col">

                    <div class="d-flex flex-column">
                        <div class="d-flex cursor-pointer btn-default align-items-center border-bottom"
                            data-toggle="collapse" data-target=".navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <div>
                                <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                    src="/image/system/patient.svg" style="width:1.5cm;height:1.5cm"
                                    data-tippy-content="Imagen del paciente"
                                    class="tooltip-primary border border-primary rounded-circle mx-auto d-block"
                                    alt="Imagen Paciente">
                            </div>
                            <div>
                                <div class="overflow-hidden pl-1">
                                    <h4 data-tippy-content="Nombre del paciente"
                                        class="m-0 p-0 tooltip-primary text-primary" style="white-space: normal;">
                                        Name First name Lastname
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around align-items-center">

                            <div>
                                <div class="px-2 tooltip-primary text-center" data-tippy-content="Cédula del paciente">
                                    <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                    <div class="text-gray">
                                        V-00.000.000
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-tippy-content="Edad"
                                    class="px-2 tooltip-primary text-center border-left border-right">
                                    <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                    <div class="text-gray">
                                        00
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="px-2 tooltip-primary text-center" data-tippy-content="Sexo">
                                    <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                    <div class="text-gray">
                                        N/I
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="col navbar-expand-sm">
                    <div class="collapse navbar-collapse navbarSupportedContent mb-2">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <ul class="list-group">
                                    <li class="list-group-item text-center p-1">
                                        <b class="text-primary" style="font-size:0.8em;">Fecha ingreso</b>
                                        <div class="text-center overflow-hidden">
                                            <input type="date" class="border-transparent">
                                        </div>
                                    </li>
                                    <li class="list-group-item text-center p-1">

                                        <b class="text-primary" style="font-size:0.8em;">Ubicación Actual <span
                                                class="badge badge-gray text-primary">0</span></b>
                                        <div class="text-center">
                                            No Indicado
                                        </div>
                                    </li>
                                    <li class="list-group-item text-center p-1">

                                        <b class="text-primary" style="font-size:0.8em;">Teléfono Contacto</b>
                                        <div class="text-center">
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=04149320905"
                                                style="line-height: 1.4;" class="btn btn-default btn-block border-0">
                                                <i class="fab fa-whatsapp text-success"></i> 04140000000
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col navbar-expand-md">
                    <div class="collapse navbar-collapse flex-column navbarSupportedContent mb-2">
                        <ul class="nav nav-pills justify-content-md-center  justify-content-lg-end w-100" id="myTab"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link py-1 active" id="impresion_diagnostica-tab" data-toggle="tab"
                                    href="#impresion_diagnostica" role="tab" aria-controls="impresion_diagnostica"
                                    aria-selected="true">Prob. Diag.</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-1" id="evolucion-tab" data-toggle="tab" href="#evolucion"
                                    role="tab" aria-controls="evolucion" aria-selected="false">Evolución</a>
                            </li>

                        </ul>
                        <div class="tab-content overflow-auto" id="myTabContent" style="max-height: 135px;">
                            <div class="tab-pane fade show active" id="impresion_diagnostica" role="tabpanel"
                                aria-labelledby="impresion_diagnostica-tab">
                                <ul class="list-group  list-group-flush">

                                </ul>
                            </div>
                            <div class="tab-pane fade" id="evolucion" role="tabpanel" aria-labelledby="evolucion-tab">
                                2Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil distinctio, corrupti
                                neque temporibus sequi harum voluptatibus numquam esse ipsum perferendis expedita
                                possimus ratione consectetur? Voluptas eaque eum culpa fugiat ullam.
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col navbar-expand-lg">
                    <div class="collapse navbar-collapse flex-column navbarSupportedContent mb-2">
                        <b class="text-center text-primary" style="font-size:0.8em;">Médicos</b>
                        <table class="w-100 m-0 p-0">
                            <tbody id="user_medico_paciente_menu">
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_tratante" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_interconsultante" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_felow" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_residente" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr>
                                    <td id="lista_ramh" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <!--<ul class="list-group">
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-success btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-info btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-orange btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-secondary btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-purple btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>

                        </ul>  -->
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<template id="card_info_paciente_1">
    <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-primary cursor-pointer" data-card-widget="collapse">

            <div class="widget-user-image">
                <img class="img-circle elevation-2" onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                    src="/image/system/icono-paciente-blanco.svg" src="../dist/img/user1-128x128.jpg" alt="User Avatar">

            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">Name Lastname</h3>
            <h5 class="widget-user-desc">00.000.000</h5>

        </div>
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Edad <span class="float-right text-secondary font-weight-bold">0 años</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Sexo <span class="float-right text-secondary font-weight-bold">M</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://api.whatsapp.com/send?phone=584149320905" target="_blank" class="nav-link">
                        Teléfono Contacto <span class="float-right text-secondary font-weight-bold"><i
                                class="fab fa-whatsapp text-success"></i> +584140000000</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Historia Inicial <span class="float-right text-secondary font-weight-bold">#1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Fecha Historia <span class="float-right text-secondary font-weight-bold">00/00/0000</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</template>
<template id="cintillo-table-equipo-medico">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="h5 pl-1 text-secondary">
                    Equipo <span class="grupo-medicos-nombre">Residente</span>
                   {{--  <i data-dismiss="modal" aria-label="Close" class="fas cursor-pointer heartbeat fa-times m-1"
                    style="
                        position: absolute;
                        right: -40px;
                        font-size: 2em;
                        top: -55px;
                        color: var(--primary);
                    "></i> --}}
                </div>
                <div class="d-flex align-items-end">
                    <div class=" flex-grow-1">
                        <div class="form-group">
                            <select class="form-control mySelect2" name="equipo_medico">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <button data-tippy-content="Guardar médico" class="ml-1 tooltip-primary btn btn-outline-primary" type="button">
                                <i class="far fa-save"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-primary text-center">
                                Médico
                            </th>
                            <th class="text-primary text-center">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-center text-primary">
                                Sin médico seleccionado
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


<template id="historia_inicial">
    <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
    <div style="margin-top: 190px !important;" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-primary">Historia Preliminar de Emergencia</h3>
            </div>
            <div class="col-md-4">
                <div id="cardInfoPaciente1"></div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Signos Vitales</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="signosVitales" class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">PESO</span>
                                    </div>
                                    <input  name="user_peso" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">Kg.</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">TALLA</span>
                                    </div>
                                    <input  name="user_talla" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">Cm.</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">TEMP.</span>
                                    </div>
                                    <input  name="user_temperatura" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">°C</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">OXI</span>
                                    </div>
                                    <input  name="user_oximetria" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">%</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">F.C.</span>
                                    </div>
                                    <input  name="user_fc" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">lat/min</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">F.R.</span>
                                    </div>
                                    <input  name="user_fr" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">resp/min</span>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 60px;">GL.</span>
                                    </div>
                                    <input  name="user_glic" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">mg/dL</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="input-group m-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                      <span class="input-group-text rounded-0 border-0" style="width: 60px;">T.A.</span>
                                    </div>
                                    <input  name="user_ta_sis" placeholder="Sistólica" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                    <input  name="user_ta_dia" placeholder="Diastólica" type="text" aria-label="Last name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0" style="width: 75px;">mmHg</span>
                                    </div>
                                </div>

                            </li>


                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente requerirá:</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="evaluacionIngreso" class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <ul class="list-group list-group-flush">
                             <li class="list-group-item p-1 d-none">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Solo Atención de Emergencia</label>

                                    <select class="form-control border-0" name="atencion_emergencia" id="atencion_emergencia">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Hospitalización:</label>
                                    <select class="form-control border-0" name="hospitalizacion" id="hospitalizacion">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Terapia Intensiva:</label>
                                    <select class="form-control border-0" name="terapia_intensiva" id="terapia_intensiva">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>

                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Cirugía:</label>
                                    <select class="form-control border-0" name="caso_tipo_medico" id="caso_tipo_medico">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Clasificación del Triaje:</label>
                                    <select class="form-control border-0" name="nivel_triaje" id="nivel_triaje">
                                        <option value="">Seleccione</option>
                                        <option value="1">Nivel 1</option>
                                        <option value="2">Nivel 2</option>
                                        <option value="3">Nivel 3</option>
                                        <option value="4">Nivel 4</option>
                                        <option value="5">Nivel 5</option>
                                    </select>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div>
            <div id="datos_ingreso" class="col-md-8">


                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus" data-card-widget="collapse"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Escriba aquí por qué el paciente acudió a la emergencia" name="user_motivo_consulta" id="user_problema_salud"
                            rows="3"></textarea>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Antecedentes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Escriba aquí los antecedentes del paciente" name="user_antecedentes" id="user_antecedentes"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Describa aquí el problema de salud actual" name="user_enfermedad_actual" id="user_problema_salud"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Describa brevemente los hallazgos positivos del examen físico realizado." name="user_examen_fisico" id="user_examen_fisico"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Problema de ingreso
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Escriba aquí el diagnóstico presuntivo del paciente" name="user_diagnostico_presuntivo" id="user_diagnostico_presuntivo"
                            rows="3"></textarea>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button id="guardarHistoriaInicial" type="button" class="btn btn-success btn-block mb-1" {{-- data-dismiss="modal" --}}>Guardar</button>
            </div>
            <div class="col-md-8">
                <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</template>
<template id="historia_inicial_Original">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div id="cardInfoPaciente1"></div>

                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Exploración Física</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1">
                                <input data-type="string" type="number" name="estatura" class="form-control border-0"
                                    id="estatura" placeholder="Estatura">
                            </li>
                            <li class="list-group-item p-1">
                                <input data-type="string" type="number" name="peso" class="form-control border-0"
                                    id="peso" placeholder="Peso">
                            </li>
                            <li class="list-group-item p-1">
                                <input data-type="string" type="number" name="imc" class="form-control border-0"
                                    id="imc" placeholder="IMC">
                            </li>


                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Comorbilidades</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th class="p-0 pb-1">
                                        <input data-type="object" type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Escribr aqui una comorbilidad">

                                    </th>
                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id="" class="btn btn-default text-primary font-weight-bold"
                                            href="#" role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="p-1">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Tempora laudantium necessitatibus facilis! At animi dolor reiciendis quam,
                                        debitis repudiandae sed similique obcaecati, nemo nesciunt corrupti, qui neque
                                        quisquam ullam numquam.</td>
                                    <td class="p-1 text-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm"><i
                                                class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Alergias</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th class="p-0 pb-1">
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Escribr aqui una alergia">

                                    </th>
                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id="" class="btn btn-default text-primary font-weight-bold"
                                            href="#" role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-1 text-center text-secondary" colspan="2">
                                        No tiene Alergias
                                    </td>
                                </tr>
                                <!--<tr>
                            <td class="p-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora laudantium necessitatibus facilis! At animi dolor reiciendis quam, debitis repudiandae sed similique obcaecati, nemo nesciunt corrupti, qui neque quisquam ullam numquam.</td>
                            <td class="p-1 text-center">
                            <button type="button"  style="width:2em;height:2em;" class="btn btn-outline-primary btn-sm"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>-->
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Medicamentos Permanentes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th class="p-0 pb-1">
                                        <input type="text" class="form-control" style="width: 130px;" name="" id=""
                                            aria-describedby="helpId" placeholder="Medicamento">
                                    </th>
                                    <th class="p-1"><input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Dosis"></th>
                                    <th class="p-0 pb-1"><input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Indicaciones"></th>
                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id="" class="btn btn-default text-primary font-weight-bold"
                                            href="#" role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                <!--
                        <tr>
                            <td class="border-right">Acetaminofen</td>
                            <td class="border-right">10 mg</td>
                            <td class="border-right">1 cada 10 dias por 2 años</td>
                            <td>
                            <button type="button" style="width:2em;height:2em;" class="btn btn-outline-primary btn-sm"><i class="fas fa-times"></i></button>
                            </td>
                        </tr> -->
                                <tr>
                                    <td class="p-1 text-center text-secondary" colspan="4">
                                        No tiene medicación permanente
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Antecedentes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th class="p-0 pb-1">
                                        <select name="" class="form-control" id="">
                                            <option value="P">Personal</option>
                                            <option value="P">Familiar</option>
                                            <option value="P">Hospitalización</option>
                                            <option value="P">Quirúrgico</option>
                                        </select>
                                    </th>
                                    <th class="p-1">
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Escribe antecedente">
                                    </th>

                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id="" class="btn btn-default text-primary font-weight-bold"
                                            href="#" role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                <!--
                        <tr>
                            <td class="border-right">Acetaminofen</td>
                            <td class="border-right">10 mg</td>
                            <td class="border-right">1 cada 10 dias por 2 años</td>
                            <td>
                            <button type="button" style="width:2em;height:2em;" class="btn btn-outline-primary btn-sm"><i class="fas fa-times"></i></button>
                            </td>
                        </tr> -->
                                <tr>
                                    <td class="p-1 text-center text-secondary" colspan="3">
                                        No tiene medicación permanente
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-8">


                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus" data-card-widget="collapse"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <textarea class="form-control textarea" placeholder="Escriba aquí el problema de salud actual" name="" id=""
                            rows="3"></textarea>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <textarea class="form-control textarea" placeholder="Escriba aquí el problema de salud actual" name="" id=""
                            rows="3"></textarea>
                    </div>
                </div>

                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 p-1">
                                    <div class="form-group">
                                        <label class="text-secondary" for="">Condiciones generales</label>
                                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 p-1">
                                    <div id="figurahumana" style="width:100%;height:400px;"></div>
                                </div>
                                <div class="col-md-6 p-1">
                                    <div style="max-height: 400px;overflow:auto;">
                                        <table class="w-100">
                                            <tr id="area_cuerpo_1" class="scale-in-hor-right">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Cabeza y cuello / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="input_area_cuerpo_1" id="input_area_cuerpo_1" placeholder="Escriba "></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_2" class="scale-in-hor-right">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Torax / Anterior
                                                </td>
                                                <td>
                                                    <textarea class=" form-control" name="input_area_cuerpo_2" id="input_area_cuerpo_2" placeholder="Escriba "></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_3" class="scale-in-hor-right">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Abdomen / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="input_area_cuerpo_3" id="input_area_cuerpo_3" placeholder="Escriba "></textarea>
                                                </td>
                                            </tr>

                                            <tr id="area_cuerpo_4" class="scale-in-hor-right" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">

                                                    Genitales / Anterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_4" id="input_area_cuerpo_4"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_5" class="scale-in-hor-right" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro superior izquierdo / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_5" id="input_area_cuerpo_5"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_6" class="scale-in-hor-right" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro superior derecho / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_6" id="input_area_cuerpo_6"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_7" class="scale-in-hor-right" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro inferior izquierdo / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_7" id="input_area_cuerpo_7"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_8" class="scale-in-hor-right" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro inferior derecho / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_8" id="input_area_cuerpo_8"></textarea>
                                                </td>
                                            </tr>



                                            <tr id="area_cuerpo_9" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Cabeza y cuello / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_9" id="input_area_cuerpo_9"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_10" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Region dorsal / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_10" id="input_area_cuerpo_10"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_11" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Region lumbar / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_11" id="input_area_cuerpo_11"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_12" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Region lumbo sacra / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_12" id="input_area_cuerpo_12"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_13" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro superior izquierdo / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_13" id="input_area_cuerpo_13"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_14" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro superior derecho / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_14" id="input_area_cuerpo_14"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_15" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro inferior izquierdo / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_15" id="input_area_cuerpo_15"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_16" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro inferior derecho / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_16" id="input_area_cuerpo_16"></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

</template>
<template id="historialEpisodios">
    <section class="content my-1">
        <h1 class="text-primary">Historia de Episodios</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overlay-wrapper">
                        <div class="overlay text-primary d-none">
                            <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
                            <div class="text-bold pt-2">
                                Espere un momento por favor...
                            </div>
                        </div>
                        <div id=episodes>
                            <div id="episode_1" class="card card-outline card-primary mb-1 collapsed-card">
                                <div class="card-header cursor-pointer overflow-auto" data-card-widget="collapse">
                                    <div class="user-block">
                                        <div class="d-flex align-items-end">
                                            <div class="px-3 border-right">
                                                <div class="m-0 description">
                                                    Episodio
                                                </div>
                                                <div class="text-center">
                                                    <a id="user_fullname" href="#"
                                                        class="h4 text-primary font-weight-bold">
                                                        1
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="px-1">
                                                <img id="user_image" class="img-circle"
                                                    src="/AdminLTE-3.2.0/dist/img/user1-128x128.jpg" alt="User Image">
                                            </div>
                                            <div class="px-1 border-right">
                                                <div>
                                                    <a id="user_fullname" href="#" class="font-weight-bold">
                                                        Jonathan Burke Jr.
                                                    </a>
                                                </div>
                                                <div class="m-0 description">
                                                    <b>Cédula:</b> <span id="user_document_id">00.000.000</span>
                                                </div>
                                            </div>
                                            <div class="px-1 border-right">
                                                <div class="m-0 description">
                                                    <b>Ingreso:</b> <span id="episode_admision_date">01/01/2022</span>
                                                </div>
                                                <div class="m-0 description">
                                                    <b>Egreso:</b> <span id="episode_departure_date">10/01/2022</span>
                                                </div>
                                            </div>
                                            <div class="px-1">
                                                <div class="m-0 description">
                                                    <b>Días de Hospitalización:</b> <span id="episode_num_days">8</span>
                                                </div>
                                                <div class="m-0 description">
                                                    <b>Ubicación:</b>
                                                    <span id="episode_num_days">Pad Covid - 1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-primary"
                                            data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-2" style="display: none;">

                                    <div class="row">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab"
                                                role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                                    href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                                    aria-selected="true">Laboratorio</a>
                                                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                                    href="#vert-tabs-profile" role="tab"
                                                    aria-controls="vert-tabs-profile" aria-selected="false">Imagen</a>
                                                <a class="nav-link" id="vert-tabs-messages-tab"
                                                    data-toggle="pill" href="#vert-tabs-messages" role="tab"
                                                    aria-controls="vert-tabs-messages" aria-selected="false">Fotografía
                                                    <span class="badge badge-primary">1</span></a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Otros
                                                    Archivo <span class="badge badge-primary">4</span></a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Probabilidad Diagnóstica
                                                    <span class="badge badge-primary">1</span></a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Evolución</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Plan</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Récipe</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Estudio
                                                    Diagnóstico</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Comorbilidad</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Informe</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Orden
                                                    Médica</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Monitoreo
                                                    indicadores</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">PAD</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Doctores</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Historia
                                                    Inicial</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab"
                                                    data-toggle="pill" href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Ubicaciones</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade active show" id="vert-tabs-home"
                                                    role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm"
                                                                src="/AdminLTE-3.2.0/dist/img/user8-128x128.jpg"
                                                                alt="user-img 128x128">
                                                            <span class="username">
                                                                <a href="#">Jonathan Burke Jr.</a>
                                                                <a href="#" class="float-right btn-tool"><i
                                                                        class="fas fa-times"></i></a>
                                                            </span>
                                                            <span class="description">Shared publicly - 7:30 PM
                                                                today</span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                        <p>
                                                            Lorem ipsum represents a long-held tradition for designers,
                                                            typographers and the like. Some people hate it and argue for
                                                            its demise, but others ignore the hate as they create
                                                            awesome
                                                            tools to help create filler text for everyone from bacon
                                                            lovers
                                                            to Charlie Sheen fans.
                                                        </p>
                                                        <div class="card-footer bg-white">
                                                            <ul
                                                                class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                                <li>
                                                                    <span class="mailbox-attachment-icon"><i
                                                                            class="far fa-file-pdf"></i></span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#" class="mailbox-attachment-name"><i
                                                                                class="fas fa-paperclip"></i>
                                                                            Sep2014-report.pdf</a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>1,245 KB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <span class="mailbox-attachment-icon has-img"><img
                                                                            src="/AdminLTE-3.2.0/dist/img/photo1.png"
                                                                            alt="Attachment"></span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#" class="mailbox-attachment-name"><i
                                                                                class="fas fa-camera"></i>
                                                                            photo1.png</a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>2.67 MB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="mailbox-attachment-icon has-img">
                                                                        <img src="/AdminLTE-3.2.0/dist/img/photo2.png"
                                                                            alt="Attachment">
                                                                    </span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#" class="mailbox-attachment-name">
                                                                            <i class="fas fa-camera"></i>
                                                                            photo2.png
                                                                        </a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>1.9 MB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="mailbox-attachment-icon">
                                                                        <i class="far fa-file-word"></i>
                                                                    </span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#" class="mailbox-attachment-name"><i
                                                                                class="fas fa-paperclip"></i> App
                                                                            Description.docx</a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>1,245 KB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                                    aria-labelledby="vert-tabs-profile-tab">
                                                    Mauris tincidunt mi at erat gravida, eget tristique urna bibendum.
                                                    Mauris pharetra purus ut
                                                    ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit
                                                    amet, consectetur adipiscing
                                                    elit. Vestibulum ante ipsum primis in faucibus orci luctus et
                                                    ultrices posuere cubilia Curae;
                                                    Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat
                                                    mi, quis posuere purus
                                                    ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies
                                                    at, posuere nec nunc. Nunc
                                                    euismod pellentesque diam.
                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                                    aria-labelledby="vert-tabs-messages-tab">
                                                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue
                                                    mauris. Phasellus volutpat augue
                                                    id mi placerat mollis. Vivamus faucibus eu massa eget condimentum.
                                                    Fusce nec hendrerit sem, ac
                                                    tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum.
                                                    Suspendisse ut velit
                                                    condimentum, mattis urna a, malesuada nunc. Curabitur eleifend
                                                    facilisis velit finibus
                                                    tristique. Nam vulputate, eros non luctus efficitur, ipsum odio
                                                    volutpat massa, sit amet
                                                    sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida
                                                    fermentum, lectus ipsum
                                                    gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem
                                                    eu risus tincidunt eleifend
                                                    ac ornare magna.
                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                                                    aria-labelledby="vert-tabs-settings-tab">
                                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque
                                                    magna, iaculis tempus turpis
                                                    ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque
                                                    tincidunt venenatis vulputate.
                                                    Morbi euismod molestie tristique. Vestibulum consectetur dolor a
                                                    vestibulum pharetra. Donec
                                                    interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget
                                                    aliquet urna. Nunc at
                                                    consequat diam. Nunc et felis ut nisl commodo dignissim. In hac
                                                    habitasse platea dictumst.
                                                    Praesent imperdiet accumsan ex sit amet facilisis.
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
    </section>
</template>
<template id="newTable">
    <table class="table">
        <thead>
            <tr>
                <td class="p-0">
                    <form class="form-horizontal">
                        <div class="input-group input-group-md mb-0">
                            <input name="value" class="form-control rounded-0 form-control-md"
                                placeholder="Escribir aquí...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success btn-flat"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</template>
<template id="newTableRowComent">
    <div class="post">
        <div class="user-block">
            <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
            <span class="username">
                <a href="#">Sarah Ross</a>
                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
            </span>
            <span class="description">
                Sent you a message - 3 days ago
            </span>
        </div>
        <!-- /.user-block -->
        <p>
            Lorem ipsum represents a long-held tradition for designers,
            typographers and the like. Some people hate it and argue for
            its demise, but others ignore the hate as they create awesome
            tools to help create filler text for everyone from bacon lovers
            to Charlie Sheen fans.
        </p>
    </div>
</template>
<template id="boxOpinionesEncuesta">
    <div class="row">
        <div class="col-md-12">
            <div
                class="d-flex card card-primary mb-0 card-header-coments card-outline cursor-pointer direct-chat direct-chat-primary shadow-none collapsed-card">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title w-100 text-center text-primary">Opiniones <span
                            class="badge badge-primary">0</span></h3>
                </div>
                <div class="card-body" style="display: none;">
                    <div id="opiniones_generales_encuesta" class="direct-chat-messages" style="height: max-content;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="opinionEncuesta">
    <div data-coment-id="16" class="direct-chat-msg">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-timestamp float-right">00 FEB 2022</span>
        </div>
        <img class="direct-chat-img" src="/image/system/icono-paciente-blanco.svg" alt="Message User Image">
        <div class="direct-chat-text">
            Respuestas comentarios
        </div>
    </div>
</template>

<template id="row-18">
    <tr>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border text-center text-secondary"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2 border-right-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
    </tr>
</template>
<template id="datos-paciente">
    <article class="text-secondary p-1">
        <div class="d-flex justify-content-evenly">
            <div aria-label="Nombre del paciente" class="h4 pb-2"></div>
            <div aria-label="Botón Estatus"></div>
        </div>
        <div class="d-flex justify-content-evenly align-items-center" aria-label="Accesos rapidos">
            <div aria-label="Botón 1"></div>
            <div aria-label="Botón 2"></div>
            <div aria-label="Botón 3"></div>
            <div aria-label="Botón 4"></div>
            <div aria-label="Botón 5"></div>
        </div>
        <span aria-label="episodio_id" class="filtroBuscador"></span>
        <span aria-label="user_id" class="filtroBuscador"></span>
        <span aria-label="cedula formateada" class="filtroBuscador"></span>
        <span aria-label="cedula" class="filtroBuscador"></span>
        <span aria-label="fecha episodio" class="filtroBuscador"></span>
    </article>
</template>
<template id="form_paciente_1">
    <div class="container">
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="h3 text-primary">
                    Datos del paciente
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                    <table class="w-100">
                        <tr>
                            <td style="width: 30%">
                                <select class="form-control form-control-lg bg-gray-footer-parodi" name="nacionalidad"
                                    id="nacionalidad">
                                    <option value="">Seleccione</option>
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="P">P</option>
                                    <option value="J">J</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" max="9" class="form-control form-control-lg bg-gray-footer-parodi"
                                    name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                            </td>
                        </tr>
                    </table>
                    <small id="help_cedula" class="form-text notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="email">Correo electrónico</label>
                    <input type="email" class="form-control form-control-lg bg-gray-footer-parodi" name="email"
                        id="email" aria-describedby="helpId" placeholder="">
                    <small id="help_email" class="form-text"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="nombre">Nombres</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="nombres"
                        id="nombres" aria-describedby="helpId" placeholder="">
                    <small id="help_nombres" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="apellido">Apellidos</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="apellidos"
                        id="apellidos" aria-describedby="helpId" placeholder="">
                    <small id="help_apellidos" class="form-text text-muted notification"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="genero">Género</label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="genero" id="genero"
                        aria-describedby="helpId" placeholder="">
                        <option value="">Seleccione</option>
                        <option value="m">Masculino</option>
                        <option value="f">Femenino</option>
                    </select>
                    <small id="help_genero" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                    <input type="date" class="form-control form-control-lg bg-gray-footer-parodi" name="fnacimiento"
                        id="fnacimiento" aria-describedby="helpId" placeholder="">
                    <small id="help_fnacimiento" class="form-text text-muted notification"></small>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="telefono_movil">Teléfono Contacto</label>
                    <input type="tel" onkeyup="validarPrimerDigito('telefono_movil')"
                        class="form-control form-control-lg bg-gray-footer-parodi" name="telefono_movil"
                        id="telefono_movil" aria-describedby="helpId" placeholder="">
                    <small id="help_telefonomovil" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                <div class="h3">
                    Dirección
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="label-text text-secondary" for="cat_estado_id">Estado</label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_estado_id"
                        id="cat_estado_id" aria-describedby="helpId" placeholder=""></select>
                    <small id="help_cat_estado_id" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="label-text text-secondary" for="cat_municipio_id">Municipio</label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_municipio_id"
                        id="cat_municipio_id" aria-describedby="helpId" placeholder=""></select>
                    <small id="help_cat_municipio_id" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="label-text text-secondary" for="description">Ciudad</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="description"
                        id="description" aria-describedby="helpId" placeholder="">
                    <small id="help_description" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label class="label-text text-secondary" for="domicilio">Domicilio</label>
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="domicilio" id="domicilio"
                        rows="2"></textarea>
                    <small id="help_domicilio" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="w-100">
                    <tr>
                        <td>
                            <div class="text-center">
                                <img id="imagen_perfil" style="width: 5em; height:5em"
                                    src="/image/user/foto_perfil/doc_id.svg" class="imagen-perfil"
                                    alt="Medic default">
                                <br />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="label-text text-secondary" for="imagen">Foto del paciente</label>
                                <input type="file" class="form-control form-control-lg bg-gray-footer-parodi"
                                    name="imagen" id="imagen" aria-describedby="helpId" placeholder="">
                                <small id="help_imagen" class="form-text text-muted"></small>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>


</template>
<template id="form_post_covid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                <div class="h3">
                    Datos Post Covid
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label class="label-text text-secondary" for="hospitalizacion">
                        ¿En que fecha se iniciaron tus sintomas de covid?
                    </label>
                    <input type="date" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="inicio_sintomas" id="inicio_sintomas" aria-describedby="helpId" placeholder="">

                    <small id="help-hospitalizacion" class="form-text text-muted"></small>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="hospitalizacion">
                        ¿Fuiste hospitalizado en algún centro de salud (Ambulatorio, Clínica u Hospital)?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="hospitalizacion"
                        id="hospitalizacion" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-hospitalizacion" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="atencion_med">
                        ¿Recibiste atención médica en casa (te valoró algún médico en tu domicilio)?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="atencion_med"
                        id="atencion_med" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-atencion_med" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="oxigenoterapia">
                        ¿Recibiste Oxigenoterapia?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="oxigenoterapia"
                        id="oxigenoterapia" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-oxigenoterapia" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="sintomatologia">
                        ¿Persiste alguna sintomatología respiratoria 1 mes o más después de que te hicieron el
                        diagnóstico de COVID?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="sintomatologia"
                        id="sintomatologia" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-sintomatologia" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="form_paciente_cita">
    <form class="needs-validation">
        <div class="container" novalidate>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center text-primary font-weight-bold h3">
                                    Ingresa tu información
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="cedula">Documento de identidad</label>
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 40%">
                                                <select class="form-control form-control-lg bg-gray-footer-parodi"
                                                    title="Seleccione una nacionalidad" name="nacionalidad"
                                                    id="nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                                <small id="help_nacionalidad" class="notification"></small>
                                            </td>
                                            <td>
                                                <input required type="number"
                                                    title="Documento de identidad es requerido."
                                                    class="form-control form-control-lg bg-gray-footer-parodi"
                                                    name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                                                <small id="help_cedula" class="notification"></small>
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="email">Correo Electrónico</label>
                                    <input type="text" required name="email" id="email"
                                        class="form-control form-control-lg bg-gray-footer-parodi" placeholder=""
                                        aria-describedby="helpEmail">
                                    <small id="help_email" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="nombre">Nombres</label>
                                    <input type="text" required
                                        class="form-control form-control-lg bg-gray-footer-parodi" name="nombres"
                                        id="nombres" aria-describedby="helpId" placeholder="">
                                    <small id="help_nombres" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="apellido">Apellidos</label>
                                    <input type="text" required
                                        class="form-control form-control-lg bg-gray-footer-parodi" name="apellidos"
                                        id="apellidos" aria-describedby="helpId" placeholder="">
                                    <small id="help_apellidos" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="genero">Género</label>
                                    <select class="form-control required form-control-lg bg-gray-footer-parodi"
                                        name="genero" id="genero" aria-describedby="helpId" placeholder="">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                    <small id="help_genero" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                    <input type="date" required
                                        class="form-control form-control-lg bg-gray-footer-parodi" name="fnacimiento"
                                        id="fnacimiento" aria-describedby="helpId" placeholder="">
                                    <small id="help_fnacimiento" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                    <input type="tel" required onkeyup="validarPrimerDigito('telefono_movil')"
                                        class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_telefono_movil" class="notification">(preferiblemente vinculado a
                                        <i class="text-success">Whatsapp</i>)</small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <!--
                                <div class="form-group">
                                    <label class="text-primary" for="parentesco">¿Quien es el paciente?</label>
                                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="parentesco" id="parentesco" aria-describedby="helpId" placeholder="">
                                        <option value="0">Soy yo</option>
                                        <option value="1">Hijo(a)</option>
                                        <option value="2">Padre</option>
                                        <option value="3">Conyugue</option>
                                        <option value="4">Nieto(a)</option>
                                        <option value="5">Abuelo(a)</option>
                                        <option value="6">BisaAbuelo(a)</option>
                                        <option value="1000">Otro</option>
                                    </select>
                                    <small id="helpId1" class=""></small>
                                </div> -->
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div id="container-parentesco" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 d-none">
                                <div class="form-group">
                                    <label class="text-primary" for="parentesco_nacionalidad">Documento de identidad <span id="select-parentesco-text" class="text-success font-weight-bold">(Padre)</span></label>
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 30%">
                                                <select  class="form-control form-control-lg bg-gray-footer-parodi" title="Seleccione una nacionalidad" name="parentesco_nacionalidad" id="parentesco_nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input  type="number" min=7 max="8" title="Cédula solo acepta 8 dígitos" class="form-control form-control-lg bg-gray-footer-parodi" name="parentesco_cedula" id="parentesco_cedula" aria-describedby="helpId" placeholder="">
                                            </td>
                                        </tr>
                                    </table>
                                    <small class=""></small>
                                </div>
                            </div>
                        </div>  -->
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="text-primary" for="cat_estado_id">Estado</label>
                                    <select required class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_estado_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="text-primary" for="cat_municipio_id">Municipio</label>
                                    <select required class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_municipio_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="text-primary" for="description">Ciudad</label>
                                    <input required type="text"
                                        class="form-control form-control-lg bg-gray-footer-parodi" name="description"
                                        id="description" aria-describedby="helpId" placeholder="">
                                    <small id="help_description" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="text-primary" for="domicilio">Domicilio</label>
                                    <textarea required class="form-control form-control-lg bg-gray-footer-parodi" name="domicilio" id="domicilio"
                                        rows="2"></textarea>
                                    <small id="help_domicilio" class="notification"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <label class="h3 text-primary text-center d-block" for="calendar">Agenda tu cita</label>
                    <!-- ........................ -->

                    <a data-toggle="collapse" href="#collapseEspecialidad" role="button" aria-expanded="false"
                        aria-controls="collapseEspecialidad">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-1"
                                style="width: 25px;line-height: 1.5;">1</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Selecciona la Especialidad</b>
                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseEspecialidad">
                        <select required data-item="item-1" name="cat_especialidad_id" class="medico-select"
                            id="cat_especialidad_id"></select>
                        <small class="notification"></small>
                    </div>


                    <a data-toggle="collapse" href="#collapseMedico" role="button" aria-expanded="false"
                        aria-controls="collapseMedico">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-2"
                                style="width: 25px;line-height: 1.5;">2</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Médico de tu preferencia</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseMedico">
                        <select required name="user_id_medico" class="medico-select" id="user_id_medico">

                        </select>
                        <small class="notification"></small>
                    </div>

                    <a data-toggle="collapse" href="#collapseDia" role="button" aria-expanded="false"
                        aria-controls="collapseDia">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-3"
                                style="width: 25px;line-height: 1.5;">3</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el día de tu conveniencia</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseDia">
                        <div id="mensaje_dia_seleccionado" class="text-center text-secondary" style="font-size:15px">
                            Solo los días resaltados están disponibles.
                        </div>
                        <input required id="cita_dia" name="cita_dia" type="hidden">
                        <div id="calendar" class="daterange" style="width: 100%"></div>

                    </div>
                    <a data-toggle="collapse" href="#collapseHora" role="button" aria-expanded="false"
                        aria-controls="collapseHora">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-4"
                                style="width: 25px;line-height: 1.5;">4</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Escoje una hora</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseHora">
                        <input required id="cita_hora" name="cita_hora" type="hidden">
                        <ul class="nav justify-content-center  nav-tabs mb-3" id="horarios" role="tablist">
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <a class="nav-link active" id="pills-am-tab" data-cita-horario="am" data-toggle="pill"
                                    href="#pills-am" role="tab" aria-controls="pills-am" aria-selected="true">Mañana</a>
                            </li>
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <a class="nav-link" id="pills-pm-tab" data-cita-horario="pm" data-toggle="pill"
                                    href="#pills-pm" role="tab" aria-controls="pills-pm" aria-selected="false">Tarde</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContentHoras">
                            <div class="tab-pane fade show active" id="pills-am" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                                    Sin Horas Disponibles
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pills-pm" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                                    Sin Horas Disponibles
                                </ul>
                            </div>
                        </div>
                    </div>

                    <a data-toggle="collapse" href="#collapseMotivo" role="button" aria-expanded="false"
                        aria-controls="collapseMotivo">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1" style="width: 25px;line-height: 1.5;">
                                5</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el motivo de consulta</b> <span
                                    class="text-secondary">(opcional)</span>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2" id="collapseMotivo">
                        <textarea class="form-control bg-gray-footer-parodi" placeholder="Escribe el motivo" name="cita_motivo"
                            id="cita_motivo" rows="3"></textarea>
                    </div>





                    <!--
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header p-0" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">


                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFor" aria-expanded="false"
                                        aria-controls="collapseFor">


                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFor" class="collapse" aria-labelledby="headingFive"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingOne">
                                <h2 class="mb-0">

                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">


                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">


                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">



                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">

                                <div class="card-body">

                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header p-0" id="headingFor">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFor">

                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                data-parent="#accordionExample">
                                <div class="card-body py-0">

                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="row fixed-bottom p-1 bg-white">
                <div class="col-md-4 offset-md-4">
                    <button id="submit" type="submit"
                        class="btn btn-success btn-block btn-lg font-weight-bold h3">Crear
                        cíta</button>
                </div>
            </div>
        </div>
    </form>
</template>
<template id="btnGroup-1">
    <div class="fixed-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Completar
                        registro</button>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="btnGroup-2">
    <div class="fixed-bottom bg-white">
        <div class="container">
            <div class="row">
                @if (is_null(Auth::id()))
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Completar
                            registro</button>
                    </div>
                @else
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button onclick="history.back()"
                            class="font-weight-bold btn btn-secondary mb-1 btn-block btn-lg">Regresar</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button id="store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Completar
                            registro</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</template>
<template id="navbar">
    <nav class="navbar navbar-expand navbar-primary navbar-light navbar-v2">
        <div>
            <a id="logoSystem" href="#"><img loading="lazy" style="height: 4em;width: 10em;"
                    src="{{ asset('image/system/patientcare_bw.svg') }}"></a>
        </div>
    </nav>
</template>
<template id="cargando">
    <div id="carga" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="d-flex m-4 justify-content-center text-primary">
                    Espere un momento por favor...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="bienvenida1">
    <div class="container-fluid bg-primary p-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i style="font-size: 0.8em;">Bienvenido a la</i><br>
                    Clínica Post Covid<br>
                    <span style="overflow-wrap: normal;font-weight:400">COVID-19</span>
                </h3>
                <p class="lead" style="font-size: 1.4em;font-style: italic;">
                    Para brindarle el mejor servicio posible,<br>
                    le pedimos por favor<br>
                    completar el siguiente formulario.
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                <button id="empezarcuestionario" data-dismiss="modal" type="button"
                    class="btn btn-light btn-block btn-lg text-primary">De acuerdo, comenzar</button>
            </div>
        </div>
    </div>




</template>
<template id="infoUser">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center text-primary font-weight-bold h3">
                    Información del paciente
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center text-secondary">
                    Le agradecemos mucho el tiempo que nos has dedicado a darnos tus opiniones, las cuales son de mucha
                    importancia para mejorar nuestros servicios.<br>
                    Esta encuesta es anonima, y puedes enviarla en este momento sin identificarse pulsando el Botón
                    <label class="cursor-pointer text-success" for="submit">Enviar encuesta</label>.<br>
                    La decisión de identificarse compartiendo sus datos con nosotros es tuya, si lo deseas.<br>
                    De igual manera, <b>si deseas hacer cualquier comentario adicional o darnos cualquier opinión o
                        recomendacion<b>, puedes hacerlo en el campo <label class="cursor-pointer text-primary"
                                for="coment">Comentarios personales</label>.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="nombre">Nombres</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="nombres"
                        id="nombres" aria-describedby="helpId" placeholder="">
                    <small id="help_nombres" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="apellido">Apellidos</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="apellidos"
                        id="apellidos" aria-describedby="helpId" placeholder="">
                    <small id="help_apellidos" class="form-text text-muted notification"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="cedula">Documento de identidad</label>
                    <table class="w-100">
                        <tr>
                            <td style="width: 30%">
                                <select class="form-control form-control-lg bg-gray-footer-parodi" name="nacionalidad"
                                    id="nacionalidad">
                                    <option value="">Seleccione</option>
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="P">P</option>
                                    <option value="J">J</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" max="9" class="form-control form-control-lg bg-gray-footer-parodi"
                                    name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                            </td>
                        </tr>
                    </table>
                    <small id="help_cedula" class="form-text notification"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="email">Correo Electrónico</label>
                    <input type="text" name="email" id="email"
                        class="form-control form-control-lg bg-gray-footer-parodi" placeholder=""
                        aria-describedby="helpEmail">
                    <small id="helpEmail" class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="label-text text-primary text-center h1 w-100" for="coment">Comentarios personales
                        <small class="text-gray">(opcional)</small></label>
                    <textarea name="coment" id="coment" class="form-control form-control-lg bg-gray-footer-parodi" placeholder=""
                        aria-describedby="helpComent"></textarea>
                    <small id="helpComent" class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="submit" class="btn btn-success btn-block btn-lg font-weight-bold h3">Enviar
                    Encuesta</button>
            </div>
        </div>
    </div>
</template>
<template id="question">
    <div class="container-fluid scale-up-ver-top">
        <div class="row">
            <div class="col-12 p-0 bd-callout bd-callout-primary">
                <div class="d-flex align-item mr-3"
                    style="width: fit-content; background-color: #f3eeee !important;border-radius: 0rem 50rem 50rem 0rem !important;">


                    <div class="bd-callout-number mx-2">99</div>
                    <div role="pregunta" class="encuesta-pregunta">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam, doloremque iste vel amet
                        officia atque temporibus veniam culpa, nobis deleniti labore fugiat odio? Nisi consectetur ad
                        aliquid libero quos hic.
                    </div>
                </div>


                <ul class="nav nav-pills mt-2 flex-row align-items-center  font-weight-bold" id="lista-respuestas"
                    role="lista-respuestas">

                </ul>
                <div class="coments d-none">
                    <div class="form-group mx-1 mt-2">
                        <textarea class="form-control w-50 " placeholder="Describe, el por qué de tu respuesta..."
                            style="background-color: #f3eeee !important;color:var(--secondary)" name="" id=""
                            rows="2"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="badgeContador">
    <div class="badge badge-primary ping" style="
        position: fixed;
        z-index: 1;
        right: 2%;
        bottom: 1%;
        font-size: 1rem;
    ">
        0/50
    </div>
</template>
<template id="card1">
    <a href="#">
        <div class="small-box">
            <div class="inner">
                <h3>00<sup style="font-size: 20px">%</sup></h3>
                <p>Title</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="small-box-footer d-flex justify-content-center align-items-center">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </a>
</template>
