@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
   {{--   @include('component.menu_principal_v2')--}}
@endsection

@section('content')
    <header>

    </header>
    <main class="d-flex flex-column overflow-auto p-1" style="height:91vh;padding-bottom: 10vh !important;">

    </main>

    <footer>

    </footer>
@endsection
@section('footer')

@endsection
@section('script')


    <script>
        headerNav({})

        const   useState = {
                    formData:{
                        nacionalidad      : "V",
                        cedula            : "",
                        email             : "",
                        nombres           : "",
                        apellidos         : "",
                        genero            : "m",
                        fnacimiento       : "",
                        telefono_movil    : "",
                        cat_estado_id     : "",
                        cat_municipio_id  : "",
                        cat_especialidad_id: "",
                        description       : "",    //ciudad
                        domicilio         : "",
                        cita_dia          : "",
                        cita_hora         : "",
                        user_id_medico    : "",
                        cita_motivo       : "",
                    },
                    cat_genero:[
                        {id:"m",description:"Masculino"},
                        {id:"f",description:"Femenino"},
                    ],
                    cat_nacionalidad:[
                        {id:"V",description:"V"},
                        {id:"E",description:"E"},
                        {id:"P",description:"P"},
                        {id:"J",description:"J"},
                    ],
                    cat_estado:[],
                    cat_municipio: [],
                    cat_especialidades : [],
                    medicos : [],
                    agendas:[],
                    get_medicos: function(especialidad_id){
                        return this.medicos.filter(medico => parseInt(medico.cat_user_especialidad_id) === parseInt(especialidad_id))
                    },
                    get_medico_agenda: function(medico_id){
                        return this.agendas.filter(agenda => parseInt(agenda.user_id_medico) === parseInt(medico_id))
                    },
                    get_medico_agenda_horas: function(agenda_id,dia_del_mes){
                        let model = first( this.agendas.filter(agenda => parseInt(agenda.agenda_id) === parseInt(agenda_id)) )['agenda']
                        let { horas_am, horas_pm } = model


                            horas_am = horas_am.filter(hora => {
                                let date = new Date(hora)
                                    if (parseInt(date.getDate()) === parseInt(dia_del_mes)) {
                                        return hora
                                    }
                            } )
                            horas_pm = horas_pm.filter(hora => {
                                let date = new Date(hora)
                                    if (parseInt(date.getDate()) === parseInt(dia_del_mes)) {
                                        return hora
                                    }
                            } )
                            return {"horas_am":horas_am,"horas_pm":horas_pm}
                    },


                };
        let final_especialidad_nombre = "No Indicado"
        let final_medico = "No Indicado"
        let final_dia = "No Indicado"
        let final_hora = "No Indicado"
        let final_lugar = "Avenida Intercomunal la Trinidad-El Hatillo. Apartado postal 80474. Caracas Venezuela."
        let d= document;
        let $form = entById(`form_paciente_cita`).content;
        let $cargando = entById(`cargando`).content,
            $main = d.querySelector(`main`);
            $main.appendChild($cargando)
            $main.appendChild($form)
            let onChange_agenda_id = 0;
        let get_medicos_Formated = (medicos)=>{
                let model = []
                    medicos.forEach( ( x , key ) => {
                        model[ key ] ={}
                        model[ key ].id = x.user_id
                        model[ key ].description = `${!is_null(x.prefijo) && !is_undefined(x.prefijo) && !is_empty(x.prefijo) ? x.prefijo+" " : ""}${x.medico}`
                    } )
                    return model
            }



        let handleItemColor = (item,e)=>{
                if(!is_empty(e.params.data.id)){
                    d.querySelector( item ).classList.remove("badge-primary")
                    d.querySelector( item ).classList.add("badge-success")
                }else{
                    d.querySelector( item ).classList.add("badge-primary")
                    d.querySelector( item ).classList.remove("badge-success")
                    entById("cita_dia").value =``
                    entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                    $('#calendar').datepicker('destroy')
                    $('#calendar').empty()

                }

            }
        let activarCalendario = (medico_id)=>
            {
                //console.log(medico_id)
                $('#calendar').datepicker('destroy')
                $('#calendar').empty()
                let medico_agenda = useState.get_medico_agenda(medico_id)
                //console.log(medico_agenda)
                let {agenda,agenda_id} = first(medico_agenda)
                    onChange_agenda_id = agenda_id
                let mesesDisponibles = agenda.mes_del_anio
                let diasDisponible = agenda.dias_del_mes
                    if( is_undefined(mesesDisponibles) ){
                        return false
                    }
                    $('#calendar').datepicker({
                        "language": "es",
                        beforeShowYear: function(date){
                            if (date.getFullYear() !== new Date().getFullYear()) {
                                return false;
                            }
                        },
                        beforeShowMonth: function(date){
                            if (
                                !mesesDisponibles.includes(date.getMonth()+1) &&
                                date.getFullYear() === new Date().getFullYear()
                                ) {
                                return false;
                            }
                        },
                        beforeShowDay: function(date){
                            let f = new Date()
                            let fActual = new Date( f.getFullYear() , (f.getMonth()+1), date.getDate() )
                            //console.log("mes",date.getMonth()+1)
                            if (
                                fActual.getTime() >=  f.getTime() &&
                                ( date.getMonth()+1 ) >= ( f.getMonth()+1 ) &&
                                diasDisponible.includes( date.getDate() ) &&
                                mesesDisponibles.includes( date.getMonth()+1 )

                                ) {

                                    return {
                                    tooltip: `Dia ${date.getDate()} de ${( meses( date.getMonth() ) )} disponible`,
                                    classes: 'today'
                                    };
                            }else{
                                return {
                                    tooltip: `No existen horas disponibles este dia`,
                                    classes: 'disabled',
                                    };
                            }
                        },
                    });

            }



        $('#cat_especialidad_id').on('select2:select', function (e) {
            handleItemColor(".item-1",e)
            saveDataForm(e)
            final_especialidad_nombre = e.params.data.text

            let medicos = useState.get_medicos( e.params.data.id )
                //console.log(medicos)
                entById("user_id_medico").innerHTML=""
                entById("user_id_medico").append( $select( get_medicos_Formated( medicos ) ) )
                entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
        })
        $('#user_id_medico').on('select2:select', function (e) {
            handleItemColor(".item-2",e)
            saveDataForm(e)
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                entById("cita_dia").value =``
                entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id )
        });
        $('#calendar').datepicker().on("changeDate", function(e) {
            let d = document;
            let f = new Date(e.date);
            let dia_del_mes = ("0" + f.getDate()).slice(-2);
            let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth()+1)).slice(-2) + "-" + dia_del_mes;
                saveDataForm({"name":"cita_dia","value":dia_del_mes})
                document.getElementById("cita_dia").value=fechaIngreso
                entById("mensaje_dia_seleccionado").innerHTML =`
                    <b>Día seleccionado:</b> <span class="badge badge-primary">${fechaCortaCustom1(e.date)}</span>
                `
                final_dia = fechaCortaCustom1(e.date)

                if(!is_empty(entById("cita_dia").value)){
                    d.querySelector( ".item-3" ).classList.remove("badge-primary")
                    d.querySelector( ".item-3" ).classList.add("badge-success")
                }else{
                    d.querySelector( ".item-3" ).classList.add("badge-primary")
                    d.querySelector( ".item-3" ).classList.remove("badge-success")
                }

            let horas = useState.get_medico_agenda_horas( onChange_agenda_id, dia_del_mes )
                //console.log(horas)
                d.querySelector('#pills-am ul.nav').innerHTML =""
                d.querySelector('#pills-pm ul.nav').innerHTML =""
                if (horas.horas_am.length > 0) {
                    horas.horas_am.forEach((hora,key)=>{

                        let h = formatAMPM( new Date(hora) ).toUpperCase()
                            d.querySelector('#pills-am ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-am-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-am-${key}" role="tab" aria-controls="pills-am-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                } else {
                    d.querySelector('#pills-am ul.nav').innerHTML ="Sin Horas Disponibles"
                }
                if (horas.horas_pm.length > 0) {
                    horas.horas_pm.forEach((hora,key)=>{
                        let h = formatAMPM( new Date(hora) ).toUpperCase()
                            d.querySelector('#pills-pm ul.nav').insertAdjacentHTML("beforeend",`
                                <li class="nav-item text-center cita-hora" data-hora="${hora}" role="presentation">
                                    <a class="nav-link cita-hora" id="hora-pm-${key}-tab" data-hora="${hora}" data-toggle="pill" href="#pills-pm-${key}" role="tab" aria-controls="pills-pm-${key}" aria-selected="true">${h}</a>
                                </li>
                            `)
                    })
                } else {
                    d.querySelector('#pills-pm ul.nav').innerHTML ="Sin Horas Disponibles"
                }
        });

        $('#calendar').datepicker('destroy')
        $('#calendar').empty()
        d.addEventListener("click",e=>{

            if (e.target.matches(".cita-hora")) {
                d.querySelector( ".item-4" ).classList.remove("badge-primary")
                d.querySelector( ".item-4" ).classList.add("badge-success")
                saveDataForm({"name":"cita_hora","value":e.target.dataset.hora})
                entById('cita_hora').value = e.target.dataset.hora
                final_hora = formatAMPM( new Date(e.target.dataset.hora) ).toUpperCase()
            }
        })
        let saveDataForm = (e)=>{
                console.clear()
                if (e.target?.matches("input") || e.target?.matches("textarea")) {
                    if (useState.formData.hasOwnProperty(e.target.name)) {
                        useState.formData[e.target.name] = e.target.value

                    }
                }
                if (e.target?.matches("select") ) {
                    if (useState.formData.hasOwnProperty(e.target.name)) {
                        useState.formData[e.target.name] = e.target.options[e.target.selectedIndex].value
                    }

                }
                if (["cita_dia","cita_hora"].includes(e.name)) {
                    useState.formData[e.name] = e.value
                }
                console.table(useState.formData)

            }
            function mensajeBienvenida() {
                    modalMensaje({
                        title:`
                        <div class="text-center">
                            <i style="font-size: 0.8em;">Bienvenido al</i><br>
                            Registro de Consulta Externa
                        </div>
                        `,
                        content:`
                        <div class="h5 text-center">
                            Gracias por preferirnos y considerarnos<br>
                            <i><b>el aliado de su salud</b></b>.<br>
                            Para ofrecerte nuestro mejor servicio, por favor,
                            registre sus datos en el siguiente formulario, y
                            seguidamente agenda tu cita médica,
                            seleccionando la especialidad, medico, día, y hora
                            de la consulta.
                            <br><br>
                            Muchas gracias por tu tiempo y colaboración.
                        </div>

                        `,
                        action:`
                            <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, continuar</button>
                        `,
                    })
                }
            function mensajeCita() {

                    modalMensaje({
                        title:`
                        <div class="text-center">
                            <i style="font-size: 0.8em;">Solicitud completada</i>
                        </div>
                        `,
                        content:`
                        <div class="h5">
                            <div class="text-center">
                                Gracias por preferirnos y considerarnos<br>
                                <i><b>el aliado de su salud</b></b>.<br>
                                Los datos agendados para su cita son los siguientes:
                            </div>
                           <br>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="p-1">
                                        Especialidad:
                                    </th>
                                    <td>
                                        ${final_especialidad_nombre}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="p-1">
                                        Médico:
                                    </th>
                                    <td>
                                        ${final_medico}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="p-1">
                                        Día:
                                    </th>
                                    <td>
                                        ${final_dia}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="p-1">
                                        Hora:
                                    </th>
                                    <td>
                                        ${final_hora}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="p-1">
                                        Lugar:
                                    </th>
                                    <td>
                                        ${final_lugar}
                                    </td>
                                </tr>

                            </table>
                            <br><br>

                        </div>

                        `,
                        action:`https://www.cmdlt.edu.ve/
                            <button id="empezarcuestionario" onclick="window.location.href ='#'" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, Finalizar</button>
                        `,
                    })
                }
        d.querySelector("form").addEventListener("change",e=>{

            saveDataForm(e)
        })
        d.addEventListener("DOMContentLoaded",async function (e) {
            mensajeBienvenida()

            useState.cat_estado       = await CatUserEstado.getAll()
            useState.cat_municipio    = await CatUserMunicipio.getAll()
            useState.cat_especialidades = await CatUserEspecialidad.getIndex2()
            useState.medicos = await UserMedico.getMedicos()
            useState.agendas = await UserMedicoAgenda.getAll()

            //console.log(useState.medicos)
            //console.log(useState.agendas)
            let medicos_con_agendas = useState.agendas.map(agenda => agenda.user_id_medico)
                useState.medicos = useState.medicos.filter(medico => medicos_con_agendas.includes(medico.user_id) )

            let especialidades_con_medicos = useState.medicos.map(medico => medico.cat_user_especialidad_id)
                useState.cat_especialidades = useState.cat_especialidades.filter(especialidad => especialidades_con_medicos.includes(especialidad.id) )



            telefonoConfig("#telefono_movil")
            entById("cat_estado_id").append($select(useState.cat_estado))
            entById("cat_municipio_id").append($select(useState.cat_municipio))
            entById("cat_especialidad_id").append($select(useState.cat_especialidades))
           // entById("user_id_medico").append($select(useState.get_medicoEspecialidadFormated()))

            entById("carga").style.display="none"
            $('.medico-select').select2();
            //console.log(useState)
        })//form
        let form = d.querySelector("form")

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()

            if (User.validate()) {
                if (UserProfile.validate()) {
                    if (UserCuestDireccion.validate()) {
                        let cat_especialidad_id = $("#cat_especialidad_id");
                            if (
                                is_empty(cat_especialidad_id.val())
                            ) {
                                $("#collapseEspecialidad").addClass("border").addClass("border-danger")
                                message = Component.alertMessage("user_no_valid");
                                Toast.fire({
                                    icon: message['image'],
                                    title: message['title'],
                                    text: "Una Especialidad Médica es requerida",
                                    didClose: () => {
                                        setTimeout(() => cat_especialidad_id.trigger("focus"), 110);
                                    }
                                })
                                return false;
                            }else{
                                $("#collapseEspecialidad").removeClass("border").removeClass("border-danger")
                            }

                            entById("carga").style.display="block"
                        let formData = new FormData();

                            for (const key in useState.formData) {
                                if (Object.hasOwnProperty.call(useState.formData, key)) {
                                    let element = useState.formData[key];
                                        formData.append(key,element)
                                }
                            }
                            formData.append("created_at",timestamps() );
                            formData.append("_token",d.querySelector("#_token").value)
                        let $response = post("/paciente/cita/store",formData)
                        $response.then(response=>{
                            entById("carga").style.display="none"
                            if($response){
                                mensajeCita()
                            }


                        })

                    }
                }
            }


            //console.log(form.querySelectorAll("input[required]"))

            //
            //alert("a")
        })
    </script>
@endsection
@section('css')
    <style>
        /*input:invalid {
        border: 2px dashed red;
        }

        input:invalid:required:after {
        content:"*";
        }

        input:valid {
        border: 2px solid black;
        }*/

        .btn-link:hover{
            background-color:var(--gray);

        }
        .nav-item > a:hover{
            color:var(--primary);
            font-weight: bold;
        }
        .btn-link {

            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .table th, .table td {
            padding: 0.1rem;
            vertical-align: top;

        }
        span.select2{
            width:100% !important;
        }
        .horas-tab > li > a.nav-link.active {
            color: #ffffff;
            background-color: var(--primary);
            border-radius: 20px;
        }
        #horarios > li > a.nav-link.active {
            color: #ffffff;
            background-color: var(--primary);
        }
        .datepicker table tr td.active.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover.active, .datepicker table tr td.active.disabled:hover.disabled, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active.disabled:hover[disabled], .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active:active, .datepicker table tr td.active:hover, .datepicker table tr td.active:hover.active, .datepicker table tr td.active:hover.disabled, .datepicker table tr td.active:hover:active, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active:hover[disabled], .datepicker table tr td.active[disabled] {
            background-color: var(--success) !important;
        }
        /*.datepicker table tr td.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active:hover {
            background-color: #006dcc;
            background-image: -moz-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: -ms-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: -webkit-gradient(linear,0 0,0 100%,from(var(--primary)),to(var(--primary)));
            background-image: -webkit-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: -o-linear-gradient(to bottom,var(--primary),var(--primary));
            background-image: linear-gradient(to bottom,var(--primary),var(--primary));
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=var(--primary), endColorstr='#0044cc', GradientType=0);
            border-color: #04c #04c #002a80;
            border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
        }*/
        .next,
        .prev,
        .datepicker-switch,
        .dow{
            color:var(--primary) !important;
        }
        .datepicker-inline {
            width: 100%;
        }
    </style>
@endsection
