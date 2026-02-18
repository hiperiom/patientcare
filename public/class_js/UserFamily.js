export default class UserFamily {
    create(selector) {
        $(selector).html(`

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="familiar_email">Correo Electrónico</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="familiar_email" id="familiar_email" aria-describedby="helpId" placeholder="">

                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="form-group">
                        <label class="label-text text-secondary" for="familiar_nombre">Nombres</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="familiar_nombre" id="familiar_nombre" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>

                    <div class="form-group">
                        <label class="label-text text-secondary" for="familiar_cedula">Documento de identidad</label>
                        <input type="number" class="form-control form-control-lg bg-gray-footer-parodi" name="familiar_cedula" id="familiar_cedula" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                    <div class="form-group">
                        <label class="label-text text-secondary" for="familiar_genero">Género</label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="familiar_genero" id="familiar_genero" aria-describedby="helpId" placeholder="">
                            <option value="">Seleccione</option>
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="familiar_apellido">Apellidos</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="familiar_apellido" id="familiar_apellido" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_family_id">Vínculo</label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_family_id" id="cat_user_family_id" aria-describedby="helpId" placeholder="">
                        <option value="">Seleccione</option>
                            <option value="1">Abuelo(a)</option>
                            <option value="2">Amigo(a)</option>
                            <option value="3">Esposo(a)</option>
                            <option value="4">Hermano(a)</option>
                            <option value="5">Hijo(a)</option>
                            <option value="6">Madre</option>
                            <option value="7">Padre</option>
                            <option value="8">Pareja</option>
                            <option value="9">Sobrino(a)</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                    <div class="form-group">
                        <label class="label-text text-secondary" for="familiar_telefono_movil">Teléfono Contacto</label>
                        <input type="number" class="form-control form-control-lg bg-gray-footer-parodi" name="familiar_telefono_movil" id="familiar_telefono_movil" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
        `);
    }

    async store(user_id) {
        let familiar_nombre = $("#familiar_nombre");
        let familiar_apellido = $("#familiar_apellido");
        let familiar_email = $("#familiar_email");
        let familiar_cedula = $("#familiar_cedula");
        let cat_user_family_id = $("#cat_user_family_id");
        let familiar_genero = $("#familiar_genero");
        let familiar_telefono_movil = $("#familiar_telefono_movil");

        let formdata = new FormData();
        formdata.append("familiar_nombre", familiar_nombre.val())
        formdata.append("familiar_apellido", familiar_apellido.val())
        formdata.append("familiar_email", familiar_email.val())
        formdata.append("familiar_cedula", familiar_cedula.val())
        formdata.append("cat_user_family_id", cat_user_family_id.val())
        formdata.append("familiar_genero", familiar_genero.val())
        formdata.append("familiar_telefono_movil", familiar_telefono_movil.val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_family/store", formdata)
    }
    validate() {
        let familiar_nombre = $("#familiar_nombre");
        let familiar_apellido = $("#familiar_apellido");
        let familiar_email = $("#familiar_email");
        let familiar_cedula = $("#familiar_cedula");
        let familiar_cat_user_family_id = $("#familiar_cat_user_family_id");
        let familiar_genero = $("#familiar_genero");
        let familiar_telefono_movil = $("#familiar_telefono_movil");


        if (familiar_nombre.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            familiar_nombre.trigger("focus")
            return false;
        }
        if (familiar_apellido.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            familiar_apellido.trigger("focus")
            return false;
        }
        if (familiar_cedula.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            familiar_cedula.trigger("focus")
            return false;
        }
        if (familiar_cat_user_family_id.val() == "") {
            message = Component.alertMessage("input_select_empty");
            alert(message['message'])
            familiar_cat_user_family_id.trigger("focus")
            return false;
        }
        if (familiar_telefono_movil.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            familiar_telefono_movil.trigger("focus")
            return false;
        }
        return true;
    }
}
