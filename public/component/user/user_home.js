import {selectOptions, store_field} from '../../helpers/helpers.js'
import {index as CatUserEstado_index} from '../catalogs/cat_estado.js'
import {index as CatUserMunicipio_index} from '../catalogs/cat_municipio.js'
import * as ComponentPaciente from '../paciente/paciente.js'
import {} from './user_profile.js'

let d = document
let final_hora;
let final_dia;
let onChange_agenda_id

let formFields_validate_reg_interno=  async ($App)=>{
    /*let
         {
            nacionalidad    ,
            cedula          ,
            email           ,
            password        ,
            password_repeat ,
            nombres         ,
            apellidos       ,
            genero          ,
            fnacimiento     ,
            telefono_movil  ,
            cat_estado_id   ,
            cat_municipio_id,
            description     ,
            domicilio       ,
            cat_user_ubicacion_id       ,
            fecha_ingreso       ,
        } = this */

        if (is_empty( this.cedula )) {
            let input = d.querySelector(`input[name='cedula']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( email )) {
            let input = d.querySelector(`input[name='email']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }

        if (is_empty( nombres )) {
            let input = d.querySelector(`input[name='nombres']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( apellidos )) {
            let input = d.querySelector(`input[name='apellidos']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( fnacimiento )) {
            let input = d.querySelector(`input[name='fnacimiento']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( telefono_movil )) {
            let input = d.querySelector(`input[name='telefono_movil']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( cat_estado_id )) {
            let input = d.querySelector(`select[name='cat_estado_id']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        if (is_empty( cat_municipio_id )) {
            let input = d.querySelector(`select[name='cat_municipio_id']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        if (is_empty( description )) {
            let input = d.querySelector(`input[name='description']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( domicilio )) {
            let input = d.querySelector(`input[name='domicilio']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( domicilio )) {
            let input = d.querySelector(`input[name='domicilio']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }

    return true
}

/* let useState = {
    "agendas":[],
    "centros_salud":[],
    "citas":[],
    "medicos":[],
    "recipes": [],
    "estudios": [],
    "informes": [],
    "especialidades": [],
    "archivos": [],
    "paciente": {
        "correo": "",
        "nombres": "",
        "apellidos": "",
        "nacionalidad": "",
        "cedula": "",
        "fnacimiento": "",
        "genero": "",
        "telefono_movil": "",
        "imagen": "",

        },
    set_paciente: function(data)
    {
        this.paciente = data
    },
    get_key_cita: function(cita_id) {
        let response
        let stop = true;
            this.citas.forEach((cita, key) => {
                if (equalsInt(cita.id, cita_id) && stop) {
                    response= key
                    stop = false
                }
            })
            return  response
    },
    set_cita_delete( cita_id ){
        let response = []

            this.citas.forEach((cita, key) => {
                if (!equalsInt(cita.id, cita_id)) {
                    response.push( cita )
                }
            })
            this.citas = response
    },
    set_item_cita: function(cita_id, item, value) {
        useState.citas[this.get_cita_key(cita_id)][item] = value
    },
    get_cita_key: function(cita_id) {
        let response
        let p = true
        this.citas.forEach((cita, key) => {
            if (equalsInt(cita.id, cita_id) && p) {
                response = key
                p = false;
            }
        })
        return response
    },
    set_especialidades:function(data)
    {
        this.especialidades = data
    },
    get_especialidad:function(especialidad_id){
        return first(this.especialidades.filter(x=> equalsInt(x.id, especialidad_id)))
    },
    get_medico:function(medico_id)
    {
        return first(this.medicos.filter( x=> equalsInt( x.user_id, medico_id ) ) )
    },
    get_centro_salud:function(centro_salud_id)
    {
        return first(this.centros_salud.filter( x=> equalsInt( x.id, centro_salud_id ) ) )
    },
    set_recipes: function(data)
    {
        this.recipes = data
    },
    set_estudios: function(data)
    {
        this.estudios = data
    },
    set_informes: function(data)
    {
        this.informes = data
    },
    set_historial: function(data)
    {
        this.historial = data
    },
    get_card_paciente: function()
    {
        let $card = document.querySelector("#profile_paciente")
        //console.log($card)
        let {
                imagen,
                nombres,
                apellidos,
                nacionalidad,
                cedula,

            } = this.paciente
            d.querySelectorAll(".imagen-perfil").forEach(x=>{
                x.setAttribute("src", imagen)
            })
            //$card.querySelector("img").setAttribute("src", imagen)
            $card.querySelector("h3").textContent=`${nombres} ${apellidos}`
            $card.querySelector("p").textContent=`${nacionalidad}-${cedula}`
        let $link = $card.querySelectorAll("li a")
            //$link[0].textContent =this.recipes.length
            //$link[1].textContent =this.estudios.length
            //$link[2].textContent =this.informes.length
            $link[0].textContent =this.citas.length
    },
    set_citas:function(data){
        this.citas = data
    },
    set_centros_salud:function(data){
        this.centros_salud = data
    },
    getEspecialidadCentroSalud:function(centro_salud_id){
        let response
        this.centros_salud.forEach( ( esp, key ) => {
            //cl(esp)
            if(equalsInt(esp.id , centro_salud_id) ){
                response = esp.especialidades
            }
        })
        return response;
    },
    getMedicoByEspecialidad:function(e){

        let agenda = this.agendas.filter(x => equalsInt(x.centro_salud_id, d.querySelector("select[name='centro_salud_id']").value) && equalsInt(x.cat_especialidad_id,e.target.value)  )
        let agenda_especialidad_id = agenda.map(x => x.cat_especialidad_id )
        let agenda_medicos_id = agenda.map(x => x.user_id_medico )
            return this.medicos.filter(medico => {

                if(
                    agenda_especialidad_id.includes(medico.cat_user_especialidad_id) &&
                    agenda_medicos_id.includes(medico.user_id)
                ){
                    return medico
                }
            })
    },
    get_medico_agenda: function(medico_id){
       // console.log("cat_especialidad_id-->",d.querySelector("select[name='cat_especialidad_id']").value)
        //console.log(this.agendas.filter(agenda => equalsInt( agenda.user_id_medico , medico_id ) && equalsInt( agenda.cat_especialidad_id , d.querySelector("select[name='cat_especialidad_id']").value ) ))
        return this.agendas.filter(agenda => equalsInt( agenda.user_id_medico , medico_id ) && equalsInt( agenda.cat_especialidad_id , d.querySelector("select[name='cat_especialidad_id']").value ) )
    },
    get_medico_agenda_horas: function(agenda_id,dia_del_mes){
        let model = first( this.agendas.filter(agenda => equalsInt( agenda.agenda_id , agenda_id ) ) )['agenda']
        let { horas_am, horas_pm } = model

           // alert("aa")
            if (is_undefined(horas_am)) {
                console.log("horas_am",horas_am)
                horas_am ={}
            }
            if (is_undefined(horas_pm)) {
                console.log("horas_pm",horas_pm)
                horas_am ={}
            }
        let am =[]
            if (horas_am.length > 0) {
                am = horas_am.filter(hora => {
                    let date = new Date(hora)

                            if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                return hora
                            }
                    } )
            }else{
                am =[]
            }
        let pm =[]
            if (horas_pm.length > 0) {
                pm = horas_pm.filter(hora => {
                        let date = new Date(hora)
                            if (fechaAMD(date) === fechaAMD(dia_del_mes)) {
                                return hora
                            }
                    } )
            }else{

                pm =[]
            }
            return {"horas_am": am,"horas_pm": pm}
    },
    "formData":{
        centro_salud_id:"",
        cita_dia          : "",
        cita_hora         : "",
        user_id_medico    : "",
        cita_motivo       : "",
        enfermedad_actual:"",
        cat_user_cita_status:1,
    },
}  */
let handleLinkCentroSalud = (e)=>
    {

    let location = e.currentTarget.dataset.location

    let $googleMaps = entById(`googleMaps`).content
        $googleMaps = d.importNode($googleMaps, true);
        $googleMaps.querySelector("iframe").src= location

    let $modalBody = d.querySelector("#fullscreen div.modal-body-2.fullscreen")
        $modalBody.innerHTML= null
        $modalBody.append( $googleMaps )

    let $footer = entById(`footer_modal_cita`).content
        $footer = d.importNode($footer, true);
        $footer.querySelector(".col-md-8").classList.add("d-none")
    let modalFooter = d.querySelector("#fullscreen div.modal-footer.fullscreen")
        modalFooter.innerHTML = null
        modalFooter.append($footer)

        $("#fullscreen").modal("show")

    }
let list_centro_salud = (list_centro_salud) =>
    {
        let $html = document.getElementById('list_centros_disponibles')
            $html.innerHTML = null
            list_centro_salud.forEach(cs => {
                let $item = document.getElementById('temp_item_list_centro_salud').content
                    $item = document.importNode($item, true)
                    //console.log(cs.location)
                    $item.querySelector(".centro-salud-link").dataset.location= cs.location
                    $item.querySelector(".centro-salud-link").addEventListener("click",e=>{
                        //console.log(e.currentTarget)
                        handleLinkCentroSalud(e)
                    })
                    $item.querySelector("strong").textContent = cs.description
                    $item.querySelector("p").textContent = cs.coments


                    $html.append($item)
            })
    }
let route = (new_route)=>
    {
        let page ="";
        switch (new_route) {
            case 'nueva_cita':
                handleformNuevaCita()
                page = "#page_4";
            break;
            case 'mis_citas':
                page = "#page_1";
            break;
        }
        $("#navegacion_consulta_externa a[href='"+page+"']").tab('show')
    }
let handleCancelar = async (e)=>
    {
        let {cita_id, cat_user_cita_status_id} = e.target.dataset

        Swal.fire({
            title: '¿Deseas cancelar esta cita?',
            text: "Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2FA600',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Aún no!',
            confirmButtonText: 'Si, Cancelar!'
            }).then( async (result) => {
                    if (result.isConfirmed) {
                        let model = await saveStatus(cita_id, cat_user_cita_status_id)


                        let target = e.target.parentNode.parentNode.parentNode
                            $(target).hide("slow")

                            useState.set_cita_delete( cita_id )

                            if (useState.citas.length < 1) {
                                entById('listado_de_citas').textContent="No posee citas pendientes"
                            }
                            console.log("Estado al Cancelar",useState.citas)

                            Swal.fire(
                                'Cita Cancelada!',
                                'Puede crear una nueva cita en la opción Nueva Cita.',
                                'success'
                            )
                    }
            })
    }
let saveStatus = async (cita_id, status) =>
    {
        let formData = new FormData();
            formData.append("cita_id", cita_id)
            formData.append("cat_user_cita_status_id", status)
            formData.append("_token", entById('_token').value)
            return await post("/consultaexterna/medico/cita/status", formData)
    }
let list_citas_activas = ()=>
    {
        let items = useState.citas;
            entById('listado_de_citas').innerHTML=null
        let actualiza_estatus = async (id,current_estatus, cat_user_cita_status_id)=>{
                await saveStatus(id,cat_user_cita_status_id)
            let $item = d.querySelector(`.user-cita_id-${id}`)
                $item.querySelector(`.cita-status .estatus-cita-${current_estatus}`).classList.add("d-none")
                $item.querySelector(`.cita-status .estatus-cita-${cat_user_cita_status_id}`).classList.remove("d-none")
                $item.querySelector(`.cita-message .message-estatus-cita-${current_estatus}`).classList.add("d-none")
                $item.querySelector(`.cita-message .message-estatus-cita-${cat_user_cita_status_id}`).classList.remove("d-none")
            }
        if (items.length > 0) {
            items.forEach((x,y)=>{
                let $item = d. getElementById("item_cita_activa").content
                    $item = d.importNode($item,true)
                let $items = $item.querySelectorAll('div')
                    $item.querySelector(".item-text-fecha-creacion").innerHTML=fechaCortaCustom2(x.created_at)
                    $item.querySelector(".item-text-especialidad").textContent=useState.get_especialidad(x.cat_especialidad_id).description
                    console.log(x)
                    $item.querySelector(".item-text-medico").textContent=useState.get_medico(x.user_id_medico).medico
                    $item.querySelector(".item-text-dia-cita").textContent=x.day
                    $item.querySelector(".item-text-mes-cita").textContent= meses(parseInt(x.month)-1)

                    $item.querySelector(".cancelar-cita span").dataset.cita_id = x.id
                    $item.querySelector(".cancelar-cita span").dataset.cat_user_cita_status_id = 3

                let hoy = new Date()
                let hora = new Date(`${x.year}-${x.month}-${x.day} ${x.hour}`)
                    $item.querySelector(".item-text-anio-cita").textContent= x.year

                let status = x.cat_user_cita_status_id;

                    $item.querySelector(".post").classList.add(`user-cita_id-${x.id}`)
                    $item.querySelector(".post").dataset.userCitaId= x.id

                    $item.querySelector(`.cita-status .estatus-cita-${status}`).classList.remove("d-none")

                    $item.querySelector(`.cita-message .message-estatus-cita-${status} .fecha_cita`).textContent= fechaCortaCustom3( hora )
                    $item.querySelector(`.cita-message .message-estatus-cita-${status}`).classList.remove("d-none")

                    if (status === 2) {//reprogramar
                        $item.querySelector(`.cita-message .message-estatus-cita-${status} .cita-aceptar`).addEventListener("click",e=>{
                            actualiza_estatus(x.id, status ,4)
                            //
                        })
                        $item.querySelector(`.cita-message .message-estatus-cita-${status} .cita-rechazar`).addEventListener("click",e=>{
                            actualiza_estatus(x.id, status ,3)
                            //
                        })
                    }
                    $item.querySelector(".item-text-hora-cita").textContent= formatAMPM(hora)
                    $item.querySelector(".item-text-motivo-cita").textContent= is_null(x.reason_for_consultation) ? "No indicado" : x.reason_for_consultation

                    $item.querySelector(".item-text-lugar-cita").innerHTML= useState.get_centro_salud(x.centro_salud_id).description

                    $item.querySelector(".item-text-direccion-cita").innerHTML= useState.get_centro_salud(x.centro_salud_id).coments

                    //console.log(useState.getEspecialidadCentroSalud())
                    //
                    entById('listado_de_citas').append($item)
            })
        }else{
            entById('listado_de_citas').textContent="No posee citas pendientes"
        }

    }
let  mensajeCita = () =>
    {
        //let { } = useState.citas_activas

        modalMensaje({
            title:`
            <div class="text-center">
                <i style="font-size: 0.8em;">Solicitud completada</i>
            </div>
            `,
            content:`
            <div class="h5">
                <div class="text-center">
                    Su Cita ha sido agendada.<br>

                </div>
            </div>

            `,
            action:`
                <button  data-dismiss="modal" type="button" class="btn-submit-cita btn btn-light btn-block btn-lg text-primary">De acuerdo, Finalizar</button>
            `,
        })
    }
let handleformNuevaCita = ()=>
    {
        let $item = d. getElementById("form_nueva_cita").content
            $item = d.importNode($item,true)
            entById('page_4').innerHTML=null
            entById('page_4').append($item)
            useState.formData = {
                    centro_salud_id    : "",
                    cat_especialidad_id: "",
                    user_id_medico     : "",
                    cita_dia           : "",
                    cita_hora          : "",
                    cita_motivo        : "",
                    enfermedad_actual  : "",
                }



            entById("centro_salud_id").append($select(useState.centros_salud))
            entById("centro_salud_id").addEventListener("change",e=>{
                saveDataForm(e)


                /********** */
                let centro_salud_id = e.target.value
                if ( !is_empty(centro_salud_id) ) {
                    /* if (is_empty(cedula) ) {
                        d.querySelector(`input[name='cedula']`).focus()
                        d.querySelector(`select[name='centro_salud_id']`).value=""
                        return false
                    } */
                    let centro_salud_especialidades = first(useState['centros_salud'].filter(centro_salud=> equalsInt(centro_salud.id , centro_salud_id) ))['especialidades']

                        d.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
                        d.querySelector(`select[name='user_id_medico']`).innerHTML = null
                    let $fragment = document.createDocumentFragment()
                    let $option = document.createElement("option")
                        $option.value = ""
                        if (centro_salud_especialidades.length === 0) {
                            $option.style.color="#a4b2bd"
                            $option.disabled=true
                        }
                        $option.textContent = "Seleccione"
                        $fragment.appendChild($option)
                        if (centro_salud_especialidades.length > 0) {
                            centro_salud_especialidades.forEach(especialidad=>{
                                $option = document.createElement("option")
                                $option.value =especialidad.cat_especialidad_id //
                                //let total_agendas = useState['medicos_agenda'].filter( agenda => equalsInt( agenda.cat_especialidad_id , especialidad.cat_especialidad_id ) )

                                //***** */
                                let agenda = useState['agendas'].filter(z => equalsInt(z.centro_salud_id, d.querySelector("select[name='centro_salud_id']").value) && equalsInt(z.cat_especialidad_id, especialidad.cat_especialidad_id)  )
                                      //console.log("agenda->",agenda)

                                let agenda_especialidad_id = agenda.map(x => x.cat_especialidad_id )
                                      //console.log("agenda_especialidad_id->",agenda_especialidad_id)

                                let agenda_medicos_id = agenda.map(x => x.user_id_medico )
                                      //console.log("agenda_medicos_id->",agenda_medicos_id)

                                let total_agendas =[]
                                    agenda_medicos_id.forEach((medico_id,key)=>{
                                        total_agendas[key] = useState['medicos'].filter(medico => {

                                            if(
                                                agenda_especialidad_id.includes(medico.cat_user_especialidad_id) &&
                                                agenda_medicos_id.includes(medico_id)
                                            ){
                                                return medico
                                            }
                                        })
                                    })
                                //***** */

                                if (total_agendas.length === 0) {
                                    $option.style.color="#a4b2bd"
                                    $option.disabled=true
                                }

                                //console.log("total_agendas",especialidad.cat_especialidad_id)
                                $option.textContent = `${especialidad.description} ${total_agendas.length   > 0 ? '('+total_agendas.length  +')' : ''}`
                                $fragment.appendChild($option)
                            })
                        } else {
                            $option.textContent ="Sin especialidades asociadas."
                            $fragment.appendChild($option)
                        }

                        d.querySelector(`select[name='cat_especialidad_id']`).append($fragment)

                        d.querySelector(`.notification-especialidad b`).textContent= centro_salud_especialidades.length
                        if (centro_salud_especialidades.length > 0) {
                            d.querySelector(`.notification-especialidad`).classList.remove("d-none")
                        }else{
                            d.querySelector(`.notification-especialidad`).classList.add("d-none")
                        }
                        //useState['formCreateCita']['centro_salud_id'] = parseInt( centro_salud_id )

                        d.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
                        d.querySelector(`.item-2`).classList.add("bg-success")
                        d.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
                        d.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
                }else{


                    //useState['formCreateCita']['centro_salud_id'] = ""
                    d.querySelector(`select[name='centro_salud_id']`).value = ""
                    d.querySelector(`.item-2`).classList.remove("bg-primary","bg-success")
                    d.querySelector(`.item-2`).classList.add("bg-danger")
                    d.querySelector(`select[name='centro_salud_id']`).classList.add("is-invalid")
                    d.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid")

                    d.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
                    d.querySelector(`select[name='user_id_medico']`).innerHTML = null
                    d.querySelector(`input[name='cita_dia']`).value = ""
                    d.querySelector(`input[name='cita_hora']`).value = ""
                    d.querySelector(`textarea[name='cita_motivo']`).value = ""
                    d.querySelector(`#pills-am`).innerHTML = null
                    d.querySelector(`#pills-pm`).innerHTML = null


                    d.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
                    d.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
                    d.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")

                    d.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
                    d.querySelector(`.item-3`).classList.add("bg-primary")

                    d.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
                    d.querySelector(`.item-4`).classList.add("bg-primary")

                    d.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
                    d.querySelector(`.item-5`).classList.add("bg-primary")

                    d.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
                    d.querySelector(`.item-6`).classList.add("bg-primary")

                    d.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
                    d.querySelector(`.item-7`).classList.add("bg-primary")
                    return false
                }

            })
            entById("cat_especialidad_id").addEventListener("change",e=>{
                    //console.log("cat_especialidad_id",e.target.value)
                    saveDataForm(e)
               /*  let med =useState.getMedicoByEspecialidad(e)
                    //console.log(med)
                let medicos_formateado = get_medicos_Formated(med)
                    entById("user_id_medico").innerHTML=null


                    entById("user_id_medico").append($select(medicos_formateado)) */



                    /*/**** */
                let cat_especialidad_id = e.target.value
                    if ( !is_empty(cat_especialidad_id) ) {


                            d.querySelector(`select[name='user_id_medico']`).innerHTML = null

                        //**** */
                        let agenda = useState['agendas'].filter(x => equalsInt(x.centro_salud_id, d.querySelector("select[name='centro_salud_id']").value) && equalsInt(x.cat_especialidad_id,e.target.value)  )
                            //console.log(agenda)

                        let agenda_especialidad_id = agenda.map(x => x.cat_especialidad_id )
                            //console.log(agenda_especialidad_id)

                        let agenda_medicos_id = agenda.map(x => x.user_id_medico )
                            //console.log("agenda_medicos_id->",agenda_medicos_id)


                         let medicos_resultset =[]
                            agenda_medicos_id.forEach((medico_id,key)=>{
                                let medico =useState['medicos'].filter(medico => equalsInt(medico.user_id,medico_id))
                                    //console.log("medico->",medico)
                                    if (!is_null( first( medico ) ) ) {
                                        medicos_resultset[ key ] =  first( medico )
                                    }

                            })
                            //console.log("medicos_resultset->",medicos_resultset)




                        let $fragment = document.createDocumentFragment()
                        let $option = document.createElement("option")
                            $option.value = ""
                            $option.textContent = "Seleccione"
                            $fragment.appendChild($option)
                            if (medicos_resultset.length > 0) {
                                medicos_resultset.forEach(medico=>{
                                    console.log("medico->",medico)
                                    $option = document.createElement("option")
                                    $option.value =medico.user_id
                                    $option.textContent = `${medico.medico}`
                                    $fragment.appendChild($option)
                                })
                            } else {
                                $option.textContent ="Sin médicos asociados."
                                $fragment.appendChild($option)
                            }

                            d.querySelector(`select[name='user_id_medico']`).append($fragment)

                            d.querySelector(`.notification-medicos b`).textContent= medicos_resultset.length
                            if (medicos_resultset.length > 0) {
                                d.querySelector(`.notification-medicos`).classList.remove("d-none")
                            }else{
                                d.querySelector(`.notification-medicos`).classList.add("d-none")
                            }

                        //useState['formCreateCita']['cat_especialidad_id'] = parseInt( cat_especialidad_id )
                        //d.querySelector(`select[name='cat_especialidad_id']`).value = cat_especialidad_id
                        d.querySelector(`.item-3`).classList.remove("bg-primary","bg-danger")
                        d.querySelector(`.item-3`).classList.add("bg-success")
                        d.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-invalid")
                        d.querySelector(`select[name='cat_especialidad_id']`).classList.add("is-valid")
                        //console.log( useState['formCreateCita'] )
                    }else{
                        // useState['formCreateCita']['cat_especialidad_id'] = ""
                        d.querySelector(`select[name='user_id_medico']`).innerHTML = null
                        //d.querySelector(`select[name='user_id_medico']`).value = ""
                        d.querySelector(`.item-3`).classList.remove("bg-primary","bg-success")
                        d.querySelector(`.item-3`).classList.add("bg-danger")
                        d.querySelector(`select[name='cat_especialidad_id']`).classList.add("is-invalid")
                        d.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid")
                        //d.querySelector(`select[name='user_id_medico']`).classList.add("is-invalid")
                        d.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")

                        d.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-4`).classList.add("bg-primary")

                        d.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-5`).classList.add("bg-primary")

                        d.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-6`).classList.add("bg-primary")

                        d.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-7`).classList.add("bg-primary")
                        return false
                    }
            })
            entById("user_id_medico").addEventListener("change",e=>{
                saveDataForm(e)
                /* entById("cita_dia").value =``
                entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.target.value ) */
                let user_id_medico = e.target.value
                    if ( !is_empty(user_id_medico) ) {

                        activarCalendario(user_id_medico)

                        d.querySelector(`.item-4`).classList.remove("bg-primary","bg-danger")
                        d.querySelector(`.item-4`).classList.add("bg-success")
                        d.querySelector(`select[name='user_id_medico']`).classList.remove("is-invalid")
                        d.querySelector(`select[name='user_id_medico']`).classList.add("is-valid")

                    }else{
                        //useState['formCreateCita']['user_id_medico'] = ""
                        d.querySelector(`select[name='user_id_medico']`).value = ""
                        d.querySelector(`.item-4`).classList.remove("bg-primary","bg-success")
                        d.querySelector(`.item-4`).classList.add("bg-danger")
                        d.querySelector(`select[name='user_id_medico']`).classList.add("is-invalid")
                        d.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid")

                        d.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-5`).classList.add("bg-primary")

                        d.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-6`).classList.add("bg-primary")

                        d.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
                        d.querySelector(`.item-7`).classList.add("bg-primary")
                        entById("mensaje_dia_seleccionado").innerHTML = `Solo los días resaltados están disponibles.`
                        $('#calendar').datepicker('destroy')
                        $('#calendar').empty()
                        return false
                    }


            })
            entById("cita_motivo").addEventListener("change",e=>{
                saveDataForm(e)

            })
            d.addEventListener("click",e=>{

                if (e.target.matches(".cita-hora")) {
                    //d.querySelector( ".item-4" ).classList.remove("badge-primary")
                    //d.querySelector( ".item-4" ).classList.add("badge-success")
                    saveDataForm({"name":"cita_hora","value":e.target.dataset.hora})
                    entById('cita_hora').value = e.target.dataset.hora
                    final_hora = formatAMPM( new Date(e.target.dataset.hora) ).toUpperCase()
                }
            })
            $('#calendar').datepicker().on("changeDate", function(e) {
                let d = document;
                let f = new Date(e.date);
                let dia_del_mes = ("0" + f.getDate()).slice(-2);
                let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth()+1)).slice(-2) + "-" + dia_del_mes;
                    saveDataForm({"name":"cita_dia","value":dia_del_mes})
                    document.getElementById("cita_dia").value=fechaIngreso
                    entById("mensaje_dia_seleccionado").innerHTML =`
                        <b>Día seleccionado:</b> <span class="badge badge-primary">${fechaCortaCustom1(e.date)}</span>
                    `
                    final_dia = fechaCortaCustom1(e.date)



                let horas = useState.get_medico_agenda_horas( onChange_agenda_id, f )
                    console.log("----------->>>",horas)
                    d.querySelector('#pills-am ul.nav').innerHTML =""
                    d.querySelector('#pills-pm ul.nav').innerHTML =""
                    if (horas.horas_am.length > 0) {

                        horas.horas_am.forEach((hora,key)=>{

                            let h = formatAMPM( new Date(hora) ).toUpperCase()
                                d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                    <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                        <a class="nav-link cita-hora" id="hora-am-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-am-${key}" role="tab" aria-controls="pills-am-${key}" aria-selected="true">${h}</a>
                                    </li>
                                `)
                        })
                    } else {
                        d.querySelector('#pills-am ul.nav').innerHTML =`
                            <li>

                            </li>
                        `
                    }
                    if (horas.horas_pm.length > 0) {

                        horas.horas_pm.forEach((hora,key)=>{
                            let h = formatAMPM( new Date(hora) ).toUpperCase()
                                d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                    <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                        <a class="nav-link cita-hora" id="hora-pm-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-pm-${key}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                    </li>
                                `)
                        })
                    }/*  else {
                        d.querySelector('#pills-pm ul.nav').innerHTML =`
                            <li>

                            </li>
                        `
                    } */
            });
            $('#calendar').datepicker('destroy')
            $('#calendar').empty()
            d.querySelector("#page_4 #submit").addEventListener("click", async function(e){
                //console.log("----------------->",d.querySelector("#submit"))

               e.preventDefault()
                //alert("aaaaa")
                let input = d.querySelector(`#page_4 select[name='centro_salud_id']`)
                    if (is_empty( input.value )) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Selecione un Centro de salud",
                                didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                }
                            })
                        return false
                    }
                    input = d.querySelector(`#page_4 select[name='cat_especialidad_id']`)
                    if (is_empty( input.value )) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Selecione una especialidad",
                                didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                }
                            })
                        return false
                    }
                    input = d.querySelector(`#page_4 select[name='user_id_medico']`)
                    if (is_empty( input.value )) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Selecione un médico",
                                didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                }
                            })
                        return false
                    }
                    input = d.querySelector(`#page_4 input[name='cita_dia']`)
                    if (is_empty( input.value )) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Selecione  un día disponible del calendario"
                                /* didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                } */
                            })
                        return false
                    }
                    input = d.querySelector(`#page_4 input[name='cita_hora']`)
                    if (is_empty( input.value )) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Selecione  una hora disponible"
                                /* didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                } */
                            })
                        return false
                    }

                    useState['formData']['cat_especialidad_id'] = d.querySelector(`#page_4 select[name='cat_especialidad_id']`).value
                    useState['formData']['user_id_medico'] = d.querySelector(`#page_4 select[name='user_id_medico']`).value
                    useState['formData']['cita_dia'] = d.querySelector(`#page_4 input[name='cita_dia']`).value
                    useState['formData']['cita_hora'] = d.querySelector(`#page_4 input[name='cita_hora']`).value
                    useState['formData']['cita_motivo'] = d.querySelector(`#page_4 textarea[name='cita_motivo']`).value

                let formData = new FormData();

                    for (const key in useState.formData) {
                        if (Object.hasOwnProperty.call(useState.formData, key)) {
                            let element = useState.formData[key];
                                formData.append(key,element)
                        }
                    }
                    formData.append("user_id_paciente",user_id_paciente );
                    formData.append("cat_user_cita_status_id",1 );
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/consultaexterna/paciente/cita/store",formData)
                    $response.then(response=>{

                        if($response){
                            useState.citas.push(response)
                            //useState.get_card_paciente()
                            list_citas_activas()
                            mensajeCita()
                        }


                    })
            })
    }
let saveDataForm = (e)=>
    {
        // console.clear()
        if (e.target?.matches("input") || e.target?.matches("textarea")) {
            if (useState.formData.hasOwnProperty(e.target.name)) {
                useState.formData[e.target.name] = e.target.value

            }
        }
        if (e.target?.matches("select") ) {
            if (useState.formData.hasOwnProperty(e.target.name)) {
                useState.formData[e.target.name] = e.target.options[e.target.selectedIndex].value
            }

        }
        if (["cita_dia","cita_hora"].includes(e.name)) {
            useState.formData[e.name] = e.value
        }
        //console.log(useState.formData)

    }
let activarCalendario = (medico_id)=>
    {
        //console.log(medico_id)
        $('#calendar').datepicker('destroy')
        $('#calendar').empty()
        let medico_agenda = useState.get_medico_agenda(medico_id)
        //console.log(medico_agenda)
        let {agenda,agenda_id} = first(medico_agenda)
            onChange_agenda_id = agenda_id
        let mesesDisponibles = agenda.mes_del_anio
        let diasDisponible = agenda.dias_del_mes
            if( is_undefined(mesesDisponibles) ){
                return false
            }
            $('#calendar').datepicker({
                "language": "es",
                beforeShowYear: function(date){
                    if (date.getFullYear() !== new Date().getFullYear()) {
                        return false;
                    }
                },
                beforeShowMonth: function(date){
                    if (
                        !mesesDisponibles.includes(date.getMonth()+1) &&
                        date.getFullYear() === new Date().getFullYear()
                        ) {
                        return false;
                    }
                },
                beforeShowDay: function(date){
                    // console.log("-->>",fechaAMD(date))
                    let f = new Date()
                    let fActual = new Date( f.getFullYear() , (f.getMonth()+1), date.getDate() )
                    if (
                            fActual.getTime() >=  f.getTime() &&
                            ( date.getMonth()+1 ) >= ( f.getMonth()+1 ) &&
                            diasDisponible.includes( fechaAMD(date) )

                        ) {

                            return {
                            tooltip: `Dia ${date.getDate()} de ${( meses( date.getMonth() ) )} disponible`,
                            classes: 'today'
                            };
                    }else{
                        return {
                            tooltip: `No existen horas disponibles este dia`,
                            classes: 'disabled',
                            };
                    }
                },
            });

    }
let get_medicos_Formated = (medicos)=>
    {
        let model = []
            medicos.forEach( ( x , key ) => {
                model[ key ] ={}
                model[ key ].id = x.user_id
                model[ key ].description = `${!is_null(x.prefijo) && !is_undefined(x.prefijo) && !is_empty(x.prefijo) ? x.prefijo+" " : ""}${x.medico}`
            } )
            return model
    }
let get_user_id = () =>{
        return useState['paciente']['user_id']
    }
export let edit = async (user_id,$selector)=>{ //editar datos paciente
        let $form = d.querySelector($selector)
            useState.cat_estado       = await CatUserEstado_index()
            useState.cat_municipio    = await CatUserMunicipio_index()



        //entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
        //entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        //entById("description").value="Caracas"
        let ruta = ""
            $form.addEventListener("change", async function(e){
                $form.querySelector(".overlay").classList.remove("d-none")
                if (
                    e.target.matches("input[name='email']")
                ) {
                    if ( !is_empty(e.target.value) ) {
                        ruta = "/consultaexterna/user/update_item"
                    }
                }
                if (
                    e.target.matches("select[name='nacionalidad']") ||
                    e.target.matches("input[name='cedula']") ||
                    e.target.matches("input[name='nombres']") ||
                    e.target.matches("input[name='apellidos']") ||
                    e.target.matches("select[name='genero']") ||
                    e.target.matches("input[name='fnacimiento']") ||
                    e.target.matches("input[name='telefono_movil']")
                ) {
                    if ( !is_empty(e.target.value) ) {
                        ruta = "/consultaexterna/user/profile/update_item"
                    }
                }
                if (
                    e.target.matches("input[name='imagen']")
                ) {

                    let file = d.querySelector(`input[name='imagen']`).files[0];
                    let response = await store_field(
                        e.target.name,
                        file,
                        user_id,
                        "/consultaexterna/user/profile/update_item_file"
                    )
                    if ( !is_null(response) ) {
                        useState['paciente'][e.target.name] = response[e.target.name]
                        useState.get_card_paciente()
                        $form.querySelector(".overlay").classList.add("d-none")
                    }
                    console.log( useState['paciente'] )
                    return false
                }
                if (
                    e.target.matches("select[name='cat_estado_id']") ||
                    e.target.matches("select[name='cat_municipio_id']") ||
                    e.target.matches("input[name='description']") ||
                    e.target.matches("input[name='domicilio']")
                ) {
                    if ( !is_empty(e.target.value) ) {
                        ruta = "/consultaexterna/user/direction/update_item"
                    }
                }
                if (
                    e.target.matches("input[name='imgSoyChacao']") ||
                    e.target.matches("input[name='imgDocIdentidad']")
                ) {
                    let file = d.querySelector(`input[name='${e.target.name}']`).files[0];
                    let response = await store_field(
                        e.target.name,
                        file,
                        user_id,
                        `/consultaexterna/user/profile_images/update_item_file/${e.target.name}`
                    )
                    if ( !is_null(response) ) {
                        useState['paciente'][e.target.name] = response["value"]
                        useState.get_card_paciente()
                        $form.querySelector(`#${e.target.name}Preview`).src= useState['paciente'][e.target.name]
                        $form.querySelector(".overlay").classList.add("d-none")
                    }
                    //console.log( useState['paciente'] )
                    return false



                }
                if (
                    e.target.matches("input[name='tarjeta_soy_chacao']")
                ) {
                    if ( !is_empty(e.target.value) ) {
                        ruta = "/consultaexterna/user/paciente/tarjeta_soy_chacao/update_item"
                    }
                }
                /****** */
                if ( !is_empty(e.target.value) ) {
                    let response = await store_field(
                            e.target.name,
                            e.target.value,
                            user_id,
                            ruta
                        )
                        if ( !is_null(response) ) {
                            useState['paciente'][e.target.name] = response[e.target.name]
                            useState.get_card_paciente()
                            $form.querySelector(".overlay").classList.add("d-none")
                        }
                }

                console.log( useState['paciente'] )
            })
            $form.querySelector("select[name='cat_estado_id']").addEventListener("change",function(e){
                $form.querySelector("select[name='cat_municipio_id']").innerHTML=null
                $form.querySelector("select[name='cat_municipio_id']").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,e.target.value ) ) )
            })
            telefonoConfig("#telefono_movil")
    }

export let init = async (param)=>{
        list_centro_salud(centro_salud)
        useState.set_citas(model.citas)
		useState.set_centros_salud(centro_salud)
        useState.set_paciente(model.paciente)
        useState.get_card_paciente()
        useState.set_especialidades(model.especialidades)
        console.log("useState->",useState)

			useState.medicos = await UserMedico.getMedicos()
        	useState.agendas = await UserMedicoAgenda.getAll()
            list_citas_activas()
            await edit( get_user_id() , "#page_3" )

        d.addEventListener("click",e=>{
            if (e.target.matches('.cancelar-cita span') ) {
                handleCancelar(e)
            }
            if (e.target.matches('.btn-nueva-cita') ) {

                route('nueva_cita')
            }
            if (e.target.matches('.btn-submit-cita') ) {
                route('mis_citas')
            }

        })
        //await mi_informacion( "#box_form_user_info", user_id_paciente)
    }
