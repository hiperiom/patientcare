<!DOCTYPE html>
<html lang="es">
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
@php
    $version = $model['version'];
    $version_impresion = [
        "bw" =>[
            "backgroundColor"=>"#fff",
            "fontColor"=>"#000",
            "boxTextColor"=>"#ecebeb",
            "boxTextBottomLine"=>"#fff",
            "logoSystemVersion"=>$model['logoSystemVersion'],
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
            "logoSystemVersion"=>$model['logoSystemVersion'],
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
            margin: 0cm;
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
    </style>

</head>

<body>
    <nav class="navbar-level-1 header-bg-color">
        <table  style="width:100%; margin:0px !important;">
            <tr>
                <td valign="top" width="50%">
                    <h1 class="header-title-color" style="font-size:25px;position:absolute;left:10;top:-10; margin-top:28px;">Récipe Médico</h1>
                    <img src="image/system/{{ $model['version'] ? 'logo-cmdlt-blanco.png':'logo-informe-bw.png'}}" style="height:45px;position:absolute;right:430" alt="Logo">
                </td>
                <td valign="top" width="50%">
                    <h1 class="header-title-color" style="font-size:25px;position:absolute;left:430;top:-10; white-space:nowrap; margin-top:28px;">Indicaciones</h1>
                    <img src="image/system/{{ $model['version'] ? 'logo-cmdlt-blanco.png':'logo-informe-bw.png'}}" style="height:45px;position:absolute;right:10" alt="Logo">
                </td>
            </tr>
        </table>


    </nav>
    <section>
        <table  style="width:100%;  border-radius:10px;">
            <tr>
                <td valign="top" width="50%">

                    <h4 class="text-primary" style="margin-bottom:4px">Paciente</h4>
                    <span class="text-primary" style="white-space:nowrap;left:300;top:55;font-size: 12px;position:absolute;">
                        Fecha: {{ $model["FECHA_INFORME"] }}
                    </span>
                    <div class="rounded border-box-respuesta bg-white" style="margin:5px;padding:5px; height:80px;">
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
                                    Edad:
                                </th>
                                <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                    {{ $model['user']['EDAD'] }} Años
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h4 class="text-primary" style="margin-bottom:4px">Medicamentos</h4>

                    <table width="100%">
                        <tr>
                            <td colspan="3">
                                <div class="rounded text-secondary border-box-respuesta bg-white" style="font-size: 14px;overflow:hidden;padding:5px;text-overflow: ellipsis;height:370px;">
                                    @php
                                        $contador=0;
                                    @endphp
                                    <ul>
                                        @foreach ($model['recipes'] as $key => $item)



                                                <li>{{ $item['value'] }} {{ $item['value2'] }}</li>

                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td valign="top" width="15%">
                                <div class="rounded bg-white text-secondary" style="text-align:center;font-size:10px;margin-top:5px;padding:5px;height:130px;">
                                    {{-- <img src="{{ $model['qr'] }}" alt="">
                                    Puede escanear este QR para validar este documento. --}}
                                </div>
                            </td>
                            <td width="55%">
                                <div class="rounded bg-white" style="margin-top:5px;padding:5px;height:130px;width:300px;">
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
                                <div class="rounded bg-white" style="margin-top:5px;padding:5px;height:130px;width:124px;">
                                    <table width="100%">
                                        <tr>
                                            <td style="width:20px;"><h5 class="text-primary">Firma</h5></td>
                                            <td class="imagen" style="width:100%;">
                                                {{-- <img src="{{ $model['medico']['firma'] }}" style="position:absolute;left:440px;top:630px;"  alt="Firma no encontrada"> --}}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20px;"><h5 class="text-primary">Sello</h5></td>
                                            <td class="imagen" style="width:100%;">
                                                {{-- <img src="{{ $model['medico']['sello'] }}" style="position:absolute;left:440px;top:680px;" alt="Sello no encontrado"> --}}
                                            </td>
                                        </tr>


                                    </table>


                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top" width="50%">

                    <span class="text-primary" style="white-space:nowrap;right:20;top:55;font-size: 12px;position:absolute;">
                        Fecha: {{ $model["FECHA_INFORME"] }}
                    </span>

                    <table width="100%">
                        <tr>
                            <td colspan="3">
                                <div class="rounded text-secondary border-box-respuesta bg-white" style="margin-top:25px;font-size: 14px;overflow:hidden;padding:5px;text-overflow: ellipsis;height:491px;">
                                    @php
                                        $contador=0;
                                    @endphp
                                    <ul>
                                        @foreach ($model['recipes'] as $key => $item)



                                                <li style="padding-bottom:10px;">
                                                    <b>{{ $item['value']}}</b>  {{ $item['value2'] }} {{ !is_null($item['value4']) ? " - ".$item['value4'] : '' }}<br>
                                                    {{ $item['value3'] }} <br>

                                                </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="15%">
                                <div class="rounded bg-white text-secondary" style="text-align:center;font-size:10px;margin-top:5px;padding:5px;height:130px;width:88%;">
                                    {{-- <img src="{{ $model['qr'] }}" alt="">
                                    Puede escanear este QR para validar este documento. --}}
                                </div>
                            </td>
                            <td width="55%">
                                <div class="rounded bg-white" style="margin-top:5px;padding:5px;height:130px;width:300px;">
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
                                <div class="rounded bg-white" style="margin-top:5px;padding:5px;height:130px;width:124px;">
                                    <table width="100%">

                                        <tr>
                                            <td style="width:20px;"><h5 class="text-primary">Firma</h5></td>
                                            <td class="imagen" style="width:100%;">
                                              {{--   <img src="{{ $model['medico']['firma'] }}" style="position:absolute;left:1000px;top:630px;"  alt="Firma no encontrada"> --}}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20px;"><h5 class="text-primary">Sello</h5></td>
                                            <td class="imagen" style="width:100%;">
                                               {{--  <img src="{{ $model['medico']['sello'] }}" style="position:absolute;left:1000px;top:680px;" alt="Sello no encontrado"> --}}
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </section>



    <footer class="text-secondary header-bg-color" style="width:100%;height:40px;position: absolute;bottom:0;font-size:10px;">
       <table style="width:100%;">
            <tr>
                <td class="header-title-color" valign="middle" width="50%" height="40px" style="text-align:center;padding-left:20px">
                    <b>{{$model['medico']['user_centro_salud_nombre']}}</b> - {{ $model['medico']['user_centro_salud_direccion'] }}<br>
                    <b>Teléfonos:</b> {{$model['user_centro_salud_telefono']}}
                </td>
                <td class="header-title-color" valign="middle" width="50%" height="40px" style="text-align:center;padding-left:20px">
                    <b>{{$model['medico']['user_centro_salud_nombre']}}</b> - {{ $model['medico']['user_centro_salud_direccion'] }}<br>
                    <b>Teléfonos:</b> {{$model['user_centro_salud_telefono']}}
                </td>
            </tr>
       </table>
       {{--  {{ $model["FECHA_INFORME"] }}  --}}
    </footer>



</body>

</html>
