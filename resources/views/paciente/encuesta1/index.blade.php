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
        headerNav({})

        const $tableEncuesta = ({
            coment=[],
            bgColor="bg-primary",
            textColor="text-primary",
            pregunta="¿Sample Question?",
            respuestas =[],
            total_respuestas_encontrada=0,
            global_total_numero_respuestas,
        })=>{
            //console.log(Object.values(coment).length)
            //console.log(coment)
            //console.log(pregunta)
            //console.log(respuestas)
            let comentarios=`
                    <div class="text-center">
                        Sin comentarios
                    </div>
                `;
            if (Object.values(coment).length > 0) {
                comentarios="";
                Object.values(coment).forEach((x,y)=>{

                    comentarios +=`
                        <div data-coment-id="${x.id}" class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-timestamp float-right">${x.date}</span>
                            </div>
                            <img class="direct-chat-img" src="/image/system/icono-paciente-blanco.svg" alt="Message User Image">
                            <div class="direct-chat-text">
                                ${x.coment}
                            </div>
                        </div>

                    `;
                })

            }
            //let porcentaje =
            let $filaRespuesta =``
            //console.log(Object.values(respuestas))
            let totalRespuestas = Object.values(respuestas).length;
            let respuestaMasrespondida = 0;
                Object.values(respuestas).forEach(x=>{
                    if(x.total_encontrado > respuestaMasrespondida){
                        respuestaMasrespondida = x.total_encontrado
                    }
                })
                for (let index = totalRespuestas; index >= 1; index--) {
                    // cl(Object.values(respuestas)[index - 1])
                    let x = Object.values(respuestas)[index - 1];
                    let {
                            puntos,
                            description,
                            total_encontrado,
                            porcentaje_del_global,
                            color,
                        } = x;
                        //porcentaje
                    //let porc = ( total_encontrado * puntos ) * 100 / ( total_encuestas * puntos );
                    //    porc = !isNaN(porc) ? porc : 0;
                        //console.log(x)
                        $filaRespuesta += `
                            <tr class="tooltip-primary"  data-tippy-content="${total_encontrado} respuestas de ${description} representan el ${porcentaje_del_global}% de las ${total_respuestas_encontrada} respuestas encontradas">

                                <td>${description}</td>
                                <td style="vertical-align: middle;width: 40%;">
                                    <div class="progress progress-lg">
                                        <div class="progress-bar bg-warning" style="width: ${porcentaje_del_global}%"></div>
                                    </div>
                                </td>
                                <td style="width: 15%;"><span class="text-primary">${porcentaje_del_global} %</span></td>
                            </tr>

                        `;
                }
            let ds = (document.getElementById('date_start').value).split("-")
            let de = (document.getElementById('date_end').value).split("-")

                return `
                    <span class="d-flex justify-content-center rounded-pill p-1 my-1 bg-gray">
                        <div class=" text-primary" style="letter-spacing: 2px;">
                            Desde: ${ds[2]}/${ds[1]}/${ds[0]} - Hasta: ${de[2]}/${de[1]}/${de[0]}
                        </div>

                    </span>
                    <div class="${Object.values(coment).length > 0?'d-flex':"d-none"} card card-primary mb-0 card-header-coments card-outline cursor-pointer direct-chat direct-chat-primary shadow-none  collapsed-card">
                        <div class="card-header" data-card-widget="collapse">
                            <h3 class="card-title text-primary">Opiniones <span class="badge badge-primary">${Object.values(coment).length}</span></h3>
                        </div>
                        <div class="card-body" style="display: none;">
                            <div class="direct-chat-messages" style="height: max-content;">
                                ${comentarios}
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped text-gray" style="font-size:1.5em;">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">
                                        ${pregunta}
                                        <div class="text-primary text-center" style="font-size:0.8em !important;">
                                            <span class="badge badge-gray text-primary">${total_respuestas_encontrada}</span> Respuestas encontradas
                                        </div>
                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                ${$filaRespuesta}
                            </tbody>
                        </table>
                    </div>



                `;
        }
        const carausel = ({
                id="carouselExampleControls",
                height = "fit-content",
                content = [
                    `
                        <div class="table-responsive">
                            <table class="table table-bordered text-gray" style="font-size:1.5em;">
                                <tbody>
                                    <tr>
                                        <th colspan="3" class="text-center">
                                            Sin resultados 1
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `,
                    `
                        <div class="table-responsive">
                            <table class="table table-bordered text-gray" style="font-size:1.5em;">
                                <tbody>
                                    <tr>
                                        <th colspan="3" class="text-center">
                                            Sin resultados 2
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `,
                ]
            })=>{

                const   d = document;
                const   $div = d.createElement("div")
                const   $carausel = d.createElement("div")
                        $carausel.id=id;
                        $carausel.classList.add("carousel","slide","overflow-auto")
                        $carausel.setAttribute("data-interval",false)
                        $carausel.setAttribute("data-ride","carousel")
                        $carausel.style.height=height
                const   $carauselInner = d.createElement("div")
                        $carauselInner.classList.add("carousel-inner")
                        content.forEach((x,key)=>{
                            let $carauselItem = d.createElement("div")
                                $carauselItem.classList.add("carousel-item")
                                if(key === 0){$carauselItem.classList.add("active")}
                                $carauselItem.style.height=(height - 1)
                                $carauselItem.innerHTML = x;
                                $carauselInner.appendChild($carauselItem)
                        })
                        $carausel.appendChild($carauselInner)
                        $div.appendChild($carausel)
                const   $aLeft = d.createElement("a")
                        $aLeft.classList.add("carousel-control-prev")
                        $aLeft.href=`#${id}`
                        $aLeft.innerHTML=`
                            <i class="fas fa-chevron-left text-gray"></i>
                            <span class="sr-only">Previous</span>
                        `;

                        $aLeft.setAttribute("role","button")
                        $aLeft.setAttribute("data-slide","prev")
                        $div.appendChild($aLeft)

                const   $aRight = d.createElement("a")
                        $aRight.classList.add("carousel-control-next")
                        $aRight.href=`#${id}`
                        $aRight.innerHTML=`
                            <i class="fas fa-chevron-right text-gray"></i>
                            <span class="sr-only">Next</span>
                        `;
                        $aRight.setAttribute("role","button")
                        $aRight.setAttribute("data-slide","next")
                        $div.appendChild($aRight)
                return $div;

        }
        class Encuesta1 {
            constructor(props){
                const {selector,state,template}=props;
                const   f = new Date();
                    this.d = document;
                    this.selector = selector !== undefined ? document.querySelector(selector) : document.querySelector('main');
                    this.user_encuesta_id = 0;
                    this.state = state !== undefined ? state : {
                        test_header:{
                            test_total:0,
                        },
                        test_section:[
                            {
                                id:"admision",
                                user_encuesta_id:1,
                                title:"Admisión",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-door-open"],
                                bgColor:`bg-primary`,
                                textColor:`primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(1)
                                }],
                            },

                            {
                                id:"enfermeria",
                                user_encuesta_id:2,
                                title:"Equipo de Enfermeria",
                                coment:[],
                                value:0,
                                valueIndice:`%`,
                                icon: ["fas","fa-user-nurse"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(2)
                                }],
                            },
                            {
                                id:"residentes",
                                user_encuesta_id:3,
                                title:"Médico Residentes",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-user-md"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(3)
                                }],
                            },
                            {
                                id:"especialistas",
                                user_encuesta_id:4,
                                title:"Médicos Especialistas",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-user-md"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(4)
                                }],
                            },
                            {
                                id:"limpieza",
                                user_encuesta_id:5,
                                title:"Ambiente del Hospital",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-broom"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(5)
                                }],
                            },
                            {
                                id:"inst_infra",
                                user_encuesta_id:6,
                                title:"Instalaciones e Infraestructura",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-building"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(6)
                                }],
                            },
                            {
                                id:"apoyo",
                                user_encuesta_id:7,
                                title:"Experiencia en el Hospital",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-comment-alt"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(7)
                                }],
                            },
                            {
                                id:"alimentacion",
                                user_encuesta_id:8,
                                title:"Calidad de Alimentación",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-utensils"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(8)
                                }],
                            },

                            {
                                id:"egre_indi",
                                user_encuesta_id:9,
                                title:"Indicaciones al Egreso",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-house-user"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(9)
                                }],
                            },
                            {
                                id:"equipo_salud",
                                user_encuesta_id:10,
                                title:"Evaluación Equipo Salud",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-users"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(10)
                                }],
                            },
                            {
                                id:"satisfaccion",
                                user_encuesta_id:11,
                                title:"Calificación Hospital",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-hospital-user"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(11)
                                }],
                            },
                            {
                                id:"egreso",
                                user_encuesta_id:12,
                                title:"Egreso",
                                value:0,
                                coment:[],
                                valueIndice:`%`,
                                icon: ["fas","fa-hospital-user"],
                                bgColor:`bg-primary`,
                                event: ["click",(e)=>{
                                    this.getDetalle(12)
                                }],
                            },



                        ],
                        user_encuesta : [

                        ],
                        user_encuesta_preg: [

                        ],
                    }

                    this.date_start = f.getFullYear() + "-" + "01" + "-" + "01";
                    this.date_end = f.getFullYear() + "-" + ("0" + (f.getMonth()+1)).slice(-2) + "-" + ("0" + f.getDate()).slice(-2);

                let d = this.d;
                let data = null;
                    d.querySelector("body").addEventListener("change", async (event) => {
                        if (!event.target.matches("#date_start") && !event.target.matches("#date_end")) return false;

                        if (event.target.matches("#date_start")|| event.target.matches("#date_end")) {
                            this.date_start = entById('date_start').value;
                            this.date_end = entById('date_end').value;
                            data = await this.getAll({})
                            this.setState(data)

                        }
                    })
                    d.querySelector("body").addEventListener("click", async (e) => {
                        //if (!e.target.matches(".btn-sync-encuesta") && !e.target.matches(".btn-sync-contador") ) return false;
                        //if (!e.target.matches(".btn-sync-contador") ) return false;

                        if (e.target.matches(".btn-sync-encuesta")) {
                            e.preventDefault();
                            e.stopPropagation()
                            let data = await this.getAll({})
                                this.setState(data)
                        }
                        if (e.target.matches(".btn-sync-contador")) {
                            alert("Contador de encuestas enviadas Actualizado con éxito")
                            e.preventDefault();
                            e.stopPropagation()
                            let contador = document.getElementById('enviadas').value
                            let data = await this.uodateContador(contador)

                        }

                    })

            }
            getDetalle(pregunta_id){
                let $modalBody = document.querySelector(".modal-body")

                let encuesta = this.getState()
                let total_encuestas = encuesta['test_header'].test_total

                //let preguntas = encuesta['user_encuesta_preg'].filter(x=>x.cat_encuesta_preg_id===pregunta_id)
                let preguntas = Object.values(encuesta['user_encuesta']['test_section']).filter(row=>row.preguntas)
                    preguntas = first(preguntas.filter(x=>x.grupo_id===pregunta_id))['preguntas']
                    //console.log(preguntas['total_encontradas'])
                let total_respuestas_encontradas =first(Object.values(encuesta['user_encuesta']['test_section']).filter(x=>x.grupo_id===pregunta_id))['total_respuestas_encontradas']

                console.log(total_respuestas_encontradas)
                let {title,value,icon,bgColor,textColor,coment} = first(encuesta['test_section'].filter(a=>a.user_encuesta_id === pregunta_id))
                let comentarios = first(encuesta['test_section'].filter(a=>a.user_encuesta_id === pregunta_id)).coment


                //console.log(first(encuesta['test_section'].filter(a=>a.user_encuesta_id === pregunta_id)).coment)
                //console.log(comentarios)
                    $modalBody.innerHTML =null
                    $("#modelId").modal("show")

                    $modalBody.appendChild(
                        this.render_card({
                            //footer:`${total_respuestas_encontradas} respuestas globales`,
                            footer:false,
                            value,
                            title,
                            icon,
                            bgColor,

                        })
                    );

                let $container = document.createElement('div')
                    $container.classList.add("container-fluid")
                let $row = document.createElement('div')
                    $row.classList.add("row")
                let $colmd12 = document.createElement('div')
                    $colmd12.classList.add("col-md-12")

                let content = []
                //console.log(preguntas)
                    Object.values(preguntas).forEach(x=>{
                        //if(x.grupo_respuesta.length > 0){
                            //console.log(x)
                            content.push($tableEncuesta({
                                pregunta:x.pregunta_id+" - "+x.pregunta,
                                respuestas:x.grupo_respuesta,
                                coment:x.comentarios,

                                bgColor,
                                textColor,
                                total_respuestas_encontrada:x.total_respuestas_encontrada,
                            }))
                        //}
                    })

                    $colmd12.appendChild(carausel({content}))

                    $row.appendChild($colmd12)
                    $container.appendChild($row)

                    $modalBody.appendChild($container)
                    activarTooltip()
            }
            render(){
                const {d,selector,state} = this;

                let $main = selector;
                let data = state;
                let testheader = $main.querySelector(".test-header .info-box-content .info-box-number");
                    $main.querySelector(".info-box-text").classList.remove("text-primary");
                    $main.querySelector(".info-box-text").classList.add("text-white");
                let total_encuestas_enviadas = data.user_encuesta.enviadas.enviadas
                let porcentaje_del_total = ( data.test_header.test_total * 100) / total_encuestas_enviadas
                console.log("---->>>>",data)
                testheader.classList.remove("text-secondary")
                testheader.classList.add("text-white")
                    testheader.innerHTML = ` ${data.test_header.test_total}  <span style="background:white;font-size:1rem;padding: 0 0.2em;letter-spacing: 1.1pt;color:var(--primary);" class="badge badge-info"><b>${porcentaje_del_total.toFixed(0)}%</b></span>`;

                    data = data.test_section;
                    //console.log(data)
                let card = $main.querySelectorAll(".test-card-container .small-box");
                    for (let index = 0; index < data.length; index++) {
                        if (data[index].value > 0) {
                            card[index].className = null;
                            card[index].classList.add("small-box")
                            card[index].classList.add(data[index].bgColor)
                            card[index].querySelector(".inner h3").innerHTML = `${data[index].value}<sup style="font-size: 20px">%</sup>`;
                        }else{
                            card[index].className = null;
                            card[index].classList.add("small-box","bg-primary")
                            card[index].querySelector(".inner h3").innerHTML = `0<sup style="font-size: 20px">%</sup>`;
                        }
                    }
            }
            getState(){
                return JSON.parse(JSON.stringify(this.state));
            }
            setState(obj){
                this.state['user_encuesta'] = obj;
                //console.log(first(Object.values(this.state['user_encuesta']['test_section']).filter(x=>x.grupo_id==1)))
                let data = this.state;

                if (Object.keys(obj).length >0) {

                    for (let key in obj) {
                        if (key==="test_header") {
                            document.getElementById('enviadas').value = obj.enviadas.enviadas
                            console.log(obj.enviadas.enviadas)
                            if (data.hasOwnProperty(key)) {
                                this.state[key].test_total = obj[key].test_total;
                            }
                        }
                        if (key==="test_section") {
                            data = data.test_section;

                            data.forEach(x=>{

                                let section = first(Object.values(this.state['user_encuesta']['test_section']).filter(j=>j.grupo_id==x.user_encuesta_id));
                                console.log(section)
                                //porcentaje de tarjeta
                                x.value= section.porcentaje_global_grupo;
                                //color de tarjeta
                                x.bgColor= "bg-"+section.global_color;
                                x.textColor= "text-"+section.global_color;

                            })
                        }
                        if (key==="user_encuesta_preg") {
                            this.state[key].forEach((x,y)=>{
                                this.state[key][y]['respuestas'] = Object.values(obj.user_encuesta_preg).filter(a=>a.cat_encuesta_preg_id===parseInt(x.id))
                            })
                        }
                    }
                }
                this.render()
            }
            render_header(){
                let col = ()=> {
                        let $col = document.createElement("div");
                            $col.classList.add("col-md-3");

                        let $infoBox = document.createElement("div");
                            $infoBox.classList.add("info-box",);

                        let $infoBoxIcon = document.createElement("span");
                            $infoBoxIcon.classList.add("info-box-icon","bg-primary");

                            $infoBox.appendChild($infoBoxIcon)

                        let $infoBoxContent = document.createElement("div");
                            $infoBoxContent.classList.add("info-box-content");

                            $infoBox.appendChild($infoBoxContent)
                            $col.appendChild($infoBox)

                            return $col;
                    }

                let $container = document.createElement("div");
                    $container.classList.add("container");
                    $container.classList.add("test-header");

                let tituloEncuesta =  `Encuesta de Atención en Áreas de Hospitalización`
                let $encuestaTitulo = document.createElement("div")
                    $encuestaTitulo.classList.add("h3","p-1","text-primary","font-weight-bold","text-center","rounded")
                    $encuestaTitulo.style.backgroundColor="var(--light)"
                    $encuestaTitulo.textContent = tituloEncuesta
                    $container.appendChild($encuestaTitulo)

                let $row = document.createElement("div");
                    $row.classList.add("row");

                let $item1 = col()
                    $item1.querySelector(".info-box").classList.add("bg-primary","text-white")
                    $item1.querySelector(".info-box-icon").innerHTML =`<i class="far fa-file-alt"></i>`
                    $item1.querySelector(".info-box-content").classList.add("align-items-center")
                    $item1.querySelector(".info-box-content").innerHTML =`
                            <span class="info-box-text text-center text-primary font-weight-bold">Encuestas<br>Contestadas<button data-tippy-content="Actualizar Encuesta" style="position: absolute;right: 5px;top: 5px;" class="tooltip-primary btn-sync-encuesta btn-sm btn btn-default float-right text-primary font-weight-bold"><i class="fas btn-sync-encuesta fa-sync-alt"></i></button></span>
                            <span class="info-box-number text-secondary">0</span>
                        `;
                    $row.appendChild($item1)

                let $item4 = col()
                    $item4.querySelector(".info-box-icon").innerHTML =`<i class="far fa-paper-plane"></i>`
                    $item4.querySelector(".info-box-content").innerHTML =`
                            <span class="info-box-text text-primary font-weight-bold">
                                Encuestas<br>Enviadas
                                <button data-tippy-content="Actualizar contador de encuestas enviadas"  style="position: absolute;right: 5px;top: 5px;" class="tooltip-primary btn-sync-contador btn-sm btn btn-default float-right text-primary font-weight-bold"><i class="far btn-sync-contador fa-save"></i></button></span>
                            <span class="info-box-number text-secondary">
                                <input id="enviadas" type="number" value="0" class="border-0 text-secondary input-date font-weight-bold">
                            </span>
                        `;

                    $row.appendChild($item4)
                let $item2 = col()
                    $item2.querySelector(".info-box-icon").innerHTML =`<i class="far fa-calendar-alt"></i>`
                    $item2.querySelector(".info-box-content").innerHTML =`
                            <label for="date_start" class="info-box-text text-primary">Desde</label>
                            <input id="date_start" type="date" value="${this.date_start}" class="border-0 text-secondary input-date font-weight-bold">
                        `;
                    $row.appendChild($item2)

                let $item3 = col()
                    $item3.querySelector(".info-box-icon").innerHTML =`<i class="far fa-calendar-alt"></i>`
                    $item3.querySelector(".info-box-content").innerHTML =`
                            <label for="date_end" class="info-box-text text-primary">Hasta</label>
                            <input id="date_end" type="date" value="${this.date_end}" class="border-0 text-secondary input-date font-weight-bold">
                        `;
                    $row.appendChild($item3)



                    $container.appendChild($row)

                const   $main = document.querySelector('main')
                    $main.appendChild($container);

            }
            render_card(props){
                const {
                        selector = "btn-sample",
                        bgColor="bg-primary",
                        value="000",
                        unity="%",
                        title="Title",
                        footer=true,
                        icon=["fas","fa-search"],
                        event=["click",()=>{console.info("No Events")}]
                    } = props;
                    //copiamos una nueva tarjeta
                let $copyCard = document.getElementById("card1").content;
                let $card = document.importNode($copyCard,true);

                    //establecemos selector de evento click
                    $card.querySelector("a").classList.add(selector)

                    //establecemos color de fondo
                    $card.querySelector(".small-box").classList.add(`${bgColor}`)

                    //establecemos valor numerico por defecto
                    $card.querySelector(".inner h3").innerHTML=`${value}<sup style="font-size: 20px">${unity}</sup>`

                    //establecemos titulo por defecto
                    $card.querySelector(".inner p").innerHTML=`${title}`

                    //establecemos icono por defecto
                    $card.querySelector(".icon i").removeAttribute("class")

                    icon.forEach(clase=>{
                        $card.querySelector(".icon i").classList.add(clase)
                    })
                    $card.querySelector(".small-box-footer").classList.add("h3")




                    if (!footer) {
                        //$card.querySelector(".small-box-footer").remove();
                        $card.querySelector(".small-box-footer").classList.add("invisible")
                    }else{
                        $card.querySelector(".small-box-footer").innerHTML=footer;
                        //$card.querySelector(".small-box-footer").dataset.tippyContent ="Valor c"
                    }
                    //establecemos evento por defecto
                    if (event !== null) {
                        const [eventType,response]= event;
                        $card.querySelector(".small-box").addEventListener(eventType,response)
                    }


                    return $card

            }
            render_list(){
               return `
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Striped Full Width Table</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Task</th>
                                <th>Progress</th>
                                <th style="width: 40px">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">55%</span></td>
                                </tr>
                                <tr>
                                <td>2.</td>
                                <td>Clean database</td>
                                <td>
                                    <div class="progress progress-xs">
                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">70%</span></td>
                                </tr>
                                <tr>
                                <td>3.</td>
                                <td>Cron job running</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">30%</span></td>
                                </tr>
                                <tr>
                                <td>4.</td>
                                <td>Fix and squish bugs</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">90%</span></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>

                    </div>
                `;
            }
            render_cardGroup(props){
                const {
                        className=["col-lg-3","col-6"],
                    } = props;
                let data = this.state.test_section

                let $container = document.createElement("div")
                    $container.classList.add("container")
                    $container.classList.add("test-card-container");
                let $row = document.createElement("div")
                    $row.classList.add("row")


                    for (let index = 0; index < Object.keys(data).length; index++) {
                        const {title,bgColor,value,icon,event} = Object.values(data)[index];

                        let $col = document.createElement("div")
                            className.forEach(clase=>{
                                $col.classList.add(clase)
                            })

                            $col.appendChild(this.render_card({
                                footer:false,
                                value,
                                title,
                                icon,
                                event,
                                bgColor,
                            }))
                            $row.appendChild($col)

                    }


                    $container.appendChild($row)
                let $boxComentarios = document.getElementById("boxOpinionesEncuesta").content
                    $boxComentarios = document.importNode($boxComentarios,true);
                    $container.appendChild($boxComentarios)




                const   $main = document.querySelector('main')
                    $main.appendChild($container);

            }
            async getAllQuestion(){
                let data = this.getState()
                //console.log(data)

            }
            opinonesGenerales(){
                let boxEncuesta = document.getElementById('opiniones_generales_encuesta')

                let opiniones = this.getState()['user_encuesta']['comentarios_globabes']
                let opinionEncuesta = document.getElementById('opinionEncuesta').content
                if (opiniones.length > 0) {
                    opiniones.forEach( x => {
                        let opinion = document.importNode(opinionEncuesta,true)
                        let opi = opinion.querySelectorAll("div")
                            console.log(opi)
                            opi[1].querySelector("span").textContent= fechaComentario(x.created_at)
                            opi[2].textContent = x.coment
                        boxEncuesta.appendChild(opinion)
                    })
                    document.querySelector("h3.card-title span").textContent = opiniones.length
                }

            }
            async getAll(){
                const {date_start,date_end} = this;

                let formdata = new FormData();
                    formdata.append("date_start", date_start)
                    formdata.append("date_end", date_end)
                    formdata.append("user_encuesta_id", 1)
                    formdata.append("_token", $("#_token").val())
                return await post(`/user_encuesta/getAll`, formdata)
            }
            async uodateContador(contador){

                let formdata = new FormData();
                    formdata.append("enviadas", contador)
                    formdata.append("_token", $("#_token").val())
                return await post(`/cat_encuesta_update/1`, formdata)
            }
        }
        const encuesta1 = new Encuesta1({});
            encuesta1.render_header()
            encuesta1.render_cardGroup({})

        document.addEventListener("DOMContentLoaded", async function(){

            let data = await encuesta1.getAll({})
                encuesta1.setState(data)
                encuesta1.opinonesGenerales()
               // console.log(data)
            setInterval(async () => {
                let data = await encuesta1.getAll({})
                encuesta1.setState(data)
            }, 30000 );
        })


    </script>
@endsection
@section('css')
    <style>
        .card-header-coments:hover{
            background-color:var(--light);
            color:var(--primary);
        }
        .input-date:hover{
            background-color:var(--light);
            cursor:pointer;
        }
        .small-box {
            border-radius: 2rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }
        .small-box>.small-box-footer {
            background: rgba(0, 0, 0, 0.1);
            color: rgba(255, 255, 255, 0.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
            border-radius: 0px 0px 30px 30px;
        }
        .bg-warning, .bg-warning>a {
            color: #ffffff !important;
        }
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
