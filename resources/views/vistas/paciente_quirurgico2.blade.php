<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pacientes y familiares</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
    <style>
        :root {
        --radius-table-row: 10px;
        /*  --table-border-row-color:rgb(240, 240, 241); */
        }

        table {
        width: 100%;
        border-collapse: separate !important;
        border-spacing: 0px 10px;
        /* Espaciado vertical entre filas */
        }
        tr{
            font-size: 1.3rem;
        }
        th,
        td {
        padding: 5px;
        }

        td {
        height: 80px;

        }
        .shadow-1 {
            text-shadow: 2px 2px 2px rgb(0 0 0 / 50%);
            ;
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
    </style>

</head>

<body>
    <div class="container-fluid px-5">
        <table>
            <thead>
                <tr>
                  <th class="text-white">
                    <h2 class="shadow-1">Área de pacientes y familiares</h2>

                  </th>


                  <th colspan="4" class="tbl-row-radius-left text-center text-white  text-shadow tbl-row-radius-right h1">
                    <div class="d-flex shadow-1 flex-column pl-5 rounded" >
                        <div class="d-flex ">
                            <div id="clock" style="line-height:1;font-size:4rem;">00:00</div>
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div id="ampm" style="font-size:1.5rem; line-height:1;">--</div>
                                <div id="segundos" style="font-size:2rem; line-height:0.8;">00</div>
                            </div>
                        </div>
                        <div id="fechaHoy" class="d-flex" style="font-size:1.2rem">00 de mes de 0000</div>
                    </div>
                  </th>
                  <td >
                    <div class="flex-grow-1 d-flex justify-content-end">
                     {{--  <img  class="img-logo d-none d-md-block"  src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg" alt="Logo CMDLT">
                      <img  class="img-logo d-block d-md-none"  src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT"> --}}
                      <i class="pc-cmdt-isotipo d-block d-md-none text-white mr-2 h1"></i>
                      <i class="pc-cmdt-isotipo  d-none d-md-block text-primary mr-2 h1"></i>
                    </div>
                  </td>
                </tr>
                <tr class="text-center text-white shadow-sm">
                  <th class="bg-primary sticky-top text-uppercase shadow-1 tbl-row-radius-left">Paciente</th>
                  <th class="bg-primary sticky-top text-uppercase shadow-1">Cirujano<br>Especialidad</th>
                  <th class="bg-primary sticky-top text-uppercase shadow-1">Tiempo<br>Cirugía</th>
                  <th class="bg-primary sticky-top text-uppercase shadow-1">Estatus</th>
                  <th class="bg-primary sticky-top text-uppercase shadow-1">Ubicación<br>Actual</th>
                  <th class="bg-primary sticky-top text-uppercase shadow-1">Ubicación<br>Destino</th>
                </tr>

              </thead>
          <tbody>

          </tbody>



        </table>
      </div>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    </script>
    <script>

        let d = document
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
        let relog = () => {
            setInterval(() => {
                let date = new Date()
                let hora = date.getHours()
                //console.log(hora)
                let ampm = hora > 12 ? 'PM' : 'AM'
                hora = horaPm[String(hora)]
                let fechaHoy =
                    `${date.getDate()} de ${mesesEnEspanol[date.getMonth()]} de ${date.getFullYear()}`
                let clock = `${hora}:${String(date.getMinutes()).padStart(2, '0')}`

                entById('segundos').innerHTML = String(date.getSeconds()).padStart(2, '0')
                entById('ampm').innerHTML = ampm
                entById('clock').innerHTML = clock
                entById('fechaHoy').innerHTML = fechaHoy
            }, 1000)
        }
        let renderRow = (color,number)=>{
            return /*html*/ `<tr class="glassmod-effect swing-in-top-fwd shadow-sm">


                    <td class="tbl-row-radius-left text-center pl-5">
                        <span class="bg-primary text-white px-2 shadow-1" style="
                                border-bottom-right-radius: 0.4rem;
                                border-top-left-radius: 0.4rem;
                                position:absolute;
                                top:0;
                                left:0
                            ">
                            ${number}
                        </span>
                        <b class="mr-2">CI:</b>
                            <span>1.234.567</span>
                    </td>
                    <td class="text-center">

                        <div class="d-flex flex-column align-items-center">

                            <b>Dr. Carlos Pérez:</b>
                            <div>Cirujano Plástico</div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mr-2">Inicio:</div>
                                <h5 class="shadow-1 text-white ">
                                    10:00 AM
                                </h5>
                            </div>
                            <h5 class="badge badge-success text-white mb-0">
                               + 00:00:00
                            </h5>
                        </div>
                    </td>
                    <td class="text-center">
                        En recuperación
                    </td>
                    <td class="text-center">
                        Quirófano
                    </td>
                    <td class="text-center">
                        Hab. 2355
                    </td>

                </tr>
            `

        }
        let table = document.querySelector(`table tbody`)
            table.innerHTML = null
            document.addEventListener("DOMContentLoaded",()=>{
                for(let i = 0; i<=6;i++){
                    let colorsSample =[
                        (Math.floor(Math.random() * 2) + 1),
                        (Math.floor(Math.random() * 2) + 1),
                        (Math.floor(Math.random() * 2) + 1),
                    ]

                    let color = []
                    if(colorsSample[0]==1){
                        color[0]="success"
                    }
                    if(colorsSample[0]==2){
                        color[0]="warning"
                    }
                    if(colorsSample[1]==1){
                        color[1]="success"
                    }
                    if(colorsSample[1]==2){
                        color[1]="warning"
                    }
                    if(colorsSample[2]==1){
                        color[2]="success"
                    }
                    if(colorsSample[2]==2){
                        color[2]="warning"
                    }
                    //console.log(color)
                    let row = renderRow(color,i+1)
                        table.insertAdjacentHTML("beforeend",row)
                }


                relog()
            })





    </script>


</body>

</html>
