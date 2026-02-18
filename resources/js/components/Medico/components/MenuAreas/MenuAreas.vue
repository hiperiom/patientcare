<template>
    <nav class="row bg-light rounded  border-0 mx-1 mb-0">
        <ListAreaOptions/>
        <BtnNewPatient />
    </nav>
</template>

<script>
    import ListAreaOptions from './ListAreaOptions.vue';
    import BtnNewPatient from './BtnNewPatient.vue';

    export default {
        name:"MenuAreas",
        components: {
            ListAreaOptions,
            BtnNewPatient,
        },
    }
</script>

<style lang="scss" scoped>

</style>
