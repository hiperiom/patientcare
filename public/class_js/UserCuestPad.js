class UserCuestPad {
    static index(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mt-1">
                        <h1 class="text-primary">
                            PAD-COVID <span id="info" onclick="UserCuestPad.ayuda('.modal-body',${user_id})" data-tippy-content="Guía de información PAD" class="cursor-pointer text-success heartbeat float-right h5"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                        </h1>
                    </div>
                    <div id="user_cuest_model_create" class="text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nuevo PAD
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <div style="height:40vh;overflow:auto">
                        <table id="index_table" class="table table-bordered mb-3">
                            <tr>
                                <th class="text-primary text-center text-uppercase"></th>
                                <th class="text-primary text-center text-uppercase">PAD</th>
                                <th class="text-primary text-center text-uppercase">Ingreso al Pad</th>
                                <th class="text-primary text-center text-uppercase">Egreso</th>
                                <th class="text-primary text-center text-uppercase">Estatus</th>
                                <th class="text-primary text-center text-uppercase">Observación</th>
                                <th class="text-primary text-center text-uppercase">Acción</th>
                            </tr>
                            <tbody id="filas">

                                <tr>
                                    <td colspan="7" class="text-center">
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
        get( location.origin+"/user_cuest_pad/show/" + user_id)
            .then(response => {

                $("#filas").empty();
                if (response.length > 0) {
                    $(response).each(function(index, element) {
                        //console.log(element.img_description)
                        $("#filas").append(`
                            <tr id="model_${element.pad_id}">
                                <td class="text-primary text-center">
                                    <div id="imgpad_${element.pad_id}"></div>
                                </td>
                                <td class="text-primary text-center">${element.pad}</td>
                                <td class="text-primary text-center">
                                ${
                                    (element.ingreso!=null) ?
                                        element.ingreso
                                    :"<input id='ingreso_"+element.pad_id+"' onchange='UserCuestPad.updateDateIngreso({pad_id:"+element.pad_id+",user_id:"+user_id+"})' type='date' class='form-control'  data-tippy-content='Actualice la fecha de ingreso' >"
                                }
                                </td>
                                <td class="text-primary text-center">${element.egreso==""?'<button data-user_id="'+user_id+'" data-tippy-content="Dar alta médica del PAD '+element.pad+'" class="btn-alta btn-block btn btn-default">Alta</button>':element.egreso}</td>
                                <td class="text-primary text-center">${element.pago_valido}</td>
                                <td class="text-primary ">${element.observacion}</td>
                                <td class="text-primary">
                                    <a onclick="UserCuestPad.edit('.modal-body',${user_id},${element.pad_id})" class="btn btn-default btn-read"><i class="fas fa-edit" data-tippy-content="Actualizar información del PAD"></i></a>
                                    <a onclick="UserCuestPad.eliminar(${element.pad_id},${user_id})" class="btn btn-default btn-delete"><i class="fas fa-trash" data-tippy-content="Eliminar"></i></a>
                                    <!--<a class="btn btn-default btn-informe"><img loading="lazy" class="heartbeat" style="width: 20px;height: 20px;" data-tippy-content="Informe de egreso" src="${location.origin}/image/system/icono_archivo2.svg"></a>-->
                                </td>
                            </tr>
                        `);
                        tippy('[data-tippy-content]', {
                            theme: 'tooltip-cmdlt-primary',
                            zIndex: 200000
                        })
                        if (element.pad == "Covid") {
                            UserCuestPad.columnaValor(
                                `#col_pad_${user_id}`, {
                                    'user_id': user_id,
                                    'valor': element.img,
                                    'descripcion': element.img_description
                                });
                        }
                        UserCuestPad.columnaValor(
                            `#imgpad_${element.pad_id}`, {
                                'user_id': user_id,
                                'valor': element.img,
                                'descripcion': element.img_description
                            });



                        /*
                         */
                    });
                    $(".btn-alta").on('click', function() {
                        UserCuestUbicacion.egreso(".modal-body", $(this).data('user_id'))
                            /*
                            UserCuestPad.alta($(this).data('id'))
                                .then(response => {
                                    UserCuestPad.index('.modal-body', user_id)
                                })*/
                    });
                } else {
                    $("#filas").append(`
                        <tr>
                            <td colspan="7" class="text-center text-primary">Sin registros</td>
                        </tr>
                    `);
                }
            })

        $("#user_cuest_model_create").on('click', function() {
            UserCuestPad.create(".modal-body", user_id)
        });
        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
            zIndex: 200000
        })

    }
    static ayuda(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Información del PAD
                        </h1>
                    </div>
                    <h3 class="text-primary">
                        Colores del Estatus:
                    </h3>
                    <div class="table-responsive">
                        <table id="index_table" class="table table-bordered mb-3">

                            <tbody>
                            <tr>
                                <td><img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(0)}"></td>
                                <td>Indica que el PAD aún no ha sido ofrecido al paciente</td>
                            </tr>
                            <tr>
                                <td><img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(1)}"></td>
                                <td>Indica que el PAD ha sido ofrecido al paciente, pero aún no ha sido aceptado.</td>
                            </tr>
                            <tr>
                                <td><img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(2)}"></td>
                                <td>Indica que el PAD ha sido ofrecido y aceptado por el paciente, pero aún no se conoce la fuente de financiamiento.</td>
                            </tr>
                            <tr>
                                <td><img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(3)}"></td>
                                <td>Indica que el PAD ha sido ofrecido, aceptado y se conoce la fuente de financiamento, pero aún no ha sido validado.</td>
                            </tr>
                            <tr>
                                <td><img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(4)}"></td>
                                <td>Indica que PAD ha sido validado</td>
                            </tr>
                            <tr>
                                <td><img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(5)}"></td>
                                <td>Indica que PAD no ha sido aceptado, o no aplica, o falta información por confirmar.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a id="regresar" class='btn bg-primary text-primary btn-block btn-lg'>Regresar</a>
                </div>
            </div>
        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)


        $("#regresar").on('click', function() {
            UserCuestPad.index(".modal-body", user_id)
        });


    }
    static create(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Programa de Atención Domiciliaria
                </div>
            </div>
            <div id="form_pad"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);
        UserCuestPad.formPad("#form_pad")

        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            UserCuestPad.index(selector, user_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            if (UserCuestPad.validateForm()) {
                UserCuestPad.store(user_id)
                    .then(response => {
                        UserCuestPad.index('.modal-body', user_id)
                    });
            }
        });

    }
    static show(pad_id) {
        return get( location.origin+"/user_cuest_pad/show2/" + pad_id);
    }
    static edit(selector, user_id, pad_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div class="row mt-5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Programa de Atención Domiciliaria
                </div>
            </div>
            <div id="form_pad"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Actualizar</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);
        UserCuestPad.formPad("#form_pad")
        UserCuestPad.show(pad_id)
            .then(response => {
                $("#cat_user_pad_id").val(response.cat_user_pad_id).hide();
                $("#th_pad_select").append(`
                    <div class="mt-1 text-primary text-center">
                        ${response.description}
                    </div>
                `);
                $("#ofrecer").val(response.ofrecer)
                $("#aceptar").val(response.aceptar)
                $("#cat_fuente_f_id").val(response.cat_fuente_f_id)

                if ($("#cat_fuente_f_id").val() == 2) {
                    $(".th_aseguradora").toggle()
                } else {
                    $(".th_aseguradora").hide()
                }

                $("#cat_aseguradora_id").val(response.cat_aseguradora_id)
                $("#value1").val(response.value1)
                $("#value2").val(response.value2)
                $("#pago_valido").val(response.pago_valido)
            })

        $("#regresar").on("click", function() {
            UserCuestPad.index(selector, user_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            if (UserCuestPad.validateForm()) {
                UserCuestPad.update(pad_id)
                    .then(response => {
                        UserCuestPad.index('.modal-body', user_id)
                    });
            }
        });

    }
    static store(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("cat_user_pad_id", $("#cat_user_pad_id").val())
        formdata.append("ofrecer", $("#ofrecer").val())
        formdata.append("aceptar", $("#aceptar").val())
        formdata.append("cat_fuente_f_id", $("#cat_fuente_f_id").val())
        formdata.append("cat_aseguradora_id", $("#cat_aseguradora_id").val())
        formdata.append("value1", $("#value1").val())
        formdata.append("pago_valido", $("#pago_valido").val())
        formdata.append("value2", $("#value2").val())


        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_pad/store", formdata)
    }
    static update(pad_id) {
        let formdata = new FormData();
        formdata.append("pad_id", pad_id)
        formdata.append("cat_user_pad_id", $("#cat_user_pad_id").val())
        formdata.append("ofrecer", $("#ofrecer").val())
        formdata.append("aceptar", $("#aceptar").val())
        formdata.append("cat_fuente_f_id", $("#cat_fuente_f_id").val())
        formdata.append("cat_aseguradora_id", $("#cat_aseguradora_id").val())
        formdata.append("value1", $("#value1").val())
        formdata.append("pago_valido", $("#pago_valido").val())
        formdata.append("value2", $("#value2").val())


        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_pad/update", formdata)
    }
    static alta(pad_id) {
        let formdata = new FormData();
        formdata.append("pad_id", pad_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_pad/alta", formdata)
    }
    static destroy(id) {
        return get( location.origin+"/user_cuest_pad/destroy/" + id)
    }
    static eliminar(pad_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestPad.destroy(pad_id)
                .then(response => {
                    UserCuestPad.index('.modal-body', user_id)
                })
        }
    }
    static imgPad(value) {
        if (value == 0) {
            return '/image/system/icono_pad_0.png';
        }
        if (value == 1) {
            return '/image/system/icono_pad_1.png';
        }
        if (value == 2) {
            return '/image/system/icono_pad_2.png';
        }
        if (value == 3) {
            return '/image/system/icono_pad_3.png';
        }
        if (value == 4) {
            return '/image/system/icono_pad_4.png';
        }
        if (value == 5) {
            return '/image/system/icono_pad_5.png';
        }
        if (value == null) {
            return '/image/system/icono_pad_0.png';
        }
    }
    static color(valor){
        switch (valor) {
            case 0:
                return "tooltip-gray"
                break;
            case 1:
                return "tooltip-cyan"
                break;
            case 2:
                return "tooltip-primary"
                break;
            case 3:
                return "tooltip-warning"
                break;
            case 4:
                return "tooltip-success"
                break;
            case 5:
                return "tooltip-danger"
                break;
            default:
                return "tooltip-gray"
                break;
        }
    }
    static columnaValor(selector, data) {
        let themeClass = "tooltip-cmdlt-gray"
        switch (data.valor) {
            case 0:
                themeClass = "tooltip-cmdlt-gray"
                break;
            case 1:
                themeClass = "tooltip-cmdlt-cyan"
                break;
            case 2:
                themeClass = "tooltip-cmdlt-primary"
                break;
            case 3:
                themeClass = "tooltip-cmdlt-warning"
                break;
            case 4:
                themeClass = "tooltip-cmdlt-success"
                break;
            case 5:
                themeClass = "tooltip-cmdlt-danger"
                break;
            default:
                themeClass = "tooltip-cmdlt-gray"
                break;
        }
        let descripcion = "";
        if (data.descripcion == null) {
            descripcion = "PAD - Por Ofrecer"
        } else {
            descripcion = data.descripcion;
        }
        $(selector).html(`
            <a id="btn_pad_${data.user_id}" data-tippy-content="${descripcion}" onclick="UserCuestPad.index('.modal-body',${data.user_id})"class="h4 cursor-pointer">
                <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}${UserCuestPad.imgPad(data.valor)}">
            </a>
        `);
        tippy(`#btn_pad_${data.user_id}`, {
            theme: themeClass,
            zIndex: 200000
        })

        /*
        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
            zIndex: 200000
        })*/
    }
    static validateForm() {
        let cat_user_pad_id = $("#cat_user_pad_id")
        let ofrecer = $("#ofrecer")
        let aceptar = $("#aceptar")
        let cat_fuente_f_id = $("#cat_fuente_f_id")
        let cat_aseguradora_id = $("#cat_aseguradora_id")
        let value1 = $("#value1")
        let pago_valido = $("#pago_valido")
        if (cat_user_pad_id.val() == "") {
            message = Component.alertMessage("input_select_empty");
            alert(message['message'])
            cat_user_pad_id.trigger('focus')
            return false;
        }

        return true;
    }
    static formPad(selector) {
        $(selector).html(`
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table id="index_table" class="table table-bordered mb-3">
                            <tr>
                                <th class="text-primary text-center">PAD</th>
                                <th class="text-primary text-center">¿Ofrecido?</th>
                                <th class="text-primary text-center">¿Aceptado?</th>
                                <th class="text-primary text-center">Financiamiento</th>
                                <th class="text-primary th_aseguradora text-center" style="display:none">Aseguradora</th>
                                <th class="text-primary text-center">Estatus</th>
                            </tr>
                            <tbody id="filas">
                                <tr>
                                    <td id="th_pad_select">
                                        <select class="form-control bg-gray-footer-parodi" name="cat_user_pad_id" id="cat_user_pad_id">
                                            <option value="">Seleccione</option>
                                            <option value="1">Covid</option>
                                            <option value="2">Quirúrgico</option>
                                            <option value="3">Médico</option>
                                            <option value="4">Cardio</option>
                                            <option value="5">Oncología</option>
                                            <option value="6">Endocrino</option>


                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control bg-gray-footer-parodi" name="ofrecer" id="ofrecer">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control bg-gray-footer-parodi" name="aceptar" id="aceptar">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control bg-gray-footer-parodi" name="cat_fuente_f_id" id="cat_fuente_f_id">
                                            <option value="">Seleccione</option>
                                            <option value="1">Privado</option>
                                            <option value="2">Asegurado</option>
                                            <option value="3">Cortesía</option>
                                            <option value="4">Empleado</option>
                                            <option value="0">Otra</option>
                                        </select>
                                    </td>
                                    <td class="th_aseguradora" style="display:none">
                                        <select class="form-control bg-gray-footer-parodi" name="cat_aseguradora_id" id="cat_aseguradora_id">
                                            <option value="">Seleccione</option>
                                            <option value="1">VUMI</option>
                                            <option value="2">Best Doctors</option>
                                            <option value="3">Mercantil</option>
                                            <option value="4">Humanitas</option>
                                            <option value="5">Caracas</option>
                                            <option value="6">Qualitas</option>
                                        </select>
                                        <input type="text" placeholder="N° de poliza" class="form-control bg-gray-footer-parodi mt-1" name="value1" id="value1">

                                    </td>
                                    <td>
                                        <select class="form-control bg-gray-footer-parodi" name="pago_valido" id="pago_valido">
                                            <option value="">Seleccione</option>
                                            <option value="0">Por Validar</option>
                                            <option value="1">Validado</option>
                                            <option value="2">No Validado</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="value2" id="value2" rows="2" placeholder="Observación"></textarea>
                </div>
                </div>
            </div>
        `);
        $("#cat_fuente_f_id").on("change", function() {
            if ($(this).val() == 2) {
                $(".th_aseguradora").toggle("slow")
            } else {
                $(".th_aseguradora").hide("slow")
            }
        });
    }
    static async menuAccion(area, title) {

        $("#messageModal").modal("hide")
        $("#row_paciente").html(`
            <tr>
                <td colspan="18">
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Cargando...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </td>
            </tr>
        `)

        let vista = "/vistas/"+area
            get(vista)
                .then(response => {
                    pacientes_datos = response;
                    Component.filasViewCovid(response)
                    Component.titleArea({title:title,area:area})
                    $('#btnNotificaciones').empty();
                    Component.notification('#btnNotificaciones', {
                        route: '#',
                        name: 'Total Pacientes',
                        cantidad: pacientes_datos.length,
                        length
                    })
                    //activarTooltip()
            });

    }
    static async menuAccionEnfermeria(area, title) {

        $("#messageModal").modal("hide")
        $("#row_paciente").html(`
            <tr>
                <td colspan="18">
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Cargando...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </td>
            </tr>
        `)

        let vista = "/vistas/"+area
            get(vista)
                .then(response => {
                    pacientes_datos = response;
                    Component.ViewEnfermeria(response)
                    Component.titleArea({title:title,area:area})
                    $('#btnNotificaciones').empty();
                    Component.notification('#btnNotificaciones', {
                        route: '#',
                        name: 'Total Pacientes',
                        cantidad: pacientes_datos.length,
                        length
                    })
                    //activarTooltip()
            });

    }
    static menuPad(selector) {
        $("#messageModal").modal("show")
        $(selector).html( /*html */`
            <div id="form_pad">
                <div id="menuPatiencare" class="list-group">
                    <span class="text-primary font-weight-bold menu-pad-title"">
                        Menú PAD
                    </span>
                    <a
                        data-toggle="collapse"
                        href="#collapseEmergencia"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseEmergencia"
                        class="d-flex align-items-center list-group-item list-group-item-action">
                        <i class="pc-pad_emergencia font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                        PAD Emergencia
                    </a>
                    <div class="collapse" id="collapseEmergencia">
                        <div class="card mb-0 card-body py-0">
                            <a
                                id="m_Emergencia_1"
                                href="#"
                                data-area="pad_emergencia_adulto"
                                data-titlearea="PAD Emergencia Adulto"
                                class="border-0 menu-emergencia list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-pad_emergencia text-info"></i> Adulto
                            </a>
                            <a
                                id="m_Emergencia_2"
                                href="#"
                                data-area="pad_emergencia_pediatrica"
                                data-titlearea="PAD Emergencia Pediátrica"
                                class="border-0 menu-emergencia list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-pad_emergencia text-info"></i> Pediátrica
                            </a>
                        </div>
                    </div>
                    <a
                        data-toggle="collapse"
                        href="#collapsequirurgico"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapsequirurgico"
                        class="d-flex align-items-center list-group-item list-group-item-action">
                        <i class="pc-light-pad-quiru font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                        PAD Postquirúrgico
                    </a>
                    <div class="collapse" id="collapsequirurgico">
                        <div class="card mb-0 card-body py-0">
                            <a
                                id="m_quirurgico_1"
                                href="#"
                                data-area="pad_postquirurgico_amb"
                                data-titlearea="PAD Postquirúrgico Ambulatorio"
                                class="border-0 menu-postquirurgico list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-light-pad-quiru text-info"></i> Ambulatorio
                            </a>
                            <a
                                id="m_quirurgico_2"
                                href="#"
                                data-area="pad_postquirurgico_hosp"
                                data-titlearea="PAD Postquirúrgico Hospitalización"
                                class="border-0 menu-postquirurgico list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-light-pad-quiru text-info"></i> Hospitalización
                            </a>
                        </div>
                    </div>
                    <a
                        id="m_medico"

                        href="#"
                        role="button"
                        data-area="pad_medico"
                        data-titlearea="PAD Medico"
                        aria-expanded="false"
                        aria-controls="collapsemedico"
                        class="menu-medico d-flex align-items-center list-group-item list-group-item-action">
                        <i class="pc-light-pad-medico font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                        Médico
                    </a>
                    <!--<a  data-toggle="collapse" href="#collapseCardio" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action"><i class="pc-pad_cardiologia text-primary"></i> Cardiología</a>
                    <div class="collapse" id="collapseCardio">
                        <div class="card mb-0 card-body py-0">
                            <a id="m_cardio_1" href="#"  data-area="#" data-titlearea="Cardiología - Insuficiencia Cardíaca" class="border-0 menu-cardio-insuficiciencia list-group-item list-group-item-action">
                                <i class="pc-pad_cardiologia text-primary"></i> Insuficiencia Cardíaca
                            </a>
                            <a id="m_cardio_2" href="#"  data-area="#" data-titlearea="Cardiología - Hipertensión Arterial" class="border-0 menu-cardio-hipertension list-group-item list-group-item-action">
                                <i class="pc-pad_cardiologia text-primary"></i> Hipertensión Arterial
                            </a>
                        </div>
                    </div>
                    <a  data-toggle="collapse" href="#collapseEvento" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action">
                        <i class="fas fa-calendar-plus text-primary"></i> Eventos Especiales
                    </a>
                    <div class="collapse" id="collapseEvento">
                        <div class="card mb-0 card-body p-0">
                            <a  data-toggle="collapse" href="#collapseEvento2" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action">
                                <i class="fas fa-table-tennis text-primary"></i> Pádel Fabrice Pastor Cup
                            </a>
                            <div class="collapse" id="collapseEvento2">
                                <div class="card mb-0 card-body py-0">

                                    <a id="evento_1_2" href="#"  data-area="#" data-titlearea="Atencion Médica" class="border-0 menu-evento-2-2 list-group-item list-group-item-action">
                                        <i class="fas fa-filter text-primary"></i> Atencion Médica
                                    </a>

                                </div>
                            </div>
                            <a  data-toggle="collapse" href="#collapseEvento1" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action">
                                <i class="fas fa-table-tennis text-primary"></i> Pádel Fest
                            </a>
                            <div class="collapse" id="collapseEvento1">
                                <div class="card mb-0 card-body py-0">
                                    <a id="evento_1_1" href="#"  data-area="#" data-titlearea="Stand" class="border-0 menu-evento-1-1 list-group-item list-group-item-action">
                                        <i class="fas fa-filter text-primary"></i> Stand
                                    </a>
                                    <a id="evento_1_2" href="#"  data-area="#" data-titlearea="Atencion Médica" class="border-0 menu-evento-1-2 list-group-item list-group-item-action">
                                        <i class="fas fa-filter text-primary"></i> Atencion Médica
                                    </a>

                                </div>
                            </div>


                        </div>
                    </div>-->

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                    <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);

    }
    static menuPadEnfermeria(selector) {
        $("#messageModal").modal("show")
        $(selector).html( /*html */`
            <div id="form_pad">
                <div id="menuPatiencare" class="list-group">
                    <span class="text-primary font-weight-bold menu-pad-title"">
                        Menú PAD
                    </span>
                    <a
                        data-toggle="collapse"
                        href="#collapseEmergencia"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseEmergencia"
                        class="d-flex align-items-center list-group-item list-group-item-action">
                        <i class="pc-pad_emergencia font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                        PAD Emergencia
                    </a>
                    <div class="collapse" id="collapseEmergencia">
                        <div class="card mb-0 card-body py-0">
                            <a
                                id="m_Emergencia_1"
                                href="#"
                                data-area="pad_emergencia_adulto"
                                data-titlearea="PAD Emergencia Adulto"
                                class="border-0 menu-emergencia list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-pad_emergencia text-info"></i> Adulto
                            </a>
                            <a
                                id="m_Emergencia_2"
                                href="#"
                                data-area="pad_emergencia_pediatrica"
                                data-titlearea="PAD Emergencia Pediátrica"
                                class="border-0 menu-emergencia list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-pad_emergencia text-info"></i> Pediátrica
                            </a>
                        </div>
                    </div>
                    <a
                        data-toggle="collapse"
                        href="#collapsequirurgico"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapsequirurgico"
                        class="d-flex align-items-center list-group-item list-group-item-action">
                        <i class="pc-light-pad-quiru font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                        PAD Postquirúrgico
                    </a>
                    <div class="collapse" id="collapsequirurgico">
                        <div class="card mb-0 card-body py-0">
                            <a
                                id="m_quirurgico_1"
                                href="#"
                                data-area="pad_postquirurgico_amb"
                                data-titlearea="PAD Postquirúrgico Ambulatorio"
                                class="border-0 menu-postquirurgico list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-light-pad-quiru text-info"></i> Ambulatorio
                            </a>
                            <a
                                id="m_quirurgico_2"
                                href="#"
                                data-area="pad_postquirurgico_hosp"
                                data-titlearea="PAD Postquirúrgico Hospitalización"
                                class="border-0 menu-postquirurgico list-group-item p-2 list-group-item-action"
                            >
                                <i class="pc-light-pad-quiru text-info"></i> Hospitalización
                            </a>
                        </div>
                    </div>
                    <a
                        id="m_medico"

                        href="#"
                        role="button"
                        data-area="pad_medico"
                        data-titlearea="PAD Medico"
                        aria-expanded="false"
                        aria-controls="collapsemedico"
                        class="menu-medico d-flex align-items-center list-group-item list-group-item-action">
                        <i class="pc-light-pad-medico font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                        Médico
                    </a>
                    <!--<a  data-toggle="collapse" href="#collapseCardio" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action"><i class="pc-pad_cardiologia text-primary"></i> Cardiología</a>
                    <div class="collapse" id="collapseCardio">
                        <div class="card mb-0 card-body py-0">
                            <a id="m_cardio_1" href="#"  data-area="#" data-titlearea="Cardiología - Insuficiencia Cardíaca" class="border-0 menu-cardio-insuficiciencia list-group-item list-group-item-action">
                                <i class="pc-pad_cardiologia text-primary"></i> Insuficiencia Cardíaca
                            </a>
                            <a id="m_cardio_2" href="#"  data-area="#" data-titlearea="Cardiología - Hipertensión Arterial" class="border-0 menu-cardio-hipertension list-group-item list-group-item-action">
                                <i class="pc-pad_cardiologia text-primary"></i> Hipertensión Arterial
                            </a>
                        </div>
                    </div>
                    <a  data-toggle="collapse" href="#collapseEvento" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action">
                        <i class="fas fa-calendar-plus text-primary"></i> Eventos Especiales
                    </a>
                    <div class="collapse" id="collapseEvento">
                        <div class="card mb-0 card-body p-0">
                            <a  data-toggle="collapse" href="#collapseEvento2" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action">
                                <i class="fas fa-table-tennis text-primary"></i> Pádel Fabrice Pastor Cup
                            </a>
                            <div class="collapse" id="collapseEvento2">
                                <div class="card mb-0 card-body py-0">

                                    <a id="evento_1_2" href="#"  data-area="#" data-titlearea="Atencion Médica" class="border-0 menu-evento-2-2 list-group-item list-group-item-action">
                                        <i class="fas fa-filter text-primary"></i> Atencion Médica
                                    </a>

                                </div>
                            </div>
                            <a  data-toggle="collapse" href="#collapseEvento1" role="button" aria-expanded="false" aria-controls="collapseExample" class=" list-group-item list-group-item-action">
                                <i class="fas fa-table-tennis text-primary"></i> Pádel Fest
                            </a>
                            <div class="collapse" id="collapseEvento1">
                                <div class="card mb-0 card-body py-0">
                                    <a id="evento_1_1" href="#"  data-area="#" data-titlearea="Stand" class="border-0 menu-evento-1-1 list-group-item list-group-item-action">
                                        <i class="fas fa-filter text-primary"></i> Stand
                                    </a>
                                    <a id="evento_1_2" href="#"  data-area="#" data-titlearea="Atencion Médica" class="border-0 menu-evento-1-2 list-group-item list-group-item-action">
                                        <i class="fas fa-filter text-primary"></i> Atencion Médica
                                    </a>

                                </div>
                            </div>


                        </div>
                    </div>-->

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                    <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);

    }
    static updateDateIngreso(data) {
        var message = Component.alertMessage('update_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            let formdata = new FormData();
            formdata.append("user_id", data.user_id)
            formdata.append("pad_id", data.pad_id)
            formdata.append("ingreso", $("#ingreso_" + data.pad_id).val())
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            post( location.origin+"/user_cuest_pad/updateDateIngreso", formdata)
                .then(response => {
                    console.log("UpdateDateIngreso: ", response)
                    UserCuestPad.index(".modal-body", data.user_id)
                })
        }
    }
}
