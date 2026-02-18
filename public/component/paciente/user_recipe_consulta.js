import {alertMessage, first} from '../../helpers/helpers.js'
let d = document
export let count = 0


let reset_reset = ()=>{
        useState['formRecipes'].recipe_id=null
        useState['formRecipes'].value=""
        useState['formRecipes'].value2=""
        useState['formRecipes'].value3=""
        useState['formRecipes'].value4=""

        d.querySelector("input[name='value']").value=""
        d.querySelector("input[name='value2']").value=""
        d.querySelector("textarea[name='value3']").value=""
        d.querySelector("input[name='value4']").value=1

    }
let handleStore = async ()=>{
    let response = await store()
        if ( !is_null(response) ) {

                useState['formRecipes']['recipes'].push( response )
                let total_recipes = useState['formRecipes']['recipes'].length
                if (total_recipes > 0 ) {
                    d.querySelector(".acceso-archivos .handle_recipes span").classList.remove("badge-gray")
                    d.querySelector(".acceso-archivos .handle_recipes span").classList.add("badge-success")
                    d.querySelector(".acceso-archivos .handle_recipes span").textContent = total_recipes
                }
                message = alertMessage("send_success");
                Toast.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => {
                            reset_reset()
                            index()
                            $('#pills-page1-tab').tab('show')
                        }, 110);
                    }
                })
        }
}
let handleUpdate = async ()=>{
    alert('SI')
    let recipe_id = useState['formRecipes'].recipe_id
    let response = await update(recipe_id)
        if ( !is_null(response) ) {
           // let index_user_id = useState['formRecipes']['recipes'].findIndex( x => equalsInt( x.user_id,response.user_id ) )
            let index_recipe_id = useState['formRecipes']['recipes'].findIndex(x=> equalsInt( x.id , recipe_id ) )

                Object.assign(useState['formRecipes']['recipes'][ index_recipe_id ], response)


                message = alertMessage("update_success");
                Toast.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: "Medicamento actualizado correctamente",
                    didClose: () => {
                        setTimeout(() => {
                            reset_reset()
                            index()
                            $('#pills-page1-tab').tab('show')
                        }, 110);
                    }
                })
        }
}
let set_formLogin = (e)=>{
    useState['formRecipes'][e.target.name] = e.target.value
}
let formFields_validate = (response)=>{
    let {value,value2,value3} = useState['formRecipes']
        if (is_empty( value )) {
            let input = d.querySelector(`input[name='value']`)
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
        if (is_empty( value2 )) {
            let input = d.querySelector(`input[name='value2']`)
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
        if (is_empty( value3 )) {
            let input = d.querySelector(`textarea[name='value3']`)
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
let index = async ()=>{
    let response = await getAll()

    let user_id = useState['formRecipes'].user_id

    let $tbody =d.querySelector('#modelId .modal-body #pills-page1 table tbody')
        $tbody.innerHTML=null
        if ( response.length < 1 ) {
            $tbody.innerHTML=`
                <tr>
                    <td colspan="3" class="text-center text-primary">
                        Sin registros
                    </td>
                </tr>
            `
        }else{
            response.forEach(x=>{
                let $html = entById('artefacto_0011').content
                    $html = d.importNode($html,true)
                    $html.querySelector(".row-item_fecha").innerHTML=  fechaCortaAPPLE(x.created_at)
                    $html.querySelector(".row-item_medicamento").textContent= x.value
                    $html.querySelector(".row-item_presentacion").textContent= x.value2
                    $html.querySelector(".row-item_cantidad").textContent= is_null(x.value4) ? 1 : x.value4
                    $html.querySelector(".row-item_indicacion").textContent= x.value3
                    $html.querySelectorAll(".row-item_delete")[0].dataset.recipe_id= x.id
                    $html.querySelectorAll(".row-item_delete")[1].dataset.recipe_id= x.id
                    $html.querySelectorAll(".row-item_edit")[0].dataset.recipe_id= x.id
                    $html.querySelectorAll(".row-item_edit")[1].dataset.recipe_id= x.id
                    if (localStorage.getItem("cita_anterior") != null) {
                        if (localStorage.getItem("cita_anterior") === "true" ) {
                            $html.querySelectorAll('.row-item_edit').forEach(x=>x.classList.add("d-none"))
                            $html.querySelectorAll('.row-item_delete').forEach(x=>x.classList.add("d-none"))
                        }
                    }
                    $tbody.append( $html )
            })
        }

    }
let getAll = async ()=>{

            return await useState['formRecipes']['recipes']
    }

let store = async ()=>{
        let formData = new FormData();
            for (const key in useState['formRecipes']) {
                formData.append( key , useState['formRecipes'][key] )
            }
            formData.append("user_cita_id",useState['formRecipes'].user_cita_id )
            formData.append("created_at",timestamps() )
            formData.append("_token",entById('_token').value)
            return await post("/consultaexterna/user/paciente/recipe/store_cita",formData)
    }
let handleDestroy = async (recipe_id)=>{
        Toast.fire({
            icon:"warning",
            title: "Atención",
            text: "¿Desea eliminar este medicamento?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`
        }).then(async (result) => {
            if (result.isConfirmed) {
                let response = await destroy(recipe_id)

                if (response) {
                    let user_id = useState['formRecipes'].user_id
                    let index_id = useState['formRecipes']['recipes'].findIndex( x => equalsInt( x.user_id, user_id ) )
                    useState['formRecipes']['recipes'] = useState['formRecipes']['recipes'].filter( x=>{
                        if (parseInt(x.id) !== parseInt(recipe_id)) {
                            return x
                        }
                    })
                    let total_recipes = useState['formRecipes']['recipes'].length
                        if (total_recipes > 0 ) {
                            d.querySelector(".acceso-archivos .handle_recipes span").classList.remove("badge-gray")
                            d.querySelector(".acceso-archivos .handle_recipes span").classList.add("badge-success")
                            d.querySelector(".acceso-archivos .handle_recipes span").textContent = total_recipes
                        }else{
                            d.querySelector(".acceso-archivos .handle_recipes span").classList.add("badge-gray")
                            d.querySelector(".acceso-archivos .handle_recipes span").classList.remove("badge-success")
                            d.querySelector(".acceso-archivos .handle_recipes span").textContent = total_recipes
                        }
                    Swal.fire(
                        'Eliminado!',
                        'El medicamento ha sido eliminado del récipe',
                        'success'
                        )
                    index()
                }else{
                    Swal.fire(
                        'Ooops!',
                        'Error al eliminar',
                        'warning'
                        )
                }
            }
        })

    }
let destroy = async (recipe_id)=>{
    let formData = new FormData();

        formData.append("id",recipe_id)
        formData.append("_token",entById('_token').value)
        return await post("/consultaexterna/user/paciente/recipe/destroy/"+recipe_id,formData)

    }
let update = async (recipe_id)=>{
        let formData = new FormData();
            for (const key in useState['formRecipes']) {
                formData.append( key , useState['formRecipes'][key] )
            }
            formData.append("recipe_id",recipe_id)
            formData.append("_token",entById('_token').value)
            return await post("/consultaexterna/user/paciente/recipe/update/"+recipe_id ,formData)
    }
let print_pdf = (user_id,user_cita_id,print)=>{

    window.open(`/consultaexterna/pdf/recipe/cita/preview/${user_centro_salud_id}/${user_cita_id}/${user_id_medico}/${user_id}/${print}`)
    }
let compartir_ws = (user_id,print)=>{
    //let index_id = useState['formRecipes']['recipes'].findIndex( x => equalsInt( x.user_id, user_id ) )
    let paciente = first(useState['users'].filter( x => equalsInt( x.user_id, user_id ) ))
    let user_cita_id = useState['formRecipes'].user_cita_id
    //console.log(paciente)
    window.open(`https://wa.me/${paciente.telefono_movil}?text=Hola! ${medico_genero=="f"?"La ":"El "}${medico_fullname}, te ha enviado un récipe. Pulsa en el siguiente enlace para descargarlo: ${host_patientcare}/pdf/recipe/cita/preview/${user_centro_salud_id}/${user_cita_id}/${user_id_medico}/${user_id}/${print}`)
    }
let compartir_email = async (user_id,print)=>{
    let paciente = first(useState['users'].filter( x => equalsInt( x.user_id, user_id ) ))
    //let paciente = useState['users']
    let user_cita_id = useState['formRecipes'].user_cita_id
    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: `¿Desea enviar el récipe al correo ${paciente.email}?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`,
        didClose: async () => {
            let response = await get(`/consultaexterna/pdf/recipe/cita/email/${user_centro_salud_id}/${user_cita_id}/${user_id_medico}/${user_id}/${print}`)

            if (response) {


                Swal.fire(
                    'Enviado!',
                    `El Récipe ha sido enviado a ${paciente.email} exitosamente`,
                    'success'
                    )
            }else{
                Swal.fire(
                    'Ooops!',
                    'Error al enviar',
                    'warning'
                    )
            }

        }
    })




    ///window.open(`https://wa.me/${paciente.telefono_movil}?text=Hola! ${medico_genero=="f"?"La ":"El "}${medico_fullname}, quien está atendiendo tu consulta médica, te ha enviado un récipe. Pulsa en el siguiente enlace para descargarlo: ${host_patientcare}/pdf/recipe/ws/${user_centro_salud_id}/${episodio_id}/${user_id_medico}/${user_id}/color`)
    }
let handleEdit = (recipe_id)=>{
    useState['formRecipes'].recipe_id= recipe_id
    d.querySelector('#submit_store').classList.add("d-none")
    d.querySelector('#submit_update').classList.remove("d-none")
    $('#pills-page2-tab').tab('show')
    let user_id = useState['formRecipes'].user_id
    let model = first( useState['formRecipes']['recipes'].filter( x=> parseInt(x.id) === parseInt(recipe_id) ) )
        useState['formRecipes'].value= model.value
        useState['formRecipes'].value2= model.value2
        useState['formRecipes'].value3= model.value3
        useState['formRecipes'].value4= model.value4
        //useState['formRecipes'].created_at= model.created_at
    let $form = d.querySelector('#modelId .modal-body')

        $form.querySelector("input[name='value']").value=model.value
        $form.querySelector("input[name='value2']").value=model.value2
        $form.querySelector("textarea[name='value3']").value=model.value3
        $form.querySelector("input[name='value4']").value=model.value4
       // $form.querySelector("input[name='created_at']").value= fechaInputDate(model.created_at)


}

export let init = async (resulset,user_cita_id)=>{
    let index_cita = useState['citas'].findIndex(cita => equalsInt(cita.user_cita_id,user_cita_id ) )
    let {user_id_paciente,user_recipe} = useState['citas'][index_cita]
    let $modal = d.querySelector(`#modelId `)
        $modal.querySelector(".modal-dialog").classList.remove("modal-lg","modal-sm")
        $modal.querySelector(".modal-dialog").classList.add("modal-lg")
        $modal.querySelector(".modal-body").innerHTML = null
        $("#modelId").modal("show")

        useState['formRecipes']['user_id'] = user_id_paciente
        useState['formRecipes']['user_cita_id'] = user_cita_id
        useState['formRecipes']['recipes'] = user_recipe
        //useState['users'] = first( useState['pacientes'].filter(pac => equalsInt(pac.id, user_id_paciente ) ) )
        //console.log(useState['formRecipes'])
        let $html = entById('artefacto_0026').content
            $html = d.importNode($html,true)


            $html.querySelector('#regresar2').addEventListener("click", function(e){
                e.preventDefault()
                $('#pills-page1-tab').tab('show')
            })
            if (localStorage.getItem("cita_anterior") != null) {
                if (localStorage.getItem("cita_anterior") === "true" ) {
                    $html.querySelector('#item_create').classList.add("d-none")
                }
            }
            $html.querySelector('#item_create').addEventListener("click", function(e){
                d.querySelector('#submit_store').classList.remove("d-none")
                d.querySelector('#submit_update').classList.add("d-none")
                $('#pills-page2-tab').tab('show')
            })
            $html.querySelector('#submit_store').addEventListener("click",e=>{
                e.preventDefault()
                if ( formFields_validate() ) {

                    handleStore()
                }
            })
            $html.querySelector('#submit_update').addEventListener("click",e=>{
                e.preventDefault()
                if ( formFields_validate() ) {

                    handleUpdate()
                }
            })
            d.querySelector('#modelId .modal-body').innerHTML=null
            d.querySelector('#modelId .modal-body').append($html)


            d.querySelector('#modelId .modal-body #imprimir_recipe_color').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #imprimir_recipe_color').dataset.user_cita_id=user_cita_id

            d.querySelector('#modelId .modal-body #imprimir_recipe_bw').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #imprimir_recipe_bw').dataset.user_cita_id=user_cita_id

            d.querySelector('#modelId .modal-body #whatsapp_recipe_color').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #whatsapp_recipe_bw').dataset.user_id=user_id_paciente

            d.querySelector('#modelId .modal-body #email_recipe_color').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #email_recipe_bw').dataset.user_id=user_id_paciente


            d.querySelector('#modelId .modal-body form').addEventListener("change",e=>{
                set_formLogin(e)
            })



            d.querySelector('#modelId .modal-body').addEventListener("click",e=>{
                //console.log(e.target)
                if (e.target.matches(".row-item_delete") ) {
                    handleDestroy(e.target.dataset.recipe_id)
                }
                if (e.target.matches(".row-item_edit") ) {
                    handleEdit(e.target.dataset.recipe_id)
                }
                if (e.target.matches("#imprimir_recipe_color") ) {

                        print_pdf(e.target.dataset.user_id,e.target.dataset.user_cita_id,"color")
                }
                if (e.target.matches("#imprimir_recipe_bw") ) {
                    let index_id = useState['formRecipes']['recipes'].findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let user_cita_id = useState['formRecipes']['recipes'][ index_id ].user_cita_id
                        print_pdf(e.target.dataset.user_id,user_cita_id,"bw")
                }
                if (e.target.matches("#whatsapp_recipe_color") ) {

                    compartir_ws(e.target.dataset.user_id,"color")
                }
                if (e.target.matches("#whatsapp_recipe_bw") ) {

                    compartir_ws(e.target.dataset.user_id,"bw")
                }
                if (e.target.matches("#email_recipe_color") ) {
                    e.preventDefault()
                    compartir_email(e.target.dataset.user_id,"color")
                }
                if (e.target.matches("#email_recipe_bw") ) {
                    e.preventDefault()
                    compartir_email(e.target.dataset.user_id,"bw")
                }
            })


            index()
    }
