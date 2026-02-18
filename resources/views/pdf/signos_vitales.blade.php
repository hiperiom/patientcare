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
            border-collapse: collapse; /* Combina los bordes de las celdas en un solo borde */
            width: 100%; /* Ancho de la tabla */
            width: 100%;
            font-size:10px;
            /*border:1px solid black*/
        }
        .table th, .table td {
            border: 1px solid black; /* Establece un borde de 1 píxel sólido en todas las celdas */
            padding: 8px; /* Añade un espacio de relleno alrededor del contenido de las celdas */
            text-align: left; /* Alinea el texto a la izquierda dentro de las celdas */
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
        <h2 class="mb-1">{{ strtoupper($model['TITULO_DOCUMENTO']) }}</h2>
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
                    <b class="ml-2">Ubicación:</b> <span>{{ $model['ubicacion'] }}</span>
                    {{-- <b class="ml-2">N° Episodio:</b> <span>{{ $model['episodio_number'] }}</span> --}}
                </td>
            </tr>
        </table>
        <div class="mt-2">


            <table class="table">

                <tr>
                    <th class="text-center">FECHA/HORA REGISTRO</th>
                    <th class="text-center">TEMP</th>
                    <th class="text-center">FR</th>
                    <th class="text-center">FC</th>
                    <th class="text-center">TAS</th>
                    <th class="text-center">TAD</th>
                    <th class="text-center">SAT O2</th>
                  {{--   <th class="text-center">TALLA</th>
                    <th class="text-center">PESO</th> --}}
                    <th class="text-center">REGISTRADO POR</th>
                </tr>

                <tbody>
                    @foreach ($model['ITEM_MEDICO'] as $item)
                        <tr>
                            <td>{{!is_null($item['created_at']) && isset($item['created_at']) ? $item['created_at']:""}}</td>
                            <td>{{!is_null($item['temp']['value']) && isset($item['temp']) ? $item['temp']['value']:""}}</td>
                            <td>{{!is_null($item['fr']['value']) && isset($item['fr']) ? $item['fr']['value']:""}}</td>
                            <td>{{!is_null($item['fc']['value']) && isset($item['fc']) ? $item['fc']['value']:""}}</td>
                            <td>{{!is_null($item['ta']['value1']) && isset($item['ta']) ? $item['ta']['value1']:""}}</td>
                            <td>{{!is_null($item['ta']['value2']) && isset($item['ta']) ? $item['ta']['value2']:""}}</td>
                            <td>{{!is_null($item['oxi']['value']) && isset($item['oxi']) ? $item['oxi']['value']:""}}</td>


                            {{--




                            <td>{{!is_null($item['talla']) ? $item['talla']:""}}</td>
                            <td>{{!is_null($item['peso']) ? $item['peso']:""}}</td> --}}
                            <td>{{$item['medico']}}</td>
                        </tr>
                    @endforeach

                    {{-- <tr>
                        <td colspan="2" class="">
                            <footer class="footer">
                                <table>

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

                                                @endif

                                            </div>

                                        </td>
                                    </tr>
                                </table>
                            </footer>
                        </td>
                    </tr> --}}
                </tbody>
            </table>



        </div>
    </main>



</body>

</html>
