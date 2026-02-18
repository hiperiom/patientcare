<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title text-primary" id="exampleModalLabel">Añadir guardia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div v-if="!confirmForm">
                        <!-- Persona de guardia -->
                        <div class="form-group text-secondary">
                            <div class="d-flex">
                                <div :class="[{ 'active': form.medico_id !== null }, 'circle-step-number']">
                                    1
                                </div>
                                <label class="ml-2 text-secondary">Selecciona la persona de guardia:</label>
                            </div>

                            <input ref="guardia_persona" placeholder="Buscar personal de área..." type="text"
                                v-model="buscar" class="form-control" id="recipient-name">

                            <div v-if="cat_medicos.length > 0" class="list-group border rounded mt-1 overflow-auto"
                                style="max-height: 238px;">
                                <a v-for="(item, index) in getFiltredMedicoList" :key="index" href="#"
                                    :class="['list-group-item py-1 list-group-item-action', { 'active': form.medico_id === item.user_id }]">
                                    <div @click="setMedicoId(item.user_id)"
                                        class="d-flex align-items-center area-agenda">
                                        <img onerror="this.src='https://via.placeholder.com/300.png';" width="40"
                                            height="40" :src="item.imagen" alt="Imagen no encontrada"
                                            class="border-primary rounded-circle medico-imagen">
                                        <div class="pl-1 mb-0">
                                            {{ item.medico }}
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div v-else class="list-group py-1">
                                <a href="#" class="list-group-item list-group-item-action">
                                    No se encontró personal de área
                                </a>
                            </div>
                        </div>
                        <!-- Cargo -->
                        <div class="form-group mt-2">
                            <div class="d-flex">
                                <div :class="[{ 'active': form.cargo !== '' }, 'circle-step-number']">
                                    2
                                </div>
                                <label class="ml-2 text-secondary">Selecciona Cargo:</label>
                            </div>
                            <select ref="guardia_cargo" v-model="form.cargo" class="form-control">
                                <option value="">Seleccione cargo</option>
                                <option v-for="(item, index) in cargosList" :key="'cargo_list_' + index" :value="item">
                                    {{ item }}
                                </option>
                            </select>
                        </div>
                        <!-- Fecha de inicio y fin -->
                        <div class="form-group d-flex mt-2">
                            <div class="col-6 pl-0">
                                <div class="d-flex">
                                    <div
                                        :class="[{ 'active': form.fecha_inicio !== '' && form.fecha_fin !== '' }, 'circle-step-number']">
                                        3
                                    </div>
                                    <label class="ml-2 text-secondary">Fecha Inicio:</label>
                                </div>
                                <input ref="guardia_fecha_inicio" v-model="form.fecha_inicio" type="date"
                                    class="form-control" id="">
                            </div>
                            <div class="col-6  pr-0">
                                <label class="text-secondary">Fecha Fin:</label>
                                <input ref="guardia_fecha_fin" v-model="form.fecha_fin" type="date" class="form-control"
                                    id="">
                            </div>
                        </div>
                        <!-- dias de guardia -->
                        <div class="form-group d-flex overflow-auto flex-column mt-2">
                            <div class="d-flex">
                                <div
                                    :class="[{ 'active': form.horarios_dias_semana.length > 0 }, 'circle-step-number']">
                                    4
                                </div>
                                <label class="ml-2 text-secondary">Selecciona días de guardias</label>
                            </div>
                            <ul class="list-week-days my-2 d-flex w-100 pl-0">
                                <li @click="handle_dia_semana(item.id)" v-for="(item, index) in dias_semana"
                                    :key="'dia_' + index"
                                    :class="[{ 'bg-primary': isDayActive(item.id) }, { 'bg-light': !isDayActive(item.id) }, 'col py-1']">
                                    {{ item.description.slice(0, 3) }}
                                </li>
                            </ul>
                        </div>
                        <!-- horarios para cada dia -->
                        <div class="form-group d-flex mt-2">
                            <div v-if="form.horarios_dias_semana.length > 0" class="d-flex flex-column w-100">
                                <div class="d-flex">
                                    <div :class="[{ 'active': isAllDayHoursConfigured() }, 'circle-step-number']">
                                        5
                                    </div>
                                    <label class="ml-2 text-secondary">Indica horarios para cada dia:</label>
                                </div>
                                <div class="d-flex w-100 align-items-center">
                                    <div class="col-4">
                                        <label class="text-secondary">Día</label>
                                    </div>
                                    <div class="col-5">
                                        <label class="text-secondary">Hora de Inicio:</label>
                                    </div>
                                    <div class="col-5">
                                        <label class="text-secondary">Hora de Fin:</label>
                                    </div>
                                </div>

                                <div v-for="(item, index) in   form.horarios_dias_semana  " :key="'horarios_' + index"
                                    class="d-flex w-100 align-items-center  mb-1">
                                    <div style="height: 100%;"
                                        :class="[{ 'text-primary font-weight-bold': item.h_inicio !== '' }, { 'text-secondary': item.h_inicio === '' }, 'col-2  d-flex align-items-center text-uppercase']">
                                        {{ item.description }} <span v-if="item.h_inicio !== '' && item.h_fin !== ''"
                                            class="text-primary ml-1">✓</span>
                                    </div>

                                    <div class="col-2" style="height: 100%;">
                                        <div class="dropdown open" style="height: 100%;">
                                            <button style="height: 100%;"
                                                class="btn btn-default text-primary d-flex align-items-center"
                                                type="button" :id="'triggerId' + index" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-list-alt mr-1"></i>
                                                <div :class="[
                        { 'd-none': item.h_inicio === '' },
                        { 'bg-warning': getTimeRange('2024-01-01 ' + item.h_inicio) === 1 },
                        { 'bg-success': getTimeRange('2024-01-01 ' + item.h_inicio) === 2 },
                        { 'bg-primary': getTimeRange('2024-01-01 ' + item.h_inicio) === 3 },
                        'mr-1 area-icon-color'
                    ]">
                                                </div>
                                            </button>
                                            <div class="dropdown-menu" :aria-labelledby="'triggerId' + index">
                                                <button @click="item.h_inicio = '07:00'; item.h_fin = '13:00'"
                                                    class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="bg-warning mr-1 area-icon-color">
                                                    </div>
                                                    07:00 AM a
                                                    01:00 PM
                                                </button>
                                                <button @click="item.h_inicio = '13:00'; item.h_fin = '19:00'"
                                                    class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="bg-success mr-1 area-icon-color">
                                                    </div>
                                                    01:00 PM a 07:00
                                                    PM
                                                </button>
                                                <button @click="item.h_inicio = '19:00'; item.h_fin = '07:00'"
                                                    class="dropdown-item d-flex align-items-center" href="#">
                                                    <div class="bg-primary mr-1 area-icon-color">
                                                    </div>
                                                    07:00 PM a 07:00 AM
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <select v-model="item.h_inicio" class="form-control">
                                            <option class="font-weight-bold" value="">Seleccione</option>
                                            <option v-for="(  item, index  ) in   generarHoras()  "
                                                :value="item.hora24">
                                                {{ item.hora12 }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm">
                                        <select v-model="item.h_fin" class="form-control">
                                            <option class="font-weight-bold" value="">Seleccione</option>
                                            <option v-for="(  item, index  ) in   generarHoras()   "
                                                :value="item.hora24">
                                                {{ item.hora12 }}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div v-else class="d-flex w-100 align-items-center">
                                <div class="col-12 text-center text-secondary">
                                    Seleccione días de la semana de guardia
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="d-flex flex-column" v-else>
                        <div class="d-flex">
                            <div :class="[{ 'active': form.horarios_dias_semana.length > 0 }, 'circle-step-number']">
                                6
                            </div>
                            <label class="ml-2 text-secondary">Indique los días que desee excluir,<br>
                                si los hubiere, luego pulse en Guardar.</label>
                        </div>
                        <div class="flex-fill d-flex justify-content-center flex-wrap w-100 overflow-auto"
                            style="gap: 0.1rem;">
                            <div v-for="(  item, index  ) in   getGuardiaDates()  " :key="'dia_to_confirm' + index"
                                @click="excludeDay(index)"
                                :class="[{ 'disabled': !item.active }, 'btn-calendar-day col-4 col-md-2 d-flex text-center border rounded flex-column']">
                                <div :class="[(item.active ? 'text-primary font-weight-bold' : 'text-secondary')]">
                                    {{ item.dayMonth }}</div>
                                <div class="text-secondary">{{ item.dayName }}</div>
                                <div v-if="item.active" class="text-secondary text-nowrap" style="font-size:0.8rem;">
                                    {{ item.h_inicio }}</div>
                                <div v-if="item.active" class="text-secondary text-nowrap" style="font-size:0.8rem;">
                                    {{ item.h_fin }}</div>
                                <div v-if="!item.active" class="text-secondary text-nowrap" style="font-size:0.8rem;"><i
                                        class="fas h3 mb-0 fa-ban"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button v-if="confirmForm" type="button" @click="confirmForm = false"
                        class="btn btn-default text-primary">Regresar</button>
                    <button v-if="!confirmForm" @click="handle_store_step1()" type="button"
                        class="btn btn-primary">Continuar</button>
                    <button v-if="confirmForm" @click="handle_store_step2()" type="button"
                        class="btn btn-primary">Confirmar y Guardar</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import { get, fechaHoy, post, timestamps2, obtenerUltimoDiaDelMes } from '../../helpers/customHelpers';
    export default {
        name: "AppSeleccionMedico",
        props: {
            parentForm: {
                type: Function,
            },
            dias_semana: {
                type: Array,
                default: []
            },
            cat_medicos: {
                type: Array,
                default: []
            },
            mostrarLoading: {
                type: Boolean,
                // required: true
            }
        },
        data() {
            let currentDate = new Date();
            return {
                step: 0,
                confirmForm: false,
                cargosList: [
                    "RAMH",
                    "Residente de cirugía general",
                    "Residente de Pediatría",
                    "Residente de Ginecoobstetricia",
                    "Residente de Medicina Interna",
                    "Residente de Oncología Médica",
                ],
                itemSelected: 0,
                buscar: "",
                temp_cat_medicos: [],

                form: {
                    medico_id: null,
                    cargo: "",
                    turno: 1,
                    /* dias_semana: [], */
                    horarios_dias_semana: [],
                    fecha_inicio: currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1).toString().padStart(2, '0') + "-" + "01",
                    fecha_fin: currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1).toString().padStart(2, '0') + "-" + obtenerUltimoDiaDelMes(currentDate.getFullYear(), (currentDate.getMonth() + 1)),
                    h_inicio: "07:00",
                    h_fin: "15:00",
                    timestamps: []
                },
            }
        },

        methods: {
            // ??= asigna valor si es null o undefined
            // ||= asigna valor si es false, 0, "", null, undefined, o NaN).
            // &&= asigna valor si no es false, 0, "", null, undefined, o NaN).
            excludeDay(day_index) {
                if (this.form.timestamps[day_index].active) {
                    this.form.timestamps[day_index].active = false
                } else {
                    this.form.timestamps[day_index].active = true
                }

            },
            getGuardiaDates() {
                return this.form.timestamps
            },
            isMedicoIdSelected() {
                return this.form.medico_id ??= false
            },
            setMedicoId(new_medico_id) {
                if (
                    !this.isMedicoIdSelected() ||
                    this.form.medico_id !== new_medico_id
                ) {
                    this.form.medico_id = new_medico_id
                } else {
                    this.form.medico_id = null
                }
            },
            isWeekDayIdSelected(new_week_day_id) {
                return this.getWeekDay().includes(Number(new_week_day_id))
            },
            setWeekDay(new_week_day_id) {
                let dia_semana = this.dias_semana.find(x => x.id === Number(new_week_day_id))
                this.form.horarios_dias_semana.push({
                    id: new_week_day_id,
                    description: dia_semana.description.slice(0, 3),
                    h_inicio: "",
                    h_fin: "",
                    active: true,
                })
            },
            isDayActive(dia) {
                return this.form.horarios_dias_semana.map(x => Number(x.id)).includes(Number(dia)) ? true : false
            },
            getWeekDay() {
                return this.form.horarios_dias_semana.map(x => Number(x.id))
            },
            unSelectedWeekDay(new_week_day_id) {
                this.form.horarios_dias_semana = this.form.horarios_dias_semana.filter(x => x.id !== Number(new_week_day_id))
            },
            handle_dia_semana(new_week_day_id) {

                if (this.isWeekDayIdSelected(new_week_day_id)) {
                    this.unSelectedWeekDay(new_week_day_id)
                } else {
                    this.setWeekDay(new_week_day_id)
                }
            },
            validateForm() {
                let { medico_id, cargo, horarios_dias_semana, fecha_inicio, fecha_fin } = this.form

                if (medico_id === null) {
                    alert("Para continuar, debe pulsar en el listado, la persona que estará de guardia.")
                    this.$refs.guardia_persona.focus()
                    return false
                }
                if (cargo === "") {
                    alert("Para continuar, debe seleccionar el cargo de la persona de guardia.")
                    this.$refs.guardia_cargo.focus()
                    return false
                }
                if (fecha_inicio === "") {
                    alert("Para continuar, debe seleccionar la fecha de inicio de la guardia.")
                    this.$refs.guardia_fecha_inicio.focus()
                    return false
                }
                if (fecha_fin === "") {
                    alert("Para continuar, debe seleccionar la fecha de fin de la guardia.")
                    this.$refs.guardia_fecha_fin.focus()
                    return false
                }
                if (this.getWeekDay().length === 0) {
                    alert("Para continuar, debe seleccionar al menos un dia de guardia.")
                    return false
                }
                if (!this.isAllDayHoursConfigured()) {
                    alert("Para continuar, debe indicar los horarios para cada dia seleccionado.")
                    return false
                }
                return true
            },
            async handle_store_step1() {
                if (this.validateForm()) {
                    this.generateDailyTimestamps()

                    //  this.form.timestamps = result;
                    this.confirmForm = true
                }
            },
            async handle_store_step2() {
                let message = confirm("¿Quieres confirmar y guardar esta agenda?")
                if (message) {
                    this.$emit('update:mostrarLoading', true);
                    let formData = new FormData();
                    formData.append("guardias", JSON.stringify(this.form.timestamps))
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                    let result = await post("guardias/store", formData)
                    this.form.timestamps = result;
                    this.$emit('update:form', this.form);
                    this.$emit('update:mostrarLoading', false);
                    alert("Guardia Registrada Exitosamente")
                    let currentDate = new Date();
                    this.form = {
                        medico_id: null,
                        cargo: "",
                        turno: 1,
                        /* dias_semana: [], */
                        horarios_dias_semana: [],
                        fecha_inicio: currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1).toString().padStart(2, '0') + "-" + "01",
                        fecha_fin: currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1).toString().padStart(2, '0') + "-" + obtenerUltimoDiaDelMes(currentDate.getFullYear(), (currentDate.getMonth() + 1)),
                        h_inicio: "07:00",
                        h_fin: "15:00",
                        timestamps: []
                    }
                    this.confirmForm = false
                    this.buscar = ""
                    $("#exampleModal").modal("hide")

                }




            },
            generateDailyTimestamps() {
                let that = this
                let { medico_id, cargo, fecha_inicio, fecha_fin } = this.form
                this.form.timestamps = [];
                let horas = that.generarHoras()

                const start = new Date(fecha_inicio + " 00:00:00");
                const end = new Date(fecha_fin + " 23:59:59");

                for (let date = new Date(start); date <= end; date.setDate(date.getDate() + 1)) {

                    let fecha = new Date(date.getTime())
                    if (this.getWeekDay().includes(fecha.getDay())) {

                        let horario = this.form.horarios_dias_semana.find(dia => dia.id === Number(fecha.getDay()))

                        const [startHour, startMinute] = horario.h_inicio.split(':').map(Number);
                        fecha.setHours(startHour, startMinute, 0, 0);

                        let hora_inicio = horas.find(hora => hora.hora24 === horario.h_inicio).hora12
                        let hora_fin = horas.find(hora => hora.hora24 === horario.h_fin).hora12


                        let dia_semana = that.dias_semana.find(x => x.id === Number(fecha.getDay()))
                        let medic_data = this.cat_medicos.find(x => x.user_id === medico_id)
                        // console.log(medic_data);
                        that.form.timestamps.push(
                            {
                                id: 4,
                                fecha_inicio: fecha_inicio + " " + horario.h_inicio + ":00",
                                fecha_fin: fecha_fin + " " + horario.h_fin + ":00",
                                turno_inicio: fecha.getFullYear() +
                                    "-" +
                                    (fecha.getMonth() + 1).toString().padStart(2, '0') +
                                    "-" +
                                    (fecha.getDate()).toString().padStart(2, '0') +
                                    " " +
                                    horario.h_inicio + ":00",
                                turno_fin: fecha.getFullYear() +
                                    "-" +
                                    (fecha.getMonth() + 1).toString().padStart(2, '0') +
                                    "-" +
                                    (fecha.getDate()).toString().padStart(2, '0') +
                                    " " +
                                    horario.h_fin + ":00",
                                h_inicio: hora_inicio,
                                h_fin: hora_fin,
                                turno_id: that.getTimeRange(timestamps2(fecha)),

                                user_id: medic_data.user_id,
                                cargo,

                                dayWeek: fecha.getDay(),
                                dayMonth: fecha.getDate(),
                                monthYear: (fecha.getMonth() + 1),
                                year: fecha.getFullYear(),
                                dayName: dia_semana.description.slice(0, 3).toUpperCase(),
                                //timestamp: timestamps2(fecha),
                                active: true,
                                comentarios: "",
                                cumplido: false,

                                imagen: medic_data.imagen,
                                personal: medic_data.medico,
                                asterisco: medic_data.extension_telefonica,
                                telefono_movil: medic_data.telefono_movil,
                            },
                        );
                    }

                }
                console.log(this.form.timestamps);
            },
            getTimeRange(timestamp) {
                const date = new Date(timestamp);

                const hours = date.getHours();
                const minutes = date.getMinutes();

                if ((hours >= 7 && hours < 13) || (hours === 12 && minutes <= 59)) {
                    return 1; // Entre las 7 am y las 12:59 pm
                } else if ((hours >= 13 && hours < 19) || (hours === 18 && minutes <= 59)) {
                    return 2; // Entre la 1 pm y las 6:59 pm
                } else {
                    return 3; // Entre las 7 pm y las 6:59 am
                }
            },
            generarHoras() {
                const horas = [];
                for (let h = 0; h < 24; h++) {
                    for (let m = 0; m < 60; m += 30) {
                        const hora24 = `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}`;
                        const periodo = h < 12 ? 'AM' : 'PM';
                        const hora12 = `${String(h % 12 || 12).padStart(2, '0')}:${String(m).padStart(2, '0')} ${periodo}`;
                        horas.push({ hora24, hora12 });
                    }
                }
                return horas;
            },
            isAllDayHoursConfigured() {
                return this.form.horarios_dias_semana.every(dia => dia.h_inicio !== "" && dia.h_fin !== "");
            },
        },
        computed: {

            getFiltredMedicoList() {
                let {
                    buscar,
                    temp_cat_medicos
                } = this

                if (this.buscar === "") {
                    return temp_cat_medicos = this.cat_medicos
                } else {
                    return temp_cat_medicos = this.cat_medicos.filter(item => {
                        if (
                            item.medico !== null &&
                            item.medico.toLowerCase().indexOf(buscar.toLowerCase()) !== -1
                        ) {
                            return item
                        }
                    })
                }


            },

        },
        mounted() {

            //this.$emit('update:form', this.form);
            // $("#exampleModal").modal("show")


        },


    }
</script>

<style lang="scss" scoped>
    .btn-calendar-day {
        cursor: pointer;
    }

    .btn-calendar-day:hover {
        background-color: var(--light);
    }

    .btn-calendar-day.disabled {
        background-color: var(--light);
    }

    .circle-step-number {
        font-weight: 600;
        text-align: center;
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 50px;
        background-color: var(--gray);
        color: var(--primary);
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        line-height: 0.7;
    }

    .circle-step-number.active {
        background-color: var(--primary);
        color: var(--white);
    }

    .list-group-item:hover {
        background-color: #dfdfdf !important;
        color: var(--primary);
        border-top: transparent;
        border-left: transparent;
        border-right: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .list-group-item:hover .options {
        display: block
    }

    .list-week-days {
        list-style: none;
        gap: 2px;
    }

    .list-week-days li {
        text-align: center;
        cursor: pointer;
        background-color: white;
        color: var(--secondary);
        border-radius: 4px;
    }

    .list-week-days li:hover {
        background-color: var(--light);
    }

    .list-week-days>li:focus {
        background-color: var(--primary) !important;
        color: white !important;
    }
</style>
