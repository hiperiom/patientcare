import {} from '../../helpers/helpers.js'
import * as ComponentRecipe from '../paciente/user_recipe_cita.js'
import * as ComponentEstudio from '../paciente/user_estudio_cita.js'
import * as ComponentMedicoHome from '../medico/medico_home.js?version = 0.1'
import * as ComponentCreate from './create.js'
import * as ComponentIndex from './index.js'
import * as ComponentShow from './show.js'
import * as ComponentStore from './store.js'
import * as ComponentUpdate from './update.js'
import * as ComponentDestroy from './destroy.js'
import * as ComponentLaboratorio from '../paciente/user_laboratorio_consulta.js'
import * as ComponentFotografia from '../paciente/user_fotografias_consulta.js'
import * as ComponentImagenes from '../paciente/user_imagenes_consulta.js'
import * as ComponentOtroArchivo from '../paciente/user_otros_archivos_consulta.js'

import { init as OtroArchivo, index as OtroArchivo_index } from '../paciente/user_otros_archivos_consulta.js'
let d = document

export let create = async () => {
        init()
        ComponentCreate.create()
    }
export let store = async (item_id) => {
       ComponentIndex()
    }
export let show = async (item_id) => {
       ComponentShow()
    }
export let update = async (item_id) => {
       ComponentStore()
    }
export let destroy = async (item_id) => {
       ComponentUpdate()
    }
export let index = async (item_id) => {
       ComponentDestroy()
    }

export let init = async ($tab="#tab_app") => {
        //useState['users'] = items
        useState['tab'] = $tab
        ComponentMedicoHome.enrutador($tab)

    }
let store_motivo_consulta = async (cita_id, value, user_id_paciente) => {
    let formData = new FormData();
    formData.append("cita_id", cita_id)
    formData.append("value", value)
    formData.append("user_id_paciente", user_id_paciente)
    formData.append("created_at", timestamps())

    formData.append("_token", entById('_token').value)
    return await post("/consultaexterna/user/paciente/motivo_consulta/store", formData)
}
let store_impresion_diagnostica = async (cita_id, value, user_id_paciente) => {
    let formData = new FormData();
    formData.append("cita_id", cita_id)
    formData.append("value", value)
    formData.append("user_id", user_id_paciente)
    formData.append("created_at", timestamps())

    formData.append("_token", entById('_token').value)
    return await post("/consultaexterna/user/paciente/impresion_diagnostica/store4", formData)
}
let store_examen_fisico = async (cita_id, value, user_id_paciente) => {
    let formData = new FormData();
    formData.append("cita_id", cita_id)
    formData.append("value", value)
    formData.append("user_id", user_id_paciente)
    formData.append("created_at", timestamps())

    formData.append("_token", entById('_token').value)
    return await post("/consultaexterna/user/paciente/examen_fisico/store", formData)
}
let store_enfermedad_actual = async (cita_id, value, user_id_paciente) => {
    let formData = new FormData();
    formData.append("cita_id", cita_id)
    formData.append("value", value)
    formData.append("user_id", user_id_paciente)
    formData.append("created_at", timestamps())

    formData.append("_token", entById('_token').value)
    return await post("/consultaexterna/user/paciente/enfermedad_actual/store", formData)
}
let store_plan = async (cita_id, value, user_id_paciente) => {
    let formData = new FormData();
    formData.append("cita_id", cita_id)
    formData.append("value", value)
    formData.append("user_id", user_id_paciente)
    formData.append("created_at", timestamps())

    formData.append("_token", entById('_token').value)
    return await post("/consultaexterna/user/paciente/plan/store2", formData)
}
let store_cita = async (cita_id, campo, valor, user_id_paciente) => {
    let formData = new FormData();
    formData.append("cita_id", cita_id)
    formData.append('campo', campo);
    formData.append('valor', valor);
    formData.append("user_id", user_id_paciente)
    formData.append("created_at", timestamps())

    formData.append("_token", entById('_token').value)
    return await post("/consultaexterna/user/paciente/cita/update/" + cita_id, formData)
}
let set_item_cita = (cita_id, item, value) => {
    let index = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
    useState.citas[index][item] = value
}
export let handle_events = ()=>{

    d.querySelector("#tab_consulta").addEventListener("change", async function (e) {
        let cita_id = this.dataset.user_cita_id
        let user_id_paciente = this.dataset.user_id_paciente

        if (e.target.matches("textarea[name='user_motivo_consulta']")) {
            //console.log(e.target.value)
            let model = await store_motivo_consulta(
                cita_id,
                e.target.value,
                user_id_paciente
            )
            console.log(model)
            if (e.target.value === model.value) {
                e.target.classList.add("is-valid")
            }else{
                e.target.classList.remove("is-valid")
            }
            set_item_cita(cita_id, "user_motivo_consulta", model)
        }
        if (e.target.matches("textarea[name='user_impresion_diagnostica']")) {
            //console.log(e.target.value)
            let model = await store_impresion_diagnostica(
                cita_id,
                e.target.value,
                user_id_paciente
            )
            if (e.target.value === model.value) {
                e.target.classList.add("is-valid")
            }else{
                e.target.classList.remove("is-valid")
            }
            set_item_cita(cita_id, "user_impresion_diagnostica", model)
        }
        if (e.target.matches("textarea[name='user_examen_fisico']")) {
            //console.log(e.target.value)
            let model = await store_examen_fisico(
                cita_id,
                e.target.value,
                user_id_paciente
            )
            if (e.target.value === model.value) {
                e.target.classList.add("is-valid")
            }else{
                e.target.classList.remove("is-valid")
            }
            set_item_cita(cita_id, "user_examen_fisico", model)
        }
        if (e.target.matches("textarea[name='user_enfermedad_actual']")) {
            //console.log(e.target.value)
            let model = await store_enfermedad_actual(
                cita_id,
                e.target.value,
                user_id_paciente
            )
            if (e.target.value === model.value) {
                e.target.classList.add("is-valid")
            }else{
                e.target.classList.remove("is-valid")
            }
            set_item_cita(cita_id, "user_enfermedad_actual", model)
        }
        if (e.target.matches("textarea[name='user_plan']")) {
            //console.log(e.target.value)
            let model = await store_plan(
                cita_id,
                e.target.value,
                user_id_paciente
            )
            if (e.target.value === model.value) {
                e.target.classList.add("is-valid")
            }else{
                e.target.classList.remove("is-valid")
            }
            set_item_cita(cita_id, "user_plan", model)
        }
        if (
            e.target.matches("select[name='hospitalizacion']") ||
            e.target.matches("select[name='terapia_intensiva']") ||
            e.target.matches("select[name='cirugia']")
        ) {
            //console.log(e.target.value)
            //cita_id, campo,valor,user_id_paciente
            let model = await store_cita(
                cita_id,
                e.target.name,
                e.target.value,
                user_id_paciente
            )
            set_item_cita(cita_id, e.target.name, model)
        }
    })
}
