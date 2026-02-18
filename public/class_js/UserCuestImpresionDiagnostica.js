import UserCuestPaciente from "./UserCuestPaciente.js";
let userCuestPaciente = new UserCuestPaciente()

export default class UserCuestImpresionDiagnostica {

    static create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="h1 text-primary">
                Probabilidad diagnóstica
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
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)

        $("#user_cuest_model_store").on("click", function() {
            if (UserCuestImpresionDiagnostica.validate()) {
                UserCuestImpresionDiagnostica.store(user_id)
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
        return post(location.origin+"/user_cuest_impresion_diagnostica/store", formdata)

    }
    static store3(user_id,data) {
        let formdata = new FormData();

            formdata.append("value", data.value)
            formdata.append("user_id_paciente", data.user_id_paciente)
            formdata.append("episodio_id", data.episodio_id)
            formdata.append("created_at", timestamps())
            formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_impresion_diagnostica/store3", formdata)
    }
    static store2({user_id,identificador}){
        /*
        let diagn_ingre= []
        let diagn_ingre_c = $('input[name="diagn_ingre_c"]');
        let diagn_ingre_d = $('input[name="diagn_ingre_d"]');
        let diagn_ingre_v = $('input[name="diagn_ingre_v"]');

        for (let index = 0; index < diagn_ingre_c.length; index++) {

            if (
                diagn_ingre_v[index]['value'] != "" &&
                diagn_ingre_d[index]['value'] != "" &&
                diagn_ingre_c[index]['value'] != ""
            ) {

                diagn_ingre.push({
                    user_cuest_episodio_id,
                    id                 : $("#input-title-"+index).data('imp_diagn_id'),
                    value              : diagn_ingre_v[index]['value'],
                    cod_cie            : diagn_ingre_c[index]['value'],
                    cod_cie_description: diagn_ingre_d[index]['value']
                })
            }

        }*/


        let formdata = new FormData();
        formdata.append("model", JSON.stringify(diagn_ingre))
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_impresion_diagnostica/store2", formdata)
    }
    static update({user_id,user_cuest_imp_diagn_id,cod_cie,cod_cie_description,value,user_cuest_episodio_id}) {
        if (user_cuest_imp_diagn_id !==undefined) {
            let formdata = new FormData();
            formdata.append("user_cuest_imp_diagn_id", user_cuest_imp_diagn_id)
            formdata.append("value", value)
            formdata.append("cod_cie", cod_cie)
            formdata.append("cod_cie_description", cod_cie_description)
            formdata.append("user_cuest_episodio_id", user_cuest_episodio_id)
            formdata.append("user_id", user_id)
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            return post( location.origin+"/user_cuest_impresion_diagnostica/update", formdata)

        }
    }
    static update2(user_id_paciente,user_cuest_imp_diagn_id,model) {
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
                    formdata.append("id", user_cuest_imp_diagn_id)
                    formdata.append("value", $(`#input_${user_cuest_imp_diagn_id}_${model}`).val())
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())


                post( location.origin+"/user_cuest_impresion_diagnostica/update2", formdata)
                .then(response=>{
                    pacientes_datos.map(x=>{
                        if (x.user_id == user_id_paciente) {
                            x.resultados.map(y=>{
                                //console.log(y.id, user_cuest_imp_diagn_id)
                                if (y.id == user_cuest_imp_diagn_id && y.description=="Probabilidad diagnóstica") {
                                    //console.log("antes ",y)
                                    y.value = $(`#input_${user_cuest_imp_diagn_id}_${model}`).val()
                                    //console.log("despues ",y)
                                }
                            })
                        }
                    });
                    showHide(`#update_${user_cuest_imp_diagn_id}_${model}`)
                    showHide(`#description_${user_cuest_imp_diagn_id}_${model}`)

                    $(`#description_${user_cuest_imp_diagn_id}_${model}`).html($(`#input_${user_cuest_imp_diagn_id}_${model}`).val());



                })

            }
        })

    }
    static show(user_id) {
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_impresion_diagnostica/show/" + user_id, formdata)
    }

    static destroy2(user_id_paciente,user_cuest_imp_diagn_id) {
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

                get( location.origin+"/user_cuest_impresion_diagnostica/destroy/" + user_cuest_imp_diagn_id)
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
                            $(`#row_${user_cuest_imp_diagn_id}_impDiagn`).slideUp("slow");
                        })



                })

            }
        })

    }
    static destroy(id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            get( location.origin+"/user_cuest_impresion_diagnostica/destroy/" + id)
                .then(response => {
                    UserCuestHistoria.index('.modal-body', user_id)
                })
        }
    }
    static destroycie11(id, n) {
        var message = Component.alertMessage('destroy_row_cuestion');
            Swal.fire({
                icon: message['image'],
                title: message['message'],
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Si`,

            }).then((result) => {
                if (result.isConfirmed) {
                    get( location.origin+"/user_cuest_impresion_diagnostica/destroy/" + id)
                .then(response => {

                   $(`.row-impDiagn-${id}`).slideUp("slow");
                   !unde(n) ? $(`.row-impDiagn-${n}`).slideUp("slow")
                            : cl(n);
                })
                } else if (result.isDenied) {
                    //Swal.fire('Changes are not saved', '', 'info')
                }
            })

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
