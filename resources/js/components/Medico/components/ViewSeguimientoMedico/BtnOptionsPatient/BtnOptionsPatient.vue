<template>
    <div class="d-flex flex-nowrap align-items-center mb-2  text-center justify-content-around">
        <BtnSignosVitales :patient_data="patient_data" :index="index" />
        <BtnInfoPaciente :patient_data="patient_data" :index="index" />
        <BtnInfoAdministrativa :patient_data="patient_data" :index="index" />
        <BtnHistoria :patient_data="patient_data" :index="index" />
        <BtnEvolucion :patient_data="patient_data" :index="index" />
        <BtnPendientes :patient_data="patient_data" :index="index" />
        <BtnChatWhatsapp :patient_data="patient_data" :index="index" />

    </div>
</template>

<script>
import BtnSignosVitales from './BtnSignosVitales/BtnSignosVitales.vue';
import BtnInfoPaciente from './BtnInfoPaciente/BtnInfoPaciente.vue';
import BtnInfoAdministrativa from './BtnInfoAdministrativa/BtnInfoAdministrativa.vue';
import BtnHistoria from './BtnHistoria/BtnHistoria.vue';
import BtnEvolucion from './BtnEvolucion/BtnEvolucion.vue';
import BtnPendientes from './BtnPendientes/BtnPendientes.vue';
import BtnChatWhatsapp from './BtnChatWhatsapp/BtnChatWhatsapp.vue';

    export default {
        name:"BtnOptionsPatient",
        components: {
            BtnInfoPaciente,
            BtnInfoAdministrativa,
            BtnHistoria,
            BtnEvolucion,
            BtnPendientes,
            BtnChatWhatsapp,
            BtnSignosVitales,
        },
        props:{
            patient_data:Object,
            index:Number,
        },
    }
</script>

<style lang="scss" scoped>

</style>
