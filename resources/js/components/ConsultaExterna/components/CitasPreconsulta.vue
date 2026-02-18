<template>
    <div class="flex-fill px-2 d-flex flex-column overflow-auto">
        <div class="d-flex flex-wrap mb-2">
            <div class="col-12 col-sm-6 pl-0">
                <h4 class="text-warning px-1">Citas en preconsulta</h4>
            </div>
            <div class="col-12 col-sm-6 pr-0 d-flex align-items-center">
                <label class="text-primary mb-0 mr-1" for="">Buscar:</label>
                <input type="search" placeholder="Escribe el texto a buscar" class="form-control" id="buscar_cita_listado">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table bg-white table-bordered table-hover">
                <thead style="font-size: 1.2em;">
                    <tr>
                        <th class="bg-white text-primary sticky-header text-center" title="Día en que se solicitó la cita">Fecha</th>
                        <th class="bg-white text-primary sticky-header text-center">Paciente</th>
                        <th class="bg-white text-primary sticky-header">Medico</th>
                        <th class="bg-white text-primary sticky-header">Especialidad</th>
                        <th class="bg-white text-primary sticky-header">Fecha Cita</th>
                        <th class="bg-white text-primary sticky-header">Hora</th>
                        <th class="bg-white text-primary sticky-header">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="text-secondary">
                        <!-- fecha -->
                        <td class="p-0 text-center" title="Día en que se solicitó la cita">Fecha</td>
                        <!-- paciente -->
                        <td class="p-0 text-center">
                            <div class="container-fluid p-0 m-0">

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column " style="width: fit-content">
                                        <i class="tag-exonerado d-none text-right font-weight-bold px-3 align-items-center" style="border-bottom-right-radius: 20px;"><i class="fas fa-check-double"></i>
                                            Exonerado</i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-end" style="width: fit-content">
                                        <div class="d-none tag-condicion-cortesia-referido text-right font-weight-bold px-3 border">
                                        </div>
                                        <div class="tag-condicion-cortesia text-right font-weight-bold px-3 bg-success" style="border-bottom-left-radius: 20px;">Cita Particular</div>
                                    </div>
                                </div>



                                <div class="d-flex flex-row" style="height:100%">

                                    <div class="flex-fill align-self-start flex-grow-1 border-right">
                                        <div class="d-flex flex-row justify-content-center border-bottom">
                                            <div class="d-flex paciente-edit cursor-pointer" style="align-items: center;" data-user_id_paciente="358171">
                                                <div class="m-1 paciente-edit" data-user_id_paciente="358171">
                                                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg';" loading="lazy" src="/image/system/patient.svg" style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente" class="paciente-edit card-item-paciente-imagen tooltip-primary border border-primary card-item-paciente-image rounded-circle mx-auto d-block" alt="..." data-user_id_paciente="358171">
                                                </div>
                                                <div>
                                                    <div class="paciente-edit" data-user_id_paciente="358171">
                                                        <h4 data-tippy-content="Nombre del paciente" class="paciente-edit tooltip-primary card-item-paciente-fullname text-primary" style="margin-bottom: 0;white-space: normal;" data-user_id_paciente="358171">Adalgiza Suárez</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex flex-fill  align-self-start">
                                                <div class="d-flex  flex-column flex-fill align-items-center">
                                                    <div data-tippy-content="Documento de identidad del paciente" class="tooltip-primary d-flex flex-fill justify-content-center">
                                                        <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                                    </div>
                                                    <div class="d-flex flex-fill justify-content-center">
                                                        <div class="text-gray text-nowrap overflow-hidden card-item-paciente-cedula">V12667255</div>
                                                    </div>
                                                </div>
                                                <div data-tippy-content="Edad del paciente" class="tooltip-primary d-flex flex-column  flex-fill align-items-center border-left border-right">
                                                    <div class="d-flex flex-fill justify-content-center">
                                                        <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                                    </div>
                                                    <div class="d-flex flex-fill justify-content-center">
                                                        <div class="text-gray card-item-paciente-edad">70</div>
                                                    </div>
                                                </div>
                                                <div data-tippy-content="Genero del paciente" class="tooltip-primary d-flex flex-column flex-fill align-items-center">
                                                    <div class="d-flex flex-fill justify-content-center">
                                                        <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                                    </div>
                                                    <div class="d-flex p-1 flex-fill justify-content-center">
                                                        <div class="text-gray card-item-paciente-genero">F</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="flex-fill align-self-start p-1">
                                        <div class="d-flex flex-column" style="width: 200px;">
                                            <div class="tarjeta-salud-chacao pb-1 bg-chacao">
                                                <div class="text-center">
                                                    <b class="text-white" style="font-size:0.9em;">Soy CMDLT</b>
                                                </div>
                                                <div class="d-flex justify-content-center w-100">
                                                    <div class="badge text-black badge-gray card-item-paciente-tarjeta-chacao">023548</div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="text-center">
                                                    <b class="text-primary" style="font-size:0.9em;">
                                                        Teléfono Contacto
                                                    </b>
                                                </div>
                                                <div class="d-flex flex-fill mb-1 justify-content-center">
                                                    <a class="enlace-whatsapp btn btn-default mx-1 btn-block text-nowrap btn-sm tooltip-primary" data-tippy-content="Teléfono contacto del paciente: +No Indicado" data-telefono_movil="+584241816596">
                                                        <i class="fab fa-whatsapp enlace-whatsapp text-success" aria-hidden="true" data-telefono_movil="+584241816596"></i>
                                                        <span class=" enlace-whatsapp card-item-paciente-telefono-movil" data-telefono_movil="+584241816596">+584241816596</span>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- medico -->
                        <td class="p-0">Medico</td>
                        <!-- especialidad -->
                        <td class="p-0">Especialidad</td>
                        <!-- fecha cita -->
                        <td class="p-0">Fecha Cita</td>
                        <!-- hora -->
                        <td class="p-0">Hora</td>
                        <!-- referencia -->
                        <td class="p-1 botones-fila"  style="width: 160px;">
                            <a class="btn btn-info btn-block btn-sm cita-referencia" data-btn-id="9" data-cat_user_cita_status_id="4" href="#" role="button" title="Referencia NO DISPONIBLE" data-cita_id="27248" data-user_id_paciente="358171">
                                <i class="fas fa-file-alt cita-referencia" style="width:15px;height:15px;" title="Referencia NO DISPONIBLE"></i>
                                Referencia
                            </a>
                            <a class="btn btn-success btn-block btn-sm preconsulta-cita mb-1" data-btn-id="4" data-cat_user_cita_status_id="5" href="#" role="button" data-cita_id="6569" data-user_id_paciente="359691">
                                <img data-cat_user_cita_status_id="5" class="preconsulta-cita" src="/image/system/calendar-check.svg" style="width:15px;height:15px;" alt="Not Image Found" data-cita_id="6569" data-user_id_paciente="359691">
                                Signos vitales
                            </a>
                            <a class="btn btn-warning btn-block btn-sm cita-reprogramar" data-btn-id="1" data-cat_user_cita_status_id="2" href="#" role="button" data-cita_id="27248" data-user_id_paciente="358171">
                                <img data-cat_user_cita_status_id="2" class="cita-reprogramar" src="/image/system/calendar-exclamation.svg" style="width:15px;height:15px;" alt="Not Image Found" data-cita_id="27248" data-user_id_paciente="358171">
                                Reprogramar
                            </a>
                            <a class="btn btn-danger btn-block btn-sm cancelar-cita" data-btn-id="6" data-cat_user_cita_status_id="3" href="#" role="button" data-cita_id="27248" data-user_id_paciente="358171">
                                <img data-cat_user_cita_status_id="3" class="cancelar-cita" src="/image/system/calendar-cancel.svg" style="width:15px;height:15px;" alt="Not Image Found" data-cita_id="27248" data-user_id_paciente="358171">
                                Cancelar
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    export default {
        name:"CitasEnPreconsulta"
    }
</script>

<style lang="scss" scoped>

</style>
