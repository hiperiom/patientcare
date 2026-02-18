<template>
    <button
        v-if="!isActive"
        :id="propName+'_'+patient_data.episodio_id"
        @click="handle_button()"
        class="col-xl-6 mr-1 my-xl-1 mr-xl-0 order-3 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"
    >
        <b class="small-title text-primary">Traslado</b>
        <div class="mt-auto">
            <i :class="['fas fa-ambulance text-gray']"></i>
        </div>
    </button>
    <button
        v-else
        :content="getTolltipContent()"
        v-tippy="{ arrow : true, allowHTML:true, theme : 'tooltip-danger' }"
        :id="propName+'_'+patient_data.episodio_id"
        @click="handle_button()"
        class="col-xl-6 mr-1 my-xl-1 mr-xl-0 order-3 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"
    >
        <b class="small-title text-primary">Traslado</b>
        <div class="mt-auto">
            <i :class="['fas fa-ambulance text-danger' ]"></i>
        </div>
    </button>
</template>

<script>
    import { get, post } from '../../../../../helpers/customHelpers';
    import ModalTrasladosAmbulancia from './ModalTrasladosAmbulancia.vue';

    export default {
        name:"BtnTrasladoAmbulancia",
        props:{
            idModal:String,
            patient_data:Object,
            index:Number,
        },
        components: {
            ModalTrasladosAmbulancia,
        },
        data() {
            return {
                selector: null,
                propName: "btn_traslado_ambulancia"
            }
        },
        computed: {
            isActive() {
                return this.patient_data.traslado_ambulancia !== null ? true : false;
            }
        },
        methods:{
            getTolltipContent(){
                return  `
                            Traslado en Ambulancia Activo
                        `
            },
            async getList() {
                let formdata = new FormData();
                    formdata.append("_token", $("#_token").val())
                let result = await get("/user/traslado_ambulancia/show/" + this.patient_data.user_id)
                    this.$store.commit('updateProperty', {
                        fieldName:'historialTrasladosAmbulanciaPaciente',
                        fieldValue: result,
                    });
            },
            async handle_button(){
                this.getList()

                this.$store.commit('updateDinamicComponent', {
                    is_dismounted:false,
                    customComponent: this.$options.components.ModalTrasladosAmbulancia,
                    patient_data: this.patient_data,
                    index: this.index
                });
                $("#modal-trasladosAmbulancia").modal("show")
            },
        },
        mounted () {

        },
    }
</script>

<style lang="scss" scoped>
    .small-title {
        font-size: 0.7rem !important;
    }
</style>
