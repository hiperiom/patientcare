class UserCuestOtroArchivo {

    static create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="h1 text-primary">
                Otro archivo
            </div>
            <div class="flex-fill">
                <textarea class="form-control bg-gray-footer-parodi " name="coments" id="coments" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
            <div class="input-group my-1">
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
            <div class="row" id="file_temp">

            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success w-100 mr-1">Agregar</button>
                <button onclick="UserCuestHistoria.index('${selector}', ${user_id})" id="regresar" class="font-weight-bold btn btn-primary w-100">Regresar</button>
            </div>

        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#file").on("change", function() {
            let file = document.getElementById(`file`).files[0];
            $(".custom-file-label").html(file.name);
            //console.log(file.name)
            $("#file_temp").html(`
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center">
                    <img class="img-fluid" style="height: 4em;width: 4em;margin: 0.5em;" src="${location.origin}/image/system/icono_archivo.svg">
                </div>
            `);
        });
        $("#user_cuest_model_store").on("click", function() {
            if (UserCuestOtroArchivo.validate()) {
                UserCuestOtroArchivo.store(user_id)
                    .then(response => {
                        UserCuestHistoria.index(".modal-body", user_id)
                    })
            }

        });

    }
    static store(user_id) {
        let episodio_id = pacientes_datos.find(x=>equalsInt(x['user_id'],user_id))['episodio']
        let formdata = new FormData();
        let value = $("#coments")
        let file = document.getElementById(`file`).files[0];
        formdata.append("coments", value.val())
        formdata.append("file", file)
        formdata.append("episodio_id", episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post("user_cuest_otro_archivo/store", formdata)

    }

    static destroy(id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            get( location.origin+"/user_cuest_otro_archivo/destroy/" + id)
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

                get( location.origin+"/user_cuest_otro_archivo/destroy/" + user_cuest_plan_id)
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
                            $(`#row_${user_cuest_plan_id}_result`).slideUp("slow");
                        })


                })

            }
        })

    }
    static validate() {
        let coments = $("#coments");
        let file = document.getElementById(`file`).files[0];

        if (file == undefined && coments.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            coments.trigger("focus")
            return false;
        }


        return true;
    }
}
