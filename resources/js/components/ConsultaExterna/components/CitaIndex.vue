<template>
    <div class="flex-fill d-flex flex-column overflow-auto">
        <div class="container-fluid">
            <div id="headerCitaStatusOptions" class="row">
                
                <div class="col-lg-3 col-6 cursor-pointer" data-cat_user_cita_status_id="1" data-name="Citas por confirmar">
                    <router-link to="/consultaexterna/app/citalistado/porconfirmar" >
                        <div :class="['small-box bg-primary rounded-pill-custom-1',{'shadow-lg-primary':$route.name==='Citas por confirmar'}]" data-shadow-color="primary">
                            <div class="inner">
                                <h3 class="total-citas-poraprobar">201</h3>
                                <p></p>
                            </div>
                            <div class="icon">
    
                                <i class="pc-cita_por_confirmar text-white"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Por Confirmar
                            </a>
                        </div>
                    </router-link>
                </div>
                <div class="col-lg-3 col-6 cursor-pointer" data-cat_user_cita_status_id="4" data-name="Citas confirmadas">
                    <router-link to="/consultaexterna/app/citalistado/confirmadas">
                        <div :class="['small-box bg-success rounded-pill-custom-1',{'shadow-lg-success':$route.name==='Citas confirmadas'}]" data-shadow-color="success">
                            <div class="inner">
                                <h3 class="total-citas-aprobadas">0</h3>
                                <p></p>
                            </div>
                            <div class="icon">

                                <i class="pc-cita_confirmada text-white"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Confirmadas
                            </a>
                        </div>
                    </router-link>
                </div>
                <div class="col-lg-3 col-6 cursor-pointer" data-cat_user_cita_status_id="5" data-name="Preconsulta">
                    <router-link to="/consultaexterna/app/citalistado/preconsulta">
                        <div :class="['small-box bg-warning rounded-pill-custom-1',{'shadow-lg-warning':$route.name==='Citas en preconsulta'}]" data-shadow-color="warning">
                            <div class="inner">
                                <h3 class="total-citas-preconsulta  text-white">139</h3>
                                <p></p>
                            </div>
                            <div class="icon">
                                <i class="pc-preconsulta text-white"></i>
                            </div>
                            <a href="#" class="small-box-footer" style="color:white !important">
                                Preconsulta
                            </a>
                        </div>
                    </router-link>
                </div>
                <div class="col-lg-3 col-6 cursor-pointer" data-cat_user_cita_status_id="6" data-name="Consulta">
                    <router-link to="/consultaexterna/app/citalistado/consulta">
                        <div :class="['small-box bg-info rounded-pill-custom-1',{'shadow-lg-info':$route.name==='Citas en consulta'}]" data-shadow-color="info">
                            <div class="inner">
                                <h3 class="total-citas-consulta">10</h3>
                                <p></p>
                            </div>
                            <div class="icon">
                                <i class="pc-consulta text-white"></i>
                            </div>
                            <a href="#" class="small-box-footer  text-white">
                                Consulta
                            </a>
                        </div>
                    </router-link>
                </div>

            </div>
        </div>
        
        <router-view></router-view>
        
    </div>
</template>

<script>
    export default {
        name:"CitaIndex",
        methods:{
           
        }
    }
</script>

<style lang="scss">
    .shadow-lg-primary {
        border: 2px solid white;
        box-shadow: 0 0.5rem 1rem var(--primary) !important;
    }
    .shadow-lg-success {
        border: 2px solid white;
        box-shadow: 0 0.5rem 1rem var(--success) !important;
    }
    .shadow-lg-warning {
        border: 2px solid white;
        box-shadow: 0 0.5rem 1rem var(--warning) !important;
    }
    .shadow-lg-info {
        border: 2px solid white;
        box-shadow: 0 0.5rem 1rem var(--info) !important;
    }
    .bg-chacao {
        height: 100%;
        background: linear-gradient(90deg, #292929 50%, #FF8A27 50%);
    }
    .sticky-header{
        position: sticky;
        top: -1px;
    }
</style>