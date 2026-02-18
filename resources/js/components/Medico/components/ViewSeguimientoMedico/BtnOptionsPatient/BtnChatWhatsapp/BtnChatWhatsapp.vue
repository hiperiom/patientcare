<template>
    <div class="flex-fill px-1">
                    <div
                        class="heartbeat"
                        style="position: relative;cursor:pointer;"
                        data-tippy-content="Pendientes"
                        @click="handle_chat_whatsapp"
                    >
                        <img style="height: 35px;width: 35px;" src="/image/system/ws.png">
                    </div>
                </div>
</template>

<script>
export default {
    name: "BtnChatWhatsapp",
    props: {
        patient_data: Object,
        index: Number,
    },
    methods: {
                handle_chat_whatsapp() {
                    UserCuestChat.index('.modal-body',this.patient_data.user_id)
                }
            },
}
</script>

<style lang="scss" scoped></style>
