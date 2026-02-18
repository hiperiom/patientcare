<template>
    <div class="container">

        <div class="row">
            <!-- cedula paciente -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            1</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary" for="validationServer03">Cédula de identidad del
                            paciente</label>
                            <small title="Escribe un documento de identidad" class="d-none notification cedula badge badge-info font-weight-normal"></small>
                    </div>
                </div>
                <input name="user_id_paciente" type="hidden">
                <input name="cedula" type="text" class="form-control">
                <small class="notification"></small>

            </div>
            <!-- especialidad -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            2</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary" for="validationServer03">Selecciona
                            la especialidad</label>
                            <small title="Especialidades disponibles." class="d-none notification cat_especialidad_id badge badge-info font-weight-normal"></small>
                    </div>
                </div>
                <select name="cat_especialidad_id" class="custom-select " id="validationServer03" aria-describedby="validationServer02Feedback" required=""><option value="">Seleccione</option><option value="4">Cardiología</option><option value="5">Cirugía Bucal</option><option value="11">Cirugía General</option><option value="75">Cirugía Plástica Reconstructiva</option><option value="19">Cirugía de Cabeza y Cuello</option><option value="88">Ecosonografía Doppler</option><option value="89">Ecosonografía Especial de embarazada</option><option value="87">Ecosonografía Especial de embarazada y doppler ginecológico</option><option value="86">Ecosonografía general, partes blandas y mamarias
</option><option value="22">Endocrinología</option><option value="69">Endodoncia</option><option value="23">Fisiatría</option><option value="77">Fisioterapia</option><option value="26">Gastroenterología</option><option value="28">Ginecología y Obstetricia</option><option value="71">Inmunología</option><option value="74">Mastología</option><option value="31">Medicina General </option><option value="32">Medicina Interna </option><option value="80">Medicina veterinaria</option><option value="85">Neumopediatría</option><option value="92">Nutricionista</option><option value="40">Nutrología</option><option value="42">Odontología</option><option value="44">Odontopediatría</option><option value="45">Oftalmología</option><option value="93">Oftalmología Adultos</option><option value="49">Otorrinolaringología</option><option value="50">Pediatría</option><option value="81">Psicología Adultos</option><option value="73">Psicología Infantil</option><option value="55">Psiquiatría</option><option value="58">Terapia Ocupacional</option><option value="59">Traumatología</option><option value="61">Urología</option></select>
                <div id="validationServer03Feedback" class="invalid-feedback cat_especialidad_id">
                    Por favor selecciona una especialidad.
                </div>
            </div>
            <!-- centro de salud -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-centro_salud_id bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            3</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary" for="validationServer03">Selecciona el Centro de Salud</label>
                            <small title="Centros de Salud en donde se atiende esta centro-salud" class="d-none notification centro_salud_id badge badge-info font-weight-normal"></small>
                    </div>
                </div>

                <select name="centro_salud_id" class="custom-select " id="validationServer04" aria-describedby="validationServer04Feedback" required="">
                </select>
                <div id="validationServer04Feedback" class="invalid-feedback centro_salud_id">
                    Por favor selecciona un Centro de Salud.
                </div>
            </div>
            <!-- user_id_medico -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-user_id_medico bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            4</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary" for="validationServer03">Selecciona el médico de tu preferencia</label>
                            <small title="Médicos que atienden esta especialidad" class="d-none notification user_id_medico badge badge-info font-weight-normal"></small>
                    </div>
                </div>

                <select name="user_id_medico" class="custom-select " id="validationServer05" aria-describedby="validationServer05Feedback" required="">
                </select>
                <div id="validationServer05Feedback" class="invalid-feedback user_id_medico">
                    Por favor selecciona un médico.
                </div>
            </div>
            <!-- calendario -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_dia form-number-input-cita_dia bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            5</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_dia h5 m-0 text-primary" for="validationServer05">
                            Indica el día de tu conveniencia
                            <small title="Dias en que se atiende este médico." class="d-none notification cita_dia badge badge-info font-weight-normal"><b>0</b></small>
                        </label>
                    </div>
                </div>
                <div id="mensaje_dia_seleccionado" class="text-center text-secondary" style="font-size:20px">
                    Solo los días resaltados en gris están disponibles.
                </div>

                <input required="" id="cita_dia" name="cita_dia" type="hidden">
                <div id="calendar" class="daterange" style="width: 100%"></div>

                <div id="validationServer06Feedback" class="invalid-feedback cita_dia">
                    Por favor selecciona un día válido.
                </div>
            </div>
            <!-- hora -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_hora form-number-input-cita_hora bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            6</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_hora h5 m-0 text-primary" for="validationServer05">
                            Escoje una hora
                            <small title="Médicos que atienden esta especialidad" class="d-none notification user_id_medico badge badge-info font-weight-normal"><b>0</b></small>
                        </label>
                    </div>
                </div>
                <input required="" id="cita_hora" name="cita_hora" type="hidden">
                <ul class="d-none nav justify-content-center  nav-tabs mb-3" id="horarios" role="tablist">
                    <li class="nav-item flex-fill text-center" role="presentation">
                        <a class="nav-link active" id="pills-am-tab" data-cita-horario="am" data-toggle="pill" href="#pills-am" role="tab" aria-controls="pills-am" aria-selected="true">Mañana</a>
                    </li>
                    <li class="nav-item flex-fill text-center" role="presentation">
                        <a class="nav-link" id="pills-pm-tab" data-cita-horario="pm" data-toggle="pill" href="#pills-pm" role="tab" aria-controls="pills-pm" aria-selected="false">Tarde</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContentHoras">
                    <div class="tab-pane fade show active" id="pills-am" role="tabpanel" aria-labelledby="pills-tabContentHoras">
                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                            <div class="flex-fill text-center text-secondary" style="font-size:15px">
                                Sin Horas disponibles
                            </div>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-pm" role="tabpanel" aria-labelledby="pills-tabContentHoras">
                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">


                        </ul>
                    </div>
                </div>
                <div id="validationServer06Feedback" class="invalid-feedback cita_hora">
                    Por favor selecciona una respuesta
                    válida.
                </div>
            </div>
            <!--  -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            7</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary" for="validationServer03">Modalidad de la cita</label>

                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="line-height: 1">
                    <div><input type="radio" value="Particular" class="form-control mx-1" style="width:20px;height:20px; display:inline !important" name="condicion_administrativa" checked=""> </div>
                    <div>Particular</div>
                    <div><input type="radio" value="Cortesía" class="form-control mx-1" style="width:20px;height:20px; display:inline !important" name="condicion_administrativa"> </div>

                    <div>Cortesía</div>
                    <div><input type="radio" value="APS" class="form-control mx-1" style="width:20px;height:20px; display:inline !important" name="condicion_administrativa"> </div>
                    <div>APS</div>
                    <div><input type="radio" value="Seguro" class="form-control mx-1" style="width:20px;height:20px; display:inline !important" name="condicion_administrativa"> </div>
                    <div>Seguro</div>
                </div>

                <div id="modalidad_cortesia" class="d-none">
                    <input type="text" class="form-control mt-2" name="condicion_descripcion" placeholder="Escriba el convenio por el que se autoriza la Cortesía.">
                    <select class="form-control mt-1" name="user_id_autorizacion">
                        <option value="">Seleccione quién autoriza la cita</option>
                                                    <option value="357585">Irma Marisela Mota Ruiz
                                (Gerente)</option>
                                                <option value="355511">Maggia Santi</option>
                        <option value="96">Luis Giménez</option>
                    </select>
                    <div class="alert alert-primary mt-1 alert-dismissible fade show" role="alert">
                        <strong>Sobre la modalidad Cortesía:</strong>
                        <ul>
                            <li>Las citas de cortesía obligatoriamente deben ser notificadas y aprobadas por un
                                usuario autorizado.</li>
                            <li>Una vez autorizada la cortesía, escribir <span class="cursor-pointer condicion_descripcion">a qué convenio
                                    pertenece</span>, y luego, seleccionar el <span class="cursor-pointer user_id_autorizacion">usuario que autoriza</span>
                                dicha cortesía.</li>
                            <li>Al pulsar en <b class="btn_submit cursor-pointer">Crear cita</b>, el usuario
                                que autoriza, recibirá una notificación por correo electrónico con los datos de
                                dicha solicitud.</li>
                        </ul>
                    </div>
                </div>
                <div id="modalidad_seguro" class="d-none">
                    <div class="d-flex">
                        <div class="flex-fill px-1">
                            <select disabled="" class="form-control mt-1" name="cat_seguro_id" id="cat_seguro_id">
                                <option value="">Seguros no disponible</option>
                            </select>
                        </div>
                        <div class="flex-fill px-1">
                            <input disabled="" type="text" class="form-control mt-1" name="poliza_numero" placeholder="Escriba el número de poliza.">
                        </div>
                    </div>
                </div>

            </div>

            <!-- motivo consulta -->
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_motivo form-number-input-cita_motivo bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            8</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_motivo h5 m-0 text-primary" for="validationServer05">
                            Motivo de consulta
                            <small title="Médicos que atienden esta especialidad" class="d-none notification cita_motivo badge badge-info font-weight-normal"><b>0</b></small>
                        </label>
                    </div>
                </div>
                <textarea class="form-control" placeholder="Escribe el motivo" name="cita_motivo" id="cita_motivo" rows="3"></textarea>
                <div id="validationServer06Feedback" class="invalid-feedback cita_motivo">
                    Por favor selecciona una respuesta
                    válida.
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_motivo form-number-input-cita_motivo bg-primary rounded-circle" style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            9</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_motivo h5 m-0 text-primary" for="validationServer05">
                            Informe Médico
                        </label>
                    </div>
                </div>
                <input id="informe_general" style="height: 43px;" name="informe_general" type="file" class="form-control">
            </div>



            <!-- submit -->
            <div class="col-md-6 offset-md-3 mb-3">
                <button id="btn_enviar" class="btn btn-success btn-block" type="submit">Enviar datos</button>
            </div>
        </div>



    </div>
</template>

<script>
    export default {
        name:"CitaCreate"
    }
</script>

<style lang="scss" scoped>

</style>