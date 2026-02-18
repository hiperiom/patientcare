<template>
    <button data-toggle="collapse" :href="'#collapse' + index" role="button" aria-expanded="false"
        aria-controls="collapseExample" class="d-xl-none btn btn-default btn-sm collapsed">
        <i class="pc-signos_vitales1 h3 text-danger"></i>
    </button>
</template>

<script>
export default {
    name: "BtnSignosVitales",
    props: {
        patient_data: Object,
        index: Number,
    },
}
</script>

<style lang="scss" scoped></style>
