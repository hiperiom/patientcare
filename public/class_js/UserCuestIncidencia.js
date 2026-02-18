class UserCuestIncidencia {
    static index(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Incidencia PatientCare
                        </h1>
                    </div>
                    <div id="user_cuest_model_create" class="text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nueva Incidencia
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-3">
                            <tr>
                                <th class="text-primary text-center">Fecha</th>
                                <th class="text-primary text-center">Asunto</th>
                                <th class="text-primary text-center">Tipo</th>
                                <th class="text-primary text-center">Prioridad</th>
                                <th class="text-primary text-center">Estatus</th>
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
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a class='btn bg-primary text-primary btn-block btn-lg' data-dismiss="modal" aria-label="Close">Cerrar</a>
                </div>
            </div>
        `);

        let filas = "";
        let tempRow = "";
        tempRow = `
                        <tr id="inc_1">
                            <td class="text-right">
                                2/3/2021 | 10:58 PM
                            </td>
                            <td class="text-center font-weight-bold">Aumentar tamaño de fuente</td>
                            <td class="text-center">Funcionalidad</td>
                            <td class="text-center">
                                <span class="text-danger">1</span>
                            </td>
                            <td class="text-center">
                                <span class="text-gray">Por hacer</span>
                            </td>
                            <td align="center">
                                <button title="Ver" onclick="$("#inc__desc_1").toggle()" class="btn btn-info description" data-id="1"><i class="fa fa-search" aria-hidden="true"></i></button>
                                <button title="Eliminar valor" onclick="UserCuestIncidencia.eliminar(1,${user_id})" class="delete-row btn btn-danger" data-option="1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        <tr id="inc_desc_1" style="display:none">

                            <td colspan="6" class="">
                                <div class="bg-gray p-2">
                                    <b>De:</b> Hideon Kim Jim <b>|</b> Medicina General
                                </div>
                                <div id="summernote">Hello Summernote</div>

                            </td>

                        </tr>
                    `;
        filas = filas + tempRow
        $("#filas").html(filas)

        $("#user_cuest_model_create").on('click', function() {
            UserCuestIncidencia.create(".modal-body", user_id)
        });
        $(".description").on("click", function() {
            let id = $(this).data('id')
            $("#inc_desc_" + id).toggle("slow");
        });

        $(function() {
            $('#summernote').summernote();
        });


    }
    static create(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Temperatura  <span id="info" title="Ayuda" class="c-pointer text-success heartbeat float-right h5"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="number" class="form-control form-control-lg bg-light" name="value" id="value" aria-describedby="helpId" placeholder="Nuevo valor">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="datetime-local" class="form-control form-control-lg bg-light" name="created_at" id="created_at" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <textarea class="form-control form-control-lg bg-light mb-3" name="sintoma_observacion" id="sintoma_observacion" rows="2" placeholder="Observación"></textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="user_cuest_temperatura_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                </div>


            </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);

        $("#regresar").on("click", function() {
            UserCuestIncidencia.index(selector, user_id)
        });
        $("#user_cuest_model_store").on("click", function() {

        });

    }
    static store(user_id) {
        let message;
        let formdata = new FormData();
        let value = $("#value");
        let created_at = $("#created_at");
        let sintoma_observacion = $("#sintoma_observacion");
        if (value.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            value.focus()
            return false;
        }
        if (created_at.val() == "") {
            created_at = timestamps()
        } else {
            created_at = timestamps2(created_at.val())
        }
        formdata.append("user_id", user_id)
        formdata.append("cat_user_cuestionario_84", value.val())
        formdata.append("created_at", created_at)
        formdata.append("sintoma_observacion", sintoma_observacion.val())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_temperatura/store", formdata)
    }
    static destroy(id) {
        let formdata = new FormData();
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_temperatura/destroy", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            //let row_id = $(this).data("option")
            //UserCuestTemperatura.destroy(row_id)
            //.then(response => {
            //UserCuestTemperatura.index('.modal-body', user_id)
            // })
        }
    }
    static colorTemp(temp, selector) {
        $(selector).removeClass(["text-secondary", "text-cyan", "text-success", "text-danger"])
        if (temp <= 30.4) {
            $(selector).addClass("text-cyan")
        } else if (temp >= 30.5 && temp <= 37.5) {
            $(selector).addClass("text-success")
        } else if (temp >= 37.6 && temp <= 37.9) {
            $(selector).addClass("text-warning")
        } else if (temp >= 38) {
            $(selector).addClass("text-danger")
        }

        if (selector == 1) {
            if (temp <= 30.4) {
                return "text-cyan";
            } else if (temp >= 30.5 && temp <= 37.5) {
                return "text-success";
            } else if (temp >= 37.6 && temp <= 37.9) {
                return "text-warning";
            } else if (temp >= 38) {
                return "text-danger";
            }
        }
    }
    static help(selector, user_id) {
        $(selector).html(`
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1 class="text-primary">
                        Manual operativo de usuario
                    </h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <object id="pdfHolder" data="/help/temperatura.pdf" type="application/pdf" style="width:100%;height:500px;">
                        <a title="Pulse para descargar" href="/help/temperatura.pdf" download ><img src="/image/system/icono_archivo2.svg" ></a>
                    </object>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>

        `);
        $("#regresar").on("click", function() {
            //UserCuestTemperatura.index(selector, user_id)
        });
    }
}
