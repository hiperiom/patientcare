<!DOCTYPE html>
<html lang="es">
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
@php
    $version = true;
    $version_impresion = [
        "bw" =>[
            "backgroundColor"=>"#fff",
            "fontColor"=>"#000",
            "boxTextColor"=>"#ecebeb",
            "boxTextBottomLine"=>"#fff",
            "logoSystemVersion"=>"logo-informe-bw.png",
            "headerTitleColor"=>"#000",
            "headerBgColor"=>"#ecebeb",
            "imgCheck"=>"check2_bw.png",
            "signsMiddleLine"=>"#fff",
            "priority-1"=>"#ecebeb",
            "priority-2"=>"#ecebeb",
            "priority-3"=>"#ecebeb",
            "priority-4"=>"#ecebeb",
            "priority-5"=>"#ecebeb",
        ],
        "color" =>[
            "backgroundColor"=>"#E8F3FC",
            "fontColor"=>"#185BA9",
            "boxTextColor"=>"#fff",
            "boxTextBottomLine"=>"#f0f0f0",
            "logoSystemVersion"=>"logo-cmdlt-blanco.png",
            "headerTitleColor"=>"#fff",
            "headerBgColor"=>"#185BA9",
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
            margin: 0cm 0cm;
            font-family: 'Helvetica' !important;
        }

        .page-break {
            page-break-after: always;
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
        .bg-light {
            background-color:#f0f0f0 /* #ecebeb */;
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
            margin: 0 20px 0 20px;
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
    </style>

</head>

<body>
    <nav class="navbar-level-1 header-bg-color">

        <h1 class="header-title-color" style="font-size:25px;position:absolute;left:10;top:-10; margin-top:28px;">Informe de Emergencia</h1>
        <img src="image/system/{{$v['logoSystemVersion']}}" style="height:45px;position:absolute;right:10" alt="">

    </nav>

    <section>
        <table style="width:100%; margin:0px !important;  border-radius:10px;">
            <tr>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Paciente</h4>
                </td>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Signos Vitales</h4>
                </td>
            </tr>
            <tr>
                <td valign="middle" class="text-secondary " style="">
                    <div class="rounded border-box-respuesta bg-white" style="margin:5px;padding:5px; height:190px;">
                        <table class="text-primary" style="width:100%;font-size: 12px;margin-right:20px;">
                            <tr>
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
                                    Nacimiento:
                                </th>
                                <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                    {{ $model['user']['NACIMIENTO'] }} ({{ $model['user']['EDAD'] }} Años)
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
                                        {{ $model['user']['DIRECTION'] }}
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th nowrap valign="top" align="left" style="padding-bottom:5px">
                                    Ingreso:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    {{ $model["episodio"]['INGRESO'] }}
                                </td>
                            </tr>
                            <tr>
                                <th nowrap valign="top" align="left" style="padding-bottom:5px">
                                    Episodio:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    {{ $model["episodio"]['ID'] }}
                                </td>
                            </tr>


                        </table>
                    </div>
                </td>
                <td valign="middle" style="" class="text-secondary ">
                    <div class="rounded bg-white" style="margin:5px;padding:5px; height:190px;">
                        <table class="text-primary" style="width:100%;font-size: 12px;">
                            <tr>
                                <td valign="top" class="signs-middle-line" style="padding-right:5px;">
                                    <b>Temperatura:</b>
                                    <div class="text-secondary">
                                        <div class="box-text-bottom-line" style="overflow:hidden;height:15px;">
                                            {{ $model["episodio"]['SIGNOS']['TEMP'] }}
                                        </div>

                                    </div>
                                    <b>Oximetria:</b>
                                    <div class="text-secondary">
                                        <div class="box-text-bottom-line" style="overflow:hidden;height:15px;">
                                            {{ $model["episodio"]['SIGNOS']['OXI'] }}
                                        </div>

                                    </div>
                                    <b>F.C:</b>
                                    <div class="text-secondary">
                                        <div class="box-text-bottom-line" style="overflow:hidden;height:15px;">
                                            {{ $model["episodio"]['SIGNOS']['FC'] }}
                                        </div>

                                    </div>


                                    <b>Glic:</b>
                                    <div class="text-secondary">
                                        <div class="box-text-bottom-line" style="overflow:hidden;height:15px;">
                                            {{ $model["episodio"]['SIGNOS']['GLIC'] }}
                                        </div>

                                    </div>
                                    <b>F.R:</b>
                                    <div class="text-secondary">
                                        <div class="box-text-bottom-line" style="overflow:hidden;height:15px;">
                                            {{ $model["episodio"]['SIGNOS']['FR'] }}
                                        </div>

                                    </div>
                                    <b>T.A:</b>
                                    <div class="text-secondary">
                                        <div class="box-text-bottom-line" style="overflow:hidden;height:15px;">
                                            {{ $model["episodio"]['SIGNOS']['TA'] }}
                                        </div>

                                    </div>
                                </td>

                            </tr>
                        </table>
                    </div>


                </td>
            </tr>
        </table>
    </section>
    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            <tr>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Motivo de Consulta</h4>
                </td>
            </tr>
            <tr>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary" style=" font-size:12px;overflow:hidden;height:45px; ">
                           {{ $model["episodio"]["MOTIVO_CONSULTA"] }}
                        </div>
                    </div>
                </td>

            </tr>
        </table>
    </section>
    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            <tr>
                <td style="width:50%">
                    <h4 class="text-primary" style="width:50%;margin-bottom:4px">Enfermedad Actual</h4>
                </td>
                <td style="width:50%">
                    <h4 class="text-primary" style="width:50%;margin-bottom:4px">Examen Físico</h4>
                </td>
            </tr>
            <tr>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary" style=" font-size:12px;overflow:hidden;height:90px; ">
                            {{ $model["episodio"]["ENFERMEDAD_ACTUAL"] }}
                        </div>
                    </div>
                </td>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary" style=" font-size:12px;overflow:hidden;height:90px; ">
                            {{ $model["episodio"]["EXAMEN_FISICO"] }}
                        </div>
                    </div>
                </td>

            </tr>
        </table>
    </section>
    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            <tr>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Problema de ingreso</h4>
                </td>
            </tr>
            <tr>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary" style=" font-size:12px;overflow:hidden;height:45px; ">
                            {{ $model["episodio"]['IMP_DIAG'] }}
                        </div>
                    </div>
                </td>

            </tr>
        </table>
    </section>
    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            <tr>
                <td {{-- colspan="2" --}}>
                    <h4 class="text-primary" style="margin-bottom:4px">El paciente requerirá:</h4>
                </td>
            </tr>
        </table>
        <table style="width:100%; margin:0px; border-radius:10px;">

            <tr>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white">
                        <div style="text-align:left; font-size:12px;overflow:hidden;height:50px;">
                            <table>
                                <tr>
                                   
                                    <td>
                                        <b>Hospitalización:</b>
                                        <table>
                                            <tr>
                                                <td>Si</td>
                                                <td>
                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['HOSPITALIZACION'] == 1)
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>No</td>
                                                <td>

                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['HOSPITALIZACION'] == 0 && !is_null($model["episodio"]['HOSPITALIZACION']))
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white">
                        <div style="text-align:left; font-size:12px;overflow:hidden;height:50px;">
                            <table>
                                <tr>
                                   
                                    <td>
                                        <b>Terapia Intensiva:</b>
                                        <table>
                                            <tr>
                                                <td>Si</td>
                                                <td>
                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['TERAPIA_INTENSIVA'] == 1)
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>No</td>
                                                <td>

                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['TERAPIA_INTENSIVA'] == 0 && !is_null($model["episodio"]['TERAPIA_INTENSIVA']))
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white">
                        <div style="text-align:left; font-size:12px;overflow:hidden;height:50px;">
                            <table>
                                <tr>
                                    <td>
                                        <b>Cirugía:</b>
                                        <table>
                                            <tr>
                                                <td>Si</td>
                                                <td>
                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['CIRUGIA'] == 1)
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>No</td>
                                                <td>

                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['CIRUGIA'] == 0 && !is_null($model["episodio"]['CIRUGIA']))
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                
            </tr>
            <tr>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white">
                        <div style="text-align:left; font-size:12px;overflow:hidden;height:50px;">
                            <table>
                                <tr>
                                   <!-- 
                                


PROCEDIMIENTO_COMPLEJIDAD
                                -->
                                    <td>
                                        <b>Interconsulta con especialista:</b>
                                        <table>
                                            <tr>
                                                <td>Si</td>
                                                <td>
                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['REQUIERE_INTERSONSULTA'] == 1)
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>No</td>
                                                <td>

                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['REQUIERE_INTERSONSULTA'] == 0 && !is_null($model["episodio"]['REQUIERE_INTERSONSULTA']))
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                @if (
                                                    $model["episodio"]['REQUIERE_INTERSONSULTA'] == 1 && 
                                                    !is_null($model["episodio"]['CANTIDAD_ESPECIALISTAS']) && 
                                                    $model["episodio"]['CANTIDAD_ESPECIALISTAS'] !== 'null' 
                                                )
                                                    <td>
                                                        
                                                        <div class="bg-light" style="padding:5px 5px 0px 5px;height:20px;border-radius:5px;">
                                                            @if ($model["episodio"]['CANTIDAD_ESPECIALISTAS'] == 1)
                                                                1 especialista
                                                            @endif
                                                            @if ($model["episodio"]['CANTIDAD_ESPECIALISTAS'] == 2)
                                                                2 especialistas
                                                            @endif
                                                            @if ($model["episodio"]['CANTIDAD_ESPECIALISTAS'] > 2)
                                                                +2 especialistas
                                                            @endif
                                                        </div>
                                                        
                                                    </td>
                                                @endif
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white">
                        <div style="text-align:left; font-size:12px;overflow:hidden;height:50px;">
                            <table>
                                <tr>
                                   
                                    <td>
                                        <b>¿Realizar procedimiento?:</b>
                                        <table>
                                            <tr>
                                                <td>Si</td>
                                                <td>
                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['REALIZAR_PROCEDIMIENTO'] == 1)
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>No</td>
                                                <td>

                                                    <div class="bg-white"
                                                        style="width:20px;height:20px; border:2px solid #58585B;border-radius:5px;">
                                                        @if ($model["episodio"]['REALIZAR_PROCEDIMIENTO'] == 0 && !is_null($model["episodio"]['REALIZAR_PROCEDIMIENTO']))
                                                            <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                                        @endif
                                                    </div>
                                                </td>
                                                @if ($model["episodio"]['REALIZAR_PROCEDIMIENTO'] == 1 && !is_null($model["episodio"]['PROCEDIMIENTO_COMPLEJIDAD']))
                                                    <td>
                                                        
                                                        <div class="bg-light" style="padding:5px 5px 0px 5px;height:20px;border-radius:5px;">
                                                            {{$model["episodio"]['PROCEDIMIENTO_COMPLEJIDAD']}}
                                                        </div>
                                                        
                                                    </td>
                                                @endif
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </section>

    <section>
        <table
            style="
                width:100%;
                height:20px;
                margin:0px;
                border-radius:10px;
            ">
            <tr>
                <td colspan="5">
                    <h4 class="text-primary" style="margin-bottom:4px">Nivel de clasificación del paciente en Triaje:</h4>
                </td>
            </tr>
            <tr>
                <th class="priority-1 text-secondary" valign="middle" style="padding-left:35px;font-size:15px;">
                    <table>
                        <tr>
                            <td align="center" valign="middle">
                                1<br>Nivel
                            </td>
                            <td>
                                <div
                                    style="
                                        background:white;
                                        width:20px;
                                        height:20px;
                                        border:2px solid #58585B;
                                        border-radius:5px;
                                    ">
                                    @if ($model["episodio"]['NIVEL_TRIAJE'] == 1)
                                        <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </th>
                <th class="priority-2 text-secondary" valign="middle" style="padding-left:35px;font-size:15px;">
                    <table>
                        <tr>
                            <td align="center" valign="middle">
                                2<br>Nivel
                            </td>
                            <td>
                                <div
                                    style="
                                        background:white;
                                        width:20px;
                                        height:20px;
                                        border:2px solid #58585B;
                                        border-radius:5px;
                                    ">
                                    @if ($model["episodio"]['NIVEL_TRIAJE'] == 2)
                                        <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </th>
                <th class="priority-3 text-secondary" valign="middle" style="padding-left:35px;font-size:15px;">
                    <table>
                        <tr>
                            <td align="center" valign="middle">
                                3<br>Nivel
                            </td>
                            <td>
                                <div
                                    style="
                                        background:white;
                                        width:20px;
                                        height:20px;
                                        border:2px solid #58585B;
                                        border-radius:5px;
                                    ">
                                    @if ($model["episodio"]['NIVEL_TRIAJE'] == 3)
                                        <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </th>
                <th class="priority-4 text-secondary" valign="middle" style="padding-left:35px;font-size:15px;">
                    <table>
                        <tr>
                            <td align="center" valign="middle">
                                4<br>Nivel
                            </td>
                            <td>
                                <div
                                    style="
                                        background:white;
                                        width:20px;
                                        height:20px;
                                        border:2px solid #58585B;
                                        border-radius:5px;
                                    ">
                                    @if ($model["episodio"]['NIVEL_TRIAJE'] == 4)
                                        <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </th>
                <th class="priority-5 text-secondary" valign="middle" style="padding-left:35px;font-size:15px;">
                    <table>
                        <tr>
                            <td align="center" valign="middle">
                                5<br>Nivel
                            </td>
                            <td>
                                <div
                                    style="
                                        background:white;
                                        width:20px;
                                        height:20px;
                                        border:2px solid #58585B;
                                        border-radius:5px;
                                    ">
                                    @if ($model["episodio"]['NIVEL_TRIAJE'] == 5)
                                        <img src='image/system/{{ $v['imgCheck'] }}' style='height:20px;' alt='Check'>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </th>
            </tr>
        </table>

    </section>
    <section>
        <table style="width:100%; margin:0px;border-radius:10px;">

            <tr>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Identificación del Médico en Emergencia:</h4>
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td valign="middle" class="text-secondary ">

                    <div class="rounded bg-white" style="margin:5px;padding:5px; width:500px; height:130px;">
                        <br>
                        <table class="text-primary" style="font-size: 12px;">
                            <tr>
                                <th nowrap valign="top" align="left">
                                    Nombres:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    {{ $model['medico']['prefijo']." ".$model['medico']['MEDICO'] }}
                                </td>
                                <th valign="top" align="left">
                                    Cédula:
                                </th>
                                <td class="text-secondary box-text-bottom-line">
                                    {{ $model['medico']['nacionalidad']."-".$model['medico']['cedula'] }}
                                </td>
                            </tr>
                            <tr>
                                <th valign="top" align="left">
                                    Especialidad:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    {{ $model['medico']['especialidad'] }}
                                </td>
                                <th nowrap valign="top" align="left">
                                    Teléfono:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    {{ $model['medico']['telefono_movil'] }}
                                </td>
                            </tr>
                            <tr>
                                <th valign="top" align="left">
                                    M.P.P.S:
                                </th>
                                <td class="text-secondary box-text-bottom-line" >
                                    {{ $model['medico']['mpps'] }}
                                </td>
                                <th nowrap valign="top" align="left">
                                    Colegio de Médicos N°:
                                </th>
                                <td nowrap class="text-secondary box-text-bottom-line" >
                                    {{ $model['medico']['colegio_medico'] }}
                                </td>
                            </tr>




                        </table>
                    </div>
                </td>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin:5px;padding-top:8px;padding-left:5px; height:130px;width:200px;">
                        <div style="margin:0px;padding:0px;">
                            <h5 class="text-primary">Firma</h5>
                            @if (!is_null($model['medico']['firma']))
                                <img onerror="this.src='image/system/firma_patientcare_default.png'" src="{{ $model['medico']['firma'] }}" style="position:absolute;top:700;right:50;height:90px;width:120px;b" alt="Firma no encontrada">
                            @endif

                        </div>

                        <div style="margin:0px;padding:0px;">
                            <h5 class="text-primary">Sello</h5>
                            @if (!is_null($model['medico']['sello']))
                                <img onerror="this.src='image/system/sello_patientcare_default.png'" src="{{ $model['medico']['sello'] }}" style="position:absolute;top:720;right:50;height:110px;width:120px;" alt="Sello no encontrado">
                            @endif
                        </div>
                        {{-- <center >
                            @if ($model['medico']['firma'] != "image/user/firma/firma_patientcare_default.png")
                                <img src="{{ $model['medico']['firma'] }}" style="height:70px;" alt="Firma Medico">
                            @endif

                        </center>
                        <div style="position:absolute;right:40;top:1000px;">
                            @if ($model['medico']['sello'] != "image/user/sello/sello_patientcare_default.png")
                                <img src="{{ $model['medico']['sello'] }}" style="height:70px;" alt="Sello Medico">
                            @endif
                        </div>
                        --}}
                    </div>
                </td>

            </tr>
        </table>
    </section>
    <footer class="text-secondary" style="position: absolute;right:30px;left:30px;bottom:10;font-size:10px;">
        <table style="width:100%;">
            <tr>
                <td>{{ $model['centro_salud']['description'] }}</td>
                <td align="right">Emitido el {{ $model["FECHA_INFORME"] }}</td>
            </tr>
        </table>


    </footer>



</body>

</html>
