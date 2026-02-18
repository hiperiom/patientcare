<template>
    <div class="d-flex flex-column h-100">
        <nav class="d-flex justify-content-between shadow-sm glassmod-effect rounded-pill m-1 pr-2">
            <div class="btn-user-home d-flex align-items-center">
                <button onclick="location.href='/auth/menu_inicial_eventos_especiales'" class="btn_home_sidebar rounded-pill">
                    <span class="principal-menu-toggle  btn" id="menu-toggle-left"><i
                            class="fas fa-bars text-white"></i></span>
                    <div class="d-none align-items-center d-none ">
                        <img onerror="this.src='https://placehold.co/600x400'" class="img-user-size"
                            src="/image/user/foto_perfil/fp_5pTerv22-Capturadepantalla2023-04-20ala(s)10.50.19a.&nbsp;m..png">
                        <span
                            class="ml-1 mr-3 align-items-start justify-content-center d-flex flex-column overflow-hidden"
                            style="line-height: 1.1;">
                            <i class="message-wellcome"> ¡Bienvenido!

                            </i>
                            <div class="username text-left">Dr. Luis Eduardo Parodi</div>
                        </span>
                    </div>

                </button>
                <!-- otros items -->
            </div>
            <img class="img-logo my-1" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"
                alt="Logo CMDLT">
        </nav>
        <div class="h1 text-center text-white">
            PADEL FEST 3
        </div>
        <div class="container-fluid px-2 mb-2">
            <div class="offset-lg-3 col-12 col-lg-6 shadow text-white glassmod-effect rounded px-2 px-md-5 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column flex-md-row align-items-center" style="line-height:1">
                    <i class="pc-paciente mr-2 h3 mb-0 d-none d-md-block"></i>
                    <div class="mb-0 mr-2 total-evento" >
                        {{ items.length }}
                    </div>
                    <h3 class="mb-0">Atendidos</h3>
                </div>
                <div class="d-flex flex-column align-items-end py-1 h3 mb-0">
                    <div class="d-flex align-items-center ">
                        <div class="mr-2 sub-total">Hoy</div>
                        <div class="border px-2 rounded">{{ atendidosHoy.length }}</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-1">
                        <div class="mr-2 sub-total">Promedio Pac/Dia</div>
                        <div class="border px-2 rounded">{{ promedio.toFixed(0) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-2">
            <div class="d-flex  bg-white">
                <b :class="['col-3 col-md-1 d-flex flex-column justify-content-center text-primary text-center']">
                    INGRESO
                </b>
                <b :class="['col-9 text-center  text-primary col-md-3']">
                    PACIENTE
                </b>
                <b :class="['col-12 col-md-4 d-none d-md-flex justify-content-center  text-primary ']">
                <!-- <b :class="['col-12 text-center col-md-4 d-none d-md-flex justify-content-center  text-primary  p-0']"> -->
                    IMPRESIÓN DIAGNÓSTICA
                </b>
                <b class="col-12 text-center d-none d-md-flex justify-content-center  text-primary col-md-4 p-0">
                    EVOLUCIÓN
                </b>
            </div>
        </div>
        <div v-if="items.length > 0" class="d-flex flex-column container-fluid text-white px-2 overflow-auto">

            <div v-for="(item,index) in items" :key="index" class="d-flex flex-wrap glassmod-effect mb-1 rounded  shadow-sm">
                <div :class="['col-3 col-md-1 d-flex flex-column justify-content-center text-center border-right']">
                    <h1 class="mb-0">
                        {{ getDate(item.ingreso)['dia'] }}
                    </h1>
                    <small>
                        {{ getDate(item.ingreso)['mes'] }}
                    </small>
                </div>
                <div :class="['col-9 col-md-3',{'border-right':getWidthScreen>=768}]">
                    <div class="d-flex flex-column rounded">
                        <div class="d-flex justify-content-center align-items-center">
                        <div class="flex-fill">
                            <h5 class="text-center  d-none  font-weight-bold">Paciente</h5>
                        </div>
                        <button
                            class="btn btn-sefault d-block d-md-none"
                            data-toggle="collapse"
                            :data-target="'#collapseExample'+index"
                            aria-expanded="false"
                            :aria-controls="'collapseExample'+index"><i
                                    class="fas fa-bars text-white"></i></button>

                        </div>
                        <div class="d-flex">
                            <div>
                                <img :src="item.imagen"
                                onerror="this.src ='https://placehold.co/100x100'" loading="lazy"
                                class="d-none d-md-block align-self-start img-user-circle" alt="Imagen No Encontrada">
                            </div>
                            <div class="ml-2 d-flex flex-column">

                                <h5 class="text-user-name text-white text-uppercase pl-1">
                                {{ item.paciente }}
                                </h5>
                                <div class="tag-box d-flex align-items-center flex-wrap pb-1 text-uppercase">
                                    <div class="badge d-flex align-items-center badge-primary mr-1"
                                        style="font-size: 0.6rem; padding: 0.1rem;">
                                        <i class="mx-1 fas fa-id-card"></i> <span
                                            style="font-size: 0.9rem; font-weight: 768;">{{ item.cedula }}</span>
                                    </div>
                                    <div :class="['badge d-flex align-items-center mr-1 text-uppercase',{'badge-primary':item.genero=='m'},{'badge-pink':item.genero=='f'}]"
                                        style="font-size: 0.6rem; padding: 0.1rem;">
                                        <i class="mx-1 fas fa-venus-mars"></i>
                                        <span style="font-size: 0.9rem; font-weight: 768;">{{ item.genero }}</span>
                                    </div>
                                    <div class="badge d-flex align-items-center badge-warning mr-1"
                                        style="font-size: 0.6rem; padding: 0.1rem;">
                                        <i class="mx-1 fas fa-birthday-cake"></i>
                                        <span style="font-size: 0.9rem; font-weight: 768;">{{ item.edad }} A</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div :class="['col-12 col-md-8 p-0 collapse',{'show':getWidthScreen>=768}]" :id="'collapseExample'+index">
                    <div class="d-flex flex-wrap " style="height:100%">
                        <div :class="['col-12 col-md-6',{'border-right':getWidthScreen>=768}]">
                            <div class="d-flex flex-column rounded">
                                <h5 v-if="item.imp_diagn.length > 0" class="my-2 text-center d-block d-md-none font-weight-bold">Impresión Diagnóstica</h5>
                                <ul class="list-group">
                                    <li v-for="(item2,index2) in item.imp_diagn" :key="index2" class="list-group-item bg-transparent border-0">
                                        {{ item2.value }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column rounded">
                                <h5 v-if="item.evolucion.length > 0" class="my-2 text-center d-block d-md-none font-weight-bold">Evolución</h5>
                                <ul class="list-group">
                                    <li v-for="(item2,index2) in item.evolucion" :key="index2" class="list-group-item bg-transparent border-0">
                                        {{ item2.value }}
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="d-flex flex-column container-fluid text-white px-2 overflow-auto">
            Sin resultados
        </div>
    </div>
</template>

<script scoped>


export default {
    name: "AppEventoEspecial3",
    data() {
        return {
            total: 0,
            promedio: 0,
            atendidosHoy:0,
            fechaInicioEvento:"2024-09-27",
            items: [],
        }
    },
    methods: {
        generarFechasDesde() {
            // Convertir la fecha de inicio a un objeto Date si no lo es
            let fechaInicio = new Date(this.fechaInicioEvento);

            // Obtener la fecha actual
            const fechaHoy = new Date();

            // Crear un array para almacenar las fechas
            const fechas = [];

            // Iterar desde la fecha de inicio hasta la fecha de hoy
            for (let fecha = new Date(fechaInicio); fecha <= fechaHoy; fecha.setDate(fecha.getDate() + 1)) {
                // Clonar la fecha para evitar efectos secundarios
                const fechaClon = new Date(fecha);
                fechas.push(fechaClon.toISOString().substr(0, 10)); // Añadir la fecha al array (formato AAAA-MM-DD)
            }

            return fechas;
        },
        calcularPromedioRegistrosPorDia() {
            // Crear un objeto para almacenar el recuento de registros por día
            const totalesPorDia = [];

            this.generarFechasDesde().forEach(item=>{
                //console.log(item);
                let hoy = new Date(item)
                let total = this.filtrarPorFecha(hoy)
                totalesPorDia.push(total.length)
            })
            const sumaValores = totalesPorDia.reduce((total, valor) => total + valor, 0);

            // Calcular el promedio
            this.promedio = sumaValores / totalesPorDia.length;
        },
        fetchData: async () => {
            try {
                const response = await fetch('/vistas/v_ee3_reporte_diario');
                const responseData = await response.json();
                return responseData;
            } catch (error) {
                console.error('Error al obtener los datos:', error);
            }
            return false
        },
        getAtendidosHoy(){
            let hoy = new Date()
            this.atendidosHoy = this.filtrarPorFecha(hoy)

        },
        filtrarPorFecha(fecha) {
            // Convertir la fecha a formato de objeto Date si no lo es
            if (!(fecha instanceof Date)) {
                fecha = new Date(fecha);
            }

            // Filtrar los registros según la fecha
            const registrosFiltrados = this.items.filter(registro => {
                //console.log(registro);
                // Convertir la fecha del registro a formato de objeto Date si no lo es
                const fechaRegistro = new Date(registro.ingreso);

                // Comparar las fechas (solo comparando el día, mes y año)
                return fechaRegistro.getDate() === fecha.getDate() &&
                    fechaRegistro.getMonth() === fecha.getMonth() &&
                    fechaRegistro.getFullYear() === fecha.getFullYear();
            });

            return registrosFiltrados;
        },
        getDate(param){
            let fecha = new Date(param)
            //console.log(param)
                return{
                    'dia':fecha.getDate().toString().padStart(2, '0'),
                    'mes':this.meses(fecha.getMonth())
                }
        },

        async getPacientes() {
            let model = await this.fetchData()
            let stringModel = JSON.stringify(model)
            let stringItems = JSON.stringify(this.items)
                if (stringModel !== stringItems) {
                    this.items = await this.fetchData()
                }

        },

        meses(p) {
            let mes = [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
                "Enero"
            ]
            return mes[p];
        },
        getPromedio: (pacientes) => {
            //console.log(pacientes   )
            //let pacientes = this.$store.state.pacientes
            let dias_eventos = Array.from(new Set(pacientes.map(x => x.ingreso)))
            let pacientesPorDia = []
            let group_pacientesPorDia = dias_eventos.map(x => {
                let f = x.split("-")
                const fecha = new Date(`${f[2]}-${f[1]}-${String(Number(f[0]))}`);

                const numeroDiaSemana = fecha.getDay();
                return pacientesPorDia[x] = {
                    "total": pacientes.filter(z => z.ingreso === x),
                    "dia_nombre": nombresDiasSemana[numeroDiaSemana].slice(0, 3).toUpperCase(),
                    "dia_mes": fecha.getDate().toString().padStart(2, '0'),
                    "total_atencionPaciente": pacientes.filter(z => z.ingreso === x && z.cat_user_ubicacion_id === 233),
                    "total_stand": response.filter(z => z.ingreso === x && z.cat_user_ubicacion_id === 232),
                }
            })
            let pacientesHoy = pacientes.filter(x => x.ingreso === fechaAMD())
            let total_pacientes_por_dia = group_pacientesPorDia.map(x => x.total.length)
            let sumaTotal = total_pacientes_por_dia.reduce((total, valor) => total + valor, 0);
            let promedio = sumaTotal / total_pacientes_por_dia.length;

            return promedio
        }
    },
    computed:{
        getWidthScreen(){
        return window.innerWidth
        }
    },
    mounted: async function () {
        await this.getPacientes()
        this.getAtendidosHoy()
        this.calcularPromedioRegistrosPorDia()
        //this.promedio = this.calcularPromedioRegistrosPorDia()
        const intervalId2 = setInterval(async () => {
            await this.getPacientes()
            this.getAtendidosHoy()
            this.calcularPromedioRegistrosPorDia()
        }, 10000);

    }
};
</script>
<style>
.badge-pink {
    color: #ffffff;
    background-color: #f278b0;
}
.h-100 {
    height: 100vh !important;
}

.glassmod-effect {
    background-color: hsla(0, 0%, 100%, .3);
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
}

body {
    background: #0062cc;
    /* //background: radial-gradient(circle, #185ba9 0, #a0ccff 0, #185ba9 100%); */
}

.rounded-pill-1 {
    border-radius: 20px;
}

.img-logo {
    height: 50px;
}

.btn_home_sidebar:hover {
    background-color: hsla(0, 0%, 100%, .31);
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
    color: #0062cc;
}

.btn-user-home button {
    background-color: transparent;
    display: flex;
    color: white;
    align-items: center;
    border: 0px;
}

.img-user-size {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.btn-user-home .username {
    font-weight: bold;
    font-size: 1.5rem;
    text-wrap: nowrap;
    overflow: hidden;
    width: auto;
    /* border: 1px solid red; */
}

table {
    border-collapse: separate;
    border-spacing: 10px 5px;
}

.position-sticky {
    position: absolute;
    top: 0px;
    z-index: 111111111;
    background-color: hsla(0, 0%, 100%, .5);
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
}
.img-user-circle {
    width: 30px;
    height: 30px;
    border-radius: 50px;
}
.gap-1{
  gap:10px;
}
.total-evento
{
    font-size:3rem;
    font-weight:600
}
.total-evento + h3
{
    font-size:1rem;
    font-weight:600
}
.sub-total{
    font-size:1rem;
    font-weight:600
}

/* // Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) {

}

/* // Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .total-evento{
        font-size:4rem;
        font-weight:600
    }
    .total-evento + h3
    {
        font-size:1.5rem;
        font-weight:600
    }
    .sub-total{
        font-size:1.5rem;
        font-weight:600
    }
    .img-user-circle {
        width: 50px;
        height: 50px;
        border-radius: 50px;
    }
}

/* // Large devices (desktops, 992px and up) */
@media (min-width: 992px) {

}

/* // Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {

}
</style>
