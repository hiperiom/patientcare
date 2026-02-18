import { is_undefined, $qs, $qsa, $select, $selectCustom, first } from '../../helpers/helpers.js'
import * as Componentmedico from '../../component/medico/medico.js'
import * as Componentpaciente from '../../component/paciente/paciente.js'
import * as Componentagenda from '../../component/agenda/agenda.js'
import * as create from './create.js'
//import * as index from './index.js'
//import * as show from './show.js'
//import * as store from './store.js'
//import * as update from './update.js'
//import * as destroy from './destroy.js'

let d = document

export let handle_create = async () => {
    //create()
}
export let handle_store = async (item_id) => {
    //store()
}
export let handle_show = async (item_id) => {
    //show()
}
export let handle_update = async (item_id) => {
    //update()
}
export let handle_destroy = async (item_id) => {
    //destroy()
}
export let form_create = async (item_id) => {

}
let init = (selector) => {
    let $App = d.querySelector(selector)
    let $dashboard = $App.querySelector('#dashboard')
        $dashboard.addEventListener("change", function (e) {
            if (e.target.matches("li input")) {
                e.preventDefault()
                let value = confirm("¿Seguro que quieres actualizar este valor?")
                if (value) {
                    //alert("Valor Actualizado")
                    alert(e.target.name)
                }
            }
        })
        $dashboard.addEventListener("click", function (e) {
            console.log(e.target)
            if (e.target.matches(".regresar")) {
                index({"level":e.target.dataset['level']})
            }
            if (e.target.matches(".goto")) {
                switch ( parseInt(e.target.dataset['goto']) ) {
                    case 1:
                        window.open("/encuesta/hospitalizacion/tablero")
                    break;
                    default:
                    break;
                }

            }
            if (e.target.matches(".card-option")) {
                if ( is_undefined(e.target.dataset['level']) ) {
                   return false;
                }
                console.log( typeof useState['menu'][e.target.dataset['level']][e.target.dataset['index']]['handle_option'] )
                if( typeof useState['menu'][e.target.dataset['level']][e.target.dataset['index']]['handle_option'] == "object"){
                    index( useState['menu'][e.target.dataset['level']][e.target.dataset['index']]['handle_option'] )
                }else{
                    useState['menu'][e.target.dataset['level']][e.target.dataset['index']]['handle_option']()
                }
            }
        })
}
export let getData = async ()=>{
    let dateStart = d.querySelector("#dateStart").value
    let dateEnd = d.querySelector("#dateEnd").value
        d.querySelector(".overlay").classList.remove("d-none")
    let model = await get(`/consultaexterna/admin/getDataIndex/${dateStart}/${dateEnd}`)
        for (const key in model) {
            console.log('Key --> ',key)
            d.querySelector(`#${key}`).innerHTML = model[key]
        }
        d.querySelector(".overlay").classList.add("d-none")
    }
export let index_dashboard = async ()=>{
    $('[data-widget="pushmenu"]').PushMenu('toggle')
    let $template = entById('artefacto_0051').content.cloneNode(true)
    let $App = entById('App')
        $App.innerHTML = null
        $App.append( $template )

        getData();

}
export let desactivarMedico = async (e) => {

    Swal.fire({
        title: `Elija una opción:`,
        //text: "Esta acción no se puede revertir!",
        icon: 'info',
        showCancelButton: true,
        showDenyButton: true,

        confirmButtonColor: '#2FA600',
        denyButtonColor: '#dc3545;',
        confirmButtonText: `ACTIVAR`,
        denyButtonText: `DESACTIVAR`,
        cancelButtonText: 'Cancelar',
        reverseButtons: false,

    }).then(async (result) => {
        let model

        let user_id_paciente = e.target.dataset['user_id_paciente']
        let formData = new FormData();
            formData.append("fecha_regreso",timestamps())
            formData.append("user_id_paciente",user_id_paciente)
            formData.append("reasignar",0)
            formData.append("created_at",timestamps())
            formData.append("_token",d.querySelector("#_token").value)

            if (result.isConfirmed) {
                formData.append("active",1)
                model = await post(location.origin+"/consultaexterna/user/medico/activo/store",formData)
                $('#equictntbl').DataTable().clear();
                    $('#equictntbl').DataTable().destroy();
                    let index = useState['medicos'].findIndex(x=>equalsInt(x['user_id'],user_id_paciente))
                    useState['medicos'][index]['user_medico_activo'] = Number(model['active'])

                    d.querySelector(`#row_${user_id_paciente}`).classList.remove("bg-gray")


                    //Componentmedico.index_admin()

                    Swal.fire({
                        icon: 'success',
                        title:'Médico activado'
                    })

                return false;
            }
            if (result.isDenied) {
                formData.append("active",0)

                model = await post(location.origin+"/consultaexterna/user/medico/activo/store",formData)
                $('#equictntbl').DataTable().clear();
                $('#equictntbl').DataTable().destroy();
                let index = useState['medicos'].findIndex(x=>equalsInt(x['user_id'],user_id_paciente))
                useState['medicos'][index]['user_medico_activo'] = Number(model['active'])

                    d.querySelector(`#row_${user_id_paciente}`).classList.add("bg-gray")


                    //Componentmedico.index_admin()
                    Swal.fire({
                        icon: 'success',
                        title:'Médico desactivado'
                    })
                    return false
               /*  })
                return false */
            }




    })

}
export let eliminarEspecialidad = async (e)=>{
        Swal.fire({
            title: `¿Desea eliminar esta especialidad?`,
            text: "Esta acción también eliminará las agendas de la especialidad en todos los centros de salud asociados al médico.!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#2FA600',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No!',
            confirmButtonText: `Si, eliminar!`
        }).then(async (result) => {
            if (result.isConfirmed) {
                let {user_especialidad_id,user_id_medico} = e.target.dataset
                let model = await get(location.origin+`/consultaexterna/user/medico/especialidad/destroy/${user_especialidad_id}`)


                let index = useState['medicos'].findIndex(medico=>equalsInt(medico['user_id'],user_id_medico))
                    console.log("user_id_medico: " + user_id_medico)
                    console.log("index: " + index)
                    useState['medicos'][index]['especialidad'] = useState['medicos'][index]['especialidad'].filter(especialidad=> Number(especialidad['user_especialidad_id']) !== Number(user_especialidad_id) )

                    d.querySelectorAll(`.user_id_medico-${user_id_medico}.card-especialidad-${user_especialidad_id}`).forEach(x=>{
                        x.classList.replace("d-flex","d-none")
                    })
                    console.log(useState['medicos'][index]['especialidad'])

            }
        })

    }
export let index_reportes = async ({selector="#App"}) => {

    //$('[data-widget="pushmenu"]').PushMenu('toggle')
    let $template = entById('artefacto_0057').content.cloneNode(true)
   /*  let $App = entById('App') */
        $App.innerHTML = null
        $App.append( $template )


        d.querySelectorAll("#report_list .btn_reporte")[0].addEventListener('click',()=>{
            let dateStart = entById('dateStart').value
            let dateEnd = entById('dateEnd').value
            window.open(location.origin+`/consultaexterna/user/paciente/cita/reporteCitas/${dateStart}/${dateEnd}`)
        })
        d.querySelectorAll("#report_list .btn_reporte")[1].addEventListener('click',()=>{
            let dateStart = entById('dateStart').value
            let dateEnd = entById('dateEnd').value
            window.open(location.origin+`/consultaexterna/user/paciente/cita/reporteCitasCreadas/${dateStart}/${dateEnd}`)
        })
        d.querySelectorAll("#report_list .btn_reporte")[2].addEventListener('click',()=>{
            let dateStart = entById('dateStart').value
            let dateEnd = entById('dateEnd').value
            window.open(location.origin+`/consultaexterna/user/paciente/reportePacientes/${dateStart}/${dateEnd}`)
        })

    d.addEventListener("click",async function(e) {
        //console.log(e.target.classList)
        if (e.target.classList.contains("btn-medico-destroy")) {

            Swal.fire({
                title: `¿Desea eliminar al médico?`,
                //text: "Esta acción no se puede revertir!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No!',
                confirmButtonText: `Si, eliminar!`
            }).then(async (result) => {
                if (result.isConfirmed) {

                        let user_id = e.target.dataset['user_id_paciente']
                        let model =  await get(location.origin+`/consultaexterna/user/medico/home/removeRol/${user_id}`)
                        console.log(model);
                        Componentmedico.index_admin()
                        Swal.fire({
                            icon:"success",
                            title: 'Médico eliminado!',
                        })

                }
            })
        }
        if (e.target.classList.contains("btn-medico-medico_inactivo")) {
            desactivarMedico(e)
        }
        if (e.target.classList.contains("btn-medico-edit")) {
            Componentmedico.edit_admin( Number(e.target.dataset['user_id_paciente']))
        }
        if (e.target.classList.contains("btn-especialidad-destroy")) {
            await eliminarEspecialidad(e)
        }
        if (e.target.classList.contains("btn-medico-agenda-create")) {
            Componentagenda.create_admin( Number(e.target.dataset['user_id_paciente']))
        }
        if (e.target.classList.contains("btn-roles")) {

            //console.log(e.target.dataset)
            let {cat_user_type_id,active,user_id} = e.target.dataset
            let rol = cat_user_type_id
            if ([1].includes(Number(cat_user_type_id))) {
                let accion = (active == "true") ? 'remover':'añadir'
                Swal.fire({
                    title: `¿Desea ${accion} este rol del usuario?`,
                    //text: "Esta acción no se puede revertir!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No!',
                    confirmButtonText: `Si, ${accion}!`
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        if(active == "true"){
                            await get(location.origin+`/consultaexterna/user/medico/home/removeRol/${user_id}/${rol}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = false
                                e.target.parentNode.dataset['active'] = false
                                e.target.classList.remove("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.remove("text-primary")
                            }
                            Swal.fire(
                                'Rol removido!',
                            )
                        }else{
                            await get(location.origin+`/consultaexterna/user/medico/home/addRol/${user_id}/${rol}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = true
                                e.target.parentNode.dataset['active'] = true
                                e.target.classList.add("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.add("text-primary")
                            }
                            Swal.fire(
                                'Rol añadido!',
                            )
                        }
                    }
                })
            }else{
                let accion = (active == "true") ? 'remover':'añadir'
                Swal.fire({
                    title: `¿Desea ${accion} este rol del usuario?`,
                    //text: "Esta acción no se puede revertir!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No!',
                    confirmButtonText: `Si, ${accion}!`
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        if(active == "true"){
                            await get(location.origin+`/consultaexterna/user/medico/home/removeRol/${user_id}/${rol}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = false
                                e.target.parentNode.dataset['active'] = false
                                e.target.classList.remove("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.remove("text-primary")
                            }
                            Swal.fire(
                                'Rol removido!',
                            )
                        }else{
                            await get(location.origin+`/consultaexterna/user/medico/home/addRol/${user_id}/${rol}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = true
                                e.target.parentNode.dataset['active'] = true
                                e.target.classList.add("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.add("text-primary")
                            }
                            Swal.fire(
                                'Rol añadido!',
                            )
                        }
                    }
                })
            }
        }
        if ( e.target.classList.contains("btn-exonerado-update") ) {

            let {
                exonerado,
                id
            } = e.target.dataset
            await Componentpaciente.exonerado_update(id,exonerado)

        }

    })


}
export let index = async ({selector="#App"}) => {
    useState['cat_centro_salud'] = await get(location.origin+`/consultaexterna/cat/centro_salud/getAll`)
    console.log('useState[cat_centro_salud] ->',useState['cat_centro_salud'])
    useState['cat_especialidad'] = await get(location.origin+`/consultaexterna/cat/especialidad/getAll`)
    await index_dashboard();


    d.querySelector(".btn-dashboard-administrador").addEventListener("click", async function(){
        await index_dashboard()
    })

    d.querySelector(".btn-medico-create").addEventListener("click",function(){
        Componentmedico.create_admin()
    })
    d.querySelector(".btn-medico-index").addEventListener("click",function(){
        Componentmedico.index_admin()
    })
    d.querySelector(".btn-paciente-familiar").addEventListener("click",function(){
        Componentpaciente.index_familiar()
    })

    d.querySelector(".btn-paciente-index").addEventListener("click",function(e){
        Componentpaciente.index_admin()
    })

    d.querySelector(".btn-paciente-exonerado").addEventListener("click",function(){
        Componentpaciente.index_exonerado()
    })

    d.querySelector("#dateStart").addEventListener("change",function(){
        getData();
    })

    d.querySelector("#dateEnd").addEventListener("change",function(){
        getData();
    })
    d.addEventListener("change",async function(e){

        if (e.target.classList.contains("motivo_exoneracion")) {
            await Componentpaciente.motivo_exoneracion_store(e)
        }
    })
    d.addEventListener("click",async function(e) {
        //console.log(e.target.classList)
        if (e.target.classList.contains("btn-revisado")) {
            e.preventDefault()
            Swal.fire({
                title: `¿Desea aprobar este familiar?`,
               /*  text: "Si pulsa en sí, la revisión ", */
                icon: 'info',
                html:`
                    <textarea
                    placeholder="Observación"
                    class="form-control"
                    name="coments_revision"
                    rows="2"></textarea>
                `,
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No!',
                confirmButtonText: `Si!`
            }).then(async (result) => {
                let coments = d.querySelector("textarea[name='coments_revision']").value
                let {user_family_id} = e.target.dataset;
                let formData = new FormData();
                    formData.append("user_family_id",user_family_id)
                    formData.append("coments",coments)
                    formData.append("created_at",timestamps())
                    formData.append("updated_at",timestamps())
                    formData.append("_token",d.querySelector("#_token").value)


                    if (result.isConfirmed) {
                            formData.append("revisado",1)
                            formData.append("active",1)

                        let model = await post(location.origin+"/consultaexterna/user/familiar/updateRevisado",formData)
                            e.target.classList.remove("btn-outline-info")
                            e.target.classList.add("btn-info")
                            Swal.fire({
                                icon:"success",
                                title: 'El Familiar ha sido revisado exitosamente!',
                            })

                    }else{
                        formData.append("revisado",0)
                        formData.append("active",0)
                        let model = await post(location.origin+"/consultaexterna/user/familiar/updateRevisado",formData)
                            e.target.classList.remove("btn-info")
                            e.target.classList.add("btn-outline-info")
                            Swal.fire({
                                icon:"warning",
                                title: 'La vinculación familiar ha sido invalidada.',
                            })
                    }
            })
        }
        if (e.target.classList.contains("btn-medico-destroy")) {

            Swal.fire({
                title: `¿Desea eliminar al médico?`,
                //text: "Esta acción no se puede revertir!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No!',
                confirmButtonText: `Si, eliminar!`
            }).then(async (result) => {
                if (result.isConfirmed) {
                    console.log(useState['medicos'].length)
                        let user_id = e.target.dataset['user_id_paciente']
                        let model =  await get(location.origin+`/consultaexterna/user/medico/home/removeRol/${user_id}`)
                        useState['medicos'] = useState['medicos'].filter(x=>Number(x['user_id']) !== Number(user_id) )
                        //console.log(model);
                        Componentmedico.index_admin()
                        console.log(useState['medicos'].length)
                        Swal.fire({
                            icon:"success",
                            title: 'Médico eliminado!',
                        })

                }
            })
        }
        if (e.target.classList.contains("btn-medico-medico_inactivo")) {
            desactivarMedico(e)
        }
        if (e.target.classList.contains("btn-medico-edit")) {
            Componentmedico.edit_admin( Number(e.target.dataset['user_id_paciente']))
        }
        if (e.target.classList.contains("btn-especialidad-destroy")) {
            await eliminarEspecialidad(e)
        }
        if (e.target.classList.contains("btn-medico-agenda-create")) {
            Componentagenda.create_admin( Number(e.target.dataset['user_id_paciente']))
        }
        if (e.target.classList.contains("btn-roles")) {
            //console.log(e.target.dataset)
            let {cat_user_type_id,active,user_id} = e.target.dataset
            let rol = cat_user_type_id
            if ([1,4,6,7,8,9].includes(Number(cat_user_type_id))) {
                let accion = (active == "true") ? 'remover':'añadir'
                Swal.fire({
                    title: `¿Desea ${accion} este rol del usuario?`,
                    //text: "Esta acción no se puede revertir!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No!',
                    confirmButtonText: `Si, ${accion}!`
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        if(active == "true"){
                            await get(location.origin+`/consultaexterna/user/paciente/removeRol/${user_id}/${rol}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = false
                                e.target.parentNode.dataset['active'] = false
                                e.target.classList.remove("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.remove("text-primary")
                            }
                            Swal.fire(
                                'Rol removido!',
                            )
                        }else{
                            await get(location.origin+`/consultaexterna/user/paciente/addRol/${user_id}/${rol}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = true
                                e.target.parentNode.dataset['active'] = true
                                e.target.classList.add("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.add("text-primary")
                            }
                            Swal.fire(
                                'Rol añadido!',
                            )
                        }
                    }
                })
            }else{
                let accion = (active == "true") ? 'remover':'añadir'
                Swal.fire({
                    title: `¿Desea ${accion} este rol del usuario?`,
                    //text: "Esta acción no se puede revertir!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No!',
                    confirmButtonText: `Si, ${accion}!`
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        if(active == "true"){
                            await get(location.origin+`/consultaexterna/user/medico/home/removeRol/${user_id}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = false
                                e.target.parentNode.dataset['active'] = false
                                e.target.classList.remove("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.remove("text-primary")
                            }
                            Swal.fire(
                                'Rol removido!',
                            )
                        }else{
                            await get(location.origin+`/consultaexterna/user/medico/home/addRol/${user_id}`)
                            if(e.target.tagName=="I"){
                                e.target.dataset['active'] = true
                                e.target.parentNode.dataset['active'] = true
                                e.target.classList.add("text-primary")
                            }else{
                                e.target.querySelector("i").parentNode.dataset['active'] = false
                                e.target.querySelector("i").dataset['active'] = false
                                e.target.querySelector("i").classList.add("text-primary")
                            }
                            Swal.fire(
                                'Rol añadido!',
                            )
                        }
                    }
                })
            }
        }
        if ( e.target.classList.contains("btn-exonerado-update") ) {

            let {
                exonerado,
                id
            } = e.target.dataset
            await Componentpaciente.exonerado_update(id,exonerado)

        }

    })

    //AGENDAMIENTO
    //CLICK
    d.addEventListener("click",async function(e){
        //console.log(e.target)

        if (e.target.matches(".agenda_month")) {
            Componentagenda.handle_agenda_month(e)
        }
        if (e.target.matches(".input-semana")) {
            Componentagenda.handle_agenda_semana(e)
        }
        if (e.target.matches(".agenda-dia")) {
            Componentagenda.handle_agenda_dia(e)
        }
        if (e.target.matches(".agenda_turno")) {
            Componentagenda.handle_agenda_turno(e)
        }
        if (e.target.matches(".dia-horario")) {
            Componentagenda.handle_agenda_dia_horario(e)
        }
        if (e.target.matches("#todo_el_anio")) {
            Componentagenda.handle_todo_el_anio(e.target.checked)
        }
        if (e.target.matches(".switch-semana")) {

            Componentagenda.handle_switch_semana(e)
        }
        if (e.target.matches("#todos_los_dias")) {

            Componentagenda.handle_todos_los_dias(e)
        }
        if (e.target.classList.contains("configurar-horas")) {
            Componentagenda.handle_configurar_horas(e)
        }
        if (e.target.matches(".grupo_turno_dia")) {
            d.querySelectorAll(`#container_dias input[type='radio']:checked`).forEach($input=>{
                let {dia_number,dia_name} = $input.dataset
                    d.querySelector(`input[name='agenda_hour_${dia_number}'][value='${e.target.value}']`).checked= true
                    let {total_pacientes_por_horas,turno_name,visibilidad,hours} = useState['formAgendaCreate']["turno"][dia_number]
                        day_turno_update(
                            [dia_name],
                            turno_name,
                            total_pacientes_por_horas,
                            hours,
                            visibilidad
                        )

                   // container_horas(useState['formAgendaCreate']["turno"][dia_name],dia)
            })
            //handle_resultset()
            console.log(useState['formAgendaCreate'])
        }
        if (e.target.matches("#pills-crear-agenda-tab")) {
            let f = new Date();
                d.querySelector(".fecha-hoy").textContent= fechaHoy(f)

                Componentagenda.turno_init()
                Componentagenda.mes_init()
                Componentagenda.container_meses()
                Componentagenda.container_dias()
                Componentagenda.handle_resultset()
                Componentagenda.activarCalendario()
                Componentagenda.handle_datepiker()

                console.log(useState['formAgendaCreate'])
        }
        if (e.target.matches("#submitAgendaCreate")) {
            let meses = useState['formAgendaCreate']['agenda_month']

                if ( d.querySelector("#centro_salud_id").value == "" ) {
                    Toast.fire({
                        icon: "warning",
                        title: "Debe seleccionar un centro de salud",
                        //text: nacionalidad.val() + cedula.val() + message['message'],
                        didClose: () => {
                            setTimeout(() =>  { d.querySelector(`select[name='centro_salud_id']`).focus();}, 110);
                        }
                    })
                    d.querySelector(`select[name='centro_salud_id']`).focus()

                    return false
                }
                if ( d.querySelector("#cat_especialidad_id").value == "" ) {
                    Toast.fire({
                        icon: "warning",
                        title: "Debe seleccionar una especialidad",
                        //text: nacionalidad.val() + cedula.val() + message['message'],
                        didClose: () => {
                            setTimeout(() =>  { d.querySelector(`select[name='cat_especialidad_id']`).focus();}, 110);
                        }
                    })
                    d.querySelector(`select[name='cat_especialidad_id']`).focus()

                    return false
                }
                if ( meses.length === 0 ) {
                    Toast.fire({
                        icon: "warning",
                        title: "Debe seleccionar al menos un mes.",
                        //text: nacionalidad.val() + cedula.val() + message['message'],
                        didClose: () => {
                            setTimeout(() =>  { d.querySelector(`input[name='agenda_month_0']`).focus();}, 110);
                        }
                    })
                    d.querySelector(`input[name='agenda_month_0']`).focus()

                    return false
                }
                meses.forEach(async (mes,key1)=>{

                    let semanas = mes['weeks']

                        if ( Object.values(semanas).length === 0 ) {
                            useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].filter((x,key2)=>key2!==key1)
                            //alert("Debe seleccionar al menos una semana del mes seleccionado.")
                            Toast.fire({
                                icon: "warning",
                                title: "Debe seleccionar al menos una semana del mes seleccionado.",
                                //text: nacionalidad.val() + cedula.val() + message['message'],

                            })
                            return false
                        }
                    let contar_dias = Object.values(semanas).every(value => value.length === 0);
                        if ( contar_dias ) {
                            Toast.fire({
                                icon: "warning",
                                title: "Debe seleccionar al menos un dia de la semana.",
                                //text: nacionalidad.val() + cedula.val() + message['message'],
                                didClose: () => {
                                    setTimeout(() =>  { d.querySelector(`#agenda_day_week_1`).focus();}, 110);
                                }
                            })

                            d.querySelector(`#agenda_day_week_1`).focus()
                            return false
                        }
                        // REGISTRAR
                        Swal.fire({
                            icon: "warning",
                            title: "Atención",
                            text:"¿Quieres guardar la agenda?",

                            showCancelButton: true,
                            confirmButtonText: `Si, guardar`,
                            cancelButtonText: `No, Aún no`,

                        }).then(async (result) => {
                            if (result.isConfirmed) {

                                let resultset = await Componentagenda.store()
                                 console.log(resultset)
                                let index = useState['medicos'].findIndex(x=>equalsInt(x['user_id'],resultset['user_id_medico']))

                                let existeAgenda = useState['medicos'][index]['agendas'].some(x=>equalsInt(x['agenda_id'],resultset['agenda_id']))
                                    console.log("existeAgenda",existeAgenda)
                                    if (existeAgenda ) {
                                        let indexAgenda = useState['medicos'][index]['agendas'].findIndex(x=>equalsInt(x['agenda_id'],resultset['agenda_id']))
                                            useState['medicos'][index]['agendas'][indexAgenda]= resultset
                                    }else{
                                        useState['medicos'][index]['agendas'].push(resultset)
                                    }
                                    console.log("Agendas del médico",useState['medicos'][index]['agendas'])
                                    Toast.fire({
                                        icon: "success",
                                        title: "Agenda guardada correctamente.",
                                        text: "",
                                        didClose: () => {
                                            setTimeout(() =>  { }, 110);
                                        }
                                    })
                                    Componentagenda.mis_agendas()



                                    Toast.fire({
                                        icon: "success",
                                        title: "Agenda guardada correctamente.",
                                        text: "",
                                        didClose: () => {
                                            setTimeout(() =>  { }, 110);
                                        }
                                    })
                                    Componentagenda.mis_agendas()

                            }
                        })


                })


        }
        if (e.target.matches(".agenda-destroy")) {

            //agenda_edit(e.target)
            Swal.fire({
                icon: "warning",
                title: "¿Quieres eliminar esta agenda?",
                text:"Eliminar esta agenda no elimina las citas ya creadas.",
                showCancelButton: true,
                confirmButtonText: `Si, eliminar`,
                cancelButtonText: `No, aún no`,

            }).then(async (result) => {
                if (result.isConfirmed) {
                    let {agenda_id,user_id_medico} = e.target.dataset
                        d.querySelector(".overlay").classList.remove("d-none")
                    let result = await get(location.origin+`/consultaexterna/user/medico/agenda/destroy/${agenda_id}`)
                        d.querySelector(".overlay").classList.add("d-none")


                    /* let index = useState['medicos'].findIndex(medico=>equalsInt(medico['user_id'],user_id_medico))
                        console.log("user_id_medico: " + user_id_medico)
                        console.log("index: " + index)
                        useState['medicos'][index]['agendas'] = useState['medicos'][index]['agendas'].filter(agenda=>Number(agenda['agenda_id']) !== Number(agenda_id))
                        console.log(useState['medicos'][index]['agendas']) */


                        let index = useState['medicos'].findIndex(medico=>equalsInt(medico['user_id'],user_id_medico))
                        console.log("user_id_medico: " + user_id_medico)
                        console.log("index: " + index)
                        useState['medicos'][index]['agendas'] = useState['medicos'][index]['agendas'].filter(agenda=>Number(agenda['agenda_id']) !== Number(agenda_id))


                        console.log(useState['medicos'][index]['especialidad'])



                        Componentagenda.mis_agendas()

                    Toast.fire({
                        icon: "success",
                        title: "Agenda eliminada correctamente.",
                        text: "",
                        didClose: () => {
                            setTimeout(() =>  { }, 110);
                        }
                    })

                }
            })
        }
    })
    //CHANGE
    d.addEventListener("change",function(e){
        if (
            e.target.matches(`select[name='pacientes_por_horas']`)
        ) {
            let total_pacientes_por_horas = Number(e.target.value)
            let visibilidad = d.querySelector("#visibilidad").value
            let {turno,dia_number,dia_name} = e.target.dataset
                useState['formAgendaCreate']['turno'][dia_number]['total_pacientes_por_horas'] = total_pacientes_por_horas
                useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = visibilidad
                useState['formAgendaCreate']['turno'][dia_number]['hours'] = Componentagenda.horas_generate(turno,total_pacientes_por_horas,visibilidad)

                Componentagenda.container_horas(dia_number,dia_name)

            console.log(useState['formAgendaCreate'])
        }
        if (
            e.target.matches("select[name='visibilidad']")
        ) {

            let visibilidad = d.querySelector("#visibilidad").value
            let {turno,dia_number,dia_name} = e.target.dataset
            let {hours,total_pacientes_por_horas} = useState['formAgendaCreate']["turno"][dia_number]
            let horas_privadas = hours.filter(hour=>hour['visibilidad']==="privada").map(hour=>hour['hora'])
                useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = horas_privadas.length > 0 ? 'personalizado':visibilidad
                useState['formAgendaCreate']['turno'][dia_number]['hours'] = Componentagenda.horas_generate(turno,total_pacientes_por_horas,visibilidad,horas_privadas)


                useState['formAgendaCreate']['turno'][dia_number]['total_pacientes_por_horas'] = total_pacientes_por_horas
                useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = visibilidad
                useState['formAgendaCreate']['turno'][dia_number]['hours'] = Componentagenda.horas_generate(turno,total_pacientes_por_horas,visibilidad)
                Componentagenda.container_horas(dia_number,dia_name)
                console.log(useState['formAgendaCreate'])
        }
        if (
            e.target.matches(`select[name='centro_salud_id']`)
        ) {
            if (!is_empty(e.target.value)) {
                useState['formAgendaCreate'][e.target.name] = Number(e.target.value)
            } else {
                useState['formAgendaCreate'][e.target.name] = null
            }
            console.log(useState['formAgendaCreate'])

            Componentagenda.mis_agendas()
            Componentagenda.handle_cat_especialidad()
        }
        if (
            e.target.matches("select[name='cat_especialidad_id']")
        ) {
            if (!is_empty(e.target.value)) {
                useState['formAgendaCreate'][e.target.name] = Number(e.target.value)
            } else {
                useState['formAgendaCreate'][e.target.name] = null
            }
            let $model = d.querySelector(`#App`)

            Componentagenda.mis_agendas()
            console.log(useState['formAgendaCreate'])
        }

        if (
            e.target.matches("input[name='agenda_desde']") ||
            e.target.matches("input[name='agenda_hasta']")
        ) {
            console.log(e.target.name)
            useState['formAgendaCreate'][e.target.name] = e.target.value
            console.log(useState['formAgendaCreate'])
        }
    })
}
let config_menu_option = ($item, index) => {
    let $menu_option = document.getElementById('artefacto_0047').content.cloneNode(true)
        $menu_option.querySelector(".card-title").innerHTML = $item['title']
        $menu_option.querySelector(".jumbotron").classList.add($item['bg-color'])
        $menu_option.querySelector(".card-title").classList.add($item['title-text-color'])
        $menu_option.querySelector(".card-icon").classList.add($item['icon-color'])
        $item['size'].forEach(x => {
            $menu_option.querySelector(".card-option").classList.add(x)
        })
        $item['icon'].forEach(x => {
            $menu_option.querySelector(".card-icon").classList.add(x)
        })
        $menu_option.querySelectorAll(".card-option").forEach(x => {
            x.dataset['level'] = $item['level']
            x.dataset['index'] = index
        })
        $menu_option.querySelector(".card-content").innerHTML = $item['content'](index)
    /*
    let totales = $item['totales']()

    $menu_option.querySelector(".card-total-parcial-1").textContent = totales['pacientes_hoy']()
    $menu_option.querySelector(".card-total-parcial-2").textContent = totales['atendidos_hoy']()
    $menu_option.querySelector(".card-total-parcial-3").textContent = totales['acumulado_mes']()

    $menu_option.querySelector("li input").value = totales['meta_pacientes']()
    $menu_option.querySelector("li input").name = $item['name'] */


    return $menu_option
}

/*  {
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":`Agendas`,

    "icon":["pc-paciente"],
    "totales": function(){
        return useState['menu']['get_totales']( this.name )
    },
    "level":"level_1",
    "handle_option":function(){
        return false;
    }, //{"level":"level_2_1"},
    "content":function(index){
        let level = this['level']
        return  `
            <ul class="list-group">
                <li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Total
                    <span class="card-option card-total-parcial-1 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Agendas en el mes
                    <span class="card-option card-total-parcial-1 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Agendas hoy
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Agendas hoy en la Mañana
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Agendas hoy en la Tarde
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Agendas hoy todo el día
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>

                <!--<li data-level="${level}" data-index="${index}"
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Meta
                    <input type="text" class="form-control text-center"
                        style="display:inherit;width:100px;height: 1.4em; border:0;border-radius:20px"
                        value="0">
                </li>-->
            </ul>
        `;
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-6", "col-xl-6"],
    "title":"Citas Atendidas<br>por Centro de Salud",

    "icon":["pc-ambulatorio"],
    "totales": function(){
        return useState['menu']['get_totales']( this.name )
    },
    "level":"level_1",
    "handle_option":function(){
        return false;
    },
    "content":function(e){
        return `
            <ul class="list-group">
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Centro de Especialidades los Palos Grande (CELPG)
                    <span class="card-option card-total-parcial-1 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Ambulatorio Altamira
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    CEQ Viseteca
                    <span class="card-option card-total-parcial-3 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Ambulatorio Chacao Bello Campo
                    <span class="card-option card-total-parcial-3 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Ambulatorio Salud Chacao el bosque
                    <span class="card-option card-total-parcial-3 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Ambulatorio Chacao El Pedregal
                    <span class="card-option card-total-parcial-3 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Ambulatorio Salud Chacao Bucaral
                    <span class="card-option card-total-parcial-3 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Meta
                    <input type="text" class="form-control text-center"
                        style="display:inherit;width:100px;height: 1.4em; border:0;border-radius:20px"
                        value="0">
                </li>
            </ul>
        `;
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-6", "col-xl-6"],
    "title":"Citas",
    "name":"atencion_extrahospitalaria",
    "icon":["pc-solid_estetoscopio"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_1",
    "handle_option":function(){
        return false;
    },
    "content":function(e){
        return `
            <ul class="list-group">
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Total
                    <span class="card-option card-total-parcial-1 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Citas en el mes
                    <span class="card-option card-total-parcial-1 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Citas hoy
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Hombres
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Mujeres
                    <span class="card-option card-total-parcial-2 font-weight-bold h5 ml-4">000000</span>
                </li>
                <!-- <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Acumulado mes
                    <span class="card-option card-total-parcial-3 font-weight-bold h5 ml-4">000000</span>
                </li>
                <li
                    class="card-option bg-transparent border-0 p-0 list-group-item d-flex justify-content-between align-items-center">
                    Meta del mes
                    <input type="text" class="form-control text-center"
                        style="display:inherit;width:100px;height: 1.4em; border:0;border-radius:20px"
                        value="0">
                </li> -->
            </ul>
            <h4 class="text-center text-primary">Próximas Citas</h4>
            <ul class="users-list clearfix">
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user1-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Alexander Pierce</a>
            <span class="users-list-date">Today</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user8-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Norman</a>
            <span class="users-list-date">Yesterday</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user7-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Jane</a>
            <span class="users-list-date">12 Jan</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user6-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">John</a>
            <span class="users-list-date">12 Jan</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Alexander</a>
            <span class="users-list-date">13 Jan</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user5-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Sarah</a>
            <span class="users-list-date">14 Jan</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user4-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Nora</a>
            <span class="users-list-date">15 Jan</span>
            </li>
            <li>
            <img src="/AdminLTE-3.2.0/dist/img/user3-128x128.jpg" alt="User Image" style="width:3em;height:3em;">
            <a class="users-list-name" href="#">Nadia</a>
            <span class="users-list-date">15 Jan</span>
            </li>
            </ul>

        `;
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-6", "col-xl-6"],
    "title":"Citas",
    "name":"atencion_extrahospitalaria",
    "icon":["pc-solid_estetoscopio"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_1",
    "handle_option":function(){
        return false;
    },
    "content":function(e){
        return `
            <div class="table-responsive">
                <table class="table m-0 text-primary">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item</th>
                            <th>Status</th>
                            <th>Popularity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge badge-success">Shipped</span></td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge badge-danger">Delivered</span></td>
                            <td>
                                <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge badge-info">Processing</span></td>
                            <td>
                                <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge badge-danger">Delivered</span></td>
                            <td>
                                <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge badge-success">Shipped</span></td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }
},


/*   "level_2_1":[
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":`Emergencia`,
    "name":"grupo_emergencia",
    "icon":["pc-preconsulta"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":{"level":"level_2_1_1"},
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":false,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":"Área<br>Quirúrgica",
    "name":"grupo_aq",
    "icon":["fa-solid","fa-hospital"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":function(e){
        alert("Area no disponible")
    }
    ,
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":"Consultas",
    "name":"grupo_consultas",
    "icon":["pc-solid_estetoscopio"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":function(e){
        alert("Area no disponible")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":"Atención<br>Domiciliaria",
    "name":"ad",
    "icon":["pc-light-homecare"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":function(e){
        alert("Area no disponible")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":"Traslados",
    "name":"traslados",
    "icon":["pc-ambulance"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":function(e){
        alert("Area no disponible")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":false,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":"Hospitalización",
    "name":"grupo_hospitalizacion",
    "icon":["fa-solid","fa-hospital"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":function(e){
        alert("Area no disponible")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":false,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":"UTI",
    "name":"grupo_uti",
    "icon":["fa-solid","fa-hospital"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1",
    "handle_option":function(e){
        alert("Area no disponible")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
],
"level_2_1_1":[
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":`Emergencia<br>Adultos`,
    "name":"ea",
    "icon":["pc-preconsulta"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1_1",
    "handle_option":function(e){
        $('#pills-tab a[href="#pills-EA"]').tab('show')
        Component.menu( "ea" )
        $("#fullscreen").modal("hide")

    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":`Emergencia<br>COVID`,
    "name":"carpas",
    "icon":["pc-preconsulta"],
    "totales": function(){
    return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1_1",
    "handle_option":function(e){
        $('#pills-tab a[href="#pills-Carpas"]').tab('show')
        Component.menu( "carpas" )
        $("#fullscreen").modal("hide")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
{
    "active":true,
    "size":["col-12", "col-sm-12", "col-md-12", "col-lg-4", "col-xl-4"],
    "title":`Emergencia<br>Pediátrica`,
    "name":"ep",
    "icon":["pc-preconsulta"],
    "totales": function(){
        return useState['menu']['get_totales']( this.name )
    },
    "level":"level_2_1_1",
    "handle_option":function(e){
        $('#pills-tab a[href="#pills-EP"]').tab('show')
        Component.menu( "ep" )
        $("#fullscreen").modal("hide")
    },
    "content":function(index){
        let level = this['level']
        return  `

        `
    }
},
],
}*/

