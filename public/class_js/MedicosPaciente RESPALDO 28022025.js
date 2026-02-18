
import {get,post,loading,meses, select,is_null,equalsInt,is_undefined, timestamps} from "../helpers/helpers.js";

export default class MedicosPaciente {
    constructor({
        attrSelectorId = "doctorsList",
        episode_id = null,
        medic_teem_patient = [], //GUARDA LOS MEDICOS ASIGNADOS AL PACIENTE
        medic_teem_to_show = [], //GUARDA LOS ID DE LOS GRUPOS DE MEDICOS A MOSTRAR EN LA TARJETA
        interconsultations = [],
    }) {
        //console.log("MedicosPaciente episode_id",episode_id)
        let that = this
        this.episode_id = episode_id
        //DATOS DE EPISODIO DEL PACIENTE
        this.paciente = pacientes_datos.find(paciente => equalsInt(paciente['episodio'], episode_id))
        //INDICE EPISODIO EN EL OBJETO
        this.episodio_index = pacientes_datos.findIndex(paciente => equalsInt(paciente['episodio'], episode_id))
        // MEDICOS QUE ATIENDEN AL PACIENTE
        this.medic_teem_patient = this.paciente['medico_paciente']
        //LISTA DE BOTONES DE MEDICOS A MOSTRAR
        this.medic_teem_to_show = medic_teem_to_show
        //ETIQUETA DONDE SE DESPLEGARÁ LA LISTA DE GRUPOS DE MEDICOS
        this.selector = document.getElementById(attrSelectorId)
        //CATALOGO DE CARGOS MEDICOS
        this.cat_items = [{
                id: [1],
                grupos_medicos_to_show: [1],
                description: "Tratante",
                selector_description: function() {
                    return that.getSelectorText(this.description)
                },
                color: 'success',
                className: ['fa-solid', 'fa-user-doctor'],
                sigla() {
                    return this.description.slice(0, 2).toUpperCase()
                },
                medicos_paciente: [],
            },
            {
                id: [2],
                grupos_medicos_to_show: [1, 2],
                description: "Interconsultante",
                selector_description: function() {
                    return that.getSelectorText(this.description)
                },
                color: 'info',
                className: ['fa-solid', 'fa-user-doctor'],
                sigla() {
                    return this.description.slice(0, 2).toUpperCase()
                },
                medicos_paciente: [],
            },
            {
                id: [3, 4],
                grupos_medicos_to_show: [3, 4],
                description: "Fellow",
                selector_description: function() {
                    return that.getSelectorText(this.description)
                },
                color: 'orange',
                className: ['fa-solid', 'fa-user-doctor'],
                sigla() {
                    return this.description.slice(0, 2).toUpperCase()
                },
                medicos_paciente: [],
            },
            {
                id: [5, 6, 7, 8],
                grupos_medicos_to_show: [5, 6, 7, 8],
                description: "Residente",
                selector_description: function() {
                    return that.getSelectorText(this.description)
                },
                color: 'secondary',
                className: ['fa-solid', 'fa-user-doctor'],
                sigla() {
                    return this.description.slice(0, 2).toUpperCase()
                },
                medicos_paciente: [],
            },
            {
                id: [9],
                grupos_medicos_to_show: [9],
                description: "RAMH",
                selector_description: function() {
                    return that.getSelectorText(this.description)
                },
                color: 'purple',
                className: ['fa-solid', 'fa-user-doctor'],
                sigla() {
                    return this.description.slice(0, 2).toUpperCase()
                },
                medicos_paciente: [],
            },
            {
                id: [10],
                grupos_medicos_to_show: [10],
                description: "Enfermería",
                selector_description: function() {
                    return that.getSelectorText(this.description)
                },
                color: 'warning',
                className: ['fa-solid', 'fa-user-nurse'],
                sigla() {
                    return this.description.slice(0, 2).toUpperCase()
                },
                medicos_paciente: [],
            },
        ]
        this.interconsultations = interconsultations

        this.episodios = pacientes_datos
        
    }
    cat_medic_teem_to_show() {
        let resultset = []
        let medic_teem = []
        if (this.medic_teem_to_show.length === 0) {
            this.medic_teem_to_show = [1, 2, 3, 7, 9, 10]
        }
        this.medic_teem_to_show.forEach(id => {
            let result = this.cat_items.find(x => x['id'].includes(id))
            if (!is_undefined(result)) {
                resultset.push(result)
            }
        })

        return resultset
    }
    getSelectorText(description) {
        return description.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase()
    }
    modalColor({
        color = null,
        group_cargo = null,
        medicos_disponibles = [],
        title = null
    }) {
        //console.log(color)
        //ELIMINAR TODOS LOS COLORES DE LA MODAL
        let colores = this.cat_items.map(x => x.color)
        //console.log("colores",colores)
        colores.forEach(color => {
            modal.querySelector(".modal-header").classList.remove('bg-' + color)
            modal.querySelector("#total_result").classList.remove('text-' + color)

            modal.querySelectorAll(".modal-footer button").forEach((button, key) => {
                button.classList.remove('btn-' + color)
                //button.classList.remove('border-'+x.color)
            })

        })
        //ASIGNAR NUEVO COLOR A LA MODAL
        modal.querySelectorAll(".modal-footer button")[0].classList.add('btn-' + color)
        modal.querySelector(".modal-header").classList.add('bg-' + color)
        modal.querySelector("#total_result").classList.add('text-' + color)

        //TEXTOS PREDEFINIDOS EN LA MODAL
        modal.querySelector(".modal-title").textContent = "Equipo " + group_cargo
        modal.querySelector(".title_index").textContent = "Equipo " + group_cargo + ":"
        modal.querySelector(".title_create").textContent = "Añadir nuevo " + group_cargo + ":"
        modal.querySelector("#modal_search_medico").placeholder = "Escribe " + group_cargo + " a buscar..."
        modal.querySelector("#total_result").innerHTML = "Mostrando <b>"+medicos_disponibles.length+"</b> resultados";
        

    }
    handleOptionListModal({
        color,
        group_cargo,
        grupos_medicos_to_show,
        position_id,
        selector_cargo,
        tippyContent,
    }) {
        let that = this

        //ID DE LOS CARGOS
        let posiciones_id = position_id.split(",").map(x => Number(x))
        console.log("posiciones_id",medicosAsignadosAlPaciente);

        //MEDICOS DISPONIBLES EN LOS CARGOS
        let medicos_disponibles = medicos_datos.filter(med => grupos_medicos_to_show.split(",").map(x => Number(
            x)).includes(Number(med.posicion_id)))
       
        //OBTENER ESPECIALIDADES MEDICAS PARA AGRUPAR LOS MEDICOS
        let especialidades_id = Array.from(new Set(medicos_disponibles.map(med => med
            .cat_user_especialidad_id)))

        //MEDICOS ASIGNADOS AL PACIENTE
        let medicosAsignadosAlPaciente = this.medic_teem_patient.filter(x => 
            posiciones_id.includes(x.cat_user_medico_posicion_id)
        )
console.log("medicosAsignadosAlPaciente",medicosAsignadosAlPaciente);
        //OBTENER ID DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS POR ESPECIALIDAD
        let user_id_asignados = Array.from(new Set(medicosAsignadosAlPaciente.map(med => med.user_id_medico)))

        //OBTENER ESPECIALIDADES DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS
        let medicos_disponibles_asignados = medicos_disponibles.filter(med => user_id_asignados.includes(Number(
            med.user_id)))

        //OBTENER ESPECIALIDADES MEDICAS DE MEDICOS ASIGNADOS PARA AGRUPAR LOS MEDICOS
        let especialidades_id_asignados = Array.from(new Set(medicos_disponibles_asignados.map(med => med
            .cat_user_especialidad_id)))
        

        /*ASIGNADOS*/
       
        let modalListadoMedicoAsignados = modal.querySelector('#modal-listado_medicos_asignados')
        let modalListadoInterconsultas = modal.querySelector('#modal-listado_interconsultas')
        modalListadoMedicoAsignados.innerHTML = null

        //INICIO LISTA DE INTERCONSULTAS COMPLETADAS
        let interconsultationCompleted = that.interconsultations 
        interconsultationCompleted.forEach(x => {
            if(x.fecha_confirmacion){
                console.log(x.medico);
                modalListadoInterconsultas.insertAdjacentHTML("beforeend", `
                    <li
                        class="bg-light list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                    >
                        <div class="flex-fill d-flex align-items-center scale-in-hor-left">
                            <div class="flex-fill d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <img 
                                        loading="lazy" 
                                        style="width: 30px;height: 30px;border-radius: 20px;" 
                                        class="img-doctor" 
                                        onerror="this.src='/image/system/patient.svg'" 
                                        src="${x.imagen}"
                                    >
                                    <div class="ml-1">
                                        ${x.medico}
                                    </div>
                                </div>
                            
                            </div>
                            <div class="d-flex flex-column align-items-end text-secondary">
                                <b>Interconsulta Respondida</b>
                                <div>Tiempo de respuesta: <span class="text-${x.color_tiempo_respuesta}"><i class="fas fa-clock"></i> ${x.tiempo_respuesta}</span></div>
                            </div>
                        </div>
                
                    </li>
                `)
            }
        });
        //FIN LISTA DE INTERCONSULTAS COMPLETADAS


        if (especialidades_id_asignados.length > 0) {
         
            especialidades_id_asignados.forEach(especialidad_id => {
                //POR CADA ESPECIALIDAD OBTENER LOS MEDICOS
                let medicos_disponibles_x_especialidad = medicos_disponibles_asignados.filter(med =>
                    Number(med.cat_user_especialidad_id) === Number(especialidad_id))
     
                medicos_disponibles_x_especialidad.forEach(medico => {
                    let activo = false
                    let medicoActivoClass = ""

                    let medicoActivo = medicosAsignadosAlPaciente.find(mp => equalsInt(mp[
                        'user_id_medico'], medico['user_id']))

                    //RESALTAMOS EN EL LISTADO DE MEDICOS DISPONIBLES LOS MEDICOS YA ASIGNADOS
                    if (!is_undefined(medicoActivo)) {
                        activo = true
                        medicoActivoClass = `bg-${color} text-white`
                    }

                    //MOSTRAMOS EL MEDICO DISPONIBLE
                    let temp_medico_posicion_id = medico.posicion_id
                    if (grupos_medicos_to_show === "1,2") {
                        temp_medico_posicion_id = 2
                    }
                    let showBtnInterconsultation = ''
                    let showInterconsultationActive = 'd-none'
                    if(selector_cargo !== 'interconsultante'){
                        showBtnInterconsultation = 'd-none'
                    }
                  



                    let is_interconsultationsActive = that.interconsultations ? that.interconsultations.some(x => x.doctor_id == medico.user_id && !x.fecha_confirmacion) : false
                    let interconsulta = that.interconsultations.find(x => x.doctor_id == medico.user_id && !x.fecha_confirmacion)
              
                    if(is_interconsultationsActive){
                        showInterconsultationActive = ''
                    }
                    
                    modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                        <li
                            data-position_id="${temp_medico_posicion_id}"
                            data-selector_cargo="${selector_cargo}"
                            data-tippyContent="${tippyContent}"
                            data-paciente_name ="${that.paciente['paciente']}"
                            data-medico_name ="${medico['medico']}"
                            data-group_cargo="${group_cargo}"
                            data-activo="${activo}"
                            data-user_id_medico="${medico.user_id}"
                            data-color="${color}"
                            class="bg-light list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                        >
                            <div class="flex-fill d-flex align-items-center scale-in-hor-left">
                                <div class="flex-fill d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <img loading="lazy" style="width: 30px;height: 30px;border-radius: 20px;" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="${medico.imagen}">
                                        <div class="ml-1">
                                            ${medico.medico}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-md-row flex-wrap align-items-center">
                                        <div class="ml-1 mb-1 py-1 badge badge-primary"> ${medico.especialidad}</div>
                                        <button class="ml-1 mb-1 btn btn-outline-primary btn-small-custom tooltip-primary text-nowrap" data-tippy-content="Teléfono contacto del médico: ${medico.telefono_movil}" onclick="window.open('https://api.whatsapp.com/send?phone=${medico.telefono_movil}')">
                                            <i class="ml-1 fab fa-whatsapp text-success"></i> ${medico.telefono_movil}
                                        </button>
                                        <a class="ml-1 mb-1 btn btn-outline-${medico.extension_telefonica ===null ?'secondary':'purple'} btn-small-custom text-nowrap" href="tel:+584149320905"><i class="ml-1 fas fa-phone"></i> ${medico.extension_telefonica ===null ?'Sin Asterísco':medico.extension_telefonica}</a>
                                    </div>
                                </div>
                                <div class="${showBtnInterconsultation} ${showInterconsultationActive} info-interconsulta-${medico.user_id}  flex-column text-right mr-1" style="line-height: 1.2;">
                                    <div>Tiempo transcurrido</div>
                                    <div><span class="text-success tiempo-transcurrido-${medico.user_id}">${interconsulta ? '<i class="fas fa-clock"></i>  '+interconsulta.tiempo_transcurrido : ''}</span></div>	
                                </div>
                                <div class="d-flex" style="gap: 5px;">
                                    <!-- nuevo boton solicitar interconsulta -->
                                    <button
                                    
                                        data-grupos_medicos_to_show="${grupos_medicos_to_show}"
                                        data-position_id="${medico.posicion_id}"
                                        data-selector_cargo="${selector_cargo}"
                                        title="Solicitar interconsulta"
                                        data-paciente_name ="${that.paciente['paciente']}"
                                        data-medico_name ="${medico['medico']}"
                                        data-group_cargo="${group_cargo}"
                                        data-activo="${activo}"
                                        data-user_id_paciente="${that.paciente.user_id}"
                                        data-user_id_medico="${medico.user_id}"
                                        data-color="${color}"
                                        style="width: 30px;height: 30px;padding:0px;"
                                        class="${showBtnInterconsultation} ${showInterconsultationActive !=='d-none' && 'd-none'} tooltip-info solicitar-interconsulta-${medico.user_id} btn btn-info"
                                    >
                                        <i class="far fa-bell text-white"></i>
                                    </button>
                                    <button
                                    
                                        data-grupos_medicos_to_show="${grupos_medicos_to_show}"
                                        data-position_id="${medico.posicion_id}"
                                        data-selector_cargo="${selector_cargo}"
                                        title="Confirmar interconsulta"
                                        data-paciente_name ="${that.paciente['paciente']}"
                                        data-medico_name ="${medico['medico']}"
                                        data-group_cargo="${group_cargo}"
                                        data-activo="${activo}"
                                        data-user_id_paciente="${that.paciente.user_id}"
                                        data-user_id_medico="${medico.user_id}"
                                        data-interconsulta_id="${interconsulta?.id}"
                                        data-color="${color}"
                                        style="width: 30px;height: 30px;padding:0px;"
                                        class="${showBtnInterconsultation} ${showInterconsultationActive} atender-interconsulta-${medico.user_id} btn btn-success"
                                    >
                                        <i class="fas fa-hand-holding-medical"></i>
                                    </button>
                                    <button
                                        data-grupos_medicos_to_show="${grupos_medicos_to_show}"
                                        data-position_id="${medico.posicion_id}"
                                        data-selector_cargo="${selector_cargo}"
                                        data-tippyContent="${tippyContent}"
                                        data-paciente_name ="${that.paciente['paciente']}"
                                        data-medico_name ="${medico['medico']}"
                                        data-group_cargo="${group_cargo}"
                                        data-activo="${activo}"
                                        data-user_id_paciente="${that.paciente.user_id}"
                                        data-user_id_medico="${medico.user_id}"
                                        data-color="${color}"
                                        style="width: 30px;height: 30px;font-size: 0.5em;"
                                        class=" ${showInterconsultationActive !=='d-none' && 'd-none'} delete-interconsulta-${medico.user_id} medico-asignado tooltip-danger delete-row btn btn-danger"
                                    > 
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>    
                                </div>
                            </div>
                            
                        </li>
                    `)
                    document.querySelector(".solicitar-interconsulta-"+medico.user_id).addEventListener("click", async (e) => {
                        const {user_id_medico,medico_name,user_id_paciente} = e.currentTarget.dataset;
                        const episode_id = this.episode_id
                        Swal.fire({
                            title: `Solicitar interconsulta`,
                            text: `¿Solicitar interconsulta a ${medico_name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, solicitar!',
                            cancelButtonText: 'Cancelar!'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                
                                let formdata = new FormData();
                                formdata.append("user_id_medico", user_id_medico)
                                formdata.append("user_id", user_id_paciente)
                                formdata.append("episodio_id", episode_id)
                                formdata.append("_token", $("#_token").val())
                                let result = await post(location.origin + "/solicitud_interconsulta/store", formdata)    
                                    if(result){
                                        let index = pacientes_datos.findIndex(x=>x['episodio'] === episode_id)
                                        that.interconsultations = result
                                        that.episodios[index].interconsultation_request = result
    
                                        EventBus.$on('externalVarChanged', (newValue) => {
                                            that.episodios = newValue;
                                        });


                                        document.querySelector(".tiempo-transcurrido-"+user_id_medico).classList.remove("d-none")
                                        document.querySelector(".solicitar-interconsulta-"+user_id_medico).classList.add("d-none")
                                        document.querySelector(".info-interconsulta-"+user_id_medico).classList.remove("d-none")
                                        document.querySelector(".atender-interconsulta-"+user_id_medico).classList.remove("d-none")
                                        document.querySelector(".atender-interconsulta-"+user_id_medico).dataset.interconsulta_id = result[0].id
                                        document.querySelector(".tiempo-transcurrido-"+user_id_medico).innerHTML = '<i class="fas fa-clock"></i>  '+result[0].tiempo_transcurrido
                                        document.querySelector(".delete-interconsulta-"+user_id_medico).classList.add("d-none")
                                        Swal.fire(
                                            `Solicitud activada`,
                                            `La interconsulta se ha solicitado correctamente.`,
                                            'success'
                                        )
                                    }

                                    
                                    
                                
                            }
                        })
                    })
                    document.querySelector(".atender-interconsulta-"+medico.user_id).addEventListener("click", async (e) => {
                        const {user_id_medico,medico_name,interconsulta_id} = e.currentTarget.dataset;
                        const episode_id = this.episode_id
                        Swal.fire({
                            title: `¿Interconsulta atendida?`,
                            text: `Quieres marcar la interconsulta de ${medico_name} como atendida?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, confirmar!',
                            cancelButtonText: 'No, aún no!'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                
                                let formdata = new FormData();
                                formdata.append("user_id_medico", user_id_medico)
                                formdata.append("episodio_id", episode_id)
                                formdata.append("_token", $("#_token").val())
                                let result = await post(location.origin + "/solicitud_interconsulta/update/"+interconsulta_id, formdata)   
                                /* if(model){ */
                                    let index = pacientes_datos.findIndex(x=>x['episodio'] === episode_id)
                                    that.interconsultations = result
                                    that.episodios[index].interconsultation_request = result

                                    EventBus.$on('externalVarChanged', (newValue) => {
                                        that.episodios = newValue;
                                    });

                                    //INICIO LISTA DE INTERCONSULTAS COMPLETADAS
                                    modalListadoInterconsultas.innerHTML = null
                                    let interconsultationCompleted = that.interconsultations 
                                    interconsultationCompleted.forEach(x => {
                                        if(x.fecha_confirmacion){
                                            modalListadoInterconsultas.insertAdjacentHTML("beforeend", `
                                                <li
                                                    class="bg-light list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                                                >
                                                    <div class="flex-fill d-flex align-items-center scale-in-hor-left">
                                                        <div class="flex-fill d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <img 
                                                                    loading="lazy" 
                                                                    style="width: 30px;height: 30px;border-radius: 20px;" 
                                                                    class="img-doctor" 
                                                                    onerror="this.src='/image/system/patient.svg'" 
                                                                    src="${x.imagen}"
                                                                >
                                                                <div class="ml-1">
                                                                    ${x.medico}
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="d-flex flex-column align-items-end text-secondary">
                                                            <b>Interconsulta Respondida</b>
                                                            <div>Tiempo de respuesta: <span class="text-${x.color_tiempo_respuesta}"><i class="fas fa-clock"></i> ${x.tiempo_respuesta}</span></div>
                                                        </div>
                                                    </div>
                                            
                                                </li>
                                            `)
                                        }
                                    });
                                    //FIN LISTA DE INTERCONSULTAS COMPLETADAS


                                    document.querySelector(".tiempo-transcurrido-"+user_id_medico).classList.add("d-none")
                                    document.querySelector(".solicitar-interconsulta-"+user_id_medico).classList.remove("d-none")
                                    document.querySelector(".info-interconsulta-"+user_id_medico).classList.add("d-none")
                                    document.querySelector(".atender-interconsulta-"+user_id_medico).classList.add("d-none")
                                    document.querySelector(".delete-interconsulta-"+user_id_medico).classList.remove("d-none")
                                    Swal.fire(
                                        `Datos guardados`,
                                        `Se han confirmado los datos de la interconsulta.`,
                                        'success'
                                    )
                                /* }  */



                                
                                
                            }
                        })
                    })
                })
                
            })
        } else {
            modalListadoMedicoAsignados.insertAdjacentHTML("beforeend", `
                            <li class="text-center text-${color} list-group-item list-group-item-action p-1">
                                No se encontraron ${group_cargo} asignados
                            </li>
                        `)
        }
        /*DISPONIBLES*/
        let modalListadoMedicoDisponibles = modal.querySelector('#modal-listado_medicos')
        modalListadoMedicoDisponibles.innerHTML = null
        if (especialidades_id.length > 0) {

            especialidades_id.forEach(especialidad_id => {
                //POR CADA ESPECIALIDAD OBTENER LOS MEDICOS
                let medicos_disponibles_x_especialidad = medicos_disponibles.filter(med => Number(med
                    .cat_user_especialidad_id) === Number(especialidad_id))
                //OBTENER NOMBRE DE LA ESPECIALIDAD
                let especialidad_nombre = medicos_disponibles_x_especialidad[0]

                //MOSTRAMOS LA ESPECIALIDAD QUE AGRUPARA LOS MEDICOS
                modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                <li class="list-group-item d-flex text-${color} font-weight-bold disabled list-group-item-action p-1">
                                    <div>${especialidad_nombre.especialidad}</div>
                                </li>
                            `)

                medicos_disponibles_x_especialidad.forEach(medico => {
                    let activo = false
                    let medicoActivoClass = ""
                    
                    let medicoActivo = medicosAsignadosAlPaciente.find(mp => equalsInt(mp[
                        'user_id_medico'], medico['user_id']))

                    //RESALTAMOS EN EL LISTADO DE MEDICOS DISPONIBLES LOS MEDICOS YA ASIGNADOS
                    if (is_undefined(medicoActivo)) {
                        //activo = true
                        //medicoActivoClass =`bg-${color} text-white`
                        let temp_medico_posicion_id = medico.posicion_id
                        if (grupos_medicos_to_show === "1,2") {
                            temp_medico_posicion_id = 2
                        }
                        //MOSTRAMOS EL MEDICO DISPONIBLE
                        modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                                        <li
                                            data-grupos_medicos_to_show="${grupos_medicos_to_show}"
                                            data-position_id="${temp_medico_posicion_id}"
                                            data-selector_cargo="${selector_cargo}"
                                            data-tippyContent="${tippyContent}"
                                            data-paciente_name ="${that.paciente['paciente']}"
                                            data-medico_name ="${medico['medico']}"
                                            data-group_cargo="${group_cargo}"
                                            data-activo="${activo}"
                                            data-user_id_medico="${medico.user_id}"
                                            data-color="${color}"
                                            class="${medicoActivoClass} list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                                        >

                                            <div class="d-flex align-items-center">
                                                <img loading="lazy" style="width: 30px;height: 30px;border-radius: 20px;" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="${medico.imagen}">
                                                <div class="ml-1">
                                                    ${medico.medico}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column flex-md-row align-items-start">
                                                <button class="ml-1 mb-1 btn btn-outline-primary btn-small-custom tooltip-primary text-nowrap" data-tippy-content="Teléfono contacto del médico: ${medico.telefono_movil}" onclick="window.open('https://api.whatsapp.com/send?phone=${medico.telefono_movil}')">
                                                    <i class="ml-1 fab fa-whatsapp text-success"></i> ${medico.telefono_movil}
                                                </button>
                                                <a class="ml-1 mb-1 btn btn-outline-${medico.extension_telefonica ===null ?'secondary':'purple'} btn-small-custom text-nowrap" href="tel:+584149320905"><i class="ml-1 fas fa-phone"></i> ${medico.extension_telefonica ===null ?'Sin Asterísco':medico.extension_telefonica}</a>
                                            </div>

                                        </li>
                                    `)
                    }
                })

            })
            //EVENTO CLICK A CADA MEDICO DISPONIBLE
            modalListadoMedicoDisponibles.querySelectorAll("li").forEach(handleMedicoDisponible => {
                handleMedicoDisponible.addEventListener("click", (e) => {
                    that.handleMedicoDisponible(e)
                })
            })
            //EVENTO CLICK A CADA MEDICO ASIGNADO
            modalListadoMedicoAsignados.querySelectorAll("li button.medico-asignado").forEach(
                handleMedicoAsignados => {
                    handleMedicoAsignados.addEventListener("click", (e) => {
                        that.handleMedicoDisponible(e)
                    })
                })
           
            
            //
            setTimeout(() => {
                that.filtroModalMedicos()
                modal.querySelector("#modal_search_medico").focus()
            }, 500)
        } else {
            modalListadoMedicoDisponibles.insertAdjacentHTML("beforeend", `
                            <li class="text-center text-${color} list-group-item list-group-item-action p-1">
                                No se encontraron ${group_cargo}
                            </li>
                        `)
        }

        //COLORES DE LA MODAL
        this.modalColor({
            color,
            group_cargo,
            medicos_disponibles,
            title: tippyContent,
        })



        //EVENTOS

        //MOSTRAR MODAL
        modalJQ.modal("show")
        /* d.querySelector("#modalLoading").classList.add("d-none") */
    }
    filtroModalMedicos() {
        let busqueda = modal.querySelector('#modal_search_medico');
        let table = modal.querySelectorAll("#modal-listado_medicos li");
        let buscaTabla = function() {
            let texto = busqueda.value.toLowerCase();
            let dFlexCount = 0;
            let dNoneCount = 0;
            setTimeout(() => {
                if (table.length > 0) {
                    table.forEach((row, r) => {
                        
                        if (row.querySelector("div").innerText.toLowerCase().indexOf(
                                texto) !== -1) {
                            row.classList.replace('d-none', 'd-flex');
                        } else {
                            
                            row.classList.replace('d-flex', 'd-none');
                        }
                        if (row.classList.contains('d-flex')) {
                            dFlexCount++;
                        } else if (row.classList.contains('d-none')) {
                            dNoneCount++;
                        }
                    })
                    modal.querySelector('#total_result').innerHTML =
                        `Mostrando <b>${dFlexCount.toString()}</b> resultados`

                }
                busqueda.value = ""
            }, 100);
        }
        busqueda.addEventListener('change', buscaTabla);
        busqueda.addEventListener('input', function(event) {
            // Se está escribiendo o borrando texto en el input
            if (event.target.value === '') {
                buscaTabla()
            }
        });

    }
    async destroy(medico_paciente_id) {
        ///user_cuest_medico_paciente/eliminarById
        let formdata = new FormData();
        formdata.append("id", medico_paciente_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return await post(location.origin + "/user_cuest_medico_paciente/eliminarById", formdata)
    }
    async store(user_id_medico, position_id) {

        let formdata = new FormData();
        formdata.append("episodio_id", this.paciente['episodio'])
        formdata.append("user_id_medico", user_id_medico)
        formdata.append("user_id_paciente", this.paciente['user_id'])
        formdata.append("position_id", position_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return await post(location.origin + "/user_cuest_medico_paciente/store", formdata)
    }
    async handleSolicitarInterconsulta(event) {
        alert("Solicitando interconsulta...")
    }
    async handleMedicoDisponible(event) {
        let that = this
        let {
            grupos_medicos_to_show,
            position_id,
            selector_cargo,
            tippyContent,
            paciente_name,
            medico_name,
            group_cargo,
            activo,
            user_id_medico,
            color,
            episodio_id
        } = event.currentTarget.dataset
        //VALIDAMOS QUE EL MEDICO NO ESTE ASIGNADO
        let medicosAsignadosAlPaciente = that.medic_teem_patient
        //console.log("medicosAsignadosAlPaciente",medicosAsignadosAlPaciente)
        let medicoEstaAsignado = medicosAsignadosAlPaciente.find(med => Number(med.user_id_medico) === Number(
            user_id_medico))
        //console.log(medicosAsignadosAlPaciente)
        //console.log("medicoEstaAsignado",medicoEstaAsignado)
        if (is_undefined(medicoEstaAsignado)) {
            /*   Swal.fire({
                title: `¿Asignar ${group_cargo}?`,
                text:`¿Quieres asignar el ${group_cargo} ${medico_name} al paciente ${paciente_name}?`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, asignar!',
                cancelButtonText: 'No, aún no!'
            }).then( async(result) => {
                if (result.isConfirmed) { */
            //GUARDAMOS LA ASIGNACION
            d.querySelector("#modalLoading").classList.remove("d-none")



            let model = await that.store(user_id_medico, position_id)
            d.querySelector("#modalLoading").classList.add("d-none")
            this.medic_teem_patient = model
            pacientes_datos[that.episodio_index]['medico_paciente'] = model
            that.deployMedicoPacienteList()

            that.handleOptionListModal({
                grupos_medicos_to_show,
                color,
                group_cargo,
                position_id,
                selector_cargo,
                tippyContent,
            })
            //modalJQ.modal("hide")
            /* Swal.fire(
                `${group_cargo} asignado!`,
                `El ${group_cargo} se asignó correctamente.`,
                'success'
            ) */
            /* } */
            /*  }) */
        } else {
            Swal.fire({
                title: `¿Retirar ${group_cargo}?`,
                text: `¿Quieres retirar el ${group_cargo} ${medico_name} del paciente ${paciente_name}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, retirar!',
                cancelButtonText: 'No, aún no!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    d.querySelector("#modalLoading").classList.remove("d-none")
                    let temp_medico_posicion_id = position_id
                    if (grupos_medicos_to_show === "1,2") {
                        temp_medico_posicion_id = 2
                    }
                    let medico_paciente_id = this.medic_teem_patient.find((mp, key) => Number(mp
                            .cat_user_medico_posicion_id) === Number(temp_medico_posicion_id) &&
                        Number(mp.user_id_medico) === Number(user_id_medico))[
                        'medico_paciente_id']
                    
                    await that.destroy(medico_paciente_id)
                    d.querySelector("#modalLoading").classList.add("d-none")

                    this.medic_teem_patient = this.medic_teem_patient.filter((mp, key) => 
                        Number(mp.cat_user_medico_posicion_id) !== Number(temp_medico_posicion_id) &&
                        Number(mp.user_id_medico) !== Number(user_id_medico))

                    pacientes_datos[that.episodio_index]['medico_paciente'] = this.medic_teem_patient /* pacientes_datos[that
                        .episodio_index]['medico_paciente'].filter((mp, key) => Number(mp
                        .user_id_medico) !== Number(user_id_medico)) */
                        that.deployMedicoPacienteList()


                        console.log(pacientes_datos[that.episodio_index]['medico_paciente']); //cat_user_medico_posicion_id
                        that.handleOptionListModal({
                            grupos_medicos_to_show,
                            color,
                            group_cargo,
                            position_id,
                            selector_cargo,
                            tippyContent,
                        })

                        Swal.fire(
                            `${group_cargo} retirado!`,
                            `El ${group_cargo} se retiró correctamente.`,
                            'success'
                        )
              
                 
                }
            })
        }

    }
    renderListOption({
        grupos_medicos_to_show,
        medicoAsignado = false,
        position_id = null,
        color = "default",
        selector_cargo = null,
        group_cargo = null,
        group_cargo_siglas = "",
        imgError = "/image/system/patient.svg",
        imgDoctor = null,
        nameDoctor = "",
    }) {
        return /*html*/ `
                    <li
                        data-grupos_medicos_to_show="${grupos_medicos_to_show.join()}"
                        data-episodio_id="${this.paciente['episodio']}"
                        data-position_id="${position_id}"
                        data-color="${color}"
                        data-selector_cargo="${selector_cargo}"
                        data-group_cargo="${group_cargo}"
                        data-tippy-content="Equipo ${group_cargo}"
                        class="tooltip-${color} list-group-item cursor-pointer list-group-item-action p-0"
                    >
                        <div class="d-flex flex-column">
                            <!-- Tarjeta activa -->
                            <div class="card-medic-team-active d-${medicoAsignado ? 'flex':'none'} align-items-center py-1">
                                <div class="badge badge-${color} mx-2 medico-badge-width scale-in-hor-left">${group_cargo_siglas}</div>
                                <img loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1" onerror="this.src='${imgError}'"  src="${imgDoctor}">
                                <b class="text-nowrap">
                                    ${nameDoctor}
                                </b>
                            </div>
                            <!-- Tarjeta inactiva -->
                            <div class="card-medic-team-inactive d-${!medicoAsignado ? 'flex':'none'}  align-items-center">
                                <div class="badge badge-${color} mx-2 medico-badge-width">${group_cargo_siglas}</div>
                                <div class="overflow-hidden text-nowrap ">${group_cargo}</div>
                            </div>
                        </div>
                    </li>
                `
    }
    renderMedicoPacienteList() {

        this.selector.innerHTML = null
        this.selector.innerHTML = `
            <ul class="list-group list-group-flush">

            </ul>
        `

    }
    getMedicosAsignados(item) {
        return this.medic_teem_patient.filter(medic => item['id'].includes(medic[
            'cat_user_medico_posicion_id']))
    }
    //PASO 1
    deployMedicoPacienteList() {
        let that = this
        //Limpio y renderizo espacio del cintillo de la modal
        // para mostrar la lista de los 6 ultimos personal de salud
        //asiognado al paciente. 
        this.renderMedicoPacienteList()
         
        //Lo siguiente va a pintar en el cintillo de la modal
        //la lista de los ultimos personal de salud asignados al paciente TR, IN, FE, RE, RA, EN
        this.cat_medic_teem_to_show().forEach((item, key) => {
            //BUSCAR MEDICOS ASIGNADOS
            let medicosAsignados = this.getMedicosAsignados(item)

            //OBTENER ULTIMO MEDICO ASIGNADO
            let object = {
                grupos_medicos_to_show: item['grupos_medicos_to_show'],
                position_id: item['id'].join(),
                color: item['color'],
                selector_cargo: item['selector_description'](),
                group_cargo: item['description'],
                group_cargo_siglas: item['sigla'](),
            }
            let ultimoMedicoAsignado = medicosAsignados.reduce((max, obj) => (obj.medico_paciente_id >
                max.medico_paciente_id ? obj : max), medicosAsignados[0]);

            if (!is_undefined(ultimoMedicoAsignado)) {
                object = {
                    grupos_medicos_to_show: item['grupos_medicos_to_show'],
                    medicoAsignado: true,
                    position_id: item['id'].join(),
                    color: item['color'],
                    selector_cargo: item['selector_description'](),
                    group_cargo: item['description'],
                    group_cargo_siglas: item['sigla'](),
                    nameDoctor: ultimoMedicoAsignado['medico'],
                    imgDoctor: ultimoMedicoAsignado['medico_img']
                }
            }
            

            let option = that.renderListOption(object)

            that.selector.querySelector(`ul`).insertAdjacentHTML("beforeend", option)


        })

        //EVENTO CLICK PARA CADA OPCIÓN DEL CINTILLO DE LA MODAL
        this.selector.querySelectorAll("li").forEach(optionHTML => {
            optionHTML.addEventListener("click", (event) => {
                //Obtengo los atributos data del elemento que se ha clickado
                let {
                    grupos_medicos_to_show,
                    color,
                    group_cargo,
                    position_id,
                    selector_cargo,
                    tippyContent,
                } = event.currentTarget.dataset

                //PASO 2
                //Ejecuto el método handleOptionListModal para abrir la modal
                //con los datos del elemento que se ha clickado
                that.handleOptionListModal({
                    grupos_medicos_to_show,
                    color,
                    group_cargo,
                    position_id,
                    selector_cargo,
                    tippyContent,
                })

            })
        })

    }
}
