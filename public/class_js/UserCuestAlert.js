class UserCuestAlert {
    constructor({value=1, user_id_paciente=null,description=null,episodio_id=null}){
        this.episodio_id = Number(episodio_id),
        this.value = Number(value),
        this.user_id_paciente = Number(user_id_paciente)
        this.model_name = "alert"
        this.description = "Estable"
        this.icon = "pc-alerta_estable"
        this.color = "success"
        this.prioridad = "pri_estable"
        this.animation = ""
        this.message = is_null(description) ? '': description
    }
    view1(){
        return /*html */`
            <div class="container-fluid py-3">
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" placeholder="Escribe un comentario sobre tu selección. (Opcional)" rows="3" name="coment_${this.model_name}" id="coment_${this.model_name}"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pt-3">
                        <a id="submit_alert" class="btn btn-block btn-primary" data-value="${this.value}" data-episodio_id="${this.episodio_id}" data-user_id_paciente="${this.user_id_paciente}" href="#" role="button">Guardar</a>
                    </div>
                </div>
            </div>
        `;
    }
    buttom(){

            if (Number(this.value) == 2) {
                this.description = "Intermedio"
                this.icon = "pc-alerta_intermedia"
                this.color = "warning"
                this.prioridad = "pri_intermedio"
                this.animation = "ping"
            }
            if (Number(this.value) == 1) {
                this.description = "Alta"
                this.icon = "pc-alerta_alta"
                this.color = "danger"
                this.prioridad = "pri_de_cuidado"
                this.animation = "ping-2"
            }
            return `<span data-tippy-content="<b><i class='${this.icon}'></i> Alerta:</b> ${this.description} <br> <small>${this.message}</small>" style='font-size: 25px !important;' class='tooltip-cmdlt-${this.color} ${this.prioridad} text-${this.color} ${this.animation} heartbeat p-0 m-0 font-weight-bold'><i class='${this.icon}'></i></span>`
    }
    async store(){
        console.log(this)
        let description = $("#coment_"+this.model_name ).val()
        let formData = new FormData();
            formData.append("episodio_id", this.episodio_id)
            formData.append(this.model_name, this.value)
            formData.append("user_id_paciente", this.user_id_paciente)
            formData.append("description", !is_undefined( description ) ? description : null)
            formData.append("created_at", timestamps() )
            formData.append("_token", $("#_token").val())
        let model = await post(location.origin+"/user_cuest_alert/store", formData)
            this.value = Number(model.value)
            this.user_id_paciente = Number(model.user_id_paciente)
            this.message = is_null(model.description) || is_undefined(model.description) ? '': model.description

            $("#default-"+this.model_name +"_"+ this.user_id_paciente).html(this.buttom());

            tippy("."+this.prioridad, {
                theme: `tooltip-cmdlt-${this.color}`,
                zIndex: 200000,
                allowHTML: true
            })

            activarTooltip()
            $("#messageModal").modal("hide")
    }
    create() {
        $("#messageModal").modal("show")
        $("#messageModal .modal-body").html( this.view1() );
    }
}
