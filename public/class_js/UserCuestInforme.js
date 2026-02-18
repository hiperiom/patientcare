class UserCuestInforme {
    static index(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Informes
                        </h1>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <span id="user_cuest_model_create" class="text-shadow-drop-tl text-primary mr-2" style="float:right;font-size: 2rem !important; cursor:pointer;">
                        Nuevo informe
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div style="height:32vh;overflow:auto">
                        <table class="table table-bordered mb-3">
                            <tr>
                                <th class="text-primary text-center">Tipo</th>
                                <th class="text-primary text-center">Desde</th>
                                <th class="text-primary text-center">Hasta</th>
                                <th class="text-primary text-center">Generado por</th>
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
            <div class="botones-bottom-modal">
                <div>
                    <a class='btn bg-primary text-primary btn-block btn-lg' data-dismiss="modal" aria-label="Close">Cerrar</a>
                </div>
            </div>
        `);

        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#user_cuest_model_create").on("click", function() {
            UserCuestInforme.create(".modal-body", user_id)
            //$("#modelId").modal("hide")
            //UserCuestInforme.create_egreso({'user_id':user_id})
        });
        //UserCuestInforme.create("#user_cuest_informe_create", user_id)
        UserCuestInforme.getAll(user_id, "#filas");
        $(function() {
            $('#observaciones').summernote();
        });

    }
    static create(selector, user_id) {
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Nuevo Informe
                        </h1>
                        <h3>PAD - Covid</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-primary text-center">
                        Desde
                    </h3>
                    <input id="since" type="date" class="form-control form-control-lg bg-gray-footer-parodi">
                </div>
                <div class="col-md-6">
                    <h3 class="text-primary text-center">
                        Hasta
                    </h3>
                    <input id="until" type="date" class="form-control form-control-lg bg-gray-footer-parodi">
                </div>


                <div class="col-md-12">
                    <h3 class="text-primary text-center">
                        Observaciones
                    </h3>
                    <textarea id="observaciones" class="form-control form-control-lg bg-gray-footer-parodi" rows="3"></textarea>
                </div>

            </div>

            <div class="botones-bottom-modal">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>

            </div>
        `);

        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $(function() {
            $('#observaciones').summernote();
        });
        $("#regresar").on("click", function() {
            UserCuestInforme.index(".modal-body", user_id)
        });
        $("#user_cuest_model_store").on('click', function() {
            UserCuestInforme.store(user_id)
                .then(r => {
                    UserCuestInforme.index(".modal-body", user_id);
                });
        });
    }
    static create_egreso({selector=".modal-body", user_id}) {
        $("#modal-icd11").modal("show")
        /*
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Nuevo Egreso
                        </h1>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                </div>

                <div class="col-md-6">
                    <h3 class="text-primary text-center">
                        Desde
                    </h3>
                    <input id="since" type="date" class="form-control form-control-lg bg-gray-footer-parodi">
                </div>
                <div class="col-md-6">
                    <h3 class="text-primary text-center">
                        Hasta
                    </h3>
                    <input id="until" type="date" class="form-control form-control-lg bg-gray-footer-parodi">
                </div>


                <div class="col-md-12">
                    <h3 class="text-primary text-center">
                        Observaciones
                    </h3>
                    <textarea id="observaciones" class="form-control form-control-lg bg-gray-footer-parodi" rows="3"></textarea>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);*/

        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)

        $("#regresar").on("click", function() {
            UserCuestInforme.index(".modal-body", user_id)
        });
        $("#user_cuest_model_store").on('click', function() {

        });
    }
    static show(selector, user_id) {



        let user_cuest_user_informe = post( location.origin+"/user_cuest_user_informe/show", formdata)

    }

    static store(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("cat_user_informe_id", 1)
        formdata.append("since", $("#since").val() + tiempo())
        formdata.append("until", $("#until").val() + tiempo())
        formdata.append("coment", $("#observaciones").val())
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_informe/store", formdata);

    }
    edit(params) {

    }
    update(params) {

    }
    static destroy(user_cuest_informe_id, user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("user_cuest_informe_id", user_cuest_informe_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("deleted_at", timestamps())
        post( location.origin+"/user_cuest_informe/destroy", formdata)
            .then(r => {
                UserCuestInforme.index("#modal-body", user_id);
            })
    }
    static rowTableIndex(valueOfElement) {
        let tipo;
        switch (valueOfElement.cat_user_informe_id) {
            case 1:
                tipo = "PAD - Covid";
                break;
            case 2:
                tipo = "Egreso";
                break;
        }
        return `
            <tr id="row_index${valueOfElement.id}">
                <td class="text-center">
                    ${tipo}
                </td>
                <td class="text-center">
                    ${valueOfElement.since}
                </td>
                <td class="text-center">
                    ${valueOfElement.until}
                </td>
                <td class="text-center">
                    ${valueOfElement.nombres} ${valueOfElement.apellidos}
                </td>
                <td class="text-left">
                    <a ${valueOfElement.cat_user_informe_id!=2?"style='display:none;'":''} data-tippy-content="Clasificación CIE-11" target="_blank" class="btn btn-success" href="/clasificador_cie11/${valueOfElement.user_id}/${valueOfElement.value}"><i class="fas fa-book-medical"></i></a>
                    <a ${valueOfElement.cat_user_informe_id!=1?"style='display:none;'":''} data-tippy-content="Generar informe PAD-Covid" target="_blank" class="btn btn-success" href="/pdf/informeEgreso?user_cuest_informe_id=${valueOfElement.id}"><i class="fa fa-print"></i></a>
                    <a ${valueOfElement.cat_user_informe_id!=1?"style='display:none;'":''} data-tippy-content="Ver Observaciones" onclick="$('#obs${valueOfElement.id}').toggle('slow')" class="text-primary btn btn-outline-light"><i class="fa fa-search"></i></a>
                    <a ${"style='display:none;'"} data-tippy-content="Generar informe de Egreso" onclick="$('#obs${valueOfElement.id}').toggle('slow')" class="text-primary btn btn-outline-light"><i class="fa fa-search"></i></a>
                    <a ${valueOfElement.cat_user_informe_id!=1?"style='display:none;'":''} data-tippy-content="Eliminar informe" onclick="UserCuestInforme.destroy(${valueOfElement.id},${valueOfElement.user_id})" class="text-primary btn btn-outline-light" ><i class="fa fa-trash"></i></a>
                    <a ${valueOfElement.cat_user_informe_id!=2?"style='display:none;'":''} data-tippy-content="Eliminar informe" onclick="UserCuestInforme.destroy(${valueOfElement.id},${valueOfElement.user_id})" class="text-primary btn btn-outline-light" ><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <tr id="obs${valueOfElement.id}" style="display:none">
                <td colspan="5">
                    <textarea id="observaciones" class="form-control" rows="3">${valueOfElement.coments==undefined?"":valueOfElement.coments}</textarea>
                </td>
            </tr>
        `;

    }
    static getAll(user_id, selector) {
        let formdata = new FormData();
        formdata.append("user_id", user_id);
        formdata.append("_token", $("#_token").val());
        post( location.origin+"/user_cuest_informe/index", formdata)
            .then(response => {
                let row = "";
                if (response.length == 0) {
                    row += `
                    <tr>
                        <td colspan="5" class="text-center">
                            No existen informes
                        </td>
                    </tr>
                `;
                } else {
                    $.each(response, function(indexInArray, valueOfElement) {
                        row += UserCuestInforme.rowTableIndex(valueOfElement);
                    });
                }

                $(selector).html(row);
                tippy('[data-tippy-content]', {
                    theme: 'tooltip-cmdlt-primary',
                    zIndex: 200000
                })
            })
    }
}
