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
                margin: 0;
                font-family: 'Helvetica' !important;
            }

            .aside-left {
                position: absolute;
                top: 0cm;
                left: 0cm;
                width: 50%;
                height: 125%;
                background-color: #185BA9;
                color: white;


                font-family: 'Helvetica' !important;
            }
            .aside-right {
                position: absolute;
                top: 0cm;
                right: 0;
                width: 370px;
                height: 125%;
                 /* background-color: red; */
                color: rgb(102, 102, 102);
                padding:1rem;

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
                z-index: 11111111;
            }
            main{
                /* margin-top:1.5em; */
                color:rgb(70, 69, 69);
                text-align: justify;
                font-size: 1em;
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

            .bg-cmdlt {
                background: url("image/system/slider-cmdlt-fachada.jpg") no-repeat center center fixed;

                background-size: 1000px;
                background-position: -310px 0px;

            }
            .m-0{
                margin:0;
            }
            .p-0{
                padding:0;
            }
            .lg-1{
                line-height:1.2em;
            }
            .mt-1{
                margin-top:.25rem;
            }
            .mt-2{
                margin-top:.50rem;
            }
            .ml-3{
                margin-left:1.25rem;
            }
            .w-100{

            }
        </style>
    </head>
    <body>

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
            <div class="aside-left">
                <div style="height:15cm; padding-top:2cm;" class="bg-primary">
                    <table class="ml-3">
                        <tr>
                            <td colspan="2">
                                <!-- inicio fecha -->
                                <article aria-label="fecha">
                                    <b>Caracas, {{date("d")}} de {{mes((int) date("m"))}} del {{date("Y")}}</b>
                                </article>
                                <!-- fin fecha -->
                            </td>
                        </tr>
                        <tr>
                            <td nowrap>
                                <h1 class="m-0">Informe Médico</h1>
                            </td>
                            <td>
                                <img src="image/system/cruz.png" style="width:50px;height:50px;" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h2 class="m-0">Datos del Paciente</h2>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="lg-1">
                                <b>Nombre y apellido</b>: <br>
                                {{$user->apellidos}}, {{$user->nombres}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="lg-1">
                                <b>C.I</b>: {{$user->nacionalidad}}-{{number_format($user->cedula, 0, ",", ".")}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="lg-1">
                                <b>Edad</b>: {{$user->edad}} Años
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="lg-1">

                                <b>F. Nacimiento</b>: {{date('d/m/Y', strtotime($user->fnacimiento))}}
                            </td>
                        </tr>
                    </table>
                    <table class="mt-2 ml-3">
                        <tr>
                            <td colspan="2" class="lg-1">
                                <b>Médico Tratante</b>:<br> Dr. Mario Isea
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="lg-1">
                                <b>F. Ingreso al Programa</b>: {{date("d-m-Y",strtotime($fecha["finicio"]))}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="lg-1">
                                <b>F. Egreso al Programa</b>: {{date("d-m-Y",strtotime($fecha["ffin"]))}}
                            </td>
                        </tr>


                    </table>



                </div>
                <div style="height:14cm;" class="bg-cmdlt">

                </div>
            </div>
            <div class="aside-right">
                <div style="text-align: right">
                    <img src="image/system/logo-cmdlt-color.png" style="height:50px;" alt="">
                </div>
                <div style="text-align: right">
                    <h1 class="text-primary">Monitoreo</h1>
                </div>
                <div>
                    <h3>SatO2 <span style="font-size:0.7em;">%</span></h3>
                    <img id="grafico1" src="{{$g1[1]}}" alt="">
                </div>
                <div>
                    <h3>FR <span style="font-size:0.7em;">rpm</span></h3>
                    <img id="grafico2" src="{{$g1[1]}}" alt="">
                </div>
                <div>
                    <h3>FC <span style="font-size:0.7em;">lpm</span></h3>
                    <img id="grafico3" src="{{$g1[1]}}" alt="">
                </div>
                <div>
                    <h3>Glicemia <span style="font-size:0.7em;">mg/dl</span></h3>
                    <img id="grafico4" src="{{$g1[1]}}" alt="">
                </div>

            </div>
            <footer>
                <div class="bg-primary" style="height: 40px;"></div>
            </footer>
<div class="page-break"></div>

<div class="aside-left">
    <div style="height:15cm; padding-top:2cm;" class="bg-primary">
        <table class="ml-3">
            <tr>
                <td colspan="2">
                    <!-- inicio fecha -->
                    <article aria-label="fecha">
                        <b>Caracas, {{date("d")}} de {{mes((int) date("m"))}} del {{date("Y")}}</b>
                    </article>
                    <!-- fin fecha -->
                </td>
            </tr>
            <tr>
                <td nowrap>
                    <h1 class="m-0">Observaciones</h1>
                </td>

            </tr>
            <tr>
                <td colspan="2" class="lg-1">

                </td>
            </tr>

        </table>
    </div>
    <div style="height:14cm;" class="bg-primary">

    </div>
    <div style="
        whith:100%;
        border:3px solid white;
        background-color:#ffffff36;
        height:23cm;
        border-radius:10px;
        padding:5px;
        position:absolute;
        top:4.5cm;
        margin-right:5px;
        right:5px;
        font-size:1.2rem;
        overflow:hidden;
        /* color:rgb(37, 37, 37); */
    ">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum voluptates nam aliquid, harum quis assumenda, inventore accusantium ex perferendis
        voluptatum eum animi hic repudiandae. Pariatur cumque suscipit libero minima dolorum. <br><br>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magni soluta, corporis voluptatem ipsum accusamus quis illo fugit sed fugiat quas sint autem eligendi, recusandae nulla dignissimos libero ex! Facilis.
        Ea ipsam recusandae nemo hic. Voluptates cupiditate consequuntur ducimus expedita aliquam.<br><br> maiores explicabo maxime accusantium, similique obcaecati quisquam totam dolore quia sint alias, id perspiciatis facilis doloremque? Itaque, sequi doloribus.
        Laboriosam maiores, mollitia rerum asperiores quasi tempora eius odio veniam esse recusandae culpa doloremque vero cupiditate suscipit iure temporibus id minima minus tempore? Officia voluptatibus sunt corrupti rerum iure itaque.
        Repudiandae odit fugit nostrum consequuntur beatae, expedita possimus nesciunt autem aliquam.<br><br> laudantium fuga tempore pariatur tenetur voluptatem culpa natus! Distinctio fugit illum fugiat rerum animi accusamus eaque consectetur? Eveniet, deserunt?
    </div>
</div>
<div class="aside-right">
    <div style="text-align: right">
        <img src="image/system/logo-cmdlt-color.png" style="height:50px;" alt="">
    </div>
    <div style="text-align: right">
        <h1 class="text-primary">Monitoreo</h1>
    </div>
    <div>
        <h3>Presión Arterial Sistólica <span style="font-size:0.7em;">mmHg</span></h3>
        <img id="grafico5" src="{{$g1[1]}}" alt="">
    </div>
    <div>
        <h3>Presión Arterial Diástólica <span style="font-size:0.7em;">mmHg</span></h3>
        <img id="grafico6" src="{{$g1[1]}}" alt="">
    </div>

</div>


            {{--
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


       --}} </main>

        <footer>
            <div class="bg-primary" style="height: 40px;"></div>
        </footer>
        <!-- jQuery -->
        <script src="/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
        <!-- ChartJS -->
        <script src="/AdminLTE-3.0.5/plugins/Chart.min.js"></script>

    </body>

</html>
