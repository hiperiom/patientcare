import {get,post,loading,meses,equalsInt, is_undefined, select,is_null,timestamps,horaAMPM, is_empty} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
import UserCuestImpresionDiagnostica from "./UserCuestImpresionDiagnostica.js";
import CatUserUbicacion from "./CatUserUbicacion.js";
import UserCuestEpisodio from "./UserCuestEpisodio.js";
import UserCuestHistoria from "./UserCuestHistoria.js";
import Component from "./Component.js";


let userCuestPaciente = new UserCuestPaciente()
let catUserUbicacion = new CatUserUbicacion()
let userCuestHistoria = new UserCuestHistoria()
//let userCuestImpresionDiagnostica = new UserCuestImpresionDiagnostica()

export default class UserCuestUbicacion {
    static create(selector, user_id) {
        //MODAL TRASLADO
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <h1 class="h1 text-primary">
                Traslado
            </h1>
            <div class="mb-auto row overflow-auto mb-1">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Nueva Ubicación
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">

                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion1" style="display:none;" name="subUbicacion1" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion2" style="display:none;" name="subUbicacion2" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
            </div>

            <div class="d-flex">
                <button id="user_cuest_ubicacion_store" class="font-weight-bold btn btn-success mr-1 w-100 mb-1">Guardar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100 mb-1"  data-dismiss="modal" aria-label="Close">Cancelar</button>

            </div>

        `);

        userCuestPaciente.infoPaciente("#infoPaciente", user_id)

        this.show(user_id)
            .then(response => {
                //console.log("UserCuestUbicacion", response)
                if (response.name != null) {
                    $("#ubicacion_actual").val(response.name)
                } else {
                    $("#ubicacion_actual").val(response.description + " | " + response.coments)
                }
            })

        catUserUbicacion.getIndex()
            .then(response => {
                //console.log("catUserUbicacion:", response)
                let temp = []
                $.each(response, function (indexInArray, valueOfElement) {
                     if (valueOfElement['id']!==246) {
                         temp[indexInArray]=valueOfElement
                     }
                });
                $("#cat_user_ubicacion_id").html(select(temp));
            })
        $("#cat_user_ubicacion_id").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion1").show()
                        $("#subUbicacion2").hide()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion1").html(data);
                    } else {
                        $("#subUbicacion1").hide()
                        $("#subUbicacion2").hide()
                    }
                })

        });
        $("#subUbicacion1").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion2").show()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion2").html(data);
                    } else {
                        $("#subUbicacion2").hide()
                    }
                })
        });
        $("#user_cuest_ubicacion_store").on("click", function() {
            ingreso = "Traslado";

            UserCuestUbicacion.store2(user_id)
                .then(response => {
                    console.log("UserCuestUbicacion:", response)
                    $("#row_" + user_id).slideUp("slow")
                    $(".row_" + user_id).slideUp("slow")
                    $("#modal-patient-item").modal("hide");

                    // get(location.origin+"/getIdUltimasUbicaciones/"+user_id).then(res => {
                    //     console.log(`Objeto res --> ${res}`)
                    //     console.log('ID DE LA FILA DEL PACIENTE --> row-paciente-' + user_id + '-' + res[1].cat_user_ubicacion_id)
                    //     // ocultar el paciente de la lista luego del traslado
                    //     document.getElementById('row-paciente-' + user_id + '-' + res[1].cat_user_ubicacion_id).style.display = 'none'
                    // })

                    const userIdToRemove = user_id;
                    const indexToRemove = pacientes_datos.findIndex(user => user.user_id === userIdToRemove);

                    if (indexToRemove !== -1) {
                        pacientes_datos.splice(indexToRemove, 1);
                    }

                })
        });
    }
    create3(selector, user_id) {
        //MODAL INGRESO
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Traslado
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Nueva Ubicación
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">

                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion1" style="display:none;" name="subUbicacion1" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion2" style="display:none;" name="subUbicacion2" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <button id="user_cuest_ubicacion_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Guardar</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg"  data-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
            </div>

        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)

        this.show(user_id)
            .then(response => {
                //console.log("UserCuestUbicacion", response)
                if (response.name != null) {
                    $("#ubicacion_actual").val(response.name)
                } else {
                    $("#ubicacion_actual").val(response.description + " | " + response.coments)
                }
            })

        catUserUbicacion.getIndex()
            .then(response => {
                console.log("catUserUbicacion:", response)
                let temp = []
                $.each(response, function (indexInArray, valueOfElement) {
                     if (valueOfElement['id']!==246) {
                         temp[indexInArray]=valueOfElement
                     }
                });
                $("#cat_user_ubicacion_id").html(select(temp));
            })
        $("#cat_user_ubicacion_id").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion1").show()
                        $("#subUbicacion2").hide()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion1").html(data);
                    } else {
                        $("#subUbicacion1").hide()
                        $("#subUbicacion2").hide()
                    }
                })

        });
        $("#subUbicacion1").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion2").show()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion2").html(data);
                    } else {
                        $("#subUbicacion2").hide()
                    }
                })
        });
        $("#user_cuest_ubicacion_store").on("click", function() {
            ingreso = "Ingreso";
            UserCuestUbicacion.store2(user_id)
                .then(response => {
                    console.log("UserCuestUbicacion:", response)
                    $("#row_" + user_id).slideUp("slow")
                    $(".row_" + user_id).slideUp("slow")
                    $("#modelId").modal("hide")
                })
        });
    }
    static async trasladoAmbulanciaIndex(episodio_id, user_id) {
        let rows = `
                <tr>
                    <td colspan="5" class="text-center text-primary">No posee traslados</td>
                </tr>
                `;
        let model = await get("/user/traslado_ambulancia/show/"+user_id)
        //console.log(model)
        if (model.length > 0) {
            let f = null;
            let fecha = null;
                rows = ""
                model.forEach(x=>{
                    let fecha_traslado = (x['fecha_traslado'].split(" "))[0]

                    let hora = (x['fecha_traslado'].split(" "))[1]
                        f =new Date(fecha_traslado);
                        fecha = f.getDate() + " de " + meses(f.getMonth()) + " "+ f.getFullYear();

                        rows += `
                            <tr>
                                <td>
                                    ${fecha}
                                </td>
                                <td>
                                    ${ horaAMPM(hora) }
                                </td>
                                <td>
                                    ${x['origen_traslado']}
                                </td>
                                <td>
                                    ${x['destino_traslado']}
                                </td>
                                <td>
                                    ${!is_null(x['observacion']) ? x['observacion']: ''}
                                </td>
                            </tr>
                        `
                })
        }
        //MODAL TRASLADO
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                    Traslados en ambulancia
                </h1>
                <button id="user_cuest_model_create" class="btn btn-default text-primary" style="float:right;font-size: 2rem !important; cursor:pointer;">
                    Nuevo traslado
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
            <div class="flex-fill d-flex flex-column overflow-auto mb-1">

                <div class="flex-fill">
                    <table class="table table-bordered mb-3">
                        <tbody><tr>
                            <th class="text-primary bg-white text-center sticky-top">Fecha</th>
                            <th class="text-primary bg-white text-center sticky-top">Hora</th>
                            <th class="text-primary bg-white text-center sticky-top">Origen</th>
                            <th class="text-primary bg-white text-center sticky-top">Destino</th>
                            <th class="text-primary bg-white text-center sticky-top">Observación</th>
                        </tr>
                        </tbody>
                            ${rows}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex">
                <button id="regresar" class="font-weight-bold btn btn-primary w-100 mb-1"  data-dismiss="modal" aria-label="Close">Cerrar</button>

            </div>

        `);

        loading("#historial_model")
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        document.getElementById("user_cuest_model_create").addEventListener("click",()=>{
            this.trasladoAmbulanciaCreate(episodio_id, user_id)
        })

    }
    static trasladoAmbulanciaCreate(episodio_id, user_id) {
        let that = this
        //MODAL TRASLADO
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                    Traslados en ambulancia
                </h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="fecha">Fecha del Traslado:</label>
                    <input type="date" id="fecha_traslado" name="fecha" class="form-control bg-gray-footer-parodi">
                </div>
                <div class="col-6">
                    <label for="hora">Hora del Traslado:</label>
                    <input type="time" id="hora_traslado" name="hora" class="form-control bg-gray-footer-parodi">
                </div>
                <div class="col-6">
                    <label for="origen">Origen del Traslado:</label>
                    <input type="text" id="origen_traslado" name="origen" class="form-control bg-gray-footer-parodi">
                </div>
                <div class="col-6">
                    <label for="destino">Destino del Traslado:</label>
                    <input type="text" id="destino_traslado" name="destino" class="form-control bg-gray-footer-parodi">
                </div>

            </div>

            <div class="flex-fill d-flex flex-column  overflow-auto mb-1">
                <div class="flex-fill mt-1">
                    <textarea class="form-control bg-gray-footer-parodi " name="observacion" id="observacion" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
                </div>
            </div>

            <div class="d-flex">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success w-100 mr-1 mb-1" >Guardar</button>

                <button id="user_cuest_model_index" class="font-weight-bold btn btn-primary w-100 mb-1">Regresar</button>

            </div>

        `);

        loading("#historial_model")
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        document.getElementById("user_cuest_model_index").addEventListener("click",()=>{
            this.trasladoAmbulanciaIndex(episodio_id, user_id)
        })
        document.getElementById("user_cuest_model_store").addEventListener("click",async ()=>{
            let formNotValidate = true;
            [
                "fecha_traslado",
                "hora_traslado",
                "origen_traslado",
                "destino_traslado",
                "observacion",
            ].forEach(x=>{
                let input = document.getElementById(x)
                    if(is_empty(input.value) && formNotValidate){
                        alert("El campo no puede estar vacio.")
                        formNotValidate = false
                        input.focus()
                        return false
                    }
            })
            if(formNotValidate){
                let formdata = new FormData();
                    formdata.append("fecha_traslado", document.getElementById("fecha_traslado").value)
                    formdata.append("hora_traslado", document.getElementById("hora_traslado").value )
                    formdata.append("origen_traslado", document.getElementById("origen_traslado").value)
                    formdata.append("destino_traslado", document.getElementById("destino_traslado").value)
                    formdata.append("observacion", document.getElementById("observacion").value)
                    formdata.append("user_cuest_episodio_id", episodio_id)
                    formdata.append("user_id_paciente", user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    console.log(formdata)
                    await post( location.origin+"/user/traslado_ambulancia/store", formdata)
                    Swal.fire({
                        title: "<strong>Registro completado</strong>",
                        icon: "success",


                        showCloseButton: true,


                        confirmButtonText:'Ok!',
                        timerProgressBar: true,
                    }).then(async (result) => {
                        let fechaTimestamp = document.getElementById("fecha_traslado").value
                        let hora = document.getElementById("hora_traslado").value
                        let f =new Date(fechaTimestamp);
                        let fecha = f.getDate() + " de " + meses(f.getMonth()) + " "+ f.getFullYear()+ ", a las " + horaAMPM(hora);

                        let btn_traslado_ambulancia = document.querySelector(`#btn_traslado_ambulancia_${episodio_id}`)
                            btn_traslado_ambulancia.dataset.tippyContent = `Traslado reciente: ${fecha}`
                            btn_traslado_ambulancia.classList.replace("tooltip-gray","tooltip-danger")
                        let btn_traslado_ambulancia_icon =  btn_traslado_ambulancia.querySelector("i")
                            btn_traslado_ambulancia_icon.classList.replace("text-gray","text-danger")
                            that.trasladoAmbulanciaIndex(episodio_id, user_id)
                    });


            }

        })

    }
    static historialUbiEpisodio(selector, user_id) {
        //MODAL TRASLADO
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <h1 class="h1 text-primary">
                Traslado
            </h1>
            <div class="flex-fill row overflow-auto mb-1">
                <div class="col-12" id="historial_model">

                </div>
            </div>

            <div class="d-flex">
                <button id="regresar" class="font-weight-bold btn btn-primary w-100 mb-1"  data-dismiss="modal" aria-label="Close">Cerrar</button>

            </div>

        `);

        loading("#historial_model")
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        UserCuestUbicacion.gethistorialUbiEpisodio(user_id)
            .then(response => {
                let result = "<table class='table'>";
                result += `
                <thead>
                    <tr>
                        <th scope="col" class="text-primary">Área</th>
                        <th scope="col" class="text-primary">Fecha ingreso</th>
                        <th scope="col" class="text-primary">Fecha traslado</th>
                        <th scope="col" class="text-primary">Días en área</th>
                        <th scope="col" class="text-primary">Reubicado por</th>
                    </tr>
                </thead>
                <tbody>
            `
                if (Object.keys(response).length > 0) {
                    $.each(response, function(indexInArray, valueOfElement) {
                        result += `
                        <tr>
                            <th class="text-gray" scope="row">${valueOfElement.area}</th>
                            <td class="text-gray">${valueOfElement.fecha_ingreso}</td>
                            <td class="text-gray">${valueOfElement.fecha_traslado}</td>
                            <td class="text-gray">${valueOfElement.dias_en_area}</td>
                            <td class="text-gray">${valueOfElement.creado_por}</td>
                        </tr>
                    `;
                    });

                } else {
                    result += "<a href='#' class='list-group-item list-group-item-action'>Sin ubicaciones</a>";
                }
                result += "</tbody></table>";
                $("#historial_model").html(result);
            });
            UserCuestUbicacion.show(user_id)
            .then(response => {
                //console.log("UserCuestUbicacion", response)
                if (response.name != null) {
                    $("#ubicacion_actual").val(response.name)
                } else {
                    $("#ubicacion_actual").val(response.description + " | " + response.coments)
                }
            })

        catUserUbicacion.getIndex()
            .then(response => {
                //console.log("catUserUbicacion:", response)
                $("#cat_user_ubicacion_id").html(select(response));
            })
        $("#cat_user_ubicacion_id").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion1").show()
                        $("#subUbicacion2").hide()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion1").html(data);
                    } else {
                        $("#subUbicacion1").hide()
                        $("#subUbicacion2").hide()
                    }
                })

        });
        $("#subUbicacion1").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion2").show()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion2").html(data);
                    } else {
                        $("#subUbicacion2").hide()
                    }
                })
        });
        $("#user_cuest_ubicacion_store").on("click", function() {
            ingreso = "Traslado";
            UserCuestUbicacion.store2(user_id)
                .then(response => {
                    console.log("UserCuestUbicacion:", response)
                    $("#row_" + user_id).slideUp("slow")
                    $(".row_" + user_id).slideUp("slow")
                    $("#modelId").modal("hide")
                })
            // ocultar el paciente luego del traslado
            const userIdToRemove = user_id;
            const indexToRemove = pacientes_datos.findIndex(user => user.user_id === userIdToRemove);

            if (indexToRemove !== -1) {
                pacientes_datos.splice(indexToRemove, 1);
            }
        });
    }
    historialEgreso(selector, user_id) {
        //MODAL TRASLADO
        $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Historial de Egresos
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <div id="historial_model">

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg"  data-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        `);
        loading("#historial_model")
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        UserCuestUbicacion.gethistorialAltas(user_id)
            .then(response => {
                let result = "<table class='table'>";
                result += `
                <thead>
                    <tr>
                        <th scope="col" class="text-primary">Área</th>
                        <th scope="col" class="text-primary">Fecha ingreso</th>
                        <th scope="col" class="text-primary">Fecha traslado</th>
                        <th scope="col" class="text-primary">¿Clasificado?</th>
                        <th scope="col" class="text-primary">Días en área</th>
                    </tr>
                </thead>
                <tbody>
            `
                if (Object.keys(response).length > 0) {
                    $.each(response, function(indexInArray, valueOfElement) {

                        result += `
                            <tr>
                                <th class="text-gray" scope="row">${valueOfElement.area}</th>
                                <td class="text-gray">${valueOfElement.fecha_ingreso}</td>
                                <td class="text-gray">${valueOfElement.fecha_traslado}</td>
                                <td class="text-gray">No</td>
                                <td class="text-gray">${valueOfElement.dias_en_area}</td>
                            </tr>
                        `;


                    });

                } else {
                    result += "<a href='#' class='list-group-item list-group-item-action'>Sin ubicaciones</a>";
                }
                result += "</tbody></table>";
                $("#historial_model").html(result);
            });
        this.show(user_id)
            .then(response => {
                //console.log("UserCuestUbicacion", response)
                if (response.name != null) {
                    $("#ubicacion_actual").val(response.name)
                } else {
                    $("#ubicacion_actual").val(response.description + " | " + response.coments)
                }
            })

        catUserUbicacion.getIndex()
            .then(response => {
                console.log("catUserUbicacion:", response)
                $("#cat_user_ubicacion_id").html(select(response));
            })
        $("#cat_user_ubicacion_id").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion1").show()
                        $("#subUbicacion2").hide()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion1").html(data);
                    } else {
                        $("#subUbicacion1").hide()
                        $("#subUbicacion2").hide()
                    }
                })

        });
        $("#subUbicacion1").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion2").show()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion2").html(data);
                    } else {
                        $("#subUbicacion2").hide()
                    }
                })
        });
        $("#user_cuest_ubicacion_store").on("click", function() {
            ingreso = "Traslado";
            UserCuestUbicacion.store2(user_id)
                .then(response => {
                    console.log("UserCuestUbicacion:", response)
                    $("#row_" + user_id).slideUp("slow")
                    $(".row_" + user_id).slideUp("slow")
                    $("#modelId").modal("hide")
                })
        });
    }
    create2(selector) {
        //se usa en el registro de paciente interno
        $(selector).html(`
            <div id="form" class="row mb-3">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray">
                        Ubicación Actual
                    </div>
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray">
                        Nueva Ubicación
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">

                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion1" style="display:none;" name="subUbicacion1" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion2" style="display:none;" name="subUbicacion2" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
            </div>
        `);
        $("#ubicacion_actual").val("Sala de Espera")

        get( location.origin+"/cat_user_ubicacion/index")
            .then(response => {
                let data = "";
                console.log(response)
                $.each(response, function(indexInArray, valueOfElement) {
                    let temp = []
                        //console.log(valueOfElement)
                     if (![246,387].includes(valueOfElement['id'])) {
                        data += `
                            <option value="${valueOfElement.id}">
                                ${valueOfElement.description}
                            </option>
                        `;
                     }
                });
                $("#cat_user_ubicacion_id").html(data);
                $("#cat_user_ubicacion_id").append(`
                    <option value="388">
                        Telesalud Empresarial
                    </option>
                `);

            })
        $("#cat_user_ubicacion_id").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion1").show()
                        $("#subUbicacion2").hide()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                    <option value="${valueOfElement.id}">
                                        ${valueOfElement.coments}
                                    </option>
                                `;
                        });
                        $("#subUbicacion1").html(data);
                    } else {
                        $("#subUbicacion1").hide()
                        $("#subUbicacion2").hide()
                    }
                })

        });
        $("#subUbicacion1").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion2").show()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                    <option value="${valueOfElement.id}">
                                        ${valueOfElement.coments}
                                    </option>
                                `;
                        });
                        $("#subUbicacion2").html(data);
                    } else {
                        $("#subUbicacion2").hide()
                    }
                })
        });
    }
    static show(user_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return post("/user_cuest_ubicacion/show", formdata)
    }
    store(user_id) {
        let formdata = new FormData();
        formdata.append("cat_user_ubicacion_id", $("#contacto_cmdlt").val())
        formdata.append("prioridad_lista", $("#prioridad_lista").val())
        formdata.append("user_id_paciente", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())

        return post( location.origin+"/user_cuest_ubicacion/store2", formdata)
    }
    static gethistorialUbiEpisodio(user_id) {
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_ubicacion/historialUbiEpisodio/" + user_id, formdata)
    }
    gethistorialAltas(user_id) {
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_ubicacion/historialAltas/" + user_id, formdata)
    }
    static async store2(user_id) {
        $("#row_" + user_id).slideUp("slow")
        let formdata = new FormData();
        formdata.append("cat_user_ubicacion_id", $("#cat_user_ubicacion_id").val())
        formdata.append("subUbicacion1", $("#subUbicacion1").val() != undefined ? $("#subUbicacion1").val() : null)
        formdata.append("subUbicacion2", $("#subUbicacion2").val() != undefined ? $("#subUbicacion2").val() : null)
        if(!is_undefined($("#coment").val())){
            formdata.append("coment", $("#coment").val() )
        }

        let fechaIngreso = $("#ingreso").val();
        //console.log(fechaIngreso)
        if (ingreso != undefined) {
            console.log("Ingreso: ", ingreso)
            formdata.append("value", ingreso)
            if (fechaIngreso !== "") {
                formdata.append("ingreso", fechaIngreso)
            }
        }
        formdata.append("user_id", user_id)
        formdata.append("user_id_paciente", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        console.log(formdata)
        return await post( location.origin+"/user_cuest_ubicacion/store", formdata)
    }
    validate() {
        let prioridad_lista = $("#prioridad_lista");
        let contacto_cmdlt = $("#contacto_cmdlt");
        if (prioridad_lista.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { prioridad_lista.trigger("focus");}, 110);
                }
            })
            //alert(message['message'])
            //prioridad_lista.trigger("focus")
            return false;
        }
        if (contacto_cmdlt.val() == "") {
            message = Component.alertMessage("input_select_empty");
            //alert(message['message'])
            //contacto_cmdlt.trigger("focus")
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { contacto_cmdlt.trigger("focus");}, 110);
                }
            })

            return false;
        }
        return true;
    }
    validate2() {
        let cat_user_ubicacion_id = $("#cat_user_ubicacion_id");
        if (cat_user_ubicacion_id.val() == "") {
            message = Component.alertMessage("input_select_empty");
            //alert(message['message'])
            //cat_user_ubicacion_id.trigger("focus")
            Swal.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { cat_user_ubicacion_id.trigger("focus");}, 110);
                }
            })
            return false;
        }

        return true;
    }

    menuEgreso(selector) {
        $("#messageModal").modal("show")
        $(selector).html(`
            <div id="form_pad">
                <div id="menuPatiencare" class="list-group">
                    <span class="text-primary font-weight-bold menu-pad-title"">
                        Menú Egresos
                    </span>
                    <a id="" href="#"  data-area="egreso" data-titlearea="Egresos - Alta" class="menu-egreso list-group-item list-group-item-action">Alta</a>
                    <a id="" href="#"  data-area="traslado" data-titlearea="Egresos - Traslado a otra Institución" class="menu-egreso list-group-item list-group-item-action">Traslado a otra Institución</a>
                    <a id="" href="#"  data-area="contraopinion" data-titlearea="Egresos - Contraopinión médica" class="menu-egreso list-group-item list-group-item-action">Contraopinión médica</a>
                    <a id="" href="#"  data-area="fallecido" data-titlearea="Egresos - Fallecido" class="menu-egreso list-group-item list-group-item-action">Fallecido</a>
                    <a id="" href="#"  data-area="otro" data-titlearea="Egresos - Otro" class="menu-egreso list-group-item list-group-item-action">Otro</a>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                    <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);
        $(".menu-egreso").on("click", function() {
            $('#btnNotificaciones').empty();
            Component.menu($(this).data("area"), $(this).data("titlearea"))
        });
    }
    static egreso(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <h1 class="h1 text-primary">
                Egreso
            </h1>
            <div class="row overflow-auto mb-1">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <input type="hidden" id="cat_user_ubicacion_id_actual">
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Destino alta
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">
                        <option value='246'>Domicilio</option>
                        <option value='251'>Traslado a otra Institución</option>
                        <option value='247'>Contraopinión Médica</option>
                        <option value='248'>Fallecido</option>
                        <option value='249'>Otra</option>
                    </select>
                </div>

            </div>
            <div class="h3 text-gray text-center">
                Diagnóstico de Egreso
            </div>
            <div class="flex-fill overflow-auto mb-1">
                <textarea class="form-control bg-gray-footer-parodi "  placeholder="Escriba el diagnóstico" name="coment" id="coment" rows="3" style=" width: 100%;height: 100%;resize: none;" ></textarea>
            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mr-1 w-100 mb-1">Guardar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100 mb-1"  data-dismiss="modal" aria-label="Close">Cancelar</button>

            </div>

        `);
       /*  $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Egreso
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <input type="hidden" id="cat_user_ubicacion_id_actual">
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Destino alta
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">
                        <option value='246'>Domicilio</option>
                        <option value='251'>Traslado a otra Institución</option>
                        <option value='247'>Contraopinión Médica</option>
                        <option value='248'>Fallecido</option>
                        <option value='249'>Otra</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <div class="h3 text-gray text-center">
                        Diagnóstico de Egreso
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" placeholder="Escriba el diagnóstico" name="coment" id="coment" rows="3"></textarea>
                    </div>
                </div>

            </div>
            <div class="botones-bottom-modal">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Guardar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg"  data-dismiss="modal" aria-label="Close">Cancelar</button>

            </div>
        `); */

        userCuestPaciente.infoPaciente("#infoPaciente", user_id)

        this.show(user_id)
            .then(response => {
                //console.log("UserCuestUbicacion", response)
                if (response.name != null) {
                    $("#ubicacion_actual").val(response.name)
                    $("#cat_user_ubicacion_id_actual").val(response.cat_user_ubicacion_id)
                } else {
                    $("#cat_user_ubicacion_id_actual").val(response.cat_user_ubicacion_id)
                    $("#ubicacion_actual").val(response.description + " | " + response.coments)
                }

            })

        $("#user_cuest_model_store").on("click", async function() {
            let coment = $('#coment')
            if (coment.val() == "") {
                message = Component.alertMessage("input_text_empty");
                Swal.fire({
                    icon: message['image'],
                    title: message['title'],
                    text: message['message'],
                    didClose: () => {
                        setTimeout(() => coment.trigger("focus"), 110);
                    }
                })

                return false;
            }
            ingreso = "Egreso";
            UserCuestEpisodio.store({user_id})
            .then(async response=>{
                if (String(response)=='imp_diagn_not_found') {

                    Swal.fire({
                        icon: message['image'],
                        title: message['title'],
                        text: "Debe agregar una Probabilidad diagnóstica para generar un Informe de Egreso válido."
                    })
                    let patient_data = pacientes_datos.find(x=>x.user_id ===user_id)
                    let index = pacientes_datos.findIndex(x=>x.user_id ===user_id)
                        userCuestHistoria.index(patient_data,index)
                        // UserCuestImpresionDiagnostica.create('.modal-body',user_id)
                }else{
                    UserCuestUbicacion.store2(user_id)
                    .then(async (response) => {
                        let user = pacientes_datos.find(x=>equalsInt(x['user_id'],user_id))
                        let paciente = user['paciente'];
                        let correo = user['email'];
                        let telefono_movil = "+584149320905" //user['telefono_movil'];

                        // ocultar el paciente luego del alta médica
                        const userIdToRemove = user_id;
                        const indexToRemove = pacientes_datos.findIndex(user => user.user_id === userIdToRemove);

                        if (indexToRemove !== -1) {
                            pacientes_datos.splice(indexToRemove, 1);
                        }

                        //ENVIO DE ENCUESTA
                        await get(location.origin+"/discharged/store/"+user_id)

                        let enlace = ""
                            $("#row_" + user_id).slideUp("slow")
                            $(".row_" + user_id).slideUp("slow")
                            $("#modal-patient-item").modal("hide");
                            /* switch (response['egreso_de']) {
                                case 'pad':
                                    return false
                                break;
                                case 'emergencia':
                                    return false;
                                break;
                                case 'hospitalizacion':
                                    enlace = `
                                        https://api.whatsapp.com/send/?phone=${telefono_movil}&text=*Hola, ${paciente}*,%0ARecibe un afectuoso saludo de parte del equipo médico del Centro Médico Docente La Trinidad. Gracias, por preferirnos y considerarnos el aliado de su salud.%0ATus impresiones y opiniones son de mucha importancia para mejorar nuestros servicios, por lo que nos sentiríamos muy agradecidos de que nos puedas dedicar un momento de tu valioso tiempo, para responder una breve encuesta y compartirnos, cómo fue tu experiencia con nosotros. %0A*Has clic en el siguiente enlace para empezar*:%0A https://patientcare.cmdlt.pstelemed.com/encuesta/hospitalizacion/nueva
                                    `
                                break;

                                default:
                                    return false
                                break;
                            } */
                            return false //QUITAR AL CONTINUAR EL DESARROLLO
                        Swal.fire({
                            title: '<strong>Egreso completado</strong>',
                            icon: 'info',
                            /* html:`
                                ¿Quieres enviar via Whatsapp, la <a target="_blank" href="/encuesta/hospitalizacion/nueva">Encuesta de Atención en Áreas de Hospitalización</a>, al número <b>${telefono_movil}</b>?
                            `, */
                            html:`
                                Se ha enviado al correo <b>${correo}</b>
                                el enlace de invitación a la <a target="_blank" href="${window.location.host}/encuesta/hospitalizacion/nueva">Encuesta de Atención en Áreas de Hospitalización</a>.<br>
                                ¿Desea adicionalmente enviar este enlace via Whatsapp, al número <b>${telefono_movil}</b>?
                            `,
                            customClass: {
                                confirmButton: 'btn btn-success mx-1',
                                cancelButton: 'btn btn-info mx-1'
                            },
                            buttonsStyling: false,
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText:
                              '<i class="fab fa-whatsapp"></i> Si, enviar por Whatsapp',

                            cancelButtonText:
                              'No, continuar',

                            timer: 30000,
                            timerProgressBar: true,
                          })
                          .then( async (result) => {

                            if (result.isConfirmed) {
                                let formdata = new FormData();
                                    formdata.append("user_id", user_id)
                                    formdata.append("_token", $("#_token").val())
                                    post("/cat/encuesta/1/sumarEncuesta", formdata)
                                    .then(response => {
                                        window.open(enlace)
                                    })

                            }
                          })

                        //

                    })
                }
            })

        });
    }
    static reingreso(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <h1 class="h1 text-primary">
                Reingreso
            </h1>
            <div class="row mb-auto overflow-auto mb-1">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Nueva Ubicación
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">

                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion1" style="display:none;" name="subUbicacion1" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion2" style="display:none;" name="subUbicacion2" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>

            </div>

            <div class="d-flex">
                <button id="user_cuest_ubicacion_store" class="font-weight-bold btn btn-success mr-1 w-100 mb-1">Guardar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100 mb-1"  data-dismiss="modal" aria-label="Close">Cancelar</button>

            </div>

        `);
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)

        this.show(user_id)
            .then(response => {
                //console.log("UserCuestUbicacion", response)
                if (response.name != null) {
                    $("#ubicacion_actual").val(response.name)
                } else {
                    $("#ubicacion_actual").val(response.description + " | " + response.coments)
                }
            })
            catUserUbicacion.getIndex()
            .then(response => {
                //console.log("catUserUbicacion:", response)
                $("#cat_user_ubicacion_id").html(select(response));
            })
        $("#cat_user_ubicacion_id").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion1").show()
                        $("#subUbicacion2").hide()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion1").html(data);
                    } else {
                        $("#subUbicacion1").hide()
                        $("#subUbicacion2").hide()
                    }
                })

        });
        $("#subUbicacion1").on("change", function() {
            catUserUbicacion.show($(this).val())
                .then(response => {
                    if (response.length > 0) {
                        $("#subUbicacion2").show()
                        let data = "<option value=''>Seleccione</option>";
                        $.each(response, function(indexInArray, valueOfElement) {
                            data += `
                                <option value="${valueOfElement.id}">
                                    ${valueOfElement.coments}
                                </option>
                            `;
                        });
                        $("#subUbicacion2").html(data);
                    } else {
                        $("#subUbicacion2").hide()
                    }
                })
        });
        $("#user_cuest_ubicacion_store").on("click", function() {
            ingreso = "Reingreso";
            UserCuestUbicacion.store2(user_id)
                .then(response => {
                    console.log("UserCuestUbicacion:", response)
                    $("#row_" + user_id).slideUp("slow")
                    $(".row_" + user_id).slideUp("slow")
                    $("#modal-patient-item").modal("hide");
                    window.location = "/medico";
                })
        });
        //MODAL REINGRESO
       /*  $("#modelId").modal("show")
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Reingreso
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <input type="text" style="background-color:var(--gray) !important" readonly class="form-control text-center form-control-lg bg-gray-footer-parodi" name="ubicacion_actual" id="ubicacion_actual" aria-describedby="helpId" placeholder="Nuevo valor">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-1">
                    <div class="h3 text-gray text-center">
                        Nueva Ubicación
                    </div>
                    <select id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control form-control-lg bg-gray-footer-parodi">

                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion1" style="display:none;" name="subUbicacion1" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">
                    <select id="subUbicacion2" style="display:none;" name="subUbicacion2" class="form-control form-control-lg bg-gray-footer-parodi">
                    </select>
                </div>

            </div>

            <div class="botones-bottom-modal">
                <button id="user_cuest_ubicacion_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Guardar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>

            </div>
        `); */
        /**/


    }
}
