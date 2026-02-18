<template>
    <!-- OBSERVACIONES -->
    <td :style="'font-size: 0.9rem;line-height:0.8rem !important;width:10% !important;height:'+height" class="glassmod-effect text-left p-1">
        <div v-if="patient !== undefined && ![null, 'null'].includes(patient['user_vip_description'])"
            class="d-flex text-left align-items-center">
            <span :class="['badge badge-info mr-1 mb-1']">
                <i :class="['pc-paciente_vip']"></i>
                <!--  VIP: -->
            </span>
            {{ patient['user_vip_description'] }}
        </div>
        <div v-if="patient !== undefined && ![null, 'null'].includes(patient['alerta_riesgo_description'])"
            class="d-flex text-left align-items-center">
            <span
                :class="['badge mr-1 mb-1', { 'badge-danger': patient['alerta_riesgo_value'] === 1 }, { 'badge-warning': patient['alerta_riesgo_value'] === 2 }, { 'badge-success': patient['alerta_riesgo_value'] === 3 },]">
                <i
                    :class="['text-white ', { 'pc-alerta_alta heartbeat-2': patient['alerta_riesgo_value'] === 1 }, { 'pc-alerta_intermedia heartbeat': patient['alerta_riesgo_value'] === 2 }, { 'pc-alerta_estable': patient['alerta_riesgo_value'] === 3 },]"></i>
                <!-- Riesgo: -->
            </span>
            {{ patient['alerta_riesgo_description'] }}
        </div>
        <div v-if="patient !== undefined && ![null, 'null'].includes(patient['resbalar_riesgo_description'])"
            class="d-flex text-left align-items-center">
            <span
                :class="['badge mr-1 mb-1', { 'badge-success': patient['resbalar_riesgo_value'] === 3 }, { 'badge-warning': patient['resbalar_riesgo_value'] === 2 }, { 'badge-danger': patient['resbalar_riesgo_value'] === 1 },]">
                <i
                    :class="['pc-resbalar text-white', { 'heartbeat-2': patient['resbalar_riesgo_value'] === 1 }, { 'heartbeat ': patient['resbalar_riesgo_value'] === 2 }]"></i>
                <!-- Riesgo Caida: -->
            </span>
            {{ patient['resbalar_riesgo_description'] }}
        </div>
        <div v-if="patient !== undefined && ![null, 'null'].includes(patient['cirugia_riesgo_description'])"
            class="d-flex text-left align-items-center">
            <span
                :class="['badge mr-1 mb-1', { 'badge-success': patient['cirugia_riesgo_value'] === 3 }, { 'badge-warning': patient['cirugia_riesgo_value'] === 2 }, { 'badge-danger': patient['cirugia_riesgo_value'] === 1 },]">
                <i
                    :class="['pc-cirugia text-white', { 'heartbeat-2': patient['cirugia_riesgo_value'] === 3 }, { 'heartbeat': patient['cirugia_riesgo_value'] === 2 }]"></i>
                <!-- Riesgo Cirugía: -->
            </span>
            {{ patient['cirugia_riesgo_description'] }}
        </div>
    </td>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name:"Column6",
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
                this.patient = this.pacientes_activos.find(x=>x.cat_user_ubicacion_id === this.ubication.id)
            }
        },
        methods: {
         
        },
        
    }
</script>

<style lang="scss" scoped>

</style>