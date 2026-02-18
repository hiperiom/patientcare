class SystemIncidencia{
    static modelTitle ="PatientCare Incidencia";
    static classModel ="SystemIncidencia";
    static prefixRoute = "system_incidencia";

    static index() {
        //incio component
        let model = SystemIncidencia.classModel;

        Component.modalTemplate_2(
            {
                title:eval( model+".modelTitle" ),

                btn_title:"Nueva Incidencia",
            },
            function () {

                eval( model+".indexModel({})" )

                Component.btn_closeModal({})

                $("#model_create").on("click", function () {
                    eval( model+".create({})" )
                });

            }
        );
        //fin component
    }
    static indexModel({selector='#modalTemplate_1_body'}){
        let model = SystemIncidencia.classModel;
        $(selector) .html( `
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-haciendo-tab" data-toggle="pill" href="#pills-haciendo" role="tab"
                        aria-controls="pills-haciendo" aria-selected="false">
                        Haciendo
                        <span class="badge badge-light">4</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-pendiente-tab" data-toggle="pill" href="#pills-pendiente" role="tab"
                        aria-controls="pills-pendiente" aria-selected="true">
                        Pendiente
                        <span class="badge badge-light">4</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-completada-tab" data-toggle="pill" href="#pills-completada" role="tab"
                        aria-controls="pills-completada" aria-selected="false">
                        Completado
                        <span class="badge badge-light">4</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-haciendo" role="tabpanel" aria-labelledby="pills-haciendo-tab"></div>
                <div class="tab-pane fade" id="pills-pendiente" role="tabpanel" aria-labelledby="pills-pendiente-tab">.2..</div>
                <div class="tab-pane fade" id="pills-completada" role="tabpanel" aria-labelledby="pills-completada-tab">.3..</div>
            </div>
        `);


        eval(model+`.listadoModel({})`)
        .then(response=>{
            $("#pills-haciendo").html(response);
            $('#tableModel1').DataTable();
        })
        eval(model+`.listadoModel({tableId:2})`)
        .then(response=>{
            $("#pills-pendiente").html(response);
            $('#tableModel2').DataTable();
        })
        eval(model+`.listadoModel({tableId:3,'finalizado':true})`)
        .then(response=>{
            $("#pills-completada").html(response);
            $('#tableModel3').DataTable();
        })

        let formdata = new FormData();
            formdata.append("_token", $("#_token").val())
        post(location.origin+"/"+SystemIncidencia.prefixRoute +"/index",formdata)
        .then(response=>{
            if (Object.keys(response).length > 0) {
                response.map(x => {
                    console.log(x)
                })
            }

        })

    }
    static createModel({selector='#modalTemplate_1_body'}){
        let model = SystemIncidencia.classModel;

        $(selector) .html( `
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helptitulo" placeholder="">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                        <label for="cat_tipo_incidencia_id">Tipo</label>
                        <select class="form-control" name="cat_tipo_incidencia_id" id="cat_tipo_incidencia_id">
                            <option value="">Seleccione</option>
                            <option value="1">Actualización</option>
                            <option value="2">Error</option>
                            <option value="3">Funcionalidad</option>
                            <option value="4">Información</option>
                            <option value="5">Mejora</option>
                            <option value="6">Solicitud</option>
                            <option value="7">Sugerencia</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                        <label for="coments">Descripción</label>
                        <textarea id="coments" class="form-control form-control-lg bg-gray-footer-parodi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                        <label for="cat_tipo_prioridad_id">Prioridad</label>
                        <select class="form-control" name="cat_tipo_prioridad_id" id="cat_tipo_prioridad_id">
                            <option value="">Seleccione</option>
                            <option value="1">Alta</option>
                            <option value="2">Media</option>
                            <option value="3">Baja</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                        <label for="carpeta">Guardar en:</label>
                        <select class="form-control" name="carpeta" id="carpeta">
                            <option value="">Seleccione</option>
                            <option value="1">Pendiente</option>
                            <option value="2">Haciendo</option>
                            <option value="3">Completado</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                        <label for="finalizacion">Fecha aproximada de finalización</label>
                        <input type="date" name="finalizacion" id="finalizacion" class="form-control">
                        </div>
                    </div>
                </div>

            </div>
        `);
        Component.btn_agregar({eventModel:model+".store({})"})

        Component.btn_regresar({eventModel:model+".index({})"})
        $(function() {
            $('#coments').summernote();
        });
    }
    static listadoModel({col=['Tipo','Titulo','Prioridad','Avance','Creado','Acción'],tableId=1,finalizado=false}){
        return new Promise((resolve, reject) => {
            let columnas = "";
            col.forEach(element => {
                if (finalizado && element=="Creado") {
                    element ="Finalizado"
                }
                columnas += `<th>${element}</th>`;
            });

            resolve(`
                <div  class="table-responsive mb-2" style="max-height:60vh">
                    <table id="tableModel${tableId}" class="table table-bordered">
                        <thead>
                            <tr class="text-center text-secondary">
                                ${columnas}
                            </tr>
                        </thead>
                        <tbody id="listado_model">
                            <tr>
                                <td class="text-center">
                                    <div class="badge bg-primary">Mejora</div>
                                    <div class="badge bg-secondary">Secondary</div>
                                    <div class="badge bg-success">Success</div>
                                    <div class="badge bg-danger">Danger</div>
                                    <div class="badge bg-warning text-dark">Warning</div>
                                    <div class="badge bg-info text-dark">Info</div>
                                    <div class="badge bg-light text-dark">Light</div>
                                    <div class="badge bg-dark">Dark</div>
                                </td>
                                <td>asd asd asd sad sadsa dsadsa d</td>

                                <td>
                                    <select name="" id="input" class="form-control border-0" style="text-align-last: center;">
                                        <option value="1">Alta</option>
                                        <option value="2">Media</option>
                                        <option value="3">Baja</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    06/10/1987
                                </td>
                                <td nowrap class="text-center">
                                    <button type="button" class="btn btn-light text-primary"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-light text-danger"><i class="fas fa-minus-square"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `);

        });

    }
    static create({selector=".modal-body",user_id}){
        //incio component
        let model = SystemIncidencia.classModel;

        Component.modalTemplate_2(
            {
                title: "Nueva Incidencia",

                btn_create:false,

            },
            function () {
                eval( model+".createModel({})" )
            }
        );
        //fin component
    }
    static show({user_id}){
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return post(location.origin+"/"+SystemIncidencia.prefixRoute + "/show/" + user_id, formdata)
    }
    static validate() {


        let titulo = $("#titulo");
        let cat_tipo_incidencia_id = $("#cat_tipo_incidencia_id");
        let coments = $("#coments");
        let carpeta = $("#carpeta");
        let cat_tipo_prioridad_id = $("#cat_tipo_prioridad_id");
        let finalizacion = $("#finalizacion");

        if (titulo.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Toast.fire({
                icon:  message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => titulo.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (cat_tipo_incidencia_id.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Toast.fire({
                icon:  message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => cat_tipo_incidencia_id.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (
            coments.summernote('code') == "<p><br></p>" ||
            coments.summernote('code') == ""
        ) {
            message = Component.alertMessage("input_text_empty");
            Toast.fire({
                icon:  message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => coments.summernote('focus'), 110);
                }
            })
            return false;
        }
        if (cat_tipo_prioridad_id.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Toast.fire({
                icon:  message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => cat_tipo_prioridad_id.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (carpeta.val() == "") {
            message = Component.alertMessage("input_select_empty");
            Toast.fire({
                icon:  message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => carpeta.trigger("focus"), 110);
                }
            })
            return false;
        }
        if (finalizacion.val() == "") {
            message = Component.alertMessage("input_text_empty");
            Toast.fire({
                icon:  message['image'],
                title: message['title'],
                text: message['message'],
                didClose: () => {
                    setTimeout(() => finalizacion.trigger("focus"), 110);
                }
            })
            return false;
        }



        return true;
    }
    static store({}){
        let model = SystemIncidencia.classModel;
        let response = eval(model + ".validate()");
        if (response) {

            let titulo = $("#titulo");
            let cat_tipo_incidencia_id = $("#cat_tipo_incidencia_id");
            let coments = $("#coments");
            let carpeta = $("#carpeta");
            let cat_tipo_prioridad_id = $("#cat_tipo_prioridad_id");
            let finalizacion = $("#finalizacion");


            let formdata = new FormData();

            formdata.append("titulo", titulo.val())
            formdata.append("cat_tipo_incidencia_id", cat_tipo_incidencia_id.val())
            formdata.append("coments", coments.val())
            formdata.append("cat_tipo_prioridad_id", cat_tipo_prioridad_id.val())
            formdata.append("carpeta", carpeta.val())
            formdata.append("finalizacion", finalizacion.val())
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            post(location.origin+"/"+ SystemIncidencia.prefixRoute +"/store", formdata)
            .then(response=>{
                SystemIncidencia.index();
            });
        }
    }

    static store2({user_id}){

        let comor= []
        for (let index = diagn_ingre_total; index < comor_total; index++) {

            if (
                $("#input-value-"+index).val() !== "" &&
                $("#input-code-"+index).val() !== "" &&
                $("#input-title-"+index).val() !== ""
            ) {
                comor.push({
                    id                 : $("#input-title-"+index).data('comor_id'),
                    value              : $("#input-value-"+index).val(),
                    cod_cie            : $("#input-code-"+index).val(),
                    cod_cie_description: $("#input-title-"+index).val()
                })
            }

        }

        //console.log(comor)
        let formdata = new FormData();
        formdata.append("model", JSON.stringify(comor))
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/"+SystemIncidencia.prefixRoute +"/store2", formdata)
    }
    static eliminar({id,user_id}){
        SystemIncidencia.destroy({id})
        .then(response=>{
            SystemIncidencia.index({user_id})
        })
    }
    static destroy({id}){
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/"+SystemIncidencia.prefixRoute +"/destroy/"+id, formdata)
    }
    static regresar({}){

        Component.btn_closeModal({})
    }
}

