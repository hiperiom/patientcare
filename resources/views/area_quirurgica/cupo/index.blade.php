<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plan Quirúrgico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/dist/css/adminlte.css')}}">
     <link href="/css/scale.css" rel="stylesheet"/>
     <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">

     <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
     <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
     <link rel="stylesheet" href="{{asset('image/system/icomoon/style.css')}}">
     <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
    <style>
        :root {
            --radius-table-row: 10px;
            /*  --table-border-row-color:rgb(240, 240, 241); */
        }

        table {
            width: 100%;
            border-collapse: separate !important;
            /* border-spacing: 4px 10px; */
            /* Espaciado vertical entre filas */
        }
        tr{
            font-size: 1.1rem;
        }
        th,
        td {
        padding: 5px;
        }

        td {
            /* height: 80px; */
            height: fit-content;
        }
        .shadow-1 {
            text-shadow: 1px 1px 2px rgb(0 0 0 / 100%);
        }
        .glassmod-effect {
        background-color: rgb(255 255 255 / 30%);
        backdrop-filter: blur(20px);
        }

        .corner-radius-top-left {
        border-top-left-radius: var(--radius-table-row);
        }

        .corner-radius-bottom-left {
        border-bottom-left-radius: var(--radius-table-row);
        }

        .tbl-row-radius-left {
        border-top-left-radius: var(--radius-table-row);
        border-bottom-left-radius: var(--radius-table-row);
        border-left: 1px solid var(--table-border-row-color);
        border-top: 1px solid var(--table-border-row-color);
        border-bottom: 1px solid var(--table-border-row-color);
        }

        .tbl-row-radius-right {
        border-top-right-radius: var(--radius-table-row);
        border-bottom-right-radius: var(--radius-table-row);
        border-right: 1px solid var(--table-border-row-color);
        border-top: 1px solid var(--table-border-row-color);
        border-bottom: 1px solid var(--table-border-row-color);
        }

        .sticky-top {
        position: sticky;
        }

        .text-shadow {
        text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
        }

        body {

        /*https://www.cmdlt.edu.ve/wp-content/uploads/2020/01/medicina-cmdlt.jpg*/
            /*         background: url("http://drive.google.com/uc?export=view&id=1MF_BH8YAEllzSBXlqn5bA9V0GdS_5Leg") no-repeat center center fixed;
        */        background: url("https://patientcare.cmdlt.pstelemed.com/image/system/background_quirofano.jpg") no-repeat center center fixed;

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

        /* background: rgb(0,58,126);
                        background: linear-gradient(269deg, rgb(24 84 155) 0%, rgb(10 62 135) 60%) rgb(255 58 58) 52%;
        */
        /*   background: rgb(24,91,169);
                        background: linear-gradient(90deg, rgba(24,91,169,1) 0%, rgba(108,175,247,1) 48%, rgba(24,91,169,1) 100%);
        */
        }

        .img-logo {
        height: 50px;
        width: 120px;
        }

        .swing-in-top-fwd {
        -webkit-animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both;
        animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both
        }

        @-webkit-keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
        }

        @keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
        }
        .h-100{
            height: 100vh;
        }
        ul, li{
        margin:0 0 0 0;
        padding:0 0 0 0;
        }
        .blink-2{-webkit-animation:blink-2 .9s infinite both;animation:blink-2 .9s infinite both}
    @-webkit-keyframes blink-2{0%{opacity:1}50%{opacity:.2}100%{opacity:1}}@keyframes blink-2{0%{opacity:1}50%{opacity:.2}100%{opacity:1}}
    </style>

</head>

<body>
    <div class="d-flex flex-column h-100">
        <div class="flex-shrink-1 container-fluid  py-2 text-white d-flex align-items-center justify-content-between">
            {{-- <h2 class="shadow-1">Plan Quirúrgico</h2> --}}
            <div class="col-1">
                <i class="mr-2 pc-fa-patientcare-logo  h3 mb-0"></i>
            </div>

            <div class="col-2 d-flex shadow-1 flex-column align-items-center rounded" >
                <div class="d-flex align-items-center">
                    <div class="dropdown mr-1"><!-- style="line-height:1;font-size:4rem;" -->
                        <button class="btn btn-default text-white shadow-1 bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                        <ul class="dropdown-menu p-1" style="z-index: 1111111">
                            <li>
                                @php
                                    $fecha = isset($_GET['fecha']) ? $_GET['fecha']: date("Y-m-d");

                                @endphp
                                <input id="fecha_reporte" type="date" value="{{ $fecha}}" class="bg-transparent w-100" id="">

                            </li>
                            <li>
                                <button
                                    onclick="actualizarPlan()"
                                    class="btn btn-success btn-sm btn-block mt-1"
                                    href="#">
                                    Actualizar fecha
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div id="clock" class="d-flex align-items-center" style="font-size: 45px;">
                        <div class="dia mr-1">00</div>
                        <div class="mx-1">|</div>
                        <div class="mr-1 mes text-uppercase"></div>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <div class="anio" style="font-size: 2rem;line-height:1;">0000</div>
                        <div class="hora" style="font-size: 1.3rem;line-height: 1;">0:00 AM</div>
                    </div>
                </div>
                <div id="fechaHoy" class="d-flex"></div>
            </div>
            <div class="glassmod-effect col-2 py-1 px-2 m-1" style="border-radius:var(--radius-table-row: 10px);border-radius: 1.25rem;">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="shadow-1" style="font-size: 1.5rem; line-height: 1;">
                        Total IQX<br>
                        Programadas
                    </div>
                    <b id="total_cirugias" class="text-white shadow-1 mr-3" style="font-size: 3rem;">
                        0
                    </b>
                </div>
            </div>
            <div class="glassmod-effect col-2 py-1 px-2 m-1" style="border-radius:var(--radius-table-row: 10px);border-radius: 1.25rem;">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="shadow-1" style="font-size: 1.5rem; line-height: 1;">
                        Total Hospitalización
                    </div>
                    <b id="total_hospitalizacion" class="text-white shadow-1 mr-3" style="font-size: 3rem;">
                        0
                    </b>
                </div>
            </div>
            <div class="glassmod-effect col-3 py-1 px-2 m-1" style="border-radius:var(--radius-table-row: 10px);border-radius: 1.25rem;">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="shadow-1" style="font-size: 1.5rem; line-height: 1;">
                        Total Ambulatorio MAPM
                    </div>
                    <b id="total_ambulatoria" class="text-white shadow-1 mr-3" style="font-size: 3rem;">
                        0
                    </b>
                </div>
            </div>
            <div class="col-1 text-right">
                <img  class="img-logo mr-1" style="height: auto;width: 150px;"  src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg" alt="Logo CMDLT">
            </div>


        </div>
        <div class="flex-grow-1 d-flex container-fluid overflow-auto">
           <div class="col-9">
            <table>
                <thead>

                    <tr class="text-center text-white shadow-sm">
                        <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-left">Qx</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Datos del Paciente</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Hora</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Horas QX</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Intervención</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Cirujano Principal</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Anestesiólogo</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1">Equipos Especiales</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-right">Destino</th>
                    </tr>

                    </thead>
                <tbody>

                </tbody>



            </table>
           </div>
           <div class="col-3">
            <table id="table2" class="table" style="">
                <thead>
                    <tr >
                        <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-left">QX</th>
                        <th  class="bg-primary sticky-top text-uppercase shadow-1">C. ANESTESIA</th>
                        <th  class="bg-primary sticky-top text-uppercase shadow-1">C. CIRUGÍA</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-right">INSTRUM</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <table id="table3" class="table" >
                <thead>
                    <tr >
                        <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-left">PRE-ANESTESIA</th>
                        <th  class="bg-primary sticky-top text-uppercase shadow-1">RECUPERACIÓN</th>
                        <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-right">OBST / PED</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
           </div>


        </div>
        {{-- <div class="flex-shrink-1 container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="glassmod-effect py-1 px-2 m-1" style="border-radius:var(--radius-table-row: 10px);border-radius: 1.25rem;">
                        <div class="d-flex justify-content-between align-items-center text-primary">
                            <div style="font-size: 1.5rem; line-height: 1;">
                                En Pre-anestesia
                            </div>
                            <b id="total_preanestesia" class="text-info shadow-1 mr-3" style="font-size: 3rem;">
                                0
                            </b>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="glassmod-effect py-1 px-2 m-1" style="border-radius:var(--radius-table-row: 10px);border-radius: 1.25rem;">
                        <div class="d-flex justify-content-between align-items-center text-primary">
                            <div style="font-size: 1.5rem; line-height: 1;">
                                En Recuperación
                            </div>
                            <b id="total_recuperacion" class="text-warning shadow-1 mr-3" style="font-size: 3rem;">
                                0
                            </b>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="glassmod-effect py-1 px-2 m-1" style="border-radius:var(--radius-table-row: 10px);border-radius: 1.25rem;">
                        <div class="d-flex justify-content-between align-items-center text-primary">
                            <div style="font-size: 1.5rem; line-height: 1;">
                                Pre y Post Obstetrico / Pediátrico
                            </div>
                            <b id="total_postquirurgico" class="text-success shadow-1 mr-3" style="font-size: 3rem;">
                                0
                            </b>
                        </div>
                    </div>
                </div>

            </div>

        </div> --}}
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <script>

        let d = document
        let useState ={
            "solicitudes": []
        }
        let horaPm = {
                '1': '01',
                '2': '02',
                '3': '03',
                '4': '04',
                '5': '05',
                '6': '06',
                '7': '07',
                '8': '08',
                '9': '09',
                '10': '10',
                '11': '11',
                '12': '12',
                '13': '01',
                '14': '02',
                '15': '03',
                '16': '04',
                '17': '05',
                '18': '06',
                '19': '07',
                '20': '08',
                '21': '09',
                '22': '10',
                '23': '11',
                '0': '12'
            }
        // Get the input field
        let myInput = document.getElementById("fecha_reporte");

            // Execute a function when the user presses a key on the keyboard
            myInput.addEventListener("keypress", function(event) {
                // If the user presses the "Enter" key on the keyboard
                if (event.key === "Enter") {
                    actualizarPlan()
                }
            })
        let mesesEnEspanol = [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ];
        let table = document.querySelector(`table tbody`)
        let table2 = document.querySelector(`#table2 tbody`)
        let table3 = document.querySelector(`#table3 tbody`)
        let fecha_reporte = document.querySelector(`#fecha_reporte`).value
        let actualizarPlan = ()=>{
                fecha_reporte = document.querySelector(`#fecha_reporte`).value
                location.href= location.origin+ `/areaQuirofano/cupo/index?fecha=${fecha_reporte}`
            }
            function formatAMPM(date) {

                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;

                return strTime;
            }
        let post = async (url, data) => {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: data
                });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        let get = async (url, data) => {
            try {
                const response = await fetch(
                    url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        let relog = async () => {


                fecha = fecha_reporte.split("-")
            let dia = fecha[2].padStart(2, '0')
            let mes = fecha[1].padStart(2, '0')
            let anio = fecha[0]

            setInterval(() => {
                let date = new Date()
                let hora = date.getHours()
                //console.log(hora)
                let ampm = hora > 12 ? 'PM' : 'AM'
                hora = horaPm[String(hora)]
                let fechaHoy =
                    `${date.getDate()} de ${mesesEnEspanol[date.getMonth()]} de ${date.getFullYear()}`
                let clock = `${hora}:${String(date.getMinutes()).padStart(2, '0')}`
                d.querySelector('.mes').textContent = mesesEnEspanol[Number(mes)-1].slice(0,3)
                d.querySelector('.dia').textContent = dia
                d.querySelector('.anio').textContent = anio
                d.querySelector('.hora').textContent = formatAMPM(date)
                //entById('segundos').innerHTML = String(date.getSeconds()).padStart(2, '0')
                //entById('ampm').innerHTML = ampm
                //entById('clock').innerHTML = clock
                //entById('fechaHoy').innerHTML = fechaHoy
            }, 1000)
        }
        let horaAMPM2 = (param) =>{
            let m = "AM"
            let p = param.split(":")
            let hora = p[0];
                //console.log(p[0])
                if (parseInt(p[0]) > 12) {
                    m = "PM"
                    switch(p[0]){
                        case "13": hora = "1"; break
                        case "14": hora = "2"; break
                        case "15": hora = "3"; break
                        case "16": hora = "4"; break
                        case "17": hora = "5"; break
                        case "18": hora = "6"; break
                        case "19": hora = "7"; break
                        case "20": hora = "8"; break
                        case "21": hora = "9"; break
                        case "22": hora = "10"; break
                        case "23": hora = "11"; break

                    }
                }
                if (parseInt(p[0]) === 0) {
                    hora = "12";
                }

                return `${hora.padStart(2, '0')}:${p[1].padStart(2, '0')} ${m.toString().padStart(2, '0')}`


        }
        let is_undefined = (params) =>{
            return (params === undefined || params === "undefined") ? true : false
        }
        let calcularTiempoRestante = (timestampInicio, horasASumar, selector) => {
                //console.log(timestampInicio, horasASumar, selector);
                const intervalo = 1000; // Intervalo de 1 segundo en milisegundos
                const fechaInicio = new Date(timestampInicio); // Convierte el timestamp en milisegundos

                // Calcula la fecha final sumando las horas
                const fechaFinal = new Date(fechaInicio.getTime() + horasASumar * 60 * 60 * 1000);

                // Crea un temporizador que se ejecutará cada segundo
                const temporizador = setInterval(function () {
                    const ahora = new Date();
                    const tiempoRestante = fechaFinal - ahora;

                    // Comprueba si el tiempo restante es menor o igual a cero
                    if (tiempoRestante <= 0) {
                        clearInterval(temporizador); // Detiene el temporizador cuando ha transcurrido todo el tiempo
                            //console.log("Tiempo agotado");
                        } else {
                        const segundosRestantes = Math.floor((tiempoRestante / 1000) % 60);
                        const minutosRestantes = Math.floor((tiempoRestante / (1000 * 60)) % 60);
                        const horasRestantes = Math.floor(tiempoRestante / (1000 * 60 * 60));

                        // Verifica si el tiempo restante es mayor que cero antes de actualizar el contenido
                            //console.log(fechaInicio.getTime() , ahora.getTime());
                            //console.log(fechaInicio.getTime() >= ahora.getTime());
                            /* document.querySelector(selector).innerHTML = `
                                <span class="badge badge-gray font-weight-normal">
                                    <i class="far fa-clock"></i> 00:00:00
                                </span>
                            `; */
                        if (tiempoRestante > 0 && fechaInicio.getTime() >= ahora.getTime()) {

                        }else{

                                document.querySelector(selector).innerHTML = `<span class="badge badge-success font-weight-normal">
                                <i class="far fa-clock"></i> ${horasRestantes.toString().padStart(2, "0")}:${minutosRestantes.toString().padStart(2, "0")}:${segundosRestantes.toString().padStart(2, "0")}
                                </span>`;
                        }
                    }
                }, intervalo);
            };
        let renderRow = (solicitud,number)=>{
            let intervencion =  "";
            let cirujano_principal =  "";
            let equipos_especiales =  "";
            let anestesiologo =  "";
                if (solicitud['intervencion'] !== null ) {
                    intervencion = JSON.parse(solicitud['intervencion']).map(c=>`<li>${c['description']}</li>`).join("")
                }
                if (solicitud['cirujano_principal'] !== null ) {
                    cirujano_principal = JSON.parse(solicitud['cirujano_principal']).map(c=>`<li>${c['description']}</li>`).join("")
                }
                if (solicitud['anestesiologo'] !== null ) {
                    anestesiologo = JSON.parse(solicitud['anestesiologo']).map(c=>`<li>${c['description']}</li>`).join("")
                }
                if (solicitud['equipos_especiales'] !== null ) {
                    equipos_especiales = JSON.parse(solicitud['equipos_especiales']).map(c=>`<li>${c['description']}</li>`).join("")
                }
           /*   */
            //console.log(solicitud)
            let h = new Date(solicitud['h_inicio'])
            let hora_inicio = horaAMPM2(h.getHours()+":"+h.getMinutes())

            return `<tr class="glassmod-effect swing-in-top-fwd shadow-sm">


                    <td class="tbl-row-radius-left text-center text-white p-1">
                        <h1 style="color:${getBgColor(solicitud['n_quirofano'])}" class="shadow-1">QX${solicitud['n_quirofano']}</h1>
                        <div class="h5 align-items-center justify-content-between text-white bg-preanestesia d-none ${solicitud.fase_ubicacion==='Pre-anestesia' ? 'd-flex':'' }" style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                            <div class="text-nowrap mr-1">En Pre-anestesia</div>
                            <div class="badge badge-warning">
                                <i class="fas fa-syringe"></i>
                            </div>
                        </div>
                        <div class="blink-2 h5 align-items-center justify-content-between text-white bg-preanestesia d-none ${solicitud.fase_ubicacion==='En quirófano' ? 'd-flex':'' }" style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                            <div class="text-nowrap mr-1">En Quirófano</div>
                            <div class="badge badge-info">
                                <i class="pc-cirugia"></i>
                            </div>
                        </div>
                        <div class="h5 align-items-center justify-content-between text-white bg-preanestesia d-none ${solicitud.fase_ubicacion==='Recuperación' ? 'd-flex':'' }" style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                            <div class="text-nowrap mr-1">En Recuperación</div>
                            <div class="badge badge-success">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>


                    </td>
                    <td class="text-center p-1">
                        <div class="d-flex flex-column w-100  text-dark">
                            <div class="d-flex justify-content-between align-items-center">
                                <b class="mr-2 text-nowrap">${solicitud['paciente']}</b>
                                <div class="d-flex flex-wrap">
                                    <span title="Emergencia" class="${solicitud.tipo_reservacion=='Emergencia'?'':'d-none'} badge badge-danger text-left text-white" >
                                        EM
                                    </span>
                                    <span title="Electiva" class="${solicitud.tipo_reservacion=='Electiva'?'':'d-none'} badge badge-warning text-left text-dark" >
                                        EL
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column text-nowrap text-dark">
                            <div class="d-flex">
                                <b class="mr-2">Edad:</b>
                                <div>${solicitud['edad']}</div>
                            </div>
                            <div class="d-flex">
                                <b class="mr-2">CI:</b>
                                <div>${solicitud['cedula']}</div>
                            </div>
                        </div>

                    </td>
                    <td class="text-center p-1">
                        <div class="text-center text-dark text-nowrap">${hora_inicio}</div>
                    </td>
                    <th class="text-center  text-dark p-1">
                        ${solicitud['horas_intervencion']}
                        <span id="solicitud_${solicitud['id']}"></span>
                    </th>
                    <td class="text-center p-1">
                        <ul class=" text-dark" style="list-style-type: none;">
                            ${intervencion}
                        </ul>

                    </td>
                    <th class="text-center p-1">
                        <ul class=" text-dark" style="list-style-type: none;">
                            ${cirujano_principal}
                        </ul>
                    </th>
                    <th class="text-center p-1">
                        <ul class=" text-dark" style="list-style-type: none;">
                            ${anestesiologo}
                        </ul>
                    </th>
                    <td class="text-center p-1">
                        <ul class=" text-dark" style="list-style-type: none;">
                            ${equipos_especiales}
                        </ul>
                    </td>
                    <td class="
                         p-1
                        ${solicitud['destino']==='Hospitalización'?'text-primary':''}
                        ${solicitud['destino']==='Ambulatorio'?'text-success':''}
                        tbl-row-radius-right text-center">
                        ${solicitud['destino']===null ?'':solicitud['destino']}
                    </td>
                </tr>
            `

        }

        let renderRow2 = (row,number)=>{
            let col1 = ""
            let col2 = ""
            let col3 = ""
            row.personal_asistencial.forEach(x=>{
                if(x['tipo_personal']==="c_anestesia"){
                    col1 += `
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                            <div class="text-dark">${x['personal']} </div>
                        </li>
                    `
                }

                if(x['tipo_personal']==="c_cirugia"){
                    col2 += `
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                            <div class="text-dark">${x['personal']} </div>
                        </li>
                    `
                }
                if(x['tipo_personal']==="instrumentista"){
                    col3 += `
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                            <div class="text-dark">${x['personal']} </div>
                        </li>
                    `
                }

            })


            return `
                <tr class="glassmod-effect swing-in-top-fwd shadow-sm">
                    <td style="vertical-align:middle;color:${row['backgroundColor']}; text-shadow: 1px 0px 2px rgba(72, 73, 76, 1);" class="tbl-row-radius-left text-center font-weight-bold p-1">
                        ${row['description']}
                    </td>

                    <td style="vertical-align:middle;" class="text-center p-1">
                        <ul class="list-group list-group-flush p-0">
                            ${col1}
                        </ul>
                    </td>
                    <td style="vertical-align:middle;" class="text-center p-1">
                        <ul class="list-group list-group-flush p-0">
                            ${col2}
                        </ul>
                    </td>
                    <td style="vertical-align:middle;" class="tbl-row-radius-right text-center p-1">
                        <ul class="list-group list-group-flush p-0">
                            ${col3}
                        </ul>
                    </td>
                </tr>
            `
        }
        let renderRow3 = (row,number)=>{
            let col1 = ""
            let col2 = ""
            let col3 = ""
            row.forEach(x=>{
                if(x['tipo_personal']==="preanestesia"){
                    col1 += `
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                            <div class="text-dark">${x['personal']} </div>
                        </li>
                    `
                }

                if(x['tipo_personal']==="recuperacion"){
                    col2 += `
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                            <div class="text-dark">${x['personal']} </div>
                        </li>
                    `
                }
                if(x['tipo_personal']==="obstetrico"){
                    col3 += `
                        <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                            <div class="text-dark">${x['personal']} </div>
                        </li>
                    `
                }

            })

            table3.insertAdjacentHTML("beforeend",
            `<tr class="glassmod-effect swing-in-top-fwd shadow-sm">
                    <td style="vertical-align:middle;color:${row['backgroundColor']};" class="p-1 tbl-row-radius-left text-center text-white">
                        <ul class="list-group list-group-flush p-0">
                            ${col1}
                        </ul>
                    </td>
                    <td class="p-1 " style="vertical-align:middle;">
                        <ul class="list-group list-group-flush p-0">
                            ${col2}
                        </ul>
                    </td>
                    <td class="p-1  tbl-row-radius-right" style="vertical-align:middle;">
                        <ul class="list-group list-group-flush p-0">
                            ${col3}
                        </ul>
                    </td>
                </tr>
            `)
        }

        let getAllOtroPersonalAsistensial = async ()=>{
            table3.innerHTML =`
                    <tr class="glassmod-effect shadow-sm">
                        <td colspan="4" class="tbl-row-radius-left tbl-row-radius-right shadow-1 text-white text-center">
                            <div class="d-flex w-100 justify-content-center">

                                <div class="spinner-border text-primary mr-1" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div>
                                    Por favor espere un momento...
                                </div>
                            </div>
                        </td>
                    </tr>
                `
                //patientcare.cmdlt.pstelemed.com/areaQuirofano/personal_asistencial/gelAll
            return await get( location.origin+"//areaQuirofano/personal_asistencial/gelAllOtroPersonal")
        }
        let getAllPersonalAsistensial = async ()=>{
            table2.innerHTML =`
                    <tr class="glassmod-effect shadow-sm">
                        <td colspan="4" class="tbl-row-radius-left tbl-row-radius-right shadow-1 text-white text-center">
                            <div class="d-flex w-100 justify-content-center">

                                <div class="spinner-border text-primary mr-1" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div>
                                    Por favor espere un momento...
                                </div>
                            </div>
                        </td>
                    </tr>
                `
                //patientcare.cmdlt.pstelemed.com/areaQuirofano/personal_asistencial/gelAll
            return await get( location.origin+"/areaQuirofano/personal_asistencial/gelAll")
        }
        let getAll = async ()=>{
            table.innerHTML =`
                    <tr class="glassmod-effect shadow-sm">
                        <td colspan="9" class="tbl-row-radius-left tbl-row-radius-right shadow-1 text-white text-center">
                            <div class="d-flex w-100 justify-content-center">

                                <div class="spinner-border text-primary mr-1" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div>
                                    Por favor espere un momento...
                                </div>
                            </div>
                        </td>
                    </tr>
                `
            return await get( location.origin+"/areaQuirofano/cupo/getAllExterno/"+fecha_reporte)
        }
        let getBgColor = (id)=>{
            //console.log(id)
            //console.log(useState['personalAsistensial'])
                let model = useState['personalAsistensial'].find(x=>x['id']===id)
                return !is_undefined(model) ? model['backgroundColor'] :'var(--white)'
            }
        let handlePlan = async ()=>{

            useState['otroPersonalAsistensial'] = await getAllOtroPersonalAsistensial()
            useState['personalAsistensial'] = await getAllPersonalAsistensial()
            useState['solicitudes'] = await getAll()
            table.innerHTML = null
            table2.innerHTML = null
            table3.innerHTML = null
            if( useState['solicitudes'].length >0){
                useState['solicitudes'].forEach((solicitud,i) => {
                    let row = renderRow(solicitud,i)
                        table.insertAdjacentHTML("beforeend",row)

                        calcularTiempoRestante(solicitud.h_inicio,solicitud.h_aprox_fin,`#solicitud_${solicitud.id}`)


                });
                //d.querySelector(`#total_preanestesia`).textContent = useState['solicitudes'].filter(x=>x['fase_ubicacion']==="Pre-anestesia").length
                //d.querySelector(`#total_recuperacion`).textContent = useState['solicitudes'].filter(x=>x['fase_ubicacion']==="Recuperación").length
                //d.querySelector(`#total_postquirurgico`).textContent = useState['solicitudes'].filter(x=>x['fase_ubicacion']==="Postquirúrgico").length
                d.querySelector(`#total_cirugias`).textContent = useState['solicitudes'].length
                d.querySelector(`#total_hospitalizacion`).textContent = useState['solicitudes'].filter(x=>x['destino']==="Hospitalización").length
                d.querySelector(`#total_ambulatoria`).textContent = useState['solicitudes'].filter(x=>x['destino']==="Ambulatorio").length
            }else{
                table.innerHTML =`
                    <tr class="glassmod-effect swing-in-top-fwd shadow-sm">
                        <td colspan="9" class="tbl-row-radius-left tbl-row-radius-right shadow-1 text-white text-center">
                            No posee plan quirúrgico actualmente
                        </td>
                    </tr>
                `
            }

            if( useState['personalAsistensial'].length >0){
                useState['personalAsistensial'].forEach((solicitud,i) => {
                    let row = renderRow2(solicitud,i)
                        table2.insertAdjacentHTML("beforeend",row)




                });

            }else{
                table2.innerHTML =`
                    <tr class="glassmod-effect swing-in-top-fwd shadow-sm">
                        <td colspan="4" class="tbl-row-radius-left tbl-row-radius-right shadow-1 text-white text-center">
                            No posee quirófanos disponibles
                        </td>
                    </tr>
                `
            }
            if( useState['otroPersonalAsistensial'].length >0){
                let solicitud = useState['otroPersonalAsistensial']
                    renderRow3(solicitud)







            }else{
                table3.innerHTML =`
                    <tr class="glassmod-effect swing-in-top-fwd shadow-sm">
                        <td colspan="3" class="tbl-row-radius-left tbl-row-radius-right shadow-1 text-white text-center">
                            No posee quirófanos disponibles
                        </td>
                    </tr>
                `
            }
        }
        let intervals = []
            function detenerIntervalos() {
                intervals.forEach(interval => {
                    clearInterval(interval);
                });

                // Limpiar el array de intervalos
                intervals.length = 0;
            }
            document.addEventListener("DOMContentLoaded", async()=>{
                await handlePlan()
                let interval1 = setInterval( async() => {
                    detenerIntervalos();
                    await handlePlan()
                }, 60000);
                intervals.push(interval1);

                relog()
                const dropdown = document.querySelector(".dropdown");

                dropdown.addEventListener("click", function(event) {
                    // Detiene la propagación del evento para evitar que el dropdown se cierre
                    event.stopPropagation();
                });

                // Cierra el dropdown cuando se hace clic fuera de él
                document.addEventListener("click", function() {
                    const dropdownMenu = dropdown.querySelector(".dropdown-menu");
                    dropdownMenu.classList.remove("show");
                });
            })





    </script>


</body>

</html>
