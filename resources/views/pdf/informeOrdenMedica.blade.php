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
    </style>

</head>

<body>
    <nav class="navbar-level-1 header-bg-color">

        <h1 class="header-title-color" style="font-size:25px;position:absolute;left:10;top:-10; margin-top:28px;">Ordenes Médicas</h1>
        <img src="image/system/{{ $v['logoSystemVersion'] }}" style="height:45px;position:absolute;right:110" alt="">

    </nav>
    <section>
        <table  style="width:100%; margin:0px; border-radius:10px;">
            
            <tr>
                <td > </td>
                <td style="width:60px;">
                    <h4 class="text-primary" style="margin-bottom:4px;text-align:right;">Fecha:</h4>
                </td>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary text-center" style=" font-size:12px; ">
                            {{ $model["FECHA_INFORME"] }}
                        </div>
                    </div>
                </td>
                <td style="width:60px;">
                    <h4 class="text-primary" style="margin-bottom:4px;text-align:right">Hora:</h4>
                </td>
                <td valign="top" class="text-secondary">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary text-center" style=" font-size:12px; ">
                            {{ $model["HORA_INFORME"] }}
                        </div>
                    </div>
                </td>
            </tr>  
            
        </table>
    </section>
    <section>
        <table style="width:100%; margin:0px !important;  border-radius:10px;">
            <tr>
                <td style="width:60%">
                    <h4 class="text-primary" style="margin-bottom:4px">Paciente</h4>
                </td>
                <td style="width:40%">
                    <h4 class="text-primary" style="margin-bottom:4px">Datos de Equipo Médico</h4>
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
                                    {{ $model['user']['NACIMIENTO'] }}
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
                <td valign="middle" class="text-secondary ">
                    <div class="rounded border-box-respuesta bg-white" style="margin:5px;padding:5px;height:190px;">
             
                        <ul style="margin:0px;padding:0px;width:100%;font-size: 12px;list-style: none;margin:0px">
                            @foreach ($model['episodio']['EQUIPO_MEDICO'] as $item)
                                <li style="margin:4;padding:0">
                                
                                    <span style="width:15px;" class="badge bg-{{ $item['badge_color'] }} text-white">{{ $item['position_siglas']}}</span> {{ $item['medico']}}
                                   
                                </li>
                            @endforeach
                        </ul>
                       
                    </div>
                </td>
            </tr>
        </table>
    </section>
    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            <tr>
                <td>
                    <h4 class="text-primary" style="margin-bottom:4px">Diagnóstico</h4>
                </td>
            </tr>
            <tr>
                <td valign="top" class="text-secondary ">
                    <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                        <div class="text-secondary" style=" font-size:12px; height:100px;">
                            {{ $model['episodio']['IMP_DIAG'] }}
                        </div>
                    </div>
                </td>
            </tr>  
            
        </table>
    </section>
    
    <section>
        <table style="width:100%; margin:0px; border-radius:10px;">
            <tr>
                <td colspan="2">
                    <h4 class="text-primary" style="margin-bottom:4px">Ordenes Médicas</h4>
                </td>
            </tr>

            
                    
        @foreach ($model["episodio"]["ORDENES_MEDICAS"] as $key => $item)
            
                <tr>
                    <td style="width:20px;" class="text-secondary ">
                        {{ $key+1 }}
                    </td>
                    <td valign="top" class="text-secondary ">
                        <div class="rounded bg-white" style="margin: 0 5px 0 5px;padding:5px;">
                            <div class="text-secondary" style=" font-size:12px;">
                                {{ $item }}
                            </div>
                        </div>
                    </td>
                </tr>  
        @endforeach
                        
                    
                
            
        </table>
    </section>
  
 
  
    
    <section style="position:absolute;bottom:10">
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
                            @if ($model['medico']['firma'] != "image/user/firma/firma_patientcare_default.png")
                                <img onerror="this.src='image/system/firma_patientcare_default.png'" src="{{ $model['medico']['firma'] }}" style="position:absolute;top:660;right:50;height:90px;width:120px;b" alt="Firma no encontrada">
                            @endif
                            
                        </div>
                        
                        <div style="margin:0px;padding:0px;">
                            <h5 class="text-primary">Sello</h5>
                            @if ($model['medico']['sello'] != "image/user/sello/sello_patientcare_default.png")
                                <img onerror="this.src='image/system/sello_patientcare_default.png'" src="{{ $model['medico']['sello'] }}" style="position:absolute;top:680;right:50;height:110px;width:120px;" alt="Sello no encontrado">
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
    <footer class="text-secondary" style="position: absolute;right:30px;bottom:10;font-size:10px;">
       
        
    </footer>

    

</body>

</html>
