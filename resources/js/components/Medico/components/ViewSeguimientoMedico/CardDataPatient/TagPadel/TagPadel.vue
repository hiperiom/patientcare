<template>
    <div :id="'badge_padel_' + patient_data['user_id']"
        :class="[getVisibility(), 'mt-1 mr-1 badge font-italic badge-orange text-white']" style=" font-size: 0.8rem;">
        <i class="pc-padel"></i> Padel Fest 2024
    </div>
</template>

<script>
export default {
    name: "TagPadel",
    props:{
        patient_data:Object,
        index:Number,
    },
    methods: {
        getVisibility() {
            return [429].includes(Number(this.patient_data['cat_user_ubicacion_id'])) ? '' : 'd-none'
        },
    },
}
</script>

<style lang="scss" scoped></style>
