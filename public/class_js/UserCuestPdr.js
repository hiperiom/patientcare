class UserCuestPdr {
    static index(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Prueba PDR
                        </h1>
                    </div>
                    <div id="user_cuest_model_create" class="text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nuevo valor
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <div  style="height:40vh;overflow:auto">
                        <table id="index_table" class="table table-bordered mb-3">
                            <tr>
                                <th class="text-primary text-center">Fecha</th>
                                <th class="text-primary text-center">Valor</th>
                                <th class="text-primary text-center">Observación</th>
                                <th class="text-primary text-center">Episodio</th>
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
        let formdata = new FormData();
        formdata.append("user_id", user_id);
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_pdr/index", formdata)
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
                        let valor = UserCuestPdr.columnaValor2(element)

                        tempRow = `
                            <tr id="model_${element.id}">
                                <td class="text-center">${jsUcfirst(meses(d.getMonth()))+"/"+d.getDate()+" a las "+ formatAMPM(d)}</td>
                                <td class="text-center font-weight-bold" id="modal-model-${element.id}">${valor}</td>
                                <td class="text-center">
                                    ${(element.coments!=null)?element.coments:""}
                                </td>
                                <td class="text-center">
                                </td>
                                <td align="center">
                                <!--  <button title="Eliminar valor" onclick="UserCuestPdr.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button>-->
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
            UserCuestPdr.create(".modal-body", user_id)
        });

    }
    static create(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Prueba PDR
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="input-group mb-3">

                        <select style="height: calc(2.25rem + 13px);" class="custom-select  form-control-lg bg-gray-footer-parodi" id="value1">
                            <option value="">Seleccione</option>
                            <option value="Negativo">Negativo</option>
                            <option value="Positivo">Positivo</option>
                            <option value="Indeterminado">Indeterminado</option>
                            <option value="No sabe">No sabe</option>
                        </select>
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">
                                <table>
                                    <tr>
                                        <td style="width: 3em;">
                                            <input type="checkbox" style="height: 1.5em;" class="form-control" value="Si" id="igm" name="igm">
                                        </td>
                                        <td>
                                            IgM
                                        </td>
                                    </tr>
                                </table>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="input-group mb-3">
                        <select style="height: calc(2.25rem + 13px);" class="custom-select  form-control-lg bg-gray-footer-parodi" id="value2">
                            <option value="">Seleccione</option>
                            <option value="Negativo">Negativo</option>
                            <option value="Positivo">Positivo</option>
                            <option value="Indeterminado">Indeterminado</option>
                            <option value="No sabe">No sabe</option>
                        </select>
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">
                                <table>
                                    <tr>
                                        <td style="width: 3em;">
                                            <input type="checkbox" style="height: 1.5em;" class="form-control" value="Si" id="igg" name="igg">
                                        </td>
                                        <td>
                                            IgG
                                        </td>
                                    </tr>
                                </table>
                            </label>
                        </div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="pcr form-group">
                    <label class="text-secondary text-size-sintoma" for="created_at">Fecha</label>
                    <input type="date" name="created_at" id="created_at" class="form-control form-control-lg bg-gray-footer-parodi" placeholder="" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="coments" id="coments" rows="2" placeholder="Observación"></textarea>
                </div>

            </div>

            <div class="botones-bottom-modal">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>

            </div>
        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            UserCuestPdr.index(selector, user_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            UserCuestPdr.store(user_id)
                .then(response => {
                    if (Object.keys(response).length > 0) {
                        //let valor = $("#value").val();

                        let valor = UserCuestPdr.columnaValor2(response)
                        UserCuestPdr.columnaValor(
                            `#col_15_${user_id}`, {
                                'user_id': user_id,
                                'valor': valor
                            });
                    }

                    UserCuestPdr.index('.modal-body', user_id)
                });
        });

    }
    static store(user_id) {
        let message;
        let formdata = new FormData();
        let value = $("#value1");
        let value2 = $("#value2");
        let created_at = $("#created_at");
        let coments = $("#coments");

        if (value.val() == "" && value2.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            value.trigger('focus')
            return false;
        }

        if (created_at.val() == "") {
            created_at = timestamps()
        } else {
            created_at = timestamps2(created_at.val())
        }

        formdata.append("value", value.val())
        formdata.append("igm", $("#igm").prop("checked"))

        formdata.append("value2", value2.val())
        formdata.append("igg", $("#igg").prop("checked"))

        formdata.append("user_id", user_id)
        formdata.append("created_at", created_at)
        formdata.append("coments", coments.val())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_pdr/store", formdata)
    }
    static destroy(id) {
        let formdata = new FormData();
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_pdr/destroy", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestPdr.destroy(row_id)
                .then(response => {
                    if (response.length > 0) {
                        UserCuestPdr.columnaValor(
                            `#col_15_${user_id}`, {
                                'user_id': user_id,
                                'valor': response[0].value
                            });
                    } else {
                        $("#modelId").modal("hide")
                        UserCuestPdr.columnaValor(
                            `#col_15_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    UserCuestPdr.index('.modal-body', user_id)
                })
        }
    }
    static colorPdr(value) {
        if (value == 'Positivo') {
            return 'text-danger';
        }
        if (value == 'Negativo') {
            return 'text-success';
        }
        if (value == 'Indeterminado') {
            return 'text-warning';
        }
        if (value == 'No sabe') {
            return 'text-cyan';
        }
    }
    static columnaValor2(element) {
        let valor = "";
        /*
            Negativo -- 0      = IgM
            Positivo -- 0      = IgM
            Negativo -- null      = IgM
            Positivo -- null      = IgM
            Indeterminado -- null = IgM
            No sabe -- null       = IgM

            Negativo -- 0      = IgG
            Positivo -- 0      = IgG
            Negativo -- null      = IgG
            Positivo -- null      = IgG
            Indeterminado -- null = IgG
            No sabe -- null       = IgG

            Negativo -- 1         = IgM -
            Positivo -- 1         = IgM +

        */
        if (
            (element.value == "Negativo" && element.igm == 0) ||
            (element.value == "Positivo" && element.igm == 0) ||
            (element.value == "Indeterminado" && element.igm == 0) ||
            (element.value == "No sabe" && element.igm == 0) ||
            (element.value == "Indeterminado" && element.igm == null) ||
            (element.value == "No sabe" && element.igm == null) ||
            (element.value == "Negativo" && element.igm == null) ||
            (element.value == "Positivo" && element.igm == null)
        ) {
            valor = `
            <span class="text-secondary">IgM</span>
                `;
        }
        if (
            (element.value == "Negativo" && element.igm == 1)
        ) {
            valor = `
            <span class="text-secondary">IgM</span> <span class="text-success">-</span>
                `;
        }
        if (
            (element.value == "Positivo" && element.igm == 1)
        ) {
            valor = `
            <span class="text-secondary">IgM</span> <span class="text-danger">+</span>
                `;
        }

        if (
            (element.value2 == "Negativo" && element.igg == 0) ||
            (element.value2 == "Positivo" && element.igg == 0) ||
            (element.value2 == "Indeterminado" && element.igg == 0) ||
            (element.value2 == "No sabe" && element.igg == 0) ||
            (element.value2 == "Indeterminado" && element.igg == null) ||
            (element.value2 == "No sabe" && element.igg == null) ||
            (element.value2 == "Negativo" && element.igg == null) ||
            (element.value2 == "Positivo" && element.igg == null)
        ) {
            valor += `
            <span class="text-secondary">IgG</span>
                `;
        }
        if (
            (element.value2 == "Negativo" && element.igg == 1)
        ) {
            valor += `
            <span class="text-secondary">IgG</span> <span class="text-success">-</span>
                `;
        }
        if (
            (element.value2 == "Positivo" && element.igg == 1)
        ) {
            valor += `
            <span class="text-secondary">IgG</span> <span class="text-danger">+</span>
                `;
        }
        return valor;


    }
    static columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestPdr.index('.modal-body',${data.user_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    PDR
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":data.valor}
            </div>
        `);
    }
}
