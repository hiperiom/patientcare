<template>

        <aside ref="sidebar-left" :class="{'bg-white shadow-sm rounded-1 mb-1 sidebar-left shadow-box col col-sm-3 col-md-2 d-none flex-column ':true, 'd-flex show':showMenuLeft}">
            <div class="text-nowrap mx-1 text-center font-weight-bold h4 mb-0 p-2">
                <i class="pc-fa-patientcare-logo text-primary"></i>
            </div>

            <!-- index -->
            <nav class="nav flex-column nav-pills m-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <router-link :class="{'nav-link':true, 'active':this.$route.path=='/areaQuirofano/enfermeria/index_enfermeria'}" data-toggle="pill" to="/areaQuirofano/enfermeria/index_enfermeria">Plan Programado</router-link>
                <router-link :class="{'nav-link':true, 'active':this.$route.path=='/areaQuirofano/enfermeria/index_finalizadas'}" data-toggle="pill" to="/areaQuirofano/enfermeria/index_finalizadas">Plan Ejecutado</router-link>
                <a  @click="closeSesion" class="d-none nav-link" data-toggle="pill">Salir</a>
                <a  @click="goToAreaMedico" class="nav-link" href="#" data-toggle="pill" >Regresar</a>
                <a  @click="goToExit" class="nav-link" href="#" data-toggle="pill" >Salir</a>

            </nav>

        </aside>


</template>
<script scoped>
export default{
    name:"MenuPatientcare",
    data(){
        return{
            backButtonActive:false,
            currentPathname:'/user/admin/index',
            indexActive:false,
        }
    },
    watch: {
        '$route'(to, from) {


            if(to.path !== '/user/admin/index'){
                this.backButtonActive=true
            }else{
                this.backButtonActive=false
            }
        }
    },
    computed: {

        routeIsIndex(){
            this.indexActive = location.pathname ==='/user/admin/index'
        },
        hideBtnBack(){
            return this.backButtonActive
        },
        showMenuLeft(){
            return Boolean(this.$store.state.sidebarLeft)
        },
    },
    methods: {
        is_pathname(pathname){
            //console.log("1 ",this.currentPathname, pathname,this.currentPathname=== pathname)
            return  this.currentPathname=== pathname ? true : false
        },
        openRoute(route){
            window.open(route,'_blank');
        },
        goToRoute:(route)=>{
            location.href=route
        },
        goToAreaMedico:()=>{
            location.href="/auth/menu_inicial_principal"
        },
        goToEquipoMedico:()=>{
            location.href="/medico/index_medicos"
        },
        closeSesion:()=>{
            location.href="/finalizarSesion"
        },
        getLocalStorageSidebar(){
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
        },
        goToExit:()=>{
            location.href="/finalizarSesion"
        },
    },
    async mounted(){
        //console.log(location)
        //ACTIVAR menus laterales
        this.getLocalStorageSidebar();
        //this.currentPathname = location.pathname
        //console.log("2 ",this.currentPathname)
        /* if(this.currentPathname !== '/user/admin/index'){
            this.backButtonActive=true
        }else{
            this.backButtonActive=false
        } */

    }

}

</script>
<style scoped>
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #ffffff;
    background-color: #5b96df !important;
}
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
