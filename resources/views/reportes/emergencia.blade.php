<!doctype html>
<html lang="en">

    <head>
        <title>Reporte Emergencia</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/css/stylePatientcare.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
       <style>
            .tippy-box[data-theme~='tooltip-cmdlt-primary'] {
                background-color: var(--primary);
                color: white;
            }

            .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='top']>.tippy-arrow::before {
                border-top-color: var(--primary);
            }

            .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='bottom']>.tippy-arrow::before {
                border-bottom-color: var(--primary);
            }

            .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='left']>.tippy-arrow::before {
                border-left-color: var(--primary);
            }

            .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='right']>.tippy-arrow::before {
                border-right-color: var(--primary);
            }
           .piso {
                display: flex;
                justify-content: betwen;
                align-items: center;
                position: relative;
                /* margin: 2px 0 2px 0; */
                padding: 0.3rem 0.3rem 0.3rem 0.3rem;
                text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
                box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
                ;
                -webkit-box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
                -moz-box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
            }

            .text-shadow {
                text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
            }

            .column-1 {
                min-width: 90px;
                font-size: 1.5rem;
                 font-weight: 500;

            }

            .column-2 {
                font-size: 2rem;
                 font-weight: 500;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                width: 70px;

            }
            /* .column-3 {

            } */
            .shadow-bottom {
                box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
                -webkit-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
                -moz-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
            }


            .arrow-right {
                width: 0;
                height: 0;
                border-top: 15px solid transparent;
                border-bottom: 15px solid transparent;
                border-left: 15px solid rgb(255 255 255 / 30%);
            }


            .bed-on {
                opacity: 1
            }

            .bed-off {
                opacity: 0.1
            }

            .badge {
                width: 40px;
                color: white;
                border: 1px solid #ffffff;
                font-size: 1rem;
            }

            body {

                /*https://www.cmdlt.edu.ve/wp-content/uploads/2020/01/medicina-cmdlt.jpg*/
                /* background: url("http://drive.google.com/uc?export=view&id=1lOnAmjJm26ZhK9j0ERYKlSv58rInMWjG") no-repeat center center fixed; */
                background: url("/image/system/background_emergencia.jpg") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;

                /* background: rgb(0,58,126);
                            background: linear-gradient(269deg, rgb(24 84 155) 0%, rgb(10 62 135) 60%) rgb(255 58 58) 52%; */

                /*background: rgb(24,91,169);
                            background: linear-gradient(90deg, rgba(24,91,169,1) 0%, rgba(108,175,247,1) 48%, rgba(24,91,169,1) 100%);*/

            }


            .glassmod-effect {
                background-color: rgb(255 255 255 / 30%);
                backdrop-filter: blur(20px);
            }

            .rotate-in-ver {
                -webkit-animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both;
                animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both
            }

            @-webkit-keyframes rotate-in-ver {
                0% {
                    -webkit-transform: rotateY(-360deg);
                    transform: rotateY(-360deg);
                    opacity: 0
                }

                100% {
                    -webkit-transform: rotateY(0deg);
                    transform: rotateY(0deg);
                    opacity: 1
                }
            }

            @keyframes rotate-in-ver {
                0% {
                    -webkit-transform: rotateY(-360deg);
                    transform: rotateY(-360deg);
                    opacity: 0
                }

                100% {
                    -webkit-transform: rotateY(0deg);
                    transform: rotateY(0deg);
                    opacity: 1
                }
            }

            .scale-in-ver-top {
                -webkit-animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both;
                animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both
            }

            @-webkit-keyframes scale-in-ver-top {
                0% {
                    -webkit-transform: scaleY(0);
                    transform: scaleY(0);
                    -webkit-transform-origin: 100% 0;
                    transform-origin: 100% 0;
                    opacity: 1
                }

                100% {
                    -webkit-transform: scaleY(1);
                    transform: scaleY(1);
                    -webkit-transform-origin: 100% 0;
                    transform-origin: 100% 0;
                    opacity: 1
                }
            }

            @keyframes scale-in-ver-top {
                0% {
                    -webkit-transform: scaleY(0);
                    transform: scaleY(0);
                    -webkit-transform-origin: 100% 0;
                    transform-origin: 100% 0;
                    opacity: 1
                }

                100% {
                    -webkit-transform: scaleY(1);
                    transform: scaleY(1);
                    -webkit-transform-origin: 100% 0;
                    transform-origin: 100% 0;
                    opacity: 1
                }
            }

            .scale-in-hor-left {
                -webkit-animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both;
                animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both
            }

            @-webkit-keyframes scale-in-hor-left {
                0% {
                    -webkit-transform: scaleX(0);
                    transform: scaleX(0);
                    -webkit-transform-origin: 0 0;
                    transform-origin: 0 0;
                    opacity: 1
                }

                100% {
                    -webkit-transform: scaleX(1);
                    transform: scaleX(1);
                    -webkit-transform-origin: 0 0;
                    transform-origin: 0 0;
                    opacity: 1
                }
            }

            @keyframes scale-in-hor-left {
                0% {
                    -webkit-transform: scaleX(0);
                    transform: scaleX(0);
                    -webkit-transform-origin: 0 0;
                    transform-origin: 0 0;
                    opacity: 1
                }

                100% {
                    -webkit-transform: scaleX(1);
                    transform: scaleX(1);
                    -webkit-transform-origin: 0 0;
                    transform-origin: 0 0;
                    opacity: 1
                }
            }

            .vh-100 {
                height: 100vh;
            }
            .row_counter_user div:nth-child(1){
                width:15px;
                text-align:center;
            }
            .row_counter_user div:nth-child(2){
                width:30px;
                text-align:center;
            }
            .rounded-pill-1 {
                border-radius: 20px;
            }
            .rounded-top-pill {
                border-top-right-radius: 20px;
                border-top-left-radius: 20px;
            }

            .rounded-bottom-pill {
                border-bottom-right-radius: 20px;
                border-bottom-left-radius: 20px;
            }



            /*****/
                .total-title {
                    font-size: 1rem;
                    font-weight: 700;
                }
                .total-counter{
                    line-height: 1;
                }
            /*****/
            .total-counter,
            .total-counter-hp,
            .total-counter-uti {
                min-width: 70px;
            }
            @media (max-width: 576px) {
                header .img-logo {
                    height: 40px;
                    width: auto;
                }
                .header-titles {
                    font-size: 1rem;
                }

                .piso-height {
                    height: auto;
                }

                .total-icon {
                    font-size: 3rem !important;
                }

                .total-counter,
                .total-counter-hp,
                .total-counter-uti {
                    font-size: 4rem;
                    line-height: 1;
                }

                header .h1 {
                    font-size: 1rem !important;
                }

                header .h3 {
                    font-size: 1rem !important;
                }


            }

            @media (min-width: 576px) {
                header .img-logo {
                    height: 40px;
                     width: 120px;
                }
                .piso-height {
                    height: auto;
                }
                .header-titles {
                    font-size: 1.5rem;
                }


                .total-icon {
                    font-size: 4em;
                }

                .total-title {
                    font-size: 1rem;
                    font-weight: 700;
                }

                .total-counter,
                .total-counter-hp,
                .total-counter-uti {
                    font-size: 4rem;

                }
                .pc-cama_ocupada,
                .fa-bed {
                    font-size: 0.6rem;
                }
                header .h1 {
                    font-size: 2rem !important;
                }

                header .h3 {
                    font-size: 2rem !important;
                }
            }

            @media (min-width: 992px) {
                .total-icon {
                    font-size: 7em;
                }
                .header-titles {
                    font-size: 1.5rem;
                }
            }

       </style>
    </head>
    <body>
        <div class="d-flex flex-column vh-100 overflow-auto p-2 p-md-4">
            <header>
                <nav class="d-flex justify-content-bewteen">
                    <div class="d-flex flex-column glassmod-effect rounded-pill px-4 mr-2 justify-content-center h1 mb-0">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column align-items-center">
                                <div class="header-titles text-warning text-shadow">
                                    ÁREAS DE EMERGENCIA
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex-grow-1 d-flex justify-content-end">
                        <img  class="img-logo d-none d-md-block"  src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg" alt="Logo CMDLT">
                        <img  class="img-logo d-block d-md-none"  src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                    </div>
                </nav>
                <div class=" p-0">
                    <div class="col-12 col-md-4 col-lg-3 header-date pl-4 mt-1 mb-1 mb-sm-3 text-white text-nowrap rounded-pill glassmod-effect p-1 text-shadow">
                        mes 00, 0000 00:00pm
                    </div>
                </div>


            </header>
            <div class="flex-fill d-flex justify-content-center align-items-md-center">
                <div class="container p-sm-0">

                    <div class="row align-items-center">

                        <div class="col-12 col-sm-12 col-md-4 p-0 p-sm-0">
                            <div class="glassmod-effect flex-fill rounded-pill-1 text-white text-center text-shadow mr-sm-2 py-md-3">
                                <div class="total-title text-center d-none d-block d-sm-block d-md-block">Pacientes</div>
                                <div class="d-flex justify-content-center">
                                    <i class="total-icon d-block d-md-block pc-light-patient-copia-3 text-white text-shadow rotate-in-ver mb-1"></i>
                                    <div class="total-title d-none d-sm-none d-md-none d-lg-none text-center">Pacientes</div>
                                    <div class="d-flex justify-content-center align-items-center mx-2">
                                        <div class="tooltip-primary total-counter mr-2">00</div>
                                        <div>
                                            <div class="row_counter_user d-flex flex-row align-items-center">
                                                <div class="mr-1"><i class="fas fa-user"></i></div>
                                                <div class="tooltip-primary total-counter-adulto  border rounded px-1">00</div>
                                            </div>
                                            <div class="row_counter_user d-flex flex-row align-items-center mt-1">
                                                <div class="mr-1"><i class="fas fa-child"></i></div>
                                                <div class="tooltip-primary total-counter-pediatrico  border rounded px-1">00</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-8 p-0 p-sm-0 mt-1">
                            <div class="d-flex flex-column">
                                <div class="flex-fill d-flex">
                                    <div class="flex-shrink-1 px-md-3 glassmod-effect rounded-top-pill rounded-bottom-pill d-flex flex-column justify-content-center align-items-center">
                                        <div class="text-white text-center text-shadow py-1">
                                        <div class="total-title text-center d-none d-block d-sm-block d-md-block">Hospitalización</div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <i class="total-icon pc-cama_ocupada_solid text-white text-shadow rotate-in-ver"></i>
                                            <div class="total-title d-none d-sm-none d-md-none d-lg-none text-center">Hospitalización</div>
                                            <div class="d-flex justify-content-center align-items-center mx-2">
                                                <div class="tooltip-primary total-counter-hp mr-2">00</div>
                                                <div>
                                                    <div class=" row_counter_user d-flex flex-row align-items-center">
                                                        <div class="mr-1"><i class="fas fa-user"></i></div>
                                                        <div class="tooltip-primary total-counter-hp-adulto border rounded px-1">00</div>
                                                    </div>
                                                    <div class="row_counter_user d-flex flex-row align-items-center mt-1">
                                                        <div class="mr-1"><i class="fas fa-child"></i></div>
                                                        <div class="tooltip-primary total-counter-hp-pediatrico border rounded px-1">00</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                    <div id="items" class="flex-grow-1 d-flex flex-column justify-content-center pl-2 text-white">

                                    </div>
                                </div>
                                <div class="flex-fill d-flex align mt-1 mt-md-2">
                                    <div class="flex-shrink-1 px-md-3 glassmod-effect rounded-top-pill rounded-bottom-pill d-flex flex-column justify-content-center align-items-center">
                                        <div class="text-white text-center text-shadow py-1">
                                            <div class="total-title text-center d-block d-sm-block d-md-block d-lg-none">Terapia intensiva</div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <div class="total-title d-none d-sm-none d-md-none d-lg-block text-center">Terapia intensiva</div>
                                                <i class="total-icon pc-cama_ocupada text-white text-shadow rotate-in-ver"></i>
                                                <div class="d-flex justify-content-center align-items-center mx-2">
                                                    <div class="tooltip-primary total-counter-uti mr-2">00</div>
                                                    <div>
                                                        <div class="row_counter_user d-flex flex-row align-items-center">
                                                            <div class="mr-1"><i class="fas fa-user"></i></div>
                                                            <div class="tooltip-primary total-counter-uti-adulto border rounded px-1">00</div>
                                                        </div>
                                                        <div class="row_counter_user d-flex flex-row align-items-center mt-1">
                                                            <div class="mr-1"><i class="fas fa-child"></i></div>
                                                            <div class="tooltip-primary total-counter-uti-pediatrico border rounded px-1">00</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="items2" class="flex-grow-1 d-flex flex-column justify-content-center pl-2 text-white">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column"  >



                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>





        <!-- card pad -->

        <!-- tooltip info -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="/js/html2canvas.min.js"></script>
        <script>
let d = document

    function is_null(params) {
        return (params === null || params === "null") ? true : false
    }

    function is_empty(params) {
        return (params === "") || (params.length === 0) ? true : false
    }
    function is_undefined(params) {
        return (params === undefined || params === "undefined") ? true : false
    }
     function activarTooltip(){
            let array = ['primary','danger','success','info','warning','secondary','cyan','gray','purple','orange']
            for (let index = 0; index <= array.length; index++) {
                let element = array[index];
                tippy('.tooltip-'+element, {
                    allowHTML: true,
                    theme: 'tooltip-cmdlt-'+element,
                    zIndex: 200000
                })
            }
        }
    function meses(p) {
        let mes = [
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
            "Diciembre",
            "Enero"
        ]
        return mes[p];
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
    async function get(url) {
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
    async function reporte() {
       let model = await get(location.origin+"/vistas/v_hospitalizacion_reporte_diario")
            //console.log(model)
            /* if(is_undefined(model)){
                model = [
                    {
                        "cedula": "V-21.615.870",
                        "dias": 51,
                        "ingreso": "27-05-2023",
                        "alert": null,
                        "paciente": "Alberto Rizzitelli",
                        "genero": "m",
                        "telefono_movil": "+584143701514",
                        "imagen": "/image/system/patient.svg",
                        "id": 46741,
                        "cat_user_ubicacion_id": 186,
                        "user_id_paciente": 14150,
                        "user_id_medico": 13231,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 16975,
                        "created_at": "2023-06-04 17:39:57",
                        "updated_at": "2023-06-04 17:39:57",
                        "deleted_at": null,
                        "edad": 58
                    },
                    {
                        "cedula": "V-82.049.683",
                        "dias": 14,
                        "ingreso": "03-07-2023",
                        "alert": null,
                        "paciente": "Gloria maria Tome rodriguez",
                        "genero": "f",
                        "telefono_movil": "+5804143293020 / 04143206276",
                        "imagen": "/image/system/patient.svg",
                        "id": 48980,
                        "cat_user_ubicacion_id": 139,
                        "user_id_paciente": 14954,
                        "user_id_medico": 1901,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18198,
                        "created_at": "2023-07-04 15:54:11",
                        "updated_at": "2023-07-04 15:54:11",
                        "deleted_at": null,
                        "edad": 66
                    },
                    {
                        "cedula": "V-6.175.916",
                        "dias": 7,
                        "ingreso": "10-07-2023",
                        "alert": null,
                        "paciente": "Vicenzo Mazzone",
                        "genero": "m",
                        "telefono_movil": "+584142430838",
                        "imagen": "undefined",
                        "id": 49442,
                        "cat_user_ubicacion_id": 149,
                        "user_id_paciente": 10928,
                        "user_id_medico": 11677,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18484,
                        "created_at": "2023-07-10 16:20:11",
                        "updated_at": "2023-07-10 16:20:11",
                        "deleted_at": null,
                        "edad": 84
                    },
                    {
                        "cedula": "V-6.852.107",
                        "dias": 7,
                        "ingreso": "10-07-2023",
                        "alert": null,
                        "paciente": "Saverio Notarfrancesco Logiurato",
                        "genero": "m",
                        "telefono_movil": "+584128417307",
                        "imagen": "/image/system/patient.svg",
                        "id": 49452,
                        "cat_user_ubicacion_id": 148,
                        "user_id_paciente": 6712,
                        "user_id_medico": 13231,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18489,
                        "created_at": "2023-07-10 21:59:31",
                        "updated_at": "2023-07-10 21:59:31",
                        "deleted_at": null,
                        "edad": 86
                    },
                    {
                        "cedula": "V-5.151.950",
                        "dias": 6,
                        "ingreso": "11-07-2023",
                        "alert": null,
                        "paciente": "FORTUNATO CHOCRON BAENA",
                        "genero": "m",
                        "telefono_movil": "+584143244565",
                        "imagen": "/image/system/patient.svg",
                        "id": 49528,
                        "cat_user_ubicacion_id": 146,
                        "user_id_paciente": 6856,
                        "user_id_medico": 11675,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18536,
                        "created_at": "2023-07-11 16:22:40",
                        "updated_at": "2023-07-11 16:22:40",
                        "deleted_at": null,
                        "edad": 64
                    },
                    {
                        "cedula": "V-6.332.567",
                        "dias": 6,
                        "ingreso": "11-07-2023",
                        "alert": null,
                        "paciente": "Rafael Torrealba",
                        "genero": "m",
                        "telefono_movil": "+584120000000",
                        "imagen": "/image/system/patient.svg",
                        "id": 49536,
                        "cat_user_ubicacion_id": 362,
                        "user_id_paciente": 15112,
                        "user_id_medico": 11630,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18537,
                        "created_at": "2023-07-11 16:33:06",
                        "updated_at": "2023-07-11 16:33:06",
                        "deleted_at": null,
                        "edad": 54
                    },
                    {
                        "cedula": "V-16.905.624",
                        "dias": 4,
                        "ingreso": "13-07-2023",
                        "alert": null,
                        "paciente": "Fernanda Rojas",
                        "genero": "f",
                        "telefono_movil": "+584241512805",
                        "imagen": "/image/system/patient.svg",
                        "id": 49620,
                        "cat_user_ubicacion_id": 133,
                        "user_id_paciente": 8089,
                        "user_id_medico": 11630,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18593,
                        "created_at": "2023-07-13 05:19:29",
                        "updated_at": "2023-07-13 05:19:30",
                        "deleted_at": null,
                        "edad": 4
                    },
                    {
                        "cedula": "V-5.738.957",
                        "dias": 3,
                        "ingreso": "14-07-2023",
                        "alert": null,
                        "paciente": "Mayra Rengifo",
                        "genero": "f",
                        "telefono_movil": "+584142017754",
                        "imagen": "undefined",
                        "id": 49803,
                        "cat_user_ubicacion_id": 257,
                        "user_id_paciente": 10202,
                        "user_id_medico": 11675,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18674,
                        "created_at": "2023-07-14 20:40:50",
                        "updated_at": "2023-07-14 20:40:50",
                        "deleted_at": null,
                        "edad": 62
                    },
                    {
                        "cedula": "V-2.984.738",
                        "dias": 2,
                        "ingreso": "15-07-2023",
                        "alert": null,
                        "paciente": "Margarita Fonseca de Caballero",
                        "genero": "f",
                        "telefono_movil": "+582129621394",
                        "imagen": "/image/system/patient.svg",
                        "id": 49806,
                        "cat_user_ubicacion_id": 150,
                        "user_id_paciente": 15172,
                        "user_id_medico": 13231,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18690,
                        "created_at": "2023-07-15 06:37:15",
                        "updated_at": "2023-07-15 06:37:15",
                        "deleted_at": null,
                        "edad": 80
                    },
                    {
                        "cedula": "V-941.179",
                        "dias": 3,
                        "ingreso": "14-07-2023",
                        "alert": null,
                        "paciente": "Francisco Marcelo Abascal Alvarez",
                        "genero": "m",
                        "telefono_movil": "+584142671066",
                        "imagen": "/image/system/patient.svg",
                        "id": 49822,
                        "cat_user_ubicacion_id": 253,
                        "user_id_paciente": 15169,
                        "user_id_medico": 11676,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18689,
                        "created_at": "2023-07-15 17:01:32",
                        "updated_at": "2023-07-15 17:01:32",
                        "deleted_at": null,
                        "edad": 90
                    },
                    {
                        "cedula": "V-21.143.896",
                        "dias": 1,
                        "ingreso": "16-07-2023",
                        "alert": null,
                        "paciente": "Gabriela Juliet Rodrígues Vásquez",
                        "genero": "f",
                        "telefono_movil": "+584242310109",
                        "imagen": "/image/system/patient.svg",
                        "id": 49836,
                        "cat_user_ubicacion_id": 140,
                        "user_id_paciente": 7200,
                        "user_id_medico": 13209,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18702,
                        "created_at": "2023-07-16 07:02:15",
                        "updated_at": "2023-07-16 07:02:15",
                        "deleted_at": null,
                        "edad": 30
                    },
                    {
                        "cedula": "V-4.354.892",
                        "dias": 12,
                        "ingreso": "05-07-2023",
                        "alert": null,
                        "paciente": "Ana Maria Teresa Perez Bueno",
                        "genero": "f",
                        "telefono_movil": "+584120000000",
                        "imagen": "/image/system/patient.svg",
                        "id": 49837,
                        "cat_user_ubicacion_id": 254,
                        "user_id_paciente": 13965,
                        "user_id_medico": 13209,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18285,
                        "created_at": "2023-07-16 07:05:16",
                        "updated_at": "2023-07-16 07:05:16",
                        "deleted_at": null,
                        "edad": 70
                    },
                    {
                        "cedula": "V-11.735.001",
                        "dias": 3,
                        "ingreso": "14-07-2023",
                        "alert": null,
                        "paciente": "GILBERTO LUIS PEREZ VON SEGGERN",
                        "genero": "m",
                        "telefono_movil": "+582129486411",
                        "imagen": "/image/system/patient.svg",
                        "id": 49875,
                        "cat_user_ubicacion_id": 130,
                        "user_id_paciente": 15167,
                        "user_id_medico": 13231,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18679,
                        "created_at": "2023-07-16 17:29:37",
                        "updated_at": "2023-07-16 17:29:38",
                        "deleted_at": null,
                        "edad": 52
                    },
                    {
                        "cedula": "V-11.957.067",
                        "dias": 1,
                        "ingreso": "16-07-2023",
                        "alert": null,
                        "paciente": "Yunara Rodriguez",
                        "genero": "f",
                        "telefono_movil": "+584120000000",
                        "imagen": "/image/system/patient.svg",
                        "id": 49889,
                        "cat_user_ubicacion_id": 153,
                        "user_id_paciente": 15192,
                        "user_id_medico": 11627,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18722,
                        "created_at": "2023-07-17 06:38:10",
                        "updated_at": "2023-07-17 06:38:10",
                        "deleted_at": null,
                        "edad": 50
                    },
                    {
                        "cedula": "V-84.409.497",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "WU WEICUN",
                        "genero": "f",
                        "telefono_movil": "+584125555555",
                        "imagen": "/image/system/patient.svg",
                        "id": 49890,
                        "cat_user_ubicacion_id": 255,
                        "user_id_paciente": 10241,
                        "user_id_medico": 11627,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18723,
                        "created_at": "2023-07-17 06:42:10",
                        "updated_at": "2023-07-17 06:42:10",
                        "deleted_at": null,
                        "edad": 60
                    },
                    {
                        "cedula": "V-15.075.026",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "YOHANA RUJANO",
                        "genero": "f",
                        "telefono_movil": "04129131872",
                        "imagen": "/image/system/patient.svg",
                        "id": 49891,
                        "cat_user_ubicacion_id": 92,
                        "user_id_paciente": 3424,
                        "user_id_medico": 13231,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18724,
                        "created_at": "2023-07-17 06:56:21",
                        "updated_at": "2023-07-17 06:56:22",
                        "deleted_at": null,
                        "edad": 42
                    },
                    {
                        "cedula": "V-3.251.106",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Caricia Elena Sanchez Mora",
                        "genero": "f",
                        "telefono_movil": "+584123162092",
                        "imagen": "undefined",
                        "id": 49892,
                        "cat_user_ubicacion_id": 138,
                        "user_id_paciente": 1111,
                        "user_id_medico": 13231,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18725,
                        "created_at": "2023-07-17 06:57:32",
                        "updated_at": "2023-07-17 06:57:32",
                        "deleted_at": null,
                        "edad": 74
                    },
                    {
                        "cedula": "V-30.395.528",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Silva Castro Fabiana de Jesus",
                        "genero": "f",
                        "telefono_movil": "+584242114982",
                        "imagen": "/image/system/patient.svg",
                        "id": 49893,
                        "cat_user_ubicacion_id": 142,
                        "user_id_paciente": 15193,
                        "user_id_medico": 13231,
                        "value": "Ingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18726,
                        "created_at": "2023-07-17 07:00:55",
                        "updated_at": "2023-07-17 07:00:55",
                        "deleted_at": null,
                        "edad": 19
                    },
                    {
                        "cedula": "V-3.588.167",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Gustavo Antonio Nahmens Bravo",
                        "genero": "m",
                        "telefono_movil": "+582127942990",
                        "imagen": "/image/system/patient.svg",
                        "id": 49894,
                        "cat_user_ubicacion_id": 146,
                        "user_id_paciente": 15194,
                        "user_id_medico": 13231,
                        "value": "Ingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18727,
                        "created_at": "2023-07-17 07:05:43",
                        "updated_at": "2023-07-17 07:05:43",
                        "deleted_at": null,
                        "edad": 72
                    },
                    {
                        "cedula": "V-11.736.455",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Matteo Gerardo Frattallone Roye",
                        "genero": "m",
                        "telefono_movil": "+580412232128",
                        "imagen": "/image/system/patient.svg",
                        "id": 49924,
                        "cat_user_ubicacion_id": 131,
                        "user_id_paciente": 15207,
                        "user_id_medico": 11679,
                        "value": "Ingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18746,
                        "created_at": "2023-07-17 11:00:04",
                        "updated_at": "2023-07-17 11:00:04",
                        "deleted_at": null,
                        "edad": 13
                    },
                    {
                        "cedula": "V-2.427.126",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Elisa Yolanda Perez de Ramos",
                        "genero": "f",
                        "telefono_movil": "+584142490305",
                        "imagen": "/image/system/patient.svg",
                        "id": 49926,
                        "cat_user_ubicacion_id": 145,
                        "user_id_paciente": 7163,
                        "user_id_medico": 11679,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18747,
                        "created_at": "2023-07-17 11:04:50",
                        "updated_at": "2023-07-17 11:04:51",
                        "deleted_at": null,
                        "edad": 73
                    },
                    {
                        "cedula": "V-4.484.953",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Brenda Contreras",
                        "genero": "f",
                        "telefono_movil": "+584166079747",
                        "imagen": "/image/system/patient.svg",
                        "id": 49928,
                        "cat_user_ubicacion_id": 94,
                        "user_id_paciente": 11173,
                        "user_id_medico": 11679,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18748,
                        "created_at": "2023-07-17 11:10:00",
                        "updated_at": "2023-07-17 11:10:00",
                        "deleted_at": null,
                        "edad": 71
                    },
                    {
                        "cedula": "V-9.958.982",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Miguel Mitre",
                        "genero": "m",
                        "telefono_movil": "+584142628849",
                        "imagen": "/image/system/patient.svg",
                        "id": 49969,
                        "cat_user_ubicacion_id": 134,
                        "user_id_paciente": 15205,
                        "user_id_medico": 13472,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18758,
                        "created_at": "2023-07-17 15:39:39",
                        "updated_at": "2023-07-17 15:39:39",
                        "deleted_at": null,
                        "edad": 53
                    },
                    {
                        "cedula": "V-8.494.681",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "SONIA KUFFATTI ATTIE",
                        "genero": "f",
                        "telefono_movil": "+584120000000",
                        "imagen": "/image/system/patient.svg",
                        "id": 49977,
                        "cat_user_ubicacion_id": 144,
                        "user_id_paciente": 15211,
                        "user_id_medico": 11634,
                        "value": "Ingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18760,
                        "created_at": "2023-07-17 16:12:41",
                        "updated_at": "2023-07-17 16:12:41",
                        "deleted_at": null,
                        "edad": 58
                    },
                    {
                        "cedula": "V-676.909",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Virginia Padilla",
                        "genero": "f",
                        "telefono_movil": "+584165364779",
                        "imagen": "/image/system/patient.svg",
                        "id": 49978,
                        "cat_user_ubicacion_id": 256,
                        "user_id_paciente": 15208,
                        "user_id_medico": 11634,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18761,
                        "created_at": "2023-07-17 16:44:47",
                        "updated_at": "2023-07-17 16:44:47",
                        "deleted_at": null,
                        "edad": 87
                    },
                    {
                        "cedula": "V-7.085.842",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Jose Querales",
                        "genero": "m",
                        "telefono_movil": "+584148859874",
                        "imagen": "/image/system/patient.svg",
                        "id": 49979,
                        "cat_user_ubicacion_id": 143,
                        "user_id_paciente": 15212,
                        "user_id_medico": 11675,
                        "value": "Ingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18762,
                        "created_at": "2023-07-17 16:50:01",
                        "updated_at": "2023-07-17 16:50:01",
                        "deleted_at": null,
                        "edad": 58
                    },
                    {
                        "cedula": "V-30.663.968",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Diego Rasetta",
                        "genero": "m",
                        "telefono_movil": "+584125874140",
                        "imagen": "/image/system/patient.svg",
                        "id": 49980,
                        "cat_user_ubicacion_id": 141,
                        "user_id_paciente": 15213,
                        "user_id_medico": 11677,
                        "value": "Ingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18763,
                        "created_at": "2023-07-17 17:58:01",
                        "updated_at": "2023-07-17 17:58:01",
                        "deleted_at": null,
                        "edad": 20
                    },
                    {
                        "cedula": "V-13.224.669",
                        "dias": 0,
                        "ingreso": "17-07-2023",
                        "alert": null,
                        "paciente": "Iliana Maria Da silva araujo",
                        "genero": "f",
                        "telefono_movil": "+584120000000",
                        "imagen": "/image/system/patient.svg",
                        "id": 49981,
                        "cat_user_ubicacion_id": 129,
                        "user_id_paciente": 12219,
                        "user_id_medico": 11679,
                        "value": "Reingreso",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18764,
                        "created_at": "2023-07-17 18:18:47",
                        "updated_at": "2023-07-17 18:18:47",
                        "deleted_at": null,
                        "edad": 46
                    },
                    {
                        "cedula": "V-4.090.161",
                        "dias": 8,
                        "ingreso": "09-07-2023",
                        "alert": null,
                        "paciente": "Maigualida Coromoto Sanoja Gimon",
                        "genero": "f",
                        "telefono_movil": "+584141375687",
                        "imagen": "/image/system/patient.svg",
                        "id": 49982,
                        "cat_user_ubicacion_id": 252,
                        "user_id_paciente": 15063,
                        "user_id_medico": 11675,
                        "value": "Traslado",
                        "coments": null,
                        "prioridad": "0",
                        "active": "1",
                        "user_cuest_episodio_id": 18437,
                        "created_at": "2023-07-17 18:43:07",
                        "updated_at": "2023-07-17 21:43:06",
                        "deleted_at": null,
                        "edad": 73
                    }
                ]
            } */
        return model
    }
    let renderCard = (key,borderInferiorOsuperior,element,camas)=>{
        //console.log(element)
        return `
            <div class="piso mb-md-1 glassmod-effect piso-height scale-in-ver-top shadow-lg ${borderInferiorOsuperior}">
                <div data-tippy-content="${element.description}" class="tooltip-primary column-1 pr-1 px-sm-2 text-uppercase">
                    ${element.title}
                </div>
                <div data-tippy-content="${element.total.length} pacientes en ${element.title}" class="tooltip-primary column-2 px-3 border-left border-secondary total-piso-counter">
                    ${element.total.length}
                </div>
                <div class="column-5 border-left border-secondary border-right px-2 align-items-end d-flex flex-column">
                    <div data-tippy-content="${element.adulto.length} Adultos en ${element.title}" class="tooltip-primary row_counter_user d-flex flex-row align-items-center">
                        <div class="mr-1"><i class="fas fa-user"></i></div>
                        <div class="border rounded ${element.adulto.length >0?'font-weight-bold':''}  px-1">${element.adulto.length}</div>
                    </div>
                    <div data-tippy-content="${element.pediatrico.length} Pediátricos en ${element.title}" class="tooltip-primary row_counter_user d-flex flex-row align-items-center mt-1">
                        <div class="mr-1"><i class="fas fa-child"></i></div>
                        <div class="border rounded ${element.pediatrico.length >0?'font-weight-bold':''} px-1">${element.pediatrico.length}</div>
                    </div>
                </div>

                <div class="flex-grow-1 d-none d-sm-block">
                    <div class="bed-box d-flex  px-sm-2 flex-wrap align-items-center overflow-hidden">
                        ${camas}
                    </div>
                </div>

            </div>


        `
    }
    let useState= {
            "HP6":{"title":"HP6", "description":"Hospitalización Piso 6",  "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "HP5":{"title":"HP5", "description":"Hospitalización Piso 5",  "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "HP4":{"title":"HP4", "description":"Hospitalización Piso 4",  "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "HP3":{"title":"HP3", "description":"Hospitalización Piso 3",  "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "HP2":{"title":"HP2", "description":"Hospitalización Piso 2", "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "RETEN":{"title":"RETEN", "description":"Retén", "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "HCEP":{"title":"HCEP", "description":"Hospitalización Corta Estancia Pediátrica", "adulto":null,"pediatrico":null,"total":null,"subtotal":true, "active":true},
            "UTIP":{"title":"UTIP", "description":"Unidad de Tratamiento Intensivo Pediátrico", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},
            "UTIA":{"title":"UTIA", "description":"Unidad de Tratamiento Intensivo Adulto", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},
            "UTIN":{"title":"UTIN", "description":"Unidad de Tratamiento Intensivo Neonatal", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},
            "DIALISIS":{"title":"DIÁL", "description":"DIÁLISIS", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},

            "TOTAL":{"title":"TOTAL", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},
            "TOTAL_HOSPITALIZACION":{"title":"TOTAL", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},
            "TOTAL_UTI":{"title":"TOTAL", "adulto":null,"pediatrico":null,"total":null,"subtotal":false, "active":true},

        }
    let start = async ()=>{
        d.querySelectorAll(".total-icon").forEach(x=>{
            x.classList.remove( "rotate-in-ver" )
        })
        //FECHA DEL REPORTE
        let  fecha = new Date();
            fecha = meses(fecha.getMonth()).toUpperCase()+ " " + fecha.getDate() + ", " + fecha.getFullYear()  + " " + formatAMPM(fecha);
            d.querySelectorAll('.header-date').forEach(x=>{
                x.innerHTML=fecha
            })


        let model = await reporte();
            //console.log(model)
            //console.log(useState)


        let areas_id = {
                "HP2":[44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69],
                "HP3":[72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97],
                "HP4":[100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,358,359,360,361,362,363],
                "HP5":[128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,252,253,254,255,256,257,258,259,260],
                "HP6":[156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,261,262,263,264,265,266,267,268,269],
                "RETEN":[],
                "HCEP":[390],
                "UTIA":[184,185,186,187,188,189,190,191,192,193],
                "UTIP":[213,214,215,216,217,218,219,220,221,222],
                "UTIN":[],
                "DIALISIS":[],
                "TOTAL":function (param) {
                    let model = []
                        for (const key in this) {
                            if (!["TOTAL","TOTAL_HOSPITALIZACION","TOTAL_UTI"].includes(key)) {
                                model = [...model,...this[key]]
                            }
                        }
                        return model;
                 },
                "TOTAL_HOSPITALIZACION":function (param) {
                    let model = []
                        for (const key in this) {
                            if (["HP2","HP3","HP4","HP5","HP6","RETEN","HCEP",].includes(key) ) {

                                model = [...model,...this[key]]
                            }
                        }
                        return model;
                 },
                "TOTAL_UTI":function (param) {
                    let model = []
                        for (const key in this) {
                            if (["UTIP","UTIA","UTIN","DIALISIS"].includes(key) ) {

                                model = [...model,...this[key]]
                            }
                        }
                        return model;
                 },
            }
            for (const key in areas_id) {
                if (Object.hasOwnProperty.call(useState, key)) {
                    //console.log(key)
                    if (["HP2","HP3","HP4","HP5","HP6","RETEN","HCEP","UTIP","UTIA","UTIN","DIALISIS"].includes(key)) {
                        useState[ key ]['camas_id'] = areas_id[key]
                    }else{
                        useState[ key ]['camas_id'] = areas_id[key]()
                    }
                    useState[ key ]['adulto'] = model.filter(pad => useState[ key ]['camas_id'].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] > 17  )
                    useState[ key ]['pediatrico'] = model.filter(pad => useState[ key ]['camas_id'].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] < 18 )
                    useState[ key ]['total'] = model.filter(pad => useState[ key ]['camas_id'].includes( pad['cat_user_ubicacion_id'] ) )
                }
            }

            console.log(useState )
            d.querySelector(".total-counter").textContent = useState['TOTAL']['total'].length
            d.querySelector(".total-counter").dataset['tippyContent'] = `${useState['TOTAL']['total'].length} pacientes entre Hospitalización y Terapia Intensiva`
            d.querySelector(".total-counter-adulto").textContent = useState['TOTAL']['adulto'].length
            d.querySelector(".total-counter-adulto").dataset['tippyContent'] = `${useState['TOTAL']['adulto'].length} adultos entre Hospitalización y Terapia Intensiva`

            d.querySelector(".total-counter-pediatrico").textContent = useState['TOTAL']['pediatrico'].length
            d.querySelector(".total-counter-pediatrico").dataset['tippyContent'] = `${useState['TOTAL']['pediatrico'].length} Pediátricos entre Hospitalización y Terapia Intensiva`

            d.querySelector(".total-counter-hp").textContent = useState['TOTAL_HOSPITALIZACION']['total'].length
            d.querySelector(".total-counter-hp").dataset['tippyContent'] = `${useState['TOTAL_HOSPITALIZACION']['total'].length} pacientes en Hospitalización`

            d.querySelector(".total-counter-hp-adulto").textContent = useState['TOTAL_HOSPITALIZACION']['adulto'].length
            d.querySelector(".total-counter-hp-adulto").dataset['tippyContent'] = `${useState['TOTAL_HOSPITALIZACION']['adulto'].length} adultos en Hospitalización`

            d.querySelector(".total-counter-hp-pediatrico").textContent = useState['TOTAL_HOSPITALIZACION']['pediatrico'].length
            d.querySelector(".total-counter-hp-pediatrico").dataset['tippyContent'] = `${useState['TOTAL_HOSPITALIZACION']['pediatrico'].length} pediátricos en Hospitalización`

            d.querySelector(".total-counter-uti").textContent = useState['TOTAL_UTI']['total'].length
            d.querySelector(".total-counter-uti").dataset['tippyContent'] = `${useState['TOTAL_UTI']['total'].length} pacientes en UTI`

            d.querySelector(".total-counter-uti-adulto").textContent = useState['TOTAL_UTI']['adulto'].length
            d.querySelector(".total-counter-uti-adulto").dataset['tippyContent'] = `${useState['TOTAL_UTI']['adulto'].length} adultos en UTI`

            d.querySelector(".total-counter-uti-pediatrico").textContent = useState['TOTAL_UTI']['pediatrico'].length
            d.querySelector(".total-counter-uti-pediatrico").dataset['tippyContent'] = `${useState['TOTAL_UTI']['pediatrico'].length} pediátricos en UTI`








        let box = entById("items");
        let box2 = entById("items2");
            box.innerHTML = null
            box2.innerHTML = null
        let color = (data)=>{
                //console.log("🚀 ~ file: index.blade.php ~ line 361 ~ color ~ user", Number(user['alert']))

                switch(Number(data)){
                    case 1: return 'white'; break;
                    case 2: return 'warning'; break;
                    case 3: return 'danger'; break;
                    default: return 'white'; break;
                }
            }
        let i =0;
            for (const key in useState) {
                console.log(key)
                if (["HP2","HP3","HP4","HP5","HP6","RETEN","HCEP"].includes(key)) {
                    if ((i+1) <= (Object.values(useState).length -1) ) {
                        let borderInferiorOsuperior = ""
                            if(i==0){
                                borderInferiorOsuperior = "rounded-top-pill"
                            }
                            if(i==6){
                                borderInferiorOsuperior = "rounded-bottom-pill"
                            }
                        let camas = ""
                            useState[key]['total'].forEach((x,z)=>{
                                if(z < useState[key]['total'].length ){
                                    let alert = !is_null(x['alert']) ? x['alert'] : 1
                                    camas += `<i id="template_${x['user_cuest_episodio_id']}" class="fas fa-bed text-${color(alert)} ml-1"></i>`
                                }else{
                                    camas += `<i class="fas fa-bed text-white ml-1 bed-off"></i>`

                                }
                            })

                        let card = renderCard( i, borderInferiorOsuperior,useState[key],camas)

                            box.insertAdjacentHTML("beforeend",card)

                        useState[key]['total'].forEach(user=>{
                            //console.log(user)
                            let color = (user)=>{
                                //console.log("🚀 ~ file: index.blade.php ~ line 361 ~ color ~ user", Number(user['alert']))

                                    switch(Number(user['alert'])){
                                        case 1: return 'success'; break;
                                        case 2: return 'warning'; break;
                                        case 3: return 'danger'; break;
                                        default: return 'success'; break;
                                    }
                                }

                            tippy(`#template_${user['user_cuest_episodio_id']}`, {
                                content: `
                                    <h5>${user['paciente']}</h5>
                                    <div>
                                        <div>
                                            <b>Edad:</b> ${user['edad']} años
                                        </div>
                                        <div>
                                            <b>Ingreso:</b> ${user['ingreso']}
                                        </div>
                                        <div>
                                            <b>Días:</b> ${user['dias']}
                                        </div>
                                    </div>
                                `,
                                theme: 'tooltip-cmdlt-primary',
                                allowHTML: true,
                            });
                        })
                    }


                }
                if (["UTIP","UTIA","UTIN","DIALISIS"].includes(key)) {
                    if ((i+1) <= (Object.values(useState).length -1) ) {
                        let borderInferiorOsuperior = ""
                            if(i==7){
                                borderInferiorOsuperior = "rounded-top-pill"
                            }
                            if(i==10){
                                borderInferiorOsuperior = "rounded-bottom-pill"
                            }
                        let camas = ""
                        useState[key]['total'].forEach((x,z)=>{
                                if(z < useState[key]['total'].length ){
                                    let alert = !is_null(x['alert']) ? x['alert'] : 1
                                    camas += `<i id="template_${x['user_cuest_episodio_id']}" class="pc-cama_ocupada text-${color(alert)} ml-1" id="template_${x['user_id_paciente']}"></i>`
                                }else{
                                    camas += `<i class="pc-cama_ocupada text-${color(alert)} ml-1"></i>`

                                }
                            })


                        let card = renderCard( i, borderInferiorOsuperior,useState[key],camas)

                            box2.insertAdjacentHTML("beforeend",card)
                        useState[key]['total'].forEach(user=>{
                            //console.log(user)
                            let color = (user)=>{
                                //console.log("🚀 ~ file: index.blade.php ~ line 361 ~ color ~ user", Number(user['alert']))

                                    switch(Number(user['alert'])){
                                        case 1: return 'success'; break;
                                        case 2: return 'warning'; break;
                                        case 3: return 'danger'; break;
                                        default: return 'success'; break;
                                    }
                                }

                            tippy(`#template_${user['user_cuest_episodio_id']}`, {
                                content: `
                                    <h5>${user['paciente']}</h5>
                                    <div>
                                        <div>
                                            <b>Edad:</b> ${user['edad']} años
                                        </div>
                                        <div>
                                            <b>Ingreso:</b> ${user['ingreso']}
                                        </div>
                                        <div>
                                            <b>Días:</b> ${user['dias']}
                                        </div>
                                    </div>
                                `,
                                theme: 'tooltip-cmdlt-primary',
                                allowHTML: true,
                            });
                        })

                    }
                }
                i++
            }

                    d.querySelector(".total-icon").classList.add( "rotate-in-ver" )
            }


            d.addEventListener("DOMContentLoaded", async function(){
                setInterval( async() => {
                    await start()
                    activarTooltip()
                }, 60000);
                    await start()
                activarTooltip()

            })
        </script>
    </body>

</html>
