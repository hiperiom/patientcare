<template>
   <div class="flex-fill px-1">
                    <a
                        :id="'btn_evolucion_'+patient_data.user_id"
                        @click="handle_evolucion()"
                        data-tippy-content="Evoluciones"
                        class="h4 cursor-pointer"
                    >
                        <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/icono-new-evolucion.svg">
                    </a>
                </div>
</template>

<script>
    export default {
        name:"BtnEvolucion",
        props:{
                patient_data:Object,
                index:Number,
            },
    }
</script>

<style lang="scss" scoped>

</style>
