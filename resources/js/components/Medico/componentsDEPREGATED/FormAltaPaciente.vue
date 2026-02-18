<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto" >

        <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" />
        <div class="flex-fill mt-1 container-fluid d-flex flex-column  rounded overflow-auto">
            <h1 class="h1 text-primary">
                Egreso
            </h1>
            <div class="row mb-1">
                <div class="col-12 col-sm-6">
                    <div class="h3 text-gray text-center">
                        Ubicación Actual
                    </div>
                    <!-- <input type="hidden" id="cat_user_ubicacion_id_actual" value="57"> -->
                    <input
                        type="text" style="background-color:var(--gray) !important"
                        readonly
                        class="form-control text-center bg-gray-footer-parodi"
                        name="ubicacion_actual"
                        id="ubicacion_actual"
                        aria-describedby="helpId"
                        placeholder="Nuevo valor"
                        :value="dataPaciente.ubicacion"
                    >
                </div>
                <div class="col-12 col-sm-6">
                    <div class="h3 text-gray text-center">
                        Destino alta
                    </div>
                    <select
                        id="cat_user_ubicacion_id"
                        name="cat_user_ubicacion_id"
                        class="form-control bg-gray-footer-parodi"
                        v-model="form.cat_user_ubicacion_id"
                    >
                        <option value="246">Domicilio</option>
                        <option value="251">Traslado a otra Institución</option>
                        <option value="247">Contraopinión Médica</option>
                        <option value="248">Fallecido</option>
                        <option value="249">Otra</option>
                    </select>
                </div>

            </div>
            <div class="h3 text-gray text-center">
                Diagnóstico de Egreso
            </div>
            <div class="flex-fill overflow-auto mb-1">
                <textarea
                    class="form-control bg-gray-footer-parodi "
                    placeholder="Escriba el diagnóstico"
                    name="coment"
                    ref="coment"
                    rows="3"
                    style=" width: 100%;height: 100%;resize: none;"
                    v-model="form.coment"
                ></textarea>
            </div>






        </div>
        <div class="rounded d-flex mt-1">
            <button @click="submit()" id="submit" class="flex-fill btn btn-success mr-1">
                Guardar
            </button>
            <button class="flex-fill btn btn-primary"   data-dismiss="modal" aria-label="Close">
                Cancelar
            </button>

        </div>

    </div>
</template>

<script>
    import { get,post,timestamps , is_empty,capitalize,meses, is_null,horaAMPM, is_undefined } from '../../../helpers/customHelpers';
    import CintilloModal from './CintilloModal.vue';
    import FormProbalilidadDiagnostica from './FormProbalilidadDiagnostica.vue';
    export default {
        name:"FormAltaPaciente",
        props:{
            index_row:Number,
            dataPaciente:Object
        },
        components: {
            CintilloModal,
            FormProbalilidadDiagnostica,
        },
        data() {
            return {
                ingreso:"Egreso",
                prefixRoute:"user_cuest_episodio",
                form:{
                    cat_user_ubicacion_id:246,
                    coment:"",
                }
            }
        },
        methods: {
            async store(){

                let formdata = new FormData();
                    formdata.append('cat_user_ubicacion_id',this.dataPaciente.cat_user_ubicacion_id);
                    formdata.append('cat_user_informe_id',2);
                    formdata.append('cat_user_ubicacion_id_destino',this.form.cat_user_ubicacion_id);
                    formdata.append('coment',this.form.coment);
                    formdata.append('value',this.ingreso);
                    formdata.append("user_id", this.dataPaciente.user_id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                    return await post( location.origin+"/"+this.prefixRoute +"/store", formdata)
            },
            async submit(){

                if (this.form.coment === "") {

                    Swal.fire({
                        icon: "warning",
                        title: "Campo obligatorio",
                        text: "El diagnóstico de egreso es requerido.",
                        didClose: () => {
                            setTimeout(() => this.$refs.coment.focus(), 110);

                        }
                    })

                    return false;
                }
                let response = await this.store()
                if (String(response)=='imp_diagn_not_found') {

                    Swal.fire({
                        icon: "warning",
                        title: "Probabilidad diagnóstica requerida",
                        text: "Debe agregar una probabilidad diagnóstica para generar un informe de egreso válido.",
                        didClose: () => {
                            this.$store.commit('updateProperty', {
                                fieldName: 'componenteDinamico',
                                fieldValue: {
                                    customComponent: this.$options.components.FormProbalilidadDiagnostica,
                                    customComponent2: this.$store.state.componenteDinamico.customComponent2,
                                    index_row: this.index_row,
                                    dataPaciente: this.dataPaciente
                                }
                            });

                        }
                    })


                    //UserCuestImpresionDiagnostica.create('.modal-body',user_id)
                }
                //$("#exampleModal").modal("hide")
                //ingreso = "Egreso";

            }
        },
        mounted() {

            }
    }
</script>

<style scoped>

    .bg-transparent{
        background-color: transparent !important;
        border:0px !important
    }
    .btn-default-custom {
        background-color: transparent;
    }
    .btn-default-custom:hover {
        background-color: #e2e2e2;
    }
    .heartbeat:hover {
        -webkit-animation: heartbeat 1.5s ease-in-out infinite both;
        animation: heartbeat 1.5s ease-in-out infinite both
    }

    @-webkit-keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        10% {
            -webkit-transform: scale(.91);
            transform: scale(.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        17% {
            -webkit-transform: scale(.98);
            transform: scale(.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        33% {
            -webkit-transform: scale(.87);
            transform: scale(.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
    }

    @keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        10% {
            -webkit-transform: scale(.91);
            transform: scale(.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        17% {
            -webkit-transform: scale(.98);
            transform: scale(.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        33% {
            -webkit-transform: scale(.87);
            transform: scale(.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
    }
</style>
