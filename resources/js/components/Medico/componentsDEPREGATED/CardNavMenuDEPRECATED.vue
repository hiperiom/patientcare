<template>
    
    <div 
        @click="handleCard" 
        :class="[{'goback flex-row flex-md-column':isCardGoback},'card card-height justify-content-center align-items-center']"
    >
        <i :class="[{'mr-2 mr-md-0':isCardGoback},icon]"></i>
        <div class="title text-uppercase mt-1">
            {{ title }}
        </div>
    </div>
    
</template>

<script>
    export default {
        props:{
            title:{
                type:String,
                default:"Title Card"
            },
            icon:{
                type:String,
                default:"fas fa-question"
            },
            isCardGoback:{
                type:Boolean,
                default:false
            },
            funtionEvent:{
                type:Function,
                default:function(){
                    alert("Opción no disponible")
                }
            } 
        },
        methods:{
            handleCard(){
                this.funtionEvent();
            }
        }
    }
</script>

<style lang="scss" scoped>
.nav-patientcare .card.goback {
    height:auto;
} 
.nav-patientcare .card{
    color:var(--secondary);
    border-radius: 1rem;
    overflow: auto;
}
.nav-patientcare .card i{
    font-size: 50px;
}
.nav-patientcare .card .title{
    font-weight: 600;
    text-align: center;
}
.nav-patientcare .card.goback:hover{
    background-color: var(--secondary) !important;
    color: var(--white) !important;
    
    transition: all 0.30s ease !important;
    cursor:pointer;
    
}
.nav-patientcare .card:not(.title):hover{
    background-color: var(--primary);
    color: var(--white);
    transition: width 1s,opacity 0.5s;
    cursor:pointer;
    transition: all 0.30s ease !important;
}
@media (min-width: 768px) { 
    .nav-patientcare .card.goback {
        height:200px;
    } 
    .nav-patientcare .card.goback i{
      
        font-size: 50px;
    } 
    .nav-patientcare .card.title{
        font-size: 1.5rem;
    }
    .nav-patientcare .card.goback{
        background-color:var(--primary);
        color:var(--white);
    } 
}
@media (min-width: 0) {  
    .shadow-none{
        box-shadow: none !important;
    }
    .nav-patientcare .card.title,
   .nav-patientcare .card.goback{
        margin: 0.5rem !important;
        padding:0.5rem !important;
    } 
    
   
    
    .nav-patientcare .card.title{
       
        color:var(--primary);
    } 
    .card-height{
        height:200px;
    }
  
}
</style>