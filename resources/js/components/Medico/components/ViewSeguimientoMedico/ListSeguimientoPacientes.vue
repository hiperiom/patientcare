<template>
    <div id="AppRowVitalSign" class="d-flex flex-wrap  rounded border mx-1 overflow-auto">
        <div
            v-for="(item, index) in $store.state.pacientes_datos"
            :key="'row' + index"
            class="row-paciente col-12 mt-3 col-sm-12 col-md-6 col-lg-6 col-xl-12"
        >
            <div class="d-flex flex-column flex-xl-row  shadow-sm rounded bg-light ">
                <div class="col col-md col-xl-1 d-flex flex-xl-wrap p-1">
                    <BtnUbicacion :patient_data="item" :index="index" />
                    <BtnDias :patient_data="item" :index="index" />
                    <BtnPrealta :patient_data="item" :index="index" />
                    <BtnTrasladoAmbulancia :patient_data="item" :index="index" />
                </div>
                <div class="col px-1 d-flex flex-column ">
                    <div class="rounded d-flex flex-column flex-xl-row my-1" style="height: 100% !important;gap: 4px;">
                        <div class=" rounded width-custom d-flex flex-column justify-content-between border">
                            <CardDataPatient :patient_data="item" :index="index" />
                            <BtnOptionsPatient :patient_data="item" :index="index" />
                        <!--  <app-data-paciente :patient_data="item" :index="index"></app-data-paciente>
                            <app-btn-group2 :patient_data="item" :index="index"></app-btn-group2> -->

                        </div>
                        <div class="collapseVitalsign p-1 collapse col align-content-center" :id="'collapse' + index">
                            <!-- <app-form-vital-signs :patient_data="item" :index="index"></app-form-vital-signs> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BtnUbicacion from './BtnUbicacion/BtnUbicacion.vue';
import BtnDias from './BtnDias/BtnDias.vue';
import BtnPrealta from './BtnPrealta/BtnPrealta.vue';
import BtnTrasladoAmbulancia from './BtnTrasladoAmbulancia/BtnTrasladoAmbulancia.vue';
import CardDataPatient from './CardDataPatient/CardDataPatient.vue';
import BtnOptionsPatient from './BtnOptionsPatient/BtnOptionsPatient.vue';

export default {
    name: "ListSeguimientoPacientes",
    components: {
        BtnUbicacion,
        BtnDias,
        BtnPrealta,
        BtnTrasladoAmbulancia,
        CardDataPatient,
        BtnOptionsPatient,
    },
}
</script>

<style lang="scss" scoped>

    .btn-warning {
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-outline-gray {
        color: var(--secondary);
        border-color: var(--gray);
    }
    @media (min-width: 1200px) {
        .collapseVitalsign.collapse:not(.show) {
            display: block !important;
        }
    }
</style>
