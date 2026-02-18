


import {get,is_empty,post,timestamps,equalsInt,meses,is_null,activarTooltip,is_undefined,fechaCortaCustom2,fechaCortaCustom1, getFileExtension1} from "../helpers/helpers.js";
import UserCuestPendiente from "./UserCuestPendiente.js";
let userCuestPendiente = new UserCuestPendiente()
let onOffBlueCode = async (user_id) => {
    if ($(`#blue_code_${user_id}`).val()==1) {
        get( location.origin+"/user_cuest_episodio/blue_code/"+user_id+"/0")
        .then(response=>{

            $(`#blue_code_${user_id}`).val(0)

            $(`#ico_blue_code_${user_id}`).css("color","var(--danger)")
            $(`#ico_blue_code_${user_id}`).removeClass("pc-fa-blue-code-on")
            $(`#ico_blue_code_${user_id}`).addClass("pc-fa-blue-code-off")
            $(`#ico_blue_code_${user_id}`).attr('title',"Código azul DESACTIVADO")
        })

    }else{
        get( location.origin+"/user_cuest_episodio/blue_code/"+user_id+"/1")
        .then(response=>{

            $(`#blue_code_${user_id}`).val(1)


             $(`#ico_blue_code_${user_id}`).css("color","var(--primary)")
             $(`#ico_blue_code_${user_id}`).removeClass("pc-fa-blue-code-off")
             $(`#ico_blue_code_${user_id}`).addClass("pc-fa-blue-code-on")
            $(`#ico_blue_code_${user_id}`).attr('title',"Código azul ACTIVADO")

        })

    }

}
const listGoup = ({
    eventEliminar   = "",
    eventUpdateField   = "",
    eventCompletar   = "",
    created_at      = "00/00/000",
    description     = "Description",
    tagDescription1=    true,
    tagDescription2=  false,
    description2     = "",
    titleImg        = "https://placeimg.com/30/30/any",
    destroy         = true,
    completar         = false,
    edit            = false,
    especialidad    = "Especialidad no indicada",
    hora            = "00:00 PM",
    id              = 0,
    posicion        = "Posición no indicada",
    posicionColor   = "No indicado",
    tagArchivo      = false,
    tagColor        = "primary",
    tagTitleImg     = false,
    tagDescription  = false,
    tagEspecialidad = false,
    tagPosicion     = false,
    tagTelefono     = false,
    tagTime         = false,
    tagTitle        = false,
    telefono        = "Teléfono no indicado",
    tipoArchivo     = null,
    registromedico           = "",
    title           = "Sample Sample Sample",
    model           = 'sample'
}) => {
    return  `

            <li id="row_${id}_${model}" class="list-group-item p-0">
                <div class="d-flex flex-row  justify-content-between">
                    <div class="p-2 bd-highlight" style="width: 90%;">
                        <!--Titulo tarjeta-->
                        <div class="d-inline-flex align-middle">
                            <div class="${tagTitleImg?'':'d-none'} pr-2">
                                <img src="${location.origin}${titleImg}" style="width: 2em;height: 2em;" alt="foto medico" onerror="this.src = '/image/system/medic.svg'" class="rounded-circle p-0 img-thumbnail">
                            </div>
                            <div class="${tagTitle?'':'d-none'} text-${tagColor} font-weight-bold">
                                ${title}
                            </div>
                        </div>

                        <!--campo-valor tarjeta-->
                        <div id="update_${id}_${model}" style="display:none">
                            <textarea id="input_${id}_${model}" rows="10" class="form-control" style="color:var(--primary) !important">${description}</textarea>
                            <button onclick="${eventUpdateField}" class="btn btn-primary mt-1 btn-block btn-sm">Actualizar</button>
                        </div>

                        <!--descripcion tarjeta-->
                        <div id="description_${id}_${model}" class="${tagDescription?'':'d-none'}" style="font-size:1em" >
                            <div class="${tagDescription1?'':'d-none'}">${description}</div>
                            <div class="${tagDescription2?'':'d-none'}">${description2}</div>
                        </div>

                        <!--archivos-->
                        <div class="${tagArchivo ?'':'d-none'}">
                            ${formatImage(description,tipoArchivo)}
                        </div>

                        <!--dia y fecha-->
                        <div class="${tagTime?'':'d-none'} float-right text-primary" style="font-size:0.9em">
                            <span data-tippy-content="${registromedico}" class="badge badge-gray tooltip-primary text-primary">
                                <i class="far fa-clock"></i> ${created_at} <span class="text-primary">|</span> ${hora}
                            </span>
                        </div>

                        <!--etiquetas-->
                        <div>
                            <span class="${tagPosicion?'':'d-none'} badge-custom tooltip-${posicionColor} badge-pill badge-${posicionColor}"  data-tippy-content="Posición o cargo: ${posicion}">${posicion}</span>

                            <span class="${tagEspecialidad?'':'d-none'} badge-custom tooltip-primary badge-pill badge-primary"  data-tippy-content="Especialidad: ${especialidad}">${especialidad}</span>

                            <button class="${tagTelefono?'':'d-none'} btn btn-outline-primary btn-small-custom tooltip-primary"  data-tippy-content="Teléfono contacto del médico: ${telefono}" onclick="window.open('https://api.whatsapp.com/send?phone=${telefono}')"><i class="fab fa-whatsapp text-success"></i> ${telefono}</button>
                            </span>
                        </div>

                    </div>

                    <div class="p-2 bd-highlight">
                        <!--<i class="${edit?'':'d-none'} tooltip-primary fas fa-edit text-primary heartbeat cursor-pointer"  onclick="showHide('#update_${id}_${model}');showHide('#description_${id}_${model}')"  data-tippy-content="Editar"></i>
                        <i onclick="${eventEliminar}" class="${destroy?'':'d-none'} tooltip-danger fas fa-minus-square text-danger heartbeat cursor-pointer" data-tippy-content="Eliminar"></i>-->
                        <i onclick="${eventCompletar}" class="${completar?'':'d-none'} tooltip-success fas fa-clipboard-check text-success heartbeat cursor-pointer" data-tippy-content="Completar"></i>
                    </div>
                </div>
            </li>

    `;
}

const formatImage = (url,tipoArchivo) => {
    switch (tipoArchivo) {
        case 'jpeg':
            return `<a href="/${url}" target="_black"><img src="${location.origin}/${url}" style="width:4em;height:4em" class="img-fluid heartbeat cursor-pointer" onerror="this.src='https://via.placeholder.com/150'"></a>`;
            break;
        case 'jpg':
            return `<a href="/${url}" target="_black"><img src="${location.origin}/${url}" style="width:4em;height:4em" class="img-fluid heartbeat cursor-pointer" onerror="this.src='https://via.placeholder.com/150'"></a>`;
            break;
        case 'png':
            return `<a href="/${url}" target="_black"><img src="${location.origin}/${url}" style="width:4em;height:4em" class="img-fluid heartbeat cursor-pointer" onerror="this.src='https://via.placeholder.com/150'"></a>`;
            break;
        case 'pdf':
            return `<a href="/${url}" target="_black"><img src="${location.origin}/image/system/icono_archivo.svg" style="width:4em;height:4em" class="img-fluid heartbeat cursor-pointer" onerror="this.src='https://via.placeholder.com/150'"></a>`;
            break;
        case null:
            return ``
        break;
        default:
            return `<a href="/${url}" target="_black"><img src="${location.origin}/image/system/icono_archivo.svg" style="width:4em;height:4em" class="img-fluid heartbeat cursor-pointer" onerror="this.src='https://via.placeholder.com/150'"></a>`;
        break;
    }
}
export default class UserCuestEpisodio{
   //static modelTitle ="Episodio";
   //static classModel ="UserCuestEpisodio";
   //static prefixRoute = "user_cuest_episodio";
    static modelTitle(){
        return "Episodio";
    }
    static classModel(){
        return "UserCuestEpisodio";
    }
    static prefixRoute(){
        return "user_cuest_episodio";
    }
    static index({selector=".modal-body", user_id}) {
        //incio component
        let model = UserCuestEpisodio.classModel();

        Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: UserCuestEpisodio.modelTitle(),

                //selector: identificador html en donde se va a pintar el componente
                selector,

                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.
                eventModelCreate: model+".create({user_id:"+user_id+"})",

                //eventModelContent: contenido del modelo que se esta mostrando
                eventModelContent: "Component.modelIndex_1({user_id:"+user_id+",columName:['"+UserCuestEpisodio.modelTitle()+"'],classModel:'"+model+"'})",

                //eventModelFooter: opciones del modelo que se esta mostrando
                eventModelFooter:"UserCuestHistoria.regresar({user_id:"+user_id+"})"

                //si se está en la otra vista que no sea index,
                //se le pasa el parametro btn_create:false
                //para que no muestre el botón de crear
            },
            function () {

            }
        );
        //fin component
    }
    static indexEpisodioCIE11({selector=".modal-body", user_id}) {
        //incio component
        let model = UserCuestEpisodio.classModel();

        Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: "Clasificador CIE-11 <br><span class='h4'>Egresos sin clasificar</span>",

                //selector: identificador html en donde se va a pintar el componente
                selector,

                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.
                eventModelCreate: model+".create({user_id:"+user_id+"})",

                //eventModelContent: contenido del modelo que se esta mostrando
                //eventModelContent: "Component.modelIndex_2({tableId:'"+model+"table',user_id:"+user_id+",columName:['Paciente','Ingreso', 'Egreso'],classModel:'"+model+"'})",

                //eventModelFooter: opciones del modelo que se esta mostrando
                eventModelFooter:"Component.btn_closeModal({})",

                //btn_create:false  oculta el boton
                btn_create:false,

                datatable:true,

                headerPaciente:false
                //si se está en la otra vista que no sea index,
                //se le pasa el parametro btn_create:false
                //para que no muestre el botón de crear
            },
            function () {
                let columName=['Paciente','Cédula','Ingreso', 'Egreso'];
                Component.modelIndex_2({
                    tableId: model+'table',
                    user_id:user_id,
                    columName,
                    datatablereportes:true
                },function () {
                    eval( model +".episodioPendiente()" )
                    .then(response=>{
                        cl(response)
                        let filas = "";
                        if (Object.keys(response).length > 0) {
                            let tempRow = "";
                            $(response).each(function(index, element) {
                                tempRow = `
                                    <tr id="temp_${element.id}">

                                        <td class="text-secondary" >
                                            ${element.paciente}
                                        </td>
                                        <td class="text-secondary" >
                                            ${element.cedula}
                                            <div class="d-none">
                                                ${element.cedula_original}
                                            </div>
                                        </td>
                                        <td class="text-secondary text-center" >
                                            ${element.ingreso}
                                        </td>
                                        <td class="text-secondary text-center" >
                                            ${element.egreso}
                                        </td>

                                        <td style="width: 60px;" align="center">
                                            <a data-tippy-content="Clasificación CIE-11" target="_blank" class="btn tooltip-primary btn-light" onclick="window.open('/clasificador_cie11/${element.user_id}/${element.id}')" ><i class="fas fa-book-medical text-primary"></i></a>
                                        </td>
                                    </tr>
                                `;
                                filas = filas + tempRow
                            });
                        }else{
                            filas = `
                                <tr>
                                    <td colspan="${columName.length +1}" class="text-center text-primary">Sin registros</td>
                                </tr>
                            `;
                        }
                        $("#filas").html(filas)

                        $(".delete-row").on("click", function () {
                            let c = confirm("¿Seguro que desea eliminar este registro?")
                            if (c) {
                                let id = $(this).data('id')
                                eval( classModel() +".eliminar({id:"+id+",user_id:"+user_id+"})" )
                            }

                        });

                        activarTooltip()
                        $(`#${model+'table'}`).DataTable({
                            dom: 'Bfrtip',
                            buttons: ['excel','pdf']/*'copy','csv','print'*/
                        });

                    });
                })

            }
        );
        //fin component
    }
    static indexEntregaGuardia({selector=".modal-body", user_id}) {
        //incio component
        let model = UserCuestEpisodio.classModel();

        Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: "Entrega de guardia <br><span class='h4'></span>",

                //selector: identificador html en donde se va a pintar el componente
                selector,

                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.
                //eventModelCreate: model+".menuEntregaGuardia({user_id:"+user_id+"})",

                //eventModelContent: contenido del modelo que se esta mostrando
                //eventModelContent: "Component.modelIndex_2({tableId:'"+model+"table',user_id:"+user_id+",columName:['Paciente','Ingreso', 'Egreso'],classModel:'"+model+"'})",

                //eventModelFooter: opciones del modelo que se esta mostrando
                eventModelFooter:"Component.btn_closeModal({})",

                //btn_create:false  oculta el boton
                btn_create:false,

                datatable:true,

                headerPaciente:false
                //si se está en la otra vista que no sea index,
                //se le pasa el parametro btn_create:false
                //para que no muestre el botón de crear
            },
            function () {
                UserCuestEpisodio.menuEntregaGuardia({})

            }
        );
        //fin component
    }
    static menuEntregaGuardia({
        selector='.modal-body'
    }) {

        let area = [

            {title:"TP",  evento:`redireccionar('tp')`},
            {title:"EA",  evento:`redireccionar('ea')`},
            {title:"ECVD",evento:`redireccionar('ecvd')`},
            {title:"EP",evento:`redireccionar('ep')`},
            //{title:"AQ",evento:`redireccionar('aq')`},
            //{title:"HP2", evento:`redireccionar('hp2')`},
            {title:"HP3", evento:`redireccionar('hp3')`},
            {title:"HP4", evento:`redireccionar('hp4')`},
            {title:"HP5", evento:`redireccionar('hp5')`},
            {title:"HP6", evento:`redireccionar('hp6')`},
            {title:"UTIA",evento:`redireccionar('utia')`},
            {title:"UTICVD",evento:`redireccionar('uticvd')`},
            {title:"UTIP",evento:`redireccionar('utip')}`},
            {title:"PAD",evento:`redireccionar('pad')`},
        ];
        let grupoCard = "";
        area.forEach(x=>{
            grupoCard += `
                <div class="col-xs-4 col-md-4 col-lg-4 mb-4">
                    ${customCard({title:x.title,evento:x.evento})}
                </div>
            `;
        })
        console.log(area)
        $(selector).html(`
            <div>
                <h1 class="text-primary text-center">
                    Seleccione un área
                </h1>
            </div>
            <div class="row row-cols-sm-3 row-cols-md-3 row-cols-lg-3 row-cols-xl-3 justify-content-center" style="max-height: 60vh;overflow: auto;" >
                ${grupoCard}
            </div>

            <div class="botones-bottom-modal">
                <div>
                    <a class='btn bg-primary text-primary btn-block btn-lg' data-dismiss="modal" aria-label="Close">Cerrar</a>
                </div>
            </div>
        `);
    }
    static listadoEntrega({
        selector='#filasPacientes',
        area_id =[],
        pacientes_datos
    }) {

                // console.clear()
                $("#cargando").css("display","flex")
                $("#example,#sinresultados").css("display","none")
                $("#total_paciente").html(0)
                let configDatatable = ()=>{
                    table = $('#example').DataTable( {
                        dom: '<"dom_wrapper fh-fixedHeader" Bf>tip',
                        //responsive: true,
                        //scrollY:        '73vh',
                        //searching: false,
                        //ordering: false,
                        order:[ 0, 'asc' ],
                        buttons: [
                            {extend: "excel", className: "d-none"},
                            {extend: "pdf", className: "d-none"},
                            {extend: "print", className: "d-none"}
                        ],
                        bInfo : false,
                        scrollY:        "71.2vh",
                        scrollX:        true,
                        //fixedColumns:   {
                        //    left: 1
                        //},
                        //scrollCollapse: true,
                        paging:         false,
                    });


                    $('a.toggle-vis').on( 'click', function (e) {
                        //e.preventDefault();
                        //showHide(".DTFC_Cloned")

                        // Get the column API object
                        //var column = table.column( $(this).attr('data-column') );

                        // Toggle the visibility
                        //column.visible( ! column.visible() );
                    } );
                    $('#search').on('change',function (param) {
                        table.search($(this).val()).draw() ;
                    })

                }
                let filas = ` `;
                $(selector).html(filas);

                setTimeout(function(){
                    let model =[];
                    console.log(area_id)
                    if (area_id.length > 0) {
                        area_id.forEach((y,index)=>{

                            pacientes_datos.forEach(x =>{
                                if (x.parent_cat_user_ubicacion_id === y) {
                                    model.push(x)
                                }
                            })


                        })

                    }else{
                        model = pacientes_datos;
                    }

                    if (model.length > 0) {
                        filas = "";
                        model.forEach(element => {
                            let listadoMed = `<ul class="list-group list-group-flush" style="width:20em;">`;
                                element.medico_paciente.forEach(x=>{

                                listadoMed += listGoup(
                                    {
                                        /*
                                            Tarjeta medico:
                                            Nombre, especialidad, telefono, posicion
                                        */
                                        eventEliminar  : `UserCuestMedicoPaciente.eliminar(${x.id},${element.user_id})`,
                                        tagTitle       : true,
                                        tagTitleImg    : true,
                                        titleImg       : x.medico_img,
                                        title          : x.medico,
                                        tagPosicion    : true,
                                        posicion       : x.posicion,
                                        tagEspecialidad: true,
                                        especialidad   : x.especialidad,
                                        tagTelefono    : true,
                                        telefono       : x.telefono_movil,
                                        id             : x.id,
                                        posicionColor  : x.tagColor,
                                        model          : 'medico'
                                    }
                                );
                                });
                                listadoMed += `</ul>`;

                            let listadoImpDiagn = `<ul class="list-group list-group-flush" style="width:20em;">`;
                                element.resultados.forEach(x=>{
                                    let f = new Date(x.created_at);
                                    let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                                    if (x.description ==="Probabilidad diagnóstica")
                                    {

                                        listadoImpDiagn += listGoup(
                                            {
                                                edit      : true,
                                                tagTitle      : true,
                                                title         : "Probabilidad Diagnóstica",
                                                tagDescription: true,
                                                description   : x.value,
                                                tagTime       : true,
                                                created_at    : fecha,
                                                hora          : x.hora,
                                                registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                                id            : x.id,
                                                model         : "impDiagn",
                                                eventUpdateField:`UserCuestImpresionDiagnostica.update2(${element.user_id},${x.id},'impDiagn')`,
                                                eventEliminar : `UserCuestImpresionDiagnostica.destroy2(${element.user_id},${x.id})`,
                                            }
                                        );
                                    }
                                });
                                listadoImpDiagn += `</ul>`;
                            let listadoEvolucion = `<ul class="list-group list-group-flush" style="width:20em;">`;
                                element.resultados.forEach(x=>{
                                    let f = new Date(x.created_at);
                                    let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                                    if (x.description ==="Evolución")
                                    {

                                        listadoEvolucion += listGoup(
                                            {
                                                //edit      : true,
                                                destroy      : false,
                                                tagTitle      : true,
                                                title         : "Evolución",
                                                tagDescription: true,
                                                description   : x.value,
                                                tagTime       : true,
                                                created_at    : fecha,
                                                hora          : x.hora,
                                                registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                                id            : x.id,
                                                model         : "evolucion",
                                                eventUpdateField:`UserCuestEvolucion.update2(${element.user_id},${x.id},'evolucion')`,
                                                eventEliminar : `UserCuestEvolucion.destroy2(${element.user_id},${x.id})`,
                                            }
                                        );
                                    }
                                });
                                listadoEvolucion += `</ul>`;
                            let listadoPlan = `<ul class="list-group list-group-flush" style="width:20em;">`;
                                element.resultados.forEach(x=>{
                                    let f = new Date(x.created_at);
                                    let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                                    if (x.description ==="Plan")
                                    {

                                        listadoPlan += listGoup(

                                            {
                                                edit      : true,
                                                tagTitle      : true,
                                                title         : x.description,
                                                tagDescription: true,
                                                description   : x.value,
                                                tagTime       : true,
                                                created_at    : fecha,
                                                hora          : x.hora,
                                                registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                                id            : x.id,
                                                model         : "plan",
                                                eventUpdateField:`UserCuestPlan.update2(${element.user_id},${x.id},'plan')`,
                                                eventEliminar : `UserCuestPlan.destroy2(${element.user_id},${x.id})`,
                                            }
                                        );
                                    }
                                });
                                listadoPlan += `</ul>`;

                            let listadoResultado = `<ul class="list-group flex-column-reverse list-group-flush" style="width:20em;">`;
                            element.resultados.forEach(x=>{

                                let f = new Date(x.created_at);
                                let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                                if (
                                    x.description !=="Probabilidad diagnóstica" &&
                                    x.description !=="Observación" &&
                                    x.description !=="Evolución" &&
                                    x.description !=="Pendiente" &&
                                    x.description !=="Plan"

                                    )
                                {
                                    let tipo = x.description.substring(0,3);
                                    listadoResultado += listGoup(
                                        {
                                            created_at    : fecha,
                                            description   : x.value,
                                            description2   : x.coments,
                                            destroy:false,
                                            eventEliminar : `UserCuestPlan.destroy2(${element.user_id},${x.id})`,
                                            hora          : x.hora,
                                            id            : x.id,
                                            model         : "result"+tipo,
                                            registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                            tagArchivo:true,
                                            tagDescription: true,
                                            tagDescription1:false,
                                            tagDescription2:true,
                                            tagTime       : true,
                                            tagTitle      : true,
                                            tipoArchivo:getFileExtension1(x.value),
                                            title         : x.description,
                                        }
                                    );
                                }
                            });
                            listadoResultado += `</ul>`;

                            let listadoPendiente = `<ul id="listado_pendiente_${element.user_id}" class="list-group list-group-flush" style="width:20em;">`;
                            element.resultados.forEach(x=>{
                                let f = new Date(x.created_at);
                                let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();

                                if ( x.description === "Pendiente")
                                {

                                    let tipo = x.description.substring(0,3);

                                    listadoPendiente += listGoup(
                                        {
                                            eventCompletar:`UserCuestPendiente.update2(${element.user_id},${x.id},'pendiente')`,
                                            completar:true,
                                            tagTitle      : true,
                                            title         : x.value,
                                            tagDescription: true,
                                            description   : x.coments,

                                            destroy:false,
                                            tagTime       : true,
                                            created_at    : fecha,
                                            hora          : x.hora,
                                            registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                            id            : x.id,
                                            model         : "pendiente",
                                            eventEliminar : `UserCuestPlan.destroy2(${element.user_id},${x.id})`,
                                        }
                                    );
                                }
                            });
                            listadoPendiente += `</ul>`;


                            let f = new Date(element.ingreso_episodio);
                            let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                            let fechaIngreso = f.getFullYear() + "-" + ("0" + (f.getMonth()+1)).slice(-2) + "-" + ("0" + f.getDate()).slice(-2);
                            let blue_code = element.codigo_azul;
                            //console.log(element.episodio)
                            filas +=`
                                <tr class="row-${element.parent_cat_user_ubicacion_id}" style="border-bottom: 3px solid #dee2e6 !important;">
                                    <td class="d-none">
                                        ${element.ubicacion}
                                    </td>
                                    <td class="text-center">
                                        <div class='container-fluid border rounded'>
                                            <div class='d-flex flex-row  p-1' style='height:100%'>
                                            <div class='p-1 flex-fill align-self-start flex-grow-1 border-right'>
                                                <div class='d-flex flex-row justify-content-center p-1 border-bottom'>
                                                    <div class="d-flex" style="align-items: center;">
                                                        <div class="mx-1 mb-1">
                                                            <img onerror="this.src='/image/system/icono-paciente-blanco.svg';" src="${element.imagen}"
                                                                style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente"
                                                                class="tooltip-primary border border-primary rounded-circle mx-auto d-block" alt="...">

                                                        </div>
                                                        <div>
                                                            <div>
                                                                <h4 data-tippy-content="Nombre del paciente" class="tooltip-primary text-primary"
                                                                    style="margin-bottom: 0;">
                                                                    ${element.paciente}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='d-flex justify-content-center p-1'>
                                                    <div class='d-flex p-1 flex-fill  align-self-start'>
                                                        <div class='d-flex  flex-column flex-fill align-items-center p-1'>
                                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                                <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                                            </div>
                                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                                <div class="text-gray text-nowrap overflow-hidden">
                                                                    ${element.cedula.replace('.', '').replace('.', '')}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='d-flex flex-column  flex-fill align-items-center p-1 border-left border-right'>
                                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                                <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                                            </div>
                                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                                <div class="text-gray">
                                                                    ${element.edad}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='d-flex flex-column flex-fill align-items-center p-1'>
                                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                                <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                                            </div>
                                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                                <div class="text-gray">
                                                                    ${element.sexo.toUpperCase()}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='p-1 flex-fill align-self-start'>
                                                <div class='d-flex flex-column align-items-center p-1'>
                                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                                        <b class="text-primary" style="font-size:0.9em;">Fecha ingreso</b>
                                                    </div>
                                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                                        <div class="text-gray text-nowrap overflow-hidden">
                                                            <input
                                                                class="tooltip-primary cursor-pointer"
                                                                data-tippy-content="Fecha de ingreso: ${fecha}"
                                                                onchange="UserCuestEpisodio.update3(this.id,${element.episodio},${element.user_id})"
                                                                id="ingreso${element.user_id}"
                                                                style="
                                                                    border: 1px solid var(--gray);
                                                                    background-color: transparent;

                                                                    color: var( --secondary);
                                                                    text-align: center;
                                                                    border-radius: 50px;" type="date"
                                                                value="${fechaIngreso}">

                                                            <small id="help_ingreso_${element.user_id}"></small>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='d-flex flex-column align-items-center p-1'>
                                                    <div class='d-flex p-1 flex-fill text-nowrap justify-content-center'>
                                                        <b class="text-primary" style="font-size:0.9em;">
                                                            Ubicación Actual
                                                            <span class="badge-gray tooltip-primary text-primary p-1 rounded" style="font-size: 0.9em;" data-tippy-content="Días en el área">
                                                                ${element.dias}
                                                            </span>
                                                        </b>
                                                    </div>
                                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                                        <div class="text-gray text-nowrap overflow-hidden">
                                                            ${element.ubicacion}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='d-flex flex-column align-items-center p-1'>
                                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                                        <b class="text-primary" style="font-size:0.9em;">Teléfono Contacto</b>
                                                    </div>
                                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                                        <button
                                                            class="btn btn-outline-primary text-nowrap btn-sm tooltip-primary"
                                                            data-tippy-content="Teléfono contacto del paciente: ${element.telefono_movil}"
                                                            onclick="window.open('https://api.whatsapp.com/send?phone=${element.telefono_movil}')">
                                                            <i class="fab fa-whatsapp text-success"></i> ${element.telefono_movil}
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>





                                        <!--
                                            <div>
                                                ${element.paciente}
                                            </div>
                                            <div>
                                                <b class="tooltip-primary text-secondary" data-tippy-content="Edad">
                                                ${element.edad} Años
                                                </b>
                                            </div>

                                            <div class="mt-1">
                                                <span class="tooltip-primary ml-2 badge badge-gray text-primary"  data-tippy-content="Cédula de identidad" style="line-height: inherit;font-size: 1em;">
                                                    <b>${element.cedula.replace('.', '').replace('.', '')}</b>
                                                </span>
                                            </div>
                                            <div class="mt-1">

                                                <button class="btn btn-outline-primary tooltip-success" data-tippy-content="Teléfono contacto del paciente: ${element.telefono_movil}" onclick="window.open('https://api.whatsapp.com/send?phone=${element.telefono_movil}')"><i class="fab fa-whatsapp text-success"></i> ${element.telefono_movil}</button>

                                            </div>-->

                                    </td>
                                    <!--


                                    <td nowrap class="text-center">
                                        <div>
                                            ${fecha}
                                        </div>
                                        <div>
                                            <span class="tooltip-primary ml-2 badge badge-gray text-secondary"  data-tippy-content="Días desde el ingreso" style="line-height: inherit;">
                                                ${element.dias} días
                                            </span>
                                        </div>

                                    </td>-->
                                    <td class="p-1">
                                        <div style="max-height: 20em;overflow: auto;">
                                            ${listadoMed}
                                        </div>

                                    </td>


                                    <td class="p-1">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0">
                                                <div class="d-flex p-1 form-impresion_diagnostica-user_${element.user_id}">

                                                    <div class="flex-grow-1">
                                                        <input type="hidden" name="model" data-name="Probabilidad diagnóstica" value="user_cuest_impresion_diagnostica" >
                                                        <input type="text" name="comentario" class="form-control" placeholder="Escribe una Prob. Diagnóstica    ." >
                                                    </div>
                                                    <div >
                                                        <button type="button" data-type="impresion_diagnostica"  data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" data-tippy-content="Guardar" class="btn-impresion_diagnostica-store btn btn-outline-success tooltip-primary ml-1">
                                                            <i  data-type="impresion_diagnostica" data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" class="far fa-save btn-impresion_diagnostica-store"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="impresion_diagnostica-listado-${element.user_id}" style="max-height: 20em;overflow: auto;">
                                            ${listadoImpDiagn}
                                        </div>
                                    </td>
                                    <td class="p-1">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0">
                                                <div class="d-flex p-1 form-evolucion-user_${element.user_id}">

                                                    <div class="flex-grow-1">
                                                        <input type="hidden" name="model" data-name="Evolución" value="user_cuest_evolucion" >
                                                        <input type="text" name="comentario" class="form-control" placeholder="Escribe una evolución." >
                                                    </div>
                                                    <div >
                                                        <button type="button" data-type="evolucion"  data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" data-tippy-content="Guardar" class="btn-evolucion-store btn btn-outline-success tooltip-primary  ml-1">
                                                            <i  data-type="evolucion" data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" class="far fa-save btn-evolucion-store"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="evolucion-listado-${element.user_id}" style="max-height: 20em;overflow: auto;">
                                            ${listadoEvolucion}
                                        </div>
                                    </td>
                                    <td class="p-1">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0">
                                                <div class="d-flex p-1 form-plan-user_${element.user_id}">

                                                    <div class="flex-grow-1">
                                                        <input type="hidden" name="model" data-name="Plan" value="user_cuest_plan" >
                                                        <input type="text" name="comentario" class="form-control" placeholder="Escribe un plan" >
                                                    </div>
                                                    <div >
                                                        <button type="button" data-type="plan" data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" data-tippy-content="Guardar" class="btn-plan-store btn btn-outline-success tooltip-primary  ml-1">
                                                            <i data-type="plan" data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" class="far fa-save btn-plan-store"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="plan-listado-${element.user_id}" style="max-height: 20em;overflow: auto;">
                                            ${listadoPlan}
                                        </div>
                                    </td>
                                    <td class="p-1">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0">
                                                <div class="d-flex flex-column p-1 form-resultados-user_${element.user_id}">
                                                    <div>
                                                        <div class="d-flex">
                                                            <div class="flex-fill">

                                                                <select name="tipo_resultado" class="form-control rounded-0" style="border-radius: 3px 0px 0px 0px !important;">
                                                                    <option value="">Resultado</option>
                                                                    <option value="Laboratorio">Laboratorio</option>
                                                                    <option value="Imagen">Imagen</option>
                                                                    <option value="Fotografía">Fotografía</option>
                                                                    <option value="Otro archivo">Otro archivo</option>
                                                                </select>
                                                            </div>
                                                            <div class="flex-fill">
                                                                <input type="text" name="comentario" class="form-control rounded-0" placeholder="Escribe un comentario" style="border-left: 0;border-right: 0;">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <button type="button" data-type="plan" data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" style="border-radius: 0px 3px 0px 0px;" data-tippy-content="Guardar Resultado" class="btn-resultado-store btn btn-outline-success tooltip-primary btn-flat">
                                                                    <i data-episodio_id="${element.episodio}" data-user_id_paciente="${element.user_id}" class="far fa-save btn-resultado-store"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="file" name="file" class="form-control border-top-0 rounded-bottom" style="height: 43px;border-radius: 0px 0px 3px 3px !important;">
                                                    </div>
                                                </div>



                                            </li>
                                        </ul>
                                        <div class="resultados-listado-${element.user_id}" style="max-height: 20em;overflow: auto;">
                                            ${listadoResultado}
                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-0">
                                                <div class="d-flex p-1">

                                                    <div class="flex-grow-1">
                                                        <input id="privado_${element.user_id}" class="d-none" value="0">
                                                        <input id="coments_${element.user_id}" placeholder="Escribe un nuevo pendiente" class="form-control">
                                                    </div>
                                                    <div >
                                                        <button id="btn_pendiente_create_${element.user_id}" onclick="UserCuestPendiente.store2(${element.user_id})" type="button" data-tippy-content="Guardar" class="btn btn-outline-success tooltip-primary  ml-1">
                                                            <i class="far fa-save"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                        <div style="max-height: 20em;overflow: auto;">
                                           ${listadoPendiente}
                                        </div>

                                    </td>
                                    <td class="p-1 text-center">
                                        <input id="blue_code_${element.user_id}" class="d-none" value="${blue_code}">
                                        <span id="ico_blue_code_${element.user_id}" onclick="onOffBlueCode(${element.user_id})" title="${blue_code ? 'Código azul ACTIVADO':'Código azul DESACTIVADO'}" style="font-size: 4em; color:${blue_code ? 'var(--primary)':'var(--danger)'}" class="${blue_code ? 'pc-fa-blue-code-on':'pc-fa-blue-code-off'} heartbeat cursor-pointer"></span>
                                    </td>
                                    <td>
                                        <buttom onclick="UserCuestUbicacion.egreso('.modal-body',${element.user_id})" class="btn btn-primary btn-block">Alta</buttom>
                                    </td>
                                </tr>`;

                        });
                        $(selector).html(filas);

                        $("#total_paciente").html(model.length)
                        //configDatatable()
                        $("#cargando").css("display","none")
                        $("#example").css("display","block")
                        activarTooltip()







                    }else{

                            $("#sinresultados").css("display","flex")

                            $("#cargando").css("display","none")




                    }
                },500)
                document.addEventListener("click", async function (e) {
                    let {user_id_paciente,episodio_id,type} = e.target.dataset
                    if (e.target.classList.contains("btn-resultado-store")) {
                        let $form = document.querySelector(`.form-resultados-user_${user_id_paciente}`)
                        let file = $form.querySelector("input[name=file]").files[0];
                            //console.log("type_file",type_file)
                        let comentario = $form.querySelector("input[name=comentario]")
                            //console.log("comentario",comentario)
                        let tipo_resultado = $form.querySelector("select[name=tipo_resultado]")
                            //console.log("tipo_resultado",tipo_resultado)

                            if (tipo_resultado.value === "") {
                                alert("No has seleccionado un tipo de resultado.")
                                tipo_resultado.focus()
                                return false
                            }
                            if (comentario.value === "") {
                                alert("No has escrito un comentario.")
                                comentario.focus()
                                return false
                            }
                        let formdata = new FormData();
                            formdata.append("coments", comentario.value)
                            formdata.append("file", file)
                            formdata.append("episodio_id", episodio_id)
                            formdata.append("user_id", user_id_paciente)
                            formdata.append("_token", $("#_token").val())
                            formdata.append("created_at", timestamps())
                        let result
                            if (tipo_resultado.value =="Laboratorio") {
                                result = await post( location.origin+"/user_cuest_laboratorio/store", formdata)
                            }
                            if (tipo_resultado.value =="Imagen") {
                                result = await post( location.origin+"/user_cuest_imagen/store", formdata)
                            }
                            if (tipo_resultado.value =="Fotografía") {
                                result = await post( location.origin+"/user_cuest_fotografia/store", formdata)
                            }
                            if (tipo_resultado.value =="Otro archivo") {
                                result = await post( location.origin+"/user_cuest_otro_archivo/store", formdata)
                            }

                            Object.assign(result, {"description": tipo_resultado.value } )
                            //console.log(result)
                        let index = pacientes_datos.findIndex(paciente=>equalsInt(paciente['user_id'],user_id_paciente))
                            pacientes_datos[ index ]['resultados'].push( result )

                            document.querySelector(`.resultados-listado-${user_id_paciente}`).innerHTML = null

                            pacientes_datos[ index ]['resultados'].forEach(resultado=>{
                                let listadoResultado = `<ul class="list-group flex-column-reverse list-group-flush" style="width:20em;">`;
                                    pacientes_datos[ index ]['resultados'].forEach(x=>{

                                        let f = new Date(x.created_at);

                                        let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();

                                            if (
                                                    x.description !=="Probabilidad diagnóstica" &&
                                                    x.description !=="Observación" &&
                                                    x.description !=="Evolución" &&
                                                    x.description !=="Pendiente" &&
                                                    x.description !=="Plan"
                                                )
                                            {
                                                let tipo = x.description.substring(0,3);
                                                    listadoResultado += listGoup(
                                                        {
                                                            tagArchivo:true,
                                                            tipoArchivo:getFileExtension1(x.value),
                                                            tagTitle      : true,
                                                            title         : x.description,
                                                            tagDescription: true,
                                                            description   : x.value,
                                                            tagDescription1:false,
                                                            tagDescription2:true,
                                                            description2   : x.coments,
                                                            destroy:false,
                                                            tagTime       : true,
                                                            created_at    : fecha,
                                                            hora          : x.hora,
                                                            registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                                            id            : x.id,
                                                            model         : "result"+tipo,
                                                            eventEliminar : `UserCuestPlan.destroy2(${user_id_paciente},${x.id})`,
                                                        }
                                                    );
                                            }
                                    });
                                    listadoResultado += `</ul>`;
                                    document.querySelector(`.resultados-listado-${user_id_paciente}`).innerHTML= listadoResultado
                            })
                            comentario.value = ""
                            tipo_resultado.value = ""
                    }
                    if (
                        e.target.classList.contains("btn-plan-store") ||
                        e.target.classList.contains("btn-evolucion-store") ||
                        e.target.classList.contains("btn-impresion_diagnostica-store")
                    ) {

                        let $form = document.querySelector(`.form-${e.target.dataset['type']}-user_${user_id_paciente}`)

                        let comentario = $form.querySelector("input[name=comentario]")
                        let model = $form.querySelector("input[name=model]")

                            if (comentario.value === "") {
                                alert("No has escrito un comentario.")
                                comentario.focus()
                                return false
                            }
                        let formdata = new FormData();
                            formdata.append("value", comentario.value)
                            formdata.append("episodio_id", episodio_id)
                            formdata.append("user_id", user_id_paciente)
                            formdata.append("_token", $("#_token").val())
                            formdata.append("created_at", timestamps())
                        let result;
                            //console.log(model.dataset['name'])
                            if (model.dataset['name'] =="Plan") {
                                result = await post(`/${model.value}/store`, formdata)
                            }
                            if (model.dataset['name'] =="Evolución") {
                                result = await post( location.origin+"/user_cuest_evolucion/store", formdata)
                            }
                            if (model.dataset['name'] =="Probabilidad diagnóstica") {
                                result = await post( location.origin+"/user_cuest_impresion_diagnostica/store", formdata)
                            }


                            Object.assign(result, {"description": model.dataset['name'] } )
                            console.log(result)
                        let index = pacientes_datos.findIndex(paciente=>equalsInt(paciente['user_id'],user_id_paciente))
                            pacientes_datos[ index ]['resultados'].push( result )

                            document.querySelector(`.${type}-listado-${user_id_paciente}`).innerHTML = null

                            pacientes_datos[ index ]['resultados'].forEach(resultado=>{
                                let listado = `<ul class="list-group flex-column-reverse list-group-flush" style="width:20em;">`;
                                    pacientes_datos[ index ]['resultados'].forEach(x=>{

                                        let f = new Date(x.created_at);

                                        let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();

                                            if (model.dataset['name'] == x.description) {
                                                listado += listGoup(

                                                    {
                                                        edit      : true,
                                                        destroy      : false,
                                                        tagTitle      : true,
                                                        title         : x.description,
                                                        tagDescription: true,
                                                        description   : x.value,
                                                        tagTime       : true,
                                                        created_at    : fecha,
                                                        hora          : x.hora,
                                                        registromedico: `${x.medico} | ${fecha} | ${x.hora}`,
                                                        id            : x.id,
                                                        model         : type

                                                    }
                                                );
                                            }



                                        //}



                                    });
                                    listado += `</ul>`;
                                    document.querySelector(`.${type}-listado-${user_id_paciente}`).innerHTML= listado
                            })
                            comentario.value = ""
                    }
                })




    }
    static episodioPendiente (){
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/"+UserCuestEpisodio.prefixRoute() + "/episodioPendiente", formdata)
    }
    static create({selector=".modal-body",user_id}){
         //incio component
         let model = UserCuestEpisodio.classModel();
         Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: UserCuestEpisodio.modelTitle(),

                //selector: identificador html en donde se va a pintar el componente
                selector,

                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.
                eventModelCreate: model+".create({user_id:"+user_id+"})",

                //eventModelContent: contenido del modelo que se esta mostrando
                eventModelContent: "Component.formTemplate_2({user_id:"+user_id+"})",

                //eventModelCreate: evento a ejecutar al pulsar en los botones del footer
                eventModelFooter: model+".regresar({user_id:"+user_id+"})",

                //btn_create:false  oculta el boton
                btn_create:false

                //si se está en la otra vista que no sea index,
                //se le pasa el parametro btn_create:false
                //para que no muestre el botón de crear
            },
            function () {
                $("#btn_modalTemplate_store").on("click", function () {
                   eval( model+".store({user_id:"+user_id+"})" )
                   .then(response=>{
                        eval( model+".index({user_id:"+user_id+"})" )
                   });
                });
            }
        );
        //fin component

    }
    static show({user_id}){
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/"+UserCuestEpisodio.prefixRoute() + "/show/" + user_id, formdata)
    }
    static store({user_id}){

        let formdata = new FormData();
        formdata.append('cat_user_ubicacion_id',$("#cat_user_ubicacion_id_actual").val());
        formdata.append('cat_user_informe_id',2);
        formdata.append('cat_user_ubicacion_id_destino',$("#cat_user_ubicacion_id").val());
        //formdata.append('diag_egreso',$("#coments").val());
        formdata.append('coment',$("#coment").val());
        formdata.append('value',ingreso);
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/store", formdata)
    }
    static async get_historiaIngreso(user_id) {
                 //para actualizar cualquier campo de un registro especifico
        let formdata = new FormData();
            formdata.append("user_id", user_id)
            formdata.append("_token", $("#_token").val())
            return await post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/get_historiaIngreso", formdata)
    }
    static async store3(user_id,data) {
                 //para actualizar cualquier campo de un registro especifico
        let formdata = new FormData();
            formdata.append('campo',data.name);
            formdata.append('valor',data.value);
            formdata.append('user_cuest_episodio_id',data.episodio_id);
            formdata.append("user_id", user_id)
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            return await post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/update2", formdata)
    }
    static update({user_id}){

        let formdata = new FormData();
        formdata.append('user_cuest_episodio_id',user_cuest_episodio_id);
        formdata.append('uti',$("#uti").val());
        formdata.append('uti_causa',$("#uti_causa").val());
        //formdata.append('diag_egreso_cod_cie',$("#input-code-2").val());
        //formdata.append('diag_egreso_cod_cie_description',$("#input-title-2").val());
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/update", formdata)
    }
    static update2(selector){
        //alert(selector)
        //para actualizar cualquier campo de un registro especifico

        let formdata = new FormData();
        formdata.append('campo',selector);
        formdata.append('valor',$("#"+selector).val());
        formdata.append('user_cuest_episodio_id',user_cuest_episodio_id);
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/update2", formdata)
        .then(response => {
            message = Component.alertMessage("update_success");
            $(".help_"+selector).html(`<div class='scale-up-ver-top text-center text-success'>${message['message']} <i class='fas fa-check-circle'></i></span>`);
        });
    }
    static update3(selector,user_cuest_episodio_id,user_id){
        //alert(selector)
         //para actualizar cualquier campo de un registro especifico

        let formdata = new FormData();
        formdata.append('campo',"ingreso");
        formdata.append('valor',$("#ingreso"+user_id).val());
        formdata.append('user_cuest_episodio_id',user_cuest_episodio_id);
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/update2", formdata)
        .then(response => {
            pacientes_datos.forEach(x =>{
                if(x.user_id === response.user_id){
                    x.ingreso_episodio = response.ingreso;
                }
            })
            message = Component.alertMessage("update_success");
            $("#help_ingreso_"+user_id).html(`<div class='scale-up-ver-top text-center text-success'>${message['message']} <i class='fas fa-check-circle'></i></span>`);
        });
    }

    //METODO historialEpisodios MOVIDO EL 12-07-2024 HACIA component.js con el nombre AppHistorialEpisodios
    static async historialEpisodios(patient_data,index_episodio) {
        let {user_id} = patient_data
        $("#modal-patient-item").modal("show");


            let $cabecera = document.getElementById(`historialEpisodios`).content.cloneNode(true)
            let $cargando = document.getElementById(`cargando`).content.cloneNode(true)
            let modalBody = document.querySelector("#modal-patient-item .modal-body-2")
                modalBody.innerHTML=null;
                modalBody.appendChild($cargando)

            let response = await get(`/episodio/historial/${user_id}`);
            if (response.length === 0) {
                modalBody.innerHTML=`
                    <div class="container-fluid h-100">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-8 text-center">
                                <h3 class="text-primary">No se encontraron episodios anteriores</h3>
                            </div>
                        </div>
                    </div>
                `;
            }else{

                let imagen = (x)=>{
                    if (["jpeg","jpg","png","gif","bmp"].includes(x.file_type)) {
                        return `
                            <li>
                                <span class="mailbox-attachment-icon has-img">
                                <img src="/${x.value}" alt="Attachment" /></span>
                                <div class="mailbox-attachment-info">
                                    <a href="/${x.value}" target="_blank" class="btn btn-default btn-block mt-2"><i class="far fa-eye"></i> Ver</a>
                                </div>
                            </li>
                        `;
                    }
                }
                let docu = (x,optionName) => {
                    switch (optionName) {
                        case 'Laboratorio':
                            optionName = "icono_laboratorio.svg";
                        break;
                        case 'Imagenes':
                            optionName = "icono_laboratorio.svg";
                        break;
                        case 'Estudio':
                            optionName = "icono_estudio.svg";
                        break;
                        case 'Fotografías':
                            optionName = "icono_fotografia.svg";
                        break;
                        case 'Otros Archivos':
                            optionName = "icono_archivo.svg";
                        break;
                        default:
                            optionName = "icono_archivo.svg";
                        break;
                    }
                    if (["pdf","doc","txt","docx","bmp","ods","xls","xlsx","ppt","pptx"].includes(x.file_type)) {
                        return `
                            <li>
                                <span class="mailbox-attachment-icon has-img">
                                <img src="/image/system/${optionName}" alt="Attachment" style="width: 50%;height: 50%;" /></span>
                                <div class="mailbox-attachment-info">
                                    <a href="/${x.value}" target="_blank" class="btn btn-default btn-block"><i class="far fa-eye"></i> Ver</a>
                                </div>
                                <div class="mailbox-attachment-size text-center clearfix">
                                    <span>${x.file_type.toUpperCase()}</span>
                                </div>
                            </li>
                        `;
                    }
                }
                let adjuntos = (imagenes,documentos)=>{
                    return `
                        <div>
                            ${!is_empty(imagenes) || !is_empty(documentos) ?'<i class="fas fa-paperclip"></i> Archivos Adjuntos':''}
                            <div class="card-footer bg-white ${is_empty(imagenes) && is_empty(documentos) ? 'd-none' :''}">
                                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                    ${is_empty(imagenes) || is_undefined(imagenes) ? '' : imagenes }
                                    ${is_empty(documentos) || is_undefined(documentos) ? '' : documentos}
                                </ul>
                            </div>
                        </div>
                    `
                }
                let item = (x,itemName) => {
                    let imagenes = ""
                    let documentos = ""
                    let adjuntos_temp =""
                    let mostra
                    if(["Imagenes","Otros archivos"].includes(itemName)){
                        if (x?.file_type) {
                            imagenes = ""
                            imagenes += imagen(x)

                            documentos = ""
                            documentos += docu(x,itemName)
                        }
                        adjuntos_temp = adjuntos(imagenes,documentos)
                    }


                    let medico = medicos_datos.find( medico=> parseInt( medico.user_id ) === parseInt( x.user_id_medico ) )
                    let mostrarMedico = true
                        if (is_undefined(medico)) {
                            mostrarMedico = false;
                        }
                    //console.log("medico -->",medico)
                    return `
                        <div data-episodio_id="${x.episodio_id}" class="post">
                            <div class="user-block ${!mostrarMedico ? 'd-none':''}">
                                <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-circle img-bordered-sm" src="${!mostrarMedico ? '#':medico.imagen}" alt="user-img 128x128">
                                <div class="d-flex flex-column">
                                    <span class="username">
                                        <a href="#">${!mostrarMedico ? '#':medico.medico}</a>
                                    </span>
                                    <span class="description">
                                        <i class="far fa-clock"></i> ${fechaCortaCustom2(x.created_at)}
                                    </span>
                                </div>
                            </div>
                            <p>
                                    ${
                                        !["Imagenes","Laboratorio","Fotografías","Otros archivos"].includes(itemName) &&
                                        !is_null(x.description)  && !is_undefined(x.description)  
                                        ? x.description +'<br>' 
                                        : ''
                                    }

                                    ${!is_null(x.coment)  && !is_undefined(x.coment) ? x.coment +'<br>' : ''}
                                    ${!is_null(x.coments)  && !is_undefined(x.coments) ? x.coments +'<br>' : ''}
                                    ${!is_null(x.cod_cie)  && !is_undefined(x.cod_cie) ? x.cod_cie +'<br>' : ''}
                                    ${!is_null(x.cod_cie_description) && !is_undefined(x.cod_cie_description) ? x.cod_cie_description +'<br>' : ''}
                            </p>

                            ${adjuntos_temp}

                        </div>
                    `

                }


                let cardhistorias =""
                    response.forEach( (historia,index)=>{

                        let items = ""
                        let opcionesHistoria = ""

                        let index1 = 0
                            for (const key in historia.episodio) {

                                if(historia.episodio[key].items.length > 0 || key === 'historia_inicial' ){
                                    let existHistoriaInicial = 0;
                                    if(key === 'historia_inicial'){
                                        let {FR,GLIC,OXI,TA,TEMP,FC,PESO,TALLA} = historia.episodio[key].items.SIGNOS
                                        let {MOTIVO_CONSULTA,
                                            ANTECEDENTES,
                                            ENFERMEDAD_ACTUAL,
                                            EXAMEN_FISICO,
                                            IMP_DIAG,
                                            HOSPITALIZACION,
                                            TERAPIA_INTENSIVA,
                                            CIRUGIA,
                                            NIVEL_TRIAJE,
                                            REQUIERE_INTERCONSULTA,
                                            REALIZAR_PROCEDIMIENTO,
                                            CANTIDAD_ESPECIALISTAS,
                                            PROCEDIMIENTO_COMPLEJIDAD,
                                        } = historia.episodio[key].items
                                        if (
                                            FR ||
                                            GLIC ||
                                            OXI ||
                                            TA ||
                                            TEMP ||
                                            FC ||
                                            PESO ||
                                            TALLA ||
                                            MOTIVO_CONSULTA ||
                                            ANTECEDENTES ||
                                            ENFERMEDAD_ACTUAL ||
                                            EXAMEN_FISICO ||
                                            IMP_DIAG ||
                                            HOSPITALIZACION ||
                                            TERAPIA_INTENSIVA ||
                                            CIRUGIA 
                                        ) {
                                            existHistoriaInicial=1
                                        }


                                    }
                                    opcionesHistoria += `
                                        <a
                                            class="nav-link flex-nowrap d-flex justify-content-between align-items-center text-secondary"
                                            id="nav-${historia.episodio_id}-tabs-${index1}-tab"
                                            data-toggle="pill"
                                            href="#nav-${historia.episodio_id}-tabs-${index1}"
                                            role="tab" aria-controls="nav-${historia.episodio_id}-tabs-${index1}"
                                            aria-selected="false"
                                        >
                                            <span>${historia.episodio[key].title} </span>
                                            <span class="${['historia_inicial'].includes(key) && !existHistoriaInicial && 'd-none' } badge badge-primary">
                                                ${['historia_inicial'].includes(key) && existHistoriaInicial ? existHistoriaInicial :historia.episodio[key].items.length}
                                            </span>
                                        </a>
                                    `
                                        if(['historia_inicial'].includes(key)){
                                            let {FR,GLIC,OXI,TA,TEMP,FC,PESO,TALLA} = historia.episodio[key].items.SIGNOS
                                            let {
                                                MOTIVO_CONSULTA,
                                                ANTECEDENTES,
                                                ENFERMEDAD_ACTUAL,
                                                EXAMEN_FISICO,
                                                IMP_DIAG,
                                                HOSPITALIZACION,
                                                TERAPIA_INTENSIVA,
                                                CIRUGIA,
                                                NIVEL_TRIAJE,
                                                REQUIERE_INTERCONSULTA,
                                                REALIZAR_PROCEDIMIENTO,
                                                CANTIDAD_ESPECIALISTAS,
                                                PROCEDIMIENTO_COMPLEJIDAD,
                                            } = historia.episodio[key].items

                                            let mostrarMedico = true
                                            let medico = null
                                            //console.log(IMP_DIAG);
                                            if (IMP_DIAG) {
                                                medico = medicos_datos.find( medico=> parseInt( medico.user_id ) === parseInt( IMP_DIAG.user_id_medico ) )
                                            }

                                            if (!medico) {
                                                mostrarMedico = false;
                                            }

                                            items +=  `
                                                <div class="tab-pane text-left fade" id="nav-${historia.episodio_id}-tabs-${index1}" role="tabpanel" aria-labelledby="nav-${historia.episodio_id}-tabs-${index1}">
                                                    
                                                    <div class="d-flex flex-column">
                                                        <div class="user-block ${!mostrarMedico ? 'd-none':''}">
                                                            <img 
                                                                onerror="this.src='/image/system/icono-paciente-blanco.svg'" 
                                                                class="img-circle img-bordered-sm" 
                                                                src="${!mostrarMedico ? '#' : medico.imagen}" 
                                                                alt="user-img 128x128"
                                                            >
                                                            <div class="d-flex flex-column">
                                                                <span class="username">
                                                                    <a href="#">${!mostrarMedico ? '#':medico.medico}</a>
                                                                </span>
                                                                <span class="description">
                                                                    <i class="far fa-clock"></i> ${mostrarMedico ? fechaCortaCustom2(IMP_DIAG.created_at):''}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="container-fluid py-1">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">
                                                                    <div class="card p-1 mb-1">
                                                                        <h5 class="text-primary">Signos Vitales</h5>
                                                                        <div class="d-flex flex-column">
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold rounded" style="width:60px">
                                                                                Peso
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${PESO ? PESO + ' Kg.' : ''}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold" style="width:60px">
                                                                                Talla
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${TALLA ? TALLA + ' cm.' : ''}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold" style="width:60px">
                                                                                Temp
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${TEMP ? TEMP + ' ºC' : ''}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold" style="width:60px">
                                                                                Oxi
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${OXI ? OXI + ' %' : ''}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold" style="width:60px">
                                                                                Fc
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${FC ? FC + ' resp/min' : ''}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold" style="width:60px">
                                                                                Gl
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${GLIC ? GLIC + ' mg/dL' : ''}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex mb-1">
                                                                                <div class="pl-2 text-secondary font-weight-bold" style="width:60px">
                                                                                Ta
                                                                                </div>
                                                                                <div class="pl-2">
                                                                                ${TA ? TA + ' mmHg' : ''}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card p-1 mb-1">
                                                                        <h5 class="text-primary">Sospecho que el paciente requerirá:</h5>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-secondary font-weight-bold rounded" >
                                                                            Interconsulta con médico especialista:
                                                                            </div>
                                                                            <div class="pl-2">
                                                                            ${[null,'null',undefined,'undefined',0].includes(REQUIERE_INTERCONSULTA) ? 'No' :'Si'}
                                                                            ${CANTIDAD_ESPECIALISTAS > 0 ? ', '+ CANTIDAD_ESPECIALISTAS+' especialista'+(CANTIDAD_ESPECIALISTAS>1?'s':'') : ''}
                                                                            
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-secondary font-weight-bold rounded" >
                                                                            ¿Realizar procedimiento?
                                                                            </div>
                                                                            <div class="pl-2">
                                                                            ${[null,'null',undefined,'undefined',0].includes(REALIZAR_PROCEDIMIENTO) ? 'No' :'Si'}
                                                                            ${[null,'null',undefined,'undefined',0].includes(PROCEDIMIENTO_COMPLEJIDAD) ? '' :', '+PROCEDIMIENTO_COMPLEJIDAD}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-secondary font-weight-bold rounded" >
                                                                            ¿Hospitalización?
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined',0].includes(HOSPITALIZACION) ? 'No' :'Si'}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-secondary font-weight-bold rounded" >
                                                                            ¿Terapia intensiva?
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined',0].includes(TERAPIA_INTENSIVA) ? 'No' :'Si'}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-secondary font-weight-bold rounded" >
                                                                            ¿Cirugía?
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined',0].includes(CIRUGIA) ? 'No' :'Si'}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-secondary font-weight-bold rounded" >
                                                                            Clasificación del triaje
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined'].includes(NIVEL_TRIAJE) ? 'No indicado' :NIVEL_TRIAJE}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-9">
                                                                    <div class="card p-1 mb-1">
                                                                        
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-primary font-weight-bold rounded" >
                                                                            Motivo de consulta
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined'].includes(MOTIVO_CONSULTA) ? 'No indicado' :MOTIVO_CONSULTA}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-primary font-weight-bold rounded" >
                                                                            Antecedentes
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined'].includes(ANTECEDENTES) ? 'No indicado' :ANTECEDENTES}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-primary font-weight-bold rounded" >
                                                                            Enfermedad Actual
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined'].includes(ENFERMEDAD_ACTUAL) ? 'No indicado' :ENFERMEDAD_ACTUAL}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-primary font-weight-bold rounded" >
                                                                            Examen Físico
                                                                            </div>
                                                                            <div class="pl-2">
                                                                                ${[null,'null',undefined,'undefined'].includes(EXAMEN_FISICO) ? 'No indicado' :EXAMEN_FISICO}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column mb-1">
                                                                            <div class="pl-2 text-primary font-weight-bold rounded" >
                                                                            Problema de ingreso
                                                                            </div>
                                                                            <div class="pl-2">
                                                                            ${IMP_DIAG ? [null,'null',undefined,'undefined'].includes(IMP_DIAG.value) ? 'No indicado' :IMP_DIAG.value : ''}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `
                                        }else{
                                            let itemsOpcionesHistoria = ""
                                            historia.episodio[key].items.forEach((x,index2)=>{
    
                                                if (!["Traslados","Equipo Médico"].includes(historia.episodio[key].title)) {
                                                    itemsOpcionesHistoria += item(x,historia.episodio[key].title)
                                                }
    
    
    
    
                                            })
                                            items +=  `
                                                <div class="tab-pane text-left fade" id="nav-${historia.episodio_id}-tabs-${index1}" role="tabpanel" aria-labelledby="nav-${historia.episodio_id}-tabs-${index1}">
                                                    ${itemsOpcionesHistoria}
                                                </div>
                                            `
                                        }
                                   
                                }
                                index1++
                            }

                            cardhistorias += `
                                <div class="card">
                                    <div class="card-header p-0" id="heading${index}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse${index}" aria-expanded="true" aria-controls="collapse${index}">
                                                <div class="d-flex align-content-md-end align-content-sm-start">
                                                    <div class="px-1 border-right">
                                                        <div class="m-0 description text-center">
                                                            <b class="text-primary">Episodio:</b>
                                                            <div class="font-weight-bold">${index+1}</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-1 border-right">
                                                        <div class="m-0 description text-center">
                                                            <b class="text-primary">Ingreso:</b>
                                                            <div class="font-weight-bold">${is_undefined(historia.fecha_ingreso) ? '' :fechaCortaCustom1(historia.fecha_ingreso)}</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-1 border-right">
                                                        <div class="m-0 description text-center">
                                                            <b class="text-primary">Egreso:</b>
                                                            <div class="font-weight-bold">${is_undefined(historia.fecha_egreso) ? '' :fechaCortaCustom1(historia.fecha_egreso)}</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-1 border-right">
                                                        <div class="m-0 description text-center">
                                                            <b class="text-primary">Días de Hospitalización:</b>
                                                            <div class="font-weight-bold">${historia.dia_hos}</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-1">
                                                        <div class="m-0 description text-center">
                                                            <b class="text-primary">Área de Egreso:</b>
                                                            <div class="font-weight-bold">${historia.area_de_egreso}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse${index}" class="collapse" aria-labelledby="heading${index}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5 col-sm-3 col-lg-2 col-xl-2">
                                                    <div class="nav flex-column nav-tabs" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                                    ${opcionesHistoria}
                                                    </div>
                                                </div>
                                                <div class="col-7 col-sm-9">
                                                    <div class="tab-content" id="vert-tabs-tabContent">
                                                    ${items}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                    })
                    modalBody.innerHTML=  `
                        <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>

                        <h1 class="text-center text-primary" style="margin-top: 50px">Historial de Episodios</h1>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="accordion" id="accordionExample">
                                        ${cardhistorias}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;


            }

    }
    static eliminar({id,user_id}){
        UserCuestEpisodio.destroy({id})
        .then(response=>{
            UserCuestEpisodio.index({user_id})
        })
    }
    static destroy({id}){
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/destroy/"+id, formdata)
    }
    static regresar({user_id, selector='#modalTemplate_2_footer'}){
        Component.btn_regresar({
            selector,
            eventModel:"UserCuestEpisodio.index({user_id:"+user_id+"})"
        })
    }
    static async fixed_episodio(row){
        //CREA EL EPISODIO SI EL PACIENTEW NO LO TIENE
        let formdata = new FormData();
        formdata.append('value',"episodio_null");
        formdata.append("user_id", row.user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        let episodio = await post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/store", formdata)
        //console.log(episodio)
        return  episodio.id;
    }
    static async updatePrealta(user_id,valor){

        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("valor", valor)
        return await post( location.origin+"/"+UserCuestEpisodio.prefixRoute() +"/prealta", formdata)

    }
    static prealtaColor(fecha){
        let date_1 = new Date(fecha);
        let date_1N = new Date(date_1.getFullYear() , (date_1.getMonth()+1) , date_1.getDate()+1)
        let date_2 = new Date(Date.now());
        let date_2N = new Date(date_2.getFullYear() , (date_2.getMonth()+1) , date_2.getDate());

        //console.log(date_1N.getTime(),date_2N.getTime())

        let day_as_milliseconds = 86400000;
        let diff_in_millisenconds = date_1N.getTime() - date_2N.getTime();
        let diff_in_days = diff_in_millisenconds / day_as_milliseconds;

        if (parseInt(diff_in_days) < 0) {
            diff_in_days = 0;
        }
        //console.log(diff_in_days)
        if (parseInt(diff_in_days) >= 2) {
            return "success"
        }
        if (parseInt(diff_in_days) === 1) {
            return "warning"
        }
        if (parseInt(diff_in_days) === 0) {
            return "danger"
        }
        return  false ;
    }
    static async addPrealta(user_id) {
        let selector=".modal-body";

        //incio component
        let model = UserCuestEpisodio.classModel();

        Component.modalTemplate_3(
            {
                title: UserCuestEpisodio.modelTitle()
            },
            async function () {
                let calendar = document.querySelector("#messageModal div.modal-body")
                $(calendar).html(`

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 h3 text-primary font-weight-bold text-center">
                                Fecha Probable de Alta
                            </div>

                        </div>
                    </div>
                    <div id="calendar" data-user_id="${user_id}" class="daterange" style="width: 100%"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <button id="store_prealta" data-user_id="${user_id}" class="btn btn-success btn-block my-1">Confirmar</button>
                            </div>
                            <div class="col-12">
                                <button id="destroy_prealta" class="btn btn-primary btn-block my-1">Cancelar</button>
                            </div>
                        </div>
                    </div>

                `);

                document.querySelector("#store_prealta").addEventListener("click",async (e)=>{
                    //let user_id =document.querySelector("#store_prealta").dataset.user_id
                    let d = document;
                    let fecha = document.getElementById(`fecha_prealta_${user_id}`).value
                        if (fecha !== "") {
                            let date_1 = new Date(fecha);
                            let date_1N = new Date(date_1.getFullYear() , (date_1.getMonth()+1) , date_1.getDate()+1)
                            let date_2 = new Date(Date.now());
                            let date_2N = new Date(date_2.getFullYear() , (date_2.getMonth()+1) , date_2.getDate());

                            if (date_1N.getTime() < date_2N.getTime()) {
                                alert("La fecha ingresada no puede ser anterior a hoy.");

                            }else{
                                UserCuestEpisodio.updatePrealta(user_id,fecha)
                                .then(response => {
                                    let btn = d.querySelector(`#col_1_${user_id} .calendar-prealta`)
                                        btn.classList.replace("fa-calendar","fa-calendar-check");
                                        ["info","danger","warning","success","gray"].forEach(x=>btn.classList.remove("text-"+x))
                                        btn.classList.add("text-"+UserCuestEpisodio.prealtaColor(fecha))
                                    let card = d.querySelector(`#col_1_${user_id} #card_prealta_${user_id}`)
                                        card.classList.remove("d-none");

                                        if(
                                            UserCuestEpisodio.prealtaColor(fecha) !== "danger" &&
                                            UserCuestEpisodio.prealtaColor(fecha) !== "warning"
                                        ) {
                                            card.classList.remove('heartbeat_infinity');
                                        }else{
                                            card.classList.add('heartbeat_infinity')

                                        }

                                        if(
                                            UserCuestEpisodio.prealtaColor(fecha) === "danger"
                                        ) document.getElementById('title_prealta_'+user_id).innerHTML="ALTA";
                                        if(
                                            UserCuestEpisodio.prealtaColor(fecha) === "warning"
                                        ) document.getElementById('title_prealta_'+user_id).innerHTML="PRE-ALTA";
                                        if(
                                            UserCuestEpisodio.prealtaColor(fecha) === "success"
                                        ) document.getElementById('title_prealta_'+user_id).innerHTML="PRE-ALTA";



                                        if(UserCuestEpisodio.prealtaColor(fecha) !== "success"){
                                            d.querySelectorAll(`.row_${user_id} > td`).forEach(x=>{x.classList.replace("bg-gray-2","prealta");})
                                        }else{
                                            d.querySelectorAll(`.row_${user_id} > td`).forEach(x=>{x.classList.replace("prealta","bg-gray-2");})
                                        }

                                        pacientes_datos.map(x=>{
                                            if (x.user_id == user_id) {
                                            x.prealta = fecha;
                                            }
                                        });
                                        activarTooltip()
                                        $("#messageModal").modal("hide")
                                })
                            }
                        }else{
                            alert("No has seleccionado un día")
                        }


                })
                document.querySelector("#destroy_prealta").addEventListener("click",async ()=>{
                    UserCuestEpisodio.updatePrealta(user_id,null)
                    .then(response => {
                        let d = document;
                        document.getElementById(`fecha_prealta_${user_id}`).value = ""
                        let btn = d.querySelector(`#col_1_${user_id} .calendar-prealta`)
                                    btn.classList.replace("fa-calendar-check","fa-calendar");

                            ["info","danger","warning","success"].forEach(x=>btn.classList.remove("text-"+x))
                            btn.classList.add("text-gray")
                        let card = d.querySelector(`#col_1_${user_id} #card_prealta_${user_id}`)
                            card.classList.add("d-none");
                            ["info","danger","warning","success"].forEach(x=>{
                                card.classList.remove("tooltip-"+x)
                                card.classList.remove("bg-"+x)
                            })
                            card.classList.add("tooltip-info")
                            card.classList.add("bg-info")

                            pacientes_datos.map(x=>{
                                if (x.user_id == user_id) {
                                x.prealta = null;
                                }
                            });
                            d.querySelectorAll(`.row_${user_id} > td`).forEach(x=>{x.classList.replace("prealta","bg-gray-2");})
                            activarTooltip()
                            $("#messageModal").modal("hide")
                    })

                })
                $('#calendar').datepicker({
                    language: "es",
                    toggleActive: true,
                    todayHighlight: true,
                });
                $('#calendar').datepicker().on("changeDate", function(e) {
                    let d = document;
                    let f = new Date(e.date);
                    let fechaIngreso = f.getFullYear() + "-" + (f.getMonth()+1) + "-" + f.getDate();
                        document.getElementById(`fecha_prealta_${user_id}`).value=fechaIngreso
                    let btn = d.querySelector(`#col_1_${user_id} .calendar-prealta`);
                        ["info","danger","warning","success"].forEach(x=>btn.classList.remove("text-"+x))
                        btn.classList.add("text-"+UserCuestEpisodio.prealtaColor(fechaIngreso))
                    let card = d.querySelector(`#col_1_${user_id} #card_prealta_${user_id}`);
                        ["info","danger","warning","success"].forEach(x=>{
                            card.classList.remove("tooltip-"+x)
                            card.classList.remove("bg-"+x)
                        })
                        if(
                            UserCuestEpisodio.prealtaColor(fechaIngreso) === "danger"
                        ) document.getElementById('title_prealta_'+user_id).innerHTML="ALTA";
                        if(
                            UserCuestEpisodio.prealtaColor(fechaIngreso) === "warning"
                        ) document.getElementById('title_prealta_'+user_id).innerHTML="PRE-ALTA";
                        if(
                            UserCuestEpisodio.prealtaColor(fechaIngreso) === "success"
                        ) document.getElementById('title_prealta_'+user_id).innerHTML="PRE-ALTA";
                        card.classList.add("tooltip-"+UserCuestEpisodio.prealtaColor(fechaIngreso))
                        card.classList.add("bg-"+UserCuestEpisodio.prealtaColor(fechaIngreso))
                        fechaIngreso =  f.getDate() + "-" + capitalize(meses(f.getMonth()).slice(0,3))  + "-" +  f.getFullYear();
                         card.querySelectorAll("div")[1].textContent=fechaIngreso
                });
            }
        );
        //fin component
    }
}

