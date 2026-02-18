class UserCuestComorbilidad{
    //static modelTitle ="Comorbilidad";
    //static classModel ="UserCuestComorbilidad";
    //static prefixRoute = "user_cuest_comorbilidad";
    static modelTitle(){
        return "Antecedentes/Comorbilidad de Egreso";
    }
    static classModel(){
        return "UserCuestComorbilidad";
    }
    static prefixRoute(){
        return "user_cuest_comorbilidad";
    }
    static index({selector=".modal-body", user_id}) {
        //incio component
        let model = UserCuestComorbilidad.classModel();

        Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: UserCuestComorbilidad.modelTitle(),

                //selector: identificador html en donde se va a pintar el componente
                selector,

                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.
                eventModelCreate: model+".create({user_id:"+user_id+"})",

                //eventModelContent: contenido del modelo que se esta mostrando
                //eventModelContent: "",

                //eventModelFooter: opciones del modelo que se esta mostrando
                eventModelFooter:"UserCuestHistoria.regresar({user_id:"+user_id+"})"

                //si se está en la otra vista que no sea index,
                //se le pasa el parametro btn_create:false
                //para que no muestre el botón de crear
            },
            function () {
                $("#model_create").on("click", function () {
                   eval( model+".create({user_id:"+user_id+"})" )
                });

                Component.modelIndex_1({
                    user_id,
                    columName:[UserCuestComorbilidad.modelTitle()],
                    classModel:model
                })
            }
        );
        //fin component
    }


    static create({selector=".modal-body",user_id}){
         //incio component
         let model = UserCuestComorbilidad.classModel();
         Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: UserCuestComorbilidad.modelTitle(),

                //selector: identificador html en donde se va a pintar el componente


                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.


                //eventModelContent: contenido del modelo que se esta mostrando
                //eventModelContent: "Component.formTemplate_2({user_id:"+user_id+"})",

                //eventModelCreate: evento a ejecutar al pulsar en los botones del footer
                eventModelFooter: model+".regresar({user_id:"+user_id+"})",

                //btn_create:false  oculta el boton
                btn_create:false

                //si se está en la otra vista que no sea index,
                //se le pasa el parametro btn_create:false
                //para que no muestre el botón de crear
            },
            function () {
                Component.formTemplate_2({user_id})

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
        return post(location.origin+"/"+UserCuestComorbilidad.prefixRoute() + "/show/" + user_id, formdata)
    }
    static store({user_id}){

        let formdata = new FormData();
        formdata.append("description", $("#description").val())
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/"+UserCuestComorbilidad.prefixRoute() +"/store", formdata)
    }
    static update({user_id,user_cuest_comorbilidad_id,cod_cie,cod_cie_description,description}) {
        if (user_cuest_comorbilidad_id !==undefined) {
            let formdata = new FormData();
            formdata.append("user_cuest_comorbilidad_id", user_cuest_comorbilidad_id)
            formdata.append("description", description)
            formdata.append("cod_cie", cod_cie)
            formdata.append("cod_cie_description", cod_cie_description)
            formdata.append("user_cuest_episodio_id", user_cuest_episodio_id)
            formdata.append("user_id", user_id)
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            return post(location.origin+"/user_cuest_comorbilidad/update2", formdata)
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
        return post(location.origin+"/"+UserCuestComorbilidad.prefixRoute() +"/store2", formdata)
    }
    static eliminar({id,user_id}){
        UserCuestComorbilidad.destroy({id})
        .then(response=>{
            UserCuestComorbilidad.index({user_id})
        })
    }
    static destroy({id}){
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/"+UserCuestComorbilidad.prefixRoute() +"/destroy/"+id, formdata)
    }
    static destroycie11(id, n) {
        var message = Component.alertMessage('destroy_row_cuestion');
            Swal.fire({
                icon: message['image'],
                title: message['message'],
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Si`,

            }).then((result) => {
                if (result.isConfirmed) {

                    UserCuestComorbilidad.destroy({id})
                    .then(response => {

                        $(`.row-comorb-${id}`).slideUp("slow");
                        !unde(n) ? $(`.row-comorb-${n}`).slideUp("slow")
                            : cl(n);
                    })
                } else if (result.isDenied) {
                    //Swal.fire('Changes are not saved', '', 'info')
                }
            })

    }
    static regresar({user_id, selector='#modalTemplate_2_footer'}){
        Component.btn_group_store({
            selector,
            eventModel:"UserCuestComorbilidad.index({user_id:"+user_id+"})"
        })
    }
}

