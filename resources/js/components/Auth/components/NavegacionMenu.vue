<template>
    <div class="flex-fill bg-white rounded-pill  col-10 col-sm-8 col-md-10 col-lg-10 col-xl-10 d-flex flex-column p-0 justify-content-center overflow-auto  container">

    <!-- <div class="flex-fill bg-white col-12 d-flex flex-column text-center p-4 rounded-pill overflow-auto"> -->
        <!-- <img class="img-fluid" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg"
            style="height: 3.5em;" alt="Not Logo System Found"> -->
        <h4 class=" text-center text-secondary mt-3">Áreas de atención</h4>
        <div class="text-center text-secondary my-1">
            Selecciona el área a la que quieres ingresar
        </div>
        <div class="flex-fill nav-patientcare d-flex flex-column flex-md-row justify-content-center p-1 overflow-auto">
            <!-- <div class="d-flex flex-column"> -->
                <div class="flex-shrink-1 mt-auto mt-md-0 order-2 order-md-1 col-md-3 d-flex flex-wrap overflow-auto">
                    <div class="flex-fill p-0   d-flex flex-column justify-content-center rounded-pill-custom-1">
                        <div @click="handleEvent($store.state.navegationMenu[ currentNavegationMenu ].goback.eventHandle)" class="card goback flex-row flex-md-column m-0 card-height justify-content-center align-items-center">
                            <i :class="$store.state.navegationMenu[ currentNavegationMenu ].goback.icon"></i>
                            <div class="title text-uppercase mt-1">
                            {{$store.state.navegationMenu[ currentNavegationMenu ].goback.title}}
                            </div>
                        </div>
                    </div>
                </div>
                <div :class="['order-1 order-md-2 d-flex flex-wrap pt-1 flex-md-fill overflow-auto',{'align-content-md-center':$store.state.navegationMenu[ currentNavegationMenu ].menu.length <= 6},{'align-content-md-start':$store.state.navegationMenu[ currentNavegationMenu ].menu.length > 6}]">
                    <div v-for="(item,index) in $store.state.navegationMenu[ currentNavegationMenu ].menu" :key="index" class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4  ">
                        <div @click="handleEvent(item.eventHandle)" :class="[{'bg-light':!item.active},'card mb-2 justify-content-center align-items-center card-height']">
                          <i :class="[item.icon,{'text-gray':!item.active }]"></i>
                          <div :class="[{'text-gray':!item.active },'title text-uppercase mt-1']">
                            {{item.title}}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="d-flex flex-wrap w-100 overflow-auto">

            </div>-->
       <!--  </div> -->
       <a href="/finalizarSesion" class=" btn btn-exit mt-2">Salir del sistema</a>
    </div>
</template>
<script>

    //import {is_empty,post} from '../../../helpers/customHelpers.js'
    export default{
        name:"Navegation",
        data() {
            return {
                currentNavegationMenu:""
            }
        },
        methods: {
            handleEvent(param){
                param = param()
                if (param.type==="route") {
                    this.$router.push(param.value);
                }
                if (param.type==="function") {
                    param.value(this)
                }

            },

        },
        computed:{

        },
        created(){
            this.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
            localStorage.setItem("lastNavegationMenu",localStorage.getItem("currentNavegationMenu"))
            window.addEventListener('beforeunload', function(event) {
                event.preventDefault()
                if(
                    localStorage.getItem("currentNavegationMenu") === 'navegationLv0_1_areaquirurgica' ||
                    localStorage.getItem("currentNavegationMenu") === 'navegationLv0_1_telesalud' ||
                    localStorage.getItem("currentNavegationMenu") === 'navegationLv0_1_tableros_seguimiento' ||
                    localStorage.getItem("currentNavegationMenu") === 'navegationLv0_4_eventos_especiales' ||
                    localStorage.getItem("currentNavegationMenu") === 'navegationLv0_6_administrador' ||
                    localStorage.getItem("currentNavegationMenu") === 'navegationLv0_7_satisfaccion'
                ){
                    alert('Home')
                }
                // if(window.location.pathname === '/auth/navegationHome'){
                //     alert('Home')
                //     localStorage.setItem("currentNavegationMenu","navegationHome")
                // }
            });
        },
        mounted() {
            this.$store.commit('updateProperty', {
                fieldName:'loading',
                fieldValue:false,
            });
        },
    }
</script>
<style>

</style>

