<template>
    <!-- PENDIENTES -->
    <td :style="'width:5% !important;height:'+height" class="glassmod-effect text-center p-0">
  
        <div v-if="patient !== undefined" style="height: 100%;">
            <div v-for="(observacion, index) in patient['observaciones']" :key="index"
                class="d-flex mb-1 text-left align-items-start">
     
                <div class="d-flex flex-column align-items-start">

                    <b>{{ observacion.value }}</b>
                    <div class="mt-1">{{ observacion.description }}</div>
                </div>
            </div>
        </div>
    </td>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name:"Column5",
        data() {
            return {
                patient: {},
            }
        },
        props: {
            ubication: Object,
            index: Number,
            height:{
                type: String,
                required: true,
                default: "auto",
            },
        },
   
        computed: {
            ...mapState(['pacientes_activos']),
          
        },
        watch: {
            pacientes_activos(newValue, oldValue) {
                if(this.ubication.cat_user_ubicacion_id === 391){
                    this.patient = this.ubication
                }else{
                    this.patient = this.pacientes_activos.find(x=>x.cat_user_ubicacion_id === this.ubication.id)
                }
            }
        },

        mounted () {
            if(this.ubication.cat_user_ubicacion_id === 391){
                this.patient = this.ubication
            }else{
                this.patient = this.pacientes_activos.find(x=>x.cat_user_ubicacion_id === this.ubication.id)
            };
        },
        
    }
</script>

<style lang="scss" scoped>

</style>