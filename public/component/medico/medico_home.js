import { first, $selectCustom, emptyItem, removeAccents , dia_semana, recalcularAltoPagina,fechaUserCita, mes, item_historial_cita, active_form, cargandoModal, item_historial_cita2, get, is_null  } from '../../helpers/helpers.js'

//import { create as PacienteCreate, edit as PacienteEdit } from '../user/user_create.js'
import { create as MedicoCreate } from './medico.js'
import * as ComponentMedico from './medico.js?version = 0.1'
import * as ComponentPaciente from '../paciente/paciente.js'
import * as ComponentAgenda from '../agenda/agenda.js'
import * as ComponentBuscador from '../medico/search.js'
import * as ComponentCita from '../cita/cita.js'
import * as CitaCreate from '../cita/create.js'
import * as ComponentRecipe from '../paciente/user_recipe_cita.js'
import * as ComponentEstudio from '../paciente/user_estudio_cita.js'
import * as ComponentLaboratorio from '../paciente/user_laboratorio_consulta.js'
import * as ComponentFotografia from '../paciente/user_fotografias_consulta.js'
import * as ComponentImagenes from '../paciente/user_imagenes_consulta.js'
import * as ComponentOtroArchivo from '../paciente/user_otros_archivos_consulta.js'
import * as ComponentEspecialidad from '../catalogs/cat_especialidad_medica.js'


let d = document
let onChange_agenda_id;
let final_hora;
let final_dia;
let $header = d.querySelector("#headerCitaStatusOptions")
let $sidebar = d.querySelector(".nav-sidebar")
let tableFilter = (inputSearch,tableId) => {
    let busqueda = document.getElementById(inputSearch);
    let table = document.getElementById(tableId).tBodies[0];

    let buscaTabla = function() {
        let texto = busqueda.value.toLowerCase();
        let r = 0;
        let row
        while (row = table.rows[r++]) {
            if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                row.style.display = null;
            else
                row.style.display = 'none';
        }
    }

    busqueda.addEventListener('change', buscaTabla);

}
let get_citas_by_status = (status_id) => {
    let citas = useState['citas'].filter(x => equalsInt(x['cat_user_cita_status_id'], status_id))
    return filtrarPor(citas)
}
let get_cita = async (cita_id) => {
    // console.dir(`first(useState['citas'].filter(x => equalsInt(x.user_cita_id, cita_id))) --> ${JSON.stringify(first(useState['citas'].filter(x => equalsInt(x.user_cita_id, cita_id))))}`)
    return await first(useState['citas'].filter(x => equalsInt(x.user_cita_id, cita_id)))
}

let get_cita_fecha = async (cita_id) => {

    let cita = await get_cita(cita_id)
    //console.log(cita)
    return cita.year + "-" + cita.month + "-" + cita.day + " " + cita.hour
}
let paciente = (user_id) => {
    return first(useState['users'].filter(x => equalsInt(x.user_id, user_id)))
}
let tarjetasoychacao = (user_id) => {


    let response = first(useState['users'].filter(x => equalsInt(x.user_id, user_id) ) )
    //console.log("tarjetasoychacao->",response)
        if (!is_null(response)) {
            return response.tarjeta_soy_chacao
        } else {
            return undefined
        }
}
let get_rowTable = async (cita) => {
    // console.log("paciente->",cita)
    let $row_new_cita = d.querySelector("#artefacto_0018").content.cloneNode(true)

    // $row_new_cita = d.importNode($row_new_cita, true)
    //let paciente = useState['users'].find(x => equalsInt(x.user_id, cita.user_id_paciente ))
    //console.log("paciente",paciente)
    // if (is_undefined(paciente) ) {
        // if (paciente === 'undefined') {
        //     console.log("user_paciente_id->",cita)
        //     return 'Paciente no encontrado'
        // }else{


        //condicion administrativa
        //particular --seguro cual? -- cortesia convenio?
        //console.log("user_id->",cita.user_id_paciente,"paciente->",paciente)
        // console.log(`cita --> ${JSON.stringify(cita)}`)
        $row_new_cita.querySelector("tr").classList.add(`row-cita-${cita.user_cita_id}`)
        $row_new_cita.querySelector(".card-item-paciente-image").src = cita.imagen_paciente
        $row_new_cita.querySelector("small").textContent = "#citaid" + cita.user_cita_id +" "+ "#userid" + cita.user_id_paciente
        $row_new_cita.querySelector(".card-item-paciente-solicitud-fecha").innerHTML = `
            ${fechaAPPLE(cita.created_at)}
            <div style="font-size:0.8rem">
                <small style="color:transparent">#cita_id: ${cita.user_cita_id}</small>
                <small style="color:transparent">#user_id_paciente: ${cita.user_id_paciente}</small>
            </div>

        `
        $row_new_cita.querySelector(".card-item-paciente-fullname").textContent = cita.paciente
        $row_new_cita.querySelector(".card-item-paciente-cedula").textContent = cita.cedula_paciente
        $row_new_cita.querySelector(".card-item-paciente-edad").textContent = cita.edad
        $row_new_cita.querySelector(".card-item-paciente-genero").textContent = cita.genero_paciente.toUpperCase()
        $row_new_cita.querySelectorAll(".paciente-edit").forEach(x=>x.dataset.user_id_paciente=cita.user_id_paciente)

        if (!is_null(cita.tarjeta_soy_chacao)) {
            $row_new_cita.querySelector(".tarjeta-salud-chacao").classList.add("bg-chacao")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.remove("text-gray")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.add("text-white")
            $row_new_cita.querySelector(".card-item-paciente-tarjeta-chacao").textContent = cita.tarjeta_soy_chacao
        } else {
            $row_new_cita.querySelector(".tarjeta-salud-chacao").classList.remove("bg-chacao")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.remove("text-white")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.add("text-gray")
            $row_new_cita.querySelector(".card-item-paciente-tarjeta-chacao").textContent = 'No posee'
        }

        let color = "success"
        $row_new_cita.querySelectorAll(".enlace-whatsapp").forEach(x => {
            x.dataset.telefono_movil = cita.telefono_movil
        })
        $row_new_cita.querySelector(".card-item-paciente-telefono-movil").textContent = `${!is_null(cita.telefono_movil) ? cita.telefono_movil : 'No Indicado'}`

        if (
            cita['condicion_administrativa'] === "Cortesía"
            && !is_null( cita['condicion_descripcion'] )
        ) {
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none")
            $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Cortesía autorizada por: ${cita["condicion_descripcion"]}`
        }
        if (
            cita['condicion_administrativa'] === "Particular"
        ) {
            color ="success"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Particular`
        }
        if (
            cita['condicion_administrativa'] === "Seguro"
        ) {
            color ="info"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            if(cita.cat_seguro_id !== null){
                let seguro = await get(`/consultaexterna/cat_seguro/get_by_id/${cita.cat_seguro_id}`)
                cita['seguro_nombre'] = seguro.name
                $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Asegurado | ${cita["seguro_nombre"]} | Póliza: ${cita["poliza_numero"]}`
            }
        }
        if (
            cita['condicion_administrativa'] === "Empresarial"
        ) {
            color ="purple"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            if(cita.cat_empresa_id !== null){
                let empresa = await get(`/consultaexterna/cat_empresa/get_by_id/${cita.cat_empresa_id}`)
                cita['empresa_nombre'] = empresa.razon_social
                $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Empresarial | ${cita["empresa_nombre"]}`
            }
        }
        if (
            cita['condicion_administrativa'] === "Empleado"
        ) {
            color ="orange"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            if(cita.department_id !== null){
                let departamento = await get(`/consultaexterna/department/get_by_id/${cita.department_id}`)
                cita['departamento_nombre'] = departamento.shortname
                $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Empleado | ${cita["departamento_nombre"]}`
            }
        }
        if (
            !is_null( cita['user_cita_id_referenciado'] )
        ) {
            $row_new_cita.querySelector(".tag-condicion-cortesia-referido").classList.remove("d-none")
            $row_new_cita.querySelector(".tag-condicion-cortesia-referido").classList.add(`border-${color}`,`text-${color}`)
            $row_new_cita.querySelector(".tag-condicion-cortesia-referido").innerHTML = cita['descripcion_referenciado']
        }
        if ( cita['exonerado'] > 0) {
            let bgColor ="bg-danger"
                if (
                    cita['exonerado'] >24 &&
                    cita['exonerado'] <=49
                ) {
                    bgColor = "bg-info"
                }
                if (
                    cita['exonerado'] >49 &&
                    cita['exonerado'] <=74
                ) {
                    bgColor = "bg-warning"
                }
                if (
                    cita['exonerado'] >74 &&
                    cita['exonerado'] <=100
                ) {
                    bgColor = "bg-success"
                }

                $row_new_cita.querySelector(".tag-exonerado").classList.add("d-flex",bgColor)
                $row_new_cita.querySelector(".tag-exonerado").innerHTML = `<i class="fas fa-check-double"></i> Exonerado ${paciente['exonerado']}%`
        }

        $row_new_cita.querySelector(".card-item-paciente-cita-medico").textContent = cita.medico
        $row_new_cita.querySelector(".card-item-paciente-cita-especialidad").textContent = cita.especialidad_nombre
        $row_new_cita.querySelector(".card-item-paciente-cita-fecha").textContent = fechaTextoCustom1({
            "day": cita.day,
            "month_name": cita.mes_nombre,
            "year": cita.year,
        })
        $row_new_cita.querySelector(".card-item-paciente-cita-hora").textContent = horaAMPM(cita.hour)
        $row_new_cita.querySelectorAll(".botones-fila a").forEach((opcion, button) => {
            /*
                botones:
                0 Confirmar
                1 Reprogramar
                2 Preconsulta
                3 Registra signos vitales
                4 Atender Consulta
                5 Cancelar
                6 ¿atendido?
                7
            */

            let cat_user_cita_status_id = 4
            //botenes a ocultar por cada pestaña:
            //console.log(useState.status_current_tab,[1, 6, 8], parseInt(opcion.dataset.btnId))
            if (useState.status_current_tab == 1 && ![0, 1, 6, 7, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 2 && ![0,1, 6, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 4 && ![1, 6, 8, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 5 && ![1, 4, 6, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 6 && ![1, 5, 6, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }

            if (button == 1) {
                cat_user_cita_status_id = 2
            }
            if (button == 2) {
                cat_user_cita_status_id = 3
            }
            if (!is_null(opcion.querySelector("img"))) {
                opcion.querySelector("img").dataset.cita_id = cita.id
                opcion.querySelector("img").dataset.user_id_paciente = cita.user_id_paciente
            }
            if( opcion.classList.contains("cita-referencia") ){

                if (!is_null( cita['informe_general'] )) {
                    opcion.dataset['route'] = is_null( cita['informe_general'] ) ? "": cita['informe_general'];
                    opcion.querySelector("i").dataset['route'] = is_null( cita['informe_general'] ) ? "": cita['informe_general'];

                }else{
                    opcion.title ="Referencia NO DISPONIBLE"
                    opcion.querySelector("i").title ="Referencia NO DISPONIBLE"
                    opcion.classList.add("disabled")

                }
            }
            opcion.dataset.cita_id = cita.id
            opcion.dataset.user_id_paciente = cita.user_id_paciente
        })

        return $row_new_cita

    // }
}
export let updateTotales = async (citas) => {
    $sidebar.querySelectorAll(".total-citas-poraprobar").forEach(x => {
        if (equalsInt(get_citas_by_status(1).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-primary")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(1).length
            x.classList.add("badge-primary")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-aprobadas").forEach(x => {
        if (equalsInt(get_citas_by_status(4).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-success")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(4).length
            x.classList.add("badge-success")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-preconsulta").forEach(x => {
        if (equalsInt(get_citas_by_status(5).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-warning")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(5).length
            x.classList.add("badge-warning")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-consulta").forEach(x => {
        if (equalsInt(get_citas_by_status(6).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-info")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(6).length
            x.classList.add("badge-info")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-reprogramadas").forEach(x => {
        if (equalsInt(get_citas_by_status(2).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-secondary")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(2).length
            x.classList.add("badge-secondary")
            x.classList.remove("badge-gray")
        }

    })


    $header.querySelector(".total-citas-poraprobar").textContent = get_citas_by_status(1).length
    $header.querySelector(".total-citas-aprobadas").textContent = get_citas_by_status(4).length
    $header.querySelector(".total-citas-preconsulta").textContent = get_citas_by_status(5).length

    if (useState['user_type_id'] === 2) {
        $header.querySelector(".total-citas-consulta").textContent = get_citas_by_status(6).length
    }
}
let set_item_cita = (cita_id, item, value) => {
    let index = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
    useState.citas[index][item] = value
}
let filtrarPor = (citas) => {
    citas = citas.filter(cita => {
        switch (useState['filtrar_por']) {
            case "solo_yo":
                if (equalsInt(cita['user_id_medico'], useState['user_id_medico'])) {
                    return cita
                }
            break;

            default:
                return cita
            break;
        }
    })
    return citas
}
export let handle_tablaCitas = async (status, titleTable = "Citas por confirmar") => {

    let $tableCitas = d.querySelector("#citas_pacientes tbody")
    $tableCitas.innerHTML = null
    d.querySelector(".cat-cita-status-title").classList.add("d-none")
    d.querySelector(".cat-cita-status-title").classList.remove("scale-in-hor-left")
    d.querySelector(".cat-cita-status-title").textContent = titleTable

    d.querySelector("#cargando").classList.remove("d-none")
    let citas = get_citas_by_status(status)
    if (equalsInt(citas.length, 0)) {
        $tableCitas.innerHTML = emptyItem("No se encontraron citas", 7)
        d.querySelector("#cargando").classList.add("d-none")
    } else {
        //filtrar por

        citas = filtrarPor(citas)
        /* if ( is_null( useState['users']) ) {
            let formData = new FormData();
            formData.append("pacientes_id", useState['citas'].map(x=>x['user_id_paciente']))
            formData.append("_token", d.querySelector("#_token").value)
            useState['users'] = await post(location.origin+"/user/userCitaAll",formData);
        } */
        /* let pacientes_id_faltantes = []
        citas.forEach( async cita => {
            let searchPaciente = useState['users'].find(x=>equalsInt(x['user_id'], cita.user_id_paciente))
            if ( is_undefined( searchPaciente ) ) {
                pacientes_id_faltantes.push(cita.user_id_paciente)
            }
        }) */
        /* if (!is_empty(pacientes_id_faltantes)) {
            let formData = new FormData();
            formData.append("pacientes_id", pacientes_id_faltantes )
            formData.append("_token", d.querySelector("#_token").value)
            let result = await post(location.origin+"/user/userCitaAll",formData)
            //console.log(useState['users'])
            //console.log("result",result.length)
            if (result.length === 1) {
                useState['users'].push( first(result))
            }else{
                result.forEach(x=>{
                    useState['users'].push( x )
                })
            }
            //console.log(useState['users'])
        } */

        citas.forEach( async cita => {
            let $row = await get_rowTable(cita)
            //console.log("$row",$row)
            $tableCitas.append($row)
        })
        d.querySelector("#cargando").classList.add("d-none")
        activarTooltip()
    }
    setTimeout(() => {
        d.querySelector(".cat-cita-status-title").classList.remove("d-none")
        d.querySelector(".cat-cita-status-title").classList.add("scale-in-hor-left")
    }, 200);
    activarTooltip()
    tableFilter("buscar_cita_listado","citas_pacientes")
    //$('#citas_pacientes').DataTable();
    //d.querySelector(".overlay").classList.add("d-none")
}
let handle_headerGroup = () => {
    let col_lg = 3
        if (useState['user_type_id'] !== 2) {
            col_lg = 4;
        }

    let $options = $header.querySelectorAll(`.col-lg-${col_lg}`)
        $options.forEach($option => {
            $option.addEventListener("click", async function (e) {
                let $options = $header.querySelectorAll(".small-box")
                    $options.forEach($option => {
                        $option.classList.remove(`shadow-lg-${$option.dataset.shadowColor}` )
                        d.querySelectorAll(".cat-cita-status-title")
                        .forEach(z=>{
                            z.classList.remove(`text-${$option.dataset.shadowColor}`)
                        })
                    })
                    this.querySelector(".small-box").classList.add( `shadow-lg-${ this.querySelector(".small-box").dataset.shadowColor}` )
                    d.querySelectorAll(".cat-cita-status-title")
                    .forEach(z=>{
                        z.classList.add(`text-${ this.querySelector(".small-box").dataset.shadowColor }`)
                    })

                    enrutador("#tab_citas")
                    await updateTotales()
                    useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
                let titleTable = e.currentTarget.dataset.name
                let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
                    console.log("cat_user_cita_status_id",cat_user_cita_status_id)
                    /* if ([1,4,5,6].includes( cat_user_cita_status_id )) {
                        cat_user_cita_status_id
                    } */
                    //d.querySelector("#headerCitaStatusOptions").classList.remove("d-none")
                    handle_tablaCitas(cat_user_cita_status_id, titleTable)

            })
        })
}
let handle_sidebarGroup = async (citas) => {
    $sidebar.querySelector(".sidebar-por-confirmar").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })
    $sidebar.querySelector(".sidebar-confirmadas").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })
    $sidebar.querySelector(".sidebar-preconsulta").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })
    if (useState['user_type_id'] === 2) {
        $sidebar.querySelector(".sidebar-consulta").addEventListener("click", function (e) {
            d.querySelector('body').classList.add("sidebar-collapse")
            enrutador("#tab_citas")
            useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
            let titleTable = e.currentTarget.dataset.name
            let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
            handle_tablaCitas(cat_user_cita_status_id, titleTable)
        })
    }

    $sidebar.querySelector(".sidebar-reprogramadas").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })



}
let handle_citas_confirmadas = async (e) => {
    d.querySelector("#tab_citas").classList.remove("d-none")
    d.querySelector("#tab_preconsulta").classList.add("d-none")
    let { cita_id, cat_user_cita_status_id } = e.target.dataset

    Swal.fire({
        title: '¿Desea confirmar esta cita?',
        //text: "Esta acción no se puede revertir!",
        iconHtml: '<i class="pc-warning text-warning" style="font-size:100px"></i>',
        customClass: {
            icon: 'border-0'
        },
        //icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2FA600',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Aún no!',
        confirmButtonText: 'Si, Confirmar!'
    }).then(async (result) => {


        if (result.isConfirmed) {
            d.querySelector(".overlay").classList.remove("d-none")
            // console.log("---->", cita_id,cat_user_cita_status_id)
            let fecha_cita = await get_cita_fecha(cita_id)
            //console.log("*****>>>   ", fecha_cita)
            //VALIDACION
            //SI LA CONFIRMACIÓN ES PARA UNA CITA QUE ES DEL MISMO DIA, LA ACTUALIZAREMOS A PRECONSULTA Y NO A CONGIRMADA PARA AHORRARNOS UN PASO
            /* if (comparar_fechas(timestamps(), fecha_cita) === "igual") {
                cat_user_cita_status_id = 5
            } */
            let model = await store_cita_status(cita_id, 4)

            set_item_cita(cita_id, "cat_user_cita_status_id", 4)
            await updateTotales()
            handle_tablaCitas(useState.status_current_tab)
            //d.querySelector(`.row-cita-${cita_id}`).remove()
            Swal.fire(
                'Cita confirmada!',
                'El paciente será notificado de esta acción',
                'success'
            )
            d.querySelector(".overlay").classList.add("d-none")
        }
    })
}
let handle_cancelar = async (e, cita_id, cat_user_cita_status_id) => {

    $("#exampleModalCancelar").modal("show")
    useState.formReprogramar = {
        "cat_user_cita_status_id": 2,
        "coments2": "",
        "cita_id": cita_id
    }
    let cita = await get_cita(cita_id)
    let hora = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)


    let $modal = d.querySelector(`#exampleModalCancelar`)
        $modal.querySelector(".modal-body form").innerHTML = null
        $modal.querySelector(".modal-body form").innerHTML = `
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <b class="text-primary h3">Cancelar Cita</b>
                    </div>
                    <div class="col-md-12">
                        <b class="text-secondary">Fecha Agendada:</b> <span>${fechaCortaCustom3(hora)}</span>
                    </div>
                    <div class="col-md-12 mt-2">
                        <h5 class="text-primary">Mótivo para cancelar:</h5>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">

                            <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3"
                                aria-describedby="helpId" rows="3"></textarea>
                            <small id="helpId" class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>
        `
        $modal.addEventListener("change", async function (e) {
            //console.log(e.target.name)

            if (e.target.name === "coments") {
                useState.formReprogramar["coments2"] = e.target.value
            }

        })
        $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => {
            Swal.fire({
                title: '¿Deseas cancelar esta cita?',
                text: "Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, Cancelar!'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    d.querySelector(".overlay").classList.remove("d-none")
                    let index_cita = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
                    //console.log("Estado antes Cancelar", useState['citas'][index_cita])
                    let model = await store_cita_status(cita_id, cat_user_cita_status_id, d.querySelector("textarea[name='coments']").value)
                    //delete_cita(cita_id)
                    useState['citas'][index_cita]['cat_user_cita_status_id'] = cat_user_cita_status_id
                    //console.log("Estado despues Cancelar", useState['citas'][index_cita])

                    handle_tablaCitas(useState.status_current_tab)
                    await updateTotales()
                    Swal.fire(
                        'Cita Cancelada!',
                        'El paciente será notificado de esta acción',
                        'success'
                    )
                    $("#exampleModalCancelar").modal("hide")
                    d.querySelector(".overlay").classList.add("d-none")
                }
            })

        })
    /* let $formReprogramar = entById('artefacto_0022').content
    $formReprogramar = d.importNode($formReprogramar, true);

    */


    /* $modal.querySelector(`.exampleModal_title`).textContent = "Cancelar Cita"
    let header = $modal.querySelectorAll(`table td`)
    let {
        nombres,
        apellidos
    } = useState['citas'].find(x=>equalsInt(x['user_id_paciente'],cita.user_id_paciente))
    header[0].textContent = `${nombres} ${apellidos}`
    header[1].textContent = cita.medico
    header[2].textContent = cita.especialidad_nombre */


    /* $modal.querySelector(".modal-body form").append($formReprogramar)

    let $div = $modal.querySelectorAll("form div")



    */

}
let handle_finalizar = async (e, cita_id, cat_user_cita_status_id) => {
    $("#exampleModal").modal("show")
    useState.formReprogramar = {
        "cat_user_cita_status_id": 8,
        "coments2": "",
        "cita_id": cita_id
    }
    let $modal = d.querySelector(`#exampleModal`)
    $modal.querySelector(".modal-body form").innerHTML = null
    let $formReprogramar = entById('artefacto_0022').content
    $formReprogramar = d.importNode($formReprogramar, true);

    $formReprogramar.addEventListener("change", async function (e) {
        console.log(e.target.name)

        if (e.target.name === "coments") {
            useState.formReprogramar["coments2"] = e.target.value
        }

    })
    //console.log("p_cita_id->", cita_id )
    // console.log("cita-1->", await get_cita(cita_id) )
    let cita = await get_cita(cita_id)

    if (is_undefined(cita)) {
        console.log("handle_finalizar->", cita)
        console.log(useState.citas)
        console.log(cita_id, cat_user_cita_status_id)
        console.log(useState.citas.filter(x => x.user_cita_id === cita_id))
    }
    $modal.querySelector(`.exampleModal_title`).textContent = "Paciente No asistió a consulta"
    let header = $modal.querySelectorAll(`table td`)
    let {
        nombres,
        apellidos
    } = cita.paciente
    header[0].textContent = `${nombres} ${apellidos}`
    header[1].textContent = cita.medico
    header[2].textContent = cita.especialidad_nombre


    $modal.querySelector(".modal-body form").append($formReprogramar)

    let $div = $modal.querySelectorAll("form div")
    console.log($div)
    $div[2].querySelector("h5").textContent = "Comente el motivo, si lo hubiere, de la inasistencia del paciente:"
    let hora = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)
    $div[1].querySelector("span").textContent = fechaCortaCustom3(hora)

    $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => {
        Swal.fire({
            title: '¿Deseas Finalizar esta cita?',
            text: "Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2FA600',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Aún no!',
            confirmButtonText: 'Si, Finalizar!'
        }).then(async (result) => {

            if (result.isConfirmed) {
                d.querySelector(".overlay").classList.remove("d-none")
                let index_cita = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
                console.log("Estado antes Cancelar", useState['citas'][index_cita])
                let model = await store_cita_status(cita_id, 8, d.querySelector("textarea[name='coments']").value)
                //delete_cita(cita_id)
                useState['citas'][index_cita]['cat_user_cita_status_id'] = 8
                console.log("Estado despues Cancelar", useState['citas'][index_cita])


                handle_tablaCitas(useState.status_current_tab)
                await updateTotales()
                Swal.fire(
                    'Cita Finalizada!',
                    '',
                    'success'
                )
                $("#exampleModal").modal("hide")
                d.querySelector(".overlay").classList.add("d-none")
            }
        })

    })

}
let handle_atender_hoy = async (e, cita_id, cat_user_cita_status_id) => {
    let date = new Date()
    useState.formReprogramar = {
        "cat_user_cita_status_id": 5,
        "year": date.getFullYear(),
        "month": (date.getMonth() + 1),
        "day": date.getDate(),
        "hour": date.getHours() + ":" + date.getMinutes(),
        "coments": "Cita cambiada para hoy",
        "cita_id": cita_id
    }


    Swal.fire({
        title: '¿Deseas atender esta cita hoy?',
        text: "El paciente debe estar al tanto, antes de adelantar la fecha",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2FA600',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Aún no!',
        confirmButtonText: 'Si, Atender!'
    }).then(async (result) => {

        if (result.isConfirmed) {
            d.querySelector(".overlay").classList.remove("d-none")
            let model = store_reprogramar()
            set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
            set_item_cita(cita_id, "year", useState.formReprogramar['year'])
            set_item_cita(cita_id, "month", useState.formReprogramar['month'])
            set_item_cita(cita_id, "day", useState.formReprogramar['day'])
            Swal.fire(
                'Cita Actualizada para hoy!',
                "Notifique al paciente el momento del día en que será atendido",
                'success'
            )


            handle_tablaCitas(useState.status_current_tab)
            await updateTotales()
            console.log(useState.citas)
            d.querySelector(".overlay").classList.add("d-none")
        }
    })

}
let handle_consulta_store_and_send = async (e) => {

    let { user_cita_id,color,user_id_paciente } = e.target.dataset

        $("#modelId").modal("hide")
        d.querySelector("#tab_consulta .overlay").classList.remove("d-none")
            await get(`/consultaexterna/pdf/informeCita/enviar_y_finalizar/${useState['user_centro_salud_id']}/${useState['user_id_medico']}/${user_cita_id}/${user_id_paciente}/${color}`)

            // console.log("---->", cita_id,cat_user_cita_status_id)
            let fecha_cita = await get_cita_fecha(user_cita_id)
            //console.log("*****>>>   ", fecha_cita)

            let cat_user_cita_status_id = 7

            let model = await store_cita_status(user_cita_id, cat_user_cita_status_id)

            set_item_cita(user_cita_id, "cat_user_cita_status_id", cat_user_cita_status_id)



            enrutador("#tab_citas")
            useState.status_current_tab = 6
                cat_user_cita_status_id = 6
                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                await updateTotales()


            Swal.fire(
                'Cita Guardada y Finalizada!',
                'El paciente será notificado de esta acción',
                'success'
            )
            d.querySelector("#tab_consulta .overlay").classList.add("d-none")
}
let handle_consulta_store = async (e) => {

    let { user_cita_id } = e.target.dataset

    Swal.fire({
        title: '¿Desea guardar y finalizar esta cita?',
        text: "Esta acción no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2FA600',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Aún no!',
        confirmButtonText: 'Si, Guardar y finalizar!'
    }).then(async (result) => {


        if (result.isConfirmed) {
            $("#modelId").modal("hide")
            d.querySelector("#tab_consulta .overlay").classList.remove("d-none")
            // console.log("---->", cita_id,cat_user_cita_status_id)
            let fecha_cita = await get_cita_fecha(user_cita_id)
            //console.log("*****>>>   ", fecha_cita)

            let cat_user_cita_status_id = 7

            let model = await store_cita_status(user_cita_id, cat_user_cita_status_id)

            set_item_cita(user_cita_id, "cat_user_cita_status_id", cat_user_cita_status_id)



            enrutador("#tab_citas")
            useState.status_current_tab = 6
                cat_user_cita_status_id = 6
                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                await updateTotales()


            Swal.fire(
                'Cita Guardada y Finalizada!',
                'El paciente será notificado de esta acción',
                'success'
            )
            d.querySelector("#tab_consulta .overlay").classList.add("d-none")
        }
    })
}
export let handle_finalizar_cita = async (e) => {
    let $modal = d.querySelector(`#modelId`)
        $modal.querySelector(".modal-dialog").classList.remove("modal-lg","modal-sm")
        $modal.querySelector(".modal-dialog").classList.add("modal-sm")
        $modal.querySelector(".modal-body").innerHTML = null

    $("#modelId").modal("show")
    $modal.querySelector(".modal-body").innerHTML= /*html*/ `
        <!--<button type="button" class="btn mb-2 btn-success btn-block handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}">Guardar y finalizar cita</button>-->
        <!--<button type="button" class="btn mb-2 btn-success btn-block handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}">Guardar y finalizar cita</button>-->

        <!--<div class="btn-group w-100 mb-2">
            <button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Referenciar cita a...
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item handle_referencia_especialista" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="color" href="#">Especialista</a>
            </div>
        </div>-->
        <div class="btn-group w-100 mb-2">
            <button type="button" class="btn btn-success btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Guardar y finalizar cita
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="color" href="#"  style="display:none">Color</a>
                <a class="dropdown-item handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="bw" href="#">Blanco y negro</a>
            </div>
        </div>
        <div class="btn-group w-100 mb-2">
            <button type="button" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ver Informe médico
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item handle_informe_medico" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="color" href="#"  style="display:none">Color</a>
                <a class="dropdown-item handle_informe_medico" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="bw" href="#">Blanco y negro</a>
            </div>
        </div>
        <!--<button type="button" class="btn btn-primary btn-block" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}">Generar una cíta para cirugía</button>
        <button class="btn mb-2 btn-warning btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Compartir Informe de cita por
        </button>-->

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Active link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled link</a>
                    </li>
                </ul>
            </div>
        </div>
        <button type="button" class="btn btn-default btn-block"  data-dismiss="modal">Regresar</button>
    `
    d.querySelectorAll("#modelId .handle_consulta_store").forEach(x=>{
        x.addEventListener("click",function(e){
            Swal.fire({
                title: '<strong>¡Atención!</strong>',
                icon: 'info',
                html:`
                    ¿Desea enviar por correo, y finalizar esta cita, o prefieres solo guardar y finalizar la misma?
                `,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Enviar por correo y finalizar',
                denyButtonText: `Guardar y Finalizar`,
                cancelButtonText: `Aún no!`,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    handle_consulta_store_and_send(e)
                } else if (result.isDenied) {
                    handle_consulta_store(e)
                }
            })


        })
    })
    d.querySelectorAll("#modelId .handle_informe_medico").forEach(x=>{
        x.addEventListener("click",function(e){

            window.open(`${useState['host_patientcare']}/consultaexterna/pdf/informeCita/${useState['user_centro_salud_id']}/${useState['user_id_medico']}/${e.target.dataset.user_cita_id}/${e.target.dataset.user_id_paciente}/${e.target.dataset.color}`)
        })
    })

}
let solicitud_cita_select_MEDICO = async ({cat_especialidad_id,centro_salud_id,medicos_id})=>{

       // console.log(useState['formCreateCita']);
    /*     let centro_salud =     useState['centro_salud'].find(x=> equalsInt( x['id'],centro_salud_id) )
    let medicos_id =    centro_salud['medicos_id']
                        .split(",")
                        .map(x=> parseInt(x) ) */
        d.querySelector(".overlay").classList.remove("d-none")
    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        formData.append("medicos_id",medicos_id)
        formData.append("especialidad_id",cat_especialidad_id)
        formData.append("centro_salud_id",centro_salud_id)
    let model = await post(location.origin+`/consultaexterna/user/medico/agenda/medicos`,formData);
        d.querySelector(".overlay").classList.add("d-none")
    let medicos = model.map(x=>{
            return {
                "id":x['user_id_medico'],
                "description":x['medico_descripcion'],
                "agenda":x['agenda']
                }
            })
            //console.log(medicos)
        return medicos
    /*     let medicos = useState['medicos'].map(x=>{
        return {
            "id":x['user_id_medico'],
            "description":x['medico_descripcion'],
            }
        })
    let inputSelect2 = d.querySelector(`select[name='user_id_medico']`)
        inputSelect2.innerHTML = null
        inputSelect2.append($select(medicos)) */



}

let solicitud_cita_select_CENTRO_SALUD = async (cat_especialidad_id)=>{


    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        if (is_null(useState['centro_salud'])) {
            d.querySelector(".overlay").classList.remove("d-none")
            useState['centro_salud'] = await post(location.origin+`/consultaexterna/cat/centro_salud/getAll`,formData);
            d.querySelector(".overlay").classList.add("d-none")
        }
    let centro_salud =     useState['centro_salud'].find(x=> Number(cat_especialidad_id) === Number(x['id']) )['medicos_id'].split(",").map(x=> parseInt(x) )

        return centro_salud
}
let local_timestamps2=(date) =>{
    var hoy = new Date(date);

    return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
}
let activarAgenda = ()=>{
    let agenda =  useState['formReprogramar']['agenda']
    let diasDisponible =  []
        if (!is_undefined(agenda)) {
            agenda = JSON.parse(agenda['agenda'])
            diasDisponible =  agenda.filter(x=>["publica","privada"].includes(x['visibilidad'])).map(x=>{
                let fecha = new Date(x['day']);
                    return fecha.getFullYear() + "-" + String(fecha.getMonth() + 1).padStart(2, '0') + "-" + String(fecha.getDate()).padStart(2, '0') +" 00:00"
            })
        }
        $('#calendar').datepicker('destroy')
        $('#calendar').empty();
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
        $('#calendar').datepicker().on("changeDate", function(e) {
            let {user_id_medico} = useState['formReprogramar']
            let f = new Date(e.date);
            let anio = String(f.getFullYear())
            let mes  = String(f.getMonth()+1 ).padStart(2, '0')
            let dia  = String(f.getDate()).padStart(2, '0')

                useState['formReprogramar']['year'] = anio
                useState['formReprogramar']['month'] = mes
                useState['formReprogramar']['day'] = dia
                //console.log(useState['formReprogramar'])


                entById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día a reprogramar:</b><br><span class="badge  badge-info">${fechaCortaCustom1(e.date)}</span>
                `

            let medicoFechas =  useState['formReprogramar']['agenda']
                //console.log("medicoFechas",medicoFechas);
                medicoFechas =  JSON.parse(medicoFechas['agenda'])
                medicoFechas =  medicoFechas.map(fecha=>{
                                    let fc = new Date(fecha['day'])
                                        return {
                                            "day": String(fc.getDate()).padStart(2, '0'),
                                            "month": String(fc.getMonth()+1).padStart(2, '0'),
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
                d.querySelector('#horas-tab').innerHTML =""
                if (medicoHoras.length == 0) {
                    d.querySelector('#horas-tab').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }else{
                    medicoHoras.forEach((hora,key)=>{
                        //console.log(hora);
                        let textColor =""
                        if (hora['visibilidad']==="privada") {
                            textColor ="font-weight-bold border border-default"
                        }
                        let h = horaAMPM( hora['hour'] ).toUpperCase()
                            d.querySelector('#horas-tab').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora mr-1" data-hora="${hora['hour']}" role="presentation">
                                    <a class="nav-link cita-hora ${textColor}" id="hora-pm-${key}-tab" data-hora="${hora['hour']}" data-toggle="pill" href="#pills-pm-${hora['hour']}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                    /* for(let key in medicoHoras){
                        let textColor =""
                        let hora = medicoHoras[key]
                            if (medicoHoras['visibilidad']==="privada") {
                                textColor ="font-weight-bold border border-default"
                            }
                            console.log(medicoHoras[key])
                        let h = horaAMPM( hora ).toUpperCase()
                            d.querySelector('#horas-tab').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora['hour']}" role="presentation">
                                    <a class="nav-link cita-hora ${textColor}" id="hora-pm-${key}-tab" data-hora="${hora['hour']}" data-toggle="pill" href="#pills-pm-${hora['hour']}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)

                    } */

                }


        });
}
let selectCustom = (model, param) => {
    let id = param != undefined ? param : "";
    let selected = '';
    let data = "<option value=''>Seleccione</option>";
        $.each(model, function(indexInArray, valueOfElement) {
            if (Number(valueOfElement.id) == Number(id)) {

                selected = 'selected';
            } else {
                selected = '';
            }
            data += `
                <option data-agenda="${valueOfElement.agenda}" ${selected} value="${valueOfElement.id}">
                    ${valueOfElement.description}
                </option>
            `;
        });
    return data;
}
let handle_cita_reprogramar = async (e, cita_id) => {

    let cita = await get_cita(cita_id)
        console.log("cita",cita)
        useState['formReprogramar'] = {
            "cat_user_cita_status_id": 2,
            "year"                   : cita['year'],
            "month"                  : null,
            "day"                    : null,
            "hour"                   : null,
            "coments"                : "",
            "cita_id"                : cita_id,
            "agenda"                 : null,
            "user_id_medico"         : cita['user_id_medico'],
        }

    let medicos_id = await solicitud_cita_select_CENTRO_SALUD(cita['centro_salud_id'])
    let temp_medicos =  await solicitud_cita_select_MEDICO({
            medicos_id,
            "cat_especialidad_id":cita['cat_especialidad_id'],
            "centro_salud_id":cita['centro_salud_id']
        })
        useState['formReprogramar']['agendas'] = temp_medicos
        useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],cita['user_id_medico']))



        //console.log("temp_medicos",temp_medicos)
    let $modal = d.querySelector(`#exampleModal`)

        $modal.querySelector(".modal-body").innerHTML = null
    let dia_agendado = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)

    let header =  /*html*/ `
            <div class="bg-light p-2">
                <h3 class="exampleModal_title text-primary">Reprogramar Cita</h3>
                <table class="w-100">
                    <tr>
                        <th class="pr-1 text-secondary">Paciente:</th>
                        <td class="exampleModal_paciente">${cita['paciente']}</td>
                    </tr>
                    <tr>
                        <th class="pr-1 text-secondary">Especialidad:</th>
                        <td>${cita['especialidad_nombre']}</td>
                    </tr>
                    <tr>
                        <th class="pr-1 text-secondary">Centro de Salud:</th>
                        <td>${cita['centro_salud_description']}</td>
                    </tr>
                    <tr>
                        <th class="pr-1 text-secondary">Médico:</th>
                        <td class="exampleModal_medico">
                            <select name="user_id_medico" class="form-control border-0">
                                ${selectCustom(temp_medicos,cita['user_id_medico'])}
                            </select>
                        </td>
                    </tr>
                    <tr class="bg-secondary text-primary">
                        <th class="pr-1">Fecha agendada:</th>
                        <td>${ fechaCortaCustom3( dia_agendado )}</td>
                    </tr>
                </table>
            </div>
        `
        $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend",header)

        $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend", /*html */`
            <div class="h4 text-center text-primary">Selecciona un dia del calendario</div>
            <div id="calendar" class="daterange" style="width: 100%"></div>
            <div id="mensaje_dia_seleccionado" class="rounded text-center"></div>
            <div class="h4 text-center text-primary">Selecciona una hora</div>
            <ul class="nav justify-content-center nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                <div class="flex-fill text-center text-secondary" style="font-size:15px">
                    Sin Horas disponibles
                </div>
            </ul>
            <div class="h4 text-center text-primary">Motivo de reprogramación <span class="text-gray">(Opcional)</span></div>
            <div class="container-fluid">
                <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3" aria-describedby="helpId" rows="3"></textarea>
            </div>
        `)





        d.querySelector(`textarea[name='coments']`).addEventListener("change",async (e)=>{
            useState['formReprogramar']['coments'] = e.target.value
            console.log(useState['formReprogramar'])
        })
        d.querySelector(`select[name='user_id_medico']`).addEventListener("change",async (e)=>{
            let cita = await get_cita(cita_id)
            let temp_medicos =  await solicitud_cita_select_MEDICO({
                    medicos_id,
                    "cat_especialidad_id":cita['cat_especialidad_id'],
                    "centro_salud_id":cita['centro_salud_id']
                })
                useState['formReprogramar']['agendas'] = temp_medicos
                useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],e.target.value))


                useState['formReprogramar']['user_id_medico'] = e.target.value
                //console.log(e.target.selectedOptions)
                console.log(useState['formReprogramar'])
                activarAgenda()

        })

        d.addEventListener("click",(e)=>{
            if (e.target.matches(".cita-hora")) {

                useState['formReprogramar']['hour'] = e.target.dataset.hora

                console.log(useState['formReprogramar'])
            }
            if (e.target.matches("#reprogramacion_store")) {

                let mes_value = useState['formReprogramar']['month']
                    if (
                        is_null(mes_value) ||
                        is_empty(mes_value)
                    ) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Debe seleccionar una fecha disponible en el calendario",

                        })
                        return false
                    }
                let hour_value = useState['formReprogramar']['hour']
                    if (
                        is_null(hour_value) ||
                        is_empty(hour_value)
                    ) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Debe seleccionar una hora disponible",

                        })
                        return false
                    }
                Swal.fire({
                    title: "¿Deseas reprogramar esta cita?",
                    text: "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Aún no!',
                    confirmButtonText: 'Si, reprogramar!'
                }).then(async (result) => {

                    if (result.isConfirmed) {

                        let ahora = new Date();
                        let ahoraMilisegundos = ahora.getTime();


                        let fechaActualizada = new Date(useState.formReprogramar['fechacompleta'] )
                            fechaActualizada = fechaActualizada.getTime()
                            if (fechaActualizada < ahoraMilisegundos) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Atención',
                                    text: "Verifique la fecha y hora de la reprogramación",
                                })
                                return false
                            }
                            d.querySelector(".overlay").classList.remove("d-none")
                        let model = store_reprogramar()
                            d.querySelector(".overlay").classList.add("d-none")
                            set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                            set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                            set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                            set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                            set_item_cita(cita_id, "hour", useState.formReprogramar['hour'])
                            Swal.fire(
                                'Cita reprogramada!',
                                message.final_message,
                                'success'
                            )


                            handle_tablaCitas(useState.status_current_tab)
                            await updateTotales()
                            console.log(useState.citas)
                            $("#exampleModal").modal("hide")

                    }
                })
            }
        })
        activarAgenda()
        $("#exampleModal").modal("show")







    /* let message = {
            "title": "¿Deseas reprogramar esta cita?",
            "description": "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
            "final_message": "El paciente será notificado de esta acción"
        }



    let $formReprogramar = entById('artefacto_0019').content
        $formReprogramar = d.importNode($formReprogramar, true); */

       /*  $formReprogramar.querySelector("#atencion_inmediata").addEventListener("click", function (h) {
            if (h.target.checked) {
                let fecha = fechaAMD2()
                let hora = horaActual()
                //console.log("hora actual->",hora)
                d.querySelector("input[name='fecha']").value = fecha
                d.querySelector("input[name='hour']").value = hora
                d.querySelector("input[name='fecha']").disabled = true
                fecha = fecha.split("-")
                useState.formReprogramar['cat_user_cita_status_id'] = 5
                useState.formReprogramar['year'] = fecha[0]
                useState.formReprogramar["month"] = fecha[1]
                useState.formReprogramar["day"] = fecha[2]
                useState.formReprogramar["hour"] = hora
                message = {
                    "title": "¿Deseas reprogramar esta cita para hoy?",
                    "description": "El paciente debe previamente, estar al tanto de esta acción.",
                    "final_message": "Esta cita ya está activa, para la preconsulta del paciente."
                }
            } else {
                d.querySelector("input[name='fecha']").value = ""
                d.querySelector("input[name='hour']").value = ""
                d.querySelector("input[name='fecha']").disabled = false
                useState.formReprogramar['cat_user_cita_status_id'] = 2
                useState.formReprogramar['year'] = ""
                useState.formReprogramar["month"] = ""
                useState.formReprogramar["day"] = ""
                useState.formReprogramar["hour"] = ""
                message = {
                    "title": "¿Deseas reprogramar esta cita?",
                    "description": "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
                    "final_message": "El paciente será notificado de esta acción"
                }
            }
        }) */



    //let header = $modal.querySelectorAll(`table td`)


        /* header[0].textContent = `${cita['paciente']}`
        header[1].textContent = cita.medico
        header[2].textContent = cita.especialidad_nombre

        $modal.querySelector(".modal-body form").append($formReprogramar)

         */


    /* let $div = $modal.querySelectorAll("form div")

     */

        /* $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => {
            let fecha = $modal.querySelector(`#fecha`)
                if (is_empty(fecha.value)) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "Debes indicar la fecha de la cíta",
                        didClose: () => {
                            setTimeout(() => fecha.focus() , 110);
                        }
                    })
                    return false
                }
            let hour = $modal.querySelector(`#hour`)
                if (is_empty(hour.value)) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "Debes indicar la hora de la cíta",
                        didClose: () => {
                            setTimeout(() => hour.focus() , 110);
                        }
                    })
                    return false
                }
            //console.log("fecha",fecha)
            Swal.fire({
                title: message.title,
                text: message.description,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, reprogramar!'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    console.log(useState.formReprogramar)
                    //let f = new Date()
                    let ahora = new Date();
                    let ahoraMilisegundos = ahora.getTime();
                    d.querySelector(".overlay").classList.remove("d-none")

                    let fechaActualizada = new Date(useState.formReprogramar['fechacompleta'] )
                        fechaActualizada = fechaActualizada.getTime()
                    if (
                        fechaActualizada < ahoraMilisegundos

                    ) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Verifique la fecha y hora de la reprogramación",
                        })
                        return false
                    }

                    let model = store_reprogramar()
                    set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                    set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                    set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                    set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                    set_item_cita(cita_id, "hour", useState.formReprogramar['hour'])
                    Swal.fire(
                        'Cita reprogramada!',
                        message.final_message,
                        'success'
                    )


                    handle_tablaCitas(useState.status_current_tab)
                    await updateTotales()
                    console.log(useState.citas)
                    $("#exampleModal").modal("hide")
                    d.querySelector(".overlay").classList.add("d-none")
                }
            })

        }) */
}
let handle_vitalSigns = async ($form, user_cita_id) => {
    let $vitalSign = entById("artefacto_0024").content
    $vitalSign = d.importNode($vitalSign, true)
    let {
        user_peso,
        user_alergias,
        user_altura,
        user_temp,
        user_spo2,
        user_fc,
        user_fr,
        user_glic,
        user_ta,
    } = await get_cita(user_cita_id)
    //console.log(user_cita_id)
    if (!is_null(user_peso?.value) && !is_undefined(user_peso?.value)) {
        $vitalSign.querySelector("input[name='user_peso']").value = user_peso.value
        $vitalSign.querySelector("input[name='user_peso']").classList.add("is-valid")
    }
    if (!is_null(user_altura?.value) && !is_undefined(user_altura?.value)) {
        $vitalSign.querySelector("input[name='user_altura']").value = user_altura.value
        $vitalSign.querySelector("input[name='user_altura']").classList.add("is-valid")
    }
    if (!is_null(user_temp?.value) && !is_undefined(user_temp?.value)) {
        $vitalSign.querySelector("input[name='user_temp']").value = user_temp.value
        $vitalSign.querySelector("input[name='user_temp']").classList.add("is-valid")
    }
    if (!is_null(user_spo2?.value) && !is_undefined(user_spo2?.value)) {
        $vitalSign.querySelector("input[name='user_spo2']").value = user_spo2.value
        $vitalSign.querySelector("input[name='user_spo2']").classList.add("is-valid")
    }
    if (!is_null(user_fc?.value) && !is_undefined(user_fc?.value)) {
        $vitalSign.querySelector("input[name='user_fc']").value = user_fc.value
        $vitalSign.querySelector("input[name='user_fc']").classList.add("is-valid")
    }
    if (!is_null(user_fr?.value) && !is_undefined(user_fr?.value)) {
        $vitalSign.querySelector("input[name='user_fr']").value = user_fr.value
        $vitalSign.querySelector("input[name='user_fr']").classList.add("is-valid")
    }
    if (!is_null(user_glic?.value) && !is_undefined(user_glic?.value)) {
        $vitalSign.querySelector("input[name='user_glic']").value = user_glic.value
        $vitalSign.querySelector("input[name='user_glic']").classList.add("is-valid")
    }
    if (!is_null(user_ta?.value) && !is_undefined(user_ta?.value)) {
        $vitalSign.querySelector("input[name='user_ta_sis']").value = user_ta.value
        $vitalSign.querySelector("input[name='user_ta_sis']").classList.add("is-valid")
    }

    if (!is_null(user_ta?.value2) && !is_undefined(user_ta?.value2)) {
        $vitalSign.querySelector("input[name='user_ta_dia']").value = user_ta.value2
        $vitalSign.querySelector("input[name='user_ta_dia']").classList.add("is-valid")
    }

    $form.querySelector(".group_vital_signs").innerHTML = ""
    $form.querySelector(".group_vital_signs").append($vitalSign)
    $form.querySelector(".group_vital_signs .vital-signs").addEventListener("change", async e => {
        let {
            user_cita_id,
            user_id_paciente
        } = $form.dataset


        if (e.target.value === "") {
            e.target.classList.add("is-invalid")
            return false
        } else {
            e.target.classList.remove("is-invalid")
        }
        $form.querySelector(".overlay").classList.remove(`d-none`)
        let formData = new FormData();

        if (e.target.matches("input[name='user_ta_dia']")) {
            formData.append("value", d.querySelector("input[name='user_ta_sis']").value)
            formData.append("value2", d.querySelector("input[name='user_ta_dia']").value)
        } else {
            formData.append("value", e.target.value)
        }
        formData.append("user_cita_id", user_cita_id)
        formData.append("user_id_paciente", user_id_paciente)
        formData.append("created_at", timestamps());
        formData.append("_token", d.querySelector("#_token").value)

        let response = await post(`/consultaexterna/${e.target.name}/store`, formData)
        if (
            ![
                "user_ta_sis",
                "user_ta_dia",
            ].includes(e.target.name)
        ) {
            set_item_cita(user_cita_id, e.target.name, response)
        } else {
            set_item_cita(user_cita_id, "user_ta", response)
        }
        e.target.classList.add("is-valid")
        $form.querySelector(".overlay").classList.add(`d-none`)
    })

}
let handle_patientCard = (card, data) => {
    //console.log(card)
    let $card = import { first, $selectCustom, emptyItem, removeAccents , dia_semana, recalcularAltoPagina,fechaUserCita, mes, item_historial_cita, active_form, cargandoModal, item_historial_cita2, get, is_null  } from '../../helpers/helpers.js'

//import { create as PacienteCreate, edit as PacienteEdit } from '../user/user_create.js'
import { create as MedicoCreate } from './medico.js'
import * as ComponentMedico from './medico.js?version = 0.1'
import * as ComponentPaciente from '../paciente/paciente.js'
import * as ComponentAgenda from '../agenda/agenda.js'
import * as ComponentBuscador from '../medico/search.js'
import * as ComponentCita from '../cita/cita.js'
import * as CitaCreate from '../cita/create.js'
import * as ComponentRecipe from '../paciente/user_recipe_cita.js'
import * as ComponentEstudio from '../paciente/user_estudio_cita.js'
import * as ComponentLaboratorio from '../paciente/user_laboratorio_consulta.js'
import * as ComponentFotografia from '../paciente/user_fotografias_consulta.js'
import * as ComponentImagenes from '../paciente/user_imagenes_consulta.js'
import * as ComponentOtroArchivo from '../paciente/user_otros_archivos_consulta.js'
import * as ComponentEspecialidad from '../catalogs/cat_especialidad_medica.js'


let d = document
let onChange_agenda_id;
let final_hora;
let final_dia;
let $header = d.querySelector("#headerCitaStatusOptions")
let $sidebar = d.querySelector(".nav-sidebar")
let tableFilter = (inputSearch,tableId) => {
    let busqueda = document.getElementById(inputSearch);
    let table = document.getElementById(tableId).tBodies[0];

    let buscaTabla = function() {
        let texto = busqueda.value.toLowerCase();
        let r = 0;
        let row
        while (row = table.rows[r++]) {
            if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                row.style.display = null;
            else
                row.style.display = 'none';
        }
    }

    busqueda.addEventListener('change', buscaTabla);

}
let get_citas_by_status = (status_id) => {
    let citas = useState['citas'].filter(x => equalsInt(x['cat_user_cita_status_id'], status_id))
    return filtrarPor(citas)
}
let get_cita = async (cita_id) => {
    // console.dir(`first(useState['citas'].filter(x => equalsInt(x.user_cita_id, cita_id))) --> ${JSON.stringify(first(useState['citas'].filter(x => equalsInt(x.user_cita_id, cita_id))))}`)
    return await first(useState['citas'].filter(x => equalsInt(x.user_cita_id, cita_id)))
}

let get_cita_fecha = async (cita_id) => {

    let cita = await get_cita(cita_id)
    //console.log(cita)
    return cita.year + "-" + cita.month + "-" + cita.day + " " + cita.hour
}
let paciente = (user_id) => {
    return first(useState['users'].filter(x => equalsInt(x.user_id, user_id)))
}
let tarjetasoychacao = (user_id) => {


    let response = first(useState['users'].filter(x => equalsInt(x.user_id, user_id) ) )
    //console.log("tarjetasoychacao->",response)
        if (!is_null(response)) {
            return response.tarjeta_soy_chacao
        } else {
            return undefined
        }
}
let get_rowTable = async (cita) => {
    // console.log("paciente->",cita)
    let $row_new_cita = d.querySelector("#artefacto_0018").content.cloneNode(true)

    // $row_new_cita = d.importNode($row_new_cita, true)
    //let paciente = useState['users'].find(x => equalsInt(x.user_id, cita.user_id_paciente ))
    //console.log("paciente",paciente)
    // if (is_undefined(paciente) ) {
        // if (paciente === 'undefined') {
        //     console.log("user_paciente_id->",cita)
        //     return 'Paciente no encontrado'
        // }else{


        //condicion administrativa
        //particular --seguro cual? -- cortesia convenio?
        //console.log("user_id->",cita.user_id_paciente,"paciente->",paciente)
        // console.log(`cita --> ${JSON.stringify(cita)}`)
        $row_new_cita.querySelector("tr").classList.add(`row-cita-${cita.user_cita_id}`)
        $row_new_cita.querySelector(".card-item-paciente-image").src = cita.imagen_paciente
        $row_new_cita.querySelector("small").textContent = "#citaid" + cita.user_cita_id +" "+ "#userid" + cita.user_id_paciente
        $row_new_cita.querySelector(".card-item-paciente-solicitud-fecha").innerHTML = `
            ${fechaAPPLE(cita.created_at)}
            <div style="font-size:0.8rem">
                <small style="color:transparent">#cita_id: ${cita.user_cita_id}</small>
                <small style="color:transparent">#user_id_paciente: ${cita.user_id_paciente}</small>
            </div>

        `
        $row_new_cita.querySelector(".card-item-paciente-fullname").textContent = cita.paciente
        $row_new_cita.querySelector(".card-item-paciente-cedula").textContent = cita.cedula_paciente
        $row_new_cita.querySelector(".card-item-paciente-edad").textContent = cita.edad
        $row_new_cita.querySelector(".card-item-paciente-genero").textContent = cita.genero_paciente.toUpperCase()
        $row_new_cita.querySelectorAll(".paciente-edit").forEach(x=>x.dataset.user_id_paciente=cita.user_id_paciente)

        if (!is_null(cita.tarjeta_soy_chacao)) {
            $row_new_cita.querySelector(".tarjeta-salud-chacao").classList.add("bg-chacao")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.remove("text-gray")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.add("text-white")
            $row_new_cita.querySelector(".card-item-paciente-tarjeta-chacao").textContent = cita.tarjeta_soy_chacao
        } else {
            $row_new_cita.querySelector(".tarjeta-salud-chacao").classList.remove("bg-chacao")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.remove("text-white")
            $row_new_cita.querySelector(".tarjeta-salud-chacao b").classList.add("text-gray")
            $row_new_cita.querySelector(".card-item-paciente-tarjeta-chacao").textContent = 'No posee'
        }

        let color = "success"
        $row_new_cita.querySelectorAll(".enlace-whatsapp").forEach(x => {
            x.dataset.telefono_movil = cita.telefono_movil
        })
        $row_new_cita.querySelector(".card-item-paciente-telefono-movil").textContent = `${!is_null(cita.telefono_movil) ? cita.telefono_movil : 'No Indicado'}`

        if (
            cita['condicion_administrativa'] === "Cortesía"
            && !is_null( cita['condicion_descripcion'] )
        ) {
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none")
            $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Cortesía autorizada por: ${cita["condicion_descripcion"]}`
        }
        if (
            cita['condicion_administrativa'] === "Particular"
        ) {
            color ="success"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Particular`
        }
        if (
            cita['condicion_administrativa'] === "Seguro"
        ) {
            color ="info"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            if(cita.cat_seguro_id !== null){
                let seguro = await get(`/consultaexterna/cat_seguro/get_by_id/${cita.cat_seguro_id}`)
                cita['seguro_nombre'] = seguro.name
                $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Asegurado | ${cita["seguro_nombre"]} | Póliza: ${cita["poliza_numero"]}`
            }
        }
        if (
            cita['condicion_administrativa'] === "Empresarial"
        ) {
            color ="purple"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            if(cita.cat_empresa_id !== null){
                let empresa = await get(`/consultaexterna/cat_empresa/get_by_id/${cita.cat_empresa_id}`)
                cita['empresa_nombre'] = empresa.razon_social
                $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Empresarial | ${cita["empresa_nombre"]}`
            }
        }
        if (
            cita['condicion_administrativa'] === "Empleado"
        ) {
            color ="orange"
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.remove("d-none",`bg-warning`)
            $row_new_cita.querySelector(".tag-condicion-cortesia").classList.add(`bg-${color}`)
            if(cita.department_id !== null){
                let departamento = await get(`/consultaexterna/department/get_by_id/${cita.department_id}`)
                cita['departamento_nombre'] = departamento.shortname
                $row_new_cita.querySelector(".tag-condicion-cortesia").innerHTML = `Empleado | ${cita["departamento_nombre"]}`
            }
        }
        if (
            !is_null( cita['user_cita_id_referenciado'] )
        ) {
            $row_new_cita.querySelector(".tag-condicion-cortesia-referido").classList.remove("d-none")
            $row_new_cita.querySelector(".tag-condicion-cortesia-referido").classList.add(`border-${color}`,`text-${color}`)
            $row_new_cita.querySelector(".tag-condicion-cortesia-referido").innerHTML = cita['descripcion_referenciado']
        }
        if ( cita['exonerado'] > 0) {
            let bgColor ="bg-danger"
                if (
                    cita['exonerado'] >24 &&
                    cita['exonerado'] <=49
                ) {
                    bgColor = "bg-info"
                }
                if (
                    cita['exonerado'] >49 &&
                    cita['exonerado'] <=74
                ) {
                    bgColor = "bg-warning"
                }
                if (
                    cita['exonerado'] >74 &&
                    cita['exonerado'] <=100
                ) {
                    bgColor = "bg-success"
                }

                $row_new_cita.querySelector(".tag-exonerado").classList.add("d-flex",bgColor)
                $row_new_cita.querySelector(".tag-exonerado").innerHTML = `<i class="fas fa-check-double"></i> Exonerado ${paciente['exonerado']}%`
        }

        $row_new_cita.querySelector(".card-item-paciente-cita-medico").textContent = cita.medico
        $row_new_cita.querySelector(".card-item-paciente-cita-especialidad").textContent = cita.especialidad_nombre
        $row_new_cita.querySelector(".card-item-paciente-cita-fecha").textContent = fechaTextoCustom1({
            "day": cita.day,
            "month_name": cita.mes_nombre,
            "year": cita.year,
        })
        $row_new_cita.querySelector(".card-item-paciente-cita-hora").textContent = horaAMPM(cita.hour)
        $row_new_cita.querySelectorAll(".botones-fila a").forEach((opcion, button) => {
            /*
                botones:
                0 Confirmar
                1 Reprogramar
                2 Preconsulta
                3 Registra signos vitales
                4 Atender Consulta
                5 Cancelar
                6 ¿atendido?
                7
            */

            let cat_user_cita_status_id = 4
            //botenes a ocultar por cada pestaña:
            //console.log(useState.status_current_tab,[1, 6, 8], parseInt(opcion.dataset.btnId))
            if (useState.status_current_tab == 1 && ![0, 1, 6, 7, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 2 && ![0,1, 6, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 4 && ![1, 6, 8, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 5 && ![1, 4, 6, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }
            if (useState.status_current_tab == 6 && ![1, 5, 6, 9].includes(parseInt(opcion.dataset.btnId))) {
                opcion.classList.add("d-none")
            }

            if (button == 1) {
                cat_user_cita_status_id = 2
            }
            if (button == 2) {
                cat_user_cita_status_id = 3
            }
            if (!is_null(opcion.querySelector("img"))) {
                opcion.querySelector("img").dataset.cita_id = cita.id
                opcion.querySelector("img").dataset.user_id_paciente = cita.user_id_paciente
            }
            if( opcion.classList.contains("cita-referencia") ){

                if (!is_null( cita['informe_general'] )) {
                    opcion.dataset['route'] = is_null( cita['informe_general'] ) ? "": cita['informe_general'];
                    opcion.querySelector("i").dataset['route'] = is_null( cita['informe_general'] ) ? "": cita['informe_general'];

                }else{
                    opcion.title ="Referencia NO DISPONIBLE"
                    opcion.querySelector("i").title ="Referencia NO DISPONIBLE"
                    opcion.classList.add("disabled")

                }
            }
            opcion.dataset.cita_id = cita.id
            opcion.dataset.user_id_paciente = cita.user_id_paciente
        })

        return $row_new_cita

    // }
}
export let updateTotales = async (citas) => {
    $sidebar.querySelectorAll(".total-citas-poraprobar").forEach(x => {
        if (equalsInt(get_citas_by_status(1).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-primary")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(1).length
            x.classList.add("badge-primary")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-aprobadas").forEach(x => {
        if (equalsInt(get_citas_by_status(4).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-success")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(4).length
            x.classList.add("badge-success")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-preconsulta").forEach(x => {
        if (equalsInt(get_citas_by_status(5).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-warning")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(5).length
            x.classList.add("badge-warning")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-consulta").forEach(x => {
        if (equalsInt(get_citas_by_status(6).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-info")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(6).length
            x.classList.add("badge-info")
            x.classList.remove("badge-gray")
        }

    })
    $sidebar.querySelectorAll(".total-citas-reprogramadas").forEach(x => {
        if (equalsInt(get_citas_by_status(2).length, 0)) {
            x.textContent = 0
            x.classList.remove("badge-secondary")
            x.classList.add("badge-gray")
        } else {
            x.textContent = get_citas_by_status(2).length
            x.classList.add("badge-secondary")
            x.classList.remove("badge-gray")
        }

    })


    $header.querySelector(".total-citas-poraprobar").textContent = get_citas_by_status(1).length
    $header.querySelector(".total-citas-aprobadas").textContent = get_citas_by_status(4).length
    $header.querySelector(".total-citas-preconsulta").textContent = get_citas_by_status(5).length

    if (useState['user_type_id'] === 2) {
        $header.querySelector(".total-citas-consulta").textContent = get_citas_by_status(6).length
    }
}
let set_item_cita = (cita_id, item, value) => {
    let index = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
    useState.citas[index][item] = value
}
let filtrarPor = (citas) => {
    citas = citas.filter(cita => {
        switch (useState['filtrar_por']) {
            case "solo_yo":
                if (equalsInt(cita['user_id_medico'], useState['user_id_medico'])) {
                    return cita
                }
            break;

            default:
                return cita
            break;
        }
    })
    return citas
}
export let handle_tablaCitas = async (status, titleTable = "Citas por confirmar") => {

    let $tableCitas = d.querySelector("#citas_pacientes tbody")
    $tableCitas.innerHTML = null
    d.querySelector(".cat-cita-status-title").classList.add("d-none")
    d.querySelector(".cat-cita-status-title").classList.remove("scale-in-hor-left")
    d.querySelector(".cat-cita-status-title").textContent = titleTable

    d.querySelector("#cargando").classList.remove("d-none")
    let citas = get_citas_by_status(status)
    if (equalsInt(citas.length, 0)) {
        $tableCitas.innerHTML = emptyItem("No se encontraron citas", 7)
        d.querySelector("#cargando").classList.add("d-none")
    } else {
        //filtrar por

        citas = filtrarPor(citas)
        /* if ( is_null( useState['users']) ) {
            let formData = new FormData();
            formData.append("pacientes_id", useState['citas'].map(x=>x['user_id_paciente']))
            formData.append("_token", d.querySelector("#_token").value)
            useState['users'] = await post(location.origin+"/user/userCitaAll",formData);
        } */
        /* let pacientes_id_faltantes = []
        citas.forEach( async cita => {
            let searchPaciente = useState['users'].find(x=>equalsInt(x['user_id'], cita.user_id_paciente))
            if ( is_undefined( searchPaciente ) ) {
                pacientes_id_faltantes.push(cita.user_id_paciente)
            }
        }) */
        /* if (!is_empty(pacientes_id_faltantes)) {
            let formData = new FormData();
            formData.append("pacientes_id", pacientes_id_faltantes )
            formData.append("_token", d.querySelector("#_token").value)
            let result = await post(location.origin+"/user/userCitaAll",formData)
            //console.log(useState['users'])
            //console.log("result",result.length)
            if (result.length === 1) {
                useState['users'].push( first(result))
            }else{
                result.forEach(x=>{
                    useState['users'].push( x )
                })
            }
            //console.log(useState['users'])
        } */

        citas.forEach( async cita => {
            let $row = await get_rowTable(cita)
            //console.log("$row",$row)
            $tableCitas.append($row)
        })
        d.querySelector("#cargando").classList.add("d-none")
        activarTooltip()
    }
    setTimeout(() => {
        d.querySelector(".cat-cita-status-title").classList.remove("d-none")
        d.querySelector(".cat-cita-status-title").classList.add("scale-in-hor-left")
    }, 200);
    activarTooltip()
    tableFilter("buscar_cita_listado","citas_pacientes")
    //$('#citas_pacientes').DataTable();
    //d.querySelector(".overlay").classList.add("d-none")
}
let handle_headerGroup = () => {
    let col_lg = 3
        if (useState['user_type_id'] !== 2) {
            col_lg = 4;
        }

    let $options = $header.querySelectorAll(`.col-lg-${col_lg}`)
        $options.forEach($option => {
            $option.addEventListener("click", async function (e) {
                let $options = $header.querySelectorAll(".small-box")
                    $options.forEach($option => {
                        $option.classList.remove(`shadow-lg-${$option.dataset.shadowColor}` )
                        d.querySelectorAll(".cat-cita-status-title")
                        .forEach(z=>{
                            z.classList.remove(`text-${$option.dataset.shadowColor}`)
                        })
                    })
                    this.querySelector(".small-box").classList.add( `shadow-lg-${ this.querySelector(".small-box").dataset.shadowColor}` )
                    d.querySelectorAll(".cat-cita-status-title")
                    .forEach(z=>{
                        z.classList.add(`text-${ this.querySelector(".small-box").dataset.shadowColor }`)
                    })

                    enrutador("#tab_citas")
                    await updateTotales()
                    useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
                let titleTable = e.currentTarget.dataset.name
                let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
                    console.log("cat_user_cita_status_id",cat_user_cita_status_id)
                    /* if ([1,4,5,6].includes( cat_user_cita_status_id )) {
                        cat_user_cita_status_id
                    } */
                    //d.querySelector("#headerCitaStatusOptions").classList.remove("d-none")
                    handle_tablaCitas(cat_user_cita_status_id, titleTable)

            })
        })
}
let handle_sidebarGroup = async (citas) => {
    $sidebar.querySelector(".sidebar-por-confirmar").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })
    $sidebar.querySelector(".sidebar-confirmadas").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })
    $sidebar.querySelector(".sidebar-preconsulta").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })
    if (useState['user_type_id'] === 2) {
        $sidebar.querySelector(".sidebar-consulta").addEventListener("click", function (e) {
            d.querySelector('body').classList.add("sidebar-collapse")
            enrutador("#tab_citas")
            useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
            let titleTable = e.currentTarget.dataset.name
            let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
            handle_tablaCitas(cat_user_cita_status_id, titleTable)
        })
    }

    $sidebar.querySelector(".sidebar-reprogramadas").addEventListener("click", function (e) {
        d.querySelector('body').classList.add("sidebar-collapse")
        enrutador("#tab_citas")
        useState.status_current_tab = e.currentTarget.dataset.cat_user_cita_status_id
        let titleTable = e.currentTarget.dataset.name
        let cat_user_cita_status_id = e.currentTarget.dataset.cat_user_cita_status_id
        handle_tablaCitas(cat_user_cita_status_id, titleTable)
    })



}
let handle_citas_confirmadas = async (e) => {
    d.querySelector("#tab_citas").classList.remove("d-none")
    d.querySelector("#tab_preconsulta").classList.add("d-none")
    let { cita_id, cat_user_cita_status_id } = e.target.dataset

    Swal.fire({
        title: '¿Desea confirmar esta cita?',
        //text: "Esta acción no se puede revertir!",
        iconHtml: '<i class="pc-warning text-warning" style="font-size:100px"></i>',
        customClass: {
            icon: 'border-0'
        },
        //icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2FA600',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Aún no!',
        confirmButtonText: 'Si, Confirmar!'
    }).then(async (result) => {


        if (result.isConfirmed) {
            d.querySelector(".overlay").classList.remove("d-none")
            // console.log("---->", cita_id,cat_user_cita_status_id)
            let fecha_cita = await get_cita_fecha(cita_id)
            //console.log("*****>>>   ", fecha_cita)
            //VALIDACION
            //SI LA CONFIRMACIÓN ES PARA UNA CITA QUE ES DEL MISMO DIA, LA ACTUALIZAREMOS A PRECONSULTA Y NO A CONGIRMADA PARA AHORRARNOS UN PASO
            /* if (comparar_fechas(timestamps(), fecha_cita) === "igual") {
                cat_user_cita_status_id = 5
            } */
            let model = await store_cita_status(cita_id, 4)

            set_item_cita(cita_id, "cat_user_cita_status_id", 4)
            await updateTotales()
            handle_tablaCitas(useState.status_current_tab)
            //d.querySelector(`.row-cita-${cita_id}`).remove()
            Swal.fire(
                'Cita confirmada!',
                'El paciente será notificado de esta acción',
                'success'
            )
            d.querySelector(".overlay").classList.add("d-none")
        }
    })
}
let handle_cancelar = async (e, cita_id, cat_user_cita_status_id) => {

    $("#exampleModalCancelar").modal("show")
    useState.formReprogramar = {
        "cat_user_cita_status_id": 2,
        "coments2": "",
        "cita_id": cita_id
    }
    let cita = await get_cita(cita_id)
    let hora = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)


    let $modal = d.querySelector(`#exampleModalCancelar`)
        $modal.querySelector(".modal-body form").innerHTML = null
        $modal.querySelector(".modal-body form").innerHTML = `
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <b class="text-primary h3">Cancelar Cita</b>
                    </div>
                    <div class="col-md-12">
                        <b class="text-secondary">Fecha Agendada:</b> <span>${fechaCortaCustom3(hora)}</span>
                    </div>
                    <div class="col-md-12 mt-2">
                        <h5 class="text-primary">Mótivo para cancelar:</h5>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">

                            <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3"
                                aria-describedby="helpId" rows="3"></textarea>
                            <small id="helpId" class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>
        `
        $modal.addEventListener("change", async function (e) {
            //console.log(e.target.name)

            if (e.target.name === "coments") {
                useState.formReprogramar["coments2"] = e.target.value
            }

        })
        $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => {
            Swal.fire({
                title: '¿Deseas cancelar esta cita?',
                text: "Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, Cancelar!'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    d.querySelector(".overlay").classList.remove("d-none")
                    let index_cita = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
                    //console.log("Estado antes Cancelar", useState['citas'][index_cita])
                    let model = await store_cita_status(cita_id, cat_user_cita_status_id, d.querySelector("textarea[name='coments']").value)
                    //delete_cita(cita_id)
                    useState['citas'][index_cita]['cat_user_cita_status_id'] = cat_user_cita_status_id
                    //console.log("Estado despues Cancelar", useState['citas'][index_cita])

                    handle_tablaCitas(useState.status_current_tab)
                    await updateTotales()
                    Swal.fire(
                        'Cita Cancelada!',
                        'El paciente será notificado de esta acción',
                        'success'
                    )
                    $("#exampleModalCancelar").modal("hide")
                    d.querySelector(".overlay").classList.add("d-none")
                }
            })

        })
    /* let $formReprogramar = document.getElementById('artefacto_0022').content
    $formReprogramar = d.importNode($formReprogramar, true);

    */


    /* $modal.querySelector(`.exampleModal_title`).textContent = "Cancelar Cita"
    let header = $modal.querySelectorAll(`table td`)
    let {
        nombres,
        apellidos
    } = useState['citas'].find(x=>equalsInt(x['user_id_paciente'],cita.user_id_paciente))
    header[0].textContent = `${nombres} ${apellidos}`
    header[1].textContent = cita.medico
    header[2].textContent = cita.especialidad_nombre */


    /* $modal.querySelector(".modal-body form").append($formReprogramar)

    let $div = $modal.querySelectorAll("form div")



    */

}
let handle_finalizar = async (e, cita_id, cat_user_cita_status_id) => {
    $("#exampleModal").modal("show")
    useState.formReprogramar = {
        "cat_user_cita_status_id": 8,
        "coments2": "",
        "cita_id": cita_id
    }
    let $modal = d.querySelector(`#exampleModal`)
    $modal.querySelector(".modal-body form").innerHTML = null
    let $formReprogramar = document.getElementById('artefacto_0022').content
    $formReprogramar = d.importNode($formReprogramar, true);

    $formReprogramar.addEventListener("change", async function (e) {
        console.log(e.target.name)

        if (e.target.name === "coments") {
            useState.formReprogramar["coments2"] = e.target.value
        }

    })
    //console.log("p_cita_id->", cita_id )
    // console.log("cita-1->", await get_cita(cita_id) )
    let cita = await get_cita(cita_id)

    if (is_undefined(cita)) {
        console.log("handle_finalizar->", cita)
        console.log(useState.citas)
        console.log(cita_id, cat_user_cita_status_id)
        console.log(useState.citas.filter(x => x.user_cita_id === cita_id))
    }
    $modal.querySelector(`.exampleModal_title`).textContent = "Paciente No asistió a consulta"
    let header = $modal.querySelectorAll(`table td`)
    let {
        nombres,
        apellidos
    } = cita.paciente
    header[0].textContent = `${nombres} ${apellidos}`
    header[1].textContent = cita.medico
    header[2].textContent = cita.especialidad_nombre


    $modal.querySelector(".modal-body form").append($formReprogramar)

    let $div = $modal.querySelectorAll("form div")
    console.log($div)
    $div[2].querySelector("h5").textContent = "Comente el motivo, si lo hubiere, de la inasistencia del paciente:"
    let hora = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)
    $div[1].querySelector("span").textContent = fechaCortaCustom3(hora)

    $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => {
        Swal.fire({
            title: '¿Deseas Finalizar esta cita?',
            text: "Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2FA600',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Aún no!',
            confirmButtonText: 'Si, Finalizar!'
        }).then(async (result) => {

            if (result.isConfirmed) {
                d.querySelector(".overlay").classList.remove("d-none")
                let index_cita = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
                console.log("Estado antes Cancelar", useState['citas'][index_cita])
                let model = await store_cita_status(cita_id, 8, d.querySelector("textarea[name='coments']").value)
                //delete_cita(cita_id)
                useState['citas'][index_cita]['cat_user_cita_status_id'] = 8
                console.log("Estado despues Cancelar", useState['citas'][index_cita])


                handle_tablaCitas(useState.status_current_tab)
                await updateTotales()
                Swal.fire(
                    'Cita Finalizada!',
                    '',
                    'success'
                )
                $("#exampleModal").modal("hide")
                d.querySelector(".overlay").classList.add("d-none")
            }
        })

    })

}
let handle_atender_hoy = async (e, cita_id, cat_user_cita_status_id) => {
    let date = new Date()
    useState.formReprogramar = {
        "cat_user_cita_status_id": 5,
        "year": date.getFullYear(),
        "month": (date.getMonth() + 1),
        "day": date.getDate(),
        "hour": date.getHours() + ":" + date.getMinutes(),
        "coments": "Cita cambiada para hoy",
        "cita_id": cita_id
    }


    Swal.fire({
        title: '¿Deseas atender esta cita hoy?',
        text: "El paciente debe estar al tanto, antes de adelantar la fecha",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2FA600',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Aún no!',
        confirmButtonText: 'Si, Atender!'
    }).then(async (result) => {

        if (result.isConfirmed) {
            d.querySelector(".overlay").classList.remove("d-none")
            let model = store_reprogramar()
            set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
            set_item_cita(cita_id, "year", useState.formReprogramar['year'])
            set_item_cita(cita_id, "month", useState.formReprogramar['month'])
            set_item_cita(cita_id, "day", useState.formReprogramar['day'])
            Swal.fire(
                'Cita Actualizada para hoy!',
                "Notifique al paciente el momento del día en que será atendido",
                'success'
            )


            handle_tablaCitas(useState.status_current_tab)
            await updateTotales()
            console.log(useState.citas)
            d.querySelector(".overlay").classList.add("d-none")
        }
    })

}
let handle_consulta_store_and_send = async (e) => {

    let { user_cita_id,color,user_id_paciente } = e.target.dataset

        $("#modelId").modal("hide")
        d.querySelector("#tab_consulta .overlay").classList.remove("d-none")
            await get(`/consultaexterna/pdf/informeCita/enviar_y_finalizar/${useState['user_centro_salud_id']}/${useState['user_id_medico']}/${user_cita_id}/${user_id_paciente}/${color}`)

            // console.log("---->", cita_id,cat_user_cita_status_id)
            let fecha_cita = await get_cita_fecha(user_cita_id)
            //console.log("*****>>>   ", fecha_cita)

            let cat_user_cita_status_id = 7

            let model = await store_cita_status(user_cita_id, cat_user_cita_status_id)

            set_item_cita(user_cita_id, "cat_user_cita_status_id", cat_user_cita_status_id)



            enrutador("#tab_citas")
            useState.status_current_tab = 6
                cat_user_cita_status_id = 6
                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                await updateTotales()


            Swal.fire(
                'Cita Guardada y Finalizada!',
                'El paciente será notificado de esta acción',
                'success'
            )
            d.querySelector("#tab_consulta .overlay").classList.add("d-none")
}
let handle_consulta_store = async (e) => {

    let { user_cita_id } = e.target.dataset

    Swal.fire({
        title: '¿Desea guardar y finalizar esta cita?',
        text: "Esta acción no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2FA600',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Aún no!',
        confirmButtonText: 'Si, Guardar y finalizar!'
    }).then(async (result) => {


        if (result.isConfirmed) {
            $("#modelId").modal("hide")
            d.querySelector("#tab_consulta .overlay").classList.remove("d-none")
            // console.log("---->", cita_id,cat_user_cita_status_id)
            let fecha_cita = await get_cita_fecha(user_cita_id)
            //console.log("*****>>>   ", fecha_cita)

            let cat_user_cita_status_id = 7

            let model = await store_cita_status(user_cita_id, cat_user_cita_status_id)

            set_item_cita(user_cita_id, "cat_user_cita_status_id", cat_user_cita_status_id)



            enrutador("#tab_citas")
            useState.status_current_tab = 6
                cat_user_cita_status_id = 6
                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                await updateTotales()


            Swal.fire(
                'Cita Guardada y Finalizada!',
                'El paciente será notificado de esta acción',
                'success'
            )
            d.querySelector("#tab_consulta .overlay").classList.add("d-none")
        }
    })
}
export let handle_finalizar_cita = async (e) => {
    let $modal = d.querySelector(`#modelId`)
        $modal.querySelector(".modal-dialog").classList.remove("modal-lg","modal-sm")
        $modal.querySelector(".modal-dialog").classList.add("modal-sm")
        $modal.querySelector(".modal-body").innerHTML = null

    $("#modelId").modal("show")
    $modal.querySelector(".modal-body").innerHTML= /*html*/ `
        <!--<button type="button" class="btn mb-2 btn-success btn-block handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}">Guardar y finalizar cita</button>-->
        <!--<button type="button" class="btn mb-2 btn-success btn-block handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}">Guardar y finalizar cita</button>-->

        <!--<div class="btn-group w-100 mb-2">
            <button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Referenciar cita a...
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item handle_referencia_especialista" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="color" href="#">Especialista</a>
            </div>
        </div>-->
        <div class="btn-group w-100 mb-2">
            <button type="button" class="btn btn-success btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Guardar y finalizar cita
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="color" href="#"  style="display:none">Color</a>
                <a class="dropdown-item handle_consulta_store" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="bw" href="#">Blanco y negro</a>
            </div>
        </div>
        <div class="btn-group w-100 mb-2">
            <button type="button" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ver Informe médico
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item handle_informe_medico" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="color" href="#"  style="display:none">Color</a>
                <a class="dropdown-item handle_informe_medico" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}" data-color="bw" href="#">Blanco y negro</a>
            </div>
        </div>
        <!--<button type="button" class="btn btn-primary btn-block" data-user_id_paciente="${e.target.dataset.user_id_paciente}" data-user_cita_id="${e.target.dataset.user_cita_id}">Generar una cíta para cirugía</button>
        <button class="btn mb-2 btn-warning btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Compartir Informe de cita por
        </button>-->

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Active link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled link</a>
                    </li>
                </ul>
            </div>
        </div>
        <button type="button" class="btn btn-default btn-block"  data-dismiss="modal">Regresar</button>
    `
    d.querySelectorAll("#modelId .handle_consulta_store").forEach(x=>{
        x.addEventListener("click",function(e){
            Swal.fire({
                title: '<strong>¡Atención!</strong>',
                icon: 'info',
                html:`
                    ¿Desea enviar por correo, y finalizar esta cita, o prefieres solo guardar y finalizar la misma?
                `,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Enviar por correo y finalizar',
                denyButtonText: `Guardar y Finalizar`,
                cancelButtonText: `Aún no!`,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    handle_consulta_store_and_send(e)
                } else if (result.isDenied) {
                    handle_consulta_store(e)
                }
            })


        })
    })
    d.querySelectorAll("#modelId .handle_informe_medico").forEach(x=>{
        x.addEventListener("click",function(e){

            window.open(`${useState['host_patientcare']}/consultaexterna/pdf/informeCita/${useState['user_centro_salud_id']}/${useState['user_id_medico']}/${e.target.dataset.user_cita_id}/${e.target.dataset.user_id_paciente}/${e.target.dataset.color}`)
        })
    })

}
let solicitud_cita_select_MEDICO = async ({cat_especialidad_id,centro_salud_id,medicos_id})=>{

       // console.log(useState['formCreateCita']);
    /*     let centro_salud =     useState['centro_salud'].find(x=> equalsInt( x['id'],centro_salud_id) )
    let medicos_id =    centro_salud['medicos_id']
                        .split(",")
                        .map(x=> parseInt(x) ) */
        d.querySelector(".overlay").classList.remove("d-none")
    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        formData.append("medicos_id",medicos_id)
        formData.append("especialidad_id",cat_especialidad_id)
        formData.append("centro_salud_id",centro_salud_id)
    let model = await post(location.origin+`/consultaexterna/user/medico/agenda/medicos`,formData);
        d.querySelector(".overlay").classList.add("d-none")
    let medicos = model.map(x=>{
            return {
                "id":x['user_id_medico'],
                "description":x['medico_descripcion'],
                "agenda":x['agenda']
                }
            })
            //console.log(medicos)
        return medicos
    /*     let medicos = useState['medicos'].map(x=>{
        return {
            "id":x['user_id_medico'],
            "description":x['medico_descripcion'],
            }
        })
    let inputSelect2 = d.querySelector(`select[name='user_id_medico']`)
        inputSelect2.innerHTML = null
        inputSelect2.append($select(medicos)) */



}

let solicitud_cita_select_CENTRO_SALUD = async (cat_especialidad_id)=>{


    let formData = new FormData();
        formData.append("_token",d.querySelector("#_token").value)
        if (is_null(useState['centro_salud'])) {
            d.querySelector(".overlay").classList.remove("d-none")
            useState['centro_salud'] = await post(location.origin+`/consultaexterna/cat/centro_salud/getAll`,formData);
            d.querySelector(".overlay").classList.add("d-none")
        }
    let centro_salud =     useState['centro_salud'].find(x=> Number(cat_especialidad_id) === Number(x['id']) )['medicos_id'].split(",").map(x=> parseInt(x) )

        return centro_salud
}
let local_timestamps2=(date) =>{
    var hoy = new Date(date);

    return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
}
let activarAgenda = ()=>{
    let agenda =  useState['formReprogramar']['agenda']
    let diasDisponible =  []
        if (!is_undefined(agenda)) {
            agenda = JSON.parse(agenda['agenda'])
            diasDisponible =  agenda.filter(x=>["publica","privada"].includes(x['visibilidad'])).map(x=>{
                let fecha = new Date(x['day']);
                    return fecha.getFullYear() + "-" + String(fecha.getMonth() + 1).padStart(2, '0') + "-" + String(fecha.getDate()).padStart(2, '0') +" 00:00"
            })
        }
        $('#calendar').datepicker('destroy')
        $('#calendar').empty();
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
        $('#calendar').datepicker().on("changeDate", function(e) {
            let {user_id_medico} = useState['formReprogramar']
            let f = new Date(e.date);
            let anio = String(f.getFullYear())
            let mes  = String(f.getMonth()+1 ).padStart(2, '0')
            let dia  = String(f.getDate()).padStart(2, '0')

                useState['formReprogramar']['year'] = anio
                useState['formReprogramar']['month'] = mes
                useState['formReprogramar']['day'] = dia
                //console.log(useState['formReprogramar'])


                document.getElementById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día a reprogramar:</b><br><span class="badge  badge-info">${fechaCortaCustom1(e.date)}</span>
                `

            let medicoFechas =  useState['formReprogramar']['agenda']
                //console.log("medicoFechas",medicoFechas);
                medicoFechas =  JSON.parse(medicoFechas['agenda'])
                medicoFechas =  medicoFechas.map(fecha=>{
                                    let fc = new Date(fecha['day'])
                                        return {
                                            "day": String(fc.getDate()).padStart(2, '0'),
                                            "month": String(fc.getMonth()+1).padStart(2, '0'),
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
                d.querySelector('#horas-tab').innerHTML =""
                if (medicoHoras.length == 0) {
                    d.querySelector('#horas-tab').innerHTML =`
                        <li class="text-center">
                            No quedan horas disponibles para este dia.
                        </li>
                    `
                }else{
                    medicoHoras.forEach((hora,key)=>{
                        //console.log(hora);
                        let textColor =""
                        if (hora['visibilidad']==="privada") {
                            textColor ="font-weight-bold border border-default"
                        }
                        let h = horaAMPM( hora['hour'] ).toUpperCase()
                            d.querySelector('#horas-tab').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora mr-1" data-hora="${hora['hour']}" role="presentation">
                                    <a class="nav-link cita-hora ${textColor}" id="hora-pm-${key}-tab" data-hora="${hora['hour']}" data-toggle="pill" href="#pills-pm-${hora['hour']}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                    /* for(let key in medicoHoras){
                        let textColor =""
                        let hora = medicoHoras[key]
                            if (medicoHoras['visibilidad']==="privada") {
                                textColor ="font-weight-bold border border-default"
                            }
                            console.log(medicoHoras[key])
                        let h = horaAMPM( hora ).toUpperCase()
                            d.querySelector('#horas-tab').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora['hour']}" role="presentation">
                                    <a class="nav-link cita-hora ${textColor}" id="hora-pm-${key}-tab" data-hora="${hora['hour']}" data-toggle="pill" href="#pills-pm-${hora['hour']}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)

                    } */

                }


        });
}
let selectCustom = (model, param) => {
    let id = param != undefined ? param : "";
    let selected = '';
    let data = "<option value=''>Seleccione</option>";
        $.each(model, function(indexInArray, valueOfElement) {
            if (Number(valueOfElement.id) == Number(id)) {

                selected = 'selected';
            } else {
                selected = '';
            }
            data += `
                <option data-agenda="${valueOfElement.agenda}" ${selected} value="${valueOfElement.id}">
                    ${valueOfElement.description}
                </option>
            `;
        });
    return data;
}
let handle_cita_reprogramar = async (e, cita_id) => {

    let cita = await get_cita(cita_id)
        console.log("cita",cita)
        useState['formReprogramar'] = {
            "cat_user_cita_status_id": 2,
            "year"                   : cita['year'],
            "month"                  : null,
            "day"                    : null,
            "hour"                   : null,
            "coments"                : "",
            "cita_id"                : cita_id,
            "agenda"                 : null,
            "user_id_medico"         : cita['user_id_medico'],
        }

    let medicos_id = await solicitud_cita_select_CENTRO_SALUD(cita['centro_salud_id'])
    let temp_medicos =  await solicitud_cita_select_MEDICO({
            medicos_id,
            "cat_especialidad_id":cita['cat_especialidad_id'],
            "centro_salud_id":cita['centro_salud_id']
        })
        useState['formReprogramar']['agendas'] = temp_medicos
        useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],cita['user_id_medico']))



        //console.log("temp_medicos",temp_medicos)
    let $modal = d.querySelector(`#exampleModal`)

        $modal.querySelector(".modal-body").innerHTML = null
    let dia_agendado = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)

    let header =  /*html*/ `
            <div class="bg-light p-2">
                <h3 class="exampleModal_title text-primary">Reprogramar Cita</h3>
                <table class="w-100">
                    <tr>
                        <th class="pr-1 text-secondary">Paciente:</th>
                        <td class="exampleModal_paciente">${cita['paciente']}</td>
                    </tr>
                    <tr>
                        <th class="pr-1 text-secondary">Especialidad:</th>
                        <td>${cita['especialidad_nombre']}</td>
                    </tr>
                    <tr>
                        <th class="pr-1 text-secondary">Centro de Salud:</th>
                        <td>${cita['centro_salud_description']}</td>
                    </tr>
                    <tr>
                        <th class="pr-1 text-secondary">Médico:</th>
                        <td class="exampleModal_medico">
                            <select name="user_id_medico" class="form-control border-0">
                                ${selectCustom(temp_medicos,cita['user_id_medico'])}
                            </select>
                        </td>
                    </tr>
                    <tr class="bg-secondary text-primary">
                        <th class="pr-1">Fecha agendada:</th>
                        <td>${ fechaCortaCustom3( dia_agendado )}</td>
                    </tr>
                </table>
            </div>
        `
        $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend",header)

        $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend", /*html */`
            <div class="h4 text-center text-primary">Selecciona un dia del calendario</div>
            <div id="calendar" class="daterange" style="width: 100%"></div>
            <div id="mensaje_dia_seleccionado" class="rounded text-center"></div>
            <div class="h4 text-center text-primary">Selecciona una hora</div>
            <ul class="nav justify-content-center nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                <div class="flex-fill text-center text-secondary" style="font-size:15px">
                    Sin Horas disponibles
                </div>
            </ul>
            <div class="h4 text-center text-primary">Motivo de reprogramación <span class="text-gray">(Opcional)</span></div>
            <div class="container-fluid">
                <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3" aria-describedby="helpId" rows="3"></textarea>
            </div>
        `)





        d.querySelector(`textarea[name='coments']`).addEventListener("change",async (e)=>{
            useState['formReprogramar']['coments'] = e.target.value
            console.log(useState['formReprogramar'])
        })
        d.querySelector(`select[name='user_id_medico']`).addEventListener("change",async (e)=>{
            let cita = await get_cita(cita_id)
            let temp_medicos =  await solicitud_cita_select_MEDICO({
                    medicos_id,
                    "cat_especialidad_id":cita['cat_especialidad_id'],
                    "centro_salud_id":cita['centro_salud_id']
                })
                useState['formReprogramar']['agendas'] = temp_medicos
                useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],e.target.value))


                useState['formReprogramar']['user_id_medico'] = e.target.value
                //console.log(e.target.selectedOptions)
                console.log(useState['formReprogramar'])
                activarAgenda()

        })

        d.addEventListener("click",(e)=>{
            if (e.target.matches(".cita-hora")) {

                useState['formReprogramar']['hour'] = e.target.dataset.hora

                console.log(useState['formReprogramar'])
            }
            if (e.target.matches("#reprogramacion_store")) {

                let mes_value = useState['formReprogramar']['month']
                    if (
                        is_null(mes_value) ||
                        is_empty(mes_value)
                    ) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Debe seleccionar una fecha disponible en el calendario",

                        })
                        return false
                    }
                let hour_value = useState['formReprogramar']['hour']
                    if (
                        is_null(hour_value) ||
                        is_empty(hour_value)
                    ) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Debe seleccionar una hora disponible",

                        })
                        return false
                    }
                Swal.fire({
                    title: "¿Deseas reprogramar esta cita?",
                    text: "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Aún no!',
                    confirmButtonText: 'Si, reprogramar!'
                }).then(async (result) => {

                    if (result.isConfirmed) {

                        let ahora = new Date();
                        let ahoraMilisegundos = ahora.getTime();


                        let fechaActualizada = new Date(useState.formReprogramar['fechacompleta'] )
                            fechaActualizada = fechaActualizada.getTime()
                            if (fechaActualizada < ahoraMilisegundos) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Atención',
                                    text: "Verifique la fecha y hora de la reprogramación",
                                })
                                return false
                            }
                            d.querySelector(".overlay").classList.remove("d-none")
                        let model = store_reprogramar()
                            d.querySelector(".overlay").classList.add("d-none")
                            set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                            set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                            set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                            set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                            set_item_cita(cita_id, "hour", useState.formReprogramar['hour'])
                            Swal.fire(
                                'Cita reprogramada!',
                                message.final_message,
                                'success'
                            )


                            handle_tablaCitas(useState.status_current_tab)
                            await updateTotales()
                            console.log(useState.citas)
                            $("#exampleModal").modal("hide")

                    }
                })
            }
        })
        activarAgenda()
        $("#exampleModal").modal("show")







    /* let message = {
            "title": "¿Deseas reprogramar esta cita?",
            "description": "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
            "final_message": "El paciente será notificado de esta acción"
        }



    let $formReprogramar = document.getElementById('artefacto_0019').content
        $formReprogramar = d.importNode($formReprogramar, true); */

       /*  $formReprogramar.querySelector("#atencion_inmediata").addEventListener("click", function (h) {
            if (h.target.checked) {
                let fecha = fechaAMD2()
                let hora = horaActual()
                //console.log("hora actual->",hora)
                d.querySelector("input[name='fecha']").value = fecha
                d.querySelector("input[name='hour']").value = hora
                d.querySelector("input[name='fecha']").disabled = true
                fecha = fecha.split("-")
                useState.formReprogramar['cat_user_cita_status_id'] = 5
                useState.formReprogramar['year'] = fecha[0]
                useState.formReprogramar["month"] = fecha[1]
                useState.formReprogramar["day"] = fecha[2]
                useState.formReprogramar["hour"] = hora
                message = {
                    "title": "¿Deseas reprogramar esta cita para hoy?",
                    "description": "El paciente debe previamente, estar al tanto de esta acción.",
                    "final_message": "Esta cita ya está activa, para la preconsulta del paciente."
                }
            } else {
                d.querySelector("input[name='fecha']").value = ""
                d.querySelector("input[name='hour']").value = ""
                d.querySelector("input[name='fecha']").disabled = false
                useState.formReprogramar['cat_user_cita_status_id'] = 2
                useState.formReprogramar['year'] = ""
                useState.formReprogramar["month"] = ""
                useState.formReprogramar["day"] = ""
                useState.formReprogramar["hour"] = ""
                message = {
                    "title": "¿Deseas reprogramar esta cita?",
                    "description": "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
                    "final_message": "El paciente será notificado de esta acción"
                }
            }
        }) */



    //let header = $modal.querySelectorAll(`table td`)


        /* header[0].textContent = `${cita['paciente']}`
        header[1].textContent = cita.medico
        header[2].textContent = cita.especialidad_nombre

        $modal.querySelector(".modal-body form").append($formReprogramar)

         */


    /* let $div = $modal.querySelectorAll("form div")

     */

        /* $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => {
            let fecha = $modal.querySelector(`#fecha`)
                if (is_empty(fecha.value)) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "Debes indicar la fecha de la cíta",
                        didClose: () => {
                            setTimeout(() => fecha.focus() , 110);
                        }
                    })
                    return false
                }
            let hour = $modal.querySelector(`#hour`)
                if (is_empty(hour.value)) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "Debes indicar la hora de la cíta",
                        didClose: () => {
                            setTimeout(() => hour.focus() , 110);
                        }
                    })
                    return false
                }
            //console.log("fecha",fecha)
            Swal.fire({
                title: message.title,
                text: message.description,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, reprogramar!'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    console.log(useState.formReprogramar)
                    //let f = new Date()
                    let ahora = new Date();
                    let ahoraMilisegundos = ahora.getTime();
                    d.querySelector(".overlay").classList.remove("d-none")

                    let fechaActualizada = new Date(useState.formReprogramar['fechacompleta'] )
                        fechaActualizada = fechaActualizada.getTime()
                    if (
                        fechaActualizada < ahoraMilisegundos

                    ) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: "Verifique la fecha y hora de la reprogramación",
                        })
                        return false
                    }

                    let model = store_reprogramar()
                    set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                    set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                    set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                    set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                    set_item_cita(cita_id, "hour", useState.formReprogramar['hour'])
                    Swal.fire(
                        'Cita reprogramada!',
                        message.final_message,
                        'success'
                    )


                    handle_tablaCitas(useState.status_current_tab)
                    await updateTotales()
                    console.log(useState.citas)
                    $("#exampleModal").modal("hide")
                    d.querySelector(".overlay").classList.add("d-none")
                }
            })

        }) */
}
let handle_vitalSigns = async ($form, user_cita_id) => {
    let $vitalSign = document.getElementById("artefacto_0024").content
    $vitalSign = d.importNode($vitalSign, true)
    let {
        user_peso,
        user_alergias,
        user_altura,
        user_temp,
        user_spo2,
        user_fc,
        user_fr,
        user_glic,
        user_ta,
    } = await get_cita(user_cita_id)
    //console.log(user_cita_id)
    if (!is_null(user_peso?.value) && !is_undefined(user_peso?.value)) {
        $vitalSign.querySelector("input[name='user_peso']").value = user_peso.value
        $vitalSign.querySelector("input[name='user_peso']").classList.add("is-valid")
    }
    if (!is_null(user_altura?.value) && !is_undefined(user_altura?.value)) {
        $vitalSign.querySelector("input[name='user_altura']").value = user_altura.value
        $vitalSign.querySelector("input[name='user_altura']").classList.add("is-valid")
    }
    if (!is_null(user_temp?.value) && !is_undefined(user_temp?.value)) {
        $vitalSign.querySelector("input[name='user_temp']").value = user_temp.value
        $vitalSign.querySelector("input[name='user_temp']").classList.add("is-valid")
    }
    if (!is_null(user_spo2?.value) && !is_undefined(user_spo2?.value)) {
        $vitalSign.querySelector("input[name='user_spo2']").value = user_spo2.value
        $vitalSign.querySelector("input[name='user_spo2']").classList.add("is-valid")
    }
    if (!is_null(user_fc?.value) && !is_undefined(user_fc?.value)) {
        $vitalSign.querySelector("input[name='user_fc']").value = user_fc.value
        $vitalSign.querySelector("input[name='user_fc']").classList.add("is-valid")
    }
    if (!is_null(user_fr?.value) && !is_undefined(user_fr?.value)) {
        $vitalSign.querySelector("input[name='user_fr']").value = user_fr.value
        $vitalSign.querySelector("input[name='user_fr']").classList.add("is-valid")
    }
    if (!is_null(user_glic?.value) && !is_undefined(user_glic?.value)) {
        $vitalSign.querySelector("input[name='user_glic']").value = user_glic.value
        $vitalSign.querySelector("input[name='user_glic']").classList.add("is-valid")
    }
    if (!is_null(user_ta?.value) && !is_undefined(user_ta?.value)) {
        $vitalSign.querySelector("input[name='user_ta_sis']").value = user_ta.value
        $vitalSign.querySelector("input[name='user_ta_sis']").classList.add("is-valid")
    }

    if (!is_null(user_ta?.value2) && !is_undefined(user_ta?.value2)) {
        $vitalSign.querySelector("input[name='user_ta_dia']").value = user_ta.value2
        $vitalSign.querySelector("input[name='user_ta_dia']").classList.add("is-valid")
    }

    $form.querySelector(".group_vital_signs").innerHTML = ""
    $form.querySelector(".group_vital_signs").append($vitalSign)
    $form.querySelector(".group_vital_signs .vital-signs").addEventListener("change", async e => {
        let {
            user_cita_id,
            user_id_paciente
        } = $form.dataset


        if (e.target.value === "") {
            e.target.classList.add("is-invalid")
            return false
        } else {
            e.target.classList.remove("is-invalid")
        }
        $form.querySelector(".overlay").classList.remove(`d-none`)
        let formData = new FormData();

        if (e.target.matches("input[name='user_ta_dia']")) {
            formData.append("value", d.querySelector("input[name='user_ta_sis']").value)
            formData.append("value2", d.querySelector("input[name='user_ta_dia']").value)
        } else {
            formData.append("value", e.target.value)
        }
        formData.append("user_cita_id", user_cita_id)
        formData.append("user_id_paciente", user_id_paciente)
        formData.append("created_at", timestamps());
        formData.append("_token", d.querySelector("#_token").value)

        let response = await post(`/consultaexterna/${e.target.name}/store`, formData)
        if (
            ![
                "user_ta_sis",
                "user_ta_dia",
            ].includes(e.target.name)
        ) {
            set_item_cita(user_cita_id, e.target.name, response)
        } else {
            set_item_cita(user_cita_id, "user_ta", response)
        }
        e.target.classList.add("is-valid")
        $form.querySelector(".overlay").classList.add(`d-none`)
    })

}
let handle_patientCard = (card, data) => {
    //console.log(card)
    let $card = document.getElem