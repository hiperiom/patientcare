@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
{{-- @section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection --}}
@section('content')
    <div id="loadingScreen" class="loadingScreen">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img loading="lazy" onerror="this.src='/image/system/patient.svg'" src="/image/system/logo-cmdlt-blanco.svg" class="mb-3" alt="Cmdlt" style="width: 140px; height: 80px" />
            <div class="d-flex align-items-center justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
                <h4 class="pl-2 swing-in-top-fwd">Por favor espere un momento...</h4>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column pt-1 px-1 h-vh-100 bg-gray-300">
        <nav class="navbar px-3 py-1 rounded-pill justify-content-between navbar-expand-lg bg-primary">
            <div>
                <div class="btn-group">
                    <a data-tippy-content="Menú principal . Pulsa para abrir" class="tooltip-info" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img loading="lazy" onerror="this.src='/image/system/patient.svg'" src="{{ session('userData')['imagen'] }}" alt="Bootstrap" class="rounded-circle"
                            style="width: 40px; height: 40px" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="triggerId">
                        <a href="#" class="list-group-item list-group-item-action bg-primary">
                            Menú Patientcare
                        </a>
                        @php
                            $optionsMenu = [


                            ];
                        @endphp
                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/medico"><i
                                class="fas fa-home text-primary"></i> Inicio</a>
                        @if (session('userData')['especialidad_id'] == 62)
                            <a class="dropdown-item p-2 scale-up-ver-top  " href="/medico/index_medicos"><i
                                    class="fas fa-user-md text-primary"></i> Equipo
                                Médico</a>
                        @endif


                        @if (Request::is('medico'))
                            <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer"
                                onclick="CatUserEspecialidad.menuEspecialidad('.modal-body')">
                                <i class="fas fa-notes-medical text-primary"></i>
                                Especialidades
                            </a>
                        @endif


                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/pendiente"><i
                                class="fas fa-users text-primary"></i> Nuevos
                            Pacientes</a>
                        <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer"
                            onclick="UserCuestEpisodio.indexEpisodioCIE11({})">
                            <i class="fas fa-book-medical text-primary"></i>
                            Clasificador CIE-11
                        </a>
                        <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer"
                            onclick="UserCuestEpisodio.indexEntregaGuardia({})">
                            <i class="fas fa-address-book text-primary"></i>
                            Entrega de guardia
                        </a>
                        <a class="dropdown-item p-2 scale-up-ver-top  " target="_blank" href="/reportes/pad/resumen"><i
                                class="fas fa-home text-primary"></i>
                            Dashboard PAD</a>
                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/create"><i
                                class="fas fa-external-link-alt text-primary"></i>
                            Cuestionario covid</a>
                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/post_covid_index"><i
                                class="fas fa-external-link-alt text-primary"></i>
                            Clínica PostCovid</a>
                        <a class="dropdown-item p-2 scale-up-ver-top  btn-telesaludEmpresarial"
                            href="/telesalud/empresarial/index"><i class="fas fa-building text-primary"></i>
                            Telesalud Empresarial</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/finalizarSesion"><i
                                class="fas fa-sign-out-alt text-primary"></i> Salir</a>
                    </div>
                </div>
            </div>
            <div class="flex-fill pl-1 text-white d-flex flex-column">
                <i>
                    @if (isset(session('userData')['genero']) && session('userData')['genero'] == 'f')
                        ¡Bienvenida!
                    @else
                        ¡Bienvenido!
                    @endif
                </i>
                <div class="font-weight-bold">
                    {{ !is_null(session('userData')['prefijo']) ? session('userData')['prefijo'] : '' }}
                    {{ session('userData')['nombre'] }} {{ session('userData')['apellido'] }}
                </div>

            </div>

            <a href="/finalizarSesion">
                <img loading="lazy" src="/image/system/logo-cmdlt-blanco.svg" alt="Bootstrap" style="width: 100px; height: 40px" />
            </a>
        </nav>
        <nav class="navbar pt-1 pb-0 swing-in-top-fwd">
            <div class="col-12 col-md-8">

                <ul id="cat_user_ubicacion_menu" class="nav nav-pills overflow-auto flex-nowrap text-uppercase"
                    role="tablist">
                    @php
                        $optionsMenu = [
                            [
                                "name"=>"Todos los pacientes",
                                "siglas_name"=>"TP",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>1
                            ],
                            [
                                "name"=>"Emergencia Adulto",
                                "siglas_name"=>"EA",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>2
                            ],
                            /*EMERGENCIA*/
                            [
                                "name"=>"Emergencia Pediátrica",
                                "siglas_name"=>"EP",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>28
                            ],
                            [
                                "name"=>"Área Quirúrgica",
                                "siglas_name"=>"AQ",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>41
                            ],
                            /*HOSPITALIZACION*/
                            [
                                "name"=>"Hospitalización Corta Estancia Pediátrica",
                                "siglas_name"=>"HCEP",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>390
                            ],
                            [
                                "name"=>"Hospitalización Piso 2",
                                "siglas_name"=>"HP2",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>42
                            ],
                            [
                                "name"=>"Hospitalización Piso 3",
                                "siglas_name"=>"HP3",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>70
                            ],
                            [
                                "name"=>"Hospitalización Piso 4",
                                "siglas_name"=>"HP4",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>98
                            ],
                            [
                                "name"=>"Hospitalización Piso 5",
                                "siglas_name"=>"HP5",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>126
                            ],
                            [
                                "name"=>"Hospitalización Piso 6",
                                "siglas_name"=>"HP6",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>154
                            ],
                            [
                                "name"=>"Unidad de Tratamiento Intensivo Adulto",
                                "siglas_name"=>"UTIA",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>182
                            ],
                            [
                                "name"=>"Unidad de Tratamiento Intensivo Pediátrico",
                                "siglas_name"=>"UTIP",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>211
                            ],
                            [
                                "name"=>"Unidad de Tratamiento Intensivo Neonatal",
                                "siglas_name"=>"UTIN",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>391
                            ],
                            [
                                "name"=>"Programa de Atención Domiciliaria",
                                "siglas_name"=>"PAD",
                                "classHandleClick"=>"menu-pad",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>223
                            ],
                            [
                                "name"=>"Altas Médica",
                                "siglas_name"=>"ALTAS",
                                "classHandleClick"=>"",
                                "dropdowm"=>FALSE,
                                "icon"=>"",
                                "color"=>"success",
                                "private"=>FALSE,
                                "active"=>TRUE,
                                "cat_user_ubicacion_id"=>null
                            ],



                        ];

                    @endphp
                    @foreach ($optionsMenu as $key => $item)
                        @php
                           $active = "";
                           if ($key == 0) {
                                $active = "active";
                           }
                        @endphp

                        <li class="
                            nav-item
                            mb-2"
                            role="presentation"
                        >
                            <a
                                data-toggle="pill"
                                role="tab"
                                aria-controls="pills-{{strtolower($item['siglas_name'])}}"
                                aria-selected="false"
                                id="area_{{strtolower($item['siglas_name'])}}"
                                class="nav-link tooltip-{{$item['color']}} {{$item['classHandleClick']}} py-1 px-2"
                                data-area="{{strtolower($item['siglas_name'])}}"
                                data-tippy-content="{{$item['name']}}"
                                data-title="{{$item['name']}}"
                                data-cat_user_ubicacion_id="{{$item['cat_user_ubicacion_id']}}"
                                href="#"
                            >
                                <div class="d-flex align-items-center">
                                    <div class="pr-1 text-uppercase">{{$item['siglas_name']}}</div>
                                    <div id="{{strtolower($item['siglas_name'])}}_badge" class="badge badge-light">0</div>
                                </div>
                            </a>

                        </li>

                    @endforeach
                </ul>

            </div>
            <div class="col-12 col-md-4 d-flex">
                <input id="busquedapaciente" class="form-control mr-2" type="search"
                    placeholder="Buscar un paciente..." aria-label="Search" />
                <a id="btn_paciente_create" onclick="location.origin='/medico/create_paciente'"
                    class="ms-1 btn btn-success text-white text-nowrap">Nuevo Paciente</a>
            </div>
        </nav>
        <nav class="navbar py-0 mx-0 mx-xs-3 mt-1 rounded navbar-expand-lg swing-in-top-fwd"
            >
            <div  class="col-11 col-md-5">
                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-primary btn-layout-options tooltip-primary mr-1" data-tippy-content="Cambiar el modo de visualización de pacientes">
                        <i class="btn-layout-options pc-solid-pisos"></i>
                    </a>
                    <span id="titleArea" class="h5 my-0 text-primary text-uppercase text-nowrap overflow-hidden">Todos los pacientes</span>
                </div>
            </div>
            <div class="col-12 col-md-7 ">
                <ul id="gruposAreasMenu"
                    class="nav nav-pills justify-content-md-end overflow-auto flex-nowrap text-uppercase" role="tablist">

                    <li data-tippy-content="Total Pacientes" class="tooltip-primary nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-paciente text-secondary h5"></i>
                                <div id="total_pacientes" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li class="btn-total-emergencia nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-light-emergency text-secondary h5"></i>
                                <div id="total_emergencia" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li class="btn-total-hospitalizacion nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-light-hospital text-secondary h5"></i>
                                <div id="total_hospitalizacion" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <!-- data-tippy-content="Total Unidad de Tratamiento Intensivo (UTI)" -->
                    <li class="btn-total-uti nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-uti-light text-secondary h5"></i>
                                <div id="total_uti" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <!-- data-tippy-content="Total Programa de Atención Domiciliaria (PAD)"  -->
                    <li class="btn-total-pad nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-light-homecare text-secondary h5"></i>
                                <div id="total_pad" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li data-tippy-content="Total Pacientes con Infección de Herida Intermedio - Alto"
                        class="tooltip-primary nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-cirugia text-secondary h5"></i>
                                <div id="total_infeccion" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li data-tippy-content="Total Pacientes con Riesgo de Caida Intermedio - Alto"
                        class="tooltip-primary  nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-resbalar text-secondary h5"></i>
                                <div id="total_caida" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li data-tippy-content="Total Pacientes de riesgo Intermedio - Alto" class="tooltip-primary nav-item"
                        role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-alerta_estable text-secondary h5"></i>
                                <div id="total_riesgo" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li data-tippy-content="Total VIP" class="tooltip-primary  nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-paciente_vip text-secondary h5"></i>
                                <div id="total_vip" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>
                    <li data-tippy-content="Total Prealtas" class="tooltip-primary nav-item" role="presentation">
                        <a class="nav-link py-1 px-2" href="#" role="tab">
                            <div class="d-flex align-items-center">
                                <i class="pc-cronometro-solid text-secondary h5"></i>
                                <div id="total_prealtas" class="navbar-totales bg-light rounded px-1">0</div>
                            </div>
                        </a>
                    </li>





                </ul>
            </div>
        </nav>
        <nav class="navbar p-0 mx-0 mx-xs-3 mt-1 rounded navbar-expand-lg swing-in-top-fwd"
            style="border-top-left-radius: 20px !important;border-top-right-radius: 20px !important;">
            <div  class="col-12 bg-light m-0 p-0 text-nowrap overflow-hidden">
                <marquee id="priorizadosMarquee" data-tippy-content="Pacientes Priorizados" class="tooltip-primary cursor-pointer text-secondary mt-1"
                onmouseout="this.start()" onmouseover="this.stop()" scrollamount="5">

                </marquee>
            </div>
        </nav>

        <div id="App" class="flex-fill mb-2 overflow-auto border-radius-xl">

            <table id="tablapacientesSignosVitales" class="d-none table table-bordered bg-white table-striped-columns align-middle">
                <thead>

                    <tr>
                        <th data-tippy-content="Área de ubicación del paciente" class="tooltip-primary header-1" scope="col">UBICACIÓN</th>
                        <th data-tippy-content="Días desde el ingreso" class="tooltip-primary header-1" scope="col">DÍAS</th>
                        <th data-tippy-content="Información del paciente" class="tooltip-primary header-1" scope="col">PACIENTE</th>
                        <th data-tippy-content="Género" class="tooltip-primary header-1" scope="col">SEXO</th>
                        <th data-tippy-content="Edad" class="tooltip-primary header-1" scope="col">EDAD</th>
                        <th data-tippy-content="Temperatura" class="tooltip-primary header-1" scope="col">TEMP</th>
                        <th data-tippy-content="Frecuencia Cardíaca" class="tooltip-primary header-1" scope="col">FC</th>
                        <th data-tippy-content="Frecuencia Respiratoria" class="tooltip-primary header-1" scope="col">FR</th>
                        <th data-tippy-content="Tensión Arterial" class="tooltip-primary header-1" scope="col">TA</th>
                        <th data-tippy-content="Glicemia" class="tooltip-primary header-1" scope="col">GL</th>
                        <th data-tippy-content="Oximetría" class="tooltip-primary header-1" scope="col">SPO2</th>
                        <th data-tippy-content="Acciones" class="tooltip-primary header-1" scope="col">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody class="row_pacientes">

                </tbody>
            </table>
            <table id="tablapacientesDiagnosticos" class="d-none table table-bordered bg-white table-striped-columns align-middle">
                <thead>

                    <tr>
                        <th data-tippy-content="Área de ubicación del paciente" class="tooltip-primary header-1" scope="col">UBICACIÓN</th>
                        <th data-tippy-content="Días desde el ingreso" class="tooltip-primary header-1" scope="col">DÍAS</th>
                        <th data-tippy-content="Información del paciente" class="tooltip-primary header-1" scope="col">PACIENTE</th>
                        <th data-tippy-content="Género" class="tooltip-primary header-1" scope="col">SEXO</th>
                        <th data-tippy-content="Edad" class="tooltip-primary header-1" scope="col">EDAD</th>
                        <th data-tippy-content="Impresión Diagnóstica" class="tooltip-primary header-1" scope="col">DIAGNÓSTICO</th>
                        <th data-tippy-content="Impresión Diagnóstica" class="tooltip-primary header-1" scope="col">EVOLUCIÓN</th>
                        <th data-tippy-content="Equipo médico especialista" class="tooltip-primary header-1" scope="col">EQUIPO MÉDICO</th>
                    </tr>
                </thead>
                <tbody class="row_pacientes">

                </tbody>
            </table>
        </div>
    </div>
    <template id="template_paciente_nuevo_buscar">
        <div class="d-flex flex-column box-container-height-2">
            <div class="d-flex p-1 justify-content-between align-items-center">
                <h3 id="title" class="m-0 text-primary">Buscar Paciente</h3>
                <a class="d-block d-sm-none btn-modal-nuevo-paciente overflow-hidden text-nowrap btn btn-outline-success rounded-pill" id="pills-nuevo-paciente-tab2" href="#">Nuevo
                    Paciente</a>
            </div>
          <ul class="nav p-1 nav-pills justify-content-center justify-content-sm-between align-items-center flex-nowrap" id="pills-tab-paciente-options" role="tablist">
            <li class="nav-item d-none" role="presentation">
              <div class="dropdown">
                <button class="btn btn-default border text-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-filter"></i>
                </button>

                <div id="buscar_por" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Cédula</a>
                  <a class="dropdown-item" href="#">Nombres o Apellidos</a>
                  <a class="dropdown-item" href="#">Episodio SAP</a>
                </div>
              </div>
            </li>
            <li class="flex-grow-1 nav-item px-1" role="presentation">
              <input type="search" placeholder="Escribe texto a buscar..." class="form-control" id="search_advanced_paciente">
            </li>
            <li class="flex-shrink-1 nav-item px-1">
              <ul class="nav flex-nowrap nav-pills">
                <li class="nav-item" role="presentation">
                  <a class="btn-modal-search-paciente nav-link active" id="pills-buscador-paciente-tab" data-toggle="pill" href="#pills-buscador-paciente" role="tab" aria-controls="pills-buscador-paciente" aria-selected="true">
                    <i class="btn-modal-search-paciente fas fa-search"></i>
                  </a>
                </li>
                <li class="nav-item d-none d-sm-block" role="presentation">
                  <a class="btn-modal-nuevo-paciente overflow-hidden ml-1 text-nowrap nav-link" id="pills-nuevo-paciente-tab" data-toggle="pill" href="#pills-nuevo-paciente" role="tab" aria-controls="pills-nuevo-paciente" aria-selected="false">Nuevo
                    Paciente</a>
                </li>
              </ul>
            </li>

          </ul>
          <div class="flex-fill tab-content d-flex flex-column overflow-hidden">
            <div class="flex-fill tab-pane fade overflow-auto show active" id="pills-buscador-paciente" role="tabpanel"
              aria-labelledby="pills-buscador-paciente-tab">

                <table id="modal_table_paciente_search" class="table">
                  <thead>
                    <tr>
                      <th class="header-1" scope="col">#</th>
                      <th class="header-1" scope="col">Paciente</th>
                      <th class="header-1 text-center" scope="col">Cédula</th>
                      <th class="header-1 text-center" scope="col">Episodios</th>
                      <th class="header-1 text-center" scope="col">Registro</th>
                      <th class="header-1" scope="col">Acción</th>
                    </tr>
                  </thead>
                  <tbody>

                   <tr>
                      <td class="text-center text-primary" colspan="6">
                        Sin resultados<br>
                        <button class="btn-modal-empty-nuevo-paciente btn btn-primary mt-3">
                          Nuevo Paciente
                        </button>
                      </td>
                    </tr>






                  </tbody>
                </table>

            </div>
            <div class="flex-fill tab-pane fade overflow-auto" id="pills-nuevo-paciente" role="tabpanel"
              aria-labelledby="pills-nuevo-paciente-tab">
            <div class="d-flex flex-column">
                <div class="p-1 overflow-auto">
                  <div class="accordion" id="accordionExample">
                    <div class="card border-0 mb-0">
                      <div class="card-header p-0 bg-transparent" id="headingOne">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <h3 class="mb-0">Datos del paciente</h3>
                            </button>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="container">
                                <input id="cat_user_type_id" type="hidden" value="1">

                                <div class="row">
                                    <div class="col-12 text-secondary">
                                    <div class="h5">
                                        Información personal
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                                        <d class="d-flex">
                                            <select class="flex-shrink-1 form-control bg-gray-footer-parodi" name="nacionalidad" id="nacionalidad" style="width: fit-content;">
                                                <option title="Venezolano" value="V">V</option>
                                                <option title="Extrangero" value="E">E</option>
                                                <option title="Pasaporte" value="P">P</option>
                                            </select>
                                            <input type="number" max="9" class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi" name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                                        </d>
                                        <small id="sms_cedula" class="form-text text-danger notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="email">Correo electrónico</label>
                                        <input type="email" class="form-control bg-gray-footer-parodi" name="email" id="email" aria-describedby="helpId" placeholder="">
                                        <small id="sms_email" class="form-text text-danger notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="nombre">Nombres</label>
                                        <input type="text" class="form-control bg-gray-footer-parodi" name="nombres" id="nombres" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="apellido">Apellidos</label>
                                        <input type="text" class="form-control bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="genero">Género</label>
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
                                        <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                                        <input type="date" class="form-control bg-gray-footer-parodi" name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="telefono_movil">Teléfono contacto</label>
                                        <input type="number" class="form-control bg-gray-footer-parodi" name="telefonomovil" id="telefonomovil" aria-describedby="helpId" placeholder="">
                                        <small id="help_telefonomovil" class="form-text text-muted notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="telefono_hogar">Teléfono secundario</label>
                                        <input type="number" class="form-control bg-gray-footer-parodi" name="telefono_hogar" id="telefono_hogar" aria-describedby="helpId" placeholder="">
                                        <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                                    </div>
                                    </div>

                                    <div class="col-12 text-secondary">
                                    <div class="h5">
                                        Dirección
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="cat_estado_id">Estado</label>
                                        <select class="form-control bg-gray-footer-parodi" name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId" placeholder=""><option value="">Seleccione</option>

                                                                </select>
                                        <small id="helpId1" class="form-text text-muted"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="cat_municipio_id">Municipio</label>
                                        <select class="form-control bg-gray-footer-parodi" name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId" placeholder=""><option value="">Seleccione</option>

                                                                    </select>
                                        <small id="helpId1" class="form-text text-muted"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="description">Ciudad</label>
                                        <input type="text" class="form-control bg-gray-footer-parodi" name="description" id="description" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted"></small>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="domicilio">Domicilio</label>
                                        <textarea class="form-control bg-gray-footer-parodi" name="domicilio" id="domicilio" rows="2"></textarea>
                                        <small id="helpId1" class="form-text text-muted"></small>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <div class="d-flex flex-column align-items-center">
                                        <img loading="lazy" onerror="this.src='/image/system/patient.svg'" id="imagen_perfil" style="width: 100px; height:100px;border-radius:10px;" src="/image/user/foto_perfil/doc_id.svg" class="imagen-perfil" alt="Medic default">
                                        <div class="form-group text-center">
                                        <label class="label-text text-secondary" for="imagen">Foto documento de identidad</label>
                                        <input type="file" class="p-1 form-control bg-gray-footer-parodi" name="imagen" id="imagen" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12 text-secondary">
                                    <div class="h5">
                                        Ubicación del paciente
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <label class="label-text text-secondary" for="">Área de ubicación</label>
                                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control bg-gray-footer-parodi">
                                    </select>
                                    </div>
                                    <div class="col-12">
                                    <select id="subUbicacion1" name="subUbicacion1" class="form-control mt-1 bg-gray-footer-parodi">
                                    </select>
                                    </div>
                                    <div class="col-12">
                                    <select id="subUbicacion2" name="subUbicacion2" class="form-control mt-1 bg-gray-footer-parodi">
                                    </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-1">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="n_episodio_sap">N° Episodio SAP</label>
                                        <input type="n_episodio_sap" class="form-control bg-gray-footer-parodi" name="n_episodio_sap" id="n_episodio_sap" aria-describedby="helpId" placeholder="">
                                        <small id="sms_n_episodio_sap" class="form-text text-danger notification"></small>
                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-1">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="nombre">Fecha de ingreso</label>
                                        <input type="date" class="form-control bg-gray-footer-parodi" name="ingreso" id="ingreso" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted notification"></small>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="card border-0 mb-0">
                        <div class="card-header p-0 bg-transparent" id="headingTwo">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <h3 class="mb-0">Datos del familiar</h3>
                          </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                            <div class="container">
                              <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="familiar_email">Correo electrónico</label>
                                    <input type="text" class="form-control bg-gray-footer-parodi" name="familiar_email" id="familiar_email" aria-describedby="helpId" placeholder="">

                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="familiar_nombre">Nombres</label>
                                    <input type="text" class="form-control bg-gray-footer-parodi" name="familiar_nombre" id="familiar_nombre" aria-describedby="helpId" placeholder="">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                  </div>
                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                                    <d class="d-flex">
                                        <select class="flex-shrink-1 form-control bg-gray-footer-parodi" name="familiar_nacionalidad" id="familiar_nacionalidad" style="width: fit-content;">
                                            <option title="Venezolano" value="V">V</option>
                                            <option title="Extrangero" value="E">E</option>
                                            <option title="Pasaporte" value="P">P</option>
                                        </select>
                                        <input type="number" max="9" class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi" name="familiar_cedula" id="familiar_cedula" aria-describedby="helpId" placeholder="">
                                    </d>
                                    <small id="sms_cedula" class="form-text text-danger notification"></small>
                                  </div>


                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="familiar_genero">Género</label>
                                    <select class="form-control bg-gray-footer-parodi" name="familiar_genero" id="familiar_genero" aria-describedby="helpId" placeholder="">
                                      <option value="">Seleccione</option>
                                      <option value="m">Masculino</option>
                                      <option value="f">Femenino</option>
                                  </select>
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="familiar_apellido">Apellidos</label>
                                    <input type="text" class="form-control bg-gray-footer-parodi" name="familiar_apellido" id="familiar_apellido" aria-describedby="helpId" placeholder="">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                  </div>
                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="cat_user_family_id">Vínculo</label>
                                    <select class="form-control bg-gray-footer-parodi" name="cat_user_family_id" id="cat_user_family_id" aria-describedby="helpId" placeholder="">
                                  <option value="">Seleccione</option>
                                      <option value="1">Abuelo(a)</option>
                                      <option value="2">Amigo(a)</option>
                                      <option value="3">Esposo(a)</option>
                                      <option value="4">Hermano(a)</option>
                                      <option value="5">Hijo(a)</option>
                                      <option value="6">Madre</option>
                                      <option value="7">Padre</option>
                                      <option value="8">Pareja</option>
                                      <option value="9">Sobrino(a)</option>
                                  </select>
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                  </div>
                                  <div class="form-group">
                                    <label class="label-text text-secondary" for="familiar_telefono_movil">Teléfono contacto</label>
                                    <input type="number" class="form-control bg-gray-footer-parodi" name="familiar_telefono_movil" id="familiar_telefono_movil" aria-describedby="helpId" placeholder="">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card border-0 mb-0">
                        <div class="card-header p-0 bg-transparent" id="headingTwo">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <h3 class="mb-0">Datos administrativos</h3>
                          </button>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="collapseThree"
                          data-parent="#accordionExample">
                          <div class="card-body">
                           Módulo proximamente disponible.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>


              </div>
            </div>
          </div>
          <footer class="d-flex justify-content-center">
            <button id="store" class="btn d-none btn-success m-1">Guardar</button>
            <button id="cancel" data-dismiss="modal" aria-label="Close" class="btn btn-primary m-1">Regresar</button>
          </footer>
        </div>


      </template>

    <template id="cintilloModal">

        <nav class="navbar d-flex d-lg-none">
          <button
            class="btn btn-default"
            type="button"
            data-toggle="collapse"
            data-target="#collapseExample1"
            aria-expanded="false"
            aria-controls="collapseExample1">
              <i class="fas fa-ellipsis-v text-primary"></i>
          </button>
          <ul class="nav nav-tabs mt-1" id="myTabCintilloModal" role="tablist">
            <li class="nav-item d-none d-sm-block" role="presentation">
              <a data-item_id="0" class="nav-link" id="group_1-tab" data-toggle="tab" href="#" role="tab"
                aria-controls="group_1" aria-selected="true">
                <i class="fas fa-ellipsis-h"></i>
              </a>
            </li>
            <li class="nav-item d-sm-none" role="presentation">
              <a data-item_id="1" class="nav-link active" id="paciente-tab" data-toggle="tab" href="#paciente" role="tab"
                aria-controls="paciente" aria-selected="true"><i
                              class="fas fa-user-injured"></i> PA</a>
            </li>
            <li class="nav-item d-sm-none" role="presentation">
              <a data-item_id="2" class="nav-link" id="impresion_diagnostica-tab" data-toggle="tab"
                href="#impresion_diagnostica" role="tab" aria-controls="impresion_diagnostica" aria-selected="false"><i
                              class="fas fa-notes-medical"></i> ID</a>
            </li>
            <li class="nav-item" role="presentation">
              <a data-item_id="3" class="nav-link" id="equipo_medico-tab" data-toggle="tab" href="#equipo_medico" role="tab"
                aria-controls="equipo_medico" aria-selected="false"><i
                              class="fas fa-user-md"></i> EM</a>
            </li>
          </ul>
        </nav>
        <div class="d-flex">
          <div class="flex-shrink-1">
            <button
              title="Mostrar/Ocultar Panel superior"
              class="btn_switch_cintillo mt-1 d-none d-lg-block btn btn-default"
              type="button"
              aria-expanded="false"
              aria-controls="collapseExample1"
            >
              <i class="fas fa-ellipsis-v text-primary"></i>
            </button>
          </div>
          <div class="col">
            <div class="collapse bg-transparent mt-1 show" id="collapseExample1">
              <div class="card bg-transparent card-body border-0 p-0">
                <div class="tab-content d-block d-sm-flex d-sm-row" id="myTabContentCintilloModal">
                  <div class="tab-pane col col-sm col-md col-lg-5 col-xl fade shadow-sm rounded" id="paciente"
                    role="tabpanel" aria-labelledby="paciente-tab">
                    <div class="card-body d-flex flex-column p-1">
                      <h5 class="card-title text-primary mb-0">Paciente</h5>
                      <div class="d-flex flex-column flex-sm-row">
                        <!-- columna 1 -->
                        <div class="d-flex flex-column border-right">
                          <!-- fila 1 -->
                          <div class="flex-fill p-1 border-bottom">
                            <div class="d-flex align-items-center">
                              <img
                                    loading="lazy"
                                    onerror="this.src='/image/system/patient.svg'"
                                    style="width:50px;height:50px"
                                    class="imagen-paciente rounded rounded-circle d-block mb-1"
                                    src="/image/system/patient.svg"
                                    alt="Patient Photo">
                              <div class="nombre-paciente flex-grow-1 pl-1 text-primary pb-0" style="font-size:1.5rem">
                                _NOMBRE_ PACIENTE_ _NOMBRE_ PACIENTE_
                              </div>
                            </div>
                          </div>
                          <!-- fila 2 -->
                          <div class="flex-fill d-flex p-1 ">
                            <div class="flex-fill d-flex flex-column border-right">
                              <small class="card-title text-primary text-center mb-0">Cédula</small>
                              <div class="cedula-paciente T text-center">22014778</div>
                            </div>
                            <div class="flex-fill d-flex flex-column border-right">
                              <small class="card-title text-primary text-center mb-0">Edad</small>
                              <div class="edad-paciente T text-center">38</div>
                            </div>
                            <div class="flex-fill d-flex flex-column ">
                              <small class="card-title text-primary text-center mb-0">Sexo</small>
                              <div class="sexo-paciente T text-center">M</div>
                            </div>
                            <div class="flex-fill d-flex d-sm-none border-left flex-column">
                              <small class="card-title text-primary text-center mb-0">Ingreso</small>
                              <input type="date" class="fecha-ingreso-paciente text-center bg-transparent border-0 form-control-sm form-control">
                            </div>
                          </div>
                        </div>
                        <!-- columna 2 -->
                        <ul class="list-group flex-row flex-sm-column text-center">
                          <li class="d-none d-sm-block list-group-item bg-transparent flex-fill border-0 p-1">
                            <small class="card-title text-primary text-center mb-0">Ingreso</small>
                            <input type="date" class="fecha-ingreso-paciente form-control-sm form-control">
                          </li>
                          <li id="modal-btn-menu-reubicacion" class="list-group-item bg-transparent flex-fill border-0 p-1">
                            <small class="card-title text-primary text-center mb-0">
                                  Ubicación actual
                                  <span class="dias-hospitalizacion-paciente badge badge-info text-white">0</span>
                                </small>
                            <button class="ubicacion-actual-paciente btn btn-default btn-block border p-1 text-wrap">0000 asd asd  sadsad</button>
                          </li>
                          <li class="list-group-item bg-transparent d-flex flex-column flex-fill border-0 p-1">
                            <small class="card-title text-primary mb-1 text-center mb-0">Teléfono</small>
                            <a href="#" target="_blank"
                              class="telefono-paciente-link btn btn-default btn-block border p-1 text-nowrap">
                              <i class="fab fa-whatsapp text-success"></i>
                              <span class="telefono-paciente-content overflow-hidden">+584149320905</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane col col-sm col-md col-lg-3 col-xl fade shadow-sm rounded" id="impresion_diagnostica"
                    role="tabpanel" aria-labelledby="impresion_diagnostica-tab">
                    <div class="card-body d-flex flex-column p-1">
                      <h5 class="card-title text-primary mb-0">
                        Probabilidad diagnóstica
                        <span class="total-imp-diagn-paciente badge badge-info text-white">0</span>
                      </h5>
                      <div id="content-impresion-diagnostica" class="content-impresion-diagnostica list-group overflow-auto" style="max-height:200px">
                        <div class="list-group-item">
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus
                              varius blandit.</p>
                              <div class="d-flex w-100 justify-content-between">
                              <h6 class="mb-1 border-right  pr-1 mr-1 text-secondary">Dra. Hernández Cabaña Johana Carolina</h6>
                              <small>Junio 11, 2023 | 04:32 PM</small>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane col col-lg-4 col-xl-3  fade shadow-sm rounded overflow-auto" id="equipo_medico" role="tabpanel"
                    aria-labelledby="equipo_medico-tab">
                    <div class="card-body d-flex flex-column p-1">
                      <h5 class="card-title text-primary mb-0">Equipo Médico
                      </h5>
                      <div id="doctorsList" class="list-group list-group-flush overflow-auto"
                        style="height: 190px;min-width:300px">
                        <ul class="list-group list-group-flush ">

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="collapse mt-1" id="collapseExample2">

                <div class="d-flex">
                  <div class="col card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Paciente</small>
                    <div class="nombre-paciente text-nowrap overflow-auto">
                      _NOMBRE_PACIENTE_
                    </div>
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Imp. Diag. <span class="total-imp-diagn-paciente badge badge-info text-white">0</span></small>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle"
                                  data-toggle="dropdown" data-display="static"
                                  aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-notes-medical text-primary"></i>
                              </button>
                      <div class="dropdown-menu dropdown-menu-lg-right">
                        <ul class="list-group  list-group-flush content-impresion-diagnostica overflow-auto p-2"
                          style="max-height:50vh;min-width:20vw">

                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Cédula</small>
                    <div class="cedula-paciente text-nowrap overflow-hidden">
                      _CEDULA_PACIENTE_
                    </div>
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Edad</small>
                    <div class="edad-paciente text-center">
                      _EDAD_PACIENTE_
                    </div>
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Sexo</small>
                    <div class="sexo-paciente text-center">
                      _SEXO_PACIENTE_
                    </div>
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Ingreso</small>
                    <input type="date" class="fecha-ingreso-paciente form-control-sm form-control"
                              >
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary overflow-hidden">Ubicación Actual</small>
                    <button
                              class="ubicacion-actual-paciente btn bg-white btn-default btn-block border p-1 text-nowrap">_UBICACION_PACIENTE_</button>
                  </div>
                  <div class="flex-shrink-1 card shadow-sm bg-transparent mr-1 p-1">
                    <small class="text-primary">Teléfono</small>
                    <a href="#" target="_blank"
                      class="telefono-paciente-link btn bg-white btn-default btn-block border p-1 text-nowrap">
                      <i class="fab fa-whatsapp text-success"></i>
                      <span class="telefono-paciente-content">_TELEFONO_PACIENTE_</span>
                    </a>
                  </div>
                  <!---->
                  <div class="d-none flex-shrink-1 card shadow-sm bg-transparent p-1">
                    <small class="text-primary">Equipo Médico</small>
                    <div class="d-flex">
                      <div id="doctorsListMini" class="mr-1 list-group list-group-flush">
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                      data-toggle="dropdown" data-display="static"
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-bars text-primary"></i>
                                  </button>
                        <div id="doctorsListMiniMenu" class="dropdown-menu dropdown-menu-lg-right">

                        </div>
                      </div>
                    </div>


                  </div>
                </div>

            </div>
          </div>
        </div>
    </template>

@endsection
@section('footer')
@endsection
@section('script')
    <script>
        let d = document
        let useState ={}
        let loadingScreen = document.getElementById('loadingScreen')
        let setTimeOut = 200
        let setTimeOutIncrement = 200
        let initSignosVitalesTooltip = true
        let modalHeightClass= "template_historia_medica-mini"
        let activeArea = "tp"
        let activeLayout = "tablapacientesDiagnosticos"
        let lsActiveLayout = localStorage.getItem("activeLayout")
        let nombreIdModal = "doctorsListModal"
        let modal = document.getElementById(nombreIdModal)
        let modalJQ = $("#"+nombreIdModal)

            //console.log(lsActiveLayout);
            if (is_null(lsActiveLayout)) {
                localStorage.setItem("activeLayout",activeLayout)
            }
        let lsactiveArea = localStorage.getItem("activeArea")
            if (is_null(lsactiveArea) || is_undefined(lsactiveArea)) {
                localStorage.setItem("activeArea",activeArea)
            }
            class MenuIngresoPaciente{
                constructor(){
                    this.template = document.getElementById("template_paciente_nuevo_buscar").content.cloneNode("true")

                    //boxContentModal
                    this.modalId = 'modal-patient-item-1'
                    this.$modal = document.getElementById(this.modalId)

                    this.boxContentModal = document.getElementById("boxContentModal")
                    this.modalTableSearch = ""
                    this.inputSearch = ""
                    this.searchResult = []
                    this.btn_store = ""
                    this.rowEpisodiosHtml =""
                    this.rowE = ""
                    this.rowHtml = ""
                    this.$filtrar_por = ""


                }
                renderRowEpisodiosPaciente(r,key2){
                    return `
                    <tr>
                        <th style="width:50px;" scope="row">
                        ${key2+1}
                        </th>
                        <td>
                        ${!is_null(r['episodio_sap']) ? r['episodio_sap']:''}
                        </td>
                        <td>
                        ${fechaCorta(r['ingreso'])}
                        </td>
                        <td>
                        ${fechaCorta(r['egreso'])}
                        </td>
                        <td>
                            ${!is_null(r['dia_hos']) ? r['dia_hos']:''}
                        </td>
                        <td>
                            ${!is_null(r['area']) ? r['area']:''}
                        </td>
                        <td>
                        ${r['total_informes']}
                        </td>
                    </tr>
                    `
                }
                renderTableRowEpisodiosPaciente(key){
                    return `
                    <tr class="collapse" id="collapse${key}">
                        <td colspan="6">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Episodio SAP</th>
                                    <th scope="col">Ingreso</th>
                                    <th scope="col">Egreso</th>
                                    <th scope="col">Días</th>
                                    <th scope="col">Área</th>
                                    <th scope="col">Informes</th>
                                </tr>
                                </thead>
                                <tbody>
                                ${this.rowE}
                                </tbody>
                            </table>

                        </td>
                    </tr>
                    `

                }
                renderSearchRowPaciente(row,key){
                    let total_episodios = Object.values(row['episodios']).length

                    return `
                    <tr
                        ${row['episodios'].length >0 ? 'data-tippy-content="Pulsa para ver episodios anteriores"':''}
                        data-toggle="collapse"
                        data-target="#collapse${key}"
                        aria-expanded="false"
                        aria-controls="collapse${key}"
                        class="tooltip-primary ${row['episodios'].length >0 ? 'cursor-pointer':''}"
                    >
                        <th class="text-primary" style="width:50px;" scope="row">${key +1}</th>
                        <td valign="middle" class="h5 text-dark text-nowrap p-0 mb-0">
                            ${row['paciente']}
                        </td>
                        <td class="text-center">
                            ${row['cedulaF']}
                        </td>
                        <td class="text-center">
                            ${(total_episodios > 0)?"<span class='badge badge-primary'>"+total_episodios+"</span>": total_episodios}
                        </td>
                        <td class="text-center">
                            ${fechaCorta(row['registrada_desde'])}
                        </td>
                        <td style="width:100px;">
                            <button
                                data-user_id="${row['user_id']}"
                                class="${ !is_null(row['episodio_id_activo']) ? 'd-none':'' } btn-paciente-reingreso btn btn-success btn-block">
                                Reingresar
                            </button>
                            <button
                                data-episodio_id="${row['episodio_id_activo']}"
                                data-user_id="${row['user_id']}"
                                class="${ is_null(row['episodio_id_activo']) ? 'd-none':'' } btn-ubicar-paciente-activo btn btn-info btn-block">
                                Ubicar
                            </button>
                        </td>
                    </tr>
                    ${this.rowEpisodiosHtml}
                    `
                }
                renderEmptySearch(){
                    return `
                    <tr>
                        <td class="text-center text-primary" colspan="6">
                        Sin resultados<br>
                        <button class="btn-modal-empty-nuevo-paciente btn btn-primary mt-3">
                            Nuevo Paciente
                        </button>
                        </td>
                    </tr>
                    `
                }
                async getPacientes(){
                    return await get(location.origin + `/user/paciente/searchBy/all/${this.inputSearch.value.replace(" ","|")}`)
                }
                async searchPaciente(){
                    let that = this
                    if(this.inputSearch.value !== ""){

                        loadingScreen.classList.remove("d-none")

                        this.searchResult = await that.getPacientes()

                        if(this.searchResult.length >0){
                            this.modalTableSearch.innerHTML= null
                            this.searchResult.forEach((row,key)=>{
                            //console.log(row)
                            that.rowEpisodiosHtml = ""
                            if(row['episodios'].length >0){
                                that.rowE = ""
                                row['episodios'].forEach((r,key2)=>{
                                that.rowE += that.renderRowEpisodiosPaciente(r,key2)
                                })
                                that.rowEpisodiosHtml = that.renderTableRowEpisodiosPaciente(key)
                            }
                            that.rowHtml = that.renderSearchRowPaciente(row,key)
                            that.modalTableSearch.insertAdjacentHTML("beforeend",that.rowHtml)
                            })
                        }else{
                            loadingScreen.classList.add("d-none")
                            that.modalTableSearch.innerHTML= this.renderEmptySearch()
                            //console.log(that.boxContentModal)
                            if(!is_null(that.boxContentModal)){
                                that.boxContentModal.addEventListener("click",(e)=>{
                                    if(e.target.matches(".btn-modal-empty-nuevo-paciente")){
                                        that.inputSearch.value=""
                                        $("a[href='#pills-nuevo-paciente']").tab('show')
                                        that.btn_store.classList.remove("d-none")


                                    }
                                })
                            }

                        }
                        loadingScreen.classList.add("d-none")
                    /*  setTimeout(()=>{

                        },1000) */
                    }
                }
                handleReingreso(e){
                    let menu = /*html*/ `
                        <div id="form" class="row">

                            <div class="col-12 mt-1">
                                <div class="text-gray text-center">
                                    Escribe número de episodio SAP
                                </div>
                                <input id="cat_user_ubicacion_id" type="number" name="episodio_sap" class="form-control  bg-gray-footer-parodi">
                            </div>
                            <div class="col-12 mt-1">
                                <div class="text-gray text-center">
                                    Reubicar en:
                                </div>
                                <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control  bg-gray-footer-parodi"><option value="">Seleccione</option>
                                    <option value="387">
                                        Consulta Externa
                                    </option>

                                    <option value="245">
                                        SE
                                    </option>

                                    <option value="2">
                                        EA
                                    </option>

                                    <option value="6">
                                        ECvd
                                    </option>

                                    <option value="28">
                                        EP
                                    </option>

                                    <option value="41">
                                        AQ
                                    </option>

                                    <option value="390">
                                        HCEP
                                    </option>

                                    <option value="42">
                                        HP2
                                    </option>

                                    <option value="70">
                                        HP3
                                    </option>

                                    <option value="98">
                                        HP4
                                    </option>

                                    <option value="126">
                                        HP5
                                    </option>

                                    <option value="154">
                                        HP6
                                    </option>

                                    <option value="182">
                                        UTIA
                                    </option>

                                    <option value="194">
                                        UTICvd
                                    </option>

                                    <option value="211">
                                        UTIP
                                    </option>

                                    <option value="223">
                                        PAD
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-1">
                                <select id="subUbicacion1" style="" name="subUbicacion1" class="form-control bg-gray-footer-parodi"><option value="">Seleccione</option>
                                    <option value="7">
                                        Triaje
                                    </option>

                                    <option value="10">
                                        Obs
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-1">
                                <select id="subUbicacion2" style="" name="subUbicacion2" class="form-control bg-gray-footer-parodi"><option value="">Seleccione</option>
                                            <option value="8">
                                        A
                                    </option>

                                    <option value="9">
                                        B
                                    </option>
                                </select>
                            </div>


                        </div>
                    `
                    //loadingScreen.classList.remove("d-none")
                    let $modal = document.querySelector("#messageModal")
                    $modal.querySelector(".modal-body").innerHTML = null
                    $modal.querySelector(".modal-body").innerHTML = menu
                    $("#messageModal").modal("show")


                }
                handleUbicacion(e){
                    activeLayout = localStorage.getItem("activeLayout")
                    activeArea = localStorage.getItem("activeArea")
                    loadingScreen.classList.remove("d-none")

                    let {episodio_id} = e.target.dataset

                    d.querySelector(`#${activeLayout} .row_pacientes`).innerHTML = null

                    let pacientes =  pacientes_datos.filter(paciente=>
                                        equalsInt(paciente['episodio_id'],episodio_id)
                                    )

                        if (pacientes.length > 0) {
                            pacientes.forEach(paciente => {
                                switch (activeLayout) {
                                    case 'tablapacientesDiagnosticos':table_rowDiagnostico(paciente); break;
                                    case 'tablapacientesSignosVitales':table_rowSignosVitales(paciente);break;
                                }
                            })
                            d.querySelectorAll('#App table').forEach(x=>{
                                if (x.id==activeLayout) {
                                    x.classList.remove("d-none")
                                }else{
                                    x.classList.add("d-none")
                                }
                            })
                            activarTippyTooltip()
                        }

                        $("#"+this.modalId).modal("hide")
                        loadingScreen.classList.add("d-none")
                }
                handle_ingresoPaciente(){
                    let that = this
                    let { $modal,template } = this
                    this.$modal.querySelector(`.modal-body`).innerHTML = null
                    this.$modal.querySelector(`.modal-body`).append( template )


                    this.btn_store = this.$modal.querySelector("#store")
                    this.modalTableSearch = this.$modal.querySelector("#modal_table_paciente_search tbody")
                    this.inputSearch = this.$modal.querySelector("#search_advanced_paciente")

                    this.$filtrar_por = document.querySelectorAll(`#pills-tab-paciente-options #buscar_por a`)
                    this.$filtrar_por.forEach(option=>{
                        option.addEventListener("click",(e)=>{
                            this.$filtrar_por.forEach(o=>o.classList.remove("active"))
                            e.target.classList.add("active")
                            //alert(e.target.textContent)
                        })
                    })
                    document.querySelector("#pills-nuevo-paciente-tab2").addEventListener("click",(e)=>{
                        $("#pills-nuevo-paciente-tab").tab('show')
                    })
                    this.inputSearch.addEventListener('keydown', function(event) {
                        if (event.keyCode === 13 || event.key === 'Enter') {
                            // Código a ejecutar cuando se presione Enter
                            //console.log('Enter presionado');
                            if (that.inputSearch.value !== "") {
                                $("a[href='#pills-buscador-paciente']").tab('show')
                                that.btn_store.classList.add("d-none")
                                that.searchPaciente()
                            }
                        }
                    });

                    this.$modal.addEventListener("click",(e)=>{
                        if(
                            e.target.classList.contains("btn-modal-search-paciente")
                        ){
                            $("a[href='#pills-buscador-paciente']").tab('show')
                            that.btn_store.classList.add("d-none")
                            that.searchPaciente()

                        }
                        if(
                            e.target.classList.contains("btn-modal-nuevo-paciente")
                        ){
                            that.btn_store.classList.remove("d-none")

                        }
                        if(e.target.matches(".btn-modal-empty-nuevo-paciente")){
                            that.inputSearch.value=""
                            $("a[href='#pills-nuevo-paciente']").tab('show')
                            that.btn_store.classList.remove("d-none")
                        }
                        if(e.target.matches(".btn-ubicar-paciente-activo")){
                            that.handleUbicacion(e)
                        }
                        if(e.target.matches(".btn-paciente-reingreso")){
                            that.handleReingreso(e)
                        }

                    })


                    $("#"+this.modalId).modal("show")
                    setTimeout(() => {
                        this.inputSearch.focus();
                    }, 1000);

                }
            }
            class MedicosPaciente {
                constructor({
                        attrSelectorId="doctorsList",
                        episode_id=null,
                        medic_teem_patient=[],//GUARDA LOS MEDICOS ASIGNADOS AL PACIENTE
                        medic_teem_to_show=[],//GUARDA LOS ID DE LOS GRUPOS DE MEDICOS A MOSTRAR EN LA TARJETA
                    }){
                        //console.log("MedicosPaciente episode_id",episode_id)
                    let that = this
                    this.episode_id = episode_id
                    //DATOS DE EPISODIO DEL PACIENTE
                    this.paciente = pacientes_datos.find(paciente=> equalsInt(paciente['episodio_id'],episode_id ) )
                    //INDICE EPISODIO EN EL OBJETO
                    this.episodio_index = pacientes_datos.findIndex(paciente=> equalsInt(paciente['episodio_id'],episode_id ) )
                    // MEDICOS QUE ATIENDEN AL PACIENTE
                    this.medic_teem_patient = this.paciente['medico_paciente']
                    //LISTA DE BOTONES DE MEDICOS A MOSTRAR
                    this.medic_teem_to_show = medic_teem_to_show
                    //ETIQUETA DONDE SE DESPLEGARÁ LA LISTA DE GRUPOS DE MEDICOS
                    this.selector = document.getElementById( attrSelectorId )
                    //CATALOGO DE CARGOS MEDICOS
                    this.cat_items = [
                        {
                            id:[1],
                            description:"Tratante",
                            selector_description :function(){
                                return that.getSelectorText( this.description )
                            },
                            color:'success',
                            className:['fa-solid','fa-user-doctor'],
                            sigla(){return this.description.slice(0,2).toUpperCase()},
                            medicos_paciente:[],
                        },
                        {
                            id:[2],
                            description:"Interconsultante",
                            selector_description :function(){
                                return that.getSelectorText( this.description )
                            },
                            color:'info',
                            className:['fa-solid','fa-user-doctor'],
                            sigla(){return this.description.slice(0,2).toUpperCase()},
                            medicos_paciente:[],
                        },
                        {
                            id:[3,4],
                            description:"Fellow",
                            selector_description :function(){
                                return that.getSelectorText( this.description )
                            },
                            color:'orange',
                            className:['fa-solid','fa-user-doctor'],
                            sigla(){return this.description.slice(0,2).toUpperCase()},
                            medicos_paciente:[],
                        },
                        {
                            id:[5,6,7,8],
                            description:"Residente",
                            selector_description :function(){
                                return that.getSelectorText( this.description )
                            },
                            color:'secondary',
                            className:['fa-solid','fa-user-doctor'],
                            sigla(){return this.description.slice(0,2).toUpperCase()},
                            medicos_paciente:[],
                        },
                        {
                            id:[9],
                            description:"RAMH",
                            selector_description :function(){
                                return that.getSelectorText( this.description )
                            },
                            color:'purple',
                            className:['fa-solid','fa-user-doctor'],
                            sigla(){return this.description.slice(0,2).toUpperCase()},
                            medicos_paciente:[],
                        },
                        {
                            id:[10],
                            description:"Enfermería",
                            selector_description :function(){
                                return that.getSelectorText( this.description )
                            },
                            color:'warning',
                            className:['fa-solid','fa-user-nurse'],
                            sigla(){return this.description.slice(0,2).toUpperCase()},
                            medicos_paciente:[],
                        },
                    ]


                }
                cat_medic_teem_to_show(){
                    let resultset = []
                    let medic_teem = []
                        if(this.medic_teem_to_show.length === 0){
                            this.medic_teem_to_show = [1,2,3,7,9,10]
                        }
                        this.medic_teem_to_show.forEach(id=>{
                            let result = this.cat_items.find(x=> x['id'].includes(id) )
                                if( !is_undefined( result ) ){
                                    resultset.push(result)
                                }
                        })

                    return resultset
                }
                getSelectorText(description){
                    return description.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase()
                }
                modalColor({ color=null, group_cargo=null, medicos_disponibles=[],title=null }){
                    //console.log(color)
                        //ELIMINAR TODOS LOS COLORES DE LA MODAL
                    let colores = this.cat_items.map(x=> x.color)
                        //console.log("colores",colores)
                        colores.forEach(color=>{
                            modal.querySelector(".modal-header").classList.remove('bg-'+color)
                            modal.querySelector("#total_result").classList.remove('text-'+color)

                            modal.querySelectorAll(".modal-footer button").forEach( (button,key)=>{
                                button.classList.remove('btn-'+color)
                                //button.classList.remove('border-'+x.color)
                            })

                        })
                        //ASIGNAR NUEVO COLOR A LA MODAL
                        modal.querySelectorAll(".modal-footer button")[1].classList.add('btn-'+color)
                        modal.querySelector(".modal-header").classList.add('bg-'+color)
                        modal.querySelector("#total_result").classList.add('text-'+color)

                        //TEXTOS PREDEFINIDOS EN LA MODAL
                        modal.querySelector(".modal-title").textContent = `Equipo ${group_cargo}`
                        modal.querySelector(".title_index").textContent = `Equipo ${group_cargo}:`
                        modal.querySelector(".title_create").textContent = `Añadir nuevo ${group_cargo}:`
                        modal.querySelector("#modal_search_medico").placeholder = `Escribe ${group_cargo} a buscar...`
                        modal.querySelector("#total_result").innerHTML= `Mostrando <b>${medicos_disponibles.length}</b> resultados`


                }
                handleOptionListModal({
                        color,
                        group_cargo,
                        position_id,
                        selector_cargo,
                        tippyContent,
                    }){
                    let that = this
                        d.querySelector("#modalLoading").classList.remove("d-none")
                        //console.log(event )
                        //ID DE LOS CARGOS
                    let posiciones_id = position_id.split(",").map(x=>Number(x))


                        //MEDICOS DISPONIBLES EN LOS CARGOS
                    let medicos_disponibles = medicos_datos.filter(med => posiciones_id.includes(Number(med.posicion_id)) )
                        //console.log(medicos_disponibles)
                        //OBTENER ESPECIALIDADES MEDICAS PARA AGRUPAR LOS MEDICOS
                    let especialidades_id = Array.from( new Set(medicos_disponibles.map(med => med.cat_user_especialidad_id)) )

                        //MEDICOS ASIGNADOS AL PACIENTE
                    let medicosAsignadosAlPaciente = this.medic_teem_patient.filter(x=> posiciones_id.includes(x.cat_user_medico_posicion_id) )
                        //console.log(medicosAsignadosAlPaciente)

                        //OBTENER ID DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS POR ESPECIALIDAD
                    let user_id_asignados = Array.from( new Set(medicosAsignadosAlPaciente.map(med => med.user_id_medico)) )
                        //console.log(user_id_asignados)

                        //OBTENER ESPECIALIDADES DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS
                    let medicos_disponibles_asignados = medicos_disponibles.filter(med => user_id_asignados.includes(Number(med.user_id)) )
                        //console.log(medicos_disponibles_asignados)

                        //OBTENER ESPECIALIDADES MEDICAS DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS
                    let especialidades_id_asignados = Array.from( new Set(medicos_disponibles_asignados.map(med => med.cat_user_especialidad_id)) )
                        //console.log(especialidades_id_asignados)

                    /*ASIGNADOS*/
                    let modalListadoMedicoAsignados =  modal.querySelector('#modal-listado_medicos_asignados')
                        modalListadoMedicoAsignados.innerHTML = null

                        if (especialidades_id_asignados.length > 0) {
                            //let grupoMedicosAsignadosAlPaciente = medicosAsignadosAlPaciente.filter(x=> posiciones_id.includes(x.user_cuest_medico_posicion_id) )
                                //console.log(grupoMedicosAsignadosAlPaciente)
                                especialidades_id_asignados.forEach(especialidad_id => {
                                    //POR CADA ESPECIALIDAD OBTENER LOS MEDICOS
                                    let medicos_disponibles_x_especialidad = medicos_disponibles_asignados.filter(med => Number(med.cat_user_especialidad_id) === Number(especialidad_id))
                                    //OBTENER NOMBRE DE LA ESPECIALIDAD
                                    let especialidad_nombre = medicos_disponibles_x_especialidad[0]

                                    //MOSTRAMOS LA ESPECIALIDAD QUE AGRUPARA LOS MEDICOS
                                    modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                                        <li class="list-group-item d-flex text-${color} font-weight-bold disabled list-group-item-action p-1">
                                            <div>${especialidad_nombre.especialidad}</div>
                                        </li>
                                    `)

                                    medicos_disponibles_x_especialidad.forEach(medico => {
                                        let activo= false
                                        let medicoActivoClass=""
                                        //console.log(medicosPaciente)
                                        let medicoActivo = medicosAsignadosAlPaciente.find(mp=> equalsInt( mp['user_id_medico'], medico['user_id'] ) )

                                        //RESALTAMOS EN EL LISTADO DE MEDICOS DISPONIBLES LOS MEDICOS YA ASIGNADOS
                                        if(!is_undefined(medicoActivo)){
                                            activo = true
                                            medicoActivoClass =`bg-${color} text-white`
                                        }
                                        //MOSTRAMOS EL MEDICO DISPONIBLE
                                        modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                                            <li
                                                data-position_id="${medico.posicion_id}"
                                                data-selector_cargo="${selector_cargo}"
                                                data-tippyContent="${tippyContent}"
                                                data-paciente_name ="${that.paciente['paciente']}"
                                                data-medico_name ="${medico['medico']}"
                                                data-group_cargo="${group_cargo}"
                                                data-activo="${activo}"
                                                data-user_id_medico="${medico.user_id}"
                                                data-color="${color}"

                                                class="${medicoActivoClass} list-group-item d-flex align-items-center cursor-pointer list-group-item-action p-1">
                                                    <img loading="lazy" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="${medico.imagen}">
                                                <div class="pl-1">
                                                    ${medico.medico}
                                                </div>
                                            </li>
                                        `)
                                    })
                                })
                        } else {
                            modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                                <li class="text-center text-${color} list-group-item list-group-item-action p-1">
                                    No se encontraron ${group_cargo} asignados
                                </li>
                            `)
                        }
                    /*DISPONIBLES*/
                    let modalListadoMedicoDisponibles =  modal.querySelector('#modal-listado_medicos')
                        modalListadoMedicoDisponibles.innerHTML = null
                        if (especialidades_id.length > 0) {

                            especialidades_id.forEach(especialidad_id => {
                                //POR CADA ESPECIALIDAD OBTENER LOS MEDICOS
                                let medicos_disponibles_x_especialidad = medicos_disponibles.filter(med => Number(med.cat_user_especialidad_id) === Number(especialidad_id))
                                //OBTENER NOMBRE DE LA ESPECIALIDAD
                                let especialidad_nombre = medicos_disponibles_x_especialidad[0]

                                //MOSTRAMOS LA ESPECIALIDAD QUE AGRUPARA LOS MEDICOS
                                modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                    <li class="list-group-item d-flex text-${color} font-weight-bold disabled list-group-item-action p-1">
                                        <div>${especialidad_nombre.especialidad}</div>
                                    </li>
                                `)

                                medicos_disponibles_x_especialidad.forEach(medico => {
                                    let activo= false
                                    let medicoActivoClass=""
                                    //console.log(medicosPaciente)
                                    let medicoActivo = medicosAsignadosAlPaciente.find(mp=> equalsInt( mp['user_id_medico'], medico['user_id'] ) )

                                    //RESALTAMOS EN EL LISTADO DE MEDICOS DISPONIBLES LOS MEDICOS YA ASIGNADOS
                                    if(is_undefined(medicoActivo)){
                                        //activo = true
                                        //medicoActivoClass =`bg-${color} text-white`

                                        //MOSTRAMOS EL MEDICO DISPONIBLE
                                        modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                            <li
                                                data-position_id="${medico.posicion_id}"
                                                data-selector_cargo="${selector_cargo}"
                                                data-tippyContent="${tippyContent}"
                                                data-paciente_name ="${that.paciente['paciente']}"
                                                data-medico_name ="${medico['medico']}"
                                                data-group_cargo="${group_cargo}"
                                                data-activo="${activo}"
                                                data-user_id_medico="${medico.user_id}"
                                                data-color="${color}"

                                                class="${medicoActivoClass} list-group-item d-flex align-items-center cursor-pointer list-group-item-action p-1">
                                                    <img loading="lazy" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="${medico.imagen}">
                                                <div class="pl-1">
                                                    ${medico.medico}
                                                </div>
                                            </li>
                                        `)
                                    }
                                })

                            })
                            //EVENTO CLICK A CADA MEDICO DISPONIBLE
                            modalListadoMedicoDisponibles.querySelectorAll("li").forEach(handleMedicoDisponible=>{
                                handleMedicoDisponible.addEventListener("click",(e)=>{
                                    that.handleMedicoDisponible(e)
                                })
                            })
                            //EVENTO CLICK A CADA MEDICO ASIGNADO
                            modalListadoMedicoAsignados.querySelectorAll("li").forEach(handleMedicoAsignados=>{
                                handleMedicoAsignados.addEventListener("click",(e)=>{
                                    that.handleMedicoDisponible(e)
                                })
                            })
                            //
                            setTimeout(()=>{
                                that.filtroModalMedicos()
                                modal.querySelector("#modal_search_medico").focus()
                            },500)
                        } else {
                            modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                <li class="text-center text-${color} list-group-item list-group-item-action p-1">
                                    No se encontraron ${group_cargo}
                                </li>
                            `)
                        }

                        //COLORES DE LA MODAL
                        this.modalColor({
                            color,
                            group_cargo,
                            medicos_disponibles,
                            title:tippyContent,
                        })



                        //EVENTOS

                        //MOSTRAR MODAL
                        modalJQ.modal("show")
                        d.querySelector("#modalLoading").classList.add("d-none")
                }
                filtroModalMedicos(){
                    let busqueda = modal.querySelector('#modal_search_medico');
                    let table =  modal.querySelectorAll("#modal-listado_medicos li");
                    let buscaTabla = function () {
                        let texto = busqueda.value.toLowerCase();
                        let dFlexCount = 0;
                        let dNoneCount = 0;
                        setTimeout(() => {
                            if(table.length > 0){
                                table.forEach( (row,r)=>{
                                    //console.log(row)
                                    if (row.querySelector("div").innerText.toLowerCase().indexOf(texto) !== -1){
                                        row.classList.replace('d-none','d-flex');
                                    }else{
                                        //console.log(row)
                                        row.classList.replace('d-flex','d-none');
                                    }
                                    if (row.classList.contains('d-flex')){
                                        dFlexCount++;
                                    }else if (row.classList.contains('d-none')){
                                        dNoneCount++;
                                    }
                                })
                                modal.querySelector('#total_result').innerHTML = `Mostrando <b>${dFlexCount.toString()}</b> resultados`

                            }

                        }, 100);
                    }
                    busqueda.addEventListener('change', buscaTabla);
                    busqueda.addEventListener('input', function(event) {
                        // Se está escribiendo o borrando texto en el input
                        if (event.target.value === '') {
                            buscaTabla()
                            /* console.log('Se borró todo el texto del input'); */
                        }
                    });
                }
                async destroy(medico_paciente_id){
                    ///user_cuest_medico_paciente/eliminarById
                    let formdata = new FormData();
                        formdata.append("id", medico_paciente_id )
                        formdata.append("_token", $("#_token").val())
                        formdata.append("created_at", timestamps())
                        return await post( location.origin+"/user_cuest_medico_paciente/eliminarById", formdata)
                }
                async store(user_id_medico,position_id){

                 let formdata = new FormData();
                        formdata.append("episodio_id", this.paciente['episodio_id'] )
                        formdata.append("user_id_medico", user_id_medico )
                        formdata.append("user_id_paciente", this.paciente['user_id'] )
                        formdata.append("position_id", position_id)
                        formdata.append("_token", $("#_token").val())
                        formdata.append("created_at", timestamps())
                        return await post( location.origin+"/user_cuest_medico_paciente/store", formdata)
                }
                handleMedicoDisponible(event){
                    let that = this
                    let {
                            position_id,
                            selector_cargo,
                            tippyContent,
                            paciente_name,
                            medico_name,
                            group_cargo,
                            activo,
                            user_id_medico,
                            color,
                            episodio_id
                        } = event.currentTarget.dataset
                        //VALIDAMOS QUE EL MEDICO NO ESTE ASIGNADO
                        let medicosAsignadosAlPaciente = that.medic_teem_patient
                        let medicoEstaAsignado = medicosAsignadosAlPaciente.find(med => Number(med.user_id_medico) === Number(user_id_medico))
                            //console.log(medicosAsignadosAlPaciente)
                            //console.log(medicoEstaAsignado)
                            if(is_undefined(medicoEstaAsignado)){
                                Swal.fire({
                                    title: `¿Asignar ${group_cargo}?`,
                                    text:`¿Quieres asignar el ${group_cargo} ${medico_name} al paciente ${paciente_name}?`,
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, asignar!',
                                    cancelButtonText: 'No, aún no!'
                                }).then( async(result) => {
                                    if (result.isConfirmed) {
                                        //GUARDAMOS LA ASIGNACION
                                        d.querySelector("#modalLoading").classList.remove("d-none")
                                        let model = await that.store( user_id_medico, position_id )
                                        d.querySelector("#modalLoading").classList.add("d-none")
                                            this.medic_teem_patient = model
                                            pacientes_datos[ that.episodio_index ]['medico_paciente']  = model
                                            that.deployMedicoPacienteList()

                                            that.handleOptionListModal({
                                                color,
                                                group_cargo,
                                                position_id,
                                                selector_cargo,
                                                tippyContent,
                                            })
                                            Swal.fire(
                                                `${group_cargo} asignado!`,
                                                `El ${group_cargo} se asignó correctamente.`,
                                                'success'
                                            )
                                    }
                                })
                            }else{
                                Swal.fire({
                                    title: `¿Retirar ${group_cargo}?`,
                                    text:`¿Quieres retirar el ${group_cargo} ${medico_name} del paciente ${paciente_name}?`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, retirar!',
                                    cancelButtonText: 'No, aún no!'
                                }).then( async (result) => {
                                    if (result.isConfirmed) {
                                        d.querySelector("#modalLoading").classList.remove("d-none")

                                        let medico_paciente_id = this.medic_teem_patient.find( (mp,key)=> Number(mp.cat_user_medico_posicion_id) === Number(position_id) && Number(mp.user_id_medico) === Number(user_id_medico) )['medico_paciente_id']
                                        //console.log(medico_paciente_id)
                                        let model = await that.destroy( medico_paciente_id )
                                        d.querySelector("#modalLoading").classList.add("d-none")
                                        //console.log("user_id_medico",user_id_medico)
                                        //console.log(pacientes_datos[ that.episodio_index ]['medico_paciente'])
                                        this.medic_teem_patient = this.medic_teem_patient.filter( (mp,key)=> Number(mp.user_id_medico) !== Number(user_id_medico) )
                                        pacientes_datos[ that.episodio_index ]['medico_paciente'] = pacientes_datos[ that.episodio_index ]['medico_paciente'].filter( (mp,key)=> Number(mp.user_id_medico) !== Number(user_id_medico) )
                                        //console.log(pacientes_datos[ that.episodio_index ]['medico_paciente'])
                                        that.deployMedicoPacienteList()
                                        that.handleOptionListModal({
                                            color,
                                            group_cargo,
                                            position_id,
                                            selector_cargo,
                                            tippyContent,
                                        })
                                        Swal.fire(
                                            `${group_cargo} retirado!`,
                                            `El ${group_cargo} se retiró correctamente.`,
                                            'success'
                                        )
                                    }
                                })
                            }

                }
                renderListOption({
                        medicoAsignado = false,
                        position_id=null,
                        color="default",
                        selector_cargo=null,
                        group_cargo=null,
                        group_cargo_siglas ="",
                        imgError ="/image/system/patient.svg",
                        imgDoctor =null,
                        nameDoctor = "",
                    }){
                    return /*html*/ `
                        <li
                            data-episodio_id="${this.paciente['episodio_id']}"
                            data-position_id="${position_id}"
                            data-color="${color}"
                            data-selector_cargo="${selector_cargo}"
                            data-group_cargo="${group_cargo}"
                            data-tippy-content="Equipo ${group_cargo}"
                            class="tooltip-${color} list-group-item cursor-pointer list-group-item-action p-0"
                        >
                            <div class="d-flex flex-column">
                                <!-- Tarjeta activa -->
                                <div class="card-medic-team-active d-${medicoAsignado ? 'flex':'none'} align-items-center py-1">
                                    <img loading="lazy" class="img-doctor mx-1" onerror="this.src='${imgError}'"  src="${imgDoctor}">
                                    <div class="d-flex flex-column">
                                        <div class="card-medic-team-title text-${color}">
                                            ${group_cargo}
                                        </div>
                                        <b>
                                            ${nameDoctor}
                                        </b>
                                    </div>
                                </div>
                                <!-- Tarjeta inactiva -->
                                <div class="card-medic-team-inactive d-${!medicoAsignado ? 'flex':'none'}  align-items-center">
                                    <div class="badge badge-${color} mx-2 medico-badge-width">${group_cargo_siglas}</div>
                                    <div class="overflow-hidden text-nowrap ">${group_cargo}</div>
                                </div>
                            </div>
                        </li>
                    `
                }
                renderMedicoPacienteList(){

                    this.selector.innerHTML = null
                    this.selector.innerHTML= `
                        <ul class="list-group list-group-flush">

                        </ul>
                    `

                }
                getMedicosAsignados(item){
                    return this.medic_teem_patient.filter(medic=> item['id'].includes( medic['cat_user_medico_posicion_id'] ) )
                }
                deployMedicoPacienteList(){
                    let that = this
                    this.renderMedicoPacienteList()

                    this.cat_medic_teem_to_show().forEach( (item,key)=>{
                        //BUSCAR MEDICOS ASIGNADOS
                        let medicosAsignados = this.getMedicosAsignados(item)
                        //OBTENER ULTIMO MEDICO ASIGNADO
                        let object = {
                                position_id: item['id'].join(),
                                color:item['color'],
                                selector_cargo:item['selector_description'](),
                                group_cargo:item['description'],
                                group_cargo_siglas :item['sigla'](),
                            }
                        let ultimoMedicoAsignado = medicosAsignados.reduce((max, obj) => (obj.medico_paciente_id > max.medico_paciente_id ? obj : max), medicosAsignados[0]);
                            if( !is_undefined( ultimoMedicoAsignado ) ){
                                object = {
                                    medicoAsignado : true,
                                    position_id: item['id'].join(),
                                    color:item['color'],
                                    selector_cargo:item['selector_description'](),
                                    group_cargo:item['description'],
                                    group_cargo_siglas :item['sigla'](),
                                    nameDoctor : ultimoMedicoAsignado['medico'],
                                }
                            }
                            //console.log(ultimoMedicoAsignado)

                        let option = that.renderListOption( object )
                            that.selector.querySelector(`ul`).insertAdjacentHTML("beforeend",option)


                    })
                    //EVENTO CLICK PARA CADA OPCIÓN
                    this.selector.querySelectorAll("li").forEach(optionHTML=>{
                        optionHTML.addEventListener("click",(event)=>{
                            let {
                                    color,
                                    group_cargo,
                                    position_id,
                                    selector_cargo,
                                    tippyContent,
                                } = event.currentTarget.dataset

                                that.handleOptionListModal({
                                    color,
                                    group_cargo,
                                    position_id,
                                    selector_cargo,
                                    tippyContent,
                                })
                        })
                    })

                }
            }
          /*INICIO CONFIG CINTILLO MODAL******************** */
        let handleResizeCintilloModal = (e) => {


                let items = document.querySelectorAll(`#myTabContentCintilloModal div.tab-pane`)
                let screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                items.forEach(item => {
                    item.classList.add("d-none")
                    item.classList.remove("show", "active")
                })

                items.forEach((item, key) => {
                    //mostrar botones solo cuando cumpla con el ancho de pantalla
                    if (screenWidth < 576) {
                    item.classList.remove("d-none")
                    if (key === 0) {
                        item.classList.add("show", "active")
                    }
                    }
                    if (screenWidth >= 576 && screenWidth < 992) {
                    item.classList.remove("d-none")

                    if (key === 0 || key === 1) {
                        item.classList.add("show", "active")
                    }
                    }
                    if (screenWidth >= 992) {
                    item.classList.remove("d-none")
                    item.classList.add("show","active")

                    }
                })


            }
            window.addEventListener('resize', (e)=>{
                handleResizeCintilloModal()
            });


        let layoutOptions = ()=> {
            $("#messageModal").modal("show")

            d.querySelector(`#messageModal .modal-body`).innerHTML= /*html*/ `
                <div >
                    <div class="list-group">
                        <span class="text-primary font-weight-bold menu-pad-title"">
                            Ver pacientes por:
                        </span>
                        <a href="#" data-layout="tablapacientesDiagnosticos" class="handle_active_layout list-group-item list-group-item-action">
                            Resumen Clínico
                        </a>
                        <a href="#" data-layout="tablapacientesSignosVitales" class="handle_active_layout list-group-item list-group-item-action">
                            Sígnos Vitales
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                        <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                    </div>
                </div>
            `;
        }
        let filtroPacientesTabla =(tabla) => {


            var busqueda = document.getElementById('busquedapaciente');
            var table = document.getElementById(tabla).tBodies[0];

            buscaTabla = function () {
                loadingScreen.classList.remove("d-none")
                texto = busqueda.value.toLowerCase();
                var r = 0;
                setTimeout(() => {
                    while (row = table.rows[r++]) {
                        if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                            row.style.display = null;
                        else
                            row.style.display = 'none';
                    }
                    loadingScreen.classList.add("d-none")
                }, 200);

            }

            busqueda.addEventListener('change', buscaTabla);



        }
        let newsSignos = () => {

            let news = "";
            let vip = pacientes_datos.filter(x => equalsInt(x.vip, 1))
            let riesgo = pacientes_datos.filter(x => ["2", "3"].includes(x.alert))
            let riesgo_infeccion = pacientes_datos.filter(x => ["2", "3"].includes(x.cirugia))
            let riesgo_resbalar = pacientes_datos.filter(x => ["2", "3"].includes(x.resbalar))

            if (vip.length > 0) {
                vip.forEach((paciente, index) => {
                    news += `
                        <span ${!is_null(paciente['vip_description']) ? "data-tippy-content='"+paciente['vip_description']+"'":''}  class="${!is_null(paciente['vip_description']) ? "tooltip-info":''} marquee-search-paciente" data-user_id_paciente="${paciente['user_id']}" data-paciente="${paciente['paciente']}" >
                            <i title="VIP" class="pc-paciente_vip text-info"></i>
                            <span  data-user_id_paciente="${paciente['user_id']}" data-paciente="${paciente['paciente']}"  class='font-weight-bold marquee-search-paciente'>
                                ${paciente['nombres']} ${paciente['apellidos']} <span class="rounded-pill px-2" style="background-color: #e3e2e2;">${paciente['ubicacion_description']}</span>
                            </span>

                        </span>
                    `;
                    if (index < (vip.length - 1)) {
                        news += `
                            <span class="mx-4">-</span>
                        `;
                    }
                })
            }
            if (riesgo.length > 0) {
                if(!is_empty(news)){
                    news += `
                        <span class="mx-4">-</span>
                    `;
                }
                riesgo.forEach((paciente, index) => {
                    let alertColor = equalsInt(paciente.alert, 2) ? 'warning' : 'danger'
                    let alertIcono = equalsInt(paciente.alert, 2) ? 'intermedia' : 'alta'
                    news += `
                        <span ${!is_null(paciente['alert_description']) ? "data-tippy-content='"+paciente['alert_description']+"'":''}  class="${!is_null(paciente['alert_description']) ? "tooltip-"+alertColor:''} text-${paciente['user_id']}"  data-user_id_paciente="${paciente['user_id']}" data-paciente="${paciente['paciente']}">
                            <i class="pc-alerta_${alertIcono} text-${alertColor}"></i>
                            <span  data-user_id_paciente="${paciente['user_id']}" data-paciente="${paciente['paciente']}"  class='font-weight-bold marquee-search-paciente'>
                                ${paciente['nombres']} ${paciente['apellidos']} <span class="rounded-pill px-2" style="background-color: #e3e2e2;">${paciente['ubicacion_description']}</span>
                            </span>
                        </span>
                    `;
                    if (index < (riesgo.length - 1)) {
                        news += `
                        <span class="mx-4">-</span>
                        `;
                    }
                })
            }
            if (riesgo_infeccion.length > 0) {
                if(!is_empty(news)){
                    news += `
                        <span class="mx-4">-</span>
                    `;
                }
                riesgo_infeccion.forEach((paciente, index) => {
                   // console.log(paciente)
                    let cirugiaColor = equalsInt(paciente.cirugia, 2) ? 'warning' : 'danger'

                    news += `
                        <span ${!is_null(paciente['cirugia_description']) ? "data-tippy-content='"+paciente['cirugia_description']+"'":''}  class="${!is_null(paciente['cirugia_description']) ? "tooltip-"+cirugiaColor :''} text-${paciente['user_id']}" >
                            <i class="pc-cirugia text-${cirugiaColor}"></i>
                            <span  data-user_id_paciente="${paciente['user_id']}" data-paciente="${paciente['paciente']}"  class='font-weight-bold marquee-search-paciente'>
                                ${paciente['nombres']} ${paciente['apellidos']} <span class="rounded-pill px-2" style="background-color: #e3e2e2;">${paciente['ubicacion_description']}</span>
                            </span>
                        </span>
                    `;
                    if (index < (riesgo_infeccion.length - 1)) {
                        news += `
                            <span class="mx-4">-</span>
                        `;
                    }
                })
            }
            if (riesgo_resbalar.length > 0) {
                if(!is_empty(news)){
                    news += `
                        <span class="mx-4">-</span>
                    `;
                }
                riesgo_resbalar.forEach((paciente, index) => {
                    let resbalarColor = equalsInt(paciente.resbalar, 2) ? 'warning' : 'danger'

                    news += `
                        <span ${!is_null(paciente['resbalar_description']) ? "data-tippy-content='"+paciente['resbalar_description']+"'":''}  class="${!is_null(paciente['resbalar_description']) ? "tooltip-"+resbalarColor:''} text-${paciente['user_id']}" >
                            <i class="pc-resbalar text-${resbalarColor}"></i>
                            <span  data-user_id_paciente="${paciente['user_id']}" data-paciente="${paciente['paciente']}"  class='font-weight-bold marquee-search-paciente'>
                                ${paciente['nombres']} ${paciente['apellidos']} <span class="rounded-pill px-2" style="background-color: #e3e2e2;">${paciente['ubicacion_description']}</span>
                            </span>
                        </span>
                    `;
                    if (index < (riesgo_resbalar.length - 1)) {
                        news += `
                            <span class="mx-4">-</span>
                        `;
                    }
                })
            }

            d.querySelector("#priorizadosMarquee").innerHTML = news

        }
        let getGroupAreas = (nivel1)=>{
            let ubicaciones = useState['ubicaciones']
            //return [cat_user_ubicacion_id].map(area=>{
            let result = [];
            let nivel2 = ubicaciones.filter(sub=>sub.parent_cat_user_ubicacion_id === nivel1 ).map(sub=>sub.id )
                console.log("nivel2----->",nivel2)
                if(nivel2.length === 0){
                    result = [nivel1]
                }else{
                    let nivel3 = ubicaciones.filter(sub=> nivel2.includes(sub.parent_cat_user_ubicacion_id ) ).map(sub=>sub.id )
                        console.log("nivel3----->",nivel3)

                        if(nivel3.length === 0){
                            result = nivel2
                        }else{
                            result = nivel3
                        }
                }
                result = result.join()
                        .split(",")
                        .map(x=>Number(x))
                return result
            //})
        }
        let handleMenuPad = (cat_user_ubicacion_id,titleArea) => {
            activeLayout = localStorage.getItem("activeLayout")
            activeArea = localStorage.getItem("activeArea")

            loadingScreen.classList.remove("d-none")

            setTimeout((e) => {
                let ubicaciones = useState['ubicaciones']
                let groupAreas = getGroupAreas(Number(cat_user_ubicacion_id))
                    groupAreas.push(cat_user_ubicacion_id)
                    pacientes = pacientes_datos.filter(a => groupAreas.includes(a.cat_user_ubicacion_id) )
                    d.querySelector("#pad_badge").textContent = pacientes.length
                    d.querySelector(`#${activeLayout} .row_pacientes`).innerHTML = null
                    if (pacientes.length > 0) {
                        pacientes.forEach(paciente => {
                            switch (activeLayout) {
                                case 'tablapacientesDiagnosticos':table_rowDiagnostico(paciente); break;
                                case 'tablapacientesSignosVitales':table_rowSignosVitales(paciente);break;
                            }
                        })
                        d.querySelectorAll('#App table').forEach(x=>{
                            if (x.id==activeLayout) {
                                x.classList.remove("d-none")
                            }else{
                                x.classList.add("d-none")
                            }
                        })
                        activarTippyTooltip()
                    }

                    document.getElementById('titleArea').textContent = titleArea
                    loadingScreen.classList.add("d-none")
                    filtroPacientesTabla(activeLayout)
                    activarTooltip()
                    $("#messageModal").modal("hide")
            }, 200);
        }
        let handleMenuPrincipalOpciones = (e) => {
            activeLayout = localStorage.getItem("activeLayout")
            activeArea = localStorage.getItem("activeArea")

            loadingScreen.classList.remove("d-none")
            d.querySelectorAll("#cat_user_ubicacion_menu a.nav-link .badge")
                .forEach(badge => {
                    badge.classList.add("d-none")
                })
            miData = e.currentTarget;
            //console.log("miData",miData)
            setTimeout((e) => {
                miData.querySelector(".badge").classList.remove("d-none")
                let pacientes
                let dataset = miData.dataset


                let cat_user_ubicacion_id = Number(dataset['cat_user_ubicacion_id'])
                let ubicaciones = useState['ubicaciones']
                let groupAreas


                if (cat_user_ubicacion_id === 1) {
                    groupAreas = ubicaciones.map(sub=>sub.id )
                }else if(cat_user_ubicacion_id === 223){

                    groupAreas = getGroupAreas(cat_user_ubicacion_id)
                    //groupAreas = first(groupAreas)

                    pacientes = pacientes_datos.filter(a => groupAreas.includes(a.cat_user_ubicacion_id) )
                    //console.log(pacientes)

                    miData.querySelector(".badge").textContent = pacientes.length
                    UserCuestPad.menuPad()
                    loadingScreen.classList.add("d-none")
                    return false
                }else{
                    console.log("cat_user_ubicacion_id",cat_user_ubicacion_id)
                    groupAreas = getGroupAreas(cat_user_ubicacion_id)
                    //console.log("groupAreas",groupAreas)
                }

                //console.log(first(groupAreas))
                pacientes = pacientes_datos.filter(a => groupAreas.includes(a.cat_user_ubicacion_id) )
                //console.log("pacientes",pacientes)
                    miData.querySelector(".badge").textContent = pacientes.length
                    d.querySelector(`#${activeLayout} .row_pacientes`).innerHTML = null
                    if (pacientes.length > 0) {
                        //console.log('activeLayout',activeLayout);
                        pacientes.forEach(paciente => {
                            switch (activeLayout) {
                                case 'tablapacientesDiagnosticos':table_rowDiagnostico(paciente); break;
                                case 'tablapacientesSignosVitales':table_rowSignosVitales(paciente);break;
                            }
                        })
                        d.querySelectorAll('#App table').forEach(x=>{
                            if (x.id==activeLayout) {
                                x.classList.remove("d-none")
                            }else{
                                x.classList.add("d-none")
                            }
                        })
                        activarTippyTooltip()
                    }
                let titleArea = miData.dataset.title
                    document.getElementById('titleArea').textContent = titleArea
                    loadingScreen.classList.add("d-none")
                    filtroPacientesTabla(activeLayout)
                    activarTooltip()
            }, 200);
        }
        let activarTippyTooltip=()=>{

            tippy('.btn-signos-vitales', {
                theme: "tooltip-cmdlt-light",
                interactive: true,
                trigger: 'click',
                //content: ,
                onShow(instance) {
                    let user_id_paciente = Number(instance.reference.getAttribute(
                        'data-user_id_paciente'))
                    let paciente = pacientes_datos.find(x => x.user_id === user_id_paciente)
                    instance.setContent( /*html*/ `

                        <h4 class="mb-2 text-secondary">Signos Vitales</h4>
                        <table class="w-100 text-secondary">
                            <thead>
                                <tr>
                                    <th style="border-top-left-radius: 12px;" class="header-signos-vitales">Signo</th>
                                    <th class="header-signos-vitales">Nuevo</th>
                                    <th class="header-signos-vitales">Actual</th>
                                    <th style="border-top-right-radius: 12px;" class="header-signos-vitales">Anteriores</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td valign="middle" align="right">TEMP:</td>
                                    <td valign="middle" class="p-1">
                                        <input data-user_id_paciente="${user_id_paciente}" type="number" class="tooltip-input-user_temp form-control mr-1" >
                                    </td>
                                    <td style="vertical-align: middle;" class="actual_temp_value_${user_id_paciente} p-1 text-nowrap">
                                        ${ UserCuestTemperatura.columnaValor(paciente['temp'])}
                                    </td>
                                    <td valign="middle" class="p-1">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-default evolucion-sv-temp">
                                            <i data-user_id="${user_id_paciente}" class="fas fa-history evolucion-sv-temp"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="right">FC:</td>
                                    <td valign="middle" class="p-1">
                                        <input data-user_id_paciente="${user_id_paciente}" type="number" class="tooltip-input-user_fc form-control mr-1" >
                                    </td>
                                    <td id="actual_fc_value_${user_id_paciente}" style="vertical-align: middle;" class="actual_fc_value_${user_id_paciente} p-1 text-nowrap">
                                        ${ UserCuestFc.columnaValor(paciente['fc'])}
                                    </td>
                                    <td valign="middle" class="p-1">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-default evolucion-sv-fc">
                                            <i data-user_id="${user_id_paciente}" class="fas fa-history evolucion-sv-fc"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="right">FR:</td>
                                    <td valign="middle" class="p-1">
                                        <input data-user_id_paciente="${user_id_paciente}" type="number" class="tooltip-input-user_fr form-control mr-1" >
                                    </td>
                                    <td id="actual_fr_value_${user_id_paciente}" style="vertical-align: middle;" class="actual_fr_value_${user_id_paciente} p-1 text-nowrap">
                                        ${ UserCuestFr.columnaValor(paciente['fr'])}
                                    </td>
                                    <td valign="middle" class="p-1">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-default evolucion-sv-fr">
                                            <i data-user_id="${user_id_paciente}" class="fas fa-history evolucion-sv-fr"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="right">TA:</td>
                                    <td valign="middle" class="p-1">
                                        <div class="d-flex flex-column flex-sm-row">
                                            <div class="flex-fill">
                                                <input data-user_id_paciente="${user_id_paciente}" type="number" id="ta_sis${user_id_paciente}" class="user_ta_sis tooltip-input-user_ta form-control mr-1" >
                                            </div>
                                            <div class="flex-fill">
                                                <input data-user_id_paciente="${user_id_paciente}" type="number" id="ta_dia${user_id_paciente}" class="user_ta_dia tooltip-input-user_ta form-control mr-1" >
                                            </div>
                                        </div>

                                    </td>
                                    <td id="actual_ta_value_${user_id_paciente}" style="vertical-align: middle;" class="actual_ta_value_${user_id_paciente} p-1 text-nowrap">
                                        ${ UserCuestTa.columnaValor(paciente['ta'])}
                                    </td>
                                    <td valign="middle" class="p-1">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-default evolucion-sv-ta">
                                            <i data-user_id="${user_id_paciente}" class="fas fa-history evolucion-sv-ta"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="right">GL:</td>
                                    <td valign="middle" class="p-1">
                                        <input data-user_id_paciente="${user_id_paciente}" type="number" class="tooltip-input-user_gl form-control mr-1" >
                                    </td>
                                    <td id="actual_gl_value_${user_id_paciente}" style="vertical-align: middle;" class="actual_gl_value_${user_id_paciente} p-1 text-nowrap">
                                        ${ UserCuestGl.columnaValor(paciente['gl'])}
                                    </td>
                                    <td valign="middle" class="p-1">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-default evolucion-sv-gl">
                                            <i data-user_id="${user_id_paciente}" class="fas fa-history evolucion-sv-gl"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="right">SPO2:</td>
                                    <td valign="middle" class="p-1">
                                        <input data-user_id_paciente="${user_id_paciente}" type="number" class="tooltip-input-user_oxi form-control mr-1" >
                                    </td>
                                    <td id="actual_oxi_value_${user_id_paciente}" style="vertical-align: middle;" class="actual_oxi_value_${user_id_paciente} p-1 text-nowrap">
                                        ${ UserCuestOximetria.columnaValor(paciente['oxi'])}
                                    </td>
                                    <td valign="middle" class="p-1">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-default evolucion-sv-oxi">
                                            <i data-user_id="${user_id_paciente}" class="fas fa-history evolucion-sv-oxi"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="border-bottom-left-radius: 12px;border-bottom-right-radius: 12px;" colspan="4" class="p-1 text-center">
                                        <button data-user_id="${user_id_paciente}" class="btn btn-success store-signos-vitales">
                                            Guardar
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    `);

                },
                allowHTML: true,
            });
            initSignosVitalesTooltip = false
        }
        let groupBtnTotales = () => {
            let totales = {
                "total_pacientes": pacientes_datos.length,
                "total_emergencia": pacientes_datos.filter(x => [2, 6, 10, 32].includes(Number(x
                    .parent_cat_user_ubicacion_id))).length,

                "total_hospitalizacion": pacientes_datos.filter(x => [43, 71, 99, 127, 155].includes(Number(x
                    .parent_cat_user_ubicacion_id)) || [42, 70, 98, 126, 154, 390].includes(Number(x
                    .cat_user_ubicacion_id))).length,
                "total_uti": pacientes_datos.filter(x => [183, 195, 212].includes(Number(x
                    .parent_cat_user_ubicacion_id)) || [182, 42, 70, 98, 126, 154, 390].includes(Number(x
                    .cat_user_ubicacion_id))).length,
                "total_pad": pacientes_datos.filter(x => [224, 372, 379, 368].includes(Number(x
                    .parent_cat_user_ubicacion_id))).length,
                "total_infeccion": pacientes_datos.filter(x => !is_null(x.cirugia) && x.cirugia > 1).length,
                "total_caida": pacientes_datos.filter(x => !is_null(x.resbalar) && x.resbalar > 1).length,
                "total_riesgo": pacientes_datos.filter(x => !is_null(x.alert) && x.alert > 1).length,
                "total_vip": pacientes_datos.filter(x => !is_null(x.vip) && x.vip > 0).length,
            }
            d.querySelectorAll(".navbar-totales").forEach(btn => {
                //console.log(btn.id);
                if (totales.hasOwnProperty(btn.id)) {
                    btn.textContent = totales[btn.id]
                }
                //console.log(btn);
            })
            newsSignos()
            /* tippy('.layout-options', {
                theme: "tooltip-cmdlt-light",
                interactive: true,
                trigger: 'click',
                //content: ,
                onShow(instance) {
                    instance.setContent(  `
                        <h4 class="mb-2 text-secondary">Seleccione tipo de visualización:</h4>
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active">Active item</button>
                            <button type="button" class="list-group-item list-group-item-action">Item</button>
                            <button type="button" class="list-group-item list-group-item-action disabled">Disabled item</button>
                        </div>
                    `);
                },
                allowHTML: true,
            }) */
        }
        let btnCirugia = (valueOfElement) => {
            //**icono cirugia */
            let cirugia = new UserCuestRiesgoQuirurgico({
                "value": valueOfElement['cirugia'],
                "user_id_paciente": valueOfElement['user_id'],
                "description": valueOfElement['cirugia_description'],
                "episodio_id": valueOfElement['episodio']
            })
            return /*html*/ `
                <div class="px-1">
                    <div class="btn-group" role="group">
                        <a
                            id="default-cirugia_${valueOfElement["user_id"]}"
                            class="px-2 m-0"
                            type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            ${cirugia.buttom()}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a data-value="1" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-cirugia dropdown-item cursor-pointer"><span class="text-success pc-cirugia"></span>
                                Estable</a>
                            <a data-value="2" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-cirugia dropdown-item cursor-pointer"><span class="text-warning pc-cirugia"></span>
                                Intermedio</a>
                            <a data-value="3" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-cirugia dropdown-item cursor-pointer"><span class="text-danger pc-cirugia"></span>
                                De cuidado</a>
                        </div>
                    </div>
                </div>
            `

        }
        let btnResbalar = (valueOfElement) => {
            //**icono resbalar */
            let resbalar = new UserCuestResbalar({
                "value": valueOfElement['resbalar'],
                "user_id_paciente": valueOfElement['user_id'],
                "description": valueOfElement['resbalar_description'],
                "episodio_id": valueOfElement['episodio']
            })
            return `
                <div class="px-1">
                    <div class="btn-group" role="group">
                        <a id="default-resbalar_${valueOfElement["user_id"]}" class="px-2 m-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ${resbalar.buttom()}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a data-value="1" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-resbalar dropdown-item cursor-pointer"><span class="text-success pc-resbalar"></span>
                                Estable</a>
                            <a data-value="2" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-resbalar dropdown-item cursor-pointer"><span class="text-warning pc-resbalar"></span>
                                Intermedio</a>
                            <a data-value="3" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-resbalar dropdown-item cursor-pointer"><span class="text-danger pc-resbalar"></span>
                                De cuidado</a>
                        </div>
                    </div>
                </div>
            `

        }
        let btnRiesgo = (valueOfElement) => {
            //**icono alerta */
            let alerta = new UserCuestAlert({
                "value": valueOfElement['alert'],
                "user_id_paciente": valueOfElement['user_id'],
                "description": valueOfElement['alert_description'],
                "episodio_id": valueOfElement['episodio']
            })
            return `
                <div class="px-1">
                    <div class="btn-group" role="group">
                        <a id="default-alert_${valueOfElement["user_id"]}" class="px-2 m-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ${alerta.buttom()}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a data-value="1" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-alert dropdown-item cursor-pointer"><span class="text-success">!</span>
                                Estable</a>
                            <a data-value="2" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-alert dropdown-item cursor-pointer"><span class="text-warning">!!</span>
                                Intermedio</a>
                            <a data-value="3" data-user_id_paciente="${valueOfElement['user_id']}" class="btn-alert dropdown-item cursor-pointer"><span class="text-danger">!!!</span>
                                De cuidado</a>
                        </div>
                    </div>
                </div>
            `

        }
        let btnVIP = (valueOfElement) => {
            //**icono vip */
            let vip = new UserVIP({
                "value": valueOfElement['vip'],
                "user_id_paciente": valueOfElement['user_id'],
                "description": valueOfElement['vip_description'],
                "episodio_id": valueOfElement['episodio']
            })
            return `
                <div class="px-1">
                    <button id="vip_${valueOfElement["user_id"]}" data-user_id="${valueOfElement["user_id"]}" data-value="${valueOfElement['vip']}" data-episodio_id="${valueOfElement['episodio']}" class="btn-vip btn btn-transparent p-0 m-0">
                        ${vip.buttom()}
                    </button>
                </div>
            `

        }
        let btnPendientes = (paciente) => {

            let pendientes = 0
            if (paciente.pendiente.length > 0) {
                pendientes = paciente.pendiente.filter(x => Number(x.active) === 1).length
            }


            return /*html*/ `
                <div class="d-flex flex-column">
                     <div class="text-right">
                         <span
                            id="total_pendientes_${paciente.user_id}"
                            class="${(pendientes === 0) ? 'd-none':'' } badge badge-danger position-relative rounded-circle"
                            style="right: -15px;">
                            ${pendientes}
                        </span>
                     </div>
                    <div>
                        <i

                            data-user_id_paciente="${paciente.user_id}"
                            class="pendientes-paciente pc-pendiente_paciente text-primary h4"
                            style="position: relative; bottom: ${(pendientes === 0) ? '0px':'12px' } ;"
                        >
                        </i>
                    </div>
                </div>
            `
        }
        let column_ubicacion = (valueOfElement) => {
            let text_color = "text-gray"
            let iconCalendar = "fa-calendar"
            let cardPreAltaDisplay = "d-none"
            let cardPreAltaTooltipColor = "info"
            let titlePreAlta = ""
            let fechaIngreso = ""
            if (!is_null(valueOfElement['prealta']) && valueOfElement['prealta'] !== undefined) {
                let d = document;
                let fecha = valueOfElement['prealta'].split("-")
                let f = new Date(fecha[0], (parseInt(fecha[1]) - 1), fecha[2]);

                text_color = "text-" + valueOfElement['prealta_color']
                iconCalendar = "fa-calendar-check"
                cardPreAltaDisplay = ""
                cardPreAltaTooltipColor = valueOfElement['prealta_color']
                if (
                    UserCuestEpisodio.prealtaColor(valueOfElement['prealta']) === "danger"
                ) titlePreAlta = "ALTA";
                if (
                    UserCuestEpisodio.prealtaColor(valueOfElement['prealta']) === "warning" ||
                    UserCuestEpisodio.prealtaColor(valueOfElement['prealta']) === "success"

                ) titlePreAlta = "PRE-ALTA";

                fechaIngreso = f.getFullYear() + "-" + (f.getMonth()) + "-" + f.getDate();
                fechaIngreso = f.getDate() + "-" + capitalize(meses(f.getMonth()).slice(0, 3)) + "-" + f.getFullYear();

            }
            let ubicacion = valueOfElement.ubicacion_description

            return /*html*/ `
                <input type="hidden" id="fecha_prealta_${valueOfElement['user_id']}" value="${valueOfElement['prealta']}">

                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex flex-nowrap" style="width: 6em;">

                        <button class="d-flex flex-column align-items-center text-secondary btn btn-transparent btn-block btn-ubicacion-paciente" data-tippy-content="Historial de ubicaciones del paciente" data-user_id_paciente="${valueOfElement['user_id']}">
                            <div class="btn-ubicacion-paciente text-uppercase" data-user_id_paciente="${valueOfElement['user_id']}" ></div>
                            <b class="btn-ubicacion-paciente text-uppercase" data-user_id_paciente="${valueOfElement['user_id']}" >${ubicacion}</b>
                        </button>
                    </div>
                    <div class="">
                        <button data-tippy-content="Agregar Fecha Probable de Alta" data-user_id_paciente="${valueOfElement['user_id']}" class="add-prealta btn btn-block" style="background-color: #eeefef;border-color: #ddd;color: #444;">
                            <i data-user_id_paciente="${valueOfElement['user_id']}" class="add-prealta far ${iconCalendar} calendar-prealta ${text_color}"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div id="card_prealta_${valueOfElement['user_id']}" data-tippy-content="Fecha Probable de Alta" data-user_id_paciente="${valueOfElement['user_id']}" class="add-prealta tooltip-${cardPreAltaTooltipColor} ${(valueOfElement['prealta_color'] !== "danger" && valueOfElement['prealta_color'] !== "warning") ? '' : 'heartbeat_infinity'} cursor-pointer bg-${valueOfElement['prealta_color']} ${cardPreAltaDisplay}  rounded mx-1 px-1 text-center">
                        <div class="font-weight-bold" style="font-size: 0.8em;">
                            <i class="fas fa-stopwatch"></i>
                            <span id="title_prealta_${valueOfElement['user_id']}">
                                ${(valueOfElement['prealta_color'] !== "success" && valueOfElement['prealta_color'] !== "warning") ? 'ALTA' : 'PRE-ALTA'}
                            </span>
                        </div>
                        <div>
                            ${fechaIngreso}
                        </div>
                    </div>
                </div>
            `
        }
        let column_cardPaciente = (paciente) => {
            return /*html*/ `
                <div class="container-fluid p-0 rounded">
                    <span class="cursor-pointer d-none">
                        <span class="filtroBuscador" style="font-size:0em">
                            ${paciente.episodio_id}
                        </span>
                        <span class="filtroBuscador" style="font-size:0em">
                            ${paciente.user_id}
                        </span>
                        <span class="filtroBuscador" style="font-size:0em">
                            ${paciente.cedula}
                        </span>
                        <span class="filtroBuscador" style="font-size:0em">
                            ${paciente.email}
                        </span>
                        <span class="filtroBuscador" style="font-size:0em">
                            ${paciente.ingreso}
                        </span>
                    </span>

                    <div class="d-flex">
                        <div class="mx-1">
                            <img loading="lazy" src="${paciente.imagen}" onerror="this.src ='/image/system/patient.svg'" style="width: 1.5cm; height: 1.5cm;object-fit: cover;"
                                class="border border-primary rounded-circle mx-auto d-block" />
                                <small style="color:transparent">${paciente.user_id}</small>
                        </div>
                        <div class="flex-grown-1">
                            <div class="d-flex">
                                ${btnCirugia(paciente)}
                                ${btnResbalar(paciente)}
                                ${btnRiesgo(paciente)}
                                ${btnVIP(paciente)}
                            </div>
                            <div>
                                <div style="min-width: 200px">
                                    <h4 data-tippy-content="Nombre del paciente" class="text-primary text-wrap"
                                        style="margin-bottom: 0; max-width: 230px">
                                        ${paciente.nombres+" "+paciente.apellidos}
                                    </h4>
                                </div>
                                <span class="text-secondary">${paciente.cedula}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex flex-fill justify-content-around">
                            <div class="btn-group mx-2 align-items-center">
                                <a
                                    href="#"

                                    data-toggle="dropdown"
                                    data-display="static"
                                    aria-haspopup="true"
                                    data-tippy-content="Información del paciente"
                                    aria-expanded="false"
                                    class="tooltip-success"
                                >
                                    <i

                                        class="pc-paciente-info-solid text-success h4"
                                    >
                                    </i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    @php
                                        $pacienteOptions = [
                                            [
                                                "tooltip"=>"Información del paciente",
                                                "name"=>"Info. Paciente",
                                                "classHandleClick"=>"info-paciente",
                                                "icon"=>"pc-paciente-info-solid",
                                                "color"=>"success",
                                                "active"=>TRUE,
                                                "completado"=>TRUE,
                                            ],
                                            [
                                                "tooltip"=>"Información del familiar",
                                                "name"=>"Info. Familiar",
                                                "classHandleClick"=>"info-familiar",
                                                "icon"=>"pc-family",
                                                "color"=>"success",
                                                "active"=>TRUE,
                                                "completado"=>TRUE,
                                            ],
                                            [
                                                "tooltip"=>"Información Administrativa",
                                                "name"=>"Info. Administrativa",
                                                "classHandleClick"=>"info-paciente-administrative",
                                                "icon"=>"pc-info_administracion_solid",
                                                "color"=>"success",
                                                "active"=>TRUE,
                                                "completado"=>FALSE,
                                            ],


                                        ];
                                    @endphp
                                    @foreach ( $pacienteOptions as $pacienteOption )
                                        @if ( $pacienteOption['active'] )
                                            <a
                                                id="paciente-${paciente.user_id}-${paciente.episodio_id}"
                                                href="#"
                                                data-user_id_paciente="${paciente.user_id}"
                                                data-episodio_id ="${paciente.episodio_id}"
                                                class="{{ $pacienteOption['classHandleClick'] }} tooltip-{{ $pacienteOption['color'] }} dropdown-item cursor-pointer"
                                                data-tippy-content="{{ $pacienteOption['tooltip'] }}"
                                            >
                                                <div class="d-flex justify-content-start">
                                                    <i
                                                        data-user_id_paciente="${paciente.user_id}"
                                                        data-episodio_id ="${paciente.episodio_id}"
                                                        class="{{ $pacienteOption['classHandleClick'] }} {{ $pacienteOption['icon'] }} text-{{ $pacienteOption['color'] }} pr-1 h4 mb-0">
                                                    </i>
                                                    <div
                                                        data-user_id_paciente="${paciente.user_id}"
                                                        data-episodio_id ="${paciente.episodio_id}"
                                                        class="{{ $pacienteOption['classHandleClick'] }} flex-fill option-informe-ingreso"
                                                    >{{ $pacienteOption['name'] }}</div>
                                                </div>
                                            </a>
                                        @endif

                                    @endforeach
                                </div>
                            </div>


                            <button
                                data-user_id_paciente="${paciente.user_id}"
                                data-episodio_id="${paciente.episodio_id}"
                                class="tooltip-purple historia-ingreso btn btn-transparent pulsate-bck"
                                data-tippy-content="Historia Preliminar de Ingreso"

                            >
                                <i
                                    data-user_id_paciente="${paciente.user_id}"
                                    data-episodio_id="${paciente.episodio_id}"
                                    class="historia-ingreso pc-historia-inicial-solid text-purple h4"></i>
                            </button>


                            <div class="btn-group mx-2 align-items-center">
                                <a
                                    href="#"
                                    data-toggle="dropdown"
                                    data-display="static"
                                    aria-haspopup="true"
                                    data-tippy-content="Historia Clínica | Episodios anteriores <b class='badge badge-info'>${paciente.total_episodios}</b>"
                                    aria-expanded="false"
                                    class="tooltip-primary"
                                >
                                    <i data-user_id_paciente="${paciente.user_id}" data-episodio_id ="${paciente.episodio_id}" class="pc-solid-evolucion text-primary h4" ></i>



                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    <a
                                        href="#"
                                        data-user_id_paciente="${paciente.user_id}"
                                        data-episodio_id ="${paciente.episodio_id}"
                                        class="evolucion-paciente dropdown-item cursor-pointer"
                                    >
                                        <i
                                            data-user_id_paciente="${paciente.user_id}"
                                            data-episodio_id ="${paciente.episodio_id}"
                                            class="evolucion-paciente pc-evo-medic text-primary h4"></i>
                                            Historia Médica
                                    </a>
                                    <a
                                        href="#"
                                        data-user_id_paciente="${paciente.user_id}"
                                        data-episodio_id ="${paciente.episodio_id}"
                                        class="evolucion-paciente dropdown-item cursor-pointer"
                                    >
                                        <i
                                            data-user_id_paciente="${paciente.user_id}"
                                            data-episodio_id ="${paciente.episodio_id}"
                                            class="evolucion-paciente pc-evo-nurse text-warning-enfermeria h4"></i>
                                            Historia Enfermería
                                    </a>
                                    <a
                                        href="#"
                                        data-user_id_paciente="${paciente.user_id}"
                                        data-episodio_id ="${paciente.episodio_id}"
                                        class="historia-episodio-anteriores dropdown-item cursor-pointer"
                                    >
                                        <i
                                            data-user_id_paciente="${paciente.user_id}"
                                            data-episodio_id ="${paciente.episodio_id}"
                                            class="historia-episodio-anteriores pc-historial-episodios-solid text-primary h4">
                                        </i>
                                        Episodios anteriores
                                        <span data-tippy-content="${paciente.total_episodios > 0 ? paciente.total_episodios + ' episodios encontrados' : 'Sin episodios anteriores'}" class="badge rounded-circle badge-${paciente.total_episodios > 0 ?'primary' : 'gray'}">
                                            ${paciente.total_episodios}
                                        </span>
                                    </a>

                                </div>
                            </div>
                            <div class="btn-group mx-2 align-items-center">
                                <a
                                    href="#"
                                    data-toggle="dropdown"
                                    data-display="static"
                                    aria-haspopup="true"
                                    data-tippy-content="Informes"
                                    aria-expanded="false"
                                    class="tooltip-danger"
                                >

                                    <i
                                        data-user_id_paciente="${paciente.user_id}"
                                        data-episodio_id ="${paciente.episodio_id}"
                                        class="pc-folder_informes text-danger h4"
                                    >
                                    </i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    @php
                                        $informesOptions = [
                                            [
                                                "name"=>"Ingreso",
                                                "classHandleClick"=>"ingreso",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Ordenes Médicas",
                                                "classHandleClick"=>"ordenes-medicas",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"De interconsulta",
                                                "classHandleClick"=>"interconsulta",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Evaluación Preoperatoria",
                                                "classHandleClick"=>"evaluacion-preoperatoria",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Estudios Cardiológicos",
                                                "classHandleClick"=>"estudio-cardiologico",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Nota Operatoria",
                                                "classHandleClick"=>"nota-pperatoria",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Procedimiento Médico",
                                                "classHandleClick"=>"procedimiento-medico",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Orden Med. Pre operatoria",
                                                "classHandleClick"=>"orden-med-pre-operatoria",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Nota de traslado",
                                                "classHandleClick"=>"nota-de-traslado",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Nota de Egreso",
                                                "classHandleClick"=>"nota-de-egreso",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                            [
                                                "name"=>"Informe Preliminar de Emergencia",
                                                "classHandleClick"=>"preliminar-emergencia",
                                                "icon"=>"",
                                                "active"=>TRUE,
                                            ],
                                        ];
                                    @endphp
                                    @foreach ( $informesOptions as $informesOption )
                                        @if ( $informesOption['active'] )
                                            <a
                                                id="informe-${paciente.user_id}-${paciente.episodio_id}-{{ $informesOption['classHandleClick'] }}"
                                                href="#"
                                                data-user_id_paciente="${paciente.user_id}"
                                                data-episodio_id ="${paciente.episodio_id}"
                                                class="informe-${paciente.user_id}-${paciente.episodio_id}-{{ $informesOption['classHandleClick'] }} tooltip-secondary dropdown-item cursor-pointer"
                                                data-tippy-content="El informe no ha sido completado.</b>"
                                            >
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="option-informe-ingreso">{{ $informesOption['name'] }}</div>
                                                    <!--check &#10004;-->
                                                    <!--uncheck &#9744;-->
                                                    <b class="text-secondary ml-2">&#9744;</b>
                                                </div>
                                            </a>
                                        @endif

                                    @endforeach
                                </div>
                            </div>


                            <button data-user_id_paciente="${paciente.user_id}" data-tippy-content="Signos vitales del paciente" class="tooltip-danger btn-signos-vitales signos-vitales btn btn-transparent pulsate-bck">
                                <i data-user_id_paciente="${paciente.user_id}" class="signos-vitales pc-signos_vitales text-danger h4"></i>
                            </button>
                            <button
                                data-user_id_paciente="${paciente.user_id}"
                                data-tippy-content="Pendientes del paciente <b class='badge badge-info'>${paciente.total_episodios}</b>"
                                class="tooltip-primary pendientes-paciente btn btn-transparent pulsate-bck"
                            >
                                ${btnPendientes(paciente)}
                            </button>
                            <button data-user_id_paciente="${paciente.user_id}" data-tippy-content="Chat Whatsapp" class="tooltip-success chat-whatsapp-paciente btn btn-transparent pulsate-bck">
                                <i data-user_id_paciente="${paciente.user_id}" class="chat-whatsapp-paciente pc-whatsapp-solid text-success h4"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <small style="color:transparent">${paciente.episodio_id}</small>

            `
        }
        let column_impresionDiagnostica = (paciente) => {
            let imp_diagn = "";
            let f = null;
            let fecha = null;
            let contImpDiagn = 0;

            if (paciente.hasOwnProperty('resultados')) {
                paciente.resultados.forEach(row => {
                    if (row.description ===
                        "Probabilidad diagnóstica") {
                        f = new Date(row.created_at);
                        fecha = f.getDate() + " " + meses(f
                                .getMonth()) + ", " + f
                            .getFullYear();
                        imp_diagn += /*html*/ `
                            <li class="list-group-item bg-transparent text-secondary impresion-diagnostica-width">
                                <div class="d-flex flex-column justify-content-start">
                                    <div>
                                        ${is_null(row.value) ? "" :row.value.replace(/\n/g, '<br>').trim()}
                                    </div>
                                    <small class="d-flex align-items-center justify-content-end mt-2">
                                        <i class="far fa-clock mr-1"></i> ${row.medico} | ${fecha} | ${row.hora}
                                    </small>
                                </div>
                            </li>
                        `;
                        contImpDiagn++;
                    }
                });
            }
            return imp_diagn
        }
        let column_evolucion = (paciente) => {
            let model = "";
            let f = null;
            let fecha = null;
            let contImpDiagn = 0;

            if (paciente.hasOwnProperty('resultados')) {
                paciente.resultados.forEach(row => {
                    if (row.description ===
                        "Evolución") {
                        f = new Date(row.created_at);
                        fecha = f.getDate() + " " + meses(f
                                .getMonth()) + ", " + f
                            .getFullYear();
                        model += /*html*/ `
                            <li class="list-group-item bg-transparent text-secondary impresion-diagnostica-width">
                                <div class="d-flex flex-column justify-content-start">
                                    <div>
                                        ${is_null(row.value) ? "" :row.value.replace(/\n/g, '<br>').trim()}
                                    </div>
                                    <small class="d-flex align-items-center justify-content-end mt-2">
                                        <i class="far fa-clock mr-1"></i> ${row.medico} | ${fecha} | ${row.hora}
                                    </small>
                                </div>
                            </li>
                        `;
                        contImpDiagn++;
                    }
                });
            }
            return model
        }
        let columnMedicoPaciente = (medicos_paciente, cell_id = null) => {
            let result = ""
            if (medicos_paciente.length > 0) {
                medicos_paciente.forEach(m => {
                    result += /*html*/ `
                            <li class="list-group-item bg-transparent text-nowrap">
                                <span style="width: 25px;" data-tippy-content="${m.posicion.toUpperCase()}" class="tooltip-${m.tagColor} badge font-weight-bold badge-${m.tagColor}">${m.posicion.slice(0,2).toUpperCase()}</span> ${m.medico}
                            </li>
                        `
                })
            }
            if (is_null(cell_id)) {
                return result
            } else {
                document.getElementById(cell_id).innerHTML = result
            }

        }
        let columnsDataPaciente = (paciente)=>{
            let prealtaAlert = ""

                if (!["info", "success", null].includes(paciente.prealta_color)) {
                    prealtaAlert = "prealta"
                }
                return `
                    <td id="col_1_${paciente.user_id}" align="center">
                        ${column_ubicacion(paciente)}
                    </td>
                    <td align="center" class="text-secondary pt-5 h4 tooltip-primary " data-tippy-content="Fecha de ingreso:${paciente.ingreso}" >${paciente.dias}</td>
                    <td >
                        ${column_cardPaciente(paciente)}
                    </td>
                    <td align="center" class="text-secondary pt-5 h4">${paciente.genero.toUpperCase()}</td>
                    <td align="center" class="text-secondary pt-5 h4">${paciente.edad}</td>
                `
        }
        let handleBoxHeight = (id)=>{
            const contentDiv = document.querySelector(id);
            const readMoreBtn = contentDiv.querySelector('.readMoreBtn');
            const readLessBtn = contentDiv.querySelector('.readLessBtn');

            readMoreBtn.addEventListener('click', () => {
                contentDiv.querySelector('.content-max-height').style.maxHeight = 'none';
                readLessBtn.classList.add('show');
                contentDiv.querySelector('.content-max-height').classList.add('scale-in-ver-top');
                readMoreBtn.classList.remove('show');
            });

            readLessBtn.addEventListener('click', () => {
                contentDiv.querySelector('.content-max-height').classList.remove('scale-in-ver-top');

                contentDiv.querySelector('.content-max-height').style.maxHeight = '200px';
                readMoreBtn.classList.add('show');

                readLessBtn.classList.remove('show');
            });
            if (contentDiv.scrollHeight > 100) {
                readMoreBtn.classList.add('show');
            }
        }
        let table_rowDiagnostico = (paciente) => {
            let evolucion = column_evolucion(paciente)
            let diagnostico = column_impresionDiagnostica(paciente)

            let nuevaFila = /*html*/
                `
                    <tr class="fade-in row_${paciente.episodio_id}">

                        ${columnsDataPaciente(paciente)}

                        <td>
                            <div class="box_content-imp-diag_${paciente.episodio_id} scale-in-ver-top d-flex flex-column">
                                <div class="content-max-height">
                                    <ul id="list_diagnosticos_${paciente.episodio_id}" class="list-group rounded list-group-flush">
                                        ${ diagnostico }
                                    </ul>
                                </div>
                                <div>
                                    <a href="#" class="d-none ml-2 btn-sm text-primary font-weight-bold readMoreBtn show">Ver más ...</i></a href="#">
                                    <a href="#" class="d-none ml-2 btn-sm text-primary font-weight-bold readLessBtn">... Ver menos</a href="#">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="box_content-evo_${paciente.episodio_id} scale-in-ver-top d-flex flex-column">
                                <div class="content-max-height">
                                    <ul id="list_evolucion_${paciente.episodio_id}" class="list-group rounded list-group-flush">
                                        ${ evolucion }
                                    </ul>
                                </div>
                                <div>
                                    <a href="#" class="d-none ml-2 btn-sm text-primary font-weight-bold readMoreBtn show">Ver más ...</i></a href="#">
                                    <a href="#" class="d-none ml-2 btn-sm text-primary font-weight-bold readLessBtn">... Ver menos</a href="#">
                                </div>
                            </div>


                        </td>
                        <td id="list_medicos_pacientes_${paciente.episodio_id}">

                        </td>
                    </tr>
                `
                d.querySelector(`#${activeLayout} .row_pacientes`).insertAdjacentHTML('beforeend', nuevaFila)

                let box = document.querySelector(`.box_content-imp-diag_${paciente.episodio_id}`);
                    if (!is_empty(diagnostico)) {
                        box.querySelectorAll(`a`).forEach(x=>{
                            x.classList.remove("d-none")
                        });
                        handleBoxHeight(".box_content-imp-diag_"+paciente.episodio_id)

                    }

                    box = document.querySelector(`.box_content-evo_${paciente.episodio_id}`);
                    if (!is_empty(evolucion)) {
                        box.querySelectorAll(`a`).forEach(x=>{
                            x.classList.remove("d-none")
                        });
                        handleBoxHeight(".box_content-evo_"+paciente.episodio_id)
                    }



                let doctoresPacientes= new MedicosPaciente({
                        episode_id:paciente.episodio_id,
                        attrSelectorId:`list_medicos_pacientes_${paciente.episodio_id}`,
                    })
                    doctoresPacientes.deployMedicoPacienteList()

        }
        let table_rowSignosVitales = (paciente) => {


            let nuevaFila = /*html*/
                `
                    <tr class="fade-in row_${paciente.episodio_id}">

                        ${columnsDataPaciente(paciente)}

                        <td class="valign-center valign-center">
                            <input placeholder="Temp"
                                id="dropdown_pac_temp_${paciente.user_id}"
                                style="width:130px"
                                data-episodio_id="${paciente.episodio_id}"
                                data-user_id_paciente="${paciente.user_id}"
                                type="number"
                                class="text-center mx-auto tooltip-input-user_temp_${paciente.user_id} form-control border-light"
                            >
                            <div
                                data-user_id_paciente="${paciente.user_id}"
                                data-episodio_id="${paciente.episodio_id}"
                                class="evolucion-sv-temp h4 mt-3 actual_temp_value_${paciente.user_id}"
                            >
                                ${ UserCuestTemperatura.columnaValor(paciente['temp'],paciente.user_id )}
                            </div>
                        </td>
                        <td class="valign-center">
                            <input placeholder="Fc"  id="dropdown_pac_fc_${paciente.user_id}"  style="width:130px;background-color:rgb(243, 243, 243)" data-episodio_id="${paciente.episodio_id}" data-user_id_paciente="${paciente.user_id}" type="number" class="text-center mx-auto tooltip-input-user_fc_${paciente.user_id} form-control border-light">
                            <div data-user_id_paciente="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" class="evolucion-sv-fc h4 mt-3 actual_fc_value_${paciente.user_id}">
                                ${ UserCuestFc.columnaValor(paciente['fc'],paciente.user_id )}
                            </div>
                        </td>
                        <td class="valign-center">
                            <input placeholder="Fr"  id="dropdown_pac_fr_${paciente.user_id}"  style="width:130px" data-user_id_paciente="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" type="number" class="text-center mx-auto tooltip-input-user_fr_${paciente.user_id} form-control border-light">
                            <div data-user_id_paciente="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" class="evolucion-sv-fr h4 mt-3 actual_fr_value_${paciente.user_id}">
                                ${ UserCuestFr.columnaValor(paciente['fr'],paciente.user_id )}
                            </div>
                        </td>
                        <td class="valign-center">
                            <div class="d-flex">
                                <input placeholder="Sis"  style="width:80px;background-color:rgb(243, 243, 243)" data-episodio_id="${paciente.episodio_id}" data-user_id_paciente="${paciente.user_id}" type="number" id="ta_sis${paciente.user_id}" class="text-center user_ta_sis mx-auto tooltip-input-user_ta_${paciente.user_id} form-control border-light">
                                <input placeholder="Dia"  style="width:80px;background-color:rgb(243, 243, 243)" data-episodio_id="${paciente.episodio_id}" data-user_id_paciente="${paciente.user_id}" type="number" id="ta_dia${paciente.user_id}" class="text-center user_ta_dia mx-auto tooltip-input-user_ta_${paciente.user_id} form-control border-light">
                            </div>
                            <div data-user_id_paciente="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" class="evolucion-sv-ta_${paciente.user_id} h4 mt-3 actual_ta_value_${paciente.user_id}">
                                ${ UserCuestTa.columnaValor(paciente['ta'],paciente.user_id )}
                            </div>
                        </td>
                        <td class="valign-center">
                            <input placeholder="Gl" id="dropdown_pac_gl_${paciente.user_id}"  data-episodio_id="${paciente.episodio_id}"  style="width:130px" data-user_id_paciente="${paciente.user_id}" type="number" class="text-center mx-auto tooltip-input-user_gl_${paciente.user_id} form-control border-light">
                            <div data-user_id_paciente="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" class="evolucion-sv-gl_${paciente.user_id} h4 mt-3 actual_gl_value_${paciente.user_id}">
                                ${ UserCuestGl.columnaValor(paciente['gl'],paciente.user_id )}
                            </div>
                        </td>
                        <td class="valign-center">
                            <input placeholder="Oxi" id="dropdown_pac_oxi_${paciente.user_id}"  data-episodio_id="${paciente.episodio_id}" style="width:130px;background-color:rgb(243, 243, 243)" data-user_id_paciente="${paciente.user_id}" type="number" class="text-center mx-auto tooltip-input-user_oxi_${paciente.user_id} form-control border-light">
                            <div data-user_id_paciente="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" class="evolucion-sv-oxi_${paciente.user_id} h4 mt-3 actual_oxi_value_${paciente.user_id}">
                                ${ UserCuestOximetria.columnaValor(paciente['oxi'],paciente.user_id )}
                            </div>
                        </td>

                        <td class="valign-center">
                            <button data-user_id="${paciente.user_id}" data-episodio_id="${paciente.episodio_id}" class=" mx-auto btn btn-success store-signos-vitales-table">
                                Guardar
                            </button>
                        </td>

                    </tr>
                `
                d.querySelector(`#${activeLayout} .row_pacientes`).insertAdjacentHTML('beforeend', nuevaFila)

        }
        let getPacientes = async (data, title) => {
            return await get(location.origin + "/vistas/tp")
        }
        d.addEventListener('DOMContentLoaded', async function() {
            //catUserUbicacion = await get(location.origin + "/cat_user_ubicacion/index")
            UserMedico.getMedicosByCargo();
            useState['ubicaciones'] = await CatUserUbicacion.getIndex();
            //Component.menu('tp')
            pacientes_datos = await getPacientes()
            groupBtnTotales()




            d.querySelectorAll("#cat_user_ubicacion_menu a.nav-link").forEach(btnArea => {
                if (!['Programa de Atención domicialiaria'].includes(btnArea.title)) {
                    btnArea.addEventListener('click', async (e) => {
                        //console.log(e.currentTarget)
                        activeArea = e.currentTarget.dataset.area
                        localStorage.setItem("activeArea",activeArea)
                        handleMenuPrincipalOpciones(e)
                    })
                }else{
                    btnArea.addEventListener('click', async (e) => {
                        //console.log(e.currentTarget)
                        activeArea = e.currentTarget.dataset.area
                        localStorage.setItem("activeArea",activeArea)
                    })
                }
            })
            loadingScreen.classList.add("d-none")
            //INICIALIZAR AREA
            let area_tp = d.querySelector(`#cat_user_ubicacion_menu [data-area="${localStorage.getItem("activeArea")}"]`);
                area_tp.click();



            tippy('.btn-total-emergencia', {
                theme: "tooltip-cmdlt-primary",
                content: /*html*/ `
                    <strong>Pacientes en Emergencia</strong>
                    <div class="d-flex flex-column">
                        <div>
                            Adulto: <b>${pacientes_datos.filter(x=> [2,3].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Pediátrico: <b>${pacientes_datos.filter(x=> [28,29,32].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                    </div>
                `,
                allowHTML: true,
            });
            tippy('.btn-total-hospitalizacion', {
                theme: "tooltip-cmdlt-primary",
                content: /*html*/ `
                    <strong>Pacientes en Hospitalización</strong>
                    <div class="d-flex flex-column">
                        <div>
                            HCEP: <b>${pacientes_datos.filter(x=> [390].includes( Number(x.cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Piso 2: <b>${pacientes_datos.filter(x=> [42,43].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Piso 3: <b>${pacientes_datos.filter(x=> [70,71].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Piso 4: <b>${pacientes_datos.filter(x=> [98,99].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Piso 5: <b>${pacientes_datos.filter(x=> [126,127].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Piso 6: <b>${pacientes_datos.filter(x=> [154,155].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                    </div>
                `,
                allowHTML: true,
            });
            tippy('.btn-total-uti', {
                theme: "tooltip-cmdlt-primary",
                content: /*html*/ `
                    <strong>Pacientes en UTI</strong>
                    <div class="d-flex flex-column">
                        <div>
                            Adulto: <b>${pacientes_datos.filter(x=> [182,183].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Pediátrico: <b>${pacientes_datos.filter(x=> [211,212].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                    </div>
                `,
                allowHTML: true,
            });
            tippy('.btn-total-pad', {
                theme: "tooltip-cmdlt-primary",
                content: /*html*/ `
                    <strong>Pacientes en PAD</strong>
                    <div class="d-flex flex-column">
                        <div>
                            Emergencia: <b>${pacientes_datos.filter(x=> [224].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Quirúrgico: <b>${pacientes_datos.filter(x=> [372].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Médico: <b>${pacientes_datos.filter(x=> [379].includes( Number(x.parent_cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                        <div>
                            Cardiología: <b>${pacientes_datos.filter(x=> [388,389].includes( Number(x.cat_user_ubicacion_id) )  ).length}</b>
                        </div>
                    </div>
                `,
                allowHTML: true,
            });
            tippy(`.pri_estable`, {
                theme: "tooltip-cmdlt-success",
                zIndex: 200000,
                allowHTML: true
            })
            tippy(`.pri_intermedio`, {
                theme: "tooltip-cmdlt-warning",
                zIndex: 200000,
                allowHTML: true
            })
            tippy(`.pri_de_cuidado`, {
                theme: "tooltip-cmdlt-danger",
                zIndex: 200000,
                allowHTML: true
            })
            var minutos = 1; //valor a cambiar
            var milisegundos = minutos * 60000;
            setInterval(function() {
                get('/sessionExist')
                    .then(response => {
                        if (response) {

                            message = Component.alertMessage("expire_sesion");
                            Toast.fire({
                                icon: message['imagen'],
                                title: message['title'],
                                text: message['message'],
                                timer: 15000,
                                didOpen: () => {
                                    setInterval(() => {
                                        location.href = '/finalizarSesion'
                                    }, 14000)
                                },
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    location.href = '/finalizarSesion'
                                }
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.href = '/finalizarSesion'
                                }
                            })
                            //location.href = '/finalizarSesion'
                            //alert("Su sesión ha finalizado por inactividad")
                        }
                    })
            }, milisegundos);
            let miData
            activarTooltip();
        });
        d.addEventListener("click", async (e) => {
            if (e.target.matches(".handle_active_layout")) {
                $("#messageModal").modal("hide")
                let layout = e.target.dataset.layout
                d.querySelectorAll('#App table').forEach(x=>{
                    localStorage.setItem("activeLayout",layout)
                    if (x.id==layout) {
                        x.classList.remove("d-none")
                    }else{
                        x.classList.add("d-none")
                    }
                })
                let area_tp = d.querySelector("#cat_user_ubicacion_menu a.active");
                    area_tp.click();
                    //console.log(layout)
            }
            if (e.target.matches(".btn-layout-options")) {
                layoutOptions()
            }
            if (e.target.matches(".marquee-search-paciente")) {
                activeLayout = localStorage.getItem("activeLayout")
                activeArea = localStorage.getItem("activeArea")
                loadingScreen.classList.remove("d-none")
                //var table = document.getElementById("tablapacientes").tBodies[0];
                let {user_id_paciente,paciente_nombre} = e.target.dataset

                //console.log(user_id_paciente)
                d.querySelector(`#${activeLayout} .row_pacientes`).innerHTML = null
                let pacientes =  pacientes_datos.filter(paciente=>
                                    equalsInt(paciente['user_id'],user_id_paciente)
                                )
                    //console.log(pacientes)
                    if (pacientes.length > 0) {
                        //console.log('activeLayout',activeLayout);
                        pacientes.forEach(paciente => {
                            switch (activeLayout) {
                                case 'tablapacientesDiagnosticos':table_rowDiagnostico(paciente); break;
                                case 'tablapacientesSignosVitales':table_rowSignosVitales(paciente);break;
                            }
                        })
                        d.querySelectorAll('#App table').forEach(x=>{
                            if (x.id==activeLayout) {
                                x.classList.remove("d-none")
                            }else{
                                x.classList.add("d-none")
                            }
                        })
                        activarTippyTooltip()
                    }


                    loadingScreen.classList.add("d-none")



            }


            if (e.target.matches(".menuPAD")) {
                UserCuestPad.menuPad(".modal-body")
            }
            if (e.target.matches(".menu-pad")) {

                  /* $("#messageModal").modal("hide")
                activeArea = e.target.dataset.area
                localStorage.setItem("activeArea",activeArea)

                activeLayout = localStorage.getItem("activeLayout")

                miData = e.target;
                setTimeout((e) => {
                let pacientes
                    let dataset = miData.dataset
                    //console.log(dataset);
                    //PAD ID
                    let pad_id = {
                            emergencia:{
                                cat_user_ubicacion_id:[224,225,226,227,228,229],
                                parent_cat_user_ubicacion_id:[224],

                            },

                            medico:{
                                cat_user_ubicacion_id:[379,380,381,382,383,384],
                                parent_cat_user_ubicacion_id:[379],

                            },
                            quirurgico:{
                                cat_user_ubicacion_id:[372,373,374,375,376,377],
                                parent_cat_user_ubicacion_id:[372],

                            },
                            getFilters(pad){
                                //console.log(this[ pad ].cat_user_ubicacion_id ) ;
                                //console.log( pacientes_datos.filter( x => this[ pad ].cat_user_ubicacion_id.includes( Number(x.cat_user_ubicacion_id) )  ) ) ;
                                let model = {}
                                    model['all'] = pacientes_datos.filter( x => this[ pad ].cat_user_ubicacion_id.includes( Number(x.cat_user_ubicacion_id) )  )
                                    model['adulto'] = model['all'].filter(x => x.edad >= 18 )
                                    model['pediatrico'] = model['all'].filter(x => x.edad < 18 )

                                    return model
                            },
                        }

                    let temp_pacientes = pad_id.getFilters( dataset.pad )
                    //console.log(temp_pacientes);
                     //   console.log(dataset.individuo);

                        if ( ["adulto","pediatrico"].includes( dataset.individuo ) ) {
                            temp_pacientes = temp_pacientes[ dataset.individuo ]
                        }else{
                            temp_pacientes = temp_pacientes[ 'all' ]
                        }

                       // console.log(temp_pacientes);



                    d.querySelector(`#${activeLayout} .row_pacientes`).innerHTML = null

                    pacientes = temp_pacientes

                    if (pacientes.length > 0) {

                        pacientes.forEach(paciente => {
                            switch (activeLayout) {
                                case 'tablapacientesDiagnosticos':table_rowDiagnostico(paciente); break;
                                case 'tablapacientesSignosVitales':table_rowSignosVitales(paciente);break;
                            }
                        })

                        d.querySelectorAll('#App table').forEach(x=>{
                            if (x.id==activeLayout) {
                                x.classList.remove("d-none")
                            }else{
                                x.classList.add("d-none")
                            }
                        })

                        activarTippyTooltip()
                        activarTooltip()
                    }
                let titleArea = miData.dataset.title
                    document.getElementById('titleArea').textContent = titleArea
                    loadingScreen.classList.add("d-none")
                    filtroPacientesTabla(activeLayout)
                }, 200); */
            }
            if (e.target.matches(".evolucion-sv-temp")) {
                UserCuestTemperatura.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-fc")) {
                UserCuestFc.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-fr")) {
                UserCuestFr.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-ta")) {
                UserCuestTa.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-gl")) {
                UserCuestGl.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-spo2")) {
                UserCuestOximetria.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-oxigenoterapia")) {
                UserCuestOxigenoterapia.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-sintoma")) {
                UserCuestSintoma.index('.modal-body', e.target.dataset['user_id'])
            }
            if (e.target.matches(".evolucion-sv-tac")) {
                UserCuestTac.index('.modal-body', e.target.dataset['user_id'])
            }
            /* if (e.target.matches(".btn-menu-reubicacion")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']

            } */
            if (e.target.matches(".btn-alert")) {
                let model = new UserCuestAlert({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.create()
            }
            if (e.target.matches(".btn-resbalar")) {
                let model = new UserCuestResbalar({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.create()
            }
            if (e.target.matches(".btn-cirugia")) {
                //console.log(e.currentTarget)
                let model = new UserCuestRiesgoQuirurgico({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.create()
            }
            if (e.target.matches(".btn-vip")) {
                let model = new UserVIP({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.create()
            }
            if (e.target.matches("#submit_vip")) {
                let model = new UserVIP({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.store()
            }
            if (e.target.matches("#submit_alert")) {
                let model = new UserCuestAlert({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.store()
            }
            if (e.target.matches("#submit_resbalar")) {
                let model = new UserCuestResbalar({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.store()
            }
            if (e.target.matches("#submit_cirugia")) {
                let model = new UserCuestRiesgoQuirurgico({
                    "value": e.target.dataset['value'],
                    "episodio_id": e.target.dataset['episodio_id'],
                    "user_id_paciente": e.target.dataset['user_id_paciente']
                });
                model.store()
            }
            if (e.target.matches("#btn_paciente_create")) {
                /* let model = new UserCuestPaciente({});
                    model.searchCreate() */
                    let model = new MenuIngresoPaciente();
                        model.handle_ingresoPaciente()

            }
            if (e.target.matches(".info-paciente")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestPaciente({
                        user_id,
                        episodio_id
                    })
                    model.edit()
                //UserCuestPaciente.edit('.modal-body', e.target.dataset['user_id_paciente'])
            }
            if (e.target.matches(".info-familiar")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestPaciente({
                        user_id,
                        episodio_id
                    })
                    model.edit_familiar_info()
                //UserCuestPaciente.edit('.modal-body', e.target.dataset['user_id_paciente'])
            }
            if (e.target.matches(".info-paciente-administrative")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestPaciente({
                        user_id,
                        episodio_id
                    })
                    model.edit_administrative_info()
            }
            if (e.target.matches(".historia-ingreso")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestHistoria({
                        user_id,
                        episodio_id
                    })
                    model.indexHistoriaPreliminarIngreso()

            }
            if (e.target.matches(".informe-preliminar-emergencia")) {
                UserCuestHistoria.indexHistoria({
                    user_id: e.target.dataset['user_id_paciente'],
                    episodio_id: e.target.dataset['episodio_id']
                })
            }
            if (e.target.matches(".historia-episodio-anteriores")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestEpisodio({
                        user_id,
                        episodio_id
                    })
                    model.historialEpisodios()
               /*  UserCuestEpisodio.historialEpisodios({
                    user_id: e.target.dataset['user_id_paciente']
                }) */
            }
            if (e.target.matches(".evolucion-paciente")) {
                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestHistoria({
                        user_id,
                        episodio_id
                    })
                    model.index()
            }
            if (e.target.matches(".pendientes-paciente")) {
                let user_id = e.target.dataset['user_id_paciente']
                let model = new UserCuestPendiente({user_id})
                    model.index()
            }
            if (e.target.matches(".chat-whatsapp-paciente")) {


                let user_id = e.target.dataset['user_id_paciente']
                let episodio_id = e.target.dataset['episodio_id']
                let model = new UserCuestChat({
                        user_id,
                        episodio_id
                    })
                    model.index()

            }
            if (e.target.matches(".add-prealta")) {
                UserCuestEpisodio.addPrealta(e.target.dataset['user_id_paciente'])
            }
            if (e.target.matches(".btn-ubicacion-paciente")) {
                UserCuestUbicacion.historialUbiEpisodio('.modal-body', e.target.dataset['user_id_paciente'])
            }
            if (e.target.matches(".store-signos-vitales-table")) {

                let episodio_id = e.target.dataset.episodio_id
                let user_id = e.target.dataset.user_id

                let loading = () => {
                    return `
                        <div class="scale-up-hor-left d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    `
                }
                let store = async (that) => {
                    let result = that.model.store3(episodio_id,user_id, that.value)
                    result.then(x => {
                        let index = pacientes_datos.findIndex(x => equalsInt(x.user_id,
                            user_id))
                        pacientes_datos[index][that.signo] = that.value
                        d.querySelector(`.actual_${that.signo}_value_${user_id}`).innerHTML =
                            that.model.columnaValor(that.value)
                    })
                }
                let values = [{
                        model: UserCuestTemperatura,
                        signo: 'temp',
                        value: "",
                    },
                    {
                        model: UserCuestFc,
                        signo: 'fc',
                        value: "",
                    },
                    {
                        model: UserCuestFr,
                        signo: 'fr',
                        value: "",
                    },
                    {
                        model: UserCuestTa,
                        signo: 'ta',
                        value1: "",
                        value2: "",
                    },
                    {
                        model: UserCuestGl,
                        signo: 'gl',
                        value: "",
                    },
                    {
                        model: UserCuestOximetria,
                        signo: 'oxi',
                        value: "",
                    },

                ]
                //tooltip-input-user_ta
                for (const key in values) {
                    if (!['ta'].includes(values[key].signo)) {
                        let signo_valor = d.querySelector(`.tooltip-input-user_${values[key].signo}_${user_id}`)
                        //alert(signo_valor.value)
                            if (!is_empty(signo_valor.value)) {

                                d.querySelector(`.actual_${values[key].signo}_value_${user_id}`).innerHTML = loading()

                                values[key].value = signo_valor.value

                                store(values[key])

                                signo_valor.value = ""
                            }


                    } else {
                        let signo_valor1 = d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}_${user_id}`)
                        let signo_valor2 = d.querySelector(`.user_ta_dia.tooltip-input-user_${values[key].signo}_${user_id}`)

                        if (!is_empty(signo_valor1.value) && !is_empty(signo_valor2.value)) {

                            d.querySelector(`.actual_${values[key].signo}_value_${user_id}`).innerHTML = loading()

                            values[key].value1 = signo_valor1.value
                            values[key].value2 = signo_valor2.value

                            let that = values[key]
                            let result = that.model.store3(episodio_id,user_id, that.value1, that.value2)
                                result.then(x => {
                                    let index = pacientes_datos.findIndex(x => equalsInt(x.user_id,user_id))
                                    pacientes_datos[index][that.signo] = that.value1 + "/" + that.value2

                                    d.querySelector(`.actual_${values[key].signo}_value_${user_id}`).innerHTML =
                                        that.model.columnaValor(that.value1 + "/" + that.value2)

                                    d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}_${user_id}`).value = ""
                                    d.querySelector(`.user_ta_dia.tooltip-input-user_${values[key].signo}_${user_id}`).value = ""
                                })
                        }
                    }
                }

            }
            if (e.target.matches(".store-signos-vitales")) {
                let user_id = e.target.dataset.user_id
                let loading = () => {
                    return `
                        <div class="scale-up-hor-left d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    `
                }
                let store = async (that) => {
                    let result = that.model.store3(user_id, that.value)
                    result.then(x => {
                        let index = pacientes_datos.findIndex(x => equalsInt(x.user_id,
                            user_id))
                        pacientes_datos[index][that.signo] = that.value
                        d.querySelector(`.actual_${that.signo}_value_${user_id}`).innerHTML =
                            that.model.columnaValor(that.value)
                    })
                }
                let values = [
                    {
                        model: UserCuestTemperatura,
                        signo: 'temp',
                        value: "",
                    },
                     {
                        model: UserCuestFc,
                        signo: 'fc',
                        value: "",
                    },
                    {
                        model: UserCuestFr,
                        signo: 'fr',
                        value: "",
                    },
                    {
                        model: UserCuestTa,
                        signo: 'ta',
                        value1: "",
                        value2: "",
                    },
                    {
                        model: UserCuestGl,
                        signo: 'gl',
                        value: "",
                    },
                    {
                        model: UserCuestOximetria,
                        signo: 'oxi',
                        value: "",
                    },

                ]
                //tooltip-input-user_ta
                for (const key in values) {
                    if (!['ta'].includes(values[key].signo)) {
                        let signo_valor = d.querySelector(`.tooltip-input-user_${values[key].signo}`)

                        if (!is_empty(signo_valor.value)) {

                            d.querySelector(`.actual_${values[key].signo}_value_${user_id}`).innerHTML = loading()

                            values[key].value = signo_valor.value

                            store(values[key])

                            signo_valor.value = ""
                        }


                    } else {

                        let signo_valor1 = d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}`)
                        let signo_valor2 = d.querySelector(`.user_ta_dia.tooltip-input-user_${values[key].signo}`)

                        if (!is_empty(signo_valor1.value) && !is_empty(signo_valor2.value)) {

                            d.querySelector(`.actual_${values[key].signo}_value_${user_id}`).innerHTML = loading()

                            values[key].value1 = signo_valor1.value
                            values[key].value2 = signo_valor2.value

                            let that = values[key]
                            let result = that.model.store3(user_id, that.value1, that.value2)
                                result.then(x => {
                                    let index = pacientes_datos.findIndex(x => equalsInt(x.user_id,user_id))
                                    pacientes_datos[index][that.signo] = that.value1 + "/" + that.value2

                                    d.querySelector(`.actual_${values[key].signo}_value_${user_id}`).innerHTML =
                                        that.model.columnaValor(that.value1 + "/" + that.value2)

                                    d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}`).value = ""
                                    d.querySelector(`.user_ta_dia.tooltip-input-user_${values[key].signo}`).value = ""
                                })
                        }


                        /* let signo_valor1 = d.querySelector(
                            `.user_ta_sis.tooltip-input-user_${values[key].signo}`).value
                        let signo_valor2 = d.querySelector(
                            `.user_ta_dia.tooltip-input-user_${values[key].signo}`).value

                        if (!is_empty(signo_valor1) && !is_empty(signo_valor2)) {

                            d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}`).innerHTML =
                                loading()
                            values[key].value1 = signo_valor1
                            values[key].value2 = signo_valor2

                            let that = values[key]
                            let result = that.model.store3(user_id, that.value1, that.value2)
                            result.then(x => {
                                let index = pacientes_datos.findIndex(x => equalsInt(x.user_id,
                                    user_id))
                                pacientes_datos[index][that.signo] = that.value1 + "/" + that.value2
                                d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}`).innerHTML =
                                    that.model.columnaValor(that.value1 + "/" + that.value2)

                                d.querySelector(`.user_ta_sis.tooltip-input-user_${values[key].signo}`)
                                    .value = ""
                                d.querySelector(`.user_ta_dia.tooltip-input-user_${values[key].signo}`)
                                    .value = ""
                            })
                        } */

                    }
                }

            }
        })
    </script>
@endsection
@section('css')
    <style>
        .valign-center{
            vertical-align: middle !important;
        }
        .loadingScreen {
            background-color: rgb(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;

            position: fixed;
            z-index: 1111111111111111;
            height: 100vh;
            width: 100%;
        }

        .header-signos-vitales {
            background-color: #e7e4e4 !important;
            color: rgba(24, 91, 169, 1) !important;
            text-align: center;
            text-transform: uppercase;
            border: 0px !important;
        }

        .spinner-border,
        .spinner-border+h4 {
            color: white !important;
            margin: 0 !important;
        }

        .table-striped-columns tbody td:nth-of-type(odd),
        .table-striped-columns thead th:nth-of-type(odd) {
            background: rgb(243, 243, 243);
        }

        /*         // Extra small devices (portrait phones, less than 576px)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // No media query for `xs` since this is the default in Bootstrap */
        .impresion-diagnostica-width {
            width: 100vw;
            /* white-space: pre-line; */
        }

        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {
            .impresion-diagnostica-width {
                width: 50vw;
            }
        }

        /* // Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) {}

        /* // Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {}

        /* // Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .impresion-diagnostica-width {
                width: auto;
            }
        }

        .header-1 {
            position: sticky;
            top: -1px;
            background-color: var(--light) !important;
            color: rgba(24, 91, 169, 1) !important;
            text-align: center;
            z-index: 3;
        }

        .header-2 {
            position: sticky;
            top: 29px;
            background-color: #e7e4e4 !important;
            color: rgba(24, 91, 169, 1) !important;
            text-align: center;
            z-index: 2;
        }

        .table-hover>tbody>tr:hover {
            --bs-table-accent-bg: var(--bs-table-hover-bg);
            color: var(--bs-table-hover-color);
            box-shadow: 3px -1px 17px 3px rgba(25, 135, 84, 0.74);
            -webkit-box-shadow: 3px -1px 17px 3px rgba(25, 135, 84, 0.5);
            -moz-box-shadow: 3px -1px 17px 3px rgba(25, 135, 84, 0.74);
        }

        .h-vh-100 {
            height: 100vh;
        }

        .text-shadow-drop-center {
            -webkit-animation: text-shadow-drop-center 1s infinite both;
            animation: text-shadow-drop-center 1s infinite both
        }

        @-webkit-keyframes text-shadow-drop-center {
            0% {
                text-shadow: 0 0 0 transparent
            }

            100% {
                text-shadow: 0 0 18px rgba(0, 0, 0, .35)
            }
        }

        @keyframes text-shadow-drop-center {
            0% {
                text-shadow: 0 0 0 transparent
            }

            100% {
                text-shadow: 0 0 18px rgba(0, 0, 0, .35)
            }
        }

        .swing-in-top-fwd {
            -webkit-animation: swing-in-top-fwd 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: swing-in-top-fwd 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        @-webkit-keyframes swing-in-top-fwd {
            0% {
                -webkit-transform: rotateX(-100deg);
                transform: rotateX(-100deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 1;
            }
        }

        @keyframes swing-in-top-fwd {
            0% {
                -webkit-transform: rotateX(-100deg);
                transform: rotateX(-100deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                -webkit-transform-origin: top;
                transform-origin: top;
                opacity: 1;
            }
        }

        .pulsate-bck:hover {
            -webkit-animation: pulsate-bck 0.5s ease-in-out infinite both;
            animation: pulsate-bck 0.5s ease-in-out infinite both;
        }

        @-webkit-keyframes pulsate-bck {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }

            50% {
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes pulsate-bck {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }

            50% {
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        .heartbeat_infinity {
            -webkit-animation: heartbeat2 1.5s ease-in-out infinite both;
            animation: heartbeat2 1.5s ease-in-out infinite both
        }

        @-webkit-keyframes heartbeat2 {
            from {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: center center;
                transform-origin: center center;
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            10% {
                -webkit-transform: scale(.91);
                transform: scale(.91);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            17% {
                -webkit-transform: scale(.98);
                transform: scale(.98);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            33% {
                -webkit-transform: scale(.87);
                transform: scale(.87);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            45% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }
        }

        @keyframes heartbeat2 {
            from {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: center center;
                transform-origin: center center;
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            10% {
                -webkit-transform: scale(.91);
                transform: scale(.91);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            17% {
                -webkit-transform: scale(.98);
                transform: scale(.98);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }

            33% {
                -webkit-transform: scale(.87);
                transform: scale(.87);
                -webkit-animation-timing-function: ease-in;
                animation-timing-function: ease-in
            }

            45% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-animation-timing-function: ease-out;
                animation-timing-function: ease-out
            }
        }

        .prealta {

            -webkit-animation: mymove 2s infinite;
            /* Chrome, Safari, Opera */
            animation: mymove 2s infinite;
        }

        /* Chrome, Safari, Opera */
        @-webkit-keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        /* Standard syntax */
        @keyframes mymove {
            from {
                background-color: #e7e8e8b3;
                color: var(--color-esperanza-light)
            }

            to {
                background-color: white;
                color: var(--color-custom-primary)
            }
        }

        #menu-pad>.nav-pills .nav-link.active,
        #menu-pad>.nav-pills .nav-link.active i,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--primary);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--success);
        }

        #menu-pad>.badge-gray {
            background-color: var(--white) !important;
        }

        #menu-pad.bg-light,
        .bg-light>a {
            color: var(--primary) !important;
        }

        .datepicker table tr td.active.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled.disabled,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active.disabled:hover.active,
        .datepicker table tr td.active.disabled:hover.disabled,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.disabled:hover:hover,
        .datepicker table tr td.active.disabled:hover[disabled],
        .datepicker table tr td.active.disabled[disabled],
        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active:hover.disabled,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active:hover:hover,
        .datepicker table tr td.active:hover[disabled],
        .datepicker table tr td.active[disabled] {
            background-color: var(--primary) !important;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -ms-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(var(--primary)), to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: -o-linear-gradient(to bottom, var(--primary), var(--primary));
            background-image: linear-gradient(to bottom, var(--primary), var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }

        .next,
        .prev,
        .datepicker-switch,
        .dow {
            color: var(--primary) !important;
        }

        .datepicker-inline {
            width: 100%;
        }
        .medico-badge-width {
            width:2em;
        }
        .col-listado-paciente-height{
            height: 50vh;
        }
        body{
            background-color: #F6F8FC !important;
        }
        #doctorsListMiniMenu .list-group-item,
        #doctorsListMini .list-group-item,
        #doctorsList .list-group-item {
            position: relative;
            display: block;
            padding: 0.75rem 1.25rem;
            background-color: transparent;
        }
        #doctorsListMiniMenu .list-group-item.active,
        #doctorsListMini .list-group-item.active,
        #doctorsList .list-group-item.active {
            z-index: 2;
            color: #414549;
            font-weight: 600 !important;
            background-color: #e4e5e6;
            border-color: transparent;
        }
        #doctorsListMiniMenu .list-group-item:hover,
        #doctorsListMini .list-group-item:hover,
        #doctorsList .list-group-item:hover {
        background-color: gray;
        color:white;
        }
        .modal-container {
        display: flex;
        flex-direction: column;
        padding:1rem;
        }
        .container-textarea {
            display: flex;
            flex-direction: column;
           /*  padding:1rem; */
        }
        .container-textarea textarea {
            border-radius:10px;
            height: 100%;
            border:1px solid rgb(233, 233, 233);
            background-color: rgb(233, 233, 233);
            width: 100%;
            /* resize: none; */
            box-sizing: border-box;
            padding: 10px;

        }
        .modal-body .card-title {
            float: left;
            font-size: 80%;
            font-weight: 400;
            margin: 0;
        }
        #template_historia_medica .column-1,
        #template_historia_medica .column-2{
            overflow: auto;
            border-radius:1.5rem;
        }
        #template_historia_medica .column-1{
            background-color:#ebebeb;
            overflow: auto;
        }
        #template_historia_medica .column-2{
            background-color: rgb(255 255 255 / 50%);
        }
        #template_historia_medica .column-height{
            height:100vh;
            overflow:auto;
        }
        #template_historia_medica .nav-pills .nav-link.active .badge-primary {
            color: var(--primary) ;
            background-color: #ffffff;
        }
        #template_historia_medica .nav-pills .nav-link.active,
        #template_historia_medica .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--primary);
        }

        .cintillo-alto{
            height: 100%;
        }

        /* #template_historia_medica .column-1 a.focus{
            background-color: var(--primary);
            color:white;
            border-radius: 10px;
        }
        #template_historia_medica .column-1 a:hover{
            background-color: var(--gray);
            color:var(--primary);
            border-radius: 10px;
        } */
        @media (max-width: 575px) {
            .flex-fill-custom{
                flex: 1 1 auto !important;
            }
            #myTabContentCintilloModal #paciente .nombre-paciente h3, .h3 {
                font-size: 1.1rem;
                margin-bottom: 0;
            }
            #myTabContentCintilloModal #paciente .form-control-sm {
                /* height: calc(1.5rem + 2px); */
                padding: 0.15rem;
                font-size: 1.06rem;
                line-height: 1.5;
                border-radius: 0.2rem;
                text-align: center;
            }
            .timeline>div>.timeline-item {
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
                border-radius: 0.25rem;
                background: #ffffff;
                color: #495057;
                margin-left: 0px;
                margin-right: 0px;
                margin-top: 0;
                padding: 0;
                position: relative;
            }
            .timeline>div>.fa, .timeline>div>.fas, .timeline>div>.far, .timeline>div>.fab, .timeline>div>.glyphicon, .timeline>div>.ion {
                display: none;
            }

        }
        .box-container-height {
            height: 90vh;
        }
        .box-container-height textarea {
        background-color: rgb(237, 237, 237);

        }
        .mailbox-attachments li {
        border: 1px solid #eee;
        float: left;
        padding:0.5rem;
        border-radius: 5px;
        margin-right: 10px;
        width: 200px;
        }
        .mailbox-attachments {
        padding-left: 0;
        list-style: none;
        }
        .mailbox-attachment-info {
        background-color: #f8f9fa;
        padding: 10px;
        }
        .mailbox-attachment-icon.has-img img {
        height: 132.5px !important;
        }
        .mailbox-attachment-icon {
        color: #666;
        font-size: 65px;
        max-height: 132.5px;
        text-align: center;
        padding: 0px;
        }

        .mailbox-attachment-name {
        color: #666;
        font-weight: 700;
        display: -webkit-box;
        /* Establece el tipo de display como box */
        -webkit-box-orient: vertical;
        /* Establece la orientación vertical de las cajas */
        overflow: hidden;
        /* Oculta el contenido que excede el contenedor */
        -webkit-line-clamp: 2;
        /* Limita el número de líneas a mostrar */
        text-overflow: ellipsis;
        /* Agrega los puntos suspensivos */
        }
        #pills-buscador-paciente-tab:not(.active),
        #pills-nuevo-paciente-tab:not(.active){
            color: var(--success) !important;
            background-color: #ededed;
        }
        .box-container-height-2 {
            height: 92vh;
        }
        #modal_table_paciente_search th,
        #modal_table_paciente_search td {
            vertical-align: middle; /* Puedes usar otros valores como top, bottom, etc. */
        }
        #buscar_por a:focus {
            background-color: var(--primary) !important;
            color: white !important;
        }
        .text-warning-enfermeria{
            color: #c19205 !important;
        }
        .img-doctor{
            width:25px;
            height:25px;
            border-radius:50px;
        }
        .card-medic-team-active{
            line-height: 1;
        }
        .card-medic-team-title{
            font-size:0.8rem;
        }
        .modal-loading{
            height: 100%;
            width: 100%;
            background-color: rgb(52 58 64 / 50%);
            position: absolute;
            left: 0;
            z-index: 1111111111111111;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
            font-size:1.5rem;
            color:white;
            text-shadow: 2px 1px #434343;
        }
        @media (min-width: 576px) {
            .cintillo-alto{
                height: 190px;
            }
        }
        /* // Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) {}

        /* // Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {}

        /* // Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {

        }

    </style>
    <style>

        .card-menu {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            border-radius: 15px;
            padding: 1rem;
            color: var(--secondary);
            text-align: center;
            overflow: hidden;
            background-color:white;

        }

        .card-menu .card-title {
            font-size: 1.5rem;

        }

        .card-menu:hover {
            background-color: var(--primary);
            color: white;
            animation: fade-in 1s;
            cursor: pointer;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card-menu footer {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: gray;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            border-radius: 50px;
            padding: 0.1rem 1rem;
            color: white !important;
            font-weight: 500;
        }

        .card-menu footer.hide {
            visibility: hidden;
        }

        .card-menu h1,
        .card-menu h3,
        .card-menu p,
            {
            margin-bottom: 0 !important;
        }

        .card-menu p {
            text-align: center;
        }

        .content-max-height {
            max-height: 200px;
            overflow: hidden;
        }

        .readMoreBtn,
        .readLessBtn {
            display: none;
        }

        .readMoreBtn.show,
        .readLessBtn.show {
            display: inline-block;
        }
        .scale-out-ver-top{-webkit-animation:scale-out-ver-top .5s cubic-bezier(.55,.085,.68,.53) both;animation:scale-out-ver-top .5s cubic-bezier(.55,.085,.68,.53) both}
        @-webkit-keyframes scale-out-ver-top{0%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}@keyframes scale-out-ver-top{0%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}
        .scale-in-ver-top{-webkit-animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both;animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both}
        @-webkit-keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}@keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}
        @media (max-width: 575px) {
            .title-ubi{
                font-size:1.2rem;
            }
            .card-menu {
                min-height: 150px !important;
            }

        }
        @media (min-width: 576px) {
           .card-menu {
                height: 200px !important;
            }

        }


        @media (min-width: 768px) {
            .title-ubi{
                font-size:1.8rem;
            }
        }


        @media (min-width: 992px) {}

        @media (min-width: 1200px) {}
    </style>
@endsection
