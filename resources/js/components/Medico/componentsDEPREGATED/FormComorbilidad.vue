<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto" >

        <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" />
        <div class="flex-fill mt-1 container-fluid d-flex flex-column  rounded overflow-auto">
            <h1 class="h1 text-primary">
                {{ title }}
            </h1>
            <div class="flex-fill overflow-auto mb-1">
                <textarea
                    class="form-control bg-gray-footer-parodi "
                    :placeholder="'Escriba su '+ title"
                    name="value"
                    ref="value"
                    rows="3"
                    style=" width: 100%;height: 100%;resize: none;"
                    v-model="form.value"
                ></textarea>
            </div>
        </div>
        <div class="rounded d-flex mt-1">
            <button @click="submit()" id="submit" class="flex-fill btn btn-success mr-1">
                Agregar
            </button>
            <button @click="regresar()" class="flex-fill btn btn-primary"   >
                Regresar
            </button>

        </div>

    </div>
</template>

<script>
    import { get,post,timestamps , is_empty,capitalize,meses, is_null,horaAMPM, is_undefined } from '../../../helpers/customHelpers';
    import CintilloModal from './CintilloModal.vue';

    export default {
        name:"FormComorbilidad",
        props:{
            index_row:Number,
            dataPaciente:Object
        },
        components: {
            CintilloModal,
        },
        data() {
            return {
                title:"Antecedentes/Comorbilidad",
                prefixRoute:"user_cuest_comorbilidad",
                form:{
                    value:"",
                }
            }
        },
        methods: {

            regresar(){
                //console.log(this.$options.components)
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$store.state.componenteDinamico.customComponent2,
                        customComponent2: this.$store.state.componenteDinamico.customComponent2,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            async getHistorial(){
                let formdata = new FormData();
                formdata.append("user_id", this.dataPaciente.user_id)
                formdata.append("_token", $("#_token").val())
                return await post( location.origin+"/user_cuest_historia_medica/getHistorial", formdata)
            },
            async submit(){
                if (this.form.value === "") {

                    Swal.fire({
                        icon: "warning",
                        title: "Campo Obligatorio",
                        text: `Una ${this.title} es requerida.`,
                        didClose: () => {
                            setTimeout(() => this.$refs.value.focus(), 110);

                        }
                    })

                    return false;
                }



                let formdata = new FormData();
                    formdata.append("description", this.form.value)
                    formdata.append("user_id", this.dataPaciente.user_id)
                    formdata.append("episodio_id", this.dataPaciente.episodio_id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                let result = await post(location.origin+"/"+this.prefixRoute+"/store", formdata)


                /* let temp = this.dataPaciente
                    console.log(temp.resultados)
                    temp.resultados = await this.getHistorial()
                    console.log(temp)
                    this.$store.commit('updateEpisodio', {
                        formName:'pacientes_datos',
                        index:this.index_row,
                        fieldValue: temp
                    }); */

                    Swal.fire({
                        icon: "warning",
                        title: "Datos guardados",
                        text: "El registro se ha guardado exitosamente.",
                        didClose: () => {
                            //$("#exampleModal").modal("hide")
                            this.$store.commit('updateProperty', {
                                fieldName: 'componenteDinamico',
                                fieldValue: {
                                    customComponent: this.$store.state.componenteDinamico.customComponent2,
                                    customComponent2: this.$store.state.componenteDinamico.customComponent2,
                                    index_row: this.index_row,
                                    dataPaciente: this.dataPaciente
                                }
                            });

                        }
                    })

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
