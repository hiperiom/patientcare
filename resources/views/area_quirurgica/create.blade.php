<!DOCTYPE html>
<html>

<head>
    <title>Formulario Bootstrap</title>
    <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.0.5/dist/css/adminlte.css')}}">
    <link href="/css/scale.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/plugin/intl-tel-input/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{asset('css/stylePatientcare.css')}}">
    <link rel="stylesheet" href="{{asset('image/system/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
    <link rel="stylesheet" href="/AdminLTE-3.0.5/plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">
</head>

<body>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="container">
        <h3 class="text-primary">Nueva Intervención Quirúrgica</h3>
        <form>
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="h_inicio">Hora de inicio:</label>
                        <input type="time" class="form-control" id="h_inicio">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="h_fin">Hora (estimada) de fin:</label>
                        <input type="time" class="form-control" id="h_fin">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="intervencion">Intervención:</label>
                        <div class="d-flex">
                            <input type="text" class="form-control mr-1" id="intervencion">
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
                            <input type="text" class="form-control mr-1" id="equipos_especiales">
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
                        <select type="text" class="form-control mr-1" id="cirujano_principal">
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
                        <select type="text" class="form-control mr-1" id="anestesiologo">
                            <option value="">Selecione</option>
                            <option value="1">Anestesiologo 1</option>
                            <option value="2">Anestesiologo 2</option>
                            <option value="3">Anestesiologo 3</option>
                            <option value="4">Anestesiologo 4</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <select class="form-control" id="destino">
                            <option value="Habitación">Habitación</option>
                            <option value="Domicilio">Domicilio</option>
                            <option value="UTI">UTI</option>
                        </select>
                    </div>
                </div>
            </div>






            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <script>
        let d = document
        let date = new Date()
        let useState = {
            "h_inicio": null,
            "h_fin": null,
            "cirujano_principal": "[]",
            "anestesiologo": "[{'id':'Servicio de Anestesia','description':'Servicio de Anestesia'}]",
            "intervencion": "[]",
            "equipos_especiales": "[]",
            "destino": "Habitación",
        }
        d.querySelector("form").addEventListener("change", function(e) {
            console.log(e.target.id)
            if (e.target.matches("input")) {
                if (["h_inicio", "h_fin"].includes(e.target.id)) {
                    useState[e.target.id] =
                        `${ date.getFullYear() }-${ String( date.getMonth() ).padStart(2, '0') }-${String(date.getDate()).padStart(2, '0') } ${e.target.value}`
                }

            }
            if (e.target.matches("select")) {
                if (["destino", "cirujano_principal", "anestesiologo"].includes(e.target.id)) {
                    useState[e.target.id] = JSON.stringify([{
                        "id": e.target.value,
                        "description": e.target.selectedOptions[0].text
                    }])
                }
            }
            console.log(useState)
        })
        d.querySelector("form").addEventListener("submit", async function(e) {
            e.preventDefault()
            if (validate()) {
                let formdata = new FormData()
                for (const key in useState) {
                    if (Object.hasOwnProperty.call(useState, key)) {
                        const element = useState[key];
                        formdata.append(key, element)
                    }
                }
                formdata.append("user_id_paciente", 22)
                formdata.append("user_id_medico", 22)
                formdata.append("_token", entById("_token").value)
                let result = await post(location.origin + "/areaquirurgica/store", formdata)
                console.log(result)
            }

        })
        let validate = () => {
            if (useState['h_inicio'] === null) {
                alert("Una hora de inicio es requerida")
                entById('h_inicio').focus()
                return false
            }
            if (useState['h_fin'] === null) {
                alert("Una hora de fin es requerida")
                entById('h_fin').focus()
                return false
            }

            if (Object.values(JSON.parse(useState['intervencion'])).length === 0) {
                alert("Escribe una intervención a realizar")
                entById('intervencion').focus()
                return false
            }
            if (Object.values(JSON.parse(useState['equipos_especiales'])).length === 0) {
                alert("Escribe un equipos especiales a utilizar")
                entById('equipos_especiales').focus()
                return false
            }
            if (Object.values(JSON.parse(useState['cirujano_principal'])).length === 0) {
                alert("Selecciona el cirujano principal")
                entById('cirujano_principal').focus()
                return false
            }
           /*  if (Object.values(JSON.parse(useState['anestesiologo'])).length === 0) {
                alert("Selecciona el anestesiologo")
                entById('anestesiologo').focus()
                return false
            } */
            //sdasdsadsad
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

                            let indiceAEliminar = e.target.dataset[
                            'index']; // Índice del objeto que deseas eliminar
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
        let handleInterventionList = function() {
            handleList("intervencion")
        }
        let handleEquipoEspecialList = function() {
            handleList("equipos_especiales")
        }
        handleInterventionList()
        handleEquipoEspecialList()
    </script>
</body>

</html>
