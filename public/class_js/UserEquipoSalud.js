import {get,post,select,fotoTemporal,timestamps,is_null,reemplaza_imagen} from "../helpers/helpers.js";



export default class UserEquipoSalud {

    static store(user_id) {
        let formdata = new FormData();
        formdata.append("cat_user_equipo_salud_id", $("#cat_user_equipo_salud_id").val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_equipo_salud/store", formdata)
    }
    static update(user_id) {
        let formdata = new FormData();
        formdata.append("cat_user_equipo_salud_id", $("#cat_user_equipo_salud_id").val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_equipo_salud/update", formdata)
    }
    static async show(user_id) {
        return await get( location.origin+"/user_equipo_salud/show/" + user_id);
    }
    static menuEquipoEnArea({selector='.modal-body',area='tp'}) {
        $("#modelId").modal("show")

        $(selector).html(`
            <div>
                <h1 class="text-primary">
                    Equipo médico en el área
                </h1>
            </div>
            <div id="lista_especialistas_by_area" style="max-height: 60vh;overflow: auto;" class="row row-cols-1 row-cols-md-3">
                <div class="d-flex m-4 justify-content-center text-primary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                    <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);

        UserEquipoSalud.medicosByArea({area})
        .then(response=>{
            $("#lista_especialistas_by_area").empty()
            if (Object.keys(response).length>0) {
                $.each(response, function (indexInArray, valueOfElement) {
                    $("#lista_especialistas_by_area").append(`
                        <div class="col mb-4">
                            <div data-id="${valueOfElement['user_id']}" data-medico="${valueOfElement['medico']}" class="card card-especialista mb-3">
                                <div class="row no-gutters py-2">
                                    <div class="col-md-2 border-right">
                                        <div class="text-center mt-1">
                                            <img onerror="reemplaza_imagen(this)" src="${location.origin}${valueOfElement['imagen']}" class="card-img rounded-circle" style="width:3em;height:3em;" alt="Foto Médico">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="card-body p-1">
                                        <div class="overflow-hidden" style="max-width:100%;">
                                            <div class="card-title font-weight-bold text-secondary"  style="font-size: 1.3em;white-space: nowrap;">
                                                ${valueOfElement['medico']}
                                            </div>
                                        </div>

                                            <div class="card-text m-1">
                                                <div class="text-primary icon_esp"  data-tippy-content="Especialidad">
                                                    <img src="${location.origin}/image/system/especialidades/${valueOfElement['especialidad_imagen']}.svg" class="card-img rounded-circle" style="width:1.5em;height:1.5em;" alt="Especialidad">
                                                    ${valueOfElement['especialidad']}
                                                </div>
                                                <div class="mt-1 icon_esp"  data-tippy-content="Pacientes siendo tratados por ${valueOfElement['medico']}">
                                                    <span style="font-size: 1em;" class="badge badge-primary">${valueOfElement['cantidad_pacientes']}</span>
                                                    <span class="text-primary font-weight-bold">Paciente${valueOfElement['cantidad_pacientes']>1?'s':''}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
                $(".card-especialista").on("click", function() {

                    Component.viewByMedico({
                        'medico': $(this).data("medico"),
                        'medico_id': $(this).data("id")
                    });
                    //UserCuestPad.menuAccion('m_covid', $(this).data("area"), $(this).data("titlearea"))
                });
            }else{
                $("#lista_especialistas_by_area").html(`
                    <div class="text-center p-3 text-primary">
                        No se encontraron Médicos activos en esta área.
                    </div>
                `)
            }

            tippy(`.icon_esp`, {
                theme: "tooltip-cmdlt-primary",
                zIndex: 200000
            })


        })

    }
    static menuEquipoEnEspecialidad({selector='.modal-body',cat_especialidad_id='null'}) {
        $("#modelId").modal("show")

        $(selector).html(`
            <div>
                <h1 class="text-primary">
                    Equipo médico en la Especialidad
                </h1>
            </div>
            <div id="lista_especialistas_by_area" style="max-height: 60vh;overflow: auto;" class="row row-cols-1 row-cols-md-3">
                <div class="d-flex m-4 justify-content-center text-primary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                    <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>
        `);

        UserEquipoSalud.medicosByEspecialidad({cat_especialidad_id})
        .then(response=>{
            $("#lista_especialistas_by_area").empty()
            if (Object.keys(response).length>0) {
                $.each(response, function (indexInArray, valueOfElement) {
                    $("#lista_especialistas_by_area").append(`
                        <div class="col mb-4">
                            <div data-id="${valueOfElement['user_id']}" data-medico="${valueOfElement['medico']}" class="card card-especialista mb-3">
                                <div class="row no-gutters py-2">
                                    <div class="col-md-2 border-right">
                                        <div class="text-center mt-1">
                                            <img onerror="reemplaza_imagen(this)" src="${location.origin}${valueOfElement['imagen']}" class="card-img rounded-circle" style="width:3em;height:3em;" alt="Foto Médico">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="card-body p-1">
                                        <div class="overflow-hidden" style="max-width:100%;">
                                            <div class="card-title font-weight-bold text-secondary"  style="font-size: 1.3em;white-space: nowrap;">
                                                ${valueOfElement['medico']}
                                            </div>
                                        </div>

                                            <div class="card-text m-1">
                                                <div class="text-primary icon_esp"  data-tippy-content="Especialidad">
                                                    <img src="${location.origin}/image/system/especialidades/${valueOfElement['especialidad_imagen']}.svg" class="card-img rounded-circle" style="width:1.5em;height:1.5em;" alt="Especialidad">
                                                    ${valueOfElement['especialidad']}
                                                </div>
                                                <div class="mt-1 icon_esp"  data-tippy-content="Pacientes siendo tratados por ${valueOfElement['medico']}">
                                                    <span style="font-size: 1em;" class="badge badge-primary">${valueOfElement['cantidad_pacientes']}</span>
                                                    <span class="text-primary font-weight-bold">Paciente${valueOfElement['cantidad_pacientes']>1?'s':''}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
                $(".card-especialista").on("click", function() {

                    Component.viewByMedico({
                        'medico': $(this).data("medico"),
                        'medico_id': $(this).data("id")
                    });
                    //UserCuestPad.menuAccion('m_covid', $(this).data("area"), $(this).data("titlearea"))
                });
            }else{
                $("#lista_especialistas_by_area").html(`
                    <div class="text-center p-3 text-primary">
                        No se encontraron Médicos activos en esta área.
                    </div>
                `)
            }

            tippy(`.icon_esp`, {
                theme: "tooltip-cmdlt-primary",
                zIndex: 200000
            })


        })

    }
    static medicosByArea({area='tp',searchBy='medico'}){
        let formdata = new FormData();
        formdata.append("area", area)
        formdata.append("searchBy", searchBy)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_equipo_salud/medicosByArea", formdata)

    }
    static medicosByEspecialidad({cat_especialidad_id='null'}){
        let formdata = new FormData();
        formdata.append("cat_especialidad_id", cat_especialidad_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_equipo_salud/medicosByEspecialidad", formdata)

    }
}
