import {get,post,jsUcfirst,meses,formatAMPM,timestamps,timestamps2} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
let userCuestPaciente = new UserCuestPaciente()

export default class UserCuestFc {
    static index(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                    Frecuencia Cardíaca
                </h1>
                <span id="user_cuest_model_create" class="text-shadow-drop-tl text-primary mr-2" style="float:right;font-size: 2rem !important; cursor:pointer;">
                    Nuevo valor
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </div>
            <div class="flex-fill overflow-auto mb-1">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th class="text-primary text-center">Fecha</th>
                        <th class="text-primary text-center">Valor</th>
                        <th class="text-primary text-center">Observación</th>
                        <th class="text-primary text-center">Acción</th>
                    </tr>
                    <tbody id="filas">
                        <tr>
                            <td colspan="5" class="text-center">
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


        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        let formdata = new FormData();
        formdata.append("user_id", user_id);
        formdata.append("episodio_id", episodio_id);
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_fc/show", formdata)
            .then(response => {
                let filas = "";
                let tempRow = "";
                let dia = "";
                let count = 0;
                let m = "";
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
                            <tr id="temp_${element.id}">
                                <td class="text-center">${jsUcfirst(meses(d.getMonth()) )+"/"+d.getDate()+" a las "+ formatAMPM(d)}</td>
                                <td class="text-center font-weight-bold ${UserCuestFc.colorFc(element.value,'historial')}" id="modal-temp-${element.id}">${element.value} <small>lat/min</small></td>
                                <td class="text-center">
                                    ${(element.coments!=null)?element.coments:""}
                                </td>
                                <td class="text-center">

                                </td>
                                <td align="center">
                                <!-- <button title="Eliminar valor" onclick="UserCuestFc.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button> -->
                                </td>
                            </tr>
                        `;
                        filas = filas + tempRow
                    });
                } else {
                    filas = `
                        <tr>
                            <td colspan="5" class="text-center text-primary">Sin registros</td>
                        </tr>
                    `;
                }
                $("#filas").html(filas)
            })

        $("#user_cuest_model_create").on('click', function() {
            UserCuestFc.create(".modal-body", user_id,episodio_id)
        });

    }
    static create(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex ">
                <h1 class="h1 text-primary">
                Frecuencia Cardíaca
                </h1>

            </div>
            <div class="d-flex mb-1">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 mr-1">
                    <input type="number" class="form-control bg-gray-footer-parodi" name="cat_user_cuestionario_185" id="cat_user_cuestionario_185" aria-describedby="helpId" placeholder="Nuevo valor">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0">
                    <input type="datetime-local" class="form-control bg-gray-footer-parodi" name="created_at" id="created_at" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="flex-fill mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="sintoma_observacion" id="sintoma_observacion" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="mr-1 font-weight-bold btn btn-success w-100">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100">Regresar</button>
            </div>

        `);


        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            UserCuestFc.index(selector, user_id,episodio_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            UserCuestFc.store(user_id,episodio_id)
                .then(response => {
                    let valor = $("#cat_user_cuestionario_185").val();
                    UserCuestFc.columnaValor(
                        `#col_7_${user_id}`, {
                            'user_id': user_id,
                            'valor': valor,
                            'episodio_id': episodio_id,
                        });
                    UserCuestFc.index('.modal-body', user_id,episodio_id)
                });
        });
    }
    static store(user_id,episodio_id) {
        let message;
        let formdata = new FormData();
        let cat_user_cuestionario_185 = $("#cat_user_cuestionario_185");
        let created_at = $("#created_at");
        let sintoma_observacion = $("#sintoma_observacion");
        if (cat_user_cuestionario_185.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            cat_user_cuestionario_185.on('focus')
            return false;
        }
        if (created_at.val() == "") {
            created_at = timestamps()
        } else {
            created_at = timestamps2(created_at.val())
        }
        formdata.append("episodio_id", episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("cat_user_cuestionario_185", cat_user_cuestionario_185.val())
        formdata.append("created_at", created_at)
        formdata.append("sintoma_observacion", sintoma_observacion.val())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_fc/store", formdata)
    }
    static store3(episodio_id,user_id,value) {
        let formdata = new FormData();

        formdata.append("episodio_id", episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("cat_user_cuestionario_185", value)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_fc/store", formdata)
    }
    static destroy(value) {
        let formdata = new FormData();
        formdata.append("id", value)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_fc/destroy", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            //let row_id = $(this).data("option")
            UserCuestFc.destroy(row_id)
                .then(response => {
                    UserCuestFc.index('.modal-body', user_id)
                })
        }
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestFc.destroy(row_id)
                .then(response => {
                    if (response.length > 0) {
                        UserCuestFc.columnaValor(
                            `#col_7_${user_id}`, {
                                'user_id': user_id,
                                'valor': response[0].value
                            });
                    } else {
                        $("#modelId").modal("hide")
                        UserCuestFc.columnaValor(
                            `#col_7_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    UserCuestFc.index('.modal-body', user_id)
                })
        }
    }
    static colorFc(value) {
        if (value < 55) {
            return "text-danger";
        }
        if (value >= 55 && value <= 59.9) {
            return "text-warning";
        }
        if (value >= 60 && value <= 100) {
            return "text-success";
        }
        if (value > 100) {
            return "text-danger";
        }
    }
    static columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestFc.index('.modal-body',${data.user_id},${data.episodio_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    F.C.
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span class='"+UserCuestFc.colorFc(data.valor)+"'>"+data.valor+" lat/min</span>"}
            </div>
        `);
    }
}
