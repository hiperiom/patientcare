<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recipe</title>
    <style>
        html {
            margin: 0pt;
            font-family: 'Helvetica' !important;
            font-size: 12pt;
        }

        body {
            margin: 20pt 10pt 185pt 10pt;
            text-align: justify;
            padding-top: 110pt;
            /* border:1px solid red; */
        }

        header {
            position: fixed;
            margin: 0pt;
            top: 20pt;
            left: 10pt;
            right: 10pt;

            /* border:1px solid #03a9f4; */
            text-align: center;

        }

        footer {

            /* border:1px solid blue; */
            /*  width:100%; */
            height: 220px;
            position: fixed;
            left: 10pt;
            right: 10pt;
            bottom: 20pt;
        }

        .footer-page-number {
            position: fixed;
            bottom: 60px;
            left: 0px;
            right: 0px;
            height: 80px;

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            color: black;
            text-align: center;
            line-height: 35px;
        }

        .text-left {
            text-align: left;
        }

        .ml-2 {
            margin-left: 20px;
        }

        .mr-1 {
            margin-right: 10px;
        }

        .mb-1 {
            margin-bottom: 10px;
        }

        .mt-1 {
            margin-top: 10px;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .mt-3 {
            margin-top: 30px;
        }

        .pl-2 {
            padding-left: 10px;
        }

        .pl-3 {
            padding-left: 30px;
        }

        .firma {
            width: 200pt;
            height: 110pt;
            /* border:1px solid red; */
            position: relative;
            left: 200pt;
            bottom: -50pt;
        }

        .sello {
            width: 200pt;
            height: 110pt;
            /* border:1px solid blue; */
            position: relative;
            left: 150pt;
            bottom: 200pt;
        }

        .float-right {
            float: right;
        }

        .float-left {
            float: left;
        }

        .align-left {
            position: absolute;
            left: 0px;
        }

        .align-right {
            position: absolute;
            right: 0px;
        }

        .logo-institucion {
            height: 50px;
        }

        .table {
            width: 100%;
            /*border:1px solid black*/
        }

        .table-col-1 {
            width: 20%;
            text-align: center;
            /* border:0.5px solid rgb(78, 78, 78); */
            padding: 5px;
            vertical-align: top;
        }

        .table-col-2 {
            padding: 5px;
            text-align: justify;
            /* border:0.5px solid rgb(78, 78, 78); */
            vertical-align: top;
        }

        .text-black {
            color: black;
        }

        .text-center {
            text-align: center;
        }

        .w-100 {
            width: 100%;
        }

        .fw-normal {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            //$font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(10, 575, "© ".date('Y')." Patientcare", "helvetica", 8, array(0,0,0));
            $pdf->page_text(780, 575, "Pág: {PAGE_NUM} de {PAGE_COUNT}", "helvetica", 8, array(0,0,0));
        }
    </script>
    <header>
        <table class="w-100">
            <tr>
                {{-- RECIPE --}}
                <td width="50%">

                    <h2 style="margin-top: 12pt" class="float-left">RECIPE</h2>

                    <img src="image/system/logo-informe-bw.png" class="mr-1 logo-institucion float-right">
                    <br>
                    <br>
                    <br>
                    <table class="w-100">
                        <tr>
                            <td align="right">
                                Fecha: {{ $model["FECHA_INFORME"] }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                N° Historia: <span>{{ $model['historia_id'] }}</span>
                                N° Episodio: <span>{{ $model['episodio_number'] }}</span>
                            </td>
                        </tr> --}}
                        <tr>
                            <td>
                                Apellidos y Nombres: <span>{{ $model['user']['PACIENTE'] }}</span>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                C.I: <span>{{ $model['user']['CEDULA'] }}</span>
                                Edad: <span>{{ $model['user']['EDAD'] }} Año(s)</span>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- INDICACIONES --}}
                <td width="50%">

                    <h2 style="margin-top: 12pt" class="float-left">INDICACIONES</h2>

                    <img src="image/system/logo-informe-bw.png" class="mr-1 logo-institucion float-right">
                    <br>
                    <br>
                    <br>
                    <table class="w-100">
                        <tr>
                            <td align="right">
                                Fecha: {{ $model["FECHA_INFORME"] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Apellidos y Nombres: <span>{{ $model['user']['PACIENTE'] }}</span>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                C.I: <span>{{ $model['user']['CEDULA'] }}</span>
                                Edad: <span>{{ $model['user']['EDAD'] }} Año(s)</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </header>

    <main style="padding-top:15pt;">
        <table class="w-100">
            @foreach ($model['recipes'] as $key => $item)
            <tr>
                    {{-- RECIPE --}}
                    <td width="50%" style="vertical-align: top;">
                        <strong>{{ $item['value'] }} | {{ $item['value2'] }}</strong>
                    </td>
                    {{-- INDICACIONES --}}
                    <td width="50%" style="vertical-align: top;">
                        <strong>{{ $item['value'] }} | {{ $item['value2'] }}{{ !is_null($item['value4']) ? " | " : '' }}{{$item['value4']}}</strong><br><i>{{ $item['value3'] }}</i>
                    </td>
                </tr>
                @endforeach
        </table>
    </main>

    <footer>
        <table class="w-100">
            <tr>
                @foreach ([['300px', '30px', '300px', '0px'], ['850px', '30px', '850px', '0px']] as $item)
                    @php
                        [$leftSello, $bottomSello, $leftFirma, $bottomFirma] = $item;
                    @endphp
                    <td width="50%">
                        <table>
                            {{-- <tr>
                                <th width="100%" colspan="2" class="text-left">Datos del Médico</th>
                            </tr> --}}
                            <tr>
                                <td style="min-width: 70%;">
                                    Médico: {{ $model['medico']['prefijo']." ".$model['medico']['MEDICO'] }}<br>
                                    Colegío de médicos: {{ $model['medico']['colegio_medico'] }}<br>
                                    Firma y sello:
                                </td>
                                <td width="30%" style="padding-left:50px; vertical-align: top;">
                                    <span>C.I: {{ $model['medico']['nacionalidad']."-".$model['medico']['cedula'] }}</span><br>
                                    <span>MPPS: {{ $model['medico']['mpps'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                {{-- {{dd($model['medico']['firma'])}} --}}
                                <td colspan="2" style="text-align: right;">
                                    <div>
                                        @if (!is_null($model['medico']['firma']))
                                        <img style="width:200px;height: 110px;position:absolute;left:{{ $leftSello }};bottom:{{ $bottomSello }}"
                                            onerror="this.src='image/user/firma/firma_patientcare_default.png'"
                                            src="{{ $model['medico']['firma'] }}">
                                        @endif
                                    </div>
                                    <div>
                                        @if (!is_null($model['medico']['sello']))
                                        <img style="width:200px;height: 110px;position:absolute;left:{{ $leftFirma }};bottom:{{ $bottomFirma }}"
                                            onerror="this.src='image/user/sello/sello_patientcare_default.png'"
                                            src="{{ $model['medico']['sello'] }}">
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                @endforeach
            </tr>
        </table>
    </footer>

</body>

</html>
