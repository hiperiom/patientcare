<template>
    <div class="flex-fill px-2 d-flex flex-column overflow-auto">
        <div class="d-flex flex-wrap mb-2">
            <div class="col-12 col-sm-6 pl-0">
                <h4 class="text-primary px-1">Por confirmar</h4>
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
                        <td class="p-1 botones-fila" style="width: 160px;">
                            <a @click="handleCitaReferenciaMedica()" class="btn btn-info btn-block btn-sm cita-referencia" data-btn-id="9" data-cat_user_cita_status_id="4" href="#" role="button" title="Referencia NO DISPONIBLE" data-cita_id="27248" data-user_id_paciente="358171">
                                <i class="fas fa-file-alt cita-referencia" style="width:15px;height:15px;" title="Referencia NO DISPONIBLE"></i>
                                Referencia
                            </a>
                            <a @click="handle_atender_hoy()" class="btn btn-success btn-block btn-sm atender-hoy-cita" data-btn-id="7" data-cat_user_cita_status_id="4" href="#" role="button" data-cita_id="27248" data-user_id_paciente="358171">
                                <img class="atender-hoy-cita" src="/image/system/calendar-check.svg" style="width:15px;height:15px;" alt="Not Image Found" data-cita_id="27248" data-user_id_paciente="358171"> Atender Hoy
                            </a>
                            <a @click="handle_citas_confirmadas()" class="btn btn-primary btn-block btn-sm aprobar-cita" data-btn-id="0" data-cat_user_cita_status_id="4" href="#" role="button" data-cita_id="27248" data-user_id_paciente="358171">
                                <img data-cat_user_cita_status_id="4" class="aprobar-cita" src="/image/system/calendar-check.svg" style="width:15px;height:15px;" alt="Not Image Found" data-cita_id="27248" data-user_id_paciente="358171">
                                Confirmar
                            </a>
                            <a @click="handle_cita_reprogramar()" class="btn btn-warning btn-block btn-sm cita-reprogramar" data-btn-id="1" data-cat_user_cita_status_id="2" href="#" role="button" data-cita_id="27248" data-user_id_paciente="358171">
                                <img data-cat_user_cita_status_id="2" class="cita-reprogramar" src="/image/system/calendar-exclamation.svg" style="width:15px;height:15px;" alt="Not Image Found" data-cita_id="27248" data-user_id_paciente="358171">
                                Reprogramar
                            </a>
                            <a @click="handle_cancelar()" class="btn btn-danger btn-block btn-sm cancelar-cita" data-btn-id="6" data-cat_user_cita_status_id="3" href="#" role="button" data-cita_id="27248" data-user_id_paciente="358171">
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
        name:"CitasPorConfirmar",
        methods:{
            handleCitaReferenciaMedica(){

            },
            async handle_atender_hoy(e, cita_id, cat_user_cita_status_id) {
                /* let date = new Date()
                useState.formReprogramar = {
                    "cat_user_cita_status_id": 5,
                    "year": date.getFullYear(),
                    "month": (date.getMonth() + 1),
                    "day": date.getDate(),
                    "hour": date.getHours() + ":" + date.getMinutes(),
                    "coments": "Cita cambiada para hoy",
                    "cita_id": cita_id
                }
                */

                Swal.fire({
                    title: '¿Deseas atender esta cita hoy?',
                    text: "El paciente debe estar al tanto, antes de adelantar la fecha",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Aún no!',
                    confirmButtonText: 'Si, Atender!'
                }).then(async (result) => {

                    if (result.isConfirmed) {
                        /* d.querySelector(".overlay").classList.remove("d-none")
                        let model = store_reprogramar()
                        set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                        set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                        set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                        set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                        Swal.fire(
                            'Cita Actualizada para hoy!',
                            "Notifique al paciente el momento del día en que será atendido",
                            'success'
                        )


                        handle_tablaCitas(useState.status_current_tab)
                        await updateTotales()
                        console.log(useState.citas)
                        d.querySelector(".overlay").classList.add("d-none") */
                    }
                })

            },
            async handle_citas_confirmadas(e) {
              /*   d.querySelector("#tab_citas").classList.remove("d-none")
                d.querySelector("#tab_preconsulta").classList.add("d-none")
                let { cita_id, cat_user_cita_status_id } = e.target.dataset */

                Swal.fire({
                    title: '¿Desea confirmar esta cita?',
                    //text: "Esta acción no se puede revertir!",
                    iconHtml: '<i class="pc-warning text-warning" style="font-size:100px"></i>',
                    customClass: {
                        icon: 'border-0'
                    },
                    //icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Aún no!',
                    confirmButtonText: 'Si, Confirmar!'
                }).then(async (result) => {


                    /* if (result.isConfirmed) {
                        d.querySelector(".overlay").classList.remove("d-none")
                        // console.log("---->", cita_id,cat_user_cita_status_id)
                        let fecha_cita = await get_cita_fecha(cita_id)
                        //console.log("*****>>>   ", fecha_cita)
                        //VALIDACION
                        //SI LA CONFIRMACIÓN ES PARA UNA CITA QUE ES DEL MISMO DIA, LA ACTUALIZAREMOS A PRECONSULTA Y NO A CONGIRMADA PARA AHORRARNOS UN PASO

                        let model = await store_cita_status(cita_id, 4)

                        set_item_cita(cita_id, "cat_user_cita_status_id", 4)
                        await updateTotales()
                        handle_tablaCitas(useState.status_current_tab)
                        //d.querySelector(`.row-cita-${cita_id}`).remove()
                        Swal.fire(
                            'Cita confirmada!',
                            'El paciente será notificado de esta acción',
                            'success'
                        )
                        d.querySelector(".overlay").classList.add("d-none")
                    } */
                })
            },
            async handle_cita_reprogramar(e, cita_id){

                                /* let cita = await get_cita(cita_id)
                                    console.log("cita",cita)
                                    useState['formReprogramar'] = {
                                        "cat_user_cita_status_id": 2,
                                        "year"                   : cita['year'],
                                        "month"                  : null,
                                        "day"                    : null,
                                        "hour"                   : null,
                                        "coments"                : "",
                                        "cita_id"                : cita_id,
                                        "agenda"                 : null,
                                        "user_id_medico"         : cita['user_id_medico'],
                                    }

                let medicos_id = await solicitud_cita_select_CENTRO_SALUD(cita['centro_salud_id'])
                let temp_medicos =  await solicitud_cita_select_MEDICO({
                        medicos_id,
                        "cat_especialidad_id":cita['cat_especialidad_id'],
                        "centro_salud_id":cita['centro_salud_id']
                    })
                    useState['formReprogramar']['agendas'] = temp_medicos
                    useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],cita['user_id_medico']))



                    //console.log("temp_medicos",temp_medicos)
                let $modal = d.querySelector(`#exampleModal`)

                    $modal.querySelector(".modal-body").innerHTML = null
                let dia_agendado = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)

                let header =   `
                        <div class="bg-light p-2">
                            <h3 class="exampleModal_title text-primary">Reprogramar Cita</h3>
                            <table class="w-100">
                                <tr>
                                    <th class="pr-1 text-secondary">Paciente:</th>
                                    <td class="exampleModal_paciente">${cita['paciente']}</td>
                                </tr>
                                <tr>
                                    <th class="pr-1 text-secondary">Especialidad:</th>
                                    <td>${cita['especialidad_nombre']}</td>
                                </tr>
                                <tr>
                                    <th class="pr-1 text-secondary">Centro de Salud:</th>
                                    <td>${cita['centro_salud_description']}</td>
                                </tr>
                                <tr>
                                    <th class="pr-1 text-secondary">Médico:</th>
                                    <td class="exampleModal_medico">
                                        <select name="user_id_medico" class="form-control border-0">
                                            ${selectCustom(temp_medicos,cita['user_id_medico'])}
                                        </select>
                                    </td>
                                </tr>
                                <tr class="bg-secondary text-primary">
                                    <th class="pr-1">Fecha agendada:</th>
                                    <td>${ fechaCortaCustom3( dia_agendado )}</td>
                                </tr>
                            </table>
                        </div>
                    `
                    $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend",header)

                    $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend", `
                        <div class="h4 text-center text-primary">Selecciona un dia del calendario</div>
                        <div id="calendar" class="daterange" style="width: 100%"></div>
                        <div id="mensaje_dia_seleccionado" class="rounded text-center"></div>
                        <div class="h4 text-center text-primary">Selecciona una hora</div>
                        <ul class="nav justify-content-center nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                            <div class="flex-fill text-center text-secondary" style="font-size:15px">
                                Sin Horas disponibles
                            </div>
                        </ul>
                        <div class="h4 text-center text-primary">Motivo de reprogramación <span class="text-gray">(Opcional)</span></div>
                        <div class="container-fluid">
                            <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3" aria-describedby="helpId" rows="3"></textarea>
                        </div>
                    `)





                    d.querySelector(`textarea[name='coments']`).addEventListener("change",async (e)=>{
                        useState['formReprogramar']['coments'] = e.target.value
                        console.log(useState['formReprogramar'])
                    })
                    d.querySelector(`select[name='user_id_medico']`).addEventListener("change",async (e)=>{
                        let cita = await get_cita(cita_id)
                        let temp_medicos =  await solicitud_cita_select_MEDICO({
                                medicos_id,
                                "cat_especialidad_id":cita['cat_especialidad_id'],
                                "centro_salud_id":cita['centro_salud_id']
                            })
                            useState['formReprogramar']['agendas'] = temp_medicos
                            useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],e.target.value))


                            useState['formReprogramar']['user_id_medico'] = e.target.value
                            //console.log(e.target.selectedOptions)
                            console.log(useState['formReprogramar'])
                            activarAgenda()

                    })

                    d.addEventListener("click",(e)=>{ */
                        /* if (e.target.matches(".cita-hora")) {

                            useState['formReprogramar']['hour'] = e.target.dataset.hora

                            console.log(useState['formReprogramar'])
                        }
                        if (e.target.matches("#reprogramacion_store")) {

                            let mes_value = useState['formReprogramar']['month']
                                if (
                                    is_null(mes_value) ||
                                    is_empty(mes_value)
                                ) {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Atención',
                                        text: "Debe seleccionar una fecha disponible en el calendario",

                                    })
                                    return false
                                }
                            let hour_value = useState['formReprogramar']['hour']
                                if (
                                    is_null(hour_value) ||
                                    is_empty(hour_value)
                                ) {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Atención',
                                        text: "Debe seleccionar una hora disponible",

                                    })
                                    return false
                                } */
                            Swal.fire({
                                title: "¿Deseas reprogramar esta cita?",
                                text: "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#2FA600',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Aún no!',
                                confirmButtonText: 'Si, reprogramar!'
                            }).then(async (result) => {

                                if (result.isConfirmed) {

                                /*  let ahora = new Date();
                                    let ahoraMilisegundos = ahora.getTime();


                                    let fechaActualizada = new Date(useState.formReprogramar['fechacompleta'] )
                                        fechaActualizada = fechaActualizada.getTime()
                                        if (fechaActualizada < ahoraMilisegundos) {
                                            Toast.fire({
                                                icon: 'warning',
                                                title: 'Atención',
                                                text: "Verifique la fecha y hora de la reprogramación",
                                            })
                                            return false
                                        }
                                        d.querySelector(".overlay").classList.remove("d-none")
                                    let model = store_reprogramar()
                                        d.querySelector(".overlay").classList.add("d-none")
                                        set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                                        set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                                        set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                                        set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                                        set_item_cita(cita_id, "hour", useState.formReprogramar['hour'])
                                        Swal.fire(
                                            'Cita reprogramada!',
                                            message.final_message,
                                            'success'
                                        )


                                        handle_tablaCitas(useState.status_current_tab)
                                        await updateTotales()
                                        console.log(useState.citas)
                                        $("#exampleModal").modal("hide") */

                                }
                            })
                        /* } */
                    /* }) */
                    /* activarAgenda()
                    $("#exampleModal").modal("show") */



            },
            async handle_cancelar (e, cita_id, cat_user_cita_status_id) {
                /*
                $("#exampleModalCancelar").modal("show")
                useState.formReprogramar = {
                    "cat_user_cita_status_id": 2,
                    "coments2": "",
                    "cita_id": cita_id
                }
                let cita = await get_cita(cita_id)
                let hora = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)


                let $modal = d.querySelector(`#exampleModalCancelar`)
                    $modal.querySelector(".modal-body form").innerHTML = null
                    $modal.querySelector(".modal-body form").innerHTML = `
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <b class="text-primary h3">Cancelar Cita</b>
                                </div>
                                <div class="col-md-12">
                                    <b class="text-secondary">Fecha Agendada:</b> <span>${fechaCortaCustom3(hora)}</span>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <h5 class="text-primary">Mótivo para cancelar:</h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3"
                                            aria-describedby="helpId" rows="3"></textarea>
                                        <small id="helpId" class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                    $modal.addEventListener("change", async function (e) {
                        //console.log(e.target.name)

                        if (e.target.name === "coments") {
                            useState.formReprogramar["coments2"] = e.target.value
                        }

                    })
                    $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => { */
                Swal.fire({
                    title: '¿Deseas cancelar esta cita?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2FA600',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Aún no!',
                    confirmButtonText: 'Si, Cancelar!'
                }).then(async (result) => {

                    if (result.isConfirmed) {
                        /* d.querySelector(".overlay").classList.remove("d-none")
                        let index_cita = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
                        //console.log("Estado antes Cancelar", useState['citas'][index_cita])
                        let model = await store_cita_status(cita_id, cat_user_cita_status_id, d.querySelector("textarea[name='coments']").value)
                        //delete_cita(cita_id)
                        useState['citas'][index_cita]['cat_user_cita_status_id'] = cat_user_cita_status_id
                        //console.log("Estado despues Cancelar", useState['citas'][index_cita])

                        handle_tablaCitas(useState.status_current_tab)
                        await updateTotales()
                        Swal.fire(
                            'Cita Cancelada!',
                            'El paciente será notificado de esta acción',
                            'success'
                        )
                        $("#exampleModalCancelar").modal("hide")
                        d.querySelector(".overlay").classList.add("d-none") */
                    }
                })

                /*  }) */


                    //},
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
