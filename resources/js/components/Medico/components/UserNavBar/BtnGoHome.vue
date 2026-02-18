<template>
    <div class="btn-user-home d-flex align-items-center">
        <button
            @click="goToHome()"
            class="btn_home_sidebar rounded-pill"
        >
            <span
                class="principal-menu-toggle btn"
                id="menu-toggle-left"
            >
                    <i class="fas fa-bars text-white"></i>
            </span>
            <div class="d-flex align-items-center">
                <img
                    onerror="this.src='/image/system/icono-paciente-blanco.svg'"
                    class="img-user-size"
                    :src="$store.state.userData.imagen"
                >
                <span class="ml-1 mr-3 align-items-start justify-content-center d-flex flex-column overflow-hidden" style="line-height: 1.1;">
                    <i class="message-wellcome">
                        {{ $store.state.messageWellcome }}
                    </i>
                    <div class="username text-left">
                        {{ prefijo() }} {{ $store.state.userData.username }}
                    </div>
                </span>
            </div>

        </button>
    </div>
</template>

<script>
    export default {
        name:"BtnGoHome",
        methods: {
            goToHome() {
                location.href='/auth/menu_inicial_principal'
            },
            prefijo(){
                return [null,'null',undefined,'undefined'].includes(this.$store.state.userData.prefijo) ? '' : this.$store.state.userData.prefijo
            }
        },
    }
</script>

<style lang="scss" scoped>
    .btn-user-home button {
        background-color: transparent;
        display: flex;
        color: white;
        align-items: center;
        border: 0px;
    }
    .img-user-size {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .btn-user-home .username {
        font-weight: bold;
        font-size: 1rem;
        text-wrap: nowrap;
        overflow: hidden;
        width: 117px;
        /* border: 1px solid red; */
    }
    @media (min-width: 576px) {
        .btn-user-home .username {
            font-weight: bold;
            font-size: 1.5rem;
            text-wrap: nowrap;
            overflow: hidden;
            width: auto;
            /* border: 1px solid red; */
        }
    }
</style>
