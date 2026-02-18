class UserCuestMedicoPaciente {
    static index({selector="#user_cuest_medico_paciente_index",user_id}){
        $(selector).html(`
            <table class="w-100">
                <tbody id="listado_medicos">
                    <tr>
                        <td class="p-0" style>
                            <input id="text" type="hidden" value="4141245484" />
                            <center>
                                <div id="qrcode" class="tooltip-primary" data-tippy-content="Escanee el código para llamar a Luis."></div>
                            </center>
                        </td>
                        <td class="p-0">
                            <b class="text-primary">Especialista:</b> Luis Eduardo Parodi Arritea<br>
                            <b class="text-secondary">Cargo:</b> Rey del pasillo<br>
                        </td>
                        <td class="p-0 align-middle">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=584141245484" data-tippy-content="Abre Whatsapp Web para hablar con Luis." style="width: 30px;height: 30px;padding: 1%;" class="tooltip-success btn btn-default"><i class="fab fa-whatsapp text-success"></i></a>
                            <button data-tippy-content="Eliminar médico al Paciente" style="width: 30px;height: 30px;font-size: 0.5em;" class="tooltip-danger delete-row btn btn-danger" data-option=""><i class="fa fa-minus" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        `);



        UserCuestMedicoPaciente.qr({});

    }
    static create({selector="#user_cuest_medico_paciente_create",tipoMedico="tratante",user_id}){

        $(selector).html(`
            <div class="h3 text-primary">
                Agregue Médico ${jsUcfirst(tipoMedico) }
            </div>
            <table class="w-100">
                <tbody>
                    <tr>
                        <th class="p-0 text-primary">
                            Equipo Médico
                        </th>
                        <th class="p-0 text-primary">
                            Cargo
                        </th>
                        <th class="p-0 text-primary">
                        </th>
                    </tr>
                    <tr>
                        <th class="p-1 text-primary text-center">
                            <select id="med_${tipoMedico}" style="width: 200px;" class="form-control mySelect2"></select>
                        </th>
                        <th class="p-1 text-primary text-center">
                            <input id="cargo_${tipoMedico}" class="form-control" style="width:200px">
                        </th>
                        <th class="p-1 text-primary text-center">
                            <button id="store_model" data-tippy-content='Pulse para guardar médico seleccionado' class="tooltip-success btn btn-outline-success guardar" type="button"><i class="far fa-save"></i></button>
                        </th>
                    </tr>
                </tbody>
            </table>
        `);

        $('.mySelect2').select2({
            dropdownParent: $('#modelId'),
            placeholder:"Méd. "+jsUcfirst(tipoMedico)
        });


        //SELECT MEDICOS
        UserMedico.getMedicos()
        .then(response => {
            let especialidad ="";
            let group  =`<optgroup label="">`;
                group +=`<option value=""></option>`;
                group +=`</optgroup>`
            let key = true;
            $.each(response, function(indexInArray, valueOfElement) {
                let temp =especialidad;
                if (especialidad!==valueOfElement.especialidad) {
                    especialidad = valueOfElement.especialidad
                    group +=`<optgroup class='text-primary' label="${especialidad}">`
                }
                if (especialidad===valueOfElement.especialidad) {
                    group +=`<option value="${valueOfElement.user_id}">${valueOfElement.medico}</option>`
                }
                if (temp!==valueOfElement.especialidad) {
                    group +=`</optgroup>`
                }
            });
            $(`#med_${tipoMedico}`).append(group);
        })


    }
    static async destroy(user_id_medico,user_id_paciente) {
        let formdata = new FormData();

        formdata.append("user_id_medico", user_id_medico)
        formdata.append("user_id_paciente", user_id_paciente)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return await post( location.origin+"/user_cuest_medico_paciente/destroy", formdata)
    }
    static destroyById({
        medico_paciente_id,
        grupo_medico_id,
        color,
        name,
        user_id
    }) {


        let formdata = new FormData();

        formdata.append("id", medico_paciente_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        post( location.origin+"/user_cuest_medico_paciente/eliminarById", formdata)
        .then(medicosByPaciente=>{
            let data = {
                medicosByPaciente,
                grupo_medico_id,
                color,
                user_id,
                name
            };
            UserCuestMedicoPaciente.actualizarGrupoMedicoPaciente(data)
        })
    }

    static medicoDelPaciente({
        medicosByPaciente,
        grupo_medico_id,
        color,
        user_id,
        name
    }){
        if(medicosByPaciente.length > 0){
            //2.1 ultimo medico agregado
            let medicoMasReciente = first(medicosByPaciente);
                $(`#default_${grupo_medico_id}`).html(`
                    <span style="background-color: #e9ecef;" class="px-1 rounded">
                        <span class="badge bg-${color} scale-in-hor-left" style="width:2em;">${name.substr(0,2).toUpperCase()}</span> ${medicoMasReciente.medico}
                    </span>
                `);

            //2.2 grupo de medicos agregados
            let medicosDelpaciente = "";
                medicosByPaciente.forEach( medico => {
                        let data = {
                            grupo_medico_id,
                            color,
                            user_id,
                            name,
                            medico_paciente_id : medico.medico_paciente_id
                        };

                        medicosDelpaciente += `
                            <tr id="row_medico_id${medico.id}">
                                <td >
                                    ${medico.medico}
                                </td>
                                <td nowrap>
                                    <input id="text_${medico.user_id}" title="text_${medico.user_id}" type="hidden" value="${medico.telefono_movil}" />
                                    <a onclick="$('#collapse${medico.user_id}').slideToggle('slow')" class="btn btn-light tooltip-primary" data-tippy-content="Número contacto de ${medico.medico}." style="width: 30px;height: 30px;padding: 1%;">
                                        <i class="fas fa-qrcode text-primary"></i>
                                    </a>
                                    <a
                                        target="_blank"
                                        href="https://api.whatsapp.com/send?phone=${medico.telefono_movil}" data-tippy-content="Abre Whatsapp Web para hablar con ${medico.medico}." style="width: 30px;height: 30px;padding: 1%;"
                                        class="tooltip-success btn btn-default"
                                    >
                                        <i class="fab fa-whatsapp text-success"></i>
                                    </a>
                                    <button
                                        data-tippy-content="Eliminar médico"
                                        data-user_id_paciente="${user_id}"
                                        data-user_id_medico="${medico.user_id}"
                                        data-medico_paciente_id="${medico.medico_paciente_id}"
                                        onclick="UserCuestMedicoPaciente.destroyById({grupo_medico_id:${grupo_medico_id},
                                            color:'${color}',
                                            user_id:${user_id},
                                            name:'${name}',
                                            medico_paciente_id :${medico.medico_paciente_id} })"
                                        style="width: 30px;height: 30px;font-size: 0.5em;"
                                        class="tooltip-danger delete-row btn btn-danger eliminar${grupo_medico_id}"
                                        data-option=""
                                    >
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                    <div class="collapse" id="collapse${medico.user_id}">
                                        <div class="card card-body p-1 mt-1">
                                            <center>
                                                <div id="qrcode_${medico.user_id}" class="tooltip-primary" data-tippy-content="Escanee el código para llamar a ${medico.medico}." ></div>
                                                ${medico.telefono_movil}
                                            </center>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;

                })
                $(`#filas_${grupo_medico_id}`).html(medicosDelpaciente);

                $('.mySelect2').select2({
                    dropdownParent: $('#modelId'),
                    placeholder:"Seleccione Médico"
                });


        }else{
            $(`#default_${grupo_medico_id}`).html(`
                <i class="fas fa-user-md text-${color}"></i> ${name}
            `);
            $(`#filas_${grupo_medico_id}`).html(`
                <tr>
                    <td colspan = "2" class = "text-center text-primary">
                        Sin médico seleccionado
                    </td>
                </tr>
            `);
        }
            // eventos()
    }
    static actualizarGrupoMedicoPaciente({
        grupo_medico_id,
        color,
        name,
        medicosByPaciente,
        user_id
    }){

        pacientes_datos.map(x=>{
            if (x.user_id == user_id) {
                x.medico_paciente = medicosByPaciente;
            }
        });

        let model = pacientes_datos.filter(x =>x.user_id ==user_id)[0];

        medicosByPaciente = filtroMedico(model.medico_paciente,grupo_medico_id)
        let data = {
            medicosByPaciente,
            grupo_medico_id,
            color,
            user_id,
            name
        };
        UserCuestMedicoPaciente.medicoDelPaciente(data);
    }
    static guardarMedicoPaciente({
        grupo_medico_id,
        color,
        name,
        user_id,
        position_id = 0,
        episodio_id = null

    }){

        let user_id_medico = $(`#med_${grupo_medico_id}`).val();

        if(user_id_medico !== ""){

            $(`#default_${grupo_medico_id}`).html(carga());


            if (grupo_medico_id === 1 || grupo_medico_id === 2) {
                    position_id = grupo_medico_id;
            }else{
                    position_id =$(`#med_${grupo_medico_id} option:selected`).data('position_id');
            }

            UserCuestMedicoPaciente.store(user_id_medico, user_id, position_id,episodio_id)
            .then(medicosByPaciente=>{
                let data = {
                    grupo_medico_id,
                    color,
                    user_id,
                    name,
                    medicosByPaciente
                };
                UserCuestMedicoPaciente.actualizarGrupoMedicoPaciente(data);

            })
        }else{
            message = Component.alertMessage("expire_sesion");
            Toast.fire({
                icon: message['imagen'],
                title: message['title'],
                text: "Médico no seleccionado",
                timer:5000

            })
        }
    }
    static listadoMedicoPaciente({
        selector          = "#sample",
        grupo_medico_id   = 1,
        color             = "primary",
        name              = "Sample",
        medicosByPaciente = [],
        user_id           = null
    }){
        let data = {
            grupo_medico_id,
            color,
            user_id,
            name
        };
        //1 Pintar contenido html
            $(selector).html( `
                <div class="btn-group dropleft">
                    <a
                        id                 = "default_${grupo_medico_id}"
                        class              = "btn btn-default py-0 border-0 overflow-hidden text-left dropdown-toggle tooltip-${color}"
                        style              = "width: 15em;"
                        data-tippy-content = "Equipo ${name}"
                        data-toggle        = "dropdown"
                        aria-haspopup      = "true"
                        aria-expanded      = "false"
                        onclick            = "$('.dropdownManual').hide();showHide('#cajamedico${grupo_medico_id}');"
                    >
                            <span class="text-secondary">Cargando...</span>
                            <span class="spinner-border text-primary spinner-border-sm" role="status">
                                <span class=""></span>
                            </span>

                    </a>

                    <div
                        id = "cajamedico${grupo_medico_id}"
                        class           = "dropdownManual cajamedico"
                        aria-labelledby = "trigger${grupo_medico_id}"
                    >
                        <div class="p-1">
                            <div id="">
                                <div class="h5 pl-1 text-${color}">
                                    Equipo ${name}
                                    <i id="close_modal" onclick="$('#cajamedico${grupo_medico_id}').hide();" class="fas cursor-pointer heartbeat fa-times m-1 float-right"></i>
                                </div>
                                <div class="table-responsive">
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <th class="p-0 pl-1 text-primary" colspan="2">
                                                    Equipo Médico
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-primary text-center">
                                                    <select id="med_${grupo_medico_id}" data-posicion="${grupo_medico_id}" style="width:200px" class="form-control mySelect2">
                                                    </select>
                                                </th>

                                                <th class="p-1 text-primary text-center">
                                                    <button
                                                        id="store_model_${grupo_medico_id}"
                                                        data-grupo_medico_id="${grupo_medico_id}"
                                                        data-tippy-content='Guardar médico ${name}'
                                                        onclick="UserCuestMedicoPaciente.guardarMedicoPaciente({
                                                            grupo_medico_id:${grupo_medico_id},
                                                            color:'${color}',
                                                            user_id:${user_id},
                                                            name:'${name}'})"
                                                        class="tooltip-${color} btn btn-outline-${color} guardar${grupo_medico_id}"
                                                        type="button"><i class="far fa-save"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div id="user_medico_${grupo_medico_id}_index" style="max-height: 15em;overflow: auto;">
                                <table class="table table-bordered">
                                    <thead >
                                        <tr>
                                            <th style="color:var(--primary) !important;top: -5px;" class="bg-white sticky-top text-center">
                                                Médico
                                            </th>
                                            <th style="color:var(--primary) !important;top: -5px;" class="bg-white sticky-top text-center">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="filas_${grupo_medico_id}">
                                        <tr>
                                            <td colspan="2" class="text-center text-secondary">
                                                Cargando...
                                                <span class="spinner-border text-primary spinner-border-sm" role="status">
                                                    <span class=""></span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            `);

        //2 Pintar catalogo total de medicos
            if(grupo_medico_id === 1 || grupo_medico_id === 2){
                if(medicos_datos.length > 0){
                    $(`#med_${grupo_medico_id}`).html(UserMedico.getGroup(medicos_datos));
                }else{
                    $(`#med_${grupo_medico_id}`).html(`<option value="">No disponible</option>`);
                }
            }else{
                let grupoMedicoXPosicion = [];
                medicos_datos.forEach(x => {
                    grupos_medicos[grupo_medico_id-1].forEach(y => {
                        if (y === x.posicion_id) {
                            grupoMedicoXPosicion.push(x);
                        }
                    })
                });
                if(grupoMedicoXPosicion.length > 0){
                    $(`#med_${grupo_medico_id}`).html(UserMedico.getGroup(grupoMedicoXPosicion));
                }else{
                    $(`#med_${grupo_medico_id}`).html(`<option value="">No disponible</option>`);
                }

            }
            $('.mySelect2').select2({
                dropdownParent: $('#modelId'),
                placeholder:"Seleccione Médico"
            });
        //3 Pintar médicos medicos del paciente
        UserCuestMedicoPaciente.medicoDelPaciente({
            medicosByPaciente,
            grupo_medico_id,
            color,
            user_id,
            name
        });
    }
    static eliminar(medico_paciente_id,user_id_paciente) {
        //tarjeta medico listgroup

        var message = Component.alertMessage('destroy_row_cuestion');
        Swal.fire({
            icon: message['image'],
            title: message['message'],
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,

        }).then((result) => {
            if (result.isConfirmed) {
                let formdata = new FormData();

                formdata.append("id", medico_paciente_id)
                formdata.append("_token", $("#_token").val())
                formdata.append("created_at", timestamps())
                post( location.origin+"/user_cuest_medico_paciente/eliminarById", formdata)
                .then(medicosByPaciente=>{

                    if (Object.keys(medicosByPaciente).length >0) {
                        pacientes_datos.map(x=>{
                            if (x.user_id == first(medicosByPaciente).user_id) {
                                x.medico_paciente = medicosByPaciente;
                            }
                        });
                    }else{
                        pacientes_datos.map(x=>{
                            if (x.user_id == user_id_paciente) {
                                x.medico_paciente = [];
                            }
                        });
                   }


                   $(`#row_${medico_paciente_id}_medico`).slideUp("slow");
                })

            }
        })


    }
    static async store(user_id_medico, user_id_paciente,position_id,episodio_id) {
        let formdata = new FormData();
        formdata.append("user_id_medico", user_id_medico)
        formdata.append("user_id_paciente", user_id_paciente)
        formdata.append("episodio_id", episodio_id)
        formdata.append("position_id", position_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return await post( location.origin+"/user_cuest_medico_paciente/store", formdata)
    }
    static async show(user_id,cat_user_medico_paciente_id) {
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("cat_user_medico_paciente_id", cat_user_medico_paciente_id)
        return await post( location.origin+"/user_cuest_medico_paciente/show/" + user_id +"/"+cat_user_medico_paciente_id, formdata)
    }
    static async fixed_medico_paciente(row){
        //PARA SABER LOS MEDICOS TRATANTES A LOS QUE HAY QUE AÑADIRLES EL EPISODIO ACTUAL
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("user_cuest_episodio_id", row.episodio)
        formdata.append("user_id_paciente", row.user_id)
        formdata.append("created_at", timestamps())
        let model =  await post( location.origin+"/user_cuest_medico_paciente/fixed_medico_paciente", formdata)
        console.log(model)
        return model;
    }
}
