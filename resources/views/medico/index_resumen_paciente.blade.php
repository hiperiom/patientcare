@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal_v2')
@endsection
@section('menu_2')
<div class="container-fluid px-3 bg-light overflow-auto bg-gray" style="height:6vh">
    <div class="row">
        <div class="col-md-9">
            <nav  id="v-pills-tab" role="tablist" class="nav nav-pills overflow-auto flex-row flex-nowrap flex-sm-row font-weight-bold" role="tablist">
                <a id="area-tp" data-toggle="pill" data-area="" href="#area-01-tab" role="tab" aria-controls="area-01" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link active" href="#area-01">TP</a>
                <a id="area-ea" data-toggle="pill" data-area="ea" href="#area-02-tab" role="tab" aria-controls="area-02" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-02">EA</a>
                {{-- <a id="area-ecvd" data-toggle="pill" data-area="ecvd" href="#area-03-tab" role="tab" aria-controls="area-03" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-03">ECVD</a> --}}
                <a id="area-ep" data-toggle="pill" data-area="ep" href="#area-04-tab" role="tab" aria-controls="area-04" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-04">EP</a>
                <a id="area-aq" data-toggle="pill" data-area="aq" href="#area-05-tab" role="tab" aria-controls="area-05" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-05">AQ</a>
                <a id="area-hcep" data-toggle="pill" data-area="hcep" href="#area-05-tab" role="tab" aria-controls="area-05" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-05">HCEP</a>
                <a id="area-hp2" data-toggle="pill" data-area="hp2" href="#area-06-tab" role="tab" aria-controls="area-06" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-06">HP2</a>
                <a id="area-hp3" data-toggle="pill" data-area="hp3" href="#area-07-tab" role="tab" aria-controls="area-07" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-07">HP3</a>
                <a id="area-hp4" data-toggle="pill" data-area="hp4" href="#area-08-tab" role="tab" aria-controls="area-08" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-08">HP4</a>
                <a id="area-hp5" data-toggle="pill" data-area="hp5" href="#area-09-tab" role="tab" aria-controls="area-09" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-09">HP5</a>
                <a id="area-hp6" data-toggle="pill" data-area="hp6" href="#area-10-tab" role="tab" aria-controls="area-10" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-10">HP6</a>
                <a id="area-utia" data-toggle="pill" data-area="utia" href="#area-11-tab" role="tab" aria-controls="area-11" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-11">UTIA</a>
                {{-- <a id="area-uticvd" data-toggle="pill" data-area="uticvd" href="#area-12-tab" role="tab" aria-controls="area-12" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-12">UTICVD</a> --}}
                <a id="area-utip" data-toggle="pill" data-area="utip" href="#area-13-tab" role="tab" aria-controls="area-13" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-13">UTIP</a>
                <a id="area-utin" data-toggle="pill" data-area="utin" href="#area-13-tab" role="tab" aria-controls="area-13" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-13">UTIN</a>
                <a id="area-pad" data-toggle="pill" data-area="pad" href="#area-14-tab" role="tab" aria-controls="area-14" aria-selected="true"  class="link-area flex-sm-fill text-sm-center nav-link" href="#area-14">PAD</a>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid px-3 bg-light overflow-auto bg-gray" style="height:6vh">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex row-flex justify-content-between">
                <div >
                    <div class="row-title badge badge-light" style="border-radius: 1em;">
                       Entrega de guardia
                    </div>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end">

                        <button type="button" class="btn btn-gray text-nowrap mx-1">
                                Total Pacientes <span id="total_paciente" class="badge bg-primary">0</span>
                        </button>

                </div>
                <div>
                   <input id="search" style="width: 5cm;" type="search" placeholder="Buscar..." class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('content')
    @yield('menu_2')
       <div class="container-fluid bg-light overflow-auto" style="height:78vh">
            <div class="row">
                <div class="col-md-12">
                    <div id="cargando" style="display: flex" class="m-4 justify-content-center text-primary">
                        Cargando...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                    <div id="sinresultados" style="display: none" class="m-4 justify-content-center text-primary">
                        No se encontraron resultados
                    </div>
                    <table id="example" style="display: none" class="table table-bordered table-striped bg-white" >
                        <thead>
                            <tr>
                                <th class="d-none">Ubicación</th>
                                <th>Paciente</th>


                                <!--
                                <th>Ingreso</th> -->
                                <th>Médico</th>
                                <th>Probabilidad Diagnóstica</th>
                                <th>Evolución</th>
                                <th>Plan</th>
                                <th>Resultados</th>
                                <th>Pendientes</th>
                                <th>Código Azul</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="filasPacientes">
                            <tr>
                                <td colspan="11">
                                    <div class="d-flex m-4 justify-content-center text-primary">
                                        Cargando...
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

@endsection
@section('footer')

@endsection
@section('script')
    <script src="{{ mix('js/app_resumen_clinico.js') }}"></script>


@endsection
@section('css')
    <style>
            #menu-pad > .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                color: #ffffff !important;
                background-color: var(--success);
            }
            .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                color: var(--white) !important;
                background-color: var(--success);
            }
            #menu-pad >.badge-gray {
                background-color: var(--white) !important;
            }
            #menu-pad.bg-light, .bg-light>a {
                color: var(--primary) !important;
            }
    </style>
    <style>
        body{
            background-color: var(--light) !important;
        }
        .DTFC_Cloned{
            display: none;
        }
        body{
            background-color: var(--bs-gray-200);
        }
        thead{
            background-color: var(--gray) !important;
            color: var(--secondary) !important;
            text-align: center !important;
            text-transform: uppercase !important;
            white-space: nowrap !important;
        }
        .row-title{
            font-weight: 600;
            color: var(--primary) !important;
            font-size: 1.3em;

        }
        #example_filter{
            display:none;
        }
        div.dom_wrapper {

            background-color: rgba(255, 255, 255, 1) !important;

        }
        table.dataTable {
            clear: both;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
            max-width: none !important;
            border-collapse: separate !important;
            border-spacing: 0;
        }
        table#example>thead{
            position:sticky;
            top:-0.5vh;
            background-color:white;
            z-index: 1;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 1px solid #dcdada;
            background-color: #585858;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
            background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
            background: -moz-linear-gradient(top, #585858 0%, #111 100%);
            background: -ms-linear-gradient(top, #585858 0%, #111 100%);
            background: -o-linear-gradient(top, #585858 0%, #111 100%);
            background: var(--bs-gray-300);
        }

        #example_filter{
            position: fixed !important;
            top: 8vh !important;
            right: 1em !important;
            z-index: 1111;
        }
    </style>
@endsection
