@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
   {{--   @include('component.menu_principal_v2')--}}
@endsection

@section('content')
    <header>

    </header>
    <main class=" overflow-auto p-1" style="height:91vh;padding-bottom: 10vh !important;">

    </main>
    <footer>

    </footer>




        <!--
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalFullscreen">
        Launch
        </button>


        <div class="modal fade" id="modalFullscreen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <img class="cursor-pointer" data-dismiss="modal" aria-label="Close" loading="lazy" style="height: 2em;width: 10em;" src="/image/system/patientcare_bw.svg"></a>
                            </div>
                            <div>
                                <button type="button" class="cerrar heartbeat p-0 m-0 text-white" style="font-size: 2.5em;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>


                    </div>
                    <div class="modal-body">

                        <div id="carouselExampleControls" class="carousel slide carousel-fade overflow-auto" style="height:90vh" data-interval="false" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item  active">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="mb-5">

                                                        <div class="modal-fs-modal-footer">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button id="store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="">
                                                        2
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="">
                                                        1
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev tooltip-primary" data-tippy-content="Temperatura" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next tooltip-primary" data-tippy-content="Oximetria" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>




                        </div>
                    </div>

                </div>
            </div>
        </div>
        <main style="height:91vh">
            <div class="container-fluid overflow-auto">
                <div id="cargando" class="row d-none">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="d-flex m-4 justify-content-center text-primary">
                            Cargando...
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </main>Button trigger modal -->

@endsection
@section('footer')

@endsection
@section('script')
    <script>
        //document.getElementById('homeButtomMenu').style.display="none";
        //document.getElementById('headerNavbar').classList.remove("justify-content-between");
        //document.getElementById('headerNavbar').classList.add("justify-content-end");
        //document.getElementById('logoSystem').setAttribute("href","#");

        const   f = new Date();
        const   fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth()+1)).slice(-2) + "-" + ("0" + f.getDate()).slice(-2);
        let     $modal = document.querySelector('#messageModal');

        const   $form_paciente_1 = document.getElementById(`form_paciente_1`).content,
                $form_post_covid = document.getElementById(`form_post_covid`).content,

                $btnGroup2       = document.getElementById(`btnGroup-2`).content,
                $body          = document.querySelector(`body`);
                $cargando       = document.getElementById(`cargando`).content;
                $header          = document.querySelector(`header`);
                $main            = document.querySelector(`main`);
                $navbar          = document.getElementById(`navbar`).content;
                $fragment = document.createDocumentFragment();

        let     $copy = document.importNode($navbar,true);
                $header.appendChild($copy);
                $navbar = document.querySelector("nav");
                $navbar.classList.add("justify-content-end")

                $copy = document.importNode($cargando,true);
                $main.appendChild($copy)


                $container = document.createElement("div");
                $container.setAttribute("id","content")

                $ingreso = document.createElement("input");
                $ingreso.type="hidden"
                $ingreso.id="ingreso"
                $ingreso.name="ingreso"
                $ingreso.value= fechaIngreso;
                $container.appendChild($ingreso)

                $cat_user_ubicacion_id = document.createElement("input");
                $cat_user_ubicacion_id.type="hidden"
                $cat_user_ubicacion_id.id="cat_user_ubicacion_id"
                $cat_user_ubicacion_id.name="cat_user_ubicacion_id"
                $cat_user_ubicacion_id.value= 371;
                $container.appendChild($cat_user_ubicacion_id)

                $copy = document.importNode($form_paciente_1,true);
                $container.appendChild($copy)

                $copy = document.importNode($form_post_covid,true);
                $container.appendChild($copy)

                $copy = document.importNode($btnGroup2,true);
                $container.appendChild($copy)



                $main.appendChild($container)
                telefonoConfig("#telefono_movil")
                fotoTemporal('imagen', ".imagen-perfil")
                $cargando       = document.getElementById(`carga`);
                $content       = document.getElementById(`content`);

                modalMensaje({
                    title:`
                        <i style="font-size: 0.8em;">Bienvenido a la</i><br>
                        Clínica <span style="overflow-wrap: normal;font-weight:400">Post COVID-19</span>
                    `,
                    content:`
                        Para brindarle el mejor servicio posible,<br>
                        le pedimos por favor<br>
                        completar el siguiente formulario.
                    `,
                    action:`
                        <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, comenzar</button>
                   `,
                })


        let     estado = CatUserEstado.getAll()
        let     municipio = CatUserMunicipio.getAll()
                $cedula = document.getElementById('cedula')
                $email = document.getElementById('email')
                $cat_estado_id = document.getElementById('cat_estado_id')
                $cat_municipio_id = document.getElementById('cat_municipio_id')

                estado.then(x=>$cat_estado_id.appendChild($select(x)));
                municipio.then(x=>municipio = x)

                $cat_estado_id.addEventListener("change",(e)=>{
                    e.stopPropagation()
                    let cat_estado_id = e.target.value;
                    let result = municipio.filter(x=>parseInt(x.cat_estado_id) === parseInt(cat_estado_id))
                        $cat_municipio_id.replaceChildren($select(result))
                })

                $body.addEventListener("change", async function(e){
                    if (e.target.id === "cedula") {
                        $nacionalidad = document.getElementById("nacionalidad");
                        if ($nacionalidad.value !== "") {
                            let response = await UserProfile.validateCedula();
                                $help = document.getElementById("help_cedula");

                                if (response == "cedula_existe") {
                                    $help.classList.remove("text-success")
                                    $help.classList.add("text-danger")
                                    $help.innerHTML=`<i class='fas fa-exclamation-triangle'></i> ${response}`

                                    message = Component.alertMessage("cedula_asignada2");

                                    Swal.fire(
                                        message['title'],
                                        nacionalidad.value + cedula.value + " ya se encuentra asignada a un paciente registrado.",
                                        message['image']
                                    ).then(()=>{
                                        setTimeout(() =>  {
                                            cedula.value =""
                                            cedula.focus()
                                        }, 110);
                                    })
                                }else{
                                    $help.classList.remove("text-danger")
                                    $help.classList.add("text-success")
                                    $help.innerHTML=`<i class='fas fa-check-circle text-success'></i> Documento válido`
                                }
                        }else{
                            message = Component.alertMessage("input_select_empty");

                            Swal.fire(
                                message['title'],
                                message['message'],
                                message['image']
                            ).then(()=>{
                                setTimeout(() =>{
                                    $nacionalidad.focus()
                                }, 110);
                            })
                        }
                    }
                    if (e.target.id === "email") {
                        let response = await User.validateEmail();
                            $help = document.getElementById("help_email");

                            if (response == "email_existe") {
                                $help.classList.remove("text-success")
                                $help.classList.add("text-danger")
                                $help.innerHTML=`<i class='fas fa-exclamation-triangle'></i> ${response}`

                                message = Component.alertMessage("email_registrado");

                                Swal.fire(
                                    message['title'],
                                    "El correo " + $email.value + " ya se encuentra asignado a un paciente registrado.",
                                    message['image']
                                ).then(()=>{
                                    setTimeout(() =>  {
                                        $email.value =""
                                        $email.focus()
                                    }, 110);
                                })
                            }else{
                                $help.classList.remove("text-danger")
                                $help.classList.add("text-success")
                                $help.innerHTML=`<i class='fas fa-check-circle text-success'></i> Correo válido`
                            }
                    }
                })


            let store = document.getElementById('store');
                store.addEventListener("click", async function() {
                    try {
                        $cargando.classList.remove("d-none")
                        $cargando.classList.add("d-block")
                        $content.classList.remove("d-block")
                        $content.classList.add("d-none")
                        if (User.validate2()) {
                            if (UserProfile.validate()) {
                                if (UserCuestDireccion.validate()) {

                                    let model = await User.store();

                                    let user_id = model.id;
                                    console.log(user_id)

                                        ingreso = "Ingreso";

                                        model = await UserType.store(user_id);

                                        model = await UserProfile.store(user_id);

                                        model = await UserCuestDireccion.store(user_id);

                                        model = await UserCuestUbicacion.store2(user_id);

                                        model = await UserPostCovid.store(user_id);

                                        message = Component.alertMessage("send_success");


                                        modalMensaje({
                                            title:`
                                                <i >Gracias por responder el formulario.</i>

                                            `,
                                            content:`
                                                Esto nos permitirá brindarle el mejor servicio posible.

                                                <p>
                                                    El equipo de salud del Centro Médico Docente La Trinidad le agradece que nos hayas escogido como el aliado de su Salud !
                                                </p>
                                            `,
                                            action:`
                                                <button id="salir" onclick="window.location = 'https://www.cmdlt.edu.ve/';" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Finalizar</button>
                                        `,
                                        })
                                        /*
                                        Toast.fire({
                                            icon: message['image'],
                                            title: message['title'],
                                            text: message['message'],
                                            didClose: () => {
                                                //setTimeout(() => { window.location = "https://www.cmdlt.edu.ve/";}, 110);
                                            }
                                        })*/

                                }
                            }
                        }

                    } catch (error) {
                        console.warn(error)
                    }finally{
                        $cargando.classList.remove("d-block")
                        $cargando.classList.add("d-none")
                        $content.classList.remove("d-none")
                        $content.classList.add("d-block")
                    }

                });

                $cargando.classList.add("d-none")


    </script>

    <script>





        //VISTAS
        /*

        */
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        //ACCIONES
        /*
        */


        $(document).ready( function () {
            activarTooltip()

        });

    </script>

@endsection
@section('css')

@endsection
