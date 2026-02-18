<template>
    <button
        @click="handle_button()"
        class="w-100 mr-1 mr-xl-0 order-1 order-1 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"
    >
        <b class="small-title text-primary">Ubicación</b>
        <div class="flex-fill d-flex justify-content-center  align-items-end">
            {{patient_data.ubicacion}}
        </div>
    </button>
</template>

<script>
    import { post } from '../../../../../helpers/customHelpers';
    import ModalTraslado from './ModalTraslado.vue';

    export default {
        name:"BtnUbicacion",
        props:{
            patient_data:Object,
            index:Number,
        },
        data() {
            return {
                item:{},
            }
        },
        components: {
            ModalTraslado,
        },
        methods:{

            async getList() {
                let formdata = new FormData();
                    formdata.append("_token", $("#_token").val())
                let result = await post( location.origin+"/user_cuest_ubicacion/historialUbiEpisodio/" + this.patient_data.user_id, formdata)
                    this.$store.commit('updateProperty', {
                        fieldName:'historialUbicacionesPaciente',
                        fieldValue: result,
                    });
            },
            async handle_button(){
                this.getList()
                this.$store.commit('updateDinamicComponent', {
                    customComponent: this.$options.components.ModalTraslado,
                    patient_data: this.patient_data,
                    index: this.index
                });
                $("#modal-traslados").modal("show")
            },


        },
        mounted() {

            this.item =  this.$store.state.cat_ubicaciones.find(x=>x['id'] === this.patient_data.cat_user_ubicacion_id)
        },
    }
</script>

<style lang="scss" scoped>
    .small-title {
        font-size: 0.7rem !important;
    }
</style>
