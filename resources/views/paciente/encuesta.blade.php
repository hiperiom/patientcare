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
    <main class="d-flex flex-column overflow-auto p-1" style="height:91vh;padding-bottom: 10vh !important;">

    </main>
    <footer>

    </footer>
@endsection
@section('footer')

@endsection
@section('script')
    <script>
        let encuesta = []

        const   f = new Date();
        const   fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth()+1)).slice(-2) + "-" + ("0" + f.getDate()).slice(-2);
        let     $modal = document.querySelector('#messageModal');


                $btnGroup2       = document.getElementById(`btnGroup-2`).content,
                $body          = document.querySelector(`body`);
                $cargando       = document.getElementById(`cargando`).content;
                $header          = document.querySelector(`header`);
                $contenido          = document.createElement(`div`);
                $contenido.setAttribute("id","contenidoEncuesta")
                $main            = document.querySelector(`main`);
                $navbar          = document.getElementById(`navbar`).content;
                $fragment = document.createDocumentFragment();

        let     $copy = document.importNode($navbar,true);
                $header.appendChild($copy);
                $navbar = document.querySelector("nav");
                $navbar.classList.add("justify-content-end")



        document.addEventListener("DOMContentLoaded", function(){
           // let   encuesta_id = @json($id, JSON_PRETTY_PRINT);
            $copy = document.importNode($cargando,true);
            $main.appendChild($copy)
            $cargando = $main.querySelector("#carga")

            let user_encuesta = [
                {
                    id:1,
                    description:`En relación a la atención que recibiste de las enfermeras`,
                    coment:""
                },
                {
                    id:2,
                    description:`En relación a la atención que recibiste de los doctores`,
                    coment:""
                },
                {
                    id:3,
                    description:`En relación al ambiente en el hospital`,
                    coment:""
                },
                {
                    id:4,
                    description:`En relación a tu experiencia en el hospital`,
                    coment:""
                },
                {
                    id:5,
                    description:`En relación a cuando saliste del hospital`,
                    coment:""
                },
                {
                    id:6,
                    description:`En relación a la calificación general del hospital`,
                    coment:""
                },
                {
                    id:7,
                    description:`En relación a la atención que necesitaste cuando salieras del hospital`,
                    coment:""
                },
                {
                    id:8,
                    description:`En relación a ti`,
                    coment:""
                },
            ]
            let user_encuesta_preg = [
                {
                    id:1,
                    description:`¿Con qué frecuencia las enfermeras te trataban con cortesía y respeto?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:1,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:2,
                    description:`¿Con qué frecuencia las enfermeras te escuchaban con atención?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:1,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:3,
                    description:`¿Con qué frecuencia las enfermeras te explicaban las cosas de una manera que pudieras entender?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:1,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:4,
                    description:`Después de usar el botón para llamar a la enfermera, ¿con qué frecuencia te atendían tan pronto como querías?`,
                    coment:"",
                    grupo_respuesta:1,
                    cat_encuesta_preg_id:1,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:5,
                    description:`¿Con qué frecuencia los doctores te trataban con cortesía y respeto?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:2,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:6,
                    description:`¿Con qué frecuencia los doctores te escuchaban con atención? `,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:2,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:7,
                    description:`¿Con qué frecuencia los doctores te explicaban las cosas de una manera que pudieras entender?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:2,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:8,
                    description:`¿Con qué frecuencia mantenían tu cuarto y tu baño limpios?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:3,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:9,
                    description:`¿Con qué frecuencia estaba silenciosa el área alrededor de tu habitación por la noche?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:3,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:10,
                    description:`¿Necesitó que las enfermeras u otro personal del hospital te ayudaran a llegar al baño o a usar un orinal (bedpan)`,
                    coment:"",
                    grupo_respuesta:2,
                    cat_encuesta_preg_id:4,
                    parent:true,
                    children:false,
                    btnEventId:6,
                    negado:false,
                },
                {
                    id:11,
                    description:`¿Con qué frecuencia te ayudaron a llegar al baño o a usar un orinal (bedpan) tan pronto como querías?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:4,
                    parent:10,
                    children:true,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:12,
                    description:`¿Tuviste algún dolor?`,
                    coment:"",
                    grupo_respuesta:2,
                    cat_encuesta_preg_id:4,
                    parent:true,
                    children:false,
                    btnEventId:6,
                    negado:false,
                },
                {
                    id:13,
                    description:`¿Con qué frecuencia el personal del hospital te preguntó qué tan fuerte era el dolor que tenías?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:4,
                    parent:12,
                    children:true,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:14,
                    description:`¿Con qué frecuencia el personal del hospital te habló sobre cómo tratarte el dolor? `,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:4,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:15,
                    description:`¿Te dieron alguna medicina que no has tomado antes?`,
                    coment:"",
                    grupo_respuesta:2,
                    cat_encuesta_preg_id:4,
                    parent:true,
                    children:false,
                    btnEventId:6,
                    negado:false,
                },
                {
                    id:16,
                    description:`Antes de darte alguna medicina nueva, ¿con qué frecuencia el personal del hospital te dijo para qué era la medicina?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:4,
                    parent:15,
                    children:true,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:17,
                    description:`Antes de darte alguna medicina nueva, ¿con qué frecuencia el personal del hospital te describió los efectos secundarios posibles de una manera que pudieras entenderlos?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:4,
                    parent:15,
                    children:true,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:18,
                    description:`¿Te fuiste directamente a tu propia casa, a la casa de otra persona, o a otra institución de salud? `,
                    coment:"",
                    grupo_respuesta:3,
                    cat_encuesta_preg_id:5,
                    parent:true,
                    children:false,
                    btnEventId:10,
                    negado:true,
                },
                {
                    id:19,
                    description:`¿Los doctores, enfermeras u otro personal del hospital hablaron con contigo sobre si tendrías la ayuda necesaria cuando salieras del hospital?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:5,
                    parent:18,
                    children:true,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:20,
                    description:`¿Te dieron información por escrito sobre los síntomas o problemas de salud a los que debías poner atención cuando salieras del hospital?`,
                    coment:"",
                    grupo_respuesta:0,
                    cat_encuesta_preg_id:5,
                    parent:18,
                    children:true,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:21,
                    description:`En una escala del 0 al 10, siendo 0 el peor hospital posible, y 10, el mejor hospital posible, ¿qué número usarías para calificar este hospital?`,
                    coment:"",
                    grupo_respuesta:4,
                    cat_encuesta_preg_id:6,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:22,
                    description:`¿Recomendarías este hospital a tus amigos y familiares?`,
                    coment:"",
                    grupo_respuesta:5,
                    cat_encuesta_preg_id:6,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:23,
                    description:`Indica si estás de acuerdo con la siguiente afirmación: El personal tuvo en cuenta mis preferencias, las de mi familiares, o personas que me cuidaban, al decidir qué atención médica necesitaría cuando saliera del hospital.`,
                    coment:"",
                    grupo_respuesta:6,
                    cat_encuesta_preg_id:7,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:24,
                    description:`Indica si estás de acuerdo con la siguiente afirmación: Cuando salí del hospital, entendía bien qué cosas del control de mi salud eran responsabilidad mía`,
                    coment:"",
                    grupo_respuesta:6,
                    cat_encuesta_preg_id:7,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:25,
                    description:`Indica si estás de acuerdo con la siguiente afirmación: Cuando salí del hospital, entendía claramente la razón por la que tomaba cada una de mis medicinas`,
                    coment:"",
                    grupo_respuesta:7,
                    cat_encuesta_preg_id:7,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:26,
                    description:`¿Te admitieron al hospital a través de la sala de emergencias?`,
                    coment:"",
                    grupo_respuesta:2,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:27,
                    description:`En general, ¿cómo calificas su salud?`,
                    coment:"",
                    grupo_respuesta:8,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:28,
                    description:`En general, ¿cómo calificas su salud mental o emocional?`,
                    coment:"",
                    grupo_respuesta:8,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:29,
                    description:`¿Cuál es el grado o nivel escolar más alto que has completado?`,
                    coment:"",
                    grupo_respuesta:9,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:29,
                    description:`En general, ¿cómo calificas su salud mental o emocional?`,
                    coment:"",
                    grupo_respuesta:9,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:30,
                    description:`¿Es usted de ascendencia u origen español, hispano o latino?`,
                    coment:"",
                    grupo_respuesta:10,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:31,
                    description:`¿A qué raza pertenece? Por favor marque una o más`,
                    coment:"",
                    grupo_respuesta:11,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
                {
                    id:33,
                    description:`¿Principalmente qué idioma habla en casa?`,
                    coment:"",
                    grupo_respuesta:12,
                    cat_encuesta_preg_id:8,
                    parent:null,
                    children:false,
                    btnEventId:0,
                    negado:false,
                },
            ];

            let $encuestaTitulo = document.createElement("div")
                $encuestaTitulo.classList.add("bg-primary","h1","text-center","rounded","mx-5")
                $encuestaTitulo.textContent = `Encuesta de Atención en Áreas de Hospitalización`
                $contenido.appendChild($encuestaTitulo)

            let $encuestaInstruccion = document.createElement("div")
                $encuestaInstruccion.classList.add("text-secondary")

                $contenido.appendChild($encuestaInstruccion)

                $ul = document.createElement("ol")
                user_encuesta.forEach(response=>{
                    $li = document.createElement("li")
                    $li.classList.add("my-2","titulo-section")
                    let user_encuesta_id = response.id;
                    let encuesta = user_encuesta.filter(x=>x.id===user_encuesta_id)[0]
                        $encuestaTitulo = document.createElement("a")
                        $encuestaTitulo.setAttribute("data-toggle","collapse")
                        $encuestaTitulo.setAttribute("href","#encuesta_"+user_encuesta_id)
                        $encuestaTitulo.setAttribute("role","button")
                        $encuestaTitulo.setAttribute("aria-expanded",false)
                        $encuestaTitulo.setAttribute("aria-controls","encuesta_"+user_encuesta_id)
                        $encuestaTitulo.classList.add("text-primary","h4","font-weight-bold")
                        $encuestaTitulo.textContent = encuesta.description
                    $li.appendChild($encuestaTitulo)

                    let encuesta_preguntas = user_encuesta_preg.filter(x=>x.cat_encuesta_preg_id===encuesta.id)
                        $div = document.createElement("div")
                        $div.classList.add("collapse","pl-3")
                        $div.setAttribute("id","encuesta_"+user_encuesta_id)

                        encuesta_preguntas.forEach(x => {
                            $div.appendChild(
                                $nuevaPregunta({
                                    user_encuesta_id : x.cat_encuesta_preg_id,
                                    cat_encuesta_preg_id : x.id,
                                    grupoRespuestas:x.grupo_respuesta,
                                    textCuestion :x.description,
                                    parent:x.parent,
                                    children:x.children,
                                    btnEventId:x.btnEventId,
                                    negado:x.negado,
                                })
                            )
                        })
                    $li.appendChild($div)
                    $ul.appendChild($li)
                })
                $contenido.appendChild($ul)

                $infoUser       = document.getElementById(`infoUser`).content;
                $copy = document.importNode($infoUser,true);
                $copy.querySelector("button").addEventListener("click", function(){
                    Swal.fire({
                    title: 'Atención',
                    text: 'Seleccione Si, si desea enviar y completar la encuesta. Seleccione No, si desea continuarla.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                    }).then(async result=> {

                        if (result.isConfirmed) {
                            if(User.validate()){
                                $contenido.classList.add("d-none")
                                $cargando.classList.remove("d-none")
                                try {
                                    let model = await UserEncuesta.store()

                                    if (model === "user_id_not_found") {
                                        Swal.fire(
                                        'Error al enviar',
                                        'Información del paciente no encontrada.',
                                        'error'
                                        ).then(x=>{
                                            $contenido.classList.remove("d-none")
                                            $cargando.classList.add("d-none")
                                        })
                                    }
                                    if (model === "episode_not_found") {
                                        Swal.fire(
                                        'Error al enviar',
                                        'Última hospitalización no encontrada.',
                                        'error'
                                        ).then(x=>{
                                            $contenido.classList.remove("d-none")
                                            $cargando.classList.add("d-none")
                                        })
                                    }
                                    if (model === 200) {
                                        localStorage.removeItem("encuesta")
                                        modalMensaje({
                                            title:`
                                                <div class="text-center">
                                                    Encuesta completada<br>
                                                    con éxito.
                                                <div>
                                            `,
                                            content:`
                                                <p class="pb-2 text-center">
                                                    Gracias por responder esta encuesta,<br>
                                                    esto nos permitirá brindarle el mejor servicio.
                                                </p>
                                                <p class="pb-2 text-center">
                                                    El equipo de salud del Centro Médico Docente La Trinidad<br>
                                                    le agradece que nos hayas escogido<br>
                                                    como el aliado de su salud!
                                                </p>
                                            `,
                                            action:`
                                                <button id="salir" onclick="window.location = 'https://www.cmdlt.edu.ve/';" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Finalizar</button>
                                            `,
                                        })
                                    }

                                } catch (error) {
                                    $contenido.classList.remove("d-none")
                                    $cargando.classList.add("d-none")
                                    console.log(error)
                                }finally{
                                    $cargando.classList.add("d-none")
                                }
                            }
                        }
                    })
                })
                $contenido.appendChild($copy)
                /*
                $badgeContador       = document.getElementById(`badgeContador`).content;
                $copy = document.importNode($badgeContador,true);
                $fragment.appendChild($copy)*/

                $main.appendChild($contenido)



                function mensajeBienvenida() {
                    modalMensaje({
                        title:`
                            <i style="font-size: 0.8em;">Bienvenido a la</i><br>
                            Encuesta de Atención en Áreas de Hospitalización
                        `,
                        content:`
                        <div class="text-center h3 font-weight-bold">
                            INSTRUCCIONES
                        </div>
                        <ul class="h5">
                            <li class="pb-2">
                                Llena esta encuesta únicamente si eres el paciente que estuvo hospitalizado.
                            </li>
                            <li class="pb-2">
                                Contesta todas las preguntas seleccionando una de las opciones que aparecen como respuesta.
                            </li>
                            <li class="pb-2 font-weight-bold">
                                Las siguientes preguntas se refieren solo a tu última hospitalización.
                            </li>
                        </ul>
                        `,
                        action:`
                            <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, comenzar</button>
                        `,
                    })
                }
                $cargando.classList.add("d-none")
                if (localStorage.getItem("encuesta") === null) {
                    localStorage.setItem("encuesta",JSON.stringify(encuesta))
                    mensajeBienvenida()
                }else{
                    Swal.fire({
                    title: 'Atención',
                    text: 'Ya se encuentra una encuesta en curso. ¿Desea continuarla?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                    }).then((result) => {

                        if (result.isConfirmed) {
                            encuesta = JSON.parse(localStorage.getItem("encuesta"))

                            encuesta.forEach(x1=>{
                                if (
                                    x1.cat_encuesta_preg_value > 0
                                ) {
                                   let lista_respuesta = document.getElementById(`lista_respuesta${x1.cat_encuesta_preg_id}`)
                                   let div_encuesta = document.getElementById("encuesta_"+x1.user_encuesta_id)
                                   let a = lista_respuesta.querySelectorAll("a")
                                        a.forEach(x2=>{
                                            if(parseInt(x2.getAttribute("data-value")) === x1.cat_encuesta_preg_value)
                                            {
                                                x2.classList.add("active")
                                                if (!div_encuesta.classList.contains("show")) {
                                                    div_encuesta.classList.add("show")
                                                }
                                                triggerEvent(x2, 'click');
                                            }
                                        })

                                }
                            })
                        }else{
                            localStorage.removeItem("encuesta")
                            localStorage.setItem("encuesta",JSON.stringify(encuesta))
                            mensajeBienvenida()
                        }
                    })
                }


        })


    </script>
@endsection
@section('css')
    <style>
        ol {
            list-style: none;

        }
        ol li.titulo-section {
            counter-increment: my-awesome-counter;

        }
        ol li.titulo-section::before {
            content: counter(my-awesome-counter) " | ";


            color: var(--secondary);
            font-weight: bold;


            font-size: 1.5em;
            text-align: center;



        }
    </style>
@endsection
