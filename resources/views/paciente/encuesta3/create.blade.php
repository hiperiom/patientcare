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
                $modal.dataset.backdrop ="static";


                $btnGroup2       = document.getElementById(`btnGroup-2`).content,
                $body          = document.querySelector(`body`);
                $cargando       = document.getElementById(`cargando`).content;
                $header          = document.querySelector(`header`);
                $contenido          = document.createElement(`div`);
                $contenido.setAttribute("id","contenidoEncuesta")
                $contenido.classList.add("container")
                $row          = document.createElement(`div`);
                $row.classList.add("row")
                $col          = document.createElement(`div`);
                $col.classList.add("col-md-12")
                $main            = document.querySelector(`main`);
                $navbar          = document.getElementById(`navbar`).content;
                $fragment = document.createDocumentFragment();

        let     $copy = document.importNode($navbar,true);
                $header.appendChild($copy);
                $navbar = document.querySelector("nav");
                $navbar.classList.add("justify-content-end")



        document.addEventListener("DOMContentLoaded", function(){

            $copy = document.importNode($cargando,true);
            $main.appendChild($copy)
            $cargando = $main.querySelector("#carga")

            let user_encuesta = [
                {
                    id:1,
                    description:`Comunicación y admisión`,
                    coment:""
                },
                {
                    id:2,
                    description:`Médicos triaje`,
                    coment:""
                },
                {
                    id:3,
                    description:`Medicos Observación`,
                    coment:""
                },
                {
                    id:4,
                    description:`Enfermera Triaje`,
                    coment:""
                },
                {
                    id:5,
                    description:`Enfermería Observación`,
                    coment:""
                },
                {
                    id:6,
                    description:`Especialista`,
                    coment:""
                },
                {
                    id:7,
                    description:`Calificación Emergencia CMDLT `,
                    coment:""
                },



            ]
            user_encuesta.forEach((x,key)=>x.id =(key+1))


            let user_encuesta_preg = [
                //Comunicación y admisión
                    {
                        id:1,
                        description:`¿Le fue posible contactar a la Emergencia, antes de venir?`,
                        coment:"",
                        grupo_respuesta:5,
                        cat_encuesta_preg_id:1,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                    {
                        id:2,
                        description:`¿Fue recibido con cordialidad y atendido como usted esperaba?`,
                        coment:"",
                        grupo_respuesta:5,
                        cat_encuesta_preg_id:1,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,

                    },
                    {
                        id:3,
                        description:`En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Atención al Paciente?`,
                        coment:"",
                        grupo_respuesta:10,
                        cat_encuesta_preg_id:1,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                    {
                        id:4,
                        description:`En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Recepción?`,
                        coment:"",
                        grupo_respuesta:10,
                        cat_encuesta_preg_id:1,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                    {
                        id:5,
                        description:`En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Admisión?`,
                        coment:"",
                        grupo_respuesta:10,
                        cat_encuesta_preg_id:1,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                //Médico triaje
                    {
                        id:6,
                        description:`¿Cómo evalúas la calidad, en la atención y amabilidad, del Médico que te atendió en el cubículo de triaje?`,
                        coment:"",
                        grupo_respuesta:8,
                        cat_encuesta_preg_id:2,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                //Médico observacion
                    {
                        id:7,
                        description:`En el área de Observación, ¿el médico te explicó el plan con respecto a tu condición de salud?`,
                        coment:"",
                        grupo_respuesta:5,
                        cat_encuesta_preg_id:3,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                //Enfermería triaje
                    {
                        id:8,
                        description:`¿Cómo evalúas la calidad, en la atención y amabilidad, del personal de enfermería que te atendió en el cubículo de triaje?`,
                        coment:"",
                        grupo_respuesta:8,
                        cat_encuesta_preg_id:4,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                //Enfermería observacion
                    {
                        id:9,
                        description:`En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Enfermería en el área de Observación?`,
                        coment:"",
                        grupo_respuesta:10,
                        cat_encuesta_preg_id:5,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },

                //Especialista
                    {
                        id:10,
                        description:`De haber sido atendido por alguno de nuestros especialistas en el área de Emergencia: en una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificarlo?`,
                        coment:"",
                        grupo_respuesta:10,
                        cat_encuesta_preg_id:6,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                    {
                        id:11,
                        description:`¿Quedaste satisfecho con la atención de nuestro médico especialista?`,
                        coment:"",
                        grupo_respuesta:5,
                        cat_encuesta_preg_id:6,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },


               //CMDLT, Emergencia
                    {
                        id:12,
                        description:`En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar el servicio de Emergencia?`,
                        coment:"",
                        grupo_respuesta:10,
                        cat_encuesta_preg_id:7,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
                    {
                        id:13,
                        description:`¿Recomendarías este hospital a tus amigos y familiares?`,
                        coment:"",
                        grupo_respuesta:5,
                        cat_encuesta_preg_id:7,
                        parent:null,
                        children:false,
                        btnEventId:0,
                        negado:false,
                        coments:false,
                    },
              ]



            let tituloEncuesta = `Encuesta de Atención en Emergencia`
            let $encuestaTitulo = document.createElement("div")
                $encuestaTitulo.classList.add("bg-primary","h1","text-center","rounded")
                $encuestaTitulo.textContent = tituloEncuesta
                $contenido.appendChild($encuestaTitulo)

            let $encuestaTitulo2 = document.createElement("div")
                $encuestaTitulo2.classList.add("h4","text-center","rounded")
                $encuestaTitulo2.style.backgroundColor = "#f3eeee"
                $encuestaTitulo2.style.color = "var(--primary)"
                $encuestaTitulo2.textContent = `Responda las siguientes preguntas en relación a:`
                $contenido.appendChild($encuestaTitulo2)

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
                                    cat_encuesta_id:2,
                                    user_encuesta_id : x.cat_encuesta_preg_id,
                                    cat_encuesta_preg_id : x.id,
                                    grupoRespuestas:x.grupo_respuesta,
                                    textCuestion :x.description,
                                    parent:x.parent,
                                    children:x.children,
                                    btnEventId:x.btnEventId,
                                    negado:x.negado,
                                    coments:x.coments,
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
                            //if(User.validate()){
                                $contenido.classList.add("d-none")
                                $cargando.classList.remove("d-none")
                                try {
                                    let model = await UserEncuesta.store(3)

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
                                       // location.reload()
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
                                                    como el aliado de su Salud!
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
                            //}
                        }
                    })
                })
                $col.appendChild($copy)
                $row.appendChild($col)
                $contenido.appendChild($row)
                /*
                $badgeContador       = document.getElementById(`badgeContador`).content;
                $copy = document.importNode($badgeContador,true);
                $fragment.appendChild($copy)*/

                $main.appendChild($contenido)



                function mensajeBienvenida() {
                    modalMensaje({
                        title:`
                        <div class="text-center">
                            <i style="font-size: 0.8em;">Bienvenido a la</i><br>
                            ${tituloEncuesta}
                        </div>
                        `,
                        content:`
                        <div class="h5 text-center">
                            Gracias por preferirnos y considerarnos<br>
                            <i><b>el aliado de su salud</b></b>.<br>
                            Nuestro propósito<br>
                            es ofrecerte un excelente servicio<br>
                            para lo cual tus sugerencias<br>
                            son muy importantes.<br><br>
                            Muchas gracias por tu tiempo y colaboración.
                        </div>
                        <!-- <div class="text-center h3 font-weight-bold">
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
                        </ul>-->
                        `,
                        action:`
                            <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, continuar</button>
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
