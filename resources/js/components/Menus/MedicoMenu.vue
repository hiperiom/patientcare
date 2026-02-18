<template>
    <aside ref="sidebar-left" style="" :class="['menu-home rounded-pill-custom-1 col-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 shadow-box d-none flex-column ',{'d-flex show':showMenuLeft}]">
        <div class="car-userData d-flex mt-1 text-secondary d-sm-none align-items-center">
            <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" class="img-user-size" :src="$store.state.userData.userImage">
            <span class="ml-1 align-items-start d-flex flex-column" style="line-height: 1.1;">
                <i class="message-wellcome">{{$store.state.messageWellcome}}</i>
                <div class="username">{{getFullName()}}</div>
            </span>
        </div>
        <div class="text-nowrap mx-1 text-center font-weight-bold h4 mb-0 p-2">
            <i class="pc-fa-patientcare-logo text-primary"></i>
        </div>
        <nav class="nav flex-column nav-pills m-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
           <a @click="goToMenu" class="nav-link text-nowrap" href="#" data-toggle="pill">Regresar</a>
           <a @click="closeSesion" class="nav-link text-nowrap" href="#" data-toggle="pill">Salir</a>
        </nav>
    </aside>


</template>
<script scoped>
    import { get, is_empty, is_null,is_undefined } from '../../helpers/customHelpers.js';
    export default{
        name:"MenuPatientcare",
        computed: {
            showMenuLeft(){
                return this.$store.state.sidebarLeft
            },
        },
        methods: {
            goToMenu:()=>{
                location.href="/auth/menu_inicial_principal"
            },
            goToAreaMedico:()=>{
                location.href="/medico"
            },
            goToEquipoMedico:()=>{
                location.href="/medico/index_medicos"
            },
            closeSesion:()=>{
                location.href="/finalizarSesion"
            },
            /* getLocalStorageSidebar(){
                if ( localStorage.getItem('sidebarLeft') === null ){
                    localStorage.setItem('sidebarLeft',false)
                }else{
                    this.$store.state.sidebarLeft = JSON.parse(localStorage.getItem('sidebarLeft'))
                }

                if ( localStorage.getItem('sidebarRight') === null ){
                    localStorage.setItem('sidebarRight',false)
                }else{
                    this.$store.state.sidebarRight = JSON.parse(localStorage.getItem('sidebarRight'))
                }
            }, */
            getFullName(){
                let item = this.$store.state.userData
                let temp1 = is_null( item.nombres) ? [''] : item.nombres.split(" ")
                let temp2 = is_null( item.apellidos) ? [''] : item.apellidos.split(" ")
                    return `${temp1[0]} ${temp2[0]}`
            },
        },
        async mounted(){
            //ACTIVAR menus laterales
            //this.getLocalStorageSidebar();



        }

    }
</script>
<style scoped>
    .menu-home{
        position:absolute;
        background-color: var(--white);
        height: calc(100% - 7.8%);
        bottom: 0px;
        z-index: 11;

    }
    .car-userData{
        background-color: whitesmoke;
        border-radius: 10px;
        padding: 0.2rem;
    }
    .username{
        font-weight: bold;
        font-size: 1rem;
        text-wrap: nowrap;
        overflow:hidden;
        width: 117px;
        /*border: 1px solid red;*/
    }
    .img-user-size{
        width:40px;
        height:40px;
        border-radius:50%;
    }
    #v-pills-tab a.nav-link:hover {
        background-color: var(--primary) ;
        color: var(--white);
        text-decoration: none;
        transition: all 0.30s ease;
    }
    .scale-out-hor-left {
        -webkit-animation: scale-out-hor-left 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        animation: scale-out-hor-left 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
    }
    @-webkit-keyframes scale-out-hor-left {
        0% {
          -webkit-transform: scaleX(1);
                  transform: scaleX(1);
          -webkit-transform-origin: 0 0;
                  transform-origin: 0 0;
          opacity: 1;
        }
        100% {
          -webkit-transform: scaleX(0);
                  transform: scaleX(0);
          -webkit-transform-origin: 0 0;
                  transform-origin: 0 0;
          opacity: 1;
        }
    }
    @keyframes scale-out-hor-left {
    0% {
        -webkit-transform: scaleX(1);
                transform: scaleX(1);
        -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
        opacity: 1;
    }
    100% {
        -webkit-transform: scaleX(0);
                transform: scaleX(0);
        -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
        opacity: 1;
    }
    }
    .scale-in-hor-left {
        -webkit-animation: scale-in-hor-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: scale-in-hor-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }
    @-webkit-keyframes scale-in-hor-left {
        0% {
          -webkit-transform: scaleX(0);
                  transform: scaleX(0);
          -webkit-transform-origin: 0% 0%;
                  transform-origin: 0% 0%;
          opacity: 1;
        }
        100% {
          -webkit-transform: scaleX(1);
                  transform: scaleX(1);
          -webkit-transform-origin: 0% 0%;
                  transform-origin: 0% 0%;
          opacity: 1;
        }
    }
    @keyframes scale-in-hor-left {
    0% {
        -webkit-transform: scaleX(0);
                transform: scaleX(0);
        -webkit-transform-origin: 0% 0%;
                transform-origin: 0% 0%;
        opacity: 1;
    }
    100% {
        -webkit-transform: scaleX(1);
                transform: scaleX(1);
        -webkit-transform-origin: 0% 0%;
                transform-origin: 0% 0%;
        opacity: 1;
    }
    }
    .sidebar-right,
    .sidebar-left {
        width:auto;
        visibility: hidden;
        opacity:0;
        transition: width 0.5s,opacity 0.5s;
        border-radius:1rem;

    }
    .sidebar-right.show,
    .sidebar-left.show {
        visibility: visible;
        transition: width 0.5s,opacity 0.5s;
        width:auto;
        opacity:1;
        padding: 0.5rem;

    }
</style>
