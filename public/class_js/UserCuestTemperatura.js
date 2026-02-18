import {get,post,jsUcfirst,meses,formatAMPM,timestamps,timestamps2} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
let userCuestPaciente = new UserCuestPaciente()



export default class UserCuestTemperatura {
    static index(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                    Temperatura
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


        /** */
        let formdata = new FormData();
        formdata.append("episodio_id", episodio_id);
        formdata.append("user_id", user_id);
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_temperatura/index", formdata)
            .then(response => {
                //UserCuestTemperatura.grafico(response)
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
                                <td class="text-center font-weight-bold ${UserCuestTemperatura.colorTemp(element.value)}" id="modal-temp-${element.id}">${element.value}°C</td>
                                <td class="text-center">
                                    ${(element.coments!=null)?element.coments:""}
                                </td>
                                <td align="center">
                                    <!-- <button title="Eliminar valor" onclick="UserCuestTemperatura.eliminar(${element.id},${user_id})" class="delete-row btn btn-danger" data-option="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button>-->
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
            UserCuestTemperatura.create(".modal-body", user_id,episodio_id)
        });
       /*  $("#info").on("click", function() {
            UserCuestTemperatura.help(selector, user_id);
        }); */
    }
    static create(selector, user_id,episodio_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex ">
                <h1 class="h1 text-primary">
                    Temperatura
                </h1>
            </div>
            <div class="d-flex mb-1">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 mr-1">
                    <input type="number" class="form-control bg-gray-footer-parodi" name="value" id="value" aria-describedby="helpId" placeholder="Nuevo valor">
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
            UserCuestTemperatura.index(selector, user_id,episodio_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            UserCuestTemperatura.store(user_id,episodio_id)
                .then(response => {
                    let valor = $("#value").val();
                    UserCuestTemperatura.columnaValor(
                        `#col_6_${user_id}`, {
                            'user_id': user_id,
                            'valor': valor,
                            'episodio_id': episodio_id,
                        });
                    UserCuestTemperatura.index('.modal-body', user_id,episodio_id)
                });
        });
        /* $("#info").on("click", function() {
            UserCuestTemperatura.help(selector, user_id);
        }); */
    }
    static store(user_id,episodio_id) {
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
        formdata.append("episodio_id", episodio_id)
        formdata.append("cat_user_cuestionario_84", value.val())
        formdata.append("created_at", created_at)
        formdata.append("sintoma_observacion", sintoma_observacion.val())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_temperatura/store", formdata)
    }
    static store2(user_id) {
        let message;
        let formdata = new FormData();
        let value = $("#model_temp");

        formdata.append("user_id", user_id)
        formdata.append("cat_user_cuestionario_84", value.val())
        formdata.append("created_at", timestamps())
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
    static store3(episodio_id,user_id,value) {
        let formdata = new FormData();

        formdata.append("episodio_id", episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("cat_user_cuestionario_84", value)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_temperatura/store", formdata)
    }
    static eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            UserCuestTemperatura.destroy(row_id)
                .then(response => {
                    let temp = $("#value").val();
                    if (response.length > 0) {
                        UserCuestTemperatura.columnaValor(
                            `#col_6_${user_id}`, {
                                'user_id': user_id,
                                'valor': response[0].value
                            });
                    } else {
                        $("#modelId").modal("hide")
                        UserCuestTemperatura.columnaValor(
                            `#col_6_${user_id}`, {
                                'user_id': user_id,
                                'valor': null
                            });
                    }
                    UserCuestTemperatura.index('.modal-body', user_id)
                })
        }
    }
    static colorTemp(temp) {
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
    static columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestTemperatura.index('.modal-body',${data.user_id},${data.episodio_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    TEMP
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span class='"+UserCuestTemperatura.colorTemp(data.valor)+"'>"+data.valor+"°C</span>"}
            </div>
        `);
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
                        <a title="Pulse para descargar" href="/help/temperatura.pdf" download ><img src="${location.origin}/image/system/icono_archivo2.svg" ></a>
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
            UserCuestTemperatura.index(selector, user_id)
        });
    }
    static grafico(data) {
        /*
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
            bordeGrafico = "orange"
            fondoGrafico = "#b1860778";
        }
        if (colorTemp == 3) {
            //rojo
            bordeGrafico = "red"
            fondoGrafico = "#dc354578";
        }
        //qui empieza los datos del grafico
        //ejes
        //x = dia
        //y = temp

        let dia = [];
        let temp = [];
        let i = data.length;
        $.each(data, function(indexInArray, valueOfElement) {
            dia[indexInArray] = indexInArray + 1;
            temp.push({ x: indexInArray, y: valueOfElement['value'] })
                //console.log(valueOfElement['value'])
        });
        var data_set = temp; //[{ x: 1, y: 50 }, { x: 2, y: 3 }, { x: 3, y: 2 }, { x: 4, y: 1 }, { x: 5, y: 8 }, { x: 6, y: 8 }, { x: 7, y: 2 }, { x: 8, y: 2 }, { x: 9, y: 3 }, { x: 10, y: 5 }, { x: 11, y: 11 }, { x: 12, y: 1 }, { x: 12, y: 1 }, { x: 12, y: 1 }, { x: 12, y: 1 }, { x: 12, y: 1 }, { x: 40, y: 1 }];
        var dias = dia;

        var lines = [],
            id = 0;
        var linesOn = false;

        var data = {
            labels: dias,
            datasets: [{
                label: "Temperatura: ", //texto de tooltip
                backgroundColor: fondoGrafico, //fondo de linea
                borderColor: bordeGrafico, //color de linea
                borderWidth: 1, //amcho de linea
                hoverBackgroundColor: "red",
                hoverBorderColor: "purple",
                data: data_set,
            }]
        };

        var option = {
            responsive: true,
            legend: false,

            onHover: function(evt) {
                var item = myLineChart.getElementAtEvent(evt);
                if (item.length) {
                    //console.log(">item", item);
                    //console.log(">data", item[0]._index, data.datasets[0].data[item[0]._index]);
                }
            },
            onClick: function(evt) {
                //var el = myLineChart.getElementAtEvent(evt);
                //console.log("onClick", el, evt);
            },
            annotation: {
                drawTime: "afterDraw",
                events: ['click', 'mouseenter', 'mouseleave'],
                annotations: lines
            },
            scales: {

                yAxes: [{
                    id: 'y-axis',
                    type: 'linear',
                }],
            }

        };

        addLine(38, "red", "De cuidado");
        addLine(30, "green", "Estable");

        var myLineChart = Chart.Line('myChart', {
            data: data,
            options: option
        });

        //console.log(myLineChart.annotation.elements.line1);
        myLineChart.annotation.elements.line1.hidden = true;
        myLineChart.update();

        function addLine(value, color, text) {
            id++;
            var ln = {
                id: "line" + id,
                type: "line",
                mode: "horizontal",
                scaleID: "y-axis",
                value: value,
                borderWidth: 1,
                backgroundColor: color,
                borderColor: color,
                label: {
                    content: text,
                    enabled: true,
                    position: "right",
                    backgroundColor: 'rgba(0,0,0,0.3)',
                },
                onMouseenter: function(e) {
                    //console.log("onMouseenter", e, this);
                    this.options.borderColor = color;
                    this.options.label.backgroundColor = color;
                    myLineChart.update();
                },
                onMouseleave: function(e) {
                    //console.log("onMouseleave", e);
                    this.options.borderColor = color;
                    this.options.label.backgroundColor = color;
                    myLineChart.update();
                },
            };
            lines.push(ln);
        }
        */

    }

}
