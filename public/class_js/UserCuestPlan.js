class UserCuestPlan {

    static create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="h1 text-primary">
            Plan
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
            if (UserCuestPlan.validate()) {
                UserCuestPlan.store(user_id)
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
        let episodio_id = pacientes_datos.find(x=>equalsInt(x['user_id'],user_id))['episodio']
        let formdata = new FormData();
        let value = $("#value")
        formdata.append("value", value.val())
        formdata.append("user_id", user_id)
        formdata.append("episodio_id", episodio_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/user_cuest_plan/store", formdata)

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
    static update2(user_id_paciente,plan_id,model) {
        //entrega de guardias
        var message = Component.alertMessage('update_row_cuestion');
        Swal.fire({
            icon: message['image'],
            title: message['message'],
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,

        }).then((result) => {
            if (result.isConfirmed) {
                let formdata = new FormData();
                    formdata.append("id", plan_id)
                    formdata.append("value", $(`#input_${plan_id}_${model}`).val())
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())


                post( location.origin+"/user_cuest_plan/update2", formdata)
                .then(response=>{
                    pacientes_datos.map(x=>{
                        if (x.user_id == user_id_paciente) {
                            x.resultados.map(y=>{
                                ///console.log(y.id, plan_id)
                                if (y.id == plan_id && y.description=="Plan") {
                                    //console.log("antes ",y)
                                    y.value = $(`#input_${plan_id}_${model}`).val()
                                    //console.log("despues ",y)
                                }
                            })
                        }
                    });
                    showHide(`#update_${plan_id}_${model}`)
                    showHide(`#description_${plan_id}_${model}`)

                    $(`#description_${plan_id}_${model}`).html($(`#input_${plan_id}_${model}`).val());



                })

            }
        })

    }
    static destroy(id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            get( location.origin+"/user_cuest_plan/destroy/" + id)
                .then(response => {
                    UserCuestHistoria.index('.modal-body', user_id)
                })
        }
    }
    static destroy2(user_id_paciente,user_cuest_plan_id) {
        //entrega de guardias
        var message = Component.alertMessage('destroy_row_cuestion');
        Swal.fire({
            icon: message['image'],
            title: message['message'],
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,

        }).then((result) => {
            if (result.isConfirmed) {

                get( location.origin+"/user_cuest_plan/destroy/" + user_cuest_plan_id)
                .then(response=>{
                    UserCuestHistoria.getHistorial(user_id_paciente)
                        .then(response => {
                            if (Object.keys(response).length >0) {
                                pacientes_datos.map(x=>{
                                    if (x.user_id == user_id_paciente) {
                                        x.resultados = response;
                                    }
                                });
                            }else{
                                pacientes_datos.map(x=>{
                                    if (x.user_id == user_id_paciente) {
                                        x.resultados = [];
                                    }
                                });
                            }
                            $(`#row_${user_cuest_plan_id}_plan`).slideUp("slow");
                        })


                })

            }
        })

    }
}
