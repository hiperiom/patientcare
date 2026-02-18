class UserCuestPruebaCovid {
    static create(selector) {
        $(selector).html(`
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                                <div class="h3">
                                    ¿Has presentado alguno de los siguientes síntomas?
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_25" value="25" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_25">Temperatura mayor a 38°C</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_20" value="20" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_20">Dificultad de respirar</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_34" value="34" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_34">Tos</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_17" value="17" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_17">Dolor de cabeza</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_12" value="12" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_12">Dolor de garganta</label>
                                </div>

                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_32" value="32" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_32">Perdida del gusto</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_29" value="29" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_29">Dolores musculares</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_16" value="16" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_16">Fatiga o Cansancio</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_14" value="14" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_14">Falta de olfato</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input sintoma" id="model_18" value="18" name="model[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_18">Diarrea</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                                <div class="h3">
                                    ¿Sufres de alguna de las siguientes condiciones de salud?
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input epidemiologia" id="model_ant_1" value="1" name="model_ant[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_ant_1">Hipertensión arterial</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input epidemiologia" id="model_ant_2" value="2" name="model_ant[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_ant_2">Diabetes</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input epidemiologia" id="model_ant_3" value="3" name="model_ant[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_ant_3">Enfermedad cardiovascular</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input epidemiologia" id="model_ant_4" value="4" name="model_ant[]">
                                    <label class="custom-control-label text-secondary" style="font-size: 1.2rem !important" for="model_ant_4">Enfermedad del sistema respiratorio</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <div class="h3 text-primary" for="caso">¿Has tenido contácto con alguna persona positiva para Coronavirus COVID-19?</div>
                        <select class="form-control  form-control-lg bg-gray-footer-parodi" name="contacto_covid" id="contacto_covid">
                            <option value="">Seleccione</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <div class="h3 text-primary" for="model_temp">Si posee termómetro, indique, su temperatura actual:</div>
                        <input type="number" name="model_temp" id="model_temp" class="form-control  form-control-lg bg-gray-footer-parodi" placeholder="°C" aria-describedby="helpId">
                        <small id="helpId" class="text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <div class="h3 text-primary" for="model_oxi">Si posee oxímetro, indique, su nivel de oxígeno actual:</div>
                        <input type="number" name="model_oxi" id="model_oxi" class="form-control  form-control-lg bg-gray-footer-parodi" placeholder="SpO2" aria-describedby="helpId">
                        <small id="helpId" class="text-muted"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <div class="h3 text-primary" for="prioridad_lista">¿Considera que su caso es de emergencia, o puede esperar en su casa?</div>
                        <select class="form-control  form-control-lg bg-gray-footer-parodi" name="prioridad_lista" id="prioridad_lista">
                            <option value="">Seleccione</option>
                            <option value="1">Es una emergencia</option>
                            <option value="0">Puedo esperar en casa</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <div class="h3 text-primary" for="contacto_cmdlt">¿Por cuál vía tuvo<br>contácto con CMDLT?</div>
                        <select class="form-control  form-control-lg bg-gray-footer-parodi" name="contacto_cmdlt" id="contacto_cmdlt">
                            <option value="">Seleccione</option>
                            <option value="364">Whatsapp</option>
                            <option value="365">Telefonía convencional</option>
                            <option value="366">Web</option>
                            <option value="367">Instagram</option>
                        </select>
                    </div>
                </div>
            </div>
        `);

    }

    static async store(user_id) {
        return new Promise((resolve, reject) => {
            let totalSintomas = $('[name="model[]"]').serializeArray().length
            let totalAntecedentes = $('[name="model_ant[]"]').serializeArray().length
            let contacto_covid = $("#contacto_covid");
            let model_temp = $("#model_temp");
            let model_oxi = $("#model_oxi");

            p = UserCuestPruebaCovid.puntos()
            recomendacion = UserCuestPruebaCovid.determinaRecomendacion(p)
            console.log("PUNTOS CUESTIONARIO:", p)
            console.log("LETRA RECOMENDACION:", recomendacion.letra)
            if (recomendacion.llave == true) {
                $("#paso1_cuestionario").css("display", "none")
                $("#paso2_recomendacion").css("display", "block")
            } else {
                alert("Error en resultado del cuestionario de riesgo: " + recomendacion.letra)
                return user_id;
            }
            if (model_temp.val() != "") {
                UserCuestTemperatura.store2(user_id)
                    .then(response => {
                        console.log("UserCuestTemperatura:", response)
                    })
            }

            if (model_oxi.val() != "") {
                UserCuestOximetria.store2(user_id)
                    .then(response => {
                        console.log("UserCuestOximetria:", response)
                    })
            }
            if (totalSintomas > 0) {
                let value = JSON.stringify($('[name="model[]"]').serializeArray());
                let formdata = new FormData();
                formdata.append("user_id", user_id)
                formdata.append("model", value)
                formdata.append("since", timestamps())
                formdata.append("created_at", timestamps())
                formdata.append("_token", $("#_token").val())
                try {
                    post( location.origin+"/user_cuest_sintoma/store", formdata)
                        .then(response => {
                            console.log("UserCuestSintoma:", response)
                        })
                } catch (error) {
                    return user_id;
                }
            }
            if (totalAntecedentes > 0) {
                let value = JSON.stringify($('[name="model_ant[]"]').serializeArray());
                let formdata = new FormData();
                formdata.append("user_cuest_antecedente_id", value)
                formdata.append("user_id", user_id)
                formdata.append("model", value)
                formdata.append("created_at", timestamps())
                formdata.append("_token", $("#_token").val())
                try {
                    post( location.origin+"/user_cuest_antecedente/store2", formdata)
                        .then(response => {
                            console.log("UserCuesAntecedente:", response)
                        })
                } catch (error) {
                    return user_id;
                }
            }
            if (contacto_covid.val() != "") {
                let formdata = new FormData();
                formdata.append("cat_user_cuestionario_id", 60)
                formdata.append("value", $("#contacto_covid").val())
                formdata.append("value2", recomendacion.letra)
                formdata.append("user_id", user_id)
                formdata.append("created_at", timestamps())
                formdata.append("_token", $("#_token").val())
                try {
                    return post( location.origin+"/user_cuest_prueba_covid/store", formdata)
                        .then(response => {
                            console.log("UserCuesPruebaCovid:", response)
                        })
                } catch (error) {
                    return user_id;
                }
            }



            resolve(user_id)
        });

    }
    static store3(user_id) {
        let value = JSON.stringify($('[name="model[]"]').serializeArray());
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("model", value)
        formdata.append("since", timestamps())
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())

        return post( location.origin+"/user_cuest_antecedente/store", formdata)
    }
    static validate() {
        let contacto_covid = $("#contacto_covid");
        if (contacto_covid.val() == "") {
            message = Component.alertMessage("input_select_empty");
            //alert(message['message'])
            //contacto_covid.trigger("focus")
            Toast.fire({
                icon: message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => { contacto_covid.trigger("focus");}, 110);
                }
            })

            return false;
        }
        return true;
    }
    static resultadoCuestionarioCovid(selector) {
        $(selector).html(`
            <div class="container">
                <div class="row">
                    <div id="recom_izq" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="float-right text-danger" id="resultnew"></div>
                        <div class="form-group" style="text-align:center">
                            <label class="display-5 text-center text-primary text-size-pregunta" for="pregunta">
                                Tu riesgo de presentar COVID-19,
                                según la información suministrada es:
                            </label>
                        </div>
                        <div id="borderecomendacion" class="border-right border-primary"
                            style="height:380px;padding-top: 70px;margin:3%;">
                            <div class="row">
                                <div id="riesgo" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 offset-xs-4 offset-sm-4 offset-md-4 offset-lg-4 p-2 text-size-pregunta text-center font-weight-bold text-white bg-danger">
                                    ALTO
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group" style="text-align:center;">
                            <label class="display-5 mb-1 text-center text-primary text-size-pregunta" for="pregunta">
                                Las recomendaciones generales que te damos son:
                            </label>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="w-100 mb-5" style="border-collapse: separate;">
                                <tbody>
                                    <tr>
                                        <td id="recom_tabla_izq1" style="width:40%; font-size:1.5em"
                                            class="recom_tabla_izq display-4 p-2 lead font-weight-bold text-white text-size-pregunta bg-danger">
                                            AISLAMIENTO</td>
                                        <td id="recom_tabla_der1" style="width:40%; font-size:1.2em"
                                            class="p-2 text-uppercase text-white bg-secondary">DENTRO DEL HOGAR, PERMANECER AISLADO EN TU HABITACIÓN</td>
                                    </tr>
                                    <tr class="scale-down-center" onclick="UserCuestPruebaCovid.modal_4()">
                                        <td id="recom_tabla_izq2" style="width:40%; font-size:1.5em"
                                            class="recom_tabla_izq display-4 p-2 lead font-weight-bold text-white text-size-pregunta bg-danger">
                                            <div class="parpadea     float-right"><i
                                                    class="fa fa-info-circle text-white display-6"></i></div>
                                            <div id="recom_tabla_izq2_text">EVALUACIÓN POR UN MÉDICO</div>
                                        </td>
                                        <td id="recom_tabla_der2" style="width:40%; font-size:1.2em"
                                            class="p-2 text-uppercase text-white bg-secondary">A LA BREVEDAD POSIBLE</td>
                                    </tr>
                                    <tr class="scale-down-center" onclick="UserCuestPruebaCovid.modal_5()">
                                        <td id="recom_tabla_izq3" style="width:40%; font-size:1.5em"
                                            class="recom_tabla_izq display-4 p-2 lead font-weight-bold text-white text-size-pregunta bg-danger">
                                            <div class="parpadea     float-right"><i
                                                    class="fa fa-info-circle text-white display-6"></i></div>
                                            <div id="recom_tabla_izq3_text">REALIZARTE LA PRUEBA<br>COVID-19</div>
                                        </td>
                                        <td id="recom_tabla_der3" style="width:40%; font-size:1.2em"
                                            class="p-2 text-uppercase text-white bg-secondary">A LA BREVEDAD POSIBLE</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group" style="text-align:center">
                            <label class="display-5 mb-1 text-center text-primary text-size-pregunta" for="pregunta">
                                Recuerda siempre:
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-3">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="table-responsive">
                            <table class="w-100" style="border-collapse: separate;border-spacing: 30px 30px;">
                                <tbody>
                                    <tr>
                                        <td nowrap="" class="text-center" style="height:100px;border-spacing: 30px 30px;">
                                            <img style="height:100px"
                                                src="${location.origin}/image/system/iconos-06.png"
                                                class="img-fluid" alt="labarse las manos">
                                        </td>
                                        <td nowrap="" class="text-center" style="height:100px;border-spacing: 30px 30px;">
                                            <img style="height:100px"
                                                src="${location.origin}/image/system/iconos-01.png"
                                                class="img-fluid" alt="labarse las manos">
                                        </td>
                                        <td nowrap="" class="text-center" style="height:100px;border-spacing: 30px 30px;">
                                            <img style="height:100px"
                                                src="${location.origin}/image/system/iconos-04.png"
                                                class="img-fluid" alt="labarse las manos">
                                        </td>
                                        <td nowrap="" class="text-center" style="height:100px;border-spacing: 30px 30px;">
                                            <img style="height:100px"
                                                src="${location.origin}/image/system/iconos-02.png"
                                                class="img-fluid" alt="labarse las manos">
                                        </td>
                                        <td nowrap="" class="text-center" style="height:100px;border-spacing: 30px 30px;">
                                            <img style="height:100px"
                                                src="${location.origin}/image/system/iconos-05.png"
                                                class="img-fluid" alt="labarse las manos">
                                        </td>
                                        <td nowrap="" class="text-center" style="height:100px;border-spacing: 30px 30px;">
                                            <img style="height:100px"
                                                src="${location.origin}/image/system/iconos-03.png"
                                                class="img-fluid" alt="labarse las manos">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td nowrap="" class="text-center text-primary">
                                            Quedarte en casa
                                        </td>
                                        <td nowrap="" class="text-center text-primary">
                                            Lavarte las manos
                                        </td>
                                        <td nowrap="" class="text-center text-primary">
                                            No tocarte la cara
                                        </td>
                                        <td nowrap="" class="text-center text-primary">
                                            Usar tapabocas
                                        </td>
                                        <td nowrap="" class="text-center text-primary">
                                            Cubrirte al toser
                                        </td>
                                        <td nowrap="" class="text-center text-primary">
                                            Guardar distancia
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button class="btn btn-primary btn-block btn-lg" onclick="UserCuestPruebaCovid.paso({'paso':3})"
                            id="finalizar">Continuar </button>
                    </div>
                </div>
                <br><br>
            </div>
        `);
    }
    static resultCuestionarioEmail(data) {
        let formdata = new FormData();
        formdata.append("recomendacion", recomendacion)
        formdata.append("email", email)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_prueba_covid/sendEmailCuestionario", formdata);
    }
    static modal_3(params) {
        $(".modal-body").html(`
            <div class="p-3 bg-primary">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i style="font-size: 0.8em;">Gracias por responder el</i><br>
                    Cuestionario de Riesgo<br>
                    <span style="overflow-wrap: normal;font-weight:400">COVID-19</span>
                </h3>
                <div class="text-center font-italic" style="font-size: 1.4em;">
                    ¿Te fue útil el Cuestionario de Riesgo <br> COVID-19?<br>
                </div>
                <div class="text-center display-4 mt-2">
                    <p class="clasificacion-valoracion">
                            <input id="radio1" type="radio" class="input-valoracion" name="estrellas" value="5"><!--
                        --><label class="label-valoracion cursor-pointer" for="radio1">★</label><!--
                        --><input id="radio2" type="radio" class="input-valoracion" name="estrellas" value="4"><!--
                        --><label class="label-valoracion cursor-pointer" for="radio2">★</label><!--
                        --><input id="radio3" type="radio" class="input-valoracion" name="estrellas" value="3"><!--
                        --><label class="label-valoracion cursor-pointer" for="radio3">★</label><!--
                        --><input id="radio4" type="radio" class="input-valoracion" name="estrellas" value="2"><!--
                        --><label class="label-valoracion cursor-pointer" for="radio4">★</label><!--
                        --><input id="radio5" type="radio" class="input-valoracion" name="estrellas" value="1"><!--
                        --><label class="label-valoracion cursor-pointer" for="radio5">★</label>
                    </p>
                </div>
                <div>
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi" placeholder="Déjanos tus comentarios..." onkeyup="coments=this.value" id="coments"></textarea>
                </div>
                <div class="text-center font-italic" style="font-size:1.1em">
                    El Centro Médico Docente La Trinidad<br>
                    y nuestro equipo profesional<br>
                    agradecemos tu confianza.
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                        <button id="" onclick="window.location = 'http://www.cmdlt.edu.ve/';" type="button" class="btn btn-light btn-block btn-lg btn-personal-1 text-primary">Enviar y finalizar</button>
                    </div>
                </div>
            </div>
        `)
        $(".modal-footer").empty()
    }
    static modal_2(params) {
        var display = "none";
        if (
            recomendacion == "A" ||
            recomendacion == "B.1" ||
            recomendacion == "C.1"
        ) {
            display = "contents";
        }
        $(".modal-body").html(`
            <div class="p-3 bg-primary">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i style="font-size: 0.8em;">Gracias por completar el</i><br>
                    Cuestionario de Riesgo<br>
                    <span style="overflow-wrap: normal;font-weight:400">COVID-19</span>
                </h3>
                <p class="lead" style="font-size: 1.4em;font-style: italic; margin-bottom: 0.1rem !important;">
                    <i>
                        Enviaremos a tu email los resultados generados
                        a partir de tus respuestas,  con nuestras
                        recomendaciones.
                        <br><br>
                        Gracias por confiar en el equipo profesional del<br>
                        Centro Médico Docente La Trinidad. <br>
                    </i>
                </p>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-2">
                        <button id="cancelar" type="button" class="btn btn-light btn-block btn-lg btn-personal-1 text-primary" data-dismiss="modal">Regresar</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-2">
                        <button id="recomendaciones" onclick="UserCuestPruebaCovid.paso({'paso':4})" type="button" class="btn btn-light btn-block btn-lg btn-personal-1 text-primary">Continuar</button>
                    </div>
                </div>
            </div>

        `)
        $(".modal-footer").empty()
    }
    static modal_4(params) {
        $('#messageModal').modal('toggle')
        $(".modal-body").html(`
            <div class="p-3 bg-primary">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i>¿Dónde ubico a un médico?</i>
                </h3>
                <br>
                <div class="font-italic">
                    Si tienes a su médico de confianza, le recomendamos lo contactes para que te evalúe.<br><br>

                    Si no lo tiene, por favor dirigirse al servicio de emergencia más cercano a su domicilio.<br><br>

                    Puede dirigirse a los Centros de Salud Centinelas, autorizados por el Ministerio del Poder Popular para la Salud.<br><br>

                </div>

                <div class="text-center font-italic">
                    Si quieres saber cuáles son y dónde están, consulta en: <br>
                    <a href="http://www.mpps.gob.ve" class="text-white font-weight-bold">www.mpps.gob.ve</a><br><br>

                    Siempre puedes consultar a uno de nuestros médicos<br>
                    a través de la línea 0212 949 6324<br><br>

                    El Servicio de <br>
                    Teleconsulta de Orientación de Emergencia<br>
                    está disponible de lunes a domingo, <br>
                    en horario de 8:00 am a 8:00 pm<br>

                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                        <button id="" type="button" data-dismiss="modal" class="btn btn-light btn-block btn-lg btn-personal-1 text-primary">Cerrar</button>
                    </div>
                </div>
            </div>
        `)
        $(".modal-footer").empty()
    }
    static modal_5(params) {
        $('#messageModal').modal('toggle')
        $(".modal-body").html(`
            <div class="p-3 bg-primary">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i>¿Dónde me puedo hacer la prueba para COVID-19?</i>
                </h3>

                <br>
                <div class="font-italic">
                    Llama a uno de los siguientes teléfonos para que te orienten:<br><br>

                    0 800 COVID19 / 0 800 268 4319<br>
                    0 800 MIRANDA / 0 800 647 2632<br>
                    0 800 VIGILEN / 0 800 844 4536<br>



                    También puedes dirigirte  a uno de los Centros de Salud Centinelas, autorizados por el Ministerio del Poder Popular para la Salud.<br><br>
                    Si quieres saber cuáles son y dónde están,<br> consulta en: <br>
                    <div class="text-center">
                        <a href="http://www.mpps.gob.ve" class="text-white font-weight-bold">www.mpps.gob.ve</a><br><br>
                    </div>
                <div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                        <button id="" type="button" data-dismiss="modal" class="btn btn-light btn-block btn-lg btn-personal-1 text-primary">Cerrar</button>
                    </div>
                </div>
            </div>

        `)
        $(".modal-footer").empty()
    }
    static sumaedad(params) {

        if (params != "") {
            if (params >= 60) {
                return UserCuestPruebaCovid.pe("edad");
            }
            return 0;
        } else {
            return 0;
        }
    }
    static sumasexo(params) {
        if (params != "") {
            if (params == "m") {
                return UserCuestPruebaCovid.pe("sexo");
            }
            return 0;
        } else {
            return 0;
        }
    }
    static puntos() {
        p = 0;

        (calcularEdad($("#fnacimiento").val()) >= 60) ? p = p + UserCuestPruebaCovid.sumaedad(calcularEdad($("#fnacimiento").val())): p = p - UserCuestPruebaCovid.sumaedad(calcularEdad($("#fnacimiento").val()));

        ($('#genero').val() != "") ? p = p + UserCuestPruebaCovid.sumasexo($('#genero').val()): p = p - UserCuestPruebaCovid.sumasexo($('#genero').val());

        if ($('#model_25').prop('checked')) { p = p + UserCuestPruebaCovid.pe("fiebre") }
        if ($('#model_34').prop('checked')) { p = p + UserCuestPruebaCovid.pe("tos") }
        if ($('#model_20').prop('checked')) { p = p + UserCuestPruebaCovid.pe("dificultad_respiracion") }
        if ($('#model_12').prop('checked')) { p = p + UserCuestPruebaCovid.pe("dolor_garganta") }
        if ($('#model_17').prop('checked')) { p = p + UserCuestPruebaCovid.pe("dolor_cabeza") }

        if ($('#model_32').prop('checked')) { p = p + UserCuestPruebaCovid.pe("perdida_gusto") }
        if ($('#model_29').prop('checked')) { p = p + UserCuestPruebaCovid.pe("dolor_muscular") }
        if ($('#model_16').prop('checked')) { p = p + UserCuestPruebaCovid.pe("fatiga_cansancio") }
        if ($('#model_14').prop('checked')) { p = p + UserCuestPruebaCovid.pe("falta_olfato") }
        if ($('#model_18').prop('checked')) { p = p + UserCuestPruebaCovid.pe("diarrea") }

        if ($('#model_ant_1').prop('checked')) { p = p + UserCuestPruebaCovid.pe("hipertension") }
        if ($('#model_ant_2').prop('checked')) { p = p + UserCuestPruebaCovid.pe("diabetes") }
        if ($('#model_ant_3').prop('checked')) { p = p + UserCuestPruebaCovid.pe("enfermedad_cardiovascular") }
        if ($('#model_ant_4').prop('checked')) { p = p + UserCuestPruebaCovid.pe("enfermedad_respiratoria") }

        if ($('#contacto_covid').val() == "Si") {

            p = p + UserCuestPruebaCovid.pe("has_tenido_contacto")
        }
        return p
    }
    static colorRecomendacion(color) {
        if (color == "D") {
            $("#riesgo").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-success").html("BAJO")
            $(".recom_tabla_izq").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-success")

            $("#recom_tabla_izq1").html("DISTANCIAMIENTO SOCIAL")
            $("#recom_tabla_der1").html("PERMANECE  EN CASA, SI DEBES SALIR HAZLO TOMANDO MEDIDAS PREVENTIVAS")

            $("#recom_tabla_izq2_text").html("NO REQUIERES EVALUACIÓN POR UN MÉDICO")
            $("#recom_tabla_der2").html("EN ESTE MOMENTO, NO REQUIERES EVALUACIÓN MÉDICA. SOLICÍTALA EN CASO DE PRESENTAR ALGÚN SINTOMA")

            $("#recom_tabla_izq3_text").html("NO AMERITAS LA PRUEBA<br>COVID-19")
            $("#recom_tabla_der3").html("EN ESTE MOMENTO NO AMERITAS REALIZARTE LA PRUEBA DEL<br>COVID-19")
        }
        if (color == "C") {
            $("#riesgo").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning").html("MEDIO")
            $(".recom_tabla_izq").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning")

            $("#recom_tabla_izq1").html("AISLAMIENTO")
            $("#recom_tabla_der1").html("OBSERVACIÓN DOMICILIARIA POR 14 DÍAS")

            $("#recom_tabla_izq2_text").html("EVALUACIÓN POR UN MÉDICO")
            $("#recom_tabla_der2").html("DEPENDIENDO DE TU EVOLUCIÓN, SI LOS SÍNTOMAS PERSISTEN O EMPEORAN EN 48 HORAS, DEBES SER EVALUADO POR UN MÉDICO")


            $("#recom_tabla_izq3_text").html("POR AHORA NO AMERITAS LA PRUEBA<br>COVID-19")
            $("#recom_tabla_der3").html("SI TUS SÍNTOMAS EMPEORAN, UN MÉDICO DEBE EVALUARTE E INDICARTE SI HACE FALTA REALIZARTE LA PRUEBA")

        }
        if (color == "C.1") {
            $("#riesgo").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning").html("MEDIO")
            $(".recom_tabla_izq").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning")
            $("#recom_tabla_izq2").removeClass("bg-warning").addClass("bg-danger")

            $("#recom_tabla_izq1").html("CUARENTENA")
            $("#recom_tabla_der1").html("OBSERVACIÓN DOMICILIARIA POR 14 DÍAS")

            $("#recom_tabla_izq2_text").html("EVALUACIÓN POR UN MÉDICO")
            $("#recom_tabla_der2").html("A LA BREVEDAD POSIBLE")

            $("#recom_tabla_izq3_text").html("POR AHORA NO AMERITAS PRUEBA<br>COVID-19")
            $("#recom_tabla_der3").html("AL EVALUARTE, EL MÉDICO TE INDICARÁ SI HACE FALTA REALIZARTE O NO LA PRUEBA")


        }
        if (color == "B") {
            $("#riesgo").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning").html("MEDIO")
            $(".recom_tabla_izq").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning")
            $("#recom_tabla_izq1").html("AISLAMIENTO")
            $("#recom_tabla_der1").html("OBSERVACIÓN DOMICILIARIA POR 14 DÍAS")

            $("#recom_tabla_izq2_text").html("EVALUACIÓN POR UN MÉDICO")
            $("#recom_tabla_der2").html("DEPENDIENDO DE SU EVOLUCIÓN, SI LOS SÍNTOMAS PERSISTEN O EMPEORAN EN 48 HORAS, DEBE SER EVALUADO POR UN MÉDICO")

            $("#recom_tabla_izq3_text").html("POR AHORA NO AMERITAS PRUEBA<br>COVID-19")
            $("#recom_tabla_der3").html("SI TUS SÍNTOMAS EMPEORAN, UN MÉDICO DEBE EVALUARTE E INDICARTE SI HACE FALTA REALIZARTE LA PRUEBA")


        }
        if (color == "B.1") {
            $("#riesgo").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning").html("MEDIO")
            $(".recom_tabla_izq").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-warning")
            $("#recom_tabla_izq2").removeClass("bg-warning").addClass("bg-danger")
            $("#recom_tabla_izq1").html("AISLAMIENTO")
            $("#recom_tabla_der1").html("OBSERVACIÓN DOMICILIARIA POR 14 DÍAS")


            $("#recom_tabla_izq2_text").html("EVALUACIÓN POR UN MÉDICO")
            $("#recom_tabla_der2").html("A LA BREVEDAD POSIBLE")


            $("#recom_tabla_izq3_text").html("POR AHORAS NO AMERITAS PRUEBA<br>COVID-19")
            $("#recom_tabla_der3").html("AL EVALUARTE, EL MÉDICO TE INDICARÁ SI HACE FALTA REALIZARTE O NO LA PRUEBA")


        }
        if (color == "A") {
            $("#riesgo").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-danger").html("ALTO")
            $(".recom_tabla_izq").removeClass("bg-success").removeClass("bg-warning").removeClass("bg-danger").addClass("bg-danger")

            $("#recom_tabla_izq1").html("AISLAMIENTO")
            $("#recom_tabla_der1").html("DENTRO DEL HOGAR, PERMANECER AISLADO EN TU HABITACIÓN")

            $("#recom_tabla_izq2_text").html("EVALUACIÓN POR UN MÉDICO")
            $("#recom_tabla_der2").html("A LA BREVEDAD POSIBLE")

            $("#recom_tabla_izq3_text").html("REALIZARTE LA PRUEBA<br>COVID-19")
            $("#recom_tabla_der3").html("A LA BREVEDAD POSIBLE")


        }
    }
    static paso(data) {
        window.scrollTo(0, 0)
        if (data.paso == 3) {
            $('#messageModal').modal('toggle')
            UserCuestPruebaCovid.modal_2();
        }
        if (data.paso == 4) {

            //UserCuestPruebaCovid.resultCuestionarioEmail();
            UserCuestPruebaCovid.modal_3();
        }
        if (data.paso == 5) {
            alert(2222)
            data = {
                value: $('input:radio[name=estrellas]:checked').val(),
                type: "Cuestionario Covid",
                email: email,
                coments: coments
            }
            UserCuestValoracion.store(data)
                .then(response => {
                    window.location = 'http://www.cmdlt.edu.ve/';
                })


        }

    }
    static determinaRecomendacion(p) {
        let totalSintomas = $('[name="model[]"]').serializeArray().length
        let totalAntecedentes = $('[name="model_ant[]"]').serializeArray().length
        var llave = false;
        var letra = "";
        if (p >= 0 && p <= 9 && !llave) {
            UserCuestPruebaCovid.colorRecomendacion("D")
            llave = true;
            letra = "D";
            return { 'letra': letra, 'llave': llave };
        }

        if (p >= 10 && p < 20 && !llave) {
            //recomendacion D
            if (
                totalSintomas == 0 &&
                totalAntecedentes == 0 &&
                $('#contacto_covid').val() == "Si" //Has tenido contacto con una persona con covid? - 10
            ) {
                UserCuestPruebaCovid.colorRecomendacion("D")
                llave = true;
                letra = "D";
                return { 'letra': letra, 'llave': llave };
            }

            //recomendacion B
            if (
                totalAntecedentes == 0 && // - 4
                $('#model_34').prop('checked') && //tos - 5
                $('#model_25').prop('checked') || //fiebre - 5
                p >= 10 &&
                p <= 12 &&
                !llave
            ) {
                UserCuestPruebaCovid.colorRecomendacion("B")
                llave = true;
                letra = "B";
                return { 'letra': letra, 'llave': llave };
            }

            //recomendacion B-1
            if (
                totalAntecedentes == 0 &&
                !$('#model_20').prop('checked') && //dificultad_respiracion - 10
                $('#model_34').prop('checked') && //tos - 5
                $('#model_25').prop('checked') || //fiebre - 5
                p >= 13 &&
                p <= 15 &&
                !llave
            ) {
                UserCuestPruebaCovid.colorRecomendacion("B.1")
                llave = true;
                letra = "B.1";
                return { 'letra': letra, 'llave': llave };
            }

            //recomendacion C
            if (
                p >= 16 &&
                p <= 17 &&
                !llave
            ) {
                UserCuestPruebaCovid.colorRecomendacion("C")
                llave = true;
                letra = "C";
                return { 'letra': letra, 'llave': llave };
            }
            //recomendacion C-1
            if (
                p >= 18 &&
                p <= 19 &&
                !llave
            ) {
                UserCuestPruebaCovid.colorRecomendacion("C.1")
                llave = true;
                letra = "C.1";
                return { 'letra': letra, 'llave': llave };
            }
        }
        if (p >= 20 && !llave) {
            UserCuestPruebaCovid.colorRecomendacion("A")
            llave = true;
            letra = "A";
            return { 'letra': letra, 'llave': llave };
        }



    }
    static pe(key) {
        //parametro de evaluacion
        var parametro = {
            edad: 5,
            sexo: 0,
            fiebre: 5,
            tos: 5,
            dificultad_respiracion: 10,
            dolor_garganta: 1,
            dolor_cabeza: 1,
            perdida_gusto: 1,
            dolor_muscular: 1,
            fatiga_cansancio: 1,
            falta_olfato: 1,
            diarrea: 1,
            hipertension: 1,
            diabetes: 1,
            enfermedad_cardiovascular: 1,
            enfermedad_respiratoria: 1,
            has_tenido_contacto: 10
        }
        return parametro[key];
    }

}
