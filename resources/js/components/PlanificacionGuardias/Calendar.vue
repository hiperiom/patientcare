<template>
    <div class="flex-fill calendar d-flex w-100 flex-column overflow-auto">


        <!-- Modal -->
        <AppSeleccionMedico @update:mostrarLoading="updateLoading" :dias_semana="dias_semana" :cat_medicos="cat_medicos"
            @update:form="updateFormChild" />


        <nav class="calendar-header px-1 d-flex align-items-center mt-1">
            <button onclick="location.href='/auth/menu_inicial_principal'"
                class="btn-patientcare btn bg-transparent col-1  d-flex h3  align-items-center text-white">
                <i class="fas fa-bars text-white mr-2"></i><i
                    class="d-none d-sm-flex pc-fa-patientcare-logo text-white h3 mb-0"></i>

            </button>
            <div class="monthName mb-0 text-white text-uppercase text-center">
                <span>PLANIFICACIÓN DE GUARDIAS CMDLT</span>
                <br>{{ monthName }} {{ year }}
            </div>
            <img src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT"
                class="img-logo">
        </nav>
        <nav class="calendar-header px-1 d-flex align-items-center mt-1">
            <button class="btn btn-outline-white" @click="prevMonth">Anterior</button>

            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-white">Añadir guardia</button>
            <button class="btn btn-outline-white" @click="nextMonth">Siguiente</button>
        </nav>
        <div class="calendar-grid mx-2">

            <div class="d-none d-lg-block font-weight-bold calendar-day text-center text-white"
                v-for="day in daysOfWeek" :key="day">
                {{ day }}
            </div>
        </div>
        <div class="calendar-grid rounded-custom-1 glassmod-effect mx-2 flex-fill overflow-auto">
            <div :class="['border calendar-date d-lg-block', { 'd-none': !date.day }, { 'empty': !date.day }]"
                v-for="(date, index) in calendarDays" :key="index">

                <div v-if="isFestiveDay(date)" :title="getFestiveDay(date)?.description"
                    class="rounded text-center bg-gray">
                    <span class="d-lg-none">{{ date.weekday }}</span> <b class=" text-primary"> {{ date.day }}</b>
                </div>
                <div v-else class="text-center text-primary">
                    <span class="d-lg-none">{{ date.weekday }}</span> <b> {{ date.day }}</b>
                </div>

                <div v-if="date.day" v-for="(item, index) in getAgendaDesplegada(date.day)" :key="'item1_' + index"
                    class="text-dark shadow-sm pb-1 bg-light rounded mx-1 mb-2 " style="font-size:0.8rem">
                    <div class="d-flex align-items-center ">
                        <div class="text-center w-100 rounded text-uppercase font-weight-bold"
                            style="background-color: #ededed !important;">
                            {{ item.description }}
                        </div>
                    </div>
                    <ul class="list-group">
                        <li v-for="(item2, index2) in item.items.sort((a, b) => new Date(a.fecha) - new Date(b.fecha))"
                            :key="'item2_' + index2"
                            :class="[{ 'bg-transparent': item2.active && !item2.cumplido }, { 'bg-success-cumplido': item2.active && item2.cumplido }, { 'bg-danger-disabled': !item2.active }, 'calendar-day list-group-item border-0 d-flex align-items-center mb-1 py-1 px-1']">
                            <div
                                :class="[{ 'bg-warning': item2.turno_id === 1 }, { 'bg-success': item2.turno_id === 2 }, { 'bg-primary': item2.turno_id === 3 }, 'mr-1 area-icon-color']">
                            </div>

                            <img onerror="this.src='https://placehold.co/300x300'" :src="item2.imagen" class="mr-1"
                                style="width: 30px; height: 30px; border-radius: 50px;">

                            <div class="d-flex flex-column w-100">
                                <div class=" mr-1"></div>
                                <div class="d-flex align-items-center">
                                    <div
                                        :class="[{ 'text-dark': item2.active }, { 'text-white': !item2.active }, 'flex-grow-1 font-weight-bold text-nowrap']">

                                        {{ getHoraAMPM(item2.turno_inicio) }} - {{ getHoraAMPM(item2.turno_fin) }}
                                    </div>
                                    <i v-if="item2.active && item2.cumplido" class="fas fa-check text-success mr-1"></i>
                                    <i v-if="!item2.active" class="far fa-calendar-times text-danger mr-1"></i>
                                    <i v-if="item2.comentarios !== ''" class="fas fa-comment text-success "></i>
                                </div>
                                <h6
                                    :class="[{ 'text-secondary': item2.active }, { 'text-white': !item2.active }, 'mb-0']">
                                    {{ item2.personal }}
                                </h6>
                                <div class="d-flex align-items-center">

                                    <div
                                        :class="[{ 'text-secondary': item2.active }, { 'text-white': !item2.active }, 'flex-grow-1 text-nowrap']">
                                        <i class="fas fa-phone mr-1"></i> {{ item2.telefono_movil }}
                                    </div>
                                    <div
                                        :class="[{ 'text-secondary': item2.active }, { 'text-white': !item2.active }, 'flex-grow-1 bg-white rounded-pill text-nowrap text-center font-weight-bold']">
                                        {{ item2.asterisco }}
                                    </div>
                                </div>
                            </div>
                            <div class="options">
                                <button @click="handleConfirmarGuardia(item2, item2.cumplido)"
                                    class="btn btn-white p-1">
                                    <i :class="['fas fa-check', { 'text-success': item2.cumplido }]"></i>
                                </button>

                                <button @click="handleCancelarGuardia(item2, item2.active)" class="btn btn-white p-1">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { get, post, is_null } from '../../helpers/customHelpers';
    import AppSeleccionMedico from "./AppSeleccionMedico.vue";

    export default {
        name: "Calendar",
        props: {
            cat_medicos: {
                type: Array,
                default: []
            },
            dias_semana: {
                type: Array,
                default: []
            },
            parentForm: {
                type: Function,
            },
            agenda_mes: {
                type: Array,
                default: []
            },
            year: {
                type: Number,
                required: true
            },
            month: {
                type: Number,
                required: true
            },
            mostrarLoading: {
                type: Boolean,
                //required: true
            },
            getGuardiasDelMes: {
                type: Function,
            },
            fn_agendas_mes: {
                type: Function,
            }
        },
        components: {
            AppSeleccionMedico,
        },
        data() {
            return {

                festive_days: [
                    {
                        day: 21,
                        month: 8,
                        description: "Prueba Efemeride del sistema"
                    }
                ],
                temp_agenda_mes: "",
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                cargos: [],
                agenda_deplegada: [],
            }
        },
        computed: {

            monthName() {
                return new Date(this.year, this.month).toLocaleString('default', { month: 'long' });
            },
            calendarDays() {
                const startOfMonth = new Date(this.year, this.month, 1).getDay();
                const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                const days = Array.from({ length: daysInMonth }, (_, i) => {
                    const date = new Date(this.year, this.month, i + 1);
                    return {
                        day: i + 1,
                        month: this.month,
                        weekday: this.daysOfWeek[date.getDay()]
                    };
                });

                for (let i = 0; i < startOfMonth; i++) {
                    days.unshift({ day: null, weekday: '' }); // Agregar días vacíos al inicio del mes
                }
                //console.log(days)
                return days;
            }
        },
        watch: {
            'agenda_mes'(newValue, oldValue) {
                this.deploy_agenda()
            },
        },
        methods: {
            async handleConfirmarGuardia(guardia, cumplido_value) {
                let message = confirm("¿Confirmar la asistencia?")
                let index = this.agenda_mes.findIndex(x => x.id === guardia.id)
                let dia_cumplido = 1
                let dia_no_cumplido = 0
                if (message) {
                    this.$emit('update:mostrarLoading', true);
                    let formData = new FormData();
                    formData.append("guardia_id", guardia.id)
                    formData.append("field", "cumplido")
                    formData.append("value", cumplido_value === 0 ? dia_cumplido : dia_no_cumplido)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                    await post("/guardias/updatefield", formData)
                    this.agenda_mes[index].cumplido = cumplido_value === 0 ? dia_cumplido : dia_no_cumplido
                    this.$emit('update:mostrarLoading', false);
                }


            },
            async handleCancelarGuardia(guardia, active_value) {
                let message = confirm("¿Cancelar la guardia en este día?")
                let index = this.agenda_mes.findIndex(x => x.id === guardia.id)
                let dia_activo = 1
                let dia_cancelado = 0
                if (message) {
                    this.$emit('update:mostrarLoading', true);
                    let formData = new FormData();
                    formData.append("guardia_id", guardia.id)
                    formData.append("field", "active")
                    formData.append("value", active_value === 0 ? dia_activo : dia_cancelado)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                    await post("/guardias/updatefield", formData)
                    this.agenda_mes[index].active = active_value === 0 ? dia_activo : dia_cancelado
                    this.$emit('update:mostrarLoading', false);
                }

            },
            getFestiveDay(param) {

                return this.festive_days.find(x => x.day === param.day && x.month === (param.month + 1))
            },
            isFestiveDay(param) {

                return this.festive_days.some(x => x.day === param.day && x.month === (param.month + 1))
            },
            updateLoading(newValue) {
                this.$emit('update:mostrarLoading', newValue);
            },
            updateFormChild(newValue) {
                this.$emit('update:form', newValue); // Emitir evento al padre
                this.deploy_agenda()
            },
            deploy_agenda() {
                let that = this
                that.agenda_deplegada = []
                that.temp_agenda_mes = that.agenda_mes
                this.calendarDays.forEach((temp_day, index) => {
                    let { weekday, day, month } = temp_day
                    if (day !== null) {
                        let temp_guardias = that.temp_agenda_mes.filter(day_month => {
                            let fecha = new Date(day_month.turno_inicio)

                            if (

                                Number(fecha.getDate()) === Number(day) &&
                                Number(fecha.getMonth()) === Number(month)
                            ) {
                                return day_month
                            }
                        })
                        let guardias_por_cargo = []
                        let cargos = Array.from(new Set(temp_guardias.map(x => x.cargo))).sort()

                        cargos.forEach((x, index) => {
                            guardias_por_cargo.push({
                                description: x,
                                items: temp_guardias.filter(y => y.cargo === x).sort((a, b) => new Date(a.turno_inicio) - new Date(b.turno_inicio))
                            })
                        })

                        that.agenda_deplegada[index] = {
                            day,
                            weekday,
                            month,
                            guardias: guardias_por_cargo
                        }
                    }


                })


            },
            getAgendaDesplegada(day) {
                let result = this.agenda_deplegada.filter(x => x !== null)
                    .find(x => Number(x.day) === Number(day) && Number(x.month) === Number(this.month))
                //console.log("getAgendaDesplegada", result)
                return result?.guardias
            },
            getHoraAMPM(param) {
                //console.log(param)
                let fecha = (param.split(" "))[1]
                let m = "AM"
                let p = fecha.split(":")
                let hora = p[0];

                if (parseInt(p[0]) >= 12) {
                    m = "PM"
                    switch (p[0]) {
                        case "13": hora = "1"; break
                        case "14": hora = "2"; break
                        case "15": hora = "3"; break
                        case "16": hora = "4"; break
                        case "17": hora = "5"; break
                        case "18": hora = "6"; break
                        case "19": hora = "7"; break
                        case "20": hora = "8"; break
                        case "21": hora = "9"; break
                        case "22": hora = "10"; break
                        case "23": hora = "11"; break
                        case "00": hora = "12"; break
                    }
                }

                return `${hora.toString().padStart(2, '0')}:${p[1].toString().padStart(2, '0')} ${m}`


            },
            async prevMonth() {
                this.$emit('update:mostrarLoading', true);
                if (this.month === 0) {
                    this.$emit('update:year', this.year - 1);
                    this.$emit('update:month', 11);
                } else {
                    this.$emit('update:month', this.month - 1);
                }
                this.$emit('update:fn_agendas_mes', await this.getGuardiasDelMes()); // Emitir evento al padre


                this.deploy_agenda()


                this.$emit('update:mostrarLoading', false);
            },
            async nextMonth() {
                this.$emit('update:mostrarLoading', true);
                if (this.month === 11) {
                    this.$emit('update:year', this.year + 1);
                    this.$emit('update:month', 0);
                } else {
                    this.$emit('update:month', this.month + 1);
                }
                this.$emit('update:fn_agendas_mes', await this.getGuardiasDelMes()); // Emitir evento al padre

                this.deploy_agenda()

                this.$emit('update:mostrarLoading', false);
            }
        },
        mounted() {
            this.deploy_agenda()

        }
    }
</script>

<style lang="scss">
    .options {
        position: absolute;
        right: 0;
        /* background-color: white; */
        padding: 2px;
        display: none;
    }

    .list-group-item:hover {
        background-color: #dfdfdf !important;
    }

    .list-group-item:hover .options {
        display: block;
    }

    .bg-danger-disabled {
        background-color: #bb7e84 !important;
    }

    .bg-success-cumplido {
        background-color: #daf3e0 !important;
    }

    .calendar {
        max-width: 100%;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .calendar-day,
    .calendar-date {
        padding: 2px;
        /* text-align: center; */
    }

    .calendar-date.empty {
        background-color: #f0f0f0;
    }
</style>
