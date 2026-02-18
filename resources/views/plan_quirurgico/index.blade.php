@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')

@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column h-100 p-1">
        <nav class="navbar navbar-expand my-3 justify-content-between navbar-primary bg-primary rounded-pill ">
          <div>
            <a id="logoSystem"
              href="#"><img loading="lazy" style="height: 3em;width: 10em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/patientcare_bw.svg"></a>
          </div>
          <div>
            <a id="logoSystem"
              href="#"><img loading="lazy" style="height: 3em;width: 10em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"></a>
          </div>
        </nav>
        <nav>
            <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
              <a class="nav-link border-0 active" id="nav-atencion_paciente-tab" data-toggle="tab" href="#nav-atencion_paciente" role="tab" aria-controls="nav-atencion_paciente" aria-selected="true">Atención al Paciente</a>
              <a class="nav-link border-0" id="nav-medico-tab" data-toggle="tab" href="#nav-medico" role="tab" aria-controls="nav-medico" aria-selected="false">Médico</a>
              <a class="nav-link border-0" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Presupuesto</a>
            </div>
        </nav>
        <div style="margin-bottom:10px;padding:0px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;" class="container-fluid bg-white flex-fill overflow-auto">

              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-atencion_paciente" role="tabpanel" aria-labelledby="nav-atencion_paciente-tab">
                    <table id="myTable1" class="table bg-white table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">CI</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Teléfono Alternativo</th>
                            <th scope="col">Descripción / Solicitud</th>
                            <th scope="col">Prioridad</th>
                            <th scope="col">Presupuesto Standard</th>
                            <th scope="col">Presupuesto Definitivo o Plan Particular</th>
                            <th scope="col">% de Descuento</th>
                            <th scope="col">Médico Tratante Asignado</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
                <div class="tab-pane fade" id="nav-medico" role="tabpanel" aria-labelledby="nav-medico-tab">
                    <table id="myTable2" class="table bg-white table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">CI</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Teléfono Alternativo</th>
                            <th scope="col">Descripción / Solicitud</th>
                            <th scope="col">Prioridad</th>
                            <th scope="col">Presupuesto Definitivo</th>
                            <th scope="col">% Descuentos</th>
                            <th scope="col">Adicionales</th>
                            <th scope="col">CMDLT</th>
                            <th scope="col">Honorarios Médicos Totales</th>
                            <th scope="col">Honorarios Cirujano Principal</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <table id="myTable3" class="table bg-white table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">CI</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Teléfono Alternativo</th>

                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
              </div>



        </div>
      </div>
@endsection
@section('footer')

@endsection
@section('script')
    <script>
        let d = document
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        let useState = {
            pacientes:null,
        }
        let myTable1 = d.querySelector('#myTable1 tbody')
        let myTable2 = d.querySelector('#myTable2 tbody')
        let myTable3 = d.querySelector('#myTable3 tbody')
        let infoPaciente = (element)=>{
            return `
                <th scope="row">${element['id']}</th>
                <td class="text-nowrap">
                    ${element['fecha_creacion']}
                </td>
                <td>
                    ${!is_null(element['nombres']) ? element['nombres'] : ''} ${!is_null(element['apellidos']) ? element['apellidos'] : ''}
                </td>
                <td>${!is_null(element['cedula']) ? element['cedula'] : ''}</td>
                <td>${!is_null(element['fecha_nacimiento']) ? element['edad'] : ''}</td>
                <td>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=${!is_null(element['telefono_contacto']) ? element['telefono_contacto'].replace("+", "") : ''}" style="padding: 0% 3% 3% 3%;border: 0;line-height: 1.4;" class="btn btn-default btn-block">

                        <div class="text-gray text-nowrap overflow-hidden">
                            <i class="fab fa-whatsapp text-success"></i> ${!is_null(element['telefono_contacto']) ? element['telefono_contacto'].replace("+", "") : ''}
                        </div>
                    </a>
                </td>
                <td>
                    ${!is_null(element['telefono_contacto_alternativo']) ? element['telefono_contacto_alternativo'] : ''}
                </td>
            `
        }
        let infoAtencionPaciente = (element,key)=>{
            return `
                    <td>${!is_null(element['tipo_procedimiento']) ? element['tipo_procedimiento'] : ''}</td>
                    <td style="vertical-align:middle" class="p-0">
                        <select
                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="prioridad"
                            class="input-prioridad form-control text-center border-0" style="font-size:1.5rem;height: 50px;">
                            <option ${element['prioridad'] === 3 && 'selected'} value="3">3</option>
                            <option ${element['prioridad'] === 2 && 'selected'} value="2">2</option>
                            <option ${element['prioridad'] === 1 && 'selected'} value="1">1</option>
                        </select>
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input
                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="presupuesto_standard"
                            type="number"
                            placeholder="0"
                            value="${Number(element['presupuesto_standard']) === 0 ? '': element['presupuesto_standard'] }"
                            class="input-presupuesto_standard border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input
                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="presupuesto_definitivo"
                            type="number"
                            placeholder="0"
                            value="${Number(element['presupuesto_definitivo']) === 0 ? '': element['presupuesto_definitivo'] }"
                            class="input-presupuesto_definitivo border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0"><input type="number" class="border-0 text-center" name="" id="" value="0" style="font-size:1.5rem;height: 50px;"></td>
                    <td style="vertical-align:middle" class="p-0">
                        <select class=" form-control text-center border-0" style="font-size:1.5rem;height: 50px;" name="" id="">
                            <option value="3">Médico 1</option>
                            <option value="2">Médico 2</option>
                            <option value="1">Médico 3</option>
                        </select>
                    </td>
                `
        }
        let infoMedico = (element,key)=>{
            return `
                    <td>${!is_null(element['tipo_procedimiento']) ? element['tipo_procedimiento'] : ''}</td>
                    <td style="vertical-align:middle" class="p-0">
                        <select
                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="prioridad"
                            class="input-prioridad form-control text-center border-0" style="font-size:1.5rem;height: 50px;">
                            <option ${element['prioridad'] === 3 && 'selected'} value="3">3</option>
                            <option ${element['prioridad'] === 2 && 'selected'} value="2">2</option>
                            <option ${element['prioridad'] === 1 && 'selected'} value="1">1</option>
                        </select>
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input

                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="presupuesto_definitivo"
                            type="number"
                            placeholder="0"
                            value="${ Number(element['presupuesto_definitivo'])===0 ? '': Number(element['presupuesto_definitivo'])  }"
                            class="input-presupuesto_definitivo border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input

                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="porcentaje_descuento"
                            type="number"
                            placeholder="0"
                            value="${ Number(element['porcentaje_descuento'])===0 ? '': Number(element['porcentaje_descuento'])  }"
                            class="input-porcentaje_descuento border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input

                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="monto_adicionales"
                            type="number"
                            placeholder="0"
                            value="${ Number(element['monto_adicionales'])===0 ? '': Number(element['monto_adicionales'])  }"
                            class="input-monto_adicionales border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input

                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="monto_cmdlt"
                            type="number"
                            placeholder="0"
                            value="${ Number(element['monto_cmdlt'])===0 ? '': Number(element['monto_cmdlt'])  }"
                            class="input-monto_cmdlt border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input
                            id="honorario_medicos_totales_${element['id']}"
                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="honorario_medicos_totales"
                            type="number"
                            placeholder="0"
                            value="${ Number(element['honorario_medicos_totales'])===0 ? '': Number(element['honorario_medicos_totales']) }"
                            class="input-honorario_medicos_totales border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>
                    <td style="vertical-align:middle" class="p-0">
                        <input
                            data-plan_id="${element['id']}"
                            data-paciente_key="${key}"
                            name="honorario_cirujano_principal"
                            type="number"
                            placeholder="0"
                            value="${Number(element['honorario_cirujano_principal']) ===0 ? '':Number(element['honorario_cirujano_principal']) }"
                            class="input-honorario_cirujano_principal border-0 text-center"
                            style="font-size:1.5rem;height: 50px;">
                    </td>

                    <!--<td style="vertical-align:middle" class="p-0">

                    </td>
                    <td style="vertical-align:middle" class="p-0">

                    </td>
                    <td style="vertical-align:middle" class="p-0">

                    </td>
                    <td style="vertical-align:middle" class="p-0">

                    </td>
                    <td style="vertical-align:middle" class="p-0">

                    </td>
                    <td style="vertical-align:middle" class="p-0">

                    </td>-->
                `
        }
        /* let myTableList = ()=>{
            let model = useState['pacientes']
                myTable.innerHTML = null
                myTable2.innerHTML = null
                myTable3.innerHTML = null
            let totalFilas = model.lenght
                model.forEach((element,key) => {
                    let inicioFila = "<tr>";
                    let finFila = "</tr>";
                    let info_paciente = `
                            <th scope="row">${element['id']}</th>
                            <td class="text-nowrap">
                                ${element['fecha_creacion']}
                            </td>
                            <td>
                                ${!is_null(element['nombres']) ? element['nombres'] : ''} ${!is_null(element['apellidos']) ? element['apellidos'] : ''}
                            </td>
                            <td>${!is_null(element['cedula']) ? element['cedula'] : ''}</td>
                            <td>${!is_null(element['fecha_nacimiento']) ? element['edad'] : ''}</td>
                            <td>
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=${!is_null(element['telefono_contacto']) ? element['telefono_contacto'].replace("+", "") : ''}" style="padding: 0% 3% 3% 3%;border: 0;line-height: 1.4;" class="btn btn-default btn-block">

                                    <div class="text-gray text-nowrap overflow-hidden">
                                        <i class="fab fa-whatsapp text-success"></i> ${!is_null(element['telefono_contacto']) ? element['telefono_contacto'].replace("+", "") : ''}
                                    </div>
                                </a>
                            </td>
                            <td>
                                ${!is_null(element['telefono_contacto_alternativo']) ? element['telefono_contacto_alternativo'] : ''}
                            </td>
                        `


                    let info_presupuesto =
                        myTable.insertAdjacentHTML("beforeend",
                            inicioFila+
                            info_paciente+
                            info_atencion_paciente+
                            finFila
                        )
                        myTable2.insertAdjacentHTML("beforeend",
                            inicioFila+
                            info_paciente+
                            info_presupuesto+
                            finFila
                        )
                        myTable3.insertAdjacentHTML("beforeend",
                            inicioFila+
                            info_paciente+
                            finFila
                        )
                });
        } */
        let myTableList1 = ()=>{
            let model = useState['pacientes']
                myTable1.innerHTML = null
                console.log(model)
            //let totalFilas = model.lenght
                model.forEach((element,key) => {
                    let inicioFila = "<tr>";
                    let finFila = "</tr>";
                    let info_paciente = infoPaciente(element)
                    let info_atencion_paciente = infoAtencionPaciente(element,key)
                        myTable1.insertAdjacentHTML("beforeend",
                            inicioFila+
                            info_paciente+
                            info_atencion_paciente+
                            finFila
                        )

                });
        }
        let myTableList2 = ()=>{
            let model = useState['pacientes']
                myTable2.innerHTML = null
                console.log(model)
            //let totalFilas = model.lenght
                model.forEach((element,key) => {
                    let inicioFila = "<tr>";
                    let finFila = "</tr>";
                    let info_paciente = infoPaciente(element)
                    let info_medico = infoMedico(element,key)
                        myTable2.insertAdjacentHTML("beforeend",
                            inicioFila+
                            info_paciente+
                            info_medico+
                            finFila
                        )

                });
        }
        let getData = async ()=>{
            return await get("/planes/cirugia/getAll")
        }
        let updateField = async (model)=>{
            let formData = new FormData();
                    formData.append("plan_id", model.plan_id)
                    formData.append("property", model.name)
                    formData.append("value", model.value)
                    formData.append("_token", $("#_token").val())

                return await post( location.origin+"/planes/cirugia/updateField", formData)

        }
        entById("nav-atencion_paciente-tab").addEventListener("click", async (e)=>{
            myTableList1()
        })
        entById("nav-medico-tab").addEventListener("click", async (e)=>{
            myTableList2()
        })
        d.addEventListener("change", async (e)=>{
            if(

                e.target.matches(".input-monto_adicionales") ||
                e.target.matches(".input-monto_cmdlt") ||
                e.target.matches(".input-prioridad") ||
                e.target.matches(".input-presupuesto_standard")
            ){
                let {plan_id, paciente_key} = e.target.dataset
                let {name,value} = e.target

                let model ={
                    plan_id,
                    paciente_key,
                    name,
                    value
                }

                let resultset =  await updateField(model)

                    console.log("result",resultset)
                    useState['pacientes'][model.paciente_key][model.name] = parseFloat(model.value)
                    console.log(useState['pacientes'][model.paciente_key][model.name])


            }
            if(e.target.matches(".input-honorario_cirujano_principal")){
                let {plan_id, paciente_key} = e.target.dataset
                let {name,value} = e.target

                let model ={
                        plan_id,
                        paciente_key,
                        name,
                        value
                    }

                    let resultset =  await updateField(model)

                        console.log("result",resultset)
                        useState['pacientes'][model.paciente_key][model.name] = parseFloat(model.value)
                        console.log(useState['pacientes'][model.paciente_key][model.name])
                    model ={
                        plan_id,
                        paciente_key,
                        name :`honorario_medicos_totales`,
                        value: value*2.1
                    }
                    entById(`honorario_medicos_totales_${plan_id}`).value= model.value.toFixed(2)
                    await updateField(model)


            }
        })
        $(document).ready( async function () {
            useState['pacientes'] = await getData()

            myTableList1()

            $('#myTable1').DataTable({
                order: [],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
            });
            $('#myTable2').DataTable({
                order: [],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
            });
            $('#myTable3').DataTable({
                order: [],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
            });
        });
    </script>

@endsection
@section('css')
<style>
    body{
      background-color:#e7e7e7 !important;
    }
    .h-100{
      height:100vh !important;
    }
    table thead tr th{
      position:sticky !important;
      top:-1px !important;
      background-color:gray !important;
      color:white !important;
      text-align:center !important;
    }
    .dataTables_length{
      margin-left:20px;
      margin-top:10px
    }
    #myTable_filter{
      margin-right:20px;
      margin-top:10px
    }
  </style>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
