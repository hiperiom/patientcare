let d = document
    export let loading = () => {
        return `
            <div class="scale-up-hor-left my-1 d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `
    }
    export let validarArchivoImagen = (id) =>{
        const archivoInput = document.getElementById(id);
        const archivo = archivoInput.files[0];
        if (archivo) {
            const extension = archivo.name.split('.').pop().toLowerCase();
            if (!(extension === 'jpg' || extension === 'jpeg' || extension === 'png')) {
                Swal.fire({
                    icon: "error",
                    title: "Hubo un error...",
                    text: "Solo se permiten archivos .jpg o .png."
                });
                archivoInput.value = ''; // Limpiar el campo de entrada
            }
        }
    }
    export let getFileExtension2 = (filename)=> {
        return filename.substring(filename.lastIndexOf('.')+1, filename.length) || filename;
    }
    export let reemplaza_imagen = (imagen)=> {
        imagen.onerror = "";
        imagen.src = "/image/system/medic.svg";
        return true;
    }
    export let fechaCortaCustom1 = (param)=> {
        let hoy = new Date(param);
        return hoy.getDate() + " " + ( meses( hoy.getMonth() ).slice(0,3).toUpperCase() ) + ", " + hoy.getFullYear()
    }
    export let formatAMPM = (date)=> {

        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        let ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        let strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;

        return strTime;
    }
    export async function post(url, data) {
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
    export let validarNumeroConDosDecimales=(inputValue)=> {
        const regex = /^\d+\.\d{2}$/;
        return regex.test(inputValue);
    }
    export let telefonoConfig = (selectorInput,iti,customhandleChange)=> {
        let input = document.querySelector(selectorInput);
            iti = window.intlTelInput(input, {
                autoHideDialCode:true,
                nationalMode: false,
                preferredCountries: ['ve'],
                separateDialCode: true,
                utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
            });
            /*
        let handleChange = function() {
            customhandleChange(iti.getNumber(),iti.isValidNumber())
          };
            input.addEventListener('change', handleChange);
            input.addEventListener('keyup', handleChange);*/
    }
    export let fotoTemporal = (image_id, selector)=> {
        document.getElementById(image_id).onchange = function(e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function() {
                $(selector).attr("src", reader.result)
                    /*
                    let preview = document.getElementById('preview'),
                            image = document.createElement('img');

                    image.src = reader.result;

                    preview.innerHTML = '';
                    preview.append(image);*/
            };
        }

    }

    export let horaAMPM = (param)=> {
        let m = "AM"
        let p = param.split(":")
        let hora = p[0];

            if (parseInt(p[0]) > 12) {
                m = "PM"
                switch(p[0]){
                    case "13": hora = "1"; break
                    case "14": hora = "2"; break
                    case "15": hora = "3"; break
                    case "16": hora = "4"; break
                    case "17": hora = "5"; break
                    case "18": hora = "6"; break
                    case "19": hora = "7"; break
                    case "20": hora = "8"; break
                    case "21": hora = "9"; break
                    case "22": hora = "10"; break
                    case "23": hora = "11"; break
                    case "00": hora = "12"; break
                }
            }

            return `${hora.toString().padStart(2, '0')}:${p[1].toString().padStart(2, '0')} ${m}`


    }

    export let clone = (selector)=>{
        return document.getElementById(selector).content.cloneNode(true)
    }
    export let validarPrimerDigito = (value)=> {
        //console.log($("#"+value).val().length)
        if($("#"+value).val().length==1){
            if($("#"+value).val()==0){
                $("#"+value).val('')
            }
        }
    }
    export let imagePreview =(e, selector,showImageName=false)=> {
            // We create the object of the FileReader class
        let reader = new FileReader();
            // We read the uploaded file and pass it to our fileReader.
            reader.readAsDataURL(e.target.files[0]);

        let file = e.target.files[0]
            //We look for the following element where we will show the name of the uploaded file.

        let {name, size, type} = file
            if (showImageName) {
                e.target.nextElementSibling.textContent= name
            }
            // We tell it that when it is ready, run the internal code.
            reader.onload = function(load) {
                document.getElementById(selector).setAttribute("src",reader.result)
            };
    }
    export let is_null = (params) =>{
        return (params === null || params === "null") ? true : false
    }
    export let is_empty = (params) =>{
        return (params === "") ? true : false
    }
    export let equalsInt = (param1,param2)=> {
        return parseInt(param1) === parseInt(param2) ? true : false
    }
    export let getFileExtension1 =(filename)=> {
        return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
    }
    export let getRouteParams =()=>{
        // Crear un objeto URLSearchParams a partir de la parte de consulta de la URL
        const params = new URLSearchParams(window.location.search);

        // Crear un objeto vacío para almacenar los parámetros
        const queryParams = {};

        // Iterar sobre los parámetros y agregarlos al objeto
        params.forEach((value, key) => {
            queryParams[key] = value;
        });

        // Imprimir los parámetros obtenidos
        console.log('Parámetros de consulta:', queryParams);

        // Puedes acceder a un parámetro específico usando su clave
        // Por ejemplo, si tienes un parámetro 'nombre' en la URL, puedes obtener su valor así:
        return queryParams;
    }
    export let timestamps = ()=>{
        var hoy = new Date();
        return hoy.getFullYear() + "-" + (hoy.getMonth() + 1) + "-" + hoy.getDate() + " " + hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds()
    }

    export let timestamps2 = (date) => {
        var hoy = new Date(date);
        return hoy.getFullYear() + "-" + (hoy.getMonth() + 1) + "-" + hoy.getDate() + " " + hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds()
    }
    export let activarTooltip = ()=>{
        let array = ['primary','danger','success','info','warning','secondary','cyan','gray','purple','orange','pink']
        for (let index = 0; index <= array.length; index++) {
            let element = array[index];
            tippy('.tooltip-'+element, {
                allowHTML: true,
                theme: 'tooltip-cmdlt-'+element,
                zIndex: 200000
            })
        }

    }
    export let is_undefined = (params) =>{
        return (params === undefined || params === "undefined") ? true : false
    }
    export let first = (arr) => {
        return arr.length > 0 ? arr[0] : null;
    }
    export let last = (arr) => {
        return arr.length > 0 ? arr[ arr.length -1 ] : null;
    }
    export let byId = (selector)=>{
        return document.getElementById(selector)
    }
    export let calcularEdad = (fnacimiento)=>{
        const fechaNacimiento = new Date(fnacimiento);
        const fechaActual = new Date();

        const diferencia = fechaActual - fechaNacimiento;
        const edadEnMilisegundos = new Date(diferencia);

        // Extraer el año de la fecha de nacimiento
        const edad = Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970);
        //console.log(`Edad --> ${edad} años`);
        // alert(edad)
        return String(edad) === "NaN" ? 0 : edad;
    }
    export let fechaAMD = () => {
        let hoy = new Date();
        //console.log(hoy)
        return   hoy.getFullYear() + "-" + String(hoy.getMonth()+1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0')
    }
    export let fechaAMD2 = (date) => {
        let hoy = new Date(date);
        //console.log(hoy)
        return   hoy.getFullYear() + "-" + String(hoy.getMonth()+1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0')
    }
    export let $qs = (selector)=>{
        return d.querySelector(selector)
    }
    export let $qsa = (selector)=>{
        return d.querySelectorAll(selector)
    }
    export let select = (model, param)=> {
        let id = param != undefined ? param : "";
        let selected = '';
        let data = "<option value=''>Seleccione</option>";
        $.each(model, function(indexInArray, valueOfElement) {
            if (valueOfElement.id == id) {
                //console.log(valueOfElement.id+"=="+id)
                selected = 'selected';
            } else {
                selected = '';
            }
            data += `
                <option ${selected} value="${valueOfElement.id}">
                    ${valueOfElement.description}
                </option>
            `;
        });
        return data;
    }

    export let meses = (p) =>{
        let mes = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
            "Enero"
        ]
        return mes[p];
    }
    export let fechaCortaCustom2 = (param)=> {
        var hoy = new Date(param);
        return hoy.getDate() + " " + ( meses( hoy.getMonth() ).slice(0,3).toUpperCase() ) + ", " + hoy.getFullYear() + ` <span class="text-primary">|</span> ` + formatAMPM(hoy)
    }

    export let  fechaDMA = (param,divider="/") =>{
        var hoy = new Date(param);
        //console.log(hoy)
        return   hoy.getDate() + divider + (hoy.getMonth() + 1) + divider +   hoy.getFullYear()
    }
    export async function get(url) {
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
    export function ucwords(string){
            return string.charAt(0).toUpperCase()
        }
    export function alertMessage(caso) {

            switch (caso) {
                case 'expire_sesion':
                    return { 'title': 'Atención', 'message': 'Su sesión ha finalizado por inactividad.', 'image': 'success' }
                    break;
                case 'input_text_empty':
                    return { 'title': 'Atención', 'message': 'El campo no puede estar vacio.', 'image': 'warning' }
                    break;
                case 'input_select_empty':
                    return { 'title': 'Atención', 'message': 'Debe seleccionar una opción válida.', 'image': 'warning' }
                    break;
                case 'input_datetime_empty':
                    return { 'title': 'Atención', 'message': 'Debe seleccionar una fecha y hora válida.', 'image': 'warning' }
                    break;
                case 'input_date_empty':
                    return { 'title': 'Atención', 'message': 'Debe seleccionar una fecha válida.', 'image': 'warning' }
                    break;
                case 'input_checkbox_empty':
                    return { 'title': 'Atención', 'message': 'Debe seleccionar al menos una opción.', 'image': 'warning' }
                    break;
                case 'destroy_row_cuestion':
                    return { 'title': 'Atención', 'message': '¿Seguro que desea eliminar este registro?', 'image': 'warning' }
                    break;
                case 'update_row_cuestion':
                    return { 'title': 'Atención', 'message': '¿Seguro que desea actualizar este registro?', 'image': 'warning' }
                    break;
                case 'user_no_valid':
                    return { 'title': 'Atención', 'message': 'Ingrese un Documento de identidad ó un Correo Electrónico para continuar', 'image': 'warning' }
                    break;
                case 'close_cie11':
                    return { 'title': 'Atención', 'message': '¿Desea cerrar el clasificador CIE11?', 'image': 'warning' }
                    break;
                case 'cedula_registrado':
                    return { 'title': 'Atención', 'message': 'El Documento de identidad ya se encuentra asociado a un paciente. Ingrese uno distinto.', 'image': 'warning' }
                    break;
                case 'email_registrado':
                    return { 'title': 'Atención', 'message': 'El Correo Electrónico ya se encuentra asociado a un paciente. Ingrese uno distinto.', 'image': 'warning' }
                    break;
                case 'send_success':
                    return { 'title': 'Completado', 'message': 'Registro creado exitosamente', 'image': 'success' }
                    break;
                case 'error':
                    return { 'title': 'Error', 'message': 'Ha ocurrido un error', 'image': 'error' }
                    break;
                case 'update_success':
                    return { 'title': 'Completado', 'message': 'Registro actualizado exitosamente', 'image': 'success' }
                    break;
                case 'cedula_asignada':
                    return { 'title': 'Atención', 'message': ' ya se encuentra asignado a un paciente, ¿desea reingresarlo?.', 'image': 'warning' }
                    break;
                case 'cedula_asignada2':
                    return { 'title': 'Atención', 'message': ' ya se encuentra asignada a un paciente registrado.', 'image': 'warning' }
                    break;
                default:
                    console.log("error_menssage");
                    break;
            }
        }
    export let emptyItem = (message='Sin Registros',positions=1) =>
        {
            return `
                <tr>
                    <td colspan="${positions}"class="text-center text-primary">
                        ${message}
                    </td>
                </tr>
            `
        }
    export let jsUcfirst =(string)=>
        {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    export let jsUclast =(string)=>
        {
            return string.substring(0, string.length - 1);
        }
    export let fileType = ($html,file_type)=>{
            if ( ["png", "jpg", "jpeg","bmp"].includes(file_type) ) {
                $html.classList.add("fas","fa-file-image","text-gray")
            }
            if ( ["mp3", "ogg", "wav"].includes(file_type) ) {
                $html.classList.add("fas","fa-file-audio","text-gray")
            }
            if ( ["doc", "docx","txt"].includes(file_type) ) {
                $html.classList.add("fas","fa-file-word","text-gray")
            }
            if ( ["ppt","pptx"].includes(file_type) ) {
                $html.classList.add("fas","fa-file-powerpoint","text-gray")
            }
            if ( ["xls","xlsx"].includes(file_type) ) {
                $html.classList.add("fas","fa-file-excel","text-gray")
            }
            if ( ["pdf"].includes(file_type) ) {
                $html.classList.add("fas","fa-file-pdf","text-gray")
            }
            if ( ["gif"].includes(file_type) ) {
                $html.classList.add("fas","fa-film","text-gray")
            }
            if ( !["gif","gif","pdf","xls","xlsx","ppt","pptx","doc", "docx","txt","png", "jpg", "jpeg","bmp","mp3", "ogg", "wav"].includes(file_type) ) {
                $html.classList.add("fas","fa-question-circle","text-danger")
            }
        }
    export let removeAccents = (cadena)=>{
        const acentos = {'á':'a','é':'e','í':'i','ó':'o','ú':'u','Á':'A','É':'E','Í':'I','Ó':'O','Ú':'U'};
        return cadena.split('').map( letra => acentos[letra] || letra).join('').toString();
    }
    export let $select = (data,selectoption=true) => {
        let $fragment = document.createDocumentFragment()

        let $option

            if (selectoption) {
                $option = document.createElement("option")
                $option.value = ""
                $option.textContent = "Seleccione"
                $fragment.appendChild($option)
            }
            data.forEach(x=>{
                $option = document.createElement("option")
                $option.value =x.id
                $option.textContent =x.description
                $fragment.appendChild($option)
            })
        return $fragment;
    }
    export let $selectCustom = (data,attr=[],selectoption=true) => {
        let $fragment = document.createDocumentFragment()
        let $option

            if (selectoption) {
                $option = document.createElement("option")
                $option.value = ""
                $option.textContent = "Seleccione"
                $fragment.appendChild($option)
            }
            data.forEach(x=>{
                $option = document.createElement("option")
                $option.value =x[ attr[0] ]
                $option.textContent =x[ attr[1] ]
                $fragment.appendChild($option)
            })
        return $fragment;
    }
    export let recalcularAltoPagina = () => {
        let alto_pantalla = screen.height
            Array.from([
                "#tab_preconsulta",
                "#tab_consulta",
                "#tab_citas"
            ]).forEach(tab=>{
                //d.querySelector(tab).style.border="1px solid red"
            // d.querySelector(tab).style.height=alto_pantalla - 425 + "px"
                d.querySelector(tab).style.height=alto_pantalla - 425 + "px"
            })

        }
    export let store_field = async (name,value,user_id,route)=>{
        let formdata = new FormData();
            formdata.append("field", name)
            formdata.append("value", value)
            formdata.append("user_id",user_id)
            formdata.append("_token", document.querySelector("#_token").value )
            return await post(route, formdata)
        }
    export let selectOptions = (model, param, fields=['id','description'] ) => {
            let id = param != undefined ? param : "";
            let selected = '';
            //<option value=''>Seleccione</option>
            let data = "";
            model.forEach( option => {
                if ( equalsInt( option[ fields[0] ] , id ) ) {
                    //console.log(valueOfElement.id+"=="+id)
                    selected = 'selected';
                } else {
                    selected = '';
                }
                data += `
                    <option ${selected} value="${option[ fields[0] ]}">
                        ${option[ fields[1] ]}
                    </option>
                `;
            });

            return data;
        }
    export let dia_semana = (date,abr=true,maysc=false)=>{
        let fecha = new Date(date)
        let response = ""
        //console.log(date)
        //console.log("dia_semana->",parseInt( fecha.getDay() ))
        switch( parseInt( fecha.getDay() ) ){
            case 0: response = "Domingo"; break;
            case 1: response = "Lunes"; break;
            case 2: response = "Martes"; break;
            case 3: response = "Miércoles"; break;
            case 4: response = "Jueves"; break;
            case 5: response = "Viernes"; break;
            case 6: response = "Sábado"; break;
        }
        if (abr) {
            response = response.slice(0,3)
        }
        if (maysc) {
            response = response.toUpperCase()
        }
        return response
    }
    export let  fechaUserCita = (cita) =>{
        //console.log(param)

        let fullHora = cita.hour.split(":")
        //2022-03-24 00:12:26
        let anio = cita.year
        let mes = parseInt(cita.month)
        let dia = cita.day

        let hora = fullHora[0];
        let minutos = fullHora[1];
        let segundos = fullHora[2];
        let horario = "AM"
            if (parseInt(hora) > 12 && parseInt(hora) <= 23) {
                horario = "PM"
            }
            switch(hora){
                case "13": hora = 1; break
                case "14": hora = 2; break
                case "15": hora = 3; break
                case "16": hora = 4; break
                case "17": hora = 5; break
                case "18": hora = 6; break
                case "19": hora = 7; break
                case "20": hora = 8; break
                case "21": hora = 9; break
                case "22": hora = 10; break
                case "23": hora = 11; break
                case "00": hora = 12; break
            }
        //console.log(`${anio}-${mes}-${dia} ${hora}:${minutos}:${is_undefined(segundos)?'00':segundos}`)

        return `${anio}-${mes}-${dia} ${hora}:${minutos}:${is_undefined(segundos)?'00':segundos}`
    }
    export let mes = (date,abr=true,maysc=false)=> {
        let fecha = new Date(date)
        let response = "";
        switch( parseInt( fecha.getMonth() ) ){
            case 0: response = "Enero"; break;
            case 1: response = "Febrero"; break;
            case 2: response = "Marzo"; break;
            case 3: response = "Abril"; break;
            case 4: response = "Mayo"; break;
            case 5: response = "Junio"; break;
            case 6: response = "Julio"; break;
            case 7: response = "Agosto"; break;
            case 8: response = "Septiembre"; break;
            case 9: response = "Octubre"; break;
            case 10: response = "Noviembre"; break;
            case 11: response = "Diciembre"; break;
        }
        if (abr) {
            response = response.slice(0,3)
        }
        if (maysc) {
            response = response.toUpperCase()
        }
        return response;
    }
    export let item_historial_cita = (cita, centro_salud)=>{
        //console.log(centro_salud)
        let $item = document.getElementById('artefacto_0031').content.cloneNode(true)
            $item.querySelector(".header-historia-day").textContent= dia_semana( fechaUserCita( cita ) ,true,true  )
            $item.querySelector(".header-historia-day-month").textContent= parseInt(cita.day)
            $item.querySelector(".header-historia-month").textContent= mes( fechaUserCita( cita ) ,true,true  )
            $item.querySelector(".header-historia-year").textContent= cita.year
            $item.querySelector(".header-historia-doctor").textContent= cita.medico
            $item.querySelector(".header-historia-especiality").textContent= cita.especialidad_nombre
            $item.querySelector(".header-historia-address").textContent= first( centro_salud.filter(x=> equalsInt(x.id,cita.centro_salud_id ) ) ).description
            $item.querySelector("li").dataset.cat_user_cita_status_id =6
            $item.querySelector("li").dataset.user_cita_id =cita.user_cita_id

            return $item
    }
    export let item_historial_cita2 = (cita, centro_salud) => {
        //console.log("🚀 ~ file: helpers.js ~ line 396 ~ cita", cita)

        //console.log(centro_salud)
        let $item = document.getElementById('artefacto_0034').content.cloneNode(true)
            $item.querySelector(".header-historia-day").textContent= dia_semana( fechaUserCita( cita ) ,false,true  )
            $item.querySelector(".header-historia-day-month").textContent= parseInt(cita.day)
            $item.querySelector(".header-historia-month").textContent= mes( fechaUserCita( cita ) ,false,true  )
            $item.querySelector(".header-historia-year").textContent= cita.year
            $item.querySelector(".header-historia-doctor").textContent= cita.medico
            $item.querySelector(".header-historia-especiality").textContent= cita.especialidad_nombre
            $item.querySelector(".header-historia-address").textContent= first( centro_salud.filter(x=> equalsInt(x.id,cita.centro_salud_id ) ) ).description
            $item.querySelector("tr").dataset.cat_user_cita_status_id =7
            $item.querySelector("tr").dataset.user_cita_id =cita.user_cita_id
            $item.querySelector("tr").dataset.user_id_paciente =cita.user_id_paciente
        let { reason_for_consultation,user_motivo_consulta} = cita
            let motivo = ""
            if (!is_null(reason_for_consultation)) {
                motivo = reason_for_consultation
            }
            if (!is_null(user_motivo_consulta)) {
                motivo = user_motivo_consulta.value
            }
            console.log(motivo)
            if (!is_null(motivo) && !is_empty(motivo) && !is_undefined(motivo) ) {
                $item.querySelector(".header-historia-motivo_consulta").textContent= motivo
            } else {
                $item.querySelector(".header-historia-motivo_consulta").textContent= "No indicado"
            }
            return $item
    }
    export let active_form = (tab,readonly=true) => {
        if (readonly) {
            d.querySelectorAll(`${tab} textarea`).forEach(x=>x.readOnly =true)
            d.querySelectorAll(`${tab} textarea`).forEach(x=>x.classList.add(`bg-gray`))
            d.querySelectorAll(`${tab} input`).forEach(x=>x.readOnly =true)
            d.querySelectorAll(`${tab} input`).forEach(x=>x.classList.add(`bg-gray`))
            d.querySelectorAll(`${tab} select`).forEach(x=>x.disabled =true)
            d.querySelectorAll(`${tab} select`).forEach(x=>x.classList.add(`bg-gray`))
        }else{
            d.querySelectorAll(`${tab} textarea`).forEach(x=>x.readOnly =false)
            d.querySelectorAll(`${tab} textarea`).forEach(x=>x.classList.remove(`bg-gray`))
            d.querySelectorAll(`${tab} input`).forEach(x=>x.readOnly =false)
            d.querySelectorAll(`${tab} input`).forEach(x=>x.classList.remove(`bg-gray`))
            d.querySelectorAll(`${tab} select`).forEach(x=>x.disabled =false)
            d.querySelectorAll(`${tab} select`).forEach(x=>x.classList.remove(`bg-gray`))
        }

    }
    export let cargandoModal = (message="Espere un momento por favor...")=> {
        return /*html */`
            <div class="bg-primary p-3">
                <div class="d-flex justify-content-between text-white">
                    <span class="float-left font-weight-bold">
                        ${message}
                    </span>
                    <span class="spinner-border float-right" role="status">
                        <span class="sr-only"></span>
                    </span>
                </div>
            </div>
        `;
    }
    export let get_index = (attr, key, value) => {
        return useState[attr].findIndex(index => equalsInt(index[key], value))
    }
    export let get_one = (attr, key, value) => {
        return useState[attr].filter(index => equalsInt(index[key], value))
    }
    export let get_all = (attr, key, value) => {
        return useState[attr].filter(index => equalsInt(index[key], value))
    }
    export let get_one_by_index = (index, attr, key, value) => {
        return useState[index][attr].filter(index => equalsInt(index[key], value))
    }
    export let add_row = (attr, value, position = "first") => {
        if (position === "first") {
            useState[attr].unshift(value)
        }
        if (position === "last") {
            useState[attr].push(value)
        }
    }
    export let delete_row = ({attr,key, value}) => {

        let resultset = useState[attr].filter(row =>{
                if( parseInt(row[key]) !== parseInt(value) ){
                    return row
                }
            })
            useState[attr] = resultset
    }

    export let update_row = ({attr,key, value, resultset}) => {
        let index = get_index(attr,key,value)
            useState[attr][ index ] = resultset

    }
    export let add_row_by_index = (index, attr, value, position = "first") => {
        if (position === "first") {
            useState[index][attr].unshift(value)
        }
        if (position === "last") {
            useState[index][attr].push(value)
        }
    }


