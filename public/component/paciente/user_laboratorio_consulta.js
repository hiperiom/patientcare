import {add_row, alertMessage,fileType,jsUclast} from '../../helpers/helpers.js'
let d = document
export let count = 0
let prefix =`user_`
let item_model = `laboratorio`
let icon = `pc-laboratorios`
let title = jsUcfirst(item_model)
let model = `${prefix}${item_model}`
let $modal = d.querySelector('#modelId')
let citaBtnBadge = ".handle_laboratorios"

export let citaTotalItems = (user_id)=>{

    let total_items = useState[model].filter(x=> equalsInt(x['user_id'],user_id) )
        console.log(model,"->",total_items)
    let badge = d.querySelector(`.acceso-archivos ${citaBtnBadge} span`)
        if (total_items.length > 0) {
            badge.classList.remove("badge-gray")
            badge.classList.add("badge-success")
        } else {
            badge.classList.add("badge-gray")
            badge.classList.remove("badge-success")
        }
        badge.textContent = total_items.length
}
let module_event_config = ()=>{

    let $html = entById('artefacto_0028').content
        $html = d.importNode($html,true)

        //evento regresar al index modal
        $html.querySelector('#regresar2').addEventListener("click", function(e){
            e.preventDefault()
            $('#pills-page1-tab').tab('show')
        })

        //evento boton formulario crear
        $html.querySelector('#item_create').addEventListener("click", function(e){
            d.querySelector('#submit_store').classList.remove("d-none")
            d.querySelector('#submit_update').classList.add("d-none")
            $('#pills-page2-tab').tab('show')
        })

        //evento registrar
        $html.querySelector('#submit_store').addEventListener("click",e=>{
            e.preventDefault()
            if ( formFields_validate() ) {
                handle_store()
            }
        })
        //evento actualizar
        $html.querySelector('#submit_update').addEventListener("click",e=>{
            e.preventDefault()
            if ( formFields_validate() ) {
                handle_update()
            }
        })
        //botones de editar y eliminar
        d.querySelector('#modelId .modal-body').addEventListener("click",e=>{
            if (e.target.matches(".row-item_delete") ) {
                handle_destroy(e.target.dataset[model],e.target.dataset['user_id'])
            }
            if (e.target.matches(".row-item_edit") ) {
                handle_edit(e.target.dataset[model])
            }
        })
        d.querySelector('#modelId .modal-body').innerHTML=null
        d.querySelector('#modelId .modal-body').append($html)
    let $modal = d.querySelector("#modelId")
        $modal.querySelector('.modal-title').textContent = title
        $modal.querySelector('#title_modal i').classList.add(icon)
        $modal.querySelector('.modal-btn-create').textContent= title
}
let handle_store = async ()=>{
    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: "¿Desea guardar los archivos?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`
    }).then(async (result) => {
        if (result.isConfirmed) {
            $modal.querySelector('.overlay').classList.remove(`d-none`)

            let response = await store()

            // console.log('response --> ',{response})

                add_row(
                    model,
                    first(response)
                )
                //console.log(`store_${model}->`,useState[model])
                $modal.querySelector('.overlay').classList.add(`d-none`)
                Swal.fire(
                    'Archivos guardados!',
                    'Los archivos se han subido correctamente',
                    'success'
                )
            let files = $modal.querySelector('.modal-body input[name="file"]')
                files.value=null
            let coments = $modal.querySelector('.modal-body textarea[name="coments"]')
                coments.value=null
                handle_index(first(response).user_id)



                $('#pills-page1-tab').tab('show')

        }
    })

}
let handle_edit = async (item_id)=>{

    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: "¿Desea actualizar los comentarios?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`
    }).then(async (result) => {
        if (result.isConfirmed) {
            $modal.querySelector('.overlay').classList.remove(`d-none`)
            let coments = $modal.querySelector(`#${model}_textarea_${item_id}`).value

            let response = await update(coments,item_id)
            let index = useState[model].findIndex( x => equalsInt( parseInt(x.id),parseInt(item_id)))
                useState[model][index]['coments'] = response['coments']

                $modal.querySelector('.overlay').classList.add(`d-none`)
                Swal.fire(
                    'Comentario actualizado!',
                    'El texto se actualizó correctamente',
                    'success'
                )

        }
    })
}
let handle_index = async (user_id)=>{

    $modal.querySelector('.overlay').classList.remove(`d-none`)
    console.log("model",model)
    let response = useState[model].filter(x=> equalsInt(x['user_id'],user_id) )
        //console.log(model,"->",response)
    let $tbody =$modal.querySelector('.modal-body #pills-page1 table tbody')
        $tbody.innerHTML=null
        citaTotalItems(user_id)
        if ( response.length < 1 ) {
            $tbody.innerHTML=emptyItem('Sin registros',5)
            $modal.querySelector('.overlay').classList.add(`d-none`)
        }else{

            response.forEach(x=>{
                let $html = entById('artefacto_0032').content.cloneNode(true)

                let $td = $html.querySelectorAll("td")
                    $td[0].innerHTML=  fechaCortaAPPLE( x.created_at )
                    $td[1].querySelector("a").href= `/${x.value}`

                    fileType( $td[1].querySelector("a i"), x.file_type)
                    let str = x.file_type
                    $td[2].textContent= !is_null(x.file_type) ?str.toUpperCase() : ''
                    $td[3].querySelector("textarea").value= !is_null(x.coments) ?x.coments : ''
                    $td[3].querySelector("textarea").id =`${model}_textarea_${x.id}`


                    $html.querySelectorAll(".row-item_delete")[0].dataset[model]= x.id
                    $html.querySelectorAll(".row-item_delete")[1].dataset[model]= x.id

                    $html.querySelectorAll(".row-item_delete")[0].dataset['user_id']= x.user_id
                    $html.querySelectorAll(".row-item_delete")[1].dataset['user_id']= x.user_id

                    $html.querySelectorAll(".row-item_edit")[0].dataset[model]= x.id
                    $html.querySelectorAll(".row-item_edit")[1].dataset[model]= x.id

                    $html.querySelectorAll(".row-item_edit")[0].dataset['user_id']= x.user_id
                    $html.querySelectorAll(".row-item_edit")[1].dataset['user_id']= x.user_id
                    /* if (localStorage.getItem("cita_anterior") != null) {
                        if (localStorage.getItem("cita_anterior") === "true" ) {
                            $html.querySelectorAll('.row-item_edit').forEach(x=>x.classList.add("d-none"))
                            $html.querySelectorAll('.row-item_delete').forEach(x=>x.classList.add("d-none"))
                        }
                    } */
                    $tbody.append( $html )
            })
            $modal.querySelector('.overlay').classList.add(`d-none`)
        }

}

let handle_destroy = async (item_id,user_id)=>{
    Toast.fire({
        icon:"warning",
        title: "Atención",
        text: `¿Desea eliminar este ${title}?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si`
    }).then(async (result) => {
        if (result.isConfirmed) {
            let response = await destroy(item_id)

            if (response) {

                useState[model] = useState[model].filter( x=>{
                    if (parseInt(x.id) !== parseInt(item_id)) {
                        return x
                    }
                })

                Swal.fire(
                    'Eliminado!',
                    `El ${title} ha sido eliminado`,
                    'success'
                    )
                handle_index(user_id)
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
let destroy = async (item_id)=>{
let formData = new FormData();

    formData.append("id",item_id)
    formData.append("_token",entById('_token').value)
    return await post(`/consultaexterna/user/paciente/${item_model}/destroy/${item_id}`,formData)

}
let update = async (coments,item_id)=>{
    let formData = new FormData();
        formData.append("id",item_id)
        formData.append("coments",coments)
        formData.append("_token",entById('_token').value)
        return await post(`/consultaexterna/user/paciente/${item_model}/update/${item_id}` ,formData)
}
let store = async ()=>{
    let files = $modal.querySelector('.modal-body input[name="file"]').files;
    // console.log("files --> ",files)
    let coments = $modal.querySelector('.modal-body textarea[name="coments"]').value;
    let formdata = new FormData();
        formdata.append("coments", coments)
        for (let index = 0; index < files.length; index++) {
            formdata.append("file_"+index, files[index])
        }

        formdata.append("total_archivos", files.length )
        formdata.append("user_id", useState['formFileCreate']['user_id'])
        formdata.append("user_cita_id", useState['formFileCreate']['user_cita_id'])
        formdata.append("_token", entById('_token').value )
        formdata.append("created_at", timestamps())
        console.log('formData --> ',formdata);
        return await post(`/consultaexterna/user/paciente/${item_model}/store_cita`,formdata)

}
export let index = async (user_id_paciente)=>{
return await get(`/consultaexterna/user/paciente/${item_model}/index_by_cita/${user_id_paciente}`)
}

let formFields_validate = ()=>{
let files = d.querySelector('#modelId .modal-body input[name="file"]').files;
    if (files.length === 0) {
        let input = d.querySelector('#modelId .modal-body input[name="file"]')
            Toast.fire({
                icon: 'warning',
                title: 'Atención',
                text: "Debe elegir al menos un archivo.",
                didClose: () => {
                    setTimeout(() => input.focus() , 110);
                }
            })
        return false
    }
    // console.log(files.length)
    return true
}

export let init = async (e)=>{
let $modal = d.querySelector(`#modelId `)
    $modal.querySelector(".modal-dialog").classList.remove("modal-lg","modal-sm")
    $modal.querySelector(".modal-dialog").classList.add("modal-lg")
    $modal.querySelector(".modal-body").innerHTML = null
    $("#modelId").modal("show")
    useState['formFileCreate']['user_id'] = e.target.dataset.user_id_paciente
    useState['formFileCreate']['user_cita_id'] = e.target.dataset.user_cita_id

    //console.log(useState)//
    module_event_config()
    handle_index(e.target.dataset.user_id_paciente)
}
