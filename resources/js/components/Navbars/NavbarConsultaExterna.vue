<template>
    <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1">
        <!-- <div class="btn-user-home d-flex align-items-center">
            <button ref="btn_home_sidebar" @click="btn_sidebarLeft">
                <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i class="fas fa-bars text-white"></i></span>
                <div class="d-none d-sm-flex">
                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-user-size" :src="$store.state.userData.userImage">
                    <span class="ml-1 align-items-start d-flex flex-column" style="line-height: 1.1;">
                        <i class="message-wellcome">{{$store.state.messageWellcome}}</i>
                        <div class="username">{{getFullName}}</div>
                    </span>
                </div>
                
            </button>
           
            <span  class="principal-menu-toggle btn" id="menu-toggle-right"></span>
        </div> -->
        <ul class="nav nav-pills">
            <li class="nav-item btn-user-home">
                <a href="#" class="btn_home_sidebar" ref="btn_home_sidebar" @click="btn_sidebarLeft">
                    <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i class="fas fa-bars text-white"></i></span>
                    <!-- <div class="d-none d-sm-flex">
                        <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-user-size" :src="$store.state.userData.userImage">
                        <span class="ml-1 align-items-start d-flex flex-column" style="line-height: 1.1;">
                            <i class="message-wellcome">{{$store.state.messageWellcome}}</i>
                            <div class="username">{{getFullName}}</div>
                        </span>
                    </div> -->
                    
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link to="/consultaexterna/app/citalistado/porconfirmar" :class="['nav-link rounded-pill inicio',isPageInicioActive()]" data-toggle="pill" role="tab" aria-controls="pills-1" aria-selected="true">
                    <i class="pc-home inicio"></i>
                    <span class="inicio">Inicio</span>
                </router-link>
                
            </li>
            <li class="nav-item d-none d-sm-inline-block ">
                <router-link to="/consultaexterna/app/pacientecreate" class="nav-link rounded-pill paciente-create" data-toggle="pill" role="tab" aria-controls="pills-1" aria-selected="true">
                    <i class="pc-paciente paciente-create"></i>
                    <span class="paciente-create">Paciente</span>
                </router-link>
                
            </li>
            <li class="nav-item d-none d-sm-inline-block paciente_create_cita">
                <router-link to="/consultaexterna/app/citacreate" class="nav-link rounded-pill paciente_create_cita" data-toggle="pill" role="tab" aria-controls="pills-1" aria-selected="true">
                    <i class="pc-cita_por_confirmar paciente_create_cita"></i>
                    <span class="paciente_create_cita">Cita</span>
                </router-link>
               
            </li>
            <li class="nav-item paciente_search">
                <router-link to="/consultaexterna/app/pacientebuscar" class="nav-link rounded-pill paciente_search" data-toggle="pill" role="tab" aria-controls="pills-1" aria-selected="true">
                    <span class="pc-buscar paciente_search"></span>
                    <span class="paciente_search">Buscar</span>
                </router-link>
            </li>
            
        </ul>
        <img class="img-logo m-1 d-block" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
    </nav>
</template>

<script>
    import { get, is_empty, is_null,is_undefined } from '../../helpers/customHelpers.js';
    export default {
        name:"NavbarConsultaExterna",
        computed:{
            getFullName(){
                let item = this.$store.state.userData
                let temp1 = is_null( item.nombres) ? [''] : item.nombres.split(" ") 
                let temp2 = is_null( item.apellidos) ? [''] : item.apellidos.split(" ") 
                    return `${temp1[0]} ${temp2[0]}`
            },
        },
        methods:{
            isPageInicioActive(){
                if([
                    'Citas por confirmar',
                    'Citas por confirmar',
                    'Citas en preconsulta',
                    'Citas en consulta',   
                ].includes(this.$route.name)){
                    return 'router-link-exact-active'
                }
            },
            btn_sidebarLeft(){
                if (localStorage.getItem('sidebarLeft') ==="true") {
                    localStorage.setItem('sidebarLeft',"false")
                } else {
                    localStorage.setItem('sidebarLeft',"true")
                }
                this.$store.commit('updateProperty', {
                    fieldName:'sidebarLeft',
                    fieldValue: JSON.parse(localStorage.getItem('sidebarLeft')) ,
                });
                
            },
            
        },
    }
</script>

<style lang="scss" scoped>
a.btn_home_sidebar{
    background-color: transparent !important;
}
a.btn_home_sidebar:hover i{
    color: rgb(196, 196, 189) !important;
}
.nav-pills .nav-link {
    color: #ffffff;
}
.router-link-exact-active,
.nav-pills .nav-link.active, 
.nav-pills .show>.nav-link {
    color: var(--primary) !important;
    background-color: var(--white) !important;
}
.img-logo {
    height: 50px;
    width: 120px;
}
.img-user-size{
    width:40px;
    height:40px;
    border-radius:50%;
}
.btn-user-home button {
   background-color: transparent;
   display: flex;
   color: white;
   align-items: center;
   border: 0px;
}
.btn-user-home button:focus {
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