<template>
    <nav class="row bg-light rounded border-0  mx-1 mb-1">
        <div class="col-12 row order-4 align-items-center">
            <div id="titleArea" class="mx-2 text-primary font-weight-bold text-nowrap">
                <button data-tippy-content="Pulse para ver el Equipo Médico en el área" type="button" class="btn btn-light btn-block text-uppercase">
                    <span id="areaName" style="font-weight:bold;color:var(--primary)!important">{{ $store.state.selectorAreaName }}</span>
                </button>
            </div>
            <div id="signosP" class="col marquee-with-options" style="height: 30px;">
                <marquee
                    class="cursor-pointer"
                    onmouseout="this.start()"
                    onmouseover="this.stop()" scrollamount="5"
                    style="width:100%"
                >asdasdasdas
                </marquee>
            </div>
        </div>

    </nav>
</template>

<script>
    export default {
        name:"NavbarNotifications",
    }
</script>

<style lang="scss" scoped>

</style>
