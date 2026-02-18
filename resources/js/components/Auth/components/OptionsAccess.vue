<template>
    <div class="flex-fill bg-white col-12 d-flex flex-column text-center p-4 rounded-pill overflow-auto">
        <img class="img-fluid" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg"
            style="height: 3.5em;" alt="Not Logo System Found">
        <h4 class=" text-center text-secondary mt-3">Áreas de atención</h4>
        <div class="text-center text-secondary my-3">
            Selecciona el área a la que quieres ingresar
        </div>
        <div class="flex-fill nav-patientcare d-flex flex-column justify-content-center p-1 overflow-auto">  
            <div class="d-flex flex-wrap pt-1 overflow-auto">
                <div v-for="(item,index) in menu" :key="index" class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                    <div @click="handleEvent(item.eventHandle)" class="card mb-1 card-height justify-content-center align-items-center">
                      <i :class="item.icon"></i> 
                      <div class="title text-uppercase mt-1">
                        {{item.title}}
                      </div>
                    </div>
                </div>
            </div>
            <!-- <div class="d-flex flex-wrap w-100 overflow-auto">
               
            </div>--> 
        </div> 
       <!--  
       
            
              
        
        
        -->
        <!-- <form ref="form" v-on:submit.prevent="procesar();">
            <div class="list-group">
                <a href="#" @click="goToAreaMedico" class="list-group-item list-group-item-action">Seguimiento Médico</a>
                <a href="#" @click="goToAreaQuirurgica" class="list-group-item list-group-item-action">Área Quirúrgica</a>
                <a href="#" @click="goToAreaTelesaludEpresarial" class="list-group-item list-group-item-action">Telesalud Empresarial</a>
                <a href="#" @click="goToAreaHoteleria" class="list-group-item list-group-item-action">Area de Hotelería</a>
                <a href="#" @click="goToAdministrador" class="list-group-item list-group-item-action">Administrador</a>
            </div>
        </form>
        <a href="/finalizarSesion" class=" w-100 font-weight-bold text-secondary">Salir</a> -->

    </div>
</template>
<script>
//import {is_empty,post} from '../../../helpers/customHelpers.js'
export default{
    name:"AccessUserProfile",
    data: () => ({
        goback:{
            title:"",
            icon:"",
            route:"",
            eventHandle(){
                 /*  let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                    route = location.origin + "/medico"+ "?user_id="+user_id
                    this.$router.push(route); */
            },
            active:true,
        },
        menu:[
            {
            title:"Seguimiento de Pacientes",
            icon:"pc-paciente",
            route:"/medico",
            eventHandle(){
                let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                    location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id
            },
            active:true,
        },
        {
            title:"Área Quirúrgica",
            icon:"pc-cirugia-light",
            route:"",
            eventHandle(){
                location.href='#'
            },
            active:true,
        },
        {
            title:"Telesalud Empresarial",
            icon:"pc-telesalud-empresarial",
            route:"",
            eventHandle(){
                location.href='#'
            },
            active:true,
        },
        
   
        
        
        ]
    
    }),
    methods: {
        handleEvent(param){
            param()
        },
        goToRoute(route){
           
        }
        /* goToAdministrador:()=>{
            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                //localStorage.removeItem("user_profile")
                location.href = location.origin + "/auth/areaadministrador?user_id="+user_id
        },
        goToAreaMedico:()=>{
            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                //localStorage.removeItem("user_profile")
                location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id
          
        },
        goToAreaHoteleria:()=>{
            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                //localStorage.removeItem("user_profile")
                location.href = location.origin + "/surveyInsituIndex?user_id="+user_id
 
        },
        goToAreaTelesaludEpresarial:()=>{
            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                //localStorage.removeItem("user_profile")
                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id
        },
        goToAreaQuirurgica:()=>{
            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                //localStorage.removeItem("user_profile")
                location.href = location.origin + "/auth/areaquirurgica?user_id="+user_id
        }, */
    },
    mounted() {
        this.$store.commit('updateProperty', {
            fieldName:'loading',
            fieldValue:false,
        });
    },
}
</script>

