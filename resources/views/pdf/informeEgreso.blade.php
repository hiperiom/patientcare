<!DOCTYPE html>
<html lang="es">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <head>
        <style>
            @page {
                margin: 0cm 0cm;
                font-family: 'Helvetica' !important;
            }
            .page-break {
                page-break-after: always;
            }
            body {
                margin: 3cm 2cm 2cm;
                font-family: 'Helvetica' !important;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                /*background-color: #2a0927;*/
                color: white;
                text-align: center;
                line-height: 30px;
                font-family: 'Helvetica' !important;
            }

            footer {
                position: fixed;
                bottom: -36px;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                /*background-color: #2a0927;*/
                color: white;
                text-align: center;
                line-height: 35px;
                font-family: 'Helvetica' !important;
            }
            main{
                margin-top:1.5em;
                color:rgb(70, 69, 69);
                text-align: justify;
                font-size: 1.2em;
                font-family: 'Helvetica' !important;
            }
            .text-primary{
                color:#185BA9;
            }
            .text-success{
                color:#339933;
            }
            .bg-primary{
                background-color:#185BA9;
            }
            .bg-success{
                background-color:#339933;
            }
            .text-white{
                color: white;
            }
            .width-100{
                width: 100%;
            }
            .pl-2{
                padding-left:2%;
            }
            .pr-2{
                padding-right:2%;
            }
            .text-left{
                text-align:left;
            }
            .text-center{
                text-align:center;
            }
        </style>
    </head>
    <body>
        <header>
            <div style="font-weight: bold;position:absolute;text-align:left;color:rgb(70, 69, 69);left:75px;top:50px;">
                <h3 class="text-primary" style="line-height:1.0 ">
                    Programa de <br>
                    Atención Domiciliaria
                </h3>
            </div>
            <img style="height: 50px;top:50px;right:150;position:absolute;" src="image/system/logo-cmdlt-color.png" alt="">
        </header>

        <main>
            @php
                function formatTextSummerNote($text)
                {
                    $text = str_replace('<p>','',$text);
                    $text = str_replace('</p>','<br>',$text);
                    $text = str_replace('&nbsp;',' ',$text);
                    foreach (explode("<br>",$text) as $key => $value) {
                        echo  $value."<br>";
                    }
                }
                function rangoFecha($fecha)
                {
                    echo htmlspecialchars_decode("
                        <table style='margin: 0 auto;font-size:0.7em;font-weight:bold'>
                            <tr>
                                <td nowrap class='pl-2 pr-2'><span style=''>DESDE:</span> ".$fecha["finicio"]." </td>
                                <td nowrap class='pl-2 pr-2'><span style=''>HASTA:</span>".$fecha["ffin"]."</td>
                            </tr>
                        </table>
                    ");
                }
                function mes($key)
                {
                    $meses = [
                        1=>"enero",
                        2=>"febrero",
                        3=>"marzo",
                        4=>"abril",
                        5=>"mayo",
                        6=>"junio",
                        7=>"julio",
                        8=>"agosto",
                        9=>"septiembre",
                        10=>"octubre",
                        11=>"noviembre",
                        12=>"diciembre",
                    ];
                    return $meses[$key];
                }
            @endphp
            <!-- pagina 1 -->
                <br>
                <b>Nombre:</b> {{$user->apellidos}}, {{$user->nombres}} <br>
                <b>Edad:</b> {{$user->edad}} años <br>
                <b>Cédula de Identidad:</b> {{$user->nacionalidad}}-{{number_format($user->cedula, 0, ",", ".")}} <br>
                <div style="text-align: center">
                    <h1 class="text-success">
                        Informe de Egreso
                    </h1>
                </div>


                <b>Fecha de Ingreso al PAD:</b> {{date("d-m-Y",strtotime($fecha["finicio"]))}} <br>
                <b>Fecha de Egreso del PAD:</b> {{date("d-m-Y",strtotime($fecha["ffin"]))}} <br>
                <b>Días dentro del Programa:</b> {{$dias_pad}} días
                <br>
                <br>


                El Programa de Atención Domiciliaria (PAD) del CMDLT es un servicio que monitorea vía WhatsApp al paciente que requiera seguimiento en su proceso de recuperación.
                El equipo de salud contacta al paciente dos veces al día durante 14 días, se solicita información sobre su saturación de oxígeno, temperatura, frecuencia cardíaca y los síntomas que presenta.
                <br><br>
                A continuación, se anexa los valores registrados durante su permanencia en el Programa:

            <!-- pagina 2 -->
                @foreach ($temp as $key => $item)
                    <div class="page-break"></div>
                    <br><br>
                    <div style="text-align: center">
                        <h3>Temperatura (C°)</h3>
                        {{rangoFecha($fecha)}}
                    </div>
                    <img id="grafico{{$key}}" src="{{$g1[$key]}}" alt="">
                    <br><br>
                    <table style="font-size: 0.7em" class="width-100">
                        <tr class="text-white" style="background-color:gray">
                            <th colspan="2" class="text-left"></th>
                            @foreach ($item['label'] as $key => $item2)
                                <th>{{$item2}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <td rowspan="2" class="text-left">Temperatura (C°)</td>
                            <td class="text-center">
                                T1
                            </td>
                            @foreach ($item['datosInicio'] as $key => $item2)
                                <td class="text-center">
                                    @if ($item2=="")

                                    @else
                                        {{number_format($item2, 2, ",", ".")}}
                                    @endif

                                </td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="text-center">
                                T2
                            </td>
                            @foreach ($item['datosFin'] as $key => $item2)
                                <td class="text-center">
                                    @if ($item2=="")

                                    @else
                                        {{number_format($item2, 2, ",", ".")}}
                                    @endif

                                </td>
                            @endforeach

                        </tr>
                    </table>
                    <br><br>
                    <i>Nota: Los datos que no están reflejados en el informe, no fueron suministrados por el paciente.</i>
                @endforeach
            <!-- pagina 3 -->
                @foreach ($oxi as $key => $item)
                    <div class="page-break"></div>
                    <br><br>
                    <div style="text-align: center">
                        <h3>Saturación de Oxígeno - SpO2 (%)</h3>
                        {{rangoFecha($fecha)}}
                    </div>
                    <img id="grafico{{$key}}" src="{{$g2[$key]}}" alt="">
                    <br><br>
                    <table style="font-size: 0.7em" class="width-100">
                        <tr class="text-white" style="background-color:gray">
                            <th colspan="2" class="text-left"></th>
                            @foreach ($item['label'] as $key => $item2)
                                <th>{{$item2}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <td rowspan="2" class="text-left">SpO2 (%)</td>
                            <td class="text-center">
                                T1
                            </td>
                            @foreach ($item['datosInicio'] as $key => $item2)
                                <td class="text-center">
                                    @if ($item2=="")

                                    @else
                                        {{number_format($item2, 0, ",", ".")}}
                                    @endif

                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="text-center">
                                T2
                            </td>
                            @foreach ($item['datosFin'] as $key => $item2)
                                <td class="text-center">
                                    @if ($item2=="")

                                    @else
                                        {{number_format($item2, 0, ",", ".")}}
                                    @endif

                                </td>
                            @endforeach
                        </tr>
                    </table>
                    <br><br>
                    <i>Nota: Los datos que no están reflejados en el informe, no fueron suministrados por el paciente.</i>
                @endforeach
            <!-- pagina 4 -->
                @foreach ($fc as $key => $item)
                    <div class="page-break"></div>
                    <br><br>
                    <div style="text-align: center">
                        <h3>Frecuencia Cardíaca (lpm)</h3>
                        {{rangoFecha($fecha)}}
                    </div>
                    <img id="grafico{{$key}}" src="{{$g3[$key]}}" alt="">
                    <br><br>
                    <table style="font-size: 0.7em" class="width-100">
                        <tr class="text-white" style="background-color:gray">
                            <th colspan="2" class="text-left"></th>
                            @foreach ($item['label'] as $key => $item2)
                                <th>{{$item2}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <td rowspan="2" class="text-left">FC (lpm)</td>
                            <td class="text-center">
                                T1
                            </td>
                            @foreach ($item['datosInicio'] as $key => $item2)
                                <td class="text-center">
                                    @if ($item2=="")

                                    @else
                                        {{number_format($item2, 0, ",", ".")}}
                                    @endif

                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="text-center">
                                T2
                            </td>
                            @foreach ($item['datosFin'] as $key => $item2)
                                <td class="text-center">
                                    @if ($item2=="")

                                    @else
                                        {{number_format($item2, 0, ",", ".")}}
                                    @endif

                                </td>
                            @endforeach
                        </tr>
                    </table>
                    <br><br>
                    <i>Nota: Los datos que no están reflejados en el informe, no fueron suministrados por el paciente.</i>
                @endforeach
            <!-- pagina 5 -->
                @if (!is_null($observaciones))
                    <div class="page-break"></div>
                    <br><br>
                    <div style="text-align: center">
                        <h3>Observaciones</h3>
                    </div>
                    <br>
                    @php
                        formatTextSummerNote($observaciones);
                    @endphp


                @endif


            <!-- pagina 6 -->
                <div class="page-break"></div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                El paciente durante su permanencia en el Programa evolucionó de manera satisfactoria, por lo que se decide su egreso, recomendándose consultar con su médico tratante en los próximos 15 días.
                Ha sido para el equipo del Programa de Atención Domiciliaria del Centro Médico Docente La Trinidad un honor acompañarlo hasta su recuperación.
                <br>
                Gracias por confiar en nosotros.
                <br>
                <br>
                <br>


                <i>Seguimos contigo, a tu lado, y te acompañamos hasta tu completa recuperación.</i> <br>
                <b>Equipo PAD</b> <br><br>

                <div style="font-size: 0.7em">Caracas, {{date("d")}} de {{mes((int) date("m"))}} del {{date("Y")}}</div>


        </main>

        <footer>
            <div class="bg-primary" style="height: 20px;"></div>
            <div class="bg-success" style="height: 20px;"></div>
        </footer>
        <!-- jQuery -->
        <script src="/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
        <!-- ChartJS -->
        <script src="/AdminLTE-3.0.5/plugins/Chart.min.js"></script>

    </body>

</html>
