class UserCuestEgreso{
    //static modelTitle ="Diagnosticos de Egreso";
    static modelTitle(){
        return "Diagnosticos de Egreso";
    }
    static classModel(){
        return "UserCuestEgreso";
    }
    static prefixRoute(){
        return "user_cuest_egreso";
    }

    //static classModel ="UserCuestEgreso";
    //static prefixRoute = "user_cuest_egreso";

    static index({selector=".modal-body", user_id}) {
        //incio component
        let model = UserCuestEgreso.classModel();

        Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: UserCuestEgreso.modelTitle(),

                //selector: identificador html en donde se va a pintar el componente
                selector,

                //user_id: id del usuario que se quiere visualizar
                user_id,

                //eventModelCreate: evento a ejecutar al pulsar en el botón Nuevo valor
                //OJO: se le pasa un string, porque la funcion eval, es la que determinará a que modelo nos estamos refiriendo.
                eventModelCreate: model+".create({user_id:"+user_id+"})",

                //eventModelContent: contenido del modelo que se esta mostrando
                eventModelContent: "Component.modelIndex_1({user_id:"+user_id+",columName:['"+UserCuestEgreso.modelTitle()+"'],classModel:'"+model+"'})",

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


    static create({selector=".modal-body",user_id}){
         //incio component
         let model = UserCuestEgreso.classModel();
         Component.modalTemplate_1(
            {
                //title: Nombre del modelo que se esta mostrando
                title: UserCuestEgreso.modelTitle(),

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
        return post( location.origin+"/"+UserCuestEgreso.prefixRoute() + "/show/" + user_id, formdata)
    }
    static store({user_id}){

        let formdata = new FormData();
        formdata.append("coment", $("#coments").val())
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( `/user_cuest_egreso/store`, formdata)
    }
    static store2({user_id}){
        let diagn_egre= []
        for (let index = comor_total; index < diagn_egre_total; index++) {
            if (
                $("#input-value-"+index).val() !== "" &&
                $("#input-code-"+index).val() !== "" &&
                $("#input-title-"+index).val() !== ""
            ) {
                diagn_egre.push({
                    user_cuest_episodio_id,
                    id                 : $("#input-title-"+index).data('diagn_egre_id'),
                    coment              : $("#input-value-"+index).val(),
                    cod_cie            : $("#input-code-"+index).val(),
                    cod_cie_description: $("#input-title-"+index).val()
                })

            }
        }
        let formdata = new FormData();
        formdata.append("model", JSON.stringify(diagn_egre))
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(`/user_cuest_egreso/store2`, formdata)
    }
    static eliminar({id,user_id}){
        UserCuestEgreso.destroy({id})
        .then(response=>{
            UserCuestEgreso.index({user_id})
        })
    }
    static update({user_id,user_cuest_egreso_id,cod_cie,cod_cie_description,coment,user_cuest_episodio_id}) {
        if (user_cuest_egreso_id !==undefined) {
            let formdata = new FormData();
            formdata.append("user_cuest_egreso_id", user_cuest_egreso_id)
            formdata.append("coment", coment)
            formdata.append("cod_cie", cod_cie)
            formdata.append("cod_cie_description", cod_cie_description)
            formdata.append("user_cuest_episodio_id", user_cuest_episodio_id)
            formdata.append("user_id", user_id)
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            return post( location.origin+"/user_cuest_egreso/update/"+user_cuest_egreso_id, formdata)

        }
    }
    static destroy({id}){
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_egreso/destroy/"+id, formdata)
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

                    UserCuestEgreso.destroy({id})
                    .then(response => {

                        $(`.row-egreso-${id}`).slideUp("slow");
                        !unde(n) ? $(`.row-egreso-${n}`).slideUp("slow")
                            : cl(n);
                    })
                } else if (result.isDenied) {
                    //Swal.fire('Changes are not saved', '', 'info')
                }
            })

    }
    static regresar({user_id, selector='#modalTemplate_2_footer'}){
        Component.btn_regresar({
            selector,
            eventModel:"UserCuestEgreso.index({user_id:"+user_id+"})"
        })
    }
}

