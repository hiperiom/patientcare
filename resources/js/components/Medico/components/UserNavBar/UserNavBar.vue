<template>
    <nav class="d-flex justify-content-between bg-primary rounded-pill m-1">

        <BtnGoHome />
        <!-- otros items -->


        <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
    </nav>
</template>

<script>
import BtnGoHome from './BtnGoHome.vue';

    export default {
        components: {
            BtnGoHome,
        },
    }
</script>

<style lang="scss" scoped>

</style>
