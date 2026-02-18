class UserCuestTac {
    static index(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            TAC
                        </h1>
                    </div>
                    <div id="user_cuest_model_create" class="text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nuevo Tac
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <div  style="height:32vh;overflow:auto">
                        <table id="index_table" class="table table-bordered mb-3">
                            <tr>
                                <th class="text-primary text-center pl-2 pr-2">Fecha registro</th>
                                <th class="text-primary text-center pl-2 pr-2">Tac</th>
                                <th class="text-primary text-center pl-2 pr-2">Fecha TAC</th>
                                <th class="text-primary text-center pl-2 pr-2">Observación</th>
                                <th class="text-primary text-center pl-2 pr-2">Episodio</th>
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
                </div>
            </div>
            <div class="botones-bottom-modal">
                <div>
                    <a class='btn bg-primary text-primary btn-block btn-lg' data-dismiss="modal" aria-label="Close">Cerrar</a>
                </div>
            </div>
        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        let formdata = new FormData();
        formdata.append("user_id", user_id);
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_tac/index", formdata)
            .then(response => {
                let filas = "";
                let tempRow = "";
                let dia = "";
                let count = 0;
                let m = "";
                let d = "";
                if (response.length > 0) {
                    console.log(response)

                    $(response).each(function(index, element) {

                        d = new Date(element.registro);
                        if (dia != d.getDate()) {
                            dia = d.getDate();
                            count++;
                            m = count;
                        } else {
                            m = "";
                        }
                        let archivo = "";
                        if (element.file != null) {
                            if (element.file_type == "jpg" ||
                                element.file_type == "jpeg" ||
                                element.file_type == "png" ||
                                element.file_type == "gif"
                            ) {
                                archivo += `<a href="${element.file}" target="_blank" class="btn btn-light text-primary"><i class="fas fa-image"></i></a>`;
                            }
                            if (element.file_type == "mp4" ||
                                element.file_type == "3gp"
                            ) {
                                archivo += `<a href="${element.file}" target="_blank" class="btn btn-light text-primary"><i class="fas fa-video"></i></a>`;
                            }
                        }
                        tempRow = `
                            <tr id="model_${element.id}">
                                <td nowrap class="text-center">${jsUcfirst(meses(d.getMonth()))+"/"+d.getDate()+" a las "+ formatAMPM(d)}</td>
                                <td class="text-center" id="modal-model-${element.id}">${element.tac}</td>
                                <td class="text-center pl-2 pr-2">
                                    <span data-tippy-content='${element.dias} días transcurridos'>${element.since}</span>
                                </td>
                                <td class="text-center">
                                    ${element.observacion}
                                    ${archivo}
                                </td>
                                <td class="text-center pl-2 pr-2">
                                    ${element.episodio}
                                </td>
                                <td align="center">
                                <!-- <button title="Eliminar valor" onclick="UserCuestTac.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button> -->
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
                tippy('[data-tippy-content]', {
                    theme: 'tooltip-cmdlt-primary',
                })
            })

        $("#user_cuest_model_create").on('click', function() {
            UserCuestTac.create(".modal-body", user_id)
        });
        $("#info").on("click", function() {
            UserCuestTac.help(selector, user_id);
        });
    }
    static create(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    TAC
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3 mb-3 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h4 class="text-gray">Fecha TAC</h4>
                    <input type="datetime-local" class="form-control form-control-lg bg-gray-footer-parodi" name="since" id="since" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="row mt-3 mb-1">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="coments" id="coments" rows="2" placeholder="Observación"></textarea>
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
            </div>

            <div class="form-group text-center">
                <input type="file" onchange="return fileValidation(this.id)" class="form-control form-control-lg bg-gray-footer-parodi" name="file" id="file" aria-describedby="helpId" placeholder="">
                <small id="helpId1" class="form-text text-muted"></small>
            </div>

            <div class="botones-bottom-modal">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>

            </div>
        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        get( location.origin+"/cat_user_cuestionario/show/100")
            .then(response => {
                //let result2 = JSON.parse(response);
                let totalItemsXColumnas = Math.ceil(response.length / 3);
                let count = 1;
                let modelHtml = "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>"
                $.each(response, function(indexInArray, valueOfElement) {
                    modelHtml += `
                        <div class="${valueOfElement['id']==122?'sms_otro':''}  custom-control custom-checkbox">
                            <input type="checkbox" class="user_cuest_model_store custom-control-input" value="${valueOfElement.id}" id="model_${valueOfElement.id}" name="model[]">
                            <label class="custom-control-label text-size-sintoma text-secondary" for="model_${valueOfElement.id}">${valueOfElement.description}</label>
                        </div>
                    `;
                    if (valueOfElement['id'] == 122) {
                        modelHtml += `
                            <div id="sms_otro" class="bg-info m-2 text-center" style="display:none">
                                Indique en las observaciones el tipo de TAC.
                            </div>
                        `;
                        $(".sms_otro").on("click", function() {
                            $("#sms_otro").toggle('slow');
                        });
                    }
                    if (count == totalItemsXColumnas) {
                        modelHtml += `
                            </div>
                            <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
                        `;
                        count = 0;
                    }
                    count++;
                });
                modelHtml += `
                    </div>
                `;
                $("#form").html(modelHtml)
                $(".sms_otro").on("click", function() {
                    $("#sms_otro").show('slow');
                });
            });


        $("#regresar").on("click", function() {
            UserCuestTac.index(selector, user_id)
        });
        $(`#user_cuest_model_store`).on('click', function() {
            UserCuestTac.store(this.id, user_id)
                .then(response => {
                    console.log(response)
                    let valor = "";
                    $.each(response, function(indexInArray, valueOfElement) {
                        valor += valueOfElement['tac'];
                        if (indexInArray < (response.length - 1)) {
                            valor += ", ";
                        }
                    });
                    UserCuestTac.columnaValor(
                        `#col_17_${user_id}`, {
                            'user_id': user_id,
                            'valor': valor
                        });
                    UserCuestTac.index('.modal-body', user_id)
                });
        });

    }
    static store(id, user_id) {
        let value = JSON.stringify($('[name="model[]"]').serializeArray());
        let formdata = new FormData();
        let created_at = timestamps();
        let since = $("#since");
        let coments = $("#coments");
        let file = document.getElementById(`file`).files[0];
        if (since.val() == "") {
            document.getElementById(`file`)
            since = created_at
        } else {
            since = since.val();
        }
        formdata.append("user_id", user_id)
        formdata.append("model", value)
        formdata.append("since", since)
        formdata.append("file", file)
        formdata.append("created_at", created_at)
        formdata.append("coments", coments.val())
        formdata.append("_token", $("#_token").val())

        return post( location.origin+"/user_cuest_tac/store", formdata)
    }
    static destroy(id, user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_tac/destroy ", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestTac.destroy(row_id)
                .then(response => {

                    if (response.length > 0) {
                        let valor = "";
                        $.each(response, function(indexInArray, valueOfElement) {
                            valor += valueOfElement['tac'];
                            if (indexInArray < (response.length - 1)) {
                                valor += ", ";
                            }
                        });
                        UserCuestTac.columnaValor(
                            `#col_17_${user_id}`, {
                                'user_id': user_id,
                                'valor': valor
                            });
                    } else {
                        $("#modelId").modal("hide")
                        UserCuestTac.columnaValor(
                            `#col_17_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    UserCuestTac.index('.modal-body', user_id)
                })
        }
    }

    static columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestTac.index('.modal-body',${data.user_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    TAC
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span>"+data.valor+"</span>"}
            </div>
        `);
    }

}
