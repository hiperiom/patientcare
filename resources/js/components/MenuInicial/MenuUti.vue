<template>
    <div class="flex-fill bg-white rounded-pill  col-10 col-sm-8 col-md-10 col-lg-10 col-xl-10 d-flex flex-column p-0 justify-content-center overflow-auto  container">

    <h4 class=" text-center text-secondary mt-3">Áreas de atención</h4>
    <div class="text-center text-secondary my-1">
        Selecciona el área a la que quieres ingresar
    </div>
    <div class="flex-fill nav-patientcare d-flex flex-column flex-md-row justify-content-center p-1 overflow-auto">
            <div class="flex-shrink-1 mt-auto mt-md-0 order-2 order-md-1 col-md-3 d-flex flex-wrap overflow-auto">
                <div class="flex-fill p-0   d-flex flex-column justify-content-center rounded-pill-custom-1">
                    <a :href="menu_seguimiento_hospitalizacion.goback.href">
                        <div class="card goback flex-row flex-md-column m-0 card-height justify-content-center align-items-center">
                            <i :class="menu_seguimiento_hospitalizacion.goback.icon"></i>
                            <div class="title text-uppercase mt-1">
                            {{menu_seguimiento_hospitalizacion.goback.title}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div :class="['order-1 order-md-2 d-flex flex-wrap pt-1 flex-md-fill overflow-auto',{'align-content-md-center':menu_seguimiento_hospitalizacion.menu.length <= 6},{'align-content-md-start':menu_seguimiento_hospitalizacion.menu.length > 6}]">
                <div v-for="(item,index) in menu_seguimiento_hospitalizacion.menu" :key="index" class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4  ">
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
            menu_seguimiento_hospitalizacion:{
                goback:{
                    title:"UTI",
                    icon:"pc-uti-light",
                    href: location.origin + '/menu_inicial_dashboards',
                    active:true,
                },
                menu:[
                    {
                        title:"UTI Adultos",
                        icon:"pc-uti-light",
                        href:location.origin + "/auth/areauti?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&uti=a",
                        active:true,
                    },
                    {
                        title:"UTI Pediátrico",
                        icon:"pc-uti-light",
                        href:location.origin + "/auth/areauti?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&uti=p",
                        active:true,
                    },
                    {
                        title:"UTI Neonatal",
                        icon:"pc-uti-light",
                        href:location.origin + "/auth/areauti?user_id="+JSON.parse(localStorage.getItem("user_profile"))['user_id']+"&uti=n",
                        active:true,
                    },
                ]
            },
        };
    },
    methods: {
    },
    mounted() {
    },
};
</script>

