        /*inicio variables globales*/

        // NO ELIMINAR ESTAS VARIABLES
        var ingreso                  = "";
        var message                  = 0;
        var totalSintomas            = 0;
        var totalEpidemiologia       = 0;
        var recomendacion            = "";
        var iti                      = "";
        var p                        = 0;
        var edad                     = 0;
        var email                    = "";
        var data                     = "";
        var hora                     = new Array();
        var menuAreaActiva           = "";

        var medicos_datos            = "";
        let pacientes_datos          = "";

        const EventBus = new Vue();

        const grupos_medicos     = [
            [1],
            [2],
            [3,4],
            [5,6,7,8],
            [9],
            [10]
        ]
        let traduccionDataTablesEsp = {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %ds fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir",
                "renameState": "Cambiar nombre",
                "updateState": "Actualizar",
                "createState": "Crear Estado",
                "removeAllStates": "Remover Estados",
                "removeState": "Remover",
                "savedStates": "Estados Guardados",
                "stateRestore": "Estado %d"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmentemente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "notBetween": "No entre",
                        "notEmpty": "No Vacio",
                        "not": "Diferente de"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vacio",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío",
                        "not": "Diferente de"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "notEmpty": "No Vacio",
                        "startsWith": "Empieza con",
                        "not": "Diferente de",
                        "notContains": "No Contiene",
                        "notStartsWith": "No empieza con",
                        "notEndsWith": "No termina con"
                    },
                    "array": {
                        "not": "Diferente de",
                        "equals": "Igual",
                        "empty": "Vacío",
                        "contains": "Contiene",
                        "notEmpty": "No Vacío",
                        "without": "Sin"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d",
                "showMessage": "Mostrar Todo",
                "collapseMessage": "Colapsar Todo"
            },
            "select": {
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "%d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                },
                "rows": {
                    "1": "1 fila seleccionada",
                    "_": "%d filas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Proximo",
                "hours": "Horas",
                "minutes": "Minutos",
                "seconds": "Segundos",
                "unknown": "-",
                "amPm": [
                    "AM",
                    "PM"
                ],
                "months": {
                    "0": "Enero",
                    "1": "Febrero",
                    "10": "Noviembre",
                    "11": "Diciembre",
                    "2": "Marzo",
                    "3": "Abril",
                    "4": "Mayo",
                    "5": "Junio",
                    "6": "Julio",
                    "7": "Agosto",
                    "8": "Septiembre",
                    "9": "Octubre"
                },
                "weekdays": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sab"
                ]
            },
            "editor": {
                "close": "Cerrar",
                "create": {
                    "button": "Nuevo",
                    "title": "Crear Nuevo Registro",
                    "submit": "Crear"
                },
                "edit": {
                    "button": "Editar",
                    "title": "Editar Registro",
                    "submit": "Actualizar"
                },
                "remove": {
                    "button": "Eliminar",
                    "title": "Eliminar Registro",
                    "submit": "Eliminar",
                    "confirm": {
                        "_": "¿Está seguro que desea eliminar %d filas?",
                        "1": "¿Está seguro que desea eliminar 1 fila?"
                    }
                },
                "error": {
                    "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                },
                "multi": {
                    "title": "Múltiples Valores",
                    "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                    "restore": "Deshacer Cambios",
                    "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                }
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "stateRestore": {
                "creationModal": {
                    "button": "Crear",
                    "name": "Nombre:",
                    "order": "Clasificación",
                    "paging": "Paginación",
                    "search": "Busqueda",
                    "select": "Seleccionar",
                    "columns": {
                        "search": "Búsqueda de Columna",
                        "visible": "Visibilidad de Columna"
                    },
                    "title": "Crear Nuevo Estado",
                    "toggleLabel": "Incluir:"
                },
                "emptyError": "El nombre no puede estar vacio",
                "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                "removeError": "Error al eliminar el registro",
                "removeJoiner": "y",
                "removeSubmit": "Eliminar",
                "renameButton": "Cambiar Nombre",
                "renameLabel": "Nuevo nombre para %s",
                "duplicateError": "Ya existe un Estado con este nombre.",
                "emptyStates": "No hay Estados guardados",
                "removeTitle": "Remover Estado",
                "renameTitle": "Cambiar Nombre Estado"
            }
        }
        let turnos = [
            "Mañana",
            "Tarde",
            "Todo el Dia"
        ]
        let tipo_turnos =[
            "todo_el_dia_publico",
            "todo_el_dia_privado",
            "manana_publica_tarde_privada",
            "tarde_publica_manana_privada",
            "personalizado",
        ]
        let mesesEnEspanol = [
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
            "Diciembre"
        ];

        let dias_nombres =[
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
        ]
        let fecha = new Date();
        let feriados = [
            {"year":fecha.getFullYear(), "month":1, "day":1, "description":`Año nuevo`},
            {"year":fecha.getFullYear(), "month":2, "day":12, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":2, "day":13, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":3, "day":24, "description":`Domingo de Ramos`},
            {"year":fecha.getFullYear(), "month":3, "day":25, "description":`Lunes Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":26, "description":`Martes Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":27, "description":`Miércoles Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":28, "description":`Jueves Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":29, "description":`Viernes Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":30, "description":`Sábado Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":31, "description":`Domingo de Resurreción`},
            {"year":fecha.getFullYear(), "month":4, "day":19, "description":`Declaración de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":5, "day":1, "description":`Día del trabajador`},
            {"year":fecha.getFullYear(), "month":6, "day":24, "description":`Batalla de Carabobo`},
            {"year":fecha.getFullYear(), "month":7, "day":5, "description":`Día de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":7, "day":24, "description":`Natalicio de Simón Bolívar`},
            {"year":fecha.getFullYear(), "month":10, "day":12, "description":`Día de la Resistencia Indigena`},
            {"year":fecha.getFullYear(), "month":12, "day":24, "description":`Vispera de navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":25, "description":`Navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":31, "description":`Fiesta de fín de año`},
        ]
        const getLastArrItem = (arr) => {
            let lastItem=arr[arr.length-1];
            return lastItem;
          }
        let tp = async ()=>
        {
            return await get( location.origin+"/vistas/tp")
        }
        let sinResult = ({message="No se encontraron pacientes",col="10"})=>
        {
              let tr = document.createElement('tr')
              let td = document.createElement('td')
                  td.setAttribute('colspan',col)
              let div = document.createElement('div')
                  div.classList.add('d-flex')
                  div.classList.add('m-4')
                  div.classList.add('justify-content-center')
                  div.classList.add('text-primary')
                  div.innerHTML=message
                  td.appendChild(div)
                  tr.appendChild(td)
              let nodo = document.getElementById('filasPacientes')
                  nodo.innerHTML=""
                  nodo.appendChild(tr)
          }
        let filtroMedico = (arr,posicion)=>{
            let temp = [];
                grupos_medicos[posicion-1].forEach(y => {
                    arr.forEach(x=>{
                        if( x.user_cuest_medico_posicion_id === y ){
                            temp.push(x);
                        }
                    });
                })
            return temp;
        }

        const headerNav = ({align="justify-content-end", fn=()=>{}})=>{
            $navbarCopy = document.getElementById(`navbar`).content;
            $navbar = document.importNode($navbarCopy,true);
            $navbar.querySelector("nav").classList.add(align);

            $headerTag = document.querySelector(`header`);

            $headerTag.appendChild($navbar);
            fn()
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

        const boton = (
                {

                    idButton="#",
                    htmlButton=false,
                    textButton="Button name",
                    typeButton="button",
                    classButton=["btn","btn-block","btn-default","text-secondary"],
                    eventoTypeButton="click",
                    dataTippyContent="Sample tippy",
                    hrefButton="#",

                },
                fn=()=>{console.warn("Sin eventos")}
            )=>{
            let button = document.createElement(typeButton);
                classButton.forEach(element => {
                    button.classList.add(element)
                });

                button.setAttribute("id",idButton)
                button.setAttribute("data-tippy-content",dataTippyContent)

                if (typeButton === "a") {
                    button.setAttribute("href",hrefButton)
                }

                if (htmlButton) {
                    button.innerHTML = textButton;
                }else{
                    button.textContent = textButton;
                }


                button.addEventListener(eventoTypeButton,()=>{
                    fn()
                })
            return button;
        }

        const redireccionar = (area)=>{
            window.location.href="/medico/resumen_pacientes?area="+area
        }
        let selectOptions = (model, param, fields=['id','description'] ) => {
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
        const Toast = Swal.mixin({
            toast: false,
            position: 'center',
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
        hora = {
                13: 1,
                14: 2,
                15: 3,
                16: 4,
                17: 5,
                18: 6,
                19: 7,
                20: 8,
                21: 9,
                22: 10,
                23: 11,
                00: 12
            }
            // NO ELIMINAR ESTAS VARIABLES
            /*fin variables globales*/
            function triggerEvent(el, type) {
                // IE9+ and other modern browsers
                if ('createEvent' in document) {
                    var e = document.createEvent('HTMLEvents');
                    e.initEvent(type, false, true);
                    el.dispatchEvent(e);
                } else {
                    // IE8
                    var e = document.createEventObject();
                    e.eventType = type;
                    el.fireEvent('on' + e.eventType, e);
                }
            }
            function dayDiff(startdate, enddate) {
                var dayCount = 0;

                while(enddate >= startdate) {
                  dayCount++;
                  startdate.setDate(startdate.getDate() + 1);
                }

                return dayCount;
            }
            const $nuevaPregunta = ({
                cat_encuesta_id=1,
                user_encuesta_id = 1,
                cat_encuesta_preg_id = 1,
                grupoRespuestas=0,
                textCuestion ="¿Sample?",
                parent=false,
                children=false,
                btnEventId= 6,
                negado=false,
                coments=false,
            })=>{
                encuesta.push({
                    user_encuesta_id,
                    cat_encuesta_preg_id,
                    cat_encuesta_preg_value:0,
                    cat_encuesta_preg_coments:null,
                })
                let respuestas = {}
                let $template = document.getElementById("question").content;
                let $question = document.importNode($template,true);

                    $question.querySelector(".container-fluid").setAttribute("id",`${user_encuesta_id}_preg_${cat_encuesta_preg_id}`)
                    $textarea = $question.querySelector("textarea")
                    $textarea.id=`coments_${cat_encuesta_preg_id}`


                    if(children){
                        $question.querySelector(".container-fluid").classList.add("d-none",`parent-${parent}`)
                    }



                    //NUMERO DE LA PREGUNTA
                    $questionNumber = $question.querySelector(".bd-callout-number")
                    $questionNumber.textContent = cat_encuesta_preg_id;

                    //TEXTO DE LA PREGUNTA
                    $textQuestion = $question.querySelector(`[role="pregunta"]`)
                    $textQuestion.innerHTML = textCuestion;

                    //INICIO GRUPO DE RESPUESTAS
                    respuestas = [
                        {id:1,punto:1,description:`Nunca`},
                        {id:2,punto:2,description:`A veces`},
                        {id:3,punto:3,description:`La mayoría de las veces`},
                        {id:4,punto:4,description:`Siempre`},

                        //{id:5,punto:0,description:`Nunca usé el botón`},

                        {id:6,punto:0,description:`Si`},
                        {id:7,punto:0,description:`No`},

                        {id:8,punto:0,description:`A mi casa`},
                        {id:9,punto:0,description:`A la casa de otra persona`},
                        {id:10,punto:0,description:`A otra institución de salud`},

                       //{id:11,punto:0,description:`0`},
                        {id:12,punto:1,description:`1`},
                        {id:13,punto:2,description:`2`},
                        {id:14,punto:3,description:`3`},
                        {id:15,punto:4,description:`4`},
                        {id:16,punto:5,description:`5`},
                        {id:17,punto:6,description:`6`},
                        {id:18,punto:7,description:`7`},
                        {id:19,punto:8,description:`8`},
                        {id:20,punto:9,description:`9`},
                        {id:21,punto:10,description:`10`},

                        {id:22,punto:1,description:`Definitivamente no`},
                        {id:23,punto:2,description:`Hasta cierto punto no`},
                        {id:24,punto:3,description:`Hasta cierto punto si`},
                        {id:25,punto:4,description:`Definitivamente si`},

                        {id:26,punto:1,description:`Muy en desacuerdo`},
                        {id:27,punto:2,description:`En desacuerdo`},
                        {id:28,punto:3,description:`De acuerdo`},
                        {id:29,punto:4,description:`Muy de acuerdo`},

                        //{id:30,punto:0,description:`No me dieron ninguna medicina cuando salí del hospital`},

                        {id:31,punto:1,description:`Mala`},
                        {id:32,punto:2,description:`Regular`},
                        {id:33,punto:3,description:`Buena`},
                        {id:34,punto:4,description:`Muy buena`},
                        {id:35,punto:5,description:`Excelente`},





                    ];
                    switch (grupoRespuestas) {
                        case 1:
                            grupoRespuestas = [1,2,3,4/*,5*/];
                        break;
                        case 2:
                            grupoRespuestas = [6,7];
                        break;
                        case 3:
                            grupoRespuestas = [8,9,10];
                        break;
                        case 4:
                            grupoRespuestas = [12,13,14,15,16,17,18,19,20,21];
                        break;
                        case 5:
                            grupoRespuestas = [22,23,24,25];
                        break;
                        case 6:
                            grupoRespuestas = [26,27,28,29];
                        break;
                        case 7:
                            grupoRespuestas = [26,27,28,29/* ,30 */];
                        break;
                        case 8:
                            grupoRespuestas = [31,32,33,34,35];
                        break;
                        case 9:
                            grupoRespuestas = [36,37,38,39,40,41];
                        break;
                        case 10:
                            grupoRespuestas = [12,13,14,15,16];
                        break;



                        default:
                            grupoRespuestas = [1,2,3,4];
                        break;
                    }
                    //FIN GRUPO DE RESPUESTAS


                let $ulOption = $question.querySelector("ul")
                    $ulOption.setAttribute("id","lista_respuesta"+cat_encuesta_preg_id)
                    grupoRespuestas.forEach((x1,key) => {
                        respuestas.filter( y => y.id === x1).forEach(x2=>{
                            let $li = document.createElement("li");
                                $li.classList.add("nav-item")
                                $li.setAttribute("role","presentation")

                            let $a = document.createElement("a");
                                $a.classList.add("nav-link","rounded-pill","cursor-pointer","text-center")
                                $a.setAttribute("data-toggle","pill")
                                $a.setAttribute("role","respuesta")
                                $a.textContent = x2.description;
                                $a.setAttribute("data-value",x2.punto)
                                $a.setAttribute("data-pregunta_id",cat_encuesta_preg_id)
                                let preguntaConComentario = {
                                    1:[19,20,33,34,35],
                                    2:[9],
                                }
                                console.log(preguntaConComentario[cat_encuesta_id])
                                $a.addEventListener("click",function(e){
                                    //guardar la pregunta en LOCAL STORAGE
                                    encuesta = JSON.parse(localStorage.getItem("encuesta"))
                                    encuesta.forEach(x=>{
                                        if (
                                            x.user_encuesta_id===user_encuesta_id  &&
                                            x.cat_encuesta_preg_id===cat_encuesta_preg_id
                                        ) {
                                            //console.log(x)
                                            x.cat_encuesta_preg_value = x2.punto
                                            localStorage.setItem("encuesta",JSON.stringify(encuesta))
                                            //console.log(x)
                                        }


                                    })
                                    //PARA ACTIVAR O DESACTIVAR EL CAMPO DE COMENTARIOS

                                    if(coments){

                                        let $question = document.getElementById(`${user_encuesta_id}_preg_${cat_encuesta_preg_id}`)
                                            $c = $question.querySelector(".coments")
                                            $textarea = $c.querySelector("textarea")
                                        if(
                                            preguntaConComentario[cat_encuesta_id].includes(parseInt(e.target.dataset.pregunta_id)) &&
                                            [1,2].includes(parseInt(e.target.dataset.value))

                                        )
                                        {
                                            $c.classList.remove("d-none")
                                            $textarea.focus();
                                        }else{
                                            $c.classList.add("d-none")
                                        }
                                    }
                                })
                                if (coments) {
                                    if(
                                        preguntaConComentario[cat_encuesta_id].includes(parseInt(cat_encuesta_preg_id))

                                    )
                                    {


                                        $textarea.addEventListener("change",(e)=>{
                                           // alert(cat_encuesta_preg_id)
                                            encuesta = JSON.parse(localStorage.getItem("encuesta"))
                                            encuesta.forEach(x=>{
                                                if (
                                                    x.user_encuesta_id===user_encuesta_id  &&
                                                    x.cat_encuesta_preg_id===cat_encuesta_preg_id
                                                ) {
                                                    let a = document.querySelector("#lista_respuesta"+cat_encuesta_preg_id+" a.active").dataset.value
                                                    //console.log(x)

                                                    $textarea = document.querySelector(`#coments_${cat_encuesta_preg_id}`)
                                                    if (x.cat_encuesta_preg_value == a) {
                                                        x.cat_encuesta_preg_coments = $textarea.value;
                                                    }else{
                                                        x.cat_encuesta_preg_coments = null;
                                                    }

                                                    localStorage.setItem("encuesta",JSON.stringify(encuesta))
                                                    //console.log(x)
                                                }


                                            })
                                        })
                                    }
                                }
                                if (parent===true) {
                                    let condicion = negado ? x2.id!==btnEventId : x2.id===btnEventId
                                    if (condicion) {
                                        $a.addEventListener("click",function(e){
                                            //console.log("1-->",x2)
                                            let result = document.querySelectorAll(`.parent-${cat_encuesta_preg_id}`)
                                                result.forEach(x3=>{
                                                    if (x3.classList.contains("d-none")) {
                                                        x3.classList.remove("d-none")
                                                    }
                                                })
                                        })
                                    }else{
                                        $a.addEventListener("click",function(e){
                                            //console.log("2-->",x2)
                                            let result = document.querySelectorAll(`.parent-${cat_encuesta_preg_id}`)
                                                result.forEach(x3=>{
                                                    if (!x3.classList.contains("d-none")) {
                                                        x3.classList.add("d-none")
                                                    }
                                                })
                                        })
                                    }

                                }

                                $li.appendChild($a)
                                $ulOption.appendChild($li);
                        })

                    });

                return $question;

            }
            $("#messageModal").data("backdrop","static");
            let modalMensaje = ({
                    static =false,
                    title = `Title`,
                    content =`Content`,
                    action=`
                        <button data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Action</button>
                    `
                } ) =>{

                    $("#messageModal").modal("show")
                    $(".modal-body").html(`
                    <div class="container-fluid bg-primary p-3">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h3 class="display-4" style="font-size: 2.5em;">
                                    ${title}
                                </h3>
                                <p class="lead" style="font-size: 1.4em;font-style: italic;">
                                    ${content}
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                                ${action}
                            </div>
                        </div>
                    </div>
                     `);
                    if (static) {
                        $("#messageModal").data("backdrop","static");
                    }

            }
            let $input = (data)=>{
                const {
                    ariaDescribedby = "",
                    className       = ["form-control", "form-control-lg", "bg-gray-footer-parodi"],
                    dataAttribute   = [],
                    id              = "",
                    labelClass      = ["label-text", "text-secondary"],
                    labelContent    = "Form Input Group",
                    name            = "input",
                    placeholder     = "",
                    prefix          = "",
                    required        = false,
                    role            = "",
                    smallClass      = [],
                    smallContent    = "",
                    title           = "El campo ? no puede estar vacio",
                    type            = "text",
                    value           = "",
                    placeholderActive = false,
                    labelActive = true,
                    labelPlaceholderActive =false,
                } = data;

                let $formGroup = document.createElement("div")
                let $label     = document.createElement("label")
                let $input     = document.createElement("input")
                let $small     = document.createElement("small")

                    //formGroup
                    $formGroup.classList.add("form-group")

                    //label
                    if (labelActive) {
                        $label.htmlFor =name;
                        $label.textContent = labelContent;
                        labelClass.forEach(x=>{
                            $label.classList.add(x)
                        })
                        $formGroup.appendChild($label)
                    }


                    //input
                    $input.setAttribute("name",name);
                    $input.setAttribute("id",`${prefix}${name}`)
                    $input.setAttribute("role",role)
                    $input.setAttribute("required",required)

                    className.forEach(x=>{
                        $input.classList.add(x)
                    })

                    if (placeholderActive) {
                        placeholder === ""
                        ? $input.placeholder = name
                        : $input.placeholder = placeholder
                    }


                    role === ""
                        ? $input.setAttribute("role",name)
                        : $input.setAttribute("role",role)

                    ariaDescribedby === ""
                        ? $input.setAttribute("aria-describedby",`help-${name}`)
                        : $input.setAttribute("aria-describedby",ariaDescribedby)

                    if (dataAttribute.length > 0) {
                        dataAttribute.forEach(x=>{
                            $input.dataset[x.prop] = x.value
                        })
                    }

                    //labelPlaceholderActive
                    if (labelPlaceholderActive) {
                       $input.placeholder = labelContent
                    }

                    //small
                    $small.setAttribute("id",`help-${name}`);
                    $small,textContent = smallContent;
                    smallClass.forEach(x=>{
                        $small.classList.add(x)
                    })





                    $formGroup.appendChild($input)
                    $formGroup.appendChild($small)

                return $formGroup;
            }
        const customCard = ({
                evento=`console.log('evento')`,
                image=`<i class="fas fa-hospital-user"></i>`,
                fontTitleSize="2em;",
                className='area',
                title ="area",
                total="10",
                existencia="2",
                alert=false,
                contador=false,
                height="6em",
                roundedPill="1em",
                width= "100%",
                imageVisibility=true
            })=>{
                return `
                    <div onclick="${evento}" class="card-${className} card mb-3" style="height: ${height};width: ${width};border-radius: ${roundedPill} !important;">
                        <div class="row no-gutters">
                            <div class="d-flex">
                                <div class="${imageVisibility ?'d-flex':'d-none'} px-1" style="align-items: center;height: ${height};">
                                    <div class="card-${className}-image">
                                        ${image}
                                    </div>
                                </div>
                                <div class="d-flex px-1" style="align-items: center;justify-content: center;flex-direction: column;height: ${height};">
                                    <div class="card-${className}-title" style="font-size:${fontTitleSize}">
                                        ${title.toUpperCase()}
                                    </div>
                                    <div class="${contador ?'d-flex':'d-none'} card-${className}-text px-1" style="align-items: center;">
                                        <div class="rounded-pill px-2">
                                            <b>${total}</b> / <span>${existencia}</span>
                                        </div>
                                        ${alert ? `<div class="bg-success rounded-circle" style="width:1em;height:1em;margin: 3% 0% 0% 0%;"></div>`:''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            };
        var comboGrupo = (response)=>{
            let especialidad ="";
            let group  =`<optgroup>`;
                group +=`<option value="">Escoja un médico</option>`;
                group +=`</optgroup>`
            let key = false;
            $.each(response, function(indexInArray, valueOfElement) {

                if (especialidad !== valueOfElement.especialidad  && !key ) {
                    especialidad = valueOfElement.especialidad
                    group +=`<optgroup class='text-primary' label="${especialidad}">`
                    key = true;
                }

                if (key) {
                    group +=`<option  class='text-secondary' value="${valueOfElement.user_id}">${valueOfElement.medico}</option>`
                }

                if(response[indexInArray+1] !== undefined){
                    if (response[indexInArray+1].especialidad !== especialidad) {
                        group +=`</optgroup>`
                        key=false;
                    }
                }


            });
            return group;
        }
        function rowIndexModel (row){
            return `
                <tr>

                    <td>
                        <div style="white-space: nowrap;">
                        ${row.medico}
                        </div>
                        <div style="white-space: nowrap;">
                            <b class="text-primary">${row.especialidad}</b>
                        </div>


                    </td>
                    <td>
                        <a
                            target="_blank"
                            href="https://api.whatsapp.com/send?phone=${row.telefono}"
                            data-tippy-content="Abre Whatsapp Web para iniciar un chat con ${row.medico}"
                            class="tooltip-success btn btn-default btn-sm"
                        >
                            <i class="fab fa-whatsapp text-success"></i>
                        </a>
                        <button data-tippy-content="Eliminar médico" onclick="UserMedico.deleteRow({tipoMedico:'tratante',user_cuest_medico_paciente_id:291,user_id:3850,color:'success',idTipoMedico:1})" class="tooltip-danger delete-row btn btn-danger  btn-sm" data-option=""><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </td>
                </tr>
            `;
        }
        let carga = () => {
            return `
                <span class="text-secondary">Cargando...</span>
                <span class="spinner-border text-primary spinner-border-sm" role="status">
                    <span class=""></span>
                </span>
            `
        }
        let first = (arr) => {

            return arr.length > 0 ? arr[0] : null;
        }

        function comingSoon(param1,param2) {

                Swal.fire(
                    param1,
                    param2,
                    'info'
                )
        }
        function cl(param) {
            console.log(param)
        }
        function cargarPagina({ruta,contenedor='newpage',data={}}){
            $(contenedor).html(`
                <div class="d-flex justify-content-center text-secondary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            `);
            var jqxhr = $.get( ruta, data, function() {
            })
            .done(function(pagina) {
                $(contenedor).html(pagina);
            })
            .fail(function() {
                alert( "Error en la función cargaPagina()" );
            })
            .always(function() {
                //alert( "finished" );
            });

            // Perform other work here ...
            // Set another completion function for the request above
            jqxhr.always(function() {
                //alert( "second finished" );
            });
        }

        function activarTooltip(){
            let array = ['primary','danger','success','info','warning','secondary','cyan','gray','purple','orange','pink','light']
            for (let index = 0; index <= array.length; index++) {
                let element = array[index];
                tippy('.tooltip-'+element, {
                    allowHTML: true,
                    theme: 'tooltip-cmdlt-'+element,
                    zIndex: 200000
                })
            }

        }
        let orderBy = (response, by,order="desc") => {
            return response.sort((a, b) => {
                let fa = a[by],
                    fb = b[by];
                if (order==="desc") {
                    if (fa > fb) {
                    return -1;
                    }
                    if (fa < fb) {
                        return 1;
                    }
                }
                if (order==="asc") {
                    if (fa < fb) {
                    return -1;
                    }
                    if (fa > fb) {
                        return 1;
                    }
                }

                return 0;
            })
        }
        function telefonoConfig(param) {
            var input = document.querySelector(param);
            iti = window.intlTelInput(input, {

                //customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                //    return "4141235555";
                //  },
            // allowDropdown: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            autoHideDialCode:true,
            nationalMode: false,
            preferredCountries: ['ve'],
            separateDialCode: true,
            utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
            });

            var handleChange = function() {
                //console.log(iti.getSelectedCountryData())
                var text = (iti.isValidNumber()) ? "<span class='text-success'><i class='far fa-check-circle'></i> Formato correcto</span>" : "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Formato incorrecto</span>";
                console.log("International: " + iti.getNumber())
                $("#help_telefonomovil").html(text)
              };
            input.addEventListener('change', handleChange);
            input.addEventListener('keyup', handleChange);
        }
        function validarPrimerDigito(value) {
            //console.log($("#"+value).val().length)
            if($("#"+value).val().length==1){
                if($("#"+value).val()==0){
                    $("#"+value).val('')
                }
            }

        }
        function newTableHeader(columnTitle) {
            let d = document;
            let $tr = d.createElement("tr")

                Object.values(columnTitle).forEach(x => {
                    let $th = d.createElement("th")
                    $th.classList.add("text-center", "text-primary")
                    $th.textContent = x
                    $tr.append($th)
                })
            return $tr
        }

        function newtableRowComent(data, $tr) {
            let { text } = data
            let d = document;
            let $coment = entById('newTableRowComent').content
                $coment = d.importNode($coment, true);
                $coment.querySelector('img').setAttribute("src", "https://via.placeholder.com/150")
            let $a = $coment.querySelectorAll('.username a')
                $a[0].textContent = "asdasdasd"
                $a[1].addEventListener("click", e => {
                    $tr.remove()
                })
            let $fecha = $coment.querySelector('.description')
                $fecha.innerHTML = `Enero 22, de 2022`
                //console.log($coment.querySelector('img'))
            let $p = $coment.querySelector('p')
                $p.textContent = text
            return $coment
        }
        function newTr(x) {
            let d = document;
            let $tr = d.createElement("tr")
            let $td = d.createElement("td")
                $td.classList.add("p-1")
                $td.append(newtableRowComent(x, $tr))
                $tr.append($td)
            return $tr
        }
        function newTableRow(rowsTexts) {

            let d = document;
            let $tr;
            let fragment = document.createDocumentFragment();
                if (rowsTexts.length === 0) {
                    $tr = d.createElement("tr")
                    let $td = d.createElement("td")
                        $td.classList.add("text-center", "text-primary","p-1")
                        $td.textContent = "Sin resultados"

                        $tr.append($td)
                        fragment.append($tr)
                } else {
                    rowsTexts.forEach((x, y) => {
                        fragment.append(newTr(x))
                    })
                }

            return fragment
        }
        function newTable(data) {
            let d = document;
            let {
                tbody = [],
            } = data
            let $table =         /*inicio variables globales*/

        // NO ELIMINAR ESTAS VARIABLES
        var ingreso                  = "";
        var message                  = 0;
        var totalSintomas            = 0;
        var totalEpidemiologia       = 0;
        var recomendacion            = "";
        var iti                      = "";
        var p                        = 0;
        var edad                     = 0;
        var email                    = "";
        var data                     = "";
        var hora                     = new Array();
        var menuAreaActiva           = "";

        var medicos_datos            = "";
        let pacientes_datos          = "";

        const EventBus = new Vue();

        const grupos_medicos     = [
            [1],
            [2],
            [3,4],
            [5,6,7,8],
            [9],
            [10]
        ]
        let traduccionDataTablesEsp = {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %ds fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir",
                "renameState": "Cambiar nombre",
                "updateState": "Actualizar",
                "createState": "Crear Estado",
                "removeAllStates": "Remover Estados",
                "removeState": "Remover",
                "savedStates": "Estados Guardados",
                "stateRestore": "Estado %d"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmentemente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "notBetween": "No entre",
                        "notEmpty": "No Vacio",
                        "not": "Diferente de"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vacio",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío",
                        "not": "Diferente de"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "notEmpty": "No Vacio",
                        "startsWith": "Empieza con",
                        "not": "Diferente de",
                        "notContains": "No Contiene",
                        "notStartsWith": "No empieza con",
                        "notEndsWith": "No termina con"
                    },
                    "array": {
                        "not": "Diferente de",
                        "equals": "Igual",
                        "empty": "Vacío",
                        "contains": "Contiene",
                        "notEmpty": "No Vacío",
                        "without": "Sin"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d",
                "showMessage": "Mostrar Todo",
                "collapseMessage": "Colapsar Todo"
            },
            "select": {
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "%d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                },
                "rows": {
                    "1": "1 fila seleccionada",
                    "_": "%d filas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Proximo",
                "hours": "Horas",
                "minutes": "Minutos",
                "seconds": "Segundos",
                "unknown": "-",
                "amPm": [
                    "AM",
                    "PM"
                ],
                "months": {
                    "0": "Enero",
                    "1": "Febrero",
                    "10": "Noviembre",
                    "11": "Diciembre",
                    "2": "Marzo",
                    "3": "Abril",
                    "4": "Mayo",
                    "5": "Junio",
                    "6": "Julio",
                    "7": "Agosto",
                    "8": "Septiembre",
                    "9": "Octubre"
                },
                "weekdays": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sab"
                ]
            },
            "editor": {
                "close": "Cerrar",
                "create": {
                    "button": "Nuevo",
                    "title": "Crear Nuevo Registro",
                    "submit": "Crear"
                },
                "edit": {
                    "button": "Editar",
                    "title": "Editar Registro",
                    "submit": "Actualizar"
                },
                "remove": {
                    "button": "Eliminar",
                    "title": "Eliminar Registro",
                    "submit": "Eliminar",
                    "confirm": {
                        "_": "¿Está seguro que desea eliminar %d filas?",
                        "1": "¿Está seguro que desea eliminar 1 fila?"
                    }
                },
                "error": {
                    "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                },
                "multi": {
                    "title": "Múltiples Valores",
                    "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                    "restore": "Deshacer Cambios",
                    "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                }
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "stateRestore": {
                "creationModal": {
                    "button": "Crear",
                    "name": "Nombre:",
                    "order": "Clasificación",
                    "paging": "Paginación",
                    "search": "Busqueda",
                    "select": "Seleccionar",
                    "columns": {
                        "search": "Búsqueda de Columna",
                        "visible": "Visibilidad de Columna"
                    },
                    "title": "Crear Nuevo Estado",
                    "toggleLabel": "Incluir:"
                },
                "emptyError": "El nombre no puede estar vacio",
                "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                "removeError": "Error al eliminar el registro",
                "removeJoiner": "y",
                "removeSubmit": "Eliminar",
                "renameButton": "Cambiar Nombre",
                "renameLabel": "Nuevo nombre para %s",
                "duplicateError": "Ya existe un Estado con este nombre.",
                "emptyStates": "No hay Estados guardados",
                "removeTitle": "Remover Estado",
                "renameTitle": "Cambiar Nombre Estado"
            }
        }
        let turnos = [
            "Mañana",
            "Tarde",
            "Todo el Dia"
        ]
        let tipo_turnos =[
            "todo_el_dia_publico",
            "todo_el_dia_privado",
            "manana_publica_tarde_privada",
            "tarde_publica_manana_privada",
            "personalizado",
        ]
        let mesesEnEspanol = [
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
            "Diciembre"
        ];

        let dias_nombres =[
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
        ]
        let fecha = new Date();
        let feriados = [
            {"year":fecha.getFullYear(), "month":1, "day":1, "description":`Año nuevo`},
            {"year":fecha.getFullYear(), "month":2, "day":12, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":2, "day":13, "description":`Carnaval`},
            {"year":fecha.getFullYear(), "month":3, "day":24, "description":`Domingo de Ramos`},
            {"year":fecha.getFullYear(), "month":3, "day":25, "description":`Lunes Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":26, "description":`Martes Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":27, "description":`Miércoles Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":28, "description":`Jueves Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":29, "description":`Viernes Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":30, "description":`Sábado Santo`},
            {"year":fecha.getFullYear(), "month":3, "day":31, "description":`Domingo de Resurreción`},
            {"year":fecha.getFullYear(), "month":4, "day":19, "description":`Declaración de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":5, "day":1, "description":`Día del trabajador`},
            {"year":fecha.getFullYear(), "month":6, "day":24, "description":`Batalla de Carabobo`},
            {"year":fecha.getFullYear(), "month":7, "day":5, "description":`Día de la Independencia de Venezuela`},
            {"year":fecha.getFullYear(), "month":7, "day":24, "description":`Natalicio de Simón Bolívar`},
            {"year":fecha.getFullYear(), "month":10, "day":12, "description":`Día de la Resistencia Indigena`},
            {"year":fecha.getFullYear(), "month":12, "day":24, "description":`Vispera de navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":25, "description":`Navidad`},
            {"year":fecha.getFullYear(), "month":12, "day":31, "description":`Fiesta de fín de año`},
        ]
        const getLastArrItem = (arr) => {
            let lastItem=arr[arr.length-1];
            return lastItem;
          }
        let tp = async ()=>
        {
            return await get( location.origin+"/vistas/tp")
        }
        let sinResult = ({message="No se encontraron pacientes",col="10"})=>
        {
              let tr = document.createElement('tr')
              let td = document.createElement('td')
                  td.setAttribute('colspan',col)
              let div = document.createElement('div')
                  div.classList.add('d-flex')
                  div.classList.add('m-4')
                  div.classList.add('justify-content-center')
                  div.classList.add('text-primary')
                  div.innerHTML=message
                  td.appendChild(div)
                  tr.appendChild(td)
              let nodo = document.getElementById('filasPacientes')
                  nodo.innerHTML=""
                  nodo.appendChild(tr)
          }
        let filtroMedico = (arr,posicion)=>{
            let temp = [];
                grupos_medicos[posicion-1].forEach(y => {
                    arr.forEach(x=>{
                        if( x.user_cuest_medico_posicion_id === y ){
                            temp.push(x);
                        }
                    });
                return await response.json();
            } catch (err) {
                console.error(err.message);
            }
        }
        function close_window() {
            var message = Component.alertMessage('close_cie11');
            Swal.fire({
                icon: message['image'],
                title: message['message'],
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Si`,

            }).then((result) => {
                if (result.isConfirmed) {
                    close();
                } else if (result.isDenied) {
                    //Swal.fire('Changes are not saved', '', 'info')
                }
            })

        }
        function openinforme(user_id) {
            if (user_id == undefined || $('#d_desde').val() == undefined || $('#d_hasta').val() == undefined) {
                alert("Ingrese fechas válidas")
                return false;
            } else {
                window.open(`/pdf/informeEgreso?user_id=${user_id}&desde=${$('#d_desde').val()}&hasta=${$('#d_hasta').val()}`, '_blank')

            }
        }
        function actualizarModalcie11(params) {
            UserCuestEpisodio.indexEpisodioCIE11({})

        }
        function loading(selector) {
            $(selector).html(`
                <div class="d-flex justify-content-center text-primary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            `);
        }

        function filtroTabla() {
            var busqueda = document.getElementById('busquedapaciente');
            var table = document.getElementById("tablapacientes").tBodies[0];

            buscaTabla = function() {
                texto = busqueda.value.toLowerCase();
                var r = 0;
                while (row = table.rows[r++]) {
                    if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                        row.style.display = null;
                    else
                        row.style.display = 'none';
                }
            }

            busqueda.addEventListener('change', buscaTabla);

        }
        function filtroPriorizados(paramPaciente) {
            $("#busquedapaciente").val(paramPaciente)
            var table = document.getElementById("tablapacientes").tBodies[0];
            let texto = $("#busquedapaciente").val().toLowerCase();
                var r = 0;
                while (row = table.rows[r++]) {
                    if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                        row.style.display = null;
                    else
                        row.style.display = 'none';
                }


        }

        function reemplaza_imagen(imagen) {
            imagen.onerror = "";
            imagen.src = "/image/system/medic.svg";
            return true;
        }

        function imagePreview(e, selector,showImageName=false) {

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


        function fotoTemporal(image_id, selector) {
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
        let $select =(data) => {
            let $fragment = document.createDocumentFragment()
            let $option = document.createElement("option")
                $option.value = ""
                $option.textContent = "Seleccione"
                $fragment.appendChild($option)
                data.forEach(x=>{
                    $option = document.createElement("option")
                    $option.value =x.id
                    $option.textContent =x.description
                    $fragment.appendChild($option)
                })
            return temp;
        }
        const onOffBlueCode = async (user_id) => {
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
        const headerNav = ({align="justify-content-end", fn=()=>{}})=>{
            $navbarCopy = document.getElementById(`navbar`).content;
            $navbar = document.importNode($navbarCopy,true);
            $navbar.querySelector("nav").classList.add(align);

            $headerTag = document.querySelector(`header`);

            $headerTag.appendChild($navbar);
            fn()
        }


        const boton = (
                {

                    idButton="#",
                    htmlButton=false,
                    textButton="Button name",
                    typeButton="button",
                    classButton=["btn","btn-block","btn-default","text-secondary"],
                    eventoTypeButton="click",
                    dataTippyContent="Sample tippy",
                    hrefButton="#",

                },
                fn=()=>{console.warn("Sin eventos")}
            )=>{
            let button = document.createElement(typeButton);
                classButton.forEach(element => {
                    button.classList.add(element)
                });

                button.setAttribute("id",idButton)
                button.setAttribute("data-tippy-content",dataTippyContent)

                if (typeButton === "a") {
                    button.setAttribute("href",hrefButton)
                }

                if (htmlButton) {
                    button.innerHTML = textButton;
                }else{
                    button.textContent = textButton;
                }


                button.addEventListener(eventoTypeButton,()=>{
                    fn()
                })
            return button;
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
                                        <img src="${location.origin}${titleImg}" style="width: 2em;height: 2em;" alt="foto medico" onerror="reemplaza_imagen(this)" class="rounded-circle p-0 img-thumbnail">
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
        const redireccionar = (area)=>{
            window.location.href="/medico/resumen_pacientes?area="+area
        }
        let selectOptions = (model, param, fields=['id','description'] ) => {
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
        const Toast = Swal.mixin({
            toast: false,
            position: 'center',
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
        hora = {
                13: 1,
                14: 2,
                15: 3,
                16: 4,
                17: 5,
                18: 6,
                19: 7,
                20: 8,
                21: 9,
                22: 10,
                23: 11,
                00: 12
            }
            // NO ELIMINAR ESTAS VARIABLES
            /*fin variables globales*/
            function triggerEvent(el, type) {
                // IE9+ and other modern browsers
                if ('createEvent' in document) {
                    var e = document.createEvent('HTMLEvents');
                    e.initEvent(type, false, true);
                    el.dispatchEvent(e);
                } else {
                    // IE8
                    var e = document.createEventObject();
                    e.eventType = type;
                    el.fireEvent('on' + e.eventType, e);
                }
            }
            function dayDiff(startdate, enddate) {
                var dayCount = 0;

                while(enddate >= startdate) {
                  dayCount++;
                  startdate.setDate(startdate.getDate() + 1);
                }

                return dayCount;
            }
            const $nuevaPregunta = ({
                cat_encuesta_id=1,
                user_encuesta_id = 1,
                cat_encuesta_preg_id = 1,
                grupoRespuestas=0,
                textCuestion ="¿Sample?",
                parent=false,
                children=false,
                btnEventId= 6,
                negado=false,
                coments=false,
            })=>{
                encuesta.push({
                    user_encuesta_id,
                    cat_encuesta_preg_id,
                    cat_encuesta_preg_value:0,
                    cat_encuesta_preg_coments:null,
                })
                let respuestas = {}
                let $template = document.getElementById("question").content;
                let $question = document.importNode($template,true);

                    $question.querySelector(".container-fluid").setAttribute("id",`${user_encuesta_id}_preg_${cat_encuesta_preg_id}`)
                    $textarea = $question.querySelector("textarea")
                    $textarea.id=`coments_${cat_encuesta_preg_id}`


                    if(children){
                        $question.querySelector(".container-fluid").classList.add("d-none",`parent-${parent}`)
                    }



                    //NUMERO DE LA PREGUNTA
                    $questionNumber = $question.querySelector(".bd-callout-number")
                    $questionNumber.textContent = cat_encuesta_preg_id;

                    //TEXTO DE LA PREGUNTA
                    $textQuestion = $question.querySelector(`[role="pregunta"]`)
                    $textQuestion.innerHTML = textCuestion;

                    //INICIO GRUPO DE RESPUESTAS
                    respuestas = [
                        {id:1,punto:1,description:`Nunca`},
                        {id:2,punto:2,description:`A veces`},
                        {id:3,punto:3,description:`La mayoría de las veces`},
                        {id:4,punto:4,description:`Siempre`},

                        //{id:5,punto:0,description:`Nunca usé el botón`},

                        {id:6,punto:0,description:`Si`},
                        {id:7,punto:0,description:`No`},

                        {id:8,punto:0,description:`A mi casa`},
                        {id:9,punto:0,description:`A la casa de otra persona`},
                        {id:10,punto:0,description:`A otra institución de salud`},

                       //{id:11,punto:0,description:`0`},
                        {id:12,punto:1,description:`1`},
                        {id:13,punto:2,description:`2`},
                        {id:14,punto:3,description:`3`},
                        {id:15,punto:4,description:`4`},
                        {id:16,punto:5,description:`5`},
                        {id:17,punto:6,description:`6`},
                        {id:18,punto:7,description:`7`},
                        {id:19,punto:8,description:`8`},
                        {id:20,punto:9,description:`9`},
                        {id:21,punto:10,description:`10`},

                        {id:22,punto:1,description:`Definitivamente no`},
                        {id:23,punto:2,description:`Hasta cierto punto no`},
                        {id:24,punto:3,description:`Hasta cierto punto si`},
                        {id:25,punto:4,description:`Definitivamente si`},

                        {id:26,punto:1,description:`Muy en desacuerdo`},
                        {id:27,punto:2,description:`En desacuerdo`},
                        {id:28,punto:3,description:`De acuerdo`},
                        {id:29,punto:4,description:`Muy de acuerdo`},

                        //{id:30,punto:0,description:`No me dieron ninguna medicina cuando salí del hospital`},

                        {id:31,punto:1,description:`Mala`},
                        {id:32,punto:2,description:`Regular`},
                        {id:33,punto:3,description:`Buena`},
                        {id:34,punto:4,description:`Muy buena`},
                        {id:35,punto:5,description:`Excelente`},





                    ];
                    switch (grupoRespuestas) {
                        case 1:
                            grupoRespuestas = [1,2,3,4/*,5*/];
                        break;
                        case 2:
                            grupoRespuestas = [6,7];
                        break;
                        case 3:
                            grupoRespuestas = [8,9,10];
                        break;
                        case 4:
                            grupoRespuestas = [12,13,14,15,16,17,18,19,20,21];
                        break;
                        case 5:
                            grupoRespuestas = [22,23,24,25];
                        break;
                        case 6:
                            grupoRespuestas = [26,27,28,29];
                        break;
                        case 7:
                            grupoRespuestas = [26,27,28,29/* ,30 */];
                        break;
                        case 8:
                            grupoRespuestas = [31,32,33,34,35];
                        break;
                        case 9:
                            grupoRespuestas = [36,37,38,39,40,41];
                        break;
                        case 10:
                            grupoRespuestas = [12,13,14,15,16];
                        break;



                        default:
                            grupoRespuestas = [1,2,3,4];
                        break;
                    }
                    //FIN GRUPO DE RESPUESTAS


                let $ulOption = $question.querySelector("ul")
                    $ulOption.setAttribute("id","lista_respuesta"+cat_encuesta_preg_id)
                    grupoRespuestas.forEach((x1,key) => {
                        respuestas.filter( y => y.id === x1).forEach(x2=>{
                            let $li = document.createElement("li");
                                $li.classList.add("nav-item")
                                $li.setAttribute("role","presentation")

                            let $a = document.createElement("a");
                                $a.classList.add("nav-link","rounded-pill","cursor-pointer","text-center")
                                $a.setAttribute("data-toggle","pill")
                                $a.setAttribute("role","respuesta")
                                $a.textContent = x2.description;
                                $a.setAttribute("data-value",x2.punto)
                                $a.setAttribute("data-pregunta_id",cat_encuesta_preg_id)
                                let preguntaConComentario = {
                                    1:[19,20,33,34,35],
                                    2:[9],
                                }
                                console.log(preguntaConComentario[cat_encuesta_id])
                                $a.addEventListener("click",function(e){
                                    //guardar la pregunta en LOCAL STORAGE
                                    encuesta = JSON.parse(localStorage.getItem("encuesta"))
                                    encuesta.forEach(x=>{
                                        if (
                                            x.user_encuesta_id===user_encuesta_id  &&
                                            x.cat_encuesta_preg_id===cat_encuesta_preg_id
                                        ) {
                                            //console.log(x)
                                            x.cat_encuesta_preg_value = x2.punto
                                            localStorage.setItem("encuesta",JSON.stringify(encuesta))
                                            //console.log(x)
                                        }


                                    })
                                    //PARA ACTIVAR O DESACTIVAR EL CAMPO DE COMENTARIOS

                                    if(coments){

                                        let $question = document.getElementById(`${user_encuesta_id}_preg_${cat_encuesta_preg_id}`)
                                            $c = $question.querySelector(".coments")
                                            $textarea = $c.querySelector("textarea")
                                        if(
                                            preguntaConComentario[cat_encuesta_id].includes(parseInt(e.target.dataset.pregunta_id)) &&
                                            [1,2].includes(parseInt(e.target.dataset.value))

                                        )
                                        {
                                            $c.classList.remove("d-none")
                                            $textarea.focus();
                                        }else{
                                            $c.classList.add("d-none")
                                        }
                                    }
                                })
                                if (coments) {
                                    if(
                                        preguntaConComentario[cat_encuesta_id].includes(parseInt(cat_encuesta_preg_id))

                                    )
                                    {


                                        $textarea.addEventListener("change",(e)=>{
                                           // alert(cat_encuesta_preg_id)
                                            encuesta = JSON.parse(localStorage.getItem("encuesta"))
                                            encuesta.forEach(x=>{
                                                if (
                                                    x.user_encuesta_id===user_encuesta_id  &&
                                                    x.cat_encuesta_preg_id===cat_encuesta_preg_id
                                                ) {
                                                    let a = document.querySelector("#lista_respuesta"+cat_encuesta_preg_id+" a.active").dataset.value
                                                    //console.log(x)

                                                    $textarea = document.querySelector(`#coments_${cat_encuesta_preg_id}`)
                                                    if (x.cat_encuesta_preg_value == a) {
                                                        x.cat_encuesta_preg_coments = $textarea.value;
                                                    }else{
                                                        x.cat_encuesta_preg_coments = null;
                                                    }

                                                    localStorage.setItem("encuesta",JSON.stringify(encuesta))
                                                    //console.log(x)
                                                }


                                            })
                                        })
                                    }
                                }
                                if (parent===true) {
                                    let condicion = negado ? x2.id!==btnEventId : x2.id===btnEventId
                                    if (condicion) {
                                        $a.addEventListener("click",function(e){
                                            //console.log("1-->",x2)
                                            let result = document.querySelectorAll(`.parent-${cat_encuesta_preg_id}`)
                                                result.forEach(x3=>{
                                                    if (x3.classList.contains("d-none")) {
                                                        x3.classList.remove("d-none")
                                                    }
                                                })
                                        })
                                    }else{
                                        $a.addEventListener("click",function(e){
                                            //console.log("2-->",x2)
                                            let result = document.querySelectorAll(`.parent-${cat_encuesta_preg_id}`)
                                                result.forEach(x3=>{
                                                    if (!x3.classList.contains("d-none")) {
                                                        x3.classList.add("d-none")
                                                    }
                                                })
                                        })
                                    }

                                }

                                $li.appendChild($a)
                                $ulOption.appendChild($li);
                        })

                    });

                return $question;

            }
            $("#messageModal").data("backdrop","static");
            let modalMensaje = ({
                    static =false,
                    title = `Title`,
                    content =`Content`,
                    action=`
                        <button data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Action</button>
                    `
                } ) =>{

                    $("#messageModal").modal("show")
                    $(".modal-body").html(`
                    <div class="container-fluid bg-primary p-3">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h3 class="display-4" style="font-size: 2.5em;">
                                    ${title}
                                </h3>
                                <p class="lead" style="font-size: 1.4em;font-style: italic;">
                                    ${content}
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                                ${action}
                            </div>
                        </div>
                    </div>
                     `);
                    if (static) {
                        $("#messageModal").data("backdrop","static");
                    }

            }
            let $input = (data)=>{
                const {
                    ariaDescribedby = "",
                    className       = ["form-control", "form-control-lg", "bg-gray-footer-parodi"],
                    dataAttribute   = [],
                    id              = "",
                    labelClass      = ["label-text", "text-secondary"],
                    labelContent    = "Form Input Group",
                    name            = "input",
                    placeholder     = "",
                    prefix          = "",
                    required        = false,
                    role            = "",
                    smallClass      = [],
                    smallContent    = "",
                    title           = "El campo ? no puede estar vacio",
                    type            = "text",
                    value           = "",
                    placeholderActive = false,
                    labelActive = true,
                    labelPlaceholderActive =false,
                } = data;

                let $formGroup = document.createElement("div")
                let $label     = document.createElement("label")
                let $input     = document.createElement("input")
                let $small     = document.createElement("small")

                    //formGroup
                    $formGroup.classList.add("form-group")

                    //label
                    if (labelActive) {
                        $label.htmlFor =name;
                        $label.textContent = labelContent;
                        labelClass.forEach(x=>{
                            $label.classList.add(x)
                        })
                        $formGroup.appendChild($label)
                    }


                    //input
                    $input.setAttribute("name",name);
                    $input.setAttribute("id",`${prefix}${name}`)
                    $input.setAttribute("role",role)
                    $input.setAttribute("required",required)

                    className.forEach(x=>{
                        $input.classList.add(x)
                    })

                    if (placeholderActive) {
                        placeholder === ""
                        ? $input.placeholder = name
                        : $input.placeholder = placeholder
                    }


                    role === ""
                        ? $input.setAttribute("role",name)
                        : $input.setAttribute("role",role)

                    ariaDescribedby === ""
                        ? $input.setAttribute("aria-describedby",`help-${name}`)
                        : $input.setAttribute("aria-describedby",ariaDescribedby)

                    if (dataAttribute.length > 0) {
                        dataAttribute.forEach(x=>{
                            $input.dataset[x.prop] = x.value
                        })
                    }

                    //labelPlaceholderActive
                    if (labelPlaceholderActive) {
                       $input.placeholder = labelContent
                    }

                    //small
                    $small.setAttribute("id",`help-${name}`);
                    $small,textContent = smallContent;
                    smallClass.forEach(x=>{
                        $small.classList.add(x)
                    })





                    $formGroup.appendChild($input)
                    $formGroup.appendChild($small)

                return $formGroup;
            }
        const customCard = ({
                evento=`console.log('evento')`,
                image=`<i class="fas fa-hospital-user"></i>`,
                fontTitleSize="2em;",
                className='area',
                title ="area",
                total="10",
                existencia="2",
                alert=false,
                contador=false,
                height="6em",
                roundedPill="1em",
                width= "100%",
                imageVisibility=true
            })=>{
                return `
                    <div onclick="${evento}" class="card-${className} card mb-3" style="height: ${height};width: ${width};border-radius: ${roundedPill} !important;">
                        <div class="row no-gutters">
                            <div class="d-flex">
                                <div class="${imageVisibility ?'d-flex':'d-none'} px-1" style="align-items: center;height: ${height};">
                                    <div class="card-${className}-image">
                                        ${image}
                                    </div>
                                </div>
                                <div class="d-flex px-1" style="align-items: center;justify-content: center;flex-direction: column;height: ${height};">
                                    <div class="card-${className}-title" style="font-size:${fontTitleSize}">
                                        ${title.toUpperCase()}
                                    </div>
                                    <div class="${contador ?'d-flex':'d-none'} card-${className}-text px-1" style="align-items: center;">
                                        <div class="rounded-pill px-2">
                                            <b>${total}</b> / <span>${existencia}</span>
                                        </div>
                                        ${alert ? `<div class="bg-success rounded-circle" style="width:1em;height:1em;margin: 3% 0% 0% 0%;"></div>`:''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            };
        var comboGrupo = (response)=>{
            let especialidad ="";
            let group  =`<optgroup>`;
                group +=`<option value="">Escoja un médico</option>`;
                group +=`</optgroup>`
            let key = false;
            $.each(response, function(indexInArray, valueOfElement) {

                if (especialidad !== valueOfElement.especialidad  && !key ) {
                    especialidad = valueOfElement.especialidad
                    group +=`<optgroup class='text-primary' label="${especialidad}">`
                    key = true;
                }

                if (key) {
                    group +=`<option  class='text-secondary' value="${valueOfElement.user_id}">${valueOfElement.medico}</option>`
                }

                if(response[indexInArray+1] !== undefined){
                    if (response[indexInArray+1].especialidad !== especialidad) {
                        group +=`</optgroup>`
                        key=false;
                    }
                }


            });
            return group;
        }
        function rowIndexModel (row){
            return `
                <tr>

                    <td>
                        <div style="white-space: nowrap;">
                        ${row.medico}
                        </div>
                        <div style="white-space: nowrap;">
                            <b class="text-primary">${row.especialidad}</b>
                        </div>


                    </td>
                    <td>
                        <a
                            target="_blank"
                            href="https://api.whatsapp.com/send?phone=${row.telefono}"
                            data-tippy-content="Abre Whatsapp Web para iniciar un chat con ${row.medico}"
                            class="tooltip-success btn btn-default btn-sm"
                        >
                            <i class="fab fa-whatsapp text-success"></i>
                        </a>
                        <button data-tippy-content="Eliminar médico" onclick="UserMedico.deleteRow({tipoMedico:'tratante',user_cuest_medico_paciente_id:291,user_id:3850,color:'success',idTipoMedico:1})" class="tooltip-danger delete-row btn btn-danger  btn-sm" data-option=""><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </td>
                </tr>
            `;
        }
        let carga = () => {
            return `
                <span class="text-secondary">Cargando...</span>
                <span class="spinner-border text-primary spinner-border-sm" role="status">
                    <span class=""></span>
                </span>
            `
        }
        let first = (arr) => {

            return arr.length > 0 ? arr[0] : null;
        }

        function comingSoon(param1,param2) {

                Swal.fire(
                    param1,
                    param2,
                    'info'
                )
        }
        function cl(param) {
            console.log(param)
        }
        function cargarPagina({ruta,contenedor='newpage',data={}}){
            $(contenedor).html(`
                <div class="d-flex justify-content-center text-secondary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            `);
            var jqxhr = $.get( ruta, data, function() {
            })
            .done(function(pagina) {
                $(contenedor).html(pagina);
            })
            .fail(function() {
                alert( "Error en la función cargaPagina()" );
            })
            .always(function() {
                //alert( "finished" );
            });

            // Perform other work here ...
            // Set another completion function for the request above
            jqxhr.always(function() {
                //alert( "second finished" );
            });
        }

        function validarArchivoImagen(id){
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
