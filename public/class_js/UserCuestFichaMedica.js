class UserCuestFichaMedica {
    static createIngreso(selector, user_id, input) {
        $(selector).html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1 class="text-primary">
                        Ingreso
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <img src="/image/system/patient.svg" style="width: 2cm;height:2cm" class="image-perfil rounded-circle mx-auto d-block" alt="Patient default">

                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">

                        <label for="peso"></label>
                        <input type="number" name="peso" id="peso" class="form-control form-control-lg bg-gray-footer-parodi" placeholder="Peso" aria-describedby="helpId">
                        <label for="talla"></label>
                        <input type="number" name="talla" id="talla" class="form-control form-control-lg bg-gray-footer-parodi" placeholder="Talla" aria-describedby="helpId">
                        <label for="estatura"></label>
                        <input type="number" name="estatura" id="estatura" class="form-control form-control-lg bg-gray-footer-parodi" placeholder="Estatura" aria-describedby="helpId">
                        <label for="grupo_sanguineo"></label>
                        <!--
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="grupo_sanguineo" id="grupo_sanguineo">
                            <option value="">Grupo Sanguíneo</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="Lo Desconozco">Lo Desconozco</option>
                        </select>
                        -->


                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">

                        <label for="i_motivo_consulta"></label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="i_motivo_consulta" placeholder="Motivo de consulta" id="i_motivo_consulta" rows="3"></textarea>

                        <label for="i_enfermedad_actual"></label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="i_enfermedad_actual" placeholder="Diagnóstico de ingreso" id="i_enfermedad_actual" rows="3"></textarea>

                        <label for="i_enfermedad_actual"></label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="i_enfermedad_actual" placeholder="Examen Físico de Ingreso" id="i_enfermedad_actual" rows="3"></textarea>

                        <label for="i_enfermedad_actual"></label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="i_enfermedad_actual" placeholder="Plan de trabajo" id="i_enfermedad_actual" rows="3"></textarea>

                        <label for="cat_user_especialidad_id"></label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_especialidad_id" id="cat_user_especialidad_id">
                            <option value="">Seleccione especialidad</option>
                        </select>

                        <label for="cat_user_especialidad_id"></label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_especialidad_id" id="cat_user_especialidad_id">
                            <option value="">Seleccione médico tratante</option>
                        </select>

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button onclick="UserCuestHistoria.index('${selector}', ${user_id})" id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>

        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)

        $("#user_cuest_model_store").on("click", function() {
            UserCuestEvolucion.index(selector, user_id)
        });
    }
    static store(user_id, input) {
        let type;
        let formdata = new FormData();
        let value = $("#" + input).val();
        if (input == "grupo_sanguineo") {
            type = 1;
        }
        if (input == "peso") {
            type = 2;
        }
        if (input == "talla") {
            type = 3;
        }
        if (input == "estatura") {
            type = 4;
        }
        formdata.append("_token", $("#_token").val())
        formdata.append("user_id", user_id)
        formdata.append("type", type)
        formdata.append("value", value)
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_ficha_medica/store", formdata)
    }
}
