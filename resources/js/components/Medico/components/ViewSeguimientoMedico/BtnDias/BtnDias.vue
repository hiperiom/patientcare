<template>
    <div class="col-xl-6  mr-1 mr-xl-0  my-xl-1 order-2 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded">
        <b class="small-title text-primary">Días</b>
        <div class="text-secondary mt-auto">
            {{patient_data.dias}}
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            patient_data:Object,
            index:Number,
        },
    }
</script>

<style lang="scss" scoped>
    .small-title {
        font-size: 0.7rem !important;
    }
</style>
