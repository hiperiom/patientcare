<!DOCTYPE html>
<html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
@php
    $version = true;
    $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    function formatTextSummerNote($text)
                {
                    $text = str_replace('<p>','',$text);
                    $text = str_replace('\r\n','<br>',$text);
                    $text = str_replace('</p>','<br>',$text);
                    $text = str_replace('&nbsp;',' ',$text);
                    foreach (explode("<br>",$text) as $key => $value) {
                        echo  $value."<br>";
                    }
                }
    $version_impresion = [
        "bw" =>[
            "backgroundColor"=>"#fff",
            "fontColor"=>"#000",
            "boxTextColor"=>"#ecebeb",
            "boxTextBottomLine"=>"#fff",
            /* "logoSystemVersion"=>config('app.APP_LOGO_VERSION_REPORTS_COLOR'), */
            "headerTitleColor"=>"#000",
            "headerBgColor"=>"#ecebeb",
            "imgCheck"=>"check2_bw.png",
            "signsMiddleLine"=>"#fff",
            "priority-1"=>"#ecebeb",
            "priority-2"=>"#ecebeb",
            "priority-3"=>"#ecebeb",
            "priority-4"=>"#ecebeb",
            "priority-5"=>"#ecebeb",
            "info"=>"#6c757d",
            "success"=>"#6c757d",
            "orange"=>"#6c757d",
            "secondary"=>"#6c757d",
            "purple"=>"#6c757d",
            "warning"=>"#6c757d",
            "gray"=>"#6c757d",
        ],
        "color" =>[
            "backgroundColor"=>"#E8F3FC",
            "fontColor"=>"#185BA9",
            "boxTextColor"=>"#fff",
            "boxTextBottomLine"=>"#f0f0f0",
            /* "logoSystemVersion"=>config('app.APP_LOGO_VERSION_REPORTS_MONO'), */
            "headerTitleColor"=>"#fff",
            "headerBgColor"=>"#185BA9",
            "imgCheck"=>"check2.png",
            "signsMiddleLine"=>"#f0f0f0",
            "priority-1"=>"#fc000050",
            "priority-2"=>"#ff880050",
            "priority-3"=>"#fbff0048",
            "priority-4"=>"#0fb3004b",
            "priority-5"=>"#00a2ff49",
            "info"=>"#00aaff",
            "success"=>"#28a745",
            "orange"=>"#fd7e14",
            "secondary"=>"#6c757d",
            "purple"=>"#6f42c1",
            "warning"=>"#ffc107",
            "gray"=>"#6c757d",
        ],
    ];
    if ($model["version"]) {
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
        header { position: fixed; left: 0px; top: 0px; right: 0px; height: 150px; text-align: center; }
        main {
            /* margin-top:1.5em; */
            color: rgb(70, 69, 69);
            text-align: justify;
            font-size: 1em;
            font-family: 'Helvetica' !important;
        }

        body {
            background-color:  {{ $v['backgroundColor'] }};
            padding-top:250px;
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
        .text-white {
            color: #ffffff;
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
        .bg-info {
            background-color: {{ $v['info'] }} !important;
        }
        .bg-success {
            background-color: {{ $v['success'] }} !important;
        }
        .bg-orange {
            background-color: {{ $v['orange'] }} !important;
        }
        .bg-secondary {
            background-color: {{ $v['secondary'] }} !important;
        }
        .bg-purple {
            background-color: {{ $v['purple'] }} !important;
        }
        .bg-warning {
            background-color: {{ $v['warning'] }} !important;
        }
        .bg-gray {
            background-color: {{ $v['gray'] }} !important;
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

        .text-center{
            text-align:center !important;
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
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .pagenum:before {
            content: counter(page);
        }
    </style>

</head>

<body>
    <script type="text/php">
        if ( isset($model) ) {
            $font = Font_Metrics::get_font("helvetica", "bold");
            $model->page_text(0, 0, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        }
    </script>
    <header>
        <nav class="navbar-level-1 header-bg-color">

            <h1 class="header-title-color" style="font-size:25px;position:absolute;left:10;top:-10; margin-top:28px;">{{ $model["NOMBREREPORTE"] }}</h1>
            <img src="image/system/{{ $model['LOGO'] }}" style="height:45px;position:absolute;right:110" alt="">

        </nav>
        <section>
            <table style="width:100%; margin:0px !important;  border-radius:10px;">
                <tr>
                    <td style="width:60%">
                        <h4 class="text-primary" style="margin-bottom:4px">Paciente</h4>
                    </td>
                    <td style="width:40%">
                        <h4 class="text-primary" style="margin-bottom:4px">Episodio</h4>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" class="text-secondary ">
                        <div class="rounded border-box-respuesta bg-white" style="margin:5px;padding:5px; height:140px;">
                            <table class="text-primary" style="width:100%;font-size: 12px;margin-right:20px;">
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        Nombres:
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" style="padding-bottom:5px">
                                        {{ $model['USER']['PACIENTE'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:20px;" nowrap valign="top" align="left">
                                        Cédula:
                                    </th>
                                    <td class="text-secondary  box-text-bottom-line" style="padding-bottom:5px">
                                        {{ $model['USER']['CEDULA'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th nowrap valign="top" align="left">
                                        Nacimiento:
                                    </th>
                                    <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                        {{ $model['USER']['NACIMIENTO'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th nowrap valign="top" align="left">
                                        Teléfono:
                                    </th>
                                    <td class="text-secondary box-text-bottom-line"  style="padding-bottom:5px">
                                        {{ $model['USER']['TELEFONO'] }}
                                    </td>
                                </tr>

                                <tr>
                                    <th nowrap valign="top" align="left" style="padding-bottom:5px">
                                        Dirección:
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" >
                                        <div style="overflow:hidden;min-height:15px;max-height:30px;">
                                            {{ $model['USER']['DIRECTION'] }}
                                        </div>

                                    </td>
                                </tr>

                            </table>
                        </div>
                    </td>
                    <td valign="middle" class="text-secondary ">
                        <div class="rounded border-box-respuesta bg-white" style="margin:5px;padding:5px; height:140px;">
                            <table class="text-primary" style="width:100%;font-size: 12px;margin-right:20px;">

                                <tr>
                                    <th nowrap valign="top" align="left" style="padding-bottom:5px">
                                        Ingreso:
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" >
                                        {{ $model["EPISODIO"]['ingreso'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th nowrap valign="top" align="left" style="padding-bottom:5px">
                                        Código episodio:
                                    </th>
                                    <td class="text-secondary box-text-bottom-line" >
                                        {{ $model["EPISODIO"]['id'] }}
                                    </td>
                                </tr>


                            </table>
                        </div>

                    </td>
                </tr>
            </table>
        </section>
    </header>


    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            {{-- <tr>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Diagnóstico</h4>
                </td>
            </tr> --}}

            @foreach (  $model['DATA'] as $value)
                <tr>
                    <td valign="top" class="text-secondary">
                        <div class="bg-white" style="border-radius: 10px 30px 0px 0px; margin: 0;width:400px;padding: 5px 10px 0px 10px;height:35px;">
                            <table>
                                <tr>
                                    <td style="padding:0px;" rowspan="2" align="top">
                                        <span style="width:15px;margin:0" class="badge bg-{{ $value['medico_posicion_color'] }} text-white">{{ $value['medico_posicion_siglas'] }}</span>
                                    </td>
                                    <td style="padding:0px;">
                                        {{ $value['MEDICO']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px;">
                                        @php
                                            $dia = date("d",strtotime($value['created_at']));
                                            $mes_number = ( (int) date("m",strtotime($value['created_at'])) -1);
                                            $anio = date("Y",strtotime($value['created_at']));
                                            $hora = date("h:m:s A",strtotime($value['created_at']));
                                        @endphp
                                        <small style="font-size:10px;">{{ $mes[ $mes_number] }} {{ $dia }}, {{ $anio }} | {{ $hora }}</small>
                                    </td>
                                </tr>
                            </table>


                        </div>
                        <div class="bg-white" style="margin: 0;padding:5px;border-radius: 0px 10px 10px 10px;">
                            <div></div>
                            <div class="text-secondary" style=" font-size:12px; ">
                                {{ $value['value'] }}
                            </div>
                            <table style="margin-left:400px" >
                                <tr>
                                    <td>
                                        <h5 class="text-primary">Sello</h5>
                                    </td>
                                    <td>
                                        @if (!is_null($value['firma']))
                                            <img src="{{ $value['sello'] }}" style="height:80px;width:120px">
                                        @endif
                                    </td>
                                    <td>
                                        <h5 class="text-primary">Firma</h5>
                                    </td>
                                    <td>
                                        @if (!is_null($value['sello']))
                                            <img src="{{ $value['firma'] }}" style="height:80px;width:120px">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach


        </table>
    </section>
    <footer class="text-secondary" style="position: absolute;right:30px;left:30px;bottom:-180;font-size:10px;">
        <table style="width:100%;">
            <tr>
                <td>{{ $model['CENTRO_SALUD']['description'] }}</td>
                <td align="right">Emitido el {{ $model["FECHA_IMPRESION"] }}</td>

            </tr>
            <tr>
                <td colspan="2" align="center">Página <span class="pagenum"></span></td>
            </tr>
        </table>


    </footer>




</body>

</html>
