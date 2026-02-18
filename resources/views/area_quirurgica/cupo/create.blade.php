<!DOCTYPE html>
<html>

<head>
    <title>Solicitud de quirófano y/o equipos médicos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/dist/css/adminlte.css')}}">
     <link href="/css/scale.css" rel="stylesheet"/>
     <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
     <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
     <link rel="stylesheet" href="{{asset('image/system/icomoon/style.css')}}">
     <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        .bg-gray-footer-parodi {
            background-color: #E0E0E0;
        }

        .vh-100 {
            height: 100vh;
        }
        .vh-93 {
            height: 93vh;
        }
        .max-width{
            max-width: 1140px;
        }
        // Extra small devices (portrait phones, less than 576px)
        // No media query for `xs` since this is the default in Bootstrap

        // Small devices (landscape phones, 576px and up)
        @media (min-width: 576px) {}

        // Medium devices (tablets, 768px and up)
        @media (min-width: 768px) {}

        // Large devices (desktops, 992px and up)
        @media (min-width: 992px) {}

        // Extra large devices (large desktops, 1200px and up)
        @media (min-width: 1200px) {}
    </style>
</head>

<body>
    <nav class="navbar px-3 py-1 m-1 rounded-pill justify-content-between navbar-expand-lg bg-primary">
        <i class="pc-fa-patientcare-logo text-shadow h4 mb-0"></i>
        <img src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Bootstrap" style="width: 100px; height: 40px" />
    </nav>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="d-flex flex-column vh-93" >
            <div class="container my-3 p-0 h3 text-primary max-width">
                Solicitud de quirófano y/o equipos médicos
            </div>
            <div class="form flex-fill d-flex justify-content-center container-fluid overflow-auto" >
                <div class="row max-width">

                    <div class="col-12 h5 text-secondary font-weight-bold">
                        Datos del paciente
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="cedula">Documento de identidad</label>
                            <div class="d-flex">
                                <select id="nacionalidad" class="flex-shrink-1 form-control bg-gray-footer-parodi" name="nacionalidad"  style="width: fit-content;">
                                    <option title="V" value="V">V</option>
                                    <option title="E" value="E">E</option>
                                    <option title="P" value="P">P</option>
                                </select>
                                <input id="cedula" type="number" class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi" name="cedula" aria-describedby="helpcedula">
                            </div>
                            <small id="sms_cedula" class="form-text text-danger notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="email">Correo electrónico</label>
                            <input id="email" type="email" class="form-control bg-gray-footer-parodi" name="email"  aria-describedby="helpId" placeholder="">
                            <small id="sms_email" class="form-text text-danger notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="nombre">Nombres</label>
                            <input id="nombres" type="text" class="form-control bg-gray-footer-parodi" name="nombres"  aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="apellido">Apellidos</label>
                            <input id="apellidos" type="text" class="form-control bg-gray-footer-parodi" name="apellidos"  aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="genero">Género</label>
                            <select id="genero" class="form-control bg-gray-footer-parodi" name="genero"  aria-describedby="helpId" placeholder="">
                                <option value="m">Masculino</option>
                                <option value="f">Femenino</option>
                            </select>
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="fnacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control bg-gray-footer-parodi" name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="telefono_movil">Teléfono contacto</label>
                            <input type="number" class="form-control bg-gray-footer-parodi" name="telefono_movil" id="telefono_movil" aria-describedby="helpId" placeholder="">
                            <small id="help_telefono_movil" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text" for="telefono_hogar">Teléfono secundario</label>
                            <input type="number" class="form-control bg-gray-footer-parodi" name="telefono_hogar" id="telefono_hogar" aria-describedby="helpId" placeholder="">
                            <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 my-3 h5 text-secondary font-weight-bold">
                        Datos de la intervención, procedimiento o estudio
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="tipo_cupo">Tipo de cupo:</label>
                            <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="tipo_cupo">
                                <option value="Quirúrgico">Quirúrgico</option>
                                <option value="Procedimiento">Procedimiento</option>
                                <option value="Estudio">Estudio</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="n_quirofano">Quirófano:</label>
                            <div class="d-flex">
                                <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="n_quirofano">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>

                                </select>
                                <button type="button" class="btn btn-primary font-weight-bold"
                                    id="n_quirofanobtn">-</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="h_inicio">Hora de inicio:</label>
                            <input type="time" class="form-control bg-gray-footer-parodi" id="h_inicio">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="h_fin">Hora (estimada) de fin:</label>
                            <input type="time" class="form-control bg-gray-footer-parodi" id="h_fin">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="intervencion">Intervención:</label>
                            <div class="d-flex">
                                <input type="text" class="form-control bg-gray-footer-parodi mr-1" id="intervencion">
                                <button type="button" class="btn btn-primary font-weight-bold"
                                    id="intervencionBtn">+</button>
                            </div>
                            <ul class="list-group mt-1" id="intervencionList">
                                <!-- Aquí se agregarán los elementos de la lista -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="equipos_especiales">Equipos especiales:</label>
                            <div class="d-flex">

                                <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="equipos_especiales">
                                    <option value="">Seleccione</option>
                                    <option value="Arco de Ste">Arco de Ste</option>
                                    <option value="Cusa">Cusa</option>
                                    <option value="Craneostomo">Craneostomo</option>
                                    <option value="Equipo criostático">Equipo criostático</option>
                                    <option value="Fuente de poder">Fuente de poder</option>
                                    <option value="Frontoluz">Frontoluz</option>
                                    <option value="Flowtron">Flowtron</option>
                                    <option value="Kit de Laparoscopia">Kit de Laparoscopia</option>
                                    <option value="Maxcess">Maxcess</option>
                                    <option value="Marco estereotaxia">Marco estereotaxia</option>
                                    <option value="Microscopio">Microscopio</option>
                                    <option value="Torre Olympus">Torre Olympus</option>
                                    <option value="Torre Storz">Torre Storz</option>
                                    <option value="Robot Da Vinci">Robot Da Vinci</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                <button type="button" class="btn btn-primary font-weight-bold"
                                    id="equipos_especialesBtn">+</button>
                            </div>
                            <ul class="list-group mt-1" id="equipos_especialesList">
                                <!-- Aquí se agregarán los elementos de la lista -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="cirujanoPrincipal">Cirujano Principal:</label>
                            <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="cirujano_principal">
                                <option value="">Selecione</option>
                                <option value="1">Cirujano 1</option>
                                <option value="2">Cirujano 2</option>
                                <option value="3">Cirujano 3</option>
                                <option value="4">Cirujano 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="cirujanoPrincipal">Anestesiologo:</label>
                            <select type="text" class="form-control bg-gray-footer-parodi mr-1" id="anestesiologo">
                                <option value="">Selecione</option>
                                <option value="1">Anestesiologo 1</option>
                                <option value="2">Anestesiologo 2</option>
                                <option value="3">Anestesiologo 3</option>
                                <option value="4">Anestesiologo 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="destino">Destino:</label>
                            <select class="form-control bg-gray-footer-parodi" id="destino">
                                <option value="Hospitalización">Hospitalización</option>
                                <option value="Domicilio">Domicilio</option>
                                <option value="UTIA">UTIA</option>
                                <option value="UTIP">UTIP</option>
                                <option value="UTIN">UTIN</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
             <div class="text-center">
                <button id="submit" class="btn btn-primary mt-1">Crear solicitud</button>
            </div>
        </div>


    </div>
    <script src="{{asset('AdminLTE-3.0.5/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let d = document
        let date = new Date()
        let useState = {
            "nacionalidad":"V",
            "cedula":null,
            "email":null,
            "nombres":null,
            "apellidos":null,
            "genero":"m",
            "fnacimiento":null,
            "telefono_movil":null,
            "telefono_hogar":null,
            "estado_id":null,
            "municipio_id":null,
            "ciudad":"",
            "domicilio":"",
            "imagen_paciente":"",


            "tipo_cupo": "Quirúrgico",
            "n_quirofano": 1,
            "h_inicio": null,
            "h_fin": null,
            "cirujano_principal": "[]",
            "anestesiologo": "[]",
            "intervencion": "[]",
            "equipos_especiales": "[]",
            "destino": "Habitación",
        }
        $('#anestesiologo').on('change', function() {
                let selectedValue = $('#anestesiologo').val();
                let selectedText = $('#anestesiologo' +' option:selected').text();


                useState['anestesiologo'] = JSON.stringify([{
                    "id": selectedValue,
                    "description": selectedText
                }])


            })
        $('#cirujano_principal').on('change', function() {
                let selectedValue = $('#cirujano_principal').val();
                let selectedText = $('#cirujano_principal' +' option:selected').text();


                useState['cirujano_principal'] = JSON.stringify([{
                    "id": selectedValue,
                    "description": selectedText
                }])


            })

        d.querySelector(".form").addEventListener("change", function(e) {
            //console.log(e.target.id)
            if (e.target.matches("input")) {
                if ([
                    "cedula",
                    "email",
                    "nombres",
                    "apellidos",
                    "fnacimiento",
                    "telefono_movil",
                    "telefono_hogar"
                    ].includes(e.target.id)
                ) {
                    useState[e.target.id] = e.target.value
                }
                if (["h_inicio", "h_fin"].includes(e.target.id)) {
                    useState[e.target.id] =
                        `${ date.getFullYear() }-${ String( date.getMonth() ).padStart(2, '0') }-${String(date.getDate()).padStart(2, '0') } ${e.target.value}`
                }

            }

               /*  if (["cirujano_principal", "anestesiologo"].includes(e.target.id)) {
                    let selectedValue = $('#'+e.target.id).val();
                    let selectedText = $('#'+e.target.id +' option:selected').text();


                    useState[e.target.id] = JSON.stringify([{
                        "id": selectedValue,
                        "description": selectedText
                    }])
                } */
            if (["tipo_cupo","n_quirofano","destino","nacionalidad","genero"].includes(e.target.id)) {
                useState[e.target.id] = e.target.value
            }


            console.log(useState)
        })
        d.querySelector("#submit").addEventListener("click", async function(e) {
            e.preventDefault()
            if (validate()) {
                let formdata = new FormData()
                for (const key in useState) {
                    if (Object.hasOwnProperty.call(useState, key)) {
                        const element = useState[key];
                        formdata.append(key, element)
                    }
                }
                /* formdata.append("user_id_paciente", 22) */
                formdata.append("user_id_medico", 22)
                formdata.append("_token", entById("_token").value)
                console.log(formdata)
                let result = await post(location.origin + "/areaquirurgica/cupo/store", formdata)
                Swal.fire({
                    icon: "success",
                    title: "Solicitud creada",
                    text:"Los datos de la solicitud pueden verse en la pantalla del Plan quirúrgico.",
                    didClose: () => {
                        setTimeout(() => entById('telefono_movil').focus(), 110);
                    }
                })
                console.log(result)
            }

        })

        d.querySelector("#n_quirofanobtn").addEventListener("click", async function(e) {
            let n_quirofano = d.querySelector("#n_quirofano").value
            let result = confirm("¿Quieres limpiar el quirófano "+n_quirofano +" y dejarlo disponible?")
            if( result ){
                let resultset = await get(`/areaquirurgica/cupo/eliminarQuirofano/${n_quirofano}`)
                console.log(resultset)
                alert(`El quirófano ${n_quirofano} está nuevamente disponible`)
            }
        })
        let validate = () => {
            if (useState['cedula'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Una cédula es requerida.",
                    didClose: () => {
                        setTimeout(() => entById('cedula').focus(), 110);
                    }
                })
                return false
            }
            if (useState['nombres'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Los nombres del paciente son requeridos.",
                    didClose: () => {
                        setTimeout(() => entById('nombres').focus(), 110);
                    }
                })
                return false
            }
            if (useState['apellidos'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Los apellidos del paciente son requeridos.",
                    didClose: () => {
                        setTimeout(() => entById('apellidos').focus(), 110);
                    }
                })
                return false
            }
            if (useState['fnacimiento'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Una Fecha de Nacimiento es requerida.",
                    didClose: () => {
                        setTimeout(() => entById('fnacimiento').focus(), 110);
                    }
                })
                return false
            }
            if (useState['telefono_movil'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Un teléfono de contacto es requerido.",
                    didClose: () => {
                        setTimeout(() => entById('telefono_movil').focus(), 110);
                    }
                })
                return false
            }
            if (useState['h_inicio'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Una hora de inicio es requerida.",
                    didClose: () => {
                        setTimeout(() => entById('h_inicio').focus(), 110);
                    }
                })
                return false
            }
            if (useState['h_fin'] === null) {
                Swal.fire({
                    icon: "warning",
                    title: "Una hora de fin es requerida.",
                    didClose: () => {
                        setTimeout(() => entById('h_fin').focus(), 110);
                    }
                })
                return false
            }

            if (Object.values(JSON.parse(useState['intervencion'])).length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Escribe y confirma, al menos una intervención a realizar",
                    didClose: () => {
                        setTimeout(() => entById('intervencion').focus(), 110);
                    }
                })
                return false
            }

            if (Object.values(JSON.parse(useState['cirujano_principal'])).length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Selecciona el cirujano principal",
                    didClose: () => {
                        setTimeout(() => entById('cirujano_principal').focus(), 110);
                    }
                })
                return false
            }
            /* if (Object.values(JSON.parse(useState['anestesiologo'])).length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Selecciona el anestesiologo",
                    didClose: () => {
                        setTimeout(() => entById('anestesiologo').focus(), 110);
                    }
                })
                return false
            } */
            if (useState['email'] === null) {
                useState['email'] = `${useState['cedula']}@correotemporal.com`
            }
            return true
        }
        let post = async (url, data) => {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: data
                });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        let get = async (url, data) => {
            try {
                const response = await fetch(
                    url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        let handleList = function(objectKey) {
            //Contador de tareas
            let taskCounter1 = 1;
            //let objectKey = "intervencion"
            // Btn Agregar tarea
            let addTaskButton = entById(objectKey + 'Btn')
            addTaskButton.addEventListener('click', function(e) {

                let newTask = document.getElementById(objectKey);
                if (newTask.value !== '') {
                    let temp_object = JSON.parse(useState[objectKey])
                    temp_object.push({
                        "id": taskCounter1,
                        "description": newTask.value,
                    })
                    useState[objectKey] = JSON.stringify(temp_object)
                    newTask.value = '';

                    console.log(useState[objectKey])

                    entById(objectKey + 'List').innerHTML = null

                    temp_object.forEach((item, index) => {
                        let listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');
                        listItem.textContent = item.id + '. ' + item.description;

                        let deleteButton = document.createElement('button');
                        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'float-right',
                            'font-weight-bold');
                        deleteButton.textContent = '-';
                        deleteButton.dataset['index'] = item.id

                        deleteButton.addEventListener('click', function(e) {

                            let indiceAEliminar = e.target.dataset['index']; // Índice del objeto que deseas eliminar
                            //console.log(indiceAEliminar)

                            let temp_object = JSON.parse(useState[objectKey])
                            temp_object = temp_object.filter((item, key) => item.id !== Number(
                                indiceAEliminar))
                            useState[objectKey] = JSON.stringify(temp_object)

                            this.parentNode.remove();
                            taskCounter1--
                            console.log(useState[objectKey])

                        })

                        listItem.appendChild(deleteButton);
                        entById(objectKey + 'List').appendChild(listItem);
                    })




                    taskCounter1++;
                }
            })
        }
        let getEquipoCirugia = async()=>{
            return await get("/user/especialidad/{id}/medicos");
        }
        let getAnestesiologos = async()=>{
            return await get("/user/especialidad/{id}/anestesiologo");
        }
        let handleInterventionList = function() {
            handleList("intervencion")
        }
        let handleEquipoEspecialList = function() {
            handleList("equipos_especiales")
        }
        handleInterventionList()
        handleEquipoEspecialList()
        document.addEventListener("DOMContentLoaded",async()=>{
            let cirujanos = await getEquipoCirugia()
            let anestesiologos = await getAnestesiologos()
            const especialidadesUnicas = [...new Set(cirujanos.map(item => item.especialidad))].sort();

            document.getElementById('cirujano_principal').innerHTML=null
            document.getElementById('cirujano_principal').innerHTML= "<option value=''>Seleccione</option>"
            especialidadesUnicas.forEach(grupoNombre=>{
                let groupOptions = cirujanos.filter(x=>x.especialidad===grupoNombre)
                                    .map(x=>`<option value="${x.user_id}">${x.description}</option>`)

                document.getElementById('cirujano_principal').insertAdjacentHTML("beforeend",`
                    <optgroup label="${grupoNombre}">
                       ${groupOptions}
                    </optgroup>
                `)
            })
            document.getElementById('anestesiologo').innerHTML=null
            document.getElementById('anestesiologo').innerHTML= "<option value=''>Seleccione</option>"
            let groupOptions = anestesiologos.map(x=>`<option value="${x.user_id}">${x.description}</option>`)

                document.getElementById('anestesiologo').insertAdjacentHTML("beforeend",groupOptions)

                $('#cirujano_principal').select2();
                $('#anestesiologo').select2();
        })
    </script>
</body>

</html>
