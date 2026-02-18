import {alertMessage,add_row, first, get_all, fechaAMD,delete_row, fechaDMA, get_one, update_row} from '../../helpers/helpers.js'
let d = document
let useStateKey = 'formRecipeCreate'
let model = "user_recipe"
let item_num = "recipe_num"
let item_id = "recipe_id"
let citaBtnBadge = ".handle_recipes"
let nameModel = "Récipe"
let nameItem1 = "Medicamento"
let nameItem2 = "recipe"
let nameItem3 = "Nuevo Récipe"


export let citaTotalItems = (user_cita_id)=>{
    //console.log(useState[model])
    let items = useState[model].filter(index => equalsInt(index['user_cita_id'], user_cita_id))
    let total_items = Array.from(new Set( items.map(x=> parseInt(x[item_num]) ) ))
        //console.log("total_items->",total_items)
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
let formValidate= ()=>{
  let $input = d.querySelector(`input[name='value']`)
      if($input.value === ""){
        alert("No has escrito el nombre del medicamento")
        $input.focus()
        return false
      }
      $input = d.querySelector(`input[name='value2']`)
      if($input.value === ""){
        alert("No has escrito la presentación")
        $input.focus()
        return false
      }
      $input = d.querySelector(`input[name='value4']`)
      if($input.value === ""){
        alert("No has escrito la cantidad")
        $input.focus()
        return false
      }
      $input = d.querySelector(`textarea[name='value3']`)
      if($input.value === ""){
        alert("No has escrito las indicaciones")
        $input.focus()
        return false
      }
      return true
  }
let store = async ()=>{
  let formData = new FormData();
      for (const key in useState[ useStateKey ]) {
          if (Object.hasOwnProperty.call(useState[ useStateKey ], key)) {
              let element = useState[ useStateKey ][key];
                  formData.append(key,element)
          }
      }
      formData.append("created_at",timestamps() );
      formData.append("_token",d.querySelector("#_token").value)
    return await post(`/consultaexterna/user/paciente/${nameItem2}/store_cita`,formData)

  }
let update = async (item_id)=>{
  let formData = new FormData();
      for (const key in useState[ useStateKey ]) {
          if (Object.hasOwnProperty.call(useState[ useStateKey ], key)) {
              let element = useState[ useStateKey ][key];
                  formData.append(key,element)
          }
      }
      formData.append("created_at",timestamps() );
      formData.append("_token",d.querySelector("#_token").value)
    return await post(`/consultaexterna/user/paciente/${nameItem2}/update/${item_id}`,formData)
  }
let destroy = async (e)=>{
    let formData = new FormData();

        formData.append("all",e.target.dataset.all )
        formData.append("recipe_num",e.target.dataset[item_num])
        formData.append("id",e.target.dataset[item_id])
        formData.append("user_cita_id",e.target.dataset['user_cita_id'])
        formData.append("_token",entById('_token').value)
        return await post("/consultaexterna/user/paciente/recipe/destroy/"+e.target.dataset[item_id] ,formData)

}
// let show = (e)=>{
//     d.querySelector("#pills-page2 #submit_store").classList.add("d-none")
//     d.querySelector("#pills-page2 #submit_update").classList.remove("d-none")

//     d.querySelector('#modelId .item-counter').classList.remove("d-none")
//     let items = useState[ model ].filter(x=> equalsInt(x.user_cita_id, e.target.dataset.user_cita_id ) && equalsInt(x[item_num], e.target.dataset[item_num] ) )

//         list(items)
//         d.querySelector('#modelId .item-counter').textContent= "#"+e.target.dataset[item_num]


//     clearFormCreate()

// }
let show = (e)=>{
    d.querySelector("#pills-page2 #submit_store").classList.remove("d-none")
    d.querySelector("#pills-page2 #submit_update").classList.add("d-none")

    d.querySelector('#modelId .item-counter').classList.remove("d-none")
    let items = useState[ model ].filter(x=> equalsInt(x.user_cita_id, e.target.dataset.user_cita_id ) && equalsInt(x[item_num], e.target.dataset[item_num] ) )

        list(items)
        d.querySelector('#modelId .item-counter').textContent= "#"+e.target.dataset[item_num]

    clearFormCreate()
}
let list = (resultset)=>{
    //let resultset = use
    let $table = d.querySelector(`#pills-page2 #table_create`)
    if(resultset.length === 0){
        $table.querySelector(`tbody`).innerHTML=`
          <tr>
            <td colspan="3" class="text-center text-primary">
                Sin registros
            </td>
          </tr>
        `
    }else{
        $table.querySelector(`tbody`).innerHTML=``
        resultset.forEach((x,counter)=>{
          //console.log(x)
          let $row = entById('artefacto_0041').content.cloneNode(true)
              $row.querySelector(`.value-counter`).textContent = counter+1
              $row.querySelector(`.value-medicamento`).textContent = x.value
              $row.querySelector(`.value-presentation`).textContent = x.value2
              $row.querySelector(`.value-cantidad`).textContent = x.value4
              $row.querySelector(`.value-indication`).textContent = x.value3

              $row.querySelector(`.btn-delete`).dataset[item_num] = x[item_num]
              $row.querySelector(`.btn-delete`).dataset[item_id] = x['id']
              $row.querySelector(`.btn-delete`).dataset['all'] = false
              $row.querySelector(`.btn-delete`).dataset['user_cita_id'] = x['user_cita_id']

              $row.querySelector(`.btn-delete i`).dataset[item_num] = x[item_num]
              $row.querySelector(`.btn-delete i`).dataset[item_id] = x['id']
              $row.querySelector(`.btn-delete i`).dataset['all'] = false
              $row.querySelector(`.btn-delete i`).dataset['user_cita_id'] = x['user_cita_id']

              $row.querySelector(`.btn-edit`).dataset[item_num] = x[item_num]
              $row.querySelector(`.btn-edit`).dataset[item_id] = x['id']
              $row.querySelector(`.btn-edit`).dataset['user_cita_id'] = x['user_cita_id']

              $row.querySelector(`.btn-edit i`).dataset[item_num] = x[item_num]
              $row.querySelector(`.btn-edit i`).dataset[item_id] = x['id']
              $row.querySelector(`.btn-edit i`).dataset['user_cita_id'] = x['user_cita_id']
              $table.querySelector(`tbody`).append($row)
        })
    }
}
export let list_index = ()=>{
    let items = get_all(model,"user_cita_id",useState[ useStateKey ]['user_cita_id'])
    let $table = d.querySelector(`#pills-page1 #table_index`)
    if(items.length === 0){
        $table.querySelector(`tbody`).innerHTML=`
          <tr>
            <td colspan="3" class="text-center text-primary">
                Sin registros
            </td>
          </tr>
        `
    }else{
        /**inicio */

        if (items.length > 0) {
                $table.querySelector(`tbody`).innerHTML=``
            let items_id = Array.from(new Set( items.map(x=> parseInt(x[item_num]) ) ))
                //console.log("items_id->",items_id)
                items_id.forEach((item_id1,counter)=>{
                    let total = items.filter(x1=> equalsInt(x1[item_num],item_id1) )
                    let medico_id = first( total.filter(x1=> equalsInt(x1[item_num],item_id1) ) )['user_id_medico']
                    let medico = first( useState['medicos'].filter(y=> equalsInt(y.user_id,medico_id)))
                    let model = first( total.filter(x1=> equalsInt(x1[item_num],item_id1) ) )
                    let fecha = model['created_at']
                    let row_id = model[item_num]
                    let user_cita_id = model['user_cita_id']

                    let $row = entById('artefacto_0042').content.cloneNode(true)
                        $row.querySelector(`.item-counter`).textContent = row_id
                        $row.querySelector(`.item-fecha`).textContent = fechaDMA(fecha)
                        $row.querySelector(`.item-cantidad`).textContent = total.length
                        $row.querySelector(`.item-medico`).textContent = `${is_null(medico)?'':medico.medico}`

                        $row.querySelector(`.btn-show`).dataset.user_cita_id = user_cita_id
                        $row.querySelector(`.btn-show i`).dataset.user_cita_id = user_cita_id
                        $row.querySelector(`.btn-show`).dataset[item_num] = row_id
                        $row.querySelector(`.btn-show i`).dataset[item_num] = row_id

                        $row.querySelector(`.btn-email_color`).dataset.user_cita_id = user_cita_id
                        $row.querySelector(`.btn-email_bw`).dataset.user_cita_id = user_cita_id

                        $row.querySelector(`.btn-delete`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-delete`).dataset[item_id] = model['id']
                        $row.querySelector(`.btn-delete`).dataset['all'] = true
                        $row.querySelector(`.btn-delete`).dataset['user_cita_id'] = user_cita_id

                        $row.querySelector(`.btn-delete i`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-delete i`).dataset[item_id] = model['id']
                        $row.querySelector(`.btn-delete i`).dataset['all'] = true
                        $row.querySelector(`.btn-delete i`).dataset['user_cita_id'] = user_cita_id

                        $row.querySelector(`.btn-imprimir_color`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-imprimir_color`).dataset['user_cita_id'] = user_cita_id
                        $row.querySelector(`.btn-imprimir_color`).dataset['user_id_paciente'] = model['user_id']
                        $row.querySelector(`.btn-imprimir_color`).dataset['user_id_medico'] = model['user_id_medico']
                        $row.querySelector(`.btn-imprimir_color`).dataset['user_centro_salud_id'] = user_centro_salud_id

                        $row.querySelector(`.btn-imprimir_bw`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-imprimir_bw`).dataset['user_cita_id'] = user_cita_id
                        $row.querySelector(`.btn-imprimir_bw`).dataset['user_id_paciente'] = model['user_id']
                        $row.querySelector(`.btn-imprimir_bw`).dataset['user_id_medico'] = model['user_id_medico']
                        $row.querySelector(`.btn-imprimir_bw`).dataset['user_centro_salud_id'] = user_centro_salud_id

                        $row.querySelector(`.btn-whatsapp_color`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-whatsapp_color`).dataset['user_cita_id'] = user_cita_id
                        $row.querySelector(`.btn-whatsapp_color`).dataset['user_id_paciente'] = model['user_id']
                        $row.querySelector(`.btn-whatsapp_color`).dataset['user_id_medico'] = model['user_id_medico']
                        $row.querySelector(`.btn-whatsapp_color`).dataset['user_centro_salud_id'] = user_centro_salud_id

                        $row.querySelector(`.btn-whatsapp_bw`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-whatsapp_bw`).dataset['user_cita_id'] = user_cita_id
                        $row.querySelector(`.btn-whatsapp_bw`).dataset['user_id_paciente'] = model['user_id']
                        $row.querySelector(`.btn-whatsapp_bw`).dataset['user_id_medico'] = model['user_id_medico']
                        $row.querySelector(`.btn-whatsapp_bw`).dataset['user_centro_salud_id'] = user_centro_salud_id

                        $row.querySelector(`.btn-email_color`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-email_color`).dataset['user_cita_id'] = user_cita_id
                        $row.querySelector(`.btn-email_color`).dataset['user_id_paciente'] = model['user_id']
                        $row.querySelector(`.btn-email_color`).dataset['user_id_medico'] = model['user_id_medico']
                        $row.querySelector(`.btn-email_color`).dataset['user_centro_salud_id'] = user_centro_salud_id

                        $row.querySelector(`.btn-email_bw`).dataset[item_num] = model[item_num]
                        $row.querySelector(`.btn-email_bw`).dataset['user_cita_id'] = user_cita_id
                        $row.querySelector(`.btn-email_bw`).dataset['user_id_paciente'] = model['user_id']
                        $row.querySelector(`.btn-email_bw`).dataset['user_id_medico'] = model['user_id_medico']
                        $row.querySelector(`.btn-email_bw`).dataset['user_centro_salud_id'] = user_centro_salud_id


                        $table.querySelector(`tbody`).append($row)
                })

        }


    }
}
let create = (e)=>{
    d.querySelector("#pills-page2 #submit_store").classList.remove("d-none")
    d.querySelector("#pills-page2 #submit_update").classList.add("d-none")
    d.querySelector('#modelId .item-counter').classList.remove("d-none")
    let newItem_num = next_item_number()
    let items = useState[ model ].filter(x=> equalsInt(x.user_cita_id, e.target.dataset.user_cita_id ) && equalsInt(x[item_num], newItem_num ))
        list(items)
        clearFormCreate()

}
let compartir_ws = (e)=>{
    let {
        user_centro_salud_id,
        user_cita_id,
        print,
        user_id_paciente,
        user_id_medico
    } = e.target.dataset
    let paciente = first(useState['users'].filter( x => equalsInt( x.user_id, user_id_paciente ) ))
        window.open(`https://wa.me/${paciente.telefono_movil}?text=Hola! ${medico_genero=="f"?"La ":"El "}${medico_fullname}, te ha enviado un ${nameModel}. Pulsa en el siguiente enlace para descargarlo: ${host_patientcare}/pdf/${nameItem2}/cita/preview/${user_centro_salud_id}/${user_cita_id}/${e.target.dataset[item_num]}/${user_id_paciente}/${user_id_medico}/${print}`)
}
let print_pdf = (e)=>{
    let {
            user_centro_salud_id,
            user_cita_id,
            print,
            user_id_paciente,
            user_id_medico
        } = e.target.dataset
        window.open(`/consultaexterna/pdf/${nameItem2}/cita/preview/${user_centro_salud_id}/${user_cita_id}/${e.target.dataset[item_num]}/${user_id_paciente}/${user_id_medico}/${print}`)
}
let compartir_email = async (e)=>{
    let {
        user_centro_salud_id,
        user_cita_id,
        print,
        user_id_paciente,
        user_id_medico
    } = e.target.dataset

    get(`/user/show/${user_id_paciente}`)
        .then(response=>{
            console.log(`response --> ${response}`)

            Toast.fire({
                icon:"warning",
                title: "Atención",
                text: `¿Desea enviar el ${nameModel} al correo ${response.email}?`,
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Si`,
                didClose: async () => {
                    let response2 = await get(`/consultaexterna/pdf/${nameItem2}/cita/email/${user_centro_salud_id}/${user_cita_id}/${e.target.dataset[item_num]}/${user_id_paciente}/${user_id_medico}/${print}`)

                    if (response2) {
                        Swal.fire(
                            'Enviado!',
                            `El ${nameModel} ha sido enviado a ${paciente.email} exitosamente.`,
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
        })

}
let handleDestroy = async (e)=>{
    let all = e.target.dataset.all

    let message=`¿Desea eliminar este ${nameModel}?`

        if(e.target.dataset.all){
            message=`¿Desea eliminar este ${nameItem1}?`
        }
        Toast.fire({
            icon:"warning",
            title: "Atención",
            text: "¿Desea eliminar este medicamento?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`
        }).then(async (result) => {
            if (result.isConfirmed) {
                d.querySelector("#pills-page2 .overlay").classList.remove(`d-none`)
                try {
                    let resultset = await destroy(e)
                         if( resultset !== null ){

                            if (e.target.dataset.all=="true") {
                                let items = useState[ model ].filter(row=>equalsInt(row['user_cita_id'],e.target.dataset['user_cita_id']) && equalsInt(row[item_num],e.target.dataset[item_num]))
                                    items = items.map(item =>item['id'])
                                    items.forEach(item =>{
                                        delete_row({
                                            "attr":model,
                                            "key":'id',
                                            "value":item
                                        })
                                    })
                                    console.log("all")
                                    list_index()
                            }else{
                                delete_row({
                                    "attr":model,
                                    "key":'id',
                                    "value":e.target.dataset[item_id]
                                })
                                console.log("one")
                                let items = useState[ model ].filter(x=> equalsInt(x['user_cita_id'], e.target.dataset['user_cita_id'] ) && equalsInt(x[item_num], e.target.dataset[item_num] ))
                                list(items)
                            }



                                citaTotalItems( useState[ useStateKey ]['user_cita_id'] )
                                d.querySelector("#pills-page2 .overlay").classList.add(`d-none`)
                        }
                } catch (error) {
                    console.log(error)
                    d.querySelector("#pills-page2 .overlay").classList.add(`d-none`)
                }




                /* let response = await destroy(item_id)

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
                } */
            }
        })

}
let totalItems = ()=>{
    return get_all(model,"user_cita_id",useState[ useStateKey ]['user_cita_id']).length
}
let clearFormCreate = ()=>{
    d.querySelectorAll(`#pills-page2 input`).forEach(x=>{
        x.value=""
    })
    d.querySelectorAll(`#pills-page2 textarea`).forEach(x=>{
        x.value=""
    })
    d.querySelector(`#pills-page2 #form`).addEventListener("keyup",function(e){
        useState["formRecipeCreate"][ e.target.name ] = e.target.value
        console.log(e.target.name,"->",useState["formRecipeCreate"])
    })
    $('#pills-page2-tab').tab('show')
}

let next_item_number = ()=>{
    let recipes = useState[ model ].filter(x=> equalsInt(x.user_id, useState[ useStateKey ]['user_id'] ) )
        if (recipes.length === 0) {
            useState[ useStateKey ][item_num]= 1

        }
        if (recipes.length > 0) {
            let recipes_num = Array.from(new Set( recipes.map(x=> parseInt(x.recipe_num) ) ))
            useState[ useStateKey ][item_num]= Math.max.apply(null, recipes_num) +1;
            console.log(useState[ useStateKey ][item_num])
        }
        d.querySelector('#modelId .item-counter').textContent= "Nuevo #"+useState[ useStateKey ][item_num]
        return useState[ useStateKey ][item_num]

}

let handleEdit = (e)=>{
    d.querySelector("#pills-page2 #submit_store").classList.add("d-none")
    d.querySelector("#pills-page2 #submit_update").classList.remove("d-none")
    //submit_update
    //submit_store
    let item = first( get_one(model,'id',e.target.dataset[item_id]) )
    //console.log(useState[useStateKey])
    d.querySelector(`#pills-page2 input[name='value']`).value=item['value']
    d.querySelector(`#pills-page2 input[name='value2']`).value=item['value2']
    d.querySelector(`#pills-page2 input[name='value4']`).value=item['value4']
    d.querySelector(`#pills-page2 textarea[name='value3']`).value=item['value3']
    useState[useStateKey]['value']=item['value']
    useState[useStateKey]['value2']=item['value2']
    useState[useStateKey]['value3']=item['value3']
    useState[useStateKey]['value4']=item['value4']
    useState[useStateKey][item_id]=item['id']
    useState[useStateKey][item_num]=item[item_num]
    useState[useStateKey]['user_cita_id']=item['user_cita_id']
    useState[useStateKey]['user_id']=item['user_id']

    console.log(item)
    console.log(useState[useStateKey])
}
let init = (e)=>{
    useState[ useStateKey ]['user_id'] =  e.target.dataset.user_id_paciente
    useState[ useStateKey ]['user_cita_id'] = e.target.dataset.user_cita_id
    let $modal = d.querySelector(`#modelId`)
        $modal.querySelector(".modal-dialog").classList.remove("modal-lg","modal-sm")
        $modal.querySelector(".modal-dialog").classList.add("modal-lg")
        $modal.querySelector(".modal-body").innerHTML = null

        $("#modelId").modal("show")

    let $html = entById('artefacto_0026').content.cloneNode(true)

        $html.querySelector('.item-title').textContent="Récipe"
        $html.querySelector('.item-counter').textContent= "#"+(totalItems()+1)
        $html.querySelector('.item-create-name').textContent="Añadir Medicamento"
        $html.querySelector('.item-table-column-name').textContent="Datos del récipe"
        $html.querySelector('.item-table2-column-name').textContent="Medicamento"


        $html.querySelector('#item_create').dataset.user_id_paciente = useState[ useStateKey ]['user_id']
        $html.querySelector('#item_create').dataset.user_cita_id = useState[ useStateKey ]['user_cita_id']
        $html.querySelector('#item_create span').dataset.user_id_paciente = useState[ useStateKey ]['user_id']
        $html.querySelector('#item_create span').dataset.user_cita_id = useState[ useStateKey ]['user_cita_id']




        //EVENTS
        $html.querySelector(`#pills-page2`).addEventListener("click", function(e){
            e.preventDefault()
            if(e.target.matches(".btn-index")){
                $('#pills-page1-tab').tab('show')
                $modal.querySelector('.item-counter').classList.add("d-none")
                list_index()
            }
        })
        $html.querySelector('#item_create').addEventListener("click", function(e){
            create(e)
        })
        $html.querySelector(`#pills-page1 #table_index`).addEventListener("click", function(e){
            e.preventDefault()
            if(e.target.matches(".btn-show")){
                show(e)
            }
            if(e.target.matches(".btn-delete")){
                handleDestroy(e)
            }
            if(e.target.matches(".btn-imprimir_color") || e.target.matches(".btn-imprimir_bw")){
                print_pdf(e)
            }
            if(e.target.matches(".btn-whatsapp_color") || e.target.matches(".btn-whatsapp_bw")){
                compartir_ws(e)
            }
            if(e.target.matches(".btn-email_color") || e.target.matches(".btn-email_bw")){
                compartir_email(e)
            }
        })
        $html.querySelector(`#pills-page2 #table_create`).addEventListener("click", function(e){
            if(e.target.matches(".btn-delete")){
                handleDestroy(e)
            }
            if(e.target.matches(".btn-edit")){
                handleEdit(e)
            }
        })
        $html.querySelector(".btn-add").addEventListener("click",async function(){
            if( formValidate() ){
                d.querySelector("#pills-page2 .overlay").classList.remove(`d-none`)
                try {
                    let resultset = await store()
                        if( resultset !== null ){
                            add_row(
                                model,
                                resultset,
                                "first"
                            )
                            let items = useState[ model ].filter(x=> equalsInt(x.user_cita_id, resultset.user_cita_id ) && equalsInt(x[item_num], resultset[item_num] ))
                            list(items)
                            clearFormCreate()
                            citaTotalItems( useState[ useStateKey ]['user_cita_id'] )
                            d.querySelector("#pills-page2 .overlay").classList.add(`d-none`)
                        }
                } catch (error) {
                    console.log(error)
                    d.querySelector("#pills-page2 .overlay").classList.add(`d-none`)
                }

            }
        })
        $html.querySelector(".btn-update").addEventListener("click",async function(){
            if( formValidate() ){
                d.querySelector("#pills-page2 .overlay").classList.remove(`d-none`)
                try {
                    console.log("SI - ACTUALIZAR --> ",useStateKey)
                    let resultset = await update(useState[ useStateKey ]['recipe_id'])
                        if( resultset !== null ){
                            update_row({
                                "attr":model,
                                "key":'id',
                                "value":useState[ useStateKey ][item_id],
                                "resultset":resultset
                            })
                            let items = useState[ model ].filter(x=> equalsInt(x.user_cita_id, resultset.user_cita_id ) && equalsInt(x[item_num], resultset[item_num] ))
                            list(items)
                            clearFormCreate()
                            citaTotalItems( useState[ useStateKey ]['user_cita_id'] )
                            d.querySelector("#pills-page2 .overlay").classList.add(`d-none`)
                        }
                } catch (error) {
                    console.log(error)
                    d.querySelector("#pills-page2 .overlay").classList.add(`d-none`)
                }

            }
        })
        $modal.querySelector('.modal-body').append($html)


        list_index()




}
export let index = (e)=>{
    init(e)

}

