class UserCuestVinculoInstitucion {
    static create(selector) {
        $(selector).html(`
            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                    <div class="h3">
                        Vínculo con la institución
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_1">¿Es usted paciente del CMDLT?</label>
                        <select onchange="showHide('#div_cat_user_cuestionario_1');" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_1" id="cat_user_cuestionario_1" aria-describedby="helpId" placeholder="">
                            <option value="No">No</option>
                            <option value="Si">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
            <div id="div_cat_user_cuestionario_1" style="display:none" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_2">¿Conoce usted algún especialista en la institución?</label>
                        <select onchange="showHide('#div_vinculo_inst');addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_2" id="cat_user_cuestionario_2" aria-describedby="helpId" placeholder="">
                            <option value="No">No</option>
                            <option value="Si">Si</option>

                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>


                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_3">¿Tiene usted un médico tratante en la institución?</label>
                        <select onchange="showHide('#div_vinculo_inst2');addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_3" id="cat_user_cuestionario_3" aria-describedby="helpId" placeholder="">
                            <option value="No">No</option>
                            <option value="Si">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
            <div id="div_vinculo_inst" class="row" style="display:none">

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_4">Nombres y apellidos</label>
                        <input type="text" onchange="addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_4" id="cat_user_cuestionario_4" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>


                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_5">Teléfono de contácto</label>
                        <input type="number" onchange="addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_5" id="cat_user_cuestionario_5" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_6">Correo electrónico</label>
                        <input type="email" onchange="addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_6" id="cat_user_cuestionario_6" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
            <div id="div_vinculo_inst2" class="row" style="display:none">

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_8">Nombres y apellidos</label>
                        <input type="text" onchange="addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_8" id="cat_user_cuestionario_8" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_9">Teléfono de contácto</label>
                        <input type="number" onchange="addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_9" id="cat_user_cuestionario_9" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_10">Correo electrónico</label>
                        <input type="email" onchange="addInstitucion()" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_10" id="cat_user_cuestionario_10" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
            </div>
      `);
    }
}