import {alertMessage} from '../../helpers/helpers.js'
let d = document
export let count = 0
let useState={
    "estudios":[],
    "medico":null,
    "estudio_id":null,
    "user_cita_id":"",
    "user_id":"",
    "value":"",
    "value2":"",
    "value3":"",
    "value4":1,
}
let reset_reset = ()=>{
    useState.estudio_id=null
    useState.value=""
    useState.value2=""
    useState.coments=""


    d.querySelector("select[name='value']").value=""
    d.querySelector("input[name='value2']").value=""
    d.querySelector("textarea[name='coments']").value=""

}
let handleStore = async ()=>{
    let response = await store()
        if ( !is_null(response) ) {

                useState['estudios'].push( response )
                let total_estudios = useState['estudios'].length
                if (total_estudios > 0 ) {
                    d.querySelector(".acceso-archivos .handle_estudios span").classList.remove("badge-gray")
                    d.querySelector(".acceso-archivos .handle_estudios span").classList.add("badge-success")
                    d.querySelector(".acceso-archivos .handle_estudios span").textContent = total_estudios
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
    let estudio_id = useState.estudio_id
    let response = await update(estudio_id)
        if ( !is_null(response) ) {
           // let index_user_id = useState['estudios'].findIndex( x => equalsInt( x.user_id,response.user_id ) )
            let index_estudio_id = useState['estudios'].findIndex(x=> equalsInt( x.id , estudio_id ) )

                Object.assign(useState['estudios'][ index_estudio_id ], response)


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
    useState[e.target.name] = e.target.value
}
let formFields_validate = (response)=>{
    let {value,value2} = useState
        if (is_empty( value )) {
            let input = d.querySelector(`select[name='value']`)
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



    return true
}
let index = async ()=>{
    let response = await getAll()
        //console.log("---->",response)
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
                let $html = entById('artefacto_0013').content
                    $html = d.importNode($html,true)
                    $html.querySelector(".row-item_fecha").innerHTML=  fechaCortaAPPLE(x.created_at)
                    $html.querySelector(".row-item_unidad").textContent= x.value
                    $html.querySelector(".row-item_estudio").textContent= x.value2
                    $html.querySelector(".row-item_notas").textContent= x.coments

                    $html.querySelectorAll(".row-item_delete")[0].dataset.estudio_id= x.id
                    $html.querySelectorAll(".row-item_delete")[1].dataset.estudio_id= x.id
                    $html.querySelectorAll(".row-item_edit")[0].dataset.estudio_id= x.id
                    $html.querySelectorAll(".row-item_edit")[1].dataset.estudio_id= x.id
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

            return await useState['estudios']
    }

let store = async ()=>{
        let formData = new FormData();
            for (const key in useState) {
                formData.append( key , useState[key] )
            }
            formData.append("user_cita_id",useState.user_cita_id )
            formData.append("created_at",timestamps() )
            formData.append("_token",entById('_token').value)
            return await post("/consultaexterna/user/paciente/estudio/store_cita",formData)
    }
let handleDestroy = async (estudio_id)=>{
        Toast.fire({
            icon:"warning",
            title: "Atención",
            text: "¿Desea eliminar este medicamento?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`
        }).then(async (result) => {
            if (result.isConfirmed) {
                let response = await destroy(estudio_id)

                if (response) {
                    let user_id = useState.user_id
                    let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, user_id ) )
                    useState['estudios'] = useState['estudios'].filter( x=>{
                        if (parseInt(x.id) !== parseInt(estudio_id)) {
                            return x
                        }
                    })
                    let total_estudios = useState['estudios'].length
                        if (total_estudios > 0 ) {
                            d.querySelector(".acceso-archivos .handle_estudios span").classList.remove("badge-gray")
                            d.querySelector(".acceso-archivos .handle_estudios span").classList.add("badge-success")
                            d.querySelector(".acceso-archivos .handle_estudios span").textContent = total_estudios
                        }else{
                            d.querySelector(".acceso-archivos .handle_estudios span").classList.add("badge-gray")
                            d.querySelector(".acceso-archivos .handle_estudios span").classList.remove("badge-success")
                            d.querySelector(".acceso-archivos .handle_estudios span").textContent = total_estudios
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
let destroy = async (estudio_id)=>{
    let formData = new FormData();

        formData.append("id",estudio_id)
        formData.append("_token",entById('_token').value)
        return await post("/consultaexterna/user/paciente/estudio/destroy/"+estudio_id,formData)

    }
let update = async (estudio_id)=>{
        let formData = new FormData();
            for (const key in useState) {
                formData.append( key , useState[key] )
            }
            formData.append("estudio_id",estudio_id)
            formData.append("_token",entById('_token').value)
            return await post("/consultaexterna/user/paciente/estudio/update/"+estudio_id ,formData)
    }
let print_pdf = (user_id,user_cita_id,print)=>{

    window.open(`/consultaexterna/pdf/estudio/cita/preview/${user_centro_salud_id}/${user_cita_id}/${user_id_medico}/${user_id}/${print}`)
    }
let compartir_ws = (user_id,print)=>{
    //let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, user_id ) )
    let paciente = useState['paciente']
    let user_cita_id = useState.user_cita_id
    console.log(paciente)
    window.open(`https://wa.me/${paciente.telefono_movil}?text=Hola! ${medico_genero=="f"?"La ":"El "}${medico_fullname}, te ha enviado una solicitud de estudio diagnóstico. Pulsa en el siguiente enlace para descargarlo: ${host_patientcare}/pdf/estudio/cita/preview/${user_centro_salud_id}/${user_cita_id}/${user_id_medico}/${user_id}/${print}`)
    }
let compartir_email = async (user_id,print)=>{
    //let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, user_id ) )
    let paciente = useState['paciente']
    let user_cita_id = useState.user_cita_id
    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: `¿Desea enviar el récipe al correo ${paciente.email}?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`,
        didClose: async () => {
            let response = await get(`/consultaexterna/pdf/estudio/cita/email/${user_centro_salud_id}/${user_cita_id}/${user_id_medico}/${user_id}/${print}`)

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




    ///window.open(`https://wa.me/${paciente.telefono_movil}?text=Hola! ${medico_genero=="f"?"La ":"El "}${medico_fullname}, quien está atendiendo tu consulta médica, te ha enviado un récipe. Pulsa en el siguiente enlace para descargarlo: ${host_patientcare}/pdf/estudio/ws/${user_centro_salud_id}/${episodio_id}/${user_id_medico}/${user_id}/color`)
    }
let handleEdit = (estudio_id)=>{
    useState.estudio_id= estudio_id
    d.querySelector('#submit_store').classList.add("d-none")
    d.querySelector('#submit_update').classList.remove("d-none")
    $('#pills-page2-tab').tab('show')
    let user_id = useState.user_id
    let model = first( useState['estudios'].filter( x=> parseInt(x.id) === parseInt(estudio_id) ) )
        useState.value= model.value
        useState.value2= model.value2
        useState.coments= model.coments
        //useState.created_at= model.created_at
    let $form = d.querySelector('#modelId .modal-body')
    let options = $form.querySelectorAll("select[name='value'] option")
        //console.log(options)
        $form.querySelector("select[name='value']").value=model.value
        $form.querySelector("input[name='value2']").value=model.value2
        $form.querySelector("textarea[name='coments']").value=model.coments


}

export let init = async (resulset,user_cita_id)=>{
    let index_cita = resulset['citas'].findIndex(cita => equalsInt(cita.user_cita_id,user_cita_id ) )
    let {user_id_paciente,user_estudio} = resulset['citas'][index_cita]
    let $modal = d.querySelector(`#modelId `)
        $modal.querySelector(".modal-dialog").classList.remove("modal-lg","modal-sm")
        $modal.querySelector(".modal-dialog").classList.add("modal-lg")
        $modal.querySelector(".modal-body").innerHTML = null
        $("#modelId").modal("show")

        useState['user_id'] = user_id_paciente
        useState['user_cita_id'] = user_cita_id
        useState['estudios'] = user_estudio
        useState['paciente'] = first( resulset['pacientes'].filter(pac => equalsInt(pac.id, user_id_paciente ) ) )
        //console.log(useState)
        let $html = entById('artefacto_0027').content
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

            d.querySelector('#modelId .modal-body #imprimir_estudio_color').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #imprimir_estudio_color').dataset.user_cita_id=user_cita_id

            d.querySelector('#modelId .modal-body #imprimir_estudio_bw').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #imprimir_estudio_bw').dataset.user_cita_id=user_cita_id

            d.querySelector('#modelId .modal-body #whatsapp_estudio_color').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #whatsapp_estudio_bw').dataset.user_id=user_id_paciente

            d.querySelector('#modelId .modal-body #email_estudio_color').dataset.user_id=user_id_paciente
            d.querySelector('#modelId .modal-body #email_estudio_bw').dataset.user_id=user_id_paciente


            d.querySelector('#modelId .modal-body form').addEventListener("change",e=>{
                set_formLogin(e)
            })



            d.querySelector('#modelId .modal-body').addEventListener("click",e=>{
                //console.log(e.target)
                if (e.target.matches(".row-item_delete") ) {
                    handleDestroy(e.target.dataset.estudio_id)
                }
                if (e.target.matches(".row-item_edit") ) {
                    handleEdit(e.target.dataset.estudio_id)
                }
                if (e.target.matches("#imprimir_estudio_color") ) {
                   // let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    //let user_cita_id = useState['estudios'][ index_id ].user_cita_id
                        print_pdf(e.target.dataset.user_id,e.target.dataset.user_cita_id,"color")
                }
                if (e.target.matches("#imprimir_estudio_bw") ) {
                    let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    let user_cita_id = useState['estudios'][ index_id ].user_cita_id
                        print_pdf(e.target.dataset.user_id,user_cita_id,"bw")
                }
                if (e.target.matches("#whatsapp_estudio_color") ) {
                    //let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                   // let episodio_id = useState['estudios'][ index_id ].user_cita_id
                    compartir_ws(e.target.dataset.user_id,"color")
                }
                if (e.target.matches("#whatsapp_estudio_bw") ) {
                    //let index_id = useState['estudios'].findIndex( x => equalsInt( x.user_id, e.target.dataset.user_id ) )
                    //let episodio_id = useState['estudios'][ index_id ].user_cita_id
                    compartir_ws(e.target.dataset.user_id,"bw")
                }
                if (e.target.matches("#email_estudio_color") ) {
                    e.preventDefault()
                    compartir_email(e.target.dataset.user_id,"color")
                }
                if (e.target.matches("#email_estudio_bw") ) {
                    e.preventDefault()
                    compartir_email(e.target.dataset.user_id,"bw")
                }
            })


            index()
    }
