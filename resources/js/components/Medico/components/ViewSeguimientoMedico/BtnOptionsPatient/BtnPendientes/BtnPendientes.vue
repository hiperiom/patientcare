<template>
    <div class="flex-fill px-1">
        <div class="heartbeat d-flex" style="position: relative;cursor:pointer;" data-tippy-content="Pendientes"
            @click="handle_pendientes">
            <img style="height: 35px;width: 33px;" src="/image/system/todolist.svg">
            <span v-if="containTasks" data-tippy-content="Total Pendientes"
                class="badge rounded-circle badge-danger align-self-start" style="font-size: 0.6rem;">
                {{ patient_data.t_pendiente }}
            </span>



        </div>
    </div>
</template>

<script>
export default {
    name: "BtnPendientes",
    props: {
        patient_data: Object,
        index: Number,
    },
    computed: {
        containTasks() {
            return this.patient_data.t_pendiente > 0 ? true : false
        }
    },
    methods: {
        handle_pendientes() {
            UserCuestPendiente.index('.modal-body', this.patient_data.user_id)
        }
    },
}
</script>

<style lang="scss" scoped></style>
