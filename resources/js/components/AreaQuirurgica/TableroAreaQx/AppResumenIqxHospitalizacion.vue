<template>
    <div class="flex-fill glassmod-effect rounded-custom-1 d-flex flex-column">
        <div style="line-height: 1;" class="flex-fill d-flex flex-column align-items-center  justify-content-center ">
            <div class="text-center font-weight-bold h4 pl-3 mb-2 text-uppercase">
                Resumen<br>Torre Hospitalización
            </div>
            <div class="mb-2 mt-1 text-center">
                CUMPLIMIENTO DE IQX<br>PROGRAMADAS VS EJECUTADAS<br>
                <small>{{ periodo_fecha_actual }}</small>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-hospital mb-0 mr-2" style="font-size: 2rem;"></i>
                    <div class="px-2" style="font-size:5rem;">{{ total_programadas_variacion_actual }}%</div>
                </div>
                <!-- <div class=" flex-fill ml-1 d-flex flex-column">
                    <div class="text-center" style="font-size:0.8rem;">
                        PROGRAMADAS
                    </div>
                    <div class="d-flex justify-content-center align-items-center">

                        <div style="font-size:2rem;">{{ total_programadas_actual }}</div>
                    </div>
                    <div class="text-center" style="font-size:0.8rem;">
                        EJECUTADAS
                    </div>
                    <div class="d-flex justify-content-center align-items-center">

                        <div style="font-size:2rem;">{{ total_ejecutadas_actual }}</div>
                    </div>
                </div> -->
            </div>
            <div v-if="!Number.isNaN(diferencia_total_resumen) && periodo_fecha_anterior > 0" class="d-flex h1">
                <hr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                <div

                    :class="[{ 'colorPositive': diferencia_total_resumen > 0 }, { 'colorNegative': diferencia_total_resumen < 0 }, { 'd-none': diferencia_total_resumen === 0 }]">
                    <span v-if="diferencia_total_resumen > 0">+ {{ diferencia_total_resumen }}%</span>
                    <span v-else>{{ diferencia_total_resumen }}%</span>
                </div>
                <hr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
            </div>
            <div class="mb-2 mt-3 text-center">
                PERÍODO ANTERIOR<br>
                <small>{{ periodo_fecha_anterior }}</small>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-hospital mb-0 mr-2" style="font-size: 2rem;"></i>
                    <div class="px-2" style="font-size:5rem;">{{ total_programadas_variacion_anterior }}%</div>
                    <!--   <i style="font-size:3rem;" class="fas text-danger fa-long-arrow-alt-down"></i> -->
                </div>
                <div class=" flex-fill ml-1 d-flex flex-column">
                    <div class="text-center" style="font-size:0.8rem;">
                        PROGRAMADAS
                    </div>
                    <div class="d-flex justify-content-center align-items-center">

                        <div style="font-size:2rem;">{{ total_programadas_anterior }}</div>
                    </div>
                    <div class="text-center" style="font-size:0.8rem;">
                        EJECUTADAS
                    </div>
                    <div class="d-flex justify-content-center align-items-center">

                        <div style="font-size:2rem;">{{ total_ejecutadas_anterior }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppResumenIqxHospitalizacion",
    props: {


        periodo_fecha_actual: {
            type: Number,

        },
        total_programadas_variacion_actual: {
            type: Number,

        },
        total_programadas_actual: {
            type: Number,

        },
        total_ejecutadas_actual: {
            type: Number,

        },
        total_programadas_variacion_anterior: {
            type: Number,

        },
        total_programadas_anterior: {
            type: Number,

        },
        total_ejecutadas_anterior: {
            type: Number,

        },
        periodo_fecha_anterior: {
            type: Number,

        },
    },
    computed: {
        diferencia_total_resumen(){
            return Number(this.total_programadas_variacion_actual) - Number(this.total_programadas_variacion_anterior )
        },
    },
}
</script>

<style lang="scss" scoped>
.rounded-custom-1 {
    border-radius: 15px;
}
        .colorNegative{
            color: #ff0018 !important;
        }
        .colorPositive{
            color: #00ff3a !important;
        }
</style>
