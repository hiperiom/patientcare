<template>

    <nav class="d-flex justify-content-between bg-primary rounded-pill m-1 ">
        <div class="btn-user-home d-flex align-items-center">
            <button onclick="location.href='/auth/menu_inicial_principal'" class="btn_home_sidebar rounded-pill">
                <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i class="fas fa-bars text-white"></i></span>
                <div class="d-flex align-items-center ">
                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-user-size" :src="$store.state.userData.userImage">
                    <span class="ml-1 mr-3 align-items-start justify-content-center d-flex flex-column overflow-hidden" style="line-height: 1.1;">
                        <i class="message-wellcome">{{$store.state.messageWellcome}}</i>
                        <div class="username text-left">{{getFullName}}</div>
                    </span>
                </div>

            </button>
            <!-- otros items -->

        </div>
        <img class="img-logo m-1 d-block" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
    </nav>
</template>

<script>
    import { get, is_empty, is_null,is_undefined } from '../../../helpers/customHelpers';
    export default {
        name:"Navbar1",
        computed:{
            getFullName(){
                let item = this.$store.state.userData
                let temp1 = is_null( item.nombres) ? [''] : item.nombres.split(" ")
                let temp2 = is_null( item.apellidos) ? [''] : item.apellidos.split(" ")
                    return `${temp1[0]} ${temp2[0]}`
            },
        },
        methods:{



        },
    }
</script>

<style lang="scss" scoped>
    .btn-user-home .username {
        font-weight: bold;
        font-size: 1.5rem;
        text-wrap: nowrap;
        overflow: hidden;
        width: 117px;
        /* border: 1px solid red; */
    }
    .img-user-size {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .btn-user-home button {
        background-color: transparent;
        display: flex;
        color: white;
        align-items: center;
        border: 0px;
    }
    .btn_home_sidebar:hover {
        background-color: #0e52a1;
    }
</style>
