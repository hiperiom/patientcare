import { $qsa,$qs,byId, selectOptions, imagePreview, $select, update_row, is_null, is_undefined } from '../../helpers/helpers.js'
import {index as CatUserEstado_index} from '../catalogs/cat_estado.js'
import {index as CatUserMunicipio_index} from '../catalogs/cat_municipio.js'
import {index as CatCentroSalud_index} from '../catalogs/cat_centro_salud.js'
import {index as CatEspecialidad_index} from '../catalogs/cat_especialidad_medica.js'
import { enrutador } from './medico_home.js'
import * as ComponentAgenda from '../agenda/agenda.js'
import * as ComponentMedicoHome from './medico_home.js'
import * as Componentmedico from '../../component/medico/medico.js'

let d = document

export let get_all = (attr) => {
        return useState[attr]
    }
export let get_by = (attr,key,value) => {
        return useState[attr].filter(item=> equalsInt(item[key],value) )
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
    }
let create_fields_validation= async ($tab)=>{

        let input = $tab.querySelector(`input[name='cedula']`)
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
            input = $tab.querySelector(`input[name='email']`)
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
            input = $tab.querySelector(`input[name='nombres']`)
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
            input = $tab.querySelector(`input[name='apellidos']`)
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
            input = $tab.querySelector(`input[name='fnacimiento']`)
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
            input = $tab.querySelector(`input[name='telefono_movil']`)
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
            input = $tab.querySelector(`select[name='cat_estado_id']`)
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
            input = $tab.querySelector(`select[name='cat_municipio_id']`)

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
            input = $tab.querySelector(`input[name='description']`)
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
            input = $tab.querySelector(`input[name='domicilio']`)
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
            input = $(".cat_especialidad_id").select2('val');
            if (input.length===0) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "Seleccione al menos una especialidad.",
                        didClose: () => {
                            setTimeout(() => {
                                $(".select2-cat_especialidad_id").addClass("border").addClass("border-danger")
                                $qs("select[name='cat_especialidad_id']").focus()
                            } , 110);
                        }
                    })
                return false
            }else{
                $(".select2-cat_especialidad_id").removeClass("border").removeClass("border-danger")
            }
            input = $tab.querySelector(`input[name='colegio_medico']`)
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
            input = $tab.querySelector(`input[name='mpps']`)
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
            input = $tab.querySelectorAll(`.input-centro-salud`)
            let counter = 0
                input.forEach(centro_salud=>{
                    if (centro_salud.checked) {
                        counter++
                    }
                })
                if (counter === 0) {

                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "Al menos un centro de salud debe estar seleccionado.",
                        didClose: () => {
                            setTimeout(() => input[0].focus() , 110);
                        }
                    })
                return false
            }


        return true
    }
let saveDataForm = (e)=>{

        if (
                e.target?.matches("input") ||
                e.target?.matches("textarea") ||
                e.target?.matches("select")
            ) {
            if (useState['formCreateMedico'].hasOwnProperty(e.target.name)) {
                useState['formCreateMedico'][e.target.name] = e.target.value
                if ("telefono_movil" === e.target.name) {
                    useState['formCreateMedico'][e.target.name] = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                }
                console.log(useState['formCreateMedico'])
            }
        }
        if (e.target?.matches(".select2") ) {
            if (useState['formCreateMedico'].hasOwnProperty(e.target.name)) {
                useState['formCreateMedico'][e.target.name] = e.target.options[e.target.selectedIndex].value
            }
            console.log(useState['formCreateMedico'])
        }
        if (e.target?.matches("input[type='checkbox']") ) {
            useState['formCreateMedico']['centro_salud_id']=[]
            $qsa(`.input-centro-salud`).forEach(centro_salud=>{
                if (centro_salud.checked) {
                    useState['formCreateMedico'][e.target.name].push( parseInt(centro_salud.value) );
                }
            })
            console.log(useState['formCreateMedico'])
        }

    }
let row_list_centros_salud = (data)=>{
    let check = data.id === 1 ? true : false;
        return /*html*/ `
            <tr>
                <td scope="row">
                    <input type="checkbox" checked="${check}" class="form-control input-centro-salud" value="${data.id}" name="centro_salud_id">
                </td>
                <td>
                    ${data.description}
                </td>
            </tr>
        `
    }
let list_centros_salud = ()=>{
    let $html = $qs(`#list_centros_salud tbody`)
        $html.innerHTML= null
        // useState["formCreateMedico"]["centro_salud_id"] = [1] // para que quede seleccionado CMDLT por defecto
        useState['cat_centro_salud'].forEach(centro_salud =>{
            $html.insertAdjacentHTML("afterbegin", row_list_centros_salud(centro_salud) )
        })
}
let create_field_config = async ()=>{
        useState['cat_centro_salud'] = await CatCentroSalud_index()
        useState['cat_especialidad'] = await get("/consultaexterna/cat_user_especialidad/index") //CatEspecialidad_index()
        useState['cat_estado']       = await CatUserEstado_index()
        useState['cat_municipio']    = await CatUserMunicipio_index()

        telefonoConfig("#telefono_movil")

        entById("cat_especialidad_id").append( $select(useState['cat_especialidad']) )
        entById("cat_estado_id").innerHTML= selectOptions(useState['cat_estado'], 14)
        entById("cat_municipio_id").innerHTML= selectOptions( useState['cat_municipio'].filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        entById("description").value="Caracas"
        list_centros_salud()
    }
export let create = async ($App)=>{
        $App.innerHTML= null
        $App.scrollTop = 0;
    let $form = entById("artefacto_0035").content.cloneNode(true)

        $App.append( $form )
        d.querySelector(".cat-cita-status-title").textContent="Nuevo Medico"
        //console.log($App)


        //configuracion predefinida para el formulario
        await create_field_config()

        //eventos
        $App.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        $(".cat_especialidad_id").on("change", function (e) {
            let $selected = $(".cat_especialidad_id").select2('val');
                useState['formCreateMedico']['cat_user_especialidad_id']= $selected.map(especialidad=>parseInt(especialidad))
        });
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        entById("firma").addEventListener("change",e=>{
            imagePreview(e,"firmaPreview")
        })
        entById("sello").addEventListener("change",e=>{
            imagePreview(e,"selloPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
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
        //console.log(useState)
        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation($App)) {
                $App.querySelector(`.overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreateMedico']) {
                        if (Object.hasOwnProperty.call(useState['formCreateMedico'], key)) {
                            let element = useState['formCreateMedico'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                let file4 = document.getElementById(`firma`).files[0];
                let file5 = document.getElementById(`sello`).files[0];
                    formData.append("imagen", !is_undefined(file1) ? file1 : "" )
                    formData.append("imgDocIdentidad", !is_undefined(file2) ? file2 : "" )
                    formData.append("imgSoyChacao", !is_undefined(file3) ? file3 : "" )
                    formData.append("firma", !is_undefined(file4) ? file4 : "" )
                    formData.append("sello", !is_undefined(file5) ? file5 : "" )
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/user/medico/home/consultaExterna/store",formData)
                    $response.then(response=>{
                        if($response){
                            $App.querySelector(`.overlay`).classList.add("d-none")
                            Swal.fire({
                                icon: 'success',
                                title: '¡Registro creado!',
                                text: 'El Médico se ha creado correctamente.',
                                confirmButtonColor: '#2FA600',
                                confirmButtonText: 'Crear agenda',
                                denyButtonColor: '#185BA9',
                                denyButtonText: `Ok`,

                                showConfirmButton: true,
                                showDenyButton: true,

                              }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    d.querySelector('body').classList.add("sidebar-collapse")
                                    ComponentAgenda.create(useState,false)
                                } else if (result.isDenied) {
                                    let tab = "#tab_paciente_create"
                                    enrutador(tab)
                                    create(d.querySelector(`${tab} #form_nuevo_paciente`))
                                }
                            })
                            /* Toast.fire({
                                icon: 'success',
                                title: '¡Registro creado!',
                                text: 'El Médico se ha creado correctamente.',
                                didClose: () => {
                                    let tab = "#tab_paciente_create"
                                        enrutador(tab)
                                        create(d.querySelector(`${tab} #form_nuevo_paciente`))
                                }
                            }).then(result=>{

                                if (result.isConfirmed) {
                                    let tab = "#tab_paciente_create"
                                        enrutador(tab)
                                        create(d.querySelector(`${tab} #form_nuevo_paciente`))
                                }
                            }) */


                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model =  get_by("cat_municipio","cat_estado_id",e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }
export let create_emergencia = async ()=>{
    let $App = d.querySelector("#App")
        $App.innerHTML= null
        $App.scrollTop = 0;
    let $form = entById("artefacto_0035").content.cloneNode(true)

        $App.append( $form )
        /* d.querySelector(".cat-cita-status-title").textContent="Nuevo Medico" */



        //configuracion predefinida para el formulario
        await create_field_config()

        //eventos
        $App.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        $(".cat_especialidad_id").on("change", function (e) {
            let $selected = $(".cat_especialidad_id").select2('val');
                useState['formCreateMedico']['cat_user_especialidad_id']= $selected.map(especialidad=>parseInt(especialidad))
        });
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        entById("firma").addEventListener("change",e=>{
            imagePreview(e,"firmaPreview")
        })
        entById("sello").addEventListener("change",e=>{
            imagePreview(e,"selloPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
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
        //console.log(useState)
        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation($App)) {
                $App.querySelector(`.overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreateMedico']) {
                        if (Object.hasOwnProperty.call(useState['formCreateMedico'], key)) {
                            let element = useState['formCreateMedico'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                let file4 = document.getElementById(`firma`).files[0];
                let file5 = document.getElementById(`sello`).files[0];
                    formData.append("imagen", !is_undefined(file1) ? file1 : "" )
                    formData.append("imgDocIdentidad", !is_undefined(file2) ? file2 : "" )
                    formData.append("imgSoyChacao", !is_undefined(file3) ? file3 : "" )
                    formData.append("firma", !is_undefined(file4) ? file4 : "" )
                    formData.append("sello", !is_undefined(file5) ? file5 : "" )
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/user/medico/home/consultaExterna/store",formData)
                    $response.then(response=>{
                        if($response){
                            $App.querySelector(`.overlay`).classList.add("d-none")

                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro creado!',
                                text: 'El Médico se ha creado correctamente.',
                                didClose: () => {
                                    setTimeout(() => window.location = "/consultaexterna/medico/index_medicos", 110);
                                }
                            }).then(result=>{

                                if (result.isConfirmed) {
                                    setTimeout(() => window.location = "/consultaexterna/medico/index_medicos", 110);
                                }
                            })


                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model =  get_by("cat_municipio","cat_estado_id",e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }

export let create_admin = async ()=>{
    $('[data-widget="pushmenu"]').PushMenu('toggle')
    let $App = d.querySelector("#App")
        $App.innerHTML= null
        $App.scrollTop = 0;
    let $form = entById("artefacto_0035").content.cloneNode(true)

        $App.append( $form )
        /* d.querySelector(".cat-cita-status-title").textContent="Nuevo Medico" */



        //configuracion predefinida para el formulario
        await create_field_config()

        //eventos
        $App.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        $(".cat_especialidad_id").on("change", function (e) {
            let $selected = $(".cat_especialidad_id").select2('val');
                useState['formCreateMedico']['cat_user_especialidad_id']= $selected.map(especialidad=>parseInt(especialidad))
        });
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        entById("firma").addEventListener("change",e=>{
            imagePreview(e,"firmaPreview")
        })
        entById("sello").addEventListener("change",e=>{
            imagePreview(e,"selloPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/user_profile/cedulaExiste",formData)
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
            let existeModel = await post("/user/emailExist",formData)
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
        //console.log(useState)
        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation($App)) {
                $App.querySelector(`.overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreateMedico']) {
                        if (Object.hasOwnProperty.call(useState['formCreateMedico'], key)) {
                            let element = useState['formCreateMedico'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                let file4 = document.getElementById(`firma`).files[0];
                let file5 = document.getElementById(`sello`).files[0];
                    formData.append("imagen", !is_undefined(file1) ? file1 : "" )
                    formData.append("imgDocIdentidad", !is_undefined(file2) ? file2 : "" )
                    formData.append("imgSoyChacao", !is_undefined(file3) ? file3 : "" )
                    formData.append("firma", !is_undefined(file4) ? file4 : "" )
                    formData.append("sello", !is_undefined(file5) ? file5 : "" )
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/user/medico/home/consultaExterna/store",formData)
                    $response.then(response=>{
                        if($response){
                            $App.querySelector(`.overlay`).classList.add("d-none")

                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro creado!',
                                text: 'El Médico se ha creado correctamente.'

                            }).then(result=>{

                                if (result.isConfirmed) {
                                    index_admin()
                                }
                            })


                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model =  get_by("cat_municipio","cat_estado_id",e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }
export let edit_admin = async (user_id)=>{
        //init()
       // console.log("user_id->",user_id)

    let $App = d.querySelector(`#App`)
        $App.innerHTML= null
        $App.scrollTop = 0;
    let $form = entById("artefacto_0035").content.cloneNode(true)
        $form.querySelector("#btn_regresar").classList.remove("d-none")
        $form.querySelector(".btn-medico-index").addEventListener("click",function(e){
            e.preventDefault()
            Componentmedico.index_admin()
        })
    /**inicio */
    //let paciente =first(  useState['users'].filter(x=> equalsInt(x.user_id, user_id) ) )

    let medico = useState['medicos'].find(x=> equalsInt(x.user_id, user_id) )
        console.log("medico", medico)

        $App.append( $form )
        //d.querySelector(".cat-cita-status-title").textContent="Editar Medico"
        $App.querySelector("h3").textContent="Editar Médico"
        //configuracion predefinida para el formulario
        await create_field_config()

        //5 imagenes
        if (!is_null( medico.imagen ) ) {
            d.querySelector("#userImagePreview").src=medico.imagen
        }
        if (!is_null( medico.imgDocIdentidad ) ) {
            d.querySelector("#imgDocIdentidadPreview").src=medico.imgDocIdentidad
        }
        if (!is_null( medico.firma ) ) {
            d.querySelector("#firmaPreview").src=medico.firma
        }
        if (!is_null( medico.sello ) ) {
            d.querySelector("#selloPreview").src=medico.sello
        }
        // if (!is_null( medico.imgSoyChacao ) ) {
        //     d.querySelector("#imgSoyChacaoPreview").src=medico.imgSoyChacao
        // }

        useState['formCreateMedico']['user_id']                  = user_id
        useState['formCreateMedico']['email']                    = medico.email
        useState['formCreateMedico']['cedula']                   = medico.cedula_unformatted
        useState['formCreateMedico']['nombres']                  = medico.nombres
        useState['formCreateMedico']['apellidos']                = medico.apellidos
        useState['formCreateMedico']['genero']                   = medico.genero.toLowerCase()
        useState['formCreateMedico']['fnacimiento']              = medico.fnacimiento
        useState['formCreateMedico']['telefono_movil']           = medico.telefono_movil
        useState['formCreateMedico']['description']              = medico['user_cuest_direction_description']
        useState['formCreateMedico']['domicilio']                = medico['user_cuest_direction_domicilio']
        useState['formCreateMedico']['tarjeta_soy_chacao']       = medico.tarjeta_soy_chacao
        useState['formCreateMedico']['centro_salud_id']          = medico['centros_salud_asignado'].map(x=>x['centro_salud_id'])
        useState['formCreateMedico']['user_especialidad_id']     = ( medico['especialidad'].length > 0 ) ? medico['especialidad'].map(x=>x['cat_user_especialidad_id'] ) : [68]
        useState['formCreateMedico']['cat_user_especialidad_id'] = ( medico['especialidad'].length > 0 ) ? medico['especialidad'].map(x=>x['cat_user_especialidad_id'] ) : [68]
        useState['formCreateMedico']['cat_medico_posicion_id']   = medico.cat_user_medico_posicion_id
        useState['formCreateMedico']['equipo_salud_id']          = medico.cat_user_equipo_salud_id
        useState['formCreateMedico']['prefijo']                  = medico.prefijo
        useState['formCreateMedico']['mpps']                     = medico.mpps
        useState['formCreateMedico']['colegio_medico']           = medico.colegio_medico
        useState['formCreateMedico']['temp_firma']               = medico.firma
        useState['formCreateMedico']['temp_sello']               = medico.sello
        useState['formCreateMedico']['temp_imgSoyChacao']        = medico.imgSoyChacao
        useState['formCreateMedico']['temp_imgDocIdentidad']     = medico.imgDocIdentidad
        useState['formCreateMedico']['temp_imagen']              = medico.imagen
        useState['formCreateMedico']['cat_estado_id']            = medico.cat_estado_id
        useState['formCreateMedico']['cat_municipio_id']         = medico.cat_municipio_id

        $App.querySelector(`#submit`).innerHTML                             = "Actualizar"
        $App.querySelector(`input[name='email']`).value                     = useState['formCreateMedico']['email']
        $App.querySelector(`input[name='cedula']`).value                    = useState['formCreateMedico']['cedula']
        $App.querySelector(`input[name='nombres']`).value                   = useState['formCreateMedico']['nombres']
        $App.querySelector(`input[name='apellidos']`).value                 = useState['formCreateMedico']['apellidos']
        $App.querySelector(`select[name='genero']`).value                   = useState['formCreateMedico']['genero']
        $App.querySelector(`input[name='fnacimiento']`).value               = fechaInputDate( useState['formCreateMedico']['fnacimiento'] )
        $App.querySelector(`input[name='telefono_movil']`).value            = useState['formCreateMedico']['telefono_movil']
        $App.querySelector(`input[name='description']`).value               = useState['formCreateMedico']['description']
        $App.querySelector(`input[name='domicilio']`).value                 = useState['formCreateMedico']['domicilio']
        $App.querySelector(`input[name='tarjeta_soy_chacao']`).value        = !is_null(useState['formCreateMedico']['tarjeta_soy_chacao']) ? useState['formCreateMedico']['tarjeta_soy_chacao'] :''
        $App.querySelector(`select[name='cat_especialidad_id']`).value      = !is_null(useState['formCreateMedico']['cat_user_especialidad_id']) ? useState['formCreateMedico']['cat_user_especialidad_id'] :''
        $App.querySelector(`select[name='prefijo']`).value                  = !is_null(useState['formCreateMedico']['prefijo']) ? useState['formCreateMedico']['prefijo'] :''
        $App.querySelector(`select[name='cat_user_equipo_salud_id']`).value = !is_null(useState['formCreateMedico']['equipo_salud_id']) ? useState['formCreateMedico']['equipo_salud_id'] :''
        $App.querySelector(`select[name='cat_medico_posicion_id']`).value   = !is_null(useState['formCreateMedico']['cat_medico_posicion_id']) ? useState['formCreateMedico']['cat_medico_posicion_id'] :''
        $App.querySelector(`input[name='colegio_medico']`).value            = !is_null(useState['formCreateMedico']['colegio_medico']) ? useState['formCreateMedico']['colegio_medico']:''
        $App.querySelector(`input[name='mpps']`).value                      = !is_null(useState['formCreateMedico']['mpps']) ? useState['formCreateMedico']['mpps'] :''


        //init select2 set values
        $('#cat_especialidad_id').val( useState['formCreateMedico']['cat_user_especialidad_id'] ) ;
        $('#cat_especialidad_id').trigger('change');
        //end

    let centro_salud_id = medico['centros_salud_asignado'].map(x=>x['centro_salud_id'])
        //console.log(centro_salud_id)
        $App.querySelectorAll(`input[name='centro_salud_id']`).forEach(x=>{
            //console.log(centro_salud_id,Number(x.value) )
            if ( centro_salud_id.includes( Number(x.value) )) {
                x.checked=true
            }
        })




        entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, useState['formCreateMedico']['cat_estado_id'])
        entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,useState['formCreateMedico']['cat_estado_id'] ) ), useState['formCreateMedico']['cat_municipio_id'] )


        /**fin */


        //console.log(useState['formCreateMedico'])
        //eventos

        $App.querySelector("form").addEventListener("change",e=>{

            saveDataForm(e)
        })
        $(".cat_especialidad_id").on("change", function (e) {
            let $selected = $(".cat_especialidad_id").select2('val');
                useState['formCreateMedico']['cat_user_especialidad_id']= $selected.map(especialidad=>parseInt(especialidad))
        });
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        entById("firma").addEventListener("change",e=>{
            imagePreview(e,"firmaPreview")
        })
        entById("sello").addEventListener("change",e=>{
            imagePreview(e,"selloPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
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
        //console.log(useState)
        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation($App)) {
                $App.querySelector(`.overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreateMedico']) {
                        if (Object.hasOwnProperty.call(useState['formCreateMedico'], key)) {
                            let element = useState['formCreateMedico'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                let file4 = document.getElementById(`firma`).files[0];
                let file5 = document.getElementById(`sello`).files[0];
                    formData.append("imagen", !is_undefined(file1) ? file1 : "" )
                    formData.append("imgDocIdentidad", !is_undefined(file2) ? file2 : "" )
                    formData.append("imgSoyChacao", !is_undefined(file3) ? file3 : "" )
                    formData.append("firma", !is_undefined(file4) ? file4 : "" )
                    formData.append("sello", !is_undefined(file5) ? file5 : "" )
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/user/medico/home/consultaExterna/update",formData)
                    $response.then(response=>{
                        if($response){
                            console.log(useState['medicos'])
                            $App.querySelector(`.overlay`).classList.add("d-none")
                            let medico_key = useState['medicos'].findIndex(x=>Number(x['user_id']) === Number(useState['formCreateMedico']['user_id']) )
                                useState['medicos'][medico_key] = response
                                /* update_row({
                                    "attr":'medicos',
                                    "key":'user_id',
                                    "value":user_id,
                                    "resultset":response
                                }) */
                                console.log(useState['medicos'])
                                Toast.fire({
                                    icon: 'success',
                                    title: '¡Registro Actualizado!',
                                    text: 'El Médico se ha actualizado correctamente.',
                                /*   didClose: () => {
                                        edit( user_id )
                                    } */
                                }).then(result=>{

                                    if (result.isConfirmed) {
                                        index_admin()
                                    }
                                })


                        }
                    })
            }

        })
        $('#cat_especialidad_id').on('select2:unselect', async function (e) {
            console.log(e.params.data.id)
            let model = await get(location.origin+"/consultaexterna/user/medico/especialidad/destroy2/"+ e.params.data.id+"/"+user_id)
            let user_id_medico = useState['formCreateMedico']['user_id']
            let index = useState['medicos'].findIndex(medico=>equalsInt(medico['user_id'],user_id_medico))
                console.log("user_id_medico: " + user_id_medico)
                console.log("index: " + index)
                useState['medicos'][index]['especialidad'] = useState['medicos'][index]['especialidad'].filter(especialidad=>especialidad['user_especialidad_id'] !== user_especialidad_id)

        });
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model =  get_by("cat_municipio","cat_estado_id",e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }
export let edit = async (user_id)=>{
        init()


    let $App = d.querySelector(`${useState['tab']} #App`)
        $App.innerHTML= null
        $App.scrollTop = 0;
    let $form = entById("artefacto_0035").content.cloneNode(true)
    /**inicio */
    //let paciente =first(  useState['users'].filter(x=> equalsInt(x.user_id, user_id) ) )
    console.log("user_id->",user_id)

    let medico = useState['medicos'].find(x=> equalsInt(x.user_id, user_id) )
        if (is_undefined(medico)) {
            let searchMedico = first(await get(location.origin+"/consultaexterna/user/medico/getMedico/"+user_id))
            useState['medicos'].push(searchMedico)
            console.log(useState['medicos'])
        }
        console.log("🚀 ~ file: medico.js ~ line 655 ~ edit ~ medico", medico)

        $App.append( $form )
        d.querySelector(".cat-cita-status-title").textContent="Editar Medico"
        $App.querySelector("h3").textContent="Editar Médico"
        //configuracion predefinida para el formulario
        await create_field_config()

        //5 imagenes
        console.log(`medico --> ${medico}`)
        if (!is_null( medico.imagen ) ) {
            d.querySelector("#userImagePreview").src=medico.imagen
        }
        if (!is_null( medico.imgDocIdentidad ) ) {
            d.querySelector("#imgDocIdentidadPreview").src=medico.imgDocIdentidad
        }
        if (!is_null( medico.firma ) ) {
            d.querySelector("#firmaPreview").src=medico.firma
        }
        if (!is_null( medico.sello ) ) {
            d.querySelector("#selloPreview").src=medico.sello
        }
        if (!is_null( medico.imgSoyChacao ) ) {
            d.querySelector("#imgSoyChacaoPreview").src=medico.imgSoyChacao
        }

        useState['formCreateMedico']['user_id']=user_id
        useState['formCreateMedico']['email']=medico.email
        useState['formCreateMedico']['cedula']=medico.cedula_unformatted
        useState['formCreateMedico']['nombres']=medico.nombres
        useState['formCreateMedico']['apellidos']=medico.apellidos
        useState['formCreateMedico']['genero']=medico.genero
        useState['formCreateMedico']['fnacimiento']=medico.fnacimiento
        useState['formCreateMedico']['telefono_movil']=medico.telefono_movil
        useState['formCreateMedico']['description']=medico.description
        useState['formCreateMedico']['domicilio']=medico.domicilio
        useState['formCreateMedico']['tarjeta_soy_chacao']=medico.tarjeta_soy_chacao
        useState['formCreateMedico']['centro_salud_id']=medico.centro_salud_id.split(",")


        useState['formCreateMedico']['user_especialidad_id']= medico.user_especialidad_id
        useState['formCreateMedico']['cat_user_especialidad_id']= medico.cat_user_especialidad_id
        useState['formCreateMedico']['cat_medico_posicion_id']= medico.posicion_id
        useState['formCreateMedico']['equipo_salud_id']= medico.equipo_salud_id
        useState['formCreateMedico']['prefijo']= medico.prefijo
        useState['formCreateMedico']['mpps']=medico.mpps
        useState['formCreateMedico']['colegio_medico']=medico.colegio_medico


        $App.querySelector(`#submit`).innerHTML="Actualizar"
        $App.querySelector(`input[name='email']`).value= medico.email
        $App.querySelector(`input[name='cedula']`).value= medico.cedula_unformatted
        $App.querySelector(`input[name='nombres']`).value= medico.nombres
        $App.querySelector(`input[name='apellidos']`).value= medico.apellidos
        $App.querySelector(`select[name='genero']`).value= medico.genero
        $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( medico.fnacimiento )
        $App.querySelector(`input[name='telefono_movil']`).value=  medico.telefono_movil
        $App.querySelector(`input[name='description']`).value= medico.description
        $App.querySelector(`input[name='domicilio']`).value= medico.domicilio

        $App.querySelector(`input[name='tarjeta_soy_chacao']`).value= !is_null(medico.tarjeta_soy_chacao) ? medico.tarjeta_soy_chacao :''

        useState['formCreateMedico']['temp_firma']=medico.firma
        useState['formCreateMedico']['temp_sello']=medico.sello
        useState['formCreateMedico']['temp_imgSoyChacao']=medico.imgSoyChacao
        useState['formCreateMedico']['temp_imgDocIdentidad']=medico.imgDocIdentidad
        useState['formCreateMedico']['temp_imagen']=medico.imagen

        $App.querySelector(`select[name='cat_especialidad_id']`).value= !is_null(medico.cat_user_especialidad_id) ? medico.cat_user_especialidad_id :''
        $App.querySelector(`select[name='prefijo']`).value= !is_null(medico.prefijo) ? medico.prefijo :''
        $App.querySelector(`select[name='cat_user_equipo_salud_id']`).value= !is_null(medico.equipo_salud_id) ? medico.equipo_salud_id :''
        $App.querySelector(`select[name='cat_medico_posicion_id']`).value= !is_null(medico.posicion_id) ? medico.posicion_id :''
        $App.querySelector(`input[name='colegio_medico']`).value= !is_null(medico.colegio_medico) ? medico.colegio_medico :''
        $App.querySelector(`input[name='mpps']`).value= !is_null(medico.mpps) ? medico.mpps :''

        //init select2 set values
        $('#cat_especialidad_id').val(medico.user_especialidad_id.split(","));
        $('#cat_especialidad_id').trigger('change');
        //end

    let centro_salud_id = medico.centro_salud_id.split(",")
        console.log(centro_salud_id)
        $App.querySelectorAll(`input[name='centro_salud_id']`).forEach(x=>{
            //console.log(centro_salud_id.includes( parseInt(x.value) ) )
            if ( centro_salud_id.includes( x.value )) {
                x.checked=true
            }
        })



        entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, medico.cat_estado_id)
        entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,medico.cat_estado_id ) ), medico.cat_municipio_id )


        /**fin */


        //console.log(useState['formCreateMedico'])
        //eventos

        $App.querySelector("form").addEventListener("change",e=>{

            saveDataForm(e)
        })
        $(".cat_especialidad_id").on("change", function (e) {
            let $selected = $(".cat_especialidad_id").select2('val');
                useState['formCreateMedico']['cat_user_especialidad_id']= $selected.map(especialidad=>parseInt(especialidad))
        });
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        entById("firma").addEventListener("change",e=>{
            imagePreview(e,"firmaPreview")
        })
        entById("sello").addEventListener("change",e=>{
            imagePreview(e,"selloPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
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
        //console.log(useState)
        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation($App)) {
                $App.querySelector(`.overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreateMedico']) {
                        if (Object.hasOwnProperty.call(useState['formCreateMedico'], key)) {
                            let element = useState['formCreateMedico'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                let file4 = document.getElementById(`firma`).files[0];
                let file5 = document.getElementById(`sello`).files[0];
                    formData.append("imagen", !is_undefined(file1) ? file1 : "" )
                    formData.append("imgDocIdentidad", !is_undefined(file2) ? file2 : "" )
                    formData.append("imgSoyChacao", !is_undefined(file3) ? file3 : "" )
                    formData.append("firma", !is_undefined(file4) ? file4 : "" )
                    formData.append("sello", !is_undefined(file5) ? file5 : "" )
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/user/medico/home/consultaExterna/update",formData)
                    $response.then(response=>{
                        if($response){
                            $App.querySelector(`.overlay`).classList.add("d-none")
                            update_row({
                                "attr":'medicos',
                                "key":'user_id',
                                "value":user_id,
                                "resultset":response
                            })

                            Toast.fire({
                                icon: 'success',
                                title: '¡Registro Actualizado!',
                                text: 'El Médico se ha actualizado correctamente.',
                              /*   didClose: () => {
                                    edit( user_id )
                                } */
                            }).then(result=>{

                                if (result.isConfirmed) {
                                    console.log(useState['medicos'])
                                    edit( user_id )
                                }
                            })


                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model =  get_by("cat_municipio","cat_estado_id",e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))

        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }
export let store = async (item_id) => {

    }
export let show = async (item_id) => {

    }
export let update = async (item_id) => {

    }
export let destroy = async (item_id) => {

    }
function getUniqueTurnosWithDate(json) {
    const turnos = [];

    for (const mes of json) {
        //console.log( mes )
    for (const week of Object.values(mes.weeks)) {
        if (!is_null(week)) {
            for (const dia of week) {
                if (dia.turno) {
                let existPrivada = dia.hours.some(hora=>hora.visibilidad==="privada")
                    dia['turno']['existPrivada']=existPrivada;
                    dia['turno']['total_pacientes_por_horas']=dia.total_pacientes_por_horas;
                const turno = { ...dia.turno };
                    //console.log(turno)
                    turno.day_name = dia.day;
                    turno.day_value = dia.day_value;
                const exists = turnos.some((t) => {
                    return (
                        t.horario === turno.horario &&
                        t.I === turno.I &&
                        t.F === turno.F &&
                        t.day_name === turno.day_name &&
                        t.day_value === turno.day_value
                    );
                });
                if (!exists) {
                    turnos.push(turno);
                }
                }
            }
        }

    }
    }

    return turnos;
}
let diaFormato = (dia,dias_calendario)=>{
    let dias_semana = {
            "1":"Lunes",
            "2":"Martes",
            "3":"Miércoles",
            "4":"Jueves",
            "5":"Viernes",
            "6":"Sabado",
            "7":"Domingo",
        }
        //if (dias_calendario['existPrivada']) {
            console.log(dias_calendario);
        //}

        //
    let dia_description = dias_semana[ String(dia) ].slice(0,3).toUpperCase()
    let temp_dia = dias_calendario.find(d=>equalsInt(d['day_value'],dia )) //temp_result.find(x=> equalsInt( x['dia'] , dia ) )


    let bgColorClass =""
         if(temp_dia?.horario==="Mañana"){
            bgColorClass = "dia-horario-dia"
        }
        if(temp_dia?.horario==="Tarde"){
            bgColorClass = "dia-horario-tarde"
        }
        if(temp_dia?.horario==="Todo el dia"){
            bgColorClass = "dia-horario-todo-el-dia"
        }
       //
    //let existeDia = dias_calendario.find(d=>equalsInt(d['day_value'],dia ))  // Array.from( new Set( temp_result.map(x=> x['dia'] ) ) ).includes( dia )
    let ocultar = false
        if (!is_undefined(temp_dia)) {
            ocultar = true
        }
    return `
        <div ${!ocultar ? '': "title='"+temp_dia?.horario+"'"} class="p-1 ${bgColorClass} flex-fill ${dia < 7 ? 'border-right' : ''}">
            <div class="d-flex text-nowrap">
                <div class="text-center"  title="Pacientes por hora">
                    <i class="${ocultar ? '': 'd-none'} pc-paciente text-success nav-icon"></i><b class="${ocultar ? '': 'd-none'}">${temp_dia?.total_pacientes_por_horas}</b>
                </div>
                <div class="flex-grow-1">
                    <i title="Posee horas privadas" data-visibilidad="privada" class="${(temp_dia?.existPrivada)?'':'d-none'} fas fa-lock" style="color:#957878"></i> <b>${ dia_description }</b>
                </div>
            </div>
            <div class="d-flex text-nowrap">
                <div class="${ocultar ? '': 'd-none'} text-center">
                    <b title="Inicio" class="text-success">I</b>
                </div>
                <div class="flex-grow-1 ${ocultar ? '': 'd-none'}">
                    ${temp_dia?.I}
                </div>
            </div>
            <div class="d-flex text-nowrap">
                <div class="${ocultar ? '': 'd-none'} text-center">
                    <b title="Fín" class="text-info">F</b>
                </div>
                <div class="flex-grow-1 ${ocultar ? '': 'd-none'}">
                    ${temp_dia?.F}
                </div>
            </div>
        </div>
    `
}
export let index_admin = async (item_id) => {
    $('[data-widget="pushmenu"]').PushMenu('collapse')
    let $template = entById("artefacto_0052").content.cloneNode(true)
    let $App = d.querySelector("#App")
        $App.innerHTML= null
        $App.scrollTop = 0;
        $App.append($template)

        try {
            if(is_empty(useState['medicos'])){
                useState['medicos'] = await get(location.origin+"/consultaexterna/cat/medico/getPersonalSalud");
            }

            // console.log('useState --> ', useState['medicos'])

            if (Object.keys(useState['medicos']).length > 0) {

                $("#index_table_medicos tbody").empty();
                useState['medicos'].map(valueOfElement=>{
// console.log('medico -->',valueOfElement)
                    let {
                            user_medico_activo,
                            centros_salud_asignado,
                            cat_user_type_id,
                            cat_user_type_description,
                            especialidad,
                            agendas,
                            user_id
                        } = valueOfElement;

                    let $agenda = `
                            <div class="d-flex flex-column align-items-center" >
                                <b class="text-danger text-nowrap px-1">
                                    No disponible
                                </b>
                            </div>
                        `;
                        //console.log("agendas",agendas)
                        if (especialidad.length > 0 && cat_user_type_id === 2) {
                                $agenda = "";
                                especialidad.forEach(x=>{
                                    //console.log(x);
                                    let {
                                            user_especialidad_id,
                                            cat_user_especialidad_id,
                                            cat_user_especialidad_image,
                                            cat_user_especialidad_description,
                                        } = x;

                                    let agenda_especialidad = agendas.filter(agendaX=> equalsInt( agendaX['cat_especialidad_id'], cat_user_especialidad_id ))
                                        //console.log("agenda_especialidad",agenda_especialidad);


                                        if (!is_empty( agenda_especialidad ) ) {
                                            agenda_especialidad.forEach(h=>{
                                                let horas = "";
                                                let temp_result =   JSON.parse( h['agenda'] ) ;

                                                let dias_calendario=[]
                                                    if(temp_result.hasOwnProperty("agenda_month")){
                                                        console.log(temp_result['agenda_month']);
                                                        dias_calendario = getUniqueTurnosWithDate(temp_result['agenda_month'])
                                                    }



                                                let dias = [];

                                                    [1,2,3,4,5,6,7].forEach(dia=>{


                                                        //if( !dias.includes( dia['dia'] )){
                                                            //dias.push( dia['dia'] )
                                                            horas += diaFormato(dia,dias_calendario);

                                                        //}
                                                    })

                                                    let centro_salud_description = ""

                                                    if (agendas.length > 0) {
                                                        centro_salud_description = agendas.find(agenda=>equalsInt(agenda['cat_especialidad_id'],cat_user_especialidad_id))

                                                        if (centro_salud_description !== undefined) {
                                                            centro_salud_description = centro_salud_description['centro_salud_description']
                                                        }
                                                    }
                                                    //console.log("centro_salud_description",centro_salud_description)
                                                    if (is_undefined(centro_salud_description) ) {
                                                        centro_salud_description ="";
                                                        let centro_sa = centros_salud_asignado
                                                        //console.log("centros_salud_asignado",centros_salud_asignado)
                                                            centro_sa.forEach(x=>{
                                                                let cs_temp = useState['cat_centro_salud'].find(z=> equalsInt(z['centro_salud_id'],x['centro_salud_id']))['centro_salud_especialidades_id']
                                                                //console.log(cs_temp);
                                                                    if (!is_null(cs_temp)) {

                                                                        if (!cs_temp.split(",").map(b=> Number(b)).includes(cat_user_especialidad_id)) {
                                                                            centro_salud_description += x['centro_salud_description']+ " "
                                                                        }
                                                                    }
                                                                //console.log("cs_temp",cs_temp)
                                                            })
                                                            centro_salud_description +=` no posee esta especialidad`


                                                    }

                                                $agenda += `
                                                    <div class="d-flex user_id_medico-${user_id} card-especialidad-${user_especialidad_id} ">
                                                        <div>
                                                            <img src="${location.origin + cat_user_especialidad_image}" style="height: 1.5rem;width:1.5rem;" onerror="reemplaza_imagen(this)">
                                                        </div>
                                                        <div class="flex-fill d-flex flex-column">
                                                            <b class="px-1 ${h['cat_especialidad_id'] == 68 ? 'text-danger': 'text-primary'} text-nowrap">
                                                                <div>
                                                                    ${cat_user_especialidad_description}<br>
                                                                    <b class="p-0 text-secondary text-nowrap" style="font-size:0.8rem;">
                                                                        ${h['centro_salud_description']}
                                                                    </b>
                                                                </div>


                                                            </b>

                                                            <div class="d-flex text-secondary text-right" style="line-height: 1;font-size: 0.8rem;background-color: #f5f5f5; border-radius: 10px 10px 0px 0px;">
                                                                ${horas}
                                                            </div>
                                                        </div>
                                                        <button data-user_id_medico="${user_id}" type="button" data-user_especialidad_id="${user_especialidad_id}" class="btn btn-default btn-especialidad-destroy" style="width: 1.2rem;height: 1.2rem;line-height: 0;padding: 0;" aria-label="Close">
                                                            <i data-user_id_medico="${user_id}" data-user_especialidad_id="${user_especialidad_id}" style="font-size: 0.7rem;"  class="fas fa-times text-secondary btn-especialidad-destroy"></i>
                                                        </button>
                                                    </div>
                                                `;




                                            })


                                        }else{
                                            $agenda += `
                                                <div class="d-flex mb-2 user_id_medico-${user_id} card-especialidad-${user_especialidad_id} ">
                                                    <div>
                                                        <img src="${location.origin + cat_user_especialidad_image}" style="height: 1.5rem;width:1.5rem;" onerror="reemplaza_imagen(this)">
                                                    </div>
                                                    <div class="flex-fill d-flex flex-column">
                                                        <b class="px-1 ${cat_user_especialidad_id == 68 ? 'text-danger': 'text-primary'} text-nowrap">
                                                            <div>
                                                                ${cat_user_especialidad_description}<br>
                                                                <b class="p-0 text-secondary text-nowrap" style="font-size:0.8rem;">

                                                                </b>
                                                            </div>
                                                        </b>
                                                        <div class="d-flex text-secondary text-right" style="line-height: 1;font-size: 0.8rem;background-color: #f5f5f5; border-radius: 10px 10px 0px 0px;">

                                                        </div>
                                                    </div>
                                                    <button data-user_id_medico="${user_id}" type="button" data-user_especialidad_id="${user_especialidad_id}" class="btn btn-default btn-especialidad-destroy" style="width: 1.2rem;height: 1.2rem;line-height: 0;padding: 0;" aria-label="Close">
                                                        <i data-user_id_medico="${user_id}" data-user_especialidad_id="${user_especialidad_id}" style="font-size: 0.7rem;"  class="fas fa-times text-secondary btn-especialidad-destroy"></i>
                                                    </button>
                                                </div>
                                            `;
                                        }





                                })

                        }

                    let fecha_regreso = "";
                    let active = 1;
                        if (user_medico_activo.length > 0) {
                            user_medico_activo = first(user_medico_activo)
                            fecha_regreso = is_null(user_medico_activo['fecha_regreso']) ? "" : user_medico_activo['fecha_regreso']
                            active = user_medico_activo['active']
                            //console.log(user_medico_activo)
                        }


                    $("#index_table_medicos tbody").append( /*html*/`
                        <tr class="${active ? '' : 'bg-gray'}" id="row_${valueOfElement['user_id']}">
                            <td class="p-1">
                                <img id="image-perfil" onerror="reemplaza_imagen(this)" src="${valueOfElement['imagen']}" style="width: 1.5cm;height:1.5cm" class="image-perfil rounded-circle mx-auto d-block" alt="Medic default">
                            </td>
                            <td class="p-1">
                                ${valueOfElement['medico']}
                                <div class="text-${active ? 'white' : 'gray'}" style="font-size:0.5rem;">${valueOfElement['user_id']}</div>
                            </td>
                            <td class="text-center p-1">
                                ${valueOfElement['genero']}
                            </td>
                            <td class="text-right p-1">
                                ${valueOfElement['cedula']}
                            </td>
                            <td class="p-1">
                                ${is_null(valueOfElement['telefono_movil'])?'':valueOfElement['telefono_movil']}
                            </td>
                            <td class="p-1">
                                ${valueOfElement['email']}
                            </td>
                            <td class="p-1">
                                ${$agenda}
                            </td>
                            <td class="p-1">
                                ${active ? '' : 'Desactivado'}
                            </td>
                            <td class="p-1">
                                ${cat_user_type_description}
                            </td>

                            <td class="p-1" nowrap>
                                <button data-tippy-content="Editar Médico" data-user_id_paciente="${valueOfElement['user_id']}" class="tooltip-primary btn btn-default btn-medico-edit">
                                    <i data-user_id_paciente="${valueOfElement['user_id']}" style="font-size:1.3rem" class="pc-medico_editar text-primary btn-medico-edit"></i>
                                </button>
                                <button data-tippy-content="Crear Agenda de citas" data-user_id_paciente="${valueOfElement['user_id']}" class="tooltip-primary btn btn-default btn-medico-agenda-create">
                                    <i data-user_id_paciente="${valueOfElement['user_id']}" style="font-size:1.3rem" class="pc-calendario text-primary btn-medico-agenda-create"></i>
                                </button>
                                <button data-tippy-content="Pulsa para  ${active ? 'Desactivar' : 'Activar'}" data-user_id_paciente="${valueOfElement['user_id']}" class="tooltip-${active ? 'success' : 'secondary'} btn btn-default btn-medico-medico_inactivo">
                                    <i data-user_id_paciente="${valueOfElement['user_id']}" style="font-size:1.3rem" class="pc-medico_inactivo ${active ?  'text-success': 'text-gray'}  btn-medico-medico_inactivo"></i>
                                </button>
                                <button data-tippy-content="Eliminar médico" data-user_id_paciente="${valueOfElement['user_id']}" class="tooltip-danger btn btn-default btn-medico-destroy">
                                    <i data-user_id_paciente="${valueOfElement['user_id']}" class="tooltip-danger btn-medico-destroy fas fa-user-minus text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                })

            }else{
                throw new Error(useState['medicos']);
            }
            activarTooltip()
            $('#index_table_medicos').DataTable( {
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
export let form_create = async (item_id) => {

    }
export let init = async ($tab="#tab_app") => {
        //useState['users'] = items
        useState['tab'] = $tab
        ComponentMedicoHome.enrutador($tab)

    }
