<!DOCTYPE html>
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <!-- INICIO LIMPIAR CACHE -->
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <!-- FIN LIMPIAR CACHE -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <meta name="theme-color" content="#185BA9">
        <meta name="MobiledObtimized" content="width">
        <meta name="HandheldFriendly" content="true">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">


        <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css">
        <link rel="apple-touch-startup-image" href="{{asset('/image/system/favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/image/system/favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/image/system/favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/image/system/favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/image/system/favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/image/system/favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/image/system/favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/image/system/favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/image/system/favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/image/system/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/image/system/favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/image/system/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/image/system/favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/image/system/favicon/favicon-16x16.png')}}">
        <link rel="stylesheet" href="https://icdcdn.who.int/embeddedct/icd11ect-1.3.css">
        <link rel="manifest" href="{{asset('/manifest.json')}}">
        <meta name="msapplication-TileColor" content="{{asset('#ffffff')}}">
        <meta name="msapplication-TileImage" content="{{asset('/ms-icon-144x144.png')}}">

        <title>
            @yield('title')
        </title>

        <!-- Font Awesome Icons -->

        <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/dist/css/adminlte.css')}}">
        <link href="/css/scale.css" rel="stylesheet"/>
        <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">

        <link rel="stylesheet" href="{{asset('image/system/icomoon/style.css')}}">
        <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
        <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            :root {
                --blue: var(--primary);
                --indigo: #6610f2;
                --purple: #6f42c1;
                --pink: #e83e8c;
                --red: #DC3545;
                --orange: #fd7e14;
                --yellow: #ffc107;
                --green: #28a745;
                --teal: #20c997;
                --cyan: #17a2b8;
                --white: #ffffff;
                --gray: #D9D9D9;
                --gray-dark: #343a40;
                --primary: #185BA9;
                --secondary: #6c757d;
                --success: #2FA600;
                --info: #00AAFF;
                --warning: #b18607;
                --danger: #dc3545;
                --light: #f8f9fa;
                --dark: #343a40;
                --parodis: #1DBA9B;
                --breakpoint-xs: 0;
                --breakpoint-sm: 576px;
                --breakpoint-md: 768px;
                --breakpoint-lg: 992px;
                --breakpoint-xl: 1200px;
            }
            a {
                color: var(--primary);
                text-decoration: none;
                background-color: transparent;
            }
            a:hover {
                color: #0056b3;
                text-decoration: none;
            }
            .btn-primary {
                color: #ffffff;
                background-color: var(--primary);
                border-color: var(--primary);
                box-shadow: none;
            }

            .btn-primary:hover {
                color: #ffffff;
                background-color: #0069d9;
                border-color: #0062cc;
            }

            .btn-primary:focus,
            .btn-primary.focus {
                color: #ffffff;
                background-color: var(--blue);
                border-color: var(--blue);
                box-shadow: none, 0 0 0 0 rgba(38, 143, 255, 0.5);
            }

            .btn-primary.disabled,
            .btn-primary:disabled {
                color: #ffffff;
                background-color: var(--primary);
                border-color: var(--primary);
            }

            .btn-primary:not(:disabled):not(.disabled):active,
            .btn-primary:not(:disabled):not(.disabled).active,
            .show>.btn-primary.dropdown-toggle {
                color: #ffffff;
                background-color: #0062cc;
                border-color: #005cbf;
            }

            .btn-primary:not(:disabled):not(.disabled):active:focus,
            .btn-primary:not(:disabled):not(.disabled).active:focus,
            .show>.btn-primary.dropdown-toggle:focus {
                box-shadow: 0 0 0 0 rgba(38, 143, 255, 0.5);
            }
            .btn-outline-primary {
                color: var(--primary);
                border-color: var(--primary);
            }

            .btn-outline-primary:hover {
                color: #ffffff;
                background-color: var(--primary);
                border-color: var(--primary);
            }

            .btn-outline-primary:focus,
            .btn-outline-primary.focus {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.5);
            }

            .btn-outline-primary.disabled,
            .btn-outline-primary:disabled {
                color: var(--primary);
                background-color: transparent;
            }

            .btn-outline-primary:not(:disabled):not(.disabled):active,
            .btn-outline-primary:not(:disabled):not(.disabled).active,
            .show>.btn-outline-primary.dropdown-toggle {
                color: #ffffff;
                background-color: var(--primary);
                border-color: var(--primary);
            }

            .btn-outline-primary:not(:disabled):not(.disabled):active:focus,
            .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
            .show>.btn-outline-primary.dropdown-toggle:focus {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.5);
            }
            .btn-link {
                font-weight: 400;
                color: var(--primary);
                text-decoration: none;
            }

            .btn-link:hover {
                color: #0056b3;
                text-decoration: none;
            }
            .dropdown-item.active,
            .dropdown-item:active {
                color: #ffffff;
                text-decoration: none;
                background-color: var(--primary);
            }
            .nav-pills .nav-link.active,
            .nav-pills .show>.nav-link {
                color: #ffffff;
                background-color: var(--primary);
            }
            .badge-primary {
                color: #ffffff;
                background-color: var(--primary);
            }

            a.badge-primary:hover,
            a.badge-primary:focus {
                color: #ffffff;
                background-color: #0062cc;
            }
            .list-group-item.active {
                z-index: 2;
                color: #ffffff;
                background-color: var(--primary);
                border-color: var(--primary);
            }
            .bg-primary {
                background-color: var(--primary) !important;
            }
            .text-primary{
                color:var(--primary) !important
            }
            .img-logo {
                height: 50px;
                width: 120px;
            }
            .loadingScreen {
                background-color: rgba(0, 0, 0, .5);
                display: flex
            ;
                flex-direction: column;
                justify-content: center;
                position: fixed;
                z-index: 1111111111111111;
                height: 100vh;
                width: 100%;
            }
        </style>
        <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
        @yield('css')
    </head>

    <body class="layout-top-nav sidebar-collapse">
        <div id="loadingScreen" class="loadingScreen d-none">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <img loading="lazy" onerror="this.src='/image/system/patient.svg'" src="/image/system/logo-cmdlt-blanco.svg" alt="Cmdlt" class="mb-3" style="width: 140px; height: 80px;">
                        <div class="d-flex align-items-center text-white justify-content-center">
                        <div role="status" class="spinner-border">
                            <span class="visually-hidden"></span>
                        </div>
                        <h4 class="pl-2">Por favor espere un momento...</h4>
                    </div>
                </div>
            </div>
        <div  id="app"  style="height: 100vh;overflow: auto;">
            <input type="hidden" id="_token" value="{{ csrf_token() }}">

            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="height: 90vh;">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <div class=" sticky-top">
                                <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                                    aria-label="Close" data-dismiss="modal"
                                    src="/image/system/logo-cmdlt-blanco.svg">
                                <i id="close_modal" data-dismiss="modal" aria-label="Close"
                                    class="fas fa-times text-white position-fixed zoom"
                                    style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- style="height: 80vh;" -->
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fullscreen-modal fade" id="fullscreen" style="z-index: 100000;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header p-0">
                            <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-between">
                                <i id="close_modal" data-dismiss="modal" aria-label="Close" class="fas fa-times text-white " style="font-size: 2em;margin-left:1%;cursor:pointer;" aria-hidden="true"></i>
                                <a class="navbar-brand" href="#"  data-dismiss="modal" aria-label="Close">
                                    <img src="/image/system/logo-cmdlt-blanco.svg" style="height: 3em !important;width: 120px;" alt="Image logo system"
                                        loading="lazy">
                                </a>
                            </nav>
                            <div id="modal-header-info-user">

                            </div>

                        </div>
                        <div class="modal-body-2 fullscreen" style="overflow: auto !important;">

                        </div>

                        <div class="modal-footer fullscreen justify-content-center">

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal fullscreen-modal fade" id="modal-patient-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header p-0">
                            <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-between">
                                <i id="close_modal" data-dismiss="modal" aria-label="Close" class="fas fa-times text-white heartbeat" style="font-size: 2em;margin-left:2%;cursor:pointer;" aria-hidden="true"></i>
                                <a class="navbar-brand" href="#"  data-dismiss="modal" aria-label="Close">
                                    <img src="/image/system/logo-cmdlt-blanco.svg" style="height: 3em !important;width: 120px;" alt="Image logo system"
                                        loading="lazy">
                                </a>
                            </nav>
                            <nav class="navbar navbar-light shadow-sm bg-light">
                                <div class="container-fluid">
                                    <div class="row flex-nowrap overflow-auto w-100 secondary">
                                        <div class="col-xl-3">

                                            <div class="d-flex flex-column">
                                                <div class="d-flex cursor-pointer btn-default align-items-center border-bottom" data-toggle="collapse"
                                                    data-target=".navbarSupportedContent" aria-controls="navbarSupportedContent"
                                                    aria-expanded="false" aria-label="Toggle navigation">
                                                    <div>
                                                        <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                                            src="/image/system/patient.svg" style="width:1.5cm;height:1.5cm"
                                                            data-tippy-content="Imagen del paciente"
                                                            id="cintillo-user-imagen"
                                                            class=" my-1 tooltip-primary border border-primary rounded-circle mx-auto d-block"
                                                            alt="Imagen Paciente">
                                                    </div>
                                                    <div>
                                                        <div class="overflow-hidden pl-1">
                                                            <h4 data-tippy-content="Nombre del paciente"
                                                                id="cintillo-user-fullname"
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
                                                            <div id="cintillo-user-cedula" class="text-gray text-nowrap">
                                                                V-00.000.000
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div data-tippy-content="Edad"
                                                            class="px-2 tooltip-primary text-center border-left border-right">
                                                            <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                                            <div id="cintillo-user-edad" class="text-gray">
                                                                00
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="px-2 tooltip-primary text-center" data-tippy-content="Sexo">
                                                            <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                                            <div id="cintillo-user-sexo" class="text-gray">
                                                                N/I
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="col-xl-2">
                                            <ul class="navbar-nav w-100">
                                                <li class="nav-item w-100">
                                                    <ul class="list-group">
                                                        <li class="list-group-item text-center p-1">
                                                            <b class="text-primary" style="font-size:0.8em;">Fecha ingreso</b>
                                                            <div class="text-center overflow-hidden">
                                                                <input id="cintillo-user-fecha-episodio" type="date" class="border-transparent">
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item text-center p-1">

                                                            <b class="text-primary" style="font-size:0.8em;">Ubicación Actual <span id="cintillo-user-total-dias-hospitalizacion" class="badge badge-gray text-primary">0</span></b>
                                                            <div id="cintillo-user-ubicacion-actual" class="text-center">
                                                                No Indicado
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item text-center p-1">

                                                            <b class="text-primary" style="font-size:0.8em;">Teléfono Contacto</b>
                                                            <div class="text-center">
                                                                <a id="cintillo-user-telefono-link" target="_blank" href="#" style="line-height: 1.4;" class="btn btn-default btn-block border-0">
                                                                    <i class="fab fa-whatsapp text-success"></i> <span id="cintillo-user-telefono">#</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                            <ul class="nav nav-pills justify-content-md-center  justify-content-lg-end w-100" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link py-1 text-primary" id="impresion_diagnostica-tab" data-toggle="tab" href="#impresion_diagnostica" role="tab" aria-controls="impresion_diagnostica" aria-selected="true">Prob. Diag.</a>
                                                </li>

                                            </ul>
                                            <div class="tab-content overflow-auto" id="myTabContent" style="max-height: 135px;">
                                                <div class="tab-pane fade show active" id="impresion_diagnostica" role="tabpanel" aria-labelledby="impresion_diagnostica-tab">
                                                    <ul class="list-group  list-group-flush">

                                                    </ul>

                                                </div>
                                                <div class="tab-pane fade" id="evolucion" role="tabpanel" aria-labelledby="evolucion-tab">
                                                    <ul class="list-group  list-group-flush">

                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <b class="text-center text-primary" style="font-size:0.8em;">Médicos</b>
                                                {{-- <table class="w-100 m-0 p-0">
                                                    <tbody id="user_medico_menu">
                                                        <tr style="border-bottom: 1px solid #efefef;">
                                                            <td id="lista_m1" class="p-0 pb-1" scope="row">

                                                            </td>
                                                        </tr>
                                                        <tr style="border-bottom: 1px solid #efefef;">
                                                            <td id="lista_m2" class="p-0 pb-1" scope="row">

                                                            </td>
                                                        </tr>
                                                        <tr style="border-bottom: 1px solid #efefef;">
                                                            <td id="lista_m3" class="p-0 pb-1" scope="row">

                                                            </td>
                                                        </tr>
                                                        <tr style="border-bottom: 1px solid #efefef;">
                                                            <td id="lista_m4" class="p-0 pb-1" scope="row">

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="lista_m5" class="p-0 pb-1" scope="row">

                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            <ul id="listado_medicos" class="list-group bg-transparent">

                                                <li class="list-group-item border-0 p-0">
                                                    <button class="btn mb-1 text-nowrap text-left btn-outline-success btn-block py-1 overflow-hidden"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-caret-left"></i> <i class="fas fa-user-md"></i> <span id="nombre_tratante">Tratantes</span>
                                                    </button>


                                                </li>
                                                <li class="list-group-item border-0 p-0">
                                                    <button class="btn mb-1 text-nowrap text-left btn-outline-info btn-block py-1 overflow-hidden"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-caret-left"></i> <i class="fas fa-user-md"></i> <span id="nombre_tratante">Interconsultante</span>
                                                    </button>
                                                </li>
                                                <li class="list-group-item border-0 p-0">
                                                    <button class="btn mb-1 text-nowrap text-left btn-outline-orange btn-block py-1 overflow-hidden"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-caret-left"></i> <i class="fas fa-user-md"></i> <span id="nombre_tratante">Fellow</span>
                                                    </button>

                                                </li>
                                                <li class="list-group-item border-0 p-0">
                                                    <button class="btn mb-1 text-nowrap text-left btn-outline-secondary btn-block py-1 overflow-hidden"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-caret-left"></i> <i class="fas fa-user-md"></i> <span id="nombre_tratante">Residentes</span>
                                                    </button>

                                                </li>
                                                <li class="list-group-item border-0 p-0">
                                                    <button class="btn mb-1 text-nowrap text-left btn-outline-purple btn-block py-1 overflow-hidden"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-caret-left"></i> <i class="fas fa-user-md"></i> <span id="nombre_tratante">RAMH</span>
                                                    </button>

                                                </li>

                                            </ul>

                                        </div>
                                    </div>

                                </div>
                            </nav>

                        </div>
                        <div class="modal-body-2 fullscreen" style="overflow: auto !important;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div>
                                    <h1 class="text-primary">
                                        Frecuencia respiratoria
                                    </h1>
                                </div>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <a class="nav-link active" id="pills-index-tab" data-toggle="pill" href="#pills-index" role="tab" aria-controls="pills-index" aria-selected="true">Historico</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <a class="nav-link" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab" aria-controls="pills-store" aria-selected="false">Añadir valor <i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </li>

                                  </ul>
                                  <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-index" role="tabpanel" aria-labelledby="pills-index-tab">
                                        <div style="height:32vh;overflow:auto">
                                            <table id="index_table" class="table table-bordered mb-3">
                                                <thead>
                                                    <tr>
                                                        <th class="text-primary text-center">Fecha</th>
                                                        <th class="text-primary text-center">Valor</th>
                                                        <th class="text-primary text-center">Observación</th>
                                                        <th class="text-primary text-center">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="filas">
                                                    <tr>
                                                        <td colspan="4" class="text-center text-primary">Sin registros</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">...</div>
                                  </div>





                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modal-patient-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content d-flex flex-column overflow-auto vh-100">
                        <div class="modal-header p-0">
                            <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                                <i id="close_modal" data-dismiss="modal" aria-label="Close" class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;" aria-hidden="true"></i>

                                <img class="img-logo m-1 d-block" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                            </nav>
                        </div>
                        <div class="modal-body-2 container-fluid  fullscreen d-flex flex-column overflow-auto">

                        </div>

                    </div>
                </div>
            </div>
            <!-- ModalMensajes -->
            <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-light">
                        <div class="modal-header">
                            <img src="/image/system/logo-cmdlt_color.svg" style="height: 3em;" class="img-fluid float-right"
                                alt="Imagen CMDLT">
                            <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                        </div>
                    </div>
                </div>
            </div>
            @yield('header')

            @yield('content')

            @yield('footer')
        </div>
        @include('templates.template')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('AdminLTE-3.0.5/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{--     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
 --}}
    <!-- AdminLTE App -->
    {{--
    <script src="{{asset('AdminLTE-3.0.5/dist/js/adminlte.min.js')}}"></script>--}}
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

    <!-- queryloader

    <script src="https://cdn.jsdelivr.net/jquery.queryloader2/3.2.2/jquery.queryloader2.min.js"></script>
    -->

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/tippy-bundle.umd.min.js')}}"></script>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="/js/summernote-ES.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
    <script src="{{asset('js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('js/chartjs-plugin-annotation.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
    <script src="/js/sweetalert2@10.js"></script>
    <link href="/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <script src="/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <!--
    <script src="/js/datatables-Spanish.json"></script> -->
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
    <script src="/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/plugin/intl-tel-input/build/js/intlTelInput.js"></script>
    <script src="/plugin/moment/moment.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js" integrity="sha512-tBzZQxySO5q5lqwLWfu8Q+o4VkTcRGOeQGVQ0ueJga4A1RKuzmAu5HXDOXLEjpbKyV7ow9ympVoa6wZLEzRzDg==" crossorigin="anonymous"></script>

    <script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
    <script src="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.es.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    @php
        //$version = session('APP_VERSION')  !== NULL ? session('APP_VERSION') : '0.0.0' ;
        //$random = rand(1, 100000);
    @endphp

    <script>
        /* $.fn.select2.defaults.set('language', 'es'); */
        /*inicio funciones y procedimientos*/

        /* function cargarPagina(ruta,contenedor,data){
            $(contenedor).html(`
                <div class="d-flex justify-content-center text-secondary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            `);
            var jqxhr = $.get( ruta, data, function() {
            })
            .done(function(pagina) {
                $(contenedor).html(pagina);
            })
            .fail(function() {
                alert( "Error en la función cargaPagina()" );
            })
            .always(function() {
                //alert( "finished" );
            });

            // Perform other work here ...
            // Set another completion function for the request above
            jqxhr.always(function() {
                //alert( "second finished" );
            });
        }


        function messaje(params) {
            $("#modelId div.modal-header").css("border-bottom","0px solid #e9ecef")
            $("#modelId div.modal-body").addClass("bg-primary")

            if (params == "cat_user_type-error") {
                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        No existe un tipo de usuario valido.<br>
                        Seleccione uno para continuar
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" href='/'>Aceptar</a>
                `;
            }
            if (params == "user-register-success") {
                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Cuenta creada exitosamente.<br>
                        Ingrese sus datos para autenticarse
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "user-register-no-found") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Cuenta no encontrada.<br>
                        Los datos ingresados no se encuentran registrados
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "user-register-error") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Cuenta no creada.<br>
                        Los datos ingresados no pudieron ser registrados
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "user-logout") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Su sesión ha finalizado

                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "paciente-register-no-found") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Por favor, complete el siguiente cuestionario,<br>
                        con la información sobre su estado de salud
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "medico-register-no-found") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Por favor, complete la siguiente información<br>
                        para iniciar su sesión
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "paciente-register-success") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        El paciente ha sido<br>
                        registrado de manera exitosa
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }
            if (params == "medico-register-new-paciente") {

                return `
                    <div class="p-1 mb-1 text-center h3 text-white">
                        Por favor, complete el siguiente cuestionario,<br>
                        con la información sobre el estado de salud del paciente
                    </div>
                    <br><a class='btn bg-light text-primary btn-flat btn-block' style="color:#185ba9!important;font-size:1.5em;" data-dismiss="modal" aria-label="Close">Aceptar</a>
                `;
            }

        } */







        $(document).ready(function () {
            /* $.extend( $.fn.dataTable.defaults, {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            } ); */
            /* //configuracion del plugin datatable

            //configuracion del plugin summernote
            $.extend($.summernote.options, {
                lang:'es-ES',
                 height: '10vh'
            });
            $.summernote.dom.emptyPara='';

            $('.dropdown-toggle').dropdown()
            $('[data-toggle="tooltip"]').tooltip()
            tippy('[data-tippy-content]', {
                theme: 'tooltip-cmdlt-primary',
                zIndex: 200000
            }) */
            //$("#modal-patient-item").modal("show")
            //UserCuestHistoria.indexHistoria({user_id:10})
            //UserCuestComorbilidad.create({selector:"#user_comorbility_create"})
            //UserCuestComorbilidad.index({selector:"#user_comorbility_index"})
            /*
            tippy('.ampliar', {
                content: 'Has click para ampliar/abrir',
                theme: 'tooltip-cmdlt-primary',
            });
            tippy('#close_modal', {
                content: 'Cerrar',
                theme: 'tooltip-cmdlt-primary',
            });*/
        });



    </script>

    <script src="/vue/vue.js"></script>

    <script src="{{ mix('js/app.js') }}"></script>
    {{-- <script src="/class_js/CatUserEspecialidad.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/CatUserEstado.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/CatUserMunicipio.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/CatUserUbicacion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/Component.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/User.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestAntecedente.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestAntg.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestChat.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestDireccion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestEstudioDiagnostico.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestEvolucion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestFc.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestFichaMedica.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestFotografia.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestFr.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestGl.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestHistoria.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestImagen.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestImpresionDiagnostica.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestIncidencia.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestInforme.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestLaboratorio.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestObservacion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestOtroArchivo.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestOxigenoterapia.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestOximetria.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPaciente.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPad.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPcr.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPdr.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPendiente.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPlan.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestPruebaCovid.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestRecipe.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestSintoma.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestTa.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestTac.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestTemperatura.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestUbicacion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestValoracion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestVinculoInstitucion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserEquipoSalud.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserEspecialidad.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserFamily.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserMedico.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserProfile.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserType.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestMedicoPaciente.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestComorbilidad.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestEpisodio.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestEgreso.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/SystemIncidencia.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserMedicoPosicion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserPostCovid.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserEncuesta.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserVIP.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserMedicoAgenda.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserProblemaSalud.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserEnfermedadActual.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserExamenFisico.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestOrdenMedica.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestAlert.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestResbalar.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestRiesgoQuirurgico.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/UserCuestAdministracion.js?version={{$version}}&force={{$random}}"></script>
    <script src="/class_js/MedicosPaciente.js?version={{$version}}&force={{$random}}"></script> --}}

    @yield('script')

</html>
