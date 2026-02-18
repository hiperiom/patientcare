<template>
    <div class="d-flex flex-column">
        <div class="order-1 d-flex justify-content-end">
            <RiesgoHeridaDropdown :patient_data="patient_data" :index="index" />
            <RiesgoResbalarDropdown :patient_data="patient_data" :index="index" />
            <RiesgoAlertaDropdown :patient_data="patient_data" :index="index" />
            <RiesgoVipDropdown :patient_data="patient_data" :index="index" />
        </div>
        <div class="order-2 w-100  d-flex align-items-center">
            <img :src="patient_data.imagen" onerror="this.src='/image/system/icono-paciente-blanco.svg'" loading="lazy"
                class="align-self-start ml-1 mt-1 img-user-circle" alt="Imagen No Encontrada">
            <div class="text-user-name text-primary text-uppercase pl-1">
                {{ patient_data.paciente }}
            </div>
        </div>
        <div class="order-3 d-flex flex-column">

            <div class="tag-box px-1 d-flex  align-items-center flex-wrap pb-1 text-uppercase">
                <div class="mt-1 badge d-flex align-items-center badge-primary mr-1"
                    style="font-size: 0.6rem; padding: 0.1rem;">
                    <i class="mx-1 fas fa-id-card"></i> <span
                        style="font-size: 0.9rem; font-weight: 500;">
                        {{ patient_data.nacionalidad + patient_data.cedula }}
                    </span>
                </div>
                <div class="mt-1 badge d-flex align-items-center badge-warning mr-1"
                    style="font-size: 0.6rem; padding: 0.1rem;">
                    <i class="mx-1 fas fa-birthday-cake"></i>
                    <span style="font-size: 0.9rem; font-weight: 500;">{{ patient_data.edad }} A</span>
                </div>
                <div :class="['mt-1 badge d-flex align-items-center mr-1 text-uppercase', (patient_data.genero === 'f' ? 'badge-pink' : 'badge-primary')]"
                    style="font-size: 0.6rem; padding: 0.1rem;">
                    <i class="mx-1 fas fa-venus-mars"></i>
                    <span style="font-size: 0.9rem; font-weight: 500;">{{ patient_data.genero }}</span>
                </div>
                <TagWalkin :patient_data="patient_data" :index="index" />
                <TagPadel :patient_data="patient_data" :index="index" />



            </div>
        </div>

    </div>
</template>

<script>
import RiesgoHeridaDropdown from './RiesgoHeridaDropdown/RiesgoHeridaDropdown.vue';
import RiesgoResbalarDropdown from './RiesgoResbalarDropdown/RiesgoResbalarDropdown.vue';
import RiesgoAlertaDropdown from './RiesgoAlertaDropdown/RiesgoAlertaDropdown.vue';
import RiesgoVipDropdown from './RiesgoVipDropdown/RiesgoVipDropdown.vue';
import TagWalkin from './TagWalkin/TagWalkin.vue';
import TagPadel from './TagPadel/TagPadel.vue';

export default {
    name: "CardDataPatient",
    components: {
        RiesgoHeridaDropdown,
        RiesgoResbalarDropdown,
        RiesgoAlertaDropdown,
        RiesgoVipDropdown,
        TagWalkin,
        TagPadel,
    },
    props:{
        patient_data:Object,
        index:Number,
    },
}
</script>

<style lang="scss" scoped>
    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 500;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .badge-pink {
        color: #ffffff;
        background-color: #f278b0;
    }
    .img-user-circle {
        width: 50px;
        height: 50px;
        border-radius: 50px;
    }
    .text-user-name {
        font-weight: 500;
        font-size: 1.2rem;
    }
    .width-custom {
        width: auto;
    }
    @media (min-width: 992px) {
        .width-custom {
            width: 350px;
        }
    }
</style>
