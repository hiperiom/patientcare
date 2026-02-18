{{--
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation + Sidebar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <style>
        :root {

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
            --blue: #185BA9;
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
            color:var(--primary) !important;
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
            top: 3.5em;
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
        .text-primary {
            color: var(--primary)!important;
        }
        .bg-light, .bg-light>a {
            color: var(--secondary)!important;
        }
        /* Small devices (landscape phones, 576px and up)*/
        @media (min-width: 576px) {
            .home-user-info{
                display:block;
            }
            .home-user-info-list{
                display:none !important;
            }
        }

        /* Medium devices (tablets, 768px and up)*/
        @media (min-width: 768px) {  }

        /* Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {  }

        /* Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {}
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <header>
            <nav class="main-header-custom navbar navbar-expand-md navbar-primary">
                <ul class="navbar-nav">
                    <li class="nav-item">

                        <a class="nav-link p-0 pl-3" data-widget="pushmenu" href="#" role="button">
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
                        <a class="nav-link p-0 pr-2" style="padding-top: 13px !important;" data-widget="navbar-search"
                            href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block rounded-pill">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
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
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-slide="true" href="#" role="button">
                            <img class="" loading="lazy" style="height: 30px;" src="/image/system/patientcare_bw.svg">
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
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
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-hospital"></i>
                                    <p>
                                        Atención Hospitalaria
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-layer-group nav-icon"></i>
                                            <p>
                                                Hospitalización
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>HP2</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>HP3</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>HP4</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>HP5</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>HP6</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-ambulance nav-icon"></i>
                                            <p>
                                                Emergencia
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>EA</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>ECVD</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>EP</p>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-procedures nav-icon"></i>
                                            <p>
                                                Cuidado Intensivo
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>UTIA</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>UTICVD</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>UTIP</p>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-procedures nav-icon"></i>
                                            <p>
                                                Área Quirúrgica
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Torre Hospitalización</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Ambulatoria MAPM</p>
                                                </a>
                                            </li>


                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-clinic-medical"></i>
                                    <p>
                                        Atención Domiciliaria
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>PAD Covid</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                PAD Médico
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>PAD Diabetes</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>PAD Cardio</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>PAD Dolor</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>PAD Quirúrgico</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>PAD Oncológico</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>PAD Pediátrico</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Operatividad
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Pacientes
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Agregar</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Buscar</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Historia Inicial</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>PAD Oncológico</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>PAD Pediátrico</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-door-open"></i>
                                    <p>
                                        Salir

                                    </p>
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>

            </aside>


            <div class="content-wrapper" style="height: 95vh;">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-primary"> Total Pacientes</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <div  style="    width: 100%;
                                display: flex;
                                flex-direction: row-reverse;
                                overflow-x: auto;
                                white-space: nowrap;">
                                    <div class="d-flex flex-row ">
                                        <div>
                                            <button type="button" class="btn btn-gray rounded-pill">
                                                Hospitalizados <span class="badge badge-light">4</span>
                                            </button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-gray rounded-pill">
                                                Total Pacientes <span class="badge badge-light">4</span>
                                            </button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-success font-weight-bold">
                                                Nuevo Paciente
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>Rendering engine</th>
                                      <th>Browser</th>
                                      <th>Platform(s)</th>
                                      <th>Engine version</th>
                                      <th>CSS grade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                      <td>Trident</td>
                                      <td>Internet
                                        Explorer 4.0
                                      </td>
                                      <td>Win 95+</td>
                                      <td> 4</td>
                                      <td>X</td>
                                    </tr>
                                    <tr>
                                      <td>Trident</td>
                                      <td>Internet
                                        Explorer 5.0
                                      </td>
                                      <td>Win 95+</td>
                                      <td>5</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>Trident</td>
                                      <td>Internet
                                        Explorer 5.5
                                      </td>
                                      <td>Win 95+</td>
                                      <td>5.5</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Trident</td>
                                      <td>Internet
                                        Explorer 6
                                      </td>
                                      <td>Win 98+</td>
                                      <td>6</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Trident</td>
                                      <td>Internet Explorer 7</td>
                                      <td>Win XP SP2+</td>
                                      <td>7</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Trident</td>
                                      <td>AOL browser (AOL desktop)</td>
                                      <td>Win XP</td>
                                      <td>6</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Firefox 1.0</td>
                                      <td>Win 98+ / OSX.2+</td>
                                      <td>1.7</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Firefox 1.5</td>
                                      <td>Win 98+ / OSX.2+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Firefox 2.0</td>
                                      <td>Win 98+ / OSX.2+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Firefox 3.0</td>
                                      <td>Win 2k+ / OSX.3+</td>
                                      <td>1.9</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Camino 1.0</td>
                                      <td>OSX.2+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Camino 1.5</td>
                                      <td>OSX.3+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Netscape 7.2</td>
                                      <td>Win 95+ / Mac OS 8.6-9.2</td>
                                      <td>1.7</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Netscape Browser 8</td>
                                      <td>Win 98SE+</td>
                                      <td>1.7</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Netscape Navigator 9</td>
                                      <td>Win 98+ / OSX.2+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.0</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.1</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1.1</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.2</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1.2</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.3</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1.3</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.4</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1.4</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.5</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1.5</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.6</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>1.6</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.7</td>
                                      <td>Win 98+ / OSX.1+</td>
                                      <td>1.7</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Mozilla 1.8</td>
                                      <td>Win 98+ / OSX.1+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Seamonkey 1.1</td>
                                      <td>Win 98+ / OSX.2+</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Gecko</td>
                                      <td>Epiphany 2.20</td>
                                      <td>Gnome</td>
                                      <td>1.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>Safari 1.2</td>
                                      <td>OSX.3</td>
                                      <td>125.5</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>Safari 1.3</td>
                                      <td>OSX.3</td>
                                      <td>312.8</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>Safari 2.0</td>
                                      <td>OSX.4+</td>
                                      <td>419.3</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>Safari 3.0</td>
                                      <td>OSX.4+</td>
                                      <td>522.1</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>OmniWeb 5.5</td>
                                      <td>OSX.4+</td>
                                      <td>420</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>iPod Touch / iPhone</td>
                                      <td>iPod</td>
                                      <td>420.1</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Webkit</td>
                                      <td>S60</td>
                                      <td>S60</td>
                                      <td>413</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 7.0</td>
                                      <td>Win 95+ / OSX.1+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 7.5</td>
                                      <td>Win 95+ / OSX.2+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 8.0</td>
                                      <td>Win 95+ / OSX.2+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 8.5</td>
                                      <td>Win 95+ / OSX.2+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 9.0</td>
                                      <td>Win 95+ / OSX.3+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 9.2</td>
                                      <td>Win 88+ / OSX.3+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera 9.5</td>
                                      <td>Win 88+ / OSX.3+</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Opera for Wii</td>
                                      <td>Wii</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Nokia N800</td>
                                      <td>N800</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Presto</td>
                                      <td>Nintendo DS browser</td>
                                      <td>Nintendo DS</td>
                                      <td>8.5</td>
                                      <td>C/A<sup>1</sup></td>
                                    </tr>
                                    <tr>
                                      <td>KHTML</td>
                                      <td>Konqureror 3.1</td>
                                      <td>KDE 3.1</td>
                                      <td>3.1</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>KHTML</td>
                                      <td>Konqureror 3.3</td>
                                      <td>KDE 3.3</td>
                                      <td>3.3</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>KHTML</td>
                                      <td>Konqureror 3.5</td>
                                      <td>KDE 3.5</td>
                                      <td>3.5</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Tasman</td>
                                      <td>Internet Explorer 4.5</td>
                                      <td>Mac OS 8-9</td>
                                      <td>-</td>
                                      <td>X</td>
                                    </tr>
                                    <tr>
                                      <td>Tasman</td>
                                      <td>Internet Explorer 5.1</td>
                                      <td>Mac OS 7.6-9</td>
                                      <td>1</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>Tasman</td>
                                      <td>Internet Explorer 5.2</td>
                                      <td>Mac OS 8-X</td>
                                      <td>1</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>NetFront 3.1</td>
                                      <td>Embedded devices</td>
                                      <td>-</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>NetFront 3.4</td>
                                      <td>Embedded devices</td>
                                      <td>-</td>
                                      <td>A</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>Dillo 0.8</td>
                                      <td>Embedded devices</td>
                                      <td>-</td>
                                      <td>X</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>Links</td>
                                      <td>Text only</td>
                                      <td>-</td>
                                      <td>X</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>Lynx</td>
                                      <td>Text only</td>
                                      <td>-</td>
                                      <td>X</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>IE Mobile</td>
                                      <td>Windows Mobile 6</td>
                                      <td>-</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>Misc</td>
                                      <td>PSP browser</td>
                                      <td>PSP</td>
                                      <td>-</td>
                                      <td>C</td>
                                    </tr>
                                    <tr>
                                      <td>Other browsers</td>
                                      <td>All others</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>U</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                      <th>Rendering engine</th>
                                      <th>Browser</th>
                                      <th>Platform(s)</th>
                                      <th>Engine version</th>
                                      <th>CSS grade</th>
                                    </tr>
                                    </tfoot>
                                  </table>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
        </main>


        <template id="home-menu">

        </template>




    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
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
    <script>
        $(function () {
            var table = $('#example1').DataTable( {
        responsive: false,
        paging: false
    } );

    new $.fn.dataTable.FixedHeader( table );/*
            var table = $("#example1").DataTable({
            "paging": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          });//.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

          new $.fn.dataTable.FixedHeader( table );*/
        });
      </script>
    <!-- AdminLTE App -->
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes
    <script src="/AdminLTE-3.2.0/dist/js/demo.js"></script> -->
</body>

</html>
--}}


@extends('component.template')
@section('title')
CMDLT | PatientCare
@endsection
@section('header')
<nav id="headerNavbar" class="navbar shadow navbar-expand navbar-primary justify-content-between navbar-light navbar-v2">
    <ul class="navbar-nav">
        <li class="nav-item">

            <a class="nav-link p-0 pl-3" data-widget="pushmenu" href="#" role="button">
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
            <a class="nav-link p-0 pr-2" style="padding-top: 13px !important;" data-widget="navbar-search"
                href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block rounded-pill">
                <form class="form-inline">
                    <div class="input-group input-group-md">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
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
                </form>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hospital"></i>
                        <p>
                            Atención Hospitalaria
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>
                                    Hospitalización
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>HP2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>HP3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>HP4</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>HP5</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>HP6</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-ambulance nav-icon"></i>
                                <p>
                                    Emergencia
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>EA</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>ECVD</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>EP</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-procedures nav-icon"></i>
                                <p>
                                    Cuidado Intensivo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>UTIA</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>UTICVD</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>UTIP</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-procedures nav-icon"></i>
                                <p>
                                    Área Quirúrgica
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Torre Hospitalización</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Ambulatoria MAPM</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>
                            Atención Domiciliaria
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAD Covid</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    PAD Médico
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>PAD Diabetes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>PAD Cardio</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>PAD Dolor</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAD Quirúrgico</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAD Oncológico</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAD Pediátrico</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Operatividad
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pacientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Agregar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Buscar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Historia Inicial</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAD Oncológico</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAD Pediátrico</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>
                            Salir

                        </p>
                    </a>
                </li>
            </ul>

        </nav>
    </div>

</aside>
@endsection
@section('menu_2')
<div class="container-fluid bg-light" style="height:8vh">
    <div class="d-flex justify-content-between flex-nowrap">
        <div class="flex-fill">

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Areas
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>

                <nav id="v-pills-tab" role="tablist"
                    class="nav nav-pills d-none overflow-auto flex-row flex-nowrap flex-sm-row font-weight-bold" role="tablist">
                    <a id="area-tp" data-toggle="pill" data-area="" href="#area-01-tab" role="tab" aria-controls="area-01"
                        aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link active"
                        href="#area-01">TP</a>
                    <a id="area-ea" data-toggle="pill" data-area="ea" href="#area-02-tab" role="tab" aria-controls="area-02"
                        aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link" href="#area-02">EA</a>
                    <a id="area-ecvd" data-toggle="pill" data-area="ecvd" href="#area-03-tab" role="tab"
                        aria-controls="area-03" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-03">ECVD</a>
                    <a id="area-ep" data-toggle="pill" data-area="ep" href="#area-04-tab" role="tab" aria-controls="area-04"
                        aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link" href="#area-04">EP</a>
                    <a id="area-aq" data-toggle="pill" data-area="aq" href="#area-05-tab" role="tab" aria-controls="area-05"
                        aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link" href="#area-05">AQ</a>
                    <a id="area-hp2" data-toggle="pill" data-area="hp2" href="#area-06-tab" role="tab"
                        aria-controls="area-06" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-06">HP2</a>
                    <a id="area-hp3" data-toggle="pill" data-area="hp3" href="#area-07-tab" role="tab"
                        aria-controls="area-07" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-07">HP3</a>
                    <a id="area-hp4" data-toggle="pill" data-area="hp4" href="#area-08-tab" role="tab"
                        aria-controls="area-08" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-08">HP4</a>
                    <a id="area-hp5" data-toggle="pill" data-area="hp5" href="#area-09-tab" role="tab"
                        aria-controls="area-09" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-09">HP5</a>
                    <a id="area-hp6" data-toggle="pill" data-area="hp6" href="#area-10-tab" role="tab"
                        aria-controls="area-10" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-10">HP6</a>
                    <a id="area-utia" data-toggle="pill" data-area="utia" href="#area-11-tab" role="tab"
                        aria-controls="area-11" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-11">UTIA</a>
                    <a id="area-uticvd" data-toggle="pill" data-area="uticvd" href="#area-12-tab" role="tab"
                        aria-controls="area-12" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-12">UTICVD</a>
                    <a id="area-utip" data-toggle="pill" data-area="utip" href="#area-13-tab" role="tab"
                        aria-controls="area-13" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-13">UTIP</a>
                    <a id="area-pad" data-toggle="pill" data-area="pad" href="#area-14-tab" role="tab"
                        aria-controls="area-14" aria-selected="true" class="link-area flex-sm-fill text-sm-center nav-link"
                        href="#area-14">PAD</a>
                </nav>

        </div>
        <div>
            <button class="btn btn-success text-nowrap btn-block" data-widget="navbar-search"
                href="#" role="button">
                <i class="fas fa-user"></i>
                Nuevo Paciente
            </button>
        </div>
        <div>
             <a class="btn btn-outline-primary ml-1  btn-block" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="signosP" class="marquee-with-options">
                <marquee  onmouseout="this.start()" onmouseover="this.stop()" scrollamount="5"
                    style="width:600">
                    <a href="#ultimafila">
                    <span class="text-danger">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">90%</span> |
                        <span class="font-weight-bold text-gray">Keila Veruska Rodriguez Blanco</span> |
                        <span class="font-weight-bold text-gray">UTIA | UTIA</span>
                    </span>
                </a>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <span class="text-danger" onclick="filtroPriorizados('Angel Ramon Lima Avila')">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">90%</span> |
                        <span class="font-weight-bold text-gray">Angel Ramon Lima Avila</span> |
                        <span class="font-weight-bold text-gray">HP4 | Hab. 2410</span>
                    </span>

                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <span class="text-warning" onclick="filtroPriorizados('Rodrigo Reinaldo Chacon Garcia')">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">91%</span> |
                        <span class="font-weight-bold text-gray">Rodrigo Reinaldo Chacon Garcia</span> |
                        <span class="font-weight-bold text-gray">UTICvd | Cama. 10</span>
                    </span>

                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <span class="text-warning" onclick="filtroPriorizados('Jose Santiago Rodriguez Duarte')">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">91%</span> |
                        <span class="font-weight-bold text-gray">Jose Santiago Rodriguez Duarte</span> |
                        <span class="font-weight-bold text-gray">HP6 | Hab. 2610</span>
                    </span>

                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <span class="text-warning" onclick="filtroPriorizados('Alessandro Tassini Aciukian')">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">92%</span> |
                        <span class="font-weight-bold text-gray">Alessandro Tassini Aciukian</span> |
                        <span class="font-weight-bold text-gray">PAD | PAD - 1</span>
                    </span>

                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <span class="text-warning" onclick="filtroPriorizados('Sun Yick Fung Chang')">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">93%</span> |
                        <span class="font-weight-bold text-gray">Sun Yick Fung Chang</span> |
                        <span class="font-weight-bold text-gray">UTICvd | Cama. 1</span>
                    </span>

                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <span class="text-warning" onclick="filtroPriorizados('Rodrigo Garnica Gelviz')">
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">93%</span> |
                        <span class="font-weight-bold text-gray">Rodrigo Garnica Gelviz</span> |
                        <span class="font-weight-bold text-gray">HP4 | Hab. 2409</span>
                    </span>
                </marquee>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="height:6vh">
    {{--
    <div class="row mx-0">
        <div class="col-4 p-0 overflow-auto">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. In, hic odit sapiente nobis at animi nam excepturi accusantium inventore, impedit dolorum expedita, amet voluptates molestias dolor harum incidunt suscipit vero?
            Modi error corrupti praesentium similique consequuntur assumenda accusantium quisquam laboriosam voluptates cum officia at ipsam incidunt voluptatem eligendi voluptatibus, totam, quasi, quaerat unde ullam iste sed animi amet. Fuga, illum!
            Reprehenderit provident aliquam repudiandae fugit! Architecto minima quasi amet obcaecati corrupti ipsa nulla harum non expedita natus. At asperiores praesentium neque quibusdam cum architecto officiis! Laboriosam labore minus beatae. Assumenda?
            Natus a facilis adipisci soluta totam, ducimus asperiores harum laudantium assumenda reprehenderit quidem quos nesciunt aliquam veritatis voluptates eum molestias id esse aperiam repellat vel, porro suscipit provident? Est, accusamus.
            Ad, doloremque dolore. Tempore obcaecati quas quisquam, illum exercitationem consectetur laborum iusto eveniet cum aliquid alias velit deserunt deleniti veniam officiis. Repudiandae rerum ipsum, sapiente sit tempora maxime nemo unde!
            Ratione, est dignissimos et nam iste quia nihil libero id necessitatibus possimus culpa quos cumque alias? Aut laboriosam corporis possimus pariatur ducimus repudiandae dolorum doloribus iusto rerum. Laboriosam, error eum!
            Unde dicta deleniti cum ut, repellendus cumque doloribus minus corporis perferendis? Sed illum, nihil dolores quis quidem nemo optio blanditiis suscipit itaque reiciendis consequuntur facere nisi voluptas recusandae sit voluptatibus?
            Possimus, asperiores adipisci voluptas delectus ipsam facilis. Eveniet rerum, perferendis quia asperiores dolores eos velit enim expedita explicabo placeat. Culpa itaque libero provident harum quasi voluptatum quo odit vel accusantium!
            Repellendus rem dolores fugiat eum, eaque officiis nostrum placeat illum. Quam minus optio velit, expedita omnis quis quo consectetur perferendis mollitia aspernatur nam obcaecati, sapiente laborum quidem unde! Sequi, minima.
            Officia eveniet ipsum, sint esse dicta voluptas laudantium dolore nihil iusto molestias culpa animi nam vero tenetur pariatur, dolorum officiis voluptatibus quasi quaerat corrupti rerum qui quos. Consectetur, velit reprehenderit.
            <!--
            <div class="d-flex row-flex justify-content-between">
                <div>
                    <div class="row-title badge badge-light" style="border-radius: 1em;">
                        Entrega de guardia
                    </div>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end">

                    <button type="button" class="btn btn-gray text-nowrap mx-1">
                        Total Pacientes <span id="total_paciente" class="badge bg-primary">0</span>
                    </button>

                </div>

            </div> -->
        </div>
        <div class="col-6 p-1">

        </div>
        <div class="col-2 p-1">
            <a class="btn btn-primary btn-block"  data-widget="navbar-search"
                href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
        </div>
    </div>--}}
</div>

@endsection
@section('content')
@yield('menu_2')

<div class="container-fluid bg-light overflow-auto" style="height:76vh">
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
            <table id="example" class="table table-bordered table-striped bg-white">
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
                    {{--
                    <tr>
                        <td colspan="11">
                            <div class="d-flex m-4 justify-content-center text-primary">
                                Cargando...
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </td>
                    </tr> --}}
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 5.0
                        </td>
                        <td>Win 95+</td>
                        <td>5</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 5.5
                        </td>
                        <td>Win 95+</td>
                        <td>5.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 6
                        </td>
                        <td>Win 98+</td>
                        <td>6</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet Explorer 7</td>
                        <td>Win XP SP2+</td>
                        <td>7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>AOL browser (AOL desktop)</td>
                        <td>Win XP</td>
                        <td>6</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.5</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 2.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 3.0</td>
                        <td>Win 2k+ / OSX.3+</td>
                        <td>1.9</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Camino 1.0</td>
                        <td>OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Camino 1.5</td>
                        <td>OSX.3+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Netscape 7.2</td>
                        <td>Win 95+ / Mac OS 8.6-9.2</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Netscape Browser 8</td>
                        <td>Win 98SE+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Netscape Navigator 9</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.0</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.1</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.2</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.2</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.3</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.3</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.4</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.4</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.5</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.6</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.6</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.7</td>
                        <td>Win 98+ / OSX.1+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.8</td>
                        <td>Win 98+ / OSX.1+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Seamonkey 1.1</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Epiphany 2.20</td>
                        <td>Gnome</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 1.2</td>
                        <td>OSX.3</td>
                        <td>125.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 1.3</td>
                        <td>OSX.3</td>
                        <td>312.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 2.0</td>
                        <td>OSX.4+</td>
                        <td>419.3</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 3.0</td>
                        <td>OSX.4+</td>
                        <td>522.1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>OmniWeb 5.5</td>
                        <td>OSX.4+</td>
                        <td>420</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>iPod Touch / iPhone</td>
                        <td>iPod</td>
                        <td>420.1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>S60</td>
                        <td>S60</td>
                        <td>413</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 7.0</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 7.5</td>
                        <td>Win 95+ / OSX.2+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 8.0</td>
                        <td>Win 95+ / OSX.2+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 8.5</td>
                        <td>Win 95+ / OSX.2+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 9.0</td>
                        <td>Win 95+ / OSX.3+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 9.2</td>
                        <td>Win 88+ / OSX.3+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 9.5</td>
                        <td>Win 88+ / OSX.3+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera for Wii</td>
                        <td>Wii</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Nokia N800</td>
                        <td>N800</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Nintendo DS browser</td>
                        <td>Nintendo DS</td>
                        <td>8.5</td>
                        <td>C/A<sup>1</sup></td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.1</td>
                        <td>KDE 3.1</td>
                        <td>3.1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.3</td>
                        <td>KDE 3.3</td>
                        <td>3.3</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.5</td>
                        <td>KDE 3.5</td>
                        <td>3.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 4.5</td>
                        <td>Mac OS 8-9</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 5.1</td>
                        <td>Mac OS 7.6-9</td>
                        <td>1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 5.2</td>
                        <td>Mac OS 8-X</td>
                        <td>1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>NetFront 3.1</td>
                        <td>Embedded devices</td>
                        <td>-</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>NetFront 3.4</td>
                        <td>Embedded devices</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Dillo 0.8</td>
                        <td>Embedded devices</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Links</td>
                        <td>Text only</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Lynx</td>
                        <td>Text only</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>IE Mobile</td>
                        <td>Windows Mobile 6</td>
                        <td>-</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>PSP browser</td>
                        <td>PSP</td>
                        <td>-</td>
                        <td>C</td>
                      </tr>
                      <tr id="ultimafila">
                        <td>Other browsers</td>
                        <td>All others</td>
                        <td>-</td>
                        <td>-</td>
                        <td>U</td>
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
<script src="/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
{{--
    <script>
        let opcionesMenu =[
                {
                    image      : "fa-home",
                    description: "Inicio",
                    route      : "/"
                },
                {
                    image      : "fa-user-md",
                    description: "Equipo Médico",
                    route      : "/medico/index_medicos"
                },
                {
                    image      : "fa-notes-medical",
                    description: "Especialidades",
                    route      : ()=>{
                        CatUserEspecialidad.menuEspecialidad('.modal-body');
                    }
                },
                {
                    image      : "fa-book-medical",
                    description: "Clasificador CIE-11",
                    route      : ()=>{
                        UserCuestEpisodio.indexEpisodioCIE11({});
                    }
                },
                {
                    image      : "fa-address-book",
                    description: "Entrega de guardia",
                    route      : ()=>{
                        UserCuestEpisodio.indexEntregaGuardia({})
                    }
                },
                {
                    image      : "fa-external-link-alt",
                    description: "/paciente/create",
                    route      : "/paciente/create"
                },

            ]
    </script>

    <script>

            let d = document;
                d.addEventListener("DOMContentLoaded", async function(){
                    console.log(await tp())
                })
            const AreaSwitch = (a)=> {
                let area_id;
                    switch (a) {
                        default: area_id=[]; break;
                        case 'ea':area_id=[2,3,270]; break;
                        case 'ecvd':area_id=[6,7,10]; break;
                        case 'ep':area_id=[29,32]; break;
                        case 'aq':area_id=[41]; break;
                        case 'hp2':area_id=[42,43]; break;
                        case 'hp3':area_id=[70,71]; break;
                        case 'hp4':area_id=[99,98]; break;
                        case 'hp5':area_id=[126,127]; break;
                        case 'hp6':area_id=[154,155]; break;
                        case 'utia':area_id=[183,182]; break;
                        case 'uticvd':area_id=[194,195]; break;
                        case 'utip':area_id=[212]; break;
                        case 'pad':area_id=[223,224,225,226,227,228,229,357]; break;
                    }
                    $('#area-'+a).tab('show')
                return area_id;
            }
            let table;
            let getArea_id = "tp"
            let area_id = AreaSwitch(getArea_id)
                //console.log(getArea_id)
                /*
            $(document).ready( function () {

                model.then(response=>{
                    pacientes_datos = model
                    if (response.length > 0) {
                        pacientes_datos = response


                        $(".link-area").on("click", function () {
                            let area_id = AreaSwitch($(this).data("area"))
                            let model =[];
                            if (area_id.length > 0) {
                                area_id.forEach((y,index)=>{
                                    pacientes_datos.forEach(x =>{
                                        if (x.parent_cat_user_ubicacion_id === y) {
                                            model.push(x)
                                        }
                                    })
                                })

                            }else{
                                model = pacientes_datos;
                            }
                            if (model.length > 0) {
                                table.clear().destroy()

                            }else{
                                $("#sinresultados").css("display","flex")

                                $("#example,#example_wrapper").css("display","none")
                                $("#cargando").css("display","none")

                            };
                        });
                        $("#search").trigger("focus");
                    }else{
                        $("#sinresultados").css("display","flex")

                    }

                })

                var minutos =1;//valor a cambiar
                var milisegundos = minutos*60000;
                setInterval(function () {
                    get('/sessionExist')
                    .then(response=>{
                        if(response){

                            message = Component.alertMessage("expire_sesion");
                            Toast.fire({
                                icon: message['imagen'],
                                title: message['title'],
                                text: message['message'],
                                timer:15000,
                                didOpen: () => {
                                    setInterval(() => {
                                        location.href = '/finalizarSesion'
                                    }, 14000)
                                },
                            }).then((result) => {

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
                },milisegundos);




            });*/

    </script>
--}}
@endsection
@section('css')
    <style>
        #menu-pad>.nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff !important;
            background-color: var(--success);
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
    </style>

    <style>
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
            color:var(--primary) !important;
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
            top: 3.5em;
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


        /* Small devices (landscape phones, 576px and up)*/
        @media (min-width: 576px) {
            .home-user-info{
                display:block;
            }
            .home-user-info-list{
                display:none !important;
            }
        }

        /* Medium devices (tablets, 768px and up)*/
        @media (min-width: 768px) {  }

        /* Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {  }

        /* Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {}
    </style>
@endsection

