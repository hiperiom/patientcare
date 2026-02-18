<template>
    <!-- RIESGOS-->
    <td :style="'width:5% !important;height:'+height" class="glassmod-effect text-center p-0">
    
        <div v-if="patient !== undefined" class="d-flex justify-content-around align-items-center" style="height: 100%;">
            <div style="font-size: 1.5rem;">
                <i
                    :class="[{ 'pc-alerta_alta text-danger heartbeat-2': patient['alerta_riesgo_value'] === 1 }, { 'pc-alerta_intermedia heartbeat text-warning': patient['alerta_riesgo_value'] === 2 }, { 'pc-alerta_estable text-success-alert': patient['alerta_riesgo_value'] === 3 },]"></i>
            </div>

            <!-- Riesgo Caida: -->
            <div style="font-size: 1.5rem;">
                <i
                    :class="['pc-resbalar', { 'text-danger heartbeat-2': patient['resbalar_riesgo_value'] === 1 }, { 'text-warning heartbeat ': patient['resbalar_riesgo_value'] === 2 }, { 'text-success-resbalar': patient['resbalar_riesgo_value'] === 3 },]"></i>
            </div>

            <!-- Riesgo Cirugía: -->
            <div style="font-size: 1.5rem;">
                <i
                    :class="['pc-cirugia', { 'text-danger heartbeat-2': patient['cirugia_riesgo_value'] === 3 }, { 'heartbeat  text-warning': patient['cirugia_riesgo_value'] === 2 }, { 'text-success-cirugia': patient['cirugia_riesgo_value'] === 1 },]"></i>
            </div>

        </div>
  
    </td>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name:"Column4",
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