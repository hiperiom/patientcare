class UserCuestEstudioDiagnostico {
    static create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="h1 text-primary">
                Estudio Diagnóstico
            </div>
            <div class="flex-fill mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="value" id="value" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
            <div class="input-group my-1 d-none">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">
                        <img style="width: 2em;height: 2em;" src="/image/system/carga1-success.svg">
                    </span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" aria-describedby="file">
                    <label class="custom-file-label" style="height: calc(2.7rem + 3px);" for="inputGroupFile01">Pulsa aquí para subir archivos</label>
                </div>
            </div>
            <div class="row d-none" id="file_temp">

            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success w-100 mr-1">Agregar</button>
                <button onclick="UserCuestHistoria.index('${selector}', ${user_id})" id="regresar" class="font-weight-bold btn btn-primary w-100">Regresar</button>
            </div>

        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)

        $("#user_cuest_model_store").on("click", function() {
            if (UserCuestEstudioDiagnostico.validate()) {
                UserCuestEstudioDiagnostico.store(user_id)
                    .then(response => {
                        UserCuestHistoria.getHistorial(user_id)
                        .then(response => {
                            if (Object.keys(response).length >0) {
                                pacientes_datos.map(x=>{
                                    if (x.user_id == user_id) {
                                        x.resultados = response;
                                    }
                                });
                            }else{
                                pacientes_datos.map(x=>{
                                    if (x.user_id == user_id) {
                                        x.resultados = [];
                                    }
                                });
                            }
                            UserCuestHistoria.index(".modal-body", user_id)
                        })
                    })
            }

        });


    }

    static store(user_id) {
        let formdata = new FormData();
        formdata.append("value", $("#value").val())
        formdata.append("coments", $("#coments").val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_estudio/store", formdata)
    }

    static destroy(id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            get( location.origin+"/user_cuest_estudio/destroy/" + id)
                .then(response => {
                    UserCuestHistoria.index('.modal-body', user_id)
                })
        }
    }
    static validate() {
        let value = $("#value");
        if (value.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            value.trigger("focus")
            return false;
        }
        return true;
    }

}
