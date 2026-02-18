import {get,post,meses,is_null,activarTooltip,timestamps, is_undefined, loading, fechaCortaCustom2,fechaCortaCustom1, is_empty} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
import UserCuestHistoria from "./UserCuestHistoria.js";
let userCuestPaciente = new UserCuestPaciente()
let userCuestHistoria = new UserCuestHistoria()
export default class UserCuestPendiente {
    index(selector, user_id) {
        const index = pacientes_datos.findIndex((x) => x.user_id === user_id);
        
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div id="AppPending" class="flex-fill container-fluid d-flex flex-column">
                <div class="d-flex flex-wrap align-items-center my-2">
                <div class="col-12 col-sm-6">
                    <h3 class="text-primary mb-0">{{!create ? '':'Nuevo '}}Pendiente{{!create ? 's':''}}</h3>
                </div>
                <div class="col-12 col-sm-6 text-sm-right text-left">
                    <button 
                    @click="create = !create" style="font-size:1.5rem" 
                    v-if="!create"
                    class="btn btn-default text-primary mb-0"
                    >
                    Nuevo pendiente <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                
                </div>
                <div v-if="!create" class="flex-fill d-flex flex-column overflow-auto">
                <div class="flex-fill d-flex overflow-auto">
                    <div class="col-12 col-sm-6 d-flex flex-column overflow-auto">
                    <div class="p-1 mb-1 flex-fill d-flex flex-column overflow-auto"
                        style="background-color:#f3f3f3;border-radius:1rem">
                        <div class="d-flex align-items-center">
                        <h3 class="text-primary">Por hacer</h3>
                        <span class="ml-1 badge badge-danger">
                            {{listItems.filter(item=>Number(item.active)).length}}
                        </span>
                        </div>
                        <div class="flex-fill d-flex flex-column overflow-auto">
                        <div v-if="listItems.filter(item=>Number(item.active)).length > 0">
                            <div 
                            v-for="(item,index) in listItems.filter(item=>Number(item.active))" 
                            :key="item.id" 
                            @click="selectItem(item.id)"
                            :class="['card cursor-pointer shadow-sm d-flex p-1 mb-1',{'active':itemsMarks.includes(Number(item.id))}]"
                            >
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                <input
                                    :checked="itemsMarks.includes(Number(item.id))"
                                    style="width:1rem; height:1rem"
                                    type="checkbox"
                                    class="mx-1 mt-1 justify-content-start"
                                    >
                                <h5 class="mb-0">{{item.title}}</h5>
                                </div>
                                <h6 class="mb-0 text-nowrap">{{item.dias > 0 ? 'Hace '+item.dias+' dia' + (item.dias > 1 ? 's':'') : 'Hoy'}}</h6>
                            </div>
                            <div class="ml-4 d-flex">
                                {{item.description}}
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <img
                                    onerror="this.src='/image/system/medic.svg';"
                                    :src="item.imagen"
                                    style="border-radius:1rem;width:1rem; height:1rem;margin-right:0.2rem" alt="User Image"
                                > {{item.medico}}
                            </div>
                            </div>
                        </div>
                        <div v-else class="p-3 text-center text-secondary">
                            Nada pendiente
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-sm-6 d-flex flex-column overflow-auto">
                    <div class="p-1 mb-1 flex-fill d-flex flex-column overflow-auto"
                        style="background-color:#f3f3f3;border-radius:1rem">
                        <div class="d-flex align-items-center">
                        <h3 class="text-primary">Completados</h3>
                        <span class="ml-1 badge badge-success">
                            {{listItems.filter(item=>!Number(item.active)).length}}
                        </span>
                        </div>
                        <div class="flex-fill d-flex flex-column overflow-auto">
                        <div v-if="listItems.filter(item=>!Number(item.active)).length > 0">
                            <div 
                            v-for="(item,index) in listItems.filter(item=>!Number(item.active))" 
                            :key="item.id" 
                            
                            :class="['card shadow-sm d-flex p-1 mb-1']"
                            >
                            <div class="d-flex align-items-center justify-content-between">
                            
                                
                                <h5 class="mb-0">{{item.title}}</h5>
                                
                                <h6 class="mb-0 text-nowrap">{{item.dias > 0 ? 'Hace '+item.dias+' dia' + (item.dias > 1 ? 's':'') : 'Hoy'}}</h6>
                            </div>
                            <div class="d-flex">
                                {{item.description}}
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <img
                                    onerror="this.src='/image/system/medic.svg';"
                                    :src="item.imagen"
                                    style="border-radius:1rem;width:1rem; height:1rem;margin-right:0.2rem" alt="User Image"
                                > {{item.medico}}
                            </div>
                            </div>
                        </div>
                        <div v-else class="p-3 text-center text-secondary">
                            Nada Completado
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="d-flex mb-1">
                    <div class="col-6">
                    <button 
                        @click="updateItems" 
                        :disabled="!itemsMarks.length > 0" 
                        class="btn btn-success w-100 mb-0"
                    >
                        Completar pendientes
                    </button>
                    </div>
                    <div class="col-6">
                    <button data-dismiss="modal" aria-label="Close" class="btn btn-primary w-100 mb-0">Cerrar</button>
                    </div>
                </div>
                </div>
                <div v-else class="flex-fill d-flex flex-column overflow-auto">
                <div>
                    <input 
                        type="text" 
                        class="form-control form-control-lg bg-gray-footer-parodi" 
                        name="value" 
                        v-model="title"
                        aria-describedby="helpId" 
                        placeholder="Titulo"
                    >
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="flex-fill mb-1">
                    <textarea 
                        class="form-control bg-gray-footer-parodi " 
                        name="coments"  
                        v-model="description"
                        style=" width: 100%;height: 100%;resize: none;" 
                        placeholder="Observación"
                    ></textarea>
                </div>
                <div class="d-flex mb-1">
                    <div class="col-6">
                    <button 
                        @click="storeItems" 
                        :disabled="saving" 
                        class="btn btn-success w-100 mb-0"
                    >
                        Agregar
                    </button>
                    </div>
                    <div class="col-6">
                    <button @click="create = !create" class="btn btn-primary w-100 mb-0">Regresar</button>
                    </div>
                </div>
                </div>
            </div>

        `);
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)

        let app = new Vue({
          el: '#AppPending',
          components: {},
          data() {
            return {
                user_id: null,
                index: null,
                episodios:pacientes_datos,
                title: '',
                description: '',
                create: false,
                saving: false,
                listItems: [],
                itemsMarks: [],
            };
          },

          methods: {
            selectItem(itemId) {
              const item = this.itemsMarks.find((x) => x === Number(itemId));
              if (item) {
                this.itemsMarks = this.itemsMarks.filter((x) => x !== Number(itemId));
              } else {
                this.itemsMarks.push(Number(itemId));
              }
            },
            addItem() {},
            async showItems() {
              let formdata = new FormData();
              formdata.append('user_id', user_id);
              formdata.append('_token', $('#_token').val());
              this.listItems = await post(location.origin + '/user_cuest_pendiente/show', formdata);
            },
            updateItems(user_id) {
                const that = this;

                Swal.fire({
                  icon: 'warning',
                  title: '¿Desea completar los pendientes seleccionados?',
                  showCancelButton: true,
                  confirmButtonText: `Si`,
                  cancelButtonText: `Cancelar`,
                }).then((result) => {
                  if (result.isConfirmed) {
                    
                     
                      let formdata = new FormData();
                      formdata.append('user_id', that.user_id);
                      formdata.append('model', JSON.stringify(that.itemsMarks));
           
                      formdata.append('_token', $('#_token').val());
                      formdata.append('created_at', timestamps());
                      post(location.origin + '/user_cuest_pendiente/update', formdata).then(
                        (response) => {
                        
                          that.listItems =  response
                          that.itemsMarks = [];
              
                            this.episodios[that.index].t_pendiente = that.listItems.filter(item=>Number(item.active)).length

                            EventBus.$on('externalVarChanged', (newValue) => {
                                that.episodios = newValue;
                            });
                        }
                      );
                    
                  }
                });
           
            },
            validate(){
                if(!this.title){
                    Swal.fire({
                        icon: "warning",
                        title: "Campo obligatorio",
                        text: "El campo 'Titulo' es obligatorio.",
                        showCancelButton: true,
                        confirmButtonText: `Si`,
                        cancelButtonText: `Cancelar`,
                    })
                    return false;
                }
                /* if(!this.description){
                    Swal.fire({
                        icon: "warning",
                        title: "Campo obligatorio",
                        text: "El campo 'Observación' es obligatorio.",
                        showCancelButton: true,
                        confirmButtonText: `Si`,
                        cancelButtonText: `Cancelar`,
                    })
                    return false;
                } */
               return true;
            },
            storeItems() {
              const that = this;

              if (that.validate()) {
                that.saving = true;
                let formdata = new FormData();
                formdata.append('user_id', that.user_id);
                formdata.append('value', that.title);
                formdata.append('coments', that.description);
                formdata.append('_token', $('#_token').val());
                formdata.append('created_at', timestamps());
                post(location.origin + '/user_cuest_pendiente/store', formdata)
                .then((response) => {
               
                    that.saving = false;
                    that.listItems = response;
                    that.itemsMarks = [];
                    that.title = '';
                    that.description = '';
                    that.create = false;
           
                    this.episodios[that.index].t_pendiente = that.listItems.filter(item=>Number(item.active)).length

                    EventBus.$on('externalVarChanged', (newValue) => {
                        that.episodios = newValue;
                    });
            }
                );
              }
            },
          },
          created() {
            let that = this
            // Escuchar cambios en el bus de eventos
            EventBus.$on('externalVarChanged', (newValue) => {
                that.items = newValue;
            });
        },
          mounted() {
            this.user_id = user_id;
            this.index = index;
            this.showItems();
          },
        });
        
    }
    create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div>
                <h1 class="text-primary">
                    Nuevo Pendientes
                </h1>
            </div>
            <div>
                <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="value" id="value" aria-describedby="helpId" placeholder="Titulo">
                <small id="helpId1" class="form-text text-muted notification"></small>
            </div>
            <div class="flex-fill mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="coments" id="coments" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>


            <div class="d-flex">
                <button id="user_cuest_model_store" class="mr-1 btn btn-success w-100">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary w-100">Regresar</button>
            </div>

        `);



        let that = this
        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            that.index(selector, user_id)
        });
        $("#user_cuest_model_store").on("click", function() {
            that.store(user_id)
                .then(response => {
                    let count = 0;
                    $.each(response, function(indexInArray, valueOfElement) {
                        if (valueOfElement.active == 1) {
                            count++;
                        }
                    });
                    $("#total_pendientes_" + user_id).show().html(count);
                    userCuestHistoria.getHistorial(user_id)
                    .then(response => {
                        if (Object.keys(response).length >0) {
                            pacientes_datos.map(x=>{
                                if (x.user_id == user_id) {
                                    x.resultados = response;
                                }
                            });
                        }else{
                            pacientes_datos.map(x=>{
                                if (x.user_id == user_id) {
                                    x.resultados = [];
                                }
                            });
                        }
                        that.index('.modal-body', user_id);
                    })

                });
        });
        $("#info").on("click", function() {
            that.help(selector, user_id);
        });
    }
    store2(user_id){
        let message;
        let formdata = new FormData();
        let value = "Pendiente";
        let coments = $("#coments_"+user_id);
        let privado = $("#privado_"+user_id).val();


        if (coments.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            coments.trigger('focus')
            return false;
        }
        formdata.append("user_id", user_id)
        formdata.append("value", value)
        formdata.append("privado", privado)
        formdata.append("created_at", timestamps())
        formdata.append("coments", coments.val())
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_pendiente/store2", formdata)
        .then(response1=>{
            coments.val('')

            userCuestHistoria.getHistorial(user_id)
            .then(response => {
                if (Object.keys(response).length >0) {
                    pacientes_datos.map(x=>{
                        if (x.user_id == user_id) {
                            x.resultados = response;
                        }
                    });
                }else{
                    pacientes_datos.map(x=>{
                        if (x.user_id == user_id) {
                            x.resultados = [];
                        }
                    });
                }
                let ultimo = first(response1);
                let f = new Date(ultimo.created_at_default);

                let fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();

                $("#listado_pendiente_"+ user_id).prepend(
                listGoup(
                    {
                        eventCompletar:`this.update2(${user_id},${ultimo.id},'pendiente')`,
                        completar:true,
                        tagTitle      : true,
                        title         : ultimo.value,
                        tagDescription: true,
                        description   : ultimo.coments,

                        destroy:false,
                        tagTime       : true,
                        created_at    : fecha,
                        hora          : ultimo.hora,
                        registromedico: `${ultimo.medico} | ${fecha} | ${ultimo.hora}`,
                        id            : ultimo.id,
                        model         : "pendiente",
                        eventEliminar : `UserCuestPlan.destroy2(${user_id},${ultimo.id})`,
                    }
                ));
            })

        })
    }
    store(user_id) {
        console.log(user_id);
        let message;
        let formdata = new FormData();
        let value = $("#value");
        let coments = $("#coments");

        if (value.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            value.trigger('focus')
            return false;
        }
        if (coments.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            coments.trigger('focus')
            return false;
        }
        formdata.append("user_id", user_id)
        formdata.append("value", value.val())
        formdata.append("created_at", timestamps())
        formdata.append("coments", coments.val())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_pendiente/store", formdata)
    }
    update(user_id) {
        let message;
        let formdata = new FormData();
        let value = JSON.stringify($('[name="model[]"]').serializeArray());
        let a = $('[name="model[]"]').serializeArray();
        if (a.length == 0) {
            message = Component.alertMessage("input_checkbox_empty");
            alert(message['message'])
            return false;
        }
        formdata.append("user_id", user_id)
        formdata.append("model", value)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_pendiente/update", formdata)
    }
    update2(user_id_paciente,user_cuest_pendiente_id,model) {
        //entrega de guardias
        var message = Component.alertMessage('update_row_cuestion');
        Swal.fire({
            icon: message['image'],
            title: message['message'],
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,

        }).then((result) => {
            if (result.isConfirmed) {
                let formdata = new FormData();
                    formdata.append("id", user_cuest_pendiente_id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())


                post( location.origin+"/user_cuest_pendiente/update2", formdata)
                .then(response=>{
                    userCuestHistoria.getHistorial(user_id_paciente)
                    .then(response => {
                        if (Object.keys(response).length >0) {
                            pacientes_datos.map(x=>{
                                if (x.user_id == user_id_paciente) {
                                    x.resultados = response;
                                }
                            });
                        }else{
                            pacientes_datos.map(x=>{
                                if (x.user_id == user_id_paciente) {
                                    x.resultados = [];
                                }
                            });
                        }
                        showHide(`#row_${user_cuest_pendiente_id}_${model}`)
                    })






                })

            }
        })

    }
    show(user_id) {
        let a = confirm("¿Desea completar los pendientes seleccionados?")

        if (a == true) {
            this.update(user_id)
                .then(response => {
                    if (Object.keys(response).length > 0) {
                        let count = 0;
                        $.each(response, function(indexInArray, valueOfElement) {
                            if (valueOfElement.active == 1) {
                                $("#total_pendientes_" + user_id).show().html(count++);
                            } else {
                                $("#total_pendientes_" + user_id).css("display", "none");
                            }
                        });
                    } else {
                        $("#total_pendientes_" + user_id).css("display", "none");
                    }
                    this.index(".modal-body", user_id)
                })
        }
    }
    destroy(id) {
        let formdata = new FormData();
        formdata.append("id", id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post( location.origin+"/user_cuest_pendiente/destroy", formdata)
    }
    eliminar(row_id, user_id) {
        var message = Component.alertMessage('destroy_row_cuestion');
        var r = confirm(message['message']);
        if (r == true) {
            this.destroy(row_id)
                .then(response => {
                    if (Object.keys(response).length > 0) {
                        let count = 0;
                        $.each(response, function(indexInArray, valueOfElement) {
                            if (valueOfElement.active == 1) {
                                $("#total_pendientes_" + user_id).show().html(count++);
                            } else {
                                $("#total_pendientes_" + user_id).css("display", "none");
                            }
                        });
                    } else {
                        $("#total_pendientes_" + user_id).css("display", "none");
                    }
                    this.index('.modal-body', user_id)
                })
        }
    }
    colorGl(value) {
        if (value < 60) {
            return "text-danger";
        }
        if (value >= 60 && value <= 69.9) {
            return "text-warning";
        }
        if (value >= 70 && value <= 100) {
            return "text-success";
        }
        if (value >= 100.1 && value <= 125) {
            return "text-warning";
        }
        if (value > 125) {
            return "text-danger";
        }

    }
    columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="this.index('.modal-body',${data.user_id})" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    GL
                </div>
                ${data.valor=="" || data.valor==null?"<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>":"<span class='"+this.colorGl(data.valor)+"'>"+data.valor+" mg/dL</span>"}
            </div>
        `);
    }
}
