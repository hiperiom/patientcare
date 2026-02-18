<template>
    <div class="flex-fill bg-white rounded-pill  col-10 col-sm-8 col-md-10 col-lg-10 col-xl-10 d-flex flex-column p-0 justify-content-center overflow-auto  container">

    <h4 class=" text-center text-secondary mt-3">Áreas de atención</h4>
    <div class="text-center text-secondary my-1">
        Selecciona el área a la que quieres ingresar
    </div>
    <div class="flex-fill nav-patientcare d-flex flex-column flex-md-row justify-content-center p-1 overflow-auto">
            <div class="flex-shrink-1 mt-auto mt-md-0 order-2 order-md-1 col-md-3 d-flex flex-wrap overflow-auto">
                <div class="flex-fill p-0   d-flex flex-column justify-content-center rounded-pill-custom-1">
                    
                    <button style="background: transparent;border:0;" @click="goback">
                        <div class="card goback flex-row flex-md-column m-0 card-height justify-content-center align-items-center">
                            <i :class="menu_pacientes_en_piso.goback.icon"></i>
                            <div class="title text-uppercase mt-1">
                            {{menu_pacientes_en_piso.goback.title}}
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <div :class="['order-1 order-md-2 d-flex flex-wrap pt-1 flex-md-fill overflow-auto',{'align-content-md-center':menu_pacientes_en_piso.menu.length <= 6},{'align-content-md-start':menu_pacientes_en_piso.menu.length > 6}]">
                <div v-for="(item,index) in menu_pacientes_en_piso.menu" :key="index" class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4  ">
                    <a :href="item.href">
                        <div :class="[{'bg-light':!item.active},'card mb-2 justify-content-center align-items-center card-height']">
                        <i :class="[item.icon,{'text-gray':!item.active }]"></i>
                        <div :class="[{'text-gray':!item.active },'title text-uppercase mt-1']">
                            {{item.title}}
                        </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <a href="/finalizarSesion" class=" btn btn-exit mt-2">Salir del sistema</a>
    </div>
</template>

<style scoped>

</style>

<script>
export default {
    props: [],
    data() {
        return {
            menu_pacientes_en_piso:{
                goback:{
                    title:"Pacientes en piso",
                    icon:"pc-light-pisos",
                    href: location.origin + '/menu_inicial_hospitalizacion',
                    active:true,
                },
                menu:[
                    {
                        title:"PISO 2 A",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=2&ala=a",
                        active:true,
                    },
                    /* {
                        title:"PISO 2 B",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=2&ala=b",
                        active:true,
                    }, */
                    {
                        title:"PISO 3 A",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=3&ala=a",
                        active:true,
                    },
                    {
                        title:"PISO 3 B",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=3&ala=b",
                        active:true,
                    },
                    {
                        title:"PISO 4 A",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=4&ala=a",
                        active:true,
                    },
                    {
                        title:"PISO 4 B",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=4&ala=b",
                        active:true,
                    },
                    {
                        title:"PISO 5 A",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=5&ala=a",
                        active:true,
                    },
                    {
                        title:"PISO 5 B",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=5&ala=b",
                        active:true,
                    },
                    {
                        title:"PISO 6 A",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=6&ala=a",
                        active:true,
                    },
                    /* {
                        title:"PISO 6 B",
                        icon:"pc-light-pisos",
                        href:location.origin + "/auth/areahospitalizacion?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&piso=6&ala=b",
                        active:true,
                    }, */
                ],
            },
        };
    },
    methods: {
        goback(){
            this.$router.push("/auth/menu_inicial_hospitalizacion");
        }
    },
    mounted() {
    },
};
</script>

