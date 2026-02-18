import { $qs, clone } from '../../helpers/helpers.js?version = 0.1'
import * as ComponentPaciente from '../paciente/paciente.js?version = 0.1'
import * as ComponentMedicoHome from '../medico/medico_home.js?version = 0.1'

let onChange_agenda_id;
let final_hora;
let final_dia;
let handle_calendario = (medico_id) => {
    //console.log(medico_id)
    $('#calendar').datepicker('destroy')
    $('#calendar').empty()
    let fecha = new Date()
    let feriados = [
            {"year":fecha.getFullYear(), "month":1, "day":1, "description":`Año nuevo`},
            {"year":fecha.getFullYear(), "month":2, "day":20, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":2, "day":21, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":4, "day":6, "description":`Jueves Santo`},
            {"year":fecha.getFullYear(), "month":4, "day":7, "description":`Viernes Santo`},
            {"year":fecha.getFullYear(), "month":4, "day":19, "description":`Declaración de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":5, "day":1, "description":`Día del trabajador`},
            {"year":fecha.getFullYear(), "month":6, "day":24, "description":`Batalla de Carabobo`},
            {"year":fecha.getFullYear(), "month":7, "day":5, "description":`Día de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":7, "day":24, "description":`Natalicio de Simón Bolívar`},
            {"year":fecha.getFullYear(), "month":10, "day":12, "description":`Día de la Resistencia Indigena`},
            {"year":fecha.getFullYear(), "month":12, "day":24, "description":`Vispera de navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":25, "description":`Navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":31, "description":`Fiesta de fín de año`},
        ]
         console.log(feriados);
    let medico_agenda = useState['medicos_agenda'].filter(x => equalsInt(x.user_id_medico, medico_id) && equalsInt( x.cat_especialidad_id , d.querySelector("select[name='cat_especialidad_id']").value ) ) //useState.get_medico_agenda(medico_id)
        console.log("medico_agenda-->", medico_agenda)
    let { agenda, agenda_id } = first(medico_agenda)
        onChange_agenda_id = agenda_id
    let mesesDisponibles = agenda.mes_del_anio
    let diasDisponible = agenda.dias_del_mes
    if (is_undefined(mesesDisponibles)) {
        return false
    }
    $('#calendar').datepicker({
        "language": "es",
        beforeShowYear: function (date) {
            if (date.getFullYear() !== new Date().getFullYear()) {
                return false;
            }
        },
        beforeShowMonth: function (date) {
            if (
                !mesesDisponibles.includes(date.getMonth() + 1) &&
                date.getFullYear() === new Date().getFullYear()
            ) {
                return false;
            }
        },
        beforeShowDay: function (date) {
            // console.log("-->>",fechaAMD(date))
            let f = new Date()
            let fActual = new Date(f.getFullYear(), (f.getMonth() + 1), date.getDate())

            let feriados_mes =  feriados
                                .find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                console.log("feriados_mes",feriados_mes)
                if (!is_undefined(feriados_mes)) {
                    return {
                        tooltip: `Feriado: ${feriados_mes['description']}`,
                        classes: 'disabled bg-info'
                    };
                }



                if (
                    fActual.getTime() >= f.getTime() &&
                    (date.getMonth() + 1) >= (f.getMonth() + 1) &&
                    diasDisponible.includes(fechaAMD(date))

                ) {

                    return {
                        tooltip: `Dia ${date.getDate()} de ${(meses(date.getMonth()))} disponible`,
                        classes: 'today'
                    };
                } else {
                    return {
                        tooltip: `No existen horas disponibles este dia`,
                        classes: 'disabled',
                    };
                }
        },
    });

}
let get_medico_agenda_horas = (agenda_id,dia_del_mes)=>{
    let model = useState['medicos'].find(agenda => equalsInt( agenda.agenda_id , agenda_id ) )['agenda']
    console.log(model);
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
}
let formValidate = async (e)=>{
    console.log(e.target)
    let $App= $qs(`${useState['tab']}`)
    let cedula = $App.querySelector(`${useState['tab']} input[name='cedula']`).value
    if (e.target.matches("input[name='cedula']")) {
        d.querySelector("#tab_app .overlay").classList.remove("d-none")
        let user = useState['users'].find(x=>equalsInt(x['cedula'],cedula))
            //console.log("user",user)
            if (is_undefined(user)) {
                useState['search_resultset'] = await get(`/consultaexterna/user/profile/searchUser/${cedula}`)

                if ( !equalsInt(useState['search_resultset'].length,0) ) {
                    user = useState['search_resultset'].find(x=>equalsInt(x['cedula'],cedula))
                    if (!is_undefined( user )) {
                        useState['users'].push( user )
                        //console.log(useState['users'])
                    }
                }

            }


        let existe_cedula = useState['users'].filter(x => equalsInt(x['cedula'] , cedula ))

            if (!is_empty(cedula) && existe_cedula.length > 0) {

                useState['formCreateCita']['user_id_paciente'] = first(existe_cedula)['user_id']
                $App.querySelector(`input[name='user_id_paciente']`).value = parseInt( first(existe_cedula)['user_id'] )
                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-1`).classList.add("bg-success")
                $App.querySelector(`input[name='cedula']`).classList.remove("is-invalid")
                $App.querySelector(`input[name='cedula']`).classList.add("is-valid")
                d.querySelector("#tab_app .overlay").classList.add("d-none")
                console.log( useState['formCreateCita'] )
            } else {
                useState['formCreateCita'] = {
                    "user_id_paciente"    : "",
                    "centro_salud_id"     : "",
                    "cita_dia"            : "",
                    "cita_hora"           : "",
                    "user_id_medico"      : "",
                    "cita_motivo"         : "",
                    "enfermedad_actual"   : "",
                    "cat_user_cita_status_id": 1,
                    "condicion_administrativa": "Particular",
                    "condicion_descripcion": "",
                    "user_id_autorizacion": null,
                    "cat_seguro_id": null,
                    "poliza_numero": null,
                }

                $App.querySelector(`input[name='user_id_paciente']`).value = ""
                $App.querySelector(`select[name='centro_salud_id']`).value = ""
                $App.querySelector(`select[name='cat_especialidad_id']`).value = ""
                $App.querySelector(`select[name='user_id_medico']`).value = ""
                $App.querySelector(`input[name='cita_dia']`).value = ""
                $App.querySelector(`input[name='cita_hora']`).value = ""
                //$App.querySelector(`input[name='condicion_administrativa][value='Particular']`).checked = true
                $App.querySelector(`input[name='condicion_descripcion']`).value = ""
                $App.querySelector(`textarea[name='cita_motivo']`).value = ""
                $App.querySelector(`#pills-am ul.nav`).innerHTML = null
                $App.querySelector(`#pills-pm ul.nav`).innerHTML = null

                $('#calendar').datepicker('destroy')
                $('#calendar').empty()

                $App.querySelector(`input[name='cedula']`).classList.add("is-invalid")
                $App.querySelector(`input[name='cedula']`).classList.remove("is-valid")

                $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid","is-invalid")
                $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
                $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
                $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")


                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-success")
                $App.querySelector(`.item-1`).classList.add("bg-danger")

                $App.querySelector(`.item-2`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-2`).classList.add("bg-primary")

                $App.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-3`).classList.add("bg-primary")

                $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-4`).classList.add("bg-primary")

                $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-5`).classList.add("bg-primary")

                $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-6`).classList.add("bg-primary")

                $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-7`).classList.add("bg-primary")
                d.querySelector("#tab_app .overlay").classList.add("d-none")
                Swal.fire({
                    title: 'Paciente no encontrado',
                    text: "El paciente con este documento de identidad no se encuentra registrado, ¿Desea registrarlo?",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--success)',
                    cancelButtonColor: 'var(--info)',
                    confirmButtonText: 'Escribiré otra cédula!',
                    cancelButtonText: 'Si, registrarlo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //$App.querySelector(`input[name='cedula']`).classList.remove("is-invalid", "is-valid")
                        $App.querySelector(`input[name='cedula']`).value = ""
                        $App.querySelector(`input[name='cedula']`).focus()
                    } else {
                        localStorage.setItem('component_cita_cedula',cedula);
                        ComponentPaciente.create()
                    }
                })
                return false
            }
    }
    let centro_salud_id = $App.querySelector(`select[name='centro_salud_id']`).value
    if (e.target.matches("select[name='centro_salud_id']")) {
        if ( !is_empty(centro_salud_id) ) {
            if (is_empty(cedula) ) {
                $App.querySelector(`input[name='cedula']`).focus()
                $App.querySelector(`select[name='centro_salud_id']`).value=""
                return false
            }
            let centro_salud_especialidades = first(useState['centro_salud'].filter(centro_salud=> equalsInt(centro_salud.id , centro_salud_id) ))['especialidades']

                $App.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
                $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
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
                        let agenda = useState['medicos_agenda'].filter(z => equalsInt(z.centro_salud_id, centro_salud_id) && equalsInt(z.cat_especialidad_id, especialidad.cat_especialidad_id)  )
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

                $App.querySelector(`select[name='cat_especialidad_id']`).append($fragment)

                $App.querySelector(`.notification-especialidad b`).textContent= centro_salud_especialidades.length
                if (centro_salud_especialidades.length > 0) {
                    $App.querySelector(`.notification-especialidad`).classList.remove("d-none")
                }else{
                    $App.querySelector(`.notification-especialidad`).classList.add("d-none")
                }
                useState['formCreateCita']['centro_salud_id'] = parseInt( centro_salud_id )

                $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-2`).classList.add("bg-success")
                $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
                $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
        }else{


            useState['formCreateCita']['centro_salud_id'] = ""
            $App.querySelector(`select[name='centro_salud_id']`).value = ""
            $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-2`).classList.add("bg-danger")
            $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-invalid")
            $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid")

            $App.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
            $App.querySelector(`input[name='cita_dia']`).value = ""
            $App.querySelector(`input[name='cita_hora']`).value = ""
            $App.querySelector(`textarea[name='cita_motivo']`).value = ""
            $App.querySelector(`#pills-am`).innerHTML = null
            $App.querySelector(`#pills-pm`).innerHTML = null


            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")

            $App.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-3`).classList.add("bg-primary")

            $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-primary")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            return false
        }
    }
    let cat_especialidad_id = $App.querySelector(`select[name='cat_especialidad_id']`).value
    if (e.target.matches("select[name='cat_especialidad_id']")) {
        if ( !is_empty(cat_especialidad_id) ) {


            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null

            //**** */
            let agenda = useState['medicos_agenda'].filter(x => equalsInt(x.centro_salud_id, centro_salud_id) && equalsInt(x.cat_especialidad_id,e.target.value)  )
            let agenda_especialidad_id = agenda.map(x => x.cat_especialidad_id )
            let agenda_medicos_id = agenda.map(x => x.user_id_medico )

            let medicos_resultset =[]
                agenda_medicos_id.forEach((medico_id,key)=>{
                    let medico =useState['medicos'].filter(medico => equalsInt(medico.user_id,medico_id))
                        //medicos_resultset[ key ] = first( medico )
                        if (!is_null( first( medico ) ) ) {
                            medicos_resultset[ key ] =  first( medico )
                        }
                })


            let $fragment = document.createDocumentFragment()
            let $option = document.createElement("option")
                $option.value = ""
                $option.textContent = "Seleccione"
                $fragment.appendChild($option)
                if (medicos_resultset.length > 0) {
                    medicos_resultset.forEach(medico=>{
                        $option = document.createElement("option")
                        $option.value =medico.user_id
                        $option.textContent = `${medico.medico}`
                        $fragment.appendChild($option)
                    })
                } else {
                    $option.textContent ="Sin médicos asociados."
                    $fragment.appendChild($option)
                }

                $App.querySelector(` select[name='user_id_medico']`).append($fragment)

                $App.querySelector(`.notification-medicos b`).textContent= medicos_resultset.length
                if (medicos_resultset.length > 0) {
                    $App.querySelector(`.notification-medicos`).classList.remove("d-none")
                }else{
                    $App.querySelector(`.notification-medicos`).classList.add("d-none")
                }

            useState['formCreateCita']['cat_especialidad_id'] = parseInt( cat_especialidad_id )
            //$App.querySelector(`select[name='cat_especialidad_id']`).value = cat_especialidad_id
            $App.querySelector(`.item-3`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-3`).classList.add("bg-success")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-invalid")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.add("is-valid")
            //console.log( useState['formCreateCita'] )
        }else{
            useState['formCreateCita']['cat_especialidad_id'] = ""
            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
            //$App.querySelector(`select[name='user_id_medico']`).value = ""
            $App.querySelector(`.item-3`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-3`).classList.add("bg-danger")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.add("is-invalid")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid")
            //$App.querySelector(`select[name='user_id_medico']`).classList.add("is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")

            $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-primary")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            return false
        }
    }
    if (e.target.matches("select[name='user_id_medico']")) {
        let user_id_medico = $App.querySelector(`select[name='user_id_medico']`).value
        if ( !is_empty(user_id_medico) ) {

            useState['formCreateCita']['user_id_medico'] = parseInt( user_id_medico )
            handle_calendario(user_id_medico)
            //$App.querySelector(` select[name='user_id_medico']`).value = parseInt( user_id_medico )
            $App.querySelector(`.item-4`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-4`).classList.add("bg-success")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.add("is-valid")
        // console.log( useState['formCreateCita'] )
        }else{
            useState['formCreateCita']['user_id_medico'] = ""
            $App.querySelector(`select[name='user_id_medico']`).value = ""
            $App.querySelector(`.item-4`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-danger")
            $App.querySelector(`select[name='user_id_medico']`).classList.add("is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            $App.getElementById("mensaje_dia_seleccionado").innerHTML = `Solo los días resaltados están disponibles.`
            $('#calendar').datepicker('destroy')
            $('#calendar').empty()
            return false
        }

    }
    let cita_motivo = $App.querySelector(`textarea[name='cita_motivo']`).value
    if (e.target.matches("textarea[name='cita_motivo']")) {
        if ( !is_empty(cita_motivo) ) {
            useState['formCreateCita']['cita_motivo'] = cita_motivo
            $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-7`).classList.add("bg-success")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-valid")
            //console.log( useState['formCreateCita'] )
        } else {
            useState['formCreateCita']['cita_motivo'] = ""
            $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-danger")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid")
            //console.log( useState['formCreateCita'] )
        }




    }
    if (e.target.matches("input[name='condicion_descripcion']")) {
        useState['formCreateCita']['condicion_descripcion'] = e.target.value
        console.log( useState['formCreateCita'] )
    }
    if (e.target.matches("select[name='user_id_autorizacion']")) {
        useState['formCreateCita']['user_id_autorizacion'] = e.target.value
        console.log( useState['formCreateCita'] )
    }
    if (e.target.matches("input[name='imforme_general']")) {
        useState['formCreateCita']['file'] = d.querySelector("#imforme_general").files,
        console.log( useState['formCreateCita'] )
    }
    return true
}
let formCreateValidate = ()=>{
    let input = d.querySelector(`${useState['tab']} input[name='cedula']`)
            if (is_empty( input.value )) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: "Escriba una cédula de identidad valida.",
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${useState['tab']} select[name='centro_salud_id']`)
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
        input = d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`)
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
        input = d.querySelector(`${useState['tab']} select[name='user_id_medico']`)
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
        input = d.querySelector(`${useState['tab']} input[name='cita_dia']`)
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
        input = d.querySelector(`${useState['tab']} input[name='cita_hora']`)
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
        return true
}
/* let updateCitasOne = async (user_id) => {
    let resulset = await get(`/user/medico/home/citas/update/one/${user_id}`)
        let index = ""
            Object.assign(useState["citas"],first(resulset['citas']))

            if (resulset['tarjetasoychacao'].length > 0) {
                Object.assign(useState["tarjetasoychacao"],first(resulset['tarjetasoychacao']))
            }

            if (resulset['user_condicion_medica'].length > 0) {
                Object.assign(useState["user_condicion_medica"],first(resulset['user_condicion_medica']))
            }

            if (resulset['user_medicamento'].length > 0) {
                Object.assign(useState["user_medicamento"],first(resulset['user_medicamento']))
            }

            if (resulset['user_antecedente'].length > 0) {
                Object.assign(useState["user_antecedente"],first(resulset['user_antecedente']))
            }

            if (resulset['user_alergias'].length > 0) {
                Object.assign(useState["user_alergias"],first(resulset['user_alergias']))
            }

            if (resulset['users'].length > 0) {
                index = useState["users"].findIndex(x=>equalsInt(x["user_id_paciente"],user_id))
                useState["users"][index]= first(resulset["users"])
            }
            if (resulset['pacientes'].length > 0) {
                index = useState["pacientes"].findIndex(x=>equalsInt(x["user_id"],user_id))
                useState["pacientes"][index]= first(resulset["pacientes"])
            }

            await updateTotales()
            console.log(useState)



} */
export let updateCitas = async (new_cita) => {
    let resulset = await get(`/consultaexterna/user/medico/home/citas/update/one/${new_cita.id}`)

        //console.log(resulset)
        //let pacientes_id_faltantes = []
        //let citaIndex = useState['users'].findIndex(x=>equalsInt(x['user_id'], new_cita.user_id_paciente))
        //let searchPaciente = useState['users'].find(x=>equalsInt(x['user_id'], new_cita.user_id_paciente))
      /*   if ( is_undefined( searchPaciente ) ) {
            pacientes_id_faltantes.push(new_cita.user_id_paciente)
            let formData = new FormData();
                formData.append("pacientes_id", pacientes_id_faltantes )
                formData.append("_token", d.querySelector("#_token").value)
            let result = await post(location.origin+"/user/userCitaAll",formData)
                if (result.length === 1) {
                    useState['users'].push( first(result))
                }else{
                    result.forEach(x=>{
                        useState['users'].push( x )
                    })
                }
        }else{

        } */



        useState["citas"].push( first(resulset.citas) );
        useState["citas"] = orderBy(useState["citas"],"user_cita_id","desc")
        console.log( useState["citas"])
        let items = [
            "user_condicion_medica",
            "user_medicamento",
            "user_antecedente",
            "user_alergias"
        ]

        for (const item of items) {
            console.log(item)
            if (resulset[ item ].length > 0) {
                resulset[ item ].forEach(x=>{
                    let existe = useState[ item ].filter(y => equalsInt(y.id,x.id ) )
                        if(existe.length == 0){
                            useState[ item ].push( x )
                        }
                })
            }
        }

        await ComponentMedicoHome.updateTotales()
}
/* let activarCalendario = ()=>{
    $('#calendar').datepicker('destroy')
    $('#calendar').empty();
    let fecha = new Date();

    let user_id_medico = d.querySelector(`select[name='user_id_medico']`).value;
        useState['formCreateCita']['user_id_medico'] = Number(user_id_medico)

    let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],user_id_medico))

        //console.log("agenda",agenda)

        onChange_agenda_id = agenda['agenda_id']
    let mesesDisponibles = agenda['agenda']['mes_del_anio']
    let diasDisponible = agenda['agenda']['dias_del_mes']
        //console.log("agenda",mesesDisponibles)
        if( is_undefined(mesesDisponibles) ){
            return false
        }


        $('#calendar').datepicker({
            "language": "es",
            "weekStart":0,
            beforeShowYear: function(date){
                if (date.getFullYear() !== new Date().getFullYear()) {
                    return false;
                }
            },
            beforeShowMonth: function(date){
                //console.log(mesesDisponibles,"---",(date.getMonth()+1));
                if (
                    !mesesDisponibles.includes(date.getMonth()+1) &&
                    date.getFullYear() === new Date().getFullYear()
                    ) {
                    return false;
                }
            },
            beforeShowDay: function(date){
                   //console.log("-->>",fechaAMD(date))
                let f = new Date()
                let fActual = new Date( f.getFullYear() , (f.getMonth()+1), date.getDate() )
                let feriados_mes =  feriados.find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                    //console.log("feriados_mes",feriados_mes)
                    if (!is_undefined(feriados_mes)) {
                        return {
                            tooltip: `Feriado: ${feriados_mes['description']}`,
                            classes: 'disabled bg-info'
                        };
                    }
                    if (!is_undefined(diasDisponible)) {
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
                    }else{
                        return {
                            tooltip: `No existen horas disponibles este dia`,
                            classes: 'disabled',
                            };
                        console.log('%chome.blade.php line:3192 diasDisponible', 'color: #007acc;', diasDisponible);
                    }


            },
        });

} */
let local_timestamps2=(date) =>{
    var hoy = new Date(date);

    return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
}
let activarCalendario = ()=>{
    //console.log(useState['formNuevaCita'])
    $('#calendar').datepicker('destroy')
    $('#calendar').empty();
    let fecha = new Date();


    let user_id_medico = d.querySelector(`select[name='user_id_medico']`).value;
        useState['formCreateCita']['user_id_medico'] = Number(user_id_medico)

        //console.log(useState['formNuevaCita'])
    let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],user_id_medico))['agenda']
        agenda = JSON.parse(agenda)
        //agenda = Array.from(agenda)
        console.log("agenda",agenda)

        onChange_agenda_id = agenda['agenda_id']

    //let mesesDisponibles = agenda['agenda']['mes_del_anio']
    let diasDisponible =  agenda.filter(x=>["publica","privada"].includes(x['visibilidad'])).map(x=>{
        let fecha = new Date(x['day']);
            return fecha.getFullYear() + "-" + String(fecha.getMonth() + 1).padStart(2, '0') + "-" + String(fecha.getDate()).padStart(2, '0') +" 00:00"
    })
        console.log("diasDisponible",diasDisponible)
        /* if( is_undefined(mesesDisponibles) ){
            return false
        } */


        $('#calendar').datepicker({
            "language": "es",
            "weekStart":0,
            beforeShowYear: function(date){
                if (date.getFullYear() !== new Date().getFullYear()) {
                    return false;
                }
            },
            beforeShowMonth: function(date){
                /* if (
                    !mesesDisponibles.includes(date.getMonth()+1) &&
                    date.getFullYear() === new Date().getFullYear()
                    ) {
                    return false;
                } */
            },
            beforeShowDay: function(date){
                // console.log("-->>",fechaAMD(date))
                let f = new Date()
                let fActual = new Date(f.getFullYear(), (f.getMonth() + 1), date.getDate())

                  //  console.log(fActual)
                let feriados_mes =  feriados
                                    .find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                    //console.log("feriados_mes",feriados_mes)
                    if (!is_undefined(feriados_mes)) {
                        return {
                            tooltip: `Feriado: ${feriados_mes['description']}`,
                            classes: 'disabled bg-info'
                        };
                    }



                    //console.log(local_timestamps2(date))
                    if (
                        fActual.getTime() >= f.getTime() &&
                        (date.getMonth() + 1) >= (f.getMonth() + 1) &&
                        diasDisponible.includes(local_timestamps2(date))

                    ) {

                        return {
                            tooltip: `Dia ${date.getDate()} de ${(meses(date.getMonth()))} disponible`,
                            classes: 'today'
                        };
                    } else {
                        return {
                            tooltip: `No existen horas disponibles este dia`,
                            classes: 'disabled',
                        };
                    }
            },
        });

}
let solicitud_cita_input_CEDULA = async ($App)=>{
    let cedula = $App.querySelector(`input[name='cedula']`).value
    let user = useState['users'].find(x=>equalsInt(x['cedula'],cedula))
        if (is_undefined(user)) {
            d.querySelector(".overlay").classList.remove("d-none")
            useState['search_resultset'] = await get(`/user/profile/searchUser/${cedula}`)
            d.querySelector(".overlay").classList.add("d-none")
            if ( !equalsInt(useState['search_resultset'].length,0) ) {
                user = useState['search_resultset'].find(x=>equalsInt(x['cedula'],cedula))
                if (!is_undefined( user )) {
                    useState['users'].push( user )
                    console.log(useState['users'])
                }
            }

        }


    let existe_cedula = useState['users'].filter(x => equalsInt(x['cedula'] , cedula ))

        if (!is_empty(cedula) && existe_cedula.length > 0) {

            useState['formCreateCita']['user_id_paciente'] = first(existe_cedula)['user_id']
          /*   $App.querySelector(`input[name='user_id_paciente']`).value = parseInt( first(existe_cedula)['user_id'] )
            $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-1`).classList.add("bg-success")
            $App.querySelector(`input[name='cedula']`).classList.remove("is-invalid")
            $App.querySelector(`input[name='cedula']`).classList.add("is-valid")
            d.querySelector("#tab_app .overlay").classList.add("d-none") */
            console.log( useState['formCreateCita'] )
        }
        else {
            useState['formCreateCita'] = {
                "user_id_paciente"    : "",
                "centro_salud_id"     : "",
                "cita_dia"            : "",
                "cita_hora"           : "",
                "user_id_medico"      : "",
                "cita_motivo"         : "",
                "enfermedad_actual"   : "",
                "cat_user_cita_status_id": 1,
                "condicion_administrativa": "Particular",
                "condicion_descripcion": "",
                "user_id_autorizacion": null,
                "cat_seguro_id": null,
                "poliza_numero": null,
            }

            /* $App.querySelector(`input[name='user_id_paciente']`).value = ""
            $App.querySelector(`select[name='centro_salud_id']`).value = ""
            $App.querySelector(`select[name='cat_especialidad_id']`).value = ""
            $App.querySelector(`select[name='user_id_medico']`).value = ""
            $App.querySelector(`input[name='cita_dia']`).value = ""
            $App.querySelector(`input[name='cita_hora']`).value = ""
            //$App.querySelector(`input[name='condicion_administrativa][value='Particular']`).checked = true
            $App.querySelector(`input[name='condicion_descripcion']`).value = ""
            $App.querySelector(`textarea[name='cita_motivo']`).value = ""
            $App.querySelector(`#pills-am ul.nav`).innerHTML = null
            $App.querySelector(`#pills-pm ul.nav`).innerHTML = null */

            $('#calendar').datepicker('destroy')
            $('#calendar').empty()

            /* $App.querySelector(`input[name='cedula']`).classList.add("is-invalid")
            $App.querySelector(`input[name='cedula']`).classList.remove("is-valid")

            $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")


            $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-1`).classList.add("bg-danger")

            $App.querySelector(`.item-2`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-2`).classList.add("bg-primary")

            $App.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-3`).classList.add("bg-primary")

            $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-primary")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            d.querySelector("#tab_app .overlay").classList.add("d-none") */
            Swal.fire({
                title: 'Paciente no encontrado',
                text: "El paciente con este documento de identidad no se encuentra registrado, ¿Desea registrarlo?",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--info)',
                confirmButtonText: 'Escribiré otra cédula!',
                cancelButtonText: 'Si, registrarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    //$App.querySelector(`input[name='cedula']`).classList.remove("is-invalid", "is-valid")
                    $App.querySelector(`input[name='cedula']`).value = ""
                    $App.querySelector(`input[name='cedula']`).focus()
                } else {
                    localStorage.setItem('component_cita_cedula',cedula);
                    ComponentPaciente.create()
                }
            })
            return false
        }
}
let solicitud_cita_select_ESPECIALIDAD = async ($App)=>{

    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        if (is_empty(useState['especialidades'])) {
            d.querySelector(".overlay").classList.remove("d-none")
            useState['especialidades'] = orderBy(await post(location.origin+`/consultaexterna/user/medico/especialidad/getAll`,formData) , 'description','asc');
            d.querySelector(".overlay").classList.add("d-none")
        }
    let inputSelect1 = $App.querySelector(`select[name='cat_especialidad_id']`)
        inputSelect1.innerHTML = null
        inputSelect1.append( $select(useState['especialidades']) )

}
let solicitud_cita_select_CENTRO_SALUD = async ($App)=>{
    let cat_especialidad_id = $App.querySelector(`select[name='cat_especialidad_id']`).value
        useState['formCreateCita']['cat_especialidad_id'] = Number(cat_especialidad_id)
        //console.log(useState['formCreateCita']);
    let especialidades =    useState['especialidades'].find(x=> equalsInt(x['id'],cat_especialidad_id) )
    let centro_salud = [];
        if (!is_null(especialidades)) {
            let centro_salud_id = [];
                if (!is_null(especialidades[ 'centro_salud_id' ])) {
                    centro_salud_id =   Array.from(new Set(especialidades[ 'centro_salud_id' ]
                    .split(",")
                    .map(x=> parseInt(x) )))
                }
            let formData = new FormData();
                formData.append("_token",d.querySelector("#_token").value)
                if (is_null(useState['centro_salud'])) {
                    d.querySelector(".overlay").classList.remove("d-none")
                    useState['centro_salud'] = await post(location.origin+`/consultaexterna/cat/centro_salud/getAll`,formData);
                    d.querySelector(".overlay").classList.add("d-none")
                }
                centro_salud =     useState['centro_salud'].filter(x=> centro_salud_id.includes( parseInt(x['id']) ) )
        }
    let inputSelect1 = d.querySelector(`select[name='centro_salud_id']`)
        inputSelect1.innerHTML = null
        inputSelect1.append( $select(centro_salud))
}
let solicitud_cita_select_MEDICO = async ($App)=>{
    let cat_especialidad_id = $App.querySelector(`select[name='cat_especialidad_id']`).value
    let centro_salud_id = $App.querySelector(`select[name='centro_salud_id']`).value
        useState['formCreateCita']['centro_salud_id'] = Number(centro_salud_id)
       // console.log(useState['formCreateCita']);
    let centro_salud =     useState['centro_salud'].find(x=> equalsInt( x['id'],centro_salud_id) )
    let medicos_id =    centro_salud['medicos_id']
                        .split(",")
                        .map(x=> parseInt(x) )
        d.querySelector(".overlay").classList.remove("d-none")
    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        formData.append("medicos_id",medicos_id)
        formData.append("especialidad_id",cat_especialidad_id)
        formData.append("centro_salud_id",centro_salud_id)
        useState['medicos'] = await post(location.origin+`/consultaexterna/user/medico/agenda/medicos`,formData);
        d.querySelector(".overlay").classList.add("d-none")


    let medicos = useState['medicos'].map(x=>{
        return {
            "id":x['user_id_medico'],
            "description":x['medico_descripcion'],
            }
        })
    let inputSelect2 = d.querySelector(`select[name='user_id_medico']`)
        inputSelect2.innerHTML = null
        inputSelect2.append($select(medicos))



}
let solicitud_cita_textarea_MOTIVO_CITA = async ($App)=>{
    let cita_motivo = $App.querySelector(`textarea[name='cita_motivo']`).value
    if ( !is_empty(cita_motivo) ) {
        useState['formCreateCita']['cita_motivo'] = cita_motivo
        /* $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-danger")
        $App.querySelector(`.item-7`).classList.add("bg-success")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-invalid")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-valid") */
        //console.log( useState['formCreateCita'] )
    } else {
        useState['formCreateCita']['cita_motivo'] = ""
        /* $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-success")
        $App.querySelector(`.item-7`).classList.add("bg-danger")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-invalid")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid") */
        //console.log( useState['formCreateCita'] )
    }
}
export let create = async ()=>{
    //let $App= $qs(`${useState['tab']} #App`)
    //ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)

    let $form = clone( "artefacto_0040" )
        $App.innerHTML=null
        $App.append( $form )

        //Carga de los seguros en el select #cat_seguro_id
        let seguros = await get(`/consultaexterna/cat_seguro/all`)
        let select_cat_seguro_id = document.getElementById('cat_seguro_id');
        seguros.forEach((seguro, index) => {
            let nuevaOpcion_cat_seguro_id = document.createElement('option');
            nuevaOpcion_cat_seguro_id.text = seguro.name;
            nuevaOpcion_cat_seguro_id.value = seguro.id;
            select_cat_seguro_id.appendChild(nuevaOpcion_cat_seguro_id);
        });

        //Carga de las empresas en el select #cat_empresa_id
        let empresas = await get(`/consultaexterna/cat_empresa/all`)
        let select_cat_empresa_id = document.getElementById('cat_empresa_id');
        empresas.forEach((empresa, index) => {
            let nuevaOpcion_cat_empresa_id = document.createElement('option');
            nuevaOpcion_cat_empresa_id.text = empresa.razon_social;
            nuevaOpcion_cat_empresa_id.value = empresa.id;
            select_cat_empresa_id.appendChild(nuevaOpcion_cat_empresa_id);
        });

        //Carga de los departamentos en el select #directorio_organizacional_id
        let departamentos = await get(`/consultaexterna/department/all`)
        let select_directorio_organizacional_id = document.getElementById('directorio_organizacional_id');
        departamentos.forEach((departamento, index) => {
            let nuevaOpcion_directorio_organizacional_id = document.createElement('option');
            nuevaOpcion_directorio_organizacional_id.text = departamento.name;
            nuevaOpcion_directorio_organizacional_id.value = departamento.id;
            select_directorio_organizacional_id.appendChild(nuevaOpcion_directorio_organizacional_id);
        });

        if (!is_null(localStorage.getItem('component_search_cedula'))) {
            let cedula = localStorage.getItem('component_search_cedula')
                $App.querySelector(`input[name='cedula']`).value = cedula.replace(/\./g, '')
            // let result = useState['users'].find(x => equalsInt(x.cedula,cedula) )
            // console.log("result --> ", result)
            //if (result.length > 0) {
                // useState['formCreateCita']['user_id_paciente'] =result['user_id']
                // $App.querySelector("input[name='user_id_paciente']").value = result['user_id']
                get(`/consultaexterna/user/profile/show_by_cedula/${cedula.replace(/\./g, '')}`)
                .then(response=>{
                    // console.log( response );
                    useState['formCreateCita']['user_id_paciente'] = response.id
                    $App.querySelector("input[name='user_id_paciente']").value = response.id
                })
                /* $App.querySelector("input[name='cedula']").classList.remove("is-invalid")
                $App.querySelector("input[name='cedula']").classList.add("is-valid")
                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-1`).classList.add("bg-success") */
            //}
            localStorage.removeItem('component_search_cedula');
        }

        solicitud_cita_select_ESPECIALIDAD($App)

        //EVENTO CEDULA
        $App.querySelector(`input[name='cedula']`).addEventListener("change",async function(e){
            solicitud_cita_input_CEDULA($App)
        })
        //EVENTO ESPECIALIDAD
        $App.querySelector(`select[name='cat_especialidad_id']`).addEventListener("change",async function(e){
            solicitud_cita_select_CENTRO_SALUD($App)
        })
        //EVENTO CENTRO SALUD
        $App.querySelector(`select[name='centro_salud_id']`).addEventListener("change",async function(e){
            solicitud_cita_select_MEDICO($App)
        })
        //EVENTO medico
        $App.querySelector(`select[name='user_id_medico']`).addEventListener("change",async function(e){
            activarCalendario()
        })

        $App.addEventListener("click",function(e){
            //EVENTO CALENDARIO
            if (e.target.classList.contains("cita-hora")) {
                //saveDataForm({"name":"cita_hora","value":e.target.dataset.hora})

                $App.querySelector('#cita_hora').value = e.target.dataset.hora
                useState['formCreateCita']['cita_hora'] = e.target.dataset.hora
                final_hora = formatAMPM( new Date(e.target.dataset.hora) ).toUpperCase()
                //inputValidation2('cita_hora')
                console.log(useState['formCreateCita'])
            }
            //EVENTO MODALIDAD CITA
            if (e.target.matches("input[name='condicion_administrativa']")) {
                useState['formCreateCita']['condicion_administrativa'] = e.target.value
                d.querySelector(`input[name='condicion_administrativa']`).value = e.target.value
                //$App.querySelector(`.item-8`).classList.remove("bg-primary","bg-danger")
                //$App.querySelector(`.item-8`).classList.add("bg-success")
                console.log( useState['formCreateCita'] )
            }
        })
        //EVENTO MOTIVO CONSULTA
        $App.querySelector(`textarea[name='cita_motivo']`).addEventListener("change",async function(e){
            solicitud_cita_textarea_MOTIVO_CITA($App)
        })
        //EVENTO ARCHIVO REFERENCIA MEDICO
        $App.querySelector(`input[name='informe_general']`).addEventListener("change",async function(e){
            useState['formCreateCita']['file'] = equalsInt( $App.querySelector("#informe_general").files.length,0) ? null : $App.querySelector("#informe_general").files
            console.log( useState['formCreateCita'] )
        })
        //EVENTO REGISTRAR CITA
        $App.querySelector("#btn_enviar").addEventListener("click", async function(e){
            e.preventDefault()
            let input = d.querySelector(`input[name='cedula']`)
                if (is_empty( input.value )) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Debe escribir una cédula válida",
                            didClose: () => {
                                setTimeout(() => input.focus() , 110);
                            }
                        })
                    return false
                }
                input = d.querySelector(`select[name='cat_especialidad_id']`)
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
                input = d.querySelector(`select[name='centro_salud_id']`)
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
                input = d.querySelector(`select[name='user_id_medico']`)
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
                input = d.querySelector(`input[name='cita_dia']`)
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
                input = d.querySelector(`input[name='cita_hora']`)
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

                input = d.querySelector(`input[name='condicion_administrativa']`)

                if(input.value === 'Seguro'){
                    if(document.getElementById("cat_seguro_id").value !== '' && !is_empty(document.getElementById("cat_seguro_id").value)){
                        useState['formCreateCita']['cat_seguro_id'] = document.getElementById("cat_seguro_id").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha elegido a qué seguro pertenece el paciente."
                        })
                        return false
                    }
                    if(document.getElementById("poliza_numero").value !== '' && !is_empty(document.getElementById("poliza_numero").value)){
                        useState['formCreateCita']['poliza_numero'] = document.getElementById("poliza_numero").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha introducido el número de póliza del seguro."
                        })
                        return false
                    }
                }

                if(input.value === 'Empresarial'){
                    if(document.getElementById("cat_empresa_id").value !== '' && !is_empty(document.getElementById("cat_empresa_id").value)){
                        useState['formCreateCita']['cat_empresa_id'] = document.getElementById("cat_empresa_id").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha elegido a qué empresa pertenece el paciente."
                        })
                        return false
                    }
                }

                if(input.value === 'Cortesía'){
                    if(document.getElementById("condicion_descripcion").value !== '' && !is_empty(document.getElementById("condicion_descripcion").value)){
                        useState['formCreateCita']['condicion_descripcion'] = document.getElementById("condicion_descripcion").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha ingresado el nombre del responsable de la cortesía."
                        })
                        return false
                    }
                }

                if(input.value === 'Empleado'){
                    if(document.getElementById("directorio_organizacional_id").value !== '' && !is_empty(document.getElementById("directorio_organizacional_id").value)){
                        useState['formCreateCita']['directorio_organizacional_id'] = document.getElementById("directorio_organizacional_id").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha elegido a qué departamento pertenece el empleado."
                        })
                        return false
                    }
                }

                input = d.querySelector(`textarea[name='cita_motivo']`)
                if (is_empty( input.value )) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Escriba el motivo de su cita."
                            /* didClose: () => {
                                setTimeout(() => input.focus() , 110);
                            } */
                        })
                    return false
                }
            //if (formCreateValidate()) {

            // console.log(`useState['formCreateCita'] --> ${JSON.stringify(useState['formCreateCita'],null,2)}`)
                //let $App= $qs(`${useState['tab']}`)
            Swal.fire({
                title: '¿Deseas enviar la solicitud?',
                //text: "Recomendamos solo cancelar, 12 o 24 horas antes, del día y hora aprobados de la cita. Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, enviar!'
            }).then( async (result) => {
                if (result.isConfirmed) {

                    let formData = new FormData();

                        for (const key in useState['formCreateCita']) {
                            if (Object.hasOwnProperty.call(useState['formCreateCita'], key)) {
                                let element = useState['formCreateCita'][key];
                                    formData.append(key,element)
                            }
                        }
                    /* let files = equalsInt( d.querySelector("#informe_general").files.length,0) ? null : d.querySelector("#informe_general").files
                        formData.append("file", files );
                        formData.append("user_id_paciente", $App.querySelector("input[name='user_id_paciente']").value ); */
                        formData.append("created_at",timestamps() );
                        formData.append("_token",d.querySelector("#_token").value)
                        d.querySelector(".overlay").classList.remove("d-none")
                    let $response = await post("/consultaexterna/paciente/cita/store",formData)
                        // if($response=="maximo_citas_alcanzado"){
                        //     d.querySelector(".overlay").classList.add("d-none")
                        //     Swal.fire(
                        //         'Máximo de citas activas superada.',
                        //         'No puede tener más de dos citas activas.',
                        //         'error'
                        //     )
                        //     return false

                        // }
                        await updateCitas($response)
                        ComponentMedicoHome.enrutador("#tab_citas")
                        useState.status_current_tab = 1
                        ComponentMedicoHome.handle_tablaCitas(useState.status_current_tab, "Citas por ponfirmar")
                        await ComponentMedicoHome.updateTotales()
                        ComponentMedicoHome.handle_tablaCitas(useState.status_current_tab)
                        d.querySelector(".overlay").classList.add("d-none")
                        //d.querySelector("#headerCitaStatusOptions").classList.remove("d-none")
                        Swal.fire(
                            'Cita Creada!',
                            'El paciente será notificado de esta acción',
                            'success'
                        )
                }
            })
            //}
                //alert("cita creada")





        })
        $('#calendar').datepicker().on("changeDate", function(e) {

            let user_id_medico = d.querySelector(`select[name='user_id_medico']`).value;
            let f = new Date(e.date);
            let anio = String(f.getFullYear())
            let mes  = String(f.getMonth() + 1).padStart(2, '0')
            let dia  = String(f.getDate()).padStart(2, '0')
            let fechaIngreso = anio + "-" + mes + "-" + dia;
                useState['formCreateCita']['cita_dia'] = fechaIngreso
                document.getElementById("cita_dia").value=fechaIngreso


                entById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día seleccionado:</b><br><span class="badge  badge-info">${fechaCortaCustom1(e.date)}</span>
                `

            let medicoFechas =  useState['medicos'].find(medico=>equalsInt(medico['user_id_medico'],user_id_medico))['agenda']
                medicoFechas = JSON.parse(medicoFechas)
                medicoFechas =  medicoFechas.map(fecha=>{
                                    let fc = new Date(fecha['day'])
                                        return {
                                            "day": String(fc.getDate()).padStart(2, '0'),
                                            "month": String(fc.getMonth() + 1).padStart(2, '0'),
                                            "year": String(fc.getFullYear()).padStart(2, '0'),
                                            "hour": String(fc.getHours()).padStart(2, '0')+":"+String(fc.getMinutes()).padStart(2, '0'),
                                            "visibilidad":fecha['visibilidad']
                                        }
                                })
                //console.log("medicoFechas",medicoFechas)
            let medicoHoras = medicoFechas.filter(fecha=>{
                    if (
                        fecha['month'] === mes &&
                        fecha['day'] === dia

                    ) {
                        return fecha
                    }
                }) //.map(fecha=>fecha['hour'])
                //console.log("medicoHoras",medicoHoras)
                d.querySelector('#pills-am ul.nav').innerHTML =""
                if (medicoHoras.length == 0) {
                    d.querySelector('#pills-am ul.nav').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }else{
                    medicoHoras.forEach((hora,key)=>{
                        console.log(hora);
                        let textColor =""
                        if (
                            hora['visibilidad']==="privada"
                        ) {
                            textColor ="font-weight-bold border border-default"
                            //ocultar horas privadas a los siguientes usuarios
                            //console.log(useState['user_id_medico'], 357585)
                            if (
                                /* ![
                                    355511,//mag
                                    96, //lg
                                    113590,//ln
                                    64233,//db
                                    95,//mg
                                    25, //pm
                                    22, //lp
                                    357137, //ls
                                    356153, //as
                                ].includes( Number(useState['user_id_medico']) ) */
                                useState['ver_citas_privadas'] === 0
                            ) {
                                textColor +=" d-none"
                            }
                        }

                        let h = horaAMPM( hora['hour'] ).toUpperCase()
                            d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora mr-1" data-hora="${hora['hour']}" role="presentation">
                                    <a class="nav-link cita-hora ${textColor}" id="hora-pm-${key}-tab" data-hora="${hora['hour']}" data-toggle="pill" href="#pills-pm-${hora['hour']}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                }


        });
        /* $('#calendar').datepicker().on("changeDate", function (e) {

            let d = document;
            let f = new Date(e.date);
            let dia_del_mes = ("0" + f.getDate()).slice(-2);
            let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth() + 1)).slice(-2) + "-" + dia_del_mes;
                useState['formCreateCita']['cita_dia'] = dia_del_mes
                console.log(useState['formCreateCita'])
                document.getElementById("cita_dia").value = fechaIngreso
                //console.log(useState['formCreateCita'])
                entById("mensaje_dia_seleccionado").innerHTML = `
                                <b>Día seleccionado:</b> <span class="badge badge-primary">${fechaCortaCustom1(e.date)}</span>
                            `
                final_dia = fechaCortaCustom1(e.date)

                //$App.querySelector(`.item-5`).classList.remove("bg-danger","bg-primary")
                //$App.querySelector(`.item-5`).classList.add("bg-success")

            //let horas = useState.get_medico_agenda_horas( onChange_agenda_id, f )
            let horas = get_medico_agenda_horas(onChange_agenda_id, f)
                //console.log("----------->>>",horas)
                $App.querySelector('#pills-am ul.nav').innerHTML =""
                $App.querySelector('#pills-pm ul.nav').innerHTML =""
                if (horas.horas_am.length > 0) {

                    horas.horas_am.forEach((hora,key)=>{

                        let h = formatAMPM( new Date(hora) ).toUpperCase()
                            $App.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-am-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-am-${key}" role="tab" aria-controls="pills-am-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                }
                if (horas.horas_pm.length > 0) {

                    horas.horas_pm.forEach((hora,key)=>{
                        let h = formatAMPM( new Date(hora) ).toUpperCase()
                            $App.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-pm-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-pm-${key}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                }
                if (horas.horas_pm.length == 0 && horas.horas_am.length == 0) {
                    d.querySelector('#pills-am ul.nav').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }
        }); */
        $('#calendar').datepicker('destroy')
        $('#calendar').empty()
}
export let createRespaldo = async ()=>{
    let $App= $qs(`${useState['tab']} #App`)
    let $form = clone( "artefacto_0040" )
        $App.innerHTML=null
        $App.append( $form )
        $App.querySelector("h3").classList.add("d-none")
        d.querySelector(".cat-cita-status-title").textContent="Nueva Cita"
        entById("tab_consulta_overlay").classList.remove("d-none")



        if (!is_null(localStorage.getItem('component_search_cedula'))) {
            let cedula = localStorage.getItem('component_search_cedula')
                d.querySelector(`${useState['tab']} input[name='cedula']`).value = cedula.replace(/\./g, '')
            let result = useState['users'].filter(x =>{
                if (parseInt(x.cedula) ===  parseInt(cedula) ) {
                    return  x
                }

            })
            //if (result.length > 0) {
                useState['formCreateCita']['user_id_paciente'] = first(result)['user_id']
                $App.querySelector("input[name='user_id_paciente']").value = first(result)['user_id']
                $App.querySelector("input[name='cedula']").classList.remove("is-invalid")
                $App.querySelector("input[name='cedula']").classList.add("is-valid")
                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-1`).classList.add("bg-success")
            //}
            localStorage.removeItem('component_search_cedula');
        }



        $App.querySelector(`select[name='centro_salud_id']`).innerHTML = null
        /**inicio */

    let data = useState['centro_salud']
    let $fragment = document.createDocumentFragment()
    let $option = document.createElement("option")
        $option.value = ""
        $option.textContent = "Seleccione"
        $fragment.appendChild($option)
        data.forEach(x=>{
            $option = document.createElement("option")
            $option.value =x.id
            if ( equalsInt(x.id, useState['user_centro_salud_id']) ) {
                $option.selected=true
                $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-2`).classList.add("bg-success")
                $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
                $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
            }
            $option.textContent = `${x.description} ${x['especialidades'].length > 0 ? '('+x['especialidades'].length+')' : ''}`
            $fragment.appendChild($option)
        })
        $App.querySelector(`select[name='centro_salud_id']`).append($fragment)
        /**fin */

        /**incio */
        $App.addEventListener("change", async function (e) {
            formValidate(e)
        })
        /**fin */

        /**inicio */
        let centro_salud_id = $App.querySelector(`select[name='centro_salud_id']`).value

        let centro_salud_especialidades = first(useState['centro_salud'].filter(centro_salud=> equalsInt(centro_salud.id , centro_salud_id) ))['especialidades']

            $App.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
            $fragment = document.createDocumentFragment()
            $option = document.createElement("option")
            $option.value = ""
            if (centro_salud_especialidades.length === 0) {
                $option.style.color="#a4b2bd"
                $option.disabled=true
            }
            //tab_app_overlay
            $option.textContent = "Seleccione"
            $fragment.appendChild($option)
            if (centro_salud_especialidades.length > 0) {
                centro_salud_especialidades.forEach(especialidad=>{
                    $option = document.createElement("option")
                    $option.value =especialidad.cat_especialidad_id //
                    //let total_agendas = useState['medicos_agenda'].filter( agenda => equalsInt( agenda.cat_especialidad_id , especialidad.cat_especialidad_id ) )

                    //***** */
                    let agenda = useState['medicos_agenda'].filter(z => equalsInt(z.centro_salud_id, centro_salud_id) && equalsInt(z.cat_especialidad_id, especialidad.cat_especialidad_id)  )
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

            $App.querySelector(`select[name='cat_especialidad_id']`).append($fragment)

            $App.querySelector(`.notification-especialidad b`).textContent= centro_salud_especialidades.length
            if (centro_salud_especialidades.length > 0) {
                $App.querySelector(`.notification-especialidad`).classList.remove("d-none")
            }else{
                $App.querySelector(`.notification-especialidad`).classList.add("d-none")
            }
            useState['formCreateCita']['centro_salud_id'] = parseInt( centro_salud_id )

            $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-2`).classList.add("bg-success")
            $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
            $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
        /**fin */

        /**inicio */
        $('#calendar').datepicker().on("changeDate", function (e) {
            let d = document;
            let f = new Date(e.date);
            let dia_del_mes = ("0" + f.getDate()).slice(-2);
            let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth() + 1)).slice(-2) + "-" + dia_del_mes;
                useState['formCreateCita']['cita_dia'] = dia_del_mes
                document.getElementById("cita_dia").value = fechaIngreso
                //console.log(useState['formCreateCita'])
                import { $qs, clone } from '../../helpers/helpers.js?version = 0.1'
import * as ComponentPaciente from '../paciente/paciente.js?version = 0.1'
import * as ComponentMedicoHome from '../medico/medico_home.js?version = 0.1'

let onChange_agenda_id;
let final_hora;
let final_dia;
let handle_calendario = (medico_id) => {
    //console.log(medico_id)
    $('#calendar').datepicker('destroy')
    $('#calendar').empty()
    let fecha = new Date()
    let feriados = [
            {"year":fecha.getFullYear(), "month":1, "day":1, "description":`Año nuevo`},
            {"year":fecha.getFullYear(), "month":2, "day":20, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":2, "day":21, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":4, "day":6, "description":`Jueves Santo`},
            {"year":fecha.getFullYear(), "month":4, "day":7, "description":`Viernes Santo`},
            {"year":fecha.getFullYear(), "month":4, "day":19, "description":`Declaración de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":5, "day":1, "description":`Día del trabajador`},
            {"year":fecha.getFullYear(), "month":6, "day":24, "description":`Batalla de Carabobo`},
            {"year":fecha.getFullYear(), "month":7, "day":5, "description":`Día de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":7, "day":24, "description":`Natalicio de Simón Bolívar`},
            {"year":fecha.getFullYear(), "month":10, "day":12, "description":`Día de la Resistencia Indigena`},
            {"year":fecha.getFullYear(), "month":12, "day":24, "description":`Vispera de navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":25, "description":`Navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":31, "description":`Fiesta de fín de año`},
        ]
         console.log(feriados);
    let medico_agenda = useState['medicos_agenda'].filter(x => equalsInt(x.user_id_medico, medico_id) && equalsInt( x.cat_especialidad_id , d.querySelector("select[name='cat_especialidad_id']").value ) ) //useState.get_medico_agenda(medico_id)
        console.log("medico_agenda-->", medico_agenda)
    let { agenda, agenda_id } = first(medico_agenda)
        onChange_agenda_id = agenda_id
    let mesesDisponibles = agenda.mes_del_anio
    let diasDisponible = agenda.dias_del_mes
    if (is_undefined(mesesDisponibles)) {
        return false
    }
    $('#calendar').datepicker({
        "language": "es",
        beforeShowYear: function (date) {
            if (date.getFullYear() !== new Date().getFullYear()) {
                return false;
            }
        },
        beforeShowMonth: function (date) {
            if (
                !mesesDisponibles.includes(date.getMonth() + 1) &&
                date.getFullYear() === new Date().getFullYear()
            ) {
                return false;
            }
        },
        beforeShowDay: function (date) {
            // console.log("-->>",fechaAMD(date))
            let f = new Date()
            let fActual = new Date(f.getFullYear(), (f.getMonth() + 1), date.getDate())

            let feriados_mes =  feriados
                                .find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                console.log("feriados_mes",feriados_mes)
                if (!is_undefined(feriados_mes)) {
                    return {
                        tooltip: `Feriado: ${feriados_mes['description']}`,
                        classes: 'disabled bg-info'
                    };
                }



                if (
                    fActual.getTime() >= f.getTime() &&
                    (date.getMonth() + 1) >= (f.getMonth() + 1) &&
                    diasDisponible.includes(fechaAMD(date))

                ) {

                    return {
                        tooltip: `Dia ${date.getDate()} de ${(meses(date.getMonth()))} disponible`,
                        classes: 'today'
                    };
                } else {
                    return {
                        tooltip: `No existen horas disponibles este dia`,
                        classes: 'disabled',
                    };
                }
        },
    });

}
let get_medico_agenda_horas = (agenda_id,dia_del_mes)=>{
    let model = useState['medicos'].find(agenda => equalsInt( agenda.agenda_id , agenda_id ) )['agenda']
    console.log(model);
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
}
let formValidate = async (e)=>{
    console.log(e.target)
    let $App= $qs(`${useState['tab']}`)
    let cedula = $App.querySelector(`${useState['tab']} input[name='cedula']`).value
    if (e.target.matches("input[name='cedula']")) {
        d.querySelector("#tab_app .overlay").classList.remove("d-none")
        let user = useState['users'].find(x=>equalsInt(x['cedula'],cedula))
            //console.log("user",user)
            if (is_undefined(user)) {
                useState['search_resultset'] = await get(`/consultaexterna/user/profile/searchUser/${cedula}`)

                if ( !equalsInt(useState['search_resultset'].length,0) ) {
                    user = useState['search_resultset'].find(x=>equalsInt(x['cedula'],cedula))
                    if (!is_undefined( user )) {
                        useState['users'].push( user )
                        //console.log(useState['users'])
                    }
                }

            }


        let existe_cedula = useState['users'].filter(x => equalsInt(x['cedula'] , cedula ))

            if (!is_empty(cedula) && existe_cedula.length > 0) {

                useState['formCreateCita']['user_id_paciente'] = first(existe_cedula)['user_id']
                $App.querySelector(`input[name='user_id_paciente']`).value = parseInt( first(existe_cedula)['user_id'] )
                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-1`).classList.add("bg-success")
                $App.querySelector(`input[name='cedula']`).classList.remove("is-invalid")
                $App.querySelector(`input[name='cedula']`).classList.add("is-valid")
                d.querySelector("#tab_app .overlay").classList.add("d-none")
                console.log( useState['formCreateCita'] )
            } else {
                useState['formCreateCita'] = {
                    "user_id_paciente"    : "",
                    "centro_salud_id"     : "",
                    "cita_dia"            : "",
                    "cita_hora"           : "",
                    "user_id_medico"      : "",
                    "cita_motivo"         : "",
                    "enfermedad_actual"   : "",
                    "cat_user_cita_status_id": 1,
                    "condicion_administrativa": "Particular",
                    "condicion_descripcion": "",
                    "user_id_autorizacion": null,
                    "cat_seguro_id": null,
                    "poliza_numero": null,
                }

                $App.querySelector(`input[name='user_id_paciente']`).value = ""
                $App.querySelector(`select[name='centro_salud_id']`).value = ""
                $App.querySelector(`select[name='cat_especialidad_id']`).value = ""
                $App.querySelector(`select[name='user_id_medico']`).value = ""
                $App.querySelector(`input[name='cita_dia']`).value = ""
                $App.querySelector(`input[name='cita_hora']`).value = ""
                //$App.querySelector(`input[name='condicion_administrativa][value='Particular']`).checked = true
                $App.querySelector(`input[name='condicion_descripcion']`).value = ""
                $App.querySelector(`textarea[name='cita_motivo']`).value = ""
                $App.querySelector(`#pills-am ul.nav`).innerHTML = null
                $App.querySelector(`#pills-pm ul.nav`).innerHTML = null

                $('#calendar').datepicker('destroy')
                $('#calendar').empty()

                $App.querySelector(`input[name='cedula']`).classList.add("is-invalid")
                $App.querySelector(`input[name='cedula']`).classList.remove("is-valid")

                $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid","is-invalid")
                $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
                $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
                $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")


                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-success")
                $App.querySelector(`.item-1`).classList.add("bg-danger")

                $App.querySelector(`.item-2`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-2`).classList.add("bg-primary")

                $App.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-3`).classList.add("bg-primary")

                $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-4`).classList.add("bg-primary")

                $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-5`).classList.add("bg-primary")

                $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-6`).classList.add("bg-primary")

                $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
                $App.querySelector(`.item-7`).classList.add("bg-primary")
                d.querySelector("#tab_app .overlay").classList.add("d-none")
                Swal.fire({
                    title: 'Paciente no encontrado',
                    text: "El paciente con este documento de identidad no se encuentra registrado, ¿Desea registrarlo?",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--success)',
                    cancelButtonColor: 'var(--info)',
                    confirmButtonText: 'Escribiré otra cédula!',
                    cancelButtonText: 'Si, registrarlo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //$App.querySelector(`input[name='cedula']`).classList.remove("is-invalid", "is-valid")
                        $App.querySelector(`input[name='cedula']`).value = ""
                        $App.querySelector(`input[name='cedula']`).focus()
                    } else {
                        localStorage.setItem('component_cita_cedula',cedula);
                        ComponentPaciente.create()
                    }
                })
                return false
            }
    }
    let centro_salud_id = $App.querySelector(`select[name='centro_salud_id']`).value
    if (e.target.matches("select[name='centro_salud_id']")) {
        if ( !is_empty(centro_salud_id) ) {
            if (is_empty(cedula) ) {
                $App.querySelector(`input[name='cedula']`).focus()
                $App.querySelector(`select[name='centro_salud_id']`).value=""
                return false
            }
            let centro_salud_especialidades = first(useState['centro_salud'].filter(centro_salud=> equalsInt(centro_salud.id , centro_salud_id) ))['especialidades']

                $App.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
                $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
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
                        let agenda = useState['medicos_agenda'].filter(z => equalsInt(z.centro_salud_id, centro_salud_id) && equalsInt(z.cat_especialidad_id, especialidad.cat_especialidad_id)  )
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

                $App.querySelector(`select[name='cat_especialidad_id']`).append($fragment)

                $App.querySelector(`.notification-especialidad b`).textContent= centro_salud_especialidades.length
                if (centro_salud_especialidades.length > 0) {
                    $App.querySelector(`.notification-especialidad`).classList.remove("d-none")
                }else{
                    $App.querySelector(`.notification-especialidad`).classList.add("d-none")
                }
                useState['formCreateCita']['centro_salud_id'] = parseInt( centro_salud_id )

                $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-2`).classList.add("bg-success")
                $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
                $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
        }else{


            useState['formCreateCita']['centro_salud_id'] = ""
            $App.querySelector(`select[name='centro_salud_id']`).value = ""
            $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-2`).classList.add("bg-danger")
            $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-invalid")
            $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid")

            $App.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
            $App.querySelector(`input[name='cita_dia']`).value = ""
            $App.querySelector(`input[name='cita_hora']`).value = ""
            $App.querySelector(`textarea[name='cita_motivo']`).value = ""
            $App.querySelector(`#pills-am`).innerHTML = null
            $App.querySelector(`#pills-pm`).innerHTML = null


            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")

            $App.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-3`).classList.add("bg-primary")

            $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-primary")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            return false
        }
    }
    let cat_especialidad_id = $App.querySelector(`select[name='cat_especialidad_id']`).value
    if (e.target.matches("select[name='cat_especialidad_id']")) {
        if ( !is_empty(cat_especialidad_id) ) {


            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null

            //**** */
            let agenda = useState['medicos_agenda'].filter(x => equalsInt(x.centro_salud_id, centro_salud_id) && equalsInt(x.cat_especialidad_id,e.target.value)  )
            let agenda_especialidad_id = agenda.map(x => x.cat_especialidad_id )
            let agenda_medicos_id = agenda.map(x => x.user_id_medico )

            let medicos_resultset =[]
                agenda_medicos_id.forEach((medico_id,key)=>{
                    let medico =useState['medicos'].filter(medico => equalsInt(medico.user_id,medico_id))
                        //medicos_resultset[ key ] = first( medico )
                        if (!is_null( first( medico ) ) ) {
                            medicos_resultset[ key ] =  first( medico )
                        }
                })


            let $fragment = document.createDocumentFragment()
            let $option = document.createElement("option")
                $option.value = ""
                $option.textContent = "Seleccione"
                $fragment.appendChild($option)
                if (medicos_resultset.length > 0) {
                    medicos_resultset.forEach(medico=>{
                        $option = document.createElement("option")
                        $option.value =medico.user_id
                        $option.textContent = `${medico.medico}`
                        $fragment.appendChild($option)
                    })
                } else {
                    $option.textContent ="Sin médicos asociados."
                    $fragment.appendChild($option)
                }

                $App.querySelector(` select[name='user_id_medico']`).append($fragment)

                $App.querySelector(`.notification-medicos b`).textContent= medicos_resultset.length
                if (medicos_resultset.length > 0) {
                    $App.querySelector(`.notification-medicos`).classList.remove("d-none")
                }else{
                    $App.querySelector(`.notification-medicos`).classList.add("d-none")
                }

            useState['formCreateCita']['cat_especialidad_id'] = parseInt( cat_especialidad_id )
            //$App.querySelector(`select[name='cat_especialidad_id']`).value = cat_especialidad_id
            $App.querySelector(`.item-3`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-3`).classList.add("bg-success")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-invalid")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.add("is-valid")
            //console.log( useState['formCreateCita'] )
        }else{
            useState['formCreateCita']['cat_especialidad_id'] = ""
            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
            //$App.querySelector(`select[name='user_id_medico']`).value = ""
            $App.querySelector(`.item-3`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-3`).classList.add("bg-danger")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.add("is-invalid")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid")
            //$App.querySelector(`select[name='user_id_medico']`).classList.add("is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")

            $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-primary")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            return false
        }
    }
    if (e.target.matches("select[name='user_id_medico']")) {
        let user_id_medico = $App.querySelector(`select[name='user_id_medico']`).value
        if ( !is_empty(user_id_medico) ) {

            useState['formCreateCita']['user_id_medico'] = parseInt( user_id_medico )
            handle_calendario(user_id_medico)
            //$App.querySelector(` select[name='user_id_medico']`).value = parseInt( user_id_medico )
            $App.querySelector(`.item-4`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-4`).classList.add("bg-success")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.add("is-valid")
        // console.log( useState['formCreateCita'] )
        }else{
            useState['formCreateCita']['user_id_medico'] = ""
            $App.querySelector(`select[name='user_id_medico']`).value = ""
            $App.querySelector(`.item-4`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-danger")
            $App.querySelector(`select[name='user_id_medico']`).classList.add("is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            $App.getElementById("mensaje_dia_seleccionado").innerHTML = `Solo los días resaltados están disponibles.`
            $('#calendar').datepicker('destroy')
            $('#calendar').empty()
            return false
        }

    }
    let cita_motivo = $App.querySelector(`textarea[name='cita_motivo']`).value
    if (e.target.matches("textarea[name='cita_motivo']")) {
        if ( !is_empty(cita_motivo) ) {
            useState['formCreateCita']['cita_motivo'] = cita_motivo
            $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-7`).classList.add("bg-success")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-valid")
            //console.log( useState['formCreateCita'] )
        } else {
            useState['formCreateCita']['cita_motivo'] = ""
            $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-danger")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid")
            //console.log( useState['formCreateCita'] )
        }




    }
    if (e.target.matches("input[name='condicion_descripcion']")) {
        useState['formCreateCita']['condicion_descripcion'] = e.target.value
        console.log( useState['formCreateCita'] )
    }
    if (e.target.matches("select[name='user_id_autorizacion']")) {
        useState['formCreateCita']['user_id_autorizacion'] = e.target.value
        console.log( useState['formCreateCita'] )
    }
    if (e.target.matches("input[name='imforme_general']")) {
        useState['formCreateCita']['file'] = d.querySelector("#imforme_general").files,
        console.log( useState['formCreateCita'] )
    }
    return true
}
let formCreateValidate = ()=>{
    let input = d.querySelector(`${useState['tab']} input[name='cedula']`)
            if (is_empty( input.value )) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: "Escriba una cédula de identidad valida.",
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${useState['tab']} select[name='centro_salud_id']`)
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
        input = d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`)
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
        input = d.querySelector(`${useState['tab']} select[name='user_id_medico']`)
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
        input = d.querySelector(`${useState['tab']} input[name='cita_dia']`)
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
        input = d.querySelector(`${useState['tab']} input[name='cita_hora']`)
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
        return true
}
/* let updateCitasOne = async (user_id) => {
    let resulset = await get(`/user/medico/home/citas/update/one/${user_id}`)
        let index = ""
            Object.assign(useState["citas"],first(resulset['citas']))

            if (resulset['tarjetasoychacao'].length > 0) {
                Object.assign(useState["tarjetasoychacao"],first(resulset['tarjetasoychacao']))
            }

            if (resulset['user_condicion_medica'].length > 0) {
                Object.assign(useState["user_condicion_medica"],first(resulset['user_condicion_medica']))
            }

            if (resulset['user_medicamento'].length > 0) {
                Object.assign(useState["user_medicamento"],first(resulset['user_medicamento']))
            }

            if (resulset['user_antecedente'].length > 0) {
                Object.assign(useState["user_antecedente"],first(resulset['user_antecedente']))
            }

            if (resulset['user_alergias'].length > 0) {
                Object.assign(useState["user_alergias"],first(resulset['user_alergias']))
            }

            if (resulset['users'].length > 0) {
                index = useState["users"].findIndex(x=>equalsInt(x["user_id_paciente"],user_id))
                useState["users"][index]= first(resulset["users"])
            }
            if (resulset['pacientes'].length > 0) {
                index = useState["pacientes"].findIndex(x=>equalsInt(x["user_id"],user_id))
                useState["pacientes"][index]= first(resulset["pacientes"])
            }

            await updateTotales()
            console.log(useState)



} */
export let updateCitas = async (new_cita) => {
    let resulset = await get(`/consultaexterna/user/medico/home/citas/update/one/${new_cita.id}`)

        //console.log(resulset)
        //let pacientes_id_faltantes = []
        //let citaIndex = useState['users'].findIndex(x=>equalsInt(x['user_id'], new_cita.user_id_paciente))
        //let searchPaciente = useState['users'].find(x=>equalsInt(x['user_id'], new_cita.user_id_paciente))
      /*   if ( is_undefined( searchPaciente ) ) {
            pacientes_id_faltantes.push(new_cita.user_id_paciente)
            let formData = new FormData();
                formData.append("pacientes_id", pacientes_id_faltantes )
                formData.append("_token", d.querySelector("#_token").value)
            let result = await post(location.origin+"/user/userCitaAll",formData)
                if (result.length === 1) {
                    useState['users'].push( first(result))
                }else{
                    result.forEach(x=>{
                        useState['users'].push( x )
                    })
                }
        }else{

        } */



        useState["citas"].push( first(resulset.citas) );
        useState["citas"] = orderBy(useState["citas"],"user_cita_id","desc")
        console.log( useState["citas"])
        let items = [
            "user_condicion_medica",
            "user_medicamento",
            "user_antecedente",
            "user_alergias"
        ]

        for (const item of items) {
            console.log(item)
            if (resulset[ item ].length > 0) {
                resulset[ item ].forEach(x=>{
                    let existe = useState[ item ].filter(y => equalsInt(y.id,x.id ) )
                        if(existe.length == 0){
                            useState[ item ].push( x )
                        }
                })
            }
        }

        await ComponentMedicoHome.updateTotales()
}
/* let activarCalendario = ()=>{
    $('#calendar').datepicker('destroy')
    $('#calendar').empty();
    let fecha = new Date();

    let user_id_medico = d.querySelector(`select[name='user_id_medico']`).value;
        useState['formCreateCita']['user_id_medico'] = Number(user_id_medico)

    let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],user_id_medico))

        //console.log("agenda",agenda)

        onChange_agenda_id = agenda['agenda_id']
    let mesesDisponibles = agenda['agenda']['mes_del_anio']
    let diasDisponible = agenda['agenda']['dias_del_mes']
        //console.log("agenda",mesesDisponibles)
        if( is_undefined(mesesDisponibles) ){
            return false
        }


        $('#calendar').datepicker({
            "language": "es",
            "weekStart":0,
            beforeShowYear: function(date){
                if (date.getFullYear() !== new Date().getFullYear()) {
                    return false;
                }
            },
            beforeShowMonth: function(date){
                //console.log(mesesDisponibles,"---",(date.getMonth()+1));
                if (
                    !mesesDisponibles.includes(date.getMonth()+1) &&
                    date.getFullYear() === new Date().getFullYear()
                    ) {
                    return false;
                }
            },
            beforeShowDay: function(date){
                   //console.log("-->>",fechaAMD(date))
                let f = new Date()
                let fActual = new Date( f.getFullYear() , (f.getMonth()+1), date.getDate() )
                let feriados_mes =  feriados.find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                    //console.log("feriados_mes",feriados_mes)
                    if (!is_undefined(feriados_mes)) {
                        return {
                            tooltip: `Feriado: ${feriados_mes['description']}`,
                            classes: 'disabled bg-info'
                        };
                    }
                    if (!is_undefined(diasDisponible)) {
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
                    }else{
                        return {
                            tooltip: `No existen horas disponibles este dia`,
                            classes: 'disabled',
                            };
                        console.log('%chome.blade.php line:3192 diasDisponible', 'color: #007acc;', diasDisponible);
                    }


            },
        });

} */
let local_timestamps2=(date) =>{
    var hoy = new Date(date);

    return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
}
let activarCalendario = ()=>{
    //console.log(useState['formNuevaCita'])
    $('#calendar').datepicker('destroy')
    $('#calendar').empty();
    let fecha = new Date();


    let user_id_medico = d.querySelector(`select[name='user_id_medico']`).value;
        useState['formCreateCita']['user_id_medico'] = Number(user_id_medico)

        //console.log(useState['formNuevaCita'])
    let agenda =  useState['medicos'].find(x=>equalsInt(x['user_id_medico'],user_id_medico))['agenda']
        agenda = JSON.parse(agenda)
        //agenda = Array.from(agenda)
        console.log("agenda",agenda)

        onChange_agenda_id = agenda['agenda_id']

    //let mesesDisponibles = agenda['agenda']['mes_del_anio']
    let diasDisponible =  agenda.filter(x=>["publica","privada"].includes(x['visibilidad'])).map(x=>{
        let fecha = new Date(x['day']);
            return fecha.getFullYear() + "-" + String(fecha.getMonth() + 1).padStart(2, '0') + "-" + String(fecha.getDate()).padStart(2, '0') +" 00:00"
    })
        console.log("diasDisponible",diasDisponible)
        /* if( is_undefined(mesesDisponibles) ){
            return false
        } */


        $('#calendar').datepicker({
            "language": "es",
            "weekStart":0,
            beforeShowYear: function(date){
                if (date.getFullYear() !== new Date().getFullYear()) {
                    return false;
                }
            },
            beforeShowMonth: function(date){
                /* if (
                    !mesesDisponibles.includes(date.getMonth()+1) &&
                    date.getFullYear() === new Date().getFullYear()
                    ) {
                    return false;
                } */
            },
            beforeShowDay: function(date){
                // console.log("-->>",fechaAMD(date))
                let f = new Date()
                let fActual = new Date(f.getFullYear(), (f.getMonth() + 1), date.getDate())

                  //  console.log(fActual)
                let feriados_mes =  feriados
                                    .find(x=> equalsInt(x['month'], (date.getMonth() + 1) ) && (equalsInt(x['day'], (date.getDate()) ) ) )
                    //console.log("feriados_mes",feriados_mes)
                    if (!is_undefined(feriados_mes)) {
                        return {
                            tooltip: `Feriado: ${feriados_mes['description']}`,
                            classes: 'disabled bg-info'
                        };
                    }



                    //console.log(local_timestamps2(date))
                    if (
                        fActual.getTime() >= f.getTime() &&
                        (date.getMonth() + 1) >= (f.getMonth() + 1) &&
                        diasDisponible.includes(local_timestamps2(date))

                    ) {

                        return {
                            tooltip: `Dia ${date.getDate()} de ${(meses(date.getMonth()))} disponible`,
                            classes: 'today'
                        };
                    } else {
                        return {
                            tooltip: `No existen horas disponibles este dia`,
                            classes: 'disabled',
                        };
                    }
            },
        });

}
let solicitud_cita_input_CEDULA = async ($App)=>{
    let cedula = $App.querySelector(`input[name='cedula']`).value
    let user = useState['users'].find(x=>equalsInt(x['cedula'],cedula))
        if (is_undefined(user)) {
            d.querySelector(".overlay").classList.remove("d-none")
            useState['search_resultset'] = await get(`/user/profile/searchUser/${cedula}`)
            d.querySelector(".overlay").classList.add("d-none")
            if ( !equalsInt(useState['search_resultset'].length,0) ) {
                user = useState['search_resultset'].find(x=>equalsInt(x['cedula'],cedula))
                if (!is_undefined( user )) {
                    useState['users'].push( user )
                    console.log(useState['users'])
                }
            }

        }


    let existe_cedula = useState['users'].filter(x => equalsInt(x['cedula'] , cedula ))

        if (!is_empty(cedula) && existe_cedula.length > 0) {

            useState['formCreateCita']['user_id_paciente'] = first(existe_cedula)['user_id']
          /*   $App.querySelector(`input[name='user_id_paciente']`).value = parseInt( first(existe_cedula)['user_id'] )
            $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-1`).classList.add("bg-success")
            $App.querySelector(`input[name='cedula']`).classList.remove("is-invalid")
            $App.querySelector(`input[name='cedula']`).classList.add("is-valid")
            d.querySelector("#tab_app .overlay").classList.add("d-none") */
            console.log( useState['formCreateCita'] )
        }
        else {
            useState['formCreateCita'] = {
                "user_id_paciente"    : "",
                "centro_salud_id"     : "",
                "cita_dia"            : "",
                "cita_hora"           : "",
                "user_id_medico"      : "",
                "cita_motivo"         : "",
                "enfermedad_actual"   : "",
                "cat_user_cita_status_id": 1,
                "condicion_administrativa": "Particular",
                "condicion_descripcion": "",
                "user_id_autorizacion": null,
                "cat_seguro_id": null,
                "poliza_numero": null,
            }

            /* $App.querySelector(`input[name='user_id_paciente']`).value = ""
            $App.querySelector(`select[name='centro_salud_id']`).value = ""
            $App.querySelector(`select[name='cat_especialidad_id']`).value = ""
            $App.querySelector(`select[name='user_id_medico']`).value = ""
            $App.querySelector(`input[name='cita_dia']`).value = ""
            $App.querySelector(`input[name='cita_hora']`).value = ""
            //$App.querySelector(`input[name='condicion_administrativa][value='Particular']`).checked = true
            $App.querySelector(`input[name='condicion_descripcion']`).value = ""
            $App.querySelector(`textarea[name='cita_motivo']`).value = ""
            $App.querySelector(`#pills-am ul.nav`).innerHTML = null
            $App.querySelector(`#pills-pm ul.nav`).innerHTML = null */

            $('#calendar').datepicker('destroy')
            $('#calendar').empty()

            /* $App.querySelector(`input[name='cedula']`).classList.add("is-invalid")
            $App.querySelector(`input[name='cedula']`).classList.remove("is-valid")

            $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`select[name='cat_especialidad_id']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`select[name='user_id_medico']`).classList.remove("is-valid","is-invalid")
            $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid","is-invalid")


            $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-success")
            $App.querySelector(`.item-1`).classList.add("bg-danger")

            $App.querySelector(`.item-2`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-2`).classList.add("bg-primary")

            $App.querySelector(`.item-3`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-3`).classList.add("bg-primary")

            $App.querySelector(`.item-4`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-4`).classList.add("bg-primary")

            $App.querySelector(`.item-5`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-5`).classList.add("bg-primary")

            $App.querySelector(`.item-6`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-6`).classList.add("bg-primary")

            $App.querySelector(`.item-7`).classList.remove("bg-danger","bg-success")
            $App.querySelector(`.item-7`).classList.add("bg-primary")
            d.querySelector("#tab_app .overlay").classList.add("d-none") */
            Swal.fire({
                title: 'Paciente no encontrado',
                text: "El paciente con este documento de identidad no se encuentra registrado, ¿Desea registrarlo?",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--info)',
                confirmButtonText: 'Escribiré otra cédula!',
                cancelButtonText: 'Si, registrarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    //$App.querySelector(`input[name='cedula']`).classList.remove("is-invalid", "is-valid")
                    $App.querySelector(`input[name='cedula']`).value = ""
                    $App.querySelector(`input[name='cedula']`).focus()
                } else {
                    localStorage.setItem('component_cita_cedula',cedula);
                    ComponentPaciente.create()
                }
            })
            return false
        }
}
let solicitud_cita_select_ESPECIALIDAD = async ($App)=>{

    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        if (is_empty(useState['especialidades'])) {
            d.querySelector(".overlay").classList.remove("d-none")
            useState['especialidades'] = orderBy(await post(location.origin+`/consultaexterna/user/medico/especialidad/getAll`,formData) , 'description','asc');
            d.querySelector(".overlay").classList.add("d-none")
        }
    let inputSelect1 = $App.querySelector(`select[name='cat_especialidad_id']`)
        inputSelect1.innerHTML = null
        inputSelect1.append( $select(useState['especialidades']) )

}
let solicitud_cita_select_CENTRO_SALUD = async ($App)=>{
    let cat_especialidad_id = $App.querySelector(`select[name='cat_especialidad_id']`).value
        useState['formCreateCita']['cat_especialidad_id'] = Number(cat_especialidad_id)
        //console.log(useState['formCreateCita']);
    let especialidades =    useState['especialidades'].find(x=> equalsInt(x['id'],cat_especialidad_id) )
    let centro_salud = [];
        if (!is_null(especialidades)) {
            let centro_salud_id = [];
                if (!is_null(especialidades[ 'centro_salud_id' ])) {
                    centro_salud_id =   Array.from(new Set(especialidades[ 'centro_salud_id' ]
                    .split(",")
                    .map(x=> parseInt(x) )))
                }
            let formData = new FormData();
                formData.append("_token",d.querySelector("#_token").value)
                if (is_null(useState['centro_salud'])) {
                    d.querySelector(".overlay").classList.remove("d-none")
                    useState['centro_salud'] = await post(location.origin+`/consultaexterna/cat/centro_salud/getAll`,formData);
                    d.querySelector(".overlay").classList.add("d-none")
                }
                centro_salud =     useState['centro_salud'].filter(x=> centro_salud_id.includes( parseInt(x['id']) ) )
        }
    let inputSelect1 = d.querySelector(`select[name='centro_salud_id']`)
        inputSelect1.innerHTML = null
        inputSelect1.append( $select(centro_salud))
}
let solicitud_cita_select_MEDICO = async ($App)=>{
    let cat_especialidad_id = $App.querySelector(`select[name='cat_especialidad_id']`).value
    let centro_salud_id = $App.querySelector(`select[name='centro_salud_id']`).value
        useState['formCreateCita']['centro_salud_id'] = Number(centro_salud_id)
       // console.log(useState['formCreateCita']);
    let centro_salud =     useState['centro_salud'].find(x=> equalsInt( x['id'],centro_salud_id) )
    let medicos_id =    centro_salud['medicos_id']
                        .split(",")
                        .map(x=> parseInt(x) )
        d.querySelector(".overlay").classList.remove("d-none")
    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        formData.append("medicos_id",medicos_id)
        formData.append("especialidad_id",cat_especialidad_id)
        formData.append("centro_salud_id",centro_salud_id)
        useState['medicos'] = await post(location.origin+`/consultaexterna/user/medico/agenda/medicos`,formData);
        d.querySelector(".overlay").classList.add("d-none")


    let medicos = useState['medicos'].map(x=>{
        return {
            "id":x['user_id_medico'],
            "description":x['medico_descripcion'],
            }
        })
    let inputSelect2 = d.querySelector(`select[name='user_id_medico']`)
        inputSelect2.innerHTML = null
        inputSelect2.append($select(medicos))



}
let solicitud_cita_textarea_MOTIVO_CITA = async ($App)=>{
    let cita_motivo = $App.querySelector(`textarea[name='cita_motivo']`).value
    if ( !is_empty(cita_motivo) ) {
        useState['formCreateCita']['cita_motivo'] = cita_motivo
        /* $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-danger")
        $App.querySelector(`.item-7`).classList.add("bg-success")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-invalid")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-valid") */
        //console.log( useState['formCreateCita'] )
    } else {
        useState['formCreateCita']['cita_motivo'] = ""
        /* $App.querySelector(`.item-7`).classList.remove("bg-primary","bg-success")
        $App.querySelector(`.item-7`).classList.add("bg-danger")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.add("is-invalid")
        $App.querySelector(`textarea[name='cita_motivo']`).classList.remove("is-valid") */
        //console.log( useState['formCreateCita'] )
    }
}
export let create = async ()=>{
    //let $App= $qs(`${useState['tab']} #App`)
    //ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)

    let $form = clone( "artefacto_0040" )
        $App.innerHTML=null
        $App.append( $form )

        //Carga de los seguros en el select #cat_seguro_id
        let seguros = await get(`/consultaexterna/cat_seguro/all`)
        let select_cat_seguro_id = document.getElementById('cat_seguro_id');
        seguros.forEach((seguro, index) => {
            let nuevaOpcion_cat_seguro_id = document.createElement('option');
            nuevaOpcion_cat_seguro_id.text = seguro.name;
            nuevaOpcion_cat_seguro_id.value = seguro.id;
            select_cat_seguro_id.appendChild(nuevaOpcion_cat_seguro_id);
        });

        //Carga de las empresas en el select #cat_empresa_id
        let empresas = await get(`/consultaexterna/cat_empresa/all`)
        let select_cat_empresa_id = document.getElementById('cat_empresa_id');
        empresas.forEach((empresa, index) => {
            let nuevaOpcion_cat_empresa_id = document.createElement('option');
            nuevaOpcion_cat_empresa_id.text = empresa.razon_social;
            nuevaOpcion_cat_empresa_id.value = empresa.id;
            select_cat_empresa_id.appendChild(nuevaOpcion_cat_empresa_id);
        });

        //Carga de los departamentos en el select #directorio_organizacional_id
        let departamentos = await get(`/consultaexterna/department/all`)
        let select_directorio_organizacional_id = document.getElementById('directorio_organizacional_id');
        departamentos.forEach((departamento, index) => {
            let nuevaOpcion_directorio_organizacional_id = document.createElement('option');
            nuevaOpcion_directorio_organizacional_id.text = departamento.name;
            nuevaOpcion_directorio_organizacional_id.value = departamento.id;
            select_directorio_organizacional_id.appendChild(nuevaOpcion_directorio_organizacional_id);
        });

        if (!is_null(localStorage.getItem('component_search_cedula'))) {
            let cedula = localStorage.getItem('component_search_cedula')
                $App.querySelector(`input[name='cedula']`).value = cedula.replace(/\./g, '')
            // let result = useState['users'].find(x => equalsInt(x.cedula,cedula) )
            // console.log("result --> ", result)
            //if (result.length > 0) {
                // useState['formCreateCita']['user_id_paciente'] =result['user_id']
                // $App.querySelector("input[name='user_id_paciente']").value = result['user_id']
                get(`/consultaexterna/user/profile/show_by_cedula/${cedula.replace(/\./g, '')}`)
                .then(response=>{
                    // console.log( response );
                    useState['formCreateCita']['user_id_paciente'] = response.id
                    $App.querySelector("input[name='user_id_paciente']").value = response.id
                })
                /* $App.querySelector("input[name='cedula']").classList.remove("is-invalid")
                $App.querySelector("input[name='cedula']").classList.add("is-valid")
                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-1`).classList.add("bg-success") */
            //}
            localStorage.removeItem('component_search_cedula');
        }

        solicitud_cita_select_ESPECIALIDAD($App)

        //EVENTO CEDULA
        $App.querySelector(`input[name='cedula']`).addEventListener("change",async function(e){
            solicitud_cita_input_CEDULA($App)
        })
        //EVENTO ESPECIALIDAD
        $App.querySelector(`select[name='cat_especialidad_id']`).addEventListener("change",async function(e){
            solicitud_cita_select_CENTRO_SALUD($App)
        })
        //EVENTO CENTRO SALUD
        $App.querySelector(`select[name='centro_salud_id']`).addEventListener("change",async function(e){
            solicitud_cita_select_MEDICO($App)
        })
        //EVENTO medico
        $App.querySelector(`select[name='user_id_medico']`).addEventListener("change",async function(e){
            activarCalendario()
        })

        $App.addEventListener("click",function(e){
            //EVENTO CALENDARIO
            if (e.target.classList.contains("cita-hora")) {
                //saveDataForm({"name":"cita_hora","value":e.target.dataset.hora})

                $App.querySelector('#cita_hora').value = e.target.dataset.hora
                useState['formCreateCita']['cita_hora'] = e.target.dataset.hora
                final_hora = formatAMPM( new Date(e.target.dataset.hora) ).toUpperCase()
                //inputValidation2('cita_hora')
                console.log(useState['formCreateCita'])
            }
            //EVENTO MODALIDAD CITA
            if (e.target.matches("input[name='condicion_administrativa']")) {
                useState['formCreateCita']['condicion_administrativa'] = e.target.value
                d.querySelector(`input[name='condicion_administrativa']`).value = e.target.value
                //$App.querySelector(`.item-8`).classList.remove("bg-primary","bg-danger")
                //$App.querySelector(`.item-8`).classList.add("bg-success")
                console.log( useState['formCreateCita'] )
            }
        })
        //EVENTO MOTIVO CONSULTA
        $App.querySelector(`textarea[name='cita_motivo']`).addEventListener("change",async function(e){
            solicitud_cita_textarea_MOTIVO_CITA($App)
        })
        //EVENTO ARCHIVO REFERENCIA MEDICO
        $App.querySelector(`input[name='informe_general']`).addEventListener("change",async function(e){
            useState['formCreateCita']['file'] = equalsInt( $App.querySelector("#informe_general").files.length,0) ? null : $App.querySelector("#informe_general").files
            console.log( useState['formCreateCita'] )
        })
        //EVENTO REGISTRAR CITA
        $App.querySelector("#btn_enviar").addEventListener("click", async function(e){
            e.preventDefault()
            let input = d.querySelector(`input[name='cedula']`)
                if (is_empty( input.value )) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Debe escribir una cédula válida",
                            didClose: () => {
                                setTimeout(() => input.focus() , 110);
                            }
                        })
                    return false
                }
                input = d.querySelector(`select[name='cat_especialidad_id']`)
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
                input = d.querySelector(`select[name='centro_salud_id']`)
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
                input = d.querySelector(`select[name='user_id_medico']`)
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
                input = d.querySelector(`input[name='cita_dia']`)
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
                input = d.querySelector(`input[name='cita_hora']`)
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

                input = d.querySelector(`input[name='condicion_administrativa']`)

                if(input.value === 'Seguro'){
                    if(document.getElementById("cat_seguro_id").value !== '' && !is_empty(document.getElementById("cat_seguro_id").value)){
                        useState['formCreateCita']['cat_seguro_id'] = document.getElementById("cat_seguro_id").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha elegido a qué seguro pertenece el paciente."
                        })
                        return false
                    }
                    if(document.getElementById("poliza_numero").value !== '' && !is_empty(document.getElementById("poliza_numero").value)){
                        useState['formCreateCita']['poliza_numero'] = document.getElementById("poliza_numero").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha introducido el número de póliza del seguro."
                        })
                        return false
                    }
                }

                if(input.value === 'Empresarial'){
                    if(document.getElementById("cat_empresa_id").value !== '' && !is_empty(document.getElementById("cat_empresa_id").value)){
                        useState['formCreateCita']['cat_empresa_id'] = document.getElementById("cat_empresa_id").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha elegido a qué empresa pertenece el paciente."
                        })
                        return false
                    }
                }

                if(input.value === 'Cortesía'){
                    if(document.getElementById("condicion_descripcion").value !== '' && !is_empty(document.getElementById("condicion_descripcion").value)){
                        useState['formCreateCita']['condicion_descripcion'] = document.getElementById("condicion_descripcion").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha ingresado el nombre del responsable de la cortesía."
                        })
                        return false
                    }
                }

                if(input.value === 'Empleado'){
                    if(document.getElementById("directorio_organizacional_id").value !== '' && !is_empty(document.getElementById("directorio_organizacional_id").value)){
                        useState['formCreateCita']['directorio_organizacional_id'] = document.getElementById("directorio_organizacional_id").value
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "No se ha elegido a qué departamento pertenece el empleado."
                        })
                        return false
                    }
                }

                input = d.querySelector(`textarea[name='cita_motivo']`)
                if (is_empty( input.value )) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Escriba el motivo de su cita."
                            /* didClose: () => {
                                setTimeout(() => input.focus() , 110);
                            } */
                        })
                    return false
                }
            //if (formCreateValidate()) {

            // console.log(`useState['formCreateCita'] --> ${JSON.stringify(useState['formCreateCita'],null,2)}`)
                //let $App= $qs(`${useState['tab']}`)
            Swal.fire({
                title: '¿Deseas enviar la solicitud?',
                //text: "Recomendamos solo cancelar, 12 o 24 horas antes, del día y hora aprobados de la cita. Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, enviar!'
            }).then( async (result) => {
                if (result.isConfirmed) {

                    let formData = new FormData();

                        for (const key in useState['formCreateCita']) {
                            if (Object.hasOwnProperty.call(useState['formCreateCita'], key)) {
                                let element = useState['formCreateCita'][key];
                                    formData.append(key,element)
                            }
                        }
                    /* let files = equalsInt( d.querySelector("#informe_general").files.length,0) ? null : d.querySelector("#informe_general").files
                        formData.append("file", files );
                        formData.append("user_id_paciente", $App.querySelector("input[name='user_id_paciente']").value ); */
                        formData.append("created_at",timestamps() );
                        formData.append("_token",d.querySelector("#_token").value)
                        d.querySelector(".overlay").classList.remove("d-none")
                    let $response = await post("/consultaexterna/paciente/cita/store",formData)
                        // if($response=="maximo_citas_alcanzado"){
                        //     d.querySelector(".overlay").classList.add("d-none")
                        //     Swal.fire(
                        //         'Máximo de citas activas superada.',
                        //         'No puede tener más de dos citas activas.',
                        //         'error'
                        //     )
                        //     return false

                        // }
                        await updateCitas($response)
                        ComponentMedicoHome.enrutador("#tab_citas")
                        useState.status_current_tab = 1
                        ComponentMedicoHome.handle_tablaCitas(useState.status_current_tab, "Citas por ponfirmar")
                        await ComponentMedicoHome.updateTotales()
                        ComponentMedicoHome.handle_tablaCitas(useState.status_current_tab)
                        d.querySelector(".overlay").classList.add("d-none")
                        //d.querySelector("#headerCitaStatusOptions").classList.remove("d-none")
                        Swal.fire(
                            'Cita Creada!',
                            'El paciente será notificado de esta acción',
                            'success'
                        )
                }
            })
            //}
                //alert("cita creada")





        })
        $('#calendar').datepicker().on("changeDate", function(e) {

            let user_id_medico = d.querySelector(`select[name='user_id_medico']`).value;
            let f = new Date(e.date);
            let anio = String(f.getFullYear())
            let mes  = String(f.getMonth() + 1).padStart(2, '0')
            let dia  = String(f.getDate()).padStart(2, '0')
            let fechaIngreso = anio + "-" + mes + "-" + dia;
                useState['formCreateCita']['cita_dia'] = fechaIngreso
                document.getElementById("cita_dia").value=fechaIngreso


                document.getElementById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día seleccionado:</b><br><span class="badge  badge-info">${fechaCortaCustom1(e.date)}</span>
                `

            let medicoFechas =  useState['medicos'].find(medico=>equalsInt(medico['user_id_medico'],user_id_medico))['agenda']
                medicoFechas = JSON.parse(medicoFechas)
                medicoFechas =  medicoFechas.map(fecha=>{
                                    let fc = new Date(fecha['day'])
                                        return {
                                            "day": String(fc.getDate()).padStart(2, '0'),
                                            "month": String(fc.getMonth() + 1).padStart(2, '0'),
                                            "year": String(fc.getFullYear()).padStart(2, '0'),
                                            "hour": String(fc.getHours()).padStart(2, '0')+":"+String(fc.getMinutes()).padStart(2, '0'),
                                            "visibilidad":fecha['visibilidad']
                                        }
                                })
                //console.log("medicoFechas",medicoFechas)
            let medicoHoras = medicoFechas.filter(fecha=>{
                    if (
                        fecha['month'] === mes &&
                        fecha['day'] === dia

                    ) {
                        return fecha
                    }
                }) //.map(fecha=>fecha['hour'])
                //console.log("medicoHoras",medicoHoras)
                d.querySelector('#pills-am ul.nav').innerHTML =""
                if (medicoHoras.length == 0) {
                    d.querySelector('#pills-am ul.nav').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }else{
                    medicoHoras.forEach((hora,key)=>{
                        console.log(hora);
                        let textColor =""
                        if (
                            hora['visibilidad']==="privada"
                        ) {
                            textColor ="font-weight-bold border border-default"
                            //ocultar horas privadas a los siguientes usuarios
                            //console.log(useState['user_id_medico'], 357585)
                            if (
                                /* ![
                                    355511,//mag
                                    96, //lg
                                    113590,//ln
                                    64233,//db
                                    95,//mg
                                    25, //pm
                                    22, //lp
                                    357137, //ls
                                    356153, //as
                                ].includes( Number(useState['user_id_medico']) ) */
                                useState['ver_citas_privadas'] === 0
                            ) {
                                textColor +=" d-none"
                            }
                        }

                        let h = horaAMPM( hora['hour'] ).toUpperCase()
                            d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora mr-1" data-hora="${hora['hour']}" role="presentation">
                                    <a class="nav-link cita-hora ${textColor}" id="hora-pm-${key}-tab" data-hora="${hora['hour']}" data-toggle="pill" href="#pills-pm-${hora['hour']}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                }


        });
        /* $('#calendar').datepicker().on("changeDate", function (e) {

            let d = document;
            let f = new Date(e.date);
            let dia_del_mes = ("0" + f.getDate()).slice(-2);
            let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth() + 1)).slice(-2) + "-" + dia_del_mes;
                useState['formCreateCita']['cita_dia'] = dia_del_mes
                console.log(useState['formCreateCita'])
                document.getElementById("cita_dia").value = fechaIngreso
                //console.log(useState['formCreateCita'])
                document.getElementById("mensaje_dia_seleccionado").innerHTML = `
                                <b>Día seleccionado:</b> <span class="badge badge-primary">${fechaCortaCustom1(e.date)}</span>
                            `
                final_dia = fechaCortaCustom1(e.date)

                //$App.querySelector(`.item-5`).classList.remove("bg-danger","bg-primary")
                //$App.querySelector(`.item-5`).classList.add("bg-success")

            //let horas = useState.get_medico_agenda_horas( onChange_agenda_id, f )
            let horas = get_medico_agenda_horas(onChange_agenda_id, f)
                //console.log("----------->>>",horas)
                $App.querySelector('#pills-am ul.nav').innerHTML =""
                $App.querySelector('#pills-pm ul.nav').innerHTML =""
                if (horas.horas_am.length > 0) {

                    horas.horas_am.forEach((hora,key)=>{

                        let h = formatAMPM( new Date(hora) ).toUpperCase()
                            $App.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-am-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-am-${key}" role="tab" aria-controls="pills-am-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                }
                if (horas.horas_pm.length > 0) {

                    horas.horas_pm.forEach((hora,key)=>{
                        let h = formatAMPM( new Date(hora) ).toUpperCase()
                            $App.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-pm-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-pm-${key}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                }
                if (horas.horas_pm.length == 0 && horas.horas_am.length == 0) {
                    d.querySelector('#pills-am ul.nav').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }
        }); */
        $('#calendar').datepicker('destroy')
        $('#calendar').empty()
}
export let createRespaldo = async ()=>{
    let $App= $qs(`${useState['tab']} #App`)
    let $form = clone( "artefacto_0040" )
        $App.innerHTML=null
        $App.append( $form )
        $App.querySelector("h3").classList.add("d-none")
        d.querySelector(".cat-cita-status-title").textContent="Nueva Cita"
        document.getElementById("tab_consulta_overlay").classList.remove("d-none")



        if (!is_null(localStorage.getItem('component_search_cedula'))) {
            let cedula = localStorage.getItem('component_search_cedula')
                d.querySelector(`${useState['tab']} input[name='cedula']`).value = cedula.replace(/\./g, '')
            let result = useState['users'].filter(x =>{
                if (parseInt(x.cedula) ===  parseInt(cedula) ) {
                    return  x
                }

            })
            //if (result.length > 0) {
                useState['formCreateCita']['user_id_paciente'] = first(result)['user_id']
                $App.querySelector("input[name='user_id_paciente']").value = first(result)['user_id']
                $App.querySelector("input[name='cedula']").classList.remove("is-invalid")
                $App.querySelector("input[name='cedula']").classList.add("is-valid")
                $App.querySelector(`.item-1`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-1`).classList.add("bg-success")
            //}
            localStorage.removeItem('component_search_cedula');
        }



        $App.querySelector(`select[name='centro_salud_id']`).innerHTML = null
        /**inicio */

    let data = useState['centro_salud']
    let $fragment = document.createDocumentFragment()
    let $option = document.createElement("option")
        $option.value = ""
        $option.textContent = "Seleccione"
        $fragment.appendChild($option)
        data.forEach(x=>{
            $option = document.createElement("option")
            $option.value =x.id
            if ( equalsInt(x.id, useState['user_centro_salud_id']) ) {
                $option.selected=true
                $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
                $App.querySelector(`.item-2`).classList.add("bg-success")
                $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
                $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
            }
            $option.textContent = `${x.description} ${x['especialidades'].length > 0 ? '('+x['especialidades'].length+')' : ''}`
            $fragment.appendChild($option)
        })
        $App.querySelector(`select[name='centro_salud_id']`).append($fragment)
        /**fin */

        /**incio */
        $App.addEventListener("change", async function (e) {
            formValidate(e)
        })
        /**fin */

        /**inicio */
        let centro_salud_id = $App.querySelector(`select[name='centro_salud_id']`).value

        let centro_salud_especialidades = first(useState['centro_salud'].filter(centro_salud=> equalsInt(centro_salud.id , centro_salud_id) ))['especialidades']

            $App.querySelector(`select[name='cat_especialidad_id']`).innerHTML = null
            $App.querySelector(`select[name='user_id_medico']`).innerHTML = null
            $fragment = document.createDocumentFragment()
            $option = document.createElement("option")
            $option.value = ""
            if (centro_salud_especialidades.length === 0) {
                $option.style.color="#a4b2bd"
                $option.disabled=true
            }
            //tab_app_overlay
            $option.textContent = "Seleccione"
            $fragment.appendChild($option)
            if (centro_salud_especialidades.length > 0) {
                centro_salud_especialidades.forEach(especialidad=>{
                    $option = document.createElement("option")
                    $option.value =especialidad.cat_especialidad_id //
                    //let total_agendas = useState['medicos_agenda'].filter( agenda => equalsInt( agenda.cat_especialidad_id , especialidad.cat_especialidad_id ) )

                    //***** */
                    let agenda = useState['medicos_agenda'].filter(z => equalsInt(z.centro_salud_id, centro_salud_id) && equalsInt(z.cat_especialidad_id, especialidad.cat_especialidad_id)  )
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

            $App.querySelector(`select[name='cat_especialidad_id']`).append($fragment)

            $App.querySelector(`.notification-especialidad b`).textContent= centro_salud_especialidades.length
            if (centro_salud_especialidades.length > 0) {
                $App.querySelector(`.notification-especialidad`).classList.remove("d-none")
            }else{
                $App.querySelector(`.notification-especialidad`).classList.add("d-none")
            }
            useState['formCreateCita']['centro_salud_id'] = parseInt( centro_salud_id )

            $App.querySelector(`.item-2`).classList.remove("bg-primary","bg-danger")
            $App.querySelector(`.item-2`).classList.add("bg-success")
            $App.querySelector(`select[name='centro_salud_id']`).classList.remove("is-invalid")
            $App.querySelector(`select[name='centro_salud_id']`).classList.add("is-valid")
        /**fin */

        /**inicio */
        $('#calendar').datepicker().on("changeDate", function (e) {
            let d = document;
            let f = new Date(e.date);
            let dia_del_mes = ("0" + f.getDate()).slice(-2);
            let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth() + 1)).slice(-2) + "-" + dia_del_mes;
                useState['formCreateCita']['cita_dia'] = dia_del_mes
                document.getElementById("cita_dia").value = fechaIngreso
                //console.log(useState['formCreateCita'])
                document.getElem