@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')

@endsection

@section('content')
<div class="container">
    <header>
      <nav class="navbar navbar-expand my-3 justify-content-between navbar-primary bg-primary rounded-pill ">
        <div>
          <a id="logoSystem"
            href="#"><img loading="lazy" style="margin-left: 0.5rem;height: 3em;width: 10em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/patientcare_bw.svg"></a>
        </div>
        <div>
          <a id="logoSystem"
            href="#"><img loading="lazy" style="height: 3em;width: 8em;" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"></a>
        </div>
      </nav>

    </header>
    <div class="row">
      <div class="col-12">
        <div class="h3 p-1 text-white text-center py-3 rounded bg-primary">
          CMDLT: Planes Quirúrgicos Especiales para Pacientes Particulares
        </div>
      </div>
    </div>
    <form class="mt-3">
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="nombres"
        >
          Nombres
        </label>
            <input
          type="text"
          class="form-control"
          id="nombres"
          data-label="Nombres"
        >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="apellidos"
        >
          Apellidos
        </label>
            <input
          type="text"
          class="form-control"
          id="apellidos"
          data-label="Apellidos"
        >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="cedula"
        >
          Cédula de identidad
        </label>
            <input
          type="number"
          class="form-control"
          id="cedula"
          data-label="Cédula de identidad"
        >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="cedula"
        >
          Género
        </label>
            <select
                type="number"
                class="form-control"
                id="genero"
                data-label="Género"
            >
                <option value="m">Masculino</option>
                <option value="f">Femenino</option>
            </select>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="fecha_nacimiento"
        >
          Fecha de nacimiento
        </label>
            <input
          type="date"
          class="form-control"
          id="fecha_nacimiento"
          data-label="Fecha de Nacimiento"
        >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="telefono_contacto"
        >
          Número telefónico (Whatsapp)
        </label>
            <input
          type="tel"
          class="form-control"
          id="telefono_contacto"
          data-label="Número telefónico (Whatsapp)"
        >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
          for="email"
        >
          Correo electrónico
        </label>
            <input
          type="email"
          class="form-control"
          id="email"
          data-label="Correo electrónico"
        >
          </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
              <label
            for="telefono_contacto_alternativo"
          >
            Número telefónico (Alternativo)
          </label>
              <input
            type="tel"
            class="form-control"
            id="telefono_contacto_alternativo"
            data-label="Número telefónico (Alternativo)"
          >
            </div>
          </div>
      </div>

      <div class="row mb-3">
        <div class="col-12">
          <div class="h5">
            Solicitud
          </div>
          <div>
            Para poderle apoyar con su solicitud y ofrecerle un mejor servicio, por favor responda las siguientes
            preguntas:
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="tipo_procedimiento">¿Qué tipo de procedimiento o cirugía requiere?</label>
            <textarea data-label="¿Qué tipo de procedimiento o cirugía requiere?" class="form-control" id="tipo_procedimiento" rows="3"></textarea>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
                for="edad"
              >
                ¿Su médico tratante pertenece al Centro Médico Docente La Trinidad?
              </label>
            <div class="d-flex align-items-center">
              <input
                  type="radio"
                  class="form-control form-control-sm"
                  style="width:20px"
                  name="medico_paciente_cmdlt"
                  value="Sí"
                  id="medico_paciente_cmdlt_si"
                >
              <label for="medico_paciente_cmdlt_si" class="mb-0 mx-2">Sí</label>
              <input
                  type="radio"
                  name="medico_paciente_cmdlt"
                  class="form-control form-control-sm"
                  style="width:20px"
                  value="No"
                  id="medico_paciente_cmdlt_no"
                >
              <label for="medico_paciente_cmdlt_no" class="mb-0 mx-2">No</label>
            </div>
          </div>
          <div id="detal_medico_paciente_cmdlt_si" class="form-group d-none">
            <label
                for="nombre_especialista"
              >
              Indíquenos por favor, el nombre de su médico especialista:
              </label>
            <input
                type="text"
                name="nombre_especialista"
                class="form-control"
                id="nombre_especialista"
                data-label="Indíquenos por favor, el nombre de su médico especialista"
              >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
                for="edad"
              >
                ¿Posee algún presupuesto de otra institución para su cirugía?
              </label>
            <div class="d-flex align-items-center">
              <input
                  type="radio"
                  class="form-control form-control-sm"
                  style="width:20px"
                  name="pre_otra_inst"
                  value="Sí"
                  id="pre_otra_inst_si"
                >
              <label for="pre_otra_inst_si" class="mb-0 mx-2">Sí</label>
              <input
                  type="radio"
                  name="pre_otra_inst"
                  class="form-control form-control-sm"
                  style="width:20px"
                  value="No"
                  id="pre_otra_inst_no"
                >
              <label for="pre_otra_inst_no" class="mb-0 mx-2">No</label>
            </div>
          </div>
          <div id="detal_pre_otra_inst_si" class="form-group d-none">
            <label
                for="edad"
              >
                Indíquenos por favor, el monto total del presupuesto (USD):
              </label>
            <input
                type="number"
                class="form-control"
                id="presupuesto_total"
                data-label="Indíquenos por favor, el monto total del presupuesto (USD)"
              >
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label
                  for="edad"
                >
                  ¿Cómo se enteró de nuestros planes quirúrgicos especiales?
                </label>
            <div class="d-flex flex-column">
              <div class="d-flex">
                <input
                      type="checkbox"
                      class="form-control form-control-sm"
                      style="width:20px"
                      name="via_comunicacion"
                      value="Instagram"
                      id="via_comunicacion_instagram"
                    >
                <label for="via_comunicacion_instagram" class="mb-0 mx-2">Instagram</label>
              </div>
              <div class="d-flex">
                <input
                      type="checkbox"
                      class="form-control form-control-sm"
                      style="width:20px"
                      name="via_comunicacion"
                      value="Twitter"
                      id="via_comunicacion_twitter"
                    >
                <label for="via_comunicacion_twitter" class="mb-0 mx-2">Twitter</label>
              </div>
              <div class="d-flex">
                <input
                      type="checkbox"
                      class="form-control form-control-sm"
                      style="width:20px"
                      name="via_comunicacion"
                      value="Vallas publicitarias"
                      id="via_comunicacion_v_publicitaria"
                    >
                <label for="via_comunicacion_v_publicitaria" class="mb-0 mx-2">Vallas publicitarias</label>
              </div>
              <div class="d-flex">
                <input
                      type="checkbox"
                      class="form-control form-control-sm"
                      style="width:20px"
                      name="via_comunicacion"
                      value="Radio"
                      id="via_comunicacion_radio"
                    >
                <label for="via_comunicacion_radio" class="mb-0 mx-2">Radio</label>
              </div>
              <div class="d-flex">
                <input
                      type="checkbox"
                      class="form-control form-control-sm"
                      style="width:20px"
                      name="via_comunicacion"
                      value="A través de un amigo"
                      id="via_comunicacion_amigo"
                    >
                <label for="via_comunicacion_amigo" class="mb-0 mx-2">A través de un amigo</label>
              </div>
              <div class="d-flex">
                <input
                      type="checkbox"
                      class="form-control form-control-sm"
                      style="width:20px"
                      name="via_comunicacion"
                      value="Página web del Centro Médico Docente La trinidad"
                      id="via_comunicacion_cmdlt"
                    >
                <label for="via_comunicacion_cmdlt" class="mb-0 mx-2">Página web del Centro Médico Docente La trinidad</label>
              </div>
              <div class="d-flex align-items-center">

                <input
                  type="checkbox"
                  class="form-control form-control-sm"
                  style="width:20px"
                  name="via_comunicacion"
                  value="Página web del Centro Médico Docente la trinidad"
                  id="via_comunicacion_otra"
                >
                <label for="via_comunicacion_otra" class="mb-0 mx-2">Otro</label>
                <input
                  type="text"
                  class="d-none form-control form-control-sm"
                  name="via_comunicacion"
                  id="detail_via_comunicacion_otra"
                  data-label="Otro"
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-sm-4 offset-sm-4 mb-3">
          <buttom id="submit" type="button" class="btn btn-primary btn-block">Enviar</buttom>
        </div>
      </div>
    </form>
  </div>
  <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="messageModalLabel" data-backdrop="static"
    aria-modal="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <img src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg" style="height: 3em;" class="img-fluid float-right" alt="Imagen CMDLT">
          <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
        </div>
        <div class="modal-body text-white p-0">

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
    let modal = d.querySelector("#registroModal .modal-body")
    let goodByMessage = ()=>{
        message = /*html*/  `
        <div class="container-fluid bg-primary p-3">
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="display-4" style="font-size: 2.5em;">
                <div class="text-center">
                    Registro completado<br>
                    con éxito.
                </div>
                </h3>

                <div class="h5 text-center">
                <p class="pb-2 text-center">
                    Gracias por enviarnos su información,<br>
                    esto nos permitirá brindarle el mejor servicio.
                </p>
                <p class="pb-2 text-center">
                    El equipo de salud del<br>
                    Centro Médico Docente La Trinidad<br>
                    le agradece que nos hayas escogido<br>
                    como el aliado de su Salud!
                </p>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                <button id="salir" onclick="window.location = 'https://www.cmdlt.edu.ve/';" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Finalizar</button>
                </div>
            </div>
        </div>

        `
        modal.innerHTML = message
        $("#registroModal").modal("show")
    }
    let wellcomeMessage = ()=>{
        message = /*html*/  `
        <div class="container-fluid bg-primary p-3">
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="display-4" style="font-size: 2.5em;">
                <div class="text-center">
                    <i style="font-size: 0.8em;">Bienvenido al registro:</i><br>
                    Planes Quirúrgicos Especiales para Pacientes Particulares
                </div>
                </h3>

                <div class="h5 text-center">
                Gracias por preferirnos y considerarnos<br>
                <i><b>el aliado de su salud</b>.<br>
                    Nuestro propósito<br>
                    es ofrecerle un excelente servicio,<br>
                    por lo que requerimos algunos datos<br>
                    que nos permitan brindarle la solución<br>
                    más adecuada a sus necesidades.<br><br>

                    Muchas gracias por su tiempo y colaboración.
                </i>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, continuar</button>
                </div>
            </div>
        </div>

        `
        modal.innerHTML = message
        $("#registroModal").modal("show")
    }
    let storeForm =  async (data)=>{
        let formData = new FormData();

            for (let key in data) {
                formData.append(key, data[key]);
            }
            formData.append("_token", $("#_token").val())
        let result = await post("/planes/cirugia/store",formData)
    }
    let input = document.querySelector("#telefono_contacto");
        iti = window.intlTelInput(input, {
            autoHideDialCode:true,
            nationalMode: false,
            preferredCountries: ['ve'],
            separateDialCode: true,
            utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
        });
    let input2 = document.querySelector("#telefono_contacto_alternativo");
        iti2 = window.intlTelInput(input2, {
            autoHideDialCode:true,
            nationalMode: false,
            preferredCountries: ['ve'],
            separateDialCode: true,
            utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
        });
       /*  input.addEventListener('change', handleChange);
        input.addEventListener('keyup', handleChange);
        let configTelefono = (param)=> {
            let input = document.querySelector(param);
                iti = window.intlTelInput(input, {
                    autoHideDialCode:true,
                    nationalMode: false,
                    preferredCountries: ['ve'],
                    separateDialCode: true,
                    utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
                });
            let handleChange = function() {
                    //console.log(iti.getSelectedCountryData())
                    let text = (iti.isValidNumber()) ? "<span class='text-success'><i class='far fa-check-circle'></i> Formato correcto</span>" : "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Formato incorrecto</span>";
                    console.log("International: " + iti.getNumber())
                    return  iti.getNumber()
                    //$("#help_telefonomovil").html(text)
                };

            input.addEventListener('change', handleChange);
            input.addEventListener('keyup', handleChange);
        } */








        let dne = entById('detal_medico_paciente_cmdlt_si')
        let dpoi = entById('detal_pre_otra_inst_si')
        let vco = entById('detail_via_comunicacion_otra')
            d.addEventListener("click", async function(e){
              if(e.target.matches("#medico_paciente_cmdlt_si")){
                dne.classList.remove("d-none")
              }
              if(e.target.matches("#medico_paciente_cmdlt_no")){
                dne.classList.add("d-none")
              }
              if(e.target.matches("#pre_otra_inst_si")){
                dpoi.classList.remove("d-none")
              }
              if(e.target.matches("#pre_otra_inst_no")){
                dpoi.classList.add("d-none")
              }
              if(e.target.matches("#via_comunicacion_otra")){
                if(e.target.checked){
                  vco.classList.remove("d-none")
                }else{
                  vco.classList.add("d-none")
                  vco.value=""
                }
              }
              if(e.target.matches("#submit")){
                // obtener todos los campos de formulario
                let form = document.querySelector('form').elements;
                    //console.log(form)
                // obtener los valores de todos los campos
                let values = {
                  via_comunicacion:[]
                };
                let field
                let type
                let label
                let value


                let input = entById('nombres')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = entById('apellidos')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = entById('cedula')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = entById('fecha_nacimiento')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = entById('telefono_contacto')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = entById('email')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = entById('tipo_procedimiento')
                    if(is_empty(input.value)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `El campo ${input.dataset.label} no puede estar vacio`,
                            didClose: () => {
                                setTimeout(() => input.focus(), 110);
                            }
                        })
                        return false;
                    }
                    input = d.querySelector(`input[name='medico_paciente_cmdlt']:checked`)
                    if(is_null(input)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `Seleccione una opción en la pregunta: ¿Tu médico tratante pertenece al Centro Médico Docente la Trinidad?`,
                            didClose: () => {
                                setTimeout(() => d.querySelector("#medico_paciente_cmdlt_no").checked=true, 110);
                            }
                        })
                        d.querySelector("#medico_paciente_cmdlt_no").checked=true
                        return false;
                    }else if(input.value ==="Sí"){
                        input = d.querySelector(`#nombre_especialista`)
                        if(is_empty(input.value)){
                            Toast.fire({
                                icon: "error",
                                title: "Información requerida",
                                text: `El campo ${input.dataset.label} no puede estar vacio`,
                                didClose: () => {
                                    setTimeout(() => input.focus(), 110);
                                }
                            })
                            return false;
                        }
                    }
                    input = d.querySelector(`input[name='pre_otra_inst']:checked`)
                    if(is_null(input)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `Seleccione una opción en la pregunta: ¿Tienes algún presupuesto de otra institución para tu cirugía?`,
                            didClose: () => {
                                setTimeout(() => d.querySelector("#pre_otra_inst_no").checked=true, 110);
                            }
                        })
                        d.querySelector("#pre_otra_inst_no").checked=true
                        return false;
                    }else if(input.value ==="Sí"){
                        input = d.querySelector(`#presupuesto_total`)
                        if(is_empty(input.value)){
                            Toast.fire({
                                icon: "error",
                                title: "Información requerida",
                                text: `El campo ${input.dataset.label} no puede estar vacio`,
                                didClose: () => {
                                    setTimeout(() => input.focus(), 110);
                                }
                            })
                            return false;
                        }
                    }
                    input = d.querySelector(`input[name='via_comunicacion']:checked`)
                    if(is_null(input)){
                        Toast.fire({
                            icon: "error",
                            title: "Información requerida",
                            text: `Seleccione al menos una opción en la pregunta: ¿Cómo te enteraste de nuestros planes quirúrgicos especiales?`,
                            didClose: () => {
                                setTimeout(() => d.querySelector("#pre_otra_inst_no").checked=true, 110);
                            }
                        })
                        d.querySelector("#pre_otra_inst_no").checked=true
                        return false;
                    }
                    input = d.querySelector(`#via_comunicacion_otra`)
                    if(input.checked){
                        input = d.querySelector(`#detail_via_comunicacion_otra`)
                        if(is_empty(input.value)){
                            Toast.fire({
                                icon: "error",
                                title: "Información requerida",
                                text: `El campo ${input.dataset.label} no puede estar vacio`,
                                didClose: () => {
                                    setTimeout(() => input.focus(), 110);
                                }
                            })
                            return false;
                        }
                    }

                for (let i = 0; i < form.length; i++) {
                    field = form[i];
                    type = field.type;
                    label = field.getAttribute('id');
                    value;
                    console.log(type)
                    if (
                        [
                            'email',
                            'text',
                            'number',
                            'date',
                            'tel',
                            'select-one',
                            'textarea'
                        ].includes(type)
                    ) {
                        value = field.value;
                        values[label] = value;
                        if (label === "telefono_contacto") {
                            value = iti.getNumber();
                            values[label] = value;
                        }
                        if (label === "telefono_contacto_alternativo") {
                            value = iti2.getNumber();
                            values[label] = value;
                        }
                    } else if (
                        [
                        'radio',
                        'checkbox'
                        ].includes(type)
                    ) {
                        if (field.checked) {
                            if(
                                [
                                    "medico_paciente_cmdlt_no",
                                    "medico_paciente_cmdlt_si"
                                ].includes(label)
                            ){

                                label = "medico_paciente_cmdlt"
                                value = field.value;
                                values[label] = value;
                            }
                            if(
                                [
                                "via_comunicacion_instagram",
                                "via_comunicacion_twitter",
                                "via_comunicacion_v_publicitaria",
                                "via_comunicacion_radio",
                                "via_comunicacion_amigo",
                                "via_comunicacion_cmdlt",
                                ].includes(label)
                            ){

                                label = "via_comunicacion"
                                values[label].push(field.value)
                            }
                            if(
                                [
                                    "pre_otra_inst_si",
                                    "pre_otra_inst_no"
                                ].includes(label)
                            ){
                                label = "pre_otra_inst"
                                value = field.value;
                                values[label] = value;
                            }
                        } else {
                            continue;
                        }
                    }
                }

                //console.log(values);

                Toast.fire({
                    icon: "warning",
                    title: "¿Desea enviar los datos?",
                    text: "",
                    timer: 15000,
                    showDenyButton: true,
                    confirmButtonText: 'Sí, enviar',
                    denyButtonText: `No, aún no`,
                    /* didOpen: () => {
                        setInterval(() => {
                            location.href = '/finalizarSesion'
                        }, 14000)
                    }, */
                }).then( async (result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        await storeForm(values)
                        document.querySelector('form').reset()
                        goodByMessage()
                    }
                })


              }
            })
            d.addEventListener("keyup",(e)=>{
                if(e.target.id=="telefono_contacto"){
                    validarPrimerDigito("telefono_contacto")
                }
            })
            d.addEventListener("change",(e)=>{
                if(e.target.id=="telefono_contacto"){
                    validarPrimerDigito("telefono_contacto")
                }
            })
            d.addEventListener("DOMContentLoaded",()=>{

                wellcomeMessage()
            })
  </script>
@endsection
@section('css')
<style>
    input[type="radio"]:checked~label {
        color: black;
    }
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
@endsection
