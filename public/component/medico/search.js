import { $qs, clone } from '../../helpers/helpers.js'
import * as ComponentMedico from '../medico/medico_home.js'
import * as ComponentCita from '../cita/cita.js'

let d = document

/* export let get_all = (attr) => {
        return useState[attr]
    }
export let get_index = (attr,key,value) => {
        return useState[ attr ].findIndex( index => equalsInt(index[key]), value )
    }
export let get_one = (attr,key,value) => {
        return useState[ attr ].map( index => equalsInt( index[key] ), value )
    }
export let add_row = (attr,value,position="first") => {
        if (position === "first") {
            useState[ attr ].unshift(value)
        }
        if (position === "last") {
            useState[ attr ].push(value)
        }
    }
export let delete_one = ({attr,index,item_id}) => {
        useState[ attr ][ get_index(item_id) ].splice(index,1);
    } */
export let handle_buscador_nueva_cita = async (e) => {
        localStorage.setItem("component_search_cedula", e.target.dataset.cedula)
        ComponentCita.create()
    }
let list_row = (item)=>{

    let $row = entById("artefacto_0030").content.cloneNode(true)
        $row.querySelector("tr").classList.add(`row-cita-${item['user_id']}`)
        $row.querySelector(".card-item-paciente-image").src = item['imagen']
        //$row.querySelector("small").textContent = "#" + item['user_cita_id']
        $row.querySelector(".card-item-paciente-fullname").textContent = item['paciente']
        $row.querySelector(".card-item-paciente-cedula").textContent = item['cedula']
        $row.querySelector(".card-item-paciente-edad").textContent = item['edad']
        $row.querySelector(".card-item-paciente-genero").textContent = item['genero'].toUpperCase()
        $row.querySelector(".card-item-total-citas").textContent = item['citas_completadas']

        let paciente = item
        if ( paciente['exonerado'] > 0) {
            let bgColor ="bg-danger"
                if (
                    paciente['exonerado'] >24 &&
                    paciente['exonerado'] <=49
                ) {
                    bgColor = "bg-info"
                }
                if (
                    paciente['exonerado'] >49 &&
                    paciente['exonerado'] <=74
                ) {
                    bgColor = "bg-warning"
                }
                if (
                    paciente['exonerado'] >74 &&
                    paciente['exonerado'] <=100
                ) {
                    bgColor = "bg-success"
                }


                $row.querySelector(".tag-exonerado").classList.add("d-flex",bgColor)
                $row.querySelector(".tag-exonerado").innerHTML = `<i class="fas fa-check-double"></i> Exonerado ${paciente['exonerado']}%`
        }
        if (!is_null(item.tarjeta_soy_chacao)) {
            $row.querySelector(".tarjeta-salud-chacao").classList.add("bg-chacao")
            $row.querySelector(".tarjeta-salud-chacao b").classList.remove("text-gray")
            $row.querySelector(".tarjeta-salud-chacao b").classList.add("text-white")
            $row.querySelector(".card-item-paciente-tarjeta-chacao").textContent = item.tarjeta_soy_chacao
        } else {
            $row.querySelector(".tarjeta-salud-chacao").classList.remove("bg-chacao")
            $row.querySelector(".tarjeta-salud-chacao b").classList.remove("text-white")
            $row.querySelector(".tarjeta-salud-chacao b").classList.add("text-gray")
            $row.querySelector(".card-item-paciente-tarjeta-chacao").textContent = 'No posee'
        }


        $row.querySelectorAll(".enlace-whatsapp").forEach(x => {
            x.dataset.telefono_movil = item.telefono_movil
        })
        $row.querySelector(".card-item-paciente-telefono-movil").textContent = `${!is_null(item.telefono_movil) ? item.telefono_movil : 'No Indicado'}`

        $row.querySelector(".buscador_nueva_cita").dataset.cedula = item['cedula']
        $row.querySelector(".buscador_nueva_cita").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".paciente-edit").dataset.cedula = item['cedula']
        $row.querySelector(".paciente-edit").dataset.user_id_paciente = item['user_id']
        $row.querySelector(".paciente-edit i").dataset.cedula = item['cedula']
        $row.querySelector(".paciente-edit i").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".paciente-historial-citas").dataset.user_id_paciente = item['user_id']
        $row.querySelector(".paciente-historial-citas i").dataset.user_id_paciente = item['user_id']

        return $row
}
let list = async (items) => {
    let $fragment = d.createDocumentFragment();
    let $row;
    for (let index = (items.length-1); index >= 0; index--) {
            $row = list_row( items[index] )
            $fragment.append($row)
        }
        return $fragment
    }
export let search = async () => {
        let search_value = d.querySelector(`#navbar-search3 input[name='search_value']`)
        //let $App = d.querySelector(`${useState['tab']} #App`)
        //ComponentMedicoHome.enrutador("#tab_app")
        let $App= d.querySelector(`#tab_app`)
        let $form = clone( "artefacto_0039" )
            $App.innerHTML=null
            $App.append( $form )

        let $tbody = $App.querySelector(`table tbody`)
            $tbody.innerHTML = null
            if (!is_empty(search_value.value)) {
                $tbody.innerHTML = emptyItem(`
                    <div class="bg-default p-3">
                        <div class="d-flex justify-content-between text-white">
                            <span class="float-left text-primary font-weight-bold">
                                Espere un momento por favor...
                            </span>
                            <span class="spinner-border  text-primary float-right" role="status">
                                <span class="sr-only"></span>
                            </span>
                        </div>
                    </div>
                `, 4)

                //console.log( useState['search_resultset'])
                let er = new RegExp( search_value.value , "i" )
                let resulset =""
                    //console.log(useState['users'])

                    //console.log( "resulset",resulset)
                    //if  ( equalsInt(resulset.length,0) ) {
                        useState['search_resultset'] = await get(`/consultaexterna/user/profile/searchUser/${search_value.value}`)
                        //resulset = useState['search_resultset']
                    //}
                    resulset = useState['search_resultset'].filter(x => {

                        let nombreCustom = x.paciente.split(" ")
                        let nombreCustom1 = ""
                        let nombreCustom2 = ""
                        let nombreCustom3 = ""
                        let nombreCustom4 = ""
                        let nombreCustom5 = ""
                        let nombreCustom6 = ""
                            if (nombreCustom.length === 4) {
                                nombreCustom1 = nombreCustom[0].toLowerCase() +" "+nombreCustom[2].toLowerCase() +" "+nombreCustom[3].toLowerCase()
                                nombreCustom2 = nombreCustom[1].toLowerCase() +" "+nombreCustom[2].toLowerCase() +" "+nombreCustom[3].toLowerCase()
                                nombreCustom3 = nombreCustom[0].toLowerCase() +" "+nombreCustom[2].toLowerCase()
                                nombreCustom4 = nombreCustom[0].toLowerCase() +" "+nombreCustom[3].toLowerCase()
                                nombreCustom5 = nombreCustom[1].toLowerCase() +" "+nombreCustom[2].toLowerCase()
                                nombreCustom6 = nombreCustom[1].toLowerCase() +" "+nombreCustom[3].toLowerCase()

                            }

                        let valor = x.cedula+
                                x.email                 +
                                x.paciente              +
                                nombreCustom1           +
                                nombreCustom2           +
                                nombreCustom3           +
                                nombreCustom4           +
                                nombreCustom5           +
                                nombreCustom6           +
                                x.tarjeta_soy_chacao    +
                                x.telefono_movil        +
                                x.user_id;
                            if (er.test(valor)) {
                                return valor
                            }

                    })
                    //
                    //index(useState['search_resultset'])
                    //init()
                    //event_search()

                        if (resulset.length > 0) {
                                $tbody.innerHTML = null
                            let $rowList = await list(resulset)
                                $tbody.append($rowList)

                        }else {
                            $tbody.innerHTML = emptyItem("Sin resultados", 4)
                        }

            }else{
                $tbody.innerHTML = emptyItem("Sin resultados", 4)
            }
    }
let event_search = async  ()=>{


    }
export let index = async (items) => {
        init()
        event_search()
        /* let $App = d.querySelector(`${useState['tab']} #App`)
        let $form = clone( "artefacto_0039" )
            $App.innerHTML=null
            $App.append( $form )

        let $tbody = $App.querySelector(`table tbody`)
            $tbody.innerHTML = ""
            if (items.length > 0) {
                let $rowList = await list(items)
                    $tbody.append($rowList)

            }else {
                $tbody.innerHTML = emptyItem("Sin resultados", 3)
            } */

    }
export let create = async () => {

    }
export let store = async (item_id) => {

    }
export let show = async (item_id) => {

    }
export let update = async (item_id) => {

    }
export let destroy = async (item_id) => {

    }
export let form_create = async (item_id) => {

    }


export let init = async ($tab="#tab_app") => {
        //useState['users'] = items
        useState['tab'] = $tab
        ComponentMedico.enrutador($tab)




    }
