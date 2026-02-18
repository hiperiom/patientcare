import {get,post,fotoTemporal,loading,meses,fechaAMD2,is_null,activarTooltip,is_empty, timestamps, telefonoConfig, is_undefined, select} from "../helpers/helpers.js";
import CatUserEstado from "./CatUserEstado.js";
import CatUserMunicipio from "./CatUserMunicipio.js";

let catUserEstado = new CatUserEstado();
let catUserMunicipio = new CatUserMunicipio();

export default class UserCuestDireccion {
    index(selector, user_id) {
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente"><div>
            <div class="row mt-5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div>
                        <h1 class="text-primary">
                            Temperatura <span id="info" title="Ayuda" class="c-pointer text-success heartbeat float-right h5"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                        </h1>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div id="user_cuest_temperatura_create" class="text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nuevo valor
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <canvas id="chart_0" style="height:40vh; width:100vw"></canvas>
                </div>h
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-3">
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
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a class='btn bg-primary text-primary btn-block btn-lg' data-dismiss="modal" aria-label="Close">Cerrar</a>
                </div>
            </div>
        `);
        Paciente.InfoPaciente("#infoPaciente", user_id)
        var colorTemp = 1;
        var bordeGrafico = "#2FA600"
        var fondoGrafico = "#2fa60078"
        if (colorTemp == 1) {
            //verde
            bordeGrafico = "green"
            fondoGrafico = "#2fa60078";
        }
        if (colorTemp == 2) {
            //amarillo
            bordeGrafico = "green"
            fondoGrafico = "#2fa60078";
        }
        if (colorTemp == 3) {
            //rojo
            fondoGrafico = "#2FA600";
        }
        /*** */
        var data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            datasets: [{
                label: "Dataset #1",
                backgroundColor: fondoGrafico,
                borderColor: bordeGrafico,
                borderWidth: 2,
                hoverBackgroundColor: "rgba(255,99,132,0.4)",
                hoverBorderColor: "rgba(255,99,132,1)",
                data: [65, 59, 20, 81, 56, 55, 40],
            }]
        };

        var option = {
            responsive: true,
            scales: {
                yAxes: [{
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }, {
                    type: 'time',
                    time: {
                        displayFormats: {
                            quarter: 'DD MMM YYYY'
                        },
                        tooltipFormat: 'DD [de] MMM [de] YYYY',
                    },
                    stacked: true,
                    ticks: {
                        fontSize: 10,
                        //maxRotation: 50, // angle in degrees
                    },
                }]
            },

            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            backgroundColor: 'rgba(60, 141, 188, 0.2)',
                            borderColor: 'rgba(60, 141, 188,1)'
                        }
                    },
                    label: function(tooltipItem, data) {
                        return '#: ' + tooltipItem.yLabel;
                    }
                }
            },

            elements: {
                line: {
                    tension: 0,
                }
            },
            animation: {
                duration: 500, // general animation time
            },
            hover: {
                animationDuration: 500, // duration of animations when hovering an item
            },
            responsiveAnimationDuration: 500 // animation duration after a resize
        };

        Chart.Line('chart_0', {
            options: option,
            data: data
        });
        let that = this
        /** */
        let formdata = new FormData();
        formdata.append("user_id", user_id);
        formdata.append("_token", $("#_token").val())
        post(location.origin+"/user_cuest_temperatura/index", formdata)
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
                                <td class="text-center">${jsUcfirst(meses(d.getMonth()))+"/"+d.getDate()+" a las "+ formatAMPM(d)}</td>
                                <td class="text-center font-weight-bold ${that.colorTemp(element.value)}" id="modal-temp-${element.id}">${element.value}°C</td>
                                <td class="text-center">
                                    ${(element.coments!=null)?element.coments:""}
                                </td>
                                <td class="text-center"></td>
                                <td align="center">
                                    <button title="Eliminar valor" onclick="that.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button>
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

        $("#user_cuest_temperatura_create").on('click', function() {
            that.create(".modal-body", user_id)
        });
        $("#info").on("click", function() {
            that.help(selector, user_id);
        });
    }
    async create(selector) {

        $(selector).html(`

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_estado_id">Estado</label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_estado_id"
                            id="cat_estado_id" aria-describedby="helpId" placeholder=""></select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary"
                            for="cat_municipio_id">Municipio</label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_municipio_id"
                            id="cat_municipio_id" aria-describedby="helpId" placeholder=""></select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="description">Ciudad</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi"
                            name="description" id="description" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="domicilio">Domicilio</label>
                        <textarea  class="form-control form-control-lg bg-gray-footer-parodi" name="domicilio" id="domicilio" rows="2"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

        `);
        catUserEstado.getAll()
            .then(response => {
                $("#cat_estado_id").html(select(response));
                return response[0].id
            }).then(response => {
                catUserMunicipio.show(response)
                    .then(response => {
                        $("#cat_municipio_id").html(select(response));
                    })
            })
        $("#cat_estado_id").on("change", function() {
            //loadingModal("show")
            catUserMunicipio.show($(this).val())
                .then(response => {
                    $("#cat_municipio_id").html(select(response));
                    return response
                })
                .then(response => {
                    // $("#messageModal").modal('hide')
                    //loadingModal("hide")
                })
        });
    }
    async store(user_id) {
        let message;
        let formdata = new FormData();
        let cat_estado_id = $("#cat_estado_id");
        let cat_municipio_id = $("#cat_municipio_id");
        let description = $("#description");
        let domicilio = $("#domicilio");


        formdata.append("cat_estado_id", cat_estado_id.val())
        formdata.append("cat_municipio_id", cat_municipio_id.val())
        formdata.append("description", description.val())
        formdata.append("domicilio", domicilio.val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post(location.origin+"/user_cuest_direccion/store", formdata)
    }
    update(user_id) {
        let message;
        let formdata = new FormData();
        let cat_estado_id = $("#cat_estado_id");
        let cat_municipio_id = $("#cat_municipio_id");
        let description = $("#description");
        let domicilio = $("#domicilio");

        formdata.append("cat_estado_id", cat_estado_id.val())
        formdata.append("cat_municipio_id", cat_municipio_id.val())
        formdata.append("description", description.val())
        formdata.append("domicilio", domicilio.val())
        formdata.append("user_id", user_id)
        formdata.append("updated_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post(location.origin+"/user_cuest_direccion/update", formdata)
    }
    destroy(id) {
        let formdata = new FormData();
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/user_cuest_temperatura/destroy", formdata)
    }
    show(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return post(location.origin+"/userDirection/show", formdata)
    }
    eliminar(row_id, user_id) {
        let that = this
        var message = component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            that.destroy(row_id)
                .then(response => {
                    let temp = $("#value").val();
                    if (response.length > 0) {
                        that.columnaValor(
                            `#col_6_${user_id}`, {
                                'user_id': user_id,
                                'valor': response[0].value
                            });
                    } else {
                        $("#modelId").modal("hide")
                        that.columnaValor(
                            `#col_6_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    that.index('.modal-body', user_id)
                })
        }
    }
    colorTemp(temp) {
        //$(selector).removeClass(["text-secondary", "text-cyan", "text-success", "text-danger"])
        if (temp <= 30.4) {
            return "text-cyan";
        } else if (temp >= 30.5 && temp <= 37.5) {
            return "text-success";
        } else if (temp >= 37.6 && temp <= 37.9) {
            return "text-warning";
        } else if (temp >= 38) {
            return "text-danger";
        } else {

        }
    }
    columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="this.index('.modal-body',${data.user_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    TEMP
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span class='"+this.colorTemp(data.valor)+"'>"+data.valor+"°C</span>"}
            </div>
        `);
    }
    help(selector, user_id) {
        let that = this
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
            that.index(selector, user_id)
        });
    }
    validate() {
        let cat_estado_id = $("#cat_estado_id");
        let cat_municipio_id = $("#cat_municipio_id");
        let description = $("#description");
        let domicilio = $("#domicilio");

        if (location.pathname !== "/medico") {
            if (cat_estado_id.val() == "") {
                message = Component.alertMessage("input_select_empty");
                Toast.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => { cat_estado_id.trigger("focus");}, 110);
                    }
                })
                //alert(message['message'])
                //cat_estado_id.trigger("focus")
                return false;
            }
            if (cat_municipio_id.val() == "") {
                message = Component.alertMessage("input_select_empty");
                Toast.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => { cat_municipio_id.trigger("focus");}, 110);
                    }
                })
                //alert(message['message'])
                //cat_municipio_id.trigger("focus")
                return false;
            }
            if (description.val() == "") {
                message = Component.alertMessage("input_text_empty");
                Toast.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => { description.trigger("focus");}, 110);
                    }
                })
                //alert(message['message'])
                //description.trigger("focus")
                return false;
            }
            if (domicilio.val() == "") {
                message = Component.alertMessage("input_text_empty");
                Toast.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => { domicilio.trigger("focus");}, 110);
                    }
                })
                //alert(message['message'])
                //domicilio.trigger("focus")
                return false;
            }
        }

        return true;
    }
    infoPaciente(selector, user_id) {
        $(selector).html(`
            <div class="container">
                <nav class="navbar navbar-expand-lg m-0 navbar-light w-100 bg-light position-absolute" style="left:0;top:0">
                <div class="table-responsive">
                    <table class=" slide-in-right" style="width: 1100px !important;">
                        <tr>
                            <td class="text-gray pl-2 pr-2">
                                <b>Paciente:</b> Ranses Jimenez Dominguez <br>
                                <b>Cédula:</b> 22.014.778
                            </td>
                            <td class="text-gray pl-2 pr-2">
                                <b>Edad:</b> 36 años <br>
                                <b>Sexo:</b> M
                            </td>
                            <td class="text-gray pl-2 pr-2">
                                <b>Ingreso:</b> 22/03/2021 <br>
                                <b>Episodio:</b> No indicado
                            </td>
                            <td class="text-gray pl-2 pr-2">
                                <b>Médico Tratante:</b> Dr. Luis Eduardo Parodi Arrieta <br>
                                <b>Especialidad:</b> Alergia, Asma e Inmunología
                            </td>
                        </tr>
                    </table>
                </div>
                </nav>
            </div>
        `);
    }
}
