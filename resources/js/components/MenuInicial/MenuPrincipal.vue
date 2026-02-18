<template>
    <div class="flex-fill bg-white rounded-pill  col-10 col-sm-8 col-md-10 col-lg-10 col-xl-10 d-flex flex-column p-0 justify-content-center overflow-auto  container">
    <h4 class=" text-center text-secondary mt-3">Áreas de atención</h4>
    <div class="text-center text-secondary my-1">
        Selecciona el área a la que quieres ingresar
    </div>
    <div class="flex-fill nav-patientcare d-flex flex-column justify-content-center p-1 overflow-auto">
        <div class="d-flex flex-wrap pt-1 overflow-auto">

            <div v-for="(item,index) in navegationHome.menu" :key="index" class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <a :href="item.href">
                    <div :href="item.href" :class="[{'bg-light':!item.active},'card flex-row flex-sm-column mb-2 card-height justify-content-start justify-content-sm-center align-items-center']">
                      <i :class="[item.icon,'ml-1 ml-sm-0',{'text-gray':!item.active }]"></i>
                      <div :class="[{'text-gray':!item.active },'ml-2 ml-sm-0 title text-uppercase mt-1 text-left text-sm-center']">
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
            navegationHome:{
                menu:[
                    {
                        title:"Seguimiento de Pacientes",
                        icon:"pc-paciente",
                        href: location.origin + "/auth/areaequiposalud?user_id="+JSON.parse( localStorage.getItem("user_profile") )['user_id'],
                        active:true,
                    },
                    {
                        title:"Resumen Clínico",
                        icon:"pc-resumen_clinico",
                        href: location.origin + "/auth/arearesumenclinico?user_id="+JSON.parse( localStorage.getItem("user_profile") )['user_id'],
                        active:true,
                    },
                    {
                        title:"Área Quirúrgica",
                        icon:"pc-cirugia-light",
                        href: location.origin + '/menu_inicial_aq',
                        active:true,
                    },
                    /* {
                        title:"Telesalud",
                        icon:"pc-telesalud",
                        href:location.origin + '/menu_inicial_telesalud',
                        active:true,
                    }, */
                    {
                        title:"Dashboards de Seguimiento",
                        icon:"pc-tablero",
                        href:location.origin + '/menu_inicial_dashboards',
                        active:true,
                    },
                    
                    
                    /* {
                        title:"Consulta Externa",
                        icon:"pc-solid_estetoscopio",
                        href:'#',
                        active:false,
                    }, */
                    {
                        title:"Hotelería",
                        icon:"pc-hoteleria",
                        href: location.origin + "/auth/hoteleria?user_id="+JSON.parse( localStorage.getItem("user_profile") )['user_id'],
                        active:true,
                    },
                    {
                        title:"Satisfacción",
                        icon:"pc-light-satisfation",
                        href:'/menu_inicial_satisfaccion',
                        active:true,
                    },
                    {
                        title:"Administrador",
                        icon:"pc-administrador",
                        href:'/menu_inicial_administrador',
                        active:true,
                    },
                    {
                        title:"Eventos Especiales",
                        icon:"pc-cita_favorita",
                        href:location.origin + 'auth/menu_inicial_eventos_especiales',
                        active:true,
                    },
                    {
                        title:"Planificación de guardias",
                        icon:"pc-seguro_medico",
                        href: location.origin + "/auth/areaplanificacionguardia?user_id="+JSON.parse( localStorage.getItem("user_profile") )['user_id'],
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
