<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vista Familiares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {

            /*https://www.cmdlt.edu.ve/wp-content/uploads/2020/01/medicina-cmdlt.jpg*/
            background: url("/image/system/cmdlt-cirugia.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .glassmod-effect {
            background-color: rgb(255 255 255 / 30%);
            backdrop-filter: blur(20px);
            border: 1px solid rgb(255 255 255 / 50%);

            /* color: white; */
        }

        .bg-transp-1 {
            background-color: rgb(255 255 255 / 10%);
            border-radius: 0.3rem;
        }

        .shadow-1 {
            text-shadow: 2px 2px 2px rgb(0 0 0 / 50%);
            ;
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
    <nav class="container-fluid text-white">

        <div class="row  align-items-center">
            <div class="order-1 col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <div class="d-flex shadow-1 mt-0 mt-md-5 flex-column align-items-center px-2 rounded"
                    style="backdrop-filter: blur(20px);">
                    <div class="d-flex ">
                        <div id="clock" style="line-height:1;font-size:4rem;">01:06</div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div id="ampm" style="font-size:1.5rem; line-height:1;">AM</div>
                            <div id="segundos" style="font-size:2rem; line-height:0.8;">13</div>
                        </div>
                    </div>
                    <div id="fechaHoy" class="d-flex" style="font-size:1.2rem">13 de Marzo de 2023</div>
                </div>
            </div>
            <div class="order-3 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-8">
                <h1 class="shadow-1 text-center">
                    Área de pacientes y familiares
                </h1>
            </div>
            <div
                class="order-2 col-5 col-sm-6 col-md-2 col-lg-3 col-xl-3 col-xxl-2 order-md-3 order-md-3  p-0   d-none d-sm-block">
                <img style="width:20rem;height:4rem" class="img-fluid  float-sm-end"
                    src="https://patientcare.saludchacao.pstelemed.com/image/system/logo-cmdlt_mono.svg" alt="">
            </div> <!-- style="" -->
        </div>
    </nav>
    <div style="height:81vh" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mx-sm-3 table-responsive">
                    <table style="border-collapse: separate" class="w-100">
                        <thead>

                            <tr class="shadow-1">
                                <th rowspan="2" style="vertical-align: bottom"
                                    class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Paciente</span>
                                </th>
                                <th class="h2 text-center text-white">
                                    <span class="">Cirujano</span>
                                </th>
                                <th class="h2 text-center text-white">
                                    <span class="">Tiempo</span><br>
                                </th>
                                <th rowspan="2" style="vertical-align: bottom"
                                    class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Estatus</span>
                                </th>

                                <th colspan="2" class="h2 text-center text-white">
                                    <span class="">Ubicación</span><br>

                                </th>
                                <th rowspan="2" style="vertical-align: bottom"
                                    class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Qr</span>
                                </th>


                            </tr>
                            <tr class="shadow-1">
                                <th class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Especialidad</span>
                                </th>
                                <th class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Cirugía</span>
                                </th>
                                <th class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Actual</span>
                                </th>
                                <th class="pb-3 h2 text-center text-white">
                                    <span class="border-bottom border-primary border-5">Destino</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="listadoPacientes">


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="offset-5 col-2">
                <div class="mt-2">
                    <div id="updateBarTable" style="height:10px;" class="loading rounded bg-white shadow-sm"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
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
        let template = `
  <tr>
    <td class="rounded-start swing-in-top-fwd  p-4 border-0 glassmod-effect">
      <span
          class="bg-primary text-white px-2"
          style="
            border-bottom-right-radius: 0.4rem;
            border-top-left-radius: 0.4rem;
            position:absolute;
            top:0;
            left:0
          "
        >
        _NUMERO_PACIENTE_
      </span>


      <h2 class="shadow-1 text-white">
        _NOMBRE_PACIENTE_
      </h2>
      <small class="text-dark">
        <b>Cédula:</b> 18.014.778 |
        <b>Edad:</b> 27 años
      </small>

    </td>
    <td class=" swing-in-top-fwd p-2 border-0 glassmod-effect">

        <h3 class="shadow-1 text-white">
          Luis Eduardo Parodi Arrieta
        </h3>
        <b>Especialidad:</b> Cirujano Plástico

    </td>
    <td class=" swing-in-top-fwd p-2 border-0 glassmod-effect">

        <div class="d-flex align-items-center flex-column">
          <b>Inicio:</b>
          <h5 class="shadow-1 text-white">
            10:00 AM
          </h5>
        </div>
        <div class="d-flex align-items-center flex-column">
          <b>Fin:</b>
          <h5 class="shadow-1 text-white">
            10:00 AM
          </h5>
        </div>
    </td>
    <td class=" swing-in-top-fwd p-2 border-0 glassmod-effect">
      <h3 class="shadow-1 text-white">
        En recuperación
      </h3>
    </td>
    <td class=" swing-in-top-fwd p-2 border-0 glassmod-effect">
      <h3 class="shadow-1 text-white">
        En quirófano
      </h3>
    </td>
    <td class="swing-in-top-fwd p-2 border-0 glassmod-effect">
      <h3 class="shadow-1 text-white">
        Hab. 2355
      </h3>
    </td>
    <td class="rounded-end text-center swing-in-top-fwd p-2 border-0 glassmod-effect">
      <img style="width:100px;height:100px;"  src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Commons_QR_code.png">
    </td>

  </tr>

  `

        let getData = async function() {
            let resultset = await fetch("https://jsonplaceholder.typicode.com/users")
            return await resultset.json()
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

        let getPacientes = async (datos) => {

            entById('listadoPacientes').innerHTML = null
            datos.forEach((pac, key) => {



                let paciente = template
                let keyNumber = key + 1
                paciente = paciente.replace("_NUMERO_PACIENTE_", keyNumber)
                paciente = paciente.replace("_NOMBRE_PACIENTE_", pac.name)
                paciente = paciente.replace("_CEDULA_", "1.234.567")
                paciente = paciente.replace("_EDAD_", "27 años")
                //paciente = paciente.replace("_HORA_INICIO_","10:00 AM")
                //paciente = paciente.replace("_HORA_FIN_","11:00 AM")
                //paciente = paciente.replace("_ESTATUS_","Recuperación")
                //paciente = paciente.replace("_DESTINO_","Hab. 3298")

                entById('listadoPacientes').insertAdjacentHTML("beforeend", paciente)

            })
        }
        let paginacion = 0
        const nuevoArray = [];

        let handleResultadosaMostrar = (datos) => {
            // Iteramos sobre el array original y lo dividimos en trozos de 4 objetos
            for (let i = 0; i < datos.length; i += 4) {
                const trozo = datos.slice(i, i + 4); // Obtenemos 4 objetos a partir del índice actual
                nuevoArray.push(trozo); // Agregamos el trozo al nuevo array como un objeto
            }

            console.log(nuevoArray);
        }

        let handleLoading = (anchoActual) => {

            // Obtenemos el elemento div por su id
            const miDiv = document.getElementById("updateBarTable");
            miDiv.style.width = `100%`;
            // Guardamos el ancho inicial del div

            let total = (anchoActual / 20)
            // Creamos un intervalo que se ejecuta cada 1 segundo
            const intervalo = setInterval(() => {
                miDiv.style.width = `${anchoActual}%`;
                // Disminuimos el ancho en 10 píxeles
                anchoActual -= total;
                console.log(anchoActual)
                // Actualizamos el ancho del div


            }, 1000);
        }
        d.addEventListener("DOMContentLoaded", async () => {
            let data = await getData()
            handleResultadosaMostrar(data)

            await getPacientes(nuevoArray[paginacion])
            paginacion++

            handleLoading(100)
            setInterval(async function(e) {
                handleLoading(100)
                await getPacientes(nuevoArray[paginacion])

                paginacion++
                let total = nuevoArray.length - 1
                if (paginacion == total) {
                    paginacion = 0
                } else {

                }

            }, 20000)
            //nuevoTiempo++

            relog()
        })
    </script>


</body>

</html>
