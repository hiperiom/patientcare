<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe</title>
    <style>
        html {
            margin: 0pt;
            font-family: 'Helvetica' !important;
            font-size: 12pt;
        }

        body {
            margin: 30pt 30pt 30pt 30pt;
            text-align: justify;
            padding-top: 80pt;
            /* border:1px solid red; */
        }

        header {
            position: fixed;

            top: 30pt;
            left: 30pt;
            right: 30pt;
            height: 80pt;
            /* border:1px solid #03a9f4; */

            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer {

            /* border:1px solid blue; */
            width: 100%;
            height: 230px;
            position: relative;
            /* left: 30pt;
            right: 30pt;
            bottom:0pt; */
        }

        .footer-page-number {
            position: fixed;
            bottom: 60px;
            left: 0px;
            right: 0px;
            height: 80px;

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            color: white;
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

        .align-left {
            position: absolute;
            left: 0px;
        }

        .align-right {
            position: absolute;
            right: 0px;
        }

        .logo-institucion {
            height: 80px;
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
    </style>
</head>

<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            //$font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(15, 810, "© ".date('Y')." Patientcare", "helvetica", 8, array(0,0,0));
            $pdf->page_text(535, 810, "Pág: {PAGE_NUM} de {PAGE_COUNT}", "helvetica", 8, array(0,0,0));
        }
    </script>
    <header>
        {{-- <h3 class="align-left text-black"><b>N° HISTORIA:</b> {{ $model['historia_id'] }}</h3> --}}
        <img src="image/system/logo-informe-bw.png" class="logo-institucion float-right">
    </header>
    <main>
        <h2 class="mb-1">{{ strtoupper($model['TITULO_DOCUMENTO']) . ($model['ITEM_MEDICO']['medico_cargo'] =="Enfermería" ? " DE ENFERMERÍA": "")}}</h2>
        <table>
            <tr>
                <td>
                    <b>Apellidos y Nombres:</b> <span>{{ $model['paciente'] }}</span>
                    <b class="ml-2">C.I:</b> <span>{{ $model['cedula'] }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Fecha de nacimiento:</b> <span>{{ $model['fecha_nacimiento'] }}</span>
                    <b class="ml-2">Edad:</b> <span>{{ $model['edad'] }} Año(s)</span>
                    {{-- <b class="ml-2">N° Episodio:</b> <span>{{ $model['episodio_number'] }}</span> --}}
                </td>
            </tr>
        </table>
        <div class="mt-2">


            <table class="table">

                <tr>
                    <th class="table-col-1">Fecha y hora</th>

                    <th class="table-col-2 text-center">(Subjetivo, Objetivo, Análisis, Diagnóstico, y Plan)</th>
                </tr>

                <tbody>
                    @foreach ($model['ITEM_MEDICO'] as $key => $item)
                        @if (in_array($key, ['value', 'subjetivo', 'objetivo', 'analisis', 'diagnostico', 'plan']))
                            @if (!is_null($item))
                                @foreach ($item as $key1 => $texto)
                                    <tr>
                                        <td class="table-col-1">
                                            @if ($key1 ==0)
                                                {{ $model['ITEM_MEDICO']['fecha_creacion'] }}<br>{{ $model['ITEM_MEDICO']['hora_creacion'] }}
                                            @endif

                                        </td>
                                        <td class="table-col-2">
                                            <div
                                                style="{{ $key == 'value' ? 'white-space: normal;text-align:left;' : '' }}">

                                                    {{ $texto }}

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="2" class="">
                            <footer class="footer">
                                <table>
                                    {{-- <tr>
                                        <th colspan="2" class="text-left">Datos del Médico</th>
                                    </tr> --}}
                                    <tr>
                                        <td>
                                            {{$model['ITEM_MEDICO']['medico_cargo']}}: {{ $model['ITEM_MEDICO']['medico'] }}<br>
                                            @php
                                                if($model['ITEM_MEDICO']['medico_cargo'] =="Enfermería"){
                                                    "Colegío de médicos:". $model['ITEM_MEDICO']['colegio_medico']."<br>";
                                                }
                                            @endphp
                                            Firma y sello:
                                        </td>
                                        <td class="pl-3">
                                            <span>C.I: {{ $model['ITEM_MEDICO']['cedula'] }}</span><br>
                                            <span>MPPS: {{ $model['ITEM_MEDICO']['mpps'] }}</span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div>

                                                @if (
                                                    !is_null($model['ITEM_MEDICO']['firma']) &&
                                                    !in_array($model['ITEM_MEDICO']['firma'], ['image/system/firma_patientcare_default.png'])
                                                )
                                                    <img style="width:200px;height: 110px;position:absolute;left:200px;bottom:30px"
                                                        onerror="this.src='image/system/sello_patientcare_default.png'"
                                                        src="{{ $model['ITEM_MEDICO']['firma'] }}">
                                                    {{-- <img onerror="this.src='image/system/sello_patientcare_default.png'" src="image/system/firmas y sellos/firma daliana cabello.png" > --}}
                                                @endif

                                            </div>
                                            <div>
                                                @if (
                                                    !is_null($model['ITEM_MEDICO']['sello']) &&
                                                    !in_array($model['ITEM_MEDICO']['sello'], ['image/system/sello_patientcare_default.png'])
                                                )
                                                    <img style="width:200px;height: 110px;position:absolute;left:200px;bottom:0px"
                                                        onerror="this.src='image/system/sello_patientcare_default.png'"
                                                        src="{{ $model['ITEM_MEDICO']['sello'] }}">
                                                    {{-- <img onerror="this.src='image/system/sello_patientcare_default.png'" src="image/system/firmas y sellos/sello daliana cabello.png" > --}}
                                                @endif

                                            </div>

                                        </td>
                                    </tr>
                                </table>
                            </footer>
                        </td>
                    </tr>
                </tbody>
            </table>



        </div>
    </main>



</body>

</html>
