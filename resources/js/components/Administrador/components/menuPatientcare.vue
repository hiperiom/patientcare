<template>
    <aside ref="sidebar-left" :class="{'sidebar-left shadow-box col d-none flex-column ':true, 'd-flex show':showMenuLeft}">
        <div class="text-nowrap mx-1 text-center font-weight-bold h4 mb-0 p-2">
            <i class="pc-fa-patientcare-logo text-primary"></i>
        </div>

        <!-- index -->

        <nav class="nav flex-column nav-pills m-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <router-link v-if="hideBtnBack" class="btn btn-primary btn-block text-nowrap" to="/user/admin/index">
                Volver al inicio
            </router-link>
           <!--  <router-link class="nav-link text-nowrap" to="/user/admin/equipo_salud">
                Equipo de Salud 1
            </router-link> -->
            <a @click="goToRoute('/medico/index_medicos')" class="nav-link text-nowrap" href="#" data-toggle="pill">Equipo de Salud</a>

            <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseDashboard" role="button" aria-expanded="false" aria-controls="collapseExample">
                Dashboard
            </a>
            <div class="collapse" id="collapseDashboard">
                <div class="card card-body p-0">
                    <a @click="openRoute('/reportes/pad/resumen')" class="nav-link text-nowrap" href="#" data-toggle="pill">Pad</a>
                    <a @click="openRoute('/reportes/hospitalizacion/resumen')" class="nav-link text-nowrap" href="#" data-toggle="pill">Hospitalización</a>
                </div>
            </div>
            <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapsecuestionarios" role="button" aria-expanded="false" aria-controls="collapseExample">
                Cuestionarios
            </a>
            <div class="collapse" id="collapsecuestionarios">
                <div class="card card-body p-0">
                    <a @click="openRoute('/paciente/create')" class="nav-link text-nowrap" href="#" data-toggle="pill">Cuestionario Covid</a>

                </div>
            </div>
            <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseencuestas" role="button" aria-expanded="false" aria-controls="collapseExample">
                Encuestas
            </a>
            <div class="collapse" id="collapseencuestas">
                <div class="card card-body p-0">
                    <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseencuesta0" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Hospitalización
                    </a>
                    <div class="collapse" id="collapseencuesta0">
                        <div class="card card-body p-0">
                            <a @click="openRoute('/encuesta/hospitalizacion/nueva')" class="nav-link text-nowrap" href="#" data-toggle="pill">Crear nueva</a>
                            <a @click="openRoute('/encuesta/hospitalizacion/tablero')" class="nav-link text-nowrap" href="#" data-toggle="pill">Tablero</a>
                        </div>
                    </div>
                    <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseencuesta1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Emergencia
                    </a>
                    <div class="collapse" id="collapseencuesta1">
                        <div class="card card-body p-0">
                            <a @click="openRoute('/encuesta/emergencia/nueva')" class="nav-link text-nowrap" href="#" data-toggle="pill">Crear nueva</a>
                            <a @click="openRoute('/encuesta/emergencia/tablero')" class="nav-link text-nowrap" href="#" data-toggle="pill">Tablero</a>
                        </div>
                    </div>
                    <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseencuesta2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Consulta externa
                    </a>
                    <div class="collapse" id="collapseencuesta2">
                        <div class="card card-body p-0">
                            <a @click="openRoute('/encuesta/consultaexterna/nueva')" class="nav-link text-nowrap" href="#" data-toggle="pill">Crear nueva</a>
                            <a @click="openRoute('/encuesta/consultaexterna/tablero')" class="nav-link text-nowrap" href="#" data-toggle="pill">Tablero</a>
                        </div>
                    </div>

                </div>
            </div>
            <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseplanes" role="button" aria-expanded="false" aria-controls="collapseExample">
                Planes
            </a>
            <div class="collapse" id="collapseplanes">
                <div class="card card-body p-0">
                    <a class="pl-3 btn btn-default border-0 text-secondary text-left" data-toggle="collapse" href="#" data-target="#collapseplanes0" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Plan Qirúrgico especial para pacientes particulares
                    </a>
                    <div class="collapse" id="collapseplanes0">
                        <div class="card card-body p-0">
                            <a @click="openRoute('/plan/cirugia/create')" class="nav-link text-nowrap" href="#" data-toggle="pill">Crear nuevo</a>
                            <a @click="openRoute('/plan/cirugia/index')" class="nav-link text-nowrap" href="#" data-toggle="pill">Tablero</a>
                        </div>
                    </div>



                </div>
            </div>
            <div v-if="indexActive">


            </div>
            <div v-if="is_pathname('/user/admin/equipo_salud')">
                2

            </div>
           <a @click="closeSesion" class="nav-link text-nowrap" href="#" data-toggle="pill">Salir</a>
        </nav>
    </aside>
    <!-- <aside id="sidebar" :class="{'sidebar d-flex flex-column':true}">
        <div class="text-nowrap mx-1 text-center font-weight-bold h4 mb-0 p-2">
            <i class="pc-fa-patientcare-logo text-primary"></i>
        </div>
        <nav class="nav flex-column nav-pills m-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a  @click="goToAreaMedico" class="nav-link" href="#" data-toggle="pill" >Inicio</a>
            <a  @click="goToEquipoMedico" class="nav-link" href="#" data-toggle="pill" >Equipo Médico</a>
            <a  @click="closeSesion" class="nav-link" data-toggle="pill">Salir</a>

        </nav>
    </aside> -->

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
                return this.$store.state.sidebarLeft
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
                location.href="/medico"
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

        },
        async mounted(){
            //console.log(location)
            //ACTIVAR menus laterales
            this.getLocalStorageSidebar();
            //this.currentPathname = location.pathname
            console.log("2 ",this.currentPathname)
            /* if(this.currentPathname !== '/user/admin/index'){
                this.backButtonActive=true
            }else{
                this.backButtonActive=false
            } */

        }

    }
</script>
<style scoped>
/*.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #ffffff;
    background-color: #5b96df !important;
}*/
</style>
