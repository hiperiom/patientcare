import {get,post,fotoTemporal,loading,meses,fechaAMD2,is_null,activarTooltip,is_empty, timestamps, telefonoConfig, is_undefined, select} from "../helpers/helpers.js";
import UserProfile  from "./UserProfile.js";
import Component from "./Component.js";
let userProfile  = new UserProfile();
let message
export default class User {
    create(selector) {
        $(selector).html(`
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="email">Correo electrónico</label>
                        <input type="email" class="form-control form-control-lg bg-gray-footer-parodi" name="email" id="email" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="password">Contraseña</label>
                        <input type="password" class="form-control form-control-lg bg-gray-footer-parodi" name="password" id="password" aria-describedby="helpId" placeholder="">
                        <small id="helpId2" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>
        `);
    }
    static create2(selector) {
        $(selector).html(`
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                        <table class="w-100">
                            <tr>
                                <td style="width: 30%">
                                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="nacionalidad" id="nacionalidad">
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="P">P</option>
                                        <option value="J">J</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" max="9" class="form-control form-control-lg bg-gray-footer-parodi" name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                                </td>
                            </tr>
                        </table>
                        <small id="sms_cedula" class="form-text text-danger notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div id="correoAdulto" class="form-group">
                        <label class="label-text text-secondary" for="email">Correo electrónico</label>
                        <input type="email" class="form-control form-control-lg bg-gray-footer-parodi" name="email" id="email" aria-describedby="helpId" placeholder="">
                        <small id="sms_email" class="form-text text-danger notification"></small>
                    </div>
                    <div id="emailAlternativo" class="form-group d-none">
                        <label class="label-text text-secondary" for="email_alternativo">Correo electrónico <span class="font-weight-bold">(del representante)</span></label>
                        <input type="email" class="form-control form-control-lg bg-gray-footer-parodi" name="email_alternativo" id="email_alternativo" aria-describedby="helpId" placeholder="">
                        <small id="sms_email_alternativo" class="form-text text-danger notification"></small>
                    </div>
                </div>
            </div>
        `);

        let temp_cedula = ""
        let temp_email = ""
        function validarNumeroConDosDecimales(inputValue) {
            const regex = /^\d+\.\d{2}$/;
            return regex.test(inputValue);
        }
        $("#cedula").on("change", function() {
            let nacionalidad = $("#nacionalidad");
            if (nacionalidad.val() != "") {
                //console.log(response)
                let email = $("#email");
                let nacionalidad = $("#nacionalidad");
                let cedula = $("#cedula");

                temp_cedula = cedula.val()
                    userProfile.validateCedula()
                        .then(response => {

                            if (response.exist) {

                                if(response.episodesOpen.length === undefined){

                                    document.querySelector("#content_1").style.visibility = 'hidden'
                                    Swal.fire({
                                        title: "¡Episodio activo!",
                                        html: `
                                            La cédula <b>${cedula.val()}</b> está asociada al paciente:
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Nombres:</th>
                                                    <th>Apellidos:</th>
                                                    <th>Ubicación actual:</th>
                                                </tr>
                                                <tr>
                                                    <td>${response.user.profile.nombres}</td>
                                                    <td>${response.user.profile.apellidos}</td>
                                                    <td>${response.episodesOpen.ubicacion_description}</td>
                                                </tr>
                                            </table>
                                            Para reingresarlo, deberá crearle el alta a su episodio actual. Si desea reubicarlo de area, pulse en la opción <b>traslado</b> desde su ubicación actual.
                                        `,
                                        allowOutsideClick: false,
                                        icon: "warning",
                                        showCancelButton: false,
                                        confirmButtonColor: "#3085d6",
                                        //cancelButtonColor: "#d33",
                                        confirmButtonText: "De acuerdo!",
                                        //cancelButtonText: "No!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.querySelector("#content_1").style.visibility = 'visible'
                                            cedula.val('')
                                            cedula.trigger("focus");
                                        }
                                    });

                                    return false
                                }
                                $("#sms_cedula").html("<i class='fas fa-exclamation-triangle'></i> La cédula está registrada");
                                //console.log("2 ",location.pathname !== "/paciente/create")
                                if (location.pathname !== "/medico/create") {


                                    if (
                                        location.pathname === "/paciente/create" ||
                                        //location.pathname === "/medico/create" ||
                                        location.pathname === "/medico"
                                    ) {
                                        message = Component.alertMessage("cedula_asignada2");
                                        Swal.fire(
                                            message['title'],
                                            nacionalidad.val() + cedula.val() + message['message'],
                                            message['image']

                                        ).then(()=>{
                                            setTimeout(() =>  {
                                                if (location.pathname !== "/medico") {
                                                    cedula.val('');
                                                }else{
                                                    cedula.val(document.getElementById('cedula').dataset.cedula);
                                                }
                                                cedula.trigger("focus");
                                            }, 110);
                                        })
                                    }else{
                                        Swal.fire({
                                            title: "Cédula registrada!",
                                            html: `
                                                La cédula <b>${cedula.val()}</b> está asociada al paciente:
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Nombres:</th>
                                                        <th>Apellidos:</th>
                                                        <th>Ubicación actual:</th>
                                                    </tr>
                                                    <tr>
                                                        <td>${response.user.profile.nombres}</td>
                                                        <td>${response.user.profile.apellidos}</td>
                                                        <td>${is_undefined(response.episodesOpen.ubicacion_description) ? '' : response.episodesOpen.ubicacion_description}</td>
                                                    </tr>
                                                </table>
                                                <h4>¿Quieres reingresarlo? </h4>
                                                Esta acción creará un nuevo episodio.
                                            `,
                                            allowOutsideClick: false,
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "De acuerdo!",
                                            cancelButtonText: "No!"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                User.reingresoByCedula(temp_cedula)
                                            }else{
                                                setTimeout(() => { cedula.val('');cedula.trigger("focus");}, 110);
                                            }
                                        });


                                    }
                                }


                            } else {
                                //$("#sms_cedula").empty();
                                $("#sms_cedula").html("<i class='fas fa-check-circle text-success'></i><span class='text-success'> Cédula no registrada</span>");
                            }

                        })
                    $("#sms_email").empty();
            } else {
                message = Component.alertMessage("input_select_empty");
                Swal.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => { nacionalidad.trigger("focus");}, 110);
                    }
                })
                //alert(message['message'])
                //nacionalidad.trigger("focus")
                $(this).val('')
                return false;
            }
        });
        $("#cedula").on("keyup", function(e) {
            //console.log(e.currentTarget.value)
            const numeroValido = validarNumeroConDosDecimales(e.currentTarget.value)
            if(numeroValido){
                document.querySelector('#email').value= `${e.currentTarget.value}@correotemporal.com`
                document.querySelector('#correoAdulto').classList.add("d-none")
                document.querySelector('#emailAlternativo').classList.remove("d-none")
            }else{
                document.querySelector('#email').value= ``
                document.querySelector('#correoAdulto').classList.remove("d-none")
                document.querySelector('#emailAlternativo').classList.add("d-none")
            }
        })
        let that = this
        $("#email").on("change", function() {
            that.validateEmail()
            .then(response => {
                //console.log(response)
                let email = $("#email");
                if (location.pathname !== "/medico/create") {
                    if (response == "email_existe") {
                        let temp_email = email.val();
                        $("#sms_email").html("<i class='fas fa-exclamation-triangle'></i> " + response);
                        message = Component.alertMessage("email_registrado");
                        Swal.fire({
                            icon: message['image'],
                            title: message['title'],
                            text: email.val() + ". "+ message['message'],
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: `Entendido`,
                            didClose: () => {
                                setTimeout(() => {
                                    if (location.pathname !== "/medico") {
                                        email.val('');
                                    }else{
                                        email.val(document.getElementById('email').dataset.email);
                                    }
                                    email.trigger("focus");
                                }, 110);
                            }

                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                let cedula = $("#cedula");
                                setTimeout(() => { email.val('');email.trigger("focus");}, 110);
                            }
                        })

                    }else {
                        //$("#sms_cedula").empty();
                        $("#sms_email").html("<i class='fas fa-check-circle text-success'></i> ");
                    }
                }

            })
        });
    }
    static async store() {
        let email = $("#email");
        let email_alternativo = $("#email_alternativo");
        let cedula = $("#cedula");
        let nacionalidad = $("#nacionalidad");
        let password = $("#password");

        let formdata = new FormData();
        formdata.append("email", email.val())
        formdata.append("email_alternativo", email_alternativo.val())
        formdata.append("cedula", cedula.val())
        formdata.append("nacionalidad", nacionalidad.val())
        formdata.append("password", password.val() != undefined ? password.val() : 123456)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post(location.origin+"/user/store", formdata)
    }
    static async update() {
        let email = $("#email");
        let email_alternativo = $("#email_alternativo");
        let cedula = $("#user_id");


        let formdata = new FormData();
        formdata.append("email", email.val())
        formdata.append("email_alternativo", email_alternativo.val())
        formdata.append("user_id", document.getElementById('email').dataset.user_id)
        formdata.append("updated_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post(location.origin+"/user/update", formdata)
    }
    static validate() {
        let nacionalidad = $("#nacionalidad");
        let cedula = $("#cedula");
        let email = $("#email");

        if (
            nacionalidad.val() == "" &&
            cedula.val() == "" &&
            email.val() == ""
        ) {
            message = Component.alertMessage("user_no_valid");
            //alert(message['message'])
            //nacionalidad.trigger("focus")
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => nacionalidad.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (nacionalidad.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => nacionalidad.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (cedula.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => cedula.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (email.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => email.trigger("focus"), 110);
                }
            })
            return false;
        }

        return true;
    }
    validate2() {
        let nacionalidad = $("#nacionalidad");
        let cedula = $("#cedula");
        if (nacionalidad.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => nacionalidad.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (cedula.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => cedula.trigger("focus"), 110);
                }
            })
            return false;
        }

        return true;
    }
    static async validateEmail() {
        let nacionalidad = $("#nacionalidad");
        let cedula = $("#cedula");
        let email = $("#email");
        let formdata = new FormData();
        formdata.append("nacionalidad", nacionalidad.val())
        formdata.append("cedula", cedula.val())
        formdata.append("email", email.val())
        formdata.append("_token", $("#_token").val())
        return await post(location.origin+"/user/emailExist", formdata)
    }
    static async show(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return await post(location.origin+"/user/show", formdata)
    }

    getByEmail(email) {
        let formdata = new FormData();
        formdata.append("email", email)
        formdata.append("_token", $("#_token").val())
        return post(location.origin+"/user/getByEmail", formdata)
    }
    async reingresoByCedula(cedula) {

        if (location.pathname == "/medico/create_paciente") {
            console.log("cedula->",cedula)
                let model = await UserProfile.getCedula(cedula)
                console.log("reingresoByCedula->",model)
                const tiempoTranscurrido = Date.now();
                const hoy = new Date(tiempoTranscurrido);
                model.fnacimiento = model.fnacimiento === null ? hoy.toISOString():model.fnacimiento;
                let fn = new Date(model.fnacimiento)
                let paciente = model.nombres +" "+model.apellidos;

                pacientes_datos = [{
                    cedula: model.nacionalidad + model.cedula,
                    dias: 0,
                    edad: calcularEdad(fn.getFullYear()+'-'+fn.getMonth()+'-'+fn.getDate()),
                    imagen: model.genero !== null ? model.imagen:"" ,
                    imp_diagn: null,
                    ingreso: hoy.toISOString(),
                    medico_felow: null,
                    medico_interconsultante: null,
                    medico_ramh: null,
                    medico_residente: null,
                    medico_tratante: null,
                    paciente: paciente !== " " ? paciente:"No Indicado",
                    sexo: model.genero !== null ? model.genero.toUpperCase():"M",
                    telefono_movil: model.telefono_movil !== null? model.telefono_movil:"No Indicado",
                    ubicacion: "ALTA | Domicilio",
                    user_id: model.user_id
                }];
                //UserCuestUbicacion.reingreso('.modal-body',model.user_id)
                UserCuestHistoria.index('.modal-body', model.user_id)


        }
    }
    async reingresoByEmail(cedula) {
            /*
        if (location.pathname == "/medico/create_paciente") {
            let model = await UserProfile.getCedula(cedula)
            console.log(model)
            const tiempoTranscurrido = Date.now();
            const hoy = new Date(tiempoTranscurrido);
            let fn = new Date(model.fnacimiento)
            let paciente = model.nombres +" "+model.apellidos;
            pacientes_datos = [{
                cedula: model.nacionalidad + model.cedula,
                dias: 0,
                edad: calcularEdad(fn.getFullYear()+'-'+fn.getMonth()+'-'+fn.getDate()),
                imagen: model.genero !== null ? model.imagen:"" ,
                imp_diagn: null,
                ingreso: hoy.toISOString(),
                medico_felow: null,
                medico_interconsultante: null,
                medico_ramh: null,
                medico_residente: null,
                medico_tratante: null,
                paciente: paciente !== " " ? paciente:"No Indicado",
                sexo: model.genero !== null ? model.genero.toUpperCase():"M",
                telefono_movil: model.telefono_movil !== null? model.telefono_movil:"No Indicado",
                ubicacion: "ALTA | Domicilio",
                user_id: model.user_id
            }];

            UserCuestHistoria.index('.modal-body', model.user_id)


        }*/
    }
}
