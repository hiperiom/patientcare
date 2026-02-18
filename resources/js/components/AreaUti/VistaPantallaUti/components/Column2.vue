<template>
    <!-- PACIENTE -->
    <td :style="'width:8% !important;height:'+height" class="glassmod-effect text-left p-0 pl-1 pb-2">
        <div v-if="patient" class="d-flex align-items-center" style="height: 100%;">

            <div class="d-flex flex-column" style="font-size: 1.8rem;">
                <div class="text-nowrap text-left overflow-hidden mb-1"
                    style="width:auto !important;text-transform: capitalize !important; ">
                    {{ formatearNombrePaciente2() }}
                </div>
                <div class="d-flex  align-items-center">

                    <div :class="['badge d-flex align-items-center px-2 mr-2 text-uppercase',
                        { 'badge-info': patient['genero'] === 'm' }, , { 'badge-pink': patient['genero'] === 'f' }]"
                        style="font-size:0.6rem;padding:0.1rem;">
                        <i class="fas fa-venus-mars mr-2"></i> <span style="font-size:0.9rem;font-weight:500">{{
                            patient['genero'] }}</span>
                    </div>

                    <div class="badge d-flex align-items-center px-2 badge-warning mr-2"
                        style="font-size:0.6rem;padding:0.1rem;">
                        <i class="fas fa-birthday-cake mr-2"></i> <span style="font-size:0.9rem;font-weight:500">{{
                            patient['edad']
                            }} A</span>
                    </div>

                    <div v-if="patient['user_vip_value'] === 1" class="mr-2"
                        style="font-size:1rem;padding:0.1rem;font-weight:400">
                        <i :class="['pc-paciente_vip text-info']"></i>
                    </div>
                </div>
            </div>
        </div>

    </td>

</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name:"Column2",
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
        methods: {
            formatearNombrePaciente2() {
                let temp_nombres = ""
                if (this.patient['nombres']) {
                    temp_nombres = ((this.patient['nombres'].split(" "))[0]).toLowerCase()
                }

                let temp_apellidos = ""
                if (this.patient['apellidos']) {
                    temp_apellidos = ((this.patient['apellidos'].split(" "))[0]).toLowerCase()
                    if (temp_apellidos.length <= 3) {
                        if (this.patient['apellidos'].split(" ")[1] !== undefined) {
                            temp_apellidos = (this.patient['apellidos'].split(" ")[0] + " " + this.patient['apellidos'].split(" ")[1]).toLowerCase()
                        }

                    }
                }
                let temp_prefijo = ""
                if (![undefined, null, 'null', 'undefined'].includes(this.patient['prefijo'])) {
                    temp_prefijo = (this.patient['prefijo'] + ' ').toLowerCase()
                }

                return `${temp_prefijo}${temp_apellidos}, ${temp_nombres.slice(0, 1)}.`
            },
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