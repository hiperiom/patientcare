import {get,post,select,fotoTemporal,is_null,validarArchivoImagen,timestamps,reemplaza_imagen, is_empty} from "../helpers/helpers.js";
import Component from "./Component.js";
import User from "./User.js";
import UserProfile from "./UserProfile.js"
import UserType from "./UserType.js"
import CatUserEspecialidad from "./CatUserEspecialidad.js";
import UserEquipoSalud from "./UserEquipoSalud.js";
import UserEspecialidad from "./UserEspecialidad.js";
import UserMedicoPosicion from "./UserMedicoPosicion.js";

//let user = new User()
let userProfile = new UserProfile()
let userType = new UserType()
let message
var iti
export let telefonoConfig = (selectorInput,customhandleChange)=> {
    let input = document.querySelector(selectorInput);
        iti = window.intlTelInput(input, {
            autoHideDialCode:true,
            nationalMode: false,
            preferredCountries: ['ve'],
            separateDialCode: true,
            utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
        });
        /*
    let handleChange = function() {
        customhandleChange(iti.getNumber(),iti.isValidNumber())
      };
        input.addEventListener('change', handleChange);
        input.addEventListener('keyup', handleChange);*/
}
export default class UserMedico {
    constructor() {

    }
    static async index(selector, user_id) {
        let model = await get( location.origin+"/medico/getMedicos")
        

        $(selector).html(`
            <div class="row mt-5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Equipo Médico
                        </h1>
                    </div>

                    <span id="user_cuest_model_create" onclick="window.location='/medico/create'" class="float-right text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nuevo Usuario
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </span>

                    <div class="table-responsive mb-3">
                        <table id="index_table_medicos" class="table table-bordered mb-3">
                            <thead>

                                <tr>
                                    <th class="text-primary sticky-top text-center">Foto</th>
                                    <th class="text-primary sticky-top text-center">Médico</th>
                                    <th class="text-primary sticky-top text-center">Sexo</th>
                                    <th class="text-primary sticky-top text-center">Cédula</th>
                                    <th class="text-primary sticky-top text-center">Teléfonos</th>
                                    <th class="text-primary sticky-top text-center">Correo</th>
                                    <th class="text-primary sticky-top text-center">Equipo Salud</th>
                                    <th class="text-primary sticky-top text-center">Especialidad</th>
                                    <th class="text-primary sticky-top text-center">Posición/Cargo</th>
                                    <!--<th class="text-primary text-center">Ingreso</th>-->
                                    <th class="text-primary sticky-top text-center" nowrap>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="filas">
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `);
       
        if (Object.keys(model).length > 0) {
            
            $("#index_table_medicos tbody").empty();
            model.map(valueOfElement=>{
                // console.log(`Valor del elemento ${valueOfElement}`)
                //cl(valueOfElement['prefijo'])onclick="EditImage(${valueOfElement['user_id']},'${valueOfElement['imagen']}')"
                $("#index_table_medicos tbody").append(`
                    <tr id="row_${valueOfElement['user_id']}">
                        <td>
                            <img
                                data-user_id="${valueOfElement['user_id']}"
                                data-urlimg="${valueOfElement['imagen']}"
                                id="image-perfil_${valueOfElement['user_id']}" onerror="this.src = '/image/system/medic.svg'"
                                src="${valueOfElement['imagen']}"
                                style="cursor:pointer; width: 1.5cm; height:1.5cm; object-fit: cover;"
                                class="image-perfil rounded-circle mx-auto d-block" alt="Medic default"'
                            >
                            <span class="text-white">
                                #${valueOfElement['user_id']}
                            </span>

                        </td>
                        <td>
                            ${!is_null(valueOfElement['prefijo'])?valueOfElement['prefijo']+' ':''}

                            <div class="d-flex flex-column">
                                <h5 class="mb-0 text-secondary">
                                    ${valueOfElement['medico']}
                                </h5>
                                <div class="d-flex">
                                    <div class="flex-fill">
                                        <b style="font-size:0.6rem;font-weight:500;" class="text-info">Firma</b>
                                        <img onerror="this.style.display='none'" src="${['image/user/firma/firma_patientcare_default.png',null].includes(valueOfElement['firma']) ? '#':'/'+valueOfElement['firma']}" style="height:50px" >

                                    </div>
                                    <div class="flex-fill">
                                        <b style="font-size:0.6rem;font-weight:500;" class="text-info">Sello</b>
                                        <img onerror="this.style.display='none'" src="${['image/user/sello/sello_patientcare_default.png',null].includes(valueOfElement['sello']) ? '#':'/'+valueOfElement['sello']}" style="height:50px" >
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            ${valueOfElement['genero']}
                        </td>
                        <td class="text-right">
                            ${valueOfElement['cedula']}
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <div>
                                    <b class="text-info">Movil:</b>
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=${['null',null].includes(valueOfElement['telefono_movil']) ? '#':valueOfElement['telefono_movil'].replace("+", "")}" style="padding: 0% 3% 3% 3%;border: 0;line-height: 1.4;" class="btn text-nowrap btn-default btn-block">
                                        <i class="fab fa-whatsapp text-success"></i> ${['null',null].includes(valueOfElement['telefono_movil']) ? '':valueOfElement['telefono_movil'].replace("+", "")}
                                    </a>
                                </div>
                                <div>
                                    <b class="text-orange">Asterísco:</b> ${['null',null].includes(valueOfElement['extension_telefonica']) ? '':valueOfElement['extension_telefonica']}
                                </div>
                            </div>

                        </td>
                        <td>
                            <div>
                            ${valueOfElement['email']}
                            </div>
                        </td>
                        <td>
                            ${valueOfElement['equipo_salud']}
                        </td>
                        <td>
                            ${['Sin Especialidad',null].includes(valueOfElement['especialidad']) ? '':valueOfElement['especialidad']}
                        </td>
                        <td>
                            ${valueOfElement['posicion']}
                        </td>
                        <td nowrap>
                            <button id="edit${valueOfElement['user_id']}" onclick="location.href='/medico/edit/${valueOfElement['user_id']}'" class="btn btn-default"><i class="fas fa-user-edit text-primary"></i></button>
                            <button 
                                id="destroy${valueOfElement['user_id']}" 
                                class="btn btn-default handleDelete"
                                data-user_id="${valueOfElement['user_id']}" 
                            >
                                <i data-user_id="${valueOfElement['user_id']}"  class="handleDelete fas fa-user-minus text-danger"></i>
                            </button>
                            <button 
                                class="btn btn-default handleRole" 
                                type="button"
                                data-user_id="${valueOfElement['user_id']}" 
                                data-role="4" 
                            >
                                <i id="role_${valueOfElement['user_id']}_4" 
                                    data-user_id="${valueOfElement['user_id']}" 
                                    data-role="4" 
                                    class="fas fa-user-shield handleRole text-${(valueOfElement['user_roles_id'].split(",")).includes('4') ? 'success':'gray'} "
                                ></i>
                            </button>
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
        document.addEventListener("click", async (e) => {
            if (e.target.matches(".handleRole")) {
                document.querySelector("#loadingScreen").classList.remove("d-none")
                let user_id = Number(e.target.dataset.user_id)
                let role_id = Number(e.target.dataset.role)
                let r = model.find(med => Number(med.user_id) === user_id )['user_roles_id'].split(",").map(x=>Number(x))
                let index = model.findIndex(med => Number(med.user_id) === user_id )
                let formdata = new FormData();
                formdata.append("user_id", user_id)
                formdata.append("role_id", role_id)
                formdata.append("_token", $("#_token").val())
                await post( location.origin+"/medico/updateRol",formdata)
                if(r.includes(role_id)){
                    let temp_roles = r.filter(x=>x!==role_id)
                    model[index]['user_roles_id'] = temp_roles.join(",")
                    $("#role_"+user_id+"_"+role_id).removeClass("text-success").addClass("text-gray")
                }else{
                    model[index]['user_roles_id'] = model[index]['user_roles_id']+","+role_id
                    $("#role_"+user_id+"_"+role_id).removeClass("text-gray").addClass("text-success")
                }
                document.querySelector("#loadingScreen").classList.add("d-none")
            }
            if (e.target.matches(".handleDelete")) {
                var message = Component.alertMessage('destroy_row_cuestion');
                let user_id = Number(e.target.dataset.user_id)

                Swal.fire({
                    icon: message['image'],
                    title: message['message'],
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Si`,

                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let formdata = new FormData();
                        formdata.append("user_id", user_id)
                        formdata.append("cat_user_type_id", 2)
                        formdata.append("new_cat_user_type_id", 5)
                        formdata.append("_token", $("#_token").val())
                        await post( location.origin+"/user_type/update", formdata)
                        $("#row_"+ user_id).slideUp("slow");
                        
                    } else if (result.isDenied) {
                        //Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            }
        })
    }
    static medicoTratante() {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;z-index: 200000;"></div>
            <div class="row mt-5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Médico Tratante
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="number" class="form-control form-control-lg bg-gray-footer-parodi" name="value" id="value" aria-describedby="helpId" placeholder="Nuevo valor">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="datetime-local" class="form-control form-control-lg bg-gray-footer-parodi" name="created_at" id="created_at" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="sintoma_observacion" id="sintoma_observacion" rows="2" placeholder="Observación"></textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                </div>


            </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            UserCuestGl.index(selector, user_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            UserCuestGl.store(user_id)
                .then(response => {
                    let valor = $("#value").val();
                    UserCuestGl.columnaValor(
                        `#col_10_${user_id}`, {
                            'user_id': user_id,
                            'valor': valor
                        });
                    UserCuestGl.index('.modal-body', user_id)
                });
        });
        $("#info").on("click", function() {
            UserCuestGl.help(selector, user_id);
        });
    }
    static async store(){

       /*  try { */
            //$("#cargando_model,#contenido_model").slideToggle();
            let model = await User.store();

            if (Object.keys(model).length > 0) {
                let user_id = model.id;

                await userType.store2({ 'user_id': user_id, 'cat_user_type_id': 2 });

                await userType.store2({ 'user_id': user_id, 'cat_user_type_id': 1 });

                await userProfile.store(user_id,iti);

                await UserEquipoSalud.store(user_id);

                await UserEspecialidad.store(user_id);

                await UserMedicoPosicion.store(user_id);

                 message = Component.alertMessage("send_success");
                Swal.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => window.location = "/medico/index_medicos", 110);
                    }
                })
            }else{
                throw new Error(model);
            }

        /* } catch (error) {
            $("#cargando_model,#contenido_model").slideToggle();
            message = Component.alertMessage("error");
            Swal.fire({
                icon: message['imagen'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => console.log(error), 110);
                }
            })
        } */

    }
    static create(selector) {
        UserMedico.create_form(selector);
        setTimeout(() => {
            fotoTemporal('imagen', ".image-perfil")
            fotoTemporal('sello', ".image-sello")
            fotoTemporal('firma', ".image-firma")
            document.querySelector("#cat_user_type_id").value=2
            console.log(document.querySelector(".extension_telefonica"))
            telefonoConfig("#telefono_movil")

            $("#user_medico_store").on("click", function() {

                if (User.validate()) {
                    if (UserProfile.validate()) {
                        UserMedico.store();
                    }
                }
            });    
        }, 1000);
        

    }
    static async edit(selector, user_id) {

            await UserMedico.create_form(selector);
            $("#contenido_model").css("display","none");
            $("#cargando_model").show();
            document.querySelector("#cat_user_type_id").value=2
            document.querySelector("#email").dataset.user_id = user_id

            fotoTemporal('imagen', ".image-perfil")
            fotoTemporal('sello', ".image-sello")
            fotoTemporal('firma', ".image-firma")
            telefonoConfig("#telefono_movil")
            $("#user_medico_store").html("Actualizar usuario");
            $("#nacionalidad,#cedula, #email").css("border", 0);
console.log("iti",iti);
            /* try { */
                let response = await User.show(user_id)
                console.log("user->",response);

                let emailCurrent = response.email
                    $("#email").val(emailCurrent)

                response = await UserProfile.show(user_id)
                console.log("user_profile->",response);
                if (!is_empty(iti)) {
                    iti.setNumber(response.telefono_movil);
                }else{
                    $("#telefono_movil").val(response.telefono_movil)
                }
                if(["/medico/create"].includes(location.pathname) || location.pathname.indexOf('medico/edit')){
                    document.querySelector(".extension_telefonica").classList.remove("d-none")
                }
                if (response !== undefined) {
                    $("#nacionalidad").val(response.nacionalidad).attr("disabled", true)
                    $("#cedula").val(response.cedula) //.attr("readonly", true)
                    $("#nombres").val(response.nombres)
                    $("#apellidos").val(response.apellidos)
                    $("#fnacimiento").val(response.fnacimiento)
                    $("#extension_telefonica").val(response.extension_telefonica)
                    $("#genero").val(response.genero)
                    $("#image-perfil").attr('src', response.imagen)
                    $("#image-sello").attr('src', "/"+response.sello)
                    $("#image-firma").attr('src', "/"+response.firma)
                    $("#temp_imagen").val(response.imagen)
                    $("#temp_sello").val(response.sello)
                    $("#temp_firma").val(response.firma)
                    $("#prefijo").val(response.prefijo)
                    $("#colegio_medico").val(response.colegio_medico)
                    $("#mpps").val(response.mpps)

                }
                response = await UserEspecialidad.show(user_id)

                if (response !== undefined) {
                    if (response.cat_user_especialidad_id == undefined) {
                        $("#cat_user_especialidad_id").val(1)
                    }else{
                        $("#cat_user_especialidad_id").val(response.cat_user_especialidad_id)
                    }
                }

                response = await UserEquipoSalud.show(user_id)
                    if (response !== undefined) {
                        if (response.cat_user_equipo_salud_id == undefined) {
                            $("#cat_user_equipo_salud_id").val(1)
                        }else{
                            $("#cat_user_equipo_salud_id").val(response.cat_user_equipo_salud_id)
                        }
                    }
                response = await UserMedicoPosicion.show(user_id)
                if (response !== undefined) {
                    $("#cat_medico_posicion_id").val(response.cat_user_medico_posicion_id)
                }

                $("#user_medico_store").on("click", async function() {
                    await UserMedico.update(user_id)
                });




                $("#cargando_model,#contenido_model").slideToggle();

    }
    static async create_externo(selector) {
        UserMedico.create_form(selector);
        fotoTemporal('imagen', ".image-perfil")

        $("#user_medico_store").on("click", async function() {

            if (User.validate()) {
                if (UserProfile.validate()) {
                    try {
                        $("#cargando_model,#contenido_model").slideToggle();
                        let model = await User.store();

                        if (Object.keys(model).length > 0) {
                            let user_id = model.id;

                            await UserType.store2({ 'user_id': user_id, 'cat_user_type_id': 2 });

                            await UserProfile.store(user_id);

                            await UserEquipoSalud.store(user_id);

                            await UserEspecialidad.store(user_id);

                            await UserMedicoPosicion.store(user_id);

                            message = Component.alertMessage("send_success");
                            Swal.fire({
                                icon: message['image'],
                                title: message['title'],
                                text: message['message'],
                                didClose: () => {
                                    setTimeout(() => window.location = "/", 110);
                                }
                            })
                        }else{
                            throw new Error(model);
                        }

                    } catch (error) {
                        $("#cargando_model,#contenido_model").slideToggle();
                        message = Component.alertMessage("error");
                        Swal.fire({
                            icon: message['imagen'],
                            title: message['title'],
                            text: message['message'],
                            didClose: () => {
                                setTimeout(() => console.log(error), 110);
                            }
                        })
                    }
                }
            }
        });

    }
    static show(selector) {

    }
    static async update(user_id) {
        if (User.validate()) {
            if (UserProfile.validate()) {

                try {
                    $("#cargando_model,#contenido_model").slideToggle();
                    let model = await UserProfile.update(user_id,iti);
                        console.log("1->",model)

                        model = await UserEquipoSalud.update(user_id)
                        console.log("2->",model)

                        model = await UserEspecialidad.update(user_id)
                        console.log("3->",model)

                        model = await UserMedicoPosicion.update(user_id)
                        console.log("4->",model)

                        model = await User.update()
                        console.log("5->",model)

                        message = Component.alertMessage("send_success");
                         Swal.fire({
                            icon: message['image'],
                            title: message['title'],
                            text: message['message'],
                            didClose: () => {
                                setTimeout(() => window.location = "/medico/index_medicos", 110);
                            }
                        })
                } catch (error) {
                    $("#cargando_model,#contenido_model").slideToggle();
                    message = Component.alertMessage("error");
                    Swal.fire({
                        icon: message['imagen'],
                        title: message['title'],
                        text: message['message'],
                        didClose: () => {
                            setTimeout(() => console.log(error), 110);
                        }
                    })
                }
            }

        }
    }
    static destroy(selector) {

    }
    static eliminar(user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');


        Swal.fire({
            icon: message['image'],
            title: message['message'],
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,

        }).then((result) => {
            if (result.isConfirmed) {
                UserType.update(user_id,2,5)
                .then(response => {
                    $("#row_"+ user_id).slideUp("slow");
                })
            } else if (result.isDenied) {
                //Swal.fire('Changes are not saved', '', 'info')
            }
        })

    }
    static async create_form(selector) {

        $(selector).html( /*html */`
            <div id="cargando_model" style="display:none;" class="container">
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="d-flex m-4 justify-content-center text-primary">
                            Cargando...
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contenido_model" class="container">
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Nuevo Usuario
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div>
                            <img id="image-perfil" onerror="this.src = '/image/system/medic.svg'" src="${location.origin}/image/user/foto_perfil/medic.svg" style="width: 2cm;height:2cm" class="image-perfil rounded-circle mx-auto d-block" alt="Medic default">
                        </div>
                        <div class="form-group">
                            <label class="label-text text-secondary" for="imagen">Subir Foto <h6>solo archivos (.jpg o .png)</h6></label>
                            <input type="file" accept="image/png, image/gif, image/jpeg"

                            class="validarArchivoImagen form-control form-control-lg bg-gray-footer-parodi name="imagen" id="imagen" >
                            <input type="hidden" name="temp_imagen" id="temp_imagen" >
                            <input type="hidden" name="temp_firma" id="temp_firma" >
                            <input type="hidden" name="temp_sello" id="temp_sello" >
                            <input type="hidden" name="cat_user_type_id" id="cat_user_type_id">
                            <small id="helpId1" class="form-text text-muted"></small>
                        </div>
                    </div>
                </div>
                <div id="user_create"></div>
                <div id="user_profile"></div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="cat_especialidad_id">Miembro del equipo de salud</label>
                        <select name="cat_user_equipo_salud_id" id="cat_user_equipo_salud_id" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="1">Médico(a)</option>
                            <option value="2">Enfermero(a)</option>
                            <option value="3">Estudiante de medicina</option>
                            <option value="4">Estudiante de enfermería</option>
                            <option value="5">Atención al paciente</option>
                            <option value="6">Instrumentista</option>
                            <option value="7">C. Anestesia</option>
                            <option value="8">C. Cirugía</option>
                            <option value="9">Hotelería</option>
                            <option value="10">Ingeniero(a)</option>
                            <option value="12">Admisión</option>
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="cat_especialidad_id">Especialidad</label>
                        <select name="cat_user_especialidad_id" id="cat_user_especialidad_id" class="form-control form-control-lg bg-gray-footer-parodi"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="cat_medico_posicion_id">Posición o cargo</label>
                        <select name="cat_medico_posicion_id" id="cat_medico_posicion_id" class="form-control form-control-lg bg-gray-footer-parodi">

                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="prefijo">Prefijo</label>
                        <select name="prefijo" id="prefijo" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option aria-label="Doctor" value="Dr.">Dr.</option>
                            <option aria-label="Doctora" value="Dra.">Dra.</option>
                            <option aria-label="Licenciado" value="Licdo.">Licdo.</option>
                            <option aria-label="Licenciada" value="Licda.">Licda.</option>
                            <option aria-label="Bachiller" value="Br.">Br.</option>
                            <option aria-label="Enfermería" value="Enf.">Enf.</option>
                            <option aria-label="Ingeniero" value="Ing.">Ing.</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <img id="image-firma" onerror="this.src = '/image/user/firma/firma_patientcare_default.png'"  src="${location.origin}/image/user/firma/firma_patientcare_default.png" style="width: 200px;height:110px;" class="mt-3 image-firma rounded mx-auto d-block" alt="Medic default">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <img id="image-sello" onerror="this.src = '/image/user/sello/sello_patientcare_default.png'"  src="${location.origin}/image/user/sello/sello_patientcare_default.png" style="width: 200px;height:110px;" class="mt-3 image-sello rounded mx-auto d-block" alt="Medic default">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="firma">Subir Firma</label>
                        <input name="firma" id="firma" type="file" class="form-control form-control-lg bg-gray-footer-parodi">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="sello">Subir Sello</label>
                        <input name="sello" id="sello" type="file" class="form-control form-control-lg bg-gray-footer-parodi">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="colegio_medicos">Colegio de médicos N°</label>
                        <input name="colegio_medico" id="colegio_medico" type="text" class="form-control form-control-lg bg-gray-footer-parodi">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="label-text text-secondary" for="mpps">MPPS N°</label>
                        <input name="mpps" id="mpps" type="text" class="form-control form-control-lg bg-gray-footer-parodi">
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button onclick="history.back()" class="regresar btn btn-lg btn-default bg-secondary mt-3 btn-block">
                            Regresar
                        </button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button id="user_medico_store" type="submit" class="btn btn-lg btn-primary mt-3 btn-block">Registrar usuario</button>
                    </div>
                </div>
            </div>
        `);
        document.addEventListener("click", async (e) => {
            if (e.target.matches(".validarArchivoImagen")) {
                //that.show(user_id)
                validarArchivoImagen("imagen")
                //EditImage(e.target.dataset.user_id, e.target.dataset.urlImg)
            }
        })

        let formdata = new FormData();
            formdata.append("_token", $("#_token").val())
        let cat_user_medico_posicion = await post( location.origin+"/cat_user_medico_posicion/getAll",formdata)
            cat_user_medico_posicion.forEach(row=>{
                 $("#cat_medico_posicion_id").append(`
                    <option value="${row.id}">${row.description}</option>`
                );
            })
        User.create2("#user_create")
        UserProfile.create("#user_profile")
        CatUserEspecialidad.getIndex()
            .then(response => {
                $("#cat_user_especialidad_id").html(select(response));
                telefonoConfig("#telefono_movil")
            })
            return 0
    }
    static deleteRow({tipoMedico,user_cuest_medico_paciente_id,user_id,color,idTipoMedico}){
        loading(`#listado_medicos_${tipoMedico}`)
        UserCuestMedicoPaciente.eliminar({tipoMedico,user_cuest_medico_paciente_id,user_id,color,idTipoMedico})
    }
    static getGroup(response){
       // UserMedico.getMedicos()
        //.then(response => {
            let especialidad ="";
            let group  =``;
            /*
                group +=`<optgroup>`;
                group +=`<option value="">Escoja un médico</option>`;
                group +=`</optgroup>`*/
            let key = false;
            $.each(response, function(indexInArray, valueOfElement) {

                if (especialidad !== valueOfElement.especialidad  && !key ) {
                    especialidad = valueOfElement.especialidad
                    group +=`<optgroup class='text-primary' label="${especialidad}">`
                    key = true;
                }

                if (key) {
                    group +=`<option data-position_id="${valueOfElement.posicion_id}"  class='text-secondary' value="${valueOfElement.user_id}">
                    ${!is_null(valueOfElement['prefijo'])?valueOfElement['prefijo']+' ':''}${valueOfElement.medico}
                    </option>`
                }


                if(response[indexInArray+1] !== undefined){
                    if (response[indexInArray+1].especialidad !== especialidad) {
                        group +=`</optgroup>`
                        key=false;
                    }
                }


            });
            //$(`#med_${tipoMedico}`).append(group);
       // })
        /*
        $('.mySelect2').select2({
            dropdownParent: $('#modelId'),
            placeholder:"Escoja Médico"
        });*/
        return group;
    }
    static validate() {
        if ($("#nombre").val() == "") {
            alert(Component.alertMessage('input_text_empty')['message'])
            $("#nombre").trigger("focus")
            return false;
        }
        if ($("#apellido").val() == "") {
            alert(Component.alertMessage('input_text_empty')['message'])
            $("#apellido").trigger("focus")
            return false;
        }
        if ($("#cedula").val() == "") {
            alert(Component.alertMessage('input_text_empty')['message'])
            $("#cedula").trigger("focus")
            return false;
        }

        if ($("#fnacimiento").val() == "") {
            alert(Component.alertMessage('input_text_empty')['message'])
            $("#fnacimiento").trigger("focus")
            return false;
        }

        if ($("#genero").val() == "") {
            alert(Component.alertMessage('input_select_empty')['message'])
            $("#genero").trigger("focus")
            return false;
        }
        if ($("#telefono_movil").val() == "") {
            alert(Component.alertMessage('input_text_empty')['message'])
            $("#telefono_movil").trigger("focus")
            return false;
        }
        if ($("#cat_especialidad_user_id").val() == "") {
            alert(Component.alertMessage('input_select_empty')['message'])
            $("#cat_especialidad_user_id").trigger("focus")
            return false;
        }
        return true;
    }
    static getMedicos() {
        return get( location.origin+"/medico/getMedicos");
    }
    async getMedicosByCargo(){
        medicos_datos = await UserMedico.getMedicos();
    }

}
