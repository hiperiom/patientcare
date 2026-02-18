class UserCuestSintoma {
    static index(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                Síntomas
                </h1>
                <span id="user_cuest_model_create" class="text-shadow-drop-tl text-primary mr-2" style="float:right;font-size: 2rem !important; cursor:pointer;">
                    Nuevo valor
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </div>
            <div class="flex-fill overflow-auto mb-1">
                <table id="index_table" class="table table-bordered mb-3">
                    <tr>
                        <th class="text-primary text-center pl-2 pr-2">Fecha registro</th>
                        <th class="text-primary text-center pl-2 pr-2">Síntoma</th>
                        <th class="text-primary text-center pl-2 pr-2">Fecha inicio del síntoma</th>
                        <th class="text-primary text-center pl-2 pr-2">Observación</th>
                        <th class="text-primary text-center pl-2 pr-2">Acción</th>
                    </tr>
                    <tbody id="filas">
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex">
                <a class='btn btn-primary btn-block' data-dismiss="modal" aria-label="Close">Cerrar</a>

            </div>

        `);


        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        let formdata = new FormData();
        formdata.append("episodio_id", episodio_id);
        formdata.append("user_id", user_id);
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_sintoma/index", formdata)
            .then(response => {
                let filas = "";
                let tempRow = "";
                let dia = "";
                let count = 0;
                let m = "";
                let d = "";
                if (response.length > 0) {
                    $(response).each(function(index, element) {
                        d = new Date(element.registro);
                        if (dia != d.getDate()) {
                            dia = d.getDate();
                            count++;
                            m = count;
                        } else {
                            m = "";
                        }
                        tempRow = `
                            <tr id="temp_${element.id}">
                                <td nowrap class="text-center">${jsUcfirst(meses(d.getMonth()))+"/"+d.getDate()+" a las "+ formatAMPM(d)}</td>
                                <td class="text-center" id="modal-temp-${element.id}">${element.sintoma}</td>
                                <td class="text-center pl-2 pr-2">
                                    <span data-tippy-content='${element.dias} días transcurridos'>${element.since}</span>
                                </td>
                                <td class="text-center">
                                    ${element.observacion}
                                </td>

                                <td align="center">
                                <!-- <button title="Eliminar valor" onclick="UserCuestSintoma.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button>-->
                                </td>
                            </tr>
                        `;
                        filas = filas + tempRow
                    });
                } else {
                    filas = `
                        <tr>
                            <td colspan="6" class="text-center text-primary">Sin registros</td>
                        </tr>
                    `;
                }
                $("#filas").html(filas)
                /* tippy('[data-tippy-content]', {
                    theme: 'tooltip-cmdlt-primary',
                }) */
            })

        $("#user_cuest_model_create").on('click', function() {
            UserCuestSintoma.create(".modal-body", user_id,episodio_id)
        });
        $("#info").on("click", function() {
            UserCuestSintoma.help(selector, user_id);
        });
    }
    static create(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex ">
                <h1 class="h1 text-primary">
                    Síntomas
                </h1>
            </div>
            <div id="form" class="row flex-fill overflow-auto">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3 mb-3 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class=" mb-1">
                <h4 class="text-gray">Fecha inicio de los síntomas</h4>
                <input type="datetime-local" class="form-control bg-gray-footer-parodi" name="since" id="since" aria-describedby="helpId">
                <small id="helpId1" class="form-text text-muted notification"></small>
            </div>

            <div class="mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="sintoma_observacion" id="sintoma_observacion" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="mr-1 font-weight-bold btn btn-success w-100">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100">Regresar</button>
            </div>

        `);

        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/cat_user_cuestionario/sintomas", formdata)
            .then(response => {
                response.sort(function (a, b) {
                    if (a.description > b.description) {
                      return 1;
                    }
                    if (a.description < b.description) {
                      return -1;
                    }
                    // a must be equal to b
                    return 0;
                  });
                //let result2 = JSON.parse(response);
                let totalItemsXColumnas = Math.ceil(response.length / 3);
                let count = 1;
                let sintomas = "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>"
                $.each(response, function(indexInArray, valueOfElement) {
                    if (valueOfElement.id != 36) {
                        sintomas += `
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="user_cuest_model_store custom-control-input" value="${valueOfElement.id}" id="model_${valueOfElement.id}" name="model[]">
                                <label class="custom-control-label text-size-sintoma text-secondary" for="model_${valueOfElement.id}">${valueOfElement.description}</label>
                            </div>
                        `;
                        if (count == totalItemsXColumnas) {
                            sintomas += `
                                </div>
                                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
                            `;
                            count = 0;
                        }
                        count++;
                    }
                });

                sintomas += `
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="user_cuest_model_store custom-control-input" value="36" id="model_36" name="model[]">
                            <label class="custom-control-label text-size-sintoma text-secondary" for="model_36">Otros</label>
                        </div>
                    `;
                sintomas += `
                    </div>
                `;
                $("#form").html(sintomas)
                $("#model_36").on("click", function() {
                    $("#div_nuevo_sintoma").toggle("slow");
                });
            });

        $("#regresar").on("click", function() {
            UserCuestSintoma.index(selector, user_id,episodio_id)
        });
        $(`#user_cuest_model_store`).on('click', function() {
            UserCuestSintoma.store(this.id, user_id,episodio_id)
                .then(response => {
                    let valor = "";
                    $.each(response, function(indexInArray, valueOfElement) {
                        valor += valueOfElement['sintoma'];
                        if (indexInArray < (response.length - 1)) {
                            valor += ", ";
                        }
                    });
                    UserCuestSintoma.columnaValor(
                        `#col_13_${user_id}`, {
                            'user_id': user_id,
                            'valor': valor,
                            'episodio_id': episodio_id,
                        });
                    UserCuestSintoma.index('.modal-body', user_id,episodio_id)
                });
        });

    }
    static store(id, user_id,episodio_id) {
        let value = JSON.stringify($('[name="model[]"]').serializeArray());
        //let active              = $(`#${id}`).prop('checked');
        let formdata = new FormData();
        let created_at = timestamps();
        let since = $("#since");
        let sintoma_observacion = $("#sintoma_observacion");
        let sintoma_nuevo = $("#sintoma_nuevo");

        if (since.val() == "") {
            since = timestamps()
        } else {
            since = since.val();
        }
        formdata.append("episodio_id", episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("model", value)
            //formdata.append("active",active)
        formdata.append("since", since)
        formdata.append("sintoma_nuevo", sintoma_nuevo.val())
        formdata.append("created_at", created_at)
        formdata.append("sintoma_observacion", sintoma_observacion.val())
        formdata.append("_token", $("#_token").val())

        $("#since").val('');
        $("#sintoma_observacion").val('');
        return post( location.origin+"/user_cuest_sintoma/store", formdata)
    }
    static destroy(id, user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_sintoma/destroy ", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestSintoma.destroy(row_id)
                .then(response => {

                    if (response.length > 0) {
                        let valor = "";
                        $.each(response, function(indexInArray, valueOfElement) {
                            valor += valueOfElement['sintoma'];
                            if (indexInArray < (response.length - 1)) {
                                valor += ", ";
                            }
                        });
                        UserCuestSintoma.columnaValor(
                            `#col_13_${user_id}`, {
                                'user_id': user_id,
                                'valor': valor
                            });
                    } else {
                        $("#modelId").modal("hide")
                        UserCuestSintoma.columnaValor(
                            `#col_13_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    UserCuestSintoma.index('.modal-body', user_id)
                })
        }
    }
    static columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestSintoma.index('.modal-body',${data.user_id},${data.episodio_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    SÍNTOMA
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span>"+data.valor+"</span>"}
            </div>
        `);
    }

}
