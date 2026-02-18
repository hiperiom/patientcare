
import {get,post,meses,is_null,activarTooltip,is_empty,timestamps} from "../helpers/helpers.js";
import UserCuestUbicacion from "./UserCuestUbicacion.js";
import UserCuestTemperatura from "./UserCuestTemperatura.js";
import UserCuestFr from "./UserCuestFr.js";
import UserCuestTa from "./UserCuestTa.js";
import UserCuestFc from "./UserCuestFc.js";
import UserCuestOximetria from "./UserCuestOximetria.js";
import UserCuestGl from "./UserCuestGl.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
import AppAdministrativeData from "./UserCuestAdministracion.js";
import UserCuestEpisodio from "./UserCuestEpisodio.js";
import UserCuestPendiente from "./UserCuestPendiente.js";
import {index as UserCuestChat } from "./UserCuestChat.js";

import UserCuestHistoria,{create_historia_inicial} from "./UserCuestHistoria.js";
import { data } from "jquery";

let message
let userCuestPaciente = new UserCuestPaciente()
let userCuestHistoria = new UserCuestHistoria()
let userCuestPendiente = new UserCuestPendiente()

export default class Component {
    constructor(){

    }
    modalTemplate_1({
            title="Sin titulo",
            user_id,
            modal='#modelId',
            selector='.modal-body',
            btn_title='Nuevo valor',
            btn_create=true,
            eventModelFooter='',
            headerPaciente=true
        },
        fn
        ) {
            $("#modal-patient-item").modal("show");
            $("#modal-patient-item .modal-body-2").html( /*html */`
                <div id="infoPaciente"></div>

                <div class="d-flex flex-wrap justify-content-between" >
                    <div class="h1 text-primary">
                        ${title}
                    </div>
                    <span id="model_create" class="btn text-shadow-drop-tl text-primary mr-2" style="${btn_create === true?'display:block;':'display:none;'}float:right;font-size: 2rem !important; cursor:pointer;">
                        ${btn_title}
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </span>
                </div>
                <div id="modalTemplate_1_body" class="flex-fill mb-1">
                </div>
                <div class="input-group my-1 d-none">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">
                            <img style="width: 2em;height: 2em;" src="/image/system/carga1-success.svg">
                        </span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" aria-describedby="file">
                        <label class="custom-file-label" style="height: calc(2.7rem + 3px);" for="inputGroupFile01">Pulsa aquí para subir archivos</label>
                    </div>
                </div>
                <div class="row d-none" id="file_temp">

                </div>
                <div class="d-flex justify-content-center">
                    <div id="modalTemplate_1_footer"></div>
                    <div id="modalTemplate_2_footer"></div>
                </div>

            `);



            //eval( eventModelContent  );

            eval( eventModelFooter  );


            if (headerPaciente) {
                UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
            }
            fn();

    }
    modalTemplate_3({
            title="Sin titulo",

            modal='#messageModal',
            selector='.modal-body'

        },
        fn
        ) {

            $(modal).modal("show")





            fn();

    }

    /**
     * Modulos que usan modalTemplate_2:
     *
     * SystemIncidencia
     *
     */
    modalTemplate_2({
            title="Sin titulo",
            user_id,modal='#modelId',
            selector='.modal-body',
            btn_title='Nuevo valor',
            btn_create=true,

        },
        fn
        ) {

            $(modal).modal("show")

            $(selector).html( `
                <div class="row mt-1">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 position-inherit">
                        <div>
                            <h1 class="text-primary">
                                <span id="modalTemplate_1_title">
                                    ${title}
                                </span>
                            </h1>
                        </div>
                        <span id="model_create" class="text-shadow-drop-tl text-primary mr-2" style="${btn_create === true?'display:block;':'display:none;'}float:right;font-size: 2rem !important; cursor:pointer;">
                            ${btn_title}
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        <div id="modalTemplate_1_body"></div>
                    </div>
                </div>
                <div class="botones-bottom-modal">
                    <div id="modalTemplate_1_footer"></div>
                    <div id="modalTemplate_2_footer"></div>
                </div>
            `);

            fn();

    }
    formTemplate_1({selector='#modalTemplate_1_body',eventModelContent,btn_agregar='Agregar'}){
        $(selector).html(`
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <input type="number" class="form-control form-control-lg bg-gray-footer-parodi" name="value" id="value" aria-describedby="helpId" placeholder="Nuevo valor">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <input type="datetime-local" class="form-control form-control-lg bg-gray-footer-parodi" name="created_at" id="created_at" aria-describedby="helpId">
                        <small id="helpId1" class="form-text text-muted notification"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="coment" id="coment" rows="2" placeholder="Observación"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="btn_modalTemplate_agregar" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">${btn_agregar}</button>
                    </div>
                </div>
            </div>
        `);
        $("btn_modalTemplate_agregar").on("click", function () {
            eval( eventModelContent )
        });
    }

    formTemplate_2({placeholder="Escriba un texto...", fieldName="description", selector='#modalTemplate_1_body',btn_agregar='Agregar'}){
        $(selector).html(`
            <textarea class="form-control bg-gray-footer-parodi " name="${fieldName}" id="${fieldName}" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
        `);

    }

    btn_regresar({selector='#modalTemplate_2_footer',title='Regresar',eventModel}){
        //console.log(eventModel)
        $(selector).html (`
            <button id="btn_regresar" class="font-weight-bold btn btn-primary btn-block btn-lg">${title}</button>
        `);
        $("#btn_regresar").on("click", function () {
            eval( eventModel );
        });

    }
    btn_group_store({selector='#modalTemplate_2_footer',title='Regresar',eventModel}){
        //console.log(eventModel)
        $(selector).html (`
            <button id="btn_modalTemplate_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
            <button id="btn_regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">${title}</button>
        `);
        $("#btn_regresar").on("click", function () {
            eval( eventModel );
        });

    }
    btn_agregar({selector='#modalTemplate_1_footer',title='Agregar',eventModel}){
        //console.log(eventModel)
        $(selector).html (`
            <button id="btn_agregar" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">${title}</button>
        `);
        $("#btn_agregar").on("click", function () {
            eval( eventModel );
        });

    }
    btn_closeModal({selector="#modalTemplate_2_footer",title="Cerrar"}){
        $(selector).html (`
            <a class="btn bg-primary text-primary btn-block btn-lg" data-dismiss="modal" aria-label="Close">${title}</a>
        `);

    }
    btn_delete({data="#", tooltip="Eliminar Valor", className="delete-row btn btn-danger",html="<i class='fa fa-minus' aria-hidden='true'></i>"}){
        return`
            <button
                data-tippy-content="${tooltip}"
                class="${className}"
                data-id="${data}"
            >
                ${html}
            </button>
        `;

    }

    modelIndex_1({selector='#modalTemplate_1_body',columName=['Valor',"Observación"], classModel=null,user_id}){


        let tempColumn ="";
        $.each(columName, function (indexOfArray, valueOfElement ) {
            tempColumn += `<th class="text-primary text-center">${valueOfElement}</th>`;
        });
        $(selector).html(`
            <div class="table-responsive">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th class="text-primary text-center">
                            #
                        </th>
                        ${tempColumn}
                        <th class="text-primary text-center">Acción</th>

                    </tr>
                    <tbody id="filas">
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `);

        eval( classModel +".show({user_id:"+user_id+"})" )
        .then(response=>{
            let filas = "";
            if (Object.keys(response).length > 0) {

                let tempRow = "";


                $(response).each(function(index, element) {
                    tempRow = `
                        <tr id="temp_${element.id}">
                            <td style="width: 20px;" class="text-right text-secondary" id="modal-${element.id}">
                                ${index+1}
                            </td>
                            <td class="text-secondary" id="modal-${element.id}">
                                ${element.description!=null?element.description:''}
                            </td>
                            <td style="width: 60px;" align="center">
                                <button data-tippy-content="Eliminar valor" class="delete-row btn btn-danger" data-id="${element.id}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    `;
                    filas = filas + tempRow
                });

            }else{
                filas = `
                    <tr>
                        <td colspan="5" class="text-center text-primary">Sin registros</td>
                    </tr>
                `;
            }
            $("#filas").html(filas)
            $(".delete-row").on("click", function () {
                let c = confirm("¿Seguro que desea eliminar este registro?")
                if (c) {
                    let id = $(this).data('id')
                    eval( classModel +".eliminar({id:"+id+",user_id:"+user_id+"})" )
                }

            });

            tippy('[data-tippy-content]', {
                theme: 'tooltip-cmdlt-primary',
                zIndex: 200000
            })

        });

    }
    modelIndex_2({
        tableId="",
        selector='#modalTemplate_1_body',
        columName=['Valor',"Observación"],
        datatable = true,
        datatableOptions = [],
        datatablereportes=false,
        classModel=null,
        user_id=null
    },fn){


        let tempColumn ="";
        $.each(columName, function (indexOfArray, valueOfElement ) {
            tempColumn += `<th class="text-primary text-center">${valueOfElement}</th>`;
        });
        $(selector).html(`
            <div class="table-responsive" style="max-height: 60vh;">
                <table id="${tableId}" class="table table-bordered mb-3">
                    <thead>
                        <tr>

                            ${tempColumn}
                            <th class="text-primary text-center">Acción</th>

                        </tr>
                    </thead>
                    <tbody id="filas">
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `);

        fn();

    }
    formatArray({response,columnName="column-"}){
        let resultSet = new Array();
        $.each(response, function (indexInArray, valueOfElement) {
            resultSet[indexInArray]={};
            let i = 0;
            $.each(valueOfElement, function (indexInArray2, valueOfElement2) {
                resultSet[indexInArray][columnName+i]=valueOfElement2;
                i++;
            });
        });
        return resultSet;
    }
    formatArray_2({response,columnName=['id','value','coments','active','cat_user_cuestionario_id','user_id','created_at']}){
        let resultSet = new Array();
        $.each(response, function (indexInArray, valueOfElement) {
            resultSet[indexInArray]={};
            $.each(valueOfElement, function (indexInArray2, valueOfElement2) {
                let buscar = columnName.find(element => element === indexInArray2)
                if(buscar==indexInArray2){
                    resultSet[indexInArray][indexInArray2]=valueOfElement2;
                }
            });
        });
        return resultSet;
    }
    modelTableResult_1(
        {
            selector      = '#modalTemplate_1_body',
            response      = [{v1:"v1",v2:"v2",v3:"v3"},{v4:"v4",v5:"v5",v6:"v6"}],
            columnName    = ['Title1', "Title2"],
            className     = "table table-borderless",
            messageNoData = "Sin resultados",
            eventDelete   = null
        }
    ){
        let totalColumn = Object.keys(columnName).length;

        let thead =  ()=>{
            let row = "<tr>";
                    $.each(columnName, function (indexInArray, valueOfElement) {
                        row += `
                            <th class='head-${indexInArray} text-center text-primary'>${valueOfElement}</th>
                        `;
                    });
                row += "</tr>";
            return row;
        }

        let tbody =  ()=>{
            let resultSet = "";
            if (Object.keys(response).length > 0) {
                $.each(response, function (indexInArray, valueOfElement) {
                    resultSet += "<tr>";
                    $.each(valueOfElement, function (indexInArray2, valueOfElement2) {
                        resultSet += "<td>";
                        resultSet += valueOfElement2;
                        resultSet += "</td>";
                    });
                    resultSet += "</tr>";
                });
            }else{
                resultSet += "<tr>";
                resultSet += "<td class='text-secondary' colspan='"+totalColumn+"'>";
                resultSet += messageNoData;
                resultSet += "</td>";
                resultSet += "</tr>";
            }
            return resultSet;
        }

        let table = `
            <table class="${className}">
                <thead>
                    ${thead()}
                </thead>
                <tbody>
                    ${tbody()}
                </tbody>
            </table>
        `;
        $(selector).html(table)
        $(".delete-row").on("click", function () {
            eval( eventDelete.replace( "#", $(this).data('id') ) )
        });
        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
        })
    }
    headerTable({option=1}){
        switch (option) {
            case 1:
                return ["Fecha","Valor","Observación","Acción"];
            break;
        }
    }

    formatDate({date="2000-01-01 00:00:00 AM"}){
        let d = new Date(date);
        return  meses(d.getMonth()).toUpperCase()+" / "+d.getDate()+" <b>|</b> "+formatAMPM(d);
    }
    static alertMessage(caso) {

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
    async viewResumenPaciente(selector) {
        $(selector).html(`
            <div class="container-fluid  p-0 sticky-top" style="z-index: 1040 !important;">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <div class="table-responsive-md">
                            <table id="tablapacientes" class="w-100">
                                <thead>
                                    <tr>
                                        <th class="bg-white sticky-top p-1 menu-nivel-1 text-uppercase" colspan="13">
                                            <div id="cat_user_ubicacion_menu"></div>
                                        </th>
                                        <th class="bg-white sticky-top p-1 menu-nivel-1" colspan="5" align="middle">
                                            <button id="btn_paciente_create" onclick="window.location='/medico/create_paciente'"  class="btn btn-success font-weight-bold btn-block" style="" >Nuevo Paciente</button>
                                        </th>
                                    </tr>
                                    <tr>

                                        <th class="menu-nivel-2 sticky-top align-top align-top pt-2" colspan="18">
                                            <table class="w-100">
                                                <tr>
                                                    <td align="middle" style="width: 100px;overflow: hidden;">
                                                        <div id="titleArea" style="width:180px;"  class="text-uppercase">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="flex-fill" id="btnNotificaciones" style="
                                                        display: flex;

                                                        justify-content: flex-end;
                                                    ">
                                                        </div>
                                                    </td>
                                                    <td align="middle" style="width: 26%;overflow: hidden;">
                                                        <input type="search" class="form-control" id="busquedapaciente" placeholder="Buscar paciente..." aria-label="Buscar paciente..." aria-describedby="button-addon2">

                                                    </td>
                                                </tr>
                                            </table>

                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="menu-nivel-3 sticky-top" data-tippy-content="Monitoreo de Pacientes Priorizados" colspan="18">
                                            <div id="signosP"  class='marquee-with-options'></div>
                                        </td>
                                    </tr>

                                </thead>
                                <tbody id="row_paciente">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `);

        filtroTabla()
        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
        })
    }

    /*************** */
    AppMenuPad(){
        let that = this
        return {
            el:"#AppMenuPad",
            template: /*html */ `

                <div>
                    <div id="menuPatiencare" class="list-group">
                        <span class="text-primary font-weight-bold menu-pad-title">
                            Menú PAD
                        </span>
                        <div v-for="(item,index) in items" :key="index">
                            <a
                                v-if="!item.hasEvent"
                                data-toggle="collapse"
                                :href="'#collapse_pad'+index"
                                role="button"
                                aria-expanded="false"
                                :aria-controls="'#collapse'+index"
                                class="d-flex align-items-center list-group-item list-group-item-action">
                                <i :class="[item.icon,'font-weight-bold text-info mr-1 ml-2 mb-0 h3']"></i>
                                {{item.description}}
                            </a>
                            <a
                                v-else
                                @click="handleAreaOption(item.param_route)"
                                :href="'#collapse'+index"
                                role="button"
                                class="d-flex align-items-center list-group-item list-group-item-action">
                                <i :class="[item.icon,'font-weight-bold text-info mr-1 ml-2 mb-0 h3']"></i>
                                {{item.description}}
                            </a>
                            <div v-if="!item.hasEvent" class="collapse" :id="'collapse_pad'+index">
                                <div class="card mb-0 card-body py-0">
                                    <a
                                        v-for="(item2,index2) in item.subItems" :key="index2"
                                        @click="handleAreaOption(item2.param_route)"
                                        href="#"
                                        class="border-0 list-group-item p-2 list-group-item-action"
                                    >
                                        <i :class="[item2.icon,'text-info']"></i> {{item2.description}}
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                            <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                        </div>
                    </div>
                </div>
            `,
            data() {
                return {
                    items: [
                        {
                            id:1,
                            description:"Pad Emergencia",
                            icon:"pc-pad_emergencia",
                            param_route:"",
                            hasEvent:false,
                            subItems:[
                                {
                                    id:1,
                                    description:"Adulto",
                                    icon:"pc-pad_emergencia",
                                    param_route:"pad_emergencia_adulto",
                                    hasEvent:false,
                                    subItems:[]
                                },
                                {
                                    id:1,
                                    description:"Pediátrica",
                                    icon:"pc-pad_emergencia",
                                    param_route:"pad_emergencia_pediatrica",
                                    hasEvent:false,
                                    subItems:[]
                                },
                            ]
                        },
                        {
                            id:1,
                            description:"Pad PostQuirúrgico",
                            icon:"pc-light-pad-quiru",
                            param_route:"",
                            hasEvent:false,
                            subItems:[
                                {
                                    id:1,
                                    description:"Ambulatorio",
                                    icon:"pc-pad_emergencia",
                                    param_route:"pad_postquirurgico_amb",
                                    hasEvent:false,
                                    subItems:[]
                                },
                                {
                                    id:1,
                                    description:"Hospitalización",
                                    icon:"pc-pad_emergencia",
                                    param_route:"pad_postquirurgico_hosp",
                                    hasEvent:false,
                                    subItems:[]
                                },
                            ]
                        },
                        {
                            id:1,
                            description:"Pad Médico",
                            icon:"pc-light-pad-medico",
                            param_route:"pad_medico",
                            hasEvent:true,
                            subItems:[]
                        },

                    ],
                    loading:document.getElementById('loadingScreen')
                }
            },
            props:{
                areaSiglas:String,
                FnAreaSiglas:Function,
            },

            methods:{
                async getAreaData(){
                    let areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                    this.FnAreaSiglas(areaSiglas)

                    //this.selectorAreaName.textContent = this.items.find(x=>x.siglas === areaSiglas).name
                    this.loading.classList.remove("d-none")
                    pacientes_datos = await get( location.origin+"/vistas/" + areaSiglas )
                    EventBus.$emit('externalVarChanged', pacientes_datos);
                    that.AppBtnTotales(pacientes_datos)
                    this.loading.classList.add("d-none")
                },
                handleAreaOption(areaSiglas){
                    console.log(areaSiglas)

                    this.FnAreaSiglas(areaSiglas)
                    localStorage.setItem("area",areaSiglas)
                    this.getAreaData()
                    $("#messageModal").modal("hide")
                },
            },
            mounted () {

            },
        }
    }
    AppMenuAQ(){
        let that = this
        console.log(pacientes_datos);
        return {
            el:"#AppMenuAQ",
            template: /*html */ `

                <div>
                    <div id="menuPatiencare" class="list-group">
                        <span class="text-primary font-weight-bold menu-pad-title">
                            Menú Área Quirúrgica
                        </span>
                        <div v-for="(item,index) in items" :key="index">
                            <a
                                v-if="!item.hasEvent"
                                @click="handleAreaOption(item.param_route)"
                                data-toggle="collapse"
                                :href="'#collapse_pad'+index"
                                role="button"
                                aria-expanded="false"
                                :aria-controls="'#collapse'+index"
                                class="d-flex align-items-center list-group-item list-group-item-action">
                                <i :class="[item.icon,'font-weight-bold text-info mr-1 ml-2 mb-0 h3']"></i>
                                {{item.description}} <!--<span class="ml-1 badge badge-gray text-info">{{item.total_pacientes}}</span>-->
                            </a>

                        </div>


                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                            <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                        </div>
                    </div>
                </div>
            `,
            data() {
                return {
                    items: [

                        {
                            id:1,
                            description:"Torre Hospitalización",
                            icon:"pc-light-hospital",
                            param_route:"aq_torre_hosp",
                            hasEvent:false,
                            subItems:[],
                            //total_pacientes: pacientes_datos.filter(x=>[418,422].includes( Number(x.cat_user_ubicacion_id) )).length
                        },
                        {
                            id:1,
                            description:"MAPM",
                            icon:"pc-ambulatorio",
                            param_route:"aq_mapm",
                            hasEvent:false,
                            subItems:[],
                            //total_pacientes: pacientes_datos.filter(x=>[424,425].includes( Number(x.cat_user_ubicacion_id) )).length
                        },

                    ],
                    loading:document.getElementById('loadingScreen')
                }
            },
            props:{
                areaSiglas:String,
                FnAreaSiglas:Function,
            },

            methods:{
                async getAreaData(){
                    let areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                    this.FnAreaSiglas(areaSiglas)

                    //this.selectorAreaName.textContent = this.items.find(x=>x.siglas === areaSiglas).name
                    this.loading.classList.remove("d-none")
                    pacientes_datos = await get( location.origin+"/vistas/" + areaSiglas )
                    EventBus.$emit('externalVarChanged', pacientes_datos);
                    that.AppBtnTotales(pacientes_datos)
                    this.loading.classList.add("d-none")
                },
                handleAreaOption(areaSiglas){
                    console.log(areaSiglas)

                    this.FnAreaSiglas(areaSiglas)
                    localStorage.setItem("area",areaSiglas)
                    this.getAreaData()
                    $("#messageModal").modal("hide")
                },
            },
            mounted () {

            },
        }
    }
    AppMenuEgresos(){

        return {
            el:"#AppMenuEgresos",
            template:/*html */ `
                <div id="AppMenuEgresos">
                    <div id="menuPatiencare" class="list-group">
                        <span class="text-primary font-weight-bold menu-pad-title">
                            Menú Egresos
                        </span>
                        <div v-for="(item,index) in items" :key="index">
                            <a
                                v-if="!item.hasEvent"
                                data-toggle="collapse"
                                :href="'#collapse_pad'+index"
                                role="button"
                                aria-expanded="false"
                                :aria-controls="'#collapse'+index"
                                class="d-flex align-items-center list-group-item list-group-item-action">
                                <i :class="[item.icon,'font-weight-bold text-info mr-1 ml-2 mb-0 h3']"></i>
                                {{item.description}}
                            </a>
                            <a
                                v-else
                                @click="handleAreaOption(item.param_route)"
                                :href="'#collapse'+index"
                                role="button"
                                class="d-flex align-items-center list-group-item list-group-item-action">
                                <i :class="[item.icon,'font-weight-bold text-info mr-1 ml-2 mb-0 h3']"></i>
                                {{item.description}}
                            </a>
                            <div v-if="!item.hasEvent" class="collapse" :id="'collapse_pad'+index">
                                <div class="card mb-0 card-body py-0">
                                    <a
                                        v-for="(item2,index2) in item.subItems" :key="index2"
                                        @click="handleAreaOption(item2.param_route)"
                                        href="#"
                                        class="border-0 list-group-item p-2 list-group-item-action"
                                    >
                                        <i :class="[item2.icon,'text-info']"></i> {{item2.description}}
                                    </a>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                        <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                    </div>
                </div>
            `,
            data() {
                return {
                    loading:document.getElementById('loadingScreen'),
                    items: [

                        {
                            id:1,
                            description:"Altas",
                            icon:"",
                            param_route:"alta",
                            hasEvent:true,
                            subItems:[]
                        },
                        {
                            id:1,
                            description:"Traslado a otra institución",
                            icon:"",
                            param_route:"traslado",
                            hasEvent:true,
                            subItems:[]
                        },
                        {
                            id:1,
                            description:"Contraopinión médica",
                            icon:"",
                            param_route:"contraopinion",
                            hasEvent:true,
                            subItems:[]
                        },
                        {
                            id:1,
                            description:"Fallecido",
                            icon:"",
                            param_route:"fallecido",
                            hasEvent:true,
                            subItems:[]
                        },
                        {
                            id:1,
                            description:"Otro",
                            icon:"",
                            param_route:"otro",
                            hasEvent:true,
                            subItems:[]
                        },

                    ]
                }
            },
            props:{
                areaSiglas:String,
                FnAreaSiglas:Function,
            },

            methods:{
                async getAreaData(){
                    let areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                        this.FnAreaSiglas(areaSiglas)

                        //this.selectorAreaName.textContent = this.items.find(x=>x.siglas === areaSiglas).name
                        //this.loading.classList.remove("d-none")
                        this.loading.classList.remove("d-none")
                        pacientes_datos = await get( location.origin+"/vistas/" + areaSiglas )
                        EventBus.$emit('externalVarChanged', pacientes_datos);
                        this.loading.classList.add("d-none")
                },
                handleAreaOption(areaSiglas){
                    console.log(areaSiglas)

                    this.FnAreaSiglas(areaSiglas)
                    localStorage.setItem("area",areaSiglas)
                    this.getAreaData()
                    $("#messageModal").modal("hide")
                },
            },
            mounted () {

            },
        }

    }
    AppBtnUbicacion(){
        /*
        <div :class="[{'border-right':item.area_lv_2 !==''},'d-flex px-1 justify-content-center flex-column']" style="line-height:0.5rem;height:100%">
                            <div class="h6 mb-0 text-nowrap mt-auto">
                                {{item.area_lv_1}}
                            </div>
                        </div>
                        <div :class="[{'border-right':item.area_lv_3 !==''},'d-flex px-1 justify-content-center flex-column']" style="line-height:0.5rem">
                            <div v-if="is_hospitalizacion(item.parent_cat_user_ubicacion_id)" style="font-size:0.7rem;">ALA</div>

                            <div class="h6 mb-0 text-nowrap">
                                {{item.area_lv_2}}
                            </div>
                        </div>
                        <div :class="[{'border-right':item.area_lv_4 !==''},'d-flex px-1 justify-content-center flex-column']"style="line-height:0.5rem">
                            <div v-if="is_hospitalizacion(item.parent_cat_user_ubicacion_id)" style="font-size:0.7rem;">HAB</div>
                                <div class="h6 mb-0 text-nowrap">
                                    {{item.area_lv_3}}
                                </div>
                            </div>
                            <div :class="[{'border-right':item.area_lv_4 !==''},'d-flex px-1 justify-content-center flex-column']"style="line-height:0.5rem">
                                <div class="h6 mb-0 text-nowrap">
                                    {{item.area_lv_4}}
                                </div>
                            </div>
                        </div>

        */

        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            data() {
                return {
                    item:{},
                }
            },
            template:/*HTML */`
                <button
                    @click="handle_historial_ubicaciones()"
                    class="w-100 mr-1 mr-xl-0 order-1 order-1 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"
                >
                    <b class="small-title text-primary">Ubicación</b>
                    <div class="flex-fill d-flex justify-content-center  align-items-end">
                        {{patient_data.ubicacion}}
                    </div>
                </button>

            `,
            methods:{
                handle_historial_ubicaciones(){
                    UserCuestUbicacion.historialUbiEpisodio('.modal-body',this.patient_data.user_id )
                },
                is_hospitalizacion(ubicacion_id){
                  let parent_ubicacion_id = [42,71,235,236,99,127,234,155]

                  if(parent_ubicacion_id.includes(ubicacion_id)){
                    return true
                  }else{
                    return false
                  }
                },

            },
            mounted() {

            this.item =  cat_ubicaciones.find(x=>x['id'] === this.patient_data.cat_user_ubicacion_id)
            },
        }
    }
    AppBtnDias(){
        return {
            data() {
                return {
                    h: null,
                    m: null,
                }
            },
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div :class="[([6,7,10,2,3,270,29,32].includes(this.patient_data.parent_cat_user_ubicacion_id) || [405,406].includes(this.patient_data.cat_user_ubicacion_id) ? 'col-xl-12'+' btn-'+patient_data.status_color_emergencia :'col-xl-6 btn-outline-gray' ) ,'mr-1 my-xl-1 mr-xl-0   justify-content-around order-2 btn p-1 d-flex justify-content-center align-items-center text-uppercase rounded']">
                    <div :class='["flex-column",([6,7,10,2,3,270,29,32].includes(this.patient_data.parent_cat_user_ubicacion_id) || [405,406].includes(this.patient_data.cat_user_ubicacion_id) ? "d-none":"d-flex")]'>
                        <b class="small-title text-primary">Días</b>
                        <div class="text-secondary mt-auto">
                        {{patient_data.dias}}
                        </div>
                    </div>
                    <div :class="[([6,7,10,2,3,270,29,32].includes(this.patient_data.parent_cat_user_ubicacion_id) || [405,406].includes(this.patient_data.cat_user_ubicacion_id) ? 'd-flex':'d-none'),'flex-column']">
                        <b class="small-title">Horas</b>
                        <div :class="['mt-auto']">
                        <i :class="['fas fa-clock', {'d-none':!['warning','danger'].includes(patient_data.status_color_emergencia)},{'ping':patient_data.status_color_emergencia==='warning'},{'ping-2':patient_data.status_color_emergencia==='danger'}]"></i> {{JSON.parse(patient_data.tiempo_transcurrido).h}} H, {{JSON.parse(patient_data.tiempo_transcurrido).m}} M
                        </div>
                    </div>
                </div>
            `,

        }
    }

    AppPrealta(){
        return {
            template:/*html*/ `
                <button
                    v-if="calendarOpen"
                    @click="createPrealta()"

                    :class="[getButtonVisible() ,{'heartbeat_infinity':['danger','warning'].includes(prealtaColor)}, 'col-xl d-flex flex-column flex-sm-row order-4 btn p-1 justify-content-center align-items-center text-uppercase rounded']"
                >
                    <div class="px-1 border-sm-right pr-1" style="font-size: 0.7rem;">
                        <i class="fas fa-stopwatch d-none d-sm-block"></i> {{title}}
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div style="font-size: 2rem;font-weight:bold;line-height: 0.8;">
                            {{preAltaDay}}
                        </div>
                        <div style="font-size: 0.8rem;">
                            {{prealtaMonth}}
                        </div>
                    </div>
                </button>
                <button
                    v-else
                    @click="createPrealta()"
                    :class="[getButtonVisible() ,{'heartbeat_infinity':['danger','warning'].includes(prealtaColor)}, 'col-xl d-flex order-4 btn p-1 flex-column justify-content-center align-items-center text-uppercase rounded']"
                >
                    <b class="small-title text-primary">{{title}}</b>
                    <i class="far fa-calendar text-gray  mt-auto"></i>
                </button>
            `,
            data() {
                return {
                    title: "PREALTA",
                    calendarOpen:false,
                    preAltaDay:0,
                    prealtaMonth:"No indicado",
                    prealtaColor:"default",
                    item: [],
                }
            },
            props:{
                patient_data:Object,
                index:Number,
            },
            methods: {
                have_Prealta(){
                    //console.log(this.patient_data.pre_alta);
                    let fecha_prealta = this.patient_data.pre_alta
                        //console.log(fecha_prealta);
                        if (fecha_prealta !== null) {
                            this.calendarOpen = true
                            fecha_prealta = ( fecha_prealta.split(" ") )[0]
                            fecha_prealta = fecha_prealta.split("-");
                            //console.log(fecha_prealta);
                            this.preAltaDay = fecha_prealta[2]
                            this.prealtaMonth = this.meses( Number(fecha_prealta[1])-1 ).slice(0,3)
                            this.getColorPrealta()

                        }else{
                            this.calendarOpen = false
                        }
                },
                getButtonVisible(){
                    return this.calendarOpen ? 'btn-'+this.prealtaColor : "btn-outline-gray"
                },
                getColorPrealta(){
                    // Define una fecha dada
                    let fecha_prealta = this.patient_data.pre_alta
                    const fechaDada = new Date( fecha_prealta ); // Cambia la fecha según tus necesidades

                    // Obtén la fecha actual
                    const fechaActual = new Date();

                    // Calcula la diferencia en milisegundos
                    const diferenciaMilisegundos = fechaDada - fechaActual;

                    // Convierte la diferencia de milisegundos a días
                    const diferenciaDias = diferenciaMilisegundos / (1000 * 60 * 60 * 24);

                    // Redondea la diferencia a un número entero (puedes ajustar el redondeo según tus necesidades)
                    const diasPorDelante = Math.ceil(diferenciaDias);
                        if(diasPorDelante <= 0){
                            this.prealtaColor = "danger"
                        }
                        if(diasPorDelante === 1){
                            this.prealtaColor = "warning"
                        }
                        if(diasPorDelante >= 2){
                            this.prealtaColor = "success"
                        }

                       // console.log(`Días por delante: ${diasPorDelante}`);
                },
                meses(p) {
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
                },
                handleDaySelected(e){

                    //Obtener dia actual
                    let currentDay = new Date()
                    //obtener dia actual en formato milisegundos
                    let currentDayMilisecons = new Date(currentDay.getFullYear() , (currentDay.getMonth()+1) , currentDay.getDate()+1)
                    //Obtener dia seleccionado en el calendario
                    let selectedDay = new Date(e.date)
                    //Obtener el dia seleccionado en milisegundos
                    let selectedDayMilisecons = new Date(selectedDay.getFullYear() , (selectedDay.getMonth()+1) , selectedDay.getDate()+1)
                        if(selectedDayMilisecons.getTime() < currentDayMilisecons.getTime()){
                            alert("La fecha ingresada no puede ser anterior a hoy.");
                            return false
                        }else{
                            this.patient_data.pre_alta = selectedDay.getFullYear() +'-'+ (selectedDay.getMonth()+1).toString().padStart(2, '0') +'-'+ selectedDay.getDate().toString().padStart(2, '0')
                            //console.log(this.patient.prealta);
                        }
                },
                async updatePrealta(){
                    let formdata = new FormData();
                        formdata.append("user_id", this.patient_data.user_id)
                        formdata.append("_token", $("#_token").val())
                        formdata.append("valor", this.patient_data.pre_alta)
                        return await post( location.origin+"/user_cuest_episodio/prealta", formdata)
                },
                createPrealta(){

                    let that = this
                    let modal = document.querySelector("#messageModal div.modal-body")
                        modal.innerHTML = /*html */`
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 h3 text-primary font-weight-bold text-center">
                                        Fecha Probable de Alta
                                    </div>
                                </div>
                            </div>
                            <div id="calendar" data-user_id="${this.patient_data.user_id}" class="daterange" style="width: 100%"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <button id="storePrealta" data-user_id="${this.patient_data.user_id}" class="btn btn-success btn-block my-1">Confirmar</button>
                                    </div>
                                    <div class="col-12">
                                        <button id="destroyPrealta" class="btn btn-primary btn-block my-1">Cancelar Prealta</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('storePrealta').addEventListener("click",async ()=>{
                            let result = await that.updatePrealta()

                                pacientes_datos[this.index] = this.patient_data
                                that.have_Prealta()
                                $("#messageModal").modal("hide");
                        })
                        document.getElementById('destroyPrealta').addEventListener("click",async ()=>{
                            this.patient_data.pre_alta = null;
                            let result = await that.updatePrealta()
                                pacientes_datos[this.index] = this.patient_data
                                that.have_Prealta()
                                $("#messageModal").modal("hide");
                        })
                        $('#calendar').datepicker({
                            language: "es",
                            toggleActive: true,
                            todayHighlight: true,
                        });
                        $('#calendar').datepicker().on("changeDate", function(e) {
                            that.handleDaySelected(e)
                        })
                        $("#messageModal").modal("show");
                }
            },
            async mounted () {
                //this.patient_data
                //this.index =
                this.have_Prealta()
                //console.log(this.item);
            },
        }
    }
    AppBtnTrasladoAmbulancia(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            data() {
                return {
                    selector: null,
                    propName: "btn_traslado_ambulancia"
                }
            },
            template:/*HTML */`
                <button
                    :id="propName+'_'+patient_data.episodio_id"
                    @click="handle_historial_ubicaciones()"
                    :class="[([6,7,10,2,3,270,29,32].includes(this.patient_data.parent_cat_user_ubicacion_id) || [405,406].includes(this.patient_data.cat_user_ubicacion_id) ? 'col-xl-12 mb-xl-1 mr-1' :'col-xl-6 my-xl-1' ) ,' order-3 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded']"
                >
                    <b class="small-title text-primary">Traslado</b>
                    <div class="mt-auto">
                        <i :class="['fas fa-ambulance',(isActive ? 'text-danger' : 'text-gray')]"></i>
                    </div>
                </button>
            `,
            computed: {
                isActive() {
                    return this.patient_data.traslado_ambulancia !== null ? true : false;
                }
            },
            methods:{
                handle_historial_ubicaciones(){
                    UserCuestUbicacion.trasladoAmbulanciaIndex(this.patient_data.episodio_id,this.patient_data.user_id)
                },
                destroyTooltip(){
                    let btn = this.selector;

                        if (btn._tippy !==undefined) {
                            const instance= btn._tippy;
                            instance.destroy()
                        }
                },
                activateTooltip(){
                    this.destroyTooltip()

                    if (this.patient_data.traslado_ambulancia !== null) {
                        tippy(this.selector, {
                            content: `Fecha del traslado: ${this.patient_data.traslado_ambulancia.fecha_traslado}`,
                            theme: 'tooltip-cmdlt-danger',
                            zIndex: 200000,
                            allowHTML: true,
                        });

                    }

                },
            },
            mounted () {
                this.selector = document.querySelector('#'+this.propName+'_'+this.patient_data.episodio_id)
                //console.log('#'+this.propName+'_'+this.patient_data.episodio_id);
                //console.log(this.selector);
                this.activateTooltip()
            },
        }
    }
    AppBtnRiesgoHerida(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template: /*html*/ `
                <div class="dropdown">
                    <button
                        :id="propName+'_'+patient_data.user_id"
                        class="btn btn-default p-1 dropdown-toggle"
                        type="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                    <i :class="[icon,('text-'+getColor),{'ping-2':Number(patient_data[this.propName])==1},{'ping':Number(patient_data[this.propName])==2}]"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a @click="create(3)" href="#" :class="[{'active':Number(riesgo_value)===3},'dropdown-item']">
                            <span :class="[icon,'text-success']"></span>
                            Estable
                        </a>
                        <a @click="create(2)" href="#" :class="[{'active':Number(riesgo_value)===2},'dropdown-item']">
                            <span :class="[icon,'text-warning']"></span>
                            Intermedio
                        </a>
                        <a @click="create(1)" href="#" :class="[{'active':Number(riesgo_value)===1},'dropdown-item']">
                            <span :class="[icon,'text-danger']"></span>
                            De cuidado
                        </a>
                    </div>
                </div>
            `,
            data() {
                return {
                    index:null,
                    icon:"pc-cirugia",
                    title:"Riesgo de Herida",
                    propName:"cirugia",
                    riesgo_coment:"",
                    riesgo_value:1,
                    riesgo_color:"success",
                    item:[]
                }
            },
            computed: {
                getTooltipMessage(){
                    let riesgo = ""
                        if (this.patient_data[this.propName] == 1 || this.patient_data[this.propName] == null) {
                            riesgo = 'Estable'
                        }
                        if (this.patient_data[this.propName] == 2) {
                            riesgo = 'Intermedio'
                        }
                        if (this.patient_data[this.propName] == 3) {
                            riesgo = 'De cuidado'
                        }
                    return /*html*/`
                        <b>
                            <i class='${this.icon}'></i>
                            ${this.title}:
                        </b>
                        ${riesgo}
                        <small class="${ [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName]) || [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName+'_description'])?'d-none':''}">
                            <br>
                            ${this.patient_data[this.propName+'_description']}
                        </small>
                    `
                },
                getColor(){
                    if (Number(this.patient_data[this.propName]) == 1 || Number(this.patient_data[this.propName]) == null) {
                        return 'danger'
                    }
                    if (Number(this.patient_data[this.propName]) == 2) {
                        return 'warning'
                    }
                    if (Number(this.patient_data[this.propName]) == 3 || this.patient_data[this.propName] ===null) {
                        return 'success'
                    }

                },
            },
            methods: {

                have_item(){
                    if (this.patient_data[this.propName] !== null) {
                        this.riesgo_value = this.patient_data[this.propName]
                        this.riesgo_coment = this.patient_data[this.propName+'_description']
                    }else{
                        this.riesgo_value = 1
                        this.riesgo_coment = null
                    }
                    this.activateTooltip()
                },
                view1(){
                    return /*html */`
                        <div class="container-fluid py-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea
                                        class="form-control"
                                        placeholder="Escribe un comentario sobre tu selección. (Opcional)"
                                        rows="3"
                                        id="coment"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3">
                                    <a id="submit" class="btn btn-block btn-primary"  href="#" role="button">Guardar</a>
                                </div>
                            </div>
                        </div>
                    `;
                },
                destroyTooltip(){
                    let btn = document.querySelector('#'+this.propName+'_'+this.patient_data.user_id);
                        if (btn._tippy !==undefined) {
                            const instance= btn._tippy;
                            instance.destroy()
                        }
                },
                activateTooltip(){
                    this.destroyTooltip()
                    tippy('#'+this.propName+'_'+this.patient_data.user_id, {
                        content: this.getTooltipMessage,
                        theme: 'tooltip-cmdlt-'+this.getColor,
                        zIndex: 200000,
                        allowHTML: true,
                    });
                },
                async store(value){


                    this.riesgo_value = Number(value)
                    this.riesgo_coment =  document.getElementById('coment').value
                    let formData = new FormData();
                        formData.append("episodio_id", this.patient_data.episodio_id)
                        formData.append("value", this.riesgo_value )
                        formData.append("user_id_paciente", this.patient_data.user_id)
                        formData.append("description", !is_empty( this.riesgo_coment ) ? this.riesgo_coment : null)
                        formData.append("created_at", timestamps() )
                        formData.append("_token", $("#_token").val())
                    let model = await post( location.origin+"/user_cuest_riesgo_quirurgico/store", formData)

                        this.patient_data[this.propName] = Number(this.riesgo_value)
                        this.patient_data[this.propName+'_description'] = this.riesgo_coment
                        pacientes_datos[this.index] = this.patient_data[this.propName]
                        this.have_item()
                        /* Swal.fire(
                            `Riesgo actualizado!`,
                            `La registro se hizo correctamente.`,
                            'success'
                        ) */


                        $("#messageModal").modal("hide")



                },
                create(value){
                    let that = this
                        $("#messageModal").modal("show")
                        $("#messageModal .modal-body").html( this.view1() );
                        document.getElementById('submit').addEventListener("click",(e)=>{
                           that.store(value)
                        })
                },
            },
            mounted () {

                this.have_item()

            },
        }


    }
    AppBtnRiesgoCaida(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template: /*html*/ `
                <div class="dropdown">
                    <button
                        :id="propName+'_'+patient_data.user_id"
                        class="btn btn-default p-1 dropdown-toggle"
                        type="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i :class="[icon,('text-'+getColor),{'ping-2':riesgo_value==1},{'ping':riesgo_value==2}]"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a @click="create(3)" href="#" :class="[{'active':riesgo_value==3},'dropdown-item']">
                            <span :class="[icon,'text-success']"></span>
                            Estable
                        </a>
                        <a @click="create(2)" href="#" :class="[{'active':riesgo_value==2},'dropdown-item']">
                            <span :class="[icon,'text-warning']"></span>
                            Intermedio
                        </a>
                        <a @click="create(1)" href="#" :class="[{'active':riesgo_value==1},'dropdown-item']">
                            <span :class="[icon,'text-danger']"></span>
                            De cuidado
                        </a>
                    </div>
                </div>
            `,
            data() {
                return {
                    index:null,
                    icon:"pc-resbalar",
                    title:"Riesgo de caida",
                    propName:"resbalar",
                    riesgo_coment:"",
                    riesgo_value:3,
                    riesgo_color:"success",
                    item:[]
                }
            },
            computed: {
                getTooltipMessage(){

                    let riesgo = ""
                        if (this.patient_data[this.propName] == "3" || this.patient_data[this.propName] === null) {
                            riesgo = 'Estable'
                        }
                        if (this.patient_data[this.propName] == "2") {
                            riesgo = 'Intermedio'
                        }
                        if (this.patient_data[this.propName] == "1") {
                            riesgo = 'De cuidado'
                        }
                    return /*html*/`
                        <b>
                            <i class='${this.icon}'></i>
                            ${this.title}:
                        </b>
                        ${riesgo}
                        <small class="${ [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName]) || [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName+'_description'])?'d-none':''}">
                            <br>
                            ${this.patient_data[this.propName+'_description']}
                        </small>
                    `
                },
                getColor(){
                    if (this.patient_data[this.propName] == "3" || this.patient_data[this.propName] === null) {
                        return 'success'
                    }
                    if (this.patient_data[this.propName] == "2") {
                        return 'warning'
                    }
                    if (this.patient_data[this.propName] == "1") {
                        return 'danger'
                    }

                },
            },
            methods: {

                have_item(){
                        if (this.patient_data[this.propName] !== null) {
                            this.riesgo_value = Number(this.patient_data[this.propName])
                            this.riesgo_coment = this.patient_data[this.propName+'_description']
                        }else{
                            this.riesgo_value = "3"
                            this.riesgo_coment = null
                        }
                        this.activateTooltip()
                },
                view1(){
                    return /*html */`
                        <div class="container-fluid py-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea
                                        class="form-control"
                                        placeholder="Escribe un comentario sobre tu selección. (Opcional)"
                                        rows="3"
                                        id="coment"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3">
                                    <a id="submit" class="btn btn-block btn-primary"  href="#" role="button">Guardar</a>
                                </div>
                            </div>
                        </div>
                    `;
                },
                destroyTooltip(){
                    let btn = document.querySelector('#'+this.propName+'_'+this.patient_data.user_id);
                        if (btn._tippy !==undefined) {

                            const instance= btn._tippy;
                            instance.destroy()
                        }
                },
                activateTooltip(){
                    this.destroyTooltip()
                    tippy('#'+this.propName+'_'+this.patient_data.user_id, {
                        content: this.getTooltipMessage,
                        theme: 'tooltip-cmdlt-'+this.getColor,
                        zIndex: 200000,
                        allowHTML: true,
                    });
                },
                async store(value){


                    this.riesgo_value = Number(value)
                    this.riesgo_coment =  document.getElementById('coment').value
                    let formData = new FormData();
                        formData.append("episodio_id", this.patient_data.episodio_id)
                        formData.append("value", this.riesgo_value )
                        formData.append("user_id_paciente", this.patient_data.user_id)
                        formData.append("description", !is_empty( this.riesgo_coment ) ? this.riesgo_coment : null)
                        formData.append("created_at", timestamps() )
                        formData.append("_token", $("#_token").val())
                    let model = await post( location.origin+"/user_cuest_resbalar/store", formData)

                        this.patient_data[this.propName] = Number(this.riesgo_value)
                        this.patient_data[this.propName+'_description'] = this.riesgo_coment
                        pacientes_datos[this.index] = this.patient_data[this.propName]
                        this.have_item()
                        /* Swal.fire(
                            `Riesgo actualizado!`,
                            `La registro se hizo correctamente.`,
                            'success'
                        ) */


                        $("#messageModal").modal("hide")



                },
                create(value){
                    let that = this
                        $("#messageModal").modal("show")
                        $("#messageModal .modal-body").html( this.view1() );
                        document.getElementById('submit').addEventListener("click",(e)=>{
                           that.store(value)
                        })
                },
            },
            mounted () {

                this.have_item()

            },
        }


    }
    AppBtnRiesgoAlerta(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template: /*html*/ `
                <div class="dropdown">
                    <button
                        :id="propName+'_'+patient_data.user_id"
                        class="btn btn-default p-1 dropdown-toggle"
                        type="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i :class="[getIcon,('text-'+getColor),{'ping-2':Number(riesgo_value)===1},{'ping':Number(riesgo_value)===2}]"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a @click="create(3)" href="#" :class="[{'active':riesgo_value===3},'dropdown-item']">
                            <span :class="['pc-alerta_estable','text-success']"></span>
                            Estable
                        </a>
                        <a @click="create(2)" href="#" :class="[{'active':riesgo_value===2},'dropdown-item']">
                            <span :class="['pc-alerta_intermedia','text-warning']"></span>
                            Intermedio
                        </a>
                        <a @click="create(1)" href="#" :class="[{'active':riesgo_value===1},'dropdown-item']">
                            <span :class="['pc-alerta_alta','text-danger']"></span>
                            De cuidado
                        </a>
                    </div>
                </div>
            `,
            data() {
                return {
                    index:null,
                    icon:"",
                    title:"Alerta de riesgo",
                    propName:"alert",
                    riesgo_coment:"",
                    riesgo_value:3,
                    riesgo_color:"success",
                    item:[]
                }
            },
            computed: {
                getTooltipMessage(){
                    let riesgo = ""
                        if (Number(this.patient_data[this.propName]) === 3 || this.patient_data[this.propName] === null) {
                            riesgo = 'Estable'
                        }
                        if (Number(this.patient_data[this.propName]) === 2) {
                            riesgo = 'Intermedio'
                        }
                        if (Number(this.patient_data[this.propName]) === 1) {
                            riesgo = 'De cuidado'
                        }
                    return /*html*/`
                        <b>
                            <i class='${this.getIcon}'></i>
                            ${this.title}:
                        </b>
                        ${riesgo}
                        <small class="${ [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName]) || [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName+'_description'])?'d-none':''}">
                            <br>
                            ${this.patient_data[this.propName+'_description']}
                        </small>
                    `
                },
                getColor(){
                    if (Number(this.patient_data[this.propName]) === 3 || this.patient_data[this.propName] === null) {
                        return 'success'
                    }
                    if (Number(this.patient_data[this.propName]) === 2) {
                        return 'warning'
                    }
                    if (Number(this.patient_data[this.propName]) === 1) {
                        return 'danger'
                    }

                },
                getIcon(){
                    if (Number(this.patient_data[this.propName]) === 3 || this.patient_data[this.propName] === null) {
                        return 'pc-alerta_estable'
                    }
                    if (Number(this.patient_data[this.propName]) === 2) {
                        return 'pc-alerta_intermedia'
                    }
                    if (Number(this.patient_data[this.propName]) === 1) {
                        return 'pc-alerta_alta'
                    }

                },
            },
            methods: {

                have_item(){
                        if (this.patient_data[this.propName] !== null) {
                            this.riesgo_value = Number(this.patient_data[this.propName])
                            this.riesgo_coment = this.patient_data[this.propName+'_description']
                        }else{
                            this.riesgo_value = 3
                            this.riesgo_coment = null
                        }
                        this.activateTooltip()
                },
                view1(){
                    return /*html */`
                        <div class="container-fluid py-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea
                                        class="form-control"
                                        placeholder="Escribe un comentario sobre tu selección. (Opcional)"
                                        rows="3"
                                        id="coment"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3">
                                    <a id="submit" class="btn btn-block btn-primary"  href="#" role="button">Guardar</a>
                                </div>
                            </div>
                        </div>
                    `;
                },
                destroyTooltip(){
                    let btn = document.querySelector('#'+this.propName+'_'+this.patient_data.user_id);
                        if (btn._tippy !==undefined) {

                            const instance= btn._tippy;
                            instance.destroy()
                        }
                },
                activateTooltip(){
                    this.destroyTooltip()
                    tippy('#'+this.propName+'_'+this.patient_data.user_id, {
                        content: this.getTooltipMessage,
                        theme: 'tooltip-cmdlt-'+this.getColor,
                        zIndex: 200000,
                        allowHTML: true,
                    });
                },
                async store(value){


                    this.riesgo_value = Number(value)
                    this.riesgo_coment =  document.getElementById('coment').value
                    let formData = new FormData();
                        formData.append("episodio_id", this.patient_data.episodio_id)
                        formData.append("alert", this.riesgo_value )
                        formData.append("user_id_paciente", this.patient_data.user_id)
                        formData.append("description", !is_empty( this.riesgo_coment ) ? this.riesgo_coment : null)
                        formData.append("created_at", timestamps() )
                        formData.append("_token", $("#_token").val())
                    let model = await post( location.origin+"/user_cuest_alert/store", formData)

                        this.patient_data[this.propName] = Number(this.riesgo_value)
                        this.patient_data[this.propName+'_description'] = this.riesgo_coment
                        pacientes_datos[this.index] = this.patient_data[this.propName]
                        this.have_item()
                        /* Swal.fire(
                            `Riesgo actualizado!`,
                            `La registro se hizo correctamente.`,
                            'success'
                        ) */


                        $("#messageModal").modal("hide")



                },
                create(value){
                    let that = this
                        $("#messageModal").modal("show")
                        $("#messageModal .modal-body").html( this.view1() );
                        document.getElementById('submit').addEventListener("click",(e)=>{
                           that.store(value)
                        })
                },
            },
            mounted () {

                this.have_item()

            },
        }
    }
    AppBtnPatientVip(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template: /*html*/ `
                <div class="dropdown">
                    <button
                        @click="create()"
                        :id="propName+'_'+patient_data.user_id"
                        class="btn btn-default p-1"
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i :class="[icon,('text-'+getColor),{'text-info':Number(riesgo_value)===1},{'text-info-disabled':Number(riesgo_value)===0}]"></i>
                    </button>

                </div>
            `,
            data() {
                return {
                    index:null,
                    icon:"pc-paciente_vip",
                    title:"VIP",
                    propName:"vip",
                    riesgo_coment:"",
                    riesgo_value:0,
                    riesgo_color:"",
                    item:[]
                }
            },
            computed: {
                getTooltipMessage(){
                    return /*html*/`
                        <b>
                            <i class='${this.icon}'></i>
                            ${this.title}:
                        </b>
                        <small class="${ [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName]) || [null,'null',undefined,'undefined',''].includes(this.patient_data[this.propName+'_description'])?'d-none':''}">
                            <br>
                            ${this.patient_data[this.propName+'_description']}
                        </small>
                    `
                },
                getColor(){
                    return 'info'
                    /* if (Number(this.patient_data[this.propName]) === 3 || this.patient_data[this.propName] === null) {
                        return 'success'
                    }
                    if (Number(this.patient_data[this.propName]) === 2) {
                        return 'warning'
                    }
                    if (Number(this.patient_data[this.propName]) === 1) {
                        return 'danger'
                    } */

                },

            },
            methods: {

                have_item(){
                        if (this.patient_data[this.propName] !== null) {
                            this.riesgo_value = Number(this.patient_data[this.propName])
                            this.riesgo_coment = this.patient_data[this.propName+'_description']
                        }else{
                            this.riesgo_value = 0
                            this.riesgo_coment = null
                        }
                        this.activateTooltip()
                },
                view1(){
                    return /*html */`
                        <div class="container-fluid py-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea
                                        class="form-control"
                                        placeholder="Escribe un comentario sobre tu selección. (Opcional)"
                                        rows="3"
                                        id="coment"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3">
                                    <a id="submit" class="btn btn-block btn-primary"  href="#" role="button">Guardar</a>
                                </div>
                            </div>
                        </div>
                    `;
                },
                destroyTooltip(){
                    let btn = document.querySelector('#'+this.propName+'_'+this.patient_data.user_id);
                        if (btn._tippy !==undefined) {

                            const instance= btn._tippy;
                            instance.destroy()
                        }
                },
                activateTooltip(){
                    this.destroyTooltip()
                    tippy('#'+this.propName+'_'+this.patient_data.user_id, {
                        content: this.getTooltipMessage,
                        theme: 'tooltip-cmdlt-'+this.getColor,
                        zIndex: 200000,
                        allowHTML: true,
                    });
                },
                async store(){



                    this.riesgo_coment =  document.getElementById('coment').value
                    let formData = new FormData();
                        formData.append("episodio_id", this.patient_data.episodio_id)
                        formData.append("value", this.riesgo_value )
                        formData.append("user_id_paciente", this.patient_data.user_id)
                        formData.append("description", !is_empty( this.riesgo_coment ) ? this.riesgo_coment : null)
                        formData.append("created_at", timestamps() )
                        formData.append("_token", $("#_token").val())
                    let model = await post( location.origin+"/user_vip/store", formData)
                        this.riesgo_value = Number(model.value)
                        console.log(model);
                        this.patient_data[this.propName] = Number(this.riesgo_value)
                        this.patient_data[this.propName+'_description'] = this.riesgo_coment
                        pacientes_datos[this.index] = this.patient_data[this.propName]
                        this.have_item()
                        /* Swal.fire(
                            `Riesgo actualizado!`,
                            `La registro se hizo correctamente.`,
                            'success'
                        ) */


                        $("#messageModal").modal("hide")



                },
                create(){
                    let that = this
                        $("#messageModal").modal("show")
                        $("#messageModal .modal-body").html( this.view1() );
                        document.getElementById('submit').addEventListener("click",(e)=>{
                           that.store()
                        })
                },
            },
            mounted () {

                this.have_item()

            },
        }

    }
    AppDataPaciente(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            components: {
                "app-paciente-vip": this.AppBtnPatientVip(),
                "app-riesgo-alerta": this.AppBtnRiesgoAlerta(),
                "app-riesgo-resbalar": this.AppBtnRiesgoCaida(),
                "app-riesgo-herida": this.AppBtnRiesgoHerida(),
                "app-tag-walkin": this.AppTagWalkin(),
                "app-tag-interconsulta": this.AppTagInterconsulta(),
                "app-tag-padel": this.AppTagPadel(),

            },
            template: /*html */ `
            <div class="d-flex flex-column">
                <div v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))" class="order-1 d-flex justify-content-end">
                    <app-riesgo-herida :patient_data="patient_data" :index="index"></app-riesgo-herida>
                    <app-riesgo-resbalar :patient_data="patient_data" :index="index"></app-riesgo-resbalar>
                    <app-riesgo-alerta :patient_data="patient_data" :index="index"></app-riesgo-alerta>
                    <app-paciente-vip :patient_data="patient_data" :index="index"></app-paciente-vip>
                </div>
                <div class="order-2 w-100  d-flex align-items-center">
                    <img
                        :src="patient_data.imagen"
                        onerror="this.src='/image/system/icono-paciente-blanco.svg'"
                        loading="lazy"
                        class="align-self-start ml-1 mt-1 img-user-circle"
                        alt="Imagen No Encontrada"
                    >
                    <div class="text-user-name text-primary text-uppercase pl-1">
                        {{patient_data.paciente}}
                    </div>
                </div>
                <div class="order-3 d-flex flex-column">

                    <div class="tag-box px-1 d-flex  align-items-center flex-wrap pb-1 text-uppercase">
                        <div
                            class="mt-1 badge d-flex align-items-center badge-primary mr-1"
                            style="font-size: 0.6rem; padding: 0.1rem;"
                        >
                            <i class="mx-1 fas fa-id-card"></i> <span style="font-size: 0.9rem; font-weight: 500;">{{patient_data.cedula_formated}}</span>
                        </div>
                        <div
                            class="mt-1 badge d-flex align-items-center badge-warning mr-1"
                            style="font-size: 0.6rem; padding: 0.1rem;"
                        >
                            <i class="mx-1 fas fa-birthday-cake"></i>
                            <span style="font-size: 0.9rem; font-weight: 500;">{{patient_data.edad}} A</span>
                        </div>
                        <div
                            :class="['mt-1 badge d-flex align-items-center mr-1 text-uppercase',(patient_data.genero ==='f' ? 'badge-pink': 'badge-primary')]"
                            style="font-size: 0.6rem; padding: 0.1rem;"
                        >
                            <i class="mx-1 fas fa-venus-mars"></i>
                            <span style="font-size: 0.9rem; font-weight: 500;">{{patient_data.genero}}</span>
                        </div>
                        <app-tag-walkin v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))" :patient_data="patient_data" :index="index"></app-tag-walkin>
                        <app-tag-padel v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))" :patient_data="patient_data" :index="index"></app-tag-padel>


                    </div>
                    <div>
                        <app-tag-interconsulta :patient_data="patient_data" :index="index"></app-tag-interconsulta>
                     
                       
                
                    </div>
                </div>

            </div>
        `,
        }
    }
    AppBtnSignosVitales(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <button
                    data-toggle="collapse"
                    :href="'#collapse'+index"
                    role="button"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                    class="d-xl-none btn btn-default btn-sm collapsed"
                >
                    <i class="pc-signos_vitales1 h3 text-danger"></i>
                </button>
            `,
        }
    }
    AppBtnInfoPaciente(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div :class="['px-1',{'flex-fill':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))}]">
                    <a
                        :id="'btn_infoPaciente_'+patient_data.user_id"
                        data-tippy-content="Datos del Paciente"
                        @click="handle_info_paciente()"
                        class="h4 cursor-pointer"
                    >
                        <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/info.svg">
                    </a>
                </div>
            `,
            methods: {
                handle_info_paciente() {
                    userCuestPaciente.edit('.modal-body',this.patient_data.user_id)
                }
            },
        }
    }
    AppBtnEpisodiosAnteriores(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div :class="['px-1',{'flex-fill':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))}]">
                    <a
                        :id="'btn_episodios_anteriores_'+patient_data.user_id"
                        @click="handle_episodios_anteriores()"
                        data-tippy-content="Historias anteriores"
                        class="h4 cursor-pointer"
                    >
                        <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-historia.png">
                    </a>
                </div>
            `,
            methods: {
                handle_episodios_anteriores() {
                    UserCuestEpisodio.historialEpisodios(this.patient_data,this.index)
                },
            },
        }
    }
    AppBtnReingreso(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div :class="['px-1',{'flex-fill':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))}]">
                    <a
                        :id="'btn_reingresar_'+patient_data.user_id"
                        @click="handle_reingresar()"
                        data-tippy-content="Reingresar"
                        class="h4 cursor-pointer"
                    >
                        <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-evolucion.svg">
                    </a>
                </div>
            `,
            methods: {
                handle_reingresar() {
                    Swal.fire({
                        title: "Reingreso del paciente",
                        text: "Esta acción creará un nuevo episodio.",
                        //allowOutsideClick: false,
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "De acuerdo!",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                     
                            UserCuestUbicacion.reingreso('.modal-body',this.patient_data.user_id)

                        }
                    });
                },
            },
        }
    }
    AppBtnRestablecerEpisodio(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            data() {
                return {
                    items:pacientes_datos,
                }
            },
            template:/*HTML */`
                <div :class="['px-1',{'flex-fill':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))}]">
                    <a
                        :id="'btn_restablecer_'+patient_data.user_id"
                        @click="handle_restablecer()"
                        title="Restablecer Episodio"
                        class="h4 mb-0 cursor-pointer text-primary"
                    >
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            `,
            created() {
                let that = this
                // Escuchar cambios en el bus de eventos
                EventBus.$on('externalVarChanged', (newValue) => {
                    that.items = newValue;
                });
            },
            methods: {
                handle_restablecer() {
                    let that = this
                    Swal.fire({
                        title: "Restablecer el episodio",
                        text: "Esta acción cerrará otros episodios activos.",
                        //allowOutsideClick: false,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "De acuerdo!",
                        cancelButtonText: "Cancelar"
                    }).then(async(result) => {
                        if (result.isConfirmed) {
                            let formdata = new FormData();
                                formdata.append("episodio_id", this.patient_data.episodio_id)
                                formdata.append("user_id", this.patient_data.user_id)
                                formdata.append("_token", d.querySelector("#_token").value)
                            let model = await post(location.origin+"/user_cuest_episodio/restablecer_episodio", formdata)
                            if (model.success ) {
                                pacientes_datos = that.items.filter(item => item.episodio_id !== this.patient_data.episodio_id);
                                EventBus.$emit('externalVarChanged', pacientes_datos);
                                
                            }
                            console.log(model);
                           

                        }
                    });
                },
            },
        }
    }
    AppBtnInfoAdministrativa(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div class="flex-fill px-1">
                    <div class="btn-group">
                        <a
                            @click="handle_info_administrativa()"
                            href="#"
                            class="heartbeat"
                            style="width: 30px;height: 30px;"
                            data-display="static"
                            aria-haspopup="true"
                            data-tippy-content="Datos Administrativos"
                            aria-expanded="false"
                        >
                            <i class="pc-info_administracion_solid  text-purple h3 mb-0"></i>
                        </a>
                    </div>
                </div>
            `,
            methods: {
                handle_info_administrativa() {
                    console.log(this.patient_data);
                    //UserCuestAdministracion.index( this.patient_data.episodio_id )
                    AppAdministrativeData( this.patient_data,this.index )
                }
            },
        }
    }
    AppBtnEvolucion(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div :class="['px-1',{'flex-fill':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))}]">
                    <a
                        :id="'btn_evolucion_'+patient_data.user_id"
                        @click="handle_evolucion()"
                        data-tippy-content="Evoluciones"
                        class="h4 cursor-pointer"
                    >
                        <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-evolucion.svg">
                    </a>
                </div>
            `,
            methods: {
                handle_evolucion() {
                    userCuestHistoria.index(this.patient_data,this.index)
                    //UserCuestHistoria.index('.modal-body',this.patient_data.user_id)
                }
            },
        }
    }
    AppBtnPendientes(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div class="flex-fill px-1">
                    <div
                        class="heartbeat d-flex"
                        style="position: relative;cursor:pointer;"
                        data-tippy-content="Pendientes"
                        @click="handle_pendientes"
                    >
                        <img style="height: 35px;width: 33px;" src="/image/system/todolist.svg">
                        <span v-if="containTasks" data-tippy-content="Total Pendientes" class="badge rounded-circle badge-danger align-self-start" style="font-size: 0.6rem;">
                            {{patient_data.t_pendiente}}
                        </span>



                    </div>
                </div>
            `,
            computed: {
                containTasks() {
                    return this.patient_data.t_pendiente > 0 ?true : false
                }
            },
            methods: {
                handle_pendientes() {
                    userCuestPendiente.index('.modal-body',this.patient_data.user_id)
                }
            },
        }
    }
    AppBtnChatWhatsapp(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div class="flex-fill px-1">
                    <div
                        class="heartbeat"
                        style="position: relative;cursor:pointer;"
                        data-tippy-content="Whatsapp"
                        @click="handle_chat_whatsapp"
                    >
                        <img style="height: 35px;width: 35px;" src="/image/system/ws.png">
                    </div>
                </div>
            `,
            methods: {
                handle_chat_whatsapp() {
                    UserCuestChat(this.patient_data,this.index)
                }
            },
        }
    }
    AppBtnHistoria(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div :class="['px-1',{'flex-fill':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))}]">
                    <div class="btn-group">
                        <a
                            href="#"
                            data-toggle="dropdown"
                            data-display="static"
                            aria-haspopup="true"
                            data-tippy-content="Historia del Paciente"
                            aria-expanded="false"
                            class="d-flex "
                        >
                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-historia.png">
                            <span v-if="containEpisodes" title="Total Episodios" class="badge rounded-circle badge-info align-self-start" style="font-size: 0.6rem;">
                                {{patient_data.total_episodios}}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right">
                            <a
                                @click="handle_historia_inicial()"
                                data-tippy-content="Historia de Ingreso"
                                class="dropdown-item cursor-pointer"
                            >
                                <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/h_inicial.svg"> Historia Inicial
                            </a>
                            <a
                                @click="handle_episodios_anteriores()"
                                data-tippy-content="Historias anteriores"
                                class="dropdown-item cursor-pointer"
                            >
                                <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/h_episodios.svg"> Episodios anteriores
                                <span v-if="containEpisodes" title="Total Episodios" class="badge rounded-circle badge-info align-self-start" style="font-size: 0.6rem;">
                                    {{patient_data.total_episodios}}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            `,
            computed: {
                containEpisodes() {
                    return this.patient_data.total_episodios > 0 ? true : false
                }
            },
            methods: {
                handle_historia_inicial() {
                    create_historia_inicial(this.patient_data,this.index)
                },
                handle_episodios_anteriores() {
                    UserCuestEpisodio.historialEpisodios(this.patient_data,this.index)
                },
            },
        }
    }
    AppBtnGroup2(){
        let that = this
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            data() {
                return {
                    user_id_medico: null
                }
            },
            components: {
                'app-btn-signos-vitales':that.AppBtnSignosVitales(),
                'app-btn-info-paciente':that.AppBtnInfoPaciente(),
                'app-btn-episodios-anteriores':that.AppBtnEpisodiosAnteriores(),
                'app-btn-reingreso':that.AppBtnReingreso(),
                'app-btn-restablecer-episodio':that.AppBtnRestablecerEpisodio(),
                'app-btn-info-administrativa':that.AppBtnInfoAdministrativa(),
                'app-btn-historia':that.AppBtnHistoria(),
                'app-btn-evolucion':that.AppBtnEvolucion(),
                'app-btn-pendientes':that.AppBtnPendientes(),
                'app-btn-chat-whatsapp':that.AppBtnChatWhatsapp(),
            },
            template:/*html*/ `
                <div :class="[
                    'd-flex flex-nowrap align-items-center mb-2  text-center',
                    {' justify-content-left':['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                    {' justify-content-around':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                    ]">
                    <app-btn-signos-vitales 
                        v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index" 
                    />
                    <app-btn-info-paciente 
                        :patient_data="patient_data" 
                        :index="index" 
                    />
                    <app-btn-episodios-anteriores 
                        v-if="['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index" 
                    />
                    <app-btn-reingreso 
                        v-if="['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index" 
                    />
                    <app-btn-info-administrativa 
                        v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index" 
                    />
                    <app-btn-historia 
                        v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index" 
                    />
                    <app-btn-evolucion 
                        v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index"
                    />
                    <app-btn-pendientes 
                        v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index"
                    />
                    <app-btn-chat-whatsapp 
                        v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))"
                        :patient_data="patient_data" 
                        :index="index"
                    /> 
                    <app-btn-restablecer-episodio
                        v-if="['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area')) && 
                        [
                            2523, //andrea
                            2501, // teresa
                            19, // parodi
                            22, //pruebas
                            19092 //gabriel
                        ].includes(user_id_medico)"
                        :patient_data="patient_data" 
                        :index="index"
                    />

                </div>
            `,
            mounted () {
                this.user_id_medico = Number(userIdMedico);
            },
        }
    }
    AppTagWalkin(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div
                    :id="'badge_walkin_'+patient_data['user_id']"
                    :class="[getVisibility(),'mt-1 mr-1 badge font-italic',getTextColor()]"
                    style=" font-size: 0.8rem;"
                >
                    <i :class="['pc-servicio_walkin ',getTextColor2()]"></i> {{patient_data['servicio_emergencia']['description']}}
                </div>
            `,
            methods: {
                getVisibility() {
                    return [1,2,3,4,5,6].includes( Number( this.patient_data['servicio_emergencia']['value']) ) ? '' : 'd-none'
                },
                getTextColor2() {
                    return [1,2,3,4,5].includes( Number( this.patient_data['servicio_emergencia']['value']) ) ? 'text-white' : 'text-secondary'
                },
                getTextColor(){
                    return 'badge-'+this.patient_data['servicio_emergencia']['color']
                }
            },
        }
    }
    AppTagInterconsulta(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            data() {
                return {
                    selector:null,
                    tippyInstance:null,
                    propName: "tag_interconsulta"
                }
            },
            template:/*HTML */`
             
                <div 
                    v-if="patient_data.interconsultation_request.filter(x=>!x.fecha_confirmacion).length > 0"
                    :id="'tag_interconsulta_'+patient_data['episodio_id']"
                    :class="['card-medic-team-active d-flex align-items-center']"
                    style="
                        border: 1px solid #dfdcdc;
                        border-radius: 5px;
                        margin: 0 0 5px 5px;
                        width: fit-content;
                        padding: 0 5px;
                        cursor: default;
                    "
                >
                    <!--<i class="far fa-bell text-info mx-1 ping"></i>-->
                    <div class="badge badge-info medico-badge-width scale-in-hor-left">IN</div>
                    <img loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1" onerror="this.src='/image/system/patient.svg'" src="/image/system/patient.svg">
                    <b class="text-nowrap text-dark">
                        {{getLastInterconsultation()}} 
                        <span class="badge mb-1 font-weight-bold text-info">
                            {{patient_data.interconsultation_request.filter(x=>!x.fecha_confirmacion).length > 1 ? '+' + (patient_data.interconsultation_request.filter(x=>!x.fecha_confirmacion).length-1) : ''}}
                        </span>
                    </b>
                    
                </div>
            `,
         
            methods: {
            
       
                getLastInterconsultation(){
                    let lastMedic = this.patient_data.interconsultation_request.filter(x=>!x.end_date)[0] // cero porque esta ordenado descendente el arreglo
                    return lastMedic.medico
                },
                
                
              
            },
            mounted () {
                this.selector = document.querySelector('#'+this.propName+'_'+this.patient_data.episodio_id)
           
            },
        }
    }
    AppTagPadel(){
        return {
            props:{
                patient_data:Object,
                index:Number,
            },
            template:/*HTML */`
                <div
                    :id="'badge_padel_'+patient_data['user_id']"
                    :class="[getVisibility(),'mt-1 mr-1 badge font-italic badge-orange text-white']"
                    style=" font-size: 0.8rem;"
                >
                    <i class="pc-padel"></i> Padel Fest 3
                </div>
            `,
            methods: {
                getVisibility() {
                    return [429].includes( Number( this.patient_data['cat_user_ubicacion_id'] ) ) ?'':'d-none'
                },
            },
        }
    }
    AppFormTemperatura(){
        return {
            props:{
                patient_data:Object,
                index:Number,
                fnOnEnter:Function,
                myInputValue:Number,
                myInputValue2:Number,
                myInputValue3:Number,
            },
            data() {
                return {
                    unidadMedida:"°C",
                    siglas: "temp",
                }
            },
            template:/*HTML */`
                <div class="col-12 p-0 col-xl rounded d-flex  flex-xl-column border">
                    <div
                        @click="handle_item()"
                        class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                    >
                        {{siglas}}
                    </div>
                    <input
                        :id="siglas+'_'+patient_data['user_id']"
                        @keyup.enter="handleEnterKey('fr')"
                        v-model="inputValue"
                        type="text"
                        class="shadow-inset-center w-100 text-center input-full-height border-0"
                    >
                    <div
                        @click="handle_item()"
                        class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"
                    >
                        <span
                            v-if="!['nc','sc',null,'','NaN','NaN/NaN'].includes(patient_data[siglas])"
                            :class="[getColor(),'text-nowrap']">{{patient_data[siglas]}} {{unidadMedida}}
                        </span>
                    </div>
                </div>
            `,
            computed: {
                // Crear un modelo computado para la props `value`
                inputValue: {
                  get() {
                    return this.myInputValue;
                  },
                  set(newValue) {
                    // Emitir un evento llamado 'input' con el nuevo valor
                    this.$emit('input', newValue);
                  }
                },

              },
            methods: {
                handleEnterKey(siglas){
                    this.fnOnEnter(siglas)
                },
                handle_item() {
                    UserCuestTemperatura.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                getColor(){
                    return UserCuestTemperatura.colorTemp(this.patient_data[this.siglas])
                }
            },
        }
    }
    AppFormFrecuenciaRespiratoria(){
        return {
            props:{
                patient_data:Object,
                index:Number,
                fnOnEnter:Function,
                myInputValue:Number,
            },
            data() {
                return {
                    unidadMedida:"resp/min",
                    siglas: "fr",
                }
            },
            template:/*HTML */`
                <div class="col-12 p-0 col-xl rounded d-flex  flex-xl-column border">
                    <div
                        @click="handle_item()"
                        class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                    >
                        {{siglas}}
                    </div>
                    <input
                        :id="siglas+'_'+patient_data['user_id']"
                        @keyup.enter="handleEnterKey('fc')"
                        v-model="inputValue"
                        type="text"
                        class="shadow-inset-center w-100 text-center input-full-height border-0"
                    >
                    <div
                        @click="handle_item()"
                        class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"
                    >
                        <span
                            v-if="!['nc','sc',null,'','NaN','NaN/NaN'].includes(patient_data[siglas])"
                            :class="[getColor(),'text-nowrap']">{{patient_data[siglas]}} {{unidadMedida}}
                        </span>
                    </div>
                </div>
            `,
            computed: {
                // Crear un modelo computado para la props `value`
                inputValue: {
                  get() {
                    return this.myInputValue;
                  },
                  set(newValue) {
                    // Emitir un evento llamado 'input' con el nuevo valor
                    this.$emit('input', newValue);
                  }
                }
              },
            methods: {
                handleEnterKey(siglas){
                    this.fnOnEnter(siglas)
                },
                handle_item() {
                    UserCuestFr.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                getColor(){
                    return UserCuestFr.colorFr(this.patient_data[this.siglas])
                }
            },
        }
    }
    AppFormFrecuenciaCardiaca(){
        return {
            props:{
                patient_data:Object,
                fnOnEnter:Function,
                index:Number,
                myInputValue:Number,
            },
            data() {
                return {
                    unidadMedida:"lat/min",
                    siglas: "fc",
                }
            },
            template:/*HTML */`
                <div class="col-12 p-0 col-xl rounded d-flex  flex-xl-column border">
                    <div
                        @click="handle_item()"
                        class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                    >
                        {{siglas}}
                    </div>
                    <input
                        :id="siglas+'_'+patient_data['user_id']"
                        @keyup.enter="handleEnterKey('tasis')"
                        v-model="inputValue"
                        type="text"
                        class="shadow-inset-center w-100 text-center input-full-height border-0"
                    >
                    <div
                        @click="handle_item()"
                        class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"
                    >
                        <span
                            v-if="!['nc','sc',null,'','NaN','NaN/NaN'].includes(patient_data[siglas])"
                            :class="[getColor(),'text-nowrap']">{{patient_data[siglas]}} {{unidadMedida}}
                        </span>
                    </div>
                </div>
            `,
            computed: {
                // Crear un modelo computado para la props `value`
                inputValue: {
                  get() {
                    return this.myInputValue;
                  },
                  set(newValue) {
                    // Emitir un evento llamado 'input' con el nuevo valor
                    this.$emit('input', newValue);
                  }
                }
              },
            methods: {
                handleEnterKey(siglas){
                    this.fnOnEnter(siglas)
                },
                handle_item() {
                    UserCuestFc.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                getColor(){
                    return UserCuestFc.colorFc(this.patient_data[this.siglas])
                }
            },
        }
    }
    AppFormTensionArterial(){
        return {

            data() {
                return {
                    unidadMedida:"mmHg",
                    siglas: "ta",
                }
            },
            template:/*html */ `
                <div class="col-12 p-0 col-xl-2 rounded d-flex flex-xl-column border">
                    <div
                        @click="handle_item()"
                        class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                    >
                        {{siglas}}
                    </div>
                    <div class="w-100 flex-lg-fill d-flex flex-column">
                        <input
                            :id="'tasis_'+patient_data['user_id']"
                            @keyup.enter="handleEnterKey('tadia')"
                            v-model="input1"
                            @input="onInputChange('tasis', input1)"
                            type="text"
                            placeholder="Sis"
                            class="shadow-inset-center w-100 text-center input-full-height border-0"
                        >
                        <hr class="border-top m-0">
                        <input
                            :id="'tadia_'+patient_data['user_id']"
                            @keyup.enter="handleEnterKey('oxi')"
                            v-model="input2"
                            @input="onInputChange('tadia', input2)"
                            type="text"
                            placeholder="Dia"
                            class="shadow-inset-center w-100 text-center input-full-height border-0"
                        >
                        <div class="flex-fill flex-column d-flex justify-content-center align-items-center text-secondary bg-light px-1">
                            <div>
                                {{input3}}
                            </div>
                            <div class="mt-auto" style="font-size:0.7rem;">
                                Media
                            </div>

                        </div>


                    </div>
                    <div
                        @click="handle_item()"
                        class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"
                    >
                        <span
                            v-if="!['nc','sc',null,'','NaN','NaN/NaN'].includes(patient_data[siglas])"
                            :class="[getColor(),'text-nowrap']">{{patient_data[siglas]}} {{unidadMedida}}
                        </span>
                    </div>

                </div>
            `,
            props:{
                patient_data:Object,
                fnOnEnter:Function,
                index:Number,
                input1: {
                    type: Number,
                    required: true
                },
                input2: {
                    type: Number,
                    required: true
                },
                input3: {
                    type: Number,
                    required: true
                },

            },
            computed: {
                getValues() {
                    let temCurrentValue = this.patient_data[this.siglas] === null ? [0,0] :  this.patient_data[this.siglas].split("/").map(x=>Number(x))

                        return {
                            dia:temCurrentValue[0],
                            sys:temCurrentValue[1]
                        }
                }
            },
            methods: {
                handleEnterKey(siglas){
                    this.fnOnEnter(siglas)
                },
                onInputChange(inputName, newValue) {
                    // Emite un evento con el nombre del input y su nuevo valor
                    this.$emit('input-change', { inputName, newValue });
                },
                handle_item() {
                    UserCuestTa.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                getColor(){ //UserCuestTa.colorTa(cadena[0],cadena[1])
                    let temCurrentValue = this.patient_data[this.siglas] === null ? [0,0] :  this.patient_data[this.siglas].split("/").map(x=>Number(x))
                        return UserCuestTa.colorTa(temCurrentValue[0],temCurrentValue[1])
                }
            },
        }
    }
    AppFormOximetria(){
        return {
            props:{
                patient_data:Object,
                fnOnEnter:Function,
                index:Number,
                myInputValue:Number,
            },
            data() {
                return {
                    unidadMedida:"%",
                    siglas: "oxi",
                }
            },
            template:/*HTML */`
                <div class="col-12 p-0 col-xl rounded d-flex  flex-xl-column border">
                    <div
                        @click="handle_item()"
                        class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                    >
                        {{siglas}}
                    </div>
                    <input
                        :id="siglas+'_'+patient_data['user_id']"
                        @keyup.enter="handleEnterKey('gl')"
                        v-model="inputValue"
                        type="text"
                        class="shadow-inset-center w-100 text-center input-full-height border-0"
                    >
                    <div
                        @click="handle_item()"
                        class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"
                    >
                        <span
                            v-if="!['nc',,null,'','NaN','NaN/NaN'].includes(patient_data[siglas])"
                            :class="[getColor(),'text-nowrap']">{{patient_data[siglas]}} {{unidadMedida}}
                        </span>
                    </div>
                </div>
            `,
            computed: {
                // Crear un modelo computado para la props `value`
                inputValue: {
                  get() {
                    return this.myInputValue;
                  },
                  set(newValue) {
                    // Emitir un evento llamado 'input' con el nuevo valor
                    this.$emit('input', newValue);
                  }
                }
              },
            methods: {
                handleEnterKey(siglas){
                    this.fnOnEnter(siglas)
                },
                handle_item() {
                    UserCuestOximetria.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                getColor(){
                    return UserCuestOximetria.colorOxi(this.patient_data[this.siglas])
                }
            },
        }
    }
    AppFormSintomas(){
        return {
            props:{
                patient_data:Object,
                /* fnOnEnter:Function, */
                index:Number,
                /* myInputValue:Number, */
            },
            template:/*HTML */`
                <div class="col-12 p-0 col-xl rounded d-flex  flex-column border">
                    <div class="d-flex justify-content-between">
                        <div
                            @click="handle_item()"
                            class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                        >
                            Síntomas
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu py-0">
                                <input placeholder="Escribe un sintoma" :ref="'searchInput'+patient_data.user_id" type="text" @keypress="filterValues()" class="form-control rounded-0 border-0 bg-light">
                                <div :ref="'myList'+patient_data.user_id" class="overflow-auto" style="max-height: 200px;">
                                    <a
                                        v-for="(item,index) in getSintomas"
                                        :key="'sintoma_'+index"
                                        class="dropdown-item"
                                        href="#"
                                        @click="addItem(item.id)"
                                    >
                                        {{item.description}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex flex-fill bg-white flex-wrap align-items-center p-1 rounded my-1" style="overflow: auto;max-height: 108px;">
                        <span v-for="(item,index) in registred" :key="index" style="font-size: 1rem;" class="badge badge-gray text-dark mb-1 mr-1 d-flex justify-content-between">
                            <span>{{item.description}}</span>
                            <button
                                class="border-0 bg-transparent text-white"
                                @click="deleteItem(item.id)"
                            >
                                x
                            </button>
                        </span>
                    </div>

                </div>
            `,
            data() {
                return {
                    registred:[],
                    sintomas:[
                        {
                            'id':12,
                            'description':'Adenopatias'
                        },
                        {
                            'id':14,
                            'description':'Anosmia'
                        },
                        {
                            'id':13,
                            'description':'Artralgias'
                        },
                        {
                            'id':17,
                            'description':'Cefalea'
                        },
                        {
                            'id':195,
                            'description':'Diaforesis'
                        },
                        {
                            'id':18,
                            'description':'Diarrea'
                        },
                        {
                            'id':19,
                            'description':'Disfagia'
                        },
                        {
                            'id':4,
                            'description':'Disfonia'
                        },
                        {
                            'id':5,
                            'description':'Dolor cervical'
                        },
                        {
                            'id':194,
                            'description':'Dolor lumbar'
                        },
                        {
                            'id':100,
                            'description':'Eritema'
                        },
                        {
                            'id':16,
                            'description':'Epistaxis'
                        },
                        {
                            'id':1,
                            'description':'Disgeusia'
                        },
                        {
                            'id':112,
                            'description':'Palidez'
                        },
                        {
                            'id':27,
                            'description':'Vómitos'
                        },
                        {
                            'id':20,
                            'description':'Disnea'
                        },
                        {
                            'id':21,
                            'description':'Dolor abdominal'
                        },
                        {
                            'id':22,
                            'description':'Dolor torácico'
                        },
                        {
                            'id':196,
                            'description':'Edema MI'
                        },
                        {
                            'id':24,
                            'description':'Fatiga'
                        },
                        {
                            'id':25,
                            'description':'Fiebre'
                        },
                        {
                            'id':26,
                            'description':'Hemoptisis'
                        },
                        {
                            'id':28,
                            'description':'Hipo'
                        },
                        {
                            'id':29,
                            'description':'Mialgias'
                        },
                        {
                            'id':30,
                            'description':'Náuseas'
                        },
                        {
                            'id':31,
                            'description':'Odinofagia'
                        },
                        {
                            'id':33,
                            'description':'Rinorrea'
                        },
                        {
                            'id':34,
                            'description':'Tos Productiva'
                        },
                        {
                            'id':35,
                            'description':'Tos seca'
                        },
                        {
                            'id':36,
                            'description':'Otros'
                        },
                    ],
                    loading:document.getElementById('loadingScreen'),
                }
            },
            computed: {
                getSintomas() {
                    let that = this
                    return this.sintomas.filter(item=> {
                        let is_registred = that.registred.find(x=> x.id === item.id)
                            if(is_registred === undefined){
                                return item
                            }
                    } )
                },

            },
            methods: {
                filterValues(){
                    let searchInput = this.$refs['searchInput'+this.patient_data.user_id];

                        let searchText = searchInput.value.toLowerCase();
                        let listItems = this.$refs[`myList${this.patient_data.user_id}`].querySelectorAll("a");
                            console.log(listItems);
                            listItems.forEach(function(item) {
                                let itemText = item.textContent.toLowerCase();
                                item.style.display = itemText.includes(searchText) ? "block" : "none";
                            });

                },
                async addItem(id){
                    let is_registred = this.registred.find(x=> x.id === id)
                        if(is_registred === undefined){
                            let item = this.sintomas.find(x=> x.id === id)
                            this.registred.push( item )
                        }
                    await this.store()



                   // console.log(id);
                },
                async store(){
                    this.loading.classList.remove("d-none")
                    //[{"name":"model[]","value":"208"},{"name":"model[]","value":"223"},{"name":"model[]","value":"250"}]
                    let model = this.registred.map(item=>{
                            return {"value":item.id}
                        })
                    let value = JSON.stringify(model);

                    let formdata = new FormData();
                    let created_at = timestamps();

                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("model", value)

                    formdata.append("since", created_at)
                    formdata.append("sintoma_nuevo", null)
                    formdata.append("created_at", created_at)
                    formdata.append("sintoma_observacion", "")
                    formdata.append("_token", $("#_token").val())

                    await post( location.origin+"/user_cuest_sintoma/store", formdata)
                    this.loading.classList.add("d-none")
                },
                handle_item() {
                    UserCuestSintoma.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                async destroy(id) {
                    let formdata = new FormData();
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("cat_user_cuestionario_id", id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                    return await post( location.origin+"/user_cuest_sintoma/destroy2", formdata)
                },
                async deleteItem(id){
                    this.loading.classList.remove("d-none")
                    this.registred= this.registred.filter(x=> x.id !== id)
                    await this.destroy(id, this.patient_data.user_id)
                    this.loading.classList.add("d-none")
                }
            },
            async mounted () {
                //console.log(this.patient_data.sintoma);
                if(this.patient_data.sintoma !== "") {
                    let sintomas= this.patient_data.sintoma.split(",").map(x=>x.trim());
                    //console.log("sintomas registrados",sintomas);
                    this.registred = this.sintomas.filter(item=> {

                        if(sintomas.includes( item.description)){
                            return item
                        }
                    } )
                    //console.log(this.registred);
                }


            },
        }
    }
    AppFormGlicemia(){
        return {

            data() {
                return {
                    unidadMedida:"mg/dL",
                    siglas: "gl",
                }
            },
            template:/*html */ `
                <div class="col-12 p-0 col-xl-2 rounded d-flex flex-xl-column border">
                    <div
                        @click="handle_item()"
                        class="w-custom-1 text-uppercase btn btn-outline-gray border-0"
                    >
                        {{siglas}}
                    </div>
                    <div class="w-100 flex-lg-fill d-flex flex-column">
                        <input
                            :id="siglas+'_'+patient_data['user_id']"
                            @keyup.enter="handleEnterKey('insulina')"
                            v-model="input1"
                            @input="onInputChange('gl', input1)"
                            type="text"
                            placeholder="mg/dL"
                            class="shadow-inset-center w-100 text-center input-full-height border-0"
                        >
                        <hr class="border-top m-0">
                        <input
                            :id="'insulina_'+patient_data['user_id']"
                            @keyup.enter="handleEnterKey('created_at')"
                            v-model="input2"
                            @input="onInputChange('unidades_insulina', input2)"
                            type="text"
                            placeholder="Insulina"
                            class="shadow-inset-center w-100 text-center input-full-height border-0"
                        >
                    </div>
                    <div
                        @click="handle_item()"
                        class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center"
                    >
                        <div
                            v-if="!['nc','sc',null,'','NaN','NaN/NaN'].includes(patient_data[siglas])"
                            :class="[getColor(),'text-nowrap flex-fill text-center border-right']"> {{ ![NaN,'NaN',null,'null',undefined].includes( patient_data[siglas] ) ? patient_data[siglas] +' '+unidadMedida : '' }}
                        </div>
                        <div
                            v-if="![null,'','NaN','NaN/NaN'].includes(patient_data['unidades_insulina'])"
                            :class="['text-nowrap text-secondary flex-fill text-center']">{{ ![NaN,'NaN',null,'null',undefined].includes(patient_data['unidades_insulina']) ? patient_data['unidades_insulina']+' UI' : '' }}
                        </div>
                    </div>

                </div>
            `,
            props:{
                patient_data:Object,
                fnOnEnter:Function,
                index:Number,
                input1: {
                    type: Number,
                    required: true
                },
                input2: {
                    type: Number,
                    required: true
                },


            },

            methods: {
                handleEnterKey(siglas){
                    this.fnOnEnter(siglas)
                },
                onInputChange(inputName, newValue) {
                    // Emite un evento con el nombre del input y su nuevo valor
                    this.$emit('input-change', { inputName, newValue });
                },
                handle_item() {
                    UserCuestGl.index('.modal-body',this.patient_data.user_id,this.patient_data.episodio_id)
                },
                getColor(){ //UserCuestTa.colorTa(cadena[0],cadena[1])
                        return UserCuestGl.colorGl(this.patient_data[this.siglas])
                }
            },
        }
    }
    AppFormVitalSigns(){
        return {
            template:/*html */ `
                <div class="d-flex flex-wrap flex-xl-nowrap" style="height: 100%;gap: 4px;">
                    <app-form-temperatura
                        v-model="form.temp"
                        :fnOnEnter="changeNextInput"
                        :patient_data="patient_data"
                        :index="index"
                    ></app-form-temperatura>
                    <app-form-frecuencia-respiratoria
                        v-model="form.fr"
                        :fnOnEnter="changeNextInput"
                        :patient_data="patient_data"
                        :index="index"
                    ></app-form-frecuencia-respiratoria>
                    <app-form-frecuencia-cardiaca
                        v-model="form.fc"
                        :fnOnEnter="changeNextInput"
                        :patient_data="patient_data"
                        :index="index"
                    ></app-form-frecuencia-cardiaca>
                    <app-form-tension-arterial
                        :fnOnEnter="changeNextInput"
                        :input1="form.tasis"
                        :input2="form.tadia"
                        :input3="form.tamedia"
                        @input-change="handleInputChange"
                        :patient_data="patient_data"
                        :index="index"
                    ></app-form-tension-arterial>
                    <app-form-oximetria
                        :fnOnEnter="changeNextInput"
                        v-model="form.oxi"
                        :patient_data="patient_data"
                        :index="index"
                    ></app-form-oximetria>
                    <app-form-glicemia
                        :fnOnEnter="changeNextInput"
                        :input1="form.gl"
                        :input2="form.unidades_insulina"
                        :patient_data="patient_data"
                        :index="index"
                        @input-change="handleInputChange"
                    ></app-form-glicemia>
                    <app-form-sintomas

                        :patient_data="patient_data"
                        :index="index"

                    ></app-form-sintomas>
                    <div class="col-12 col-sm col-xl p-0 rounded d-flex  justify-content-between flex-column">

                            <input
                                :id="'created_at_'+patient_data['user_id']"
                                @keyup.enter="changeNextInput('time')"
                                type="date"
                                v-model="created_at"
                                class="form-control text-center input-full-height "
                            >
                            <input
                                :id="'time_'+patient_data['user_id']"
                                @keyup.enter="changeNextInput('submit')"
                                type="time"
                                v-model="time"
                                class="form-control mt-1 text-center input-full-height "
                            >

                        <button
                            :id="'submit_'+patient_data['user_id']"
                            @click="submitForm()"
                            class="btn btn-outline-success mt-1 w-100 btn-sm"
                        >
                            Guardar todo
                        </button>
                        <a
                            :href="'/user/informe/signos_vitales/'+patient_data.episodio_id"
                            target="_blank"
                            class="btn btn-outline-primary mt-1 w-100 btn-sm"
                        >
                            Imprimir Signos Vitales
                        </a>
                    </div>
                </div>
            `,

            data() {
                return {
                    form:{
                        temp:"",
                        fr:"",
                        fc:"",
                        tasis:"",
                        tadia:"",
                        tamedia:"",
                        oxi:"",
                        gl:"",
                        unidades_insulina:"",
                    },
                    time:"",
                    realTime:"",
                    created_at:this.fechaInputDate()
                }
            },
            components: {
                'app-form-sintomas':this.AppFormSintomas(),
                'app-form-temperatura':this.AppFormTemperatura(),
                'app-form-frecuencia-respiratoria':this.AppFormFrecuenciaRespiratoria(),
                'app-form-frecuencia-cardiaca':this.AppFormFrecuenciaCardiaca(),
                'app-form-tension-arterial':this.AppFormTensionArterial(),
                'app-form-oximetria':this.AppFormOximetria(),
                'app-form-glicemia':this.AppFormGlicemia(),
            },
            props:{
                patient_data:Object,
                index:Number,
            },
            computed: {
                calculateTamedia(){

                    let temp_tasis = this.form.tasis === "" ? 0 : Number(this.form.tasis)
                    let temp_tadia = this.form.tadia === "" ? 0 : Number(this.form.tadia)
                        console.log('temp_tasis:', temp_tasis,'temp_tadia:',temp_tadia);
                        //PAS + (2 × PAD)/3
                        this.form.tamedia = (temp_tasis + (2 * temp_tadia)) / 3
                        this.form.tamedia = this.form.tamedia.toFixed(2)
                        return this.form.tamedia

                },
            },

            methods: {
                changeNextInput(siglas){
                    document.querySelector('#'+siglas+'_'+this.patient_data.user_id).focus()
                },
                handleInputChange({ inputName, newValue }) {
                    this.form[inputName] = Number(newValue);
                    if( ['tasis','tadia'].includes( inputName ) ){
                        this.calculateTamedia
                    }

                },
                async storeSign({ inputName, newValue,route= "" }) {
                    let formdata = new FormData();
                        formdata.append(inputName, newValue)

                        formdata.append("episodio_id", this.patient_data.episodio_id)
                        formdata.append("user_id", this.patient_data.user_id)
                        formdata.append("sintoma_observacion", "")
                        formdata.append("created_at", `${this.created_at} ${this.realTime}` )
                        formdata.append("_token", $("#_token").val())
                    let result = await post(location.origin + route, formdata)
                },
                async storeSign2({ route= "" }) {
                    let formdata = new FormData();
                        formdata.append("value",this.form.tasis)
                        formdata.append("value2", this.form.tadia)
                        formdata.append("media", this.form.tamedia)
                        formdata.append("episodio_id", this.patient_data.episodio_id)
                        formdata.append("user_id", this.patient_data.user_id)
                        formdata.append("sintoma_observacion", "")
                        formdata.append("created_at", `${this.created_at} ${this.realTime}` )
                        formdata.append("_token", $("#_token").val())
                    let result = await post(location.origin + route, formdata)
                },
                async storeSign3({ route= "" }) {
                    let formdata = new FormData();
                        formdata.append("value",this.form.gl)
                        formdata.append("unidades_insulina", this.form.unidades_insulina)
                        formdata.append("episodio_id", this.patient_data.episodio_id)
                        formdata.append("user_id", this.patient_data.user_id)
                        formdata.append("sintoma_observacion", "")
                        formdata.append("created_at", `${this.created_at} ${this.realTime}` )
                        formdata.append("_token", $("#_token").val())
                    let result = await post(location.origin + route, formdata)
                },

                async submitForm(){
                    let currentTime = new Date()
                    this.realTime = this.time === "" ? `${currentTime.getHours().toString().padStart(2, '0')}:${currentTime.getMinutes().toString().padStart(2, '0')}:${currentTime.getSeconds().toString().padStart(2, '0')}` : `${this.time}:00`


                        Swal.fire({
                            title: "Signos a guardar",
                            html: `
                                Por favor, verifique sus datos antes de guardar:<br>
                                Fecha registro: ${this.created_at} ${this.realTime}<br>
                                Temp: ${this.form.temp}<br>
                                FR: ${this.form.fr}<br>
                                FC: ${this.form.fc}<br>
                                TASIS: ${this.form.tasis}<br>
                                TADIA: ${this.form.tadia}<br>
                                TAMEDIA: ${this.form.tamedia}<br>
                                OXI: ${this.form.oxi}<br>
                                GLIC: ${this.form.gl}<br>
                                INSULINA: ${this.form.unidades_insulina}<br>
                            `,
                            //allowOutsideClick: false,
                            icon: "info",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "De acuerdo!",
                            cancelButtonText: "No guardar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let siglas = "temp"
                                    if (this.form[siglas] !== "") {
                                        this.storeSign({ inputName:"cat_user_cuestionario_84", newValue:this.form[siglas] ,route: "/user_cuest_temperatura/store"})
                                        document.querySelector('#'+siglas+'_'+this.patient_data.user_id).value=""
                                        this.patient_data[siglas] = this.form[siglas]
                                        // pacientes_datos[this.index] =  this.patient_data[siglas]
                                        this.form[siglas] = ""
                                    }
                                    siglas = "fr"
                                    if (this.form[siglas] !== "") {
                                        this.storeSign({ inputName:"value", newValue:this.form[siglas] ,route: "/user_cuest_fr/store"})
                                        document.querySelector('#'+siglas+'_'+this.patient_data.user_id).value=""
                                        this.patient_data[siglas] = this.form[siglas]
                                        // pacientes_datos[this.index] =  this.patient_data[siglas]
                                        this.form[siglas] = ""
                                    }
                                    siglas = "fc"
                                    if (this.form[siglas] !== "") {
                                        this.storeSign({ inputName:"cat_user_cuestionario_185", newValue:this.form[siglas] ,route: "/user_cuest_fc/store"})
                                        document.querySelector('#'+siglas+'_'+this.patient_data.user_id).value=""
                                        this.patient_data[siglas] = this.form[siglas]
                                        // pacientes_datos[this.index] =  this.patient_data[siglas]
                                        this.form[siglas] = ""
                                    }
                                    siglas = "tasis"
                                let siglas2 = "tadia"
                                    if (
                                        this.form[siglas] !== "" &&
                                        this.form[siglas2] !== ""
                                    ) {
                                        this.storeSign2({ route: "/user_cuest_ta/store"})
                                        document.querySelector('#'+siglas+'_'+this.patient_data.user_id).value=""
                                        document.querySelector('#'+siglas2+'_'+this.patient_data.user_id).value=""
                                        this.patient_data['ta'] = this.form[siglas]+"/"+this.form[siglas2]
                                        this.patient_data['ta_media'] = this.form['tamedia']
                                        // pacientes_datos[this.index] =  this.patient_data[siglas]
                                        this.form[siglas] = ""
                                        this.form[siglas2] = ""

                                    }
                                    siglas = "oxi"
                                    if (this.form[siglas] !== "") {
                                        this.storeSign({ inputName:"cat_user_cuestionario_73", newValue:this.form[siglas] ,route: "/user_cuest_oximetria/store"})
                                        document.querySelector('#'+siglas+'_'+this.patient_data.user_id).value=""
                                        this.patient_data[siglas] = this.form[siglas]
                                        // pacientes_datos[this.index] =  this.patient_data[siglas]
                                        this.form[siglas] = ""
                                    }
                                    siglas = "gl"
                                    if (this.form[siglas] !== "") {
                                        this.storeSign3({ inputName:"value", newValue:this.form[siglas] ,route: "/user_cuest_gl/store"})

                                        this.patient_data[siglas] = this.form[siglas]
                                        this.patient_data['unidades_insulina'] = this.form['unidades_insulina']
                                        // pacientes_datos[this.index] =  this.patient_data[siglas]

                                        this.form[siglas] = ""
                                        this.form['unidades_insulina'] = ""
                                    }


                            }
                        });


                },
                fechaInputDate() {
                    let fecha = new Date();
                    let response = "";

                    let mes = fecha.getMonth()+1; //obteniendo mes
                    let dia = fecha.getDate(); //obteniendo dia
                    let ano = fecha.getFullYear(); //obteniendo año
                        if(dia<10){dia='0'+dia}//agrega cero si el menor de 10
                        if(mes<10){mes='0'+mes}//agrega cero si el menor de 10
                        return response = ano+"-"+mes+"-"+dia;

                }
            },
            async mounted () {

            },
        }
    }
    async AppRowVitalSign(){
        let that = this
        let d = document
        let App = d.querySelector("#AppRowVitalSign")
            App.innerHTML= /*html*/ `
                <div v-for="(item,index) in items" :key="'row'+index" :id="'row-paciente-'+item.user_id+'-'+item.cat_user_ubicacion_id" 
                :class="[
                    'row-paciente ',
                    {'col-12 mt-3 col-sm-12 col-md-6 col-lg-6 col-xl-12':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                    {'col-12 mt-3 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3':['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                ]"
                
                >

                    <div :class="[
                        'd-flex shadow-sm rounded bg-light ',
                        {'flex-column flex-xl-row':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                        {'flex-column flex-xl-column':['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},

                        ]">
                        <div 
                            v-if="['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))" 
                            :class="[
                                'p-1',
                                {'col col-md col-xl-1 d-flex flex-xl-wrap ':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                                {'order-2 col-12 col-sm-12':['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                            ]"
                            
                        >
                            <div class="w-100 d-flex flex-wrap" :style="['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))?'gap: 0.5rem !important;':''">
                                <div class="col-12 col-sm-3 d-flex flex-column border border-gray mb-1 rounded">
                                    <b class="small-title text-primary text-uppercase text-center">Ubicación</b>
                                    <div class="flex-fill d-flex justify-content-center align-items-end align-items-xl-center text-gray">
                                        {{item.ubicacion_alta}}
                                    </div>
                                </div>
                                <div class="col col-sm-3 d-flex flex-column border border-gray mb-1 rounded">
                                    <b class="small-title text-primary text-uppercase text-center">Ingreso</b>
                                    <div class="flex-fill d-flex justify-content-center align-items-end align-items-xl-center text-gray">
                                        {{item.ingreso_episodio}}
                                    </div>
                                    <div class="flex-fill d-flex justify-content-center  align-items-end text-gray">
                                        {{item.hora_ingreso}}
                                    </div>
                                </div>

                                <div class="col d-flex flex-column border border-gray mb-1 rounded">
                                    <b class="small-title text-primary text-uppercase text-center">Egreso</b>
                                    <div class="flex-fill d-flex justify-content-center align-items-end align-items-xl-center text-gray">
                                        {{item.egreso_episodio}}
                                    </div>
                                    <div class="flex-fill d-flex justify-content-center  align-items-end text-gray">
                                        {{item.hora_egreso}}
                                    </div>
                                </div>
                                <div class="col-2 d-flex flex-column border border-gray mb-1 rounded">
                                    <b class="small-title text-primary text-uppercase text-center">Días</b>
                                    <div class="flex-fill d-flex justify-content-center align-items-end align-items-xl-center text-gray">
                                        {{item.dias}}
                                    </div>
                                </div>
                            </div>
                   
                        </div>
                        <div v-else class="col col-md col-xl-1 d-flex flex-xl-wrap p-1">
                            <app-btn-ubicacion :patient_data="item" :index="index"></app-btn-ubicacion>
                            <app-btn-dias :patient_data="item" :index="index"></app-btn-dias>
                            <app-prealta :patient_data="item" :index="index"></app-prealta>
                            <app-btn-traslado-ambulancia :patient_data="item" :index="index"></app-btn-traslado-ambulancia>
                        </div>
                        <div class="col px-1 d-flex flex-column ">
                            <div class="rounded d-flex flex-column flex-xl-row my-1" style="height: 100% !important;gap: 4px;">
                                <div :class="[
                                        'rounded d-flex flex-column justify-content-between border',
                                        {'width-custom':!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                                        {'w-100':['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))},
                                    ]" 
                                >
                                    <app-data-paciente :patient_data="item" :index="index"></app-data-paciente>
                                    <app-btn-group2 :patient_data="item" :index="index"></app-btn-group2>

                                </div>
                                <div
                                    v-if="!['alta','traslado','contraopinion','fallecido','otro'].includes(localStorage.getItem('area'))" 
                                    class="collapseVitalsign p-1 collapse col align-content-center"
                                    :id="'collapse'+index"
                                >
                                     <app-form-vital-signs
                                            :patient_data="item"
                                            :index="index"
                                        ></app-form-vital-signs>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        let app = new Vue({
                el: "#AppRowVitalSign",
                components: {
                    "app-btn-ubicacion": that.AppBtnUbicacion(),
                    "app-btn-dias": that.AppBtnDias(),
                    "app-prealta": that.AppPrealta(),
                    "app-btn-traslado-ambulancia": that.AppBtnTrasladoAmbulancia(),
                    "app-data-paciente": that.AppDataPaciente(),
                    "app-btn-group2": that.AppBtnGroup2(),
                    "app-form-vital-signs": that.AppFormVitalSigns(),

                },
                data() {
                    return {
                        areaSiglas:"tp",
                        items:pacientes_datos
                    }
                },
                computed: {
                    
                },
                methods: {

                },
                created() {
                    let that = this
                    // Escuchar cambios en el bus de eventos
                    EventBus.$on('externalVarChanged', (newValue) => {
                        that.items = newValue;
                    });
                },
                mounted () {
                    let that = this
                   /*  setInterval(() => {
                        that.items = pacientes_datos
                    }, 100); */
                },
            })

    }
    async AppNavMenuArea(){

        let App = d.querySelector("#App_nav_menu_areas")
            App.innerHTML = /*html*/ `
                <li
                    v-for="(item,index) in getItems.filter(x=>['tp','ea','ep',].includes(x.siglas))"
                    :key="'area_option_'+index"
                    class="nav-item"
                    :title="item.description"
                    role="presentation"
                >
                    <a
                        @click="handleAreaOption(item.siglas)"
                        :class="['font-weight-bold text-uppercase nav-link',{'active':item.siglas===areaSiglas}]"

                        :href="'#pills-'+item.siglas"
                        role="tab"
                        :aria-controls="'pills-'+item.siglas"
                        aria-selected="false">
                        {{item.siglas}}
                    </a>
                </li>
                <li
                    class="nav-item"
                    title="AQ"
                    role="presentation"
                >
                    <a
                        @click="handleMenuAQ"
                        :class="['font-weight-bold text-uppercase nav-link',{'active':['aq_torre_hosp','aq_mapm'].includes(areaSiglas)}]"

                        href="#pills-aq"
                        role="tab"
                        aria-controls="pills-aq"
                        aria-selected="false"
                    >
                       AQ
                    </a>
                </li>
                <li
                    v-for="(item,index) in getItems.filter(x=>['hcep','hp2','hp3','hp4','hp5','hp6','utia','utip','utin',].includes(x.siglas))"
                    :key="'area_option_'+index"
                    class="nav-item"
                    :title="item.description"
                    role="presentation"
                >
                    <a
                        @click="handleAreaOption(item.siglas)"
                        :class="['font-weight-bold text-uppercase nav-link',{'active':item.siglas===areaSiglas}]"

                        :href="'#pills-'+item.siglas"
                        role="tab"
                        :aria-controls="'pills-'+item.siglas"
                        aria-selected="false">
                        {{item.siglas}}
                    </a>
                </li>
                <li
                    class="nav-item"
                    title="Pad"
                    role="presentation"
                >
                    <a
                        @click="handleMenuPad"
                        :class="['font-weight-bold text-uppercase nav-link',{'active':['pad','pad_emergencia_adulto','pad_emergencia_pediatrica','pad_postquirurgico_amb','pad_postquirurgico_hosp','pad_medico'].includes(areaSiglas)}]"

                        href="#pills-pad"
                        role="tab"
                        aria-controls="pills-pad"
                        aria-selected="false"
                    >
                       PAD
                    </a>
                </li>
                <li
                    class="nav-item"
                    title="Altas"
                    role="presentation"
                >
                    <a
                        @click="handleMenuEgresos"
                        :class="['font-weight-bold text-uppercase nav-link',{'active':['alta','traslado','contraopinion','fallecido','otro'].includes(areaSiglas)}]"

                        href="#pills-TP"
                        role="tab"
                        aria-controls="pills-TP"
                        aria-selected="false"
                    >
                       ALTA
                    </a>
                </li>
                <li
                    style="background-color: #f0efef;border-radius: 5px;"
                    class="d-none nav-item"
                    title="Padel"
                    role="presentation"
                >
                    <a
                        @click="handleAreaOption('pfest')"
                        :class="['font-weight-bold text-uppercase nav-link',{'active':['pfest'].includes(areaSiglas)}]"
                        :href="'#pills-pfest'"
                        role="tab"
                        :aria-controls="'pills-pfest'"
                        aria-selected="false">
                       PADEL FEST 3
                    </a>
                </li>
            `
        let that = this
        let app = new Vue({
                el: "#App_nav_menu_areas",
                data() {
                    return {
                        areaSiglas:"tp",
                        areaName:"Todos los Pacientes",
                        selectorAreaName:document.getElementById('areaName'),
                        loading:document.getElementById('loadingScreen'),
                        items:[
                            {
                                name:"Todos los Pacientes",
                                siglas:"tp",
                            },
                            {
                                name:"Emergencia Adulto",
                                siglas:"ea",
                            },
                            {
                                name:"Emergencia Pediátrica",
                                siglas:"ep",
                            },
                            {
                                name:"Área Quirúrgica",
                                siglas:"aq",
                            },
                            {
                                name:"AQ Torre Hospitalización",
                                siglas:"aq_torre_hosp",
                            },
                            {
                                name:"AQ MAPM",
                                siglas:"aq_mapm",
                            },
                            {
                                name:"Hospitalización Corta Estancia Pediátrica",
                                siglas:"hcep",
                            },
                            {
                                name:"Hospitalización Piso 2",
                                siglas:"hp2",
                            },
                            {
                                name:"Hospitalización Piso 3",
                                siglas:"hp3",
                            },
                            {
                                name:"Hospitalización Piso 4",
                                siglas:"hp4",
                            },
                            {
                                name:"Hospitalización Piso 5",
                                siglas:"hp5",
                            },
                            {
                                name:"Hospitalización Piso 6",
                                siglas:"hp6",
                            },
                            {
                                name:"Unidad de Terapia Intensiva Adulto",
                                siglas:"utia",
                            },
                            {
                                name:"Unidad de Terapia Intensiva Pediátrica",
                                siglas:"utip",
                            },
                            {
                                name:"Unidad de Terapia Intensiva Neonatal",
                                siglas:"utin",
                            },
                            {
                                name:"Prorama de Atención Domiciliaria",
                                siglas:"pad",
                            },
                            {
                                name:"PAD Emergencia Adulto",
                                siglas:"pad_emergencia_adulto",
                            },
                            {
                                name:"PAD Emergencia Pediátrica",
                                siglas:"pad_emergencia_pediatrica",
                            },
                            {
                                name:"PAD Postquirúrgico Ambulatorio",
                                siglas:"pad_postquirurgico_amb",
                            },
                            {
                                name:"PAD Postquirúrgico Hospitalización",
                                siglas:"pad_postquirurgico_hosp",
                            },
                            {
                                name:"PAD Médico",
                                siglas:"pad_medico",
                            },
                            {
                                name:"Altas médicas",
                                siglas:"alta",
                            },
                            {
                                name:"Traslados a otra institución",
                                siglas:"traslado",
                            },
                            {
                                name:"Contraopinión médica",
                                siglas:"contraopinion",
                            },
                            {
                                name:"Contraopinión médica",
                                siglas:"fallecido",
                            },
                            {
                                name:"Otro concepto de egreso",
                                siglas:"otro",
                            },
                            {
                                name:"Padel Fest 3",
                                siglas:"pfest",
                            },
                        ]
                    }
                },
                components:{

                },
                computed: {
                    getItems(){
                        return this.items.filter(item => !['alta','traslado','contraopinion','fallecido','otro','pad','pad_emergencia_adulto','pad_emergencia_pediatrica','pad_postquirurgico_amb','pad_postquirurgico_hosp','pad_medico',].includes(item.siglas) )
                    }
                },
                methods: {
                    actualizarMensaje(nuevoMensaje) {
                        //alert(nuevoMensaje)
                        this.areaSiglas = nuevoMensaje;
                        this.selectorAreaName.textContent = this.items.find(x=>x.siglas === nuevoMensaje).name
                      },
                    getRouteParams(){
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
                        this.areaSiglas = queryParams['area'];
                        console.log('Valor de "area":', this.areaSiglas);
                    },
                    async getAreaData(){
                        this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                        this.selectorAreaName.textContent = this.items.find(x=>x.siglas === this.areaSiglas).name
                        this.loading.classList.remove("d-none")
                        pacientes_datos = await get( location.origin+"/vistas/" + this.areaSiglas )
                        EventBus.$emit('externalVarChanged', pacientes_datos);
                        that.AppBtnTotales(pacientes_datos)
                        this.loading.classList.add("d-none")
                    },
                    handleMenuPad(){

                        $("#messageModal").modal("show")
                        this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                        this.selectorAreaName.textContent = "PAD"
                        localStorage.setItem("area",this.areaSiglas)
                        let App = d.querySelector("#messageModal .modal-body")
                            App.innerHTML =null
                            App.innerHTML = `
                                <div id="AppMenuPad">
                                </div>
                            `
                        let app = new Vue( that.AppMenuPad() );
                            app._props.areaSiglas = this.areaSiglas
                            app._props.FnAreaSiglas = this.actualizarMensaje
                            console.log(app);
                    },
                    handleMenuAQ(){

                        $("#messageModal").modal("show")
                        this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                        this.selectorAreaName.textContent = "AQ"
                        localStorage.setItem("area",this.areaSiglas)
                        let App = d.querySelector("#messageModal .modal-body")
                            App.innerHTML =null
                            App.innerHTML = `
                                <div id="AppMenuAQ">
                                </div>
                            `
                        let app = new Vue( that.AppMenuAQ() );
                            app._props.areaSiglas = this.areaSiglas
                            app._props.FnAreaSiglas = this.actualizarMensaje
                            console.log(app);
                    },
                    handleMenuEgresos(){
                        $("#messageModal").modal("show")
                        this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                        localStorage.setItem("area",this.areaSiglas)
                        let App = d.querySelector("#messageModal .modal-body")
                            App.innerHTML =null
                            App.innerHTML = `
                                <div id="AppMenuEgresos">
                                </div>
                            `
                        let app = new Vue( that.AppMenuEgresos() );
                            app._props.areaSiglas = this.areaSiglas
                            app._props.FnAreaSiglas = this.actualizarMensaje
                            //console.log(app);
                    },

                    handleAreaOption(areaSiglas){
                        //console.log(areaSiglas)
                        this.areaSiglas = areaSiglas
                        localStorage.setItem("area",this.areaSiglas)

                        this.getAreaData()



                    },
                },
                mounted () {
                    this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                    //console.log(this.areaSiglas);
                    this.selectorAreaName.textContent = this.items.find(x=>x.siglas === this.areaSiglas).name
                    /* if(this.areaSiglas === "pad"){
                        this.handleMenuPad()
                        return false
                    } */
                    this.getAreaData();

                },
            })
        return app
    }
    AppBtnTotales(pacientes_datos){
        //console.log("------------>",pacientes_datos)
        let App = d.querySelector("#btnNotificaciones")
            App.innerHTML = /*HTML */`

                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-column flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-paciente text-info mr-1"></i> <span class="d-md-block text-nowrap">TP</span>
                    </span>
                    <span class="w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalPacientes()}}</span>
                </button>
                <button
                    v-if="!['tp'].includes( getArea() )"
                    type="button"
                    :class="[{'flex-column':['tp'].includes( getArea() )},'text-uppercase d-flex flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1']"
                >
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-paciente text-info mr-1"></i> <span class="d-md-block text-nowrap">Total Pacientes</span>
                    </span>
                    <span class="ml-1 w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalPacientes()}}{{getTotalPacienteArea()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-column flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-emergencia text-info mr-1"></i> <span class="d-md-block text-nowrap">EMER</span>
                    </span>
                    <span class="w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalEmergencia()}}</span>
                </button>
                <!--<button type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1"><i class="pc-cirugia-light text-info mr-1"></i> <span class="d-none d-md-block text-nowrap">QX</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">0</span>
                </button>-->
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-column flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-cirugia-light  text-info mr-1"></i> <span class="d-md-block text-nowrap">AQ</span>
                    </span>
                    <span class="w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalAQ()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-column flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-light-pisos  text-info mr-1"></i> <span class="d-md-block text-nowrap">HOSP</span>
                    </span>
                    <span class="w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalHospitalizacion()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-column flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-uti-light text-info mr-1"></i> <span class="d-md-block text-nowrap">UTI</span>
                    </span>
                    <span class="w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalUti()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-column flex-md-row flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-0 mr-md-1 mb-1 mb-md-0 d-flex align-items-center">
                        <i class="pc-light-homecare text-info mr-1"></i> <span class="d-md-block text-nowrap">PAD</span>
                    </span>
                    <span class="w-100 badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalPad()}}</span>
                </button>
            `;
        let app = new Vue( {
            el:"#btnNotificaciones",
            props:{
                patient_data:Object,
                /* fnOnEnter:Function, */
                index:Number,
                /* myInputValue:Number, */
            },

            data() {
                return {
                    aq_parent_id:[418,119,420,421,422,423,424,425],
                    hospitalizacion_parent_id:[42,235,236,99,71,234,127,155],
                    emergencia_parent_id:[2,3,270,28,29,32,392],
                    uti_parent_id:[182,211],
                    pad_parent_id:[229,228,373,374,382],
                    loading:document.getElementById('loadingScreen'),
                }
            },
            computed: {


            },
            methods: {
                getArea(){
                    return localStorage.getItem("area")
                },
                getTotalPacientes(){
                    let area = this.getArea()
                        if(['tp'].includes(area) ){
                            return this.getTotalHospitalizacion() + this.getTotalAQ() + this.getTotalEmergencia() + this.getTotalUti() + this.getTotalPad()
                        }
                        if(['ea'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [4,5,405].includes( Number(x.cat_user_ubicacion_id) ) ||
                                [270].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['ep'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [30,31,406].includes( Number(x.cat_user_ubicacion_id) ) ||
                                [32].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['hcep'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [390].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['aq'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [418,119,420,421,422,423,424,425].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['aq_torre_hosp'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [418,422].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['aq_mapm'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [424,425].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['hp2'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [42].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['hp3'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [71,235].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['hp4'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [236,99].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['hp5'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [127,234].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['hp6'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [155].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['utia'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [182].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['utip'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [211].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['utin'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [391].includes( Number(x.parent_cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['pad_emergencia_adulto'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [229].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['pad_emergencia_pediatrica'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [228].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['pad_postquirurgico_amb'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [373].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['pad_postquirurgico_hosp'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [374].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                        if(['pad_medico'].includes(area) ){
                            return  pacientes_datos.filter(x=>
                                [382].includes( Number(x.cat_user_ubicacion_id) )
                            ).length
                        }
                },
                getTotalPacienteArea(){
                    let a = this.getArea()

                    let area = {
                        'ea':17,
                        'ep':8,
                        'hp2':26,
                        'hp3':26,
                        'hp4':32,
                        'hp5':35,
                        'hp6':35,
                        'utia':10,
                        'utip':8,

                    }
                    let exclude = [



                        ]
                    let result = ""
                        if (area[a] !== undefined) {
                            result = '/'+area[ a ]
                        }
                        return !exclude.includes( a ) ?  result : '0'
                },
                getTotalAQ(){
                    return pacientes_datos.filter(x=>this.aq_parent_id.includes( Number(x.cat_user_ubicacion_id) ) ).length
                },
                getTotalHospitalizacion(){
                    return pacientes_datos.filter(x=>this.hospitalizacion_parent_id.includes( Number(x.parent_cat_user_ubicacion_id) ) ).length
                },
                getTotalEmergencia(){
                    return pacientes_datos.filter(x=>this.emergencia_parent_id.includes( Number(x.parent_cat_user_ubicacion_id) ) ).length
                },
                getTotalPad(){
                    return pacientes_datos.filter(x=>this.pad_parent_id.includes( Number(x.cat_user_ubicacion_id) ) ).length
                },
                getTotalUti(){
                    return pacientes_datos.filter(x=>
                        this.uti_parent_id.includes( Number(x.parent_cat_user_ubicacion_id) ) ||
                        [391].includes( Number(x.cat_user_ubicacion_id) )
                    ).length
                }
            },
            async mounted () {

            },
        })
        return app
    }
    async ViewEnfermeria() {
        await this.AppRowVitalSign()
        let app1 = await this.AppNavMenuArea()




    }
    /*************** */


    qrCode({}){
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 100,
            height : 100
        });
        qrcode.makeCode(444444);
    }
    titleArea({title,area='tp',searchBy='medico',cat_especialidad_id='null'}){
        //console.log(cat_especialidad_id)

        if (searchBy==="medico") {
            searchBy = `UserEquipoSalud.menuEquipoEnArea({area:'${area}'})`;
        }
        if (searchBy==="especialidad") {
            searchBy =    `UserEquipoSalud.menuEquipoEnEspecialidad({cat_especialidad_id:${cat_especialidad_id}})`;
        }
        $("#titleArea").html(`
            <button onclick="${searchBy}" data-tippy-content="Pulse para ver el Equipo Médico en el área" type="button" class="btn btn-light btn-block">
                <span style="font-weight:bold;color:var(--primary)!important">${title}</span>
            </button>
        `)
       /*  tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
        }) */
    }
    menuAreas(selector) {
        CatUserUbicacion.showMenu()
            .then(response => {
                let CatUserUbicacion = `
                    <li class="menuArea nav-item" data-titlearea="Total pacientes" data-area="tp" role="presentation" onclick="">
                        <a class="nav-link active" id="pills-tp-tab" data-toggle="pill" href="#pills-tp" role="tab" aria-controls="pills-tp" aria-selected="false">TP</a>
                    </li>
                `;

                Component.titleArea({title:"Total Pacientes",area:'tp'})

                $.each(response, function(indexInArray, valueOfElement) {
                    CatUserUbicacion += `
                    <li class="menuArea nav-item" data-titleArea="${valueOfElement['name']}" data-area="${valueOfElement['description']}" role="presentation" onclick="">
                        <a class="nav-link" id="pills-${valueOfElement['description']}-tab" data-toggle="pill" href="#pills-${valueOfElement['description']}" role="tab" aria-controls="pills-${valueOfElement['description']}" aria-selected="false">${valueOfElement['description']}</a>
                    </li>
                `;
                });
                $(selector).html(`
                    <ul class="nav nav-pills flex-nowrap" role="tablist">
                        ${CatUserUbicacion}
                    </ul>
                `);
                $(".menuArea").on("click", function() {
                    $('#btnNotificaciones').empty();
                    Component.menu($(this).data("area"), $(this).data("titlearea"))
                });
                tippy('[data-tippy-content]', {
                    theme: 'tooltip-cmdlt-primary',
                })
            })
            if (location.pathname==="/telesalud/empresarial/index") {
                document.getElementById("cat_user_ubicacion_menu").style.display="none"
            }
            //console.log('%cComponent.js line:1740 location', 'color: #007acc;', location);
    }
    searchPaciente(data) {
        let filtro = "";
        if (data.search != undefined) {
            filtro = `{'ubicacion':'TP'}`;
            get("medico/rowPacienteCovid/" + filtro)
        }

    }
    newsSignos(selector) {
        //Indica aquí, en pixels, el ancho de tu marquesina
        var marqueewidth = 600
            //Indica aquí, en pixels, el alto de tu marquesina
        var marqueeheight = 20
            //Indica aquí la velocidad de recorrido del texto
        var speed = 5
            //Escribe el mensaje que debe aparecer (con sus correspondientes enlaces, si los hay)
        function news() {
            get( location.origin+"/vistas/v_prioridad_spo2")
                .then(response => {
                    let news = "";
                    let total_news = response.length;
                    $.each(response, function(indexInArray, valueOfElement) {
                        news += `
                            <span class="text-${valueOfElement['prioridad']}" onclick="filtroPriorizados('${valueOfElement['paciente']}')">
                                <span class="font-weight-bold">${valueOfElement['signo']}</span> -
                                <span class="font-weight-bold">${valueOfElement['value']}</span> |
                                <span class="font-weight-bold text-gray">${valueOfElement['paciente']}</span> |
                                <span class="font-weight-bold text-gray">${valueOfElement['ubicacion']}</span>
                            </span>
                        `;
                        if (indexInArray < (total_news - 1)) {
                            news += `
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        `;
                        }
                    });

                    $(selector).html('<marquee class="cursor-pointer" onmouseout="this.start()" onmouseover="this.stop()" scrollAmount=' + speed + ' style="width:' + marqueewidth + '">' + news + '</marquee>')


                })
        }
        news()
    }

    viewByEspecialidad({especialidad,cat_especialidad_id}){
        $('#btnNotificaciones').empty();
        $("#messageModal").modal("hide")
        $('#pills-tp-tab').tab('show')
        //Component.titleArea({title:data.especialidad,area:data.cat_user_especialidad_id})
        Component.titleArea({
            title:especialidad,
            area:cat_especialidad_id,
            cat_especialidad_id:cat_especialidad_id,
            searchBy:"especialidad"
        })


        $("#row_paciente").html(`
            <tr>
                <td colspan="18">
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Cargando...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </td>
            </tr>
        `)

        get( location.origin+"/viewbyespecialidad/" + cat_especialidad_id)
                    .then(response => {
                        $('#btnNotificaciones').empty();
                        var contadores ={
                            'TP':0,
                            'EA':0,
                            'Ecvd':0,
                            'EP':0,
                            'AQ':0,
                            'HP2':0,
                            'HP3':0,
                            'HP4':0,
                            'HP5':0,
                            'HP6':0,
                            'UTIA':0,
                            'UTICvd':0,
                            'UTIP':0,
                            'PAD':0,
                            'Domicilio':0
                        }
                        $.each(response, function (indexInArray, valueOfElement) {
                            //console.log(valueOfElement['area'])
                            contadores[valueOfElement['area']]=contadores[valueOfElement['area']]+1

                        });
                        $.each(contadores, function (indexInArray, valueOfElement) {
                            if (contadores[indexInArray]>0) {
                                Component.notification('#btnNotificaciones', {
                                    route: '#',
                                    name: indexInArray,
                                    cantidad: contadores[indexInArray],
                                    length
                                })
                            }

                        });
                        //

                        /*
                        */
                        Component.filasViewCovid(response)
                    });
    }
    viewByMedico({medico_id,medico}){
        $('#btnNotificaciones').empty();
        $("#modelId").modal("hide")
        $('#pills-tp-tab').tab('show')
        Component.titleArea({title:medico,area:medico_id})
        //Component.titleArea(data.especialidad)

        $("#row_paciente").html(`
            <tr>
                <td colspan="18">
                    <div class="d-flex m-4 justify-content-center text-primary">
                        Cargando...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </td>
            </tr>
        `)

        get( location.origin+"/viewbymedico/" + medico_id)
                    .then(response => {
                        $('#btnNotificaciones').empty();
                        var contadores ={
                            'TP':0,
                            'EA':0,
                            'Ecvd':0,
                            'EP':0,
                            'AQ':0,
                            'HP2':0,
                            'HP3':0,
                            'HP4':0,
                            'HP5':0,
                            'HP6':0,
                            'UTIA':0,
                            'UTICvd':0,
                            'UTIP':0,
                            'PAD':0,
                            'Domicilio':0
                        }
                        $.each(response, function (indexInArray, valueOfElement) {
                            //console.log(valueOfElement['area'])
                            contadores[valueOfElement['area']]=contadores[valueOfElement['area']]+1

                        });
                        $.each(contadores, function (indexInArray, valueOfElement) {
                            if (contadores[indexInArray]>0) {
                                Component.notification('#btnNotificaciones', {
                                    route: '#',
                                    name: indexInArray,
                                    cantidad: contadores[indexInArray],
                                    length
                                })
                            }

                        });
                        //

                        /*
                        */
                        Component.filasViewCovid(response)
                    });
    }
    viewMedico(selector, data) {

        $(selector).html(`
            <div class="container-fluid sticky-top">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <div class="table-responsive-md">
                            <table id="tablapacientes" class="w-100">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase sticky-top" colspan="13" style="top: -0.1em !important;">
                                            <div id="cat_user_ubicacion_menu"></div>
                                        </th>
                                        <th align="middle" class="bg-white sticky-top" colspan="5" style="top: -0.1em !important;">
                                            <button id="btn_paciente_create" onclick="window.location='/medico/create_paciente'"  class="btn btn-success font-weight-bold btn-block" style="" >Nuevo Paciente</button>
                                        </th>
                                    </tr>

                            </table>
                            <div id="cat_user_ubicacion_menu_sub_1_content"></div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        //console.log(data.pacientes)
        /*Fila a crear*/
        let response = [
            { name: "FHOI", description: "Fundación Hospital Ortopédico Infantil", id: "1" },
            { name: "UROLÓGICO", description: "Hospital Urológico San Román", id: "2" },
            { name: "CMDLT", description: "CMDLT", id: "3" },

        ]
        let response2 = [

            { name: "MAR", description: "Marformaciones Ano Rectales", id: "1" },
            { name: "UROPED", description: "Urología Pediátrica", id: "2" },
            { name: "CIRUPED", description: "Cirugia Pediátrica general", id: "3" },
        ]
        let CatUserUbicacion = ``;
        let CatUserUbicacionContent = ``;


        /*menu 1*/
        $.each(response, function(indexInArray, valueOfElement) {
            CatUserUbicacion += `
                    <li class="nav-item" role="presentation">
                        <a class="nav-link ${indexInArray==0?'active':''}" id="hospital_${valueOfElement['id']}-tab" data-toggle="pill" href="#hospital_${valueOfElement['id']}" role="tab" aria-controls="hospital_${valueOfElement['id']}" aria-selected="true" data-tippy-content="${valueOfElement['description']}">${valueOfElement['name']}</a>
                    </li>
                `;
            CatUserUbicacionContent += `
                    <div class="tab-pane fade  ${indexInArray==0?'show active':''}" id="hospital_${valueOfElement['id']}" role="tabpanel" aria-labelledby="hospital_${valueOfElement['id']}-tab">
                        <div id="menu_hospital_${valueOfElement['id']}">${valueOfElement['id']}</div>
                        <div id="content_hospital_${valueOfElement['id']}">${valueOfElement['id']}</div>
                    </div>
                `;
        });
        $("#cat_user_ubicacion_menu").html(`
                <ul class="nav nav-pills bg-light" id="pills-tab1" style="width: max-content !important;" role="tablist">
                    ${CatUserUbicacion}
                </ul>
            `);
        $("#cat_user_ubicacion_menu_sub_1_content").html(`
            <div class="tab-content" id="pills-tabContent1">
                ${CatUserUbicacionContent}
            </div>
        `);
        /** */
        /*menu 2*/
        $.each(response, function(indexInArray, valueOfElement) {
            let CatUserUbicacion2 = ``;
            let CatUserUbicacion2Content = ``;
            $.each(response2, function(indexInArray2, valueOfElement2) {
                CatUserUbicacion2 += `
                    <li class="nav-item" role="presentation">
                        <a class="nav-link ${indexInArray2==0?'active':''}" id="pills-${valueOfElement['id']}-sub${valueOfElement2['id']}-tab" data-toggle="pill" href="#pills-${valueOfElement['id']}-sub${valueOfElement2['id']}" role="tab" aria-controls="pills-${valueOfElement['id']}-sub${valueOfElement2['id']}" aria-selected="true" data-tippy-content="${valueOfElement2['description']}">${valueOfElement2['name']}</a>
                    </li>
                `;
                CatUserUbicacion2Content += `
                    <div class="tab-pane fade  ${indexInArray2==0?'show active':''}" id="pills-${valueOfElement['id']}-sub${valueOfElement2['id']}" role="tabpanel" aria-labelledby="pills-${valueOfElement['id']}-sub${valueOfElement2['id']}-tab">
                        <table id="tablapacientes" class="w-100">
                            <thead>
                                <tr>
                                    <th class="bg-white text-uppercase sticky-top" colspan="13" style="top: 2.3em;">
                                        <div id="cat_user_ubicacion_menu_sub_1"></div>
                                    </th>
                                    <th align="middle" class="bg-white sticky-top" colspan="5" style="top: 2.3em;">
                                        <input type="text" class="form-control" id="busquedapaciente" placeholder="Buscar paciente..." aria-label="Buscar paciente..." aria-describedby="button-addon2">
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Ubicación del paciente">UBI</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Días desde el ingreso">DÍAS</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Información del paciente">PACIENTE</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Género">SEXO</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Edad">EDAD</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Temperaratura">TEMP</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Frecuencia Cardíaca">F.C</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Frecuencia Respiratoria">F.R</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Tensión Arterial">T.A</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Glicemia">GL</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Oximetría">SPO2</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Oxigenoterapia">OXIGENOTERAPIA</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Sintomas">SÍNTOMA</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="COVID PCR">PCR</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="COVID PDR">PDR</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="COVID ANTIGÉNICA">ANTG</th>
                                    <th class="text-center bg-gray p-2 sticky-top" style="top: 5.3em;color: var(--secondary) !important" data-tippy-content="Tomografpia axial computarizada">TAC</th>

                                </tr>
                            </thead>
                            <tbody id="row_paciente">

                            </tbody>
                        </table>
                    </div>
                `;


            });
            $(`#menu_hospital_${valueOfElement['id']}`).html(`
                <ul class="nav nav-pills bg-light" id="pills-tab1" style="width: max-content !important;" role="tablist">
                    ${CatUserUbicacion2}
                </ul>
            `);
            $(`#content_hospital_${valueOfElement['id']}`).html(`
                <div class="tab-content" id="pills-tabContent2${valueOfElement['id']}">
                    ${CatUserUbicacion2Content}
                </div>
            `);


        });
        /** */








        Component.searchPaciente({})
            //filtroTabla()



        if (data.pacientes != null) {

            if (data.pacientes.length > 0) {
                $.each(data.pacientes, function(indexInArray, valueOfElement) {
                    let col_light = true;
                    /*inicio fila*/
                    let fila = `<tr class='row_${valueOfElement['user_id']}'>`;

                    for (var i = 1; i <= 18; i++) {
                        let stilos = ""
                        if (i == 5) {
                            stilos = "border-right: 2px solid #bebcbc !important"
                        }
                        fila += `<td id="col_${i}_${valueOfElement['user_id']}" style=" ${stilos}" class="border ${col_light==true?'bg-gray-2':''}">`;
                        fila += ``;
                        fila += `</td>`;
                        col_light == true ? col_light = false : col_light = true;
                    }
                    fila += "</tr>";
                    $("#row_paciente").append(fila);
                    /*fin fila*/

                    //**icono calendario */
                    let dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_7.png' alt='7'>";
                    if (valueOfElement['cal'] == 7) {
                        dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_7.png' alt='7'>";
                    } else if (valueOfElement['cal'] == 14) {
                        dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_14.png' alt='14'>";
                    } else if (valueOfElement['cal'] == 21) {
                        dias_cal = "<img loading='lazy' class='img-fluid heartbeat' style='width: 30px;height: 30px;' src='/image/system/icono_cal_21.png' alt='21'>";
                    }

                    //**icono alerta */
                    let alerta = "<span id='default-alert_${valueOfElement['user_id']}' style='font-size: 25px !important;' class='heartbeat text-success alert-estable font-weight-bold'>!</span>";
                    if (valueOfElement['alert'] == 1) {
                        alerta = "<span id='default-alert_${valueOfElement['user_id']}' style='font-size: 25px !important;' class='heartbeat text-success alert-estable font-weight-bold'>!</span>";
                    } else if (valueOfElement['alert'] == 2) {
                        alerta = "<span id='default-alert_${valueOfElement['user_id']}' style='font-size: 25px !important;' class='heartbeat text-warning alert-estable font-weight-bold ping'>!!</span>";
                    } else if (valueOfElement['alert'] == 3) {
                        alerta = "<span id='default-alert_${valueOfElement['user_id']}' style='font-size: 25px !important;' class='heartbeat text-danger alert-estable font-weight-bold ping-2'>!!!</span>";
                    }

                    $(`#col_1_${valueOfElement['user_id']}`).html(`
                        <div class="text-secondary text-center">
                            <button class="btn btn-light">${valueOfElement['ubicacion']}</button>
                        </div>
                    `);
                    $(`#col_2_${valueOfElement['user_id']}`).html(`
                        <div class="text-center text-secondary">
                            ${valueOfElement['dias']}
                        </div>
                    `);
                    $(`#col_3_${valueOfElement['user_id']}`).html(`
                        <div class="text-secondary mb-2">
                            <table style="width: calc(13vh*2) !important;">
                                <tr>
                                    <td class="h4 pb-4" colspan="6">
                                        <span class="cursor-pointer">
                                            ${valueOfElement['paciente']}
                                        </span>
                                        <span>
                                            <div class="btn-group" style="margin-left: 20px"
                                                role="group" aria-label="">
                                                <div class="btn-group" role="group">
                                                    <a id="default-alert_${valueOfElement['user_id']}" type="button"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                        ${alerta}
                                                    </a>
                                                    <div class="dropdown-menu"
                                                        aria-labelledby="dropdownId">
                                                        <a onclick="addAlert(1,${valueOfElement['user_id']})"
                                                            class="dropdown-item"><span
                                                                class="text-success">!111111</span>
                                                            Estable</a>
                                                        <a onclick="addAlert(2,${valueOfElement['user_id']})"
                                                            class="dropdown-item"><span
                                                                class="text-warning">!!</span>
                                                            Intermedio</a>
                                                        <a onclick="addAlert(3,${valueOfElement['user_id']})"
                                                            class="dropdown-item"><span
                                                                class="text-danger">!!!</span>
                                                            De cuidado</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="dropdown">
                                            <a id="triggerId_${valueOfElement['user_id']}" class="h4 cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ${dias_cal}
                                            </a>
                                            <div class="dropdown-menu" style="width:4em;z-index: 10000;" aria-labelledby="triggerId_${valueOfElement['user_id']}">
                                                <a onclick="addCal(7,${valueOfElement['user_id']})" style="width:4em" class="dropdown-item cursor-pointer"><img loading="lazy" class="img-fluid" style="width: 30px;height: 30px;" src="${location.origin}/image/system/icono_cal_7.png" alt=""></a>
                                                <a onclick="addCal(14,${valueOfElement['user_id']})" style="width:4em" class="dropdown-item cursor-pointer"><img loading="lazy" class="img-fluid" style="width: 30px;height: 30px;" src="${location.origin}/image/system/icono_cal_14.png" alt=""></a>
                                                <a onclick="addCal(21,${valueOfElement['user_id']})" style="width:4em" class="dropdown-item cursor-pointer"><img loading="lazy" class="img-fluid" style="width: 30px;height: 30px;" src="${location.origin}/image/system/icono_cal_21.png" alt=""></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a onclick="UserCuestHistoria.index('.modal-body',${valueOfElement['user_id']})" class="h4 cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}/image/system/icono-new-historia.png">
                                        </a>
                                    </td>
                                    <td>
                                        <div id="col_pad_${valueOfElement['user_id']}"></div>
                                    </td>
                                    <td>
                                        <a id="btn_infoPaciente_${valueOfElement['user_id']}" onclick="datosInfoPaciente(${valueOfElement['user_id']})"class="h4 cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}/image/system/info.svg">
                                        </a>
                                    </td>
                                    <td>
                                        <a id="btn_evolucion_${valueOfElement['user_id']}" onclick="datosPaciente(${valueOfElement['user_id']})"class="h4 cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}/image/system/icono-new-evolucion.png">
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="UserCuestInforme.index('.modal-body',${valueOfElement['user_id']})" class="h4 cursor-pointer">
                                            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="${location.origin}/image/system/icono_archivo2.svg">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    `);
                    $(`#col_4_${valueOfElement['user_id']}`).html(`
                        <div class="text-center text-uppercase text-secondary">
                            ${valueOfElement['sexo']}
                        </div>
                    `);
                    $(`#col_5_${valueOfElement['user_id']}`).html(`
                        <div class="text-center text-secondary">
                            ${valueOfElement['edad']}
                        </div>
                    `);
                    /*IMAGEN PAD */
                    UserCuestPad.columnaValor(
                        `#col_pad_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': 1
                        });
                    /*TEMPERATURA*/
                    UserCuestTemperatura.columnaValor(
                        `#col_6_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['temp']
                        });
                    /*FRECUENCIA CARDIACA*/
                    UserCuestFc.columnaValor(
                        `#col_7_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['fc']
                        });
                    /*FRECUENCIA RESPIRATORIA*/
                    UserCuestFr.columnaValor(
                        `#col_8_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['fr']
                        });
                    /*TENSION ARTERIAL*/
                    UserCuestTa.columnaValor(
                        `#col_9_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['ta']['sys'],
                            'valor2': valueOfElement['ta']['dia']
                        });
                    /*GLICEMIA*/
                    UserCuestGl.columnaValor(
                        `#col_10_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['gl']
                        });
                    /*OXIMETRIA*/
                    UserCuestOximetria.columnaValor(
                        `#col_11_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['oxi']
                        });
                    /*OXIGENOTERAPIA*/
                    UserCuestOxigenoterapia.columnaValor(
                        `#col_12_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['oxit']
                        });
                    /*SINTOMA*/
                    UserCuestSintoma.columnaValor(
                        `#col_13_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['sintoma']
                        });

                    /*COVID PCR*/
                    UserCuestPcr.columnaValor(
                        `#col_14_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['pcr']
                        });

                    /*COVID PDR*/
                    UserCuestPdr.columnaValor(
                        `#col_15_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['pdr']
                        });
                    /*COVID ANTG*/
                    UserCuestAntg.columnaValor(
                        `#col_16_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['antg']
                        });

                    /*COVID TAC*/
                    UserCuestTac.columnaValor(
                        `#col_17_${valueOfElement['user_id']}`, {
                            'user_id': valueOfElement['user_id'],
                            'valor': valueOfElement['tac']
                        });


                });
            }
        } else {
            $("#row_paciente").html(`
                <tr>
                    <td colspan="18" class="text-center p-3 text-primary">
                        No se encontraron pacientes
                    </td>
                </tr>
            `);
        }
        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
        })
        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
        })
    }
    viewPendientes(selector) {

        $(selector).html(`
            <div class="container-fluid sticky-top">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <div class="h1 text-primary">
                            Nuevos pacientes

                            <button onclick="window.location=''" type="button" class="m-1 text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                                Total P2 <span id="total_prioridad2" class="badge badge-light">0</span>
                            </button>
                            <button onclick="window.location=''" type="button" class="m-1 text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                                Total P1 <span id="total_prioridad1" class="badge badge-light">0</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg6 ">
                        <div class="h3 text-primary">
                            Prioridad 1
                        </div>
                        <div class="table-responsive-lg">
                            <table class="w-100 table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Nombre del paciente">Paciente</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Teléfono del contacto">Teléfono</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Temperatura al momento del registro">Temp</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Oximetría al momento del registro">Oxi</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Vía de contácto con la institución">Ubicación</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="row_prioridad1">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg6 ">
                        <div class="h3 text-primary">
                            Prioridad 2
                        </div>
                        <div class="table-responsive-lg">
                            <table class="w-100 table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Nombre del paciente">Paciente</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Teléfono del contacto">Teléfono</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Temperatura al momento del registro">Temp</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Oximetría al momento del registro">Oxi</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important" data-tippy-content="Vía de contácto con la institución">Ubicación</th>
                                        <th class="text-center bg-gray p-2 sticky-top" style="color: var(--primary) !important">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="row_prioridad2">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `);
        Component.viewListado("prioridad1", "/vistas/v_prioridad_1")
        Component.viewListado("prioridad2", "/vistas/v_prioridad_2")
       // let prioridad1 = get( location.origin+"/vistas/v_prioridad_1");
        //let prioridad2 = get( location.origin+"/vistas/v_prioridad_2");


        tippy('[data-tippy-content]', {
            theme: 'tooltip-cmdlt-primary',
        })
    }
    notification(selector, data) {
        $(selector).append(`
            <button data-area="${data.area}" data-titlearea="${data.name}" type="button" class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                ${data.name} <span style="font-size: 96%;" class="badge badge-light text-secondary">${data.cantidad}</span>
            </button>
        `);
    }
    viewListado(selector, vista) {
        get(vista)
            .then(response => {
                let row = "";
                $("#total_" + selector).html(response.length)
                $("#row_" + selector).empty()
                if (response.length > 0) {
                    $.each(response, function(indexInArray, valueOfElement) {
                        row += `
                        <tr id="row_${valueOfElement['user_id']}">
                            <td class="text-center">${valueOfElement['paciente']}</td>
                            <td class="text-center">${valueOfElement['celular']}</td>
                            <td class="text-center">${valueOfElement['temperatura']!=""?valueOfElement['temperatura']+'°C':''}</td>
                            <td class="text-center">${valueOfElement['oximetria']!=""?valueOfElement['oximetria']+'%':''}</td>
                            <td class="text-center">${valueOfElement['ubicacion']}</td>
                            <td style="width:2em;">
                            <div class="d-flex">
                                <div>
                                    <a data-id="${valueOfElement['user_id']}" class="btn btn-block btn-default btn-read-${valueOfElement['user_id']}"><i class="fas fa-search text-primary" data-tippy-content="Ver cuestionario"></i></a>

                                </div>
                                <div>
                                    <a data-id="${valueOfElement['user_id']}" class="btn btn-block btn-default btn-move-${valueOfElement['user_id']}"><i class="fas fa-share-square text-primary" data-tippy-content="Trasladar"></i></a>

                                </div>
                            </div>
                                <!--<a data-id="${valueOfElement['user_id']}" class="btn btn-default btn-delete-${valueOfElement['user_id']}"><i class="fas fa-trash text-primary" data-tippy-content="Eliminar"></i></a>-->
                            </td>
                        </tr>
                        `;

                    });

                    $("#row_" + selector).html(row)

                    $.each(response, function(indexInArray, valueOfElement) {
                        $(`.btn-read-${valueOfElement['user_id']}`).on("click", function() {
                            UserCuestPaciente.edit('.modal-body', $(this).data('id'))
                                //UserCuestObservacion.create(".modal-body", $(this).data('id'))
                        });
                        $(`.btn-delete-${valueOfElement['user_id']}`).on("click", function() {
                            alert("No disponible aún.")
                        });
                        $(`.btn-move-${valueOfElement['user_id']}`).on("click", function() {
                            let ingreso = "Ingreso";

                            UserCuestUbicacion.create3(".modal-body", $(this).data('id'))
                        });
                    });
                } else {
                    $("#row_" + selector).html(`
                    <tr>
                        <td colspan="7" style="font-size: 1.6em;" class="text-center text-primary">
                            No se encontraron pacientes
                        </td>
                    </tr>
                `)
                }
            })
    }
}

