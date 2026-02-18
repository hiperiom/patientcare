import {get,post,validarPrimerDigito,fotoTemporal,loading,meses,fechaAMD2,is_null,activarTooltip,is_empty, timestamps, telefonoConfig, is_undefined} from "../helpers/helpers.js";
import Component from "./Component";
let message

export default class UserProfile {
    async store(user_id,iti) {
        let cedula = $("#cedula");
        let nacionalidad = $("#nacionalidad");
        let nombres = $("#nombres");
        let apellidos = $("#apellidos");
        let fnacimiento = $("#fnacimiento");
        let genero = $("#genero");
        let prefijo = $("#prefijo");
        let tipo_sangre = $("#tipo_sangre");
        let colegio_medico = $("#colegio_medico");
        let mpps = $("#mpps");
        let extension_telefonica = $("#extension_telefonica");
        let sello="image/user/sello/sello_patientcare_default.png"
        let firma="image/user/firma/firma_patientcare_default.png"

        let cat_user_type_id = document.querySelector("#cat_user_type_id").value
            console.log(
                iti
            );
        var telefono_movil = iti.getNumber(intlTelInputUtils.numberFormat.E164);
        let imagen = document.getElementById(`imagen`).files[0];


        let formdata = new FormData();
        formdata.append("nombres", nombres.val())
        formdata.append("apellidos", apellidos.val())
        formdata.append("cedula", cedula.val())
        formdata.append("extension_telefonica", extension_telefonica.val())
        formdata.append("nacionalidad", nacionalidad.val())
        formdata.append("mpps", mpps.val())
        formdata.append("fnacimiento", fnacimiento.val())
        formdata.append("genero", genero.val())
        formdata.append("prefijo", prefijo.val())
        formdata.append("telefono_movil", telefono_movil)
        formdata.append("imagen", imagen)
         //console.log( document.getElementById(`sello`) )
        if (cat_user_type_id==2) {
            sello = document.getElementById(`sello`).files[0];
                formdata.append("sello", sello)
        }
        if (cat_user_type_id==2) {
            firma = document.getElementById(`firma`).files[0];
            formdata.append("firma", firma)
        }
        /* formdata.append("sello", sello)
        formdata.append("firma", firma) */
        formdata.append("colegio_medico", colegio_medico.val())
        formdata.append("user_id", user_id)
        formdata.append("tipo_sangre", tipo_sangre.val())
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_profile/store", formdata)
    }
    static async update(user_id,iti) {
        let nombres = $("#nombres");
        let apellidos = $("#apellidos");
        let fnacimiento = $("#fnacimiento");
        let genero = $("#genero");
        let prefijo = $("#prefijo");
        let tipo_sangre = $("#tipo_sangre");
        let colegio_medico = $("#colegio_medico");
        let mpps = $("#mpps");
        let cedula = $("#cedula");
        let nacionalidad = $("#nacionalidad");

        let telefono_movil = iti.getNumber(intlTelInputUtils.numberFormat.E164);
        let extension_telefonica = $("#extension_telefonica");
        let temp_imagen = $("#temp_imagen");
        let temp_firma = $("#temp_firma");
        let temp_sello = $("#temp_sello");
        let imagen = document.getElementById(`imagen`).files[0];
        let sello="image/user/sello/sello_patientcare_default.png"
        let firma="image/user/firma/firma_patientcare_default.png"

        let formdata = new FormData();
            formdata.append("nombres", nombres.val())
            formdata.append("apellidos", apellidos.val())
            formdata.append("cedula", cedula.val())
            formdata.append("nacionalidad", nacionalidad.val())
            formdata.append("extension_telefonica", extension_telefonica.val())
            formdata.append("fnacimiento", fnacimiento.val())
            formdata.append("genero", genero.val())
            formdata.append("mpps", mpps.val())
            formdata.append("telefono_movil", telefono_movil)
            formdata.append("prefijo", prefijo.val())
            formdata.append("imagen", imagen)
        let cat_user_type_id = document.querySelector("#cat_user_type_id").value
            //cl(cat_user_type_id)

            if (cat_user_type_id==2) {
                sello = document.getElementById(`sello`).files[0];
                formdata.append("sello", sello)
            }
            if (cat_user_type_id==2) {
                firma = document.getElementById(`firma`).files[0];
                formdata.append("firma", firma)
                //console.log(firma)

            }


            formdata.append("colegio_medico", colegio_medico.val())
            formdata.append("temp_imagen", temp_imagen.val())
            formdata.append("temp_firma", temp_firma.val())
            formdata.append("temp_sello", temp_sello.val())

            formdata.append("tipo_sangre", tipo_sangre.val())
            formdata.append("user_id", user_id)
            formdata.append("updated_at", timestamps())
            formdata.append("_token", $("#_token").val())

        return await post(location.origin+"/user_profile/update", formdata)
    }
    getCedula(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_profile/getCedula", formdata)
    }
    static validate() {
        let nacionalidad = $("#nacionalidad");
        let cedula = $("#cedula");
        let nombres = $("#nombres");
        let apellidos = $("#apellidos");
        let fnacimiento = $("#fnacimiento");
        let genero = $("#genero");
        let telefono_movil = $("#telefono_movil");
        if (nacionalidad.val() == "") {
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
            return false;
        }
        if (cedula.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { cedula.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //cedula.trigger("focus")
            return false;
        }
        if (nombres.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { nombres.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //nombres.trigger("focus")
            return false;
        }
        if (apellidos.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { apellidos.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //apellidos.trigger("focus")
            return false;
        }
        if (genero.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { genero.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //genero.trigger("focus")
            return false;
        }
        if (fnacimiento.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { fnacimiento.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //fnacimiento.trigger("focus")
            return false;
        }
        if (telefono_movil.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { telefono_movil.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //telefono_movil.trigger("focus")
            return false;
        }
        return true;
    }
    static create(selector) {
        //cosas por arreglar:
        //onkeyup="validarPrimerDigito('telefono_movil')"
        $(selector).html(`
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="nombre">Nombres</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="nombres" id="nombres" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="apellido">Apellidos</label>
                        <input  type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="genero">Género</label>
                        <select  class="form-control form-control-lg bg-gray-footer-parodi" name="genero" id="genero" aria-describedby="helpId" placeholder="">
                            <option value="">Seleccione</option>
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                        <input type="date"  class="form-control form-control-lg bg-gray-footer-parodi" name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="telefono_movil">Teléfono Contacto</label>
                        <input type="tel"  class="form-control form-control-lg bg-gray-footer-parodi" name="telefono_movil" id="telefono_movil" aria-describedby="helpId" placeholder="">
                        <small id="help_telefonomovil" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group extension_telefonica d-none">
                        <label class="label-text text-secondary" for="extension_telefonica">Asterísco</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="extension_telefonica" id="extension_telefonica" aria-describedby="helpId" placeholder="">
                        <small id="help_extension_telefonica" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group d-none">
                        <label class="label-text text-secondary" for="tipo_sangre">Grupo Sanguíneo</label>
                        <select  class="form-control form-control-lg bg-gray-footer-parodi" name="tipo_sangre" id="tipo_sangre" aria-describedby="helpId" placeholder="">
                            <option value="Lo desconozco">Lo desconozco</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
        `);

    }
    async validateCedula() {
        let nacionalidad = $("#nacionalidad");
        let cedula = $("#cedula");
        let formdata = new FormData();
        formdata.append("nacionalidad", nacionalidad.val())
        formdata.append("cedula", cedula.val())
        formdata.append("_token", $("#_token").val())
        //CatUserEspecialidad.jsreturn await post( location.origin+"/user_profile/cedulaExiste", formdata)
        let result = await get( location.origin+"/getPatient/"+cedula.val())
        console.log("cedula_encontrada->",result)
        return result
    }
    static async show(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_profile/show", formdata)
    }
    getCedula(cedula) {
        let formdata = new FormData();
        formdata.append("user_id", cedula)
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_profile/getCedula", formdata)
    }
}
