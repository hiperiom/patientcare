<!DOCTYPE html>
<html lang="es">
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
@php

    $version = $model['version'];
    $version_impresion = [
        "bw" =>[
            "backgroundColor"=>"#fff",
            "fontColor"=>"#000",
            "boxTextColor"=>"#fff",
            "boxTextBottomLine"=>"#f0f0f0",
            "logoSystemVersion"=>"logo-informe-bw.png",
            "headerTitleColor"=>"#000",
            "headerBgColor"=>"#fff",
            "imgCheck"=>"check2.png",
            "signsMiddleLine"=>"#f0f0f0",
            "priority-1"=>"#fc000050",
            "priority-2"=>"#ff880050",
            "priority-3"=>"#fbff0048",
            "priority-4"=>"#0fb3004b",
            "priority-5"=>"#00a2ff49",
        ],
        "color" =>[
            "backgroundColor"=>"#fff",
            "fontColor"=>"#000",
            "boxTextColor"=>"#fff",
            "boxTextBottomLine"=>"#f0f0f0",
            "logoSystemVersion"=>"logo-informe-bw.png",
            "headerTitleColor"=>"#000",
            "headerBgColor"=>"#fff",
            "imgCheck"=>"check2.png",
            "signsMiddleLine"=>"#f0f0f0",
            "priority-1"=>"#fc000050",
            "priority-2"=>"#ff880050",
            "priority-3"=>"#fbff0048",
            "priority-4"=>"#0fb3004b",
            "priority-5"=>"#00a2ff49",
        ],
    ];

    if ($version) {
        $v = $version_impresion["color"];
    }else{
        $v = $version_impresion["bw"];
    }
@endphp
<head>
    <style>
        @page {
            margin: 0cm;
            font-family: 'Helvetica' !important;
        }

        .page-break {
            page-break-after: always;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 50px;

            color: white;
            text-align: center;

        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 50px;

            color: white;
            text-align: center;
            line-height: 35px;
        }
        main {
            /* margin-top:1.5em; */
            color: rgb(70, 69, 69);
            text-align: justify;
            font-size: 1em;
            font-family: 'Helvetica' !important;
        }

        body {
            background-color:  {{ $v['backgroundColor'] }};
        }

        nav.navbar-level-1 {
            /* border:1px solid red; */
            height: 50px;
            text-align: right;
            padding: 0.5%;
        }
        .border-box-respuesta{
            border: 0px solid #000;
        }
        .text-secondary {
            color: #58585B;
        }

        .text-primary {
            color: {{ $v['fontColor'] }} /* #185BA9 */  ;
        }
        .header-title-color{
            color: {{ $v['headerTitleColor'] }};
        }
        .bg-primary {
            background-color: #185BA9;
        }
        .header-bg-color {
            background-color: {{ $v['headerBgColor'] }} /* #185BA9 */;
        }

        .bg-white {
            background-color:{{ $v['boxTextColor'] }} /* #ecebeb */;
        }

        nav.navbar-level-2 {
            padding: 0 10 0 10;
            background-color: #BFD9ED;
            font-size: 12px;
        }

        .w-100 {
            width: 100%;
        }
        h3,
        h2,
        h4 {
            margin: 0;
            padding: 0;
        }

        section {
            /* margin: 0 20px 0 20px; */
            padding: 5px;
        }

        .rounded {
             border-radius: 10px;
        }
        .box-text-bottom-line{
            border-bottom: 1px solid {{ $v['boxTextBottomLine'] }}
        }
        .signs-middle-line{
            border-right: 1px dashed {{ $v['signsMiddleLine'] }};
        }
        .priority-1{
            background-color:{{ $v['priority-1'] }};
        }
        .priority-2{
            background-color:{{ $v['priority-2'] }};
        }
        .priority-3{
            background-color:{{ $v['priority-3'] }};
        }
        .priority-4{
            background-color:{{ $v['priority-4'] }};
        }
        .priority-5{
            background-color:{{ $v['priority-5'] }};
        }
        .imagen img {

            width: 100%;
            height: 50%;

        }
        .text-center{
            text-align:center;
        }
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .badge-secondary {
            color: #6C757D;
            background-color: #e0e9f0;
        }
    </style>

</head>

<body>
    <script type="text/php">
        /*if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }*/
    </script>
    <header>
        <nav class="navbar-level-1 header-bg-color">
            <table  style="width:100%; margin:0px !important;">
                <tr>
                    <td valign="top" >
                        <h1 class="header-title-color" style="font-size:25px;position:absolute;left:10;top:-10; margin-top:28px;">
                            Informe Médico
                        </h1>
                        @php
                            //dd($model['logo']);
                        @endphp

                        <img src="image/system/logo-informe-bw.png" style="height:45px;position:absolute;right:10" alt="Logo">
                    </td>
                </tr>
            </table>
        </nav>
    </header>
    <section  style="margin-top:60px; ">
        <table>

            <tr>

                <td style="width:60px;">
                    <h4 class="text-primary" style="margin-bottom:4px;">Fecha:</h4>
                </td>
                <td style="width:100px;" valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary text-center" style=" font-size:12px; ">
                            {{date('d-m-Y')}}
                        </div>
                    </div>
                </td>
                <td style="width:60px;">
                    <h4 class="text-primary" style="margin-bottom:4px;text-align:right">Hora:</h4>
                </td>
                <td style="width:100px;" valign="top" class="text-secondary">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary text-center" style=" font-size:12px; ">
                            {{date('g:i A')}}
                        </div>
                    </div>
                </td>
                {{-- <td >
                    <h4 class="text-primary" style="margin-bottom:4px;text-align:right">Centro Médico:</h4>
                </td>
                <td style="" valign="top" class="text-secondary">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary text-center" style=" font-size:12px; ">
                            {{$model['user_centro_salud']['description']}}
                        </div>
                    </div>
                </td> --}}
            </tr>

        </table>
    </section>
    <section>
        <table style="width:100%; border-radius:10px;">
            <tr>
                <td valign="top" >
                    <!-- Datos del paciente -->
                    <h4 class="text-primary" style="margin-bottom:4px">Paciente</h4>
                    <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:170px;overflow:hidden;">
                        <table class="text-primary" style="width:100%;font-size: 12px;margin-right:20px;">

                            <tr>
                                {{-- <td valign="top" style="width:50px;" rowspan="6" >
                                    @php
                                        $slash = substr( $model['user']['IMAGE_PACIENTE'] , 0,1);
                                        $imagen = "";
                                        if ($slash =="/") {
                                            $imagen = substr($model['user']['IMAGE_PACIENTE'],1);
                                        }else{
                                            $imagen = substr($model['user']['IMAGE_PACIENTE'],1);
                                        }
                                    @endphp
                                    <img src="image/system/patient.svg" style="width:50px;height:50px; border-radius:20px;" alt="Foto Paciente">
                                </td> --}}
                                <th style="width:20px;" nowrap valign="top" align="left">
                                    Nombres:
                                </th>
                                <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">

                                    {{ $model['user']['PACIENTE'] }}
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20px;" nowrap valign="top" align="left">
                                    Cédula:
                                </th>
                                <td class="text-secondary  box-text-bottom-line" style="padding-bottom:5px">
                                    {{ $model['user']['CEDULA'] }}
                                </td>
                            </tr>
                            <tr>
                                <th nowrap valign="top" align="left">
                                    Edad:
                                </th>
                                <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                    {{ $model['user']['EDAD'] }} Años
                                </td>
                            </tr>
                            <tr>
                                <th nowrap valign="top" align="left">
                                    Género:
                                </th>
                                <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                    {{ $model['user']['GENERO'] }}
                                </td>
                            </tr>
                            <tr>
                                <th nowrap valign="top" align="left">
                                    Teléfono:
                                </th>
                                <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                    {{ $model['user']['TELEFONO'] }}
                                </td>
                            </tr>
                            <tr>
                                <th nowrap valign="top" align="left" style="padding-bottom:5px">
                                    Dirección:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    <div style="overflow:hidden;min-height:15px;max-height:30px;">
                                        @if (isset($model['user']['DIRECTION']))
                                        {{ $model['user']['DIRECTION'] }}
                                        @endif

                                    </div>

                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" >
                    <!-- Antecedentes del paciente -->
                    <h4 class="text-primary" style="margin-bottom:4px">Antecedentes</h4>
                    <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:145px;overflow:hidden;">

                        <table class="text-primary" style="width:100%;font-size: 12px;">
                            @if (count($model['antecedentes']) == 0)
                                <tr>
                                    <td colspan="2" class="text-secondary box-text-bottom-line text-center" style="padding-bottom:5px">
                                        No posee
                                    </td>
                                </tr>
                            @else
                                @foreach ($model['antecedentes'] as $key => $item)
                                    <tr>
                                        <th style="width:20px;" nowrap valign="top" align="left">
                                            {{ $key+1 }}
                                        </th>
                                        <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                            <span class="badge badge-secondary">{{date('d-m-Y', strtotime($item['created_at']))}}</span>
                                            {{$item['value']}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <!-- Condición Médica Preexistente -->
                    <h4 class="text-primary" style="margin-bottom:4px">Condición Médica Preexistente</h4>
                    <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:145px;overflow:hidden;">
                        <table class="text-primary" style="width:100%;font-size: 12px;">
                            @if (count($model['condicion_medica']) == 0)
                                <tr>
                                    <td colspan="2" class="text-secondary box-text-bottom-line text-center" style="padding-bottom:5px">
                                        No posee
                                    </td>
                                </tr>
                            @else
                                @foreach ($model['condicion_medica'] as $key => $item)
                                    @php
                                       // dd($item);
                                    @endphp
                                    <tr>
                                        <th style="width:20px;" nowrap valign="top" align="left">
                                            {{ $key+1 }}
                                        </th>
                                        <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                            <span class="badge badge-secondary">{{date('d-m-Y', strtotime($item['created_at']))}}</span>
                                            {{$item['value']}}

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <!-- Medicamentos de uso diario -->
                    <h4 class="text-primary" style="margin-bottom:4px">Medicamentos de uso diario</h4>
                    <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:145px;overflow:hidden;">
                        <table class="text-primary" style="width:100%;font-size: 12px;">
                            @if (count($model['medicamentos']) == 0)
                                <tr>
                                    <td colspan="2" class="text-secondary box-text-bottom-line text-center" style="padding-bottom:5px">
                                        No posee
                                    </td>
                                </tr>
                            @else
                                @foreach ($model['medicamentos'] as $key => $item)
                                    @php
                                       // dd($item);
                                    @endphp
                                    <tr>
                                        <th style="width:20px;" nowrap valign="top" align="left">
                                            {{ $key+1 }}
                                        </th>
                                        <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                            <span class="badge badge-secondary">{{date('d-m-Y', strtotime($item['created_at']))}}</span>
                                            {{$item['medicamento']}}

                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </table>
                    </div>
                    <!-- Condición Médica Preexistente -->
                    <h4 class="text-primary" style="margin-bottom:4px">Alergias</h4>
                    <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:145px;overflow:hidden;">
                        <table class="text-primary" style="width:100%;font-size: 12px;">
                            @if (count($model['alergias']) == 0)
                                <tr>
                                    <td colspan="2" class="text-secondary box-text-bottom-line text-center" style="padding-bottom:5px">
                                        No posee
                                    </td>
                                </tr>
                            @else
                                @foreach ($model['alergias'] as $key => $item)
                                    @php
                                    // dd($item);
                                    @endphp
                                    <tr>
                                        <th style="width:20px;" nowrap valign="top" align="left">
                                            {{ $key+1 }}
                                        </th>
                                        <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                            <span class="badge badge-secondary">{{date('d-m-Y', strtotime($item['created_at']))}}</span>
                                            {{$item['value']}}

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </section>



    <footer class="text-secondary header-bg-color" >
       <table style="width:100%;font-size:10px;">
            <tr>
                <td class="header-title-color" valign="middle" width="50%" height="40px" style="text-align:center;padding-left:20px">
                    <b> {{$model['user_centro_salud']['description']}} </b> - {{$model['user_centro_salud']['coments']}} -
                    <b>Teléfonos:</b> {{$model['user_centro_salud_telefono']}}
                </td>
            </tr>
            {{-- <tr>
                <td class="header-title-color" valign="middle" width="50%" height="40px" style="text-align:center;padding-left:20px">
                    Avenida Intercomunal La Trinidad,
                    El Hatillo, Apartado Postal 80474
                    Caracas, Venezuela 1080-A. +58 (0212) 949.6411 - +58 (0212) 945.6346 [Fax]
                </td>
            </tr> --}}
       </table>
       {{--  {{ $model["FECHA_INFORME"] }}  --}}
    </footer>

    <div class="page-break"></div>
    <header><header>
        <section style="margin-top:60px; ">
            <table  style="width:100%; border-radius:10px;">

                <tr>
                    {{-- <td valign="top" style="width:70%" > --}}
                    <td valign="top" style="width:100%" >
                        <!-- Antecedentes del paciente -->
                        <h4 class="text-primary" style="margin-bottom:4px">Motivo de consulta</h4>
                        <div class="rounded border-box-respuesta bg-white text-secondary" style="font-size:12px;margin:5px;padding:5px; height:120px;overflow:hidden;">
                            {{ $model['motivo_consulta'] }}
                        </div>
                        <!-- Antecedentes del paciente -->
                        <h4 class="text-primary" style="margin-bottom:4px">Enfermedad Actual</h4>
                        <div class="rounded border-box-respuesta bg-white text-secondary" style="font-size:12px;margin:5px;padding:5px; height:120px;overflow:hidden;">
                            {{ $model['enfermedad_actual'] }}
                        </div>
                        <!-- Antecedentes del paciente -->
                        <h4 class="text-primary" style="margin-bottom:4px">Examen Físico</h4>
                        <div class="rounded border-box-respuesta bg-white text-secondary" style="font-size:12px;margin:5px;padding:5px; height:120px;overflow:hidden;">
                            {{ $model['examen_fisico'] }}
                        </div>
                        <!-- Antecedentes del paciente -->
                        <h4 class="text-primary" style="margin-bottom:4px">Impresión Diagnóstica</h4>
                        <div class="rounded border-box-respuesta bg-white text-secondary" style="font-size:12px;margin:5px;padding:5px; height:120px;overflow:hidden;">
                            {{ $model['impresion_diagnostica'] }}
                        </div>
                        <!-- Antecedentes del paciente -->
                        <h4 class="text-primary" style="margin-bottom:4px">Plan</h4>
                        <div class="rounded border-box-respuesta bg-white text-secondary" style="font-size:12px;margin:5px;padding:5px; height:120px;overflow:hidden;">
                            {{ $model['plan'] }}
                        </div>
                    </td>
                    {{-- <td valign="top" style="width:30%"> --}}
                        <!-- Medicamentos de uso diario -->
                        {{--
                        <h4 class="text-primary" style="margin-bottom:4px">Signos Vitales</h4>
                        <!-- inicio signo vital -->
                        <span class="text-secondary" style="margin-bottom:4px;font-size:8px;">Temperatura</span>
                        @php
                            $model['temp']=37.8;
                            $model['temp_porcentaje'] = 0;
                            if ($model['temp'] <= 30.4) { //cyan
                                if ($model['temp'] < 0) {
                                    $model['temp'] = 0;
                                }
                                $model['temp_porcentaje'] = $model['temp'] * 50 / 30.4;
                                $side ="left";
                                $style ="#009999;";
                            }
                            if ($model['temp'] >= 30.5 && $model['temp'] <= 37.5 ) { //verde
                                $model['temp_porcentaje'] = 50;//%
                                $temp = 7 -(37.5 - $model['temp']);
                                $model['temp_porcentaje'] += $temp * 90 / 7;//%
                                $side ="left";
                                $style ="green;";
                            }
                            if ($model['temp'] >= 37.6 && $model['temp'] <= 37.9 ) { //verde
                                $model['temp_porcentaje'] = 140;//%
                                $temp = (37.9 - $model['temp']);
                                $temp = $temp == 0 ? 4 : $temp * 10 ;

                                $temp = 7.5 * $temp;

                                $model['temp_porcentaje'] += $temp;//%
                                $side ="left";
                                $style ="orange;";
                            }
                            if ($model['temp'] >= 38) { //red
                                $model['temp_porcentaje'] = 130;
                                $b = $model['temp'];
                                $style ="red;";
                                if ($b > 45) {
                                    $b = 45;

                                }
                                $temp = ( (45 - $b) == 0 ? 7 : (45 - $b) ) * 45 / 7;
                                $model['temp_porcentaje'] += $temp; //($temp * 70 / 7)-(70*100/220);//%
                                $side ="right";

                            }
                        @endphp
                        <div class="rounded border-box-respuesta bg-white" style="width:220px;font-size:12px;margin:2px;/* padding:2px */; height:40px;overflow:hidden;">
                            <ul style="list-style: none;margin:0px;padding:0px;">
                                <li>
                                    <div style="

                                        margin-left:{{ $model['temp_porcentaje'] }}px;
                                        width:40px;
                                        border-{{ $side }}: 2px solid {{$style}};
                                        height:28px;
                                        float:left;
                                        text-align:center;
                                        ">
                                         <div style="
                                            background-color:{{$style}};color:white;
                                            width:100%;
                                            font-size:10px;
                                            margin:0px;
                                        ">
                                            {{ $model['temp'] }}°C
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0" style="width:220px;margin-top:15px;">
                                        <tr>
                                            <td style="width:50px;height:10px;color:white;background-color:#71e4f8;"></td>
                                            <td style="width:90px;height:10px;color:white;background-color:#4b7c4b;"></td>
                                            <td style="width:10px;height:10px;color:white;background-color:#fac460;"></td>
                                            <td style="width:70px;height:10px;color:white;background-color:#f87171;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#71e4f8;">Malo</td>
                                            <td style="width:90px;font-size:8px;text-align:center;height:10px;color:#4b7c4b;">Bueno</td>
                                            <td style="width:10px;font-size:8px;text-align:center;height:10px;color:#fac460;">Cuidado</td>
                                            <td style="width:70px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div>
                        <!-- fin signo vital -->
                        <!-- inicio signo vital -->
                        <span class="text-secondary" style="margin-bottom:4px;font-size:8px;">Oximetría</span>
                        @php
                            $model['oxi']=100;
                            $model['oxi_porcentaje'] = 0;
                             if ($model['oxi'] <= 90) {
                                if ($model['oxi'] < 0) {
                                    $model['oxi'] = 0;
                                }
                                $model['oxi_porcentaje'] = $model['oxi'] * 120 / 90;
                                $side ="left";
                                $style ="red;";
                            }
                            if ($model['oxi'] >= 90.1 && $model['oxi'] <= 93.9 ) {
                                $model['oxi_porcentaje'] = 120;//%
                                $temp = (93.9 - $model['oxi']);
                                $temp = $temp == 0 ? 1 : $temp ;

                                $temp = 7.18 * (3.9 - $temp);

                                $model['oxi_porcentaje'] += $temp;//%
                                $side ="left";
                                $style ="orange";
                            }
                            if ($model['oxi'] >= 94) { //red 149
                                $model['oxi_porcentaje'] = 149;
                                $b = $model['oxi'];
                                $style ="green;";
                                if ($b > 100) {
                                    $b = 100;

                                }
                                $temp = (100 - $b);
                                $temp = 4.3 * (6 - $temp);
                                $model['oxi_porcentaje'] += $temp;
                                $side ="right";

                            }
                        @endphp
                        <div class="rounded border-box-respuesta bg-white" style="width:220px;font-size:12px;margin:2px;/* padding:2px */; height:40px;overflow:hidden;">
                            <ul style="list-style: none;margin:0px;padding:0px;">
                                <li>
                                    <div style="

                                        margin-left:{{ $model['oxi_porcentaje'] }}px;
                                        width:40px;
                                        border-{{ $side }}: 2px solid {{$style}};
                                        height:28px;
                                        float:left;
                                        text-align:center;
                                        ">
                                         <div style="
                                            background-color:{{$style}};color:white;
                                            width:100%;
                                            font-size:10px;
                                            margin:0px;
                                        ">
                                            {{ $model['oxi'] }}%
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0" style="width:220px;margin-top:15px;">
                                        <tr>
                                            <td style="width:120px;height:10px;color:white;background-color:#f87171;"></td>
                                            <td style="width:10px;height:10px;color:white;background-color:#fac460;"></td>
                                            <td style="width:90px;height:10px;color:white;background-color:#4b7c4b;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:120px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                            <td style="width:10px;font-size:8px;text-align:center;height:10px;color:#fac460;">Cuidado</td>
                                            <td style="width:90px;font-size:8px;text-align:center;height:10px;color:#4b7c4b;">Bueno</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div> --}}
                        <!-- fin signo vital -->
                        <!-- inicio signo vital -->
                        {{-- <span class="text-secondary" style="margin-bottom:4px;font-size:8px;">Frecuencia Cardíaca</span>
                        @php
                            $model['fc']=70;
                            $model['fc_porcentaje'] = 0;
                            if ($model['fc'] < 55) {
                                if ($model['fc'] < 0) {
                                    $model['fc'] = 0;
                                }
                                $temp = $model['fc'] == 0 ? 1: $model['fc'];
                                $model['fc_porcentaje'] = $temp * 50 / 50;
                                $side ="left";
                                $style ="red;";
                            }
                            if ($model['fc'] >= 55 && $model['fc'] <= 59.9 ) {
                                $model['fc_porcentaje'] = 50;//%49
                                $temp = (59.9 - $model['fc']);

                                $temp = 10.2040 * (4.9 - $temp);

                                $model['fc_porcentaje'] += $temp;//%  */
                                $side ="left";
                                $style ="orange";
                            }
                            if ($model['fc'] >= 60 && $model['fc'] <= 100 ) {
                                $model['fc_porcentaje'] = 100;//%
                                $temp = (100 - $model['fc']);

                                $temp = 1.75 * (40 - $temp);

                                $model['fc_porcentaje'] += $temp;//%
                                $side ="left";
                                $style ="green";
                            }
                            if ($model['fc'] > 100) { //red 149
                                $model['fc_porcentaje'] = 170 - 55;
                                $b = $model['fc'];
                                $style ="red;";
                                if ($b > 115) {
                                    $b = 115;

                                }
                                $temp = ($b - 100);
                                $temp = 3 * $temp;
                                $model['fc_porcentaje'] += $temp;
                                $side ="right";

                            }
                        @endphp
                        <div class="rounded border-box-respuesta bg-white" style="width:220px;font-size:12px;margin:2px;/* padding:2px */; height:40px;overflow:hidden;">
                            <ul style="list-style: none;margin:0px;padding:0px;">
                                <li>
                                    <div style="

                                        margin-left:{{ $model['fc_porcentaje'] }}px;
                                        width:55px;
                                        border-{{ $side }}: 2px solid {{$style}};
                                        height:28px;
                                        float:left;
                                        text-align:center;
                                        ">
                                         <div style="
                                            background-color:{{$style}};color:white;
                                            width:100%;
                                            font-size:10px;
                                            margin:0px;
                                        ">
                                            {{ $model['fc'] }} lat/min
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0" style="width:220px;margin-top:15px;">
                                        <tr>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#fac460;"></td>
                                            <td style="width:70px;height:10px;color:white;background-color:#4b7c4b;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#fac460;">Cuidado</td>
                                            <td style="width:70px;font-size:8px;text-align:center;height:10px;color:#4b7c4b;">Bueno</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div> --}}
                        <!-- fin signo vital -->
                        <!-- inicio signo vital -->
                        {{-- <span class="text-secondary" style="margin-bottom:4px;font-size:8px;">Frecuencia Respiratoria</span>
                        @php
                            $model['fc']=70;
                            $model['fc_porcentaje'] = 0;
                            if ($model['fc'] < 55) {
                                if ($model['fc'] < 0) {
                                    $model['fc'] = 0;
                                }
                                $temp = $model['fc'] == 0 ? 1: $model['fc'];
                                $model['fc_porcentaje'] = $temp * 50 / 50;
                                $side ="left";
                                $style ="red;";
                            }
                            if ($model['fc'] >= 55 && $model['fc'] <= 59.9 ) {
                                $model['fc_porcentaje'] = 50;//%49
                                $temp = (59.9 - $model['fc']);

                                $temp = 10.2040 * (4.9 - $temp);

                                $model['fc_porcentaje'] += $temp;//%  */
                                $side ="left";
                                $style ="orange";
                            }
                            if ($model['fc'] >= 60 && $model['fc'] <= 100 ) {
                                $model['fc_porcentaje'] = 100;//%
                                $temp = (100 - $model['fc']);

                                $temp = 1.75 * (40 - $temp);

                                $model['fc_porcentaje'] += $temp;//%
                                $side ="left";
                                $style ="green";
                            }
                            if ($model['fc'] > 100) { //red 149
                                $model['fc_porcentaje'] = 170 - 55;
                                $b = $model['fc'];
                                $style ="red;";
                                if ($b > 115) {
                                    $b = 115;

                                }
                                $temp = ($b - 100);
                                $temp = 3 * $temp;
                                $model['fc_porcentaje'] += $temp;
                                $side ="right";

                            }
                        @endphp
                        <div class="rounded border-box-respuesta bg-white" style="width:220px;font-size:12px;margin:2px;/* padding:2px */; height:40px;overflow:hidden;">
                            <ul style="list-style: none;margin:0px;padding:0px;">
                                <li>
                                    <div style="

                                        margin-left:{{ $model['fc_porcentaje'] }}px;
                                        width:55px;
                                        border-{{ $side }}: 2px solid {{$style}};
                                        height:28px;
                                        float:left;
                                        text-align:center;
                                        ">
                                         <div style="
                                            background-color:{{$style}};color:white;
                                            width:100%;
                                            font-size:10px;
                                            margin:0px;
                                        ">
                                            {{ $model['fc'] }} lat/min
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0" style="width:220px;margin-top:15px;">
                                        <tr>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#fac460;"></td>
                                            <td style="width:70px;height:10px;color:white;background-color:#4b7c4b;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#fac460;">Cuidado</td>
                                            <td style="width:70px;font-size:8px;text-align:center;height:10px;color:#4b7c4b;">Bueno</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div> --}}
                        <!-- fin signo vital -->
                        <!-- inicio signo vital -->
                       {{--  <span class="text-secondary" style="margin-bottom:4px;font-size:8px;">Glicemia</span>
                        @php
                            $model['fc']=70;
                            $model['fc_porcentaje'] = 0;
                            if ($model['fc'] < 55) {
                                if ($model['fc'] < 0) {
                                    $model['fc'] = 0;
                                }
                                $temp = $model['fc'] == 0 ? 1: $model['fc'];
                                $model['fc_porcentaje'] = $temp * 50 / 50;
                                $side ="left";
                                $style ="red;";
                            }
                            if ($model['fc'] >= 55 && $model['fc'] <= 59.9 ) {
                                $model['fc_porcentaje'] = 50;//%49
                                $temp = (59.9 - $model['fc']);

                                $temp = 10.2040 * (4.9 - $temp);

                                $model['fc_porcentaje'] += $temp;//%  */
                                $side ="left";
                                $style ="orange";
                            }
                            if ($model['fc'] >= 60 && $model['fc'] <= 100 ) {
                                $model['fc_porcentaje'] = 100;//%
                                $temp = (100 - $model['fc']);

                                $temp = 1.75 * (40 - $temp);

                                $model['fc_porcentaje'] += $temp;//%
                                $side ="left";
                                $style ="green";
                            }
                            if ($model['fc'] > 100) { //red 149
                                $model['fc_porcentaje'] = 170 - 55;
                                $b = $model['fc'];
                                $style ="red;";
                                if ($b > 115) {
                                    $b = 115;

                                }
                                $temp = ($b - 100);
                                $temp = 3 * $temp;
                                $model['fc_porcentaje'] += $temp;
                                $side ="right";

                            }
                        @endphp
                        <div class="rounded border-box-respuesta bg-white" style="width:220px;font-size:12px;margin:2px;/* padding:2px */; height:40px;overflow:hidden;">
                            <ul style="list-style: none;margin:0px;padding:0px;">
                                <li>
                                    <div style="

                                        margin-left:{{ $model['fc_porcentaje'] }}px;
                                        width:55px;
                                        border-{{ $side }}: 2px solid {{$style}};
                                        height:28px;
                                        float:left;
                                        text-align:center;
                                        ">
                                         <div style="
                                            background-color:{{$style}};color:white;
                                            width:100%;
                                            font-size:10px;
                                            margin:0px;
                                        ">
                                            {{ $model['fc'] }} lat/min
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0" style="width:220px;margin-top:15px;">
                                        <tr>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#fac460;"></td>
                                            <td style="width:70px;height:10px;color:white;background-color:#4b7c4b;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#fac460;">Cuidado</td>
                                            <td style="width:70px;font-size:8px;text-align:center;height:10px;color:#4b7c4b;">Bueno</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div> --}}
                        <!-- fin signo vital -->
                        <!-- inicio signo vital -->
                        {{-- <span class="text-secondary" style="margin-bottom:4px;font-size:8px;">Tensión Arterial</span>
                        @php
                            $model['fc']=70;
                            $model['fc_porcentaje'] = 0;
                            if ($model['fc'] < 55) {
                                if ($model['fc'] < 0) {
                                    $model['fc'] = 0;
                                }
                                $temp = $model['fc'] == 0 ? 1: $model['fc'];
                                $model['fc_porcentaje'] = $temp * 50 / 50;
                                $side ="left";
                                $style ="red;";
                            }
                            if ($model['fc'] >= 55 && $model['fc'] <= 59.9 ) {
                                $model['fc_porcentaje'] = 50;//%49
                                $temp = (59.9 - $model['fc']);

                                $temp = 10.2040 * (4.9 - $temp);

                                $model['fc_porcentaje'] += $temp;//%  */
                                $side ="left";
                                $style ="orange";
                            }
                            if ($model['fc'] >= 60 && $model['fc'] <= 100 ) {
                                $model['fc_porcentaje'] = 100;//%
                                $temp = (100 - $model['fc']);

                                $temp = 1.75 * (40 - $temp);

                                $model['fc_porcentaje'] += $temp;//%
                                $side ="left";
                                $style ="green";
                            }
                            if ($model['fc'] > 100) { //red 149
                                $model['fc_porcentaje'] = 170 - 55;
                                $b = $model['fc'];
                                $style ="red;";
                                if ($b > 115) {
                                    $b = 115;

                                }
                                $temp = ($b - 100);
                                $temp = 3 * $temp;
                                $model['fc_porcentaje'] += $temp;
                                $side ="right";

                            }
                        @endphp
                        <div class="rounded border-box-respuesta bg-white" style="width:220px;font-size:12px;margin:2px;/* padding:2px */; height:40px;overflow:hidden;">
                            <ul style="list-style: none;margin:0px;padding:0px;">
                                <li>
                                    <div style="

                                        margin-left:{{ $model['fc_porcentaje'] }}px;
                                        width:55px;
                                        border-{{ $side }}: 2px solid {{$style}};
                                        height:28px;
                                        float:left;
                                        text-align:center;
                                        ">
                                         <div style="
                                            background-color:{{$style}};color:white;
                                            width:100%;
                                            font-size:10px;
                                            margin:0px;
                                        ">
                                            {{ $model['fc'] }} lat/min
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0" style="width:220px;margin-top:15px;">
                                        <tr>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#fac460;"></td>
                                            <td style="width:70px;height:10px;color:white;background-color:#4b7c4b;"></td>
                                            <td style="width:50px;height:10px;color:white;background-color:#f87171;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#fac460;">Cuidado</td>
                                            <td style="width:70px;font-size:8px;text-align:center;height:10px;color:#4b7c4b;">Bueno</td>
                                            <td style="width:50px;font-size:8px;text-align:center;height:10px;color:#f87171;">Malo</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div> --}}
                        <!-- fin signo vital -->

                      {{--   <!-- Medicamentos de uso diario -->
                        <h4 class="text-primary" style="margin-bottom:4px">Récipes</h4>
                        <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:200px;overflow:hidden;">
                            <table class="text-primary" style="width:100%;font-size: 12px;">
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        1
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        <span class="badge badge-secondary">06/10/1984</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo maiores, minima odio eos ad aliquam numquam quam qui necessitatibus sequi a impedit delectus ipsa maxime iste iure possimus rerum quos.
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        2
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        <span class="badge badge-secondary">06/10/1984</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo maiores, minima odio eos ad aliquam numquam quam qui necessitatibus sequi a impedit delectus ipsa maxime iste iure possimus rerum quos.
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        3
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        <span class="badge badge-secondary">06/10/1984</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo maiores, minima odio eos ad aliquam numquam quam qui necessitatibus sequi a impedit delectus ipsa maxime iste iure possimus rerum quos.
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <!-- Medicamentos de uso diario -->
                        <h4 class="text-primary" style="margin-bottom:4px">Estudios Diagnósticos</h4>
                        <div class="rounded border-box-respuesta bg-white" style="font-size:12px;margin:5px;padding:5px; height:200px;overflow:hidden;">
                            <table class="text-primary" style="width:100%;font-size: 12px;">
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        1
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        <span class="badge badge-secondary">06/10/1984</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo maiores, minima odio eos ad aliquam numquam quam qui necessitatibus sequi a impedit delectus ipsa maxime iste iure possimus rerum quos.
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        2
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        <span class="badge badge-secondary">06/10/1984</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo maiores, minima odio eos ad aliquam numquam quam qui necessitatibus sequi a impedit delectus ipsa maxime iste iure possimus rerum quos.
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        3
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        <span class="badge badge-secondary">06/10/1984</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo maiores, minima odio eos ad aliquam numquam quam qui necessitatibus sequi a impedit delectus ipsa maxime iste iure possimus rerum quos.
                                    </td>
                                </tr>

                            </table>
                        </div>  --}}

                    {{-- </td> --}}

                </tr>
            </table>
        </section>
        <section >

            <table width="100%" >
                <tr>
                    <td colspan="3">
                        <h4 class="text-primary" style="">Médico</h4>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="15%">
                        <div class="rounded bg-white text-secondary" style="text-align:center;font-size:10px;margin-top:5px;padding:5px;height:130px;">
                           {{--  <img src="{{ $model['qr'] }}" alt="">
                            Puede escanear este QR para validar este documento. --}}
                        </div>
                    </td>
                    <td width="55%">
                        <div class="rounded bg-white" style="margin-top:5px;padding:5px;height:130px;">
                            <table class="text-primary" style="font-size: 12px; width:100%;">
                                <tr>
                                    <td nowrap valign="top" align="left">
                                        <b>Nombres:</b>
                                        <span class="text-secondary " >
                                             {{ $model['medico']['prefijo']." ".$model['medico']['MEDICO'] }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" align="left">
                                        <b>Cédula:</b>
                                        <span class="text-secondary ">
                                             {{ $model['medico']['nacionalidad']."-".$model['medico']['cedula'] }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" align="left">
                                        <b>Especialidad:</b>
                                        <span class="text-secondary " >
                                            {{ $model['medico']['medico_especialidad'] }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top" align="left">
                                        <b>M.P.P.S:</b>
                                        <span class="text-secondary " >
                                             {{ $model['medico']['mpps'] }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td nowrap valign="top" align="left">
                                        <b>Colegio de Médicos N°:</b>
                                        <span nowrap class="text-secondary " >
                                             {{ $model['medico']['colegio_medico'] }}
                                        </span>
                                    </td>

                                </tr>




                            </table>


                        </div>
                    </td>
                    <td width="30%">
                        <div class="rounded bg-white" style="margin-top:5px;padding:5px;height:130px;">
                            <table width="100%">

                                <tr>
                                    <td valign="top"  style="width:20px;"><h5 class="text-primary">Firma</h5></td>
                                    <td valign="top"  class="imagen" style="width:100%;">
                                      {{--   <img src="{{ $model['medico']['firma'] }}" style="position:absolute;left:1000px;top:630px;"  alt="Firma no encontrada">--}}
                                      @if (!is_null($model['medico']['firma']))
                                      <img style="width:200px;height:110px;position:relative;top:-30px;"
                                          onerror="this.src='image/user/firma/firma_patientcare_default.png'"
                                          src="{{ $model['medico']['firma'] }}">
                                      @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top"  style="width:20px;"><h5 class="text-primary">Sello</h5></td>
                                    <td valign="top"  class="imagen" style="width:100%;">
                                       {{-- <img src="{{ $model['medico']['sello'] }}" style="position:absolute;left:1000px;top:680px;" alt="Sello no encontrado"> --}}
                                       @if (!is_null($model['medico']['sello']))
                                       <img style="width:200px;height:110px;position:relative;top:-50px;"
                                           onerror="this.src='image/user/sello/sello_patientcare_default.png'"
                                           src="{{ $model['medico']['sello'] }}">
                                       @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </section>
    <footer></footer>
</body>

</html>
