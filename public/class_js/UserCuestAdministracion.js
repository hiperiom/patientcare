import {get,post,fotoTemporal,loading,meses,fechaAMD2,is_null,activarTooltip,is_empty, timestamps, telefonoConfig, is_undefined, select, validarNumeroConDosDecimales} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
let userCuestPaciente  = new UserCuestPaciente();


class UserCuestAdministracion {
    /* static handleEmergenciaPaciente(tipo_emergencia,episodio_id){

        let datos_episodio = pacientes_datos.find(x=>x['episodio'] === episodio_id)
            console.log(tipo_emergencia,datos_episodio)

        let input_tipo_emergencia = document.querySelector('#input_tipo_emergencia')
            input_tipo_emergencia.value = tipo_emergencia


        let options_ambulatoria = document.querySelector("#options_ambulatoria")
            options_ambulatoria.classList.replace("d-flex","d-none")

            if (input_tipo_emergencia.value === "Ambulatoria") {
                options_ambulatoria.classList.replace("d-none","d-flex")
            }
            if (input_tipo_emergencia.value === "Convencional") {
                UserCuestAdministracion.handleServicioEmergencia(
                    {
                        'tipo_emergencia':input_tipo_emergencia.value,
                        'description':'Convencional',
                        'value':6,
                        'episodio_id':datos_episodio.episodio_id,
                        'color':'gray',
                        'user_id_paciente':datos_episodio.user_id
                    }
                )
            }
    } */
    /* static handleServicioEmergencia(datos){

        //console.log(datos)
        Swal.fire({
            icon: "warning",
            title: `Servicio Emergencia ${datos.description}?`,
            text:"Haz clic abajo para activar o desactivar este servicio.",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Activar`,
            cancelButtonText: `No hacer nada`,
            denyButtonText: `Desactivar`,

        }).then( async (result) => {
            if (result.isConfirmed) {

                let formdata = new FormData();
                    formdata.append("tipo_emergencia", datos.tipo_emergencia)
                    formdata.append("user_id_paciente", datos.user_id_paciente)
                    formdata.append("episodio_id", datos.episodio_id)
                    formdata.append("value",datos.value)
                    formdata.append("description",datos.description)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())


                let result = await post( location.origin+"/user/servicios/emergencia/store", formdata)

                let index = pacientes_datos.findIndex(x=>x['episodio'] === datos.episodio_id)

                    pacientes_datos[index].servicio_emergencia = result
                    UserCuestAdministracion.index(datos.episodio_id)
                    let badge = document.querySelector("#badge_walkin_"+datos.user_id_paciente)
                        badge.classList.remove("d-none","badge-info","badge-success","badge-primary","badge-gray","badge-secondary","text-white","text-secondary")
                        badge.classList.add("badge-"+result.color)
                        if ( [1,2,3,4,5].includes(Number(result['value']) ) ) {
                            badge.classList.add("text-white")
                        }else{
                            badge.classList.add("text-secondary")
                        }

                        badge.innerHTML = `<i class="pc-servicio_walkin text-white "></i> ${result.description}`
                        Swal.fire({
                            icon: "success",
                            title: `Servicio Emergencia ${datos.description} activado`,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: `Ok!`,
                        })

            }
            if (result.isDenied) {
                let formdata = new FormData();
                    formdata.append("episodio_id", datos.episodio_id)
                    formdata.append("_token", $("#_token").val())
                let result = await post( location.origin+"/user/servicios/emergencia/destroy", formdata)

                //let user = pacientes_datos.find(x=>x['episodio'] === datos.episodio_id)
                let index = pacientes_datos.findIndex(x=>x['episodio'] === datos.episodio_id)
                    pacientes_datos[index].servicio_emergencia = result
                    UserCuestAdministracion.index(datos.episodio_id)
                let badge = document.querySelector("#badge_walkin_"+datos.user_id_paciente)
                    badge.classList.remove("d-none","badge-info","badge-success","badge-primary","badge-gray","badge-secondary","text-white","text-secondary")
                    badge.classList.add("d-none")
                    badge.innerHTML = ``
                    Swal.fire({
                        icon: "success",
                        title: `Servicio Emergencia ${datos.description} desactivado`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                    })

            }

        })
    } */
    /* static handletipoPaciente(tipo_paciente){
            //SELECTOR INPUT OCULTO TIPO PACIENTE
        let input_tipo_paciente = document.querySelector('#tipo_paciente')

            //SELECTORES OPTIONS
        let options_asegurado = document.querySelector('#options_asegurado')
        let options_empresarial = document.querySelector('#options_empresarial')
        let options_cortesia = document.querySelector('#options_cortesia')
        let options_empleado = document.querySelector('#options_empleado')
        let options_otro = document.querySelector('#options_otro')

            //OCULTAR TODAS LAS CAJAS OPTIONS
            options_asegurado.classList.replace("d-block","d-none")
            options_empresarial.classList.replace("d-block","d-none")
            options_cortesia.classList.replace("d-block","d-none")
            options_empleado.classList.replace("d-block","d-none")
            options_otro.classList.replace("d-block","d-none")
            console.log(tipo_paciente);
            //MOSTRAMOS LAS OPCIONES PARA EL TIPO DE PACIENTE ACTIVO
            if (tipo_paciente === "Asegurado") {
                options_asegurado.classList.replace("d-none","d-block")
            }
            if (tipo_paciente === "Empresarial") {
                options_empresarial.classList.replace("d-none","d-block")
            }
            if (tipo_paciente === "Cortesía") {
                options_cortesia.classList.replace("d-none","d-block")
            }
            if (tipo_paciente === "Empleado") {
                options_empleado.classList.replace("d-none","d-block")
            }
            if (tipo_paciente === "Otro") {
                options_otro.classList.replace("d-none","d-block")
            }
            input_tipo_paciente.value = tipo_paciente

    } */
    static handleStoreTipoPaciente(episodio_id){
        let episodio_paciente = pacientes_datos.find(x=>x['episodio'] === episodio_id)

        let tempFormData = {
                'tipo_paciente':'Particular',
                'cat_aseguradora_id':null,
                'n_poliza':null,
                'cat_empresa_id':null,
                'autorizado_por_id':null,
                'directorio_organizacional_id':null,
                'observaciones':null,
            }

            //SELECTOR INPUT OCULTO TIPO PACIENTE
        let input_tipo_paciente = document.querySelector('#tipo_paciente')

            //SELECTOR INPUT ASEGURADORA
        let cat_aseguradora_id = document.querySelector('#cat_aseguradora_id')

            //SELECTOR INPUT NUMERO POLIZA
        let n_poliza = document.querySelector('#n_poliza')

            //SELECTOR INPUT INSTITUCION / EMPRESA / FUNDACION
        let cat_empresa_id = document.querySelector('#cat_empresa_id')

            //SELECTOR INPUT AUTORIZAZADO POR
        let autorizado_por_id = document.querySelector('#autorizado_por_id')

            //SELECTOR INPUT PERTENECE A
        let directorio_organizacional_id = document.querySelector('#directorio_organizacional_id')

            //SELECTOR INPUT OBSERVACIONES
        let observaciones = document.querySelector('#observaciones')

            //SELECTOR INPUT PACIENTE CORTESIA
        let paciente_cortesia = document.querySelector('#paciente_cortesia')

            //ASIGNAR VALOR TIPO PACIENTE AL OBJETO
            tempFormData.tipo_paciente = input_tipo_paciente.value

            //console.log('tempFormData',tempFormData)
            //SI TIPO PACIENTE ES ASEGURADO VERIFICAR SI SE HA SELECCIONADO EL SEGURO Y LA POLIZA
            if(tempFormData.tipo_paciente ==="Asegurado"){
                if (is_empty(cat_aseguradora_id.value)) {
                    Swal.fire({
                        icon: "warning",
                        title: `Debe seleccionar una Aseguradora`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                        didClose: () => {
                            setTimeout(() => { cat_aseguradora_id.focus();}, 110);
                        }
                    })
                    return false;
                }else{
                    tempFormData.cat_aseguradora_id = cat_aseguradora_id.value
                }
                if (is_empty(n_poliza.value)) {
                    /* Swal.fire({
                        icon: "warning",
                        title: `Debe escribir un número de poliza`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                        didClose: () => {
                            setTimeout(() => { n_poliza.focus();}, 110);
                        }
                    }) */
                    tempFormData.n_poliza = ""
                    return false;
                }else{
                    tempFormData.n_poliza = n_poliza.value
                }
            }
            //SI TIPO PACIENTE ES EMPRESARIAL VERIFICAR SI SE HA SELECCIONADO LA INSTITUCION/EMPRESA/FUNDACION
            if(tempFormData.tipo_paciente ==="Empresarial"){
                if (is_empty(cat_empresa_id.value)) {
                    Swal.fire({
                        icon: "warning",
                        title: `Debe seleccionar una Institución / Empresa / Fundación`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                        didClose: () => {
                            setTimeout(() => { cat_empresa_id.focus();}, 110);
                        }
                    })
                    return false;
                }else{
                    tempFormData.cat_empresa_id = cat_empresa_id.value
                }
            }
            //SI TIPO PACIENTE ES CORTESIA VERIFICAR SI SE HA SELECCIONADO QUIEN LA AUTORIZA
            if(tempFormData.tipo_paciente ==="Cortesía"){
                if (is_empty(autorizado_por_id.value)) {
                    Swal.fire({
                        icon: "warning",
                        title: `Debe seleccionar quien autoriza la cortesía`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                        didClose: () => {
                            setTimeout(() => { autorizado_por_id.focus();}, 110);
                        }
                    })
                    return false;
                }else{
                    tempFormData.autorizado_por_id = autorizado_por_id.value
                }
            }
            //SI TIPO PACIENTE ES EMPLEADO VERIFICAR SI SE HA SELECCIONADO EL AREA A LA QUE PERTENECE
            if(tempFormData.tipo_paciente ==="Empleado"){
                if (is_empty(directorio_organizacional_id.value)) {
                    Swal.fire({
                        icon: "warning",
                        title: `Debe seleccionar a qué area pertenece el empleado`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                        didClose: () => {
                            setTimeout(() => { directorio_organizacional_id.focus();}, 110);
                        }
                    })
                    return false;
                }else{
                    tempFormData.directorio_organizacional_id = directorio_organizacional_id.value
                }
            }
            //SI TIPO PACIENTE ES OTRO VERIFICAR SI SE HA DESCRITO QUE OTRO TIPO DE PACIENTE ES
            if(tempFormData.tipo_paciente ==="Otro"){
                if (is_empty(observaciones.value)) {
                    Swal.fire({
                        icon: "warning",
                        title: `Debe describir qué otro tipo de paciente es.`,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: `Ok!`,
                        didClose: () => {
                            setTimeout(() => { observaciones.focus();}, 110);
                        }
                    })
                    return false;
                }else{
                    tempFormData.observaciones = observaciones.value
                }
            }


            Swal.fire({
                icon: "warning",
                title: `¿Quieres guardar los datos?`,
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Si`,
                cancelButtonText: `No, aún no`,
                /* denyButtonText: `Desactivar`, */

            }).then( async (result) => {
                if (result.isConfirmed) {
                    let formdata = new FormData();
                        for (let key in tempFormData) {
                            formdata.append(key, tempFormData[key]  )
                        }
                        formdata.append("user_id_paciente", episodio_paciente.user_id)
                        formdata.append("episodio_id", episodio_paciente.episodio_id)
                        formdata.append("_token", $("#_token").val())
                        formdata.append("created_at", timestamps())

                    let result = await post( location.origin+"/user/tipopaciente/store", formdata)

                    let index = pacientes_datos.findIndex(x=>x['episodio'] === episodio_paciente.episodio_id)

                        pacientes_datos[index].user_tipo_paciente = result
                        UserCuestAdministracion.index(episodio_paciente.episodio_id)
                        Swal.fire({
                            icon: "success",
                            title: `Datos guardados correctamente`,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: `Ok!`,
                        })
                }

                /* if (result.isDenied) {
                    let formdata = new FormData();
                        formdata.append("episodio_id", datos.episodio_id)
                        formdata.append("_token", $("#_token").val())


                    let result = await post( location.origin+"/user/servicios/walkin/destroy", formdata)

                    let user = pacientes_datos.find(x=>x['episodio'] === datos.episodio_id)
                    let index = pacientes_datos.findIndex(x=>x['episodio'] === datos.episodio_id)
                        user.servicio_emergencia = {
                            "id": null,
                            "description": null,
                            "color": null
                        }
                        pacientes_datos[index] = user
                        UserCuestAdministracion.index(datos.episodio_id)

                    let badge = document.querySelector("#badge_walkin_"+datos.user_id_paciente)
                        badge.classList.remove("d-none","badge-info","badge-success","badge-primary")
                        badge.classList.add("d-none")
                        badge.innerHTML = `<i class="pc-servicio_walkin text-white "></i> `
                        Swal.fire({
                            icon: "success",
                            title: `Servicio Emergencia ${datos.description} desactivado`,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: `Ok!`,
                        })
                    } */

            })
    }
    static index( episodio_id) {
        let episodio = pacientes_datos.find(x=>x['episodio'] === episodio_id)
        console.log(episodio);
        let formTipoPaciente =()=>{
                return /*html */ `
                    <h3 class="ml-2 text-center text-secondary">Pulsa en el Tipo de Paciente</h3>
                    <div id="menu_tipoPaciente" class="d-flex flex-wrap bg-light m-1">
                        <button
                            onClick="UserCuestAdministracion.handletipoPaciente('Particular')"
                            class="${episodio.user_tipo_paciente.tipo_paciente==='Particular' ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="fas fa-user-injured h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Particular
                            </b>
                        </button>
                        <button
                            onClick="UserCuestAdministracion.handletipoPaciente('Asegurado')"
                            class="${episodio.user_tipo_paciente.tipo_paciente==='Asegurado' ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="fas fa-user-injured h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Asegurado
                            </b>
                        </button>
                        <button
                            onClick="UserCuestAdministracion.handletipoPaciente('Empresarial')"
                            class="${episodio.user_tipo_paciente.tipo_paciente==='Empresarial' ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="fas fa-user-injured h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Empresarial
                            </b>
                        </button>
                        <button
                            onClick="UserCuestAdministracion.handletipoPaciente('Cortesía')"
                            class="${episodio.user_tipo_paciente.tipo_paciente==='Cortesía' ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="fas fa-user-injured h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Cortesía
                            </b>
                        </button>
                        <button
                            onClick="UserCuestAdministracion.handletipoPaciente('Empleado')"
                            class="${episodio.user_tipo_paciente.tipo_paciente==='Empleado' ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="fas fa-user-injured h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Empleado
                            </b>
                        </button>
                        <button
                            onClick="UserCuestAdministracion.handletipoPaciente('Otro')"
                            class="${episodio.user_tipo_paciente.tipo_paciente==='Otro' ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="fas fa-user-injured h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Otro
                            </b>
                        </button>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div id="options_asegurado" class="${episodio.user_tipo_paciente.tipo_paciente==='Asegurado' ? 'd-block': 'd-none'} col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label>Aseguradora</label>
                                        <select class="form-control bg-gray-footer-parodi" name="cat_aseguradora_id" id="cat_aseguradora_id">
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === null ? 'selected': ''} value="">Seleccione</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 1 ? 'Selected': ''} value="1">Vumi Group</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 2 ? 'Selected': ''} value="2">Best Doctors Insurance Ho</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 3 ? 'Selected': ''} value="3">Mercantil</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 4 ? 'Selected': ''} value="4">Humanitas</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 5 ? 'Selected': ''} value="5">Seguros Caracas De Libert</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 6 ? 'Selected': ''} value="6">Usa Medical Services Vene</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 7 ? 'Selected': ''} value="7">Banesco</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 8 ? 'Selected': ''} value="8">Beneficios Medicos Intern</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 9 ? 'Selected': ''} value="9">Makler Administradora C.A</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 10 ? 'Selected': ''} value="10">Administradora De Riesgos Parsalud</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 11 ? 'Selected': ''} value="11">Euro-Center Ltda</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 12 ? 'Selected': ''} value="12">Ever Insurance</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 13 ? 'Selected': ''} value="13">Euro-Center Ltda</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 14 ? 'Selected': ''} value="14">La Internacional De Seguros,S.A</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 15 ? 'Selected': ''} value="15">Loyal</option>
                                        <option ${episodio.user_tipo_paciente.cat_aseguradora_id === 16 ? 'Selected': ''} value="16">Mafre la seguridad, ca (solo POLAR)</option>


                                            
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label>N° de poliza</label>
                                        <input type="text" value="${is_null(episodio.user_tipo_paciente.value2) ?'':episodio.user_tipo_paciente.value2}" class="form-control bg-gray-footer-parodi" id="n_poliza">
                                    </div>
                                </div>
                            </div>
                            <div id="options_empresarial" class="${episodio.user_tipo_paciente.tipo_paciente==='Empresarial' ? 'd-block': 'd-none'} col-12 col-sm-4">
                                <label>Institución / Empresa / Fundación</label>
                                <select class="form-control bg-gray-footer-parodi" name="cat_empresa_id" id="cat_empresa_id">
                                    <option ${episodio.user_tipo_paciente.cat_empresa_id === null ? 'selected': ''}  value="">Seleccione</option>
                                    <option ${episodio.user_tipo_paciente.cat_empresa_id === "1" ? 'selected': ''}  value="1">Empresas Polar</option>
                                    <option ${episodio.user_tipo_paciente.cat_empresa_id === "2" ? 'selected': ''}  value="2">Farmatodo</option>
                                    <option ${episodio.user_tipo_paciente.cat_empresa_id === "3" ? 'selected': ''}  value="3">Excelsior Gama</option>
                                </select>
                            </div>

                            <div id="options_cortesia" class="${episodio.user_tipo_paciente.tipo_paciente==='Cortesía' ? 'd-block': 'd-none'} col-12 col-sm-4">
                                <label>Autorizado por:</label>
                                <input value="${[null,'null'].includes(episodio.user_tipo_paciente.autorizado_por_id) ? '': episodio.user_tipo_paciente.autorizado_por_id}" class="form-control bg-gray-footer-parodi" name="autorizado_por_id" id="autorizado_por_id">

                            </div>
                            <div id="options_empleado" class="${episodio.user_tipo_paciente.tipo_paciente==='Empleado' ? 'd-block': 'd-none'} col-12 col-sm-4">
                                <label>Pertenece a:</label>
                                <select class="form-control bg-gray-footer-parodi" name="directorio_organizacional_id" id="directorio_organizacional_id">
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === null ? 'selected': ''} value="">Seleccione</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 1 ? 'selected': ''} value="1">Presidencia</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 2 ? 'selected': ''} value="2">Vicepresidencia</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 3 ? 'selected': ''} value="3">Secretaría</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 4 ? 'selected': ''} value="4">Dirección Médica</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 5 ? 'selected': ''} value="5">Dirección de Educación e Investigación</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 6 ? 'selected': ''} value="6">Dirección de Operaciones y Logística</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 7 ? 'selected': ''} value="7">Dirección de Comercialización</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 8 ? 'selected': ''} value="8">Dirección de Cumplimiento y Apoyo Corporativo</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 9 ? 'selected': ''} value="9">Dirección de Administración y Finanzas</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 10 ? 'selected': ''} value="10">Dirección de Ingeniería y Proyectos</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 11 ? 'selected': ''} value="11">Dirección de Medicina Comunitaria y Programas Sociales</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 12 ? 'selected': ''} value="12">Consejo Consultivo</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 13 ? 'selected': ''} value="13">Departamento de Cirugía</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 14 ? 'selected': ''} value="14">Departamento de Odontología</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 15 ? 'selected': ''} value="15">Departamento de Medicina</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 16 ? 'selected': ''} value="16">Departamento de Pediatría</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 17 ? 'selected': ''} value="17">Departamento de Ginecología y Obstetricia</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 18 ? 'selected': ''} value="18">Departamento de Medicina Crítica y Emergencia</option>
                                    <option ${episodio.user_tipo_paciente.directorio_organizacional_id === 19 ? 'selected': ''} value="19">Departamento de Medicina Crítica y Emergencia</option>
                                </select>
                            </div>
                            <div id="options_otro" class="${episodio.user_tipo_paciente.tipo_paciente==='Otro' ? 'd-block': 'd-none'} col-12">
                                <label>Descripción sobre el otro tipo de paciente.</label>
                                <textarea id="observaciones" row="2" class="form-control bg-gray-footer-parodi">${is_null(episodio.user_tipo_paciente.value1) ?'':episodio.user_tipo_paciente.value1}</textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button onclick="UserCuestAdministracion.handleStoreTipoPaciente(${episodio_id})" class="btn btn-success w-25 my-1">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                `
            }
        let formServicioEmergencia = ()=>{
                return /*html*/ `
                    <h3 class="ml-2 text-center text-primary">Selecciona tipo de Emergencia</h3>
                    <div id="menu_emergencia" class="d-flex flex-wrap bg-light m-1">
                        <button
                            onClick="UserCuestAdministracion.handleEmergenciaPaciente('Ambulatoria',${episodio_id})"
                            class="${episodio.servicio_emergencia.tipo_emergencia==='Ambulatoria' ? 'active': ''}  col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="pc-emergencia h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Emergencia Ambulatoria<br>(Walk in)
                            </b>
                        </button>
                        <button
                            onClick="UserCuestAdministracion.handleEmergenciaPaciente('Convencional',${episodio_id})"

                            class="${episodio.servicio_emergencia.tipo_emergencia==='Convencional' ? 'active': ''}  col d-flex flex-column align-items-center card-user-admin-serv primary">
                            <i class="pc-emergencia h3"></i>
                            <b class="flex-fill mb-2 title font-italic">
                                Emergencia Convencional
                            </b>
                        </button>
                    </div>
                    <div id="options_ambulatoria" class="${episodio.servicio_emergencia.tipo_emergencia==='Ambulatoria' ? 'd-flex': 'd-none'}   flex-column flex-wrap bg-light">
                        <h3 class="mr-2 text-primary text-center">
                            Walk in Emergency
                        </h3>
                        <div class="d-flex flex-wrap bg-light">
                            <button
                                onclick="UserCuestAdministracion.handleServicioEmergencia({'tipo_emergencia':'Ambulatoria','description':'Ambulatoria Walk in A','value':1,'episodio_id':${episodio_id},'color':'info','user_id_paciente':${episodio.user_id}})"
                                class="${episodio.servicio_emergencia.value==="1" ? 'active': ''}  col d-flex flex-column align-items-center card-user-admin-serv primary"
                            >
                                <i class="icon-no-check pc-serv_a mb-2"></i>
                                <i class="icon-check pc-check mb-2"></i>
                                <b class="mb-2 title font-italic">
                                    Walk in Tipo A
                                </b>
                                <div class="flex-fill d-flex flex-column justify-content-center mb-2 card-description">
                                    Evaluación por Médico Especialista<br>(Coordinador de Emergencia)
                                </div>
                                <div class="status p-2 rounded bg-white font-weight-bold"></div>
                            </button>
                            <button
                                onclick="UserCuestAdministracion.handleServicioEmergencia({'tipo_emergencia':'Ambulatoria','description':'Ambulatoria Walk in A Plus','value':2,'episodio_id':${episodio_id},'color':'info','user_id_paciente':${episodio.user_id}})"
                                class="${episodio.servicio_emergencia.value==="2" ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary"
                            >
                                <i class="icon-no-check pc-serv_a_plus mb-2"></i>
                                <i class="icon-check pc-check mb-2"></i>
                                <b class="mb-2 title font-italic">
                                    Walk in Tipo A Plus
                                </b>
                                <div class="flex-fill d-flex flex-column justify-content-center mb-2 card-description">
                                    Evaluación por Médico Especialista<br>(Coordinador de Emergencia)<br>+ Evaluación de Especialista Adicional
                                </div>
                                <div class="status p-2 rounded bg-white font-weight-bold"></div>
                            </button>
                            <button
                                onclick="UserCuestAdministracion.handleServicioEmergencia({'tipo_emergencia':'Ambulatoria','description':'Ambulatoria Walk in B','value':3,'episodio_id':${episodio_id},'color':'success','user_id_paciente':${episodio.user_id}})"
                                class="${episodio.servicio_emergencia.value==="3" ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary"
                            >
                                <i class="icon-no-check pc-serv_b mb-2"></i>
                                <i class="icon-check pc-check mb-2"></i>
                                <b class="mb-2 title font-italic">
                                    Walk in Tipo B
                                </b>
                                <div class="flex-fill d-flex flex-column justify-content-center mb-2 card-description">
                                    Evaluación por Médico Especialista<br>(Coordinador de Emergencia)
                                </div>
                                <div class="status p-2 rounded bg-white font-weight-bold"></div>
                            </button>
                            <button
                                onclick="UserCuestAdministracion.handleServicioEmergencia({'tipo_emergencia':'Ambulatoria','description':'Ambulatoria Walk in B Plus','value':4,'episodio_id':${episodio_id},'color':'success','user_id_paciente':${episodio.user_id}})"
                                class="${episodio.servicio_emergencia.value==="4" ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary"
                            >
                                <i class="icon-no-check pc-serv_b_plus mb-2"></i>
                                <i class="icon-check pc-check mb-2"></i>
                                <b class="mb-2 title font-italic">
                                    Walk in Tipo B Plus
                                </b>
                                <div class="flex-fill d-flex flex-column justify-content-center mb-2 card-description">
                                    Evaluación por Médico Especialista<br>(Coordinador de Emergencia)<br>+ Evaluación de Especialista Adicional
                                </div>
                                <div class="status p-2 rounded bg-white font-weight-bold"></div>
                            </button>
                            <button
                                onclick="UserCuestAdministracion.handleServicioEmergencia({'tipo_emergencia':'Ambulatoria','description':'Ambulatoria No Walk in','value':5,'episodio_id':${episodio_id},'color':'secondary','user_id_paciente':${episodio.user_id}})"
                                class="${episodio.servicio_emergencia.value==="5" ? 'active': ''} col d-flex flex-column align-items-center card-user-admin-serv primary"
                            >
                                <i class="icon-no-check pc-serv_nw mb-2"></i>
                                <i class="icon-check pc-check mb-2"></i>
                                <b class="mb-2 title font-italic">
                                    No Walk in
                                </b>
                                <div class="flex-fill d-flex flex-column justify-content-center mb-2 card-description">
                                    Evaluación por Médico Especialista<br>(Coordinador de Emergencia)<br>+ Evaluación de Especialistas Adicionales
                                </div>
                                <div class="status p-2 rounded bg-white font-weight-bold"></div>
                            </button>
                        </div>
                    </div>
                `
            }

            $("#modal-patient-item").modal("show");
            $("#modal-patient-item .modal-body-2").html( /*html */`
                <div id="infoPaciente"></div>
                <div class="container-fluid">
                    <div class="myContent flex-fill overflow-auto p-1">
                    <div class="col-12  overflow-auto">
                        <div class="text-primary h2">
                            Datos Administrativos
                        </div>
                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-header d-flex align-items-center h1 text-primary mb-1" id="heading2">
                                    <i class="pc-seguro_medico mr-1"></i>
                                    <button class="btn btn-block mb-0 text-secondary text-left" style="font-size:1.5rem" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                        Tipo de paciente
                                    </button>
                                </div>
                                <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordionExample">
                                    <input type="hidden" id="tipo_paciente" value="${episodio.user_tipo_paciente.tipo_paciente!=='Particular' ? episodio.user_tipo_paciente.tipo_paciente: 'Particular'}">
                                    ${formTipoPaciente()}
                            </div>
                            <div class="card">
                                <div class="card-header d-flex align-items-center h1 text-primary mb-1" id="heading1">
                                    <i class="pc-servicio_walkin mr-1"></i>
                                    <button class="btn btn-block mb-0 text-secondary text-left" style="font-size:1.5rem" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Servicios
                                    </button>
                                </div>
                                <div id="collapse1" class="collapse ${episodio.servicio_emergencia.tipo_emergencia!==null ? 'show': ''}" aria-labelledby="heading1" data-parent="#accordionExample">
                                    <input type="hidden" id="input_tipo_emergencia" value="${episodio.servicio_emergencia.tipo_emergencia!==null ? episodio.servicio_emergencia.tipo_emergencia: ''}">
                                    ${formServicioEmergencia()}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);


            UserCuestPaciente.infoPaciente("#infoPaciente", episodio.user_id)


    }
}


function AppTipoPaciente(){
    return {
        name:"AppTipoPaciente",
        template: /*html */ `
            <div class="mb-1">
                <h3 class="ml-2 text-center text-secondary">
                    Pulsa en el Tipo de Paciente
                </h3>

                <div id="menu_tipoPaciente" class="d-flex flex-wrap bg-light m-1">
                    <button
                        v-for="(option,index) in options"
                        :key="'tipo_paciente_'+index"
                        @click="handletipoPaciente(option.description)"
                        :class="['col d-flex flex-column align-items-center card-user-admin-serv primary ',(tipo_paciente===option.description ? 'active': '')]">
                        <i :class="['h3 '+option.icon]"></i>
                        <b class="flex-fill mb-2 title font-italic">
                            {{option.description}}
                        </b>
                    </button>

                </div>
                <div class="container-fluid">


                    <div class="row">
                        <div
                            id="options_asegurado"
                            :class="[(tipo_paciente==='Asegurado' ? 'd-block': 'd-none'), 'col-12']"
                        >
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Aseguradora</label>
                                    <select
                                        v-model="cat_aseguradora_id"
                                        class="form-control bg-gray-footer-parodi"
                                        name="cat_aseguradora_id"
                                        id="cat_aseguradora_id"
                                    >
                                        <option value="null">Seleccione</option>
                                        <option value="">Seleccione</option>
                                        <option value="1">Vumi Group</option>
                                        <option value="2">Best Doctors Insurance Ho</option>
                                        <option value="3">Mercantil</option>
                                        <option value="4">Humanitas</option>
                                        <option value="5">Seguros Caracas De Libert</option>
                                        <option value="6">Usa Medical Services Vene</option>
                                        <option value="7">Banesco</option>
                                        <option value="8">Beneficios Medicos Intern</option>
                                        <option value="9">Makler Administradora C.A</option>
                                        <option value="10">Administradora De Riesgos Parsalud</option>
                                        <option value="11">Euro-Center Ltda</option>
                                        <option value="12">Ever Insurance</option>
                                        <option value="13">Euro-Center Ltda</option>
                                        <option value="14">La Internacional De Seguros,S.A</option>
                                        <option value="15">Loyal</option>
                                        <option value="16">Mafre la seguridad, ca (solo POLAR)</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>N° de poliza</label>
                                    <input
                                        v-model="n_poliza"
                                        type="text"
                                        class="form-control bg-gray-footer-parodi"
                                        id="n_poliza"
                                    >
                                </div>

                            </div>
                        </div>
                        <div
                            id="options_empresarial"
                            :class="[(tipo_paciente==='Empresarial' ? 'd-block': 'd-none'), 'col-12 col-sm-4']"
                        >
                            <label>Institución / Empresa / Fundación</label>
                            {{cat_empresa_id}}
                            <select
                                v-model="cat_empresa_id"
                                class="form-control bg-gray-footer-parodi"
                                name="cat_empresa_id"
                                id="cat_empresa_id"
                            >
                                <option value="null">Seleccione</option>
                                <option value="1">Empresas Polar</option>
                                <option value="2">Farmatodo</option>
                                <option value="3">Excelsior Gama</option>
                            </select>
                        </div>
                        <div
                            id="options_cortesia"
                            :class="[(tipo_paciente==='Cortesía' ? 'd-block': 'd-none'), 'col-12 col-sm-4']"
                        >
                            <label>Autorizado por:</label>
                            <input
                                v-model="autorizado_por_id"
                                class="form-control bg-gray-footer-parodi"
                                name="autorizado_por_id"
                                id="autorizado_por_id"
                            >
                        </div>
                        <div
                            id="options_empleado"
                            :class="[(tipo_paciente==='Empleado' ? 'd-block': 'd-none'), 'col-12 col-sm-4']"
                        >
                            <label>Pertenece a:</label>
                            <select
                                v-model="directorio_organizacional_id"
                                class="form-control bg-gray-footer-parodi"
                                name="directorio_organizacional_id"
                                id="directorio_organizacional_id"
                            >
                                <option value="null">Seleccione</option>
                                <option value="1">Presidencia</option>
                                <option value="2">Vicepresidencia</option>
                                <option value="3">Secretaría</option>
                                <option value="4">Dirección Médica</option>
                                <option value="5">Dirección de Educación e Investigación</option>
                                <option value="6">Dirección de Operaciones y Logística</option>
                                <option value="7">Dirección de Comercialización</option>
                                <option value="8">Dirección de Cumplimiento y Apoyo Corporativo</option>
                                <option value="9">Dirección de Administración y Finanzas</option>
                                <option value="10">Dirección de Ingeniería y Proyectos</option>
                                <option value="11">Dirección de Medicina Comunitaria y Programas Sociales</option>
                                <option value="12">Consejo Consultivo</option>
                                <option value="13">Departamento de Cirugía</option>
                                <option value="14">Departamento de Odontología</option>
                                <option value="15">Departamento de Medicina</option>
                                <option value="16">Departamento de Pediatría</option>
                                <option value="17">Departamento de Ginecología y Obstetricia</option>
                                <option value="18">Departamento de Medicina Crítica y Emergencia</option>
                                <option value="19">Departamento de Medicina Crítica y Emergencia</option>
                            </select>
                        </div>
                        <div
                            id="options_otro"
                            :class="[(tipo_paciente==='Otro' ? 'd-block': 'd-none'), 'col-12']"
                        >
                            <label>Descripción sobre el otro tipo de paciente.</label>
                            <textarea
                                id="observaciones"
                                v-model="observaciones"
                                row="2"
                                class="form-control bg-gray-footer-parodi"
                                >{{observaciones}}</textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button @click="handleStoreTipoPaciente()" class="btn btn-success w-25 my-1">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        `,
        props: {
            index:Number,
            patient_data:Object
        },
        components: {

        },
        data() {
            return {
                //optionSelected:"Particular",
                options:[
                    {
                        icon:"fas fa-user-injured",
                        description:"Particular",
                    },
                    {
                        icon:"fas fa-user-injured",
                        description:"Asegurado",
                    },
                    {
                        icon:"fas fa-user-injured",
                        description:"Empresarial",
                    },
                    {
                        icon:"fas fa-user-injured",
                        description:"Cortesía",
                    },
                    {
                        icon:"fas fa-user-injured",
                        description:"Empleado",
                    },
                    {
                        icon:"fas fa-user-injured",
                        description:"Otro",
                    },
                ],
                episodios:pacientes_datos,
                tipo_paciente:'Particular',
                cat_aseguradora_id:null,
                n_poliza:null,
                cat_empresa_id:null,
                autorizado_por_id:"",
                directorio_organizacional_id:null,
                observaciones:null,
            }
        },
        methods: {
            handletipoPaciente(newOption) {
                this.tipo_paciente = newOption
            },
            async handleStoreTipoPaciente(){

                    //SELECTOR INPUT ASEGURADORA
                let cat_aseguradora_id = document.querySelector('#cat_aseguradora_id')

                    //SELECTOR INPUT NUMERO POLIZA
                let n_poliza = document.querySelector('#n_poliza')

                    //SELECTOR INPUT INSTITUCION / EMPRESA / FUNDACION
                let cat_empresa_id = document.querySelector('#cat_empresa_id')

                    //SELECTOR INPUT AUTORIZAZADO POR
                let autorizado_por_id = document.querySelector('#autorizado_por_id')

                    //SELECTOR INPUT PERTENECE A
                let directorio_organizacional_id = document.querySelector('#directorio_organizacional_id')

                    //SELECTOR INPUT OBSERVACIONES
                let observaciones = document.querySelector('#observaciones')


                    //SI TIPO PACIENTE ES ASEGURADO VERIFICAR SI SE HA SELECCIONADO EL SEGURO Y LA POLIZA
                    if(this.tipo_paciente ==="Asegurado"){
                        if (is_null(this.cat_aseguradora_id)) {
                            Swal.fire({
                                icon: "warning",
                                title: `Debe seleccionar una Aseguradora`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                                didClose: () => {
                                    setTimeout(() => { cat_aseguradora_id.focus();}, 110);
                                }
                            })
                            return false;
                        }

                        /* if (is_null(this.n_poliza)) {
                            Swal.fire({
                                icon: "warning",
                                title: `Debe escribir un número de poliza`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                                didClose: () => {
                                    setTimeout(() => { n_poliza.focus();}, 110);
                                }
                            })
                            return false;
                        } */
                    }
                    //SI TIPO PACIENTE ES EMPRESARIAL VERIFICAR SI SE HA SELECCIONADO LA INSTITUCION/EMPRESA/FUNDACION
                    if(this.tipo_paciente ==="Empresarial"){
                        if (is_null(this.cat_empresa_id)) {
                            Swal.fire({
                                icon: "warning",
                                title: `Debe seleccionar una Institución / Empresa / Fundación`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                                didClose: () => {
                                    setTimeout(() => { cat_empresa_id.focus();}, 110);
                                }
                            })
                            return false;
                        }
                    }
                    //SI TIPO PACIENTE ES CORTESIA VERIFICAR SI SE HA SELECCIONADO QUIEN LA AUTORIZA
                    if(this.tipo_paciente ==="Cortesía"){

                        if (is_empty(this.autorizado_por_id)) {
                            Swal.fire({
                                icon: "warning",
                                title: `Debe escribir quién autoriza la cortesía`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                                didClose: () => {
                                    setTimeout(() => { autorizado_por_id.focus();}, 110);
                                }
                            })
                            return false;
                        }
                    }
                    //SI TIPO PACIENTE ES EMPLEADO VERIFICAR SI SE HA SELECCIONADO EL AREA A LA QUE PERTENECE
                    if(this.tipo_paciente ==="Empleado"){
                        if (is_null(this.directorio_organizacional_id)) {
                            Swal.fire({
                                icon: "warning",
                                title: `Debe seleccionar a qué area pertenece el empleado`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                                didClose: () => {
                                    setTimeout(() => { directorio_organizacional_id.focus();}, 110);
                                }
                            })
                            return false;
                        }
                    }
                    //SI TIPO PACIENTE ES OTRO VERIFICAR SI SE HA DESCRITO QUE OTRO TIPO DE PACIENTE ES
                    if(this.tipo_paciente ==="Otro"){
                        if (is_null(this.observaciones)) {
                            Swal.fire({
                                icon: "warning",
                                title: `Debe describir qué otro tipo de paciente es.`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                                didClose: () => {
                                    setTimeout(() => { observaciones.focus();}, 110);
                                }
                            })
                            return false;
                        }
                    }


                    Swal.fire({
                        icon: "warning",
                        title: `¿Quieres guardar los datos?`,
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: `Si`,
                        cancelButtonText: `No, aún no`,
                        /* denyButtonText: `Desactivar`, */

                    }).then( async (result) => {
                        let that = this

                        if(that.tipo_paciente==="Particular"){
                            that.cat_aseguradora_id = null
                            that.n_poliza = null
                            that.cat_empresa_id = null
                            that.autorizado_por_id = ""
                            that.directorio_organizacional_id = null
                            that.observaciones = null
                        }
                        if(that.tipo_paciente==="Asegurado"){
                            that.cat_empresa_id = null
                            that.autorizado_por_id = ""
                            that.directorio_organizacional_id = null
                            that.observaciones = null
                        }
                        if(that.tipo_paciente==="Empresarial"){
                            that.cat_aseguradora_id = null
                            that.n_poliza = null
                            that.autorizado_por_id = ""
                            that.directorio_organizacional_id = null
                            that.observaciones = null
                        }
                        if(that.tipo_paciente==="Empleado"){
                            that.cat_aseguradora_id = null
                            that.n_poliza = null
                            that.cat_empresa_id = null
                            that.autorizado_por_id = ""
                            that.observaciones = null
                        }
                        if(that.tipo_paciente==="Otro"){
                            that.cat_aseguradora_id = null
                            that.n_poliza = null
                            that.cat_empresa_id = null
                            that.autorizado_por_id = ""
                            that.directorio_organizacional_id = null
                        }




                        if (result.isConfirmed) {
                            let formdata = new FormData();

                                [
                                    'tipo_paciente',
                                    'cat_aseguradora_id',
                                    'n_poliza',
                                    'cat_empresa_id',
                                    'autorizado_por_id',
                                    'directorio_organizacional_id',
                                    'observaciones',
                                ].forEach(key=>{
                                    formdata.append(key, that[key]  )
                                })
                                formdata.append("user_id_paciente", that.patient_data.user_id)
                                formdata.append("episodio_id", that.patient_data.episodio_id)
                                formdata.append("_token", $("#_token").val())
                                formdata.append("created_at", timestamps())

                            let result = await post( location.origin+"/user/tipopaciente/store", formdata)
                            let index = pacientes_datos.findIndex(x=>x['episodio'] === that.patient_data.episodio_id)

                                this.episodios[index].user_tipo_paciente = result

                                EventBus.$on('externalVarChanged', (newValue) => {
                                    that.episodios = newValue;
                                });


                                Swal.fire({
                                    icon: "success",
                                    title: `Datos guardados correctamente`,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: `Ok!`,
                                })
                        }


                    })
            }
        },
        mounted () {
            console.log(this.patient_data);
            let {
                    tipo_paciente,
                    cat_aseguradora_id,
                    cat_empresa_id,
                    value1,
                    value2,
                    autorizado_por_id,
                    directorio_organizacional_id,
                } = this.patient_data.user_tipo_paciente

            this.tipo_paciente = tipo_paciente
            this.cat_aseguradora_id = cat_aseguradora_id
            this.n_poliza = value2
            this.cat_empresa_id = cat_empresa_id
            this.autorizado_por_id = autorizado_por_id
            this.directorio_organizacional_id = directorio_organizacional_id
            this.observaciones = value1
        }
    }
}
function AppServiciosPaciente(){
    return {
        name:"AppServiciosPaciente",
        template: /*html*/ `
            <div>
                <h3 class="ml-2 text-center text-primary">Selecciona tipo de Emergencia</h3>
                <div id="menu_emergencia" class="d-flex flex-wrap bg-light m-1">
                    <button
                        @click="handleEmergenciaPaciente('Ambulatoria')"
                        :class="[{'active': tipo_emergencia==='Ambulatoria' }, 'col d-flex flex-column align-items-center card-user-admin-serv primary']"
                    >
                        <i class="pc-emergencia h3"></i>
                        <b class="flex-fill mb-2 title font-italic">
                            Emergencia Ambulatoria<br>(Walk in)
                        </b>
                    </button>
                    <button
                        @click="handleEmergenciaPaciente('Convencional')"
                        :class="[{'active': tipo_emergencia==='Convencional' },  'col d-flex flex-column align-items-center card-user-admin-serv primary']"
                    >
                        <i class="pc-emergencia h3"></i>
                        <b class="flex-fill mb-2 title font-italic">
                            Emergencia Convencional
                        </b>
                    </button>
                </div>
                <div
                    id="options_ambulatoria"
                    :class="[(tipo_emergencia==='Ambulatoria' ? 'd-flex': 'd-none' ),  'flex-column flex-wrap bg-light']"
                >
                    <h3 class="mr-2 text-primary text-center">
                        Walk in Emergency
                    </h3>
                    <div class="d-flex flex-wrap bg-light">
                        <button
                        v-for="(item,index) in options"
                            :key="'option_'+index"
                            @click="handleEmergenciaAmbulatoriaPaciente(index)"
                            :class="[{'active':optionSelected==item.value }, 'col d-flex flex-column align-items-center card-user-admin-serv primary']"
                        >
                            <i v-if="optionSelected==item.value" :class="item.icon"></i>
                            <i v-else class="icon-check pc-check mb-2"></i>
                            <b class="mb-2 title font-italic">
                                {{item.title}}
                            </b>
                            <div class="flex-fill d-flex flex-column justify-content-center mb-2 card-description">
                                {{item.description}}
                            </div>
                            <div class="status p-2 rounded bg-white font-weight-bold"></div>
                        </button>
                    </div>
                </div>
            </div>
        `,
        props: {
            patient_data:Object
        },
        components: {

        },
        data() {
            return {
                episodios:pacientes_datos,
                tipo_emergencia:null,
                optionSelected:null,
                options:[
                    {
                        icon:"icon-no-check pc-serv_a mb-2",
                        title:"Walk in Tipo A",
                        description:"Evaluación por Médico Especialista (Coordinador de Emergencia)",
                        value:1,
                    },
                    {
                        icon:"icon-no-check pc-serv_a mb-2",
                        title:"Walk in Tipo A Plus",
                        description:" Evaluación por Médico Especialista (Coordinador de Emergencia) + Evaluación de Especialista Adicional",
                        value:2,
                    },
                    {
                        icon:"icon-no-check pc-serv_a mb-2",
                        title:"Walk in Tipo B",
                        description:"Evaluación por Médico Especialista<br>(Coordinador de Emergencia)",
                        value:3,
                    },
                    {
                        icon:"icon-no-check pc-serv_a mb-2",
                        title:"Walk in Tipo B Plus",
                        description:"Evaluación por Médico Especialista (Coordinador de Emergencia) + Evaluación de Especialista Adicional",
                        value:4,
                    },
                    {
                        icon:"icon-no-check pc-serv_a mb-2",
                        title:"No Walk in",
                        description:"Evaluación por Médico Especialista (Coordinador de Emergencia) + Evaluación de Especialistas Adicionales",
                        value:5,
                    },
                ]
            }
        },
        methods: {
            async handleServicioEmergencia(datos){
                let that = this
                //console.log(datos)
                Swal.fire({
                    icon: "warning",
                    title: `Servicio Emergencia ${this.tipo_emergencia}?`,
                    text:"Haz clic abajo para activar o desactivar este servicio.",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Activar`,
                    cancelButtonText: `No hacer nada`,
                    denyButtonText: `Desactivar`,

                }).then( async (result) => {
                    if (result.isConfirmed) {
                        let formdata = new FormData();
                            formdata.append("tipo_emergencia", this.tipo_emergencia)
                            formdata.append("user_id_paciente", this.patient_data.user_id)
                            formdata.append("episodio_id", this.patient_data.episodio_id)
                            formdata.append("value",datos.value)
                            formdata.append("description",this.tipo_emergencia)
                            formdata.append("_token", $("#_token").val())
                            formdata.append("created_at", timestamps())


                        let result = await post( location.origin+"/user/servicios/emergencia/store", formdata)

                        let index = pacientes_datos.findIndex(x=>x['episodio'] === that.patient_data.episodio_id)

                            that.episodios[index].servicio_emergencia = result

                            EventBus.$on('externalVarChanged', (newValue) => {
                                that.episodios = newValue;
                            });
                            //console.log(pacientes_datos[index]);
                            $("#modal-patient-item").modal("hide");
                            Swal.fire({
                                icon: "success",
                                title: `Servicio Emergencia ${datos.description} activado`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                            })


                    }
                    if (result.isDenied) {
                        let formdata = new FormData();
                        formdata.append("episodio_id", this.patient_data.episodio_id)
                            formdata.append("_token", $("#_token").val())
                        let myResult = await post( location.origin+"/user/servicios/emergencia/destroy", formdata)

                        let index = pacientes_datos.findIndex(x=>x['episodio'] === this.patient_data.episodio_id)
                            that.episodios[index].servicio_emergencia = myResult

                            EventBus.$on('externalVarChanged', (newValue) => {
                                that.episodios = newValue;
                            });
                            $("#modal-patient-item").modal("hide");
                            Swal.fire({
                                icon: "success",
                                title: `Servicio Emergencia ${datos.description} desactivado`,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: `Ok!`,
                            })

                    }

                })
            },
            handleEmergenciaAmbulatoriaPaciente(index) {
                this.tipo_emergencia = "Ambulatoria"
                this.optionSelected = this.options[index].value
                    this.handleServicioEmergencia(
                        {
                            'tipo_emergencia':this.tipo_emergencia,
                            'description':this.options[index].title,
                            'value': this.optionSelected ,
                            'color':'gray',
                        }
                    )
            },
            handleEmergenciaPaciente(tipo_emergencia) {
                this.tipo_emergencia = tipo_emergencia

                    if (tipo_emergencia === "Ambulatoria") {
                        return false
                    }
                    this.handleServicioEmergencia(
                        {
                            'tipo_emergencia':this.tipo_emergencia,
                            'description':'Convencional',
                            'value':6,
                            'color':'gray',
                        }
                    )
            }
        },
        mounted () {
            this.tipo_emergencia = this.patient_data.servicio_emergencia.tipo_emergencia
            this.optionSelected = this.patient_data.servicio_emergencia.value
        }
    }
}



export default function AppAdministrativeData (patient_data,index_episodio){

    $("#modal-patient-item").modal("show");
    document.querySelector("#modal-patient-item .modal-body-2").innerHTML=  `
        <div>
            <div id="infoPaciente"></div>
            <div id='AppAdministrativeData' class="fade-in flex-fill d-flex flex-column  overflow-auto">
                <div class="container-fluid">
                    <h3 class="text-primary">
                        Datos Administrativos
                    </h3>
                </div>
                <div class="container-fluid">
                    <div class="accordion  flex-fill overflow-auto" id="accordionExample">
                        <div class="card">
                            <div
                                class="card-header d-flex align-items-center h1 text-primary mb-1"
                                id="heading1"
                            >
                                <i class="pc-seguro_medico mr-1"></i>
                                <button

                                    :class="['btn btn-block mb-0 text-secondary text-left collapsed']"
                                    style="font-size:1.5rem"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#collapse1"
                                    :aria-expanded="true"
                                    aria-controls="collapse1"
                                >
                                    Tipo de paciente
                                </button>
                            </div>
                            <div
                                id="collapse1"
                                :class="['collapse show']"
                                aria-labelledby="heading1"

                            >
                                <app-tipo-paciente :index="index" :patient_data="patient_data" />
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex align-items-center h1 text-primary mb-1" id="heading2">
                                <i class="pc-servicio_walkin mr-1"></i>
                                <button

                                    :class="['btn btn-block mb-0 text-secondary text-left collapsed']"
                                    style="font-size:1.5rem"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#collapse2"
                                    :aria-expanded="true"
                                    aria-controls="collapse2"
                                >
                                    Servicios
                                </button>
                            </div>
                            <div
                                id="collapse2"
                                :class="['collapse show']"
                                aria-labelledby="heading2"

                            >
                                <app-servicios-paciente :index="index" :patient_data="patient_data" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    `;

    //

    let app = new Vue({
            name:"AppAdministrativeData",
            el: "#AppAdministrativeData",
            components: {
                "app-tipo-paciente":AppTipoPaciente(),
                "app-servicios-paciente":AppServiciosPaciente(),
            },
            data() {
                return {
                    index:index_episodio,
                    patient_data:patient_data,
                    isOpenTipoPaciente:true,
                    isOpenServiciosPaciente:true
                }
            },
            mounted () {
                userCuestPaciente.infoPaciente("#infoPaciente", this.patient_data.user_id)
            },
        })
}
