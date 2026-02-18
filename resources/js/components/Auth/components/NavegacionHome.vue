<template>
    <div class="flex-fill bg-white rounded-pill  col-10 col-sm-8 col-md-10 col-lg-10 col-xl-10 d-flex flex-column p-0 justify-content-center overflow-auto  container">

    <!-- <div class="flex-fill bg-white col-12 d-flex flex-column text-center p-4 rounded-pill overflow-auto"> -->


        <h4 class=" text-center text-secondary mt-3">Áreas de atención</h4>
        <div class="text-center text-secondary my-1">
            Selecciona el área a la que quieres ingresar
        </div>
        <div class="flex-fill nav-patientcare d-flex flex-column justify-content-center p-1 overflow-auto">
            <div class="d-flex flex-wrap pt-1 overflow-auto">

                <div v-for="(item,index) in $store.state.navegationMenu[ currentNavegationMenu ].menu" :key="index" class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                    <div @click="handleEvent(item.eventHandle)" :class="[{'bg-light':!item.active},'card flex-row flex-sm-column mb-2 card-height justify-content-start justify-content-sm-center align-items-center']">
                      <i :class="[item.icon,'ml-1 ml-sm-0',{'text-gray':!item.active }]"></i>
                      <div :class="[{'text-gray':!item.active },'ml-2 ml-sm-0 title text-uppercase mt-1 text-left text-sm-center']">
                        {{item.title}}
                      </div>
                    </div>
                </div>
            </div>

        </div>
        <a href="/finalizarSesion" class=" btn btn-exit mt-2">Salir del sistema</a>

    </div>
</template>
<script>
    //import {is_empty,post} from '../../../helpers/customHelpers.js'
    export default{
        name:"NavegacionHome",
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
                    param.value()
                }

            },


        },
        computed:{
            /* getCurrentNavegationMenu(){
                return localStorage.getItem("currentNavegationMenu")
            } */
        },
        created(){
            localStorage.setItem("currentNavegationMenu","navegationHome")
            this.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
            window.addEventListener('beforeunload', function(event) {
                if(window.location.pathname === '/auth/navegationMenu'){
                    alert('Menú')
                    localStorage.setItem("currentNavegationMenu",localStorage.getItem("lastNavegationMenu"))
                }
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
    .btn-exit{
        color:var(--info);
    }


</style>

