class UserCuestOxigenoterapia {
    static index(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                    Dispositivo de Oxigenoterapia
                </h1>
                <span id="user_cuest_model_create" class="text-shadow-drop-tl text-primary mr-2" style="float:right;font-size: 2rem !important; cursor:pointer;">
                    Nuevo valor
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </div>
            <div class="flex-fill overflow-auto mb-1">
                <table id="index_table" class="table table-bordered mb-3">
                    <tr>
                        <th class="text-primary text-center">Fecha</th>
                        <th class="text-primary text-center">Dispositivo</th>
                        <th class="text-primary text-center">lpm</th>
                        <th class="text-primary text-center">Observación</th>
                        <th class="text-primary text-center">Acción</th>
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
        post( location.origin+"/user_cuest_oxigenoterapia/index", formdata).then(response => {
            let filas = "";
            let tempRow = "";
            let dia = "";
            let count = 0;
            let
                m = "";
            let d = "";
            if (response.length > 0) {
                $(response).each(function(index, element) {
                    d = new Date(element.created_at);
                    if (dia != d.getDate()) {
                        dia = d.getDate();
                        count++;
                        m = count;
                    } else {
                        m = "";
                    }
                    tempRow = `
                        <tr id="model_${element.id}">
                            <td class="text-center">${jsUcfirst(meses(d.getMonth()))+"/"+d.getDate()+" a las "+ formatAMPM(d)}</td>
                            <td class="text-center" id="modal-model-${element.id}">
                                ${element.dispositivo}
                            </td>
                            <td class="text-center">
                                ${element.lpm}
                            </td>
                            <td class="text-center">
                                ${(element.coments!=null)?element.coments:""}
                            </td>

                            <td align="center">
                            <!-- <button title="Eliminar valor" onclick="UserCuestOxigenoterapia.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button> -->
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
        })
        $("#user_cuest_model_create").on('click', function() {
            UserCuestOxigenoterapia.create(".modal-body", user_id,episodio_id)
        });
    }
    static create(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex ">
                <h1 class="h1 text-primary">
                 Dispositivo de Oxigenoterapia
                </h1>
            </div>
            <div class="d-flex mb-1">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 mr-1">
                    <select id="model" name="model" class="form-control bg-gray-footer-parodi form-control-lg">
                        <option value="104">Aire Ambiente</option>
                        <option value="105">BIPAP</option>
                        <option value="106">Canula Nasal</option>
                        <option value="107">CNAF</option>
                        <option value="108">CPAP</option>
                        <option value="109">Mascara con reservorio</option>
                        <option value="110">Mascara Simple</option>
                        <option value="111">VMI</option>
                        <option value="112">Otro</option>
                    </select>
                    <div id="sms_otro" class="bg-info m-2 text-center" style="display:none">
                        Indique en las observaciones el tipo de dispositivo de oxigenoterapia.
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <input type="number" class="form-control bg-gray-footer-parodi form-control-lg" name="value2" id="value2" placeholder="Lítros por minuto">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <input type="datetime-local" class="form-control form-control-lg bg-gray-footer-parodi" name="created_at" id="created_at" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <input type="number" placeholder="Presión" class="form-control form-control-lg bg-gray-footer-parodi" name="presion" id="presion" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="flex-fill mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="model_observacion" id="model_observacion" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="mr-1 font-weight-bold btn btn-success w-100">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100">Regresar</button>
            </div>

        `);


        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            UserCuestOxigenoterapia.index(selector, user_id,episodio_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            UserCuestOxigenoterapia.store(user_id,episodio_id)
                .then(response => {
                    UserCuestOxigenoterapia.columnaValor(
                        `#col_12_${user_id}`, {
                            'user_id': user_id,
                            'valor': response['description'],
                            'episodio_id': episodio_id,
                        });
                    UserCuestOxigenoterapia.index('.modal-body', user_id,episodio_id)
                });
        });
    }
    static store(user_id,episodio_id) {
        let message;
        let formdata = new FormData();
        let model_observacion = $("#model_observacion");
        let model_otro = $("#model_otro");
        let created_at = $("#created_at");
        var value = $("#model") //JSON.stringify($('[name="model[]"]').serializeArray());
        let value2 = $("#value2");
        let value3 = $("#value3");

        if (value2.val() == "") {
            value2 = "";
        } else {
            value2 = value2.val()
        }

        if (created_at.val() == "") {
            created_at = timestamps()
        } else {
            created_at = timestamps2(created_at.val())
        }
        formdata.append("episodio_id", episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("value", value.val())
        formdata.append("value2", value2)
        formdata.append("created_at", created_at)
        formdata.append("model_observacion", model_observacion.val())
        if (model_otro.css("display") == "block") {
            formdata.append("model_otro", model_otro.val())
        }
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_oxigenoterapia/store", formdata)
    }
    static destroy(id) {
        let formdata = new FormData();
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_oxigenoterapia/destroy", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestOxigenoterapia.destroy(row_id)
                .then(response => {
                    if (response != undefined) {
                        UserCuestOxigenoterapia.columnaValor(
                            `#col_12_${user_id}`, {
                                'user_id': user_id,
                                'valor': response['description']
                            });
                    } else {
                        $("#modelId").modal("hide")
                        UserCuestOxigenoterapia.columnaValor(
                            `#col_12_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    UserCuestOxigenoterapia.index('.modal-body', user_id)
                })
        }
    }
    static columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestOxigenoterapia.index('.modal-body',${data.user_id},${data.episodio_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    OXIGENOTERAPIA
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span>"+data.valor+"</span>"}
            </div>
        `);
    }
}
