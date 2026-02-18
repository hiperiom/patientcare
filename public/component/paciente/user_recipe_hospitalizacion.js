import {} from '../../helpers/helpers.js'
let d = document
let useState={
    "recipe_id":null,
    "user_id":"",
    "value":"",
    "value2":"",
    "value3":"",
    "value4":1,
}
let reset_reset = ()=>{
        useState.recipe_id=null
        useState.value=""
        useState.value2=""
        useState.value3=""
        useState.value4=""

        d.querySelector("input[name='value']").value=""
        d.querySelector("input[name='value2']").value=""
        d.querySelector("textarea[name='value3']").value=""
        d.querySelector("input[name='value4']").value=1

    }
let handleStore = async ()=>{
    let response = await store()
        if ( !is_null(response) ) {
            let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id,response.user_id ) )
                //console.log(index_id)
                pacientes_datos[ index_id ]['recipes'].push( response )

                message = Component.alertMessage("send_success");
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
    let recipe_id = useState.recipe_id
    let response = await update(recipe_id)
        if ( !is_null(response) ) {
            let index_user_id = pacientes_datos.findIndex( x => equalsInt( x.user_id,response.user_id ) )
            let index_recipe_id = pacientes_datos[ index_user_id ]['recipes'].findIndex(x=> equalsInt( x.id , recipe_id ) )

                Object.assign(pacientes_datos[ index_user_id ]['recipes'][ index_recipe_id ], response)


                message = Component.alertMessage("send_success");
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
    useState[e.target.name] = e.target.value
}
let formFields_validate = (response)=>{
    let {value,value2,value3} = useState
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
let index = ()=>{
    let response = getAll()
    let user_id = useState.user_id

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
                    $tbody.append( $html )
            })
        }

    }
let getAll = ()=>{
        let user_id = useState.user_id
        let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, user_id ) )
            return pacientes_datos[ index_id ]['recipes']
    }
let show = async ()=>{
        //pacientes_datos
    }
let store = async ()=>{
        let formData = new FormData();
            for (const key in useState) {
                formData.append( key , useState[key] )
            }
            formData.append("created_at",timestamps() )
            formData.append("_token",entById('_token').value)
            return await post("/consultaexterna/user/paciente/recipe/store",formData)
    }
let handleDestroy = async (recipe_id)=>{
    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: "¿Desea eliminar este medicamento?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`,
        didClose: async () => {
            let response = await destroy(recipe_id)

            if (response) {
                let user_id = useState.user_id
                let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, user_id ) )
                pacientes_datos[ index_id]['recipes'] = pacientes_datos[ index_id]['recipes'].filter( x=>{
                    //console.log(parseInt(x.id) +"!=="+ parseInt(recipe_id))
                    if (parseInt(x.id) !== parseInt(recipe_id)) {
                        return x
                    }
                })

                Swal.fire(
                    'Eliminado!',
                    'El medicamento ha sido eliminado del récipe',
                    'success'
                    )
                    console.log(pacientes_datos)
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
            for (const key in useState) {
                formData.append( key , useState[key] )
            }
            formData.append("recipe_id",recipe_id)
            formData.append("_token",entById('_token').value)
            return await post("/consultaexterna/user/paciente/recipe/update/"+recipe_id ,formData)
    }
let print_pdf = (user_id,episodio_id,print)=>{

    window.open(`/consultaexterna/pdf/recipe/preview/${user_centro_salud_id}/${episodio_id}/${user_id_medico}/${user_id}/${print}`)
    }
let compartir_ws = (user_id,print)=>{
    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, user_id ) )
    let paciente = pacientes_datos[ index_id ]
    let episodio_id = paciente.episodio
    window.open(`https://wa.me/${paciente.telefono_movil}?text=Hola! ${medico_genero=="f"?"La ":"El "}${medico_fullname}, te ha enviado un récipe. Pulsa en el siguiente enlace para descargarlo: ${host_patientcare}/pdf/recipe/ws/${user_centro_salud_id}/${episodio_id}/${user_id_medico}/${user_id}/${print}`)
    }
let compartir_email = async (user_id,print)=>{
    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, user_id ) )
    let paciente = pacientes_datos[ index_id ]
    let episodio_id = paciente.episodio
    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: `¿Desea enviar el récipe al correo ${paciente.email}?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`,
        didClose: async () => {
            let response = await get(`/consultaexterna/pdf/recipe/email/${user_centro_salud_id}/${episodio_id}/${user_id_medico}/${user_id}/${print}`)

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
    useState.recipe_id= recipe_id
    d.querySelector('#submit_store').classList.add("d-none")
    d.querySelector('#submit_update').classList.remove("d-none")
    $('#pills-page2-tab').tab('show')
    let user_id = useState.user_id
    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, user_id ) )
    let model = first( pacientes_datos[ index_id]['recipes'].filter( x=> parseInt(x.id) === parseInt(recipe_id) ) )
        useState.value= model.value
        useState.value2= model.value2
        useState.value3= model.value3
        useState.value4= model.value4
        useState.created_at= model.created_at
    let $form = d.querySelector('#modelId .modal-body')

        $form.querySelector("input[name='value']").value=model.value
        $form.querySelector("input[name='value2']").value=model.value2
        $form.querySelector("textarea[name='value3']").value=model.value3
        $form.querySelector("input[name='value4']").value=model.value4
        $form.querySelector("input[name='created_at']").value= fechaInputDate(model.created_at)


}
export let renderHtml = async (user_id)=>{

        $("#modelId").modal("show")
        useState['user_id'] = user_id
        let $html = entById('artefacto_0009').content
            $html = d.importNode($html,true)
            $html.querySelector('#regresar2').addEventListener("click", function(e){
                e.preventDefault()
                $('#pills-page1-tab').tab('show')
            })
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

            d.querySelector('#modelId .modal-body #imprimir_recipe_color').dataset.user_id=user_id
            d.querySelector('#modelId .modal-body #imprimir_recipe_bw').dataset.user_id=user_id

            d.querySelector('#modelId .modal-body #whatsapp_recipe_color').dataset.user_id=user_id
            d.querySelector('#modelId .modal-body #whatsapp_recipe_bw').dataset.user_id=user_id

            d.querySelector('#modelId .modal-body #email_recipe_color').dataset.user_id=user_id
            d.querySelector('#modelId .modal-body #email_recipe_bw').dataset.user_id=user_id
            UserCuestPaciente.infoPaciente("#infoPaciente", user_id)

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
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
                        print_pdf(e.target.dataset.user_id,episodio_id,"color")
                }
                if (e.target.matches("#imprimir_recipe_bw") ) {
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
                        print_pdf(e.target.dataset.user_id,episodio_id,"bw")
                }
                if (e.target.matches("#whatsapp_recipe_color") ) {
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
                    compartir_ws(e.target.dataset.user_id,"color")
                }
                if (e.target.matches("#whatsapp_recipe_bw") ) {
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
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
export let init = async (user_id)=>{
        //$("#modal-fullscreen").modal("show")
        $("#modelId").modal("show")
        useState['user_id'] = user_id
        let $html = entById('artefacto_0026').content
            $html = d.importNode($html,true)
            console.log( $html)
            //console.log($html.querySelectorAll("div"))
            $html.querySelector('#regresar2').addEventListener("click", function(e){
                e.preventDefault()
                $('#pills-page1-tab').tab('show')
            })
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

            d.querySelector('#modelId .modal-body #imprimir_recipe_color').dataset.user_id=user_id
            d.querySelector('#modelId .modal-body #imprimir_recipe_bw').dataset.user_id=user_id

            d.querySelector('#modelId .modal-body #whatsapp_recipe_color').dataset.user_id=user_id
            d.querySelector('#modelId .modal-body #whatsapp_recipe_bw').dataset.user_id=user_id

            d.querySelector('#modelId .modal-body #email_recipe_color').dataset.user_id=user_id
            d.querySelector('#modelId .modal-body #email_recipe_bw').dataset.user_id=user_id


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
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
                        print_pdf(e.target.dataset.user_id,episodio_id,"color")
                }
                if (e.target.matches("#imprimir_recipe_bw") ) {
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
                        print_pdf(e.target.dataset.user_id,episodio_id,"bw")
                }
                if (e.target.matches("#whatsapp_recipe_color") ) {
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
                    compartir_ws(e.target.dataset.user_id,"color")
                }
                if (e.target.matches("#whatsapp_recipe_bw") ) {
                    let index_id = pacientes_datos.findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let episodio_id = pacientes_datos[ index_id ].episodio
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
