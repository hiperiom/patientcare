<template>
    <nav class="d-flex justify-content-between p-1 bg-primary rounded-pill">
        <div class="d-flex align-items-center">
            <button ref="btn_home_sidebar" @click="btn_sidebarLeft" class="btn-user-home d-flex text-white align-items-center bg-transparent border-0">
                <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i class="fas fa-bars text-white"></i></span>
                <img class="img-user-size" :src="$store.state.userData.userImage">
                <span class="ml-1 align-items-start d-flex flex-column" style="line-height: 1.1;">
                    <i class="message-wellcome">{{$store.state.messageWellcome}}</i>
                    <div class="username">{{getFullName}}</div>
                </span>
            </button>
            <!-- otros items -->
            <span  class="principal-menu-toggle btn" id="menu-toggle-right"></span>
        </div>
        <img class="img-logo d-block" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
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
            
            btn_sidebarLeft(){
                if (localStorage.getItem('sidebarLeft') ==="true") {
                    localStorage.setItem('sidebarLeft',"false")
                } else {
                    localStorage.setItem('sidebarLeft',"true")
                }
                this.$store.state.sidebarLeft = JSON.parse(localStorage.getItem('sidebarLeft'))
            },
            
        },
    }
</script>

<style lang="scss" scoped>
.img-user-size{
    width:40px;
    height:40px;
    border-radius:50%;
}
button.btn-user-home:focus {
    outline: 1px dotted;
    outline: 0px !important;
}
.btn-user-home .username{
    font-weight: bold;
    font-size: 1rem;
    text-wrap: nowrap;
    overflow:hidden;
    width: 117px;
    /*border: 1px solid red;*/
}
@media (min-width: 576px) {
    .btn-user-home .username{
        font-weight:bold;
        font-size:1.5rem;
        text-wrap: nowrap;
        overflow:hidden;
        width: auto;
        /*border: 1px solid red;*/
    }
    
}
</style>