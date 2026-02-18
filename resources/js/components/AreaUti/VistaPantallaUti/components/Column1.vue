<template>
    <!-- HABITACIÓN -->
    <td :style="'font-size: 1.1rem;width:6% !important;line-height:1rem !important;height:'+height" class="tbl-row-radius-left bg-info-piso p-0">
        <div class="d-flex flex-column my-2" style="line-height:1rem !important;width:100%;">
            <b style="font-size: 1.8rem;">
                {{ ubication.cat_user_ubicacion_id === 391 ? index +1 : ubication.coments.replace("Cama.", "") }}
            </b>
            <div v-if="patient !== undefined && patient.pre_alta "
                :class="[
                    'text-uppercase p-1 mt-2 text-nowrap rounded mx-2 text-center', 
                    { 'd-none': patient['pre_alta'] === null }, 
                    getColorPrealta()
                ]"
                style="font-size: 0.8em;"
            >
                <i class="fas fa-stopwatch"></i> {{ getFechaPreAlta() }}
            </div>
         
        </div>
   
    </td>
</template>

<script>
    import {  is_null,  meses,} from '../../../../helpers/customHelpers.js';
    import { mapState } from 'vuex';

    export default {
        name:"Column1",
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
            getColorPrealta() {
                return 'bg-' + this.patient['pre_alta_color']
            },
            getFechaPreAlta() {
                let prealta = this.patient['pre_alta']
             
                if (prealta) {
                    let fecha = prealta.split(" ")
                    fecha = fecha[0].split("-")
                    
                    let f = new Date(fecha[0], (parseInt(fecha[1]) - 1), fecha[2]);
                    let fechaIngreso = f.getFullYear() + "-" + (f.getMonth()) + "-" + f.getDate();
                    fechaIngreso = f.getDate() + "-" + meses(f.getMonth()).slice(0, 3);
                    return fechaIngreso

                } else {
                    return ""
                }

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