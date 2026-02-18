<template>
    <button
        :content="getTolltipContent()"
        v-tippy="{ arrow : true, allowHTML:true, theme : 'tooltip-'+prealtaColor }"
        v-if="isActive" @click="handle_button()"
        :class="[getButtonVisible(), { 'heartbeat_infinity': ['danger', 'warning'].includes(prealtaColor) }, 'col-xl d-flex flex-column flex-sm-row order-4 btn p-1 justify-content-center align-items-center text-uppercase rounded']"
    >
        <div class="px-1 border-sm-right pr-1" style="font-size: 0.7rem;">
            <i class="fas fa-stopwatch d-none d-sm-block"></i> {{ title }}
        </div>
        <div class="d-flex flex-column justify-content-center">
            <div style="font-size: 2rem;font-weight:bold;line-height: 0.8;">
                {{ preAltaDay }}
            </div>
            <div style="font-size: 0.8rem;">
                {{ prealtaMonth }}
            </div>
        </div>
    </button>
    <button v-else @click="handle_button()"
        :class="[getButtonVisible(), { 'heartbeat_infinity': ['danger', 'warning'].includes(prealtaColor) }, 'col-xl d-flex order-4 btn p-1 flex-column justify-content-center align-items-center text-uppercase rounded']">
        <b class="small-title text-primary">{{ title }}</b>
        <i class="far fa-calendar text-gray  mt-auto"></i>
    </button>
</template>

<script>
    import { get, meses, post } from '../../../../../helpers/customHelpers';
    import ModalPrealta from './ModalPrealta.vue';


    export default {
        name:"BtnPrealta",
        props:{
            idModal:String,
            patient_data:Object,
            index:Number,
        },
        components: {
            ModalPrealta,
        },
        data() {
            return {
                title: "PREALTA",
                calendarOpen:false,
                preAltaDay:0,
                prealtaMonth:"No indicado",
                prealtaColor:"default",
            }
        },
        computed: {
            isActive() {
                return this.have_Prealta()
            }
        },
        methods:{
            getTolltipContent(){
                return  `
                            Prealta Activada
                        `
            },
            have_Prealta(){
                let fecha_prealta = this.patient_data.pre_alta
                    if (fecha_prealta !== null) {
                        this.calendarOpen = true
                        fecha_prealta = ( fecha_prealta.split(" ") )[0]
                        fecha_prealta = fecha_prealta.split("-");
                        this.preAltaDay = fecha_prealta[2]
                        this.prealtaMonth = meses( Number(fecha_prealta[1])-1 ).slice(0,3)
                        this.getColorPrealta()
                        return true
                    }else{
                        this.calendarOpen = false
                        return false
                    }
            },
            getColorPrealta(){
                // Define una fecha dada
                let fecha_prealta = this.patient_data.pre_alta
                let fechaDada = new Date( fecha_prealta ); // Cambia la fecha según tus necesidades

                // Obtén la fecha actual
                let fechaActual = new Date();

                // Calcula la diferencia en milisegundos
                let diferenciaMilisegundos = fechaDada - fechaActual;

                // Convierte la diferencia de milisegundos a días
                let diferenciaDias = diferenciaMilisegundos / (1000 * 60 * 60 * 24);

                // Redondea la diferencia a un número entero (puedes ajustar el redondeo según tus necesidades)
                let diasPorDelante = Math.ceil(diferenciaDias);
                    if(diasPorDelante <= 0){
                        this.prealtaColor = "danger"
                    }
                    if(diasPorDelante === 1){
                        this.prealtaColor = "warning"
                    }
                    if(diasPorDelante >= 2){
                        this.prealtaColor = "success"
                    }

            },
            getButtonVisible(){
                return this.calendarOpen ? 'btn-'+this.prealtaColor : "btn-outline-gray"
            },

            async handle_button(){


                this.$store.commit('updateDinamicComponent', {
                    is_dismounted:false,
                    customComponent: this.$options.components.ModalPrealta,
                    patient_data: this.patient_data,
                    index: this.index
                });
                $("#modalPrealta").modal("show")
            },
        },
        async mounted () {
            this.have_Prealta()
        },
    }
</script>

<style lang="scss" scoped>
    .small-title {
        font-size: 0.7rem !important;
    }
</style>
