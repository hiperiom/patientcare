@extends('component.template')
@section('title')
CMDLT | PatientCare
@endsection
@section('header')
    <nav id="headerNavbar" class="navbar shadow navbar-expand navbar-primary justify-content-between navbar-light navbar-v2">
        <ul class="navbar-nav">
            <li class="nav-item">

                <a id="home_btn" class="nav-link p-0 pl-3" data-widget="pushmenu" href="#" role="button">
                    <div class="d-flex flex-row">
                        <div>
                            <img id="img_profile" onerror="reemplaza_imagen(this)"
                                class="float-right border border-white rounded-circle" style="height: 1.1cm;width:1.1cm"
                                src="/image/system/patient.svg" alt="">
                        </div>
                        <div class="pl-2 home-user-info">
                            <div class="text-white" style="line-height: 1.3">
                                <i>¡Bienvenido!</i>
                                <div class="font-weight-bold" style="font-size: 1.3em;">
                                    Dr. Luis Parodi
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto flex-row">
            <li class="nav-item">

                <div class="navbar-search-block rounded-pill">
                    <div class="form-inline">
                        <div class="input-group input-group-md">
                            <input id="search" class="form-control form-control-navbar" type="search" placeholder="Escribe un texto a buscar"
                                aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                      <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                      <i class="fas fa-times"></i>
                                    </button>
                                  </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-slide="true" href="#" role="button">
                    <img class="" loading="lazy" style="height: 30px;" src="/image/system/patientcare_bw.svg">
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar bg-light elevation-4">
        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                    role="menu" data-accordion="false">
                    <li class="nav-item display-custom">
                        <div class="d-flex bg-light flex-row home-user-info-list">
                            <div>
                                <img id="img_profile" onerror="reemplaza_imagen(this)"
                                    class="float-right border border-white rounded-circle" style="height: 1.1cm;width:1.1cm"
                                    src="/image/system/patient.svg" alt="">
                            </div>
                            <div class="pl-2">
                                <div style="line-height: 1.3;font-size: 0.7em;text-align: left;">
                                    <i>¡Bienvenido!</i>
                                    <div class="font-weight-bold">
                                        Dr. Luis Parodid sfsd fsd fsd f
                                    </div>
                                </div>
                            </div>
                        </div>
                        Menú Patientcare
                    </li>

                </ul>

            </nav>
        </div>

    </aside>
@endsection
@section('menu_2')
    <div class="container-fluid bg-light" style="height:5vh">
        <div id="grupoareas" class="d-flex justify-content-between flex-nowrap">
            <div class="flex-fill">

                <div id="areas_vertical" class="dropdown">
                    <button class="btn btn-light btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ÁREAS
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    </div>
                </div>
                <div id="caja_areas" style="overflow-x:auto;">

                    <ul class="nav flex-nowrap nav-pills" id="areas_horizontal" role="tablist">

                    </ul>

                </div>




            </div>

            <div class="group-btn-paciente">
                <div class="d-flex flex-nowrap">
                    <div>
                        <button class="btn btn-success text-nowrap btn-block"
                            href="#" role="button">
                            <i class="fas fa-user"></i>
                            Nuevo Paciente
                        </button>
                    </div>
                    <div class="px-1">
                        <a class="btn btn-outline-primary  btn-block" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="d-flex row-flex justify-content-between overflow-auto" style="height:5vh">
        <div>
            <div id="area_title" class="row-title badge badge-light text-uppercase" style="border-radius: 1em;">
                TODOS LOS PACIENTES
            </div>
        </div>

        <div>
            <div class="d-flex">

                <div>
                    <div id="sub_areas_vertical" class="dropdown">
                        <button class="btn btn-light btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            PAD
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        </div>
                    </div>

                </div>
                <div>
                    <div class="overflow-auto" style="width: max-content;">
                        <ul class="nav nav-pills flex-nowrap"  id="sub_areas_horizontal" role="tablist">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100" style="height:3vh">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="    background-color: var(--gray) !important;">
                <div id="signosP" class="marquee-with-options">
                    <marquee  onmouseout="this.start()" onmouseover="this.stop()" scrollamount="5"
                        style="width:600">

                    </marquee>
                </div>
            </div>
        </div>
        </div>

    </div>
@endsection
@section('content')
@yield('menu_2')

    <div class="container-fluid bg-light overflow-auto" style="height:77vh">
        <div class="row">
            {{--
            <div class="col-md-12">
                <div id="cargando" style="display: flex" class="m-4 justify-content-center text-primary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div> --}}
                <div id="sinresultados" style="display: none" class="m-4 justify-content-center text-primary">
                    No se encontraron resultados
                </div>
                <table id="example" class="table shadow table-bordered table-vertical-striped bg-white">
                    <thead>

                    </thead>
                    <tbody id="filasPacientes">

                        <tr>
                            <td colspan="18">
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
<!-- <i class="fas fa-columns"></i> -->
@endsection
@section('footer')

@endsection
@section('script')

    <script>
        let tablaPacientes =null;
        let D = document;
        let columnCovid = [
                {"tag":"ubi","description":"Ubicación Actual del Paciente","order":0,"clase":[]},
                {"tag":"dias","description":"Días en la ubicación Actual","order":0,"clase":[]},
                {"tag":"paciente","description":"Información del Paciente","order":0,"clase":[]},
                {"tag":"sexo","description":"Género","order":0,"clase":[]},
                {"tag":"edad","description":"Edad","order":0,"clase":[]},
                {"tag":"temp","description":"Temperatura","order":0,"clase":[]},
                {"tag":"fc","description":"Frecuencia Cardíaca","order":0,"clase":[]},
                {"tag":"fr","description":"Frecuencia Respiratoria","order":0,"clase":[]},
                {"tag":"ta","description":"Tensión Arterial","order":0,"clase":[]},
                {"tag":"gl","description":"Glicemia","order":0,"clase":[]},
                {"tag":"spo2","description":"Saturación","order":0,"clase":[]},
                {"tag":"oxigenoterapia","description":"Oxigenoterapia","order":0,"clase":[]},
                {"tag":"sintoma","description":"Síntomas","order":0,"clase":[]},
                {"tag":"pcr","description":"COVID PCR","order":0,"clase":[]},
                {"tag":"pdr","description":"COVID PDR","order":0,"clase":[]},
                {"tag":"antg","description":"COVID-ANTIGÉNICA","order":0,"clase":[]},
                {"tag":"tac","description":"Tomografía Axial Computarizada","order":0,"clase":[]},
                {"tag":"chat","description":"Chat Whatsapp con Paciente","order":0,"clase":[]},
            ];

        let state = {
                "MENU_HOME":[
                    {
                        "alias":"Inicio",
                        "clase":[],
                        "area_filtro":null,
                        "description": "Emergencia Adulto",
                        "href":"#",
                        "ico": ["fas","fa-tachometer-alt"],
                        "img":null,
                        "sub_area":[],
                    },
                    {
                        "alias":"Operatividad",
                        "clase":[],
                        "area_filtro":null,
                        "description": "Operatividad",
                        "href":"#",
                        "ico": ["fas","fa-user-cog"],
                        "img":null,
                        "sub_area":[
                            {
                                "alias":"Equipo Médico",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Equipo Médico",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },
                            {
                                "alias":"Especialidades",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Especialidades",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },
                            {
                                "alias":"Nuevos Pacientes",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Nuevos Pacientes",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },
                            {
                                "alias":"Clasificador CIE-11",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Clasificador CIE-11",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },
                            {
                                "alias":"Entrega de Guardia",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Entrega de Guardia",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },
                            {
                                "alias":"Cuestionario Covid",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Cuestionario Covid",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },
                            {
                                "alias":"Clínica PostCovid",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Clínica PostCovid",
                                "href":"#",
                                "ico": ["fas","fa-dot-circle"],
                                "img":null,
                                "sub_area":[],
                            },




                        ]
                    },
                    {
                        "alias":"Atención Hospitalaria",
                        "clase":[],
                        "area_filtro":null,
                        "description": "Atención Hospitalaria",
                        "href":"#",
                        "ico": ["fas","fa-hospital"],
                        "img":null,
                        "sub_area":[
                            {
                                "alias":"Emergencia",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Emergencia",
                                "href":"#",
                                "ico": ["fas","fa-ambulance"],
                                "img":null,
                                "sub_area":[
                                    {
                                        "alias":"Emergencia Adulto",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-ea",
                                        "description": "Emergencia Adulto",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"ECVD",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-ecvd",
                                        "description": "Emergencia COVID",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"EP",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-ep",
                                        "description": "Emergencia Pediátrica",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                ],
                            },
                            {
                                "alias":"Hospitalización",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Hospitalización",
                                "href":"#",
                                "ico": ["fas","fa-layer-group"],
                                "img":null,
                                "sub_area":[
                                    {
                                        "alias":"HP2",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp2",
                                        "description": "HP2",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"HP3",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp3",
                                        "description": "HP3",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"HP4",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp4",
                                        "description": "HP4",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"HP5",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp5",
                                        "description": "HP5",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"HP6",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp6",
                                        "description": "HP6",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                ],
                            },
                            {
                                "alias":"Terapia Intensiva",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Terapia Intensiva",
                                "href":"#",
                                "ico": ["fas","fa-procedures"],
                                "img":null,
                                "sub_area":[
                                    {
                                        "alias":"UTIA",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-utia",
                                        "description": "UTIA",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"UTICVD",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-uticvd",
                                        "description": "UTICVD",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                    {
                                        "alias":"UTIP",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-utip",
                                        "description": "UTIP",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                ],
                            },
                            {
                                "alias":"Area Quirúrgica",
                                "clase":[],
                                "area_filtro":null,
                                "description": "Area Quirúrgica",
                                "href":"#",
                                "ico": ["far","fa-dot-circle"],
                                "img":null,
                                "sub_area":[
                                    {
                                        "alias":"AQ",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-aq",
                                        "description": "AQ",
                                        "href":"#",
                                        "ico": ["far","fa-dot-circle"],
                                        "img":null,
                                        "sub_area":[],
                                    },
                                ],
                            },
                        ],
                    },
                   /*
                    {
                        "ico": ["fas","fa-hospital"],
                        "description": "Atención Hospitalaria",
                        "href":"#",
                        "route": [
                            {
                                "ico": ["fas","fa-layer-group"],
                                "description": "Hospitalización",
                                "href":"#",
                                "route": [
                                    {
                                        "alias":"HP2",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp2",
                                        "description": "Hospitalización Piso 2",
                                        "href":"#HP2"
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                    {
                                        "alias":"HP3",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp3",
                                        "description": "Hospitalización Piso 3",
                                        "href":"#HP3"
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                    {
                                        "alias":"HP4",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp4",
                                        "description": "Hospitalización Piso 4",
                                        "href":"#HP4"
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                    {
                                        "alias":"HP5",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp5",
                                        "description": "Hospitalización Piso 5",
                                        "href":"#HP5"
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                    {
                                        "alias":"HP6",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-hp6",
                                        "description": "Hospitalización Piso 6",
                                        "href":"#HP6"
                                        "ico": ["far","fa-dot-circle"],
                                    },


                                ]
                            },
                            {
                                "ico": ["fas","fa-ambulance"],
                                "description": "Emergencia",
                                "href":"#",
                                "route": [
                                    {
                                        "alias":"EA",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-ea",
                                        "description": "Emergencia Adulto",
                                        "href":"#ea",
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                    {
                                        "alias":"ECVD",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-ecvd",
                                        "description": "Emergencia COVID",
                                        "href":"#ecvd",
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                    {
                                        "alias":"EP",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-ep",
                                        "description": "Emergencia Pediátrica",
                                        "href":"#EP",
                                        "ico": ["far","fa-dot-circle"],
                                    },


                                ]
                            },
                            {
                                "ico": ["fas","fa-procedures"],
                                "description": "Terapia Intensiva",
                                "href":"#",
                                "route": [
                                    {
                                        "ico": ["far","fa-dot-circle"],
                                        "description": "UTIA",
                                        "href":"#",
                                        "route": "#utia"
                                    },
                                    {
                                        "ico": ["far","fa-dot-circle"],
                                        "description": "UTICVD",
                                        "href":"#",
                                        "route": "#uticvd"
                                    },
                                    {
                                        "ico": ["far","fa-dot-circle"],
                                        "description": "UTIP",
                                        "href":"#",
                                        "route": "#utip"
                                    },
                                ]
                            },
                            {
                                "ico": ["fas","fa-procedures"],
                                "description": "Area Quirúrgica",
                                "href":"#",
                                "route": [
                                    {
                                        "alias":"AQ",
                                        "clase":[],
                                        "area_filtro":"area-a-filtrar-aq",
                                        "description": "ÁREA Quirúrgica",
                                        "href":"#AQ"
                                        "ico": ["far","fa-dot-circle"],
                                    },
                                ]
                            },
                        ]
                    },
                    {
                        "ico": ["fas","fa-clinic-medical"],
                        "description": "Atención Domiciliaria",
                        "href":"#",
                        "route": [
                            {
                                "ico": ["fas","fa-dot-circle"],
                                "description": "PAD Covid",
                                "href":"#",
                                "route": []
                            },
                            {
                                "ico": ["fas","fa-dot-circle"],
                                "description": "PAD Médico",
                                "href":"#",
                                "route": [
                                    {
                                        "ico": ["far","fa-dot-circle"],
                                        "description": "PAD Diabetes",
                                        "href":"#",
                                        "route": "#paddiabetes"
                                    },
                                    {
                                        "ico": ["far","fa-dot-circle"],
                                        "description": "PAD Cardio",
                                        "href":"#",
                                        "route": "#padcardio"
                                    },
                                    {
                                        "ico": ["far","fa-dot-circle"],
                                        "description": "PAD Dolor",
                                        "href":"#",
                                        "route": "#paddolor"
                                    },
                                ]
                            },
                            {
                                "ico": ["fas","fa-dot-circle"],
                                "description": "PAD Quirúrgico",
                                "href":"#",
                                "route": []
                            },
                            {
                                "ico": ["fas","fa-dot-circle"],
                                "description": "PAD Oncológico",
                                "href":"#",
                                "route": []
                            },
                            {
                                "ico": ["fas","fa-dot-circle"],
                                "description": "PAD Pediátrico",
                                "href":"#",
                                "route": []
                            },
                        ]
                    },

                    {
                        "ico": ["fas","fa-door-open"],
                        "description": "Salir",
                        "href":"#",
                        "route": []
                    },*/
                ],
                "MENU_SUB_AREAS":[
                    {
                        "alias":"PAD 1",
                        "clase":['btn-totales',"btn-pad_numero"],
                        "area_filtro":"area-a-filtrar-pad1",
                        "description": "PAD 1",
                        "id":"btn_total_pad1"
                    },
                    {
                        "alias":"PAD 2",
                        "clase":['btn-totales',"btn-pad_numero"],
                        "area_filtro":"area-a-filtrar-pad2",
                        "description": "PAD 2",
                        "id":"btn_total_pad2"
                    },
                    {
                        "alias":"PAD 3",
                        "clase":['btn-totales',"btn-pad_numero"],
                        "area_filtro":"area-a-filtrar-pad3",
                        "description": "PAD 3",
                        "id":"btn_total_pad3"
                    },
                    {
                        "alias":"PAD 4",
                        "clase":['btn-totales',"btn-pad_numero"],
                        "area_filtro":"area-a-filtrar-pad4",
                        "description": "PAD 4",
                        "id":"btn_total_pad4"
                    },
                    {
                        "alias":"PAD 5",
                        "clase":['btn-totales',"btn-pad_numero"],
                        "area_filtro":"area-a-filtrar-pad5",
                        "description": "PAD 5",
                        "id":"btn_total_pad5"
                    },
                    {
                        "alias":"PAD EMP",
                        "clase":['btn-totales',"btn-pad_numero"],
                        "area_filtro":"area-a-filtrar-pademp",
                        "description": "PAD EMP",
                        "id":"btn_total_pademp"
                    },
                    {
                        "alias":"PAD COVID",
                        "clase":['btn-totales',"btn-pad-area","pad-covid"],
                        "area_filtro":"area-a-filtrar-pad-covid",
                        "description": "PAD COVID",
                        "id":"total_padcovid"
                    },
                    {
                        "alias":"PAD POST-QUIRÚRGICO",
                        "clase":['btn-totales',"btn-pad-area","pad-postquirurgico"],
                        "area_filtro":"area-a-filtrar-pad-postquirurgico",
                        "description": "PAD POST-QUIRÚRGICO",
                        "id":"total_padpostquirurgico"
                    },
                    {
                        "alias":"PAD MED",
                        "clase":['btn-totales',"btn-pad-area",,"pad-medico"],
                        "area_filtro":"area-a-filtrar-pad-medico",
                        "description": "PAD MÉDICO",
                        "id":"total_padpmedico"
                    },
                    {
                        "alias":"HOSPITALIZADOS",
                        "clase":['btn-totales',"total_hospitalizados"],
                        "area_filtro":"area-a-filtrar-hospitalizados",
                        "description": "HOSPITALIZADOS",
                        "id":"total_hospitalizados"
                    },
                    {
                        "alias":"EMERGENCIA",
                        "clase":['btn-totales',"total_emergencia"],
                        "area_filtro":"area-a-filtrar-emergencia",
                        "description": "EMERGENCIA",
                        "id":"total_emergencia"
                    },
                    {
                        "alias":"UTI",
                        "clase":['btn-totales',"total_uti"],
                        "area_filtro":"area-a-filtrar-uti_total",
                        "description": "Unidad de Terapia Intensiva",
                        "id":"total_uti"
                    },
                    {
                        "alias":"PAD",
                        "clase":['btn-totales',"total_pad"],
                        "area_filtro":"area-a-filtrar-pad",
                        "description": "PAD - TOTAL PACIENTES",
                        "id":"total_pad"
                    },
                    {
                        "alias":"SALA DE ESPERA",
                        "clase":['btn-totales',"total_sala_espera"],
                        "area_filtro":"area-a-filtrar-sala_espera",
                        "description": "SALA DE ESPERA",
                        "id":"total_sala_espera"
                    },
                    {
                        "alias":"PACIENTES",
                        "clase":['btn-totales',"total_pacientes"],
                        "area_filtro":"area-a-filtrar-tp",
                        "description": "PAD MÉDICO",
                        "id":"total_pacientes"
                    },




                ],
                "MENU_AREAS":[
                    {
                        "alias":"TP",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-tp",
                        "description": "Todos los pacientes",
                        "href":"#tp"
                    },
                    {
                        "alias":"EA",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-ea",
                        "description": "Emergencia Adulto",
                        "href":"#ea"
                    },
                    {
                        "alias":"ECVD",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-ecvd",
                        "description": "Emergencia COVID",
                        "href":"#ecvd"
                    },
                    {
                        "alias":"EP",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-ep",
                        "description": "Emergencia Pediátrica",
                        "href":"#EP"
                    },
                    {
                        "alias":"AQ",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-aq",
                        "description": "ÁREA Quirúrgica",
                        "href":"#AQ"
                    },
                    {
                        "alias":"HP2",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-hp2",
                        "description": "Hospitalización Piso 2",
                        "href":"#HP2"
                    },
                    {
                        "alias":"HP3",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-hp3",
                        "description": "Hospitalización Piso 3",
                        "href":"#HP3"
                    },
                    {
                        "alias":"HP4",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-hp4",
                        "description": "Hospitalización Piso 4",
                        "href":"#HP4"
                    },
                    {
                        "alias":"HP5",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-hp5",
                        "description": "Hospitalización Piso 5",
                        "href":"#HP5"
                    },
                    {
                        "alias":"HP6",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-hp6",
                        "description": "Hospitalización Piso 6",
                        "href":"#HP6"
                    },
                    {
                        "alias":"UTIA",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-utia",
                        "description": "Unidad de Terapia Intensiva Adultos",
                        "href":"#UTIA"
                    },
                    {
                        "alias":"UTICVD",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-uticvd",
                        "description": "Unidad de Terapia Intensiva COVID",
                        "href":"#UTICVD"
                    },
                    {
                        "alias":"UTIP",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-utip",
                        "description": "Unidad de Terapia Intensiva Pediátrico",
                        "href":"#UTIP"
                    },
                    {
                        "alias":"PAD",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-pad",
                        "description": "Programa de Atención Domiciliaria",
                        "href":"#PAD"
                    },
                    {
                        "alias":"ALTA",
                        "clase":[],
                        "area_filtro":"area-a-filtrar-alta",
                        "description": "Altas Médicas",
                        "href":"#ALTA"
                    },
                ],
                "MENU_MARQUEE":[
                    {
                        "spo2":"90",
                        "color":[],
                        "paciente": "Todos los pacientes",
                        "area":"UTIA | UTIA",
                        "area_link":"#tp",
                        "paciente_id":1,
                    },

                ],
                "MEDICOS":[],
                "PACIENTES":[],
            };
        let loadMarqueeMenu = (paciente)=>{
                paciente.forEach((x,y)=>{
                    let $a = D.createElement("a")
                        $a.href="#"
                        $a.innerHTML=`
                            <a href="${x.area_link}">

                                <span class="text-danger">
                                    <span class="font-weight-bold">SPO2</span> -
                                    <span class="font-weight-bold">${x.spo2}%</span> |
                                    <span class="font-weight-bold text-gray">${x.paciente}</span> |
                                    <span class="font-weight-bold text-gray">${x.area}</span>
                                </span>
                            </a>
                            ${(y+1) < paciente.length ? '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>':''}

                        `;

                        D.querySelector("marquee").appendChild($a)
                })
            }
        let loadHomeMenu = (menu)=>{
                menu.forEach(x=>{
                    let $li = D.createElement("li")
                        $li.classList.add("nav-item")
                    let $a = D.createElement("a")
                        $a.href=x.href
                        $a.classList.add("nav-link")
                    let $i = D.createElement("i")
                        $i.classList.add("nav-icon")
                        x.ico.forEach (icono=>{
                            $i.classList.add(icono)
                        })

                        $a.appendChild($i)

                    let $p = D.createElement("p")
                        $p.textContent =x.alias

                        if (x.area_filtro !== null) {
                            $li.classList.add("filtro-area-opcion")
                            $li.dataset.area_filtro=x.area_filtro
                            $a.dataset.area_filtro=x.area_filtro
                            $p.dataset.area_filtro=x.area_filtro
                            $i.dataset.area_filtro=x.area_filtro
                        }

                        $a.appendChild($p)
                        $li.appendChild($a)
                        if (x.sub_area.length > 0) {
                            $i = D.createElement("i")
                            $i.classList.add("right","fas","fa-angle-left")
                            $p.appendChild($i)

                            x.sub_area.forEach(x2=>{
                                //inicio segundo nivel
                                let $ul1 = D.createElement("ul")
                                    $ul1.classList.add("nav","nav-treeview")

                                let $li2 = D.createElement("li")
                                    $li2.classList.add("nav-item")
                                let $a2 = D.createElement("a")
                                    $a2.classList.add("nav-link")
                                    $a2.href=x2.href
                                let $i2 = D.createElement("i")
                                    $i2.classList.add("nav-icon")
                                    x2.ico.forEach (icono=>{
                                        $i2.classList.add(icono)
                                    })

                                    $a2.appendChild($i2)
                                let $p2 = D.createElement("p")
                                    $p2.textContent =x2.alias

                                    if (x2.area_filtro !== null) {
                                        $li2.classList.add("filtro-area-opcion")
                                        $li2.dataset.area_filtro=x2.area_filtro
                                        $a2.dataset.area_filtro=x2.area_filtro
                                        $p2.dataset.area_filtro=x2.area_filtro
                                        $i2.dataset.area_filtro=x2.area_filtro
                                    }




                                    $a2.appendChild($p2)
                                    $li2.appendChild($a2)
                                    if (x2.sub_area.length > 0) {
                                        $i2 = D.createElement("i")
                                        $i2.classList.add("right","fas","fa-angle-left")
                                        $p2.appendChild($i2)
                                        //inicio tercer nivel

                                        x2.sub_area.forEach(x3=>{
                                            let $ul2 = D.createElement("ul")
                                                $ul2.classList.add("nav","nav-treeview")
                                            let $li3 = D.createElement("li")
                                                $li3.classList.add("nav-item")




                                            let $a3 = D.createElement("a")
                                                $a3.classList.add("nav-link")
                                                $a3.href=x3.href
                                            let $i3 = D.createElement("i")
                                                $i3.classList.add("nav-icon")
                                                x3.ico.forEach (icono=>{
                                                    $i3.classList.add(icono)
                                                })

                                                $a3.appendChild($i3)
                                            let $p3 = D.createElement("p")
                                                $p3.textContent =x3.alias

                                                if (x3.area_filtro !== null) {
                                                    $li3.classList.add("filtro-area-opcion")
                                                    $li3.dataset.area_filtro=x3.area_filtro
                                                    $a3.dataset.area_filtro=x3.area_filtro
                                                    $p3.dataset.area_filtro=x3.area_filtro
                                                    $i3.dataset.area_filtro=x3.area_filtro
                                                }
                                                $a3.appendChild($p3)
                                                $li3.appendChild($a3)

                                                $ul2.appendChild($li3)

                                                $li2.appendChild($ul2) //guarda en segundo nivel
                                        })
                                        //fin tercer nivel

                                    }



                                    $ul1.appendChild($li2)
                                    $li.appendChild($ul1)//añadimos al nivel 1
                                //fin segundo nivel
                            })

                        }






                    D.querySelector(".nav-sidebar").appendChild($li)
                })
            }
        let loadRowCovid = (column)=>{
            let $tr = D.createElement("tr")
            let $td = D.createElement("td")

                    let filtros =""

                    //CREACIÓN DE LOS FILTROS
                    let area = "tp";
                        filtros += `[area-a-filtrar-tp]`;
                        filtros += `[area-a-filtrar-${column['paciente']}]`;
                        filtros += `[area-a-filtrar-${column['cedula']}]`;
                        filtros += `[area-a-filtrar-${column['ubicacion']}]`;


                    //AREAS EMERGENCIA
                    if ([2,3,270].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "ea"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([6,7,10].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "ecvd"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([28,29,32].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "ep"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([
                        2,3,270,
                        6,7,10,
                        29,32,
                    ].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {

                        filtros += `[area-a-filtrar-emergencia]`
                    }


                    //AREAS QUIRURGICAS
                    if ([41].includes(parseInt(column['cat_user_ubicacion_id']))) {
                        area = "aq"
                        filtros += `[area-a-filtrar-${area}]`
                    }

                    //AREAS HOSPITALIZACION
                    if ([42,43].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "hp2"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([70,71].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "hp3"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([98,99].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "hp4"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([126,127].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "hp5"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([154,155].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "hp6"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([
                        42,43,
                        70,71,
                        98,99,
                        126,127,
                        154,155
                    ].includes(parseInt(column['parent_cat_user_ubicacion_id']))
                    ) {

                        filtros += `[area-a-filtrar-hospitalizados]`
                    }

                    //AREAS TERAPIA INTENSIVA
                    if ([182,183].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "utia"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([194,195].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "uticvd"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([211,212].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "utip"
                        filtros += `[area-a-filtrar-${area}]`
                    }
                    if ([
                        182,183,
                        194,195,
                        211,212,
                    ].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {

                        filtros += `[area-a-filtrar-uti_total]`
                    }

                    //PAD COVID
                    if ([224].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "pad"
                        filtros += `[area-a-filtrar-${area}]`;
                        filtros += `[area-a-filtrar-${area}-covid]`;
                    }
                    if ([225,226,227,228,229,357].includes(parseInt(column['cat_user_ubicacion_id']))) {
                            area = "pad";
                        let nro_pad = (caso)=>{
                                switch (caso) {
                                    case 225:return 1;break;
                                    case 226:return 2;break;
                                    case 227:return 3;break;
                                    case 228:return 4;break;
                                    case 229:return 5;break;
                                    case 357:return "emp";break;
                                }
                            }
                            filtros += `[area-a-filtrar-${area}]`;
                            filtros += `[area-a-filtrar-${area}${nro_pad(column['cat_user_ubicacion_id'])}-covid]`;
                    }
                    //PAD QUIRURGICO
                    if ([372].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "pad"
                        filtros += `[area-a-filtrar-${area}]`;
                        filtros += `[area-a-filtrar-${area}-postquirurgico]`;
                    }
                    if ([373,374,375,376,377,378].includes(parseInt(column['cat_user_ubicacion_id']))) {
                            area = "pad";
                        let nro_pad = (caso)=>{
                                switch (caso) {
                                    case 373:return 1;break;
                                    case 374:return 2;break;
                                    case 375:return 3;break;
                                    case 376:return 4;break;
                                    case 377:return 5;break;
                                    case 378:return "emp";break;
                                }
                            }
                            filtros += `[area-a-filtrar-${area}]`;
                            filtros += `[area-a-filtrar-${area}${nro_pad(column['cat_user_ubicacion_id'])}-postquirurgico]`;
                    }
                    //PAD QUIRURGICO
                    if ([379].includes(parseInt(column['parent_cat_user_ubicacion_id']))) {
                        area = "pad"
                        filtros += `[area-a-filtrar-${area}]`;
                        filtros += `[area-a-filtrar-${area}-medico]`;
                    }
                    if ([380,381,382,383,384,385].includes(parseInt(column['cat_user_ubicacion_id']))) {
                            area = "pad";
                        let nro_pad = (caso)=>{
                                switch (caso) {
                                    case 380:return 1;break;
                                    case 381:return 2;break;
                                    case 382:return 3;break;
                                    case 383:return 4;break;
                                    case 384:return 5;break;
                                    case 385:return "emp";break;
                                }
                            }
                            filtros += `[area-a-filtrar-${area}]`;
                            filtros += `[area-a-filtrar-${area}${nro_pad(column['cat_user_ubicacion_id'])}-medico]`;
                    }



                    //SALA DE ESPERA
                    if ([245].includes(parseInt(column['cat_user_ubicacion_id']))) {

                        filtros += `[area-a-filtrar-${area}]`;
                        filtros += `[area-a-filtrar-sala_espera]`;
                    }


                    //console.log(column,area)
                    columnCovid.forEach((data,y)=>{
                        const {tag} = data
                        $td = D.createElement("td")

                        $td.classList.add("p-0")
                        $td.dataset[`search`]=filtros;
                        //$td.textContent =column[x];

                        if (tag==="ubi") {
                            $td.innerHTML =`

                                <input type="hidden" id="fecha_prealta_${column['user_id']}" value="${column['prealta']}">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="d-flex flex-nowrap" style="width: 6em;">
                                        <button class="btn btn-transparent btn-block" data-tippy-content="Historial de ubicaciones del paciente" onclick="UserCuestUbicacion.historialUbiEpisodio('.modal-body',${column['user_id']})">${column['ubicacion']}</button>
                                    </div>
                                    <div class="">
                                        <button data-tippy-content="Agregar Fecha Probable de Alta" onclick="UserCuestEpisodio.addPrealta(${column['user_id']})" class="btn btn-block" style="background-color: #eeefef;border-color: #ddd;color: #444;">
                                            <i class="far fa-calendar calendar-prealta text-gray"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div id="card_prealta_${column['user_id']}" onclick="UserCuestEpisodio.addPrealta(${column['user_id']})" data-tippy-content="Fecha Probable de Alta" class="tooltip-info ${(column['prealta_color'] !== "danger" && column['prealta_color'] !== "warning") ?'':'heartbeat_infinity'} cursor-pointer bg-${column['prealta_color']} d-none  rounded mx-1 px-1 text-center">
                                        <div class="font-weight-bold" style="font-size: 0.8em;">
                                            <i class="fas fa-stopwatch"></i> <span id="title_prealta_${column['user_id']}"> ${(column['prealta_color'] !== "success" && column['prealta_color'] !== "warning") ?'ALTA':'PRE-ALTA'}</span>
                                        </div>
                                        <div>
                                            00/00/0000
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        if (tag==="paciente") {
                            //**icono alerta */
                            let alerta = "<span id='default-alert_${column['user_id']}' style='font-size: 25px !important;' class='heartbeat text-success alert-estable font-weight-bold'>!</span>";
                            if (column['alertalert']==1) {
                                alerta = "<span data-tippy-content='<b>Estable !</b><br><small>Prioridad establecida por el sistema, de acuerdo al valor actual de la oximetría.</small>' id='default-alert_${column['user_id']}' style='font-size: 25px !important;' class='heartbeat pri_estable text-success alert-estable font-weight-bold'>!</span>";
                            } else if (column['alert']==2) {
                                alerta = "<span data-tippy-content='<b>Intermedio !!</b><br><small>Prioridad establecida por el sistema, de acuerdo al valor actual de la oximetría.</small>' id='default-alert_${column['user_id']}' style='font-size: 25px !important;' class='heartbeat pri_intermedio text-warning alert-estable font-weight-bold ping'>!!</span>";
                            } else if (column['alert']==3) {
                                alerta = "<span data-tippy-content='<b>De Cuidado !!!</b><br><small>Prioridad establecida por el sistema, de acuerdo al valor actual de la oximetría.</small>' id='default-alert_${column['user_id']}' style='font-size: 25px !important;' class='heartbeat pri_de_cuidado text-danger alert-estable font-weight-bold ping-2'>!!!</span>";
                            }
                            //**icono calendario */
                            let dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_7.png' alt='7'>";
                            if (column['cal'] == 7) {
                                dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_7.png' alt='7'>";
                            } else if (column['cal'] == 14) {
                                dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_14.png' alt='14'>";
                            } else if (column['cal'] == 21) {
                                dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_21.png' alt='21'>";
                            }
                            $td.innerHTML =`
                            <div class="text-secondary mb-2">
                            <div class="h4 pb-2" style="width: calc(13vh*2) !important;">
                                <div class="d-flex justify-content-around">
                                    <div class="p-2 flex-grow-1">
                                        <span class="cursor-pointer">
                                            ${column['paciente']}
                                            <span class="filtroBuscador" style="font-size:0em">
                                                ${column['episodio']}
                                            </span>
                                            <span class="filtroBuscador" style="font-size:0em">
                                                ${column['user_id']}
                                            </span>
                                            <span class="filtroBuscador" style="font-size:0em">
                                                ${column['cedula'].replace('.', '')}
                                            </span>
                                            <span class="filtroBuscador" style="font-size:0em">
                                                ${column['email']}
                                            </span>
                                            <span class="filtroBuscador" style="font-size:0em">
                                                ${column['ingreso']}
                                            </span>
                                        </span>
                                        <span>
                                            <div class="btn-group" style="margin-left: 20px"
                                                role="group" aria-label="">
                                                <div class="btn-group" role="group">
                                                    <a id="default-alert_${column['user_id']}" type="button"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                        ${alerta}
                                                    </a>

                                                    <div class="dropdown-menu"
                                                        aria-labelledby="dropdownId">
                                                        <a onclick="addAlert(1,${column['user_id']})"
                                                            class="dropdown-item"><span
                                                                class="text-success">!</span>
                                                            Estable</a>
                                                        <a onclick="addAlert(2,${column['user_id']});"
                                                            class="dropdown-item cursor-pointer"><span
                                                                class="text-warning">!!</span>
                                                            Intermedio</a>
                                                        <a onclick="addAlert(3,${column['user_id']});"
                                                            class="dropdown-item cursor-pointer"><span
                                                                class="text-danger">!!!</span>
                                                            De cuidado</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="py-2">
                                        <button id="vip_${column['user_id']}" data-user_id="${column['user_id']}" onclick="UserVIP.updateVip(this)" data-tippy-content="Paciente VIP" class="btn btn-transparent tooltip-info"><i class="fas fa-star ${(parseInt(column['vip']) === 1) ? 'text-info':'text-info-disabled'}"></i></button>
                                    </div>
                                </div>
                                <div class="d-flex text-center justify-content-around">


                                    <div class="flex-fill">
                                        <div id="col_pad_${column['user_id']}" ></div>
                                    </div>
                                    <div class="flex-fill">
                                        <a id="btn_infoPaciente_${column['user_id']}"  data-tippy-content="Datos del Paciente" onclick="UserCuestPaciente.edit('.modal-body',${column['user_id']})"class="h4 cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/info.svg">
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a onclick="UserCuestInforme.index('.modal-body',${column['user_id']})"  data-tippy-content="Informes" class="cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono_archivo2.svg">
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a onclick="UserCuestHistoria.indexHistoria({user_id:${column['user_id']}})"  data-tippy-content="Historia inicial" class="tooltip-primary cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-historia.png">
                                        </a>
                                    </div>

                                    <div class="flex-fill">
                                        <a id="btn_evolucion_${column['user_id']}" onclick="UserCuestHistoria.index('.modal-body',${column['user_id']})" data-tippy-content="Evoluciones" class="h4 cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-evolucion.svg">
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="heartbeat" style="position: relative;cursor:pointer;"  data-tippy-content="Pendientes" onclick="UserCuestPendiente.index('.modal-body',${column['user_id']})">
                                            <img style="height: 35px;width: 33px;"src='/image/system/todolist.svg'>
                                            <span id='total_pendientes_${column['user_id']}' style='display:${column['t_pendiente']>0?'block':'none'};left: 23px;top:-5px;font-size: 0.5em;' class='badge badge-pill badge-danger position-absolute'>${column['t_pendiente']}</span>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="flex-fill">
                                        <div class="btn-group">
                                            <a href="" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true"  data-tippy-content="Más opciones" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h heartbeat text-primary" style="font-size: 1.5em;"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg-right">
                                                <a onclick="UserCuestInforme.index('.modal-body',${column['user_id']})" class="dropdown-item" type="button">
                                                    <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono_archivo2.svg">Informes
                                                </a>
                                                <a  class="dropdown-item" type="button">
                                                    <div class="dropdown">
                                                        <a id="triggerId_${column['user_id']}" class="h4 cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            ${dias_cal}
                                                        </a>
                                                        <div class="dropdown-menu" style="width:4em;z-index: 10000;" aria-labelledby="triggerId_${column['user_id']}">
                                                            <a onclick="addCal(7,${column['user_id']})" style="width:4em" class="dropdown-item cursor-pointer"><img loading="lazy" class="img-fluid" style="width: 30px;height: 30px;" src="/image/system/icono_cal_7.png" alt=""></a>
                                                            <a onclick="addCal(14,${column['user_id']})" style="width:4em" class="dropdown-item cursor-pointer"><img loading="lazy" class="img-fluid" style="width: 30px;height: 30px;" src="/image/system/icono_cal_14.png" alt=""></a>
                                                            <a onclick="addCal(21,${column['user_id']})" style="width:4em" class="dropdown-item cursor-pointer"><img loading="lazy" class="img-fluid" style="width: 30px;height: 30px;" src="/image/system/icono_cal_21.png" alt=""></a>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    -->
                                </div>
                            </div>

                        </div>
                            `;
                        }

                        $tr.appendChild($td)
                    })
                    $tr.dataset[`search`]=filtros
                    $tr.dataset[`user_id`]=`${column['user_id']}`

                return $tr;


            }
        let loadViewCovid = (PACIENTES)=>{
            let $table = D.querySelector("#example")
            let $thead = $table.querySelector("thead")
                $thead.innerHTML=null;
            let $tr = D.createElement("tr")
                columnCovid.forEach(x=>{
                    let $th = D.createElement("th")
                        $th.textContent=x.tag
                        $th.classList.add("tooltip-primary")

                        x.clase.forEach(clase=>{
                            $th.classList.add(clase)
                        })
                        $th.setAttribute("data-tippy-content",x.description)
                        $tr.appendChild($th)
                })
                $thead.appendChild($tr)
            let $tbody = $table.querySelector("tbody")
                $tbody.innerHTML=null
                PACIENTES.forEach(x=>{
                    let $tr = loadRowCovid(x)
                    $tbody.appendChild($tr)
                })


                tablaPacientes = $('#example').DataTable({
                    //bInfo : false,
                    dom: 'Bfrtip',
                    paging:false,
                    responsive: false,
                    lengthChange: false,
                    autoWidth: false,
                    buttons: ["colvis"]
                });

                $('#search').on('change',function (param) {
                    param.preventDefault();
                    //tablaPacientes.search("area-274").draw()
                    tablaPacientes.search($(this).val()).draw() ;
                    tablaPacientes = $('#example').DataTable();
                })


                btn_totales("area-a-filtrar-tp");
                activarTooltip()
            }
        let loadAreaMenu = (menu,selector)=>
            {

                menu.forEach((x,y)=>{

                    let $a = D.createElement("a")
                        $a.href=x.href
                        $a.classList.add("dropdown-item")
                        x.clase.forEach (icono=>{
                            $a.classList.add(icono)
                        })
                        $a.textContent=x.alias;
                        if(y===0){
                            $a.classList.add("active")
                        }
                    D.querySelector("#"+selector+"_vertical .dropdown-menu").appendChild($a)

                    let $li = D.createElement("li")
                        $li.setAttribute("role","presentation")
                        $li.classList.add("nav-item","filtro-area-opcion")

                        x.clase.forEach (icono=>{
                            $li.classList.add(icono)
                        })

                        $a = D.createElement("a")

                        $a.id=`pills-${x.alias}-tab`
                        $a.href=x.href
                        $a.setAttribute("role","tab")
                        $a.setAttribute("aria-controls","pills-home")
                        $a.setAttribute("aria-selected","true")
                        if(y===0){
                            $a.classList.add("active")
                        }
                        $a.dataset.toggle="pill"
                        $a.classList.add("nav-link")
                        $a.dataset.area_filtro=x.area_filtro
                        x.clase.forEach (icono=>{
                            $a.classList.add(icono)
                        })
                        $a.textContent=x.alias;
                        $li.appendChild($a);

                        D.querySelector("#"+selector+"_horizontal").appendChild($li)
                })

            }
        let loadSubAreasSMenu = ()=>
            {
                state['MENU_SUB_AREAS'].forEach((x,y)=>{

                    //MENU HORIZONTAL
                    let $span = D.createElement("span")
                        $span.classList.add("badge","bg-gray","text-secondary","mx-1")
                        $span.textContent="0";
                        $span.style.fontSize="1em";
                        $span.dataset.area_filtro=x.area_filtro;

                    let $a = D.createElement("a")
                        $a.href="#"
                        $a.setAttribute("role","tab")
                        $a.setAttribute("aria-controls","pills-home")
                        $a.setAttribute("aria-selected","true")
                        $a.dataset.toggle="pill"
                        $a.dataset.area_filtro=x.area_filtro;

                        $a.classList.add("nav-link")
                        $a.textContent=x.alias;
                        $a.appendChild($span)

                    let $li = D.createElement("li")
                        $li.setAttribute("role","presentation")
                        $li.classList.add("nav-item","d-none","filtro-area-sub-opcion","btn-gray-custom-1")

                        x.clase.forEach (icono=>{
                            $li.classList.add(icono)
                        })
                        $li.appendChild($a);
                        D.querySelector("#sub_areas_horizontal").appendChild($li)



                    //SUB MENU VERTICAL
                        $a = D.createElement("a")
                        $a.classList.add("dropdown-item","d-none")
                        $a.href="#"
                        $a.textContent=x.alias;
                        x.clase.forEach (icono=>{
                            $a.classList.add(icono)
                        })
                        D.querySelector("#sub_areas_vertical .dropdown-menu").appendChild($a)

                   /*
                        //$a.id=x.id

                        x.clase.forEach (icono=>{
                            $a.classList.add(icono)
                        })

                        if(y===0){
                            $a.classList.add("active")
                        }

                    //SUB MENU HORIZONTAL
                    let $li = D.createElement("li")




                        $a = D.createElement("a")

                        //$a.id=`pills-${x.href}-tab`
                        //$a.id=x.id
                        $a.setAttribute("role","tab")
                        $a.setAttribute("aria-controls","pills-home")
                        $a.setAttribute("aria-selected","true")
                        if(y===0){
                            $a.classList.add("active")
                        }
                        $a.dataset.toggle="pill"
                        $a.classList.add("nav-link","")

                        x.clase.forEach (icono=>{
                            $a.classList.add(icono)
                        })
                        //<span style="font-size: 96%;" class="badge text-secondary badge-gray">1</span>
                        $a.textContent=x.alias;

                    let $span = D.createElement("span")
                        $span.classList.add("badge","bg-gray","text-secondary","mx-1")
                        $span.textContent="0";
                        $span.style.fontSize="1em";
                        $a.appendChild($span)
                        $li.appendChild($a);
                    D.querySelector("#sub_areas_horizontal_horizontal").appendChild($li)*/
                })

                D.querySelectorAll("li.filtro-area-sub-opcion a").forEach(x=>{
                    x.addEventListener("click",(e)=>{
                        console.log("------>",e.target.dataset.area_filtro)
                        tablaPacientes.search(e.target.dataset.area_filtro).draw()

                        btn_totales(e.target.dataset.area_filtro)
                    })
                })
            }
        let btn_totales = (area_filtro)=>
            {
                console.log(area_filtro)


                    //CREO LOS SUBBOTONES DEL AREA
                    D.querySelectorAll("#sub_areas_vertical a").forEach(x=>x.classList.add("d-none"))
                    D.querySelectorAll("#sub_areas_horizontal li").forEach(x=>x.classList.add("d-none"))
                let btn = D.querySelectorAll("#sub_areas_horizontal li")
                if (
                    [
                        "area-a-filtrar-tp",
                        "area-a-filtrar-hospitalizados",
                        "area-a-filtrar-emergencia",
                        "area-a-filtrar-uti_total",
                        "area-a-filtrar-sala_espera",
                        "area-a-filtrar-pad",
                    ].includes(area_filtro)
                ) {
                    //BUSCO EL NOMBRE DEL AREA
                    if ([
                        "area-a-filtrar-tp"
                    ].includes(area_filtro)) {
                        let area_title = state["MENU_AREAS"].filter(x=>x.area_filtro===area_filtro)[0];
                        D.querySelector("#area_title").textContent = area_title.description.toUpperCase()
                    }else{
                        let area_title = state["MENU_SUB_AREAS"].filter(x=>x.area_filtro===area_filtro)[0];
                        D.querySelector("#area_title").textContent = area_title.description.toUpperCase()
                    }


                    btn.forEach(x=>{

                        if(x.classList.contains("total_emergencia")){
                            x.classList.remove("d-none");
                            //consulto el total
                            tablaPacientes.search("area-a-filtrar-emergencia")
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                        }
                        if(x.classList.contains("total_hospitalizados")){
                            x.classList.remove("d-none");
                            //consulto el total
                            tablaPacientes.search("area-a-filtrar-hospitalizados")
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                        }
                        if(x.classList.contains("total_pad")){
                            x.classList.remove("d-none");
                            //consulto el total
                            tablaPacientes.search("area-a-filtrar-pad")
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                        }
                        if(x.classList.contains("total_uti")){
                            x.classList.remove("d-none");
                            //consulto el total
                            tablaPacientes.search("area-a-filtrar-uti_total")
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                        }
                        if(x.classList.contains("total_pacientes")){
                            x.classList.remove("d-none");
                            //consulto el total
                            tablaPacientes.search("area-a-filtrar-tp")
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                        }
                        if(x.classList.contains("total_sala_espera")){
                            x.classList.remove("d-none");
                            //consulto el total
                            tablaPacientes.search("area-a-filtrar-sala_espera")
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                        }
                    })


                    tablaPacientes.search(area_filtro)
                }
                if (
                        [
                            "area-a-filtrar-ea",
                            "area-a-filtrar-ecvd",
                            "area-a-filtrar-ep",
                            "area-a-filtrar-aq",
                            "area-a-filtrar-hp2",
                            "area-a-filtrar-hp3",
                            "area-a-filtrar-hp4",
                            "area-a-filtrar-hp5",
                            "area-a-filtrar-hp6",
                            "area-a-filtrar-utia",
                            "area-a-filtrar-uticvd",
                            "area-a-filtrar-utip",
                        ].includes(area_filtro)
                    ) {

                    $(`#areas_horizontal a[data-area_filtro="${area_filtro}"]`).tab('show')
                    //BUSCO EL NOMBRE DEL AREA
                    let area_title = state["MENU_AREAS"].filter(x=>x.area_filtro===area_filtro)[0];
                        D.querySelector("#area_title").textContent = area_title.description.toUpperCase()
                    btn.forEach(x=>{
                        if(x.classList.contains("total_pacientes")){
                            x.classList.remove("d-none");
                             //consulto el total
                            tablaPacientes.search(area_filtro)
                            x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length

                        }
                    })
                }

                let pad = "";
                if (
                    area_filtro.includes("covid")
                ) {
                    pad = "covid";
                }
                if (area_filtro.includes("postquirurgico")) {
                    pad = "postquirurgico";
                }
                if (area_filtro.includes("medico")) {
                    pad = "medico";
                }

                if ( ("area-a-filtrar-pad-"+pad) === area_filtro )
                {

                    let area_title = state["MENU_SUB_AREAS"].filter(x=>x.area_filtro===area_filtro)[0];
                        D.querySelector("#area_title").textContent = area_title.description.toUpperCase()

                        btn.forEach((x,y)=>{
                            if(x.classList.contains("btn-pad_numero")){
                                if((y+1) < 6){
                                    x.querySelector("a").dataset.area_filtro =  "area-a-filtrar-pad"+(y+1)+"-"+pad
                                    x.querySelector("a span").dataset.area_filtro =  "area-a-filtrar-pad"+(y+1)+"-"+pad
                                    tablaPacientes.search("area-a-filtrar-pad"+(y+1)+"-"+pad)
                                    x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                                }else{
                                    tablaPacientes.search("area-a-filtrar-pademp-"+pad)
                                    x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length
                                    x.querySelector("a").dataset.area_filtro =  "area-a-filtrar-pademp-"+pad
                                    x.querySelector("a span").dataset.area_filtro =  "area-a-filtrar-pademp-"+pad
                                }



                                x.classList.remove("d-none");

                            }
                            if(x.classList.contains("pad-"+pad)){
                                tablaPacientes.search("area-a-filtrar-pad-"+pad)
                                x.querySelector("a span").textContent=tablaPacientes.rows( { filter : 'applied'} ).nodes().length

                                x.classList.remove("d-none");
                            }

                        })
                        tablaPacientes.search(area_filtro).draw()
                }
                if (
                        [
                            "area-a-filtrar-pad1-"+pad,
                            "area-a-filtrar-pad2-"+pad,
                            "area-a-filtrar-pad3-"+pad,
                            "area-a-filtrar-pad4-"+pad,
                            "area-a-filtrar-pad5-"+pad,
                            "area-a-filtrar-pademp-"+pad,
                        ].includes(area_filtro)
                    ) {
                            btn.forEach(x=>{
                                if(x.classList.contains("btn-pad_numero")){
                                    x.classList.remove("d-none");
                                }
                                if(x.classList.contains("pad-"+pad)){
                                    x.classList.remove("d-none");
                                }
                            })

                            tablaPacientes.search(area_filtro).draw()
                }
                /*
                if (
                        [
                            "area-a-filtrar-pad1-postquirurgico",
                            "area-a-filtrar-pad2-postquirurgico",
                            "area-a-filtrar-pad3-postquirurgico",
                            "area-a-filtrar-pad4-postquirurgico",
                            "area-a-filtrar-pad5-postquirurgico",
                            "area-a-filtrar-pademp-postquirurgico",
                        ].includes(area_filtro)
                    ) {
                            console.log("postquirurgico------>","area-a-filtrar-pad1-"+pad)
                            btn.forEach(x=>{
                                if(x.classList.contains("btn-pad_numero")){
                                    x.classList.remove("d-none");
                                }
                                if(x.classList.contains("pad-"+pad)){
                                    x.classList.remove("d-none");
                                }
                            })

                            tablaPacientes.search(area_filtro).draw()
                }

                if (
                        [
                            "area-a-filtrar-pad1-medico",
                            "area-a-filtrar-pad2-medico",
                            "area-a-filtrar-pad3-medico",
                            "area-a-filtrar-pad4-medico",
                            "area-a-filtrar-pad5-medico",
                            "area-a-filtrar-pademp-medico",
                        ].includes(area_filtro)
                    ) {
                            console.log("medico------>","area-a-filtrar-pad1-"+pad)
                            btn.forEach(x=>{
                                if(x.classList.contains("btn-pad_numero")){
                                    x.classList.remove("d-none");
                                }
                                if(x.classList.contains("pad-"+pad)){
                                    x.classList.remove("d-none");
                                }
                            })

                            tablaPacientes.search(area_filtro).draw()
                }*/



            }
        let muestraPad = (pad)=>{
                $("#messageModal").modal("hide")

                btn_totales(pad.dataset.area_filtro)
            }
        let seleccionaPad = ()=>
            {
                $("#messageModal").modal("show")
                $("#messageModal .modal-body").html(`
                    <div id="form_pad">
                        <div id="menuPadPatiencare" class="list-group">
                            <span class="text-primary font-weight-bold menu-pad-title"">
                                Menú PAD
                            </span>
                            <a id="m_covid" href="#"  onclick="muestraPad(this)" data-area_filtro="area-a-filtrar-pad-covid" class="menu-pad list-group-item list-group-item-action"><i class="fas fa-viruses text-primary"></i> Covid</a>
                            <a id="m_quiru" href="#"  onclick="muestraPad(this)" data-area_filtro="area-a-filtrar-pad-postquirurgico"class="menu-quiru list-group-item list-group-item-action"><img src='/image/system/post_quirurgico.svg' style="width:20px;height:20px">Post-quirúrgico</a>
                            <a id="m_medico" href="#" onclick="muestraPad(this)"  data-area_filtro="area-a-filtrar-pad-medico"  class="menu-medic list-group-item list-group-item-action"><img src='/image/system/icono-medico-color-6.svg' style="width:20px;height:20px">Médico</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                            <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                        </div>
                    </div>
                `);


            }




            loadHomeMenu(state["MENU_HOME"]);
            loadAreaMenu(state["MENU_AREAS"],"areas");
            loadSubAreasSMenu();
            loadMarqueeMenu(state["MENU_MARQUEE"]);



            D.addEventListener("DOMContentLoaded", async function(){

                state["PACIENTES"] = await tp();
                pacientes_datos = state["PACIENTES"];

                loadViewCovid(state["PACIENTES"])
                D.querySelectorAll("li.filtro-area-opcion a").forEach(x=>{
                    x.addEventListener("click",(e)=>{
                        //cerramos el menu home
                        D.querySelector("body").classList.add("sidebar-collapse")

                        //console.log(e.target.dataset.area_filtro)
                        //para abrir el menu pad
                        if (e.target.dataset.area_filtro === "area-a-filtrar-pad") {
                            seleccionaPad()
                            return false;
                        }
                        tablaPacientes.search(e.target.dataset.area_filtro).draw()
                        btn_totales(e.target.dataset.area_filtro)
                    })
                })
            });



    </script>

@endsection
@section('css')

    <style>


        table.table-vertical-striped tbody td:nth-of-type(odd){ background:var(--light); }


        #pad_vertical .dropdown-item:hover, .dropdown-item:focus,
        #areas_vertical .dropdown-item:hover, .dropdown-item:focus {
            color: var(--white);
            text-decoration: none;
            background-color: var( --success);
            font-weight: 600;
        }


        #sub_areas_horizontal a span.badge{
            background-color: var(--white) !important;
            color: var(--primary)!important;
        }
        #sub_areas_horizontal>.nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--success);
        }
        #sub_areas_horizontal .nav-link.active span.badge{
            color: var(--success) !important;
            background-color: var(--white) !important;
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
    </style>
    <style>
        body {
            background-color: var(--light) !important;
        }

        .DTFC_Cloned {
            display: none;
        }



        thead {
            background-color: var(--gray) !important;
            color: var(--secondary) !important;
            text-align: center !important;
            text-transform: uppercase !important;
            white-space: nowrap !important;
        }

        .row-title {
            font-weight: 600;
            color: var(--primary) !important;
            font-size: 1.3em;

        }
        div.dt-buttons {
            float: none;
            width: 100%;
            text-align: left !important;
            margin: 0.2em !important;
        }
        .buttons-colvis:after{
            width: 100% !important;
            content: " de columnas" !important;
        }
        .dt-button-collection{
            background-color:var(--gray);
        }
        .dt-button-collection button{

            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid var(--success);
            padding: 0.375rem;
            font-size: 1rem;
            line-height: 1.5;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            border-radius: 0.25rem !important;
            box-shadow: none;
        }
        .dt-button.buttons-columnVisibility.active{
            background-color:var(--success);
            color:var(--white);
        }
        #example_filter {
            display: none;
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

        table#example>thead {
            position: sticky;
            top: -0.5vh;
            background-color: white;
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

        #example_filter {
            position: fixed !important;
            top: 8vh !important;
            right: 1em !important;
            z-index: 1111;
        }
        .btn-gray-custom-1{
            background-color: #e5e4e4;
            margin-right: 0.25rem !important;
            border-radius: 0.25rem !important;
        }
    </style>

    <style>
        .nav-pills .nav-link.active .badge.bg-gray.text-secondary, .nav-pills .show>.nav-link {
            color: var(--white) !important;
            background-color: var(--success);
        }
        #pad_vertical .dropdown-item:active, .dropdown-item:active
        #areas_vertical .dropdown-item.active, .dropdown-item:active {
            color: #ffffff;
            text-decoration: none;
            background-color: var(--success);
        }
        .navbar-search-block .input-group {
            width: 100%;
        }
        .content-header {
            padding: 0.3em;
            position: fixed;
            top: 8vh !important;
            width: 100vw;
            z-index: 1111;
            background-color: var(--light);
        }
        table#example1>thead {
            position: fixed;
            top: 14vh;
            background-color: white;
            z-index: 1;
            width: 100%;
        }
        .navbar-primary {
            background-color: var(--primary);
            color: var(--white);
        }
        .bg-light {
            background-color: var(--light)!important;
        }
        .bg-primary {
            background-color: var(--primary)!important;
        }
        .navbar-light .navbar-brand {
            color: var(--white);
        }

        .navbar-primary .navbar-nav .nav-link {
            color: var(--white);
        }
        .text-nowrap{
            white-space:nowrap !important;
        }
        .navbar-search-block {
            position: absolute;
            padding: 0 1rem;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
            display: none;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: var(--primary);
        }
        .btn-primary {
            color: #fff;
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: none;
        }
        button.btn-gray span.badge{
            font-size: 1em !important;
            color:var(--white) !important;
        }
        .btn-gray {
            color: var(--dark);
            background-color: var(--gray);
            border-color: var(--gray);
            box-shadow: none;
        }


        body:not(.layout-fixed) .main-sidebar {
            max-height: 91vh !important;
            min-height: 50vh !important;
            position: absolute;
            top: 4.5em;
            overflow: auto;
        }

        .main-header-custom {
            border-bottom: 1px solid var(--light);
            margin: 0.25rem !important;
            border-radius: 50rem !important;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1111 !important;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: var(--primary);
        }

        .card-primary.card-outline {
            border-top: 3px solid var(--primary);
        }

        a {
            color: var(--primary);
            text-decoration: none;
            background-color: transparent;
        }
        .display-custom {
            font-size: 1.5rem;
            font-weight: 500;
            line-height: 1.2;
            color:var(--primary);
            background-color:var(--light);
            padding: 0.5rem!important;
            text-align: center;
            border-radius: 0.25rem!important;
        }
        .home-user-info{
            display: none;
        }

        header{
            height:8vh;
        }
        main{
            max-height:92vh;
            overflow: auto;
        }
        #pad_vertical .dropdown-menu.show {
            display: block;
            position: fixed !important;
            top: auto !important;
            left: auto !important;
            will-change: transform !important;
            transform: translate3d(0px, 5px, 0px) !important;
        }
        /*
        .group-btn-paciente{
            background-color:var(--light);
        }*/
        /* Small devices (landscape phones, 576px and up)*/
        @media (min-width:0px) {
            #caja_areas{
                height: 0px;
            }
            #sub_areas_vertical,
            #areas_horizontal{
                display:none !important;
            }
        }
        @media (min-width: 576px) {
            #caja_areas{
                width: 22em !important;
                height: 40px;
            }
            .home-user-info{
                display:block;
            }
            .home-user-info-list{
                display:none !important;
            }
            #sub_areas_vertical,
            #areas_vertical{
                display:none !important;
            }
            #pad_horizontal,
            #areas_horizontal{
                display:flex !important;
            }
        }

        /* Medium devices (tablets, 768px and up)*/
        @media (min-width: 768px) {
            #caja_areas{
                width: 34em !important;
            }
            /*
            .group-btn-paciente{
                position:fixed;
                right:0;
                top:auto;
            }*/
        }

        /* Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {
            #caja_areas{
                width: 48em !important;
            }
        }

        /* Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            #caja_areas{
                width: 22em !important;
            }
        }
        @media (min-width: 1200px) {
            #caja_areas{
                width: 60em !important;
            }
        }
    </style>
            <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endsection

