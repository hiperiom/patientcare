class UserCuestEvolucion {

    static create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="h1 text-primary">
                Evolución
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
            if (UserCuestEvolucion.validate()) {
                UserCuestEvolucion.store(user_id)
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
        let value = $("#value")
        formdata.append("value", value.val())
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_evolucion/store", formdata)

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
    static getAll(selector, user_id) {
        $.getJSON("/paciente/getHistorial", { "user_id": user_id },
            function(data, textStatus, jqXHR) {

                let chat = "";
                let fecha;
                let tempFecha;
                let f;
                if (data.length > 0) {
                    $.each(data, function(indexInArray, value) {
                        f = new Date(value.created_at);
                        fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                        if (tempFecha != fecha) {
                            chat += `
                                <div class="time-label">
                                    <span class="bg-primary">
                                        ${fecha}
                                    </span>
                                </div>
                            `;
                            tempFecha = fecha
                        }

                        if (tempFecha == fecha) {

                            let dato = `<textarea  readonly class="form-control">${value.value.replace('/\n/g', '<br>')}</textarea>`

                            if (value.description == "Laboratorio") {
                                dato = `
                                    <img onclick="window.open('image/user/laboratorio/${value.value}', '_blank')" style="cursor:pointer;width: 20%;" class="ampliar zoom img-fluid" src='image/user/laboratorio/${value.value}'>
                                    <br>${value.coments!=undefined?value.coments:""}
                                `;
                            }
                            if (value.description == "Fotografías") {
                                dato = `
                                    <img onclick="window.open('image/user/fotografia/${value.value}', '_blank')" style="cursor:pointer;width: 20%;" class="ampliar zoom img-fluid" src='image/user/fotografia/${value.value}'>
                                    <br>${value.coments!=undefined?value.coments:""}`;
                            }
                            if (value.description == "Solicitud de Estudio Diagnóstico") {
                                dato = `
                                    <img onclick="window.open('image/user/estudio/${value.value}', '_blank')" style="cursor:pointer;width: 20%;" class="ampliar zoom img-fluid" src='image/user/estudio/${value.value}'>
                                    <br>${value.coments!=undefined?value.coments:""}
                                    `;
                            }
                            if (value.description == "Otro") {
                                dato = `
                                    <img onclick="window.open('image/user/archivo_informe/${value.value}', '_blank')" style="cursor:pointer;width: 20%;" class="ampliar zoom img-fluid" src='image/user/archivo_informe/${value.value}'>
                                    <br>${value.coments!=undefined?value.coments:""}`;
                            }

                            if (value.description == "Laboratorio" && getFileExtension1(value.value) == "pdf") {
                                dato = `
                                    <img onclick="window.open('image/user/laboratorio/${value.value}', '_blank')" style="cursor:pointer;width: 50px;" class="ampliar zoom img-fluid" src='image/system/icono_laboratorio.svg'>
                                    <br>${value.coments!=undefined?value.coments:""}`;
                            }
                            if (value.description == "Otro" && getFileExtension1(value.value) == "pdf") {
                                dato = `
                                        <img onclick="window.open('image/user/archivo_informe/${value.value}', '_blank')" style="cursor:pointer;width: 50px;" class="ampliar zoom img-fluid" src='image/system/icono_archivo.svg'>
                                        <br>${value.coments!=undefined?value.coments:""}`;
                            }
                            if (value.description == "Solicitud de Estudio Diagnóstico" && getFileExtension1(value.value) == "pdf") {
                                dato = `
                                        <img onclick="window.open('image/user/estudio/${value.value}', '_blank')" style="cursor:pointer;width: 50px;" class="ampliar zoom img-fluid" src='image/system/icono_estudio.svg'>
                                        <br>${value.coments!=undefined?value.coments:""}`;
                            }
                            if (getFileExtension1(value.value) == undefined) {
                                dato = `
                                        <textarea  readonly class="form-control">${value.value.replace('/\n/g', '<br>')}</textarea>`;
                            }

                            chat += `
                                <div>

                                    <i class="fas fa-user-md bg-primary" aria-hidden="true"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> ${f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds()}</span>

                                        <h3 class="timeline-header"><a href="#">Dr ${value.medico}</a> | <b>${value.description}</b></h3>

                                        <div class="timeline-body" style="font-size: 0.5em;white-space: break-spaces;">
                                                ${dato}

                                        </div>
                                        <div class="timeline-footer">

                                        </div>
                                    </div>
                                </div>
                            `;
                        }



                    });
                } else {
                    chat += `
                        <div>
                            <div class="timeline-item">
                                <div class="timeline-body text-center text-primary font-weight-bold" style="font-size: 0.5em;white-space: break-spaces;">
                                    No posee historial
                                </div>
                            </div>
                        </div>
                    `;
                }

                $(selector).html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                                <div class="timeline timeline-inverse">
                                    ${chat}
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                `).slideDown("slow");

            }
        );
    }
    static destroy(id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            get( location.origin+"/user_cuest_evolucion/destroy/" + id)
                .then(response => {
                    UserCuestHistoria.index('.modal-body', user_id)
                })
        }
    }
}
