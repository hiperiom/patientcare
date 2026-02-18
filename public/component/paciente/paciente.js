import { $qs, add_row, clone, first, is_undefined, selectOptions, store_field, update_row } from '../../helpers/helpers.js'
import {index as CatUserEstado_index} from '../catalogs/cat_estado.js'
import {index as CatUserMunicipio_index} from '../catalogs/cat_municipio.js'
import * as ComponentMedico from '../medico/medico.js'
import * as ComponentMedicoHome from '../medico/medico_home.js'
import * as ComponentBuscador from '../medico/search.js'
import * as ComponentCita from '../cita/cita.js?version = 0.1'
import * as Componentpaciente from '../../component/paciente/paciente.js'
let d = document
export let editAdmin = async ( user_id_paciente ) => {

    let user_id = user_id_paciente
        console.log("user_id",user_id)

    let paciente = useState['users'].find(x => equalsInt(x.user_id,user_id) )
        console.log(paciente)
        if (is_undefined(paciente)) {
            let model = await get(`/consultaexterna/user/userCita/${user_id}`)
                console.log(model[0]);
                if (model.length > 0) {
                    useState['users'].push( first(model) )
                    paciente = first(model)
                }
        }


        //console.log(useState['users']);

        let $App= d.querySelector(`#App`)

        let $form = clone( "artefacto_0029" )
            useState['cat_estado']       = await CatUserEstado_index()
            useState['cat_municipio']    = await CatUserMunicipio_index()

            if ($('select').data('select2')) {
                $('select').select2('destroy');
            }

            $App.innerHTML=null
            $App.append( $form )

            $App.querySelector("h3").textContent="Editar Paciente"

            d.querySelector("#userImagePreview").src=paciente.imagen

            if (!is_null( paciente.imgDocIdentidad ) ) {
                d.querySelector("#imgDocIdentidadPreview").src=paciente.imgDocIdentidad
            }
            if (!is_null( paciente.imgSoyChacao ) ) {
                d.querySelector("#imgSoyChacaoPreview").src=paciente.imgSoyChacao
            }

            telefonoConfig("#telefono_movil")
            $App.querySelector(`#submit`).innerHTML="Actualizar"

            $App.querySelector(`input[name='tarjeta_soy_chacao']`).removeAttribute("readonly")

            $App.querySelector(`input[name='cedula']`).value= paciente.cedula
            $App.querySelector(`input[name='email']`).value= paciente.email
            $App.querySelector(`input[name='nombres']`).value= paciente.nombres
            $App.querySelector(`input[name='apellidos']`).value= paciente.apellidos

            $App.querySelector(`select[name='genero']`).value= paciente.genero
            $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( paciente.fnacimiento )
            $App.querySelector(`input[name='telefono_movil']`).value=  paciente.telefono_movil
            $App.querySelector(`input[name='description']`).value= paciente.description
            $App.querySelector(`input[name='domicilio']`).value= paciente.domicilio

            $App.querySelector(`input[name='tarjeta_soy_chacao']`).value= !is_null(paciente.tarjeta_soy_chacao) ? paciente.tarjeta_soy_chacao :''

            entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, paciente.cat_estado_id)
            entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,paciente.cat_estado_id ) ), paciente.cat_municipio_id )

            entById("userImage").addEventListener("change",e=>{
                imagePreview(e,"userImagePreview")
            })
            entById("imgDocIdentidad").addEventListener("change",e=>{
                imagePreview(e,"imgDocIdentidadPreview")
            })
            entById("imgSoyChacao").addEventListener("change",e=>{
                imagePreview(e,"imgSoyChacaoPreview")
            })
            //validar si existe la cedula
            entById("cedula").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("cedula",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
                console.log('respuesta 3 --> ',existeModel);
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                                didClose: () => {
                                    setTimeout(() => {
                                        e.target.value=""
                                        e.target.focus()
                                    } , 110);
                                }
                            })
                        return false
                    }else{
                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            })
            //validar si existe el correo
            entById("email").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("email",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/consultaexterna/user/emailExist",formData)
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                                didClose: () => {
                                    setTimeout(() => {
                                        e.target.value=""
                                        e.target.focus()
                                    } , 110);
                                }
                            })
                        return false
                    }else{
                        if ( !is_empty(e.target.value) ) {

                            ruta = "/consultaexterna/user/update_item"
                            //$key= false
                            let response = await store_field(
                                    e.target.name,
                                    e.target.value,
                                    user_id,
                                    ruta
                                )
                                if ( !is_null(response) ) {
                                    let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                    useState['users'][index][e.target.name] = response[e.target.name]

                                }
                            return false
                        }




                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            })
            d.querySelector("#submit").addEventListener("click", async function(e){
                e.preventDefault()
                Swal.fire({
                    icon: 'success',
                    title: 'Datos Actualizados',
                    text: 'Los cambios se realizaron correctamente.',
                })
                $('[data-widget="pushmenu"]').PushMenu('toggle')
                /* let $template = entById("artefacto_0053").content.cloneNode(true)
                let $App = d.querySelector("#App")
                    $App.innerHTML= null
                    $App.scrollTop = 0;
                    $App.append($template)
                    d.querySelector(".btn-paciente-search").addEventListener("click",function(){
                        search()
                    })
                    d.querySelector(`input[name='search_value']`).addEventListener("keydown", async function (e) {
                        if (e.code=== 'Enter' || e.code === 'NumpadEnter') {
                            search()
                        }
                    }) */
                //ComponentMedicoHome.enrutador("#tab_citas")
                //ComponentMedicoHome.handle_tablaCitas(1)
            })
            $('#cat_estado_id').on('select2:select', async function (e) {
                let model = useState['cat_municipio'].filter(x=>equalsInt(x.cat_estado_id,e.params.data.id ))
                    entById("cat_municipio_id").innerHTML=null
                    entById("cat_municipio_id").append($select(model))
                let response = await store_field(
                        e.target.name,
                        e.target.value,
                        user_id,
                        "/consultaexterna/user/direction/update_item"
                    )
                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                        useState['users'][index]['cat_estado_id'] =response.cat_estado_id
            });
            $('#cat_municipio_id').on('select2:select', async function (e) {
                let response = await store_field(
                    e.target.name,
                    e.target.value,
                    user_id,
                    "/consultaexterna/user/direction/update_item"
                )
                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                    useState['users'][index]['cat_municipio_id'] =response.cat_municipio_id
            });
            $('.select2').select2()

        let ruta = ""
            $App.addEventListener("change", async function(e){
                //console.log(e.target)
                let $key = true;
                //$App.querySelector(".overlay").classList.remove("d-none")


                if (
                    e.target.matches("select[name='nacionalidad']") ||
                    e.target.matches("input[name='cedula']") ||
                    e.target.matches("input[name='nombres']") ||
                    e.target.matches("input[name='apellidos']") ||
                    e.target.matches("select[name='genero']") ||
                    e.target.matches("input[name='fnacimiento']") ||
                    e.target.matches("input[name='telefono_movil']")
                    && $key

                ) {
                    if ( !is_empty(e.target.value) ) {

                        $App.querySelector(".overlay").classList.remove("d-none")
                        ruta = "/consultaexterna/user/profile/update_item"
                        $key= false
                        let response = await store_field(
                                e.target.name,
                                e.target.value,
                                user_id,
                                ruta
                            )
                            if ( !is_null(response) ) {
                                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                    switch (e.target.name) {
                                        case 'fnacimiento':
                                            useState['users'][index][e.target.name] = first(response)[e.target.name]
                                            useState['users'][index]["edad"] = first(response)["edad"]
                                        break;
                                        default:
                                            useState['users'][index][e.target.name] = first(response)[e.target.name]
                                        break;
                                    }
                                    //console.log(e.target.name,"->",first(response)[e.target.name] )
                                    //console.log("user->",useState['users'][index])
                                    $App.querySelector(".overlay").classList.add("d-none")
                            }else{
                                $App.querySelector(".overlay").classList.add("d-none")
                            }
                        return false
                    }

                }

                if (
                    e.target.matches("input[name='imagen']")
                    && $key
                ) {

                    $App.querySelector(".overlay").classList.remove("d-none")
                    ruta ="/consultaexterna/user/profile/update_item_file"
                    $key= false
                    let file = d.querySelector(`input[name='imagen']`).files[0];
                    let response = await store_field(
                            e.target.name,
                            file,
                            user_id,
                            ruta
                        )
                        if ( !is_null(response) ) {
                            let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                useState['users'][index][e.target.name] = response[e.target.name]

                                $App.querySelector(".overlay").classList.add("d-none")
                        }else{
                            $App.querySelector(".overlay").classList.add("d-none")
                        }
                    return false

                }
                if (
                    e.target.matches("input[name='description']") ||
                    e.target.matches("input[name='domicilio']")
                    && $key
                ) {

                    if ( !is_empty(e.target.value) ) {

                        $App.querySelector(".overlay").classList.remove("d-none")
                        ruta = "/consultaexterna/user/direction/update_item"
                        $key= false
                        let response = await store_field(
                                e.target.name,
                                e.target.value,
                                user_id,
                                ruta
                            )
                            if ( !is_null(response) ) {
                                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))

                                    useState['users'][index][e.target.name] = response[e.target.name]

                                    $App.querySelector(".overlay").classList.add("d-none")
                            }else{
                                $App.querySelector(".overlay").classList.add("d-none")
                            }
                        return false
                    }
                }
                if (
                    e.target.matches("input[name='imgSoyChacao']") ||
                    e.target.matches("input[name='imgDocIdentidad']")

                    && $key
                ) {
                    if ( !is_empty(e.target.value) ) {

                        $App.querySelector(".overlay").classList.remove("d-none")
                        ruta = `/consultaexterna/user/profile_images/update_item_file/${e.target.name}`
                        $key= false
                        let file = d.querySelector(`input[name='${e.target.name}']`).files[0];
                        let response = await store_field(
                                e.target.name,
                                file,
                                user_id,
                                ruta
                            )
                            if ( !is_null(response) ) {

                                let index = useState['users'].findIndex(x=> equalsInt(x.user_id, user_id))
                                    useState['users'][index][e.target.name] = response.value


                                    $App.querySelector(".overlay").classList.add("d-none")
                            }else{
                                $App.querySelector(".overlay").classList.add("d-none")
                            }
                        return false
                    }

                    $key= false
                    let file = d.querySelector(`input[name='${e.target.name}']`).files[0];
                    let response = await store_field(
                            e.target.name,
                            file,
                            user_id,
                            `/consultaexterna/user/profile_images/update_item_file/${e.target.name}`
                        )
                        if ( !is_null(response) ) {
                            //useState['paciente'][e.target.name] = response["value"]
                            //useState.get_card_paciente()
                            let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                useState['users'][index][e.target.name]= response.value
                            // Object.assign( useState['users'][index],response )
                            $App.querySelector(`#${e.target.name}Preview`).src= "/"+useState['paciente'][e.target.name]
                            $App.querySelector(".overlay").classList.add("d-none")
                        }
                        //console.log( useState['paciente'] )
                        return false



                }
                if (
                    e.target.matches("input[name='tarjeta_soy_chacao']")
                    && $key
                ) {
                    if ( !is_empty(e.target.value) ) {
                        ruta = "/consultaexterna/user/paciente/tarjeta_soy_chacao/update_item"
                        $key= false
                    }
                }

                if ( !is_empty(e.target.value) ) {
                    let response = await store_field(
                            e.target.name,
                            e.target.value,
                            user_id,
                            ruta
                        )
                        if ( !is_null(response) ) {
                            //console.log( useState['users'] )
                            let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                            useState['users'][index]
                            Object.assign( useState['users'][index],response )
                            //console.log("index",index)
                            //console.log( useState['users'] )
                            //update_row({attr:"users",key:"user_id", value:user_id, "resultset":response})
                            //useState['paciente'][e.target.name] = response[e.target.name]
                            //useState.get_card_paciente()
                            //$App.querySelector(".overlay").classList.add("d-none")
                        }
                }
                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))

                console.log( "useState['users']", useState['users'][index] )
            })

}
let list_row = (item)=>{
    console.log(item);
    let $row = entById("artefacto_0054").content.cloneNode(true)
        $row.querySelector("tr").classList.add(`row-cita-${item['user_id']}`)
        $row.querySelector(".btn-edit-paciente").addEventListener("click",function(){
            editAdmin(item['user_id'])
        })
        $row.querySelector(".btn-edit-paciente").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".btn-delete-paciente").addEventListener("click",function(){
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrá deshacer esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, ¡eliminar paciente!"
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                    title: "¡Paciente eliminado!",
                    text: "El paciente fue eliminado con éxito.",
                    icon: "success"
                  });
                }
              });
        })
        $row.querySelector(".btn-delete-paciente").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".btn-reset-pass-paciente").addEventListener("click", function(){

            Swal.fire({
                title: '¿Deseas restablecer esta contraseña?',
                text: "Al restablecer la contraseña, la misma volverá a ser: 123456",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, ¡Restablecer!'
              }).then(async (result) => {
                if (result.isConfirmed) {
                    let $model = await get(location.origin+`/consultaexterna/user/login/resetPassword/AtencionPaciente/${item['cedula']}`)

                    if ($model === "cedula_no_encontrada") {
                        Swal.fire(
                            '¡Error!',
                            'Esta cédula no se encontró en el sistema.',
                            'error'
                        )
                        return false
                    }else{
                        Swal.fire(
                            '¡Contraseña restablecida exitosamente!',
                            'Ahora el usuario puede usar su cédula y la contraseña 123456 para autenticarse en el sistema.',
                            'success'
                        )
                    }

                }
              });

        })
        $row.querySelector(".btn-reset-pass-paciente").dataset.user_id_paciente = item['user_id']


        $row.querySelector(".card-item-paciente-image").src = item['imagen']
        //$row.querySelector("small").textContent = "#" + item['user_cita_id']
        $row.querySelector(".card-item-paciente-fullname").textContent = item['paciente']
        $row.querySelector(".card-item-paciente-cedula").textContent = item['cedula']
        $row.querySelector(".card-item-paciente-edad").textContent = item['edad']
        $row.querySelector(".card-item-paciente-genero").textContent = item['genero'].toUpperCase()
        $row.querySelector(".card-item-total-citas").textContent = item['citas_completadas']
        let color =""
        let paciente = item
        if ( paciente['exonerado'] > 0) {

                if (
                    paciente['exonerado'] == 25
                ) {
                    color = "info"
                }
                if (
                    paciente['exonerado'] ==50
                ) {
                    color = "primary"
                }
                if (
                    paciente['exonerado'] ==75
                ) {
                    color = "warning"
                }
                if (
                    paciente['exonerado'] ==100
                ) {
                    color = "success"
                }
            let bgColor =  "bg-"+color


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


        //exonerado
    let $button =$row.querySelector(".card-exonerado button")

        $button.id=`trigger${paciente['id']}`
        $button.classList.add("text-"+color)
        $button.textContent = `${paciente['exonerado']}%`
    let $dropdown =$row.querySelector(".card-exonerado .dropdown-menu")
        $dropdown.id=`option_exonerado_${paciente['id']}`
    let $options =$row.querySelectorAll(".card-exonerado .dropdown-menu a")
        $options.forEach(x=>{
            x.dataset['id']=paciente['id']
            if(x.dataset['exonerado'] == paciente['exonerado']){
                x.classList.add("active")
            }
        })
    let cat_user_type_id = paciente['roles'].split(",").map( z=>Number(z))
    let $roles =$row.querySelectorAll(".card-roles li")
        $roles.forEach(x=>{
            x.dataset['user_id']=paciente['user_id']
            x.querySelector("i").dataset['user_id']=paciente['user_id']
            x.dataset['active']=false
            x.querySelector("i").dataset['active']=false

            if(cat_user_type_id.includes(Number(x.dataset['cat_user_type_id']))){
                console.log(cat_user_type_id,Number(x.dataset['cat_user_type_id']))
                if (Number(x.dataset['cat_user_type_id']) == 1) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-success")
                }
                if (Number(x.dataset['cat_user_type_id']) == 2) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-primary")
                }
                if (Number(x.dataset['cat_user_type_id']) == 6) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-warning")
                }
                if (Number(x.dataset['cat_user_type_id']) == 7) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-orange")
                }
                if (Number(x.dataset['cat_user_type_id']) == 4) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-secondary")
                }
            }
        })
        /*$row.querySelector(".buscador_nueva_cita").dataset.cedula = item['cedula']
        $row.querySelector(".buscador_nueva_cita").dataset.user_id_paciente = item['user_id']

         $row.querySelector(".paciente-edit").dataset.cedula = item['cedula']
        $row.querySelector(".paciente-edit").dataset.user_id_paciente = item['user_id']
        $row.querySelector(".paciente-edit i").dataset.cedula = item['cedula']
        $row.querySelector(".paciente-edit i").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".paciente-historial-citas").dataset.user_id_paciente = item['user_id']
        $row.querySelector(".paciente-historial-citas i").dataset.user_id_paciente = item['user_id'] */

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
    let search_value = $App.querySelector(`input[name='search_value']`)


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
            `, 5)

            //console.log( useState['search_resultset'])
            let er = new RegExp( search_value.value , "i" )
            let resulset =""
                    useState['pacientes'] = await get(`/consultaexterna/user/profile/searchUser/${search_value.value}`)

                resulset = useState['pacientes'].filter(x => {

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

                if (resulset.length > 0) {
                        $tbody.innerHTML = null
                    let $rowList = await list(resulset)
                        $tbody.append($rowList)

                }else {
                    $tbody.innerHTML = emptyItem("Sin resultados", 6)
                }

        }else{
            $tbody.innerHTML = emptyItem("Sin resultados", 6)
        }
}
export let index_admin = async (item_id) => {
    $('[data-widget="pushmenu"]').PushMenu('toggle')
    let $template = entById("artefacto_0053").content.cloneNode(true)
    let $App = d.querySelector("#App")
        $App.innerHTML= null
        $App.scrollTop = 0;
        $App.append($template)
        d.querySelector(".btn-paciente-search").addEventListener("click",function(){
            search()
        })
        d.querySelector(`input[name='search_value']`).addEventListener("keydown", async function (e) {
            if (e.code=== 'Enter' || e.code === 'NumpadEnter') {
                search()
            }
        })
}
export let motivo_exoneracion_store = async (e) => {
    let id = e.target.dataset['id']
    let value = e.target.value
    let formData = new FormData();
        formData.append("field","motivo_exonerado")
        formData.append("value",value)
        formData.append("_token",d.querySelector("#_token").value)

    let model = await  post( location.origin+"/consultaexterna/user/profile/update_field/"+id,formData )
    e.target.classList.add("is-valid")


}
export let exonerado_update = async (id,exonerado) => {
    let formData = new FormData();
        formData.append("field","exonerado")
        formData.append("value",exonerado)
        formData.append("_token",d.querySelector("#_token").value)

    let model = await  post( location.origin+"/consultaexterna/user/profile/update_field/"+id,formData )
    d.querySelector(`#trigger${id}`).textContent=`${exonerado}%`
    d.querySelector(`#trigger${id}`).classList.remove("text-info","text-warning","text-orange","text-success")
    let color =""
    if (
        exonerado == 25
    ) {
        color = "info"
    }
    if (
        exonerado ==50
    ) {
        color = "primary"
    }
    if (
        exonerado ==75
    ) {
        color = "warning"
    }
    if (
        exonerado ==100
    ) {
        color = "success"
    }
    color =  "text-"+color
    d.querySelector(`#trigger${id}`).classList.add(color)
    let $options = d.querySelectorAll(`#option_exonerado_${id} a`)
        //console.log($options)
        $options.forEach(x=>{
            x.classList.remove("active")
            if (
                exonerado == x.dataset['exonerado']
            ) {
                x.classList.add("active")
            }


        })
        Swal.fire({
            icon: 'success',
            title: 'Exoneración actualizada',
            text: 'Los cambios se realizaron correctamente.',
        })
}

export let index_exonerado = async (item_id) => {
    $('[data-widget="pushmenu"]').PushMenu('toggle')
        let $template = entById("artefacto_0055").content.cloneNode(true)
        let $App = d.querySelector("#App")
            $App.innerHTML= null
            $App.scrollTop = 0;
            $App.append($template)
            try {
                let model = await get(location.origin+"/consultaexterna/user/profile/exonerado");
                    //useState['exonerados'] = model

                    if (Object.keys(model).length > 0) {
                        $("#index_table_medicos tbody").empty();
                        model.map(valueOfElement=>{
                            let color =""
                            let active = "";

                            if (
                                valueOfElement['exonerado'] == 25
                            ) {
                                color = "info"
                            }
                            if (
                                valueOfElement['exonerado'] ==50
                            ) {
                                color = "primary"
                            }
                            if (
                                valueOfElement['exonerado'] ==75
                            ) {
                                color = "warning"
                            }
                            if (
                                valueOfElement['exonerado'] ==100
                            ) {
                                color = "success"
                            }
                            color =  "text-"+color

                            $("#index_table_medicos tbody").append(`
                                <tr id="row_${valueOfElement['user_id']}">
                                    <td>
                                        <img id="image-perfil" onerror="reemplaza_imagen(this)" src="${valueOfElement['imagen']}" style="width: 1.5cm;height:1.5cm" class="image-perfil rounded-circle mx-auto d-block" alt="Medic default">
                                    </td>
                                    <td>
                                        ${valueOfElement['paciente']}
                                    </td>
                                    <td class="text-center">
                                        ${valueOfElement['genero']}
                                    </td>
                                    <td class="text-right">
                                        ${valueOfElement['cedula']}
                                    </td>
                                    <td>
                                        ${is_null(valueOfElement['telefono_movil'])?'':valueOfElement['telefono_movil']}
                                    </td>
                                    <td>
                                        <div>
                                        ${valueOfElement['email']}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn ${color} btn-default border-0 btn-block dropdown-toggle" type="button" id="trigger${valueOfElement['id']}" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    ${valueOfElement['exonerado']}%
                                            </button>
                                            <div id="option_exonerado_${valueOfElement['id']}" class="dropdown-menu" aria-labelledby="trigger${valueOfElement['id']}">
                                                <a data-exonerado="0" data-id="${valueOfElement['id']}"     class="${valueOfElement['exonerado'] == 0?'active':'' } btn-exonerado-update dropdown-item" href="#">0%</a>
                                                <a data-exonerado="25" data-id="${valueOfElement['id']}"    class="${valueOfElement['exonerado'] == 25?'active':'' } btn-exonerado-update dropdown-item" href="#">25%</a>
                                                <a data-exonerado="50" data-id="${valueOfElement['id']}"    class="${valueOfElement['exonerado'] == 50?'active':'' } btn-exonerado-update dropdown-item" href="#">50%</a>
                                                <a data-exonerado="75" data-id="${valueOfElement['id']}"    class="${valueOfElement['exonerado'] == 75?'active':'' } btn-exonerado-update dropdown-item" href="#">75%</a>
                                                <a data-exonerado="100" data-id="${valueOfElement['id']}"   class="${valueOfElement['exonerado'] == 100?'active':'' } btn-exonerado-update dropdown-item" href="#">100%</a>
                                            </div>
                                        </div>

                                    </td>



                                    <td >

                                        <textarea class="form-control motivo_exoneracion" name="motivo_exoneracion_${valueOfElement['id']}" data-id="${valueOfElement['id']}"  rows="1">${!is_null(valueOfElement['motivo_exonerado']) ? valueOfElement['motivo_exonerado']:''}</textarea>

                                    </td>
                                    <td nowrap>
                                    </td>
                                </tr>
                            `);
                        })

                    }else{
                        throw new Error(model);
                    }
                    $('#index_table_medicos').DataTable( {
                        "order": [[ 1, "asc" ]]
                    });

            } catch (error) {
                //console.log("error",error)
                message = { 'title': 'Error', 'message': 'Ha ocurrido un error', 'image': 'error' };
                Toast.fire({
                    icon: message['imagen'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => console.log(error), 110);
                    }
                })
            }
    }
let pariente_revisado = (id,value)=>{
alert(value)
    }
export let index_familiar = async (item_id) => {

    $('[data-widget="pushmenu"]').PushMenu('toggle')
        let $template = entById("artefacto_0058").content.cloneNode(true)
        let $App = d.querySelector("#App")
            $App.innerHTML= null
            $App.scrollTop = 0;
            $App.append($template)
            try {
                let model = await get(location.origin+"/consultaexterna/user/familiar/por_revisar");

                    if (Object.keys(model).length > 0) {
                        $("#index_table_familiar tbody").empty();
                        model.map(valueOfElement=>{
                            let color_parentesco = "";
                                if (valueOfElement['cat_user_family_id'] == 5) {
                                    color_parentesco = "text-info"
                                }
                                if (valueOfElement['cat_user_family_id'] == 6) {
                                    color_parentesco = "text-orange"
                                }
                                if (valueOfElement['cat_user_family_id'] == 7) {
                                    color_parentesco = "text-primary"
                                }
                                if (valueOfElement['cat_user_family_id'] == 3) {
                                    color_parentesco = "text-success"
                                }
                            $("#index_table_familiar tbody").append( /*html */`
                                <tr id="row_${valueOfElement['id']}">
                                    <td>
                                        ${valueOfElement['paciente']}
                                    </td>
                                    <td>
                                        <div class="${!is_null(valueOfElement['imgDocIdentidad_paciente']) ? 'd-none' : ''}">
                                            ${valueOfElement['cedula_paciente']}
                                        </div>

                                        <a
                                            href="${valueOfElement['imgDocIdentidad_paciente']}"
                                            class="mt-1 btn btn-default btn-block text-nowrap ${is_null(valueOfElement['imgDocIdentidad_paciente']) ? 'd-none' : ''}"
                                            target="_blank"
                                        >
                                            <i class="fas fa-paperclip text-info"></i> ${valueOfElement['cedula_paciente']}
                                        </a>
                                    </td>
                                    <td class="text-center ${color_parentesco}">
                                        ${valueOfElement['cat_user_family_description']}
                                    </td>
                                    <td>
                                        ${valueOfElement['pariente']}
                                    </td>

                                    <td>
                                        <div class=" ${!is_null(valueOfElement['imgDocIdentidad_pariente']) ? 'd-none':'d-block' }">
                                            ${valueOfElement['cedula_pariente']}
                                        </div>
                                        <a
                                            href="${is_null(valueOfElement['imgDocIdentidad_pariente']) ? '#':valueOfElement['imgDocIdentidad_pariente'] }"
                                            class="mt-1 btn btn-default btn-block text-nowrap ${is_null(valueOfElement['imgDocIdentidad_pariente']) ? 'd-none':'d-block' }"
                                            target="_blank"
                                        >
                                            <i class="fas fa-paperclip text-info"></i> ${valueOfElement['cedula_pariente']}
                                        </a>
                                        <a
                                            href="${valueOfElement['partidaNacimiento_pariente']}"
                                            class="mt-1 btn btn-default btn-block text-nowrap ${is_null(valueOfElement['partidaNacimiento_pariente']) ? 'd-none' : ''}"
                                            target="_blank"
                                        >
                                            <i class="fas fa-paperclip text-info"></i> Ver Partida de Nacimiento
                                        </a>
                                    </td>

                                    <td class="text-right">
                                        <button
                                            class="btn btn-outline-info btn-revisado"
                                            selected="${valueOfElement['revisado']==1 ? true:false}"
                                            data-user_family_id="${valueOfElement['id']}"
                                        >Aprobación</button>
                                    </td>


                                    <!--<td >



                                    </td>-->

                                </tr>
                            `);
                        })

                    }else{
                        throw new Error(model);
                    }
                    $('#index_table_familiar').DataTable( {
                        "order": [[ 1, "asc" ]],
                        "language": traduccionDataTablesEsp
                    });

            } catch (error) {
                //console.log("error",error)
                message = { 'title': 'Error', 'message': 'Ha ocurrido un error', 'image': 'error' };
                Toast.fire({
                    icon: message['imagen'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => console.log(error), 110);
                    }
                })
            }
    }
let saveDataForm = (e)=>{
    if (e.target?.matches("input") || e.target?.matches("textarea") || e.target?.matches("select") ) {
        if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
            //console.log(e.target.name)
            useState['formCreatePaciente'][e.target.name] = e.target.value

            if ("telefono_movil" === e.target.name) {
                useState['formCreatePaciente'][e.target.name] = iti.getNumber(intlTelInputUtils.numberFormat.E164);
            }
        }
    }

    if (e.target?.matches(".select2") ) {
        if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
            useState['formCreatePaciente'][e.target.name] = e.target.options[e.target.selectedIndex].value
        }

    }
    if (["cita_dia","cita_hora"].includes(e.name)) {
        useState['formCreatePaciente'][e.name] = e.value
    }
    //console.log(useState['formCreatePaciente'])

}
let create_fields_validation = async ()=>{

    let input = d.querySelector(`${useState['tab']} input[name='cedula']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='email']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='nombres']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='apellidos']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='fnacimiento']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='telefono_movil']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} select[name='cat_estado_id']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} select[name='cat_municipio_id']`)

        if (is_empty( input.value )) {
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
        input = d.querySelector(`${useState['tab']} input[name='description']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='domicilio']`)
        if (is_empty( input.value )) {

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
export let updateCitas = async () => {
    d.querySelector(".overlay").classList.remove("d-none")
    // let resulset = await get(`/user/medico/home/citas/update`)
    let resulset = await get(`/consultaexterna/user/medico/home/citas/update`)
        useState["medicos"] = resulset.medicos
        useState["medicos_agenda"] = resulset.medicos_agenda
        useState["centro_salud"] = resulset.centro_salud
        useState["users"] = resulset.users
        useState["pacientes"] = resulset.pacientes
        useState["citas"] = resulset.citas
        useState["tarjetasoychacao"] = resulset.tarjetasoychacao
        useState["user_condicion_medica"] = resulset.user_condicion_medica
        useState["user_medicamento"] = resulset.user_medicamento
        useState["user_antecedente"] = resulset.user_antecedente
        useState["user_alergias"] = resulset.user_alergias
        useState["medico"] = resulset.medico
        await updateTotales()
        d.querySelector(".overlay").classList.add("d-none")
}
let updateCitasOne = async (user_id) => {
    let resulset = await get(`/consultaexterna/user/medico/home/citas/update/one/${user_id}`)
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



}
export let create = async ( ) => {
    init()
    ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)
    //let $App= $qs(`${useState['tab']} #App`)
    let $form = clone( "artefacto_0029" )
        $App.innerHTML=null
        $App.append( $form )
        $App.querySelector("h3").classList.add("d-none")
        //$App.querySelector("h3").textContent="Nuevo Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Nuevo Paciente"

        if (!is_null(localStorage.getItem('component_cita_cedula'))) {
            let cedula = localStorage.getItem('component_cita_cedula')
            d.querySelector(`${useState['tab']} input[name='cedula']`).value = cedula.replace(/\./g, '')
            localStorage.removeItem('component_cita_cedula');
        }

        useState['cat_estado']       = await CatUserEstado_index()
        useState['cat_municipio']    = await CatUserMunicipio_index()
        useState['formCreatePaciente']['password']="123456"
        useState['formCreatePaciente']['password_repeat']="123456"
        telefonoConfig("#telefono_movil")

        entById("cat_estado_id").innerHTML= selectOptions(useState['cat_estado'], 14)
        entById("cat_municipio_id").innerHTML= selectOptions( useState['cat_municipio'].filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        entById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log('respuesta 1 --> ',existeModel);
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        entById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
           store(e)

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = useState['cat_municipio'].filter(x=>equalsInt(x.cat_estado_id,e.params.data.id ))
            entById("cat_municipio_id").innerHTML=null
            entById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()

}
export let updatePassword = async ( ) => {
    //let $App= $qs(`${useState['tab']} #tab_app`)
    ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)
    let $form = clone( "artefacto_0059" )
        $App.innerHTML=null
        $App.append( $form )

    let $submit =$App.querySelector(`#submit`)
        $submit.addEventListener("click",()=>{
            Swal.fire({
                title: '¿Deseas restablecer esta contraseña?',
                text: "Al restablecer la contraseña, la misma volverá a ser: 123456",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, Restablecer!'
            }).then(async (result) => {

                if (result.isConfirmed) {

                    let input = $App.querySelector(`input[name='cedula']`)
                        if (is_empty( input.value )) {

                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Una cédula válida es requerida.",
                                didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                }
                            })
                            return false
                        }
                        $App.querySelector(".overlay").classList.remove("d-none")
                    let $model = await get(location.origin+`/consultaexterna/user/login/resetPassword/AtencionPaciente/${input.value}`)
                        $App.querySelector(".overlay").classList.add("d-none")
                        input.value = "";
                        if ($model === "cedula_no_encontrada") {
                            Swal.fire(
                                'Error!',
                                'Esta cédula no se encontró en el sistema.',
                                'error'
                            )
                            return false
                        }else{
                            Swal.fire(
                                'Contraseña restablecida exitosamente!',
                                'Ahora el usuario puede usar su cédula y la contraseña 123456 para autenticarse en el sistema.',
                                'success'
                            )
                        }



                }
            })
        })
}
export let update = async (e) => {
    e.preventDefault()
    if (await create_fields_validation()) {
        //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
        d.querySelector(`${useState['tab']} .overlay`).classList.remove("d-none")
        let formData = new FormData();

            for (const key in useState['formCreatePaciente']) {
                if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                    let element = useState['formCreatePaciente'][key];
                        formData.append(key,element)
                }
            }
        let file1 = document.getElementById(`userImage`).files[0];
        let file2 = document.getElementById(`imgDocIdentidad`).files[0];
        let file3 = document.getElementById(`imgSoyChacao`).files[0];
            formData.append("imagen", file1)
            formData.append("imgDocIdentidad", file2)
            formData.append("imgSoyChacao", file3)
            formData.append("created_at",timestamps() );
            formData.append("_token",d.querySelector("#_token").value)

        let $response = post("/consultaexterna/paciente/consultaExternaStore/update",formData)
            $response.then(response=>{
                if($response){
                    let cedula = d.querySelector(`${ useState['tab'] } input[name='cedula']`).value
                        get(`/consultaexterna/user/profile/show_by_cedula/${cedula.replace(/\./g, '')}`)
                        .then(response=>{
                            //console.log(response)
                            //console.log("useState['users'] antes->", useState['users'])

                            add_row("users",first( response), "last" )

                            //console.log("useState['users'] despues->", useState['users'])


                            d.querySelector(`${useState['tab']} .overlay`).classList.add("d-none")
                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro Actualizado!',
                                text: 'Los datos se han actualizado correctamente.',
                               // footer: '<a class="btn btn-success btn-block paciente_create_cita" href="#"><i class="pc-cita_por_confirmar paciente_create_cita"></i> Nueva Cita</a>',
                                /*  didClose: () => {
                                    d.querySelector(`${useState['tab']} .overlay`).classList.add("d-none")
                                    ComponentBuscador.index(useState['users'])
                                } ,  */
                                //cancelButtonColor: 'var(--info)',
                                //cancelButtonText: 'Si, registrarlo',
                                showDenyButton: true,
                                //showCancelButton: true,
                                confirmButtonText: 'Ok',
                                denyButtonText: `Crear Cita`,
                                denyButtonColor: 'var(--success)',
                            }).then(result=>{

                                if (result.isConfirmed) {

                                    ComponentBuscador.index(useState['users'])

                                    //d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")
                                }else if (result.isDenied) {
                                    ComponentMedicoHome.handle_paciente_create_cita()
                                }

                            })
                        })

                }
            })
    }
}
export let store = async (e) => {
    e.preventDefault()
    if (await create_fields_validation()) {
        //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
        d.querySelector(`${useState['tab']} .overlay`).classList.remove("d-none")
        let formData = new FormData();

            for (const key in useState['formCreatePaciente']) {
                if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                    let element = useState['formCreatePaciente'][key];
                        formData.append(key,element)
                }
            }
        let file1 = document.getElementById(`userImage`).files[0];
        let file2 = document.getElementById(`imgDocIdentidad`).files[0];
        let file3 = document.getElementById(`imgSoyChacao`).files[0];
            formData.append("imagen", file1)
            formData.append("imgDocIdentidad", file2)
            formData.append("imgSoyChacao", file3)
            formData.append("created_at",timestamps() );
            formData.append("_token",d.querySelector("#_token").value)

       let $response = post("/consultaexterna/paciente/consultaExternaStore/store",formData)
            $response.then(response=>{
                if($response){
                    let cedula = d.querySelector(`${ useState['tab'] } input[name='cedula']`).value
                        get(`/consultaexterna/user/profile/show_by_cedula/${cedula}`)
                        .then(response=>{
                            //console.log(response)
                            //console.log("useState['users'] antes->", useState['users'])

                            add_row("users",first( response), "last" )

                            //console.log("useState['users'] despues->", useState['users'])
                            localStorage.setItem("component_search_cedula", useState['formCreatePaciente']['cedula'])

                            d.querySelector(`${useState['tab']} .overlay`).classList.add("d-none")
                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro creado!',
                                text: 'El paciente se ha creado correctamente.',

                                showDenyButton: true,
                                //showCancelButton: true,
                                confirmButtonText: 'Ok',
                                denyButtonText: `Crear Cita`,
                                denyButtonColor: 'var(--success)',
                            }).then(result=>{

                                if (result.isConfirmed) {

                                    ComponentBuscador.index(useState['users'])

                                    //d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")
                                }else if (result.isDenied) {
                                    ComponentCita.create()
                                }

                            })
                        })

                }
            })
    }
}
export let show = async (item_id) => {

    }
export let edit = async ( e ) => {
    init()
    let user_id = e.target.dataset.user_id_paciente
    console.log("user_id",user_id)
    ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)
    //let $App= $qs(`${useState['tab']} #App`)
    let $form = clone( "artefacto_0029" )
    let paciente =first(  useState['users'].filter(x=> equalsInt(x.user_id, user_id) ) )
        useState['cat_estado']       = await CatUserEstado_index()
        useState['cat_municipio']    = await CatUserMunicipio_index()

        if ($('select').data('select2')) {
            $('select').select2('destroy');
        }

        $App.innerHTML=null
        $App.append( $form )
        $App.querySelector("h3").textContent="Editar Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Editar Paciente"

        console.log("paciente->",paciente)

        d.querySelector("#userImagePreview").src=paciente.imagen
        if (!is_null( paciente.imgDocIdentidad ) ) {
            d.querySelector("#imgDocIdentidadPreview").src=paciente.imgDocIdentidad
        }
        if (!is_null( paciente.imgSoyChacao ) ) {
            d.querySelector("#imgSoyChacaoPreview").src=paciente.imgSoyChacao
        }


        telefonoConfig("#telefono_movil")
        $App.querySelector(`#no_edit_cedula`).textContent= paciente.nacionalidad+paciente.cedula
        $App.querySelector(`#no_edit_email`).textContent= paciente.email
        $App.querySelector(`#no_edit_nombres`).textContent= paciente.nombres
        $App.querySelector(`#no_edit_apellidos`).textContent= paciente.apellidos
        $App.querySelector(`#no_edit_genero`).textContent= paciente.genero ==="f"? 'Femenino':'Masculino'

        $App.querySelector(`input[name='apellidos']`).style.display="none"
        $App.querySelector(`input[name='nombres']`).style.display="none"
        $App.querySelector(`input[name='cedula']`).style.display="none"
        $App.querySelector(`input[name='email']`).style.display="none"
        $App.querySelector(`#genero`).style.display="none"
        $App.querySelector(`#nacionalidad`).style.display="none"
        $App.querySelector(`#genero`).style.display="none"

        $App.querySelector(`#submit`).innerHTML="Actualizar"

        $App.querySelector(`input[name='cedula']`).value= paciente.cedula
        $App.querySelector(`input[name='email']`).value= paciente.email
        $App.querySelector(`input[name='nombres']`).value= paciente.nombres
        $App.querySelector(`input[name='apellidos']`).value= paciente.apellidos

        $App.querySelector(`select[name='genero']`).value= paciente.genero
        $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( paciente.fnacimiento )
        $App.querySelector(`input[name='telefono_movil']`).value=  paciente.telefono_movil
        $App.querySelector(`input[name='description']`).value= paciente.description
        $App.querySelector(`input[name='domicilio']`).value= paciente.domicilio

        $App.querySelector(`input[name='tarjeta_soy_chacao']`).value= !is_null(paciente.tarjeta_soy_chacao) ? paciente.tarjeta_soy_chacao :''



        entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, paciente.cat_estado_id)
        entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,paciente.cat_estado_id ) ), paciente.cat_municipio_id )

        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            console.log('validar si existe la cedula');
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log('respuesta 2 --> ',existeModel);
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        entById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            ComponentMedicoHome.enrutador("#tab_citas")
            ComponentMedicoHome.handle_tablaCitas(1)
        })

        $('#cat_estado_id').on('select2:select', async function (e) {
            let model = useState['cat_municipio'].filter(x=>equalsInt(x.cat_estado_id,e.params.data.id ))
                entById("cat_municipio_id").innerHTML=null
                import { $qs, add_row, clone, first, is_undefined, selectOptions, store_field, update_row } from '../../helpers/helpers.js'
import {index as CatUserEstado_index} from '../catalogs/cat_estado.js'
import {index as CatUserMunicipio_index} from '../catalogs/cat_municipio.js'
import * as ComponentMedico from '../medico/medico.js'
import * as ComponentMedicoHome from '../medico/medico_home.js'
import * as ComponentBuscador from '../medico/search.js'
import * as ComponentCita from '../cita/cita.js?version = 0.1'
import * as Componentpaciente from '../../component/paciente/paciente.js'
let d = document
export let editAdmin = async ( user_id_paciente ) => {

    let user_id = user_id_paciente
        console.log("user_id",user_id)

    let paciente = useState['users'].find(x => equalsInt(x.user_id,user_id) )
        console.log(paciente)
        if (is_undefined(paciente)) {
            let model = await get(`/consultaexterna/user/userCita/${user_id}`)
                console.log(model[0]);
                if (model.length > 0) {
                    useState['users'].push( first(model) )
                    paciente = first(model)
                }
        }


        //console.log(useState['users']);

        let $App= d.querySelector(`#App`)

        let $form = clone( "artefacto_0029" )
            useState['cat_estado']       = await CatUserEstado_index()
            useState['cat_municipio']    = await CatUserMunicipio_index()

            if ($('select').data('select2')) {
                $('select').select2('destroy');
            }

            $App.innerHTML=null
            $App.append( $form )

            $App.querySelector("h3").textContent="Editar Paciente"

            d.querySelector("#userImagePreview").src=paciente.imagen

            if (!is_null( paciente.imgDocIdentidad ) ) {
                d.querySelector("#imgDocIdentidadPreview").src=paciente.imgDocIdentidad
            }
            if (!is_null( paciente.imgSoyChacao ) ) {
                d.querySelector("#imgSoyChacaoPreview").src=paciente.imgSoyChacao
            }

            telefonoConfig("#telefono_movil")
            $App.querySelector(`#submit`).innerHTML="Actualizar"

            $App.querySelector(`input[name='tarjeta_soy_chacao']`).removeAttribute("readonly")

            $App.querySelector(`input[name='cedula']`).value= paciente.cedula
            $App.querySelector(`input[name='email']`).value= paciente.email
            $App.querySelector(`input[name='nombres']`).value= paciente.nombres
            $App.querySelector(`input[name='apellidos']`).value= paciente.apellidos

            $App.querySelector(`select[name='genero']`).value= paciente.genero
            $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( paciente.fnacimiento )
            $App.querySelector(`input[name='telefono_movil']`).value=  paciente.telefono_movil
            $App.querySelector(`input[name='description']`).value= paciente.description
            $App.querySelector(`input[name='domicilio']`).value= paciente.domicilio

            $App.querySelector(`input[name='tarjeta_soy_chacao']`).value= !is_null(paciente.tarjeta_soy_chacao) ? paciente.tarjeta_soy_chacao :''

            document.getElementById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, paciente.cat_estado_id)
            document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,paciente.cat_estado_id ) ), paciente.cat_municipio_id )

            document.getElementById("userImage").addEventListener("change",e=>{
                imagePreview(e,"userImagePreview")
            })
            document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
                imagePreview(e,"imgDocIdentidadPreview")
            })
            document.getElementById("imgSoyChacao").addEventListener("change",e=>{
                imagePreview(e,"imgSoyChacaoPreview")
            })
            //validar si existe la cedula
            document.getElementById("cedula").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("cedula",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
                console.log('respuesta 3 --> ',existeModel);
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                                didClose: () => {
                                    setTimeout(() => {
                                        e.target.value=""
                                        e.target.focus()
                                    } , 110);
                                }
                            })
                        return false
                    }else{
                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            })
            //validar si existe el correo
            document.getElementById("email").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("email",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/consultaexterna/user/emailExist",formData)
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                                didClose: () => {
                                    setTimeout(() => {
                                        e.target.value=""
                                        e.target.focus()
                                    } , 110);
                                }
                            })
                        return false
                    }else{
                        if ( !is_empty(e.target.value) ) {

                            ruta = "/consultaexterna/user/update_item"
                            //$key= false
                            let response = await store_field(
                                    e.target.name,
                                    e.target.value,
                                    user_id,
                                    ruta
                                )
                                if ( !is_null(response) ) {
                                    let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                    useState['users'][index][e.target.name] = response[e.target.name]

                                }
                            return false
                        }




                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            })
            d.querySelector("#submit").addEventListener("click", async function(e){
                e.preventDefault()
                Swal.fire({
                    icon: 'success',
                    title: 'Datos Actualizados',
                    text: 'Los cambios se realizaron correctamente.',
                })
                $('[data-widget="pushmenu"]').PushMenu('toggle')
                /* let $template = document.getElementById("artefacto_0053").content.cloneNode(true)
                let $App = d.querySelector("#App")
                    $App.innerHTML= null
                    $App.scrollTop = 0;
                    $App.append($template)
                    d.querySelector(".btn-paciente-search").addEventListener("click",function(){
                        search()
                    })
                    d.querySelector(`input[name='search_value']`).addEventListener("keydown", async function (e) {
                        if (e.code=== 'Enter' || e.code === 'NumpadEnter') {
                            search()
                        }
                    }) */
                //ComponentMedicoHome.enrutador("#tab_citas")
                //ComponentMedicoHome.handle_tablaCitas(1)
            })
            $('#cat_estado_id').on('select2:select', async function (e) {
                let model = useState['cat_municipio'].filter(x=>equalsInt(x.cat_estado_id,e.params.data.id ))
                    document.getElementById("cat_municipio_id").innerHTML=null
                    document.getElementById("cat_municipio_id").append($select(model))
                let response = await store_field(
                        e.target.name,
                        e.target.value,
                        user_id,
                        "/consultaexterna/user/direction/update_item"
                    )
                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                        useState['users'][index]['cat_estado_id'] =response.cat_estado_id
            });
            $('#cat_municipio_id').on('select2:select', async function (e) {
                let response = await store_field(
                    e.target.name,
                    e.target.value,
                    user_id,
                    "/consultaexterna/user/direction/update_item"
                )
                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                    useState['users'][index]['cat_municipio_id'] =response.cat_municipio_id
            });
            $('.select2').select2()

        let ruta = ""
            $App.addEventListener("change", async function(e){
                //console.log(e.target)
                let $key = true;
                //$App.querySelector(".overlay").classList.remove("d-none")


                if (
                    e.target.matches("select[name='nacionalidad']") ||
                    e.target.matches("input[name='cedula']") ||
                    e.target.matches("input[name='nombres']") ||
                    e.target.matches("input[name='apellidos']") ||
                    e.target.matches("select[name='genero']") ||
                    e.target.matches("input[name='fnacimiento']") ||
                    e.target.matches("input[name='telefono_movil']")
                    && $key

                ) {
                    if ( !is_empty(e.target.value) ) {

                        $App.querySelector(".overlay").classList.remove("d-none")
                        ruta = "/consultaexterna/user/profile/update_item"
                        $key= false
                        let response = await store_field(
                                e.target.name,
                                e.target.value,
                                user_id,
                                ruta
                            )
                            if ( !is_null(response) ) {
                                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                    switch (e.target.name) {
                                        case 'fnacimiento':
                                            useState['users'][index][e.target.name] = first(response)[e.target.name]
                                            useState['users'][index]["edad"] = first(response)["edad"]
                                        break;
                                        default:
                                            useState['users'][index][e.target.name] = first(response)[e.target.name]
                                        break;
                                    }
                                    //console.log(e.target.name,"->",first(response)[e.target.name] )
                                    //console.log("user->",useState['users'][index])
                                    $App.querySelector(".overlay").classList.add("d-none")
                            }else{
                                $App.querySelector(".overlay").classList.add("d-none")
                            }
                        return false
                    }

                }

                if (
                    e.target.matches("input[name='imagen']")
                    && $key
                ) {

                    $App.querySelector(".overlay").classList.remove("d-none")
                    ruta ="/consultaexterna/user/profile/update_item_file"
                    $key= false
                    let file = d.querySelector(`input[name='imagen']`).files[0];
                    let response = await store_field(
                            e.target.name,
                            file,
                            user_id,
                            ruta
                        )
                        if ( !is_null(response) ) {
                            let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                useState['users'][index][e.target.name] = response[e.target.name]

                                $App.querySelector(".overlay").classList.add("d-none")
                        }else{
                            $App.querySelector(".overlay").classList.add("d-none")
                        }
                    return false

                }
                if (
                    e.target.matches("input[name='description']") ||
                    e.target.matches("input[name='domicilio']")
                    && $key
                ) {

                    if ( !is_empty(e.target.value) ) {

                        $App.querySelector(".overlay").classList.remove("d-none")
                        ruta = "/consultaexterna/user/direction/update_item"
                        $key= false
                        let response = await store_field(
                                e.target.name,
                                e.target.value,
                                user_id,
                                ruta
                            )
                            if ( !is_null(response) ) {
                                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))

                                    useState['users'][index][e.target.name] = response[e.target.name]

                                    $App.querySelector(".overlay").classList.add("d-none")
                            }else{
                                $App.querySelector(".overlay").classList.add("d-none")
                            }
                        return false
                    }
                }
                if (
                    e.target.matches("input[name='imgSoyChacao']") ||
                    e.target.matches("input[name='imgDocIdentidad']")

                    && $key
                ) {
                    if ( !is_empty(e.target.value) ) {

                        $App.querySelector(".overlay").classList.remove("d-none")
                        ruta = `/consultaexterna/user/profile_images/update_item_file/${e.target.name}`
                        $key= false
                        let file = d.querySelector(`input[name='${e.target.name}']`).files[0];
                        let response = await store_field(
                                e.target.name,
                                file,
                                user_id,
                                ruta
                            )
                            if ( !is_null(response) ) {

                                let index = useState['users'].findIndex(x=> equalsInt(x.user_id, user_id))
                                    useState['users'][index][e.target.name] = response.value


                                    $App.querySelector(".overlay").classList.add("d-none")
                            }else{
                                $App.querySelector(".overlay").classList.add("d-none")
                            }
                        return false
                    }

                    $key= false
                    let file = d.querySelector(`input[name='${e.target.name}']`).files[0];
                    let response = await store_field(
                            e.target.name,
                            file,
                            user_id,
                            `/consultaexterna/user/profile_images/update_item_file/${e.target.name}`
                        )
                        if ( !is_null(response) ) {
                            //useState['paciente'][e.target.name] = response["value"]
                            //useState.get_card_paciente()
                            let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                                useState['users'][index][e.target.name]= response.value
                            // Object.assign( useState['users'][index],response )
                            $App.querySelector(`#${e.target.name}Preview`).src= "/"+useState['paciente'][e.target.name]
                            $App.querySelector(".overlay").classList.add("d-none")
                        }
                        //console.log( useState['paciente'] )
                        return false



                }
                if (
                    e.target.matches("input[name='tarjeta_soy_chacao']")
                    && $key
                ) {
                    if ( !is_empty(e.target.value) ) {
                        ruta = "/consultaexterna/user/paciente/tarjeta_soy_chacao/update_item"
                        $key= false
                    }
                }

                if ( !is_empty(e.target.value) ) {
                    let response = await store_field(
                            e.target.name,
                            e.target.value,
                            user_id,
                            ruta
                        )
                        if ( !is_null(response) ) {
                            //console.log( useState['users'] )
                            let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))
                            useState['users'][index]
                            Object.assign( useState['users'][index],response )
                            //console.log("index",index)
                            //console.log( useState['users'] )
                            //update_row({attr:"users",key:"user_id", value:user_id, "resultset":response})
                            //useState['paciente'][e.target.name] = response[e.target.name]
                            //useState.get_card_paciente()
                            //$App.querySelector(".overlay").classList.add("d-none")
                        }
                }
                let index = useState['users'].findIndex(x=> equalsInt(x.user_id,user_id))

                console.log( "useState['users']", useState['users'][index] )
            })

}
let list_row = (item)=>{
    console.log(item);
    let $row = document.getElementById("artefacto_0054").content.cloneNode(true)
        $row.querySelector("tr").classList.add(`row-cita-${item['user_id']}`)
        $row.querySelector(".btn-edit-paciente").addEventListener("click",function(){
            editAdmin(item['user_id'])
        })
        $row.querySelector(".btn-edit-paciente").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".btn-delete-paciente").addEventListener("click",function(){
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrá deshacer esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, ¡eliminar paciente!"
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                    title: "¡Paciente eliminado!",
                    text: "El paciente fue eliminado con éxito.",
                    icon: "success"
                  });
                }
              });
        })
        $row.querySelector(".btn-delete-paciente").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".btn-reset-pass-paciente").addEventListener("click", function(){

            Swal.fire({
                title: '¿Deseas restablecer esta contraseña?',
                text: "Al restablecer la contraseña, la misma volverá a ser: 123456",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, ¡Restablecer!'
              }).then(async (result) => {
                if (result.isConfirmed) {
                    let $model = await get(location.origin+`/consultaexterna/user/login/resetPassword/AtencionPaciente/${item['cedula']}`)

                    if ($model === "cedula_no_encontrada") {
                        Swal.fire(
                            '¡Error!',
                            'Esta cédula no se encontró en el sistema.',
                            'error'
                        )
                        return false
                    }else{
                        Swal.fire(
                            '¡Contraseña restablecida exitosamente!',
                            'Ahora el usuario puede usar su cédula y la contraseña 123456 para autenticarse en el sistema.',
                            'success'
                        )
                    }

                }
              });

        })
        $row.querySelector(".btn-reset-pass-paciente").dataset.user_id_paciente = item['user_id']


        $row.querySelector(".card-item-paciente-image").src = item['imagen']
        //$row.querySelector("small").textContent = "#" + item['user_cita_id']
        $row.querySelector(".card-item-paciente-fullname").textContent = item['paciente']
        $row.querySelector(".card-item-paciente-cedula").textContent = item['cedula']
        $row.querySelector(".card-item-paciente-edad").textContent = item['edad']
        $row.querySelector(".card-item-paciente-genero").textContent = item['genero'].toUpperCase()
        $row.querySelector(".card-item-total-citas").textContent = item['citas_completadas']
        let color =""
        let paciente = item
        if ( paciente['exonerado'] > 0) {

                if (
                    paciente['exonerado'] == 25
                ) {
                    color = "info"
                }
                if (
                    paciente['exonerado'] ==50
                ) {
                    color = "primary"
                }
                if (
                    paciente['exonerado'] ==75
                ) {
                    color = "warning"
                }
                if (
                    paciente['exonerado'] ==100
                ) {
                    color = "success"
                }
            let bgColor =  "bg-"+color


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


        //exonerado
    let $button =$row.querySelector(".card-exonerado button")

        $button.id=`trigger${paciente['id']}`
        $button.classList.add("text-"+color)
        $button.textContent = `${paciente['exonerado']}%`
    let $dropdown =$row.querySelector(".card-exonerado .dropdown-menu")
        $dropdown.id=`option_exonerado_${paciente['id']}`
    let $options =$row.querySelectorAll(".card-exonerado .dropdown-menu a")
        $options.forEach(x=>{
            x.dataset['id']=paciente['id']
            if(x.dataset['exonerado'] == paciente['exonerado']){
                x.classList.add("active")
            }
        })
    let cat_user_type_id = paciente['roles'].split(",").map( z=>Number(z))
    let $roles =$row.querySelectorAll(".card-roles li")
        $roles.forEach(x=>{
            x.dataset['user_id']=paciente['user_id']
            x.querySelector("i").dataset['user_id']=paciente['user_id']
            x.dataset['active']=false
            x.querySelector("i").dataset['active']=false

            if(cat_user_type_id.includes(Number(x.dataset['cat_user_type_id']))){
                console.log(cat_user_type_id,Number(x.dataset['cat_user_type_id']))
                if (Number(x.dataset['cat_user_type_id']) == 1) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-success")
                }
                if (Number(x.dataset['cat_user_type_id']) == 2) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-primary")
                }
                if (Number(x.dataset['cat_user_type_id']) == 6) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-warning")
                }
                if (Number(x.dataset['cat_user_type_id']) == 7) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-orange")
                }
                if (Number(x.dataset['cat_user_type_id']) == 4) {
                    x.dataset['active']=true
                    x.querySelector("i").dataset['active']=true
                    x.querySelector("i").classList.add("text-secondary")
                }
            }
        })
        /*$row.querySelector(".buscador_nueva_cita").dataset.cedula = item['cedula']
        $row.querySelector(".buscador_nueva_cita").dataset.user_id_paciente = item['user_id']

         $row.querySelector(".paciente-edit").dataset.cedula = item['cedula']
        $row.querySelector(".paciente-edit").dataset.user_id_paciente = item['user_id']
        $row.querySelector(".paciente-edit i").dataset.cedula = item['cedula']
        $row.querySelector(".paciente-edit i").dataset.user_id_paciente = item['user_id']

        $row.querySelector(".paciente-historial-citas").dataset.user_id_paciente = item['user_id']
        $row.querySelector(".paciente-historial-citas i").dataset.user_id_paciente = item['user_id'] */

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
    let search_value = $App.querySelector(`input[name='search_value']`)


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
            `, 5)

            //console.log( useState['search_resultset'])
            let er = new RegExp( search_value.value , "i" )
            let resulset =""
                    useState['pacientes'] = await get(`/consultaexterna/user/profile/searchUser/${search_value.value}`)

                resulset = useState['pacientes'].filter(x => {

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

                if (resulset.length > 0) {
                        $tbody.innerHTML = null
                    let $rowList = await list(resulset)
                        $tbody.append($rowList)

                }else {
                    $tbody.innerHTML = emptyItem("Sin resultados", 6)
                }

        }else{
            $tbody.innerHTML = emptyItem("Sin resultados", 6)
        }
}
export let index_admin = async (item_id) => {
    $('[data-widget="pushmenu"]').PushMenu('toggle')
    let $template = document.getElementById("artefacto_0053").content.cloneNode(true)
    let $App = d.querySelector("#App")
        $App.innerHTML= null
        $App.scrollTop = 0;
        $App.append($template)
        d.querySelector(".btn-paciente-search").addEventListener("click",function(){
            search()
        })
        d.querySelector(`input[name='search_value']`).addEventListener("keydown", async function (e) {
            if (e.code=== 'Enter' || e.code === 'NumpadEnter') {
                search()
            }
        })
}
export let motivo_exoneracion_store = async (e) => {
    let id = e.target.dataset['id']
    let value = e.target.value
    let formData = new FormData();
        formData.append("field","motivo_exonerado")
        formData.append("value",value)
        formData.append("_token",d.querySelector("#_token").value)

    let model = await  post( location.origin+"/consultaexterna/user/profile/update_field/"+id,formData )
    e.target.classList.add("is-valid")


}
export let exonerado_update = async (id,exonerado) => {
    let formData = new FormData();
        formData.append("field","exonerado")
        formData.append("value",exonerado)
        formData.append("_token",d.querySelector("#_token").value)

    let model = await  post( location.origin+"/consultaexterna/user/profile/update_field/"+id,formData )
    d.querySelector(`#trigger${id}`).textContent=`${exonerado}%`
    d.querySelector(`#trigger${id}`).classList.remove("text-info","text-warning","text-orange","text-success")
    let color =""
    if (
        exonerado == 25
    ) {
        color = "info"
    }
    if (
        exonerado ==50
    ) {
        color = "primary"
    }
    if (
        exonerado ==75
    ) {
        color = "warning"
    }
    if (
        exonerado ==100
    ) {
        color = "success"
    }
    color =  "text-"+color
    d.querySelector(`#trigger${id}`).classList.add(color)
    let $options = d.querySelectorAll(`#option_exonerado_${id} a`)
        //console.log($options)
        $options.forEach(x=>{
            x.classList.remove("active")
            if (
                exonerado == x.dataset['exonerado']
            ) {
                x.classList.add("active")
            }


        })
        Swal.fire({
            icon: 'success',
            title: 'Exoneración actualizada',
            text: 'Los cambios se realizaron correctamente.',
        })
}

export let index_exonerado = async (item_id) => {
    $('[data-widget="pushmenu"]').PushMenu('toggle')
        let $template = document.getElementById("artefacto_0055").content.cloneNode(true)
        let $App = d.querySelector("#App")
            $App.innerHTML= null
            $App.scrollTop = 0;
            $App.append($template)
            try {
                let model = await get(location.origin+"/consultaexterna/user/profile/exonerado");
                    //useState['exonerados'] = model

                    if (Object.keys(model).length > 0) {
                        $("#index_table_medicos tbody").empty();
                        model.map(valueOfElement=>{
                            let color =""
                            let active = "";

                            if (
                                valueOfElement['exonerado'] == 25
                            ) {
                                color = "info"
                            }
                            if (
                                valueOfElement['exonerado'] ==50
                            ) {
                                color = "primary"
                            }
                            if (
                                valueOfElement['exonerado'] ==75
                            ) {
                                color = "warning"
                            }
                            if (
                                valueOfElement['exonerado'] ==100
                            ) {
                                color = "success"
                            }
                            color =  "text-"+color

                            $("#index_table_medicos tbody").append(`
                                <tr id="row_${valueOfElement['user_id']}">
                                    <td>
                                        <img id="image-perfil" onerror="reemplaza_imagen(this)" src="${valueOfElement['imagen']}" style="width: 1.5cm;height:1.5cm" class="image-perfil rounded-circle mx-auto d-block" alt="Medic default">
                                    </td>
                                    <td>
                                        ${valueOfElement['paciente']}
                                    </td>
                                    <td class="text-center">
                                        ${valueOfElement['genero']}
                                    </td>
                                    <td class="text-right">
                                        ${valueOfElement['cedula']}
                                    </td>
                                    <td>
                                        ${is_null(valueOfElement['telefono_movil'])?'':valueOfElement['telefono_movil']}
                                    </td>
                                    <td>
                                        <div>
                                        ${valueOfElement['email']}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn ${color} btn-default border-0 btn-block dropdown-toggle" type="button" id="trigger${valueOfElement['id']}" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    ${valueOfElement['exonerado']}%
                                            </button>
                                            <div id="option_exonerado_${valueOfElement['id']}" class="dropdown-menu" aria-labelledby="trigger${valueOfElement['id']}">
                                                <a data-exonerado="0" data-id="${valueOfElement['id']}"     class="${valueOfElement['exonerado'] == 0?'active':'' } btn-exonerado-update dropdown-item" href="#">0%</a>
                                                <a data-exonerado="25" data-id="${valueOfElement['id']}"    class="${valueOfElement['exonerado'] == 25?'active':'' } btn-exonerado-update dropdown-item" href="#">25%</a>
                                                <a data-exonerado="50" data-id="${valueOfElement['id']}"    class="${valueOfElement['exonerado'] == 50?'active':'' } btn-exonerado-update dropdown-item" href="#">50%</a>
                                                <a data-exonerado="75" data-id="${valueOfElement['id']}"    class="${valueOfElement['exonerado'] == 75?'active':'' } btn-exonerado-update dropdown-item" href="#">75%</a>
                                                <a data-exonerado="100" data-id="${valueOfElement['id']}"   class="${valueOfElement['exonerado'] == 100?'active':'' } btn-exonerado-update dropdown-item" href="#">100%</a>
                                            </div>
                                        </div>

                                    </td>



                                    <td >

                                        <textarea class="form-control motivo_exoneracion" name="motivo_exoneracion_${valueOfElement['id']}" data-id="${valueOfElement['id']}"  rows="1">${!is_null(valueOfElement['motivo_exonerado']) ? valueOfElement['motivo_exonerado']:''}</textarea>

                                    </td>
                                    <td nowrap>
                                    </td>
                                </tr>
                            `);
                        })

                    }else{
                        throw new Error(model);
                    }
                    $('#index_table_medicos').DataTable( {
                        "order": [[ 1, "asc" ]]
                    });

            } catch (error) {
                //console.log("error",error)
                message = { 'title': 'Error', 'message': 'Ha ocurrido un error', 'image': 'error' };
                Toast.fire({
                    icon: message['imagen'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => console.log(error), 110);
                    }
                })
            }
    }
let pariente_revisado = (id,value)=>{
alert(value)
    }
export let index_familiar = async (item_id) => {

    $('[data-widget="pushmenu"]').PushMenu('toggle')
        let $template = document.getElementById("artefacto_0058").content.cloneNode(true)
        let $App = d.querySelector("#App")
            $App.innerHTML= null
            $App.scrollTop = 0;
            $App.append($template)
            try {
                let model = await get(location.origin+"/consultaexterna/user/familiar/por_revisar");

                    if (Object.keys(model).length > 0) {
                        $("#index_table_familiar tbody").empty();
                        model.map(valueOfElement=>{
                            let color_parentesco = "";
                                if (valueOfElement['cat_user_family_id'] == 5) {
                                    color_parentesco = "text-info"
                                }
                                if (valueOfElement['cat_user_family_id'] == 6) {
                                    color_parentesco = "text-orange"
                                }
                                if (valueOfElement['cat_user_family_id'] == 7) {
                                    color_parentesco = "text-primary"
                                }
                                if (valueOfElement['cat_user_family_id'] == 3) {
                                    color_parentesco = "text-success"
                                }
                            $("#index_table_familiar tbody").append( /*html */`
                                <tr id="row_${valueOfElement['id']}">
                                    <td>
                                        ${valueOfElement['paciente']}
                                    </td>
                                    <td>
                                        <div class="${!is_null(valueOfElement['imgDocIdentidad_paciente']) ? 'd-none' : ''}">
                                            ${valueOfElement['cedula_paciente']}
                                        </div>

                                        <a
                                            href="${valueOfElement['imgDocIdentidad_paciente']}"
                                            class="mt-1 btn btn-default btn-block text-nowrap ${is_null(valueOfElement['imgDocIdentidad_paciente']) ? 'd-none' : ''}"
                                            target="_blank"
                                        >
                                            <i class="fas fa-paperclip text-info"></i> ${valueOfElement['cedula_paciente']}
                                        </a>
                                    </td>
                                    <td class="text-center ${color_parentesco}">
                                        ${valueOfElement['cat_user_family_description']}
                                    </td>
                                    <td>
                                        ${valueOfElement['pariente']}
                                    </td>

                                    <td>
                                        <div class=" ${!is_null(valueOfElement['imgDocIdentidad_pariente']) ? 'd-none':'d-block' }">
                                            ${valueOfElement['cedula_pariente']}
                                        </div>
                                        <a
                                            href="${is_null(valueOfElement['imgDocIdentidad_pariente']) ? '#':valueOfElement['imgDocIdentidad_pariente'] }"
                                            class="mt-1 btn btn-default btn-block text-nowrap ${is_null(valueOfElement['imgDocIdentidad_pariente']) ? 'd-none':'d-block' }"
                                            target="_blank"
                                        >
                                            <i class="fas fa-paperclip text-info"></i> ${valueOfElement['cedula_pariente']}
                                        </a>
                                        <a
                                            href="${valueOfElement['partidaNacimiento_pariente']}"
                                            class="mt-1 btn btn-default btn-block text-nowrap ${is_null(valueOfElement['partidaNacimiento_pariente']) ? 'd-none' : ''}"
                                            target="_blank"
                                        >
                                            <i class="fas fa-paperclip text-info"></i> Ver Partida de Nacimiento
                                        </a>
                                    </td>

                                    <td class="text-right">
                                        <button
                                            class="btn btn-outline-info btn-revisado"
                                            selected="${valueOfElement['revisado']==1 ? true:false}"
                                            data-user_family_id="${valueOfElement['id']}"
                                        >Aprobación</button>
                                    </td>


                                    <!--<td >



                                    </td>-->

                                </tr>
                            `);
                        })

                    }else{
                        throw new Error(model);
                    }
                    $('#index_table_familiar').DataTable( {
                        "order": [[ 1, "asc" ]],
                        "language": traduccionDataTablesEsp
                    });

            } catch (error) {
                //console.log("error",error)
                message = { 'title': 'Error', 'message': 'Ha ocurrido un error', 'image': 'error' };
                Toast.fire({
                    icon: message['imagen'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => console.log(error), 110);
                    }
                })
            }
    }
let saveDataForm = (e)=>{
    if (e.target?.matches("input") || e.target?.matches("textarea") || e.target?.matches("select") ) {
        if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
            //console.log(e.target.name)
            useState['formCreatePaciente'][e.target.name] = e.target.value

            if ("telefono_movil" === e.target.name) {
                useState['formCreatePaciente'][e.target.name] = iti.getNumber(intlTelInputUtils.numberFormat.E164);
            }
        }
    }

    if (e.target?.matches(".select2") ) {
        if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
            useState['formCreatePaciente'][e.target.name] = e.target.options[e.target.selectedIndex].value
        }

    }
    if (["cita_dia","cita_hora"].includes(e.name)) {
        useState['formCreatePaciente'][e.name] = e.value
    }
    //console.log(useState['formCreatePaciente'])

}
let create_fields_validation = async ()=>{

    let input = d.querySelector(`${useState['tab']} input[name='cedula']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='email']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='nombres']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='apellidos']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='fnacimiento']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='telefono_movil']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} select[name='cat_estado_id']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} select[name='cat_municipio_id']`)

        if (is_empty( input.value )) {
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
        input = d.querySelector(`${useState['tab']} input[name='description']`)
        if (is_empty( input.value )) {

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
        input = d.querySelector(`${useState['tab']} input[name='domicilio']`)
        if (is_empty( input.value )) {

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
export let updateCitas = async () => {
    d.querySelector(".overlay").classList.remove("d-none")
    // let resulset = await get(`/user/medico/home/citas/update`)
    let resulset = await get(`/consultaexterna/user/medico/home/citas/update`)
        useState["medicos"] = resulset.medicos
        useState["medicos_agenda"] = resulset.medicos_agenda
        useState["centro_salud"] = resulset.centro_salud
        useState["users"] = resulset.users
        useState["pacientes"] = resulset.pacientes
        useState["citas"] = resulset.citas
        useState["tarjetasoychacao"] = resulset.tarjetasoychacao
        useState["user_condicion_medica"] = resulset.user_condicion_medica
        useState["user_medicamento"] = resulset.user_medicamento
        useState["user_antecedente"] = resulset.user_antecedente
        useState["user_alergias"] = resulset.user_alergias
        useState["medico"] = resulset.medico
        await updateTotales()
        d.querySelector(".overlay").classList.add("d-none")
}
let updateCitasOne = async (user_id) => {
    let resulset = await get(`/consultaexterna/user/medico/home/citas/update/one/${user_id}`)
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



}
export let create = async ( ) => {
    init()
    ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)
    //let $App= $qs(`${useState['tab']} #App`)
    let $form = clone( "artefacto_0029" )
        $App.innerHTML=null
        $App.append( $form )
        $App.querySelector("h3").classList.add("d-none")
        //$App.querySelector("h3").textContent="Nuevo Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Nuevo Paciente"

        if (!is_null(localStorage.getItem('component_cita_cedula'))) {
            let cedula = localStorage.getItem('component_cita_cedula')
            d.querySelector(`${useState['tab']} input[name='cedula']`).value = cedula.replace(/\./g, '')
            localStorage.removeItem('component_cita_cedula');
        }

        useState['cat_estado']       = await CatUserEstado_index()
        useState['cat_municipio']    = await CatUserMunicipio_index()
        useState['formCreatePaciente']['password']="123456"
        useState['formCreatePaciente']['password_repeat']="123456"
        telefonoConfig("#telefono_movil")

        document.getElementById("cat_estado_id").innerHTML= selectOptions(useState['cat_estado'], 14)
        document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState['cat_municipio'].filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        document.getElementById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        document.getElementById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        document.getElementById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        document.getElementById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log('respuesta 1 --> ',existeModel);
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        document.getElementById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
           store(e)

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = useState['cat_municipio'].filter(x=>equalsInt(x.cat_estado_id,e.params.data.id ))
            document.getElementById("cat_municipio_id").innerHTML=null
            document.getElementById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()

}
export let updatePassword = async ( ) => {
    //let $App= $qs(`${useState['tab']} #tab_app`)
    ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)
    let $form = clone( "artefacto_0059" )
        $App.innerHTML=null
        $App.append( $form )

    let $submit =$App.querySelector(`#submit`)
        $submit.addEventListener("click",()=>{
            Swal.fire({
                title: '¿Deseas restablecer esta contraseña?',
                text: "Al restablecer la contraseña, la misma volverá a ser: 123456",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2FA600',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Aún no!',
                confirmButtonText: 'Si, Restablecer!'
            }).then(async (result) => {

                if (result.isConfirmed) {

                    let input = $App.querySelector(`input[name='cedula']`)
                        if (is_empty( input.value )) {

                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Una cédula válida es requerida.",
                                didClose: () => {
                                    setTimeout(() => input.focus() , 110);
                                }
                            })
                            return false
                        }
                        $App.querySelector(".overlay").classList.remove("d-none")
                    let $model = await get(location.origin+`/consultaexterna/user/login/resetPassword/AtencionPaciente/${input.value}`)
                        $App.querySelector(".overlay").classList.add("d-none")
                        input.value = "";
                        if ($model === "cedula_no_encontrada") {
                            Swal.fire(
                                'Error!',
                                'Esta cédula no se encontró en el sistema.',
                                'error'
                            )
                            return false
                        }else{
                            Swal.fire(
                                'Contraseña restablecida exitosamente!',
                                'Ahora el usuario puede usar su cédula y la contraseña 123456 para autenticarse en el sistema.',
                                'success'
                            )
                        }



                }
            })
        })
}
export let update = async (e) => {
    e.preventDefault()
    if (await create_fields_validation()) {
        //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
        d.querySelector(`${useState['tab']} .overlay`).classList.remove("d-none")
        let formData = new FormData();

            for (const key in useState['formCreatePaciente']) {
                if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                    let element = useState['formCreatePaciente'][key];
                        formData.append(key,element)
                }
            }
        let file1 = document.getElementById(`userImage`).files[0];
        let file2 = document.getElementById(`imgDocIdentidad`).files[0];
        let file3 = document.getElementById(`imgSoyChacao`).files[0];
            formData.append("imagen", file1)
            formData.append("imgDocIdentidad", file2)
            formData.append("imgSoyChacao", file3)
            formData.append("created_at",timestamps() );
            formData.append("_token",d.querySelector("#_token").value)

        let $response = post("/consultaexterna/paciente/consultaExternaStore/update",formData)
            $response.then(response=>{
                if($response){
                    let cedula = d.querySelector(`${ useState['tab'] } input[name='cedula']`).value
                        get(`/consultaexterna/user/profile/show_by_cedula/${cedula.replace(/\./g, '')}`)
                        .then(response=>{
                            //console.log(response)
                            //console.log("useState['users'] antes->", useState['users'])

                            add_row("users",first( response), "last" )

                            //console.log("useState['users'] despues->", useState['users'])


                            d.querySelector(`${useState['tab']} .overlay`).classList.add("d-none")
                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro Actualizado!',
                                text: 'Los datos se han actualizado correctamente.',
                               // footer: '<a class="btn btn-success btn-block paciente_create_cita" href="#"><i class="pc-cita_por_confirmar paciente_create_cita"></i> Nueva Cita</a>',
                                /*  didClose: () => {
                                    d.querySelector(`${useState['tab']} .overlay`).classList.add("d-none")
                                    ComponentBuscador.index(useState['users'])
                                } ,  */
                                //cancelButtonColor: 'var(--info)',
                                //cancelButtonText: 'Si, registrarlo',
                                showDenyButton: true,
                                //showCancelButton: true,
                                confirmButtonText: 'Ok',
                                denyButtonText: `Crear Cita`,
                                denyButtonColor: 'var(--success)',
                            }).then(result=>{

                                if (result.isConfirmed) {

                                    ComponentBuscador.index(useState['users'])

                                    //d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")
                                }else if (result.isDenied) {
                                    ComponentMedicoHome.handle_paciente_create_cita()
                                }

                            })
                        })

                }
            })
    }
}
export let store = async (e) => {
    e.preventDefault()
    if (await create_fields_validation()) {
        //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
        d.querySelector(`${useState['tab']} .overlay`).classList.remove("d-none")
        let formData = new FormData();

            for (const key in useState['formCreatePaciente']) {
                if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                    let element = useState['formCreatePaciente'][key];
                        formData.append(key,element)
                }
            }
        let file1 = document.getElementById(`userImage`).files[0];
        let file2 = document.getElementById(`imgDocIdentidad`).files[0];
        let file3 = document.getElementById(`imgSoyChacao`).files[0];
            formData.append("imagen", file1)
            formData.append("imgDocIdentidad", file2)
            formData.append("imgSoyChacao", file3)
            formData.append("created_at",timestamps() );
            formData.append("_token",d.querySelector("#_token").value)

       let $response = post("/consultaexterna/paciente/consultaExternaStore/store",formData)
            $response.then(response=>{
                if($response){
                    let cedula = d.querySelector(`${ useState['tab'] } input[name='cedula']`).value
                        get(`/consultaexterna/user/profile/show_by_cedula/${cedula}`)
                        .then(response=>{
                            //console.log(response)
                            //console.log("useState['users'] antes->", useState['users'])

                            add_row("users",first( response), "last" )

                            //console.log("useState['users'] despues->", useState['users'])
                            localStorage.setItem("component_search_cedula", useState['formCreatePaciente']['cedula'])

                            d.querySelector(`${useState['tab']} .overlay`).classList.add("d-none")
                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro creado!',
                                text: 'El paciente se ha creado correctamente.',

                                showDenyButton: true,
                                //showCancelButton: true,
                                confirmButtonText: 'Ok',
                                denyButtonText: `Crear Cita`,
                                denyButtonColor: 'var(--success)',
                            }).then(result=>{

                                if (result.isConfirmed) {

                                    ComponentBuscador.index(useState['users'])

                                    //d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")
                                }else if (result.isDenied) {
                                    ComponentCita.create()
                                }

                            })
                        })

                }
            })
    }
}
export let show = async (item_id) => {

    }
export let edit = async ( e ) => {
    init()
    let user_id = e.target.dataset.user_id_paciente
    console.log("user_id",user_id)
    ComponentMedicoHome.enrutador("#tab_app")
    let $App= d.querySelector(`#tab_app`)
    //let $App= $qs(`${useState['tab']} #App`)
    let $form = clone( "artefacto_0029" )
    let paciente =first(  useState['users'].filter(x=> equalsInt(x.user_id, user_id) ) )
        useState['cat_estado']       = await CatUserEstado_index()
        useState['cat_municipio']    = await CatUserMunicipio_index()

        if ($('select').data('select2')) {
            $('select').select2('destroy');
        }

        $App.innerHTML=null
        $App.append( $form )
        $App.querySelector("h3").textContent="Editar Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Editar Paciente"

        console.log("paciente->",paciente)

        d.querySelector("#userImagePreview").src=paciente.imagen
        if (!is_null( paciente.imgDocIdentidad ) ) {
            d.querySelector("#imgDocIdentidadPreview").src=paciente.imgDocIdentidad
        }
        if (!is_null( paciente.imgSoyChacao ) ) {
            d.querySelector("#imgSoyChacaoPreview").src=paciente.imgSoyChacao
        }


        telefonoConfig("#telefono_movil")
        $App.querySelector(`#no_edit_cedula`).textContent= paciente.nacionalidad+paciente.cedula
        $App.querySelector(`#no_edit_email`).textContent= paciente.email
        $App.querySelector(`#no_edit_nombres`).textContent= paciente.nombres
        $App.querySelector(`#no_edit_apellidos`).textContent= paciente.apellidos
        $App.querySelector(`#no_edit_genero`).textContent= paciente.genero ==="f"? 'Femenino':'Masculino'

        $App.querySelector(`input[name='apellidos']`).style.display="none"
        $App.querySelector(`input[name='nombres']`).style.display="none"
        $App.querySelector(`input[name='cedula']`).style.display="none"
        $App.querySelector(`input[name='email']`).style.display="none"
        $App.querySelector(`#genero`).style.display="none"
        $App.querySelector(`#nacionalidad`).style.display="none"
        $App.querySelector(`#genero`).style.display="none"

        $App.querySelector(`#submit`).innerHTML="Actualizar"

        $App.querySelector(`input[name='cedula']`).value= paciente.cedula
        $App.querySelector(`input[name='email']`).value= paciente.email
        $App.querySelector(`input[name='nombres']`).value= paciente.nombres
        $App.querySelector(`input[name='apellidos']`).value= paciente.apellidos

        $App.querySelector(`select[name='genero']`).value= paciente.genero
        $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( paciente.fnacimiento )
        $App.querySelector(`input[name='telefono_movil']`).value=  paciente.telefono_movil
        $App.querySelector(`input[name='description']`).value= paciente.description
        $App.querySelector(`input[name='domicilio']`).value= paciente.domicilio

        $App.querySelector(`input[name='tarjeta_soy_chacao']`).value= !is_null(paciente.tarjeta_soy_chacao) ? paciente.tarjeta_soy_chacao :''



        document.getElementById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, paciente.cat_estado_id)
        document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,paciente.cat_estado_id ) ), paciente.cat_municipio_id )

        document.getElementById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        document.getElementById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        document.getElementById("cedula").addEventListener("change", async e=>{
            console.log('validar si existe la cedula');
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log('respuesta 2 --> ',existeModel);
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        document.getElementById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            ComponentMedicoHome.enrutador("#tab_citas")
            ComponentMedicoHome.handle_tablaCitas(1)
        })

        $('#cat_estado_id').on('select2:select', async function (e) {
            let model = useState['cat_municipio'].filter(x=>equalsInt(x.cat_estado_id,e.params.data.id ))
                document.getElementById("cat_municipio_id").innerHTML=null
                document.getElem