<template>
    <div class="d-flex flex-column bg-primary h-100">
        <div id="loadingScreen" :class="{ 'loadingScreen': true, 'd-none': !mostrarLoading }">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img loading="lazy" onerror="this.src='/image/system/patient.svg'"
                    src="/image/system/logo-cmdlt-blanco.svg" class="mb-3" alt="Cmdlt"
                    style="width: 140px; height: 80px">
                <div class="d-flex align-items-center  text-white justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                    <h4 class="pl-2 ">Por favor espere un momento...</h4>
                </div>
            </div>
        </div>
        <!--  <pre class="text-white">
  {{ form }}
        </pre> -->

        <Calendar @update:fn_agendas_mes="updateAgendasDelMes" :getGuardiasDelMes="getGuardiasDelMes"
            @update:mostrarLoading="updateLoading" :dias_semana="dias_semana" :cat_medicos="equipo_medico"
            :agenda_mes="agenda_mes" :year="currentYear" :month="currentMonth" @update:form="updateForm"
            @update:year="currentYear = $event" @update:month="currentMonth = $event" />
    </div>
</template>

<script>
    import Calendar from "./Calendar.vue";
    import { get, post, is_null } from '../../helpers/customHelpers';
    export default {
        name: "AppPlanificacionGuardias",
        data() {
            const today = new Date();
            const currentTimestamp = today.getTime();
            return {
                mostrarLoading: true,
                equipo_medico: [],
                //fecha: "",
                currentYear: today.getFullYear(),
                currentMonth: today.getMonth(),
                dias_semana: [
                    {
                        "id": 0,
                        "description": "Domingo",
                    },
                    {
                        "id": 1,
                        "description": "Lunes",
                    },
                    {
                        "id": 2,
                        "description": "Martes",
                    },
                    {
                        "id": 3,
                        "description": "Miércoles",
                    },
                    {
                        "id": 4,
                        "description": "Jueves",
                    },
                    {
                        "id": 5,
                        "description": "Viernes",
                    },
                    {
                        "id": 6,
                        "description": "Sábado",
                    },

                ],
                turnos: [
                    {
                        "id": 1,
                        "description": "Mañana",
                    },
                    {
                        "id": 2,
                        "description": "Tarde",
                    },
                    {
                        "id": 3,
                        "description": "Madrugada",
                    },
                ],
                form: {},
                agenda_mes: []

            };
        },

        components: {
            Calendar,
        },

        methods: {
            updateLoading(newValue) {
                this.mostrarLoading = newValue
            },
            updateForm(newForm) {
                this.form = newForm
                this.agenda_mes = [...this.agenda_mes, ...newForm.timestamps]
            },
            updateAgendasDelMes(newForm) {
                this.agenda_mes = newForm
            },
            async getEquipoMedico() {
                return await get("/medico/getMedicos")
            },
            async getGuardiasDelMes() {
                let formData = new FormData();
                formData.append("currentYear", this.currentYear)
                formData.append("currentMonth", this.currentMonth + 1)
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                return await post("/guardias/show", formData)
            },
            async initComponent() {
                this.mostrarLoading = true
                this.equipo_medico = await this.getEquipoMedico()
                this.agenda_mes = await this.getGuardiasDelMes()
                console.log(this.agenda_mes);
                this.mostrarLoading = false
            }
        },
        mounted() {
            this.initComponent()
        }
    }
</script>
<style lang="scss">
    .loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
    }

    .h-100 {
        height: 100vh !important;
    }


    .area-icon-color {
        width: 12px;
        height: 10px;
        border-radius: 50px;
    }

    .cargo-name-weight {
        font-weight: 600;
    }





    .monthName {
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-white {
        color: var(--secondary);
        background-color: white;
        border-color: var(--secondary);
    }

    .btn-white:hover {
        color: white;
        background-color: var(--secondary);
        border-color: white;
    }

    // X-Small devices (portrait phones, less than 576px)
    // No media query for `xs` since this is the default in Bootstrap

    /* // Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) {
        .calendar-grid {
            grid-template-columns: repeat(1, 1fr);
        }

    }

    /* // Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        .monthName {
            font-size: 1.5rem;
        }

        .calendar-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* // Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        .calendar-grid {
            grid-template-columns: repeat(7, 1fr);
        }
    }

    /* // X-Large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
        /* ... */
    }

    /* // XX-Large devices (larger desktops, 1400px and up) */
    @media (min-width: 1400px) {
        /* ... */
    }

    .img-logo {
        height: 50px;
        width: 120px;
    }

    body {
        background-color: #233a6d !important;
        margin: 0;
        font-family: 'Titillium Web';
        font-style: normal;
        font-weight: 400;
        src: url('/fonts/titillium-web-v8-latin-regular.eot');
        src: local('Titillium Web Regular'), local('TitilliumWeb-Regular'), url('/fonts/titillium-web-v8-latin-regular.eot?#iefix') format('embedded-opentype'),
            /* IE6-IE8 */
            url('/fonts/titillium-web-v8-latin-regular.woff2') format('woff2'),
            /* Super Modern Browsers */
            url('/fonts/titillium-web-v8-latin-regular.woff') format('woff'),
            /* Modern Browsers */
            url('/fonts/titillium-web-v8-latin-regular.ttf') format('truetype'),
            /* Safari, Android, iOS */
            url('/fonts/titillium-web-v8-latin-regular.svg#TitilliumWeb') format('svg');
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;

    }

    .btn-outline-white {
        color: white;
        border-color: white;
    }

    .btn-outline-white:hover {
        color: var(--primary);
        background-color: white;
        border-color: white;
    }

    .glassmod-effect {
        background-color: var(--light);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
        color: var(--dark);
        opacity: 1;
        transition: opacity .5s ease;
    }

    .rounded-custom-1 {
        border-radius: 0.50rem !important;
    }


    .loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
    }
</style>
